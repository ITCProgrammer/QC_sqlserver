<?php 
ini_set('error_reporting',1);
$con=mysqli_connect("10.0.0.10","dit","4dm1n","db_qc");	
//include "koneksi.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Laporan Kain Per Order</title>
</head>

<body>
<?Php 
$Order	= isset($_POST['order']) ? $_POST['order'] : '';
$Awal	= isset($_POST['awal']) ? $_POST['awal'] : '';
$Akhir	= isset($_POST['akhir']) ? $_POST['akhir'] : '';
?>	
<form id="form1" name="form1" method="POST" action="" enctype="multipart/form-data">

<table width="100%" border="0">
  <tr>
    <th height="22" colspan="6" scope="row">&nbsp;</th>
  </tr>
  <tr>
    <th colspan="6" scope="row">Filter  Per Bulan Status Stok</th>
    </tr>
      <th width="11%" align="left" valign="top" scope="row">Tanggal Awal</th>
    <th width="1%" valign="top" scope="row">:</th>
    <td width="88" colspan="4"><input type="text" id="awal" name="awal" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.awal);return false;" value="<?php echo $Awal; ?>"/>
        <a href="javascript:void(0)" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.awal);return false;"><img src="calender/calender.jpeg" alt="" name="popcal" width="34" height="29" id="popcal" style="border:none" align="absmiddle" border="0" /></a></td>
  </tr>	
  <tr>
    <th align="left" valign="top" scope="row">Tanggal Akhir</th>
    <th valign="top" scope="row">:</th>
    <td colspan="4"><input type="text" id="akhir" name="akhir" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.akhir);return false;" value="<?php echo $Akhir; ?>"/>
      <a href="javascript:void(0)" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.akhir);return false;"><img src="calender/calender.jpeg" alt="" name="popcal" width="34" height="29" id="popcal2" style="border:none" align="absmiddle" border="0" /></a></td>
  </tr>  
  <tr>
    <th align="left" valign="top" scope="row">&nbsp;</th>
    <th align="left" valign="top" scope="row">&nbsp;</th>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <th align="left" valign="top" scope="row"><input type="submit" name="cari" id="cari" value="Cari Data"/></th>
    <th align="left" valign="top" scope="row">&nbsp;</th>
    <td colspan="4" align="right"><a href="pages/lap-rekap-status-excel.php?awal=<?Php echo $Awal;?>&amp;akhir=<?Php echo $Akhir;?>&amp;order=<?Php echo $Order;?>" target="_blank">Cetak Excel</a></td>
  </tr>
	
  </table>
<div align="center"> DETAIL DATA</div>

