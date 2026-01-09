<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=kain_jadi.xls");//ganti nama sesuai keperluan
header("Pragma: no-cache");
header("Expires: 0");
//disini script laporan anda
?>
<?php
include("../koneksi.php");
ini_set("error_reporting",1);
?>
<body>                  
                        
<table width="100%" border="1">
  <tr>
    <td colspan="22" align="center"><b>LAPORAN HARIAN KAIN JADI</b></td>
    </tr>
  <tr>
 <td colspan="22"><b>No Mutasi : <?php echo  $_GET['mutasi'];?></b></td>
 </tr>
  <tr align="center" >
    <td rowspan="2">NO ITEM</td>
    <td rowspan="2">KD</td>
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
    
    <td rowspan="2">UNIT</td>
    <td rowspan="2">EXTRA Q</td>
    <td rowspan="2">LBR</td>
    <td rowspan="2">X</td>
    <td rowspan="2">GRMS</td>
    <td rowspan="2">OL</td>
  </tr>
  <tr align="center">
    <td>Grade<br /> A+B</td>
    <td>Grade <br /> C</td>
    <td>Keterangan<br />(Grade C)</td>
    </tr>
  <?php 
  $sql=mysqli_query($con,"select pergerakan_stok.id,bruto,satuan,
no_mc,pelanggan,pergerakan_stok.no_po,pergerakan_stok.no_order,tgl_update,
jenis_kain,no_warna,warna,no_item,no_lot,
lebar,berat,detail_pergerakan_stok.nokk,grade,
detail_pergerakan_stok.ket,count(yard_) as tot_rol,sum(yard_) as tot_yard ,
sum(weight) as tot_qty,sisa
from pergerakan_stok 
inner join detail_pergerakan_stok on pergerakan_stok.id=detail_pergerakan_stok.id_stok 
inner join tbl_kite on tbl_kite.nokk=detail_pergerakan_stok.nokk
WHERE pergerakan_stok.no_mutasi='".$_GET['mutasi']."'
AND fromtoid='GUDANG KAIN JADI'
GROUP BY  pergerakan_stok.id, no_dok,sisa
ORDER BY pergerakan_stok.id ASC");
  
  while($row=mysqli_fetch_array($sql))
  {
	  	 $sql1=mysqli_query($con,"SELECT sum(detail_pergerakan_stok.weight) as grd_c
FROM pergerakan_stok left join detail_pergerakan_stok on detail_pergerakan_stok.id_stok=pergerakan_stok.id
WHERE pergerakan_stok.id='".$row['id']."' and grade='C' and sisa='".$row['sisa']."'
GROUP BY pergerakan_stok.id
ORDER BY pergerakan_stok.id ASC");
		 $row1=mysqli_fetch_array($sql1);
		 
		 $sql2=mysqli_query($con,"SELECT sum(detail_pergerakan_stok.weight) as grd_a_b
FROM pergerakan_stok inner join detail_pergerakan_stok on detail_pergerakan_stok.id_stok=pergerakan_stok.id
WHERE pergerakan_stok.id='".$row['id']."' and ((grade between 'A' and 'B') or grade='') and sisa='".$row['sisa']."'
GROUP BY pergerakan_stok.id
ORDER BY pergerakan_stok.id ASC");
$row2=mysqli_fetch_array($sql2);
$sql3=mysqli_query($con,"SELECT sum(detail_pergerakan_stok.weight) as sisa_c
FROM pergerakan_stok inner join detail_pergerakan_stok on detail_pergerakan_stok.id_stok=pergerakan_stok.id
WHERE pergerakan_stok.id='".$row['id']."' and grade='C' and (detail_pergerakan_stok.sisa='SISA' or detail_pergerakan_stok.sisa='FKSI') 
ORDER BY pergerakan_stok.id ASC");
	$row3=mysqli_fetch_array($sql3);
	$sql4=mysqli_query($con,"SELECT sum(detail_pergerakan_stok.weight) as sisa_ab
FROM pergerakan_stok inner join detail_pergerakan_stok on detail_pergerakan_stok.id_stok=pergerakan_stok.id
WHERE pergerakan_stok.id='".$row['id']."' and ((grade between 'A' and 'B') or grade='') and (detail_pergerakan_stok.sisa='SISA' or detail_pergerakan_stok.sisa='FKSI') 
ORDER BY pergerakan_stok.id ASC");
	$row4=mysqli_fetch_array($sql4);	
	
	$sql5=mysqli_query($con,"SELECT sum(detail_pergerakan_stok.weight) as sisa_c
FROM pergerakan_stok inner join detail_pergerakan_stok on detail_pergerakan_stok.id_stok=pergerakan_stok.id
WHERE pergerakan_stok.id='".$row['id']."' and grade='C' and (detail_pergerakan_stok.sisa='FOC' ) 
ORDER BY pergerakan_stok.id ASC");
	$row5=mysqli_fetch_array($sql5);
	$sql6=mysqli_query($con,"SELECT sum(detail_pergerakan_stok.weight) as sisa_ab
FROM pergerakan_stok inner join detail_pergerakan_stok on detail_pergerakan_stok.id_stok=pergerakan_stok.id
WHERE pergerakan_stok.id='".$row['id']."' and ((grade between 'A' and 'B') or grade='') and (detail_pergerakan_stok.sisa='FOC') 
ORDER BY pergerakan_stok.id ASC");
	$row6=mysqli_fetch_array($sql6);
	$stmpt=mysqli_query($con,"select mutasi_kain.id as id_kain,mutasi_kain.tempat  
from mutasi_kain 
INNER JOIN pergerakan_stok on pergerakan_stok.id=mutasi_kain.id_stok
where pergerakan_stok.id='".$row['id']."' and mutasi_kain.keterangan='".$row['sisa']."'
GROUP BY mutasi_kain.id,mutasi_kain.keterangan
ORDER BY pergerakan_stok.id ASC");
$rtmpt=mysqli_fetch_array($stmpt);

	  ?>
    <tr>
    <td><?php echo $row['no_item'];?></td>
    <td>&nbsp;</td>
    <td><?php echo $row['pelanggan'];?></td>
    <td><?php echo $row['no_po'];?></td>
    <td><?php echo $row['no_order'];?></td>
    <td><?php echo htmlentities($row['jenis_kain'],ENT_QUOTES);?></td>
    <td><?php echo $row['no_warna'];?></td>
    <td><?php echo $row['warna'];?></td>
    <td>' <?php echo $row['nokk'];?></td>
    <td>'  <?php echo $row['no_lot'];?></td>
    <td align="right"><?php 
	$rol=$row['tot_rol'];
	echo $rol;
	?></td>
    <td align="right"><?php 
	if($row['sisa']=="SISA"||$row['sisa']=="FKSI")
	{$grab=number_format($row4['sisa_ab'],'2','.',',');}
	else if($row['sisa']=="FOC"){$grab=number_format($row6['sisa_ab'],'2','.',',');}
	else{$grab=number_format($row2['grd_a_b'],'2','.',',');}
	echo number_format($grab,'2','.',',');?></td>
    <td align="right"><?php 
	if($row['sisa']=="SISA"||$row['sisa']=="FKSI"){$grc=number_format($row3['sisa_c'],'2','.',',');}
	else if($row['sisa']=="FOC"){$grc=number_format($row5['sisa_c'],'2','.',',');}
	else{$grc=number_format($row1['grd_c'],'2','.',',');}
	echo number_format($grc,'2','.',',');?></td>
    <td><?php if($row['sisa']=="SISA" || $row['sisa']=="FKSI"){echo "SISA";}?></td>
    <td><?php echo $rtmpt['tempat']; ?></td>
    <td><?php if($row['sisa']=="FOC"){echo "EXTRA FULL";}?></td>
    <td><?php echo $row['lebar'];?></td>
    <td>X</td>
    <td><?PHP echo $row['berat']; ?></td>
    <td>&nbsp;</td>
  </tr>
 
      <?php
	  if($row['sisa']=="SISA" || $row['sisa']=="FKSI" || $row['sisa']=="FOC"){$brtoo=0;}else{$brtoo=number_format($row['bruto'],'2','.',',');}
	   $totbruto=$totbruto+$brtoo;
	  $totyard=$totyard+$row['tot_yard'];
	  $totrol=$totrol+$rol;
	  $totab=$totab+$grab;
	  $tota=$tota+$grc;
	  	if($row['satuan']=='Meter')
		{$kartot=$kartot + $row['tot_yard']; $totrolm = $totrolm + $row['tot_rol'];}
		if($row['satuan']=='Yard')
		{$pltot=$pltot + $row['tot_yard'];   $totroly = $totroly + $row['tot_rol'];}
	  
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
    <td>Yard</td>
    <td align="right"><?php echo  number_format($totroly);?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Yard</td>
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
    <td>&nbsp;</td>
    <td><b>Total</b></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="right"><b><?php echo $totrol;?></td>
    <td align="right"><b><?php echo number_format($totab,'2','.',',');?></b></td>
    <td align="right"><b><?php echo number_format($tota,'2','.',',');?></b></td>
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
  <tr >
    <td colspan="4" align="center">&nbsp;</td>
    <td colspan="9" align="center">Dibuat Oleh</td>
    <td colspan="9" align="center">Diperiksa oleh</td>
  </tr>
  <tr >
    <td colspan="4" >Nama</td>
    <td colspan="9" align="center">&nbsp;</td>
    <td colspan="9" align="center">&nbsp;</td>
  </tr>
  <tr >
    <td colspan="4" >Jabatan</td>
    <td colspan="9" align="center">Clerk</td>
    <td colspan="9" align="center">Supervisor</td>
  </tr>
  <tr >
    <td height="26" colspan="4" >Tanggal</td>
    <td colspan="9" align="center">&nbsp;</td>
    <td colspan="9" align="center">&nbsp;</td>
  </tr>
  <tr >
    <td colspan="4" ><p>Tanda Tangan</p>
    <p>&nbsp;</p></td>
    <td colspan="9" align="center">&nbsp;</td>
    <td colspan="9" align="center">&nbsp;</td>
  </tr>
  
</table>
</body>
</html>