<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script>
   
          function ganti()
{     var lprn= document.forms['form2']['lprn'].value;  
if(lprn=="Online"){
	window.location.href="index1.php?p=cek_harian_online";
	}

}
           </script> 
<style type="text/css">
.hurufs {
	color: #FFFFFF;
}
</style>
</head>

<body>
<form id="form1" name="form1" method="post" action="?p=mutasi_detail_ins">
  <table width="517">
    <tr>
      <td colspan="3"><div align="center">CEK INSPEK</div> 
	 </div>
	  <?php 
	  $user_name=$_SESSION['username'];
	  date_default_timezone_set('Asia/Jakarta');
	$tgl=date("Y-M-d h:i:s A");
	  echo $tgl;?><br />GROUP SHIFT: <strong><?php echo $_SESSION['username']; ?></strong></td>
    </tr>
    <tr>
      <td width="128">Nokk</td>
      <td width="5">:</td>
      <td width="368"><label for="kk"></label>
      <input type="text" name="kk2" id="kk2" /></td>
    </tr>
    <tr>
      <td><input type="submit" name="button" id="button" value="Cari Data" 
      /></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>
</h3>
<hr />
</body>
</html>
