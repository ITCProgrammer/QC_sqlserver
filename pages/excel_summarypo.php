<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Summary-PO-".$_GET['po'].".xls");
include "../koneksi.php";
ini_set("error_reporting",1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Summary PO</title>
</head>

<body>
<?php 
include"../koneksi.php";
?>
<div align="center"><strong>SUMMARY PENGIRIMAN BY PO</strong> </div> 
<table width="100%" border="1">
  <tr bgcolor="#3399CC">
    <td width="3%" align="center" bgcolor="#FFFFFF"><strong>NO</strong></td>
    <td width="9%" align="center" bgcolor="#FFFFFF"><strong>TANGGAL BUAT</strong></td>
    <td width="9%" align="center" bgcolor="#FFFFFF"><strong>TANGGAL KIRIM</strong></td>
    <td width="6%" align="center" bgcolor="#FFFFFF"><strong>NO SJ</strong></td>
    <td width="8%" align="center" bgcolor="#FFFFFF"><strong>WARNA</strong></td>
    <td width="5%" align="center" bgcolor="#FFFFFF"><strong>ROLL</strong></td>
    <td width="8%" align="center" bgcolor="#FFFFFF"><strong>QUANTITY (KG)</strong></td>
    <td width="8%" align="center" bgcolor="#FFFFFF"><strong>PANJANG YARD/METER</strong></td>
    <td width="8%" align="center" bgcolor="#FFFFFF"><strong>PCS</strong></td>
    <td width="7%" align="center" bgcolor="#FFFFFF"><strong>BUYER</strong></td>
    <td width="6%" align="center" bgcolor="#FFFFFF"><strong>NO PO</strong></td>
    <td width="10%" align="center" bgcolor="#FFFFFF"><strong>NO ORDER</strong></td>
    <td width="6%" align="center" bgcolor="#FFFFFF"><strong>NO ITEM</strong></td>
    <td width="20%" align="center" bgcolor="#FFFFFF"><strong>JENIS KAIN</strong></td>
    <td width="6%" align="center" bgcolor="#FFFFFF"><strong>LOT</strong></td>
    <td width="6%" align="center" bgcolor="#FFFFFF"><strong>CURRENCY</strong></td>
    <td width="6%" align="center" bgcolor="#FFFFFF"><strong>SATUAN</strong></td>
    <td width="6%" align="center" bgcolor="#FFFFFF"><strong>UNIT PRICE</strong></td>
  </tr>
  <?php 
    if($_GET['po']!=""){
      $po= " AND no_po LIKE '%".$_GET['po']."%' ";
    }	 
  $sql=sqlsrv_query($con,"SELECT
	id,tgl_kirim,tgl_buat,no_sj,warna,rol,qty,panjang,netto,buyer,no_po,no_order,no_item,jenis_kain,lot,tujuan,ket,foc,satuan_mkt,currency,price,approve_acc
FROM
	tbl_pengiriman
WHERE
	not no_sj='' AND ISNULL(kategori) $po
ORDER BY no_sj asc");
$no=1;
$c=0;
while($row=sqlsrv_fetch_array($sql)){
    $sqlmkt=sqlsrv_query($conn,"SELECT TOP 1 SUM(b.Quantity) AS qty_po from JobOrders a
    INNER JOIN SODetails b ON a.SOID=b.SOID
    INNER JOIN ProductMaster c ON b.ProductID=c.ID
    INNER JOIN SODetailsAdditional d ON d.SODID=b.ID
    INNER JOIN ProductPartner e ON e.productid=b.ProductID
    INNER JOIN UnitDescription f on f.ID=b.unitID
    INNER JOIN Currencies g on g.ID=b.CurrencyID
    where d.PONumber='".$row['no_po']."'
    GROUP BY a.DocumentNo");
    $rowmkt=sqlsrv_fetch_array($sqlmkt,SQLSRV_FETCH_ASSOC);
    $sqljml=sqlsrv_query($con,"SELECT
    SUM(qty) AS qty, SUM(panjang) AS panjang, SUM(netto) AS netto
    FROM
      tbl_pengiriman
    WHERE
      NOT no_sj='' AND ISNULL(kategori) AND no_po='".$row['no_po']."' 
    GROUP BY no_order LIMIT 1");
    $rowdt=sqlsrv_fetch_array($sqljml);
	$bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99';
  ?>
  <tr valign="top" >
    <td align="center"><?php echo $no;?></td>
    <td><?php echo date("d-M-Y", strtotime($row['tgl_buat'])) ?></td>
    <td><?php echo date("d-M-Y", strtotime($row['tgl_kirim'])) ?></td>
    <td>'<?php echo $row['no_sj']; ?></td>
    <td><?php echo $row['warna']; ?></td>
    <td align="right"><?php echo $row['rol']; ?></td>
    <td align="right"><?php echo $row['qty']; ?></td>
    <td align="right"><?php echo $row['panjang']; ?></td>
    <td align="right"><?php echo $row['netto']; ?></td>
    <td><?php echo $row['buyer']; ?></td>
    <td><?php echo $row['no_po']; ?></td>
    <td><?php echo $row['no_order']; ?></td>
    <td><?php echo $row['no_item']; ?></td>
    <td><?php echo $row['jenis_kain']; ?></td>
    <td><?php echo $row['lot']; ?></td>
    <td><?php echo $row['currency']; ?></td>
    <td><?php echo $row['satuan_mkt']; ?></td>
    <td><?php echo $row['price']; ?></td>
  </tr>
  <?php $no++;
  $totrol=$totrol+$row['rol'];
  $totqty=$totqty+ $row['qty'];
  $totpjg=$totpjg+ $row['panjang'];
  $totnet=$totnet+ $row['netto'];
  $satuan=$row['satuan_mkt'];
  } ?>
  <tr bgcolor="#33CC99" style="">
    <td colspan="5">Total Qty Sudah Dikirim</td>
    <td align="right"><?php echo $totrol; ?></td>
    <td align="right"><?php echo number_format(round($rowdt['qty'],2),'2',',','.'); $qt1=round($rowdt['qty'],2); ?></td>
    <td align="right"><?php echo number_format(round($rowdt['panjang'],2),'2',',','.'); $qtpjg=round($rowdt['panjang'],2); ?></td>
    <td align="right"><?php echo number_format(round($rowdt['netto'],2),'2',',','.'); $qtnet=round($rowdt['netto'],2); ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr bgcolor="#33CC99" style="">
    <td colspan="6">Total Qty Bon Order</td>
    <td align="right"><?php if($satuan=="kg"){echo number_format(round($rowmkt['qty_po'],2),'2',',','.');$qt2=round($rowmkt['qty_po'],2);}else{echo "&nbsp;";}?></td>
    <td align="right"><?php if($satuan=="yard" OR $satuan=="meter"){echo number_format(round($rowmkt['qty_po'],2),'2',',','.');$qt2=round($rowmkt['qty_po'],2);}else{echo "&nbsp;";}?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr bgcolor="#33CC99" style="border-bottom: 1px solid;">
    <td colspan="6">Total Qty Belum Kirim</td>
    <td align="right"><?php if($satuan=="kg"){echo number_format($qt2-$qt1,'2',',','.');}?></td>
    <td align="right"><?php if($satuan=="yard" OR $satuan=="meter"){echo number_format($qt2-$qtpjg,'2',',','.');}?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>