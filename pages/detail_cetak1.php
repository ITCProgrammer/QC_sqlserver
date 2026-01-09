<title>CETAK</title>
<script>
alert("Cetak No KK <?php echo $_GET['id'];?> Terima Kasih");
</script>
<?php
include("../koneksi.php");
$ip = $_SERVER['REMOTE_ADDR'];
$tmpdir = sys_get_temp_dir();
$file = tempnam($tmpdir, 'ctk');
$handle = fopen($file, 'w');
$condensed = Chr(27) . Chr(33) . Chr(4);
$bold1 = Chr(27) . Chr(69); $bold0 = Chr(27) . Chr(70);
$initialized = chr(27).chr(64); $condensed1 = chr(15);
$condensed0 = chr(18);
$Data = $initialized;
$Data .= $condensed1;
$sql=mysql_query("SELECT *,detail_kite.yard_ as yard_, detail_kite.yard_ as roll, detail_kite.net_wight as bruto
FROM tbl_kite left join detail_kite on detail_kite.nokkKite=tbl_kite.nokk
WHERE tbl_kite.nokk='$_GET[id]'
ORDER BY tbl_kite.id ASC"); 
$jumlah=mysql_num_rows($sql);
$sql1=mysql_query("SELECT * , detail_kite.yard_ AS yard_, detail_kite.yard_ AS roll, detail_kite.net_wight AS bruto,detail_kite.satuan,sisa
FROM tbl_kite
INNER JOIN detail_kite ON detail_kite.nokkKite = tbl_kite.nokk
WHERE tbl_kite.nokk = '$_GET[id]'
ORDER BY detail_kite.id ASC limit 0,20"); 
$sql2=mysql_query("SELECT * , detail_kite.yard_ AS yard_, detail_kite.yard_ AS roll, detail_kite.net_wight AS bruto,detail_kite.satuan,sisa
FROM tbl_kite
INNER JOIN detail_kite ON detail_kite.nokkKite = tbl_kite.nokk
WHERE tbl_kite.nokk = '$_GET[id]'
ORDER BY detail_kite.id ASC limit 20,20"); 
$sql3=mysql_query("SELECT * , detail_kite.yard_ AS yard_, detail_kite.yard_ AS roll, detail_kite.net_wight AS bruto,detail_kite.satuan,sisa
FROM tbl_kite
INNER JOIN detail_kite ON detail_kite.nokkKite = tbl_kite.nokk
WHERE tbl_kite.nokk = '$_GET[id]'
ORDER BY detail_kite.id ASC limit 40,20");
//$Data .="| ".$row['no_roll']." | ".number_format($row['bruto'],'2','.',',')." | ".number_format($row['yard_'],'2','.',',')." | \n";
if($jumlah>=41 && $jumlah<=60){

$Data .="| ".str_pad($row1['no_roll'],4,"____",STR_PAD_LEFT)." | ".str_pad(number_format($row1['bruto'],'2','.',','),10,"______",STR_PAD_LEFT)." | ".str_pad(number_format($row1['yard_'],'2','.',','),10,"______",STR_PAD_LEFT)." | ".str_pad($row2['no_roll'],4,"____",STR_PAD_LEFT)." | ".str_pad(number_format($row2['bruto'],'2','.',','),10,"______",STR_PAD_LEFT)." | ".str_pad(number_format($row2['yard_'],'2','.',','),10,"______",STR_PAD_LEFT)." | ".str_pad($row3['no_roll'],4,"____",STR_PAD_LEFT)." | ".str_pad(number_format($row3['bruto'],'2','.',','),10,"______",STR_PAD_LEFT)." | ".str_pad(number_format($row3['yard_'],'2','.',','),10,"______",STR_PAD_LEFT)." | \n"; 
  }


if($jumlah>=21 && $jumlah<=40){

$Data .="| ".str_pad($row1['no_roll'],4,"____",STR_PAD_LEFT)." | ".str_pad(number_format($row1['bruto'],'2','.',','),10,"______",STR_PAD_LEFT)." | ".str_pad(number_format($row1['yard_'],'2','.',','),10,"______",STR_PAD_LEFT)." | ".str_pad($row2['no_roll'],4,"____",STR_PAD_LEFT)." | ".str_pad(number_format($row2['bruto'],'2','.',','),10,"______",STR_PAD_LEFT)." | ".str_pad(number_format($row2['yard_'],'2','.',','),10,"______",STR_PAD_LEFT)." | \n"; 
}


if($jumlah>=1 && $jumlah<=20){

$Data .="| ".str_pad($row1['no_roll'],4,"____",STR_PAD_LEFT)." | ".str_pad(number_format($row1['bruto'],'2','.',','),10,"______",STR_PAD_LEFT)." | ".str_pad(number_format($row1['yard_'],'2','.',','),10,"______",STR_PAD_LEFT)." | \n"; 
}
//echo $Data;
fwrite($handle, $Data);
fclose($handle);
copy($file, "//".$ip."/printerku");
unlink($file);
	
	?>
<script> 
window.location.href='../form-Packing';
</script>    
