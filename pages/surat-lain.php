<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Surat Jalan Manual Lain-Lain</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="100%" border="0">
    <tr>
      <td>No. Surat Jalan</td>
      <td>:</td>
      <td><input name="no_sj" type="text" id="no_sj" size="7"  onchange="window.location='?p=surat-lain&amp;no_sj='+this.value"  value="<?php echo $_GET['no_sj'];?>" required="required"/>
        *</td>
      <td width="7%">&nbsp;</td>
      <td width="1%">&nbsp;</td>
      <td width="14%">&nbsp;</td>
      <td width="6%">&nbsp;</td>
      <td width="1%">&nbsp;</td>
      <td width="42%" colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td>Tgl Kirim</td>
      <td>:</td>
      <td><input name="awal" type="text" id="awal" value="<?php echo $_GET['tglkirim'];?>" onchange="window.location='?p=surat-lain&amp;no_sj=<?php echo $_GET['no_sj'];?>&amp;tglkirim='+this.value"  placeholder="0000-00-00" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}$"  required="required" size="10"/>
        *</td>
      <?php 
			$sql=mysqli_query($con,"select * from tbl_pengiriman where no_sj='".$_GET['no_sj']."' and tgl_kirim='".$_GET['tglkirim']."' and kategori='lain-lain' order by id asc");
			$d=mysqli_fetch_array($sql);
			?>
      <td>No. PO</td>
      <td>:</td>
      <td><input name="no_po" type="text" id="no_po" size="15" value="<?php echo $d['no_po'];?>" /></td>
      <td>Roll</td>
      <td>:</td>
      <td><input name="rol" type="text" id="rol" size="4" pattern="[0-9]{1,}" required placeholder="0" /></td>
      <td>FOC</td>
      <td><label for="foc"></label>
        :
        <select name="foc" id="foc">
          <option value="" <?php if($d['foc']==""){echo "SELECTED";}?>>Tidak</option>
          <option value="FOC" <?php if($d['foc']=="FOC"){echo "SELECTED";}?>>Ya</option>
      </select></td>
    </tr>
    <tr>
      <td>Tgl Buat</td>
      <td>:</td>
      <td><input name="buat" type="text" id="buat" value="<?php echo $d['tgl_buat'];?>" placeholder="0000-00-00" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}$"  required="required" size="10"/></td>
      <td>Tujuan</td>
      <td>:</td>
      <td><input name="tujuan" type="text" id="tujuan" size="10" value="<?php echo $d['tujuan'];?>" /></td>
      <td>Qty</td>
      <td>:</td>
      <td><input name="qty" type="text" id="qty" size="6" pattern="[0-9.]{1,}" placeholder="0.00" required /></td>
      <td>Kategori</td>
      <td>:
        <label for="kategori"></label>
        <select name="kategori" id="kategori">
          <option value="lain-lain">lain-lain</option>
      </select></td>
    </tr>
    <tr>
      <td>No. Order</td>
      <td>:</td>
      <td><input name="no_order" type="text" id="no_order" size="15" value="<?php echo $d['no_order'];?>" /></td>
      <td>Lot</td>
      <td>:</td>
      <td><input name="lot" type="text" id="lot" size="6" /></td>
      <td>Warna</td>
      <td>:</td>
      <td colspan="3"><input name="warna" type="text" id="warna" size="20" /></td>
    </tr>
    <tr>
      <td valign="top">Buyer</td>
      <td valign="top">:</td>
      <td>
      <textarea name="pelanggan" id="pelanggan" cols="20" rows="3"><?php echo $d['buyer'];?></textarea></td>
      <td valign="top">Ket</td>
      <td valign="top">:</td>
      <td valign="top"><textarea name="ket" cols="20" rows="3" id="ket"><?php echo $d['ket'];?></textarea></td>
      <td valign="top">Jenis Kain/ Barang</td>
      <td valign="top">:</td>
      <td colspan="3" valign="top"><textarea name="jenis_kain" cols="20" rows="3" id="jenis_kain"></textarea></td>
    </tr>
    <tr>
      <td><input type="submit" name="SIMPAN" id="SIMPAN" value="SIMPAN" /></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="3">&nbsp;</td>
    </tr>
  </table>
