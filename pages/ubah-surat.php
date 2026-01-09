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
      <td width="15%">&nbsp;</td>
      <td width="1%">&nbsp;</td>
      <td width="84%">&nbsp;</td>
    </tr>
    <tr>
      <td>Tgl kirim</td>
      <td>:</td>
      <td><b><?php echo $row['tgl_kirim'];?></b></td>
    </tr>
    <tr>
      <td>No Surat Jalan</td>
      <td>:</td>
      <td><b><?php echo $row['no_sj'];?></b></td>
    </tr>
    <tr>
      <td>Tujuan</td>
      <td>:</td>
      <td><label for="tujuan"></label>
      <input type="text" name="tujuan" id="tujuan" value="<?php echo $row['tujuan'];?>"/></td>
    </tr>
    <tr>
      <td>Keterangan</td>
      <td>:</td>
      <td><label for="ket"></label>
      <input type="text" name="ket" id="ket" value="<?php echo $row['ket'];?>" /></td>
    </tr>
    <tr>
      <td><input type="submit" name="SIMPAN" id="SIMPAN" value="SIMPAN" /></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>
</body>
</html>
<?php 
if($_POST['SIMPAN']=="SIMPAN"){
	$qry=mysqli_query($con,"UPDATE tbl_pengiriman SET tujuan='".$_POST['tujuan']."', ket='".$_POST['ket']."' WHERE id='".$_GET['id']."'");
	if($qry)
	{ 
	echo "<script>alert('Data Tersimpan');window.location.href = window.location.href='?p=lihat_data_pengiriman';window.close();</script>";
		}
	
	}
?>