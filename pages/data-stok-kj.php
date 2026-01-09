<?php
$con=mysqli_connect("10.0.0.10","dit","4dm1n","db_qc");
//include "koneksi.php";
ini_set("error_reporting",1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Data Stok Gudang Kain Jadi</title>
<link rel="stylesheet" type="text/css" href="css/datatable.css" />
<link rel="stylesheet" type="text/css" href="css/jquery-ui.css" />
<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/jquery.dataTables.js" type="text/javascript"></script>
<script>
function confirmDelete(url) {
    if (confirm("Yakin Batal Tutup Transaksi ini?")) {
        window.location.href=url;
    } else {
        false;
    }       
}
	$(document).ready(function(){
		$('#datatables').dataTable({
			"sScrollY": "400px",
			"sScrollX": "100%",
			"bScrollCollapse": true,
			"bPaginate": true,
			"bJQueryUI": true
		});			
	})
</script>
</head>

<body>
<?Php 
$Awal	= isset($_POST['awal']) ? $_POST['awal'] : '';
$Akhir	= isset($_POST['akhir']) ? $_POST['akhir'] : '';
?>	
<form id="form1" name="form1" method="post" action="">	
<table width="634">
  <tr>
    <td width="128">Tanggal Awal</td>
    <td width="5">:</td>
    <td width="433"><input name="awal" type="text" id="awal" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.awal);return false;" value="<?php echo $Awal; ?>"/>
      <a href="javascript:void(0)" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.awal);return false;"><img src="calender/calender.jpeg" alt="" name="popcal" width="34" height="29" id="popcal" style="border:none" align="absmiddle" border="0" /></a></td>
  </tr>
  <tr>
    <td>Tanggal Akhir</td>
    <td>:</td>
    <td><input name="akhir" type="text" id="akhir" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.akhir);return false;" value="<?php echo $Akhir; ?>"/>
      <a href="javascript:void(0)" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.akhir);return false;"><img src="calender/calender.jpeg" alt="" name="popcal" width="34" height="29" id="popcal2" style="border:none" align="absmiddle" border="0" /></a></td>
  </tr>
  <tr>
    <td><input type="submit" name="button" id="button" value="Cari Data" /></td>
    <td>&nbsp;</td>
    <td><input type="hidden" name="user_name" id="user_name" value="<?php echo $_SESSION['username']; ?>" /></td>
  </tr>
</table>
	</form>	
<br>
<table width="100%" border="0" class="display" id="datatables">
 <thead>
  <tr bgcolor="#1878F9">
    <th width="30">TGL</th>
    <th width="55">ROL</th>
    <th width="92">GRADE A+B/kg</th>
    <th width="92">GRADE C/kg</th>
    <th width="92">TOTAL</th>
    <th width="92">AKSI</th>
  </tr>
  </thead>
  <tbody>
  <?php
	/* $batas = 31;
	$pg = isset( $_GET['pg'] ) ? $_GET['pg'] : "";
	if ( empty( $pg ) ) {
	$posisi = 0;
	$pg = 1;
	} else {
	$posisi = ( $pg - 1 ) * $batas;
	}

	$no = 1+$posisi; */
	if($_POST['thn']!=""){$thn=$_POST['thn'];}else{ $thn=$thn_skr;}
  	$sqldt=mysqli_query($con,"SELECT tgl_tutup,ROUND(SUM(qty_ab),2) as berat,
	ROUND(SUM(qty_c),2) as berat1,SUM(rol) as rol,DATE_FORMAT(now(),'%Y-%m-%d') as tgl FROM tbl_stok_kj WHERE tgl_tutup BETWEEN '$Awal' AND '$Akhir'
    GROUP BY tgl_tutup DESC ");
$c=0;$n=1;
	while($row=mysqli_fetch_array($sqldt)){
	$bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99';

  ?>
  
  <tr bgcolor="<?php echo $bgcolor;?>">
    <td><a href="pages/detail-stok-kj.php?tgl=<?php echo $row['tgl_tutup'];?>" target="_blank"><?php echo $row['tgl_tutup'];?></a></td>
    <td align="right"><?php echo number_format($row['rol']);?></td>
    <td align="right"><?php echo number_format($row['berat'],2);?></td>
    <td align="right"><?php echo number_format($row['berat1'],2);?></td>
    <td align="right"><?php echo number_format($row['berat']+$row['berat1'],2);?></td>
    <td align="right"><div align="center"><input type="button" name="btnBatal" id="btnBatal" value="Batal" onClick="confirmDelete('?p=batal-transaksi&tgl=<?php echo $row['tgl_tutup'];?>');" <?php if($row['tgl']==$row['tgl_tutup']){ }else{echo"disabled";} ?> />
      <input type="button" name="btnCetak" id="btnCetak" value="Cetak Ke Excel" onClick="window.location.href='pages/detail-stok-kj-excel.php?tgl=<?php echo $row['tgl_tutup'];?>'" />
    </div></td>
  </tr>
  <?php $n++; $no++;} ?>
  </tbody>
</table>
<?php
/* //hitung jumlah data
$jml_data = mysql_num_rows(mysqli_query($con,"SELECT * FROM tbl_stok_kj GROUP BY tgl_tutup"));
//Jumlah halaman
$JmlHalaman = ceil($jml_data/$batas); //ceil digunakan untuk pembulatan keatas
 
//Navigasi ke sebelumnya
if ( $pg > 1 ) {
$link = $pg-1;
$prev = "<a href='?pg=$link'><<</a>";
} else {
$prev = "<< ";
}
 
//Navigasi nomor
$nmr = '';
for ( $i = 1; $i<= $JmlHalaman; $i++ ){
 
if ( $i == $pg ) {
$nmr .= $i . " ";
} else {
$nmr .= "<a href='?pg=$i'>$i</a> ";
}
}
 
//Navigasi ke selanjutnya
if ( $pg < $JmlHalaman ) {
$link = $pg + 1;
$next = " <a href='?pg=$link'>>></a>";
} else {
$next = " >>";
}
 
//Tampilkan navigasi
echo $prev . $nmr . $next; */
?>
<input type="button" value="BACK" onClick="window.location.href='?p=tutup-transaksi'"/>
</body>
</html>
