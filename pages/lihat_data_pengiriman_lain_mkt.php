<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Laporan Pengiriman</title>
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
<form id="form1" name="form1" method="POST" action="pages/simpan_approve.php?tgl=<?php echo $_POST['awal']; ?>&nosj=<?php echo $_POST['no_sj']; ?>" onsubmit="return myFungsi()">
<?php 
$bulan=array("","JANUARI","FEBRUARI","MARET","APRIL","MEI","JUNI","JULI","AGUSTUS","SEPTEMBER","OKTOBER","NOVEMBER","DESEMBER");
$bln=number_format(date("m", strtotime($_POST['awal'])));
$thn=date("Y", strtotime($_POST['awal'])); ?>
<div align="center">LAPORAN HARIAN PENGIRIMAN LAIN-LAIN<br />
BULAN <?php echo $bulan[$bln]." ".$thn; ?> </div> 
<br />
<a href="pages/lihat_data_pengiriman_mkt_excel.php?awal=<?php echo $_POST['awal'];?>&akhir=<?php echo $_POST['akhir'];?>&no_sj=<?php echo $_POST['no_sj'];?>&buyer=<?php echo $_POST['buyer'];?>">CETAK</a>
<table width="100%" border="0" class="display" id="datatables">
 <thead>
  <tr bgcolor="#3399CC">
    <th align="center">NO</th>
    <th align="center">TGL BUAT</th>
    <th align="center">TGL KIRIM</th>
    <th align="center">NO SJ</th>
    <th align="center">WARNA</th>
    <th align="center">ROLL</th>
    <th align="center">QUANTITY (KG)</th>
    <th align="center">BUYER</th>
    <th align="center">NO PO</th>
    <th align="center">NO ORDER</th>
    <th align="center">NO ITEM</th>
    <th align="center">JENIS KAIN</th>
    <th align="center">LOT</th>
    <th align="center">CURRENCY</th>
    <th align="center">SATUAN</th>
    <th align="center">UNIT PRICE</th>
    <th align="center">UBAH</th>
    
  </tr>
  </thead>
  <tbody>
  <?php 
  $ttgl=date("d", strtotime($_POST['awal']));
  $newdate = strtotime( '-1 day' , strtotime ($_POST['awal']) );
  $ttglm=date("d", $newdate);
  if($_POST['awal']!=""){
	  $tgll= " a.tgl_update='".$_POST['awal']."' ";
	  }else {$tgll="";}
  if($_POST['no_sj']!="" and $_POST['awal']!=""){
	  $sj= " And a.no_sj='".$_POST['no_sj']."' ";
	  }	 
  if($_POST['no_sj']!="" and $_POST['awal']=="") 
	  { $sj= " a.no_sj='".$_POST['no_sj']."' "; }	  
  
