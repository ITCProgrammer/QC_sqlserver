<?php
include("../koneksi.php");
ini_set("error_reporting",1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Potong Kain</title>
<script>
function jumlah()
{
				var lebar = document.forms['form1']['txt_lebar'].value;
				var berat = document.forms['form1']['txt_berat'].value;
				var netto = document.forms['form1']['txt_net_weight'].value;
				var satuan = document.forms['form1']['satuan'].value;
        
				var x,yard,meter;
				
					x=((parseInt(lebar)+2)*parseInt(berat))/43.05;
					x1=(1000/x);
					yard=x1*parseFloat(netto);
					meter=yard*(768/840);
}
</script>					
</head>

<body>
<?php 
if($_POST['SIMPAN']=='SIMPAN'){
	mysqli_query($con,"UPDATE detail_pergerakan_stok SET `weight`='".$_POST['netto2']."',`yard_`='".$_POST['yard2']."'  where id=".$_GET['id']."")or die("Gagal");
		mysqli_query($con,"UPDATE tmp_detail_kite SET `net_wight`='".$_POST['netto2']."',`yard_`='".$_POST['yard2']."'  where SN=".$_GET['sn']."")or die("Gagal1");
	echo "<script>alert('Data Tersimpan, Harap Refresh Packing list');window.close();</script>";
}
$data=mysqli_query($con,"SELECT *,a.`yard_` as `yard2` from detail_pergerakan_stok a
LEFT JOIN tmp_detail_kite b ON a.id_detail_kj=b.id
LEFT JOIN tbl_kite c ON b.id_kite=c.id
WHERE a.id='".$_GET['id']."'");
$rowd=mysqli_fetch_array($data);

?>
<form id="form1" name="form1" method="post" action="" enctype="multipart/form-data">
  <table width="50%" border="0" align="center">
    <tr>
      <td colspan="3" bgcolor="#00FFCC">Potong Kain 1</td>
    </tr>
    <tr bgcolor="#FFFF99">
      <td width="11%">No KK</td>
      <td width="2%">:</td>
      <td width="87%"><?php echo $rowd['nokk'];?></td>
    </tr>
    <tr bgcolor="#CCCCCC">
      <td >SN</td>
      <td >:</td>
      <td ><?php echo $rowd['SN'];?>
      <input type="hidden" name="satuan" value="<?php echo $rowd['satuan'];?>" /></td>
    </tr>
    <tr bgcolor="#FFFF99">
      <td>No Roll</td>
      <td>:</td>
      <td><?php echo $rowd['no_roll'];?>
      <input type="hidden" name="lebar" id="lebar" value="<?php echo $rowd['lebar'];?>" /></td>
    </tr>
    <tr bgcolor="#CCCCCC">
      <td>Panjang</td>
      <td>:</td>
      <td><input name="yard2" type="text"  size="6" style="text-align:right;" value="<?php echo $rowd['yard2'];?>" /><?php echo " ".$rowd['satuan'];?>
      <input type="hidden" name="berat" id="berat" value="<?php echo $rowd['berat'];?>" /> </td>
    </tr>
    <tr bgcolor="#FFFF99">
      <td>Netto</td>
      <td>:</td>
      <td><input name="netto2" type="text"  size="6" style="text-align:right;" value="<?php echo $rowd['weight'];?>" />
        kg</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><label for="nett"></label></td>
    </tr>
    <tr bgcolor="#CCCCCC">
      <td><input type="submit" name="SIMPAN" id="SIMPAN" value="SIMPAN" /></td>
      <td>&nbsp;</td>
      <td><input type="submit" name="Batal" id="Batal" value="BATAL" onclick="window.close();" /></td>
    </tr>
  </table>
</form>
</body>
</html>
<?php mysqli_close($con); ?>