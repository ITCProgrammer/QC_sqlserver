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
.rol{
    width: 100%;
    height: 243px;
    overflow: scroll;
} 
</style>
</head>

<body><?php
function mutasiurut(){
		date_default_timezone_set("Asia/Jakarta");
		$format = date("y")."1";
		$sql=mysql_query("SELECT refno FROM pergerakan_stok WHERE substr(refno,1,3) like '%".$format."%'
		ORDER BY refno DESC LIMIT 1 ") or die (mysql_error());
		$d=mysql_num_rows($sql);
		if($d>0){
			$r=mysql_fetch_array($sql);
			$d=$r['refno'];
			$str=substr($d,3,7);
			$Urut = (int)$str;
		}else{
			$Urut = 0;
		}
		$Urut = $Urut + 1;
		$Nol="";
		$nilai=7-strlen($Urut);
		for ($i=1;$i<=$nilai;$i++){
			$Nol= $Nol."0";
		}
		$nipbr =$format.$Nol.$Urut;
		return $nipbr;
}
$nou=mutasiurut();
#awalan
$usernm=strtoupper($_SESSION['username']);
$tglTransaksi 	= isset($_POST['awal']) ? $_POST['awal'] :'' ;
$DataKet	= isset($_POST['ket']) ? $_POST['ket'] : '';
$DataTerima	= isset($_POST['terima']) ? $_POST['terima'] : '';
$Barcode		= substr($_POST[barcode],-13);	

if(isset($_POST['btnBatal'])){
	# Kosongkan Tmp jika datanya sudah dipindah
		$hapusSql = "DELETE FROM tmp_detail_pergerakan_stok WHERE transtatus='11' AND userid='".$usernm."'";
		mysql_query($hapusSql) or die ("Gagal kosongkan tmp".mysql_error());
		
		// Refresh form
		//echo "<meta http-equiv='refresh' content='0; url=cetak/transaksi_pembelian_cetak.php?noNota=$noTransaksi'>";
		echo "<script>";
		//echo "window.open('../cetak/benang_masuk_cetak.php?noNota=$noTransaksi', width=330,height=330,left=100, top=25)";
		echo "</script>";
		echo "<meta http-equiv='refresh' content='0; url=index1.php?p=kain_bs_masuk_barcode&status=Data Sudah DiBatalkan'>";
	}
if(isset($_POST['btnTambah'])){
		# Jika sudah pernah dipilih		
		$cekSql ="SELECT * FROM tmp_detail_pergerakan_stok WHERE SN='$Barcode' AND transtatus='11' AND userid='".$usernm."'"; 
		$cekQry = mysql_query($cekSql) or die ("Gagal Query".mysql_error());
		$cekSql0 ="SELECT * FROM detail_pergerakan_stok WHERE SN='$Barcode' "; 
		$cekQry0 = mysql_query($cekSql0) or die ("Gagal Query d".mysql_error());
		$cekSql1 ="SELECT * FROM detail_pergerakan_stok WHERE SN='$Barcode' AND (transtatus='11' OR transtatus='10') "; 
		$cekQry1 = mysql_query($cekSql1) or die ("Gagal Query d".mysql_error());
		$cekSql2 ="SELECT * FROM detail_pergerakan_stok WHERE SN='$Barcode' AND transtatus='12'"; 
		$cekQry2 = mysql_query($cekSql2) or die ("Gagal Query d".mysql_error());
		$cekSql3 ="SELECT * FROM detail_pergerakan_stok WHERE SN='$Barcode' AND sisa='BS' or sisa='STOCK' "; 
		$cekQry3 = mysql_query($cekSql3) or die ("Gagal Query d".mysql_error());
		if ((mysql_num_rows($cekQry) >= 1) or (mysql_num_rows($cekQry1) >= 1) or (mysql_num_rows($cekQry2)>=1) or (mysql_num_rows($cekQry3)<=0) or (mysql_num_rows($cekQry0)<=0)) {
			$pesanError = array();
			if(mysql_num_rows($cekQry1)>=1){
			$pesanError[] = "<b>Data BARCODE ini <font color='#FF0000'>Sudah MASUK</font> di Gudang KAIN BS </b> !";		
			}
			if(mysql_num_rows($cekQry)>=1){
			$pesanError[] = "<b>Data BARCODE <font color='#FF0000'>Sudah ADA </font> di Daftar list ini</b> !";		
			}
			if(mysql_num_rows($cekQry0)<=0){
			$pesanError[] = "<b>Data BARCODE ini <font color='#FF0000'>Belum Masuk atau Tidak ADA</font> </b> !";		
			}
			if(mysql_num_rows($cekQry2)>=1){
			$pesanError[] = "<b> dan Data BARCODE ini <font color='#FF0000'>SUDAH KELUAR</font> </b> !";		
			}
			if(mysql_num_rows($cekQry3)<=0){
			$pesanError[] = "<b> dan Data BARCODE ini <font color='#FF0000'>BUKAN KAIN BS</font> </b> !";		
			}
			# JIKA ADA PESAN ERROR DARI VALIDASI
			if (count($pesanError)>=1 ){
			echo "<div class='mssgBox'>";
			echo "<img src='images/attention.png'> <br><hr>";
			$noPesan=0;
			foreach ($pesanError as $indeks=>$pesan_tampil) { 
			$noPesan++;
				echo "&nbsp;&nbsp; $noPesan. $pesan_tampil<br>";	
			} 
			echo "</div> <br>"; 
			}
				
			}
		else{# Kode benang Baru, membuka tabel benang

			# Cek data di dalam tabel kain, mungkin yang diinput dari form adalah Barcode dan mungkin Kode-nya
			$mySql ="SELECT * FROM detail_pergerakan_stok WHERE SN='$Barcode'";
			$myQry = mysql_query($mySql) or die ("Gagal Query Tmp 1 ".mysql_error());
			$myRow = mysql_fetch_array($myQry);
			$myQty = mysql_num_rows($myQry);
			if ($myQty >= 1) {
				
				// Data yang ditemukan dimasukkan ke keranjang transaksi
				$tmpSql 	= "INSERT INTO tmp_detail_pergerakan_stok
				(id_detail_kj,weight,yard_,no_roll,grade,satuan,sisa,SN,ket,nokk,ket_c,transtatus,userid) 
							VALUES ('$myRow[id_detail_kj]','$myRow[weight]','$myRow[yard_]','$myRow[no_roll]'
							, '$myRow[grade]', '$myRow[satuan]', '$myRow[sisa]', '$myRow[SN]', '$myRow[ket]', '$myRow[nokk]', '$myRow[ket_c]','11','".$usernm."')";
				mysql_query($tmpSql) or die ("Gagal Query tmp 2 : ".mysql_error());
			}}
	}

if(isset($_POST['btnSimpan'])){
	
	$pesanError = array();
	if (trim($_POST['awal'])=="") {
		$pesanError[] = "Data <b> TANGGAL</b> belum diisi, pilih pada combo !";		
	}
	
	if (trim($_POST['terima'])=="") {
		$pesanError[] = "Data <b>TERIMA KAIN DARI </b> belum diisi, pilih pada combo !";		
	}
	# Validasi jika belum ada satupun data item yang dimasukkan
	$tmpSql ="SELECT COUNT(*) As qty FROM tmp_detail_pergerakan_stok WHERE transtatus='11' AND userid='".$usernm."'";
	$tmpQry = mysql_query($tmpSql) or die ("Gagal Query Tmp 3".mysql_error());
	$tmpData = mysql_fetch_array($tmpQry);
	if ($tmpData['qty'] < 1) {
		$pesanError[] = "<b>DAFTAR KAIN BS KOSONG</b>, Daftar item kain belum ada yang dimasukan, <b>minimal 1 data </b>.";
	}


	# Baca variabel
	$txtKeterangan	= $_POST['ket'];
	$cmbTanggal 	= $_POST['awal'];
	$txtTerima		= $_POST['terima'];	
	$txtDok			= $_POST['no_dok'];		

			
	# JIKA ADA PESAN ERROR DARI VALIDASI
	if (count($pesanError)>=1 ){
		echo "<div class='mssgBox'>";
		//echo "<img src='../images/attention.png'> <br><hr>";
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
		$mySql	= "INSERT INTO pergerakan_stok SET 
						tgl_update='".$_POST['awal']."', 
						ket='$txtKeterangan', 
						typestatus='12',
						typetrans='11',
						fromtoid='$txtTerima',
						refno ='$txtDok',
						userid='".$usernm."'";
		mysql_query($mySql) or die ("Gagal query 4 ".mysql_error());
		# Ambil semua data benang/benang yang dipilih, berdasarkan user yg login
		$tmpSql1 ="SELECT id  FROM pergerakan_stok WHERE typestatus='12' and userid='".$usernm."' ORDER BY id DESC" ;
		$tmpQry1 = mysql_query($tmpSql1) or die ("Gagal Query stok ".mysql_error());
		$tmpData1= mysql_fetch_array($tmpQry1);
		# Ambil semua data benang/benang yang dipilih, berdasarkan user yg login
		$tmpSql ="SELECT * FROM tmp_detail_pergerakan_stok WHERE userid='".$usernm."' AND transtatus='11' ";
		$tmpQry = mysql_query($tmpSql) or die ("Gagal Query Tmp 5".mysql_error());
		while ($tmpData = mysql_fetch_array($tmpQry)) {
			$dataBerat 	= $tmpData['weight'];
			$dataYard 	= $tmpData['yard_'];
			$dataKJ 	= $tmpData['id_detail_kj'];
			$dataSatuan	= $tmpData['satuan'];
			$dataGrade	= $tmpData['grade'];
			$dataRol	= $tmpData['no_roll'];
			$dataSN		= $tmpData['SN'];
			$dataKK		= $tmpData['nokk'];
			$dataSisa	= $tmpData['sisa'];
			$dataKetC	= $tmpData['ket_c'];
			$dataID		= $tmpData1['id'];
			
			// Masukkan semua benang/benang dari TMP ke tabel benang_masuk detail
			$itemSql = "INSERT INTO detail_pergerakan_stok SET
									id_stok='$dataID', 
									id_detail_kj='$dataKJ', 
									weight='$dataBerat', 
									yard_='$dataYard',
									no_roll='$dataRol',
									status ='1',
									ket_c='$dataKetC',
									nokk ='$dataKK',
									transtatus='11',
									satuan='$dataSatuan',
									grade='$dataGrade',
									sisa='$dataSisa',
									SN='$dataSN'";
			mysql_query($itemSql) or die ("Gagal Query item".mysql_error());
		}
		
		# Kosongkan Tmp jika datanya sudah dipindah
		$hapusSql = "DELETE FROM tmp_detail_pergerakan_stok WHERE transtatus='11' AND userid='".$usernm."'";
		mysql_query($hapusSql) or die ("Gagal kosongkan tmp 6".mysql_error());
		
		// Refresh form
		//echo "<meta http-equiv='refresh' content='0; url=cetak/transaksi_pembelian_cetak.php?noNota=$noTransaksi'>";
		echo "<script>";
		//echo "window.open('../cetak/benang_masuk_cetak.php?noNota=$noTransaksi', width=330,height=330,left=100, top=25)";
		echo "</script>";
		echo "<meta http-equiv='refresh' content='0; url=index1.php?p=kain_bs_masuk_barcode&kkno=$_GET[kkno]&status=Data Sudah Tersimpan'>";
	}	
}


$data1=mysql_query("SELECT * FROM tbl_kite WHERE nokk='".$_GET['kkno']."'");
$rowk=mysql_fetch_array($data1);
?>

<form action="" method="post" name="form1">
<fieldset>
  <legend>Data Pokok</legend>
  <div align="center"><font color="#FF0000"><?php echo $_GET['status'];?></font></div>
      <table width="637" border="0" cellpadding="0">
  <tr>
    <td width="20%">No Dokumen</td>
    <td width="1%">:</td>
    <td><input name="no_dok" type="text" id="no_dok" value="<?php echo $nou; ?>"/></td>
    </tr>
  <tr>
    <td>Tgl Masuk</td>
    <td>:</td>
    <td><label for="nokk">
      <input type="text" id="awal" name="awal" value="<?php echo $tglTransaksi;?>"onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.awal);return false;"/>
      <a href="javascript:void(0)" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.awal);return false;"><img src="calender/calender.jpeg" alt="" name="popcal" width="34" height="29" id="popcal" style="border:none" align="absmiddle" border="0" /></a></label></td>
    </tr>
  <tr>
    <td>Terima Kain Dari</td>
    <td>:</td>
    <td><select name="terima" id="terima">
      <option value="">PILIH</option>
      <option value="PACKING"  <?php if ('PACKING'== $DataTerima) {echo "selected";}else{ echo "";}?>>PACKING</option>
      <option value="INSPEK MEJA" <?php if ('INSPEK MEJA'== $DataTerima) {echo "selected";}else{ echo "";}?>>INSPEK MEJA</option>
      <option value="LAIN" <?php if ('LAIN'== $DataTerima) {echo "selected";}else{ echo "";}?>>LAIN-LAIN</option>
    </select>
    </td>
    </tr>
  <tr>
    <td>Keterangan</td>
    <td>:</td>
    <td><textarea name="ket" cols="35" rows="2" id="ket" ><?php echo $DataKet; ?></textarea></td>
  </tr>
  </table>

