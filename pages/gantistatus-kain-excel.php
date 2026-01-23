<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=ganti-status-kain.xls");
?>
<?php
ini_set("error_reporting",1);
include("../koneksi.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Ganti Status Kain</title>

</head>

<body>
<table width="100%" align="center" style="font-size:11px" border="1">
  <tr align="center" >
    <td width="21" rowspan="3">NO</td>
    <td width="82" rowspan="3">LANGGANAN</td>
    <td width="29" rowspan="3">PO</td>
    <td width="37" rowspan="3">ORDER</td>
    <td width="62" rowspan="3">JENIS_KAIN</td>
    <td width="73" rowspan="3" >NO WARNA</td>
    <td width="50" rowspan="3">WARNA</td>
    <td width="59" rowspan="3">NO CARD</td>
    <td width="34" rowspan="3">LOT</td>
    <td width="35" rowspan="3">ROLL</td>
    <td colspan="7">Netto (KG)</td>
    <td width="71" rowspan="3">Yard / Meter</td>
    <td width="34" rowspan="3">LOKASI</td>
    <td width="59" rowspan="3">EXTRA Q</td>
    <td width="26" rowspan="3">LBR</td>
    <td width="10" rowspan="3">X</td>
    <td width="35" rowspan="3">GRMS</td>
    <td width="21" rowspan="3">OL</td>
    <td width="74" rowspan="3">Status</td>
    <td width="74" rowspan="3">Keterangan</td>
  </tr>
  <tr align="center" >
    <td colspan="2">GRADE A</td>
    <td colspan="2">GRADE B</td>
    <td colspan="2">GRADE C</td>
    <td width="63" rowspan="2">Keterangan</td>
  </tr>
  <tr align="center">
    <td width="35">ROLL</td>
    <td width="22" >KG</td>
    <td width="35" >ROLL</td>
    <td width="22" >KG</td>
    <td width="35" >ROLL</td>
    <td width="22" > KG</td>
    </tr>
  <?php
	if($_GET['itm']!='')
	{
	$item=trim($_GET['itm']);
	$where5.= " AND trim(c.no_item)='$item' ";
	}else{ $where5.= " "; }
	if($_GET['wrn']!='')
	{
	$warna=trim($_GET['wrn']);
	$where6.= " AND trim(c.warna)='$warna' ";
	}else{ $where6.= " "; }
	if($_GET['nokk']!='')
	{
	$nokk=trim($_GET['nokk']);
	$where7.= " AND trim(c.nokk)='$nokk' ";
	}else{ $where7.= " "; }
	if($_GET['order']!='')
	{
	$order=trim($_GET['order']);
	$where8.= " AND trim(c.no_order)='$order' ";
	}else{ $where8.= " "; }
	if($_GET['wrn']=="" and $_GET['order']=="" and $_GET['nokk']=="" and $_GET['itm']==""){ $nowhere.=" AND a.id='' "; }
  $sql=sqlsrv_query($con," SELECT
	a.tgl_update,c.no_po,c.no_order,a.blok,
	b.sisa,b.nokk,c.jenis_kain,c.pelanggan,c.no_lot,c.no_warna,
	c.warna,c.lebar,c.berat,c.no_item,b.id_stok,a.catat,a.id,b.ket_stok,a.sts_stok,
	GROUP_CONCAT(DISTINCT lokasi) as lokasi
	FROM
	pergerakan_stok a
	LEFT JOIN detail_pergerakan_stok b ON a.id = b.id_stok
  	LEFT JOIN tmp_detail_kite d ON d.id=b.id_detail_kj
	LEFT JOIN tbl_kite c ON c.id = d.id_kite
	WHERE
	(a.typestatus = '1' OR a.typestatus = '2')
	AND not ISNULL(b.transtatus) AND b.transtatus='1' ".$where8.$where7.$where6.$where5.$nowhere." 
	GROUP BY
	b.nokk,b.sisa,b.id_stok,b.ket_stok
	ORDER BY
	a.tgl_update,a.id ");
  $c=1;
  $i=1;
  $no=1;
  while($row=sqlsrv_fetch_array($sql))
  {
	   $bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99';
	   $mySql =sqlsrv_query($con,"SELECT tempat,catatan FROM mutasi_kain WHERE nokk='".$row['nokk']."' AND keterangan='".$row['sisa']."' AND not tempat='' order by id desc");
	   $myBlk = sqlsrv_fetch_array($mySql);
	   $mySqlC =sqlsrv_query($con,"SELECT tempat,catatan FROM mutasi_kain WHERE nokk='".$row['nokk']."' AND keterangan='".$row['sisa']."' order by id desc");
	   $myBlkC = sqlsrv_fetch_array($mySqlC);
	   $sqlCtt=sqlsrv_query($con,"SELECT keterangan FROM tbl_ket_ppc
						WHERE nokk='".$row['nokk'] ."' AND ket_sisa='".$row['sisa'] ."' AND idp='".$row['id_stok']."' ORDER BY id DESC");
	   $ctt=sqlsrv_fetch_array($sqlCtt);
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
	a.id,b.ket_stok ASC ");
	$myro = sqlsrv_fetch_array($mysqlCek);
	if($myBlkC1['sisa'] != number_format($myro['tot_yard'],'2','.','')." ".$myro['satuan']."s"){
	  if($myBlkC1['catatan']!=""){$catat=$myBlkC1['catatan'].$myBlkC1['sisa'];}else{
		  $catat= $myBlkC1['catat']; //$myBlkC['catatan'];
	  }}else{}
	  if($myro['tot_rol']>0){
	   $mySql1 =sqlsrv_query($con,"SELECT * FROM tbl_kite WHERE nokk='".$row['nokk']."'");
	   $myBlk1 = sqlsrv_fetch_array($mySql1);
	   $mySql2 =sqlsrv_query($con,"SELECT a.no_po,a.no_order FROM pergerakan_stok a
INNER JOIN detail_pergerakan_stok b ON a.id=b.id_stok
WHERE b.nokk='".$row['nokk']."' and ISNULL(b.transtatus)
GROUP BY b.nokk");
	   $myBlk2 = sqlsrv_fetch_array($mySql2);
	if($row['sisa']=="SISA" || $row['sisa']=="FKSI"){
			$brt_sisa=$myro['grd_a']+$myro['grd_b']+$myro['grd_c'];
			if($brt_sisa>10 and substr($row['tgl_update'],0,10)>="2019-08-07"){$sts_sisa="Sisa Produksi";}
			else if($brt_sisa<=10 and substr($row['tgl_update'],0,10)>="2019-08-07"){$sts_sisa="Sisa Toleransi";}
		}else{$sts_sisa="";}
	if($myBlk1['no_po']!=""){$p0=$myBlk1['no_po'];}else{$p0=$myBlk2['no_po'];}
	  $strp0=strtoupper($p0);
	  $strp1=strtoupper($p0);
	  $cBooking=strpos($strp0,"BOOKING");
	  $cMiniBulk=strpos($strp0,"MINI BULK");
	  $cTrutexPro=strpos($strp0,"TRUTEX PROJECTION");	  
	  ?>
    <tr >
      <td><?php echo $no;?></td>
    <td><?php echo $myBlk1['pelanggan'];?></td>
    <td><?php if($myBlk1['no_po']!=""){echo $myBlk1['no_po'];}else{echo $myBlk2['no_po'];}?></td>
    <td><?php if($myBlk1['no_order']!=""){echo $myBlk1['no_order'];}else{echo $myBlk2['no_order'];}?></td>
    <td><?php echo $myBlk1['jenis_kain'];?></td>
    <td><?php echo $myBlk1['no_warna'];?></td>
    <td><?php echo $myBlk1['warna'];?></td>
    <td>'<?php echo $row['nokk'];?></td>
    <td>'<?php echo trim($myBlk1['no_lot']);?></td>
    <td align="right"><?php
	echo $myro['tot_rol'];
	?></td>
    <td align="right"><?php
	echo $myro['rol_a'];
	?></td>
    <td align="right"><?php
	echo number_format($myro['grd_a'],'2','.',',');?></td>
    <td align="right"><?php
	echo $myro['rol_b'];
	?></td>
    <td align="right"><?php
	echo number_format($myro['grd_b'],'2','.',',');?></td>
    <td align="right"><?php
	echo $myro['rol_c'];
	?></td>
    <td align="right"><?php
	echo number_format($myro['grd_c'],'2','.',',');
	?></td>
    <td><?php if($row['sisa']=="SISA" || $row['sisa']=="FKSI"){echo "SISA";}?></td>
    <td align="right"><?php
	if($myro['satuan']=="PCS"){echo number_format($myro['netto'])." ".$myro['satuan'];}else{
	echo number_format($myro['tot_yard'],'2','.',',')." ".$myro['satuan'];} ?></td>
    <td><?php
	if($row['lokasi']!=""){echo $row['lokasi'];}else{echo "N/A";}?></td>
    <td><?php if($myro['sisa']=="FOC"){echo "FOC";}?></td>
    <td><?php echo $myBlk1['lebar'];?></td>
    <td>X</td>
    <td><?PHP echo $myBlk1['berat']; ?></td>
    <td><?php if($row['sisa']=="KITE" || $row['sisa']=="FKSI"){echo "Fasilitas KITE";}?></td>
    <td align="center"><?php if($row['ket_stok']!=""){echo trim($row['ket_stok']);}else if($cBooking>-1 or $cMiniBulk > -1 or $cTrutexPro > -1){echo "Booking";}else if($row['sts_stok']!="" and ($row['sisa']=="FKSI" or $row['sisa']=="SISA")){echo trim($sts_sisa);}else{echo trim($row['sts_stok']);}?></td>
    <td align="center"><?php if($catat!=""){echo $catat;}else{echo $myBlkC['catatan']; }?>
      <?php echo $ctt['keterangan']; ?></td>
    <?php  $i++; ?>
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
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>PCS</td>
    <td align="right"><?php echo number_format($totrolp); ?></td>
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
    <td>&nbsp;</td>
  </tr>
 <tr>
   <td>&nbsp;</td>
   <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Meter</td>
    <td align="right"><?php echo number_format($totrolm); ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Meter</td>
    <td align="right"><?php echo number_format($kartot,'2','.',','); ?></td>
    <td>&nbsp;</td>
    <td align="right"><?php echo number_format($totpcs); ?></td>
    <td>PCS</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Yard</td>
    <td align="right"><?php echo  number_format($totroly);?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Yard</td>
    <td align="right"><?php echo  number_format($pltot,'2','.',',');?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><b>Total</b></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="right"><b><?php echo $totrol;?></b></td>
    <td align="right"><b><?php echo $totrola;?></b></td>
    <td align="right"><b><?php echo number_format($tota,'2','.',',');?></b></td>
    <td align="right"><b><?php echo $totrolb;?></b></td>
    <td align="right"><b><?php echo number_format($totb,'2','.',',');?></b></td>
    <td align="right"><b><?php echo $totrolc;?></b></td>
    <td align="right"><b><?php echo number_format($totc,'2','.',',');?></b></td>
    <td>&nbsp;</td>
    <td align="right">&nbsp;</td>

    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="26"><b>
      ( Roll : <?php echo  number_format($totrol);  ?> )
      <font color="Blue">(GRADE A: <?php echo  number_format($tota,'2','.',',');  ?> Kg, Roll: <?php echo  number_format($totrola);  ?>)</font>
      <font color="Green">(GRADE B: <?php echo  number_format($totb,'2','.',',');  ?> Kg, Roll: <?php echo  number_format($totrolb);  ?>)</font>
      <font color="Red">(GRADE C: <?php echo  number_format($totc,'2','.',',');  ?> Kg, Roll: <?php echo  number_format($totrolc);  ?>)</font>
    (TOTAL : <?php echo  number_format($tota+$totb+$totc,'2','.',',');  ?> Kg) </b></td>
    </tr>
  <b>
  ( Roll : <?php echo  number_format($totrol);  ?> )
  <font color="Blue">(GRADE A: <?php echo  number_format($tota,'2','.',',');  ?> Kg, Roll: <?php echo  number_format($totrola);  ?>)</font>
  <font color="Green">(GRADE B: <?php echo  number_format($totb,'2','.',',');  ?> Kg, Roll: <?php echo  number_format($totrolb);  ?>)</font>
  <font color="Red">(GRADE C: <?php echo  number_format($totc,'2','.',',');  ?> Kg, Roll: <?php echo  number_format($totrolc);  ?>)</font>
  (TOTAL : <?php echo  number_format($tota+$totb+$totc,'2','.',',');  ?> Kg)</b>
      </table>

</body>
</html>
