<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Approval</title>
</head>

<body>
    <?php
    include '../koneksi.php';
	ini_set("error_reporting",1);
    $sqlAppr = sqlsrv_query($con,"SELECT `id`, `approve_acc`, `tgl_approve_acc` from tbl_pengiriman where id = '".$_GET['id']."' LIMIT 1");
    $dtAppr = sqlsrv_fetch_array($sqlAppr);
    if (isset($_POST['btnSimpan'])) {
        $sql = sqlsrv_query($con,"UPDATE tbl_pengiriman SET 
                     `approve_acc` = '".$_POST['approve_acc']."',
                     `ipaddress_acc` = '".$_SERVER['REMOTE_ADDR']."',
                     `tgl_approve_acc` = now()
                     WHERE id='".$_GET['id']."'
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
                <td colspan="3">Approval
                    <div align="center">
                        <font color="#FF0000"><?php echo $msg ?></font>
                    </div>
                </td>
            </tr>
            <tr>
                <td width="11%">Tgl Approve</td>
                <td width="1%">:</td>
                <td width="88%"><?php echo $dtAppr['tgl_approve_acc']; ?><label for="tgl_approve_acc"></label>
                </td>
            </tr>
            <tr>
                <td width="11%">No SJ</td>
                <td width="1%">:</td>
                <td width="88%"><?php echo $_GET['nosj']; ?><label for="nosj"></label>
                </td>
            </tr>
            <tr>
                <td>Approve</td>
                <td>:</td>
                <td><label for="approve_acc"></label>
                    <select name="approve_acc" id="approve_acc">
                        <?php if ($dtAppr['approve_acc'] == '') { ?>
                            <option value="" selected>-PILIH-</option>
                            <option value="Approve">Approve</option>
                        <?php } else { ?>
                            <option <?php if ($dtAppr['approve_acc'] == ''){echo "selected"; }?> value="" selected>-PILIH-</option>
                            <option <?php if ($dtAppr['approve_acc'] == 'Approve'){echo "selected"; }?> value="Approve">Approve</option>
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