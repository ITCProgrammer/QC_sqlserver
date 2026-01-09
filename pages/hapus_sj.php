 <?php   
include_once("../koneksi.php");
ini_set("error_reporting",1);
$ipadd	= $_SERVER['REMOTE_ADDR'];

$sqlsimpan=mysqli_query($con,"INSERT INTO `tbl_log_surat_jalan` SET 
`userid`='PPC', 
`ipaddress`='$ipadd', 
`no_sj`='".$_GET['nosj']."',
`aksi`='hapus', 
`ket`='".$_GET['dono']."',
`tgl_update`=now()
");
$cari	=	mysqli_query($con,"update `packing_list` set
			`no_sj`=null,
			`tgl_update`=null
			where `id`='".$_GET['id']."' limit 1");
$hpsLap	=	mysqli_query($con,"update db_qc.tbl_pengiriman set tmp_hapus='1' WHERE id_list='".$_GET['id']."' ");

if($cari >0){ 
 	  echo "<script>alert('Data Terhapus');window.location.href='../index1.php?p=surat_keluar&dono=".$_GET['dono']."&nosj=".$_GET['nosj']."';</script>";
	 }

?>