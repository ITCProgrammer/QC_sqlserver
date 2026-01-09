<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>LAPORAN MUTASI</title>
<script>
   
          function ganti()
{     var lprn= document.forms['form2']['lprn'].value;  
if(lprn=="Manual"){
	window.location.href="index1.php?p=laporan_harian_manager";
	}

}
           </script> 
</head>

<body>
 <form name="form2">
        JENIS LAPORAN: 
        <select name="lprn" onchange="ganti()">
       	  <option value="Online">Online</option>
          <option value="Manual" >Manual</option>
        </select>
      </form><br />
      <br />
<form id="form1" name="form1" method="post" action="pages/lihat_data_manager_online.php">
  <table width="517">
    <tr>
      <td colspan="3"><div align="center">LAPORAN HARIAN ONLINE</div>
	 </div>
	  <?php 
	  $user_name=$_SESSION['username'];
	  date_default_timezone_set('Asia/Jakarta');
	$tgl=date("Y-M-d h:i:s A");
	  echo $tgl;?><br />GROUP SHIFT: <strong><?php echo $_SESSION['username']; ?></strong></td>
    </tr>
    <tr>
      <td>Bagian</td>
      <td>:</td>
      <td><label for="bagian"></label>
        <select name="bagian" id="bagian">
          <option value="PACKING">PACKING</option>
          <option value="INSPEK MEJA">INSPEK MEJA</option>
      </select></td>
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
      </td>
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
