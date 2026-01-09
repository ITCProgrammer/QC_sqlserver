<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Tempat Kain Jadi</title>
</head>
<?php
ini_set("error_reporting",1);
include '../koneksi.php';
?>
<body>
<?php 	
	if(isset($_POST['btnSimpan'])){
	
	$pesanError = array();
	if (trim($_POST['lokasi'])=="") {
		$pesanError[] = "Data <b> Blok / Tempat</b> belum diisi !";		
	}
	# Baca variabel
	$TxtNokk		= $_POST['nokk'];
	$TxtKet			= $_POST['ket'];
	$TxtBlok		= $_POST['tempat'];
			
	# JIKA ADA PESAN ERROR DARI VALIDASI
	if (count($pesanError)>=1 ){
		echo "<div class='mssgBox'>";
			$noPesan=0;
			foreach ($pesanError as $indeks=>$pesan_tampil) { 
			$noPesan++;
				echo "&nbsp;&nbsp; $noPesan. $pesan_tampil<br>";	
			} 
		echo "</div> <br>"; 
	}
	else {
		# SIMPAN KE DATABASE
		# Jika jumlah error pesanError tidak ada, maka proses Penyimpanan akan dilakukan
		
		// Membuat kode Transaksi baru
		// $noTransaksi = buatKode("benang_masuk", "NP");
		
		// Skrip menyimpan data ke tabel transaksi utama
		$myQry3 ="UPDATE detail_pergerakan_stok SET lokasi='".$_POST['lokasi']."' WHERE id_stok='".$_GET['id']."' and nokk='$TxtNokk' and sisa='$TxtKet' ";
		$mySql2=mysqli_query($con,$myQry3) or die ("Gagal query  ".mysql_error());
		echo "<script>";
		echo "</script>";
		echo "<meta http-equiv='refresh' content='0; url=lokasi-persediaan.php?nokk=$TxtNokk&ket=$TxtKet&status=Blok Sudah diUbah'>";
	}	
}
	    $myQry4 = "SELECT * FROM detail_pergerakan_stok WHERE id_stok='".$_GET['id']."' and nokk='".$_GET['nokk']."' and sisa='".$_GET['ket']."' ";
		$mySql4 = mysqli_query($con,$myQry4) or die ("Gagal query  ".mysql_error());
		$rowd	= mysqli_fetch_array($mySql4);
?>
<form id="form1" name="form1" method="post" action="">
  <table width="100%" border="0">
    <tr>
      <td colspan="3">Data Lokasi Kain Jadi
      <div align="center"><font color="#FF0000"><?php echo $_GET['status'];?></font></div></td>
    </tr>
    <tr>
      <td width="11%">No KK</td>
      <td width="1%">:</td>
      <td width="88%"><?php echo $_GET['nokk'];?>
      <input type="hidden" name="nokk" id="nokk" value="<?php echo $_GET['nokk'];?>"/>
	  <input type="hidden" name="ket" id="ket" value="<?php echo $_GET['ket'];?>"/>	
	</td>
    </tr>
    <tr>
      <td>Lokasi</td>
      <td>:</td>
      <td>
      <select name="lokasi" id="lokasi">
      <option value="">Pilih</option>
	  <?php $qryLok=mysqli_query($con,"SELECT lokasi FROM tbl_lokasi ORDER BY lokasi ASC");
		while($rLok=mysqli_fetch_array($qryLok)){ ?>	
        <option value="<?php echo $rLok['lokasi']; ?>" <?php if($rowd['lokasi']==$rLok['lokasi']){ echo "SELECTED"; }?>><?php echo $rLok['lokasi']; ?></option>
		<?php } ?>
    </select>
      </td>
    </tr>
    <tr>
      <td><input type="submit" name="btnSimpan" id="simpan" value="SIMPAN" /></td>
      <td>&nbsp;</td>
      <td><input type="button" name="tutup" id="tutup" value="TUTUP"  onclick="window.close();"/></td>
    </tr>
  </table>
</form>
</body>
</html>