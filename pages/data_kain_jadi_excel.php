<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=laphariankain.xls");
ini_set("error_reporting",1);
include("../koneksi.php");
?>
<body>
<?php $tgl_cetak1=$_GET['awal']; $tgl_cetak2=$_GET['akhir']; ?><div align="center"><b>LAPORAN HARIAN KAIN JADI<?php if($_GET['ganti_stiker']=="1"){echo " GANTI STIKER ";}else if($_GET['ganti_stiker']=="2"){ echo " POTONG SISA ";}else if($_GET['ganti_stiker']=="4"){ echo " REVISI STIKER ";}else if($_GET['ganti_stiker']=="5"){ echo " INSPEK MEJA ";} ?></b></div>
Shift :<?php if($_GET['shft']=="All"){echo "All";}else{echo $_GET['shft'];} ?>
  <table border="1" align="center" style="font-size:12px">
  <tr align="center">
    <td rowspan="3" ><strong>TGL</strong></td>
    <td rowspan="3" ><strong>NO ITEM</strong></td>
    <td rowspan="3" ><strong>LANGGANAN</strong></td>
    <td rowspan="3" ><strong>PO</strong></td>
    <td rowspan="3" ><strong>ORDER</strong></td>
    <td rowspan="3" ><strong>JENIS_KAIN</strong></td>
    <td rowspan="3"  ><strong>NO WARNA</strong></td>
    <td rowspan="3" ><strong>WARNA</strong></td>
    <td rowspan="3" ><strong>NO CARD</strong></td>
    <td rowspan="3" ><strong>LOT</strong></td>
    <td rowspan="3" ><strong>ROLL</strong></td>
    <td colspan="4" ><strong>Netto (KG)</strong></td>
    <td rowspan="3" ><strong>Yard / Meter</strong></td>
    <td rowspan="3" ><strong>LOKASI</strong></td>
    <td rowspan="3" ><strong>EXTRA Q</strong></td>
    <td rowspan="3" ><strong>LBR</strong></td>
    <td rowspan="3" ><strong>X</strong></td>
    <td rowspan="3" ><strong>GRMS</strong></td>
    <td rowspan="3" ><strong>OL</strong></td>
    <td rowspan="3" ><strong>Keterangan</strong></td>
  </tr>
  <tr align="center">
    <td colspan="4"><strong>Grade</strong></td>
    </tr>
  <tr align="center">
    <td><strong>A</strong></td>
    <td>B</td>
    <td><strong> C</strong></td>
    <td><strong>Keterangan</strong></td>
    </tr>
  <?php
  if($tgl_cetak1!="" and $tgl_cetak2!="")
  {$tgll=" AND a.tgl_update between '$tgl_cetak1' AND '$tgl_cetak2' ";}
  else if($tgl_cetak1="")
  {$tgll=" ";} else if($tgl_cetak2="")
  {$tgll=" ";}
 if($_GET['shft']!="All")
  {$shft1=" AND a.shift='".$_GET['shft']."' ";}else{$shft1=" ";}
  if($_GET['no_order']!="")
  {$order=" AND c.no_order='".$_GET['no_order']."' ";}
   else if($tgl_cetak1="" and $_GET['no_order']="")
  {$tgll=" AND a.tgl_update='$tgl_cetak1' ";}
  if($_GET['ganti_stiker']=="1"){
	  $transfer=" AND ( a.fromtoid = 'GANTI STIKER') ";
	}else if($_GET['ganti_stiker']=="2"){
	  $transfer=" AND ( a.fromtoid = 'POTONG SISA') ";
	}else if($_GET['ganti_stiker']=="4"){
	  $transfer=" AND ( a.fromtoid = 'REVISI STIKER') "; 
	}else if($_GET['ganti_stiker']=="5"){
	  $transfer=" AND ( a.fromtoid='INSPEK MEJA') ";  
	}else{$transfer=" AND (a.fromtoid = 'PACKING' OR a.fromtoid='LAIN' ) ";}
