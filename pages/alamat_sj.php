<?php
include_once("../koneksi.php"); 
ini_set("error_reporting",1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Potong Kain</title>
				
</head>

<body>
<?php 
if($_POST['SIMPAN']=='SIMPAN'){
	$alamat=str_replace("'","''", $_POST['alamat']);
	sqlsrv_query($con,"UPDATE packing_list SET `alamat1`='".$alamat."' WHERE id=".$_GET['id']."")or die("Gagal simpan");
	echo "<script>alert('Data Tersimpan, Harap Refresh Surat Jalan');window.close();</script>";
}
$data=sqlsrv_query($con,"SELECT * FROM packing_list
WHERE id='".$_GET['id']."'");
$rowd=sqlsrv_fetch_array($data);

?>
<form id="form1" name="form1" method="post" action="" enctype="multipart/form-data">
  <table width="50%" border="0" align="center">
    <tr>
      <td colspan="3" bgcolor="#00FFCC">Alamat Kirim</td>
    </tr>
    <tr bgcolor="#FFFF99">
      <td width="11%">No SJ</td>
      <td width="2%">:</td>
      <td width="87%"><?php echo $rowd['no_sj'];?></td>
    </tr>
    <tr bgcolor="#CCCCCC">
      <td >Tgl Kirim</td>
      <td >:</td>
      <td ><?php echo $rowd['tgl_update'];?>
      <input type="hidden" name="id" value="<?php echo $_GET['id'];?>" /></td>
    </tr>
    <tr bgcolor="#FFFF99">
      <td>Tgl Buat</td>
      <td>:</td>
      <td><?php echo $rowd['tgl_buat'];?></td>
    </tr>
    <tr bgcolor="#CCCCCC">
      <td valign="top">Alamat</td>
      <td valign="top">:</td>
      <td valign="top"><textarea name="alamat" id="alamat" cols="45" rows="3"><?php echo $rowd['alamat1'];?></textarea></td>
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