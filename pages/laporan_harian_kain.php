<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>LAPORAN HARIAN</title>
<script>
   
          function ganti()
{     var lprn= document.forms['form2']['lprn'].value;  
if(lprn=="Keluar"){
	window.location.href="index1.php?p=laporan_harian_kain_keluar";
	}
else if(lprn=="Persediaan"){
	window.location.href="index1.php?p=laporan_persediaan_kain";
	}
else if(lprn=="In-Out"){
	window.location.href="index1.php?p=laporan_inout_kain";
	}
}
           </script> 
</head>

<body>
<br />
 <form name="form2">
        JENIS LAPORAN: 
        <select name="lprn" onchange="ganti()">
          <option value="Masuk" >Masuk</option>
          <option value="Keluar">Keluar</option>
          <option value="In-Out">In-Out</option>
          <option value="Persediaan">Persediaan Kain</option>
        </select>
      </form>
      <br />
<form id="form1" name="form1" method="post" action="pages/lihat_data_kain_jadi.php">
  <table width="634">
    <tr>
      <td colspan="3"><div align="center">LAPORAN HARIAN KAIN JADI MASUK</div>
	 
	  <?php 
	  $user_name=$_SESSION['username'];
	  date_default_timezone_set('Asia/Jakarta');
	$tgl=date("Y-M-d h:i:s A");
	  echo $tgl;?><br />GROUP SHIFT: <strong><?php echo $_SESSION['username']; ?></strong></td>
    </tr>
    <tr>
      <td width="128">Tanggal Awal</td>
      <td width="5">:</td>
      <td width="433"><input type="text" id="awal" name="awal" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.awal);return false;"/>
      <a href="javascript:void(0)" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.awal);return false;"><img src="calender/calender.jpeg" alt="" name="popcal" width="34" height="29" id="popcal" style="border:none" align="absmiddle" border="0" /></a></td>
    </tr>
    <tr>
      <td>Tanggal Akhir</td>
      <td>:</td>
      <td><input type="text" id="akhir" name="akhir" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.akhir);return false;"/>
      <a href="javascript:void(0)" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.akhir);return false;"><img src="calender/calender.jpeg" alt="" name="popcal" width="34" height="29" id="popcal2" style="border:none" align="absmiddle" border="0" /></a></td>
    </tr>
    <tr>
      <td>Shift</td>
      <td>:</td>
      <td><label for="shift"></label>
        <select name="shift" id="shift">
          <option value="">Pilih</option>
          <option value="A">A</option>
          <option value="B">B</option>
          <option value="C">C</option>
      </select></td>
    </tr>
    <tr>
      <td>No Order</td>
      <td>:</td>
      <td><label for="order"></label>
      <input type="text" name="order" id="order" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><label>
          <input type="radio" name="ganti_stiker" value="1" id="ganti_stiker_0" />
          Ganti Stiker</label>
        
        <label>
          <input type="radio" name="ganti_stiker" value="2" id="ganti_stiker_1" />
          Potong Sisa</label>
		<label>
          <input type="radio" name="ganti_stiker" value="4" id="ganti_stiker_2" />
          Revisi Stiker</label>
		<label>
          <input type="radio" name="ganti_stiker" value="5" id="ganti_stiker_3" />
          Inspek Meja</label></td>
    
   
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><input name="ckKite" type="checkbox" id="ckKite" value="1" />
      <label for="ckKite">Fasilitas KITE </label></td>
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