</fieldset>      
<fieldset>
  <legend>Data Kain BS</legend>
  <table width="100%" border="0" cellpadding="0">
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
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4"></td>
  </tr>
  </table></fieldset>
  <div class="rol">
  
  <table width="" border="0" cellpadding="1" cellspacing="1">
    <tr>
      <th  bgcolor="#9966CC" scope="col">No</th>
      <th  bgcolor="#9966CC" scope="col">No KK</th>
      <th  bgcolor="#9966CC" scope="col">NO Order</th>
      <th  bgcolor="#9966CC" scope="col">No PO</th>
      <th  bgcolor="#9966CC" scope="col">Warna</th>
      <th  bgcolor="#9966CC" scope="col">No Roll</th>
      <th  bgcolor="#9966CC" scope="col">Qty (KG)</th>
      <th  bgcolor="#9966CC" scope="col">Yard</th>
      <th  bgcolor="#9966CC" scope="col">Grade</th>
      <th  bgcolor="#9966CC" scope="col">BARCODE</th>
      <th  bgcolor="#9966CC" scope="col">Ket</th>
      <th  bgcolor="#9966CC" scope="col">AKSI</th>
      
    </tr>
    <?php
	//tambahan
	$data=mysql_query("SELECT a.*,b.no_po,b.no_order,b.warna FROM tmp_detail_pergerakan_stok a
	INNER JOIN tmp_detail_kite c on c.id=a.id_detail_kj
INNER JOIN tbl_kite b ON c.id_kite = b.id WHERE transtatus='11' and a.userid='".$usernm."' and (c.sisa='BS' or c.sisa='STOCK')  order by a.no_roll ASC");
	$no=1;
	 while($rowd=mysql_fetch_array($data)){?>
    <?php  
	 $bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99';
	 ?>
    <tr bgcolor="<?php echo $bgcolor; ?>">
      <td align="center" ><?php echo $no; ?></td>
      <td align="center" ><?PHP echo $rowd['nokk']; ?></td>
      <td align="center" ><?PHP echo $rowd['no_order']; ?></td>
      <td align="center" ><?PHP echo $rowd['no_po']; ?></td>
      <td align="center" ><?PHP echo $rowd['warna']; ?></td>
      <td align="center" ><?PHP echo $rowd['no_roll']; ?></td>
      <td align="center" ><?PHP echo number_format($rowd['weight'],'2','.',','); ?></td>
      <td align="center" ><?PHP echo number_format($rowd['yard_'],'2','.',','); ?></td>
      <td align="center" ><?PHP echo $rowd['grade']; ?></td>
      <td align="center" ><?PHP echo $rowd['SN']; ?></td>
      <td align="center" ><?PHP echo $rowd['sisa']; ?></td>
      <td align="center" >&nbsp;&nbsp;<a  onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA INI ... ?')" href="pages/hapus_tmp.php?nokk=<?PHP echo $rowd['nokk']; ?>&amp;idtmp=<?PHP echo $rowd['id']; ?>&amp;bs=1">HAPUS</a>&nbsp;&nbsp;</td>
      
    </tr>
    <?php 
	$totalyard=$totalyard+$rowd['yard_'];
	$totalqty=$totalqty+$rowd['weight'];
	$no++;}?>
    <p align="right"><font color="red"> </font></p>
    
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
