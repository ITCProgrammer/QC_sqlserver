<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Tempat Kain Jadi</title>
</head>

<body>
    <?php
	ini_set("error_reporting",1);
    include '../koneksi.php';
    $sqlGetSttsClr = mysqli_query($con,"SELECT `id`, `note` from tbl_status_warna where id_pergerakan = '".$_GET['id_pergerakan']."' and id_detail = '".$_GET['id_detail']."' and nokk ='".$_GET['nokk']."' LIMIT 1");
    $dataSttsClr = mysqli_fetch_array($sqlGetSttsClr);
    if (isset($_POST['btnSimpan'])) {
        $id_detaiL = $_POST['id_detail'];
        $sql = mysqli_query($con,"INSERT into tbl_status_warna set 
                     `id_pergerakan` = '".$_POST['id_pergerakan']."',
                     `id_detail` = '$id_detaiL',
                     `nokk` = '".$_POST['nokk']."',
                     `note` = '".$_POST['note']."'
                    ");
        if ($sql) {
            $msg = "berhasil diubah";
        } else {
            $msg = "gagal diubah, Error !";
        }
    }
    ?>
    <form id="form1" name="form1" method="post" action="">
        <table width="100%" border="0">
            <tr>
                <td colspan="3">Status Warna
                    <div align="center">
                        <font color="#FF0000"><?php echo $msg ?></font>
                    </div>
                </td>
            </tr>
            <tr>
                <td width="11%">No KK</td>
                <td width="1%">:</td>
                <td width="88%"><?php echo $_GET['nokk']; ?><label for="nokk"></label>
                    <input type="hidden" name="nokk" id="nokk" value="<?php echo $_GET['nokk']; ?>" />
                    <input type="hidden" name="id_pergerakan" id="id_pergerakan" value="<?php echo $_GET['id_pergerakan']; ?>" />
                    <input type="hidden" name="id_detail" id="id_detail" value="<?php echo $_GET['id_detail']; ?>" />
                </td>
            </tr>
            <tr>
                <td>Status warna</td>
                <td>:</td>
                <td><label for="tempat"></label>
                    <select name="note" id="note">
                        <?php if ($dataSttsClr['note'] == '') { ?>
                            <option value="" selected>-PILIH-</option>
                            <option value="GROUP A">GROUP A</option>
                            <option value="GROUP B">GROUP B</option>
                            <option value="GROUP C">GROUP C</option>
                        <?php } else { ?>
                            <option <?php if ($dataSttsClr['note'] == '') echo "selected"; ?> value="" selected>-PILIH-</option>
                            <option <?php if ($dataSttsClr['note'] == 'GROUP A') echo "selected"; ?> value="GROUP A">GROUP A</option>
                            <option <?php if ($dataSttsClr['note'] == 'GROUP B') echo "selected"; ?> value="GROUP B">GROUP B</option>
                            <option <?php if ($dataSttsClr['note'] == 'GROUP C') echo "selected"; ?> value="GROUP C">GROUP C</option>
                        <?php } ?>
                    </select>
                </td>
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