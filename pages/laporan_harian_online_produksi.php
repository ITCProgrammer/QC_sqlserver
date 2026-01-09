<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script>
   
          function ganti()
{     var lprn= document.forms['form2']['lprn'].value;  
if(lprn=="Manual"){
	window.location.href="index1.php?p=laporan_harian_produksi";
	}

}
           </script> 
</head>

<body>
<br />
<form name="form2">
        JENIS LAPORAN: 
        <select name="lprn" onchange="ganti()">
          <option value="Online" >Online</option>
          <option value="Manual">Manual</option>
        </select>
      </form>
      <br />
<form id="form1" name="form1" method="post" action="pages/lihat_data_online_produksi.php">
  <table width="517">
    <tr>
      <td colspan="3"><div align="center">LAPORAN HARIAN ONLINE</div><?php 
	  $user_name=$_SESSION['username'];
	   date_default_timezone_set('Asia/Jakarta');
	$tgl=date("Y-M-d h:i:s A");
	  echo $tgl;?><br />GROUP SHIFT: <strong><?php echo $_SESSION['username']; ?></strong><br /></td>
    </tr>
    <tr>
      <td width="128">Tanggal Awal</td>
      <td width="5">:</td>
      <td width="368"><input type="text" id="awal" name="awal" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.awal);return false;"/>
      <a href="javascript:void(0)" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.awal);return false;"><img src="calender/calender.jpeg" alt="" name="popcal" width="34" height="29" id="popcal" style="border:none" align="absmiddle" border="0" /></a></td>
    </tr>
    <tr>
      <td><input type="submit" name="button" id="button" value="Cari Data" /></td>
      <td>&nbsp;</td>
      <td><input type="hidden" name="user_name" id="user_name" value="<?php echo $_SESSION['username']; ?>" /></td>
    </tr>
  </table>
</form>

</body>
</html>
