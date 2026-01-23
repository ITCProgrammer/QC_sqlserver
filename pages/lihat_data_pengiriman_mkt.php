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
<?php 
$bulan=array("","JANUARI","FEBRUARI","MARET","APRIL","MEI","JUNI","JULI","AGUSTUS","SEPTEMBER","OKTOBER","NOVEMBER","DESEMBER");
$bln=number_format(date("m", strtotime($_POST['awal'])));
$thn=date("Y", strtotime($_POST['awal'])); ?>
<div align="center">LAPORAN HARIAN PENGIRIMAN <br />
BULAN <?php echo $bulan[$bln]." ".$thn; ?> </div> 
<br />
<a href="pages/excel_mktnew.php?awal=<?php echo $_POST['awal'];?>&akhir=<?php echo $_POST['akhir'];?>&no_sj=<?php echo $_POST['no_sj'];?>&buyer=<?php echo $_POST['buyer'];?>">CETAK</a>
<div align="right">
    <a href="pages/cetak_surat_jalan_mkt_all.php?awal=<?php echo $_POST['awal']; ?>&akhir=<?php echo $_POST['akhir']; ?>&buyer=<?php echo $_POST['buyer']; ?>&no_sj=<?php echo $_POST['no_sj']; ?>" target="_blank">CETAK SURAT JALAN ALL</a>
