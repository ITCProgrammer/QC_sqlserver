<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PENGIRIMAN</title>
<!-- Copyright 2000-2006 Adobe Macromedia Software LLC and its licensors. All rights reserved. -->
<style>
.rol{
    width: 100%;
    height: 243px;
    overflow: scroll;
}
</style>
<script>

          function ganti()
{     var lprn= document.forms['form2']['jnis'].value;
if(lprn=="BONGKARAN"){
	window.location.href="index1.php?p=kain_keluar_bongkaran_barcode";
	}
}
           </script>
           <script type="text/javascript">
$(function () {
    $('fieldset.CkNokk1').show();
    $('input[name="CkNokk1"]').click(function () {
        if (this.checked) {
            $('fieldset.CkNokk1').hide();

        } else {
            $('fieldset.CkNokk1').show();

        }
    });
});
</script>
</head>

<body><?php
function docno(){
	//include("koneksi.php");
	// $con=sqlsrv_connect("10.0.0.10","dit","4dm1n","db_qc");	
	include(__DIR__ . '../../koneksi.php');
		date_default_timezone_set("Asia/Jakarta");
		$format = date("ymd")."3";
		$sql=sqlsrv_query($con,"SELECT TOP 1 documentno FROM db_qc.pergerakan_stok WHERE SUBSTRING(documentno,1,7) like '%".$format."%'
		ORDER BY documentno DESC ") or die (sqlsrv_errors());
		$d=sqlsrv_num_rows($sql);
		if($d>0){
			$r=sqlsrv_fetch_array($sql);
			$d=$r['documentno'];
			$str=SUBSTRING($d,7,3);
			$Urut = (int)$str;
		}else{
			$Urut = 0;
		}
		$Urut = $Urut + 1;
		$Nol="";
		$nilai=3-strlen($Urut);
		for ($i=1;$i<=$nilai;$i++){
			$Nol= $Nol."0";
		}
		$nipbr =$format.$Nol.$Urut;
		return $nipbr;
}
$nou=docno();
#awalan
$usernm			= strtoupper($_SESSION['username']);
$tglTransaksi 	= isset($_POST['awal']) ? $_POST['awal'] :'' ;
$DataKet		= isset($_POST['ket']) ? $_POST['ket'] : '';
$DataSJ			= isset($_POST['no_dok']) ? $_POST['no_dok'] : '';
$NoList			= isset($_POST['no_list']) ? $_POST['no_list'] : '';
$NoList2		= isset($_POST['no_list2']) ? $_POST['no_list2'] : '';
$NoList3		= isset($_POST['no_list3']) ? $_POST['no_list3'] : '';
$NoList4		= isset($_POST['no_list4']) ? $_POST['no_list4'] : '';
$NoList5		= isset($_POST['no_list5']) ? $_POST['no_list5'] : '';
$NoList6		= isset($_POST['no_list6']) ? $_POST['no_list6'] : '';
$NoList7		= isset($_POST['no_list7']) ? $_POST['no_list7'] : '';
$NoList8		= isset($_POST['no_list8']) ? $_POST['no_list8'] : '';
$NoList9		= isset($_POST['no_list9']) ? $_POST['no_list9'] : '';
$NoList10		= isset($_POST['no_list10']) ? $_POST['no_list10'] : '';
$Barcode		= substr($_POST['barcode'],-13);	
//$DataOrder	= isset($_POST['nodo']) ? $_POST['nodo'] : '';
//$DataNopo		= isset($_POST['nopo']) ? $_POST['nopo'] : '';
//$DataKK		= isset($_POST['nokk']) ? $_POST['nokk'] : '';
//$DataTerima	= isset($_POST['terima']) ? $_POST['terima'] : '';
if(isset($_POST['btnBatal'])){
	# Kosongkan Tmp jika datanya sudah dipindah
		$hapusSql = "DELETE FROM db_qc.tmp_detail_pergerakan_stok WHERE transtatus='2' AND userid='".$usernm."'";
		sqlsrv_query($con,$hapusSql) or die ("Gagal kosongkan tmp".sqlsrv_errors());

		// Refresh form
		//echo "<meta http-equiv='refresh' content='0; url=cetak/transaksi_pembelian_cetak.php?noNota=$noTransaksi'>";
		echo "<script>";
		//echo "window.open('../cetak/benang_masuk_cetak.php?noNota=$noTransaksi', width=330,height=330,left=100, top=25)";
		echo "</script>";
		echo "<meta http-equiv='refresh' content='0; url=index1.php?p=kain_keluar_barcode&status=Data Sudah DiBatalkan'>";
	}
if(isset($_POST['btnTambah'])){

			# Jika sudah pernah dipilih
		$cekSql ="SELECT * FROM db_qc.tmp_detail_pergerakan_stok WHERE SN='$Barcode' AND transtatus='2' AND userid='".$usernm."'";
		$cekQry = sqlsrv_query($con,$cekSql) or die ("Gagal Query".sqlsrv_errors());
		$cekSql1 ="SELECT * FROM db_qc.detail_pergerakan_stok WHERE SN='$Barcode' AND (transtatus='1' or transtatus='0')";
		$cekQry1 = sqlsrv_query($con,$cekSql1) or die ("Gagal Query d".sqlsrv_errors());
		$cekSql0 ="SELECT * FROM db_qc.detail_pergerakan_stok WHERE SN='$Barcode' and transtatus=' '";
		$cekQry0 = sqlsrv_query($con,$cekSql0) or die ("Gagal Query d".sqlsrv_errors());
		$c0=sqlsrv_fetch_array($cekQry0);
		$cekSql2 ="SELECT * FROM db_qc.detail_pergerakan_stok WHERE SN='$Barcode' AND transtatus='2'";
		$cekQry2 = sqlsrv_query($con,$cekSql2) or die ("Gagal Query d".sqlsrv_errors());
		if($NoList!=""){$list=" AND refno='$NoList' ";}
		else if($NoList2!=""){$list=" AND (refno='$NoList' OR refno='$NoList2') ";}
		else if($NoList3!=""){$list=" AND (refno='$NoList' OR refno='$NoList2' OR refno='$NoList3') ";}
		else if($NoList4!=""){$list=" AND (refno='$NoList' OR refno='$NoList2' OR refno='$NoList3' OR refno='$NoList4') ";}
		else if($NoList5!=""){$list=" AND (refno='$NoList' OR refno='$NoList2' OR refno='$NoList3' OR refno='$NoList4' OR refno='$NoList5') ";}
		else if($NoList6!=""){$list=" AND (refno='$NoList' OR refno='$NoList2' OR refno='$NoList3' OR refno='$NoList4' OR refno='$NoList5' OR refno='$NoList6') ";}
		else if($NoList7!=""){$list=" AND (refno='$NoList' OR refno='$NoList2' OR refno='$NoList3' OR refno='$NoList4' OR refno='$NoList5' OR refno='$NoList6' OR refno='$NoList7') ";}
		else if($NoList8!=""){$list=" AND (refno='$NoList' OR refno='$NoList2' OR refno='$NoList3' OR refno='$NoList4' OR refno='$NoList5' OR refno='$NoList6' OR refno='$NoList7' OR refno='$NoList8') ";}
		else if($NoList9!=""){$list=" AND (refno='$NoList' OR refno='$NoList2' OR refno='$NoList3' OR refno='$NoList4' OR refno='$NoList5' OR refno='$NoList6' OR refno='$NoList7' OR refno='$NoList8' OR refno='$NoList9') ";}
		else if($NoList10!=""){$list=" AND (refno='$NoList' OR refno='$NoList2' OR refno='$NoList3' OR refno='$NoList4' OR refno='$NoList5' OR refno='$NoList6' OR refno='$NoList7' OR refno='$NoList8' OR refno='$NoList9' OR refno='$NoList10') ";}
		$cekSql3 ="SELECT * FROM db_qc.detail_pergerakan_stok WHERE SN='$Barcode' AND transtatus='1' $list ";
		$cekQry3 = sqlsrv_query($con,$cekSql3) or die ("Gagal Query d".sqlsrv_errors());
		//if ((sqlsrv_num_rows($cekQry) >= 1)  or (sqlsrv_num_rows($cekQry0)<=1) or (sqlsrv_num_rows($cekQry2)>=1)) {
			if ((sqlsrv_num_rows($cekQry) >= 1) or (sqlsrv_num_rows($cekQry2)>=1) or (sqlsrv_num_rows($cekQry3)==0 AND strpos($_POST['no_list'],"/")==0)) {

			$pesanError = array();
			if(sqlsrv_num_rows($cekQry)>=1){
			$pesanError[] = "<b>Data BARCODE <font color='#FF0000'>Sudah ADA </font> di Daftar list ini</b> !";
			}
			if((sqlsrv_num_rows($cekQry0)==1)){
			$pesanError[] = "<b>Data BARCODE ini <font color='#FF0000'>Belum Masuk atau Belum diSCAN</font> </b> !";
			}
			if((sqlsrv_num_rows($cekQry3)==0 AND strpos($_POST['no_list'],"/")==0)){
			$pesanError[] = "<b><font color='#FF0000'>No Packing List dan Data BARCODE Tidak Sesuai, Harap Dicek Kembali!</font></b>";
			}
			//if((sqlsrv_num_rows($cekQry0)==0)){
			//$pesanError[] = "<b>Data BARCODE ini <font color='#FF0000'>Tidak ADA</font> </b> !";
		//	}
			if(sqlsrv_num_rows($cekQry2)>=1){
			$pesanError[] = "<b>Data BARCODE ini <font color='#FF0000'>SUDAH KELUAR</font> </b> !";
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
	else{# Kode Kain Baru

			# Cek data di dalam tabel Kain, mungkin yang diinput dari form adalah Barcode dan mungkin Kode-nya
			//$mySql ="SELECT * FROM detail_pergerakan_stok WHERE SN='$Barcode' AND transtatus='1'";
			//$myQry = sqlsrv_query($con,$mySql) or die ("Gagal Query Tmp".sqlsrv_errors());
			//$myRow = sqlsrv_fetch_array($myQry);
			//$myQty = sqlsrv_num_rows($myQry); 
			$mySql1 ="SELECT * FROM db_qc.detail_pergerakan_stok WHERE SN='$Barcode' AND transtatus='1'";
			$myQry1 = sqlsrv_query($con,$mySql1) or die ("Gagal Query d".sqlsrv_errors());
			$myRow1 = sqlsrv_fetch_array($myQry1);
			$myQty1 = sqlsrv_num_rows($myQry1);
			if ($myQty1 >= 1) {
				$ketc=str_replace("'","''",$myRow1['ket_c']);
				// Data yang ditemukan dimasukkan ke keranjang transaksi
				$tmpSql 	= "INSERT INTO db_qc.tmp_detail_pergerakan_stok
				(id_detail_kj,weight,yard_,no_roll,grade,satuan,sisa,SN,ket,nokk,ket_c,transtatus,userid)
							VALUES ('$myRow1[id_detail_kj]','$myRow1[weight]','$myRow1[yard_]','$myRow1[no_roll]'
							, '$myRow1[grade]', '$myRow1[satuan]', '$myRow1[sisa]', '$myRow1[SN]', '$myRow1[ket]', '$myRow1[nokk]', '$ketc','2','".$usernm."')";
				sqlsrv_query($con,$tmpSql) or die ("Gagal Query tmp : ".sqlsrv_errors());
			}}
	}

if(isset($_POST['btnSimpan'])){

	$pesanError = array();
	if (trim($_POST['no_dok2'])=="") {
		$pesanError[] = "Data <b>No Dokumen</b> belum diisi !";
	}

	if (trim($_POST['awal'])=="") {
		$pesanError[] = "Data <b> TANGGAL</b> belum diisi, pilih pada combo !";
	}
	if (trim($_POST['shift'])=="") {
		$pesanError[] = "Data <b> SHIFT</b> belum diisi, pilih pada combo !";
	}
	if (trim($_POST['no_list'])=="") {
		$pesanError[] = "Data <b> No Packing List</b> belum diisi!";
	}
	/*
	if (trim($_POST['nopo'])=="") {
		$pesanError[] = "Data <b>NO PO</b> belum diisi!";
	}
	if (trim($_POST['nodo'])=="") {
		$pesanError[] = "Data <b>NO ORDER</b> belum diisi!";
	}
	if (trim($_POST['terima'])=="") {
		$pesanError[] = "Data <b>TERIMA KAIN DARI </b> belum diisi, pilih pada combo !";
	}
	*/
	# Validasi jika belum ada satupun data item yang dimasukkan
	$tmpSql ="SELECT COUNT(*) As qty FROM db_qc.tmp_detail_pergerakan_stok WHERE userid='".$usernm."' AND transtatus='2'";
	$tmpQry = sqlsrv_query($con,$tmpSql) or die ("Gagal Query Tmp".sqlsrv_errors());
	$tmpData = sqlsrv_fetch_array($tmpQry);
	if ($tmpData['qty'] < 1) {
		$pesanError[] = "<b>DAFTAR KAIN JADI KOSONG</b>, Daftar item kain belum ada yang dimasukan, <b>minimal 1 data </b>.";
	}


	# Baca variabel
	$txtKeterangan	= $_POST['ket'];
	$cmbTanggal 	= $_POST['awal'];
	$txtDok			= $_POST['no_dok'];
	$txtNoList		= $_POST['no_list'].",";
	$txtNoList2		= $_POST['no_list2'].",";
	$txtNoList3		= $_POST['no_list3'].",";
	$txtNoList4		= $_POST['no_list4'].",";
	$txtNoList5		= $_POST['no_list5'].",";
	$txtNoList6		= $_POST['no_list6'].",";
	$txtNoList7		= $_POST['no_list7'].",";
	$txtNoList8		= $_POST['no_list8'].",";
	$txtNoList9		= $_POST['no_list9'].",";
	$txtNoList10	= $_POST['no_list10'];


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
	else {
		# SIMPAN KE DATABASE
		# Jika jumlah error pesanError tidak ada, maka proses Penyimpanan akan dilakukan

		// Membuat kode Transaksi baru
		// $noTransaksi = buatKode("benang_masuk", "NP");

		// Skrip menyimpan data ke tabel transaksi utama
		$mySql	= "INSERT INTO db_qc.pergerakan_stok SET
						tgl_update='".$_POST['awal']."',
						documentno='".$nou."',
						tgl_sj='".$_POST['awal']."',
						shift='".$_POST['shift']."',
						ket='$txtKeterangan',
						typestatus='3',
						typetrans='1',
						fromtoid='OUT',
						no_pl='$txtNoList $txtNoList2 $txtNoList3 $txtNoList4 $txtNoList5 $txtNoList6 $txtNoList7 $txtNoList8 $txtNoList9 $txtNoList10',
						no_sj ='$txtDok',
						userid='".$usernm."'";
		sqlsrv_query($con,$mySql) or die ("Gagal query 1 ".sqlsrv_errors());
		# Ambil semua data benang/benang yang dipilih, berdasarkan user yg login
		$tmpSql1 ="SELECT id  FROM db_qc.pergerakan_stok WHERE typestatus='3' and userid='".$usernm."' ORDER BY id DESC" ;
		$tmpQry1 = sqlsrv_query($con,$tmpSql1) or die ("Gagal Query stok ".sqlsrv_errors());
		$tmpData1= sqlsrv_fetch_array($tmpQry1);
		# Ambil semua data benang/benang yang dipilih, berdasarkan user yg login
		$tmpSql ="SELECT * FROM db_qc.tmp_detail_pergerakan_stok WHERE userid='".$usernm."' AND transtatus='2'";
		$tmpQry = sqlsrv_query($con,$tmpSql) or die ("Gagal Query Tmp".sqlsrv_errors());
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
			$dataKetC	= str_replace("'","''",$tmpData['ket_c']);
			$dataID		= $tmpData1['id'];

			// Masukkan semua benang/benang dari TMP ke tabel benang_masuk detail
			$itemSql = "INSERT INTO detail_pergerakan_stok (
						id_stok, 
						id_detail_kj, 
						weight, 
						yard_, 
						no_roll, 
						status, 
						ket_c, 
						nokk, 
						transtatus, 
						satuan, 
						grade, 
						sisa, 
						SN
					) 
					VALUES (
						'$dataID', 
						'$dataKJ', 
						'$dataBerat', 
						'$dataYard', 
						'$dataRol', 
						'2', 
						'$dataKetC', 
						'$dataKK', 
						'2', 
						'$dataSatuan', 
						'$dataGrade', 
						'$dataSisa', 
						'$dataSN'
					)";
			sqlsrv_query($con,$itemSql) or die ("Gagal Query item".sqlsrv_errors());

			$itemSqlU="UPDATE db_qc.detail_pergerakan_stok
								SET transtatus='0'
								where  (transtatus !='2' or transtatus !=NULL)
								and SN='$dataSN'";
			sqlsrv_query($con,$itemSqlU) or die ("Gagal Query Update".sqlsrv_errors());
		}

		# Kosongkan Tmp jika datanya sudah dipindah
		$hapusSql = "DELETE FROM db_qc.tmp_detail_pergerakan_stok WHERE transtatus='2' AND userid='".$usernm."'";
		sqlsrv_query($con,$hapusSql) or die ("Gagal kosongkan tmp".sqlsrv_errors());

		// Refresh form
		//echo "<meta http-equiv='refresh' content='0; url=cetak/transaksi_pembelian_cetak.php?noNota=$noTransaksi'>";
		echo "<script>";
		//echo "window.open('../cetak/benang_masuk_cetak.php?noNota=$noTransaksi', width=330,height=330,left=100, top=25)";
		echo "</script>";
		echo "<meta http-equiv='refresh' content='0; url=index1.php?p=kain_keluar_barcode&status=Data Sudah Tersimpan'>";
	}
}


$data1=sqlsrv_query($con,"SELECT * FROM db_qc.tbl_kite WHERE nokk='".$_GET['kkno']."'");
$rowk=sqlsrv_fetch_array($data1);
?>
<fieldset>
<legend>PILIH DATA KAIN KELUAR</legend>
<form action="" method="post" name="form2">
<table width="637" border="0" cellpadding="0">
  <tr>
    <th width="19%" scope="row">JENIS KELUAR</th>
    <td width="1%">:</td>
    <td width="80%"><label for="jnis"></label>
      <select name="jnis" id="jnis" onchange="ganti()">
        <option value="PENGIRIMAN">PENGIRIMAN</option>
        <option value="BONGKARAN">BONGKARAN</option>
      </select></td>
  </tr>
  <tr>
    <th scope="row">&nbsp;</th>
    <td>&nbsp;</td>
    <td align="right"> <?php if($_SESSION['username']=="GB ADM" or $_SESSION['username']=="GB ADM A" or $_SESSION['username']=="GB ADM B" or $_SESSION['username']=="GB ADM C"){ ?>
    <button type="button" style="cursor:pointer;" name="btnLOT" onclick="window.location.href='?p=kain_keluar_barcode_lot'"> Per LOT </button>
    <?php } ?></td>
  </tr>
</table>

</form>
</fieldset>
<form action="" method="post" name="form1">
<fieldset>
  <legend>Data Pokok</legend>
  <div align="center"><font color="#FF0000"><?php echo $_GET['status'];?></font></div>
      <table width="637" border="0" cellpadding="0">
  <tr>
    <td>No Dokumen</td>
    <td>:</td>
    <td><input name="no_dok2" type="text" id="no_dok2" value="<?php echo $nou; ?>" readonly="readonly"/></td>
  </tr>
  <tr>
    <td width="15%">No Packing List 1</td>
    <td width="1%">:</td>
    <td><input name="no_list" type="text" id="no_list" onchange="window.location='index1.php?p=kain_keluar_barcode_new&barcode=<?php echo $_GET['barcode'];?>&no_list='+this.value" value="<?php echo $_GET['no_list'];?>" required/></td>
  </tr>
  <?php if($_GET['no_list']!=""){?>
  <tr>
    <td width="15%">No Packing List 2</td>
    <td width="1%">:</td>
    <td><input name="no_list2" type="text" id="no_list2" value="<?php echo $_GET['no_list2'];?>" onchange="window.location='index1.php?p=kain_keluar_barcode_new&barcode=<?php echo $_GET['barcode'];?>&no_list=<?php echo $_GET['no_list'];?>&no_list2='+this.value"/></td>
  </tr>
  <?php }
  if($_GET['no_list2']!=""){
  ?>
  <tr>
    <td width="15%">No Packing List 3</td>
    <td width="1%">:</td>
    <td><input name="no_list3" type="text" id="no_list3" value="<?php echo $_GET['no_list3'];?>" onchange="window.location='index1.php?p=kain_keluar_barcode_new&barcode=<?php echo $_GET['barcode'];?>&no_list=<?php echo $_GET['no_list'];?>&no_list2=<?php echo $_GET['no_list2'];?>&no_list3='+this.value"/></td>
  </tr>
  <?php }
  if($_GET['no_list3']!=""){
  ?>
  <tr>
    <td width="15%">No Packing List 4</td>
    <td width="1%">:</td>
    <td><input name="no_list4" type="text" id="no_list4" value="<?php echo $_GET['no_list4'];?>" onchange="window.location='index1.php?p=kain_keluar_barcode_new&barcode=<?php echo $_GET['barcode'];?>&no_list=<?php echo $_GET['no_list'];?>&no_list2=<?php echo $_GET['no_list2'];?>&no_list3=<?php echo $_GET['no_list3'];?>&no_list4='+this.value"/></td>
  </tr>
  <?php }
  if($_GET['no_list4']!=""){
  ?>
  <tr>
    <td width="15%">No Packing List 5</td>
    <td width="1%">:</td>
    <td><input name="no_list5" type="text" id="no_list5" value="<?php echo $_GET['no_list5'];?>" onchange="window.location='index1.php?p=kain_keluar_barcode_new&barcode=<?php echo $_GET['barcode'];?>&no_list=<?php echo $_GET['no_list'];?>&no_list2=<?php echo $_GET['no_list2'];?>&no_list3=<?php echo $_GET['no_list3'];?>&no_list4=<?php echo $_GET['no_list4'];?>&no_list5='+this.value"/></td>
  </tr>
  <?php }
  if($_GET['no_list5']!=""){
  ?>
  <tr>
    <td width="15%">No Packing List 6</td>
    <td width="1%">:</td>
    <td><input name="no_list6" type="text" id="no_list6" value="<?php echo $_GET['no_list6'];?>" onchange="window.location='index1.php?p=kain_keluar_barcode_new&barcode=<?php echo $_GET['barcode'];?>&no_list=<?php echo $_GET['no_list'];?>&no_list2=<?php echo $_GET['no_list2'];?>&no_list3=<?php echo $_GET['no_list3'];?>&no_list4=<?php echo $_GET['no_list4'];?>&no_list5=<?php echo $_GET['no_list5'];?>&no_list6='+this.value"/></td>
  </tr>
  <?php }
  if($_GET['no_list6']!=""){
  ?>
  <tr>
    <td width="15%">No Packing List 7</td>
    <td width="1%">:</td>
    <td><input name="no_list7" type="text" id="no_list7" value="<?php echo $_GET['no_list7'];?>" onchange="window.location='index1.php?p=kain_keluar_barcode_new&barcode=<?php echo $_GET['barcode'];?>&no_list=<?php echo $_GET['no_list'];?>&no_list2=<?php echo $_GET['no_list2'];?>&no_list3=<?php echo $_GET['no_list3'];?>&no_list4=<?php echo $_GET['no_list4'];?>&no_list5=<?php echo $_GET['no_list5'];?>&no_list6=<?php echo $_GET['no_list6'];?>&no_list7='+this.value"/></td>
  </tr>
  <?php }
  if($_GET['no_list7']!=""){
  ?>
  <tr>
    <td width="15%">No Packing List 8</td>
    <td width="1%">:</td>
    <td><input name="no_list8" type="text" id="no_list8" value="<?php echo $_GET['no_list8'];?>" onchange="window.location='index1.php?p=kain_keluar_barcode_new&barcode=<?php echo $_GET['barcode'];?>&no_list=<?php echo $_GET['no_list'];?>&no_list2=<?php echo $_GET['no_list2'];?>&no_list3=<?php echo $_GET['no_list3'];?>&no_list4=<?php echo $_GET['no_list4'];?>&no_list5=<?php echo $_GET['no_list5'];?>&no_list6=<?php echo $_GET['no_list6'];?>&no_list7=<?php echo $_GET['no_list7'];?>&no_list8='+this.value"/></td>
  </tr>
  <?php }
  if($_GET['no_list8']!=""){
  ?>
  <tr>
    <td width="15%">No Packing List 9</td>
    <td width="1%">:</td>
    <td><input name="no_list9" type="text" id="no_list9" value="<?php echo $_GET['no_list9'];?>" onchange="window.location='index1.php?p=kain_keluar_barcode_new&barcode=<?php echo $_GET['barcode'];?>&no_list=<?php echo $_GET['no_list'];?>&no_list2=<?php echo $_GET['no_list2'];?>&no_list3=<?php echo $_GET['no_list3'];?>&no_list4=<?php echo $_GET['no_list4'];?>&no_list5=<?php echo $_GET['no_list5'];?>&no_list6=<?php echo $_GET['no_list6'];?>&no_list7=<?php echo $_GET['no_list7'];?>&no_list8=<?php echo $_GET['no_list8'];?>&no_list9='+this.value"/></td>
  </tr>
  <?php }
  if($_GET['no_list9']!=""){
  ?>
  <tr>
    <td width="15%">No Packing List 10</td>
    <td width="1%">:</td>
    <td><input name="no_list10" type="text" id="no_list10" value="<?php echo $_GET['no_list10'];?>" onchange="window.location='index1.php?p=kain_keluar_barcode_new&barcode=<?php echo $_GET['barcode'];?>&no_list=<?php echo $_GET['no_list'];?>&no_list2=<?php echo $_GET['no_list2'];?>&no_list3=<?php echo $_GET['no_list3'];?>&no_list4=<?php echo $_GET['no_list4'];?>&no_list5=<?php echo $_GET['no_list5'];?>&no_list6=<?php echo $_GET['no_list6'];?>&no_list7=<?php echo $_GET['no_list7'];?>&no_list8=<?php echo $_GET['no_list8'];?>&no_list9=<?php echo $_GET['no_list9'];?>&no_list10='+this.value"/></td>
  </tr>
  <?php } ?>
  <tr>
    <td>Tgl Keluar</td>
    <td>:</td>
    <td><label for="nokk">
      <input type="text" id="awal" name="awal" value="<?php echo $tglTransaksi;?>" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.awal);return false;"/>
      <a href="javascript:void(0)" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.awal);return false;"><img src="calender/calender.jpeg" alt="" name="popcal" width="34" height="29" id="popcal" style="border:none" align="absmiddle" border="0" /></a></label></td>
    </tr>
	<tr>
    <td width="15%">No Surat Jln</td>
    <td width="1%">:</td>
    <td><input name="no_dok" type="text" id="no_dok" value="<?php echo $DataSJ; ?>"/></td>
    </tr>
  <tr>
    <td>Shift</td>
    <td>:</td>
    <td><label for="shift"></label>
      <select name="shift" id="shift">
        <option value="">Pilih</option>
        <option value="A">A</option>
        <option value="B">B</option>
        <option value="C">C</option>
      </select></td>
  </tr>
  <tr>
    <td>Keterangan</td>
    <td>:</td>
    <td><textarea name="ket" cols="35" rows="2" id="ket" ><?php echo $DataKet; ?></textarea></td>
  </tr>
  </table>

