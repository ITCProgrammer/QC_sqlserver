<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=status-kain.xls");
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
echo number_format(round($rows['netto'],2),"2",'.','');
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
echo number_format(round($rows['bruto'],2),"2",'.','');
}
/*function deliv($nokk,$orderno){
	$ckKK=strlen($nokk);
	if($ckKK==15){
	$sql0="SELECT convert(char(10),sod.RequiredDate,1) as TglPerlu FROM ProcessControlBatches pcb 
INNER JOIN  ProcessControlJO pcJO ON pcb.pcid=pcJO.pcid
INNER JOIN SODetails sod ON pcJO.SODID=sod.ID
WHERE pcb.DocumentNo='$nokk'";
	}else{
	$sql0="SELECT TOP 1 convert(char(10),sod.RequiredDate,1) as TglPerlu FROM ProcessControlBatches pcb 
INNER JOIN  ProcessControlJO pcJO ON pcb.pcid=pcJO.pcid
INNER JOIN SODetails sod ON pcJO.SODID=sod.ID
INNER JOIN JobOrders jo ON pcJO.JOID=jo.ID
WHERE  jo.DocumentNo='$orderno'";	
	}
$sql = sqlsrv_query($conn,$sql0) 
    or die('A error occured : ');
$rows=sqlsrv_fetch_array($sql);	
	
echo $rows[TglPerlu];
}*/
function deliv($nokk){
	include("../koneksi.php");
	$sql0="SELECT convert(char(10),sod.RequiredDate,1) as TglPerlu FROM ProcessControlBatches pcb 
INNER JOIN  ProcessControlJO pcJO ON pcb.pcid=pcJO.pcid
INNER JOIN SODetails sod ON pcJO.SODID=sod.ID
WHERE pcb.DocumentNo='$nokk'";	
$sql = sqlsrv_query($conn,$sql0) 
    or die('A error occured : ');
$rows=sqlsrv_fetch_array($sql,SQLSRV_FETCH_ASSOC);	
	
	if($rows['TglPerlu']!=""){
		echo $rows['TglPerlu'];		
	}else{
		$sqlMy=sqlsrv_query($con,"SELECT date_format(tgl_delv, '%m/%d/%y') as tgl_delvry FROM tbl_kite WHERE nokk='$nokk'");
		$row11=sqlsrv_fetch_array($sqlMy);
		echo $row11['tgl_delvry'];
	}

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
    <td width="78">TGL</td>
    <td width="186">LANGGANAN</td>
    <td width="154">PO</td>
    <td width="141">ORDER</td>
    <td width="70">NO LOT</td>
    <td width="70">TGL DELIVERY</td>
    <td width="70">BRUTO</td>
    <td width="67" >NETTO</td>
    <td width="69">KIRIM</td>
    <td width="78">SISA KIRIM</td>
    <td width="68">STATUS</td>
    <td width="205">KETERANGAN</td>
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
	
  $sql=sqlsrv_query($con," SELECT
	a.tgl_update,c.no_po,c.no_order,a.blok,
	b.sisa,b.nokk,c.jenis_kain,c.pelanggan,c.no_lot,c.no_warna,
	c.warna,c.lebar,c.berat,c.no_item,b.id_stok,a.catat,a.id,a.sts_stok,b.ket_stok
	FROM
	pergerakan_stok a
	LEFT JOIN detail_pergerakan_stok b ON a.id = b.id_stok
  	LEFT JOIN tmp_detail_kite d ON d.id=b.id_detail_kj
	LEFT JOIN tbl_kite c ON c.id = d.id_kite
	WHERE
	(a.typestatus = '1' OR a.typestatus = '2')
	AND not ISNULL(b.transtatus) AND b.transtatus='1' ".$where9.$where8.$where7.$where6.$where5.$nowhere." 
	GROUP BY
	b.nokk,b.sisa,b.id_stok,b.ket_stok
	ORDER BY
	a.tgl_update,a.id ");
  $c=1;
  $i=1;
  $no=1;
  $n=1;	
  $sts_sisa="";
  $brt_sisa="0";	
  while($row=sqlsrv_fetch_array($sql))
  {
	   $bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99';
	   $mySql =sqlsrv_query($con,"SELECT tempat,catatan FROM mutasi_kain WHERE nokk='".$row['nokk']."' AND keterangan='".$row['sisa']."' AND not tempat='' order by id desc");
	   $myBlk = sqlsrv_fetch_array($mySql);
	   $mySqlC =sqlsrv_query($con,"SELECT tempat,catatan FROM mutasi_kain WHERE nokk='".$row['nokk']."' AND keterangan='".$row['sisa']."' order by id desc");
	   $myBlkC = sqlsrv_fetch_array($mySqlC);
	   //$mySqlC1 =sqlsrv_query($con,"CALL ketorder('$row[id_stok]','$row[nokk]','$row[sisa]');");
	   //$mySqlC1 = sqlsrv_query($con,"CALL `db_qc`.`ketorder`(1710169575,'101801520190001','');",$dbconn12) or die("Query fail: " . mysql_error());;
	   $mySqlC1 =sqlsrv_query($con,"SELECT GROUP_CONCAT(
		CONCAT(
			'Untuk Order ',
			no_order,
			' Qty ',
			qty_minta,
			' ',
			satuan,' Sisa '
		)
	) AS catatan,a.sisa,a.catat
FROM
	tbl_catat_kain a
LEFT JOIN tbl_catat_detail b ON a.id = b.id_catat
WHERE
	a.id_kain = '".$row['id_stok']."'
AND a.nokk = '".$row['nokk']."'
AND a.ket = '".$row['sisa']."'
AND b.tmp_hapus='0'");
	   $myBlkC1 = sqlsrv_fetch_array($mySqlC1);	  
	  if($row['ket_stok']!=""){$stks=" and b.ket_stok='".$row['ket_stok']."' ";}else{ $stks="";}
	   $mysqlCek=sqlsrv_query($con," SELECT
	SUM(case when b.grade='A' or b.grade='B' or b.grade='C' or b.grade='' then b.weight else 0 end) as tot_qty,
	SUM(if(b.grade='A' or b.grade='B' or b.grade='C' or b.grade='', 1, 0)) as tot_rol,
	SUM(if(b.grade='A' or b.grade='', 1, 0)) as rol_a,
	SUM(if(b.grade='B', 1, 0)) as rol_b,
	SUM(if(b.grade='C', 1, 0)) as rol_c,
	SUM(case when b.grade='A' or b.grade='B' or b.grade='C' or b.grade='' then b.yard_ else 0 end) as tot_yard,
	SUM(case when b.grade='A' or b.grade='B' or b.grade='' then b.weight else 0 end) as grd_ab,
	SUM(case when b.grade='A' or b.grade='' then b.weight else 0 end) as grd_a,
	SUM(case when b.grade='B' then b.weight else 0 end) as grd_b,
	SUM(case when b.grade='C' then b.weight else 0 end) as grd_c,
	SUM(if(b.grade='A' or b.grade='B' or b.grade='', 1, 0)) as jml_ab,
	SUM(if(b.grade = 'C', 1, 0)) as jml_grd_c,b.sisa,b.satuan,SUM(d.netto) as netto,
	a.blok,a.tgl_update
	FROM
	pergerakan_stok a
	LEFT JOIN detail_pergerakan_stok b  ON a.id = b.id_stok
    LEFT JOIN tmp_detail_kite d ON d.id=b.id_detail_kj
	LEFT JOIN tbl_kite c ON c.id = d.id_kite
	WHERE
	b.`transtatus`='1' and b.nokk='".$row['nokk']."' and b.sisa='".$row['sisa']."' and b.id_stok='".$row['id_stok']."' $stks
	AND (a.fromtoid = 'GUDANG KAIN JADI' OR a.fromtoid = 'PACKING' OR a.fromtoid='LAIN' OR a.fromtoid='INSPEK MEJA' OR a.fromtoid ='GANTI STIKER' OR a.fromtoid ='REVISI STIKER' OR a.fromtoid ='POTONG SISA')
	GROUP BY
	b.sisa,b.id_stok,b.ket_stok
	ORDER BY
	a.id,b.ket_stok ASC");
	$myro = sqlsrv_fetch_array($mysqlCek);
	if($myBlkC1['sisa'] != number_format($myro['tot_yard'],'2','.','')." ".$myro['satuan']."s"){
	  if($myBlkC1['catatan']!=""){$catat=$myBlkC1['catatan'].$myBlkC1['sisa'];}else{
		  $catat= $myBlkC1['catat']; //$myBlkC['catatan'];
	  }}else{}
	  if($myro['tot_rol']>0){
	   $mySql1 =sqlsrv_query($con,"SELECT berat,lebar,no_item,pelanggan,no_po,no_order,
	   jenis_kain,warna,no_warna,no_lot FROM tbl_kite WHERE nokk='".$row['nokk']."' LIMIT 1");
	   $myBlk1 = sqlsrv_fetch_array($mySql1);
	   $mySql2 =sqlsrv_query($con,"SELECT a.no_po,a.no_order FROM pergerakan_stok a
INNER JOIN detail_pergerakan_stok b ON a.id=b.id_stok
WHERE b.nokk='".$row['nokk']."' and ISNULL(b.transtatus)
GROUP BY b.nokk LIMIT 1");
	   $myBlk2 = sqlsrv_fetch_array($mySql2);
	  if($row['sisa']=="SISA" || $row['sisa']=="FKSI"){
			$brt_sisa=$myro['grd_a']+$myro['grd_b']+$myro['grd_c'];
			if($brt_sisa>10 and substr($row['tgl_update'],0,10)>="2019-01-01"){$sts_sisa="Sisa Produksi";}
			else if($brt_sisa<=10 and substr($row['tgl_update'],0,10)>="2019-01-01"){$sts_sisa="Sisa Toleransi";}
		}else{$sts_sisa="";}	
	  $brt_sisa1=$myro['grd_a']+$myro['grd_b']+$myro['grd_c'];
	  if($myBlk1['no_po']!=""){$p0=$myBlk1['no_po'];}else{$p0=$myBlk2['no_po'];}
	  $strp0=strtoupper($p0);
	  $strp1=strtoupper($p0);
	  $cBooking=strpos($strp0,"BOOKING");
	  $cMiniBulk=strpos($strp0,"MINI BULK");
	  $cTrutexPro=strpos($strp0,"TRUTEX PROJECTION");
		  $sqlSKirim=sqlsrv_query($con,"SELECT if(ISNULL(sum(weight)),0,sum(weight)) as kg_skirim FROM detail_pergerakan_stok b WHERE b.`transtatus`='1' and b.nokk='".$row['nokk']."' and b.sisa='".$row['sisa']."' and b.id_stok='".$row['id_stok']."' $stks ");
		  $rSK=sqlsrv_fetch_array($sqlSKirim);
		 $sqlKirim=sqlsrv_query($con,"SELECT if(ISNULL(sum(weight)),0,sum(weight)) as kg_kirim FROM detail_pergerakan_stok b WHERE b.`transtatus`='0' and b.nokk='".$row['nokk']."'");
		  $rK=sqlsrv_fetch_array($sqlKirim); 
		  $sqlNetto=sqlsrv_query($con,"SELECT sum(weight) as netto FROM detail_pergerakan_stok WHERE nokk='".$row['nokk']."' and (transtatus='1' or transtatus='0')");
		  $rNetto=sqlsrv_fetch_array($sqlNetto);
		  
	  ?>
  <tr>
    <td align="center"><?php echo $no;?></td>
    <td align="center"><?php echo substr($row['tgl_update'],0,10);?></td>
    <td><b title="<?php echo $myBlk1['pelanggan'];?>"><?php echo $myBlk1['pelanggan'];?></b></td>
    <td><b title="<?php if($myBlk1['no_po']!=""){echo $myBlk1['no_po'];}else{echo $myBlk2['no_po'];}?>">
      <?php if($myBlk1['no_po']!=""){echo $myBlk1['no_po'];}else{echo $myBlk2['no_po'];}?>
    </b></td>
    <td><?php if($myBlk1['no_order']!=""){echo $myBlk1['no_order'];}else{echo $myBlk2['no_order'];}?></td>
    <td align="center">'<?php echo $row['no_lot'];?></td>
    <td align="right"><?php deliv($row['nokk']); ?></td>
    <td align="right"><?php tBrto($row['nokk']); ?></td>
    <td align="right"><?php echo $rNetto['netto'] ?></td>
    <td align="right"><?php echo $rK['kg_kirim']; ?></td>
    <td align="right"><?php echo $rSK['kg_skirim']; ?></td>
    <td align="center"><?php if($row['ket_stok']!=""){echo trim($row['ket_stok']);}else if($cBooking>-1 or $cMiniBulk > -1 or $cTrutexPro > -1){echo "Booking";}else if(($row['sisa']=="FKSI" or $row['sisa']=="SISA")){echo trim($sts_sisa);}else{echo trim($row['sts_stok']);}?></td>
    <td><?php if($catat!=""){echo $catat;}else{echo $myBlkC['catatan']; }?>
      '<?php echo $row['nokk']; ?></td>
    <?php  $i++; 
	       $sisaKirim=$sisaKirim+$rSK['kg_skirim'];?>
  </tr>
  <?php
		  
	}
	  	 if($myro['sisa']=="SISA" || $myro['sisa']=="FKSI" || $myro['sisa']=="FOC"){$brtoo=0;}else{$brtoo=number_format($row['bruto'],'2','.',',');}
	   $totbruto=$totbruto+$brtoo;
	  $totyard=$totyard+$myro['tot_yard'];
	  $totrol=$totrol+$myro['tot_rol'];
	  $totrola=$totrola+$myro['rol_a'];
	  $totrolb=$totrolb+$myro['rol_b'];
	  $totrolc=$totrolc+$myro['rol_c'];
	  $totab=$totab+$myro['grd_ab'];
	  $tota=$tota+$myro['grd_a'];
	  $totb=$totb+$myro['grd_b'];
	  $totc=$totc+$myro['grd_c'];
	  $totpcs=$totpcs +$myro['netto'];
	  $rolab=$rolab + $myro['jml_ab'];
	  $rolac=$rolac + $myro['jml_grd_c'];
	  	if($myro['satuan']=='Meter')
		{$kartot=$kartot + $myro['tot_yard']; $totrolm = $totrolm + $myro['tot_rol'];}
		if($myro['satuan']=='Yard')
		{$pltot=$pltot + $myro['tot_yard'];   $totroly = $totroly + $myro['tot_rol'];}
		if($myro['satuan']=='PCS')
		{$totrolp = $totrolp + $myro['tot_rol'];}	  
	  $no++;
	  }


  ?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td></td>
    <td></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="right"><?php echo $sisaKirim;?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="13"></td>
  </tr>  
</table>
</body>
</html>