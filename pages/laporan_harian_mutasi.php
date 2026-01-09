<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Mutasi</title>
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
<form id="form1" name="form1" method="post" action="pages/lihat_data_mutasi.php">
  <table width="517">
    <tr>
      <td colspan="3"><div align="center"> MUTASI</div><?php 
	  $user_name=$_SESSION['username'];
	  date_default_timezone_set('Asia/Jakarta');
	$tgl=date("Y-M-d h:i:s A");
	  echo $tgl;?><br />GROUP SHIFT: <strong><?php echo $_SESSION['username']; ?></strong></td>
    </tr>
    <tr>
      <td width="128">Tanggal Awal</td>
      <td width="5">:</td>
      <td width="368"><input type="text" id="awal" name="awal" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.awal);return false;"/>
      <a href="javascript:void(0)" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.awal);return false;"><img src="calender/calender.jpeg" alt="" name="popcal" width="34" height="29" id="popcal" style="border:none" align="absmiddle" border="0" /></a></td>
    </tr>
    <tr>
    
      <td>Shift</td>
      <td>:</td>
      <td>
     
        <select name="sift" id="select">
          <option value="3" <?php if(date("H:i:s")>="23:00:00" && date("H:i:s")<="06:59:59"){echo "selected";} ?>>3</option>
          <option value="1" <?php if(date("H:i:s")>="07:00:00" && date("H:i:s")<="14:59:59"){echo "selected";} ?>>1</option>
          <option value="2" <?php if(date("H:i:s")>="15:00:00" && date("H:i:s")<="22:59:59"){echo "selected";} ?>>2</option>
        </select>
       
        <input type="hidden" name="user_name" id="user_name" value="<?php echo $_SESSION['username']; ?>" />
        <input type="radio" name="bs" id="bs" value="BS"/>BS
		<input type="radio" name="bs" id="bs" value="GUDANG GREIGE"/>Gudang Greige</td>
    </tr>
    <tr>
      <td><input type="submit" name="button" id="button" value="Cari Data" /></td>
      <td>&nbsp;</td>
      <td><input type="button" name="button2" id="button2" value="Hapus Mutasi" onclick="window.location.href='?p=laporan_harian_mutasi_hapus'"/></td>
    </tr>
  </table>
</form>

</body>
</html>
