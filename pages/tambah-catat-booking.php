<?php
ini_set("error_reporting",1);
include("../koneksi.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Booking Kain Jadi</title>
</head>
<script>
function sum() {
	  var satuan = document.getElementById('satuan').value;
	  var jml	 = document.getElementById('jml').value;	
      var kgs1   = document.getElementById('totkgs').value;      
	  var yds1   = document.getElementById('totyds').value;
	  var kgs2   = document.getElementById('totkgs2').value;      
	  var yds2   = document.getElementById('totyds2').value;	
      var bqty   = document.getElementById('bqty').value;
	  var total;
	if(jml>0){
	  if(satuan=="Kgs"){
		  if(bqty!=""){
		  total = parseFloat(kgs1) - (parseFloat(kgs2)+parseFloat(bqty));	  
		  }else{ 
		  total = parseFloat(kgs1) - parseFloat(kgs2);
		  }
		  
	  }else if(satuan=="Yards"){
		  if(bqty!=""){
		  total = parseFloat(yds1) - (parseFloat(yds2)+parseFloat(bqty));	  
		  }else{
		  total = parseFloat(yds1) - parseFloat(yds2);
		  }
		  
	  }else if(satuan=="Meters"){
		  if(bqty!=""){
		  total = parseFloat(yds1) - (parseFloat(yds2)+parseFloat(bqty));	  
		  }else{
		  total = parseFloat(yds1) - parseFloat(yds2);
		  }
		  
	  }
		else { total=0;}
	}else{
	  if(satuan=="Kgs"){
		  total = parseFloat(kgs1) - parseFloat(bqty);
	  }else if(satuan=="Yards"){
		  total = parseFloat(yds1) - parseFloat(bqty);
	  }else if(satuan=="Meters"){
		  total = parseFloat(yds1) - parseFloat(bqty);
	  }else { total=0;}
	}
      if (!isNaN(total)) {
         document.getElementById('sisa').value = roundToTwo(total).toFixed(2);
      }else {
		 if(jml>0){ 
		  if(satuan=="Kgs"){
			document.getElementById('sisa').value = roundToTwo(kgs2).toFixed(2);  
		  }else if(satuan=="Yards"){
			document.getElementById('sisa').value = roundToTwo(yds2).toFixed(2);  
		  }else if(satuan=="Meters"){
			document.getElementById('sisa').value = roundToTwo(yds2).toFixed(2);  
		  }
		 }else{
			if(satuan=="Kgs"){
			document.getElementById('sisa').value = roundToTwo(kgs1).toFixed(2);  
		  }else if(satuan=="Yards"){
			document.getElementById('sisa').value = roundToTwo(yds1).toFixed(2);  
		  }else if(satuan=="Meters"){
			document.getElementById('sisa').value = roundToTwo(yds1).toFixed(2);  
		  }	 
		 }
		  
	  }
	    	
}
function roundToTwo(num) {    
    return +(Math.round(num + "e+2")  + "e-2");
}
</script>
<body>
<?php
	if(isset($_POST['btnSimpan'])){

	$pesanError = array();
	if (trim($_POST['nama'])=="") {
		$pesanError[] = "Data <b> Nama</b> belum diisi !";
	}
	if (trim($_POST['satuan'])=="") {
		$pesanError[] = "Data <b> Satuan</b> belum dipilih !";
	}	
	if (trim($_POST['dept'])=="") {
		$pesanError[] = "Data <b> Dept</b> belum dipilih !";
	}
	# Baca variabel
	$Txtdept		= $_POST['dept'];
	$Txtnama		= str_replace("'","''",$_POST['nama']);
	$Txtcatat		= str_replace("'","''","Untuk ".$_POST['order']." Qty ".$_POST['bqty']." ".$_POST['satuan']." Sisa ".$_POST['sisa']);
	$Txtsisa		= $_POST['sisa']." ".$_POST['satuan'];
	$Txtid			= $_GET['id'];
	$Txtket			= $_GET['ket'];
	$Txtnokk		= $_GET['nokk'];

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
		$mySqlcariMK=mysqli_query($con,$myQrycariMK) or die ("Gagal query  ".mysql_error());
		$rowcariMK=mysqli_num_rows($mySqlcariMK);
		$row3=mysqli_fetch_array($mySqlcariMK);
		$Tbcatatan=$row3['catatan']." ".$Txtcatat;
		if($rowcariMK>0){
		$myQry3 ="	UPDATE mutasi_kain SET 
					catatan='$Tbcatatan' 
					WHERE keterangan='$Txtket' AND nokk='$Txtnokk'";
		mysqli_query($con,$myQry3) or die ("Gagal query  ".mysql_error());
		}else{
			$mySql3	= "INSERT mutasi_kain SET
						catatan='".trim($Tbcatatan)."',
						nokk='".$Txtnokk."',
						keterangan='".$Txtket."'";
		mysqli_query($con,$mySql3) or die ("Gagal query ".mysql_error());
		}
		$myQrycari	= "SELECT * FROM tbl_catat_kain
						WHERE nokk='".$Txtnokk."' AND ket='".$Txtket."' AND id_kain='".$Txtid."' LIMIT 1";
		$mySqlcari=mysqli_query($con,$myQrycari) or die ("Gagal query  ".mysql_error());
		$rowc1=mysqli_fetch_array($mySqlcari);
		$rowcari=mysqli_num_rows($mySqlcari);		
		if($rowcari>0){
		$mySqlc1	= "UPDATE tbl_catat_kain SET
						catat='".$Tbcatatan."',
						sisa='".$Txtsisa."',
						tgl_update=now()
						WHERE nokk='".$Txtnokk."' AND ket='".$Txtket."' AND id_kain='".$Txtid."'";
		mysqli_query($con,$mySqlc1) or die ("Gagal query 1 ".mysql_error());	
		$mySql	= "INSERT tbl_catat_detail SET
						id_catat='".$rowc1['id']."',
						no_order='".$_POST['order']."',
						qty_minta='".$_POST['bqty']."',
						satuan='".$_POST['satuan']."',
						dept='".$_POST['dept']."',
						nama='".$_POST['nama']."',
						tgl_buat=now(),
						tgl_update=now()
						";
		mysqli_query($con,$mySql) or die ("Gagal query 1 ".mysql_error());	
		}else{
			$mySql	= "INSERT tbl_catat_kain SET
						nokk='".$Txtnokk."',
						catat='".$Tbcatatan."',
						id_kain='".$Txtid."',
						ket='".$Txtket."',
						sisa='".$Txtsisa."',
						tgl_update=now()";
		mysqli_query($con,$mySql) or die ("Gagal query 1 ".mysql_error());
		$myQryc1	= "SELECT * FROM tbl_catat_kain
						WHERE nokk='".$Txtnokk."' AND ket='".$Txtket."' AND id_kain='".$Txtid."' LIMIT 1";
		$mySqlc1=mysqli_query($con,$myQryc1) or die ("Gagal query  ".mysql_error());
		$rowcr2=mysqli_fetch_array($mySqlc1);
		$rowcr1=mysqli_num_rows($mySqlc1);		
		if($rowcr1>0){
		$mySql	= "INSERT tbl_catat_detail SET
						id_catat='".$rowcr2['id']."',
						no_order='".$_POST['order']."',
						qty_minta='".$_POST['bqty']."',
						satuan='".$_POST['satuan']."',
						dept='".$_POST['dept']."',
						nama='".$_POST['nama']."',
						tgl_buat=now(),
						tgl_update=now()
						";
		mysqli_query($con,$mySql) or die ("Gagal query 1 ".mysql_error());	
			}
		}
		echo "<script>";
		echo "</script>";
		echo "<meta http-equiv='refresh' content='0; url=tambah-catat-booking.php?id=$Txtid&nokk=$Txtnokk&ket=$Txtket&status=Catatan Sudah diUbah'>";
	}
}
if($_GET['h']=="1"){
	$Txtid			= $_GET['id'];
	$Txtket			= $_GET['ket'];
	$Txtnokk		= $_GET['nokk'];
	$qryhapus=mysqli_query($con,"UPDATE tbl_catat_detail SET `tmp_hapus`='1' WHERE id=".$_GET['idkd']."");
	if($qryhapus){
		echo "<meta http-equiv='refresh' content='0; url=tambah-catat-booking.php?id=$Txtid&nokk=$Txtnokk&ket=$Txtket&status=Catatan Sudah diHapus'>";}
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
		$mySql1=mysqli_query($con,$myQry) or die ("Gagal query  ".mysql_error());
		$row1=mysqli_fetch_array($mySql1);
	  	$myQry1	= "SELECT sum(b.weight) as kgs,sum(b.yard_) as yds,satuan FROM pergerakan_stok a
		 				INNER JOIN detail_pergerakan_stok b ON a.id=b.id_stok 
						WHERE b.transtatus='1' AND a.id='".$_GET['id'] ."' AND b.nokk='".$_GET['nokk'] ."' AND sisa='".$_GET['ket'] ."'";
	  	$mySql2=mysqli_query($con,$myQry1) or die ("Gagal query  ".mysql_error());
		$row2=mysqli_fetch_array($mySql2)
		?>
    <tr>
      <td colspan="3"><font size="-2"><table width="100%" border="1">
        <tbody>
          <tr>
            <th width="6%" rowspan="2" bgcolor="#8CB9E3" scope="col">No</th>
            <th colspan="2" bgcolor="#8CB9E3" scope="col">Booking</th>
            <th width="27%" rowspan="2" bgcolor="#8CB9E3" scope="col">No Order</th>
            <th width="27%" rowspan="2" bgcolor="#8CB9E3" scope="col">Nama</th>
            <th width="17%" rowspan="2" bgcolor="#8CB9E3" scope="col">Dept</th>
            <th width="29%" rowspan="2" bgcolor="#8CB9E3" scope="col">Tgl Buat</th>
            <th width="29%" rowspan="2" bgcolor="#8CB9E3" scope="col">Aksi</th>
          </tr>
          <tr>
            <th width="11%" bgcolor="#8CB9E3">Qty</th>
            <th width="10%" bgcolor="#8CB9E3">Satuan</th>
          </tr>
          <?php 
		$no=1;
	  	$toty=0;$totk=0;
		$myQry2	= " SELECT *,b.id as idkd FROM tbl_catat_kain a
							INNER JOIN tbl_catat_detail b ON a.id=b.id_catat
						WHERE b.tmp_hapus='0' AND a.id_kain='".$_GET['id'] ."' AND a.nokk='".$_GET['nokk'] ."' AND a.ket='".$_GET['ket'] ."'";
	  	$mySql4=mysqli_query($con,$myQry2) or die ("Gagal query  ".mysql_error());
	  	$cek=mysqli_num_rows($mySql4);
		while($data=mysqli_fetch_array($mySql4)){ ?>
          <tr>
            <td><?php echo $no;?></td>
            <td><?php echo $data['qty_minta'];?></td>
            <td><?php echo $data['satuan'];?></td>
            <td><?php echo $data['no_order'];?></td>
            <td><?php echo $data['nama'];?></td>
            <td><?php echo $data['dept'];?></td>
            <td><?php echo $data['tgl_buat'];?></td>
            <td align="center"><a href="?id=<?php echo $_GET['id'];?>&nokk=<?php echo $_GET['nokk'];?>&ket=<?php echo $_GET['ket']; ?>&no_po=<?php echo $_GET['no_po'];?>&idkd=<?php echo $data['idkd'];?>&h=1">Delete</a></td>
          </tr>
          <?php 
										
			if($data['satuan']=="yards"){
				$toty=$toty+$data['qty_minta'];
				$stn="panjang";
			}else if($data['satuan']=="meters"){
				$toty=$toty+$data['qty_minta'];
				$stn="panjang";
			}else if($data['satuan']=="kgs"){
				$totk=$totk+$data['qty_minta'];
				$stn="kgs";
			}
			 
		  $no++;				   
		  } ?>
        </tbody>
      </table></font></td>
    </tr>
    <tr>
      <td width="19%">No KK</td>
      <td width="1%">:</td>
      <td width="80%"><?php echo $_GET['nokk'];?><label for="nokk"></label>
      <input type="hidden" name="id" id="id"  value="<?php echo $_GET['id'];?>"/>
      <input type="hidden" name="jml" id="jml" value="<?php echo $cek; ?>"/></td>
    </tr>
    <tr>
      <td valign="top">Total Actual</td>
      <td valign="top">:</td>
      <td><input type="hidden" name="totkgs" id="totkgs" value="<?php echo $row2['kgs'];?>"/>
<?php echo $row2['kgs'];?> Kgs,
<input type="hidden" name="totyds" id="totyds" value="<?php echo $row2['yds'];?>" />
<?php echo $row2['yds'];?> Yds/Mtrs</td>
    </tr>
	  <?php 
	  if($stn=="panjang"){
	  $conv=($row2['kgs']/$row2['yds'])*$toty;
	  }else{
		 $conv=$totk;
	  }
	  if($stn=="kgs"){
	  $conv1=($row2['kgs']/$row2['yds'])*$totk;
	  }else{
		 $conv1=$toty; 
	  }
	  ?>
    <tr>
      <td valign="top">Tot. Booking</td>
      <td valign="top">:</td>
      <td><input type="hidden" name="totkgs2" id="totkgs2" value="<?php echo $conv;?>"/>
        <?php echo number_format(round($conv,2),'2','.','');?> Kgs,
        <input type="hidden" name="totyds2" id="totyds2" value="<?php echo $conv1;?>" />
      <?php echo number_format(round($conv1,2),'2','.','');?> Yds/Mtrs</td>
    </tr>
    <tr>
      <td valign="top">Satuan</td>
      <td valign="top">:</td>
      <td><select name="satuan" id="satuan" onChange="sum();" autofocus="autofocus">
        <option value="">Pilih</option>
        <option value="Kgs">Kgs</option>
        <option value="Yards">Yards</option>
		<option value="Meters">Meters</option>  
      </select></td>
    </tr>
    <tr>
      <td valign="top">Untuk Order</td>
      <td valign="top">:</td>
      <td><input type="text" name="order" id="order" value=""/></td>
    </tr>
    <tr>
      <td valign="top">Qty Booking</td>
      <td valign="top">:</td>
      <td><input name="bqty" type="text" id="bqty" placeholder="0.00" onkeyup="sum();" value="" size="7" maxlength="8"/></td>
    </tr>
    <tr>
      <td valign="top">Sisa</td>
      <td valign="top">:</td>
      <td><input name="sisa" type="text" id="sisa" size="7" maxlength="8" readonly/></td>
    </tr>
    <tr>
      <td>Nama</td>
      <td>:</td>
      <td><label for="nama"></label>
      <input type="text" name="nama" id="nama" value=""/>
      <label for="ket"></label></td>
    </tr>
    <tr>
      <td>Dept</td>
      <td>:</td>
      <td><select name="dept" id="dept">
        <option value="">PILIH</option>
        <option value="GKJ" >GKJ</option>
        <option value="QC" >QC</option>
        <option value="MKT" >MKT</option>
        <option value="PPC" >PPC</option>
      </select></td>
    </tr>
    <tr>
      <td><input type="submit" name="btnSimpan" id="simpan" value="SIMPAN" /></td>
      <td>&nbsp;</td>
      <td><input type="button" name="tutup" id="tutup" value="TUTUP"  onclick="window.close();"/></td>
    </tr>
  </table>
  <br />
</form>
</body>
</html>
