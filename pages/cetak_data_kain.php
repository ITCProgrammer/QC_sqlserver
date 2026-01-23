<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=kain_jadi_ol.xls");//ganti nama sesuai keperluan
header("Pragma: no-cache");
header("Expires: 0");
//disini script laporan anda
?>
<body>                  
                        
<table width="100%" border="1">
  <tr>
    <td colspan="23" align="center"><b>LAPORAN HARIAN KAIN JADI</b></td>
    </tr>
  <tr>
 <td colspan="23"><b>Tanggal : <?php echo  date("d-M-Y", strtotime($_GET['tgl1']))." s/d ".date("d-M-Y", strtotime($_GET['tgl2'])); ?> 
    </b></td>
    </tr>
  <tr align="center" >
    <td rowspan="2">NO ITEM</td>
    <td rowspan="2">LANGGANAN</td>
    <td rowspan="2">PO</td>
    <td rowspan="2">ORDER</td>
    <td rowspan="2">JENIS KAIN</td>
    <td rowspan="2" >NO WARNA</td>
    <td rowspan="2">WARNA</td>
    <td rowspan="2">NO CARD</td>
    <td rowspan="2">LOT</td>
    <td rowspan="2">ROLL</td>
    <td colspan="3">Netto (KG)</td>
    <td colspan="2">SISA</td>
    <td rowspan="2">Yard / Meter</td>
    <td rowspan="2">UNIT</td>
    <td rowspan="2">EXTRA Q</td>
    <td rowspan="2">LBR</td>
    <td rowspan="2">X</td>
    <td rowspan="2">GRMS</td>
    <td rowspan="2">OL</td>
    <td rowspan="2">Keterangan</td>
  </tr>
  <tr align="center">
    <td>Grade<br /> A+B</td>
    <td>Grade <br /> C</td>
    <td>Keterangan<br />(Grade C)</td>
    <td>Jml. Roll</td>
    <td>Qty(KG)</td>
    </tr>
  <?php 
