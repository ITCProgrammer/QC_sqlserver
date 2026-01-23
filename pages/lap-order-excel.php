<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=order-kain.xls");
?>
<?php
ini_set("error_reporting",1);
include("../koneksi.php");
$awal  = $_GET['awal'];
$akhir = $_GET['akhir'];
$order = $_GET['order'];
function tNet($orderK){
	include("../koneksi.php");
	$sql00 = "SELECT ID from SalesOrders WHERE SONumber='$orderK'";
	$sql1  = sqlsrv_query($conn,$sql00)or die('A error occured : ');
    $rows1 = sqlsrv_fetch_array($sql1,SQLSRV_FETCH_ASSOC);
	$sql0="select 
		ROUND((sum(sod.Weight * sod.WeightUnitMultiplier) / 1000),0) as netto, 
		ROUND((sum(soda.GrossWeight * soda.GrossWeightUnitMultiplier) / 1000),0) as bruto
	from 
		SODetails as sod inner join SODetailsAdditional as soda on sod.ID = soda.SODID
	where sod.SOID = '".$rows1['ID']."'";

$sql = sqlsrv_query($conn,$sql0) 
    or die('A error occured : ');
$rows=sqlsrv_fetch_array($sql,SQLSRV_FETCH_ASSOC);	
	$nt =round($rows['netto'],2);
	return $nt;
}
function tBrto($orderK){
	include("../koneksi.php");
	$sql00 = "SELECT ID from SalesOrders WHERE SONumber='$orderK'";
	$sql1  = sqlsrv_query($conn,$sql00)or die('A error occured : ');
    $rows1 = sqlsrv_fetch_array($sql1,SQLSRV_FETCH_ASSOC);
	$sql0="select 
		ROUND((sum(sod.Weight * sod.WeightUnitMultiplier) / 1000),0) as netto, 
		ROUND((sum(soda.GrossWeight * soda.GrossWeightUnitMultiplier) / 1000),0) as bruto
	from 
		SODetails as sod inner join SODetailsAdditional as soda on sod.ID = soda.SODID
	where sod.SOID = '".$rows1['ID']."'";

$sql = sqlsrv_query($conn,$sql0) 
    or die('A error occured : ');
$rows=sqlsrv_fetch_array($sql,SQLSRV_FETCH_ASSOC);	
$brt = round($rows['bruto'],2);
	return $brt;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Ganti Status Kain</title>
</head>

<body>
<table width="100%" align="center" style="font-size:11px">
  <tr align="center">
    <td width="36">NO</td>    
    <td width="186">LANGGANAN</td>
    <td width="141">ORDER</td>    
    <td width="141">PO</td>
    <td width="70">BRUTO</td>
    <td width="67" >NETTO</td>
    <td width="69">KIRIM</td>
    <td width="78">SISA KIRIM</td>
    <td width="78"> % SISA KIRIM</td>
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
	if($order!='')
	{
	$ordr=trim($order);
	$where8.= " AND trim(c.no_order)='$ordr' ";
	}else{ $where8.= " "; }
	if($awal !='')
	{
	$where9.= " AND DATE_FORMAT(a.tgl_update,'%Y-%m-%d') BETWEEN '$awal' AND '$akhir' ";
	}else{ $where9.= " "; }
	if($order=="" and $awal=="" and $akhir==""){ $nowhere.=" AND a.id='' "; }else{$nowhere.="";}
	
  $sql=sqlsrv_query($con,"SELECT *, if(ISNULL(sum(y.kg_skirim1)),0,sum(y.kg_skirim1)) as kg_skirim FROM
(SELECT x.*,if(ISNULL(x.kg),0,x.kg) as kg_skirim1 ,
if(NOT ISNULL(x.ket_stok),x.ket_stok,
if(x.Booking>0 or x.MiniBulk>0,'Booking',
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
	WHERE NOT (y.kets='Booking' OR y.kets='Tunggu Kirim' OR y.kets='Tunggu Conform') OR ISNULL(y.kets) 
	GROUP BY y.no_order	
	ORDER BY y.tgl_update ASC");
  $c=1;
  $i=1;
  $no=1;
  $n=1;	
  $sts_sisa="";
  $brt_sisa="0";	
  while($row=sqlsrv_fetch_array($sql))
  {
	   $bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99';
	  
	  if($row['ket_stok']!=""){$stks=" and b.ket_stok='".$row['ket_stok']."' ";}else{ $stks="";}
		  
		  if($row['no_order']!=""){ 
			  $ordrK="1".substr($row['no_order'],1,100);
			  $ordrKS=$row['no_order'];
		}
		    $sqlKirim=sqlsrv_query($con,"SELECT if(ISNULL(sum(weight)),0,sum(weight)) as kg_kirim FROM tbl_kite a 
		 		LEFT JOIN detail_pergerakan_stok b ON a.nokk=b.nokk
				where a.no_order='$ordrKS' and transtatus='0' ");
		  $rK=sqlsrv_fetch_array($sqlKirim);
		  if($row['kg_skirim']=="0" or tNet($ordrK)=="0"){$pers="0";}else{$pers=round($row['kg_skirim']/tNet($ordrK),4)*100;}
	      $strp0=strtoupper($row['no_po']);
	      $cBooking=strpos($strp0,"BOOKING");
		  $brt_sisa1=$row['kg_skirim'];
	  ?>
  <tr>
    <td align="center"><?php echo $no;?></td>
    <td><?php echo $row['pelanggan'];?></td>
    <td><?php echo $row['no_order'];?></td>
    <td><?php echo $row['no_po'];?></td>
    <td align="right"><?php echo tBrto($ordrK);?></td>
    <td align="right"><?php echo tNet($ordrK);?></td>
    <td align="right"><?php echo $rK['kg_kirim']; ?></td>
    <td align="right"><?php echo $row['kg_skirim']; ?></td>
    <td align="right"><?php echo $pers." %"; ?></td>
    <?php  $i++; 
	       
	  ?>
  </tr>
  <?php
	      $Tbruto    = $Tbruto + tBrto($ordrK);
		  $Tnet 	 = $Tnet + tNet($ordrK);
		  $sisaKirim = $sisaKirim+$row['kg_skirim'];
	  	   
	  $no++;
	  }
	 if($Tnet=="0" or $Tnet=="" or $sisaKirim =="0" or $sisaKirim =="0.00"){$Tpers="0";}else{  $Tpers=round($sisaKirim/$Tnet,4)*100; }

  ?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">Total</td>    
    <td align="right"><?php echo number_format($Tbruto,"2",'.','');?></td>
    <td align="right"><?php echo number_format($Tnet,"2",'.','');?></td>
    <td>&nbsp;</td>
    <td align="right"><?php echo number_format($sisaKirim,"2",'.','');?></td>
    <td align="right"><?php echo $Tpers." %"; ?></td>
  </tr>    
</table>
</body>
</html>