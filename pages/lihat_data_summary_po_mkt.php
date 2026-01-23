<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Summary PO</title>
<link rel="stylesheet" type="text/css" href="css/datatable.css" />
<link rel="stylesheet" type="text/css" href="css/jquery-ui.css" />
<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/jquery.dataTables.js" type="text/javascript"></script>
<script>
	$(document).ready(function(){
		$('#datatables').dataTable({
			"sScrollY": "400px",
			"sScrollX": "100%",
			"bScrollCollapse": true,
			"bPaginate": false,
			"bJQueryUI": true
		});			
	})
</script>
<style>
th,td{
	border-top: 1px solid;
	border-bottom: 1px solid;
	border-left: 1px solid;
	border-right: 1px solid;
	}
</style>

</head>

<body>
<?php 
$bulan=array("","JANUARI","FEBRUARI","MARET","APRIL","MEI","JUNI","JULI","AGUSTUS","SEPTEMBER","OKTOBER","NOVEMBER","DESEMBER");
$bln=number_format(date("m", strtotime($_POST['awal'])));
$thn=date("Y", strtotime($_POST['awal'])); ?>
<div align="center">SUMMARY PENGIRIMAN BY PO</div> 
<br />
<a href="pages/excel_summarypo.php?po=<?php echo $_POST['po'];?>">EXCEL</a>
<table width="100%" border="0" class="display" id="datatables">
 <thead>
  <tr bgcolor="#3399CC">
    <th align="center" width="5%">NO</th>
    <th align="center" width="10%">TGL BUAT</th>
    <th align="center" width="10%">TGL KIRIM</th>
    <th align="center" width="8%">NO SJ</th>
    <th align="center" width="10%">WARNA</th>
    <th align="center" width="8%">ROLL</th>
    <th align="center" width="8%">QUANTITY (KG)</th>
    <th align="center" width="8%">PANJANG (YARD/METER)</th>
    <th align="center" width="8%">PCS</th>
    <th align="center" width="12%">BUYER</th>
    <th align="center" width="10%">NO PO</th>
    <th align="center" width="10%">NO ORDER</th>
    <th align="center" width="10%">NO ITEM</th>
    <th align="center" width="20%">JENIS KAIN</th>
    <th align="center" width="6%">LOT</th>
    <th align="center" width="5%">CURRENCY</th>
    <th align="center" width="5%">SATUAN</th>
    <th align="center" width="5%">UNIT PRICE</th>
  </tr>
  </thead>
  <tbody>
  <?php 
  if($_POST['po']!=""){
    $po= " AND no_po LIKE '%".$_POST['po']."%' ";
  }	 
	$sqlbr=sqlsrv_query($con,"SELECT
	id,tgl_kirim,tgl_buat,no_sj,warna,rol,qty,panjang,netto,buyer,no_po,no_order,no_item,jenis_kain,lot,tujuan,ket,foc,satuan_mkt,currency,price,approve_acc
FROM
	tbl_pengiriman
WHERE
	not no_sj='' AND ISNULL(kategori) $po
ORDER BY no_sj asc");
$no=1;
$c=0;
while($row3=sqlsrv_fetch_array($sqlbr)){
    $sqlmkt=sqlsrv_query($conn,"SELECT TOP 1 SUM(b.Quantity) AS qty_po from JobOrders a
    INNER JOIN SODetails b ON a.SOID=b.SOID
    INNER JOIN ProductMaster c ON b.ProductID=c.ID
    INNER JOIN SODetailsAdditional d ON d.SODID=b.ID
    INNER JOIN ProductPartner e ON e.productid=b.ProductID
    INNER JOIN UnitDescription f on f.ID=b.unitID
    INNER JOIN Currencies g on g.ID=b.CurrencyID
    where d.PONumber='".$row3['no_po']."'
    GROUP BY a.DocumentNo");
    $rowmkt=sqlsrv_fetch_array($sqlmkt,SQLSRV_FETCH_ASSOC);

    $sqljml=sqlsrv_query($con,"SELECT
    SUM(qty) AS qty, SUM(panjang) AS panjang, SUM(netto) AS netto
    FROM
      tbl_pengiriman
    WHERE
      NOT no_sj='' AND ISNULL(kategori) AND no_po='".$row3['no_po']."' 
    GROUP BY no_order LIMIT 1");
    $rowdt=sqlsrv_fetch_array($sqljml);

  $bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99';
  ?>
  <tr bgcolor="<?php echo $bgcolor;?>" >
    <td><?php echo $no;?></td>
    <td><?php echo date("d-M-Y", strtotime($row3['tgl_buat'])) ?></td>
    <td><?php echo date("d-M-Y", strtotime($row3['tgl_kirim'])) ?></td>
    <td><?php echo $row3['no_sj']; ?></td>
    <td><?php echo $row3['warna']; ?></td>
    <td align="right"><?php echo $row3['rol']; ?></td>
    <td align="right"><?php echo $row3['qty']; ?></td>
    <td align="right"><?php echo $row3['panjang']; ?></td>
    <td align="right"><?php echo $row3['netto']; ?></td>
    <td><?php echo $row3['buyer']; ?></td>
    <td><?php echo $row3['no_po']; ?></td>
    <td><?php echo $row3['no_order']; ?></td>
    <td><?php echo $row3['no_item']; ?></td>
    <td><?php echo $row3['jenis_kain']; ?></td>
    <td><?php echo $row3['lot']; ?></td>
    <td><?php echo $row3['currency']; ?></td>
    <td><?php echo $row3['satuan_mkt']; ?></td>
    <td><?php echo $row3['price']; ?></td>
  </tr>
  <?php $no++;
  $totrol=$totrol+$row3['rol'];
  $totqty=$totqty+ $row3['qty'];
  $totpjg=$totpjg+ $row3['panjang'];
  $totnet=$totnet+ $row3['netto'];
  $satuan=$row3['satuan_mkt'];
  } ?>
  </tbody>
  <tfoot>
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
  </tfoot>
</table>

</body>
</html>