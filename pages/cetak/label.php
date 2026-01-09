<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<LINK rel="stylesheet" type"text/css" href="layar.css" media="screen">
<LINK rel="stylesheet" type"text/css" href="print.css" media="print">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Cetak Label</title>
<script>
function printPage()
{
    // Do print the page
    if (typeof(window.print) != 'undefined') {
        window.print();
    }
}
</script>
</head>

<body>
<?php
mysql_connect("192.168.0.254","root","gogogo");
	mysql_select_db("db_qc")or die("Gagal Koneksi");
$sql=mysql_query("SELECT *,no_roll,net_wight,yard_,grade,satuan FROM tbl_kite INNER JOIN detail_kite ON detail_kite.nokkKite = tbl_kite.nokk where tbl_kite.nokk='$_GET[nokk]' and no_roll='$_GET[rol]'") or die("Gagal");
 $row=mysql_fetch_array($sql);
 if($row['satuan']=="Meter"){$rmtr="M";} 
 if($row['sisa']=="FOC"){$ket="FOC";}else if($row['sisa']=="SISA"){$ket="SISA";}else if($row['sisa']=="TH"){$ket="TH";}else if($row['sisa']=="KITE"){$ket="FASILITAS KITE";}
?>
<div class="isi" >
    <table border="0" class="table-list">
  <tr style="height:0.8cm">
    <td scope="row">&nbsp;</td>
    <td >&nbsp;</td>
    <td style="width:2cm">&nbsp;</td>
    <td style="width:3cm"><?php echo $ket;?></td>
  </tr>
  <tr style="height:0.8cm">
    <td colspan="2" scope="row" valign="top"><?php echo $row['pelanggan'];?></td>
    <td>&nbsp;</td>
    <td valign="bottom"><?php echo $row['no_po'];?></td>
  </tr>
  <tr style="height:0.8cm">
    <td scope="row" style="width:2cm">&nbsp;</td>
    <td valign="bottom" style="width:3cm"><?php echo $row['no_item'];?></td>
    <td>&nbsp;</td>
    <td valign="bottom"><?php echo $row['jenis_kain'];?></td>
  </tr>
  <tr style="height:0.8cm">
    <td scope="row">&nbsp;</td>
    <td valign="bottom"><?php echo $row['warna'];?></td>
    <td width="10%">&nbsp;</td>
    <td  valign="bottom"><?php $row['no_order'];?></td>
  </tr>
  <tr style="height:0.8cm">
    <td scope="row">&nbsp;</td>
    <td valign="bottom"><?php echo $row['no_warna'];?></td>
    <td>&nbsp;</td>
    <td valign="bottom"><?php echo $row['no_style'];?></td>
  </tr>
  <tr style="height:0.8cm">
    <td scope="row">&nbsp;</td>
    <td valign="bottom"><?php echo $row['lebar'];?></td>
    <td>&nbsp;</td>
    <td valign="bottom"><?php echo $row['no_lot'];?></td>
  </tr>
  <tr style="height:0.8cm">
    <td scope="row">&nbsp;</td>
    <td valign="bottom"><?php echo $row['berat'];?></td>
    <td>&nbsp;</td>
    <td valign="bottom"><?php echo $row['no_roll'];?></td>
  </tr>
  <tr style="height:0.8cm">
    <td scope="row">&nbsp;</td>
    <td valign="bottom"><?php echo $row['yard_']." ".$rmtr;?></td>
    <td>&nbsp;</td>
    <td valign="bottom"><?php echo $row['net_wight'];?></td>
  </tr>
  <tr style="height:0.8cm">
    <td scope="row">&nbsp;</td>
    <td valign="bottom"><?php echo date("d-M-Y");?></td>
    <td>&nbsp;</td>
    <td valign="bottom"><?php echo $row['grade'];?></td>
  </tr>
  <tr style="height:0.8cm">
    <td colspan="4" scope="row">&nbsp;</td>
  </tr>
  </table></div>
<div id="cetak">
     <img src="../btn_print.png" height="20" onClick="javascript:window.print()" />
    </div>
</body>
</html>