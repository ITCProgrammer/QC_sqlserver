<html>
<head>
<title>:: Simpan Surat Jalan</title>
<style>
input{
text-align:center;
border:hidden;
}
body,td,th {
  /*font-family: Courier New, Courier, monospace; */
	font-family:sans-serif, Roman, serif;
}
body{
	margin:0px auto 0px;
	padding:3px;
	font-size:12px;
	color:#333;
	width:98%;
	background-position:top;
	background-color:#fff;
}
.table-list {
	clear: both;
	text-align: left;
	border-collapse: collapse;
	margin: 0px 0px 10px 0px;
	background:#fff;	
}
.table-list td {
	color: #333;
	font-size:12px;
	border-color: #fff;
	border-collapse: collapse;
	vertical-align: center;
	padding: 3px 5px;
	border-bottom:1px #CCCCCC solid;
	border-left:1px #CCCCCC solid;
	border-right:1px #CCCCCC solid;

	
}
.table-list1 {
	clear: both;
	text-align: left;
	border-collapse: collapse;
	margin: 0px 0px 10px 0px;
	background:#fff;	
}
.table-list1 td {
	color: #333;
	font-size:12px;
	border-color: #fff;
	border-collapse: collapse;
	vertical-align: center;
	padding: 3px 5px;
	border-bottom:1px #CCCCCC solid;
	border-top:2px #CCCCCC solid;
	border-left:2px #CCCCCC solid;
	border-right:2px #CCCCCC solid;
	
	
}
#nocetak {
	display:none;
	}
-->
</style>
</head>
<body>

<table width="70%" border="0" class="table-list1">
  <tr>
  
   <?php 
include_once("../koneksi.php");
ini_set("error_reporting",1);
	?>
    
  <?php
  if($_POST['submit']=='TAMBAH'){
	   $cari=sqlsrv_query($con,"update `packing_list` SET 
	   `no_sj`='".$_POST['ket']."',
	   `no_order`='".$_POST['dono']."',
	   `buyer`='".$_POST['buyer']."',
	   `alamat`='".$_POST['alamat']."',
	   `tujuan`='".$_POST['tujuan']."',
	   `kendaraan`='".$_POST['kendaraan']."',
	   `no_po`='-',
	   `ket`='KAIN-EXPORT',
	   `tgl_update`='".$_POST['tglawal']."',
	   `term`='".$_POST['term']."'
	    where `listno`='".$_POST['nolist']."' limit 1");
	  if($cari >0){ 
 	  echo "<script>alert('Data Ditambahkan');window.location.href='../index1.php?p=surat_keluar_export&dono=".$_POST['dono']."&nosj=".$_POST['ket']."';</script>";
	 }
  }
 ?>
  
<!--window.open('cetak_surat_jalan.php?dono=$_POST[dono]&no_sj=$_POST[ket]','_blank');window.location.href='../index1.php?p=surat_keluar&dono=$_POST[dono]'; -->