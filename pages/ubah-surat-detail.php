<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php 
$sql=mysqli_query($con,"SELECT * FROM tbl_pengiriman WHERE id='".$_GET['id']."'");
$row=mysqli_fetch_array($sql);
?>
<form id="form1" name="form1" method="post" action="">
  <table width="100%" border="0">
    <tr>
      <td width="14%">No Surat Jalan</td>
      <td width="1%">:</td>
      <td width="38%"><?php echo $row['no_sj'];?></td>
      <td width="10%">Tgl Kirim</td>
      <td width="1%">:</td>
      <td width="36%" colspan="3"><input type="text" id="awal" name="awal" value="<?php echo $row['tgl_kirim'];?>" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.awal);return false;"/>
      <a href="javascript:void(0)" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.awal);return false;"><img src="calender/calender.jpeg" alt="" name="popcal" width="34" height="29" id="popcal" style="border:none" align="absmiddle" border="0" /></a></td>
    </tr>
    <tr>
      <td>No Order</td>
      <td>:</td>
      <td><input name="no_order" type="text" id="no_order" size="25" value="<?php echo $row['no_order'];?>" /></td>
      <td>Warna</td>
      <td>:</td>
      <td colspan="3"><input name="warna" type="text" id="warna" size="20" value="<?php echo $row['warna'];?>" /></td>
    </tr>
    <tr>
      <td>No PO</td>
      <td>:</td>
      <td><input name="no_po" type="text" id="no_po" size="30" value="<?php echo $row['no_po'];?>" /></td>
      <td>Roll</td>
      <td>:</td>
      <td><input name="rol" type="text" id="rol" size="4" value="<?php echo $row['rol'];?>"/></td>
      <td align="right"><div align="right">FOC</div></td>
      <td align="center" valign="top"><label for="foc"></label>
        :
        <select name="foc" id="foc">
          <option value="" <?php if($row['foc']==""){echo "SELECTED";}?>>Tidak</option>
          <option value="FOC" <?php if($row['foc']=="FOC"){echo "SELECTED";}?>>Ya</option>
      </select></td>
    </tr>
    <tr>
      <td valign="top">Buyer</td>
      <td valign="top">:</td>
      <td><label for="tujuan">
        <textarea name="pelanggan" id="pelanggan" cols="30" rows="3"><?php echo $row['buyer'];?></textarea>
      </label></td>
      <td valign="top">Jenis Kain</td>
      <td valign="top">:</td>
      <td colspan="3" valign="top"><textarea name="jenis_kain" cols="30" rows="3" id="jenis_kain"><?php echo $row['jenis_kain'];?></textarea></td>
    </tr>
    <tr>
      <td valign="top">Lot</td>
      <td valign="top">:</td>
      <td valign="top"><label for="ket">
        <input name="lot" type="text" id="lot" size="6" value="<?php echo $row['lot'];?>" />
      </label></td>
      <td valign="top">Qty</td>
      <td valign="top">:</td>
      <td colspan="3"><input name="qty" type="text" id="qty" size="6" value="<?php echo $row['qty'];?>" /></td>
    </tr>
    <tr>
      <td><input type="submit" name="SIMPAN" id="SIMPAN" value="SIMPAN" /></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="3">&nbsp;</td>
    </tr>
  </table>
</form>
</body>
</html>
<?php 
if($_POST['SIMPAN']=="SIMPAN"){
	$qry=mysqli_query($con,"UPDATE tbl_pengiriman SET 
	no_order='".$_POST['no_order']."',
	no_po='".$_POST['no_po']."',
	buyer='".$_POST['pelanggan']."',
	lot='".$_POST['lot']."',
	tgl_kirim='".$_POST['awal']."',
	warna='".$_POST['warna']."',
	rol='".$_POST['rol']."',
	jenis_kain='".$_POST['jenis_kain']."',
	foc='".$_POST['foc']."',
	qty='".$_POST['qty']."' 
	WHERE id='".$_GET['id']."'");
	if($qry)
	{ 
	echo "<script>alert('Data Tersimpan');window.close();</script>";
		}
	
	}
?>