</form>
<br />
<table width="100%"  border="0">
  <tr align="center" bgcolor="#66FF99">
    <td width="3%">NO</td>
    <td width="5%">ROLL</td>
    <td width="5%">KG</td>
    <td width="26%">WARNA</td>
    <td width="51%">JENIS KAIN/NAMA BARANG</td>
    <td width="4%">LOT</td>
    <td width="4%">FOC</td>
    <td width="6%">AKSI</td>
  </tr>
  <?php 
			$qry=mysqli_query($con,"select * from tbl_pengiriman where no_sj='".$_GET['no_sj']."' and tgl_kirim='".$_GET['tglkirim']."' and tmp_hapus='0' and kategori='lain-lain' order by id asc");
			$no=1;
			while($row=mysqli_fetch_array($qry)){
	$bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99';
  ?>
  <tr bgcolor="<?php echo $bgcolor;?>" >
    <td align="center"><?php echo $no; ?></td>
    <td align="right"><?php echo $row['rol']; ?></td>
    <td align="right"><?php echo $row['qty']; ?></td>
    <td><?php echo $row['warna']; ?></td>
    <td><?php echo $row['jenis_kain']; ?></td>
    <td align="center"><?php echo $row['lot']; ?></td>
    <td align="center"><?php echo $row['foc']; ?></td>
    <td align="center"><a href="?p=surat-lain&id=<?php echo $row['id'];?>&h=1&sj=<?php echo $_GET['no_sj'];?>&tglkirim=<?php echo $_GET['tglkirim'];?>">HAPUS</a></td>
  </tr>
  <?php $no++;}?>
</table>
</body>
</html>
<?php
if($_POST['SIMPAN']=="SIMPAN"){
	$jk=addslashes($_POST['jenis_kain']);
	$po=addslashes($_POST['no_po']);
	$qrysimpan=mysqli_query($con,"INSERT INTO `tbl_pengiriman` (`no_sj`, `warna`, `rol`, `qty`, `buyer`, `no_po`, `no_order`, `jenis_kain`, `lot`, `tujuan`, `ket`, `tgl_kirim`, `tgl_buat`, `tgl_update`,`tmp_hapus`,`foc`,`kategori`) VALUES ('".$_POST['no_sj']."', '".$_POST['warna']."', '".$_POST['rol']."', '".$_POST['qty']."', '".$_POST['pelanggan']."', '$po', '".$_POST['no_order']."', '$jk', '".$_POST['lot']."', '".$_POST['tujuan']."', '".$_POST['ket']."', '".$_POST['awal']."', '".$_POST['buat']."', now(),'0','".$_POST['foc']."','".$_POST['kategori']."')");
	if($qrysimpan){
		echo "<script> alert('Data Tersimpan');window.location.href='?p=surat-lain&no_sj=".$_POST['no_sj']."'</script>";
		}
	}
if($_GET['h']=="1"){
	$sqllist=mysqli_query($con,"SELECT * FROM tbl_pengiriman WHERE id=".$_GET['id']." ");
	$rlist=mysqli_fetch_array($sqllist);
	$sqlhapus=mysqli_query($con,"UPDATE packing_list SET no_sj=null WHERE id='".$rlist['id_list']."'");
	$qryhapus=mysqli_query($con,"UPDATE tbl_pengiriman SET id_list=null,`tmp_hapus`='1' WHERE id=".$_GET['id']."");
	if($qryhapus){
		echo "<script> alert('Data Telah dihapus');window.location.href='?p=surat-lain&no_sj=".$_GET['sj']."&tglkirim=",$_GET['tglkirim'],"'</script>";}
	}	
?>