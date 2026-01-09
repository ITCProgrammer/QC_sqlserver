<?php 
include_once("../koneksi.php");
ini_set("error_reporting",1);
?>
<?php
if($_POST['submit']=='SIMPAN'){
    $tgl= $_GET['tgl'];
    $sj= $_GET['nosj'];
    $sqlbr=mysqli_query($con,"SELECT
	id,tgl_kirim,tgl_buat,no_sj,warna,rol,qty,buyer,no_po,no_order,jenis_kain,lot,tujuan,ket,foc
    FROM
        tbl_pengiriman
    WHERE
        not no_sj='' AND ISNULL(kategori) AND $tgl $sj
    ORDER BY no_sj asc");
    $n=0;
    while($row=mysqli_fetch_array($sqlbr)){
    if($_POST['check'][$n]!=''){
        $id=$_POST['check'][$n];
        $dataupdate=mysqli_query($con,"UPDATE tbl_pengiriman SET approve='Approve' where id='$id'")or die("Gagal!  $id");
          $n++;}else{$n++;}
    }
    if($dataupdate)
    {
	  echo "<script>alert('Data Tersimpan');window.location.href='../index1.php?p=pengirim';</script>";
	  }
}
?>