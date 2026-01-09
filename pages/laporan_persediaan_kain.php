<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>LAPORAN HARIAN</title>
  <script>
    function ganti() {
      var lprn = document.forms['form2']['lprn'].value;
      if (lprn == "Keluar") {
        window.location.href = "index1.php?p=laporan_harian_kain_keluar";
      } else if (lprn == "Masuk") {
        window.location.href = "index1.php?p=laporan_harian_kain";
      } else if (lprn == "In-Out") {
        window.location.href = "index1.php?p=laporan_inout_kain";
      }
    }
  </script>
</head>

<body>
  <br />
  <form name="form2">
    JENIS LAPORAN:
    <select name="lprn" onchange="ganti()">
      <option value="Persediaan">Persediaan Kain</option>
      <option value="Masuk">Masuk</option>
      <option value="Keluar">Keluar</option>
      <option value="In-Out">In-Out</option>
    </select>
  </form>
  <br />
  <form id="form1" name="form1" method="post" action="pages/persediaan_kain_jadi.php">
    <table width="1023">
      <tr>
        <td colspan="3">
          <div align="center">LAPORAN PERSEDIAAN KAIN JADI</div>

          <?php
          $user_name = $_SESSION['username'];
          date_default_timezone_set('Asia/Jakarta');
          $tgl = date("Y-M-d h:i:s A");
          echo $tgl; ?><br />GROUP SHIFT: <strong><?php echo $_SESSION['username']; ?></strong>
        </td>
      </tr>
      <tr>
        <td>Tanggal Awal</td>
        <td>:</td>
        <td width="877"><input type="text" id="awal" name="awal" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.awal);return false;" autocomplete="off" />
          <a href="javascript:void(0)" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.awal);return false;"><img src="calender/calender.jpeg" alt="" name="popcal" width="34" height="29" id="popcal" style="border:none" align="absmiddle" border="0" /></a>
        </td>
      </tr>
      <tr>
        <td>Tanggal Akhir</td>
        <td>:</td>
        <td><input type="text" id="akhir" name="akhir" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.akhir);return false;" autocomplete="off" />
          <a href="javascript:void(0)" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.akhir);return false;"><img src="calender/calender.jpeg" alt="" name="popcal" width="34" height="29" id="popcal2" style="border:none" align="absmiddle" border="0" /></a>
        </td>
      </tr>
      <tr>
        <td>Buyer</td>
        <td>:</td>
        <td><input name="buyer" type="text" id="buyer" size="30" autocomplete="off" /></td>
      </tr>
      <tr>
        <td>No Order</td>
        <td>:</td>
        <td><input type="text" id="no_order" name="no_order" autocomplete="off" /></td>
      </tr>
      <tr>
        <td>No PO</td>
        <td>:</td>
        <td><input type="text" id="no_po" name="no_po" autocomplete="off" /></td>
      </tr>
      <tr>
        <td>No. Item</td>
        <td>:</td>
        <td><label for="no_item"></label>
          <input type="text" name="no_item" id="no_item" autocomplete="off" />
        </td>
      </tr>
      <tr>
        <td>No. Warna</td>
        <td>:</td>
        <td><input type="text" name="no_warna" id="no_warna" autocomplete="off" /></td>
      </tr>
      <tr>
        <td>Lbr X Grms</td>
        <td>:</td>
        <td><input name="lbr" type="text" id="lbr" size="4" autocomplete="off" />
          X
          <input name="grms" type="text" id="grms" size="4" autocomplete="off" />
          contoh 64.00 x 260
        </td>
      </tr>
      <!--
    <tr>
      <td>Tempat</td>
      <td>:</td>
      <td><?php
          include "../koneksi.php";
          $blk = mysqli_query($con," SELECT blok FROM pergerakan_stok WHERE blok !='' GROUP BY blok ");
          ?>
        <select name="blok" id="blok">
          <option value="">Pilih</option>
          <?php while ($rblk = mysqli_fetch_array($blk)) { ?>
          <option value="<?php echo $rblk['blok']; ?>"><?php echo $rblk['blok']; ?></option>
          <?php } ?>
      </select></td>
    </tr>
-->
      <tr>
        <td>Lokasi</td>
        <td>:</td>
        <td><?php
            $lokasi = mysqli_query($con," SELECT lokasi FROM tbl_lokasi ORDER BY lokasi ASC ");
            ?>
          <select name="lokasi" id="lokasi" autocomplete="off">
            <option value="">Pilih</option>
            <?php while ($rlks = mysqli_fetch_array($lokasi)) { ?>
              <option value="<?php echo $rlks['lokasi']; ?>"><?php echo $rlks['lokasi']; ?></option>
            <?php } ?>
          </select>
        </td>
      </tr>
      <tr>
        <td>Rak</td>
        <td>:</td>
        <td><input name="rak" type="text" id="rak" size="4" maxlength="2" autocomplete="off" /></td>
      </tr>
      <tr>
        <td width="124">Keterangan</td>
        <td width="6">:</td>
        <td width="877"><label for="ket"></label>
          <select name="ket" id="ket" autocomplete="off">
            <option value="Pilih">Pilih</option>
            <option value=""> </option>
            <option value="SISA">SISA</option>
          </select>
          <input name="bs" type="checkbox" id="bs" value="1" />
          <label for="bs">BS </label>
        </td>
      </tr>
      <tr>
        <td><input type="submit" name="button" id="button" value="Cari Data" /></td>
        <td>&nbsp;</td>
        <td><input type="hidden" name="user_name" id="user_name" value="<?php echo $_SESSION['username']; ?>" />
          <a href="index1.php?p=laporan_persediaan_kain_m">data tidak lengkap</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="index1.php?p=booking-kain">Booking Kain</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="index1.php?p=ganti-status-kain">Ganti Status Kain</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="index1.php?p=lap-status-new">Laporan Status Kain</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="index1.php?p=lap-order">Laporan Order</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="index1.php?p=lap-rekap-status">Laporan Rekap Status</a>
        </td>
      </tr>
    </table>
  </form>

</body>

</html>