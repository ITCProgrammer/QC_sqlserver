<?php 
ini_set("error_reporting",1); 
include("../koneksi.php")
?>
<html>
<head>
 <link rel="stylesheet" href="../style.css" type="text/css" media="screen" />
    <link href="/..pages/styles_cetak.css" rel="stylesheet" type="text/css">
<title>::Hapus Mutasi Kain</title>
<script type="text/javascript" src="../script.js"></script>
<script type="text/javascript"> </script>
</head>
<body bgcolor="">
<div id="art-main">
      <input type="button" class="art-button" onClick="window.location.href='../index_login.php?act=logout'" value="Logout"/>
                            <?php if($_SESSION['status']==0){ ?><input type="button" class="art-button" onClick="window.location.href='../index1.php'" value="Home"/><input type="button" class="art-button" onClick="window.location.href='../index1.php?p=laporan_harian'" value="Laporan"/><br /><?php } ?>
 
  <table width="100%" border="0">
  <tr>
   <?php 
if($_GET['no_mutasi']!=""){
	$nomutasi=$_GET['no_mutasi'];
}else{
	$nomutasi=$_POST['no_mutasi'];
}	  
$lth=mysqli_query($con,"select pergerakan_stok.tgl_update as tanggal_update ,pergerakan_stok.userid as user_packing ,mutasi_kain.no_mutasi 
from mutasi_kain
inner JOIN pergerakan_stok on pergerakan_stok.id=mutasi_kain.id_stok
where mutasi_kain.no_mutasi='".$nomutasi."'
GROUP BY no_mutasi");
	$rowlth=mysqli_fetch_array($lth);	
	?>
   <div align="center"> <h2>MUTASI KAIN JADI</h2></div>
   <?php ?>
    <td colspan="21">
    <table width="100%"  class="table-list1" border="0">
  <tr>
    <td bgcolor="#33CC33" ><b>Tanggal : <?php echo date("d F Y",strtotime($rowlth['tanggal_update']));?>  <br>GROUP SHIFT: <?php
 echo $rowlth['user_packing']; ?> <br> SHIFT : <?php 
  if(date("H:i:s",strtotime($rowlth['tanggal_update']))>="23:00:00" && date("H:i:s",strtotime($rowlth['tanggal_update']))<="06:59:59")
  {$rsift=3;}
  else if(date("H:i:s",strtotime($rowlth['tanggal_update']))>="07:00:00" && date("H:i:s",strtotime($rowlth['tanggal_update']))<="14:59:59"){$rsift=1;}
  else if(date("H:i:s",strtotime($rowlth['tanggal_update']))>="15:00:00" && date("H:i:s",strtotime($rowlth['tanggal_update']))<="22:59:59")
  {$rsift=2;}
 echo 
 $rsift;?> <br> No Mutasi : <?php echo $rowlth['no_mutasi'];?></b></td>
    </tr>
</table>
    
    
</td>
  </tr>
  <tr align="center" bgcolor="#CCCCCC">
    <td rowspan="2" bgcolor="#0033FF">Langganan</td>
    <td rowspan="2" bgcolor="#0033FF">PO</td>
    <td rowspan="2" bgcolor="#0033FF">Order</td>
    <td rowspan="2" bgcolor="#0033FF">Warna</td>
    <td rowspan="2" bgcolor="#0033FF">L/Grm2</td>
    <td rowspan="2" bgcolor="#0033FF">Lot</td>
    <td rowspan="2" bgcolor="#0033FF">Jml. Roll</td>
    <td rowspan="2" bgcolor="#0033FF">Bruto (Kg)</td>
    <td colspan="3" bgcolor="#0033FF">Netto (KG)</td>
    <td rowspan="2" bgcolor="#0033FF">Yard</td>
    <td rowspan="2" bgcolor="#0033FF">No.Kartu Kerja</td>
    <td rowspan="2" bgcolor="#0033FF">AKSI</td>
  </tr>
  <tr align="center" bgcolor="#0099FF">
    <td bgcolor="#0033FF">Grade<br /> A+B</td>
    <td bgcolor="#0033FF">Grade <br /> C</td>
    <td bgcolor="#0033FF">Keterangan<br />(Grade C)</td>
    </tr>
 <?php
 $sql=mysqli_query($con,"select pergerakan_stok.id,bruto,satuan,pergerakan_stok.no_mutasi,
no_mc,pelanggan,pergerakan_stok.no_po,pergerakan_stok.no_order,tgl_update,
jenis_kain,no_warna,warna,no_item,no_lot,tbl_kite.user_packing,
lebar,berat,detail_pergerakan_stok.nokk,grade,
detail_pergerakan_stok.ket,count(yard_) as tot_rol,sum(yard_) as tot_yard ,
sum(weight) as tot_qty,sisa
from pergerakan_stok 
inner join detail_pergerakan_stok on pergerakan_stok.id=detail_pergerakan_stok.id_stok 
inner join tbl_kite on tbl_kite.nokk=detail_pergerakan_stok.nokk
where pergerakan_stok.no_mutasi='".$nomutasi."'
GROUP BY  pergerakan_stok.id, no_dok,sisa
ORDER BY pergerakan_stok.id ASC");
$totqty=0;
$totqty1=0;
$c=1;
  while($row=mysqli_fetch_array($sql))
  {	  
  $bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99';		
 $sql1=mysqli_query($con,"SELECT sum(detail_pergerakan_stok.weight) as grd_c
FROM pergerakan_stok left join detail_pergerakan_stok on detail_pergerakan_stok.id_stok=pergerakan_stok.id
WHERE pergerakan_stok.id='".$row['id']."' and grade='C'
GROUP BY pergerakan_stok.id
ORDER BY pergerakan_stok.id ASC");
		 $row1=mysqli_fetch_array($sql1);
		 
		 $sql2=mysqli_query($con,"SELECT sum(detail_pergerakan_stok.weight) as grd_a_b
FROM pergerakan_stok inner join detail_pergerakan_stok on detail_pergerakan_stok.id_stok=pergerakan_stok.id
WHERE pergerakan_stok.id='".$row['id']."' and ((grade between 'A' and 'B') or grade='')
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
	$sql7=mysqli_query($con,"select id from mutasi_kain where id_stok='".$row['id']."' and keterangan='".$row['sisa']."'
");
	$row7=mysqli_fetch_array($sql7);
		  ?>
    <tr bgcolor="<?php echo $bgcolor;?>">
    <td><?php echo $row['pelanggan'];?></td>
    <td><?php echo substr($row['no_po'],0,13)." ".substr($row['no_po'],13,13)." ".substr($row['no_po'],26,13);?></td>
    <td><?php echo substr($row['no_order'],0,6)." ".substr($row['no_order'],6,10);?></td>
    <td><?php echo substr($row['warna'],0,7)." ".substr($row['warna'],7,20);?></td>
    <td><?php echo $row['lebar']."/".$row['berat'];?> </td>
    <td><?php echo $row['no_lot'];?></td>
    <td align="right"><?php $rol=$row['tot_rol'];
	echo $rol;
	?></td>
    <td align="right"><?php echo number_format($row['bruto'],'2','.',',');?></td>
    <td align="right"><?php 
	if($row['sisa']=="SISA"||$row['sisa']=="FKSI")
	{$grab=number_format($row4['sisa_ab'],'2','.',',');}
	else if($row['sisa']=="FOC"){$grab=number_format($row6['sisa_ab'],'2','.',',');}
	else{$grab=number_format($row2['grd_a_b']-$row4['sisa_ab'],'2','.',',');}
	echo $grab;?></td>
    <td align="right"><?php 
	if($row['sisa']=="SISA"||$row['sisa']=="FKSI"){$grc=number_format($row3['sisa_c'],'2','.',',');}
	else if($row['sisa']=="FOC"){$grc=number_format($row5['sisa_c'],'2','.',',');}
	else{$grc=number_format($row1['grd_c']-$row3['sisa_c'],'2','.',',');}
	echo $grc;?></td>
    <td><?php if($row['sisa']=="SISA" || $row['sisa']=="FKSI"){echo "SISA";}else if($row['sisa']=="FOC"){echo "EXTRA FULL";}?> &nbsp;</td>
    <td align="right"><?php echo number_format($row['tot_yard'],'2','.',',')." ".$row['satuan']; ?></td>
    <td>
      <?php echo substr($row['nokk'],0,7)." ".substr($row['nokk'],7,20);?>  
    </td>
    <td><a href="hapus_mutasi.php?id_stok=<?php echo $row['id'];?>&id_kain=<?php echo $row7['id'];?>&nomutasi=<?php echo $rowlth['no_mutasi']; ?>" onClick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA INI ... ?')">Hapus</a></td>
  </tr>
 
      <?php
	  if($row['sisa']=="SISA" || $row['sisa']=="FKSI" || $row['sisa']=="FOC"){$brtoo=0;$grdab=0;$grdc=0;}else{$brtoo=number_format($row['bruto'],'2','.',',');$grdab=$grab;$grdc=$grc;}
	   $totbruto=$totbruto+$brtoo;
	  $totyard=$totyard+$row['tot_yard'];
	  $totrol=$totrol+$rol;
	  $totqty=$totqty+$grdab;
	  $totqty1=$totqty1+$grdc;
	  	if($row['satuan']=='Meter')
		{$kartot=$kartot + $row['tot_yard']; $totrolm = $totrolm + $row['tot_rol'];}
		if($row['satuan']=='Yard')
		{$pltot=$pltot + $row['tot_yard'];   $totroly = $totroly + $row['tot_rol'];}
	  
	  }
  ?>
 
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
  </tr><tr bgcolor="#99FFFF">
    <td bgcolor="#33CC33">&nbsp;</td>
    <td bgcolor="#33CC33">&nbsp;</td>
    <td bgcolor="#33CC33">&nbsp;</td>
    <td bgcolor="#33CC33">&nbsp;</td>
    <td colspan="2" bgcolor="#33CC33">Meter</td>
    <td align="right" bgcolor="#33CC33"><?php echo number_format($totrolm); ?></td>
    <td bgcolor="#33CC33">&nbsp;</td>
    <td bgcolor="#33CC33">&nbsp;</td>
    <td bgcolor="#33CC33">&nbsp;</td>
    <td bgcolor="#33CC33">Meter</td>
    <td align="right" bgcolor="#33CC33"><?php echo number_format($kartot,'2','.',','); ?></td>
    <td bgcolor="#33CC33">&nbsp;</td>
    <td bgcolor="#33CC33">&nbsp;</td>
  </tr>
  <tr bgcolor="#99FFFF">
    <td bgcolor="#33CC33">&nbsp;</td>
    <td bgcolor="#33CC33">&nbsp;</td>
    <td bgcolor="#33CC33">&nbsp;</td>
    <td bgcolor="#33CC33">&nbsp;</td>
    <td colspan="2" bgcolor="#33CC33">Yard</td>
    <td align="right" bgcolor="#33CC33"><?php echo  number_format($totroly);?></td>
    <td bgcolor="#33CC33">&nbsp;</td>
    <td bgcolor="#33CC33">&nbsp;</td>
    <td bgcolor="#33CC33">&nbsp;</td>
    <td bgcolor="#33CC33">Yard</td>
    <td align="right" bgcolor="#33CC33"><?php echo  number_format($pltot,'2','.',',');?></td>
    <td bgcolor="#33CC33">&nbsp;</td>
    <td bgcolor="#33CC33">&nbsp;</td>
  </tr>
  <tr bgcolor="#99FFFF">
    <td bgcolor="#33CC33">&nbsp;</td>
    <td bgcolor="#33CC33">&nbsp;</td>
    <td bgcolor="#33CC33">&nbsp;</td>
    <td colspan="2" bgcolor="#33CC33"><b>Total</b></td>
    <td bgcolor="#33CC33">&nbsp;</td>
    <td align="right" bgcolor="#33CC33"><?php echo $totrol;?><b></td>
    <td align="right" bgcolor="#33CC33"><b><?php echo number_format($totbruto,'2','.',',');?></b></td>
    <td align="right" bgcolor="#33CC33"><b><?php echo number_format($totqty,'2','.',',');?></b></td>
    <td align="right" bgcolor="#33CC33"><b><?php echo number_format($totqty1,'2','.',',');?></b></td>
    <td bgcolor="#33CC33">&nbsp;</td>
    <td align="right" bgcolor="#33CC33">&nbsp;</td>
    
    <td bgcolor="#33CC33">&nbsp;</td>
    <td bgcolor="#33CC33">&nbsp;</td>
  </tr>  
  
  <tr>
    <td colspan="21">&nbsp;</td>
  </tr> 
  </table>
  <div class="cleared"></div>
                            </div>
                        </div>
                    </div>
                </div>
</div>
        </div>
    </div>
</body>
                            
                            
      