if($_GET['ckKite']=="1"){$kite="AND (b.sisa='KITE' OR b.sisa='FKSI')";}else{$kite="";}
  $sql=mysqli_query($con,"SELECT
	a.id,a.tgl_update,a.blok,a.ket,c.no_po,c.no_order,a.blok,b.weight,b.yard_,b.no_roll,
	b.satuan,b.grade,b.sisa,b.nokk,c.jenis_kain,c.pelanggan,c.no_lot,c.no_warna,
	c.warna,c.lebar,c.berat,c.no_item,
  SUM(case when b.grade='A' or b.grade='B' or b.grade='C' or b.grade='' then b.weight else 0 end) as tot_qty,
  SUM(if(b.grade='A' or b.grade='B' or b.grade='C' or b.grade='', 1, 0)) as tot_rol,
  SUM(case when b.grade='A' or b.grade='B' or b.grade='C' or b.grade='' then b.yard_ else 0 end) as tot_yard,
	SUM(case when b.grade='A' or b.grade='B' or b.grade='' then b.weight else 0 end) as grd_ab,
	SUM(case when b.grade='A' or b.grade='' then b.weight else 0 end) as grd_a,
	SUM(case when b.grade='B' then b.weight else 0 end) as grd_b,
	SUM(case when b.grade='C' then b.weight else 0 end) as grd_c,
	SUM(if(b.grade='A' or b.grade='B' or b.grade='', 1, 0)) as jml_ab,
	SUM(if(b.grade = 'C', 1, 0)) as jml_grd_c,SUM(d.netto) as netto,
	GROUP_CONCAT(DISTINCT lokasi) as lokasi
	FROM
	detail_pergerakan_stok b
	LEFT JOIN  pergerakan_stok a ON a.id = b.id_stok
    LEFT JOIN tmp_detail_kite d ON d.id=b.id_detail_kj
	LEFT JOIN tbl_kite c ON c.id = d.id_kite
	WHERE
	(b.transtatus='1' or b.transtatus='0')
	$tgll $order $shft1 $transfer $kite
	GROUP BY
	a.id,b.nokk,b.sisa
	ORDER BY
	a.id");
  $c=1;
  $i=1;
  while($row=mysqli_fetch_array($sql))
  {
	   $bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99';
	   $mutasi=date("Ymd", strtotime($row['tgl_update']));
	   // $mySql =mysqli_query($con,"SELECT tempat FROM mutasi_kain WHERE nokk='$row[nokk]' and no_mutasi like '%$mutasi%' order by id asc");
	   $mySql=mysqli_query($con,"select mutasi_kain.tempat
from mutasi_kain
INNER JOIN pergerakan_stok on pergerakan_stok.no_mutasi=mutasi_kain.no_mutasi
INNER join detail_pergerakan_stok on pergerakan_stok.id=detail_pergerakan_stok.id_stok
where mutasi_kain.nokk='".$row['nokk']."' and mutasi_kain.keterangan='".$row['sisa']."'
GROUP BY mutasi_kain.id,mutasi_kain.keterangan");
	   $myBlk = mysqli_fetch_array($mySql);
$sqlPtg=mysqli_query($con,"SELECT
SUM(case when grade='C' then weight else 0 end) as grd_c,
SUM(case when grade='A' or grade='B' or grade='' then weight else 0 end) as grd_ab,
SUM(case when grade='A' or grade='' then weight else 0 end) as grd_a,
SUM(case when grade='B' then weight else 0 end) as grd_b,
SUM(yard_) as yard_
from detail_pergerakan_stok WHERE nokk='".$row['nokk']."' and transtatus='3' and id_ref='".$row['id']."' and sisa='".$row['sisa']."' ");
	   $dPtg=mysqli_fetch_array($sqlPtg);
	  $sqlPtgs=mysqli_query($con,"SELECT
SUM(case when grade='C' then weight else 0 end) as grd_c,
SUM(case when grade='A' or grade='B' or grade='' then weight else 0 end) as grd_ab,
SUM(case when grade='A' or grade='' then weight else 0 end) as grd_a,
SUM(case when grade='B' then weight else 0 end) as grd_b,
SUM(yard_) as yard_
from detail_pergerakan_stok WHERE nokk='".$row['nokk']."' and transtatus='3' and id_ref='".$row['id']."' and (sisa='SISA' or sisa='FKSI')");
	   $dPtgs=mysqli_fetch_array($sqlPtgs);
	  $sqlkrup=mysqli_query($con,"SELECT * FROM tbl_kite WHERE nokk='".$row['nokk']."'");
	  $rkrup=mysqli_fetch_array($sqlkrup);
	  ?>
    <tr>
      <td><?php echo date("d-M-Y", strtotime($row['tgl_update']));?></td>
      <td><?php if($row['no_item']!=""){echo $row['no_item'];}else{echo $rkrup['no_item'];}?></td>
      <td><?php if($row['pelanggan']!=""){echo $row['pelanggan'];}else{echo $rkrup['pelanggan'];} ?></td>
      <td><?php if($row['no_po']!=""){echo $row['no_po'];}else{echo $rkrup['no_po'];}?></td>
      <td><?php if($row['no_order']!=""){echo $row['no_order'];}else{echo $rkrup['no_order'];}?></td>
      <td><?php if($row['jenis_kain']!=""){echo htmlentities($row['jenis_kain'],ENT_QUOTES);}else{echo htmlentities($rkrup['jenis_kain'],ENT_QUOTES);}?></td>
      <td><?php if($row['no_warna']!=""){echo $row['no_warna'];}else{echo $rkrup['no_warna'];}?></td>
      <td><?php if($row['warna']!=""){echo $row['warna'];}else{echo $rkrup['warna'];}?></td>
    <td>'<?php echo $row['nokk'];?></td>
    <td>'
      <?php if($row['no_lot']!=""){echo $row['no_lot'];}else{echo $rkrup['no_lot'];}?></td>
    <td align="right"><?php
	$rol=$row['tot_rol'];
	echo $rol;
	?></td>
    <td align="right"><?php
	if($row['sisa']=="SISA" || $row['sisa']=="FKSI"){$gra=$row['grd_a']+$dPtgs['grd_a'];}else{
	$gra=$row['grd_a']+$dPtg['grd_a'];} echo number_format($gra,'2','.',',');?></td>
    <td align="right"><?php
	if($row['sisa']=="SISA" || $row['sisa']=="FKSI"){$grb=$row['grd_b']+$dPtgs['grd_b'];}else{
	$grb=$row['grd_b']+$dPtg['grd_b'];} echo number_format($grb,'2','.',',');?></td>
    <td align="right"><?php
	if($row['sisa']=="SISA" || $row['sisa']=="FKSI"){$grc=$row['grd_c']+$dPtgs['grd_c'];}else{
	$grc=$row['grd_c']+$dPtg['grd_c'];
	}echo number_format($grc,'2','.',',');?></td>
    <td><?php if($row['sisa']=="SISA" || $row['sisa']=="FKSI"){echo "SISA";}?></td>
    <td align="right"><?php
	if($row['satuan']=="PCS"){echo number_format($row['netto'])." ".$row['satuan'];}else{
	echo number_format($row['tot_yard']+$dPtg['yard_'],'2','.',',')." ".$row['satuan'];} ?></td>
    <td><?php if($row['lokasi']!=""){echo $row['lokasi'];}else{echo "N/A";}?></td>
    <td><?php if($row['sisa']=="FOC"){echo "EXTRA FULL";}?></td>
    <td><?php if($row['lebar']!=""){echo $row['lebar'];}else{echo $rkrup['lebar'];}?></td>
    <td>X</td>
    <td><?PHP if($row['berat']!=""){echo $row['berat'];}else{echo $rkrup['berat'];} ?></td>
    <td><?php if($row['sisa']=="KITE" || $row['sisa']=="FKSI"){echo "Fasilitas KITE";}?></td>
    <td align="center"><?php  echo $row['ket'];$i++; ?></td>
  </tr>

      <?php
	  	 if($row['sisa']=="SISA" || $row['sisa']=="FKSI" || $row['sisa']=="FOC"){$brtoo=0;}else{$brtoo=number_format($row['bruto'],'2','.',',');}
	   $totbruto=$totbruto+$brtoo;
	  $totyard=$totyard+$row['tot_yard'];
	  $totrol=$totrol+$rol;
	  $tota=$tota+$gra;
	  $totb=$totb+$grb;
	  $totc=$totc+$grc;
	  	if($row['satuan']=='Meter')
		{$kartot=$kartot + $row['tot_yard']; $totrolm = $totrolm + $row['tot_rol'];}
		if($row['satuan']=='Yard')
		{$pltot=$pltot + $row['tot_yard'];   $totroly = $totroly + $row['tot_rol'];}

	  }


  ?>
  <tr>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
  </tr>
 <tr >
   <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >Meter</td>
    <td align="right" ><?php echo number_format($totrolm); ?></td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >Meter</td>
    <td align="right" ><?php echo number_format($kartot,'2','.',','); ?></td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
  </tr>
  <tr >
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >Yard</td>
    <td align="right" ><?php echo  number_format($totroly);?></td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >Yard</td>
    <td align="right" ><?php echo  number_format($pltot,'2','.',',');?></td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
  </tr>
  <tr>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td ><b>Total</b></td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td align="right" ><b><?php echo $totrol;?></td>
    <td align="right" ><b><?php echo number_format($tota,'2','.',',');?></b></td>
    <td align="right" ><b><?php echo number_format($totb,'2','.',',');?></b></td>
    <td align="right" ><b><?php echo number_format($totc,'2','.',',');?></b></td>
    <td >&nbsp;</td>
    <td align="right" >&nbsp;</td>

    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
  </tr>
  <tr>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td align="right" >&nbsp;</td>
    <td align="right" >&nbsp;</td>
    <td align="right" >&nbsp;</td>
    <td align="right" >&nbsp;</td>
    <td >&nbsp;</td>
    <td align="right" >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4" >&nbsp;</td>
    <td colspan="10" align="center" >Dibuat Oleh</td>
    <td colspan="9" align="center" >Diperiksa oleh</td>
  </tr>
  <tr>
    <td colspan="4" >Nama</td>
    <td colspan="10" align="center" >&nbsp;</td>
    <td colspan="9" align="center" >&nbsp;</td>
    </tr>
  <tr>
    <td colspan="4" >Jabatan</td>
    <td colspan="10" align="center" >Clerk</td>
    <td colspan="9" align="center" >Supervisor</td>
    </tr>
  <tr>
    <td colspan="4" >Tanggal</td>
    <td colspan="10" align="center" >&nbsp;</td>
    <td colspan="9" align="center" >&nbsp;</td>
    </tr>
  <tr>
    <td colspan="4" >Tanda Tangan</td>
    <td colspan="10" align="center" >&nbsp;</td>
    <td colspan="9" align="center" >&nbsp;</td>
    </tr>

</table>
</body>
