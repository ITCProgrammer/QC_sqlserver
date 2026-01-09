<html>
<head>
<title>:: Cetak MUTASI KAIN JADI</title>
<link href="../styles_cetak.css" rel="stylesheet" type="text/css">
</head>
<body>

 
  <table width="100%" border="0" class="table-list">
  <tr>
   <div align="center"> <h2>MUTASI KAIN JADI</h2></div>
   <?php $tgl_cetak1= trim($_GET['thn1']."-".$_GET['bln1']."-".$_GET['tgl1']);
   	$tgl_cetak2= trim($_GET['thn2']."-".$_GET['bln2']."-".$_GET['tgl2']);?>
    <td colspan="21"><b>Tanggal : <?php echo  date("d-M-Y", strtotime($_GET['tgl1']))." s/d ".date("d-M-Y", strtotime($_GET['tgl2'])); ?> <br>GROUP SHIFT: <?php echo $_GET['user_name']; ?> <br> SHIFT : <?php echo $_GET['sift'];?></b></td>
  </tr>
  <tr align="center" bgcolor="#CCCCCC">
    <td width="10" rowspan="2" bgcolor="#F5F5F5">No MC</td>
    <td rowspan="2" bgcolor="#F5F5F5">Tanggal</td>
    <td rowspan="2" bgcolor="#F5F5F5">Langganan</td>
    <td rowspan="2" bgcolor="#F5F5F5">PO</td>
    <td rowspan="2" bgcolor="#F5F5F5">Order</td>
    <td rowspan="2" bgcolor="#F5F5F5">Jenis Kain</td>
    <td rowspan="2" bgcolor="#F5F5F5">No. Warna</td>
    <td rowspan="2" bgcolor="#F5F5F5">Warna</td>
    <td rowspan="2" bgcolor="#F5F5F5">L/Grm2</td>
    <td rowspan="2" bgcolor="#F5F5F5">Lot</td>
    <td rowspan="2" bgcolor="#F5F5F5">Jml.Roll</td>
    <td rowspan="2" bgcolor="#F5F5F5">Bruto(Kg)</td>
    <td colspan="3" bgcolor="#F5F5F5">Netto (KG)</td>
    <td colspan="2" bgcolor="#F5F5F5">SISA</td>
    <td rowspan="2" bgcolor="#F5F5F5">Yard</td>
    <td rowspan="2" bgcolor="#F5F5F5">No.Kartu Kerja</td>
    <td rowspan="2" bgcolor="#F5F5F5">Tempat</td>
    <td rowspan="2" bgcolor="#F5F5F5">Item</td>
  </tr>
  <tr align="center" bgcolor="#0099FF">
    <td bgcolor="#F5F5F5">Grade<br /> A+B</td>
    <td bgcolor="#F5F5F5">Grade <br /> C</td>
    <td bgcolor="#F5F5F5">Keterangan<br />(Grade C)</td>
    <td bgcolor="#F5F5F5">Jml. Roll</td>
    <td bgcolor="#F5F5F5">Qty(KG)</td>
    </tr>
  <?php 
  	mysql_connect("192.168.0.254","root","gogogo");
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
ORDER BY tbl_kite.id ASC");
		 $row1=mysql_fetch_array($sql1);
		 
		 $sql2=mysql_query("SELECT sum(detail_kite.net_wight) as grd_a_b
FROM tbl_kite left join detail_kite on detail_kite.nokkKite=tbl_kite.nokk
WHERE tbl_kite.id='$row[id]' and grade between 'A' and 'B'
GROUP BY tbl_kite.id
ORDER BY tbl_kite.id ASC");
$row2=mysql_fetch_array($sql2);
$sql4=mysql_query("SELECT *, sum(detail_kite.net_wight) as qty,count(detail_kite.sisa) as jml , grade
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
    <tr >
    <td><?php echo $row['no_mc'];?></td>
    <td><?php echo date("d-M-Y", strtotime($row['tanggal_update']));?></td>
    <td><?php echo $row['pelanggan'];?></td>
    <td><?php echo $row['no_po'];?></td>
    <td><?php echo $row['no_order'];?></td>
    <td><?php echo $row['jenis_kain'];?></td>
    <td><?php echo $row['no_warna'];?></td>
    <td><?php echo $row['warna'];?></td>
    <td><?php echo $row['lebar']."/".$row['berat'];?> </td>
    <td><?php echo $row['no_lot'];?></td>
    <td align="right"><?php echo $row['roll']-$row4['jml'];?></td>
    <td align="right"><?php echo number_format($row['bruto'],'2','.',',');?></td>
    <td align="right"><?php if($row4['grade']=="A" || $row4['grade']=="B"){echo number_format($row2['grd_a_b']-$row6['grd_a_b'],'2','.',',');}else{echo number_format($row2['grd_a_b'],'2','.',',');}?></td>
    <td align="right"><?php 
	if($row4['grade']=="C"){echo number_format($row2['grd_a_b']-$row5['grd_c'],'2','.',',');}else{
	echo number_format($row1['grd_c'],'2','.',',');}?></td>
    <td>&nbsp; <?php echo $row1['sisa'];?></td>
    <td align="right"><?php if($row4>0){echo $row4['jml'];}else{echo "0";}?></td>
    <td align="right"><?php if($row4>0){echo number_format($row4['qty'],'2','.',',');}else{echo "0.00";}?></td>
    <td align="right"><?php echo number_format($row['yard_'],'2','.',',')." ".$row['satuan'];?></td>
    <td>
  <?php echo $row['nokk'];?>  
    </td>
    <td>&nbsp;</td>
    <td><?php echo $row['no_item'];?></td>
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
  <?php
 if($_GET['sift']=="1"){
  
   $sql3=mysql_query("SELECT *
FROM tbl_kite
LEFT JOIN detail_kite ON detail_kite.nokkKite = tbl_kite.nokk
WHERE 
DATE_FORMAT( tanggal_update, '%H:%i:%s' )
BETWEEN '07:00:00'
AND '14:59:59'
AND tanggal_update
BETWEEN '$tgl_cetak1'
AND '$tgl_cetak2'
AND tbl_kite.user_packing = '$_GET[user_name]' AND sisa = 'SISA'
ORDER BY tbl_kite.id DESC");
 }else  if($_GET['sift']=="2"){$sql3=mysql_query("SELECT *
FROM tbl_kite
LEFT JOIN detail_kite ON detail_kite.nokkKite = tbl_kite.nokk
WHERE
DATE_FORMAT( tanggal_update, '%H:%i:%s' )
BETWEEN '15:00:00'
AND '22:59:59'
AND tanggal_update
BETWEEN '$tgl_cetak1'
AND '$tgl_cetak2'
AND tbl_kite.user_packing = '$_GET[user_name]' AND sisa = 'SISA'
ORDER BY tbl_kite.id ASC");
 }else{$sql3=mysql_query("SELECT *
FROM tbl_kite
LEFT JOIN detail_kite ON detail_kite.nokkKite = tbl_kite.nokk
WHERE 
DATE_FORMAT( tanggal_update, '%H:%i:%s' )
BETWEEN '23:00:00'
AND '06:59:59'
AND tanggal_update
BETWEEN '$tgl_cetak1'
AND '$tgl_cetak2'
AND tbl_kite.user_packing = '$_GET[user_name]' AND sisa = 'SISA'
ORDER BY tbl_kite.id ASC");}


		 while($row3=mysql_fetch_array($sql3)){
			 
  ?>
  <?php 
  
  } ?> 
  <tr >
    <td bgcolor="#F5F5F5">&nbsp;</td>
    <td bgcolor="#F5F5F5">&nbsp;</td>
    <td bgcolor="#F5F5F5">&nbsp;</td>
    <td bgcolor="#F5F5F5">&nbsp;</td>
    <td bgcolor="#F5F5F5">&nbsp;</td>
    <td bgcolor="#F5F5F5">&nbsp;</td>
    <td bgcolor="#F5F5F5">&nbsp;</td>
    <td bgcolor="#F5F5F5">&nbsp;</td>
    <td bgcolor="#F5F5F5">&nbsp;</td>
    <td bgcolor="#F5F5F5">&nbsp;</td>
    <td bgcolor="#F5F5F5">&nbsp;</td>
    <td bgcolor="#F5F5F5">&nbsp;</td>
    <td bgcolor="#F5F5F5">&nbsp;</td>
    <td bgcolor="#F5F5F5">&nbsp;</td>
    <td bgcolor="#F5F5F5">&nbsp;</td>
    <td bgcolor="#F5F5F5">&nbsp;</td>
    <td bgcolor="#F5F5F5">&nbsp;</td>
    <td bgcolor="#F5F5F5">&nbsp;</td>
    <td bgcolor="#F5F5F5">&nbsp;</td>
    <td bgcolor="#F5F5F5">&nbsp;</td>
    <td bgcolor="#F5F5F5">&nbsp;</td>
  </tr><tr bgcolor="#99FFFF">
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td colspan="2" bgcolor="#FFFFFF">Meter</td>
    <td align="right" bgcolor="#FFFFFF"><?php echo number_format($totkar); ?></td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">Meter</td>
    <td align="right" bgcolor="#FFFFFF">&nbsp;</td>
    <td align="right" bgcolor="#FFFFFF">&nbsp;</td>
    <td align="right" bgcolor="#FFFFFF"><?php echo number_format($kartot,'2','.',','); ?></td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr bgcolor="#99FFFF">
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td colspan="2" bgcolor="#FFFFFF">Yard</td>
    <td align="right" bgcolor="#FFFFFF"><?php echo  number_format($totpl);?></td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">Yard</td>
    <td align="right" bgcolor="#FFFFFF">&nbsp;</td>
    <td align="right" bgcolor="#FFFFFF">&nbsp;</td>
    <td align="right" bgcolor="#FFFFFF"><?php echo  number_format($pltot,'2','.',',');?></td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr bgcolor="#99FFFF">
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td colspan="2" bgcolor="#FFFFFF"><b>Total</b></td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td align="right" bgcolor="#FFFFFF"><b><?php echo $totrol;?></td>
    <td align="right" bgcolor="#FFFFFF"><b><?php echo number_format($totbruto,'2','.',',');?></b></td>
    <td align="right" bgcolor="#FFFFFF"><b><?php echo number_format($totab,'2','.',',');?></b></td>
    <td align="right" bgcolor="#FFFFFF"><b><?php echo number_format($tota,'2','.',',');?></b></td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td align="right" bgcolor="#FFFFFF">&nbsp;</td>
    <td align="right" bgcolor="#FFFFFF">&nbsp;</td>
    <td align="right" bgcolor="#FFFFFF"><b><?php echo number_format($totyard,'2','.',',');?></b></td>
    
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
  </tr>  
  
  <tr>
    <td colspan="21">&nbsp;</td>
  </tr> 
  </table> 
   <table width="100%" border="0" class="table-list1"> 
  <tr align="center">
    <td colspan="3">&nbsp;</td>
    <td colspan="8">Departemen QCF</td>
    <td colspan="10">Departement Gudang Kain Jadi</td>
  </tr>
  <tr align="center">
    <td colspan="3">&nbsp;</td>
    <td colspan="3">Diserahkan Oleh :</td>
    <td colspan="5">Diketahui Oleh :</td>
    <td colspan="6">Diterima oleh :</td>
    <td colspan="4"> Diketahui Oleh :</td>
  </tr>
  <tr>
    <td colspan="3">Nama</td>
    <td colspan="3">&nbsp;</td>
    <td colspan="5">&nbsp;</td>
    <td colspan="6">&nbsp;</td>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">Jabatan</td>
    <td colspan="3">&nbsp;</td>
    <td colspan="5">&nbsp;</td>
    <td colspan="6">&nbsp;</td>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">Tanggal</td>
    <td colspan="3">&nbsp;</td>
    <td colspan="5">&nbsp;</td>
    <td colspan="6">&nbsp;</td>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" height="150" valign="top">Tanda Tangan</td>
    <td colspan="3">&nbsp;</td>
    <td colspan="5">&nbsp;</td>
    <td colspan="6">&nbsp;</td>
    <td colspan="4">&nbsp;</td>
  </tr>
</table>
       <img src="../btn_print.png" height="20" onClick="javascript:window.print()" />                      

</body>
                            
                            
      