<table width="100%" align="center" style="font-size:11px">
  <tr align="center" bgcolor="#0099FF">
    <td width="36" bgcolor="#3366CC">BULAN</td>
	<td width="186" bgcolor="#3366CC">QUANTITY STOCK</td>
	<td width="186" bgcolor="#3366CC">SISA PRODUKSI</td>
	<td width="186" bgcolor="#3366CC">SISA TEMBAK QTY</td>
	<td width="186" bgcolor="#3366CC">SISA GANTI KAIN</td>
	<td width="186" bgcolor="#3366CC">TUNGGU KIRIM</td>
	<td width="141" bgcolor="#3366CC">TUNGGU CONFORM</td>
	<td width="141" bgcolor="#3366CC">SISA TOLERANSI</td>
    <td width="141" bgcolor="#3366CC">MOQ</td>
    <td width="67" bgcolor="#3366CC" >BOOKING</td>
    <td width="67" bgcolor="#3366CC" >REVISI ORDER</td>
    <td width="69" bgcolor="#3366CC">CANCEL ORDER</td>
    <td width="78" bgcolor="#3366CC">UNTUK LOCAL</td>
    <td width="78" bgcolor="#3366CC">BELUM ADA STATUS</td>
    </tr>
  <?php
  
	if($_POST['itm']!='')
	{
	$item=trim($_POST['itm']);
	$where5.= " AND trim(c.no_item)='$item' ";
	}else{ $where5.= " "; }
	if($_POST['wrn']!='')
	{
	$warna=trim($Wrn);
	$where6.= " AND trim(c.warna)='$warna' ";
	}else{ $where6.= " "; }
	if($_POST['nokk']!='')
	{
	$nokk=trim($KK);
	$where7.= " AND trim(c.nokk)='$nokk' ";
	}else{ $where7.= " "; }
	if($Order!='')
	{
	$ordr=trim($Order);
	$where8.= " AND trim(c.no_order)='$ordr' ";
	}else{ $where8.= " "; }
	if($_POST['awal'] !='')
	{
	$where9.= " AND DATE_FORMAT(a.tgl_update,'%Y-%m-%d') BETWEEN '$Awal' AND '$Akhir' ";
	}else{ $where9.= " "; }
	if($Order=="" and $Awal=="" and $Akhir==""){ $nowhere.=" AND a.id='' "; }else{$nowhere.="";}
	
  $sql=mysqli_query($con,"SELECT DATE_FORMAT(tgl_update,'%M') as bulan, 
sum(if(y.kets='Sisa Toleransi',y.kg_skirim1,0)) as sisa_toleransi,
sum(if(y.kets='Sisa Produksi',y.kg_skirim1,0)) as sisa_produksi,
sum(if(y.kets='Booking',y.kg_skirim1,0)) as booking,
sum(if(y.kets='Sisa dibawah MOQ',y.kg_skirim1,0)) as sisa_moq,
sum(if(y.kets='Sisa Ganti Kain',y.kg_skirim1,0)) as sisa_ganti,
sum(if(y.kets='Tunggu Kirim',y.kg_skirim1,0)) as tunggu_kirim,
sum(if(y.kets='Tunggu Conform',y.kg_skirim1,0)) as tunggu_conform,
sum(if(y.kets='Cancel Order',y.kg_skirim1,0)) as cancel_order,
sum(if(y.kets='Revisi',y.kg_skirim1,0)) as revisi,
sum(if(y.kets='Sisa Tembak Qty',y.kg_skirim1,0)) as sisa_tembak,
sum(if(y.kets='Untuk Local',y.kg_skirim1,0)) as utk_local,
sum(if(y.kets='',y.kg_skirim1,0)) as sisa_tdk,
sum(y.kg_skirim1) as total
FROM
(SELECT x.*,if(ISNULL(x.kg),0,x.kg) as kg_skirim1 ,
if(NOT ISNULL(x.ket_stok),x.ket_stok,
if(x.Booking>0 or x.MiniBulk>0 or x.TrutexPro>0,'Booking',
if(ISNULL(x.ket_stok) and (x.sisa='FKSI' or x.sisa='SISA') and if(ISNULL(x.kg),0,x.kg)<=10,'Sisa Toleransi',
if(ISNULL(x.ket_stok) and (x.sisa='FKSI' or x.sisa='SISA') and if(ISNULL(x.kg),0,x.kg)>10,'Sisa Produksi',
if(sts_stok='Tunggu Kirim' and ISNULL(x.ket_stok),'Tunggu Kirim',''
))))) as kets
FROM 
(
SELECT
	a.tgl_update,c.no_po,c.no_order,a.blok,
	b.sisa,b.nokk,sum(b.weight) as kg,c.jenis_kain,c.pelanggan,c.no_lot,c.no_warna,
	c.warna,c.lebar,c.berat,c.no_item,b.id_stok,a.catat,a.id,a.sts_stok,b.ket_stok,
	LOCATE('Booking',c.no_po) AS Booking,
	LOCATE('TRUTEX PROJECTION',c.no_po) AS TrutexPro,
	LOCATE('Mini Bulk',c.no_po) AS MiniBulk
	FROM
	pergerakan_stok a
	LEFT JOIN detail_pergerakan_stok b ON a.id = b.id_stok
  LEFT JOIN tmp_detail_kite d ON d.id=b.id_detail_kj
	LEFT JOIN tbl_kite c ON c.id = d.id_kite
	WHERE
	(a.typestatus = '1' OR a.typestatus = '2')
	AND not ISNULL(b.transtatus) AND b.transtatus='1' 
  ".$where9.$where8.$where7.$where6.$where5.$nowhere."  
	GROUP BY
	b.nokk,b.sisa,b.id_stok,b.ket_stok
	ORDER BY
	a.tgl_update,a.id ASC) x
	INNER JOIN
	detail_pergerakan_stok b ON b.nokk=x.nokk and b.id_stok=x.id_stok and b.sisa=x.sisa
	WHERE b.`transtatus`='1'
	GROUP BY x.nokk,x.sisa,x.id_stok,x.ket_stok
	ORDER BY x.tgl_update ASC) y
	GROUP BY DATE_FORMAT(tgl_update,'%M')	
	ORDER BY y.tgl_update ASC
	");
  $c=1;
  $no=1;	
  while($row=mysqli_fetch_array($sql))
  {
	   $bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99';
	   
	   
	  ?>
    <tr bgcolor="<?php echo $bgcolor; ?>">
    <td align="center"><?php echo $row['bulan'];?></td>
	<td align="right"><?php echo number_format($row['total'],'2','.',',');?></td>
	<td align="right"><?php echo number_format($row['sisa_produksi'],'2','.',',');?></td>
	<td align="right"><?php echo number_format($row['sisa_tembak'],'2','.',',');?></td>
	<td align="right"><?php echo number_format($row['sisa_ganti'],'2','.',',');?></td>
	<td align="right"><?php echo number_format($row['tunggu_kirim'],'2','.',',');?></td>
	<td align="right"><?php echo number_format($row['tunggu_conform'],'2','.',',');?></td>
	<td align="right"><?php echo number_format($row['sisa_toleransi'],'2','.',',');?></td>
    <td align="right"><?php echo number_format($row['sisa_moq'],'2','.',',');?></td>
    <td align="right"><?php echo number_format($row['booking'],'2','.',',');?></td>
    <td align="right"><?php echo number_format($row['revisi'],'2','.',',');?></td>
    <td align="right"><?php echo number_format($row['cancel_order'],'2','.',',');?></td>
    <td align="right"><?php echo number_format($row['utk_local'],'2','.',',');?></td>
    <td align="right"><?php echo number_format($row['sisa_tdk'],'2','.',',');?></td>
    <?php  $i++; ?>
  </tr>

      <?php
		  $TTotal    	 = $TTotal + $row['total'];
		  $TBooking 	 = $TBooking + $row['booking'];;
		  $TTKirim   	 = $TTKirim+$row['tunggu_kirim'];
	      $TTConform   	 = $TTConform+$row['tunggu_conform'];
	  	  $TSisaPro    	 = $TSisaPro + $row['sisa_produksi'];
		  $TSisaTmk 	 = $TSisaTmk + $row['sisa_tembak'];;
		  $TSisaGTI   	 = $TSisaGTI +$row['sisa_ganti'];
	      $TSisaTol   	 = $TSisaTol + $row['sisa_toleransi'];
		  $TMOQ		 	 = $TMOQ + $row['sisa_moq'];;
		  $TRevisi  	 = $TRevisi +$row['revisi'];
	      $TCancelO    	 = $TCancelO + $row['cancel_order'];
		  $TBlmAdaSTS 	 = $TBlmAdaSTS + $row['sisa_tdk'];;
		  $TLocal   	 = $TLocal + $row['utk_local'];
	  $no++;
	  }

    
  ?>
      <tr bgcolor="#99FFFF">
        <td bgcolor="#CCFF99">TOTAL</td>
        <td align="right" bgcolor="#CCFF99"><?php echo number_format($TTotal,'2','.',',');?></td>
        <td align="right" bgcolor="#CCFF99"><?php echo number_format($TSisaPro,'2','.',',');?></td>
        <td align="right" bgcolor="#CCFF99"><?php echo number_format($TSisaTmk,'2','.',',');?></td>
        <td align="right" bgcolor="#CCFF99"><?php echo number_format($TSisaGTI,'2','.',',');?></td>
        <td align="right" bgcolor="#CCFF99"><?php echo number_format($TTKirim,'2','.',',');?></td>
        <td align="right" bgcolor="#CCFF99"><?php echo number_format($TTConform,'2','.',',');?></td>
        <td align="right" bgcolor="#CCFF99"><?php echo number_format($TSisaTol,'2','.',',');?></td>
        <td align="right" bgcolor="#CCFF99"><?php echo number_format($TMOQ,'2','.',',');?></td>
        <td align="right" bgcolor="#CCFF99"><?php echo number_format($TBooking,'2','.',',');?></td>
        <td align="right" bgcolor="#CCFF99"><?php echo number_format($TRevisi,'2','.',',');?></td>
        <td align="right" bgcolor="#CCFF99"><?php echo number_format($TCancelO,'2','.',',');?></td>
        <td align="right" bgcolor="#CCFF99"><?php echo number_format($TLocal,'2','.',',');?></td>
        <td align="right" bgcolor="#CCFF99"><?php echo number_format($TBlmAdaSTS,'2','.',',');?></td>
      </tr>
  <tr bgcolor="#99FFFF">
    <td colspan="22" bgcolor="#CCFF99"></td>
    </tr>
  </table>
</form>
</body>
</html>