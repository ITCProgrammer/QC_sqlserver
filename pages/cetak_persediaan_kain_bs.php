<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=kain_bs_persediaan.xls");//ganti nama sesuai keperluan
header("Pragma: no-cache");
header("Expires: 0");
//disini script laporan anda
?>
<body>                  
                        
<table width="100%" border="1">
  <tr>
    <td colspan="23" align="center"><b>LAPORAN PERSEDIAAN KAIN BS</b></td>
    </tr>
  <tr>
 <td colspan="23">&nbsp;</td>
 </tr>
  <tr align="center" valign="middle">
    <td rowspan="2">TGL</td>
    <td rowspan="2">DOCUMENTNO</td>
    <td rowspan="2">NO ITEM</td>
    <td rowspan="2">LANGGANAN</td>
    <td rowspan="2">PO</td>
    <td rowspan="2">ORDER</td>
    <td rowspan="2">JENIS KAIN</td>
    <td rowspan="2" >NO WARNA</td>
    <td rowspan="2">WARNA</td>
    <td rowspan="2">NO CARD</td>
    <td rowspan="2">LOT</td>
    <td rowspan="2">ROLL</td>
    <td colspan="3">Netto (KG)</td>
    <td rowspan="2">Yard / Meter</td>
    <td rowspan="2">UNIT</td>
    <td rowspan="2">EXTRA Q</td>
    <td rowspan="2">LBR</td>
    <td rowspan="2">X</td>
    <td rowspan="2">GRMS</td>
    <td rowspan="2">OL</td>
    <td rowspan="2">Keterangan</td>
  </tr>
  <tr align="center">
    <td>Grade<br /> A+B</td>
    <td>Grade <br /> C</td>
    <td>Keterangan<br />(Grade C)</td>
    </tr>
  <?php 
  mysql_connect("10.0.0.10","dit","4dm1n");
