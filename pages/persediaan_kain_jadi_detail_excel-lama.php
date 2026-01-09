<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=persediaan_kain_jadi_detail_".date($_GET['tglrpt']).".xls");//ganti nama sesuai keperluan
header("Pragma: no-cache");
header("Expires: 0");
//disini script laporan anda
?> 
<body>
<center><b>LAPORAN DETAIL PERSEDIAAN KAIN JADI</b></center>    
<?php $tgl_cetak1=$_GET['awal'];$tgl_cetak2=$_GET['akhir'];?>
   <?php 
mysql_connect("192.168.0.4","dit","4dm1n");
mysql_select_db("db_qc")or die("Gagal Koneksi");
	if($_GET['blok']!='')
	{ $where3.= " AND a.blok LIKE '%$_GET[blok]%' "; 
		}else{ $where3.= " "; }
	if($_GET['ket']=='SISA')
	{ $where4.= " AND (b.sisa='SISA' OR b.sisa='FKSI') "; 
		}elseif($_GET['ket']==''){
			$where4.= " AND (b.sisa='' OR b.sisa='KITE') "; 		}else{ $where4.= " "; }
	if($_GET['no_order']!='')
	{ $where.= " AND c.no_order ='$_GET[no_order]' "; 
		}else{ $where.= " "; }
		if($_GET['no_item']!='')
	{
		$item=trim($_GET[no_item]); 
	$where5.= " AND trim(c.no_item)='$item' "; 
		}else{ $where5.= " "; }	
		if($_GET['no_warna']!='')
	{
		$warna=trim($_GET[no_warna]); 
	$where6.= " AND trim(c.no_warna)='$warna' "; 
		}else{ $where6.= " "; }	
		
		if($_GET['buyer']!='')
	{
		$buyer=trim($_GET[buyer]); 
	$where8.= " AND trim(c.pelanggan) LIKE '%$buyer' "; 
		}else{ $where8.= " "; }
		
		if($_GET['bs']!='')
	{
		$bs=trim($_GET[bs]); 
	$where9.= " AND ( a.fromtoid = 'QC BS') "; 
		}else{ $where9.= " AND (a.fromtoid = 'GUDANG KAIN JADI' OR a.fromtoid = 'PACKING' OR a.fromtoid='LAIN' OR a.fromtoid='INSPEK MEJA' OR a.fromtoid ='GANTI STIKER' OR a.fromtoid = 'POTONG SISA') "; }
		
		if($_GET['lbr']!='' and $_GET['grms']!='')
	{
		$lebar=trim($_GET[lbr]);
		$berat=trim($_GET[grms]); 
	$where7.= " AND trim(c.lebar)='$lebar' AND trim(c.berat)='$berat' "; 
		}else{ $where7.= " "; }
		
	if($_GET['awal']!='' and $_GET['akhir']!='')
	{ $where1.= " AND DATE_FORMAT(a.tgl_update,'%Y-%m-%d') BETWEEN '$_GET[awal]'"." AND '$tgl_cetak2' "; 
		}else{ $where1.= " "; }
	
		echo "<b>TGL : ".$_GET['awal']." s/d ". $_GET['akhir']."</b><br>";
	?>
                      