</div>
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
    <th align="center" width="12%">BUYER</th>
    <th align="center" width="10%">NO PO</th>
    <th align="center" width="10%">NO ORDER</th>
    <th align="center" width="10%">NO ITEM</th>
    <th align="center" width="20%">JENIS KAIN</th>
    <th align="center" width="6%">LOT</th>
    <th align="center" width="5%">CURRENCY</th>
    <th align="center" width="5%">SATUAN</th>
    <th align="center" width="5%">UNIT PRICE</th>
    <th align="center" width="5%">UBAH</th>
  </tr>
  </thead>
  <tbody>
  <?php 
  $ttgl=date("d", strtotime($_POST['awal']));
  $newdate = strtotime( '-1 day' , strtotime ($_POST['awal']) );
  $ttglm=date("d", $newdate);
    if($_POST['awal']!=""){
        $tgll= " a.tgl_update='".$_POST['awal']."' ";
        }else{$tgll= " a.tgl_update='' ";}	  
    if($_POST['no_sj']!=""){
        $sj= " AND a.no_sj='".$_POST['no_sj']."' ";
        }	 
  $sql=sqlsrv_query($con,"SELECT c.id as idtmp,a.id,a.tgl_update,a.tgl_buat,a.no_sj,a.tujuan,a.ket1,d.warna,d.no_warna,d.no_item,count(b.weight) as roll,sum(b.weight) as qty,sum(b.yard_) as panjang,d.pelanggan,d.no_po,d.no_order,d.jenis_kain,d.no_lot,d.nokk,b.sisa,b.satuan,c.ukuran,sum(c.netto) as netto from packing_list a
LEFT JOIN detail_pergerakan_stok b on a.listno=b.refno
LEFT JOIN tmp_detail_kite c on b.id_detail_kj=c.id
LEFT JOIN tbl_kite d on d.id=c.id_kite 
WHERE  not a.no_sj='' AND $tgll $sj   
GROUP BY SUBSTR(d.nokk,1,11),d.no_lot,c.ukuran,a.no_sj
ORDER BY a.no_sj asc ,b.id desc");
  
while($row=sqlsrv_fetch_array($sql)){
	$ukuran=str_replace("'","''",$row['ukuran']);
	$cek=sqlsrv_query($con,"SELECT id_list from tbl_pengiriman where id_list='".$row['id']."' and nokk='".$row['nokk']."' and (ukuran='$ukuran'or idtmp='".$row['idtmp']."') limit 1");
	$rcek=sqlsrv_num_rows($cek);
	if($rcek>0){
		
	   /* $sqltb=sqlsrv_query($con,"Select * from tbl_kite where nokk='$row[nokk]'"); 
	   $rowtb=sqlsrv_fetch_array($sqltb);
	   $itemno=$rowtb['no_item'];
	   $nowarna=$rowtb['no_warna'];
	   $jenis_kain=$rowtb['jenis_kain'];
	   
	   $sqlitmp=sqlsrv_query($conn,"select top 1 ProductId from productpartner where productcode='$itemno' AND ColorCode='$nowarna' ORDER BY ProductId DESC");
$rowitmp=sqlsrv_fetch_array($sqlitmp);
	    $sqlitmp1=sqlsrv_query($conn,"SELECT * FROM   
(SELECT ROW_NUMBER() 
        OVER (ORDER BY ProductMaster.id ) AS Row, 
       description
    FROM 
 ProductMaster WHERE ID='$rowitmp[ProductId]'
 ) AS EMP
 WHERE Row = 1");
 $sqlitm1=sqlsrv_query($conn,"SELECT description from ProductMaster where ProductNumber='".$itemno."-".$nowarna."'");
 $rowitm1=sqlsrv_fetch_array($sqlitm1);
 $rowitm2=sqlsrv_fetch_array($sqlitmp1);
	   if($rowitm['productcode']!="" and $rjns['description']!="")
	   {
	   $desc1=$rjns['description']; } 
	   
	   else if($rowitm['productcode']=="" and $rjns['description']!=""){
		    $desc1=$rjns['description'];
		   } 
		   else if($rowitm['productcode']=="" and $rowitm1['description']!=""){
		    $desc1=$rowitm1['description'];
		   } 
		   else if($rowitm['productcode']=="" and $rjns['description']==""){
		    $desc1=$jenis_kain;
		   } 
	   else if($itemno==""){
		  
		   }
		   else{
			   if($rowitm1['description']==""){
			    $desc1=$rowitm2['description']; }else{
			    $desc1=$rowitm1['description'];
			   }
			   
			   }
		
		$desc2=addslashes($desc1);
		$udata=sqlsrv_query($con,"
	UPDATE `tbl_pengiriman` SET `panjang`='$row[panjang]',`no_item`='$itemno',`desc1`='$desc2',`no_warna`='$row[no_warna]',`foc`='$row[sisa]' WHERE id_list='$row[id]' and nokk='$row[nokk]'
		"); */		
		}else{
		
	   $sqltb=sqlsrv_query($con,"Select * from tbl_kite where nokk='".$row['nokk']."'"); 
	   $rowtb=sqlsrv_fetch_array($sqltb);
	   $itemno=$rowtb['no_item'];
	   $nowarna=$rowtb['no_warna'];
	   $jenis_kain=$rowtb['jenis_kain'];
	   
	   $sqlitmp=sqlsrv_query($conn,"select top 1 ProductId from productpartner where productcode='$itemno' AND ColorCode='$nowarna' ORDER BY ProductId DESC");
$rowitmp=sqlsrv_fetch_array($sqlitmp,SQLSRV_FETCH_ASSOC);
	    $sqlitmp1=sqlsrv_query($conn,"SELECT * FROM   
(SELECT ROW_NUMBER() 
        OVER (ORDER BY ProductMaster.id ) AS Row, 
       description
    FROM 
 ProductMaster WHERE ID='".$rowitmp['ProductId']."'
 ) AS EMP
 WHERE Row = 1");
 $sqlitm1=sqlsrv_query($conn,"SELECT description from ProductMaster where ProductNumber='".$itemno."-".$nowarna."'");
 $rowitm1=sqlsrv_fetch_array($sqlitm1,SQLSRV_FETCH_ASSOC);
 $rowitm2=sqlsrv_fetch_array($sqlitmp1,SQLSRV_FETCH_ASSOC);
	   if($rowitm['productcode']!="" and $rjns['description']!="")
	   {
	   $desc1=$rjns['description']; } 
	   
	   else if($rowitm['productcode']=="" and $rjns['description']!=""){
		    $desc1=$rjns['description'];
		   } 
		   else if($rowitm['productcode']=="" and $rowitm1['description']!=""){
		    $desc1=$rowitm1['description'];
		   } 
		   else if($rowitm['productcode']=="" and $rjns['description']==""){
		    $desc1=$jenis_kain;
		   } 
	   else if($itemno==""){
		  
		   }
		   else{
			   if($rowitm1['description']==""){
			    $desc1=$rowitm2['description']; }else{
			    $desc1=$rowitm1['description'];
			   }
			   
			   }
		
		$desc2=addslashes($desc1);
		
	$jk=str_replace("'","''",$row['jenis_kain']);
	$po=str_replace("'","''",$row['no_po']);
	$nowarna=str_replace("'","''",$row['no_warna']);
	$warna=str_replace("'","''",$row['warna']);
	$ukuran=str_replace("'","''",$row['ukuran']);
	$sdata=sqlsrv_query($con,"
	INSERT INTO `tbl_pengiriman`(`id_list`,`no_sj`, `warna`, `rol`, `qty`, `buyer`, `no_po`, `no_order`, `jenis_kain`, `lot`, `tujuan`, `ket`, `tgl_kirim`, `tgl_buat`,`tgl_update`,`nokk`,`tmp_hapus`,`foc`,`panjang`,`no_item`,`no_warna`,`desc1`,`satuan`,`netto`,`ukuran`,`idtmp`) VALUES ('".$row['id']."','".$row['no_sj']."', '$warna', '".$row['roll']."', '".$row['qty']."', '".$row['pelanggan']."', '$po', '".$row['no_order']."', '$jk', '".$row['no_lot']."', '".$row['tujuan']."', '".$row['ket1']."', '".$row['tgl_update']."','".$row['tgl_buat']."', now(),'".$row['nokk']."','0','".$row['sisa']."','".$row['panjang']."','$itemno','$nowarna','$desc2','".$row['satuan']."','".$row['netto']."','$ukuran','".$row['idtmp']."')
		");		
	}}

$tt=date("Y-m-d", strtotime($_POST['awal']));
  $awal=date("Y-m-", strtotime($_POST['awal']));
  $nawal=$awal."01";
  $newdate1 = strtotime( '-1 day' , strtotime ($_POST['awal']) );
  $ttm=date("Y-m-d", $newdate1);
  $sql1=sqlsrv_query($con,"SELECT sum(qty) as qty from tbl_pengiriman 
WHERE tmp_hapus='0' AND not no_sj='' AND tgl_buat BETWEEN '$nawal' AND '$tt' AND ISNULL(kategori)");
$row1=sqlsrv_fetch_array($sql1);
 $sql2=sqlsrv_query($con,"SELECT sum(qty) as qty from tbl_pengiriman 
WHERE tmp_hapus='0' AND not no_sj='' AND tgl_buat BETWEEN '$nawal' AND '$ttm' AND ISNULL(kategori)");
$row2=sqlsrv_fetch_array($sql2);	
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
	$sqlbr=sqlsrv_query($con,"SELECT
	id,tgl_kirim,tgl_buat,no_sj,warna,rol,qty,buyer,no_po,no_order,no_item,jenis_kain,lot,tujuan,ket,foc,satuan_mkt,currency,price,approve_acc
FROM
	tbl_pengiriman
WHERE
	not no_sj='' AND ISNULL(kategori) AND $tgl2l $sj2 $buyer2
ORDER BY no_sj asc");
$no=1;
$c=0;
while($row3=sqlsrv_fetch_array($sqlbr)){
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
        $sqlupdate=sqlsrv_query($con,"UPDATE tbl_pengiriman SET 
            `satuan_mkt`='".$rowmkt['UnitName']."',
            `currency`='".$rowmkt['Symbol']."',
            `price`='".$rowmkt['UnitPrice']."'
            WHERE tgl_buat BETWEEN '".$_POST['awal']."' AND '".$_POST['akhir']."' AND no_order='".$rowmkt['DocumentNo']."' AND warna='".$rowmkt['Color']."' AND no_po='".$rowmkt['PONumber']."' AND no_item='".$rowmkt['ProductCode']."'
        ");
    }
    if($_POST['no_sj']!="" AND $row3['satuan_mkt']==''){
        $sqlupdate=sqlsrv_query($con,"UPDATE tbl_pengiriman SET 
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
    <td <?php if($row3['approve_acc']=="Approve"){?> bgcolor="#FF962C" <?php }?>><?php if(strpos($row3['jenis_kain'],'FLAT KNIT') === false){?><a href="pages/cetak_surat_jalan_mkt.php?no_sj=<?php echo $row3['no_sj']; ?>&tgl_kirim=<?php echo $row3['tgl_kirim'];?>" target="_blank"><?php echo $row3['no_sj']; ?></a>
      <?php }else if(strpos($row3['jenis_kain'],'FLAT KNIT') !== false){?> <a href="pages/cetak_surat_jalan_krah_mkt.php?no_sj=<?php echo $row3['no_sj']; ?>&tgl_kirim=<?php echo $row3['tgl_kirim'];?>" target="_blank" ><?php echo $row3['no_sj']; ?></a><?php } ?>
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
      UBAH <?php }else if($row3['approve_acc']=="" OR $row3['approve_acc']==""){?><a href="#" onClick="window.open('pages/edit_price.php?id=<?php echo $row3['id']; ?>&nosj=<?php echo $row3['no_sj']; ?>','MyWindow','height=200,width=500,top=250,left=500');">
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