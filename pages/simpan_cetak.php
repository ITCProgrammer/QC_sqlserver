<script> alert("Cetak");
window.location.href='../form-Packing?kkno=<?php echo $_GET['nokk'];?>';
</script>
<?php
	include("../koneksi.php");
$sql=mysql_query("SELECT *,no_roll,net_wight,yard_,grade,satuan FROM tbl_kite INNER JOIN detail_kite ON detail_kite.nokkKite = tbl_kite.nokk where tbl_kite.nokk='$_GET[nokk]' and no_roll='$_GET[rol]'");
 $row=mysql_fetch_array($sql);
 if($row['satuan']=="Meter"){$rmtr="M";} 
$ip = $_SERVER['REMOTE_ADDR'];
$tmpdir = sys_get_temp_dir();
$file = tempnam($tmpdir, 'ctk');
$handle = fopen($file, 'w');
$condensed = Chr(27) . Chr(33) . Chr(4);
$roman1=Chr(27).Chr(120).Chr(48);
$roman0=Chr(27).Chr(120).Chr(49);
$sans = chr(27).chr(107).chr(49);
$bold1 = Chr(27).Chr(69); 
$bold0 = Chr(27).Chr(70);
$tebal=Chr(14);
$ukuran=Chr(27).Chr(116).Chr(20);
$initialized = Chr(27).Chr(64); 
$condensed1 = Chr(15);
$condensed0 = Chr(18);
if($row['sisa']=="FOC"){$ket="FOC";}else if($row['sisa']=="SISA"){$ket="SISA";}else if($row['sisa']=="TH"){$ket="TH";}
else if($row['sisa']=="KITE"){$ket="FASILITAS KITE";}
$Data = $initialized;
$Data .= $sans;
$Data .= $bold1;
$Data .= "\n";
$Data .= "\n";
$Data .= "                                                      ".$ket."\n";
$Data .= "\n";
$Data .= "         ".$row['pelanggan']."\n";
$Data .= "                                                        ".$row['no_po']."\n";
$Data .= "                  ".$row['no_item']."\n";
$Data .= "                                                        ".$row['jenis_kain']."\n";
$Data .= "                  ".$row['warna']."\n";
$Data .= "                                                        ".$row['no_order']."\n";
$Data .= "                  ".$row['no_warna']."\n";
$Data .= "                                                        ".$row['no_style']."\n";
$Data .= "                  ".$row['lebar']."\n";
$Data .= "                                                        ".$row['no_lot']."\n";
$Data .= "                  ".$row['berat']."\n";
$Data .= "                                                        ".$row['no_roll']."\n";
$Data .= "                  ".$row['yard_'].$rmtr."\n";
$Data .= "                                                        ".$row['net_wight']."\n";
$Data .= "                  ".$row['paket']."\n";
$Data .= "                                                        ".$row['grade']."\n";
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


	
