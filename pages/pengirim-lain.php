<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Laporan Pengiriman</title>
<script>
   
          function ganti()
{     var kategori= document.forms['form1']['kategori'].value;  
if(kategori==""){
	window.location.href="index1.php?p=pengirim";
	}

}
           </script> 
</head>

<body>
<br />
<form id="form1" name="form1" method="post" action="?p=lihat_data_pengiriman_lain">
  <table width="517">
    <tr>
      <td colspan="4"><div align="center">LAPORAN PENGIRIMAN</div> 
	 </div>
	  <?php 
	  $user_name=$_SESSION['username'];
	  date_default_timezone_set('Asia/Jakarta');
	$tgl=date("Y-M-d h:i:s A");
	  echo $tgl;?><br />GROUP SHIFT: <strong><?php echo $_SESSION['username']; ?></strong></td>
    </tr>
    <tr>
      <td>Katagori</td>
      <td>:</td>
      <td colspan="2"><label for="kategori"></label>
        <select name="kategori" id="kategori" onchange="ganti()">
          <option value="Lain-Lain">Lain-Lain</option>
          <option value="">Kain Body/Krah</option>
          
        </select></td>
    </tr>
    <tr>
      <td width="128">Tanggal Kirim</td>
      <td width="5">:</td>
      <td colspan="2"><input type="text" id="awal" name="awal" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.awal);return false;"/>
      <a href="javascript:void(0)" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.awal);return false;"><img src="calender/calender.jpeg" alt="" name="popcal" width="34" height="29" id="popcal" style="border:none" align="absmiddle" border="0" /></a></td>
    </tr>
    <tr>
    
      <td>No Surat Jalan</td>
      <td>:</td>
      <td colspan="2"><label for="no_sj"></label>
      <input type="text" name="no_sj" id="no_sj" /></td>
    </tr>
    <tr>
      <td><input type="submit" name="button" id="button" value="Cari Data" /></td>
      <td>&nbsp;</td>
      <td width="174"><a href="?p=surat-manual">Surat Jalan Manual</a></td>
      <td width="190"><a href="?p=surat-lain">Surat Jalan Lain-lain</a></td>
    </tr>
  </table>
</form>

</body>
</html>
