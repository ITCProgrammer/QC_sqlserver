<html>
<head>
<title>:: Simpan Waste</title>
</head>
<body>
<?php 
include_once("../koneksi.php");
	
	?>
    <?php
	$id=$_GET['id'];
	$simpan=mysql_query("UPDATE `db_qc`.`tmp_detail_kite` SET `nokkKite` = '$_GET[kkno]' WHERE `tmp_detail_kite`.`id`='$id'") or die("Gagal");
	echo "<script>";
		echo "alert('Data Terhapus')";
		echo "</script>";
		// Refresh form
		echo "<meta http-equiv='refresh' content='0; url=../index1.php?p=form_Qc_waste&kkno=$_GET[kkno]&kkno2=$_GET[kkno2]'>";
	?>
</body>
</html>