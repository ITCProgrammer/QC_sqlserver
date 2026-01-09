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
        $pos=strpos($_POST['check'][$n], ",");
        $no_sj=substr($_POST['check'][$n],0,$pos);
        $tgl_kirim=substr($_POST['check'][$n],$pos+1,50);
        $dataupdate=mysqli_query($con,"UPDATE tbl_pengiriman SET approve_acc='Approve', ipaddress_acc='".$_SERVER['REMOTE_ADDR']."', tgl_approve_acc=now() where no_sj='$no_sj' AND tgl_kirim='$tgl_kirim'")or die("Gagal!  $id");
          $n++;}else{$n++;}
    }
    if($dataupdate)
    {
	  echo "<script>alert('Data Tersimpan');window.location.href='../index1.php?p=pengirimACC';</script>";
	  }
}
?>