<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script>
   
          function ganti()
{     var mts= document.forms['form2']['mts'].value;  
if(mts=="Online"){
	window.location.href="index1.php?p=laporan_harian_mutasi_online";
	}

}
	
           </script>
</head>

<body>
<form name="form2">
        JENIS MUTASI: 
        <select name="mts" onchange="ganti()">
          <option value="Manual" >Manual</option>
          <option value="Online">Online</option>
        </select>
      </form><br />
      <br />
<form id="form1" name="form1" method="post" action="pages/lihat_data_mutasi_hapus.php">
  <table width="517">
    <tr>
      <td colspan="3"><div align="center"> HAPUS MUTASI</div><?php 
	  $user_name=$_SESSION['username'];
	  date_default_timezone_set('Asia/Jakarta');
	$tgl=date("Y-M-d h:i:s A");
	  echo $tgl;?><br />GROUP SHIFT: <strong><?php echo $_SESSION['username']; ?></strong></td>
    </tr>
    <tr>
      <td width="128">No Mutasi</td>
      <td width="5">:</td>
      <td width="368"><label for="no_mutasi"></label>
      <input type="text" name="no_mutasi" id="no_mutasi" /></td>
    </tr>
    <tr>
      <td><input type="submit" name="button" id="button" value="Cari Data" /></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>

</body>
</html>