<table  border="1" align="center" style="font-size:11px">
  <tr align="center">
    <td  rowspan="2" >TGL</td>
    <td  rowspan="2" >NO ITEM</td>
    <td  rowspan="2" >LANGGANAN</td>
    <td  rowspan="2" >PO</td>
    <td  rowspan="2" >ORDER</td>
    <td  rowspan="2" >JENIS_KAIN</td>
    <td  rowspan="2" >NO WARNA</td>
    <td  rowspan="2" >WARNA</td>
    <td  rowspan="2" >NO CARD</td>
    <td  rowspan="2" >LOT</td>
    <td  rowspan="2" >NO ROLL</td>
    <td colspan="3" >Netto (KG)</td>
    <td  rowspan="2" >Yard / Meter</td>
    <td  rowspan="2" >UNIT</td>
    <td  rowspan="2" >EXTRA Q</td>
    <td  rowspan="2" >LBR</td>
    <td  rowspan="2" >X</td>
    <td  rowspan="2" >GRMS</td>
    <td  rowspan="2" >OL</td>
    <td  rowspan="2">Keterangan</td>
  </tr>
  <tr align="center">
    <td >Grade<br /> A+B</td>
    <td >Grade <br /> C</td>
    <td >Keterangan<br />(Grade C)</td>
  </tr>
  <?php 
 
  $sql=mysql_query(" SELECT
	a.tgl_update,c.no_po,c.no_order,a.blok,
	b.sisa,b.nokk,c.jenis_kain,c.pelanggan,c.no_lot,c.no_warna,
	c.warna,c.lebar,c.berat,c.no_item,b.id_stok,b.no_roll,b.weight,b.grade,b.ket_c,b.yard_,b.satuan,d.netto
	FROM
	pergerakan_stok a
	LEFT JOIN detail_pergerakan_stok b ON a.id = b.id_stok
  	LEFT JOIN tmp_detail_kite d ON d.id=b.id_detail_kj
	LEFT JOIN tbl_kite c ON c.id = d.id_kite
	WHERE
	(a.typestatus = '1' OR a.typestatus = '2')
	 AND not ISNULL(b.transtatus) AND b.transtatus='1' ".$where9.$where8.$where7.$where6.$where5.$where4.$where3.$where.$where1." 
	ORDER BY
	a.tgl_update,a.id ");
  $c=1;
  $i=1;
  while($row=mysql_fetch_array($sql))
  {
	   $bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99';
	   $mySql =mysql_query("SELECT tempat,catatan FROM mutasi_kain WHERE nokk='$row[nokk]' AND keterangan='$row[sisa]' AND not tempat='' order by id asc");
	   $myBlk = mysql_fetch_array($mySql);
	   $mySqlC =mysql_query("SELECT tempat,catatan FROM mutasi_kain WHERE nokk='$row[nokk]' AND keterangan='$row[sisa]' order by id asc");
	   $myBlkC = mysql_fetch_array($mySqlC);
	   
	   $mysqlCek=mysql_query(" SELECT
	SUM(case when b.grade='A' or b.grade='B' or b.grade='C' or b.grade='' then b.weight else 0 end) as tot_qty,
	SUM(if(b.grade='A' or b.grade='B' or b.grade='C' or b.grade='', 1, 0)) as tot_rol,
	SUM(case when b.grade='A' or b.grade='B' or b.grade='C' or b.grade='' then b.yard_ else 0 end) as tot_yard,
	SUM(case when b.grade='A' or b.grade='B' or b.grade='' then b.weight else 0 end) as grd_ab,
	SUM(case when b.grade='C' then b.weight else 0 end) as grd_c,
	SUM(if(b.grade='A' or b.grade='B' or b.grade='', 1, 0)) as jml_ab,
	SUM(if(b.grade = 'C', 1, 0)) as jml_grd_c,b.sisa,b.satuan,SUM(d.netto) as netto,
	a.blok
	FROM
	pergerakan_stok a 
	LEFT JOIN detail_pergerakan_stok b  ON a.id = b.id_stok
    LEFT JOIN tmp_detail_kite d ON d.id=b.id_detail_kj
	LEFT JOIN tbl_kite c ON c.id = d.id_kite
	WHERE
	b.`transtatus`='1' and b.nokk='$row[nokk]' and b.sisa='$row[sisa]' and b.id_stok='$row[id_stok]'
	
	ORDER BY
	a.id ");
	$myro = mysql_fetch_array($mysqlCek);
	if($myro['tot_rol']>0){
	   $mySql1 =mysql_query("SELECT * FROM tbl_kite WHERE nokk='$row[nokk]'");
	   $myBlk1 = mysql_fetch_array($mySql1);
	   $mySql2 =mysql_query("SELECT a.no_po,a.no_order FROM pergerakan_stok a
INNER JOIN detail_pergerakan_stok b ON a.id=b.id_stok
WHERE b.nokk='$row[nokk]' and ISNULL(b.transtatus)
GROUP BY b.nokk");
	  ?>
    <tr>
    <td><?php echo date("d-M-Y", strtotime($row['tgl_update']));?></td>
    <td>'<?php echo $myBlk1['no_item'];?></td>
    <td><?php echo $myBlk1['pelanggan'];?></td>
    <td>'
      <?php if($myBlk1['no_po']!=""){echo $myBlk1['no_po'];}else{echo $myBlk2['no_po'];}?></td>
    <td><?php if($myBlk1['no_order']!=""){echo $myBlk1['no_order'];}else{echo $myBlk2['no_order'];}?></td>
    <td><?php echo htmlentities($myBlk1['jenis_kain'],ENT_QUOTES);?></td>
    <td><?php echo $myBlk1['no_warna'];?></td>
    <td><?php echo $myBlk1['warna'];?></td>
    <td>'<?php echo $row['nokk'];?></td>
    <td>'<?php echo $myBlk1['no_lot'];?></td>
    <td align="right">'<?php 
	echo $row['no_roll'];
	?></td>
    <td align="right"><?php if($row[grade]!="C"){
		echo $row['weight'];
		$gradeAB=$row['weight'];
	}else{echo "0.00";$gradeAB=0;}
		?></td>
    <td align="right"><?php if($row[grade]=="C"){
		echo $row['weight'];
		$gradeC=$row['weight'];	
	}else{echo "0.00";$gradeC=0;}
		?></td>
    <td><?php 
		if($row['sisa']=="SISA" or $row['sisa']=="FKSI"){echo"SISA";}else{echo $row['ket_c'];}	
	?></td>
    <td align="right"><?php 
		if($row['satuan']=="Meter"){
			echo $row['yard_']." ".$row['satuan'];			
		}else if($row['satuan']=="Yard"){
			echo $row['yard_']." ".$row['satuan'];
		}else if($row['satuan']=="PCS"){
			echo $row['netto']." ".$row['satuan'];}	
			
	?></td>
    <td><?php 
	if($myBlk['tempat']!=""){echo $myBlk['tempat'];}else if($row['blok']!=""){echo $row['blok'];}else{echo "N/A";}?></td>
    <td><?php if($row['sisa']=="FOC"){echo "EXTRA FULL";}?></td>
    <td><?php echo $myBlk1['lebar'];?></td>
    <td>X</td>
    <td><?PHP echo $myBlk1['berat']; ?></td>
    <td><?php if($row['sisa']=="KITE" || $row['sisa']=="FKSI"){echo "Fasilitas KITE";}?></td>
    <td align="center"><?php  echo $myBlkC['catatan']; ?></td>
  </tr>
 <?php  $i++; ?>
      <?php
	}
	  if($myro['sisa']=="SISA" || $myro['sisa']=="FKSI" || $myro['sisa']=="FOC"){$brtoo=0;}else{$brtoo=number_format($row['bruto'],'2','.',',');}
	  $totbruto=$totbruto+$brtoo;
	  $totyard=$totyard+$myro['tot_yard'];
	  $totrol=$totrol+1;
	  $totab=$totab+$gradeAB;
	  $tota=$tota+$gradeC;
	  $totpcs=$totpcs +$row['netto'];
	  $rolab=$rolab + $myro['jml_ab'];
	  $rolac=$rolac + $myro['jml_grd_c'];
	  $totmeter+=$meter;
	  $totyard+=$yard;
	  $totpcs+=$pcs;
	  if($myro['satuan']=='Meter')
	  {$kartot=$kartot + $row['yard_']; $totrolm = $totrolm + 1;}
	  if($myro['satuan']=='Yard')
	  {$pltot=$pltot + $row['yard_'];   $totroly = $totroly + 1;}
	  if($myro['satuan']=='PCS')
	  {$totrolp = $totrolp + 1;}
	  
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
    <td>&nbsp;</td>
    <td><b>Total</b></td>
    <td>&nbsp;</td>
    <td align="right"><b><?php echo $totrol;?></td>
    <td align="right"><b><?php echo number_format($totab,'2','.',',');?></b></td>
    <td align="right"><b><?php echo number_format($tota,'2','.',',');?></b></td>
    <td align="right"><b><?php echo number_format($totab+$tota,'2','.',',');?></b></td>
    <td align="right">&nbsp;</td>
    
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  </table>
</body>
</html>
