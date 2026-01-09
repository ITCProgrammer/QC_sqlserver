<?php
ini_set("error_reporting",1);
include("../koneksi.php");
/*$sql_p=mysqli_query($con,"Select detail_pergerakan_stok.id from pergerakan_stok 
inner join detail_pergerakan_stok on pergerakan_stok.id=detail_pergerakan_stok.id_stok  
where pergerakan_stok.id='".$_GET['id_stok']."' limit 1");
while($sql_q=mysqli_fetch_array($sql_p)){
	$sql_r=mysqli_query($con,"DELETE FROM detail_pergerakan_stok where id_stok='".$sql_q['id']."'");
	}*/
$sql_r=mysqli_query($con,"DELETE FROM detail_pergerakan_stok where id_stok='".$_GET['id_stok']."'");
$sql_d=mysqli_query($con,"DELETE from pergerakan_stok where id='".$_GET['id_stok']."");
$sql_=mysqli_query($con,"Delete from mutasi_kain where id_stok='".$_GET['id_stok']."'");
echo"<script>alert('Data mutasi terhapus');window.location='lihat_data_mutasi_hapus.php?no_mutasi=".$_GET['nomutasi']."';</script>";

?>