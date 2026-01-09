<?PHP
session_start();
include"koneksi.php";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>user</title>
</head>

<body>
<?php
if($_POST){ //login user
	extract($_POST);
	    $pass = $_POST['pass'];    
		$passNew = $_POST['passNew'];
		$passRe	  =	$_POST['passRe'];
	$sql=mysqli_query($con,"SELECT count(*) jml,id FROM user_login WHERE `user`='".$_SESSION['username']."' AND `password`='$pass' AND `level`='".$_SESSION['level']."' LIMIT 1");
	$dt=mysqli_fetch_array($sql);
	if($dt['jml']>0){
		if($passNew!=$passRe)
		{
			echo " <script>alert('Not Match Re-New Password!!');</script>";
			}else
			{
				$ip_num = $_SERVER['REMOTE_ADDR']; //untuk mendeteksi alamat IP
				$sqlupdate=mysqli_query($con,"UPDATE user_login SET `password`='$passNew' WHERE `user`='".$_SESSION['username']."' AND `password`='$pass' AND `level`='".$_SESSION['level']."' LIMIT 1");
				$sqllog=mysqli_query($con,"INSERT INTO tbl_log_user SET
				id_user='".$dt['id']."',
				password_lama='$pass',
				password_baru='$passNew',
				ip_address='$ip_num',
				tgl_update=now()");
				echo " <script>alert('Password has been Changed !!');</script>";
				}
		
		}
	else{ echo " <script>alert('Wrong Password!!');</script>"; }
	
}

?>
<form id="form1" name="form1" method="post" action="" enctype="multipart/form-data">
  <table width="100%" border="0" align="center">
    <tr>
      <td colspan="3"><h2>Ganti Password </h2></td>
    </tr>
    <tr>
      <td width="173"> Password Lama</td>
      <td width="8">:</td>
      <td width="920">
      <input type="password" name="pass" /></td>
    </tr>
    <tr>
      <td> Password Baru</td>
      <td>:</td>
      <td><input type="password" name="passNew" /></td>
    </tr>
    <tr>
      <td>Ulangi Password Baru</td>
      <td>:</td>
      <td><input type="password" name="passRe" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><input type="submit" name="ubah" value="Simpan"/></td>
    </tr>
  </table>
</form>
</body>
</html>