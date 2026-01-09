<?php
$host="10.0.0.4";
$username="timdit";
$password="4dm1n";
$db_name="TM";
 set_time_limit(600);
	$conn=mssql_connect($host,$username,$password) or die ("Sorry our web is under maintenance. Please visit us later");
	mssql_select_db($db_name) or die ("Under maintenance");
		
	?> 
<html>
<head>
<title>:: Simpan Transfer Out</title>
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
	function mutasiurut(){
		date_default_timezone_set("Asia/Jakarta");
$format = date("ymd");
$sql=mysql_query("SELECT no_dok FROM pergerakan_stok WHERE substr(no_dok,1,6) like '%".$format."%' ORDER BY no_dok DESC LIMIT 1 ") or die (mysql_error());
$d=mysql_num_rows($sql);
if($d>0){
$r=mysql_fetch_array($sql);
$d=$r['no_dok'];
$str=substr($d,6,2);
$Urut = (int)$str;
}else{
$Urut = 0;
}
$Urut = $Urut + 1;
$Nol="";
$nilai=2-strlen($Urut);
for ($i=1;$i<=$nilai;$i++){
$Nol= $Nol."0";
}
$nipbr =$format.$Nol.$Urut;
return $nipbr;
}
$no=mutasiurut();
	
	?>
    
  <?php

  if($_POST['submit']=='Mutasi Keluar'){
	   $cari=mysql_query("Select `id` from `pergerakan_stok` where `refno`='$_POST[no_ref]' limit 1");
$cek=mysql_num_rows($cari);
	  if($cek>0){echo "<script>alert('No Ref Sudah Ada');window.location.href='../form-Packing?p=mutasi_kain_keluar_online&nokk=$_POST[nokk]';</script>";
	  }else{
  $sqldt="select stockmovement.id as kd,productprop.id as iddt,productprop.pcbid,SN,rollno,productprop.pcbid,SN,rollno,stockmovementdetails.Length,stockmovementdetails.weight,productprop.pono as pono,productprop.batchno,productprop.Width,productprop.WeightPerArea from stockmovement 
left join stockmovementdetails on  stockmovementdetails.stockmovementid=stockmovement.id
left join productprop on productprop.id = stockmovementdetails.productpropid
left join productmaster on productmaster.id = stockmovementdetails.productid
where stockmovement.wid=22 and stockmovement.transactiontype=4 and stockmovement.transactionstatus=1 and productprop.batchno='$_POST[nokk]'order by rollno";
$datadt=mssql_query($sqldt);
$rkj=mssql_fetch_array($datadt);
   $datastk=mysql_query("insert into `pergerakan_stok`(`id_kj`,`typetrans`,`typestatus`,`refno`,`fromtoid`,`ket`,`tgl_update`) values('$rkj[kd]','1','1','$_POST[no_ref]','$_POST[langgan]','$_POST[ket] $_POST[nokk]',now())")or die("Gagal11");
   $sql3=mysql_query("Select `id` from `pergerakan_stok` where `id_kj`='$rkj[kd]' and `refno`='$_POST[no_ref]' ");
$row3=mysql_fetch_array($sql3);
  $sql1=mssql_query("select stockmovement.id as kd,productprop.id as iddt,productprop.pcbid,SN,rollno,productprop.pcbid,SN,rollno,stockmovementdetails.Length,stockmovementdetails.weight,productprop.pono as pono,productprop.batchno,productprop.Width,productprop.WeightPerArea from stockmovement 
left join stockmovementdetails on  stockmovementdetails.stockmovementid=stockmovement.id
left join productprop on productprop.id = stockmovementdetails.productpropid
left join productmaster on productmaster.id = stockmovementdetails.productid
where stockmovement.wid=22 and stockmovement.transactiontype=4 and stockmovement.transactionstatus=1 and productprop.batchno='$_POST[nokk]'order by rollno");
  $n=1;
  $nom=1;
  while($row=mssql_fetch_array($sql1))
  {	  
 if($_POST['check'][$n]==$n)
		  {
			  $ryard=number_format(round($row['Length'],2),'2','.',',');
		$dtstk=mysql_query("insert into `detail_pergerakan_stok` (`id_stok`,`id_detail_kj`,`weight`,`yard_`) values('$row3[id]','$row[iddt]','$row[weight]','$ryard')")or die("Gagal1");
			    
	  $n++;
 }else{$n++;}
 }
  if($datastk)
  {
	  echo "<script>alert('Data Tersimpan');window.location.href='../form-Packing?p=mutasi_kain_keluar_online&nokk=$_POST[nokk]';</script>";
	  }
	  }
  }
 ?>
  
