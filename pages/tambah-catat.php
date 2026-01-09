<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Catatan Booking</title>
</head>

<body>
<?php
mysql_connect("10.0.0.10","dit","4dm1n");
mysql_select_db("db_qc")or die("Gagal Koneksi");

	if(isset($_POST['btnSimpan'])){

	$pesanError = array();
	if (trim($_POST['nama'])=="") {
		$pesanError[] = "Data <b> Nama</b> belum diisi !";
	}
	if (trim($_POST['dept'])=="") {
		$pesanError[] = "Data <b> Dept</b> belum dipilih !";
	}
	# Baca variabel
	$Txtdept		= $_POST['dept'];
	$Txtnama		= str_replace("'","''",$_POST['nama']);
	$Txtcatat		= str_replace("'","''",$_POST['catat']);
	$Txtid			= $_GET[id];
	$Txtket			= $_GET[ket];
	$Txtnokk		= $_GET[nokk];

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
		$myQrycariMK = "SELECT * FROM mutasi_kain
						WHERE nokk='".$Txtnokk."' AND keterangan='".$Txtket."' LIMIT 1";
		$mySqlcariMK=mysql_query($myQrycariMK) or die ("Gagal query  ".mysql_error());
		$rowcariMK=mysql_num_rows($mySqlcariMK);
		if($rowcari>0){
		$myQry3 ="	UPDATE mutasi_kain SET 
					catatan='$Txtcatat' 
					WHERE keterangan='$Txtket' AND nokk='$Txtnokk'";
		mysql_query($myQry3) or die ("Gagal query  ".mysql_error());
		}else{
			$mySql3	= "INSERT mutasi_kain SET
						catatan='".$Txtcatat."',
						nokk='".$Txtnokk."',
						keterangan='".$Txtket."'";
		mysql_query($mySql3) or die ("Gagal query ".mysql_error());
		}
		$myQrycari	= "SELECT * FROM tbl_catat_kain
						WHERE nokk='".$Txtnokk."' AND ket='".$Txtket."' LIMIT 1";
		$mySqlcari=mysql_query($myQrycari) or die ("Gagal query  ".mysql_error());
		$rowcari=mysql_num_rows($mySqlcari);
		if($rowcari>0){
		$mySql	= "UPDATE tbl_catat_kain SET
						catat='".$Txtcatat."',
						nokk='".$Txtnokk."',
						nama='".$Txtnama."',
						dept='".$Txtdept."',
						ket='".$Txtket."'
						WHERE id_kain='".$Txtid."'";
		mysql_query($mySql) or die ("Gagal query 1 ".mysql_error());
		}else{
			$mySql	= "INSERT tbl_catat_kain SET
						catat='".$Txtcatat."',
						nokk='".$Txtnokk."',
						nama='".$Txtnama."',
						dept='".$Txtdept."',
						id_kain='".$Txtid."',
						ket='".$Txtket."',
						tgl_update=now()";
		mysql_query($mySql) or die ("Gagal query 1 ".mysql_error());
			}

		echo "<script>";
		echo "</script>";
		echo "<meta http-equiv='refresh' content='0; url=tambah-catat.php?id=$Txtid&nokk=$Txtnokk&ket=$Txtket&status=Catatan Sudah diUbah'>";
	}
}
?>
<form id="form1" name="form1" method="post" action="">
  <table width="100%" border="0">
    <tr>
      <td colspan="3">Data Catatan Kain Jadi
        <div align="center"><font color="#FF0000"><?php echo $_GET['status'];?></font></div></td>
    </tr>
    <?php $myQry	= "SELECT * FROM tbl_catat_kain
						WHERE nokk='".$_GET['nokk'] ."' AND ket='".$_GET['ket'] ."' ORDER BY id DESC";
		$mySql1=mysql_query($myQry) or die ("Gagal query  ".mysql_error());
		$row1=mysql_fetch_array($mySql1);
		?>
    <tr>
      <td width="11%">No KK</td>
      <td width="1%">:</td>
      <td width="88%"><?php echo $_GET['nokk'];?><label for="nokk"></label>
      <input type="hidden" name="id" id="id"  value="<?php echo $_GET['id'];?>"/></td>
    </tr>
    <tr>
      <td valign="top">Catatan</td>
      <td valign="top">:</td>
      <td><textarea name="catat" id="catat" cols="45" rows="5"><?php echo $row1['catat']; ?></textarea></td>
    </tr>
    <tr>
      <td>Nama</td>
      <td>:</td>
      <td><label for="nama"></label>
      <input type="text" name="nama" id="nama" value="<?php echo $row1['nama']; ?>" />
      <label for="ket"></label></td>
    </tr>
    <tr>
      <td>Dept</td>
      <td>:</td>
      <td><select name="dept" id="dept">
        <option value="">PILIH</option>
        <option value="GKJ" <?php if($row1[dept]=="GKJ"){echo "SELECTED";}?>>GKJ</option>
        <option value="QC" <?php if($row1[dept]=="QC"){echo "SELECTED";}?>>QC</option>
        <option value="MKT" <?php if($row1[dept]=="MKT"){echo "SELECTED";}?>>MKT</option>
        <option value="PPC" <?php if($row1[dept]=="PPC"){echo "SELECTED";}?>>PPC</option>
      </select></td>
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
