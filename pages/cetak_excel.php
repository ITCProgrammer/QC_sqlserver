<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=mutasi_kain".date($_GET['tgl1']).".xls");//ganti nama sesuai keperluan
header("Pragma: no-cache");
header("Expires: 0");
//disini script laporan anda
?>
<table width="100%" border="1">
  <tr>
    <td colspan="20" align="center"><h2><b>BUKTI MUTASI KAIN</b></h2></td>
  </tr>
  <tr>
  
    <td colspan="20"><b>Tanggal : <?php echo $_GET['tgl1']." s/d ".$_GET['tgl2'] ?> <br>GROUP SHIFT: <?php echo $_GET['user_name']; ?> <br> SHIFT : <?php echo $_GET['sift'];?></b></td>
  </tr>
  <tr align="center">
    <td rowspan="2" >No MC</td>
    <td rowspan="2">Langganan</td>
    <td rowspan="2">PO</td>
    <td rowspan="2">Order</td>
    <td rowspan="2">Jenis Kain</td>
    <td rowspan="2">No. Warna</td>
    <td  rowspan="2">Warna</td>
    <td  rowspan="2">L/Grm2</td>
    <td  rowspan="2">Lot</td>
    <td  rowspan="2">Jml.Roll</td>
    <td  rowspan="2">Bruto(Kg)</td>
    <td colspan="3">Netto (Kg)</td>
    <td colspan="2">Sisa</td>
    <td  rowspan="2" >Yard</td>
    <td  rowspan="2" >No.Kartu Kerja</td>
    <td  rowspan="2" >Tempat</td>
    <td  rowspan="2" >Item</td>
  </tr>
  <tr>
    <td >Grade<br /> A+B</td>
    <td >Grade <br /> C</td>
    <td >Keterangan<br />(Grade C)</td>
    <td ><p>Jml.Roll</p></td>
    <td >Qty(KG)</td>
  </tr>
  <?php 
  	mysql_connect("svr1","root","itc0920");