ini_set("error_reporting",1);
include('koneksi.php');

  $sql=sqlsrv_query($con,"SELECT * , tbl_kite.id, sum( detail_kite.yard_ ) AS yard_, count( detail_kite.yard_ ) AS roll, sum( detail_kite.net_wight ) AS bruto1
FROM tbl_kite
INNER JOIN detail_kite ON detail_kite.nokkKite = tbl_kite.nokk
WHERE tanggal_update
BETWEEN '$_GET[tgl1] 07:00:00'
AND '$_GET[tgl2] 07:00:00'
GROUP BY tbl_kite.id
ORDER BY tbl_kite.id ASC");
  
  while($row=sqlsrv_fetch_array($sql))
  {
	  	 $sql1=sqlsrv_query($con,"SELECT sum(detail_kite.net_wight) as grd_c
FROM tbl_kite left join detail_kite on detail_kite.nokkKite=tbl_kite.nokk
WHERE tbl_kite.id='$row[id]' and grade='C'
GROUP BY tbl_kite.id
ORDER BY tbl_kite.id ASC");
		 $row1=sqlsrv_fetch_array($sql1);
		 
		 $sql2=sqlsrv_query($con,"SELECT sum(detail_kite.net_wight) as grd_a_b
FROM tbl_kite left join detail_kite on detail_kite.nokkKite=tbl_kite.nokk
WHERE tbl_kite.id='$row[id]' and grade between 'A' and 'B'
GROUP BY tbl_kite.id
ORDER BY tbl_kite.id ASC");
$row2=sqlsrv_fetch_array($sql2);
$sql4=sqlsrv_query($con,"SELECT *, sum(detail_kite.net_wight) as qty,count(detail_kite.sisa) as jml , grade
FROM tbl_kite
LEFT JOIN detail_kite ON detail_kite.nokkKite = tbl_kite.nokk
WHERE sisa = 'SISA'
AND nokkKite = '$row[nokk]'
GROUP BY tbl_kite.id
ORDER BY tbl_kite.id ASC");
		 $row4=sqlsrv_fetch_array($sql4);
		 $sql5=sqlsrv_query($con,"SELECT sum(detail_kite.net_wight) as grd_c
FROM tbl_kite left join detail_kite on detail_kite.nokkKite=tbl_kite.nokk
WHERE tbl_kite.id='$row[id]' and grade='C' and
sisa = 'SISA'
AND nokkKite = '$row[nokk]'
GROUP BY tbl_kite.id
ORDER BY tbl_kite.id ASC");
		 $row5=sqlsrv_fetch_array($sql5);
		 
		 $sql6=sqlsrv_query($con,"SELECT sum(detail_kite.net_wight) as grd_a_b
FROM tbl_kite left join detail_kite on detail_kite.nokkKite=tbl_kite.nokk
WHERE tbl_kite.id='$row[id]' and grade between 'A' and 'B' and sisa = 'SISA'
AND nokkKite = '$row[nokk]'
GROUP BY tbl_kite.id
ORDER BY tbl_kite.id ASC");
$row6=sqlsrv_fetch_array($sql6);		
$sql7=sqlsrv_query($con,"SELECT *, sum(detail_kite.net_wight) as qty,count(detail_kite.sisa) as jml , grade
FROM tbl_kite
LEFT JOIN detail_kite ON detail_kite.nokkKite = tbl_kite.nokk
WHERE sisa = 'FOC'
AND nokkKite = '$row[nokk]'
GROUP BY tbl_kite.id
ORDER BY tbl_kite.id ASC");
 $row7=sqlsrv_fetch_array($sql7);

	  ?>
    <tr>
    <td><?php echo $row['no_item'];?></td>
    <td><?php echo $row['pelanggan'];?></td>
    <td><?php echo $row['no_po'];?></td>
    <td><?php echo $row['no_order'];?></td>
    <td><?php echo htmlentities($row['jenis_kain'],ENT_QUOTES);?></td>
    <td><?php echo $row['no_warna'];?></td>
    <td><?php echo $row['warna'];?></td>
    <td><?php echo $row['nokk'];?></td>
    <td>'  <?php echo $row['no_lot'];?></td>
    <td align="right"><?php echo $row['roll']-$row4['jml'];?></td>
    <td align="right"><?php if($row4['grade']=="A" || $row4['grade']=="B"){echo number_format($row2['grd_a_b']-$row6['grd_a_b'],'2','.',',');}else{echo number_format($row2['grd_a_b'],'2','.',',');}?></td>
    <td align="right"><?php 
	if($row4['grade']=="C"){echo number_format($row2['grd_a_b']-$row5['grd_c'],'2','.',',');}else{
	echo number_format($row1['grd_c'],'2','.',',');}?></td>
    <td><?php echo $row1['sisa'];?></td>
    <td align="right"><?php if($row4>0){echo $row4['jml'];}else{echo "0";}?></td>
    <td align="right"><?php if($row4>0){echo number_format($row4['qty'],'2','.',',');}else{echo "0.00";}?></td>
    <td align="right"><?php echo number_format($row['yard_'],'2','.',',')." ".$row['satuan'];?></td>
    <td><?php echo $row['tempat']; ?></td>
    <td><?php echo number_format($row7['qty'],'2','.',',');?></td>
    <td><?php echo $row['lebar'];?></td>
    <td>X</td>
    <td><?PHP echo $row['berat']; ?></td>
    <td>&nbsp;</td>
    <td align="center">&nbsp;</td>
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
  
   $sql3=sqlsrv_query($con,"SELECT *
FROM tbl_kite
LEFT JOIN detail_kite ON detail_kite.nokkKite = tbl_kite.nokk
WHERE 
tanggal_update
BETWEEN '$_GET[tgl1] 07:00:00'
AND '$_GET[tgl2] 07:00:00'
AND tbl_kite.user_packing = '$_POST[user_name]' AND sisa = 'SISA'
ORDER BY tbl_kite.id DESC");
		 while($row3=sqlsrv_fetch_array($sql3)){
			 
  ?>
 <?php
		 }
 ?>
  <tr >
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
    <td>Meter</td>
    <td align="right"><?php echo number_format($totkar); ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">Meter</td>
    <td align="right"><?php echo number_format($kartot,'2','.',','); ?></td>
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
    <td>Yard</td>
    <td align="right"><?php echo  number_format($totpl);?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">Yard</td>
    <td align="right"><?php echo  number_format($pltot,'2','.',',');?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr >
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
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr >
    <td colspan="23">&nbsp;</td>
  </tr>
  <tr >
    <td colspan="3" align="center">&nbsp;</td>
    <td colspan="4" align="center">Dibuat Oleh</td>
    <td colspan="6" align="center">Diperiksa oleh</td>
    <td colspan="10" align="center"> Diketahui oleh </td>
  </tr>
  <tr >
    <td colspan="3" >Nama </td>
    <td colspan="4" align="center">&nbsp;</td>
    <td colspan="6" align="center">&nbsp;</td>
    <td colspan="10" align="center">&nbsp;</td>
  </tr>
  <tr >
    <td colspan="3" >Jabatan</td>
    <td colspan="4" align="center">Clerk</td>
    <td colspan="6" align="center"> Supervisor </td>
    <td colspan="10" align="center"> Asst. Manager </td>
  </tr>
  <tr >
    <td colspan="3" >Tanggal</td>
    <td colspan="4" align="center">&nbsp;</td>
    <td colspan="6" align="center">&nbsp;</td>
    <td colspan="10" align="center">&nbsp;</td>
  </tr>
  <tr >
    <td colspan="3" ><p>Tanda Tangan</p>
    <p>&nbsp;</p></td>
    <td colspan="4" align="center">&nbsp;</td>
    <td colspan="6" align="center">&nbsp;</td>
    <td colspan="10" align="center">&nbsp;</td>
  </tr>
  
</table>
</body>
</html>