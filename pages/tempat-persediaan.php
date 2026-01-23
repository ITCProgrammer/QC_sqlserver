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
	if (trim($_POST['tempat'])=="") {
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
		$myQry3 ="UPDATE pergerakan_stok SET blok='".$_POST['tempat']."' WHERE id='".$_GET['id']."'";
		$mySql2=sqlsrv_query($con,$myQry3) or die ("Gagal query  ".mysql_error());
		$myQrycari	= "SELECT * FROM mutasi_kain
						WHERE nokk='".$_GET['nokk'] ."' AND keterangan='".$_GET['ket'] ."' LIMIT 1";
		$mySqlcari=sqlsrv_query($con,$myQrycari) or die ("Gagal query  ".mysql_error());
		$rowcari=sqlsrv_fetch_row($mySqlcari);
		if($rowcari>0){
		$mySql	= "UPDATE mutasi_kain SET 
						tempat='".$TxtBlok."'
						WHERE nokk='".$TxtNokk."' AND keterangan='".$TxtKet."'";
		sqlsrv_query($con,$mySql) or die ("Gagal query 1 ".mysql_error());
		}else{
			$mySql	= "INSERT mutasi_kain SET 
						tempat='".$TxtBlok."',
						nokk='".$TxtNokk."',
						keterangan='".$TxtKet."'";
		sqlsrv_query($con,$mySql) or die ("Gagal query 1 ".mysql_error());
			}

		echo "<script>";
		echo "</script>";
		echo "<meta http-equiv='refresh' content='0; url=tempat-persediaan.php?nokk=$TxtNokk&ket=$TxtKet&status=Blok Sudah diUbah'>";
	}	
}
?>
<form id="form1" name="form1" method="post" action="">
  <table width="100%" border="0">
    <tr>
      <td colspan="3">Data Tempat Kain Jadi
      <div align="center"><font color="#FF0000"><?php echo $_GET['status'];?></font></div></td>
    </tr>
    <?php $myQry	= "SELECT * FROM mutasi_kain
						WHERE nokk='".$_GET['nokk'] ."' AND keterangan='".$_GET['ket'] ."' ORDER BY id DESC";
		$mySql1=sqlsrv_query($con,$myQry) or die ("Gagal query  ".mysql_error());
		$row1=sqlsrv_fetch_array($mySql1);
		?>
    <tr>
      <td width="11%">No KK</td>
      <td width="1%">:</td>
      <td width="88%"><?php echo $_GET['nokk'];?><label for="nokk"></label>
      <input type="hidden" name="nokk" id="nokk"  value="<?php echo $_GET['nokk'];?>"/></td>
    </tr>
    <tr>
      <td>Tempat</td>
      <td>:</td>
      <td><label for="tempat"></label>
      <input type="text" name="tempat" id="tempat" value="<?php echo $row1['tempat']; ?>" />
      <label for="ket"></label>
      <input type="hidden" name="ket" id="ket" value="<?php echo $_GET['ket'];?>" /></td>
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