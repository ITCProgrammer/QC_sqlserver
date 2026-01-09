<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Change Price</title>
</head>

<body>
    <?php
    include '../koneksi.php';
    $sqlAppr = mysql_query("SELECT `id`, `satuan_mkt`, `currency`, `price` from tbl_pengiriman where id = '$_GET[id]' LIMIT 1");
    $dtAppr = mysql_fetch_array($sqlAppr);
    if (isset($_POST['btnSimpan'])) {
        $sql = mysql_query("UPDATE tbl_pengiriman SET 
                     `satuan_mkt` = '$_POST[satuan_mkt]',
                     `currency` = '$_POST[currency]',
                     `price` = '$_POST[price]'
                     WHERE id='$_GET[id]'
                    ");
        if ($sql) {
            $msg = "Berhasil Diubah";
        } else {
            $msg = "Gagal Diubah, Error !";
        }
    }
    ?>
    <form id="form1" name="form1" method="post" action="">
        <table width="100%" border="0">
            <tr>
                <td colspan="3">Change Price
                    <div align="center">
                        <font color="#FF0000"><?php echo $msg ?></font>
                    </div>
                </td>
            </tr>
            <tr>
                <td width="11%">No SJ</td>
                <td width="1%">:</td>
                <td width="88%"><?php echo $_GET['nosj']; ?><label for="nosj"></label>
                </td>
            </tr>
            <tr>
                <td>Satuan</td>
                <td>:</td>
                <td><label for="satuan_mkt"></label>
                    <select name="satuan_mkt" id="satuan_mkt">
                        <?php if ($dtAppr['satuan_mkt'] == '' OR $dtAppr['satuan_mkt'] == NULL) { ?>
                            <option value="" selected>-PILIH-</option>
                            <option value="kg">Kg</option>
                            <option value="meter">Meter</option>
                            <option value="pc">Pcs</option>
                            <option value="yard">Yard</option>
                        <?php } else { ?>
                            <option <?php if ($dtAppr['satuan_mkt'] == ''){echo "selected"; }?> value="" selected>-PILIH-</option>
                            <option <?php if ($dtAppr['satuan_mkt'] == 'kg'){echo "selected"; }?> value="kg">Kg</option>
                            <option <?php if ($dtAppr['satuan_mkt'] == 'meter'){echo "selected"; }?> value="meter">Meter</option>
                            <option <?php if ($dtAppr['satuan_mkt'] == 'pc'){echo "selected"; }?> value="pc">Pcs</option>
                            <option <?php if ($dtAppr['satuan_mkt'] == 'yard'){echo "selected"; }?> value="yard">Yard</option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Currency</td>
                <td>:</td>
                <td><label for="currency"></label>
                    <select name="currency" id="currency">
                        <?php if ($dtAppr['currency'] == '' OR $dtAppr['currency'] == NULL) { ?>
                            <option value="" selected>-PILIH-</option>
                            <option value="HK$">HK$</option>
                            <option value="Rp">Rp</option>
                            <option value="Yen">Yen</option>
                            <option value="S$">S$</option>
                            <option value="US$">US$</option>
                            <option value="RM">RM</option>
                            <option value="EURO">EURO</option>
                            <option value="NT$">NT$</option>
                        <?php } else { ?>
                            <option <?php if ($dtAppr['currency'] == ''){echo "selected"; }?> value="" selected>-PILIH-</option>
                            <option <?php if ($dtAppr['currency'] == 'HK$'){echo "selected"; }?> value="HK$">HK$</option>
                            <option <?php if ($dtAppr['currency'] == 'Rp'){echo "selected"; }?> value="Rp">Rp</option>
                            <option <?php if ($dtAppr['currency'] == 'Yen'){echo "selected"; }?> value="Yen">Yen</option>
                            <option <?php if ($dtAppr['currency'] == 'S$'){echo "selected"; }?> value="S$">S$</option>
                            <option <?php if ($dtAppr['currency'] == 'US$'){echo "selected"; }?> value="US$">US$</option>
                            <option <?php if ($dtAppr['currency'] == 'RM'){echo "selected"; }?> value="RM">RM</option>
                            <option <?php if ($dtAppr['currency'] == 'EURO'){echo "selected"; }?> value="EURO">EURO</option>
                            <option <?php if ($dtAppr['currency'] == 'NT$'){echo "selected"; }?> value="NT$">NT$</option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Price</td>
                <td>:</td>
                <td><input name="price" type="text" id="price" size="25" value="<?php echo $dtAppr['price'];?>" /></td>
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