mysql_select_db("db_qc")or die("Gagal Koneksi");
if($_GET['tgl1']!="" and $_GET['tgl2']!="")
  {$tgll=" AND a.tgl_update between '$_GET[tgl1]' AND '$_GET[tgl2]' ";}
  else if($_GET['tgl1']="")
  {$tgll=" ";}
 
  if($_GET['order']!="")
  {$order=" AND c.no_order='$_GET[order]' ";}
   else if($tgl1="" and $order="")
  {$tgll=" AND a.tgl_update='$_GET[tgl1]' ";}
  $sql=mysql_query("SELECT
	a.idmutasi,a.tgl_update,a.documentno,c.no_po,c.no_order,a.blok,b.weight,b.yard_,b.no_roll,b.id_stok,
	b.satuan,b.grade,b.sisa,b.nokk,c.jenis_kain,c.pelanggan,c.no_lot,c.no_warna,
	c.warna,c.lebar,c.berat,c.no_item, sum(b.weight) as tot_qty,count(b.yard_) as tot_rol,sum(b.yard_) as tot_yard,
	SUM(case when b.grade='A' or b.grade='B' or b.grade='' then b.weight else 0 end) as grd_ab,
	SUM(case when b.grade='C' then b.weight else 0 end) as grd_c,
	SUM(if(b.grade='A' or b.grade='B' or b.grade='', 1, 0)) as jml_ab,
	SUM(if(b.grade = 'C', 1, 0)) as jml_grd_c,a.ket,SUM(d.netto) as netto
	FROM
	pergerakan_stok a
	INNER JOIN detail_pergerakan_stok b ON a.id = b.id_stok
    INNER JOIN tmp_detail_kite d ON d.id=b.id_detail_kj
	INNER JOIN tbl_kite c ON c.id = d.id_kite
	WHERE
    b.transtatus='11'
	$tgll $order
	GROUP BY
	a.id,b.nokk,b.sisa
	ORDER BY
	a.id");
  $c=1;
  while($row=mysql_fetch_array($sql))
  {
	   $mySql =mysql_query("SELECT tempat FROM mutasi_kain WHERE nokk='$row[nokk]' and no_mutasi='$row[idmutasi]' order by id asc");
	   $myBlk = mysql_fetch_array($mySql);
	  ?>
    <tr>
      <td align="left"><?php echo date("d-M-Y", strtotime($row['tgl_update']));?></td>
      <td align="left"><?php echo $row['documentno'];?></td>
    <td align="left"><?php echo $row['no_item'];?></td>
    <td><?php echo $row['pelanggan'];?></td>
    <td><?php echo $row['no_po'];?></td>
    <td><?php echo $row['no_order'];?></td>
    <td><?php echo htmlentities($row['jenis_kain'],ENT_QUOTES);?></td>
    <td><?php echo $row['no_warna'];?></td>
    <td><?php echo $row['warna'];?></td>
    <td align="right">' <?php echo $row['nokk'];?></td>
    <td align="right">'  <?php echo $row['no_lot'];?></td>
    <td align="right"><?php 
	$rol=$row['tot_rol'];
	echo $rol;
	?></td>
    <td align="right"><?php 
	$grab=number_format($row['grd_ab'],'2','.',',');echo $grab;?></td>
    <td align="right"><?php 
	$grc=number_format($row['grd_c'],'2','.',',');
	echo $grc;?></td>
    <td><?php if($row['sisa']=="SISA" || $row['sisa']=="FKSI"){echo "SISA";}else if($row['sisa']=="BS"){echo "BS";}?></td>
    <td align="right"><?php 
	if($row['satuan']=="PCS"){echo number_format($row['netto'])." ".$row['satuan'];}else{
	echo number_format($row['tot_yard'],'2','.',',')." ".$row['satuan'];} ?></td>
    <td><?php 
	if($myBlk['tempat']!=""){echo $myBlk['tempat'];}else if($row['blok']!=""){echo $row['blok'];}else{echo "N/A";}?></td>
    <td><?php if($row['sisa']=="FOC"){echo "EXTRA FULL";}?></td>
    <td><?php echo $row['lebar'];?></td>
    <td>X</td>
    <td><?PHP echo $row['berat']; ?></td>
    <td>&nbsp;</td>
    <td align="center"><?php echo $row['ket'];?></td>
  </tr>
 
      <?php
	  if($row['sisa']=="SISA" || $row['sisa']=="FKSI" || $row['sisa']=="FOC"){$brtoo=0;}else{$brtoo=number_format($row['bruto'],'2','.',',');}
	   $totbruto=$totbruto+$brtoo;
	  $totyard=$totyard+$row['tot_yard'];
	  $totrol=$totrol+$rol;
	  $totab=$totab+$grab;
	  $tota=$tota+$grc;
	  	if($row['satuan']=='Meter')
		{$kartot=$kartot + $row['tot_yard']; $totrolm = $totrolm + $row['tot_rol'];}
		if($row['satuan']=='Yard')
		{$pltot=$pltot + $row['tot_yard'];   $totroly = $totroly + $row['tot_rol'];}
	  
	  }
  ?>
  <tr >
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
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Meter</td>
    <td align="right"><?php echo number_format($totrolm); ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Meter</td>
    <td align="right"><?php echo number_format($kartot,'2','.',','); ?></td>
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
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Yard</td>
    <td align="right"><?php echo  number_format($totroly);?></td>
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
  </tr>
  <tr >
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><b>Total</b></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="right"><b><?php echo $totrol;?></td>
    <td align="right"><b><?php echo number_format($totab,'2','.',',');?></b></td>
    <td align="right"><b><?php echo number_format($tota,'2','.',',');?></b></td>
    <td>&nbsp;</td>
    <td align="right">&nbsp;</td>
    
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr >
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
  <tr >
    <td colspan="5" align="center">&nbsp;</td>
    <td colspan="9" align="center">Dibuat Oleh</td>
    <td colspan="9" align="center">Diperiksa oleh</td>
  </tr>
  <tr >
    <td colspan="5" >Nama</td>
    <td colspan="9" align="center">&nbsp;</td>
    <td colspan="9" align="center">&nbsp;</td>
  </tr>
  <tr >
    <td colspan="5" >Jabatan</td>
    <td colspan="9" align="center">Clerk</td>
    <td colspan="9" align="center">Supervisor</td>
  </tr>
  <tr >
    <td height="26" colspan="5" >Tanggal</td>
    <td colspan="9" align="center">&nbsp;</td>
    <td colspan="9" align="center">&nbsp;</td>
  </tr>
  <tr >
    <td colspan="5" ><p>Tanda Tangan</p>
    <p>&nbsp;</p></td>
    <td colspan="9" align="center">&nbsp;</td>
    <td colspan="9" align="center">&nbsp;</td>
  </tr>
  
</table>
</body>
</html>