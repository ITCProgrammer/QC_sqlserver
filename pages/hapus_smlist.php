<?php
include_once("../koneksi.php"); 
ini_set("error_reporting",1);
	   $cari=mysqli_query($con,"update detail_pergerakan_stok set refno=null WHERE nokk='".$_GET['nokk']."'");
	   $cari2=mysqli_query($con,"Select * from detail_pergerakan_stok  WHERE refno='".$_GET['nolist']."'");
	   $tm=mysqli_num_rows($cari2);
	   if($tm<=0){
	   $cari1=mysqli_query($con,"delete from packing_list  WHERE listno='".$_GET['nolist']."'");
	   }
	  if($cari >0){ 
 	  echo "<script>alert('Data Terhapus');window.location.href='index1.php?p=surat_keluar&dono=".$_GET['dono']."&nosj=".$_GET['nosj']."&nolist=".$_GET['nolist']."&nokk=".$_GET['nokk']."';</script>";
	 }

?>