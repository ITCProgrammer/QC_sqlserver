<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Kurs</title>
</head>

<body>
    <?php
	ini_set("error_reporting",1);
    include '../koneksi.php';
    $sqlKonv = sqlsrv_query($con,"SELECT * from tbl_konversi_accsj LIMIT 1");
    $dtKonv = sqlsrv_fetch_array($sqlKonv);
    $cekKonv=sqlsrv_num_rows($sqlKonv);
    if (isset($_POST['btnSimpan']) AND $cekKonv>0) {
        $sql = sqlsrv_query($con,"UPDATE tbl_konversi_accsj SET 
                    `konversi`='".$_POST['konversi']."',
                    `ipaddress`='".$_SERVER['REMOTE_ADDR']."',
                    `tgl_update`=now()
                    WHERE id='1'
                    ");
        if ($sql) {
            $msg = "Berhasil Diubah";
        } else {
            $msg = "Gagal Diubah, Error !";
        }
    } else if(isset($_POST['btnSimpan']) AND $cekKonv==0){
        $sqlInsert=sqlsrv_query($con,"INSERT INTO tbl_konversi_accsj SET
            `konversi`='".$_POST['konversi']."',
            `ipaddress`='".$_SERVER['REMOTE_ADDR']."',
            `tgl_update`=now()
            ");
        if ($sqlInsert) {
            $msg = "Berhasil Diinput";
        } else {
            $msg = "Gagal Diinput, Error !";
        }
    }
    ?>
    <form id="form1" name="form1" method="post" action="">
        <table width="100%" border="0">
            <tr>
                <td colspan="3">Kurs
                    <div align="center">
                        <font color="#FF0000"><?php echo $msg ?></font>
                    </div>
                </td>
            </tr>
            <tr>
                <td width="11%">Tanggal Update</td>
                <td width="1%">:</td>
                <td width="88%"><?php echo $dtKonv['tgl_update']; ?><label for="nosj"></label>
                </td>
            </tr>
            <tr>
                <td>Kurs Dollar</td>
                <td>:</td>
                <td><input name="konversi" type="text" id="konversi" size="25" value="<?php echo $dtKonv['konversi'];?>" /></td>
            </tr>
            <tr>
                <td><input type="submit" name="btnSimpan" id="simpan" value="SIMPAN" /></td>
                <td>&nbsp;</td>
                <td><input type="button" name="tutup" id="tutup" value="TUTUP" onclick="window.close();" /></td>
            </tr>
        </table>
    </form>
</body>

</html>