$tt=date("Y-m-d", strtotime($_POST['awal']));
  $awal=date("Y-m-", strtotime($_POST['awal']));
  $nawal=$awal."01";
  $newdate1 = strtotime( '-1 day' , strtotime ($_POST['awal']) );
  $ttm=date("Y-m-d", $newdate1);
  $sql1=mysqli_query($con,"SELECT sum(qty) as qty from tbl_pengiriman 
WHERE tmp_hapus='0' AND not no_sj='' AND tgl_buat BETWEEN '$nawal' AND '$tt' AND kategori='lain-lain' ");
$row1=mysqli_fetch_array($sql1);
 $sql2=mysqli_query($con,"SELECT sum(qty) as qty from tbl_pengiriman 
WHERE tmp_hapus='0' AND not no_sj='' AND tgl_buat BETWEEN '$nawal' AND '$ttm' AND kategori='lain-lain'");
$row2=mysqli_fetch_array($sql2);	
  if($_POST['awal']!="" AND $_POST['buyer']!=""){
    $tgl2l= " tmp_hapus='0' AND tgl_buat BETWEEN '".$_POST['awal']."' AND '".$_POST['akhir']."' AND buyer LIKE '%".$_POST['buyer']."%' ";
    }else if($_POST['awal']!=""){
    $tgl2l= " tmp_hapus='0' AND tgl_buat BETWEEN '".$_POST['awal']."' AND '".$_POST['akhir']."' ";
    }else{$tgl2l= " tmp_hapus='0' AND tgl_update!='' ";}	  
  if($_POST['no_sj']!=""){
    $sj2= " AND no_sj='".$_POST['no_sj']."' ";
    }
  if($_POST['buyer']!=""){
    $buyer2= " AND buyer LIKE '%".$_POST['buyer']."%' ";
  }	 
	$sqlbr=mysqli_query($con,"SELECT
	id,tgl_kirim,tgl_buat,no_sj,warna,rol,qty,buyer,no_po,no_order,no_item,jenis_kain,lot,tujuan,ket,foc,satuan_mkt,currency,price,approve_acc
FROM
	tbl_pengiriman
WHERE
	not no_sj='' AND kategori='lain-lain' AND $tgl2l $sj2 $buyer2
ORDER BY no_sj asc");
$no=1;
$c=0;
while($row3=mysqli_fetch_array($sqlbr)){
    $sqlmkt=sqlsrv_query($conn,"SELECT a.DocumentNo,c.Color,d.PONumber,e.ProductCode,b.UnitPrice,f.UnitName,g.Symbol from JobOrders a
    INNER JOIN SODetails b ON a.SOID=b.SOID
    INNER JOIN ProductMaster c ON b.ProductID=c.ID
    INNER JOIN SODetailsAdditional d ON d.SODID=b.ID
    INNER JOIN ProductPartner e ON e.productid=b.ProductID
    INNER JOIN UnitDescription f on f.ID=b.unitID
    INNER JOIN Currencies g on g.ID=b.CurrencyID
    where a.DocumentNo='".$row3['no_order']."' and c.Color='".$row3['warna']."' and d.PONumber='".$row3['no_po']."' AND e.ProductCode='".$row3['no_item']."'");
    $rowmkt=sqlsrv_fetch_array($sqlmkt,SQLSRV_FETCH_ASSOC);

    if($_POST['awal']!="" AND $row3['satuan_mkt']==''){
        $sqlupdate=mysqli_query($con,"UPDATE tbl_pengiriman SET 
            `satuan_mkt`='".$rowmkt['UnitName']."',
            `currency`='".$rowmkt['Symbol']."',
            `price`='".$rowmkt['UnitPrice']."'
            WHERE tgl_buat BETWEEN '".$_POST['awal']."' AND '".$_POST['akhir']."' AND no_order='".$rowmkt['DocumentNo']."' AND warna='".$rowmkt['Color']."' AND no_po='".$rowmkt['PONumber']."' AND no_item='".$rowmkt['ProductCode']."'
        ");
    }
    if($_POST['no_sj']!="" AND $row3['satuan_mkt']==''){
        $sqlupdate=mysqli_query($con,"UPDATE tbl_pengiriman SET 
            `satuan_mkt`='".$rowmkt['UnitName']."',
            `currency`='".$rowmkt['Symbol']."',
            `price`='".$rowmkt['UnitPrice']."'
            WHERE no_sj='".$_POST['no_sj']."' AND no_order='".$rowmkt['DocumentNo']."' AND warna='".$rowmkt['Color']."' AND no_po='".$rowmkt['PONumber']."' AND no_item='".$rowmkt['ProductCode']."'
        ");
    }
  $bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99';
  ?>
  <tr bgcolor="<?php echo $bgcolor;?>" >
    <td <?php if($row3['approve_acc']=="Approve"){?> bgcolor="#FF962C" <?php }?>><?php echo $no;?></td>
    <td <?php if($row3['approve_acc']=="Approve"){?> bgcolor="#FF962C" <?php }?>><?php echo date("d-M-Y", strtotime($row3['tgl_buat'])) ?></td>
    <td <?php if($row3['approve_acc']=="Approve"){?> bgcolor="#FF962C" <?php }?>><?php echo date("d-M-Y", strtotime($row3['tgl_kirim'])) ?></td>
    <td <?php if($row3['approve_acc']=="Approve"){?> bgcolor="#FF962C" <?php }?>><?php if(strpos($row3['jenis_kain'],'FLAT KNIT') === false){?><a href="pages/cetak_surat_jalan_mkt.php?no_sj=<?php echo $row3['no_sj']; ?>&tgl_buat=<?php echo $row3['tgl_buat'];?>" target="_blank"><?php echo $row3['no_sj']; ?></a>
      <?php }else if(strpos($row3['jenis_kain'],'FLAT KNIT') !== false){?> <a href="pages/cetak_surat_jalan_krah_mkt.php?no_sj=<?php echo $row3['no_sj']; ?>&tgl_buat=<?php echo $row3['tgl_buat'];?>" target="_blank" ><?php echo $row3['no_sj']; ?></a><?php } ?>
    </td>
    <td <?php if($row3['approve_acc']=="Approve"){?> bgcolor="#FF962C" <?php }?>><?php echo $row3['warna']; ?></td>
    <td <?php if($row3['approve_acc']=="Approve"){?> bgcolor="#FF962C" <?php }?> align="right"><?php echo $row3['rol']; ?></td>
    <td <?php if($row3['approve_acc']=="Approve"){?> bgcolor="#FF962C" <?php }?> align="right"><?php echo $row3['qty']; ?></td>
    <td <?php if($row3['approve_acc']=="Approve"){?> bgcolor="#FF962C" <?php }?>><?php echo $row3['buyer']; ?></td>
    <td <?php if($row3['approve_acc']=="Approve"){?> bgcolor="#FF962C" <?php }?>><?php echo $row3['no_po']; ?></td>
    <td <?php if($row3['approve_acc']=="Approve"){?> bgcolor="#FF962C" <?php }?>><?php echo $row3['no_order']; ?></td>
    <td <?php if($row3['approve_acc']=="Approve"){?> bgcolor="#FF962C" <?php }?>><?php echo $row3['no_item']; ?></td>
    <td <?php if($row3['approve_acc']=="Approve"){?> bgcolor="#FF962C" <?php }?>><?php echo $row3['jenis_kain']; ?></td>
    <td <?php if($row3['approve_acc']=="Approve"){?> bgcolor="#FF962C" <?php }?>><?php echo $row3['lot']; ?></td>
    <td <?php if($row3['approve_acc']=="Approve"){?> bgcolor="#FF962C" <?php }?>><?php echo $row3['currency']; ?></td>
    <td <?php if($row3['approve_acc']=="Approve"){?> bgcolor="#FF962C" <?php }?>><?php echo $row3['satuan_mkt']; ?></td>
    <td <?php if($row3['approve_acc']=="Approve"){?> bgcolor="#FF962C" <?php }?>><?php echo $row3['price']; ?></td>
    <td <?php if($row3['approve_acc']=="Approve"){?> bgcolor="#FF962C" <?php }?>>
      <?php if($row3['approve_acc']=="Approve" AND $_SESSION['username']=="mktspv"){?><a href="#" onClick="window.open('pages/edit_price.php?id=<?php echo $row3['id']; ?>&nosj=<?php echo $row3['no_sj']; ?>','MyWindow','height=200,width=500,top=250,left=500');">
      UBAH <?php }else if($row3['approve_acc']=="" OR $row3['approve_acc']==NULL){?><a href="#" onClick="window.open('pages/edit_price.php?id=<?php echo $row3['id']; ?>&nosj=<?php echo $row3['no_sj']; ?>','MyWindow','height=200,width=500,top=250,left=500');">
      UBAH <?php }else{echo "&nbsp;";} ?>
      </a>
    </td>
  </tr>
  <?php $no++;
  $totrol=$totrol+$row3['rol'];
  $totqty=$totqty+ $row3['qty'];
  } ?>
  </tbody>
  <tfoot>
  <tr bgcolor="#33CC99" style="">
    <td colspan="5">Total Tanggal <?php echo $ttgl;?></td>
    <td align="right"><?php echo $totrol; ?></td>
    <td align="right"><?php echo number_format(round($totqty,2),'2',',','.'); $qt1=round($totqty,2); ?></td>
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
    <td colspan="6">Total
      <?php if($ttgl=="01"){}else{ ?>
      Tanggal 01 S/D <?php echo $ttglm; }?></td>
    <td align="right"><?php echo number_format(round($row2['qty'],2),'2',',','.');$qt2=round($row2['qty'],2);?></td>
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
    <td colspan="6">Total Tanggal 01 S/D <?php echo $ttgl;?></td>
    <td align="right"><?php echo number_format($qt1+$qt2,'2',',','.');?></td>
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