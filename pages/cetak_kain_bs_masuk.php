<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=kain_bs_masuk.xls");//ganti nama sesuai keperluan
header("Pragma: no-cache");
header("Expires: 0");
//disini script laporan anda
?>
<body>                  
                        
<table width="100%" border="1">
  <tr>
    <td colspan="23" align="center"><b>LAPORAN HARIAN KAIN BS MASUK</b></td>
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
ini_set("error_reporting",1);
include('koneksi.php');
if($_GET['tgl1']!="" and $_GET['tgl2']!="")
  {$tgll=" AND a.tgl_update between '$_GET[tgl1]' AND '$_GET[tgl2]' ";}
  else if($_GET['tgl1']="")
  {$tgll=" ";}
 
  if($_GET['order']!="")
  {$order=" AND c.no_order='$_GET[order]' ";}
   else if($tgl1="" and $order="")
  {$tgll=" AND a.tgl_update='$_GET[tgl1]' ";}
  $sql=sqlsrv_query($con,"SELECT
    a.idmutasi, a.tgl_update, a.documentno, c.no_po, c.no_order, a.blok, b.weight, b.yard_, b.no_roll, b.id_stok,
    b.satuan, b.grade, b.sisa, b.nokk, c.jenis_kain, c.pelanggan, c.no_lot, c.no_warna,
    c.warna, c.lebar, c.berat, c.no_item, a.ket,
    SUM(b.weight) as tot_qty,
    COUNT(b.yard_) as tot_rol,
    SUM(b.yard_) as tot_yard,
    SUM(CASE WHEN b.grade IN ('A', 'B', '') THEN b.weight ELSE 0 END) as grd_ab,
    SUM(CASE WHEN b.grade = 'C' THEN b.weight ELSE 0 END) as grd_c,
    SUM(CASE WHEN b.grade IN ('A', 'B', '') THEN 1 ELSE 0 END) as jml_ab,
    SUM(CASE WHEN b.grade = 'C' THEN 1 ELSE 0 END) as jml_grd_c,
    SUM(ISNULL(d.netto, 0)) as netto
  FROM
    db_qc.pergerakan_stok a
    INNER JOIN db_qc.detail_pergerakan_stok b ON a.id = b.id_stok
    INNER JOIN db_qc.tmp_detail_kite d ON d.id = b.id_detail_kj
    INNER JOIN db_qc.tbl_kite c ON c.id = d.id_kite
  WHERE
    (b.transtatus = '11' or b.transtatus = '10')
    $tgll $order
  GROUP BY
    a.id, a.idmutasi, a.tgl_update, a.documentno, c.no_po, c.no_order, a.blok, b.weight, b.yard_, b.no_roll, b.id_stok,
    b.satuan, b.grade, b.sisa, b.nokk, c.jenis_kain, c.pelanggan, c.no_lot, c.no_warna,
    c.warna, c.lebar, c.berat, c.no_item, a.ket
  ORDER BY
    a.id");
  $c=1;
  while($row=sqlsrv_fetch_array($sql))
  {
	  $sqlsrv =sqlsrv_query($con,"SELECT tempat FROM db_qc.mutasi_kain WHERE nokk='$row[nokk]' and no_mutasi='$row[idmutasi]' order by id asc");
	   $myBlk = sqlsrv_fetch_array($sqlsrv); 
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
	echo number_�     "K   l0      "L   l0l     "M   l0�     "N   l1     "O   l1P     "P   l1�     "Q   l2L     "R   l2�     "S   l3<     "T   l3�     "U   l4     "V   l4`     "W   l4�     "X   l5L     "Y   l5�     "Z   l60     "[   l6�     "\   l7     "]   l7X     "^   l7�     "_   l7�     "`   l8L     "a   l8�     "b   l9     "c   l9�     "d   l9�     "e   l:8     "f   l:�     "g   l;$     "h   l;�     "i   l<      "j   l<p     "k   l<�     "l   l=D     "m   l=�     "n   l>,     "o   l>�     "p   l?      "q   l?�     "r   l@     "s   l@�     "t   lA     "u   lA|     "v   lA�     "w   lBl     "x   lB�     "y   lCT     "z   lC�     "{   lD(     "|   lD�     "}   lE     "~   lEL     "   lE�     "�   lF     "�   lFL     "�   lF�     "�   lF�     "�   lG@     "�   lG�     "�   lG�     "�   lH     "�   lH`     "�   lH�     "�   lH�     "�   lI8     "�   lI�     "�   lJ     "�   lJ�     "�   lK�     "�   lJx     "�   lK�     "�   lLP     "�   lL��    l2L    l2�    l3<    l3�    l4    l4`    l4�    l5L    l5�    l60    l6�    l7    l7X    l7�    l7�    l8L    l8�    l9    l9�    l9�    l:8    l:�    l;$    l;�    l<     l<p    l<�    l=D    l=�    l>,    l>�    l?     l?�    l@    l@�    lA    lA|    lA�    lBl    lB�    lCT    lC�    lD(    lD�    lE    lEL    lE�    lF    lFL    lF�    lF�    lG@    lG�    lG�    lH    lH`    lH�    lH�    lI8    lI�    lJ    lJx    lJ�    lK�    lK�    lLP    lL�    lL�    lM,    lM�    lM�    lNP    lO     lOd    lO�    lPh    lQ    lQx    lR    lR�    lR�    lSl    lT�    lU�    lVL    lV�    lX�    lZ    lZL    lZ�    l[�    l](    l^�    l`�    lbl    lb�    lc,    lc�    ldt    le0    le�    lf,    lf�    lgD    lg�    lh8    lh�    lil    lj    lk    lm�    ln�    lo(    lp(    lp�    lq    lq�    lrH    lr�    ls    lsp    ls�    lt�    lu    lu�    lv     lvx    lv�    lw�    lx$    lxl    lx�    lyX    ly�    ly�    lzL    lz�    l{0    l|    l|P    l|�    ;�1500001   �p1500002   �     "}   lE     "~   lEL     "   lE�     "�   lF     "�   lFL     "�   lF�     "�   lF�     "�   lG@     "�   lG�     "�   lG�     "�   lH     "�   lH`     "�   lH�     "�   lH�     "�   lI8     "�   lI�     "�   lJ     "�   lJ�     "�   lK�     "�   lJx     "�   lK�     "�   lLP     "�   lL�     "�   lL�     "�   lM,     "�   lM�     "�   lM�     "�   lNP     "�   lN�     "�   lO      "�   lOd     "�   lO�     "�   lO�     "�   lPh     "�   lP�     "�   lQ     "�   lQx     "�   lQ�     "�   lR     "�   lR�     "�   lR�     "�   lSl     "�   lS�     "�   lTD     "�   lU$     "�   lU�     "�   lU�     "�   lVL     "�   lV�     "�   lWd     "�   lW�     "�   lX     "�   lX�     "�   lX�     "�   lY,     "�   lYt     "�   lY�     "�   lZ     "�   lZL     "�   lZ�     "�   l[(     "�   l[�     "�   l[�     "�   l\`     "�   l\�     "�   l](     "�   l]�     "�   l]�     "�   l^`     "�   l^�     "�   l_4     "�   l_�     "�   l` �1602909   lU�1602910   lV�1602911   lWd1602912   lW�1602913   lX1602914   lX�1602915   lY,1602916   lYt1602917   lY�1602918   l[(1602919   l[�1602920   l\`1602921   l\�1602922   l]�1602923   l]�1602924   l^`1602925   l_41602926   l_�1602927   l` 1602928   l`d1602929   la(1602930   la�1602931   lb 1602932   ld,1602933   ld�1602934   lg�1602935   li1602936   li�1602937   lj|1602938   lj�1602939   lkl1602940   lk�1602941   ll1602942   llt1602943   ll�1602944   lm1602945   lm|1602946   ln,1602947   ln�1602948   lop1602949   lo�1602950   lq�1602951   ltX1602952   lwX1602953   l{t1602954   l{�1602955   l}�1602956   l~1602957   l~`1602958   l�1602959   l�1602960   l��1602961   l�D1602962   l�01602963   l��1602964   l��1602965   l�(1602966   l��1602967   l�$1602968   l��1602969   l��1602970   l��1602971   l�(1602972   l��1602973   l��1602974   l�1602975   l�`1602976   l���     "�   lW�     "�   lX     "�   lX�     "�   lX�     "�   lY,     "�   lYt     "�   lY�     "�   lZ     "�   lZL     "�   lZ�     "�   l[(     "�   l[�     "�   l[�     "�   l\`     "�   l\�     "�   l](     "�   l]�     "�   l]�     "�   l^`     "�   l^�     "�   l_4     "�   l_�     "�   l`      "�   l`d     "�   l`�     "�   la(     "�   la�     "�   lb      "�   lbl     "�   lb�     "�   lc,     "�   lc�     "�   ld,     "�   ldt     "�   ld�     "�   le0     "�   le�     "�   lf,     "�   lf�     "�   lgD     "�   lg�     "�   lg�     "�   lh8     "�   lh�     "