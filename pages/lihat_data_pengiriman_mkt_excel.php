<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=lap-pengiriman-".date($_GET['awal'])." s/d ".date($_GET['akhir']).".xls");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Laporan Pengiriman</title>
</head>

<body>
<?php 
include"../koneksi.php";
ini_set("error_reporting",1);	
$bulan=array("","JANUARI","FEBRUARI","MARET","APRIL","MEI","JUNI","JULI","AGUSTUS","SEPTEMBER","OKTOBER","NOVEMBER","DESEMBER");
$bln=number_format(date("m", strtotime($_GET['awal'])));
$thn=date("Y", strtotime($_GET['awal'])); ?>
<table width="100%" border="0">
    <td align="left" colspan="4"><img src="Kop_ITTI.png" alt="" width="130" /></td>
    <td align="center" colspan="7">&nbsp;</td>
    <td align="left" colspan="4"><img src="Kop_ITTI_2.png" alt="" width="130" /></td>
</table>
<br>
<div align="center">LAPORAN HARIAN PENGIRIMAN </div> 
<table width="100%" border="1">
  <tr bgcolor="#3399CC">
    <td width="3%" align="center" bgcolor="#FFFFFF">NO</td> 
    <td width="9%" align="center" bgcolor="#FFFFFF">TANGGAL BUAT</td>
    <td width="9%" align="center" bgcolor="#FFFFFF">TANGGAL KIRIM</td>
    <td width="6%" align="center" bgcolor="#FFFFFF">NO SJ</td>
    <td width="8%" align="center" bgcolor="#FFFFFF">WARNA</td>
    <td width="5%" align="center" bgcolor="#FFFFFF">ROLL</td>
    <td width="14%" align="center" bgcolor="#FFFFFF">QUANTITY (KG)</td>
    <td width="14%" align="center" bgcolor="#FFFFFF">YARD/METER</td>
    <td width="7%" align="center" bgcolor="#FFFFFF">BUYER</td>
    <td width="6%" align="center" bgcolor="#FFFFFF">NO PO</td>
    <td width="10%" align="center" bgcolor="#FFFFFF">NO ORDER</td>
    <td width="6%" align="center" bgcolor="#FFFFFF">NO ITEM</td>
    <td width="20%" align="center" bgcolor="#FFFFFF">JENIS KAIN</td>
    <td width="6%" align="center" bgcolor="#FFFFFF">LOT</td>
    <td width="6%" align="center" bgcolor="#FFFFFF">FOC</td>
  </tr>
  <?php 
  $ttgl=date("d", strtotime($_GET['akhir']));
    if($_GET['awal']!="" AND $_GET['buyer']!=""){
      $tgll= " tmp_hapus='0' AND tgl_buat BETWEEN '".$_GET['awal']."' AND '".$_GET['akhir']."' AND buyer LIKE '%".$_GET['buyer']."%' ";
      }else if($_GET['awal']!=""){
      $tgll= " tmp_hapus='0' AND tgl_buat BETWEEN '".$_GET['awal']."' AND '".$_GET['akhir']."' ";
      }else{$tgll= " tmp_hapus='0' AND tgl_update!='' ";}	  
    if($_GET['no_sj']!=""){
      $sj= " AND no_sj='".$_GET['no_sj']."' ";
      }
    if($_POST['buyer']!=""){
      $buyer= " AND buyer LIKE '%".$_GET['buyer']."%' ";
    }	 
  $sql=sqlsrv_query($con,"SELECT
	id,tgl_kirim,tgl_buat,no_sj,warna,rol,qty,panjang,buyer,no_po,no_order,no_item,jenis_kain,lot,tujuan,ket,foc,approve_acc
FROM
	tbl_pengiriman
WHERE
	not no_sj='' AND ISNULL(kategori) AND $tgll $sj $buyer
ORDER BY no_sj asc");
  $awal=date("Y-m-", strtotime($_GET['awal']));
  $takhir=date("Y-m-d", strtotime($_GET['akhir']));
  $nawal=$awal."01";
 $sql2=sqlsrv_query($con,"SELECT sum(qty) as qty from tbl_pengiriman 
WHERE tmp_hapus='0' AND not no_sj='' AND tgl_buat BETWEEN '$nawal' AND '$takhir' AND ISNULL(kategori)");
$row2=sqlsrv_fetch_array($sql2);
$no=1;
$c=0;
while($row=sqlsrv_fetch_array($sql)){
	$bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99';
  ?>
  <tr valign="top" >
    <td <?php if($row['approve_acc']=="Approve"){?> bgcolor="#FF962C" <?php }?>><?php echo $no; ?></td>
    <td <?php if($row['approve_acc']=="Approve"){?> bgcolor="#FF962C" <?php }?>><?php echo date("d-M-Y", strtotime($row['tgl_buat'])); ?></td>
    <td <?php if($row['approve_acc']=="Approve"){?> bgcolor="#FF962C" <?php }?>><?php echo date("d-M-Y", strtotime($row['tgl_kirim'])); ?></td>
    <td <?php if($row['approve_acc']=="Approve"){?> bgcolor="#FF962C" <?php }?>>'<?php echo $row['no_sj']; ?></td>
    <td <?php if($row['approve_acc']=="Approve"){?> bgcolor="#FF962C" <?php }?>><?php echo $row['warna']; ?></td>
    <td <?php if($row['approve_acc']=="Approve"){?> bgcolor="#FF962C" <?php }?> align="right"><?php echo $row['rol']; ?></td>
    <td <?php if($row['approve_acc']=="Approve"){?> bgcolor="#FF962C" <?php }?> align="right"><?php echo $row['qty']; ?></td>
    <td <?php if($row['approve_acc']=="Approve"){?> bgcolor="#FF962C" <?php }?> align="right"><?php echo $row['panjang']; ?></td>
    <td <?php if($row['approve_acc']=="Approve"){?> bgcolor="#FF962C" <?php }?>><?php echo $row['buyer']; ?></td>
    <td <?php if($row['approve_acc']=="Approve"){?> bgcolor="#FF962C" <?php }?>><?php echo $row['no_po']; ?></td>
    <td <?php if($row['approve_acc']=="Approve"){?> bgcolor="#FF962C" <?php }?>><?php echo $row['no_order']; ?></td>
    <td <?php if($row['approve_acc']=="Approve"){?> bgcolor="#FF962C" <?php }?>><?php echo $row['no_item']; ?></td>
    <td <?php if($row['approve_acc']=="Approve"){?> bgcolor="#FF962C" <?php }?>><?php echo $row['jenis_kain']; ?></td>
    <td <?php if($row['approve_acc']=="Approve"){?> bgcolor="#FF962C" <?php }?>>'<?php echo $row['lot']; ?></td>
    <td <?php if($row['approve_acc']=="Approve"){?> bgcolor="#FF962C" <?php }?>><?php echo $row['foc']; ?></td>
  </tr>
  <?php $no++;
  $totrol=$totrol+$row['rol'];
  $totqty=$totqty+ $row['qty'];
  $totpjg=$totpjg+ $row['panjang'];
  } ?>
  <tr bgcolor="#33CC99">
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF" align="center"><strong>TOTAL</strong></td>
    <td bgcolor="#FFFFFF"><strong><?php echo $totrol; ?></strong></td>
    <td bgcolor="#FFFFFF"><strong><?php echo $totqty; ?></strong></td>
    <td bgcolor="#FFFFFF"><strong><?php echo $totpjg; ?></strong></td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
</table>
</body>
</html>