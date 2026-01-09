<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Laporan Pengiriman</title>
<style>
.rol{
    width: 100%;
	font-size:9px;
    height: 600px;
    overflow: scroll;
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
<a href="pages/lihat_data_pengiriman_excel.php?awal=<?php echo $_POST['awal'];?>&no_sj=<?php echo $_POST['no_sj'];?>">CETAK</a>
<div class="rol">
<table width="100%" border="0">
  <tr bgcolor="#3399CC">
    <td align="center">No</td>
    <td align="center">TANGGAL</td>
    <td align="center">NO SJ</td>
    <td align="center">WARNA</td>
    <td align="center">ROLL</td>
    <td align="center">QUANTITY (KG)</td>
    <td align="center">BUYER</td>
    <td align="center">NO PO</td>
    <td align="center">NO ORDER</td>
    <td align="center">JENIS KAIN</td>
    <td align="center">LOT</td>
    <td align="center">TUJUAN</td>
    <td align="center">KET</td>
    <td align="center">FOC</td>
    <td align="center">AKSI</td>
    
  </tr>
  <?php 
  $ttgl=date("d", strtotime($_POST['awal']));
  $newdate = strtotime( '-1 day' , strtotime ($_POST['awal']) );
  $ttglm=date("d", $newdate);
  if($_POST['awal']!=""){
	  $tgll= " a.tgl_update='$_POST[awal]' ";
	  }else {$tgll="";}
  if($_POST['no_sj']!="" and $_POST['awal']!=""){
	  $sj= " And a.no_sj='$_POST[no_sj]' ";
	  }	 
  if($_POST['no_sj']!="" and $_POST['awal']=="") 
	  { $sj= " a.no_sj='$_POST[no_sj]' "; }	  
  $sql=mysql_query("SELECT a.id,a.tgl_update,a.no_sj,a.tujuan,a.ket1,d.warna,d.no_warna,d.no_item,count(b.weight) as roll,sum(b.weight) as qty,sum(b.yard_) as panjang,d.pelanggan,d.no_po,d.no_order,d.jenis_kain,d.no_lot,d.nokk,b.sisa from packing_list a
LEFT JOIN detail_pergerakan_stok b on a.listno=b.refno
LEFT JOIN tmp_detail_kite c on b.id_detail_kj=c.id
LEFT JOIN tbl_kite d on d.id=c.id_kite 
WHERE  $tgll $sj   
GROUP BY a.id,d.nokk
ORDER BY a.no_sj asc");
  
while($row=mysql_fetch_array($sql)){
	
	$cek=mysql_query("SELECT id_list from tbl_pengiriman where id_list='$row[id]' and nokk='$row[nokk]' limit 1");
	$rcek=mysql_num_rows($cek);
	if($rcek>0){
		
		$sqltb=mysql_query("Select * from tbl_kite where nokk='$row[nokk]'"); 
	   $rowtb=mysql_fetch_array($sqltb);
	   $itemno=$rowtb['no_item'];
	   $nowarna=$rowtb['no_warna'];
	   $jenis_kain=$rowtb['jenis_kain'];
	   
	   $sqlitmp=mssql_query("select top 1 ProductId from productpartner where productcode='$itemno' AND ColorCode='$nowarna' ORDER BY ProductId DESC");
$rowitmp=mssql_fetch_array($sqlitmp);
	    $sqlitmp1=mssql_query("SELECT * FROM   
(SELECT ROW_NUMBER() 
        OVER (ORDER BY ProductMaster.id ) AS Row, 
       description
    FROM 
 ProductMaster WHERE ID='$rowitmp[ProductId]'
 ) AS EMP
 WHERE Row = 1");
$sqlitm1=mssql_query("SELECT description from ProductMaster where ProductNumber='".$itemno."-".$nowarna."'");
 $rowitm1=mssql_fetch_array($sqlitm1);
 $rowitm2=mssql_fetch_array($sqlitmp1);
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
		$udata=mysql_query("
	UPDATE `tbl_pengiriman` SET `panjang`='$row[panjang]',`no_item`='$itemno',`desc1`='$desc2',`no_warna`='$row[no_warna]',`foc`='$row[sisa]' WHERE id_list='$row[id]' and nokk='$row[nokk]'
		");		
		}else{
	$jk=addslashes($row['jenis_kain']);
	$po=addslashes($row['no_po']);
	$sdata=mysql_query("
	INSERT INTO `tbl_pengiriman`(`id_list`,`no_sj`, `warna`, `rol`, `qty`, `buyer`, `no_po`, `no_order`, `jenis_kain`, `lot`, `tujuan`, `ket`, `tgl_kirim`, `tgl_update`,`nokk`,`tmp_hapus`,`foc`,`panjang`,`no_item`,`no_warna`,`desc1`) VALUES ('$row[id]','$row[no_sj]', '$row[warna]', '$row[roll]', '$row[qty]', '$row[pelanggan]', '$po', '$row[no_order]', '$jk', '$row[no_lot]', '$row[tujuan]', '$row[ket1]', '$row[tgl_update]', now(),'$row[nokk]','0','$row[foc]','$row[panjang]','$itemno','$row[no_warna]','$desc2')
		");		
	}}

$tt=date("Y-m-d", strtotime($_POST['awal']));
  $awal=date("Y-m-", strtotime($_POST['awal']));
  $nawal=$awal."01";
  $newdate1 = strtotime( '-1 day' , strtotime ($_POST['awal']) );
  $ttm=date("Y-m-d", $newdate1);
  $sql1=mysql_query("SELECT sum(qty) as qty from tbl_pengiriman 
WHERE tmp_hapus='0' AND tgl_kirim BETWEEN '$nawal' AND '$tt'");
$row1=mysql_fetch_array($sql1);
 $sql2=mysql_query("SELECT sum(qty) as qty from tbl_pengiriman 
WHERE tmp_hapus='0' AND tgl_kirim BETWEEN '$nawal' AND '$ttm'");
$row2=mysql_fetch_array($sql2);	
	if($_POST['awal']!=""){
	  $tgl2l= " tmp_hapus='0' AND tgl_kirim='$_POST[awal]' ";
	  }else{$tgl2l= " tmp_hapus='0' AND tgl_update='' ";}	  
  if($_POST['no_sj']!=""){
	  $sj2= " And no_sj='$_POST[no_sj]' ";
	  }	 
	$sqlbr=mysql_query("SELECT
	id,tgl_kirim,no_sj,warna,rol,qty,buyer,no_po,no_order,jenis_kain,lot,tujuan,ket,foc
FROM
	tbl_pengiriman
WHERE
	$tgl2l $sj2
ORDER BY no_sj asc");
$no=1;
$c=0;
while($row3=mysql_fetch_array($sqlbr)){
  $bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99';
  ?>
  <tr bgcolor="<?php echo $bgcolor;?>" >
    <td><?php echo $no; ?></td>
    <td><?php echo date("d-M-Y", strtotime($row3['tgl_kirim'])) ?></td>
    <td><a href="?p=ubah-surat&id=<?php echo $row3['id']; ?>" target="_blank"><?php echo $row3['no_sj']; ?></a></td>
    <td><?php echo $row3['warna']; ?></td>
    <td align="right"><?php echo $row3['rol']; ?></td>
    <td align="right"><?php echo $row3['qty']; ?></td>
    <td><?php echo $row3['buyer']; ?></td>
    <td><?php echo $row3['no_po']; ?></td>
    <td><?php echo $row3['no_order']; ?></td>
    <td><?php echo $row3['jenis_kain']; ?></td>
    <td><?php echo $row3['lot']; ?></td>
    <td><?php echo $row3['tujuan']; ?></td>
    <td><?php echo $row3['ket']; ?></td>
    <td align="center"><?php echo $row3['foc']; ?></td>
    <td align="center"><a href="?p=ubah-surat-detail&id=<?php echo $row3['id']; ?>" target="_blank">UBAH</a></td>
  </tr>
  <?php $no++;
  $totrol=$totrol+$row3['rol'];
  $totqty=$totqty+ $row3['qty'];
  } ?>
  <tr bgcolor="#33CC99">
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
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr bgcolor="#33CC99">
    <td colspan="4">Total Tanggal <?php echo $ttgl;?></td>
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
  <tr bgcolor="#33CC99">
    <td colspan="5">Total <?php if($ttgl=="01"){}else{ ?>Tanggal 01 S/D <?php echo $ttglm; }?></td>
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
  <tr bgcolor="#33CC99">
    <td colspan="5">Total Tanggal 01 S/D <?php echo $ttgl;?></td>
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
</table>
</div>

</body>
</html>