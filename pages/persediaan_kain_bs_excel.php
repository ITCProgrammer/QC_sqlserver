 <?php
include_once("../koneksi.php");
ini_set("error_reporting",1);
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=persediaan_kain_jadi_bs_".date($_GET['tglrpt']).".xls");//ganti nama sesuai keperluan
header("Pragma: no-cache");
header("Expires: 0");
//disini script laporan anda
?>
<html>
  
   <!--
    Created by Artisteer v2.3.0.21098
    Base template (without user's data) checked by http://validator.w3.org : "This page is valid XHTML 1.0 Transitional"
    -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <title>Laporan Persedian Kain BS</title>

</head>
<body>
<table width="100%" align="center" style="font-size:11px" border="1">
  <tr>
    <th colspan="22" align="center" style="font-size:18px"><b>LAPORAN PERSEDIAAN KAIN BS </b></th>
    </tr>
  <tr>
   <?php $tgl_cetak1=$_GET['awal']; $tgl_cetak2=$_GET['akhir'];?>
   <?php 
mysql_connect("10.0.0.10","dit","4dm1n");
mysql_select_db("db_qc")or die("Gagal Koneksi");
	 if($_GET['no_order']!='')
	{ $where.= " AND c.no_order ='$_GET[no_order]' "; 
		}else{ $where.= " "; }
	 if($tgl_cetak1!='' and $tgl_cetak2!="")
	{ $where1.= " AND a.tgl_update between '$tgl_cetak1' AND '$tgl_cetak2' "; 
		}else{ $where1.= " "; }	
	$mysqry=mysql_query("SELECT
	SUM(case when b.grade='A' or b.grade='B' or b.grade='C' or b.grade='' then b.weight else 0 end) as tot_qty,
	SUM(if(b.grade='A' or b.grade='B' or b.grade='C' or b.grade='', 1, 0)) as tot_rol,
	SUM(case when b.grade='A' or b.grade='B' or b.grade='C' or b.grade='' then b.yard_ else 0 end) as tot_yard,
	SUM(case when b.grade='A' or b.grade='B' or b.grade='' then b.weight else 0 end) as grd_ab,
	SUM(case when b.grade='C' then b.weight else 0 end) as grd_c,
	SUM(if(b.grade='A' or b.grade='B' or b.grade='', 1, 0)) as jml_ab,
	SUM(if(b.grade = 'C', 1, 0)) as jml_grd_c
	FROM
	pergerakan_stok a 
	LEFT JOIN detail_pergerakan_stok b  ON a.id = b.id_stok
    LEFT JOIN tmp_detail_kite d ON d.id=b.id_detail_kj
	LEFT JOIN tbl_kite c ON c.id = d.id_kite
	WHERE
	b.transtatus='11' ".$where1.$where." 
	ORDER BY
	a.id");
	$myrow=mysql_fetch_array($mysqry);
	?>
  <input name="tgl" type="hidden" value="<?php echo $tgl_cetak1;?>">  
    <th colspan="22" style="font-size:14px"><b> ( Roll :  <?php echo  number_format($myrow[tot_rol]);  ?> ) (GRADE A+B: <?php echo  number_format($myrow[grd_ab],'2');  ?> Kg, Roll: <?php echo  number_format($myrow[jml_ab]);  ?>)  (GRADE C: <?php echo  number_format($myrow[grd_c],'2');  ?> Kg, Roll: <?php echo  number_format($myrow[jml_grd_c]);  ?>) (TOTAL : <?php echo  number_format($myrow[tot_qty],'2');  ?> Kg) </b></th>
    </tr>
  <tr align="center">
    <th width="26" rowspan="2">TGL</th>
    <th width="56" rowspan="2">NO ITEM</th>
    <th width="73" rowspan="2">LANGGANAN</th>
    <th width="30" rowspan="2">PO</th>
    <th width="52" rowspan="2">ORDER</th>
    <th width="65" rowspan="2">JENIS_KAIN</th>
    <th width="77" rowspan="2" >NO WARNA</th>
    <th width="52" rowspan="2">WARNA</th>
    <th width="64" rowspan="2">NO CARD</th>
    <th width="33" rowspan="2">LOT</th>
    <th width="38" rowspan="2">ROLL</th>
    <th colspan="3">Netto (KG)</th>
    <th width="77" rowspan="2">Yard / Meter</th>
    <th width="31" rowspan="2">UNIT</th>
    <th width="57" rowspan="2">EXTRA Q</th>
    <th width="27" rowspan="2">LBR</th>
    <th width="10" rowspan="2">X</th>
    <th width="40" rowspan="2">GRMS</th>
    <th width="20" rowspan="2">OL</th>
    <th width="82" rowspan="2">Keterangan</th>
  </tr>
  <tr align="center">
    <th width="38">Grade<br /> A+B</th>
    <th width="42">Grade <br /> C</th>
    <th width="72">Keterangan<br />(Grade C)</th>
    </tr>
  <?php 
 
  $sql=mysql_query("SELECT
	a.tgl_update,c.no_po,c.no_order,a.blok,b.weight,b.yard_,b.no_roll,
	b.satuan,b.grade,b.sisa,b.nokk,c.jenis_kain,c.pelanggan,c.no_lot,c.no_warna,
	c.warna,c.lebar,c.berat,c.no_item,
	SUM(case when b.grade='A' or b.grade='B' or b.grade='C' or b.grade='' then b.weight else 0 end) as tot_qty,
	SUM(if(b.grade='A' or b.grade='B' or b.grade='C' or b.grade='', 1, 0)) as tot_rol,
	SUM(case when b.grade='A' or b.grade='B' or b.grade='C' or b.grade='' then b.yard_ else 0 end) as tot_yard,
	SUM(case when b.grade='A' or b.grade='B' or b.grade='' then b.weight else 0 end) as grd_ab,
	SUM(case when b.grade='C' then b.weight else 0 end) as grd_c,
	SUM(if(b.grade='A' or b.grade='B' or b.grade='', 1, 0)) as jml_ab,
	SUM(if(b.grade = 'C', 1, 0)) as jml_grd_c,SUM(d.netto) as netto
	FROM
	pergerakan_stok a
	LEFT JOIN detail_pergerakan_stok b ON a.id = b.id_stok
    LEFT JOIN tmp_detail_kite d ON d.id=b.id_detail_kj
	LEFT JOIN tbl_kite c ON c.id = d.id_kite
	WHERE
	b.transtatus='11' ".$where1.$where." 
	GROUP BY
	a.id,b.nokk,b.sisa
	ORDER BY
	a.id");
  $c=1;
  $i=1;
  while($row=mysql_fetch_array($sql))
  {
	   $bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99';
	   $mySql =mysql_query("SELECT tempat FROM mutasi_kain WHERE nokk='$row[nokk]' order by id asc");
	   $myBlk = mysql_fetch_array($mySql);
	  ?>
    <tr>
    <td><?php echo date("d-M-Y", strtotime($row['tgl_update']));?></td>
    <td><?php echo $row['no_item'];?></td>
    <td><?php echo $row['pelanggan'];?></td>
    <td><?php echo $row['no_po'];?></td>
    <td><?php echo $row['no_order'];?></td>
    <td><?php echo htmlentities($row['jenis_kain'],ENT_QUOTES);?></td>
    <td><?php echo $row['no_warna'];?></td>
    <td><?php echo $row['warna'];?></td>
    <td><a href="#" onClick="window.open('detail-persediaan-bs.php?nokk=<?php echo $row['nokk'];?>&ket=<?php echo $row['sisa'];?>','MyWindow','height=400,width=500');">'<?php echo $row['nokk'];?></a></td>
    <td>'<?php echo $row['no_lot'];?></td>
    <td align="right"><?php 
	$rol=$row['tot_rol'];
	echo $rol;
	?></td>
    <td align="right"><?php 
	$grab=number_format($row['grd_ab'],'2','.',',');echo $grab;?></td>
    <td align="right"><?php 
	$grc=number_format($row['grd_c'],'2','.',',');
	echo $grc;?></td>
    <td><?php if($row['sisa']=="SISA" || $row['sisa']=="FKSI"){echo "SISA";}else if($row['sisa']=="BS"){echo "BS";}?></td>
    <td align="right"><?php 
	if($row['satuan']=="PCS"){echo number_format($row['netto'])." ".$row['satuan'];}else{
	echo number_format($row['tot_yard'],'2','.',',')." ".$row['satuan'];} ?></td>
    <td><a href="#"onClick="window.open('tempat-persediaan.php?id=<?php echo $row['id_stok'];?>&nokk=<?php echo $row['nokk'];?>&ket=<?php echo $row['sisa'];?>','MyWindow','height=200,width=500');"><?php 
	if($myBlk['tempat']!=""){echo $myBlk['tempat'];}else if($row['blok']!=""){echo $row['blok'];}else{echo "N/A";}?></a></td>
    <td><?php if($row['sisa']=="FOC"){echo "EXTRA FULL";}?></td>
    <td><?php echo $row['lebar'];?></td>
    <td>X</td>
    <td><?PHP echo $row['berat']; ?></td>
    <td>&nbsp;</td>
    <td align="center"><?php  $i++; ?></td>
  </tr>
 
      <?php
	  	 if($row['sisa']=="SISA" || $row['sisa']=="FKSI" || $row['sisa']=="FOC"){$brtoo=0;}else{$brtoo=number_format($row['bruto'],'2','.',',');}
	   $totbruto=$totbruto+$brtoo;
	  $totyard=$totyard+$row['tot_yard'];
	  $totrol=$totrol+$rol;
	  $totab=$totab+$row['grd_ab'];
	  $tota=$tota+$row['grd_c'];
	  $totpcs=$totpcs +$row['netto'];
	  	if($row['satuan']=='Meter')
		{$kartot=$kartot + $row['tot_yard']; $totrolm = $totrolm + $row['tot_rol'];}
		if($row['satuan']=='Yard')
		{$pltot=$pltot + $row['tot_yard'];   $totroly = $totroly + $row['tot_rol'];}
		if($row['satuan']=='PCS')
		{$totrolp = $totrolp + $row['tot_rol'];}
	  
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
    <td colspan="22"><b>( Roll : <?php echo  number_format($myrow[tot_rol]);  ?> ) (GRADE A+B: <?php echo  number_format($myrow[grd_ab],'2');  ?> Kg, Roll: <?php echo  number_format($myrow[jml_ab]);  ?>)  (GRADE C: <?php echo  number_format($myrow[grd_c],'2');  ?> Kg, Roll: <?php echo  number_format($myrow[jml_grd_c]);  ?>) (TOTAL : <?php echo  number_format($myrow[tot_qty],'2');  ?> Kg) </b></td>
    </tr>
  
      </table>    
</body>
</html>
