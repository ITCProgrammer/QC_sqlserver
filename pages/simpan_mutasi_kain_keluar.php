<?php 
include_once("../koneksi.php");
$sql=mysql_query("update detail_pergerakan_stok set status='0' where id='$_GET[id]' limit 1");
if($sql)
{
	echo"<script>alert('Berhasil dihapus!!');window.location.href='../index1.php?p=mutasi_kain_keluar&no_sj=$_GET[no_sj]';</script>";
	}else{
		echo"<script>alert('Gagal hapus');</script>";
		}	
	



?>