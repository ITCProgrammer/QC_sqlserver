<title>CETAK</title>
<?php


include("koneksi.php");
$ql=mysql_query("select no_roll from detail_kite where nokkKite='$_POST[nokk]' and no_roll='$_POST[txt_roll]'");
$rr=mysql_num_rows($ql);
$rr1=mysql_fetch_array($ql);
if ($rr!=0)
		{
			echo "<script> document.location.href='?kkno=$_POST[nokk]&roll=$_POST[txt_roll]&status=No Roll $_POST[txt_roll] dengan No KK $_POST[nokk] Sudah ADA!!'; </script>";
		}else{
			$cari=mysql_query("Select * from tbl_kite where nokk='$_POST[nokk]'");
			$row=mysql_num_rows($cari);
			if($_POST['fasilitas']=='SISA')
			{$sisa='SISA';}else if($_POST['fasilitas']=='EXTRA'){$sisa='EXTRA';}
			if($row>0){
				if($_POST['tdkm']==""){$simpan=mysql_query("insert into detail_kite values('','$_POST[nokk]','$_POST[txt_grade]','$_POST[txt_roll]','$_POST[txt_net_weight]','$_POST[txt_yard]','$_POST[satuan]','$sisa')") or die("Gagal");}
				$simpantmp=mysql_query("insert into tmp_detail_kite values('','$_POST[nokk]','$_POST[txt_grade]','$_POST[txt_roll]','$_POST[txt_net_weight]','$_POST[txt_yard]','$_POST[satuan]','$sisa')") or die("Gagal");
				}else{

$tgl=date("Y-m-d H:i:s");
$simpan=mysql_query("INSERT INTO tbl_kite values('','$_POST[txt_pelanggan]','$_POST[txt_item]','$_POST[txt_warna]','$_POST[txt_no_warna]','$_POST[txt_lebar]','$_POST[txt_berat]','$_POST[txt_paket]','$_POST[txt_nopo]',																																												  '$_POST[txt_jenis_kain]','$_POST[txt_order]','$_POST[txt_style]','$_POST[txt_lot]','$tgl','$_POST[no_mc]','$_POST[nokk]','$_POST[bruto]','$_SESSION[username]')") or die("gagal");
if($_POST['tdkm']==""){$simpan=mysql_query("insert into detail_kite values('','$_POST[nokk]','$_POST[txt_grade]','$_POST[txt_roll]','$_POST[txt_net_weight]','$_POST[txt_yard]','$_POST[satuan]','$sisa')") or die("Gagal");}
$simpantmp=mysql_query("insert into tmp_detail_kite values('','$_POST[nokk]','$_POST[txt_grade]','$_POST[txt_roll]','$_POST[txt_net_weight]','$_POST[txt_yard]','$_POST[satuan]','$sisa')") or die("Gagal");
}
if($simpan ||$simpantmp )
{
	$ip = $_SERVER['REMOTE_ADDR'];
	$tmpdir = sys_get_temp_dir();
$file = tempnam($tmpdir, 'ctk');
$handle = fopen($file, 'w');
$condensed = Chr(27) . Chr(33) . Chr(4);
$bold1 = Chr(27) . Chr(69); 
$bold0 = Chr(27) . Chr(70);
$initialized = chr(27).chr(64); 
$condensed1 = chr(15);
$condensed0 = chr(18);
$Data = $initialized;
$Data .= $condensed1;


$Data .= "\n";
$Data .= "\n";
$Data .= "                                                      ".$bold1.$_POST['fasilitas'].$bold0."\n";
$Data .= "\n";
$Data .= "            ".$_POST['txt_pelanggan']."\n";
$Data .= "                                                      ".$_POST['txt_nopo']."\n";
$Data .= "            ".$_POST['txt_item']."\n";  
$Data .= "                                                      ".$_POST['txt_jenis_kain']."\n";
$Data .= "            ".$_POST['txt_warna']."\n";
$Data .= "                                                      ".$_POST['txt_order']."\n";
$Data .= "            ".$_POST['txt_no_warna']."\n";
$Data .= "                                                      ".$_POST['txt_style']."\n";
$Data .= "            ".$bold1.$_POST['txt_lebar']."\n";
$Data .= "                                                      ".$bold1.$_POST['txt_lot']."\n";
$Data .= "            ".$bold1.$_POST['txt_berat']."\n";
$Data .= "                                                      ".$bold1.$_POST['txt_roll']."\n";
$Data .= "            ".$bold1.$_POST['txt_yard'].$_POST['mtr'].$bold0."\n";
$Data .= "                                                      ".$bold1.$_POST['txt_net_weight'].$bold0."\n";
$Data .= "            ".$_POST['txt_paket']."\n";
$Data .= "                                                      ".$bold1.$_POST['txt_grade']."\n";
$Data .= "\n";
$Data .= "\n";
$Data .= "\n";
$Data .= "\n";
$Data .= "\n";
$Data .= "\n";
$Data .= "\n";
fwrite($handle, $Data);
fclose($handle);
copy($file, "//".$ip."/printerku");
unlink($file);
	
	?>
    <script>
	var agree=confirm('Input lagi');
	if(agree)window.location.href='form-Packing?kkno=<?php echo $_POST['nokk'];?>';
    else
    window.location.href='form-Packing';</script>
    <?php
}
		
		}
?>
