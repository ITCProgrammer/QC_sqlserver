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
</head>

<body><?php
		function docno()
		{
			//include("koneksi.php");
			// $con=sqlsrv_connect("10.0.0.10","dit","4dm1n","db_qc");	
			include(__DIR__ . '../../koneksi.php');
			date_default_timezone_set("Asia/Jakarta");
			$format = date("y");
			$sql = sqlsrv_query($con, "SELECT documentno FROM db_qc.pergerakan_stok WHERE SUBSTRING(documentno,1,2) like '%" . $format . "%'
		ORDER BY documentno DESC ") or die(sqlsrv_errors());
			$d = sqlsrv_num_rows($sql);
			if ($d > 0) {
				$r = sqlsrv_fetch_array($sql);
				$d = $r['refno'];
				$str = SUBSTRING($d, 2, 5);
				$Urut = (int)$str;
			} else {
				$Urut = 0;
			}
			$Urut = $Urut + 1;
			$Nol = "";
			$nilai = 5 - strlen($Urut);
			for ($i = 1; $i <= $nilai; $i++) {
				$Nol = $Nol . "0";
			}
			$nipbr = $format . $Nol . $Urut;
			return $nipbr;
		}
		$nou = docno();
		#awalan
		$tglTransaksi 	= isset($_POST['awal']) ? $_POST['awal'] : '';
		$DataKet	= isset($_POST['ket']) ? $_POST['ket'] : '';
		$DataSJ	= isset($_POST['no_dok']) ? $_POST['no_dok'] : '';
		if (isset($_POST['btnSimpan'])) {

			$pesanError = array();
			if (trim($_POST['no_dok2']) == "") {
				$pesanError[] = "Data <b>No Dokumen</b> belum diisi !";
			}
			if (trim($_POST['awal']) == "") {
				$pesanError[] = "Data <b> TANGGAL</b> belum diisi, pilih pada combo !";
			}
			# Baca variabel
			$txtKeterangan	= $_POST['ket'];
			$cmbTanggal 	= $_POST['awal'];
			$txtDok			= $_POST['no_dok'];
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
			} else {
				# UBAH KE DATABASE


				// Skrip mengubah data ke tabel transaksi utama
				$mySql	= "UPDATE db_qc.pergerakan_stok SET 
						tgl_sj='$cmbTanggal',
						tgl_update='$cmbTanggal', 
						ket='$txtKeterangan',
						no_sj ='$txtDok'
						WHERE documentno='" . $_POST['no_dok2'] . "'";
				sqlsrv_query($con, $mySql) or die("Gagal query 1 " . sqlsrv_errors());

				// Refresh form
				//echo "<meta http-equiv='refresh' content='0; url=cetak/transaksi_pembelian_cetak.php?noNota=$noTransaksi'>";
				echo "<script>";
				//echo "window.open('../cetak/benang_masuk_cetak.php?noNota=$noTransaksi', width=330,height=330,left=100, top=25)";
				echo "</script>";
				echo "<meta http-equiv='refresh' content='0; url=index1.php?p=data_kain_keluar_barcode&dmno=" . $_POST['no_dok2'] . "&status=Data Sudah Tersimpan'>";
			}
		}

		if ($_GET['dmno'] != "") {
			$data1 = sqlsrv_query($con, "SELECT * FROM db_qc.pergerakan_stok WHERE documentno='" . $_GET['dmno'] . "'");
			$rowk = sqlsrv_fetch_array($data1);
		}
		?>

	<form action="" method="post" name="form1">
		<fieldset>
			<legend>UBAH Data Pokok Kain Jadi Keluar</legend>
			<div align="center">
				<font color="#FF0000"><?php echo $_GET['status']; ?></font>
			</div>
			<table width="637" border="0" cellpadding="0">
				<tr>
					<td>No Dokumen</td>
					<td>:</td>
					<td><input name="no_dok2" type="text" id="no_dok2" value="<?php echo $_GET['dmno']; ?>" onchange="window.location='index1.php?p=data_kain_keluar_barcode&amp;dmno='+this.value" /></td>
				</tr>
				<tr>
					<td width="15%">No Surat Jln</td>
					<td width="1%">:</td>
					<td><input name="no_dok" type="text" id="no_dok" value="<?php echo $rowk['no_sj']; ?>" /></td>
				</tr>
				<tr>
					<td>Tgl Keluar</td>
					<td>:</td>
					<td><label for="nokk">
							<input type="text" id="awal" name="awal" value="<?php if ($rowk['tgl_sj'] != "") {
																				echo date("Y-m-d", strtotime($rowk['tgl_sj']));
																			} ?>" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.awal);return false;" />
							<a href="javascript:void(0)" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.awal);return false;"><img src="calender/calender.jpeg" alt="" name="popcal" width="34" height="29" id="popcal" style="border:none" align="absmiddle" border="0" /></a></label></td>
				</tr>
				<tr>
					<td>Keterangan</td>
					<td>:</td>
					<td><textarea name="ket" cols="35" rows="2" id="ket"><?php echo $rowk['ket']; ?></textarea></td>
				</tr>
				<tr>
					<td><input type="submit" name="btnSimpan" id="btnSimpan" value="SIMPAN" /></td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
			</table>

		</fieldset>

		<div class="rol">
			<table width="" border="1" cellpadding="2" cellspacing="3">
				<tr>
					<th bgcolor="#9966CC" scope="col">No</th>
					<th bgcolor="#9966CC" scope="col">No KK</th>
					<th bgcolor="#9966CC" scope="col">No Roll</th>
					<th bgcolor="#9966CC" scope="col">Qty (KG)</th>
					<th bgcolor="#9966CC" scope="col">Yard</th>
					<th bgcolor="#9966CC" scope="col">Grade</th>
					<th bgcolor="#9966CC" scope="col">BARCODE</th>
					<th bgcolor="#9966CC" scope="col">Ket</th>
					<th bgcolor="#9966CC" scope="col">AKSI</th>
				</tr>
				<?php
				//tambahan
				$data = sqlsrv_query($con, "SELECT
	*
FROM
	db_qc.pergerakan_stok
LEFT JOIN db_qc.detail_pergerakan_stok ON pergerakan_stok.id = detail_pergerakan_stok.id_stok
WHERE
	transtatus = '2'
AND documentno = '" . $_GET['dmno'] . "'
ORDER BY
	no_roll ASC");
				$no = 1;
				while ($rowd = sqlsrv_fetch_array($data)) { ?>
					<?php
					$bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99';
					?>
					<tr bgcolor="<?php echo $bgcolor; ?>">
						<td align="center"><?php echo $no; ?></td>
						<td align="center"><?PHP echo $rowd['nokk']; ?></td>
						<td align="center"><?PHP echo $rowd['no_roll']; ?></td>
						<td align="center"><?PHP echo number_format($rowd['weight'], '2', '.', ','); ?></td>
						<td align="center"><?PHP echo number_format($rowd['yard_'], '2', '.', ','); ?></td>
						<td align="center"><?PHP echo $rowd['grade']; ?></td>
						<td align="center"><?PHP echo $rowd['SN']; ?></td>
						<td align="center"><?PHP echo $rowd['sisa']; ?></td>
						<td align="center">&nbsp;&nbsp;<a onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA INI ... ?')" href="#">HAPUS</a>&nbsp;&nbsp;</td>
					</tr>
				<?php
					$totalyard = $totalyard + $rowd['yard_'];
					$totalqty = $totalqty + $rowd['weight'];
					$no++;
				} ?>
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