mysql_select_db("db_qc")or die("Gagal Koneksi");

	if($_GET['sift']=="1"){
  $sql=mysql_query("SELECT * , tbl_kite.id, sum( detail_kite.yard_ ) AS yard_, count( detail_kite.yard_ ) AS roll, sum( detail_kite.net_wight ) AS bruto
FROM tbl_kite
INNER JOIN detail_kite ON detail_kite.nokkKite = tbl_kite.nokk
WHERE DATE_FORMAT( tanggal_update, '%H:%i:%s' )
BETWEEN '07:00:00'
AND '14:59:59'
AND tanggal_update
BETWEEN '$_GET[tgl1]'
AND '$_GET[tgl2]'
AND tbl_kite.user_packing = '$_GET[user_name]'
GROUP BY tbl_kite.id
ORDER BY tbl_kite.id ASC");}else if($_GET['sift']=="2"){
	  
	  $sql=mysql_query("SELECT * , tbl_kite.id, sum( detail_kite.yard_ ) AS yard_, count( detail_kite.yard_ ) AS roll, sum( detail_kite.net_wight ) AS bruto
FROM tbl_kite
INNER JOIN detail_kite ON detail_kite.nokkKite = tbl_kite.nokk
WHERE DATE_FORMAT( tanggal_update, '%H:%i:%s' )
BETWEEN '15:00:00'
AND '22:59:59'
AND tanggal_update
BETWEEN '$_GET[tgl1]'
AND '$_GET[tgl2]'
AND tbl_kite.user_packing = '$_GET[user_name]'
GROUP BY tbl_kite.id
ORDER BY tbl_kite.id ASC");
	  
	  }else{
	$sql=mysql_query("SELECT * , tbl_kite.id, sum( detail_kite.yard_ ) AS yard_, count( detail_kite.yard_ ) AS roll, sum( detail_kite.net_wight ) AS bruto
FROM tbl_kite
INNER JOIN detail_kite ON detail_kite.nokkKite = tbl_kite.nokk
WHERE DATE_FORMAT( tanggal_update, '%H:%i:%s' )
BETWEEN '23:00:00'
AND '06:59:59'
AND tanggal_update
BETWEEN '$_GET[tgl1]'
AND '$_GET[tgl2]'
AND tbl_kite.user_packing = '$_GET[user_name]'
GROUP BY tbl_kite.id
ORDER BY tbl_kite.id ASC");	  
		  
		 }
  
  while($row=mysql_fetch_array($sql))
  {
	  	 $sql1=mysql_query("SELECT sum(detail_kite.net_wight) as grd_c
FROM tbl_kite left join detail_kite on detail_kite.nokkKite=tbl_kite.nokk
WHERE tbl_kite.id='$row[id]' and grade='C'
GROUP BY tbl_kite.id
ORDER BY tbl_kite.id DESC");
		 $row1=mysql_fetch_array($sql1);
		 
		 $sql2=mysql_query("SELECT sum(detail_kite.net_wight) as grd_a_b
FROM tbl_kite left join detail_kite on detail_kite.nokkKite=tbl_kite.nokk
WHERE tbl_kite.id='$row[id]' and grade between 'A' and 'B'
GROUP BY tbl_kite.id
ORDER BY tbl_kite.id DESC");
		 $row2=mysql_fetch_array($sql2);
		$sql4=mysql_query("SELECT *, sum(detail_kite.net_wight) as qty,count(detail_kite.sisa) as jml
FROM tbl_kite
LEFT JOIN detail_kite ON detail_kite.nokkKite = tbl_kite.nokk
WHERE sisa = 'SISA'
AND nokkKite = '$row[nokk]'
GROUP BY tbl_kite.id
ORDER BY tbl_kite.id ASC");
		 $row4=mysql_fetch_array($sql4); 
	 $sql5=mysql_query("SELECT sum(detail_kite.net_wight) as grd_c
FROM tbl_kite left join detail_kite on detail_kite.nokkKite=tbl_kite.nokk
WHERE tbl_kite.id='$row[id]' and grade='C' and
sisa = 'SISA'
AND nokkKite = '$row[nokk]'
GROUP BY tbl_kite.id
ORDER BY tbl_kite.id ASC");
		 $row5=mysql_fetch_array($sql5);
		 
		 $sql6=mysql_query("SELECT sum(detail_kite.net_wight) as grd_a_b
FROM tbl_kite left join detail_kite on detail_kite.nokkKite=tbl_kite.nokk
WHERE tbl_kite.id='$row[id]' and grade between 'A' and 'B' and sisa = 'SISA'
AND nokkKite = '$row[nokk]'
GROUP BY tbl_kite.id
ORDER BY tbl_kite.id ASC");
$row6=mysql_fetch_array($sql6);	
	  ?>
     <tr>
    <td><?php echo $row['no_mc'];?></td>
    <td><?php echo $row['pelanggan'];?></td>
    <td><?php echo $row['no_po'];?></td>
    <td><?php echo $row['no_order'];?></td>
    <td><?php echo $row['jenis_kain'];?></td>
    <td><?php echo $row['no_warna'];?></td>
    <td><?php echo $row['warna'];?></td>
    <td>'<?php echo $row['lebar']."/".$row['berat'];?> </td>
    <td>'<?php echo $row['no_lot'];?></td>
    <td align="right"><?php echo $row['roll'];?></td>
    <td align="right"><?php echo number_format($row['bruto'],'2','.',',');?></td>
    <td align="right"><?php if($row4['grade']=="A" || $row4['grade']=="B"){echo number_format($row2['grd_a_b']-$row6['grd_a_b'],'2','.',',');}else{echo number_format($row2['grd_a_b'],'2','.',',');}?></td>
    <td align="right"><?php 
	if($row4['grade']=="C"){echo number_format($row2['grd_a_b']-$row5['grd_c'],'2','.',',');}else{
	echo number_format($row1['grd_c'],'2','.',',');}?></td>
    <td><?php echo $row['a'];?></td>
    <td align="right"><?php if($row4>0){echo $row4['jml'];}else{echo "0";}?></td>
    <td align="right"><?php if($row4>0){echo number_format($row4['qty'],'2','.',',');}else{echo "0.00";}?></td>
    <td align="right"><?php echo number_format($row['yard_'],'2','.',',');?></td>
    <td>'<?php echo $row['nokk'];?></td>
    <td><?php echo $row['tempat'];?></td>
    <td><?php echo $row['jenis_kain'];?></td>
  </tr>
      <?php
	  $totbruto=$totbruto+$row['bruto'];
	  $totyard=$totyard+$row['yard_'];
	  $totrol=$totrol+$row['roll'];
	  $totab=$totab+$row2['grd_a_b'];
	  $tota=$tota+$row1['grd_c'];
	  if($row['satuan']=='Meter')
		{$kartot=$kartot + $row['yard_']; $totkar = $totkar + $row['roll'];}
		if($row['satuan']=='Yard')
		{$pltot=$pltot + $row['yard_'];   $totpl = $totpl + $row['roll'];}
	  }
  
  
  ?>
  
  
  <tr >
    <td colspan="20">&nbsp;</td>
  </tr><tr >
    <td colspan="7">&nbsp;</td>
    <td colspan="2">Meter</td>
    <td align="right"><?php echo number_format($totkar); ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Meter</td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right"><?php echo number_format($kartot,'2','.',','); ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="7">&nbsp;</td>
    <td colspan="2">Yard</td>
    <td align="right"><?php echo  number_format($totpl);?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Yard</td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right"><?php echo  number_format($pltot,'2','.',',');?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="6">&nbsp;</td>
    <td colspan="3"><b>Total</b></td>
    <td align="right"><b><?php echo $totrol;?></td>
    <td align="right"><b><?php echo number_format($totbruto,'2','.',',');?></b></td>
    <td align="right"><b><?php echo number_format($totab,'2','.',',');?></b></td>
    <td align="right"><b><?php echo number_format($tota,'2','.',',');?></b></td>
    <td>&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right"><b><?php echo number_format($totyard,'2','.',',');?></b></td>
    
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="20">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="20">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="20">&nbsp;</td>
  </tr>
  <tr align="center">
    <td colspan="3">&nbsp;</td>
    <td colspan="8">Departemen QCF</td>
    <td colspan="9">Departement Gudang Kain Jadi</td>
  </tr>
  <tr align="center">
    <td colspan="3">&nbsp;</td>
    <td colspan="3">Diserahkan Oleh :</td>
    <td colspan="5">Diketahui Oleh :</td>
    <td colspan="6">Diterima oleh :</td>
    <td colspan="3"> Diketahui Oleh :</td>
  </tr>
  <tr>
    <td colspan="3">Nama</td>
    <td colspan="3">&nbsp;</td>
    <td colspan="5">&nbsp;</td>
    <td colspan="6">&nbsp;</td>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">Jabatan</td>
    <td colspan="3">&nbsp;</td>
    <td colspan="5">&nbsp;</td>
    <td colspan="6">&nbsp;</td>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">Tangal</td>
    <td colspan="3">&nbsp;</td>
    <td colspan="5">&nbsp;</td>
    <td colspan="6">&nbsp;</td>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">Tanda Tangan</td>
    <td colspan="3">&nbsp;</td>
    <td colspan="5">&nbsp;</td>
    <td colspan="6">&nbsp;</td>
    <td colspan="3">&nbsp;</td>
  </tr>
</table>  