</fieldset>
<fieldset>
  <legend>Data Kain</legend>
  <table width="100%" border="0" cellpadding="0">
  <tr>
    <td width="11%">Barcode</td>
    <td width="1%">:</td>
    <td width="17%"><input type="text" name="barcode" id="barcode" value="<?php echo $_GET['barcode'];?>" onchange="window.location='index1.php?p=kain_keluar_barcode_new&barcode='+this.value"/></td>
    <td width="71%"><button type="submit" value="TAMBAH" style="cursor:pointer;" name="btnTambah"> TAMBAH </button></td>
  </tr>
  <tr>
    <td><button type="submit" style="cursor:pointer;" name="btnSimpan"> SIMPAN </button></td>
    <td>&nbsp;</td>
    <td><button type="submit" style="cursor:pointer;" name="btnBatal" onclick="return confirm('ANDA YAKIN AKAN MENBATALKAN DATA INI ... ?')"> BATAL </button></td>
    <td><a href="index1.php?p=data_kain_keluar_barcode">Ubah Kain Keluar</a>
    </td>
  </tr>
  <tr>
    <td colspan="4"></td>
  </tr>
  </table></fieldset>
  <div class="rol">
    <table width="" border="0" cellpadding="1" cellspacing="1">
      <tr>
        <th  bgcolor="#53F440" scope="col">No</th>
        <th  bgcolor="#53F440" scope="col">Langganan</th>
        <th  bgcolor="#53F440" scope="col">No PO</th>
        <th  bgcolor="#53F440" scope="col">No Order</th>
        <th  bgcolor="#53F440" scope="col">Warna</th>
        <th  bgcolor="#53F440" scope="col">Lot</th>
        <th  bgcolor="#53F440" scope="col">No KK</th>
        <th  bgcolor="#53F440" scope="col">No Roll</th>
        <th  bgcolor="#53F440" scope="col">Qty (KG)</th>
        <th  bgcolor="#53F440" scope="col">Yard</th>
        <th  bgcolor="#53F440" scope="col">Grade</th>
        <th  bgcolor="#53F440" scope="col">BARCODE</th>
        <th  bgcolor="#53F440" scope="col">Ket</th>
        <th  bgcolor="#53F440" scope="col">AKSI</th>
      </tr>
      <?php
	//tambahan
	$data=sqlsrv_query($con,"SELECT a.*,b.no_order,b.no_po,b.pelanggan,b.no_lot,b.warna FROM db_qc.tmp_detail_pergerakan_stok a
	INNER JOIN db_qc.tmp_detail_kite c on c.id=a.id_detail_kj
INNER JOIN db_qc.tbl_kite b ON c.id_kite = b.id WHERE a.transtatus='2' and a.userid='".$usernm."' order by a.no_roll ASC");
	$no=1;
	 while($rowd=sqlsrv_fetch_array($data)){?>
      <?php
	 $bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99';
	 ?>
      <tr bgcolor="<?php echo $bgcolor; ?>">
        <td align="center" ><?php echo $no; ?></td>
        <td align="center" ><?PHP echo $rowd['pelanggan']; ?></td>
        <td align="center" ><?PHP echo $rowd['no_po']; ?></td>
        <td align="center" ><?PHP echo $rowd['no_order']; ?></td>
        <td align="center" ><?PHP echo $rowd['warna']; ?></td>
        <td align="center" ><?PHP echo $rowd['no_lot']; ?></td>
        <td align="center" ><?PHP echo $rowd['nokk']; ?></td>
        <td align="center" ><?PHP echo $rowd['no_roll']; ?></td>
        <td align="center" ><?PHP echo number_format($rowd['weight'],'2','.',','); ?></td>
        <td align="center" ><?PHP echo number_format($rowd['yard_'],'2','.',','); ?></td>
        <td align="center" ><?PHP echo $rowd['grade']; ?></td>
        <td align="center" ><?PHP echo $rowd['SN']; ?></td>
        <td align="center" ><?PHP echo $rowd['sisa']; ?></td>
        <td align="center" >&nbsp;&nbsp;<a  onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA INI ... ?')" href="pages/hapus_tmp_b.php?nokk=<?PHP echo $rowd['nokk']; ?>&amp;idtmp=<?PHP echo $rowd['id']; ?>">HAPUS</a>&nbsp;&nbsp;</td>
      </tr>
      <?php
	$totalyard=$totalyard+$rowd['yard_'];
	$totalqty=$totalqty+$rowd['weight'];
	$no++;}?>
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
