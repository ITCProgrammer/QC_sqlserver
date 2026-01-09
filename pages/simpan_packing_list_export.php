   <?php 
   session_start();
	include("../koneksi.php");
	?>
    
  <?php
  
  if($_POST['submit']=='SIMPAN' and $_POST['pack']!=""){
	$cari=mysqli_query($con,"Select `id` from `packing_list` where `listno`='$_POST[no_list]' limit 1");
	$cek=mysqli_num_rows($cari);
	$listno = $_POST['no_list'];
	$ket = $_POST['lprn'];
if($_POST['dono']!='')
	{ $cwhere2.= $_POST['dono']; 
		}else{ $cwhere2.="null"; }
if($_POST['nopo']!='')
	{ $cwhere1.= " AND `tbl_kite`.`id`='$_POST[nopo]'"; 
		}else{ $cwhere1.= " "; }
if($_POST['noitem']!='')
	{ $cwhere10.= " AND `tbl_kite`.`no_item`='$_POST[noitem]'"; 
		}else{ $cwhere10.= " "; }
if($_POST['warna']!='')
	{ $cwhere11.= " AND `tbl_kite`.`warna`='$_POST[warna]'"; 		}else{ $cwhere11.= " "; }
if($_POST['lot']!='')
	{ $cwhere12.= " AND `tbl_kite`.`no_lot`='$_POST[lot]'"; 		}else{ $cwhere12.= " "; }
	$qry=mysqli_query($con,"SELECT
	*, detail_pergerakan_stok.id AS kd
FROM
	pergerakan_stok
INNER JOIN detail_pergerakan_stok ON pergerakan_stok.id = detail_pergerakan_stok.id_stok
INNER JOIN tmp_detail_kite ON tmp_detail_kite.id = detail_pergerakan_stok.id_detail_kj
INNER JOIN tbl_kite ON tbl_kite.id = tmp_detail_kite.id_kite
WHERE
	(detail_pergerakan_stok.sisa !='FKTH' AND detail_pergerakan_stok.sisa !='TH' AND typestatus='2'
AND `tbl_kite`.`no_order`='".$cwhere2."'
 )".$cwhere1.$cwhere10.$cwhere11.$cwhere12." GROUP BY tmp_detail_kite.id  
 ORDER BY `pergerakan_stok`.`typestatus`,
	`detail_pergerakan_stok`.`nokk`,
	`detail_pergerakan_stok`.`no_roll` ASC");
  	$n=1;
	$nom=1;
	 while($row=mysqli_fetch_array($qry))
  {	  
  if($_POST['check'][$n]!='')
		  {
			 $id_kite=$_POST['check'][$n];
			 $sdata=mysqli_query($con,"select * from detail_pergerakan_stok where id='$id_kite'");
			 $srow=mysqli_fetch_array($sdata);
			 $cari1=mysqli_query($con,"Select `id` from `packing_list` where `listno`='$listno' limit 1");
			 $cek1=mysql_num_rows($cari1);
			 if($cek1>0){// ubah data di detail_pergerakan stok
	$datastk1=mysqli_query($con,"UPDATE detail_pergerakan_stok SET refno='$listno',pack='$_POST[pack]' where id='$id_kite'")or die("Gagal1  $id_kite");
	if($datastk1)
  {
	  echo "<script>alert('Data Tersimpan');window.location.href='../index1.php?p=packing_list_export&dono=$_POST[dono]';</script>";
	  }
	}else{
//masuk ke packing_list
$ip_num = $_SERVER['REMOTE_ADDR']; //untuk mendeteksi alamat IP
$host_name = gethostbyaddr($_SERVER['REMOTE_ADDR']); //untuk mendeteksi computer name
$userid	=$_SESSION['username'];
$datastk=mysqli_query($con,"insert into `packing_list` (`listno`,`status`,ket,`ipaddress`,`userid`,`tgl_buat_list`) values('$listno','1','$ket','$ip_num','$userid',now())")or die("Gagal1  $id_kite");}
	// ubah data di detail_pergerakan stok
	mysqli_query($con,"UPDATE detail_pergerakan_stok SET refno='$listno',pack='$_POST[pack]' where id='$id_kite'")or die("Gagal1  $id_kite");
		  $n++;}else{$n++;}
 }
  if($datastk)
  {
	  echo "<script>alert('Data Tersimpan');window.location.href='../index1.php?p=packing_list_export&dono=$_POST[dono]';</script>";
	  }

  } else{ echo "<script>alert('Gagal  Tersimpan, Pack belum dipilih');window.location.href='../index1.php?p=packing_list_export&dono=$_POST[dono]';</script>";
	  }
 ?>
  
<?php mysqli_close($con); ?>