<?php ini_set("error_reporting", 1); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Button</title>
	<!-- Copyright 2000-2006 Adobe Macromedia Software LLC and its licensors. All rights reserved. -->
	<!-- Copyright 2000-2006 Adobe Macromedia Software LLC and its licensors. All rights reserved. -->
	<!-- Copyright 2000-2006 Adobe Macromedia Software LLC and its licensors. All rights reserved. -->
	<!-- Copyright 2000-2006 Adobe Macromedia Software LLC and its licensors. All rights reserved. -->
	<style>
		.rol {
			width: 100%;
			height: 243px;
			overflow: scroll;
		}
	</style>
	<script language="javascript">
		var win = null;

		function NewWindow(mypage, myname, scroll) {
			LeftPosition = (screen.width) ? (screen.width - 600) / 2 : 0;
			TopPosition = (screen.height) ? (screen.height - 400) / 2 : 0;
			settings = 'height=' + 400 + ',width=' + 600 + ',top=' + TopPosition + ',left=' + LeftPosition + ',scrollbars=' + scroll + ',resizable';
			win = window.open(mypage, myname, settings)
		}
	</script>
</head>

<body><?php
		function mutasiurut()
		{
			//include "koneksi.php";	
			// $con=sqlsrv_connect("10.0.0.10","dit","4dm1n","db_qc");	
			include(__DIR__ . '../../koneksi.php');
			date_default_timezone_set("Asia/Jakarta");
			$format = date("y") . "1";
			$sql = sqlsrv_query($con, "SELECT TOP 1 refno FROM db_qc.pergerakan_stok WHERE SUBSTRING(refno,1,3) like '%" . $format . "%'
		ORDER BY refno DESC ") or die("sqlsrv_errors()");
			$d = sqlsrv_num_rows($sql);
			if ($d > 0) {
				$r = sqlsrv_fetch_array($sql);
				$d = $r['refno'];
				$str = SUBSTRING($d, 3, 7);
				$Urut = (int)$str;
			} else {
				$Urut = 0;
			}
			$Urut = $Urut + 1;
			$Nol = "";
			$nilai = 7 - strlen($Urut);
			for ($i = 1; $i <= $nilai; $i++) {
				$Nol = $Nol . "0";
			}
			$nipbr = $format . $Nol . $Urut;
			return $nipbr;
		}
		$nou = mutasiurut();
		#awalan
		$usernm = strtoupper($_SESSION['username']);
		$tglTransaksi 	= isset($_POST['awal']) ? $_POST['awal'] : '';
		$DataKet	= isset($_POST['ket']) ? $_POST['ket'] : '';
		$DataTerima	= isset($_POST['terima']) ? $_POST['terima'] : '';
		$Barcode	= substr($_POST['barcode'], -13);
		$Lokasi		= isset($_POST['lokasi']) ? $_POST['lokasi'] : '';
		if (isset($_POST['btnBatal'])) {
			# Kosongkan Tmp jika datanya sudah dipindah
			$hapusSql = "DELETE FROM db_qc.tmp_detail_pergerakan_stok WHERE transtatus='1' AND userid='" . $usernm . "'";
			sqlsrv_query($con, $hapusSql) or die("Gagal kosongkan tmp");

			// Refresh form
			//echo "<meta http-equiv='refresh' content='0; url=cetak/transaksi_pembelian_cetak.php?noNota=$noTransaksi'>";
			echo "<script>";
			//echo "window.open('../cetak/benang_masuk_cetak.php?noNota=$noTransaksi', width=330,height=330,left=100, top=25)";
			echo "</script>";
			echo "<meta http-equiv='refresh' content='0; url=index1.php?p=kain_masuk_barcode&status=Data Sudah DiBatalkan'>";
		}
		if (isset($_POST['btnTambah'])) {
			# Jika sudah pernah dipilih		
			$cekSql = "SELECT * FROM db_qc.tmp_detail_pergerakan_stok WHERE SN='$Barcode' AND transtatus='1' AND userid='" . $usernm . "'";
			$cekQry = sqlsrv_query($con, $cekSql) or die("Gagal Query");
			$cekSql0 = "SELECT * FROM db_qc.detail_pergerakan_stok WHERE SN='$Barcode' ";
			$cekQry0 = sqlsrv_query($con, $cekSql0) or die("Gagal Query d");
			$cekSql1 = "SELECT * FROM db_qc.detail_pergerakan_stok WHERE SN='$Barcode' AND (transtatus='1' OR transtatus='0') ";
			$cekQry1 = sqlsrv_query($con, $cekSql1) or die("Gagal Query d");
			$cekSql2 = "SELECT * FROM db_qc.detail_pergerakan_stok WHERE SN='$Barcode' AND transtatus='2'";
			$cekQry2 = sqlsrv_query($con, $cekSql2) or die("Gagal Query d");
			$cekSql3 = "SELECT * FROM db_qc.detail_pergerakan_stok WHERE SN='$Barcode' AND sisa='BS'";
			$cekQry3 = sqlsrv_query($con, $cekSql3) or die("Gagal Query d");
			if ((sqlsrv_num_rows($cekQry) >= 1) or (sqlsrv_num_rows($cekQry1) >= 1) or (sqlsrv_num_rows($cekQry2) >= 1) or (sqlsrv_num_rows($cekQry3) >= 1) or (sqlsrv_num_rows($cekQry0) <= 0)) {
				$pesanError = array();
				if (sqlsrv_num_rows($cekQry1) >= 1) {
					$pesanError[] = "<b>Data BARCODE ini <font color='#FF0000'>Sudah MASUK</font> di Gudang KAIN JADI </b> !";
				}
				if (sqlsrv_num_rows($cekQry) >= 1) {
					$pesanError[] = "<b>Data BARCODE <font color='#FF0000'>Sudah ADA </font> di Daftar list ini</b> !";
				}
				if (sqlsrv_num_rows($cekQry0) <= 0) {
					$pesanError[] = "<b>Data BARCODE ini <font color='#FF0000'>Belum Masuk atau Tidak ADA</font> </b> !";
				}
				if (sqlsrv_num_rows($cekQry2) >= 1) {
					$pesanError[] = "<b> dan Data BARCODE ini <font color='#FF0000'>SUDAH KELUAR</font> </b> !";
				}
				if (sqlsrv_num_rows($cekQry3) >= 1) {
					$pesanError[] = "<b> dan Data BARCODE ini <font color='#FF0000'>KAIN BS</font> </b> !";
				}
				# JIKA ADA PESAN ERROR DARI VALIDASI
				if (count($pesanError) >= 1) {
					echo "<div class='mssgBox'>";
					echo "<img src='images/attention.png'> <br><hr>";
					$noPesan = 0;
					foreach ($pesanError as $indeks => $pesan_tampil) {
						$noPesan++;
						echo "&nbsp;&nbsp; $noPesan. $pesan_tampil<br>";
					}
					echo "</div> <br>";
				}
			} else { # Kode benang Baru, membuka tabel benang

				# Cek data di dalam tabel kain, mungkin yang diinput dari form adalah Barcode dan mungkin Kode-nya
				$mySql = "SELECT * FROM db_qc.detail_pergerakan_stok WHERE SN='$Barcode'";
				$myQry = sqlsrv_query($con, $mySql) or die("Gagal Query Tmp 1 ");
				$myRow = sqlsrv_fetch_array($myQry);
				$myQty = sqlsrv_num_rows($myQry);
				if ($myQty >= 1) {
					$ketc = str_replace("'", "''", $myRow['ket_c']);
					// Data yang ditemukan dimasukkan ke keranjang transaksi
					$tmpSql 	= "INSERT INTO db_qc.tmp_detail_pergerakan_stok
				(id_detail_kj,weight,yard_,no_roll,grade,satuan,sisa,SN,ket,nokk,lokasi,ket_c,transtatus,userid) 
							VALUES ('" . $myRow['id_detail_kj'] . "','" . $myRow['weight'] . "','" . $myRow['yard_'] . "','" . $myRow['no_roll'] . "'
							, '" . $myRow['grade'] . "', '" . $myRow['satuan'] . "', '" . $myRow['sisa'] . "', '" . $myRow['SN'] . "', '" . $myRow['ket'] . "', '" . $myRow['nokk'] . "', '" . $_POST['lokasi'] . "', '$ketc','1','" . $usernm . "')";
					sqlsrv_query($con, $tmpSql) or die("Gagal Query tmp 2 : ");
				}
			}
		}

		if (isset($_POST['btnSimpan'])) {

			$pesanError = array();
			if (trim($_POST['awal']) == "") {
				$pesanError[] = "Data <b> TANGGAL</b> belum diisi, pilih pada combo !";
			}
			if (trim($_POST['shift']) == "") {
				$pesanError[] = "Data <b> SHIFT</b> belum diisi, pilih pada combo !";
			}
			/*
	if (trim($_POST['blok'])=="") {
		$pesanError[] = "Data <b>BLOK</b> belum diisi !";		
	}	
	if (trim($_POST['nopo'])=="") {
		$pesanError[] = "Data <b>NO PO</b> belum diisi!";		
	}
	if (trim($_POST['nodo'])=="") {
		$pesanError[] = "Data <b>NO ORDER</b> belum diisi!";		
	} */
			if (trim($_POST['terima']) == "") {
				$pesanError[] = "Data <b>TERIMA KAIN DARI </b> belum diisi, pilih pada combo !";
			}
			# Validasi jika belum ada satupun data item yang dimasukkan
			$tmpSql = "SELECT COUNT(*) As qty FROM db_qc.tmp_detail_pergerakan_stok WHERE transtatus='1' AND userid='" . $usernm . "'";
			$tmpQry = sqlsrv_query($con, $tmpSql) or die("Gagal Query Tmp 3");
			$tmpData = sqlsrv_fetch_array($tmpQry);
			if ($tmpData['qty'] < 1) {
				$pesanError[] = "<b>DAFTAR KAIN JADI KOSONG</b>, Daftar item kain belum ada yang dimasukan, <b>minimal 1 data </b>.";
			}


			# Baca variabel
			$txtKeterangan	= $_POST['ket'];
			$cmbTanggal 	= $_POST['awal'];
			$txtTerima		= $_POST['terima'];
			$txtDok			= $_POST['no_dok'];


			# JIKA ADA PESAN ERROR DARI VALIDASI
			if (count($pesanError) >= 1) {
				echo "<div class='mssgBox'>";
				//echo "<img src='../images/attention.png'> <br><hr>";
				$noPesan = 0;
				foreach ($pesanError as $indeks => $pesan_tampil) {
					$noPesan++;
					echo "&nbsp;&nbsp; $noPesan. $pesan_tampil<br>";
				}
				echo "</div> <br>";
			} else {
				# SIMPAN KE DATABASE
				# Jika jumlah error pesanError tidak ada, maka proses Penyimpanan akan dilakukan

				// Membuat kode Transaksi baru
				// $noTransaksi = buatKode("benang_masuk", "NP");

				// Skrip menyimpan data ke tabel transaksi utama
				$mySql	= "INSERT INTO db_qc.pergerakan_stok SET 
						tgl_update='" . $_POST['awal'] . "',
						blok='" . $_POST['blok'] . "',
						shift='" . $_POST['shift'] . "', 
						ket='$txtKeterangan', 
						typestatus='2',
						typetrans='1',
						sts_stok='Tunggu Kirim',
						fromtoid='$txtTerima',
						refno ='$txtDok',
						userid='" . $usernm . "'";
				sqlsrv_query($con, $mySql) or die("Gagal query 4 ");
				# Ambil semua data benang/benang yang dipilih, berdasarkan user yg login
				$tmpSql1 = "SELECT id  FROM pergerakan_stok WHERE typestatus='2' and userid='" . $usernm . "' ORDER BY id DESC";
				$tmpQry1 = sqlsrv_query($con, $tmpSql1) or die("Gagal Query stok ");
				$tmpData1 = sqlsrv_fetch_array($tmpQry1);
				# Ambil semua data benang/benang yang dipilih, berdasarkan user yg login
				$tmpSql = "SELECT * FROM tmp_detail_pergerakan_stok WHERE userid='" . $usernm . "' AND transtatus='1' ";
				$tmpQry = sqlsrv_query($con, $tmpSql) or die("Gagal Query Tmp 5");
				while ($tmpData = sqlsrv_fetch_array($tmpQry)) {
					$dataBerat 	= $tmpData['weight'];
					$dataYard 	= $tmpData['yard_'];
					$dataKJ 	= $tmpData['id_detail_kj'];
					$dataSatuan	= $tmpData['satuan'];
					$dataGrade	= $tmpData['grade'];
					$dataRol	= $tmpData['no_roll'];
					$dataSN		= $tmpData['SN'];
					$dataKK		= $tmpData['nokk'];
					$dataSisa	= $tmpData['sisa'];
					$dataKetC	= str_replace("'", "''", $tmpData['ket_c']);
					$dataLokasi = $tmpData['lokasi'];
					$dataID		= $tmpData1['id'];

					// Masukkan semua benang/benang dari TMP ke tabel benang_masuk detail
					$itemSql = "INSERT INTO db_qc.detail_pergerakan_stok SET
									id_stok='$dataID', 
									id_detail_kj='$dataKJ', 
									weight='$dataBerat', 
									yard_='$dataYard',
									weight_basic='$dataBerat', 
									yard_basic='$dataYard',
									no_roll='$dataRol',
									status ='1',
									ket_c='$dataKetC',
									nokk ='$dataKK',
									transtatus='1',
									satuan='$dataSatuan',
									grade='$dataGrade',
									sisa='$dataSisa',
									lokasi='$dataLokasi',
									SN='$dataSN'";
					sqlsrv_query($con, $itemSql) or die("Gagal Query item");
				}
				// update ke status ncp
				$qrySts = sqlsrv_query($con, "SELECT count(*) FROM tbl_ncp_qcf WHERE status='Belum OK' and nokk='$dataKK'");
				$StsCk = sqlsrv_num_rows($qrySts);
				if ($StsCk > 0) {
					$sqlupdate = sqlsrv_query($con, "UPDATE db_qc.tbl_ncp_qcf SET
					status='OK',
					tgl_selesai=now(),
					ket='OK dari Scan In GKJ',
					tgl_update=now()
					WHERE status='Belum OK' and nokk='$dataKK'");
				}
				// end update status ncp
				# Kosongkan Tmp jika datanya sudah dipindah
				$hapusSql = "DELETE FROM db_qc.tmp_detail_pergerakan_stok WHERE transtatus='1' AND userid='" . $usernm . "'";
				sqlsrv_query($con, $hapusSql) or die("Gagal kosongkan tmp 6");
				// Refresh form
				//echo "<meta http-equiv='refresh' content='0; url=cetak/transaksi_pembelian_cetak.php?noNota=$noTransaksi'>";
				echo "<script>";
				//echo "window.open('../cetak/benang_masuk_cetak.php?noNota=$noTransaksi', width=330,height=330,left=100, top=25)";
				echo "</script>";
				echo "<meta http-equiv='refresh' content='0; url=index1.php?p=kain_masuk_barcode&kkno=" . $_GET['kkno'] . "&status=Data Sudah Tersimpan'>";
			}
		}


		$data1 = sqlsrv_query($con, "SELECT * FROM db_qc.tbl_kite WHERE nokk='" . $_GET['kkno'] . "'");
		$rowk = sqlsrv_fetch_array($data1);
		?>

	<form action="" method="post" name="form1">
		<fieldset>
			<legend>Data Pokok</legend>
			<div align="center">
				<font color="#FF0000"><?php echo $_GET['status']; ?></font>
			</div>
			<table width="637" border="0" cellpadding="0">
				<tr>
					<td width="20%">No Dokumen</td>
					<td width="1%">:</td>
					<td><input name="no_dok" type="text" id="no_dok" value="<?php echo $nou; ?>" /></td>
				</tr>
				<tr>
					<td>Terima Kain Dari</td>
					<td>:</td>
					<td><select name="terima" id="terima" onchange="window.location='index1.php?p=kain_masuk_barcode&terima='+this.value">
							<option value="">PILIH</option>
							<option value="PACKING" <?php if ('PACKING' == $DataTerima) {
														echo "selected";
													} else {
														if ($_GET['terima'] == "PACKING") {
															echo "selected";
														} else {
															echo "";
														}
													} ?>>PACKING</option>
							<option value="INSPEK MEJA" <?php if ('INSPEK MEJA' == $DataTerima) {
															echo "selected";
														} else {
															if ($_GET['terima'] == "INSPEK MEJA") {
																echo "selected";
															} else {
																echo "";
															}
														} ?>>INSPEK MEJA</option>
							<option value="GANTI STIKER" <?php if ('GANTI STIKER' == $DataTerima) {
																echo "selected";
															} else {
																if ($_GET['terima'] == "GANTI STIKER") {
																	echo "selected";
																} else {
																	echo "";
																}
															} ?>>GANTI STIKER</option>
							<option value="REVISI STIKER" <?php if ('REVISI STIKER' == $DataTerima) {
																echo "selected";
															} else {
																if ($_GET['terima'] == "REVISI STIKER") {
																	echo "selected";
																} else {
																	echo "";
																}
															} ?>>REVISI STIKER</option>
							<option value="POTONG SISA" <?php if ('POTONG SISA' == $DataTerima) {
															echo "selected";
														} else {
															if ($_GET['terima'] == "POTONG SISA") {
																echo "selected";
															} else {
																echo "";
															}
														} ?>>POTONG SISA</option>
							<option value="QC BS" <?php if ('QC BS' == $DataTerima) {
														echo "selected";
													} else {
														if ($_GET['terima'] == "QC BS") {
															echo "selected";
														}
													} ?>>QC BS</option>
							<option value="LAIN" <?php if ('LAIN' == $DataTerima) {
														echo "selected";
													} else {
														if ($_GET['terima'] == "LAIN") {
															echo "selected";
														} else {
															echo "";
														}
													} ?>>LAIN-LAIN</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Tgl Masuk</td>
					<td>:</td>
					<td><label for="nokk">
							<input type="text" id="awal" name="awal" value="<?php echo $tglTransaksi; ?>" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.awal);return false;" />
							<a href="javascript:void(0)" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.awal);return false;"><img src="calender/calender.jpeg" alt="" name="popcal" width="34" height="29" id="popcal" style="border:none" align="absmiddle" border="0" /></a></label></td>
				</tr>
				<?php if ($_GET['terima'] == "GANTI STIKER" or $_GET['terima'] == "POTONG SISA" or $_GET['terima'] == "QC BS") { ?>
					<tr>
						<td>Blok</td>
						<td>:</td>
						<td><label for="blok"></label>
							<input name="blok" type="text" id="blok" size="15" r />
						</td>
					</tr>
				<?Php } ?>
				<tr>
					<td>Shift</td>
					<td>:</td>
					<td><label for="shift"></label>
						<select name="shift" id="shift">
							<option value="">Pilih</option>
							<option value="A">A</option>
							<option value="B">B</option>
							<option value="C">C</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Keterangan</td>
					<td>:</td>
					<td><textarea name="ket" cols="35" rows="2" id="ket"><?php echo $DataKet; ?></textarea></td>
				</tr>
			</table>

		</fieldset>
		<fieldset>
			<legend>Data Kain</legend>
			<table width="100%" border="0" cellpadding="0">
				<tr>
					<td>Lokasi</td>
					<td>:</td>
					<td><select name="lokasi" id="lokasi">
							<option value="">Pilih</option>
							<?php $qryLok = sqlsrv_query($con, "SELECT lokasi FROM db_qc.tbl_lokasi ORDER BY lokasi ASC");
							while ($rLok = sqlsrv_fetch_array($qryLok)) { ?>
								<option value="<?php echo $rLok['lokasi']; ?>" <?php if ($Lokasi == $rLok['lokasi']) {
																					echo "SELECTED";
																				} ?>><?php echo $rLok['lokasi']; ?></option>
							<?php } ?>
						</select><input name="lc" type="button" value="..." onclick="NewWindow('pages/lokasi.php','Data Lokasi','left=100,top=300');" /></td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td width="11%">Barcode</td>
					<td width="1%">:</td>
					<td width="17%"><input type="text" name="barcode" id="barcode" /></td>
					<td width="71%"><button type="submit" value="TAMBAH" style="cursor:pointer;" name="btnTambah"> TAMBAH </button></td>
				</tr>
				<tr>
					<td><button type="submit" style="cursor:pointer;" name="btnSimpan"> SIMPAN </button></td>
					<td>&nbsp;</td>
					<td><button type="submit" style="cursor:pointer;" name="btnBatal" onclick="return confirm('ANDA YAKIN AKAN MEMBATALKAN DATA INI ... ?')"> BATAL </button></td>
					<td></td>
				</tr>
				<tr>
					<td colspan="4"></td>
				</tr>
			</table>
		</fieldset>
		<div class="rol">

			<table width="" border="0" cellpadding="1" cellspacing="1">
				<tr>
					<th bgcolor="#53F440" scope="col">No</th>
					<th bgcolor="#53F440" scope="col">Langganan</th>
					<th bgcolor="#53F440" scope="col">No PO</th>
					<th bgcolor="#53F440" scope="col">NO Order</th>
					<th bgcolor="#53F440" scope="col">Warna</th>
					<th bgcolor="#53F440" scope="col">Lot</th>
					<th bgcolor="#53F440" scope="col">No KK</th>
					<th bgcolor="#53F440" scope="col">No Roll</th>
					<th bgcolor="#53F440" scope="col">Qty (KG)</th>
					<th bgcolor="#53F440" scope="col">Yard</th>
					<th bgcolor="#53F440" scope="col">Grade</th>
					<th bgcolor="#53F440" scope="col">BARCODE</th>
					<th bgcolor="#53F440" scope="col">Ket</th>
					<th bgcolor="#53F440" scope="col">Lokasi</th>
					<th bgcolor="#53F440" scope="col">AKSI</th>

				</tr>
				<?php
				//tambahan
				$data = sqlsrv_query($con, "SELECT a.*,b.pelanggan,b.no_order,b.no_po,b.no_lot,b.warna FROM db_qc.tmp_detail_pergerakan_stok a
	INNER JOIN db_qc.tmp_detail_kite c on c.id=a.id_detail_kj
INNER JOIN db_qc.tbl_kite b ON c.id_kite = b.id WHERE transtatus='1' and a.userid='" . $usernm . "' order by a.no_roll ASC");
				$no = 1;
				while ($rowd = sqlsrv_fetch_array($data)) { ?>
					<?php
					$bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99';
					?>
					<tr bgcolor="<?php echo $bgcolor; ?>">
						<td align="center"><?php echo $no; ?></td>
						<td align="center"><?PHP echo $rowd['pelanggan']; ?></td>
						<td align="center"><?PHP echo $rowd['no_po']; ?></td>
						<td align="center"><?PHP echo $rowd['no_order']; ?></td>
						<td align="center"><?PHP echo $rowd['warna']; ?></td>
						<td align="center"><?PHP echo $rowd['no_lot']; ?></td>
						<td align="center"><?PHP echo $rowd['nokk']; ?></td>
						<td align="center"><?PHP echo $rowd['no_roll']; ?></td>
						<td align="center"><?PHP echo number_format($rowd['weight'], '2', '.', ','); ?></td>
						<td align="center"><?PHP echo number_format($rowd['yard_'], '2', '.', ','); ?></td>
						<td align="center"><?PHP echo $rowd['grade']; ?></td>
						<td align="center"><?PHP echo $rowd['SN']; ?></td>
						<td align="center"><?PHP echo $rowd['sisa']; ?></td>
						<td align="center"><?php echo $rowd['lokasi']; ?><!--<input class="input1" name="lokasi[<?php echo $i; ?>]" type="text" value="<?php echo $rowd['lokasi']; ?>">--></td>
						<td align="center">&nbsp;&nbsp;<a onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA INI ... ?')" href="pages/hapus_tmp.php?nokk=<?PHP echo $rowd['nokk']; ?>&amp;idtmp=<?PHP echo $rowd['id']; ?>">HAPUS</a>&nbsp;&nbsp;</td>

					</tr>
				<?php
					$totalyard = $totalyard + $rowd['yard_'];
					$totalqty = $totalqty + $rowd['weight'];
					$no++;
				} ?>
				<p align="right">
					<font color="red"> </font>
				</p>

				<br /> Total Yard : <?php echo $totalyard; ?><br />
				<b>Total Qty : <?php echo $totalqty; ?></b>
			</table>
		</div>

	</form>
</body>

</html>
<script type="text/javascript">
	document.getElementById('barcode').focus();
</script>