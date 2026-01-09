<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=lap.xls");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Laporan Pengiriman</title>
</head>

<body>
<?php 
ini_set("error_reporting",1);
include"../koneksi.php";
$bulan=array("","JANUARI","FEBRUARI","MARET","APRIL","MEI","JUNI","JULI","AGUSTUS","SEPTEMBER","OKTOBER","NOVEMBER","DESEMBER");
$bln=number_format(date("m", strtotime($_GET['awal'])));
$thn=date("Y", strtotime($_GET['awal'])); ?>
<div align="center">LAPORAN HARIAN PENGIRIMAN 1<br />
FW-02-PPC-04/02<br />	
BULAN <?php echo $bulan[$bln]." ".$thn; ?> </div> 
<div align="right">Halaman: &nbsp;&nbsp;</div>
<table width="100%" border="1">
  <tr bgcolor="#3399CC">
    <td width="3%" align="center" bgcolor="#FFFFFF">No</td>
    <td width="9%" align="center" bgcolor="#FFFFFF">TANGGAL</td>
    <td width="6%" align="center" bgcolor="#FFFFFF">NO SJ</td>
    <td width="8%" align="center" bgcolor="#FFFFFF">WARNA</td>
    <td width="5%" align="center" bgcolor="#FFFFFF">ROLL</td>
    <td width="14%" align="center" bgcolor="#FFFFFF">QUANTITY (KG)</td>
    <td width="7%" align="center" bgcolor="#FFFFFF">BUYER</td>
    <td width="6%" align="center" bgcolor="#FFFFFF">NO PO</td>
    <td width="10%" align="center" bgcolor="#FFFFFF">NO ORDER</td>
    <td width="20%" align="center" bgcolor="#FFFFFF">JENIS KAIN</td>
    <td width="6%" align="center" bgcolor="#FFFFFF">LOT</td>
    <td width="6%" align="center" bgcolor="#FFFFFF">FOC</td>
  </tr>
  <?php 
  $ttgl=date("d", strtotime($_GET['awal']));
  $newdate = strtotime( '-1 day' , strtotime ($_GET['awal']) );
  $ttglm=date("d", $newdate);
  if($_GET['awal']!=""){
	  $tgll= "  AND tmp_hapus='0' AND tgl_kirim='$_GET[awal]' ";
	  }else{$tgll= "  AND tmp_hapus='0' AND tgl_kirim!='' ";}	  
  if($_GET['no_sj']!=""){
	  $sj= " And no_sj='$_GET[no_sj]' ";
	  }	else { $sj=" ";} 
  if($_GET['no_po']!=""){
    $nopo1= " AND no_po='".$_GET['no_po']."' ";
    }else{
	  $nopo1= " ";
  }
  if($_GET['no_order']!=""){
    $order1= " AND no_order='".$_GET['no_order']."' ";
    }else{
	  $order1= " ";
  }	  	
  $sql=mysqli_query($con,"SELECT
	id,tgl_kirim,no_sj,warna,rol,qty,buyer,no_po,no_order,jenis_kain,lot,tujuan,ket,foc
FROM
	tbl_pengiriman
WHERE
	not no_sj='' AND ISNULL(kategori) $tgll $sj $nopo1 $order1
ORDER BY no_sj asc");
  $tt=date("Y-m-d", strtotime($_GET['awal']));
  $awal=date("Y-m-", strtotime($_GET['awal']));
  $nawal=$awal."01";
  $newdate1 = strtotime( '-1 day' , strtotime ($_GET['awal']) );
  $ttm=date("Y-m-d", $newdate1);
  $sql1=mysqli_query($con,"SELECT sum(qty) as qty from tbl_pengiriman 
WHERE tmp_hapus='0' AND not no_sj='' AND tgl_kirim BETWEEN '$nawal' AND '$tt' AND ISNULL(kategori)");
$row1=mysqli_fetch_array($sql1);
 $sql2=mysqli_query($con,"SELECT sum(qty) as qty from tbl_pengiriman 
WHERE tmp_hapus='0' AND not no_sj='' AND tgl_kirim BETWEEN '$nawal' AND '$ttm' AND ISNULL(kategori)");
$row2=mysqli_fetch_array($sql2);
$no=1;
$c=0;
while($row=mysqli_fetch_array($sql)){
	$bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99';
  ?>
  <tr valign="top" >
    <td><?php echo $no; ?></td>
    <td><?php echo date("d-M-Y", strtotime($row['tgl_kirim'])); ?></td>
    <td>'<?php echo $row['no_sj']; ?></td>
    <td><?php echo $row['warna']; ?></td>
    <td align="right"><?php echo $row['rol']; ?></td>
    <td align="right"><?php echo $row['qty']; ?></td>
    <td><?php echo $row['buyer']; ?></td>
    <td><?php echo $row['no_po']; ?></td>
    <td><?php echo $row['no_order']; ?></td>
    <td><?php echo $row['jenis_kain']; ?></td>
    <td>'<?php echo $row['lot']; ?></td>
    <td><?php echo $row['foc']; ?></td>
  </tr>
  <?php $no++;
  $totrol=$totrol+$row['rol'];
  $totqty=$totqty+ $row['qty'];
  } ?>
  <tr bgcolor="#33CC99">
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr bgcolor="#33CC99">
    <td colspan="4" bgcolor="#FFFFFF">Total Tanggal <?php echo $ttgl;?></td>
    <td align="right" bgcolor="#FFFFFF"><?php echo $totrol; ?></td>
    <td align="right" bgcolor="#FFFFFF"><?php echo number_format(round($totqty,2),'2',',','.'); $qt1=round($totqty,2); ?></td>
    <td colspan="3" align="center" bgcolor="#FFFFFF">SINGGIH</td>
    <td colspan="3" align="center" bgcolor="#FFFFFF">PUTRI</td>
  </tr>
  <tr bgcolor="#33CC99">
    <td colspan="5" bgcolor="#FFFFFF">Total <?php if($ttgl=="01"){}else{ ?>Tanggal 01 S/D <?php echo $ttglm; }?></td>
    <td align="right" bgcolor="#FFFFFF"><?php echo number_format(round($row2['qty'],2),'2',',','.');$qt2=round($row2['qty'],2);?></td>
    <td colspan="3" align="center" bgcolor="#FFFFFF">STAFF</td>
    <td colspan="3" align="center" bgcolor="#FFFFFF">PPC AST. MANAGER</td>
  </tr>
  <tr bgcolor="#33CC99">
    <td colspan="5" bgcolor="#FFFFFF">Total Tanggal 01 S/D <?php echo $ttgl;?></td>
    <td align="right" bgcolor="#FFFFFF"><?php echo number_format($qt1+$qt2,'2',',','.');?></td>
    <td colspan="3" align="center" bgcolor="#FFFFFF">&nbsp;</td>
    <td colspan="3" align="center" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr bgcolor="#33CC99">
    <td height="50" colspan="6" bgcolor="#FFFFFF">&nbsp;</td>
    <td colspan="3" align="center" bgcolor="#FFFFFF">&nbsp;</td>
    <td colspan="3" align="center" bgcolor="#FFFFFF"><?php echo $nopo1; ?></td>
  </tr>
</table>
	
</body>
</html>