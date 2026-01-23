<title>CETAK</title>
<?php
include_once("../koneksi.php");
ini_set("error_reporting",1);
$ql=sqlsrv_query($con,"select id,no_roll from detail_kite where nokkKite='".$_POST['nokk']."' and no_roll='".$_POST['txt_roll']."'");
$ql2=sqlsrv_query($con,"select id,no_roll from tmp_detail_kite where nokkKite='".$_POST['nokk']."' and no_roll='".$_POST['txt_roll']."'");
$ql3=sqlsrv_query($con,"select id from tbl_kite where nokk='".$_POST['nokk']."'");
$rr=sqlsrv_num_rows($ql);
$rr1=sqlsrv_fetch_array($ql);
$rr2=sqlsrv_fetch_array($ql2);
$rr3=sqlsrv_fetch_array($ql3);
$cekdata1=sqlsrv_query($con,"select * from tbl_kite left join tmp_detail_kite on nokk=nokkkite  where nokk='".$_POST['nokk']."' order by tbl_kite.id desc");
$jns=addslashes($_POST['txt_jenis_kain']);
$stl=addslashes($_POST['txt_style']);
if ($rr!=0)
		{ ?>
			<script> 
			var msg;
			msg="No Roll <?php echo $_POST['txt_roll']; ?> Sudah ADA!! Anda ingin mengubah data ini?";
			var agree=confirm(msg); 
			if(agree==true){
				<?php
				$ubah=sqlsrv_query($con,"UPDATE `db_qc`.`tbl_kite` SET `pelanggan` = '$_POST[txt_pelanggan]',
`no_item` = '$_POST[txt_item]',
`warna` = '$_POST[txt_warna]',
`no_warna` = '$_POST[txt_no_warna]',
`no_po` = '$_POST[txt_nopo]',
`jenis_kain` = '$jns',
`no_order` = '$_POST[txt_order]',
`no_style` = '$stl',
`no_lot` = '$_POST[txt_lot]',
`no_mc` = '$_POST[no_mc]',
`nokk` = '$_POST[nokk]',
`bruto` = '$_POST[bruto]' WHERE `tbl_kite`.`id` ='$rr3[id]' ");
	
	
						$cekdt1=sqlsrv_fetch_array($cekdata1);
	if(substr($cekdt1['user_packing'],0,7)=='PACKING')
	{ 	
	
	$simpan1=sqlsrv_query($con,"INSERT into tbl_kite values('','$_POST[txt_pelanggan]','$_POST[txt_item]','$_POST[txt_warna]','$_POST[txt_no_warna]','$_POST[txt_lebar]','$_POST[txt_berat]','$_POST[txt_paket]','$_POST[txt_nopo]',																																												  '$jns','$_POST[txt_order]','$stl','$_POST[txt_lot]',DATE_SUB(NOW(), INTERVAL 1 hour),'$_POST[no_mc]','$_POST[nokk]','$_POST[bruto]','$_SESSION[username]','','')") or die("gagal");
	}
	$simpan=sqlsrv_query($con,"UPDATE `db_qc`.`detail_kite` SET `net_wight` = '$_POST[txt_net_weight]',
`yard_` = '$_POST[txt_yard]' WHERE `detail_kite`.`id` ='$rr1[id]'") or die("Gagal");
			$simpantmp=sqlsrv_query($con,"UPDATE `db_qc`.`tmp_detail_kite` SET `net_wight` = '$_POST[txt_net_weight]',
`yard_` = '$_POST[txt_yard]',`grade` = '$_POST[txt_grade]' WHERE `tmp_detail_kite`.`id` ='$rr2[id]'") or die("Gagal");
		?>
		document.location.href='?kkno=<?php echo $_POST['nokk']; ?>&roll=<?php echo $_POST['txt_roll']; ?>&status=No Roll <?php echo $_POST['txt_roll']; ?> dengan No KK <?php echo $_POST['nokk']; ?> Sudah ADA!!';
				}else{
					document.location.href='?kkno=<?php echo $_POST['nokk']; ?>&roll=<?php echo $_POST['txt_roll']; ?>&status=No Roll <?php echo $_POST['txt_roll']; ?> dengan No KK <?php echo $_POST['nokk']; ?> Sudah ADA!!';}
</script>

			<?php

		}else{
			$cari=sqlsrv_query($con,"Select * from tbl_kite where nokk='$_POST[nokk]'");
			$row=sqlsrv_num_rows($cari);
			if($_POST['fasilitas']=='SISA')
			{$sisa='SISA';}else if($_POST['fasilitas']=='FOC'){$sisa='FOC';}else if($_POST['fasilitas']=='FASILITAS KITE'){$sisa='KITE';}else if($_POST['fasilitas']=='TH'){$sisa='TH';}else if($_POST['fasilitas']=='BS'){$sisa='BS';}else if($_POST['fasilitas']=='BB'){$sisa='BB';}else if($_POST['fasilitas']=='FASILITAS KITE TH'){$sisa='FKTH';}else if($_POST['fasilitas']=='FASILITAS KITE SISA'){$sisa='FKSI';}
			if($row>0){
				if($_POST['tdkm']==""){$simpan=sqlsrv_query($con,"insert into detail_kite values('','$_POST[nokk]','$_POST[txt_grade]','$_POST[txt_roll]','$_POST[txt_net_weight]','$_POST[txt_yard]','$_POST[satuan]','$sisa')") or die("Gagal");}
				$simpantmp=sqlsrv_query($con,"insert into tmp_detail_kite values('','$_POST[nokk]','$_POST[txt_grade]','$_POST[txt_roll]','$_POST[txt_net_weight]','$_POST[txt_yard]','$_POST[satuan]','$sisa')") or die("Gagal");
				}else{

$tgl=date("Y-m-d H:i:s");
$simpan=sqlsrv_query($con,"INSERT INTO tbl_kite values('','$_POST[txt_pelanggan]','$_POST[txt_item]','$_POST[txt_warna]','$_POST[txt_no_warna]','$_POST[txt_lebar]','$_POST[txt_berat]','$_POST[txt_paket]','$_POST[txt_nopo]',																																												  '$jns','$_POST[txt_order]','$stl','$_POST[txt_lot]',DATE_SUB(NOW(), INTERVAL 1 hour),'$_POST[no_mc]','$_POST[nokk]','$_POST[bruto]','$_SESSION[username]','','')") or die("gagal");
if($_POST['tdkm']==""){$simpan=sqlsrv_query($con,"insert into detail_kite values('','$_POST[nokk]','$_POST[txt_grade]','$_POST[txt_roll]','$_POST[txt_net_weight]','$_POST[txt_yard]','$_POST[satuan]','$sisa')") or die("Gagal");}
$simpantmp=sqlsrv_query($con,"insert into tmp_detail_kite values('','$_POST[nokk]','$_POST[txt_grade]','$_POST[txt_roll]','$_POST[txt_net_weight]','$_POST[txt_yard]','$_POST[satuan]','$sisa')") or die("Gagal");
}
if($simpan ||$simpantmp )
{ 
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
$Data = $initialized;
$Data .= $condensed1;
$Data .= $bold1;
$Data .= "\n";
$Data .= "\n";
$Data .= str_pad($_POST['fasilitas'], 65, ' ',STR_PAD_LEFT)."\n";
$Data .= "\n";
$Data .= str_pad($_POST['txt_pelanggan'], 32, ' ',STR_PAD_LEFT).str_pad($_POST['txt_nopo'], 42, ' ',STR_PAD_LEFT)."\n";
$Data .= "\n"; 
$Data .= str_pad(' ', 10, ' ',STR_PAD_LEFT).str_pad($_POST['txt_item'], 20, ' ').str_pad($_POST['txt_jenis_kain'], 42, ' ',STR_PAD_LEFT)."\n"; 
$Data .="\n";
$Data .= str_pad(substr($_POST['txt_warna'],0,30), 32, ' ',STR_PAD_LEFT).str_pad($_POST['txt_order'], 42, ' ',STR_PAD_LEFT)."\n";
$Data .= str_pad(' ', 10, ' ',STR_PAD_LEFT).str_pad(substr($_POST['txt_warna'],30,20), 20, ' ')."\n";
$Data .= str_pad($_POST['txt_no_warna'], 32, ' ',STR_PAD_LEFT).str_pad($_POST['txt_style'], 42, ' ',STR_PAD_LEFT)."\n";
$Data .= "\n";
$Data .= "\n";
$Data .= str_pad(' ', 10, ' ',STR_PAD_LEFT).str_pad($_POST['txt_lebar'], 40, ' ').str_pad($_POST['txt_lot'], 22, ' ',STR_PAD_RIGHT)."\n";
$Data .= "\n";
$Data .= str_pad(' ', 10, ' ',STR_PAD_LEFT).str_pad($_POST['txt_berat'], 40, ' ').str_pad($_POST['txt_roll'], 22, ' ',STR_PAD_RIGHT)."\n";
$Data .= "\n";
$Data .= str_pad(' ', 10, ' ',STR_PAD_LEFT).str_pad($_POST['txt_yard'], 40, ' ').str_pad($_POST['txt_net_weight'], 22, ' ',STR_PAD_RIGHT)."\n";
$Data .= "\n";
$Data .= str_pad(' ', 10, ' ',STR_PAD_LEFT).str_pad($_POST['txt_paket'], 40, ' ').str_pad("GRADE ".$_POST['txt_grade'], 22, ' ',STR_PAD_RIGHT)."\n";
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
