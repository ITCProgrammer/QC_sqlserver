<?php 
include_once("../koneksi.php");
ini_set("error_reporting",1);
?>
<html>
<head>
<title>:: Simpan Input Waste</title>
</head>
<body>
<?php
if($_POST['submit']=='Save'){
        $idb=$_POST['check'];
        $kategori_bs = $_POST['kategori_bs'];
        $p_jawab = $_POST['p_jawab'];
        $masalah_bs = $_POST['masalah_bs'];
        $no_waste = $_POST['no_waste'];
        $ket_bs = $_POST['ket_bs'];
        $tempat_bs = $_POST['tempat_bs'];
        //$id=$_POST['check'];      
            for($l=0; $l < count($kategori_bs); $l++){
                $u1=sqlsrv_query($con,"UPDATE mutasi_kain SET 
                kategori_bs='$kategori_bs[$l]',
                p_jawab='$p_jawab[$l]',
                masalah_bs='$masalah_bs[$l]',
                no_waste='$no_waste[$l]', 
                ket_bs='$ket_bs[$l]',
                tempat_bs='$tempat_bs[$l]'
                WHERE id='$idb[$l]'") or die("GAGAL Update!");
            }   
    echo "<script>alert('Data Update Tersimpan');window.location.href='../pages/cetak/cetak_mutasi_ulang_bs.php?mutasi=".$_POST['no_mutasi']."';</script>";
}

?>