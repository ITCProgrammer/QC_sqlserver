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
$jumlah=mysql_query("SELECT *,detail_kite.yard_ as yard_, detail_kite.yard_ as roll, detail_kite.net_wight as bruto
FROM tbl_kite left join detail_kite on detail_kite.nokkKite=tbl_kite.nokk
WHERE tbl_kite.nokk='$_GET[id]'
ORDER BY tbl_kite.id ASC");
$jml=mysql_num_rows($jumlah);
$sql=mysql_query("SELECT *,detail_kite.yard_ as yard_, detail_kite.yard_ as roll, detail_kite.net_wight as bruto
FROM tbl_kite left join detail_kite on detail_kite.nokkKite=tbl_kite.nokk
WHERE tbl_kite.nokk='$_GET[id]'
ORDER BY tbl_kite.id ASC limit 0,20"); 
 $x=0;
  while($row=mysql_fetch_array($sql))
  {
	  $sql1=mysql_query("SELECT *,detail_kite.yard_ as yard_, detail_kite.yard_ as roll, detail_kite.net_wight as bruto
FROM tbl_kite left join detail_kite on detail_kite.nokkKite=tbl_kite.nokk
WHERE tbl_kite.nokk='$_GET[id]'
ORDER BY tbl_kite.id ASC limit 20,20"); 
$i=0;
while($row1=mysql_fetch_array($sql1))
{
	$ar[$i]=$row1['no_roll'];
	$ar1[$i]=$row1['bruto'];
	$ar2[$i]=$row1['yard_'];
	$i++;
}
$sql2=mysql_query("SELECT *,detail_kite.yard_ as yard_, detail_kite.yard_ as roll, detail_kite.net_wight as bruto
FROM tbl_kite left join detail_kite on detail_kite.nokkKite=tbl_kite.nokk
WHERE tbl_kite.nokk='$_GET[id]'
ORDER BY tbl_kite.id ASC limit 40,20"); 
$j=0;
while($row2=mysql_fetch_array($sql2))
{
	$ar3[$j]=$row2['no_roll'];
	$ar4[$j]=$row2['bruto'];
	$ar5[$j]=$row2['yard_'];
	$j++;
}
//cetak

if($jml>=41){
$Data .="| ".str_pad($row['no_roll'],4,"____",STR_PAD_LEFT)." | ".str_pad(number_format($row['bruto'],'2','.',','),9,"_____",STR_PAD_LEFT)." | ".str_pad(number_format($row['yard_'],'2','.',','),10,"______",STR_PAD_LEFT)." | ".str_pad($ar[$x],4,"____",STR_PAD_LEFT)." | ".str_pad(number_format($ar1[$x],'2','.',','),9,"_____",STR_PAD_LEFT)." | ".str_pad(number_format($ar2[$x],'2','.',','),10,"______",STR_PAD_LEFT)." | ".str_pad($ar3[$x],4,"____",STR_PAD_LEFT)." | ".str_pad(number_format($ar4[$x],'2','.',','),9,"_____",STR_PAD_LEFT)." | ".str_pad(number_format($ar5[$x],'2','.',','),10,"______",STR_PAD_LEFT)." | \n"; 
//$Data .="\n";
}else
if($jml>=21){
$Data .="| ".str_pad($row['no_roll'],4,"____",STR_PAD_LEFT)." | ".str_pad(number_format($row['bruto'],'2','.',','),9,"_____",STR_PAD_LEFT)." | ".str_pad(number_format($row['yard_'],'2','.',','),10,"______",STR_PAD_LEFT)." | ".str_pad($ar[$x],4,"____",STR_PAD_LEFT)." | ".str_pad(number_format($ar1[$x],'2','.',','),9,"_____",STR_PAD_LEFT)." | ".str_pad(number_format($ar2[$x],'2','.',','),10,"______",STR_PAD_LEFT)."|  \n"; 
//$Data .="\n";
}else
if($jml>=1){
$Data .="| ".str_pad($row['no_roll'],4,"____",STR_PAD_LEFT)." | ".str_pad(number_format($row['bruto'],'2','.',','),9,"_____",STR_PAD_LEFT)." | ".str_pad(number_format($row['yard_'],'2','.',','),10,"______",STR_PAD_LEFT)."|  \n"; 
//$Data .="\n";
}

$x++;
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
