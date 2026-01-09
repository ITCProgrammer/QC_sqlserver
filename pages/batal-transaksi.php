<?php
//include("../koneksi.php");
//request page
$page	= isset($_GET['p'])?$_GET['p']:'';
$act	= isset($_GET['act'])?$_GET['act']:'';
$id		= isset($_GET['id'])?$_GET['id']:'';
$page	= strtolower($page);
?>
<!DOCTYPE html>
<html dir="ltr" lang="en-US"><head><!-- Created by Artisteer v4.3.0.60745 -->
    <meta charset="utf-8">
    <title>Batal Transaksi</title>
    <meta name="viewport" content="initial-scale = 1.0, maximum-scale = 1.0, user-scalable = no, width = device-width">
</head>
<body>
<?php 
	$sqlbatal=mysql_query("DELETE FROM tbl_stok_kj WHERE tgl_tutup='$_GET[tgl]'") or die("Query Gagal");
	if($sqlhapus){
	  echo "<script>alert('Transaksi Berhasil dibatalkan');window.location.href='?p=data-stok-kj';</script>";
	}
		
	
?>
</body>
</html>