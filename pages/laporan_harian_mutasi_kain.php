<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script>
   
          function ganti()
{     var mts= document.forms['form2']['mts'].value;  
if(mts=="Online"){
	window.location.href="form-Packing?p=laporan_harian_mutasi_online_kain";
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
<form id="form1" name="form1" method="post" action="laporan-harian-mutasi">
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
      <td width="368">
        <select name="thn1" id="thn1">
        	
          <option value="2014" <?php if(date("Y")=='2014'){echo"Selected";} ?> >2014</option>
          <option value="2015" <?php if(date("Y")=='2015'){echo"Selected";} ?>>2015</option>
          <option value="2016" <?php if(date("Y")=='2016'){echo"Selected";} ?>>2016</option>
          <option value="2017" <?php if(date("Y")=='2017'){echo"Selected";} ?>>2017</option>
          <option value="2018" <?php if(date("Y")=='2018'){echo"Selected";} ?>>2018</option>
          <option value="2019" <?php if(date("Y")=='2019'){echo"Selected";} ?>>2019</option>
          <option value="2020" <?php if(date("Y")=='2020'){echo"Selected";} ?>>2020</option>
        </select>
        <select name="bln1" id="bln1">
          <option value="01" <?php if(date("m")=='01'){echo"Selected";} ?> >Januari</option>
          <option value="02" <?php if(date("m")=='02'){echo"Selected";} ?> >Febuari</option>
          <option value="03" <?php if(date("m")=='03'){echo"Selected";} ?> >Maret</option>
          <option value="04" <?php if(date("m")=='04'){echo"Selected";} ?>>April</option>
          <option value="05" <?php if(date("m")=='05'){echo"Selected";} ?>>Mei</option>
          <option value="06" <?php if(date("m")=='06'){echo"Selected";} ?>>Juni</option>
          <option value="07" <?php if(date("m")=='07'){echo"Selected";} ?>>Juli</option>
          <option value="08" <?php if(date("m")=='08'){echo"Selected";} ?>>Agustus</option>
          <option value="09" <?php if(date("m")=='09'){echo"Selected";} ?>>September</option>
          <option value="10" <?php if(date("m")=='10'){echo"Selected";} ?>>Oktober</option>
          <option value="11" <?php if(date("m")=='11'){echo"Selected";} ?>>November</option>
          <option value="12" <?php if(date("m")=='12'){echo"Selected";} ?> >Desember</option>
        </select>
        <select name="tgl1" id="tgl1">
          <option value="01" <?php if(date("d")=='01'){echo"Selected";} ?> >1</option>
          <option value="02" <?php if(date("d")=='02'){echo"Selected";} ?>>2</option>
          <option value="03" <?php if(date("d")=='03'){echo"Selected";} ?>>3</option>
          <option value="04" <?php if(date("d")=='04'){echo"Selected";} ?>>4</option>
          <option value="05" <?php if(date("d")=='05'){echo"Selected";} ?> >5</option>
          <option value="06" <?php if(date("d")=='06'){echo"Selected";} ?>>6</option>
          <option value="07" <?php if(date("d")=='07'){echo"Selected";} ?>>7</option>
          <option value="08"<?php if(date("d")=='08'){echo"Selected";} ?>>8</option>
          <option value="09"<?php if(date("d")=='09'){echo"Selected";} ?>>9</option>
          <option value="10"<?php if(date("d")=='10'){echo"Selected";} ?>>10</option>
          <option value="11"<?php if(date("d")=='11'){echo"Selected";} ?>>11</option>
          <option value="12"<?php if(date("d")=='12'){echo"Selected";} ?>>12</option>
          <option value="13"<?php if(date("d")=='13'){echo"Selected";} ?>>13</option>
          <option value="14"<?php if(date("d")=='14'){echo"Selected";} ?>>14</option>
          <option value="15"<?php if(date("d")=='15'){echo"Selected";} ?>>15</option>
          <option value="16"<?php if(date("d")=='16'){echo"Selected";} ?>>16</option>
          <option value="17"<?php if(date("d")=='17'){echo"Selected";} ?>>17</option>
          <option value="18"<?php if(date("d")=='18'){echo"Selected";} ?>>18</option>
          <option value="19" <?php if(date("d")=='19'){echo"Selected";} ?>>19</option>
          <option value="20"<?php if(date("d")=='20'){echo"Selected";} ?>>20</option>
          <option value="21"<?php if(date("d")=='21'){echo"Selected";} ?>>21</option>
          <option value="22"<?php if(date("d")=='22'){echo"Selected";} ?>>22</option>
          <option value="23"<?php if(date("d")=='23'){echo"Selected";} ?>>23</option>
          <option value="24"<?php if(date("d")=='24'){echo"Selected";} ?>>24</option>
          <option value="25"<?php if(date("d")=='25'){echo"Selected";} ?>>25</option>
          <option value="26"<?php if(date("d")=='26'){echo"Selected";} ?>>26</option>
          <option value="27"<?php if(date("d")=='27'){echo"Selected";} ?>>27</option>
          <option value="28"<?php if(date("d")=='28'){echo"Selected";} ?>>28</option>
          <option value="29"<?php if(date("d")=='29'){echo"Selected";} ?>>29</option>
          <option value="30"<?php if(date("d")=='30'){echo"Selected";} ?>>30</option>
          <option value="31"<?php if(date("d")=='31'){echo"Selected";} ?>>31</option>
        </select>
      
     
      </td>
    </tr>
    <tr>
      <td>Tanggal Akhir</td>
      <td>:</td>
      <td><select name="thn2" id="select4">
       <option value="2014" <?php if(date("Y")=='2014'){echo"Selected";} ?> >2014</option>
          <option value="2015" <?php if(date("Y")=='2015'){echo"Selected";} ?>>2015</option>
          <option value="2016" <?php if(date("Y")=='2016'){echo"Selected";} ?>>2016</option>
          <option value="2017" <?php if(date("Y")=='2017'){echo"Selected";} ?>>2017</option>
          <option value="2018" <?php if(date("Y")=='2018'){echo"Selected";} ?>>2018</option>
          <option value="2019" <?php if(date("Y")=='2019'){echo"Selected";} ?>>2019</option>
          <option value="2020" <?php if(date("Y")=='2020'){echo"Selected";} ?>>2020</option>
      </select>
        <select name="bln2" id="select5">
           <option value="01" <?php if(date("m")=='01'){echo"Selected";} ?> >Januari</option>
          <option value="02" <?php if(date("m")=='02'){echo"Selected";} ?> >Febuari</option>
          <option value="03" <?php if(date("m")=='03'){echo"Selected";} ?> >Maret</option>
          <option value="04" <?php if(date("m")=='04'){echo"Selected";} ?>>April</option>
          <option value="05" <?php if(date("m")=='05'){echo"Selected";} ?>>Mei</option>
          <option value="06" <?php if(date("m")=='06'){echo"Selected";} ?>>Juni</option>
          <option value="07" <?php if(date("m")=='07'){echo"Selected";} ?>>Juli</option>
          <option value="08" <?php if(date("m")=='08'){echo"Selected";} ?>>Agustus</option>
          <option value="09" <?php if(date("m")=='09'){echo"Selected";} ?>>September</option>
          <option value="10" <?php if(date("m")=='10'){echo"Selected";} ?>>Oktober</option>
          <option value="11" <?php if(date("m")=='11'){echo"Selected";} ?>>November</option>
          <option value="12" <?php if(date("m")=='12'){echo"Selected";} ?> >Desember</option>
        </select>
        <select name="tgl2" id="select6">
           <option value="01" <?php if(date("d")=='01'){echo"Selected";} ?> >1</option>
          <option value="02" <?php if(date("d")=='02'){echo"Selected";} ?>>2</option>
          <option value="03" <?php if(date("d")=='03'){echo"Selected";} ?>>3</option>
          <option value="04" <?php if(date("d")=='04'){echo"Selected";} ?>>4</option>
          <option value="05" <?php if(date("d")=='05'){echo"Selected";} ?> >5</option>
          <option value="06" <?php if(date("d")=='06'){echo"Selected";} ?>>6</option>
          <option value="07" <?php if(date("d")=='07'){echo"Selected";} ?>>7</option>
          <option value="08"<?php if(date("d")=='08'){echo"Selected";} ?>>8</option>
          <option value="09"<?php if(date("d")=='09'){echo"Selected";} ?>>9</option>
          <option value="10"<?php if(date("d")=='10'){echo"Selected";} ?>>10</option>
          <option value="11"<?php if(date("d")=='11'){echo"Selected";} ?>>11</option>
          <option value="12"<?php if(date("d")=='12'){echo"Selected";} ?>>12</option>
          <option value="13"<?php if(date("d")=='13'){echo"Selected";} ?>>13</option>
          <option value="14"<?php if(date("d")=='14'){echo"Selected";} ?>>14</option>
          <option value="15"<?php if(date("d")=='15'){echo"Selected";} ?>>15</option>
          <option value="16"<?php if(date("d")=='16'){echo"Selected";} ?>>16</option>
          <option value="17"<?php if(date("d")=='17'){echo"Selected";} ?>>17</option>
          <option value="18"<?php if(date("d")=='18'){echo"Selected";} ?>>18</option>
          <option value="19" <?php if(date("d")=='19'){echo"Selected";} ?>>19</option>
          <option value="20"<?php if(date("d")=='20'){echo"Selected";} ?>>20</option>
          <option value="21"<?php if(date("d")=='21'){echo"Selected";} ?>>21</option>
          <option value="22"<?php if(date("d")=='22'){echo"Selected";} ?>>22</option>
          <option value="23"<?php if(date("d")=='23'){echo"Selected";} ?>>23</option>
          <option value="24"<?php if(date("d")=='24'){echo"Selected";} ?>>24</option>
          <option value="25"<?php if(date("d")=='25'){echo"Selected";} ?>>25</option>
          <option value="26"<?php if(date("d")=='26'){echo"Selected";} ?>>26</option>
          <option value="27"<?php if(date("d")=='27'){echo"Selected";} ?>>27</option>
          <option value="28"<?php if(date("d")=='28'){echo"Selected";} ?>>28</option>
          <option value="29"<?php if(date("d")=='29'){echo"Selected";} ?>>29</option>
          <option value="30"<?php if(date("d")=='30'){echo"Selected";} ?>>30</option>
          <option value="31"<?php if(date("d")=='31'){echo"Selected";} ?>>31</option>
      </select>
      <?php 
	  date_default_timezone_set('Asia/Jakarta');
	  ?>
      </td>
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
