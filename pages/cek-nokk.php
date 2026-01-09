<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Cek Nokk</title>
  </head>

  <body>
    <br />
    <form id="form1" name="form1" method="post" action="">
      <table width="767">
        <tr>
          <td colspan="3">
            <div align="center">CEK NOKK PACKING LIST DAN SURAT JALAN </div>
            </div>
            <?php
      $user_name=$_SESSION['username'];
      date_default_timezone_set('Asia/Jakarta');
    $tgl=date("Y-M-d h:i:s A");
      echo $tgl;?><br />GROUP SHIFT: <strong>
              <?php echo $_SESSION['username']; ?></strong>
          </td>
        </tr>
        <tr>
          <td width="128">No Kartu Kerja</td>
          <td width="5">:</td>
          <td><input type="text" name="nokk" id="nokk" required /></td>
        </tr>
        <tr>
          <td><input type="submit" name="button" id="button" value="Cari Data" /></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>
    </form>
    <?php if ($_POST['nokk']!="") {
          ?>
    <table width="60%">
      <tbody>
        <tr bgcolor="#144CA2">
          <th width="22%" scope="col">No PK</th>
          <th width="21%" scope="col">No. SJ</th>
          <th width="26%" scope="col">Tgl Buat</th>
          <th width="31%" scope="col">Tgl Kirim</th>
        </tr>
        <?php
      $sql=mysqli_query($con,"SELECT b.listno,b.no_sj,b.tgl_update,b.tgl_buat_list FROM detail_pergerakan_stok a
INNER JOIN packing_list b ON a.refno=b.listno
WHERE a.nokk='".$_POST['nokk']."' and (ISNULL(a.transtatus) or not ISNULL(a.transtatus))
GROUP BY b.listno");
          while ($r=mysqli_fetch_array($sql)) {
              ?>
        <tr align="center" bgcolor="#7EE8AE">
          <td>
            <?php echo $r['listno']; ?>
          </td>
          <td>
            <?php echo $r['no_sj']; ?>
          </td>
          <td>
            <?php echo $r['tgl_buat_list']; ?>
          </td>
          <td>
            <?php echo $r['tgl_update']; ?>
          </td>
        </tr>
        <?php
          } ?>
      </tbody>
    </table>
    <?php
      } ?>
  </body>

</html>
