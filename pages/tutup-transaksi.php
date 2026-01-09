<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Tutup Transaksi</title>
<script>
   
          function ganti()
{     var lprn= document.forms['form2']['lprn'].value;  
if(lprn=="Online"){
	window.location.href="index1.php?p=laporan_harian_online";
	}

}
           </script> 
</head>

<body>
<?php 
	if(isset($_POST['CekData'])){
$cektgl=mysqli_query($con,"SELECT DATE_FORMAT(NOW(),'%Y-%m-%d') as tgl,COUNT(tgl_tutup) as ck ,DATE_FORMAT(NOW(),'%H') as jam,DATE_FORMAT(NOW(),'%H:%i') as jam1 FROM tbl_stok_kj WHERE tgl_tutup='".$_POST['tglrpt']."' LIMIT 1");
$dcek=mysqli_fetch_array($cektgl);
$t1=strtotime($_POST['tglrpt']);
$t2=strtotime($dcek['tgl']);
$selh=round(abs($t2-$t1)/(60*60*45));

if($dcek['ck']>0){
	echo "<script>";
		echo "alert('Stok Tgl ".$_POST['tglrpt']." Ini Sudah Pernah ditutup')";
		echo "</script>";
		// Refresh form
		// echo "<meta http-equiv='refresh' content='0; url=index1.php?p=data-stok-kj'>";
	}else if($_POST['tglrpt'] > $dcek['tgl']){
		echo "<script>";
		echo "alert('Tanggal Lebih dari $selh hari')";
		echo "</script>";
		// Refresh form
		// echo "<meta http-equiv='refresh' content='0; url=index1.php?p=data-stok-kj'>";
	}else if($_POST['tglrpt'] < $dcek['tgl']){
		echo "<script>";
		echo "alert('Tanggal Kurang dari $selh hari')";
		echo "</script>";
		// Refresh form
		// echo "<meta http-equiv='refresh' content='0; url=index1.php?p=data-stok-kj'>";
	}else if($dcek['jam'] < 6){
		echo "<script>";
		echo "alert('Tidak Bisa Tutup Sebelum jam 6 Pagi Sampai jam 12 Malam, Sekarang Masih Jam ".$dcek['jam1']."')";
		echo "</script>";
		// Refresh form
		// echo "<meta http-equiv='refresh' content='0; url=index1.php?p=data-stok-kj'>";
			}
			else{
				
						
		$qry=mysqli_query($con," SELECT
	a.tgl_update,a.blok,
	b.sisa,b.nokk,b.id_stok,a.sts_stok,b.ket_stok,
	GROUP_CONCAT(DISTINCT lokasi) as lokasi
	FROM
	pergerakan_stok a
	LEFT JOIN detail_pergerakan_stok b ON a.id = b.id_stok
    LEFT JOIN tmp_detail_kite d ON d.id=b.id_detail_kj
	LEFT JOIN tbl_kite c ON c.id = d.id_kite
	WHERE
	(a.typestatus = '1' OR a.typestatus = '2')
	AND not ISNULL(b.transtatus) AND b.transtatus='1' 
	AND a.tgl_update > '2012-12-31'
	GROUP BY
	b.nokk,b.sisa,b.id_stok,b.ket_stok
	ORDER BY
	a.tgl_update,a.id ");
				while($row=mysqli_fetch_array($qry)){
	if($row['ket_stok']!=""){$stks=" and b.ket_stok='".$row['ket_stok']."' ";}else{ $stks="";}				
					
	$mySql =mysqli_query($con,"SELECT tempat FROM mutasi_kain WHERE nokk='".$row['nokk']."' AND keterangan='".$row['sisa']."' AND NOT tempat='' ORDER BY id DESC");
	   $myBlk = mysqli_fetch_array($mySql);
	   
	   $mysqlCek=mysqli_query($con," SELECT
	SUM(case when b.grade='A' or b.grade='B' or b.grade='C' or b.grade='' then b.weight else 0 end) as tot_qty,
	SUM(if(b.grade='A' or b.grade='B' or b.grade='C' or b.grade='', 1, 0)) as tot_rol,
	SUM(case when b.grade='A' or b.grade='B' or b.grade='C' or b.grade='' then b.yard_ else 0 end) as tot_yard,
	SUM(case when b.grade='A' or b.grade='B' or b.grade='' then b.weight else 0 end) as grd_ab,
	SUM(case when b.grade='C' then b.weight else 0 end) as grd_c,
	SUM(if(b.grade='A' or b.grade='B' or b.grade='', 1, 0)) as jml_ab,
	SUM(if(b.grade = 'C', 1, 0)) as jml_grd_c,b.sisa,b.satuan,SUM(d.netto) as netto,
	a.blok,a.tgl_update,b.ket_stok
	FROM
	pergerakan_stok a 
	LEFT JOIN detail_pergerakan_stok b  ON a.id = b.id_stok
    LEFT JOIN tmp_detail_kite d ON d.id=b.id_detail_kj
	LEFT JOIN tbl_kite c ON c.id = d.id_kite
	WHERE
	b.`transtatus`='1' and b.nokk='".$row['nokk']."' and b.sisa='".$row['sisa']."' and b.id_stok='".$row['id_stok']."' $stks 
	AND (a.fromtoid = 'GUDANG KAIN JADI' OR a.fromtoid = 'PACKING' OR a.fromtoid='LAIN' OR a.fromtoid='INSPEK MEJA' OR a.fromtoid ='GANTI STIKER' OR a.fromtoid ='REVISI STIKER' OR a.fromtoid ='POTONG SISA') AND if(b.grade='A' or b.grade='B' or b.grade='C' or b.grade='', 1, 0)>0
	GROUP BY
	b.sisa,b.id_stok,b.ket_stok
	ORDER BY
	a.id, b.ket_stok ");
	$myro = mysqli_fetch_array($mysqlCek);
	if($myro['tot_rol']>0){
	   $mySql1 =mysqli_query($con,"SELECT * FROM tbl_kite WHERE nokk='".$row['nokk']."'");
	   $myBlk1 = mysqli_fetch_array($mySql1);
	   $mySql2 =mysqli_query($con,"SELECT a.no_po,a.no_order FROM pergerakan_stok a
INNER JOIN detail_pergerakan_stok b ON a.id=b.id_stok
WHERE b.nokk='".$row['nokk']."' and ISNULL(b.transtatus)
GROUP BY b.nokk");
	   $myBlk2 = mysqli_fetch_array($mySql2); 
	if($myro['satuan']=="PCS"){$pjng=$myro['netto']; $st=$myro['satuan'];}else{ $pjng=$myro['tot_yard'];$st=$myro['satuan'];}
	//if($myBlk['tempat']!=""){$blk=$myBlk['tempat'];}else if($row['blok']!=""){$blk=$row['blok'];}else{$blk="N/A";}
	if($row['lokasi']!=""){$blk=$row['lokasi'];}else{$blk="N/A";}	
	if($myro['sisa']=="FOC"){$ketx="EXTRA FULL";}else{$ketx="";}
	if($myBlk1['no_po']!=""){$nopo=str_replace("'","''",$myBlk1['no_po']);}else{$nopo=str_replace("'","''",$myBlk2['no_po']);}
	if($myBlk1['no_order']!=""){$order=str_replace("'","''",$myBlk1['no_order']);}else{$order=str_replace("'","''",$myBlk2['no_order']);}
	$jns=str_replace("'","''",$myBlk1['jenis_kain']);
	$langganan=str_replace("'","''",$myBlk1['pelanggan']);	
	if($row['sisa']=="SISA" || $row['sisa']=="FKSI"){$sisa="SISA";}else{$sisa="";}
	$warna=str_replace("'","''",$myBlk1['warna']);
	$nowarna=str_replace("'","''",$myBlk1['no_warna']);	
					$simpan=mysqli_query($con,"INSERT INTO `tbl_stok_kj` SET 
					`tgl_in`='".$row['tgl_update']."',
					`no_item`='".$myBlk1['no_item']."',
					`langganan`='$langganan',
					`no_po`='$nopo',
					`no_order`='$order',
					`no_warna`='$nowarna',
					`warna`='$warna',
					`jenis_kain`='$jns',
					`lot`='".$myBlk1['no_lot']."',
					`qty_ab`='".$myro['grd_ab']."',
					`qty_c`='".$myro['grd_c']."',
					`panjang`='$pjng',
					`satuan`='$st',
					`tempat`='$blk',
					`ket_extra`='$ketx',
					`lebar`='".$myBlk1['lebar']."',
					`gramasi`='".$myBlk1['berat']."',
					`rol`='".$myro['tot_rol']."',
					`ket_status`='".$myro['ket_stok']."',
					`nokk`='".$row['nokk']."',
					`ket_c`='$sisa',
					`tgl_tutup`='".$_POST['tglrpt']."'
					
					") or die("GAGAL SIMPAN"); 
						}
					
				}
		if($qry){		
		echo "<script>";
		echo "alert('Stok Tgl ".$_POST['tglrpt']." Sudah ditutup')";
		echo "</script>";
        echo "<meta http-equiv='refresh' content='0; url=index1.php?p=data-stok-kj'>";
		}
				
			}
	}
	?>
<form id="form1" name="form1" method="post" action="">
  <table width="517">
    <tr>
      <td colspan="3"><div align="center">LAPORAN TUTUP TRANSAKSI GUDANG KAIN JADI</div> 
	 </div>
	  <?php 
	  $user_name=$_SESSION['username'];
	  date_default_timezone_set('Asia/Jakarta');
	$tgl=date("Y-M-d h:i:s A");
	  echo $tgl;?><br />GROUP SHIFT: <strong><?php echo $_SESSION['username']; ?></strong></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td width="128">Tanggal </td>
      <td width="5">:</td>
      <td width="368"><input type="text" id="tglrpt" name="tglrpt" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.tglrpt);return false;"/>
      <a href="javascript:void(0)" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.tglrpt);return false;"><img src="calender/calender.jpeg" alt="" name="popcal" width="34" height="29" id="popcal" style="border:none" align="absmiddle" border="0" />
      <input type="hidden" name="user_name" id="user_name" value="<?php echo $_SESSION['username']; ?>" />
      </a></td>
    </tr>
    <tr>
      <td colspan="3">* <strong>Tutup Transaksi Membutuhkan Waktu, Harap Tunggu...<br />
        ** Jangan di Tutup Sebelum Selesai.
      </strong></td>
    </tr>
    <tr>
      <td><input type="submit" name="CekData" id="CekData" value="Cek Data" /></td>
      <td>&nbsp;</td>
      <td><input type="button" name="LihatData" id="LihatData" value="Detail Data" onClick="window.location.href='?p=data-stok-kj'" /></td>
    </tr>
  </table>
</form>

</body>
</html>
