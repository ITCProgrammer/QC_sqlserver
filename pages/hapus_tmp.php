<?php
include("../koneksi.php");
ini_set("error_reporting",1);
$sql2=sqlsrv_query($con,"delete from tmp_detail_pergerakan_stok where id='".$_GET['idtmp']."'")or die("gagal1");	
if($sql2)
{ 
if($_GET['bs']=="1"){
echo "<meta http-equiv='refresh' content='0; url=../index1.php?p=kain_bs_masuk_barcode&kkno=".$_GET['nokk']."'>";	
	}else{
echo "<meta http-equiv='refresh' content='0; url=../index1.php?p=kain_masuk_barcode&kkno=".$_GET['nokk']."'>";
}
}
?>	

 