<html>
<head>
<title>:: Simpan Transfer Out</title>
</head>
<body>

<table width="70%" border="0" class="table-list1">
  <tr>
   <?php 
include("../koneksi.php");
ini_set("error_reporting",1);
	
	?>
    
  <?php

  if($_POST['submit']=='Transfer Out'){
	  
	
  $sql2=sqlsrv_query($con,"Select * from `db_qc`.`tbl_kite` 
inner join `db_qc`.`tmp_detail_kite` on `db_qc`.`tmp_detail_kite`.`id_kite`= `db_qc`.`tbl_kite`.`id`		    
where `db_qc`.`tbl_kite`.`nokk`='$_POST[nokk]'");
$row2=sqlsrv_fetch_array($sql2);
$nopo=addslashes($_POST['no_po']);
   $datastk=sqlsrv_query($con,"insert into `pergerakan_stok`(`typetrans`,`typestatus`,`no_dok`,`no_order`,`no_po`,`ket`,`fromtoid`,`tgl_update`,`userid`) values('1','1','$_POST[no_dok]','$_POST[no_do]','$nopo','$_POST[catatan]','$_POST[partners]',NOW(),'$_POST[user_name]')")or die("Gagal11");
   $sql3=sqlsrv_query($con,"Select `id` from `pergerakan_stok` where  `pergerakan_stok`.`no_dok`='$_POST[no_dok]' ");
$row3=sqlsrv_fetch_array($sql3);
 if($_POST['partners']=="INSPEK MEJA"){
$sql1=sqlsrv_query($con,"select * from tmp_detail_kite where nokkKite='$_POST[nokk]' and (sisa='TH' or sisa='FKTH' or sisa='BB')");}
if($_POST['partners']=="GUDANG KAIN JADI"){
	$sql1=sqlsrv_query($con,"select * from tmp_detail_kite where nokkKite='$_POST[nokk]' and (sisa!='TH' and sisa!='FKTH' and sisa!='BS' and sisa!='BB')");
	}
  $n=1;
  $nom=1;
  while($row=sqlsrv_fetch_array($sql1))
  {	  
 if($_POST['check'][$n]!='')
		  {
			  
		 $id_kite=$_POST['check'][$n];
			  $sqldtl=sqlsrv_query($con,"SELECT `tmp_detail_kite`.`rolexp`,`tmp_detail_kite`.`id_kite` as kd_kite,`tmp_detail_kite`.`id` as kd,`tmp_detail_kite`.`nokkKite`,`tmp_detail_kite`.`ket_c`,
`tmp_detail_kite`.`no_roll`,`tmp_detail_kite`.`net_wight`,`tmp_detail_kite`.`yard_`,`tmp_detail_kite`.`satuan`,
`tmp_detail_kite`.`sisa`,`tmp_detail_kite`.`grade`,`tmp_detail_kite`.`ket`,`tmp_detail_kite`.`SN`,
`tbl_kite`.`no_warna`,`tbl_kite`.`warna`,`tbl_kite`.`no_lot`
FROM `tbl_kite`
INNER JOIN `tmp_detail_kite` ON `tbl_kite`.`nokk` = `tmp_detail_kite`.`nokkKite` where  `tmp_detail_kite`.`id`='$id_kite'
group by `tmp_detail_kite`.`nokkkite`,`tmp_detail_kite`.`no_roll`
order by `tmp_detail_kite`.`nokkkite`,`tmp_detail_kite`.`no_roll` asc");  
$rdtkite=sqlsrv_fetch_array($sqldtl);
if($_POST['partners']=="GUDANG KAIN JADI"){
$ketc=str_replace("'","''",$rdtkite['ket_c']);
 
sqlsrv_query($con,"insert into `detail_pergerakan_stok` (`id_stok`,`id_detail_kj`,`weight`,`yard_`,`status`,`no_roll`,`grade`,`satuan`,`sisa`,`ket`,`nokk`,`ket_c`,`SN`,`weight_basic`,`yard_basic`) values('$row3[id]','$rdtkite[kd]','$rdtkite[net_wight]','$rdtkite[yard_]','0','$rdtkite[no_roll]','$rdtkite[grade]','$rdtkite[satuan]','$rdtkite[sisa]','$rdtkite[ket]','$rdtkite[nokkKite]','$ketc','$rdtkite[SN]','$rdtkite[net_wight]','$rdtkite[yard_]')")or die("Gagal1  $id_kite");


}else if($_POST['partners']=="INSPEK MEJA"){
	
sqlsrv_query($con,"insert into `detail_pergerakan_stok` (`id_stok`,`id_detail_kj`,`weight`,`yard_`,`status`,`no_roll`,`grade`,`satuan`,`sisa`,`ket`,`nokk`,`SN`,`weight_basic`,`yard_basic`) values('$row3[id]','$rdtkite[kd]','$rdtkite[net_wight]','$rdtkite[yard_]','0','$rdtkite[no_roll]','$rdtkite[grade]','$rdtkite[satuan]','$rdtkite[sisa]','$rdtkite[ket]','$rdtkite[nokkKite]','$rdtkite[SN]','$rdtkite[net_wight]','$rdtkite[yard_]')")or die("Gagal1  $id_kite");

}else if($_POST['partners']=="GUDANG BS"){
	
sqlsrv_query($con,"insert into `detail_pergerakan_stok` (`id_stok`,`id_detail_kj`,`weight`,`yard_`,`status`,`no_roll`,`grade`,`satuan`,`sisa`,`ket`,`nokk`,`ket_c`,`SN`,`weight_basic`,`yard_basic`) values('$row3[id]','$rdtkite[kd]','$rdtkite[net_wight]','$rdtkite[yard_]','0','$rdtkite[no_roll]','$rdtkite[grade]','$rdtkite[satuan]','$rdtkite[sisa]','$rdtkite[ket]','$rdtkite[nokkKite]','$rdtkite[ket_c]','$rdtkite[SN]','$rdtkite[net_wight]','$rdtkite[yard_]')")or die("Gagal1  $id_kite");

}
	  $n++;
 }else{$n++;}
 }
  if($datastk)
  {
	  echo "<script>alert('Data Tersimpan');window.location.href='../index1.php?p=transfer-out-gkj&kkno=$_POST[nokk]&ke=$_POST[partners]&tes=$rowsvr[ID] $rowsvr1[InspectionNo]';</script>";
	  
	  }
	 
  } else{
	  
		 $qry=sqlsrv_query($con,"select pergerakan_stok.id,bruto,satuan,
no_mc,pelanggan,pergerakan_stok.no_po,pergerakan_stok.no_order,paket,
jenis_kain,no_warna,warna,no_item,no_lot,
lebar,berat,grade,yard_ ,
weight as net_wight,sisa,detail_pergerakan_stok.ket,detail_pergerakan_stok.no_roll
from pergerakan_stok 
inner join detail_pergerakan_stok on pergerakan_stok.id=detail_pergerakan_stok.id_stok 
inner join tbl_kite on tbl_kite.nokk=detail_pergerakan_stok.nokk
WHERE detail_pergerakan_stok.nokk='$_POST[nokk]'
AND detail_pergerakan_stok.status='3'
AND detail_pergerakan_stok.ket='INSPEK'
ORDER BY detail_pergerakan_stok.id ASC") or die("gagal");
$n=1;

while($row=sqlsrv_fetch_array($qry))
	  {
		if($_POST['check'][$n]!='')
		  {
			  
		 $id_kite=$_POST['check'][$n];
			 $u1=sqlsrv_query($con,"Update pergerakan_stok set tgl_update=now(),fromtoid='GUDANG KAIN JADI',userid='$_POST[user_name]' where id='$row[id]'")or die("GAGAL Update 1");
			  $u2=sqlsrv_query($con,"Update detail_pergerakan_stok set status='0' where id='$id_kite'")or die("GAGAL Update 1");
			 
		$n++;
 		}else{$n++;}  
	  }
	  echo "<script>alert('Data UPDATE Tersimpan');window.location.href='../index1.php?p=transfer-out-gkj&kkno=$_POST[nokk]&ke=$_POST[partners]';</script>";
	  
	  }
 
 ?>
  
