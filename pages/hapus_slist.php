<?php
$ipadd	= $_SERVER['REMOTE_ADDR'];
include_once("../koneksi.php"); 
ini_set("error_reporting",1);

$sqlsimpan=mysqli_query($con,"INSERT INTO `tbl_log_surat_jalan` SET 
`userid`='PPC', 
`ipaddress`='$ipadd', 
`no_sj`='".$_GET['nolist']."',
`aksi`='hapus', 
`ket`='".$_GET['nosj']." ".$_GET['nokk']."',
`tgl_update`=now()
");
$cari=mysqli_query($con,"update detail_pergerakan_stok set refno=null WHERE id='".$_GET['id']."' limit 1");
if($cari >0){ 
echo "<script>alert('Data Terhapus');window.location.href='index1.php?p=hapus_rlist&dono=".$_GET['dono']."&nosj=".$_GET['nosj']."&nolist=".$_GET['nolist']."&nokk=".$_GET['nokk']."';</script>";
}

?>