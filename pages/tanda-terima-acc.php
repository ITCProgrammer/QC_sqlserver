<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Tanda Terima Acc</title>
</head>

<body>
<br />
<form id="form1" name="form1" method="post" action="?p=lihat_data_tanda_terima_acc">
  <table width="767">
    <tr>
      <td colspan="5"><div align="center">TANDA TERIMA ACC</div> 
	  <?php 
	  $user_name=$_SESSION['username'];
	  date_default_timezone_set('Asia/Jakarta');
	$tgl=date("Y-M-d h:i:s A");
	  echo $tgl;?><br />GROUP SHIFT: <strong><?php echo $_SESSION['username']; ?></strong></td>
    </tr>
    <tr>
      <td>No Surat Jalan</td>
      <td>:</td>
      <td width="12%"><label for="no_sj1"></label><input type="text" name="no_sj1" id="no_sj1" /></td>
      <td>S/D</td>
      <td><label for="no_sj2"></label><input type="text" name="no_sj2" id="no_sj2" /></td>
    </tr>
    <tr>
      <td><input type="submit" name="button" id="button" value="Cari Data" /></td>
      <!--<td width="219"><a href="?p=surat-lain">Surat Jalan Lain-lain</a></td>
	  <td width="219"><a href="?p=cek-nokk">Cek Nokk Surat Jalan</a></td>-->
    </tr>
  </table>
</form>
</body>
</html>
