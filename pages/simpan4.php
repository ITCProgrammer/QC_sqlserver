<title>CETAK</title>
<?php

	mysql_connect("192.168.0.254","root","gogogo");
	mysql_select_db("db_qc")or die("Gagal Koneksi");
$ql=mysql_query("select id,no_roll from detail_kite where nokkKite='$_POST[nokk]' and no_roll='$_POST[txt_roll]'");
$ql2=mysql_query("select id,no_roll from tmp_detail_kite where nokkKite='$_POST[nokk]' and no_roll='$_POST[txt_roll]'");
$rr=mysql_num_rows($ql);
$rr1=mysql_fetch_array($ql);
$rr2=mysql_fetch_array($ql2);
if ($rr!=0)
		{ ?>
			<script> 
			var msg;
			msg="No Roll <?php echo $_POST['txt_roll']; ?> Sudah ADA!! Anda ingin mengubah data ini?";
			var agree=confirm(msg);
			if(agree==true){
				<?php
			$simpan=mysql_query("UPDATE `db_qc`.`detail_kite` SET `net_wight` = '$_POST[txt_net_weight]',
`yard_` = '$_POST[txt_yard]' WHERE `detail_kite`.`id` ='$rr1[id]'") or die("Gagal");
			$simpantmp=mysql_query("UPDATE `db_qc`.`tmp_detail_kite` SET `net_wight` = '$_POST[txt_net_weight]',
`yard_` = '$_POST[txt_yard]' WHERE `tmp_detail_kite`.`id` ='$rr2[id]'") or die("Gagal");
		?>
		document.location.href='?kkno=<?php echo $_POST['nokk']; ?>&roll=<?php echo $_POST['txt_roll']; ?>&status=No Roll <?php echo $_POST['txt_roll']; ?> dengan No KK <?php echo $_POST['nokk']; ?> Sudah ADA!!';
				}else{
					document.location.href='?kkno=<?php echo $_POST['nokk']; ?>&roll=<?php echo $_POST['txt_roll']; ?>&status=No Roll <?php echo $_POST['txt_roll']; ?> dengan No KK <?php echo $_POST['nokk']; ?> Sudah ADA!!';}
</script>

			<?php

		}else{
			$cari=mysql_query("Select * from tbl_kite where nokk='$_POST[nokk]'");
			$row=mysql_num_rows($cari);
			if($_POST['fasilitas']=='SISA')
			{$sisa='SISA';}else if($_POST['fasilitas']=='FOC'){$sisa='FOC';}else if($_POST['fasilitas']=='FASILITAS KITE'){$sisa='KITE';}else if($_POST['fasilitas']=='TH'){$sisa='TH';}
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
	?>  
  
<script>
	var agree=confirm('Cetak');
	if(agree){
		window.location.href='form-Packing?kkno=<?php echo $_POST['nokk'];?>';
		window.open('pages/cetak/label.php?nokk=<?php echo $_POST['nokk'];?>&rol=<?php echo $_POST['txt_roll'];?>','scrollwindow','top=200,left=350,width=575,height=400');
	}
    else
    window.location.href='form-Packing';</script>
   
    <?php
}
		
		}
?>
