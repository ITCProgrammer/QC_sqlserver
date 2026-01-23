<?php
include_once("../koneksi.php");
ini_set("error_reporting",1);
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=persediaan_benang_".date($_GET['tglrpt']).".xls");//ganti nama sesuai keperluan
header("Pragma: no-cache");
header("Expires: 0");

//disini script laporan anda
?> 
<body>
<center><b>LAPORAN PERSEDIAAN KAIN JADI</b></center>    
<?php $tgl_cetak1=$_GET['awal'];$tgl_cetak2=$_GET['akhir'];

	if($_GET['no_order']!='')
	{ $where.= " AND c.no_order ='".$_GET['no_order']."' "; 
		}else{ $where.= " "; }
	if($_GET['awal']!='' and $_GET['akhir']!='')
	{ $where1.= " AND DATE_FORMAT(a.tgl_update,'%Y-%m-%d') BETWEEN '".$_GET['awal']."'"." AND '$tgl_cetak2' "; 
		}else{ $where1.= " "; }
	
		echo "<b>TGL : ".$_GET['awal']." s/d ". $_GET['akhir']."</b><br>";
	?>
                      
<table width="100" border="1" align="center" style="font-size:11px">
  <tr align="center">
    <td rowspan="2" >TGL</td>
    <td rowspan="2" >NO ITEM</td>
    <td rowspan="2" >LANGGANAN</td>
    <td width="15" rowspan="2" >PO</td>
    <td width="15" rowspan="2" >ORDER</td>
    <td rowspan="2" >JENIS_KAIN</td>
    <td rowspan="2" >NO WARNA</td>
    <td rowspan="2" >WARNA</td>
    <td rowspan="2" >NO CARD</td>
    <td rowspan="2" >LOT</td>
    <td rowspan="2" >ROLL</td>
    <td colspan="3" >Netto (KG)</td>
    <td rowspan="2" >Yard / Meter</td>
    <td rowspan="2" >UNIT</td>
    <td rowspan="2" >EXTRA Q</td>
    <td rowspan="2" >LBR</td>
    <td rowspan="2" >X</td>
    <td rowspan="2" >GRMS</td>
    <td rowspan="2" >OL</td>
    <td rowspan="2">Keterangan</td>
  </tr>
  <tr align="center">
    <td>Grade<br /> A+B</td>
    <td>Grade <br /> C</td>
    <td>Keterangan<br />(Grade C)</td>
  </tr>
  <?php 
 
  $sql=sqlsrv_query($con," SELECT
	a.tgl_update,c.no_po,c.no_order,a.blok,
	b.sisa,b.nokk,c.jenis_kain,c.pelanggan,c.no_lot,c.no_warna,
	c.warna,c.lebar,c.berat,c.no_item
	FROM
	pergerakan_stok a
	LEFT JOIN detail_pergerakan_stok b ON a.id = b.id_stok
  	LEFT JOIN tmp_detail_kite d ON d.id=b.id_detail_kj
	LEFT JOIN tbl_kite c ON c.id = d.id_kite
	WHERE
	(a.typestatus = '1' OR a.typestatus = '2')
	AND (a.fromtoid = 'GUDANG KAIN JADI' OR a.fromtoid = 'PACKING') ".$where.$where1." 
	GROUP BY
	b.nokk,b.sisa
	ORDER BY
	a.tgl_update,a.id ");
  $c=1;
  $i=1;
  while($row=sqlsrv_fetch_array($sql))
  {
	   $bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99';
	   $mySql =sqlsrv_query($con,"SELECT tempat FROM mutasi_kain WHERE nokk='".$row['nokk']."' AND keterangan='".$row['sisa']."' order by id asc");
	   $myBlk = sqlsrv_fetch_array($mySql);
	   
	   $mysqlCek=sqlsrv_query($con," SELECT
	SUM(case when b.grade='A' or b.grade='B' or b.grade='C' or b.grade='' then b.weight else 0 end) as tot_qty,
	SUM(if(b.grade='A' or b.grade='B' or b.grade='C' or b.grade='', 1, 0)) as tot_rol,
	SUM(case when b.grade='A' or b.grade='B' or b.grade='C' or b.grade='' then b.yard_ else 0 end) as tot_yard,
	SUM(case when b.grade='A' or b.grade='B' or b.grade='' then b.weight else 0 end) as grd_ab,
	SUM(case when b.grade='C' then b.weight else 0 end) as grd_c,
	SUM(if(b.grade='A' or b.grade='B' or b.grade='', 1, 0)) as jml_ab,
	SUM(if(b.grade = 'C', 1, 0)) as jml_grd_c,b.sisa,b.satuan,SUM(d.netto) as netto
	FROM
	pergerakan_stok a 
	LEFT JOIN detail_pergerakan_stok b  ON a.id = b.id_stok
  LEFT JOIN tmp_detail_kite d ON d.id=b.id_detail_kj
	LEFT JOIN tbl_kite c ON c.id = d.id_kite
	WHERE
	b.`transtatus`='1' and b.nokk='".$row['nokk']."' and b.sisa='".$row['sisa']."'
	GROUP BY
	b.sisa
	ORDER BY
	a.id ");
	$myro = sqlsrv_fetch_array($mysqlCek);
	$mySql1 =sqlsrv_query($con,"SELECT * FROM tbl_kite WHERE nokk='".$row['nokk']."'");
	$myBlk1 = sqlsrv_fetch_array($mySql1);
	if($myro['tot_rol']>0 and $myBlk1['no_order'] == ""){
	   $mySql1 =sqlsrv_query($con,"SELECT * FROM tbl_kite WHERE nokk='".$row['nokk']."'");
	   $myBlk1 = sqlsrv_fetch_array($mySql1);
	  ?>
    <tr>
    <td><?php echo date("d-M-Y", strtotime($row['tgl_update']));?></td>
    <td><?php echo $mySql1['no_item'];?></td>
    <td><?php echo $mySql1['pelanggan'];?></td>
    <td><?php echo $mySql1['no_po'];?></td>
    <td><?php echo $mySql1['no_order'];?></td>
    <td><?php echo htmlentities($mySql1['jenis_kain'],ENT_QUOTES);?></td>
    <td><?php echo $mySql1['no_warna'];?></td>
    <td><?php echo $mySql1['warna'];?></td>
    <td><a href="#" onClick="window.open('detail-persediaan.php?nokk=<?php echo $row['nokk'];?>&ket=<?php echo $row['sisa'];?>','MyWindow','height=400,width=500');"><?php echo $row['nokk'];?></a></td>
    <td><?php echo $mySql1['no_lot'];?></td>
    <td align="right"><?php 
	echo $myro['tot_rol'];
	?></td>
    <td align="right"><?php 
	echo number_format($myro['grd_ab'],'2','.',',');?></td>
    <td align="right"><?php 
	echo number_format($myro['grd_c'],'2','.',',');
	?></td>
    <td><?php if($row['sisa']=="SISA" || $row['sisa']=="FKSI"){echo "SISA";}?></td>
    <td align="right"><?php 
	if($myro['satuan']=="PCS"){echo number_format($myro['netto'])." ".$myro['satuan'];}else{
	echo number_format($myro['tot_yard'],'2','.',',')." ".$myro['satuan'];} ?></td>
    <td><input class="input1" name="tempat[<?php echo $i;?>]" type="hidden" value="<?php echo $myBlk['blok'];?>" >
    <input name="nokk" type="hidden" value="<?php echo $row['nokk'];?>"><a href="#"onClick="window.open('tempat-persediaan.php?nokk=<?php echo $row['nokk'];?>&ket=<?php echo $row['sisa'];?>','MyWindow','height=200,width=500');"><?php if($myBlk['tempat']==""){echo "N/A";}else{echo $myBlk['tempat'];}?></a></td>
    <td><?php if($myro['sisa']=="FOC"){echo "EXTRA FULL";}?></td>
    <td><?php echo $mySql1['lebar'];?></td>
    <td>X</td>
    <td><?PHP echo $mySql1['berat']; ?></td>
    <td>&nbsp;</td>
    <td align="center"><?php  $i++; ?></td>
  </tr>
 
      <?php
	}
	  	 if($myro['sisa']=="SISA" || $myro['sisa']=="FKSI" || $myro['sisa']=="FOC"){$brtoo=0;}else{$brtoo=number_format($row['bruto'],'2','.',',');}
	   $totbruto=$totbruto+$brtoo;
	  $totyard=$totyard+$myro['tot_yard'];
	  $totrol=$totrol+$myro['tot_rol'];
	  $totab=$totab+$myro['grd_ab'];
	  $tota=$tota+$myro['grd_c'];
	  $totpcs=$totpcs +$myro['netto'];
	  $rolab=$rolab + $myro['jml_ab'];
	  $rolac=$rolac + $myro['jml_grd_c'];
	  	if($myro['satuan']=='Meter')
		{$kartot=$kartot + $myro['tot_yard']; $totrolm = $totrolm + $myro['tot_rol'];}
		if($myro['satuan']=='Yard')
		{$pltot=$pltot + $myro['tot_yard'];   $totroly = $totroly + $myro['tot_rol'];}
		if($myro['satuan']=='PCS')
		{$totrolp = $totrolp + $myro['tot_rol'];}
	  
	  }
	  
	  
  ?>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>PCS</td>
    <td align="right"><?php echo number_format($totrolp); ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
 <tr>
   <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Meter</td>
    <td align="right"><?php echo number_format($totrolm); ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Meter</td>
    <td align="right"><?php echo number_format($kartot,'2','.',','); ?></td>
    <td>&nbsp;</td>
    <td align="right"><?php echo number_format($totpcs); ?></td>
    <td>PCS</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Yard</td>
    <td align="right"><?php echo  number_format($totroly);?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Yard</td>
    <td align="right"><?php echo  number_format($pltot,'2','.',',');?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><b>Total</b></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="right"><b><?php echo $totrol;?></td>
    <td align="right"><b><?php echo number_format($totab,'2','.',',');?></b></td>
    <td align="right"><b><?php echo number_format($tota,'2','.',',');?></b></td>
    <td>&nbsp;</td>
    <td align="right">&nbsp;</td>
    
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="22"><b>( Roll : <?php echo  number_format($totrol);  ?> ) (GRADE A+B: <?php echo  number_format($totab,'2','.',',');  ?> Kg, Roll: <?php echo  number_format($rolab);  ?>)  (GRADE C: <?php echo  number_format($tota,'2','.',',');  ?> Kg, Roll: <?php echo  number_format($rolac);  ?>) (TOTAL : <?php echo  number_format($totab+$tota,'2','.',',');  ?> Kg) </b></td>
  </tr>
  <b>( Roll : <?php echo  number_format($totrol);  ?> ) (GRADE A+B: <?php echo  number_format($totab,'2','.',',');  ?> Kg, Roll: <?php echo  number_format($rolab);  ?>)  (GRADE C: <?php echo  number_format($tota,'2','.',',');  ?> Kg, Roll: <?php echo  number_format($rolac);  ?>) (TOTAL : <?php echo  number_format($totab+$tota,'2','.',',');  ?> Kg) </b>
      </table>
</body>
</html>
