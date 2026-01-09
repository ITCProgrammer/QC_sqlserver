<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Ubah Tgl Masuk</title>
<script>
$(document).ready(function(){
  $('.date').mask('9999-99-99');});
</script>
</head>

<body>
<?php 
mysql_connect("10.0.0.10","dit","4dm1n");
mysql_select_db("db_qc")or die("Gagal Koneksi");
	
	if(isset($_POST['btnSimpan'])){
	
	$pesanError = array();
	if (trim($_POST['tgl'])=="") {
		$pesanError[] = "Data <b> Tgl Masuk </b> belum diisi !";		
	}
	# Baca variabel
	$TxtNo		= $_POST['no'];
	$TxtTgl			= $_POST['tgl'];
				
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
		$mySql	= "UPDATE pergerakan_stok SET 
						tgl_update='".$TxtTgl."'
						WHERE id='".$TxtNo."'";
		mysql_query($mySql) or die ("Gagal query 1 ".mysql_error());
		echo "<script>";
		echo "</script>";
		echo "<meta http-equiv='refresh' content='0; url=ubah-tgl-masuk-kain.php?no=$TxtNo&tgl=$TxtTgl&status=Tgl Masuk Sudah diUbah'>";
	}	
}
?>
<form id="form1" name="form1" method="post" action="">
  <table width="330" border="0">
    <tr>
      <td width="113">No ID</td>
      <td width="5">:</td>
      <td width="198"><font size="-1"><em><?php echo $_GET[no]; ?></em></font><input type="hidden" name="no" id="no"  value="<?php echo $_GET[no];?>"/></td>
    </tr>
    <tr>
      <td>Tgl Masuk</td>
      <td>:</td>
      <td><input name="tgl" type="text" id="tgl"  value="<?php echo $_GET[tgl];?>" size="10" maxlength="10" data-mask="9999-99-99" placeholder="0000-00-00"/> 
        <font size="-1"><em>2015-12-25</em></font></td>
    </tr>
    <tr>
      <td colspan="3"><input type="submit" name="btnSimpan" id="btnSimpan" value="Simpan" /> &nbsp; <font color="#FF0000"><?php echo $_GET['status'];?></font></td>
    </tr>
  </table>
</form>
</body>
</html>