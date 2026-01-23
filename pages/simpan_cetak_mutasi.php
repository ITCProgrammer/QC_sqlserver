<html>
<head>
<title>:: Simpan MUTASI KAIN JADI</title>
</head>
<body>
<?php 
ini_set("error_reporting",1);	
include "../koneksi.php";
function mutasiurut(){
include "../koneksi.php";		
$format = date("Ymd");
$sql=sqlsrv_query($con,"SELECT no_mutasi FROM mutasi_kain WHERE substr(no_mutasi,1,8) like '%".$format."%' ORDER BY no_mutasi DESC LIMIT 1 ") or die (mysql_error());
$d=sqlsrv_num_rows($sql);
if($d>0){
$r=sqlsrv_fetch_array($sql);
$d=$r['no_mutasi'];
$str=substr($d,8,2);
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
if($_POST['bs']=="BS"){$bs=" fromtoid='GUDANG BS' ";$kbs="BS";}else if($_POST['bs']=="GUDANG GREIGE"){$bs=" fromtoid='GUDANG GREIGE' ";$kbs="";}else{$bs=" fromtoid='GUDANG KAIN JADI' ";$kbs="";}
if(substr($_POST['user_name'],0,6)=="INSPEK"){$ket=" and detail_pergerakan_stok.ket!=''";}else{$ket=" and detail_pergerakan_stok.ket=''";}
if($_POST['sift']=="1"){	  
  $sql=sqlsrv_query($con,"select pergerakan_stok.id,bruto,satuan,
no_mc,pelanggan,pergerakan_stok.no_po,pergerakan_stok.no_order,tgl_update,
jenis_kain,no_warna,warna,no_item,no_lot,
lebar,berat,detail_pergerakan_stok.nokk,grade,
detail_pergerakan_stok.ket,count(yard_) as tot_rol,sum(yard_) as tot_yard ,
sum(weight) as tot_qty,sisa
from pergerakan_stok 
inner join detail_pergerakan_stok on pergerakan_stok.id=detail_pergerakan_stok.id_stok 
inner join tbl_kite on tbl_kite.nokk=detail_pergerakan_stok.nokk
WHERE tgl_update
BETWEEN '".$_POST['tgl1']." 07:00:00'
AND '".$_POST['tgl2']." 14:59:59'
AND ".$bs."
AND userid = '".$_POST['user_name']."' ".$ket."
GROUP BY  pergerakan_stok.id, no_dok,sisa
ORDER BY pergerakan_stok.id ASC");}else if($_POST['sift']=="2"){
	  
	  $sql=sqlsrv_query($con,"select pergerakan_stok.id,bruto,satuan,
no_mc,pelanggan,pergerakan_stok.no_po,pergerakan_stok.no_order,tgl_update,
jenis_kain,no_warna,warna,no_item,no_lot,
lebar,berat,detail_pergerakan_stok.nokk,grade,
detail_pergerakan_stok.ket,count(yard_) as tot_rol,sum(yard_) as tot_yard ,
sum(weight) as tot_qty,sisa
from pergerakan_stok 
inner join detail_pergerakan_stok on pergerakan_stok.id=detail_pergerakan_stok.id_stok 
inner join tbl_kite on tbl_kite.nokk=detail_pergerakan_stok.nokk
WHERE tgl_update
BETWEEN '".$_POST['tgl1']." 15:00:00'
AND '".$_POST['tgl2']." 22:59:59'
AND ".$bs."
AND userid = '".$_POST['user_name']."' ".$ket."
GROUP BY  pergerakan_stok.id, no_dok,sisa
ORDER BY pergerakan_stok.id ASC");
	  
	  }else{
	$sql=sqlsrv_query($con,"select pergerakan_stok.id,bruto,satuan,
no_mc,pelanggan,pergerakan_stok.no_po,pergerakan_stok.no_order,tgl_update,
jenis_kain,no_warna,warna,no_item,no_lot,
lebar,berat,detail_pergerakan_stok.nokk,grade,
detail_pergerakan_stok.ket,count(yard_) as tot_rol,sum(yard_) as tot_yard ,
sum(weight) as tot_qty,sisa
from pergerakan_stok 
inner join detail_pergerakan_stok on pergerakan_stok.id=detail_pergerakan_stok.id_stok 
inner join tbl_kite on tbl_kite.nokk=detail_pergerakan_stok.nokk
WHERE tgl_update
BETWEEN '".$_POST['tgl1']." 23:00:00'
AND '".$_POST['tgl2']." 06:59:59'
AND ".$bs."
AND userid = '".$_POST['user_name']."' ".$ket."
GROUP BY  pergerakan_stok.id, no_dok,sisa
ORDER BY pergerakan_stok.id ASC");	  
		  
		 }
	
	$n=1;
 while($row=sqlsrv_fetch_array($sql))
  {
 if($_POST['check'][$n] !='')
		  { 
$id_stk=$_POST['check'][$n];	
$pos1=strpos($id_stk,"/");
$id=substr($id_stk,0,$pos1);
$sisa1=substr($id_stk,$pos1+1,20);
$a=sqlsrv_query($con,"select pergerakan_stok.id,bruto,satuan,
no_mc,pelanggan,pergerakan_stok.no_po,pergerakan_stok.no_order,tgl_update,
jenis_kain,no_warna,warna,no_item,no_lot,
lebar,berat,detail_pergerakan_stok.nokk,grade,
detail_pergerakan_stok.ket,count(yard_) as tot_rol,sum(yard_) as tot_yard ,
sum(weight) as tot_qty,sisa
from pergerakan_stok 
inner join detail_pergerakan_stok on pergerakan_stok.id=detail_pergerakan_stok.id_stok 
inner join tbl_kite on tbl_kite.nokk=detail_pergerakan_stok.nokk
WHERE  pergerakan_stok.id='$id' AND detail_pergerakan_stok.sisa='$sisa1'
AND ".$bs."
GROUP BY  pergerakan_stok.id, no_dok,sisa
ORDER BY pergerakan_stok.id ASC");
$rb=sqlsrv_fetch_array($a);
sqlsrv_query($con,"Insert into mutasi_kain(nokk,no_mutasi,tempat,userid,keterangan,id_stok) values('".$rb['nokk']."','$no','','".$_POST['user_name']."','".$rb['sisa']."','$id')")or die("Gagal");  sqlsrv_query($con,"update pergerakan_stok 
		set no_mutasi='$no' where id='$id'")or die("Gagal update");
	  $n++;}else{$n++;}	
  }
  echo"<script>window.location.href='cetak/cetak_mutasi_ulang.php?mutasi=$no&bs='</script>";
	?>
   
   