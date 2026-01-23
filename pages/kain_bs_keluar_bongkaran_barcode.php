<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>BONGKARAN</title>
<style>
.rol{
    width: 100%;
    height: 243px;
    overflow: scroll;
} 
</style>
<script>
function ganti(){     
	var lprn= document.forms['form2']['jnis'].value;  
	if(lprn=="PENGIRIMAN"){
	window.location.href="index1.php?p=kain_bs_keluar_barcode";}
}
</script>  
</head>

<body>
<?php
	function docno(){
	$con=sqlsrv_connect("10.0.0.10","dit","4dm1n","db_qc");	
	date_default_timezone_set("Asia/Jakarta");
	$format = date("y");
	$sql=mysql_query("SELECT documentno FROM pergerakan_stok WHERE substr(documentno,1,2) like '%".$format."%'
	ORDER BY documentno DESC LIMIT 1 ") or die (mysql_error());
	$d=mysql_num_rows($sql);
	if($d>0){
			$r=mysql_fetch_array($sql);
			$d=$r['documentno'];
			$str=substr($d,2,5);
			$Urut = (int)$str;
	}else{
		$Urut = 0;}
	$Urut = $Urut + 1;
	$Nol="";
	$nilai=5-strlen($Urut);
	for ($i=1;$i<=$nilai;$i++){
			$Nol= $Nol."0";
		}
	$nipbr =$format.$Nol.$Urut;
	return $nipbr;
	}
	$nou=docno();
	function sn(){
	$qtgl=mysql_query("select DATE_FORMAT(now(),'%y') as tgl");
	$dttgll=mysql_fetch_array($qtgl);
	$format = $dttgll['tgl']."2";
	$sql=mysql_query("SELECT SN FROM detail_pergerakan_stok 
	WHERE substr(SN,1,3) like '%".$format."%' ORDER BY SN DESC LIMIT 1 ") or die (mysql_error());
	$d=mysql_num_rows($sql);
	if($d>0){
	$r=mysql_fetch_array($sql);
	$d=$r['SN'];
	$str=substr($d,3,10);
	$Urut = (int)$str;
	}else{
	$Urut = 0;
	}
	$Urut = $Urut + 3;
	$Nol="";
	$nilai=10-strlen($Urut);
	for ($i=1;$i<=$nilai;$i++){
	$Nol= $Nol."0";	
	}
	$snbr =$format.$Nol.$Urut;
	return $snbr;
	}
	$snkain=sn();

#awalan
$usernm=strtoupper($_SESSION['username']);
$tglTransaksi 	= isset($_POST['awal']) ? $_POST['awal'] :'' ;
$DataKet	= isset($_POST['ket']) ? $_POST['ket'] : '';
$DataSJ	= isset($_POST['no_dok']) ? $_POST['no_dok'] : '';
if(isset($_POST['btnBatal'])){ #AWAL
	# Kosongkan Tmp jika datanya sudah dipindah
		$hapusSql = "DELETE FROM tmp_detail_pergerakan_stok WHERE transtatus='12' AND userid='".$usernm."'";
		mysql_query($hapusSql) or die ("Gagal kosongkan tmp".mysql_error());
		
		echo "<meta http-equiv='refresh' content='0; url=index1.php?p=kain_bs_keluar_barcode&status=Data Sudah DiBatalkan'>";
	}#AKHIR
if(isset($_POST['btnTambah']))
	{#AWAL
	
		# Jika sudah pernah dipilih		
		$cekSql ="SELECT * FROM tmp_detail_pergerakan_stok WHERE SN='$_POST[barcode]' AND transtatus='12' 
		AND userid='".$usernm."'"; 
		$cekQry = mysql_query($cekSql) or die ("Gagal Query".mysql_error());
		$cekSql1 ="SELECT * FROM detail_pergerakan_stok WHERE SN='$_POST[barcode]' AND (transtatus='11' or transtatus='10')"; 
		$cekQry1 = mysql_query($cekSql1) or die ("Gagal Query d".mysql_error());
		$cekSql0 ="SELECT * FROM detail_pergerakan_stok WHERE SN='$_POST[barcode]' "; 
		$cekQry0 = mysql_query($cekSql0) or die ("Gagal Query d".mysql_error());
		$c0=mysql_fetch_array($cekQry0);
		$cekSql2 ="SELECT * FROM detail_pergerakan_stok WHERE SN='$_POST[barcode]' AND transtatus='12'"; 
		$cekQry2 = mysql_query($cekSql2) or die ("Gagal Query d".mysql_error());
		if ((mysql_num_rows($cekQry) >= 1)  or (mysql_num_rows($cekQry0)<=1) or (mysql_num_rows($cekQry2)>=1)) {
			
			$pesanError = array();
			if(mysql_num_rows($cekQry)>=1){
			$pesanError[] = "<b>Data BARCODE <font color='#FF0000'>Sudah ADA </font> di Daftar list ini</b> !";		
			}
			if((mysql_num_rows($cekQry0)==1)){
			$pesanError[] = "<b>Data BARCODE ini <font color='#FF0000'>Belum Masuk atau Belum diSCAN</font> </b> !";		
			}
			if((mysql_num_rows($cekQry0)==0)){
			$pesanError[] = "<b>Data BARCODE ini <font color='#FF0000'>Tidak ADA</font> </b> !";		
			}
			if(mysql_num_rows($cekQry2)>=1){
			$pesanError[] = "<b>Data BARCODE ini <font color='#FF0000'>SUDAH KELUAR</font> </b> !";		
			}
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
		# Cek data di dalam tabel benang, mungkin yang diinput dari form adalah Barcode dan mungkin Kode-nya
			$mySql ="SELECT * FROM detail_pergerakan_stok WHERE SN='$_POST[barcode]' AND transtatus='11'";
			$myQry = mysql_query($mySql) or die ("Gagal Query Tmp".mysql_error());
			$myRow = mysql_fetch_array($myQry);
			$myQty = mysql_num_rows($myQry);
			if ($myQty >= 1) {
				
				// Data yang ditemukan dimasukkan ke keranjang transaksi
				$tmpSql 	= "INSERT INTO tmp_detail_pergerakan_stok
				(id_detail_kj,weight,yard_,no_roll,grade,satuan,sisa,SN,ket,nokk,ket_c,transtatus,userid) 
							VALUES ('$myRow[id_detail_kj]','$myRow[weight]','$myRow[yard_]','$myRow[no_roll]'
							, '$myRow[grade]', '$myRow[satuan]', '$myRow[sisa]', '$myRow[SN]', '$myRow[ket]', '$myRow[nokk]',
							'$myRow[ket_c]','12','".$usernm."')";
				mysql_query($tmpSql) or die ("Gagal Query tmp : ".mysql_error());}
			}
	}#AKHIR

if(isset($_POST['btnSimpan']))
	{#AWAL1
		$pesanError = array();
		if (trim($_POST['no_dok2'])=="") {
		$pesanError[] = "Data <b>No Dokumen</b> belum diisi !";		
		}
		if (trim($_POST['awal'])=="") {
		$pesanError[] = "Data <b> TANGGAL</b> belum diisi, pilih pada combo !";		
		}
		if (trim($_POST['jns_bongkar'])=="PILIH") {
		$pesanError[] = "Data <b>Jenis Bongkaran </b> belum dipilih  , pilih pada combo !!";		
		}
		if($_POST['jns_bongkar']=="POTONG KAIN" or $_POST['jns_bongkar']=="POTONG SAMPLE"){
				$qrc=mysql_query("SELECT weight FROM tmp_detail_pergerakan_stok WHERE userid='".$usernm."'");
				$tmpDataC=mysql_fetch_array($qrc);
		if ($_POST['qty_p'] >= $tmpDataC['weight']) {
		$pesanError[] = "<b>Jumlah Potongan Lebih Besar atau sisa potong tidak boleh NOL!</b>";		
		}		
		}
		
	# Validasi jika belum ada satupun data item yang dimasukkan
		$tmpSql ="SELECT COUNT(*) As qty FROM tmp_detail_pergerakan_stok WHERE userid='".$usernm."'";
		$tmpQry = mysql_query($tmpSql) or die ("Gagal Query Tmp".mysql_error());
		$tmpData = mysql_fetch_array($tmpQry);
		if ($tmpData['qty'] < 1) {
		$pesanError[] = "<b>DAFTAR KAIN BS KOSONG</b>, Daftar item kain belum ada yang dimasukan, <b>minimal 1 data </b>.";
		}
	# Baca variabel
		$txtKeterangan	= $_POST['ket'];
		$cmbTanggal 	= $_POST['awal'];
		$txtDok			= $_POST['no_dok'];		
			
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
		} else { #AWAL2
		# SIMPAN KE DATABASE
		# Jika jumlah error pesanError tidak ada, maka proses Penyimpanan akan dilakukan
		
		// Membuat kode Transaksi baru
		// $noTransaksi = buatKode("benang_masuk", "NP");
		
		// Skrip menyimpan data ke tabel transaksi utama
		if($_POST['jns_bongkar']!="POTONG KAIN"){
			$mySql	= "INSERT INTO pergerakan_stok SET 
						tgl_update='".$_POST['awal']."',
						documentno='".$_POST['no_dok2']."', 
						tgl_sj='".$_POST['awal']."',
						ket='$_POST[jns_bongkar],$txtKeterangan',
						typestatus='13',
						typetrans='12',
						fromtoid='OUT',
						no_sj ='$txtDok',
						userid='".$usernm."'";
			mysql_query($mySql) or die ("Gagal query 1 ".mysql_error());
		# Ambil semua data benang/benang yang dipilih, berdasarkan user yg login
			$tmpSql1 ="SELECT id  FROM pergerakan_stok WHERE typestatus='13' 
			and userid='".$usernm."' ORDER BY id DESC" ;
			$tmpQry1 = mysql_query($tmpSql1) or die ("Gagal Query stok ".mysql_error());
			$tmpData1= mysql_fetch_array($tmpQry1);
		}
		# Ambil semua data benang/benang yang dipilih, berdasarkan user yg login
			$tmpSql ="SELECT * FROM tmp_detail_pergerakan_stok WHERE userid='".$usernm."' AND transtatus='12'";
			$tmpQry = mysql_query($tmpSql) or die ("Gagal Query Tmp".mysql_error());
			while ($tmpData = mysql_fetch_array($tmpQry)) 
			{ #AWAL WHILE
				if($_POST['qty_p']=="")
				{ #AWAL
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
									yard_='$yard_',
									no_roll='$dataRol',
									status ='3',
									ket_c='$dataKetC',
									nokk ='$dataKK',
									transtatus='12',
									satuan='$dataSatuan',
									grade='$dataGrade',
									sisa='$dataSisa',
									SN='$dataSN'";
				mysql_query($itemSql) or die ("Gagal Query item".mysql_error());
					
				}#AKHIR
				if($_POST['qty_p'] !="")
				{
					$grm=mysql_query("SELECT lebar,berat FROM tbl_kite where nokk='$tmpData[nokk]'") or die("gagal cari data");
				    $rgrm=mysql_fetch_array($grm);
				    $x=(($rgrm['lebar']+2)*$rgrm['berat'])/43.05;
					$x1=(1000/$x);
					$yard=$x1*$_POST['qty_p'];
					$meter=$yard*(768/840);
				if($tmpData['satuan']=="Yard"){$yard_=round($yard,'2');}else{$yard_=round($meter,'2');}
				$dataBerat 	= $tmpData['weight'] - $_POST['qty_p'];
				$dataYard 	= $tmpData['yard_'] - $yard_;
				$dataKJ 	= $tmpData['id_detail_kj'];
				$dataSatuan	= $tmpData['satuan'];
				$dataGrade	= $tmpData['grade'];
				$dataRol	= $tmpData['no_roll'];
				$dataSN		= $tmpData['SN'];
				$dataKK		= $tmpData['nokk'];
				$dataSisa	= $tmpData['sisa'];
				$dataKetC	= $tmpData['ket_c'];
				if($_POST['jns_bongkar']=="POTONG KAIN"){
				$qrid=mysql_query("SELECT id_stok as id FROM detail_pergerakan_stok where SN='$tmpData[SN]' AND transtatus='11'");
				$tmpData1=mysql_fetch_array($qrid);
				$st=11;$pk="PK";
				}else{$st=13;$pk="";}
				$dataID		= $tmpData1['id'];
			
			// Masukkan semua benang/benang dari TMP ke tabel benang_masuk detail
				$itemSql = "INSERT INTO detail_pergerakan_stok SET
									id_stok='$dataID', 
									id_detail_kj='$dataKJ', 
									weight='$_POST[qty_p]', 
									yard_='$yard_',
									no_roll='$dataRol$pk',
									status ='0',
									ket_c='$dataKetC',
									nokk ='$dataKK',
									transtatus='$st',
									satuan='$dataSatuan',
									grade='$dataGrade',
									sisa='$dataSisa',
									SN='$snkain'";
				mysql_query($itemSql) or die ("Gagal Query item".mysql_error());
				
				$itemSqlUPS="UPDATE detail_pergerakan_stok 
								SET  weight='$dataBerat', 
									 yard_='$dataYard'
								where  (transtatus ='11')  
								and SN='$dataSN'";
				mysql_query($itemSqlUPS) or die ("Gagal Query UPdate Potong Sample".mysql_error());
				
				}else{
				$itemSqlU="UPDATE detail_pergerakan_stok 
								SET transtatus='10' 
								where  (transtatus ='11')  
								and SN='$dataSN'";
				mysql_query($itemSqlU) or die ("Gagal Query UPdate".mysql_error());
				}
			} #AKHIR WHILE
		
		# Kosongkan Tmp jika datanya sudah dipindah
		$hapusSql = "DELETE FROM tmp_detail_pergerakan_stok WHERE transtatus='12' AND userid='".$usernm."'";
		mysql_query($hapusSql) or die ("Gagal kosongkan tmp".mysql_error());
		
		// Refresh form
		//echo "<meta http-equiv='refresh' content='0; url=cetak/transaksi_pembelian_cetak.php?noNota=$noTransaksi'>";
		echo "<script>";
		//echo "window.open('../cetak/benang_masuk_cetak.php?noNota=$noTransaksi', width=330,height=330,left=100, top=25)";
		echo "</script>";
		echo "<meta http-equiv='refresh' content='0; url=index1.php?p=kain_bs_keluar_barcode&status=Data Sudah Tersimpan'>";
	}#AKHIR2
 }#AKHIR1

$data1=mysql_query("SELECT * FROM tbl_kite WHERE nokk='".$_GET['kkno']."'");
$rowk=mysql_fetch_array($data1);
?>
<fieldset>
<legend>PILIH DATA KAIN BS KELUAR</legend>
<form action="" method="post" name="form2">
<table width="637" border="0" cellpadding="0">
  <tr>
    <th width="19%" scope="row">JENIS KELUAR</th>
    <td width="1%">:</td>
    <td width="80%"><label for="jnis"></label>
      <select name="jnis" id="jnis" onchange="ganti();">
        <option value="BONGKARAN">BONGKARAN</option>
        <option value="PENGIRIMAN">PENGIRIMAN</option>
      </select></td>
  </tr>
  <tr>
    <th scope="row">&nbsp;</th>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

</form>
</fieldset>
<form action="" method="post" name="form1">
<fieldset>
  <legend>Data Pokok</legend>
  <div align="center"><font color="#FF0000"><?php echo $_GET['status'];?></font></div>
      <table width="788" border="0" cellpadding="0">
  <tr>
    <td width="15%">No Dokumen</td>
    <td width="1%">:</td>
    <td width="34%"><input name="no_dok2" type="text" id="no_dok2" value="<?php echo $nou; ?>" readonly="readonly"/></td>
    <td width="55%" rowspan="6" > <div class="rol">
    <table width="" border="0" cellpadding="2" cellspacing="3">
      <tr >
        <th  bgcolor="#9966CC" scope="col">NO.</th>
        <th  bgcolor="#9966CC" scope="col">No Roll</th>
        <th  bgcolor="#9966CC" scope="col">Qty (KG)</th>
        <th  bgcolor="#9966CC" scope="col">Yard</th>
        <th  bgcolor="#9966CC" scope="col">Grade</th>
        <th  bgcolor="#9966CC" scope="col">BARCODE</th>
        <th  bgcolor="#9966CC" scope="col">Ket</th>
        </tr>
      <?php
	//tambahan
	$datav=mysql_query("SELECT * FROM detail_pergerakan_stok WHERE transtatus='11' and nokk='".$_GET['nokk']."' order by no_roll ASC");
	$n=1;
	 while($rowdv=mysql_fetch_array($datav)){?>
      <?php  
	 $bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99';
	 ?>
      <tr bgcolor="<?php echo $bgcolor; ?>">
        <td align="center" ><?PHP echo $n; ?></td>
        <td align="center" ><?PHP echo $rowdv['no_roll']; ?></td>
        <td align="center" ><?PHP echo number_format($rowdv['weight'],'2','.',','); ?></td>
        <td align="center" ><?PHP echo number_format($rowdv['yard_'],'2','.',','); ?></td>
        <td align="center" ><?PHP echo $rowdv['grade']; ?></td>
        <td align="center" ><?PHP echo $rowdv['SN']; ?></td>
        <td align="center" ><?PHP echo $rowdv['sisa']; ?></td>
        </tr>
      <?php 
	$toyard=$toyard+$rowdv['yard_'];
	$toqty=$toqty+$rowdv['weight'];
	$n++;
	}?>
     <br /> Total Yard : <?php echo $toyard; ?><br />
    <b>Total Qty : <?php echo $toqty; ?></b>
    </table>
    </div></td>
  </tr>
  <tr>
    <td>Jenis Bongkaran</td>
    <td>:</td>
    <td><label for="jns_bongkar"></label>
      <select name="jns_bongkar" id="jns_bongkar" onchange="window.location='index1.php?p=kain_bs_keluar_bongkaran_barcode&amp;jns='+this.value">
        <option value="PILIH">PILIH</option>
        <option value="GANTI STIKER" <?php if($_GET['jns']=="GANTI STIKER"){echo "SELECTED";}?>>GANTI STIKER</option>
        <option value="POTONG KAIN" <?php if($_GET['jns']=="POTONG KAIN"){echo "SELECTED";}?>>POTONG KAIN</option>
        <option value="POTONG SAMPLE" <?php if($_GET['jns']=="POTONG SAMPLE"){echo "SELECTED";}?>>POTONG SAMPLE</option>
        <option value="TOLAKAN" <?php if($_GET['jns']=="TOLAKAN"){echo "SELECTED";}?>>TOLAKAN</option>
        <option value="BS" <?php if($_GET['jns']=="BS"){echo "SELECTED";}?>>BS</option>
      </select></td>
    </tr>
  <tr>
    <td>No Order</td>
    <td>:</td>
    <td><input name="no_order" type="text" id="no_order" value="<?php echo $_GET['dono']; ?>" size="25" onchange="window.location='index1.php?p=kain_bs_keluar_bongkaran_barcode&amp;jns=<?php echo $_GET['jns'];?>&amp;dono='+this.value" /></td>
    </tr>
  <tr>
    <td>No KK</td>
    <td>:</td>
    <td><select name="nokk"  onchange="window.location='index1.php?p=kain_bs_keluar_bongkaran_barcode&amp;jns=<?php echo $_GET['jns'];?>&amp;dono=<?php echo $_GET['dono'];?>&amp;nokk='+this.value">
      <option value="">PILIH</option>
      <?php 
	   $sqlnokk=mysql_query("SELECT a.nokk FROM detail_pergerakan_stok a
LEFT JOIN tmp_detail_kite b ON b.id=a.id_detail_kj
LEFT JOIN tbl_kite c ON c.id=b.id_kite
WHERE a.transtatus='11' AND c.no_order='$_GET[dono]'
GROUP BY a.nokk ORDER BY a.nokk ASC");
while($rk=mysql_fetch_array($sqlnokk)){?>
      <option value="<?php echo $rk['nokk'];?>" <?php if($_GET['nokk']==$rk['nokk']){echo "SELECTED";}?>><?php echo $rk['nokk'];?></option>
      <?php  } ?>
    </select></td>
    </tr>
  <tr>
    <td>Tgl Keluar</td>
    <td>:</td>
    <td><label for="nokk">
      <input type="text" id="awal" name="awal" value="<?php echo $tglTransaksi;?>" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.awal);return false;"/>
      <a href="javascript:void(0)" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.awal);return false;"><img src="calender/calender.jpeg" alt="" name="popcal" width="34" height="29" id="popcal" style="border:none" align="absmiddle" border="0" /></a></label></td>
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
    <td><button type="submit" style="cursor:pointer;" name="btnBatal" onclick="return confirm('ANDA YAKIN AKAN MENBATALKAN DATA INI ... ?')"> BATAL </button></td>
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
        <th  bgcolor="#9966CC" scope="col">No Order</th>
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
	$data=mysql_query("SELECT * FROM tmp_detail_pergerakan_stok a
	 WHERE a.transtatus='12' and a.userid='".$usernm."' order by a.no_roll ASC");
	$no=1;
	 while($rowd=mysql_fetch_array($data)){
		$dtl=mysql_query("SELECT b.no_order,b.no_po,b.warna FROM tmp_detail_kite c 
INNER JOIN tbl_kite b ON c.id_kite = b.id WHERE c.id='$rowd[id_detail_kj]' ORDER BY c.no_roll ASC");
$rowdtl=mysql_fetch_array($dtl);
		 ?>
      <?php  
	 $bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99';
	 ?>
      <tr bgcolor="<?php echo $bgcolor; ?>">
        <td align="center" ><?php echo $no; ?></td>
        <td align="center" ><?PHP echo $rowd['nokk']; ?></td>
        <td align="center" ><?PHP echo $rowdtl['no_order']; ?></td>
        <td align="center" ><?PHP echo $rowdtl['no_po']; ?></td>
        <td align="center" ><?PHP echo $rowdtl['warna']; ?></td>
        <td align="center" ><?PHP echo $rowd['no_roll']; ?></td>
        <td align="center" ><?PHP if($_GET['jns']=="POTONG SAMPLE" or $_GET['jns']=="POTONG KAIN"){echo "<input type='text' value='$rowd[weight]' name='qty_p' size='10'>";}else{echo number_format($rowd['weight'],'2','.',',');} ?></td>
        <td align="center" ><?PHP echo number_format($rowd['yard_'],'2','.',','); ?></td>
        <td align="center" ><?PHP echo $rowd['grade']; ?></td>
        <td align="center" ><?PHP echo $rowd['SN']; ?></td>
        <td align="center" ><?PHP echo $rowd['sisa']; ?></td>
        <td align="center" >&nbsp;&nbsp;<a  onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA INI ... ?')" href="pages/hapus_tmp_b.php?nokk=<?PHP echo $rowd['nokk']; ?>&amp;idtmp=<?PHP echo $rowd['id']; ?>&amp;bs=2">HAPUS</a>&nbsp;&nbsp;</td>
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
