<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

</head>

<body>
<?php
$ganti= $_POST[template];
?>
<form id="form1" name="form1" method="POST" action="" >

<?php
	$sql="SELECT `detail_kite`.`id` as kd,`detail_kite`.`sisa`,`detail_kite`.`grade`,`detail_kite`.`nokkKite`,`detail_kite`.`no_roll`,`detail_kite`.`net_wight`,`detail_kite`.`yard_`,`detail_kite`.`satuan`,`tbl_kite`.`no_warna`,`tbl_kite`.`warna`,`tbl_kite`.`no_lot`,`tbl_kite`.`pelanggan`
FROM `tbl_kite`
INNER JOIN `detail_kite` ON `tbl_kite`.`nokk` = `detail_kite`.`nokkKite` where  `tbl_kite`.`no_order`='$_GET[bon]'
group by `detail_kite`.`nokkkite`,`detail_kite`.`no_roll`
order by `detail_kite`.`nokkkite`,`detail_kite`.`no_roll` asc";
$data=mysql_query($sql);
$sqlrd="SELECT *
FROM `tbl_kite`
INNER JOIN `detail_kite` ON `tbl_kite`.nokk = `detail_kite`.nokkKite where  `tbl_kite`.nokk='$_GET[kkno]' limit 1";
$datard=mysql_query($sqlrd);
$rd2=mysql_fetch_array($datard);
$slgn=mysql_query("SELECT `detail_kite`.`id` as kd,`detail_kite`.`sisa`,`detail_kite`.`grade`,`detail_kite`.`nokkKite`,`detail_kite`.`no_roll`,`detail_kite`.`net_wight`,`detail_kite`.`yard_`,	`tbl_kite`.`no_warna`,`tbl_kite`.`warna`,`tbl_kite`.`no_lot`,`tbl_kite`.`pelanggan`
FROM `tbl_kite`
INNER JOIN `detail_kite` ON `tbl_kite`.`nokk` = `detail_kite`.`nokkKite` where  `tbl_kite`.`nokk`='$_GET[kkno]' group by `detail_kite`.`nokkkite`,`detail_kite`.`no_roll`
order by `detail_kite`.`nokkkite`,`detail_kite`.`no_roll` asc");
$rg=mysql_fetch_array($slgn);
if($_GET[bon]!=""){$noWhere=" ";}else{$noWhere=" AND `tbl_kite`.`id`='' ";}
?>
<table width="100%" border="0">
  <tr>
    <th height="22" colspan="6" scope="row">&nbsp;</th>
  </tr>
  <tr>
    <th colspan="6" scope="row">Data Packing</th>
  </tr>
 
  
  <tr>
    <th width="8%" align="left" valign="top" scope="row">Bon Order</th>
    <th width="1%" align="right" valign="top" scope="row">:</th>
    <td width="91%" colspan="4"><input name="bon" type="text" id="bon" onchange="window.location='index1.php?p=packing_data&amp;bon='+this.value"  value="<?php echo $_GET['bon'];?>" size="20" tabindex="1"/>
      *</td>
  </tr>
  <tr>
    <th align="left" valign="top" scope="row">Buyer</th>
    <th align="right" valign="top" scope="row">:</th>
    <td colspan="4"><select name="byer" id="byer" tabindex="3"  onchange="window.location='index1.php?p=packing_data&amp;bon=<?php echo $_GET['bon'];?>&amp;byer='+this.value">
      <option value="">PILIH</option>
      <?php 
		$byr=str_replace("'","''",$_GET[byer]);
		$sqllanggan=mysql_query("SELECT trim(pelanggan) as langgan
FROM `tbl_kite`
WHERE `tbl_kite`.`no_order` = '$_GET[bon]' $noWhere 
GROUP BY pelanggan");
while($rp=mysql_fetch_array($sqllanggan)){?>
      <option value="<?php echo urlencode($rp['langgan']);?>" <?php if($rp['langgan']==$_GET['byer']){echo"selected";}?>><?php echo $rp['langgan'];?></option>
      <?php  } ?>
      
    </select>
      *</td>
  </tr>
  <tr>
    <th align="left" valign="top" scope="row">PO No</th>
    <th align="right" valign="top" scope="row">:</th>
    <td colspan="4"><select name="nopo"  onchange="window.location='index1.php?p=packing_data&amp;bon=<?php echo $_GET['bon'];?>&amp;byer=<?php echo $byr;?>&amp;nopo='+this.value" tabindex="3">
      <option value="">PILIH</option>
      <?php 
		$sqlnopo=mysql_query("SELECT trim(no_po) as no_po,nokk
FROM `tbl_kite`
WHERE `tbl_kite`.`no_order` ='$_GET[bon]' AND `tbl_kite`.`pelanggan` like '%$byr%' $noWhere
GROUP BY no_po");
while($rp=mysql_fetch_array($sqlnopo)){?>
   <option value="<?php echo urlencode($rp['no_po']);?>" <?php if($rp['no_po']==$_GET['nopo']){echo"selected";}?> ><?php echo $rp['no_po'];?></option>
      <?php  } ?>      
    </select>
      * </td>
  </tr>
  <tr>
    <th align="left" valign="top" scope="row">Item</th>
    <th align="right" valign="top" scope="row">:</th>
    <td colspan="4"><select name="itm" id="itm" tabindex="3"  onchange="window.location='index1.php?p=packing_data&amp;bon=<?php echo $_GET['bon'];?>&amp;byer=<?php echo $byr;?>&amp;nopo=<?php echo urlencode($_GET['nopo']);?>&amp;itm='+this.value">
      <option value="">PILIH</option>
      <?php
		$sqlitm=mysql_query("SELECT trim(no_item) as itm
FROM `tbl_kite`
WHERE `tbl_kite`.`no_order` = '$_GET[bon]' AND `tbl_kite`.`pelanggan` like '%$byr%' AND `tbl_kite`.`no_po` like '%$_GET[nopo]%' $noWhere 
GROUP BY no_item");
while($rp=mysql_fetch_array($sqlitm)){?>
       <option value="<?php echo $rp['itm'];?>" <?php if($rp['itm']==$_GET['itm']){echo"selected";}?>><?php echo $rp['itm'];?></option>
      <?php  } ?>
      
    </select>
      *</td>
  </tr>
  <tr>
    <th align="left" valign="top" scope="row">Warna</th>
    <th align="right" valign="top" scope="row">:</th>
    <td colspan="4"><select name="warna" id="warna" tabindex="3"  onchange="window.location='index1.php?p=packing_data&amp;bon=<?php echo $_GET['bon'];?>&amp;byer=<?php echo $_GET['byer'];?>&amp;nopo=<?php echo urlencode($_GET['nopo']);?>&amp;itm=<?php echo $_GET['itm'];?>&amp;wrn='+this.value">
      <option value="">PILIH</option>
      <?php 
		$sqlwrn=mysql_query("SELECT trim(warna) as wrn
FROM `tbl_kite`
WHERE `tbl_kite`.`no_order` = '$_GET[bon]' AND `tbl_kite`.`pelanggan` like '%$byr%' 
AND `tbl_kite`.`no_po` like '%$_GET[nopo]%' AND `tbl_kite`.`no_item` like '%$_GET[itm]%' $noWhere
GROUP BY warna");
while($rp=mysql_fetch_array($sqlwrn)){?>
     <option value="<?php echo $rp['wrn'];?>" <?php if($rp['wrn']==$_GET['wrn']){echo"selected";}?>><?php echo $rp['wrn'];?></option>
      <?php  } ?>
        </select>
      *</td>
  </tr>
  <tr>
    <th align="left" valign="top" scope="row">Lot</th>
    <th align="right" valign="top" scope="row">:</th>
    <td colspan="4"><select name="lot" id="lot" tabindex="3"  onchange="window.location='index1.php?p=packing_data&amp;bon=<?php echo $_GET['bon'];?>&amp;byer=<?php echo $_GET['byer'];?>&amp;nopo=<?php echo urlencode($_GET['nopo']);?>&amp;itm=<?php echo $_GET['itm'];?>&amp;wrn=<?php echo $_GET['wrn'];?>&amp;lot='+this.value">
      <option value="">PILIH</option>
      <?php
		$sqllot=mysql_query(" SELECT trim(no_lot) as lot,nokk
FROM `tbl_kite`
WHERE `tbl_kite`.`no_order` = '$_GET[bon]' AND `tbl_kite`.`pelanggan` = '$byr' 
AND `tbl_kite`.`no_po` = '$_GET[nopo]' AND `tbl_kite`.`no_item` = '$_GET[itm]' AND `tbl_kite`.`warna` = '$_GET[wrn]' $noWhere 
ORDER BY no_lot ASC");
while($rp=mysql_fetch_array($sqllot)){?>
     <option value="<?php echo $rp['nokk'];?>" <?php if($rp['nokk']==$_GET['lot']){echo"selected";}?>><?php echo $rp['lot'];?></option>
      <?php  } ?>
      </select>
      *</td>
  </tr>
  <?php 
	$sqlpack=mysql_query("SELECT trim(no_mc) as no_mc,nokk
FROM `tbl_kite`
WHERE `tbl_kite`.`no_order` = '$_GET[bon]' AND `tbl_kite`.`pelanggan` = '$byr' 
AND `tbl_kite`.`no_po` like '%$_GET[nopo]%' AND `tbl_kite`.`no_item` = '$_GET[itm]' AND `tbl_kite`.`warna` = '$_GET[wrn]' AND `tbl_kite`.`nokk` = '$_GET[lot]'
GROUP BY no_mc");
$pk=mysql_fetch_array($sqlpack);
$sqltmpt=mysql_query("SELECT tempat from mutasi_kain where nokk='$pk[nokk]'");
$tmpt=mysql_fetch_array($sqltmpt);
?>
  <tr>
    <th align="left" valign="top" scope="row">Packing</th>
    <th align="right" valign="top" scope="row">:</th>
    <td colspan="4"><select name="packing" id="packing" onchange="window.location='index1.php?p=packing_data&amp;bon=<?php echo $_GET['bon'];?>&amp;byer=<?php echo $_GET['byer'];?>&amp;nopo=<?php echo urlencode($_GET['nopo']);?>&amp;itm=<?php echo $_GET['itm'];?>&amp;wrn=<?php echo $_GET['wrn'];?>&amp;lot=<?php echo $_GET['lot'];?>&amp;pk='+this.value">
      <option value="">PILIH</option>
      <option value="Rolls" <?php if($_GET[pk]=="Rolls"){echo "SELECTED";} ?> >Rolls</option>
        <option value="Bales" <?php if($_GET[pk]=="Bales"){echo "SELECTED";} ?> >Bales</option>
    </select></td>
  </tr>
  <tr>
    <th align="left" valign="top" scope="row">Gudang</th>
    <th align="right" valign="top" scope="row">:</th>
    <td colspan="4"><input type="text" name="gudang" id="gudang"  tabindex="2" value="<?php echo $tmpt['tempat'];?>"/></td>
  </tr>
  <tr>
    <th align="left" valign="top" scope="row">&nbsp;</th>
    <th align="left" valign="top" scope="row">&nbsp;</th>
    <td colspan="4">* harus di isi atau di pilih</td>
  </tr>
  <tr>
    <th align="left" valign="top" scope="row">Template</th>
    <th align="left" valign="top" scope="row">&nbsp;</th>
    <td colspan="4"><label for="template"></label>
      <select name="template" id="template">
        <option value="1" <?php if($ganti=="1"){echo "SELECTED";}?>>1</option>
        <option value="2" <?php if($ganti=="2"){echo "SELECTED";}?>>2</option>
        <option value="3">3</option>
      </select>
      <input type="submit" name="ganti" id="ganti" value="ganti" /></td>
  </tr>
  </table>
<div align="center"> DETAIL DATA</div>
<?php if($_POST[template]=="" or $_POST[template]=="1"){?>
<?php
$snkk1=mysql_query("SELECT
	count(b.weight) as roll,
	sum(b.weight) as berat,sum(b.yard_) as yard
FROM
	pergerakan_stok a 
LEFT JOIN detail_pergerakan_stok b ON a.id = b.id_stok
LEFT JOIN tbl_kite c ON b.nokk = c.nokk
WHERE
	b.sisa !='FKTH' AND b.sisa !='TH' AND b.sisa !='FOC' AND a.typestatus='2'
AND c.nokk='".$pk['nokk']."'");
$rowkk1=mysql_fetch_array($snkk1);
?>
  *<b> Total Roll <?php echo $rowkk1['roll']; ?> ,Total Berat <?php echo number_format($rowkk1['berat'],'2'); ?> Kg, Total Yard <?php echo number_format($rowkk1['yard'],'2'); ?></b>
<table width="75%" border="1">
    <tr>
      <th width="69" bgcolor="#9966CC" scope="col">LOT</th>
      <th width="69" bgcolor="#9966CC" scope="col">PACK NO</th>
      <th width="75" bgcolor="#9966CC" scope="col">BALES NO</th>
      <th width="75" bgcolor="#9966CC" scope="col">KGS</th>
      <th width="77" bgcolor="#9966CC" scope="col">YDS</th>
      <th width="77" bgcolor="#9966CC" scope="col">PCS</th>
      <th width="77" bgcolor="#9966CC" scope="col">UKURAN (FLATKNIT)</th>
      <th width="77" bgcolor="#9966CC" scope="col">GW</th>
      <th width="77" bgcolor="#9966CC" scope="col">KET(EXTRA QTY)</th>
    </tr>
   <?php
      $datacek=mysql_query("SELECT
	*, b.id AS kd
FROM
	pergerakan_stok a
INNER JOIN detail_pergerakan_stok b ON a.id = b.id_stok
INNER JOIN tmp_detail_kite d ON d.id = b.id_detail_kj
INNER JOIN tbl_kite c ON d.id_kite = c.id
WHERE
	(
		b.sisa != 'FKTH'
		AND b.sisa != 'TH'
		AND a.typestatus = '2'
		AND b.nokk = '$pk[nokk]'
		AND not d.nokkKite=''
	)
GROUP BY
	b.`id`
ORDER BY
	c.`nokk`,
	d.`no_roll` ASC");
	$no=1;
	$n=1;
	$c=0;
	 while($rowd=mysql_fetch_array($datacek)){ 
		
		    $bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99';
			if($_GET[pk]=="Rolls"){$gw=0.6;}else{$gw=0.2;}
		 ?> 
    
    <tr bgcolor="<?php echo $bgcolor;?>">
      <td align="center" ><?PHP echo $rowd['no_lot']; ?></td>
      <td align="center" ><?PHP if($_GET[pk]=="Rolls"){echo $rowd['no_roll'];}else{echo"-";} ?></td>
      <td align="center" ><?PHP if($_GET[pk]=="Bales"){echo $rowd['no_roll'];}else{echo"-";} ?></td>
      <td align="center" ><?PHP echo number_format($rowd['weight'],'2','.',','); ?></td>
      <td align="center" ><?PHP echo number_format($rowd['yard_'],'2','.',','); ?></td>
      <td align="center" ><?PHP if($rowd['netto']==""){echo"-";}else{echo $rowd['netto'];} ?></td>
      <td align="center" ><?PHP if($rowd['ukuran']==""){echo"-";}else{echo $rowd['ukuran']."CM";} ?></td>
      <td align="center" ><?PHP if($rowd['weight']==""){echo"-";}else{echo number_format($rowd['weight']+$gw,'2','.',',');} ?></td>
      <td align="center" ><?PHP 
	  if($rowd['sisa']=="FOC"){
	  echo $rowd['sisa'];}else{echo"-";} ?></td>
    </tr>
    
  <?php 
		 $totkgs=$totkgs+$rowd['weight'];
		 $totyds=$totyds+$rowd['yard_'];
	$no++;  }?>
     <tr bgcolor="#3399FF">
      <td align="center" ><strong>Total</strong></td>
      <td align="center" ><b><?php echo $no-1; ?> Roll</b></td>
      <td align="right" >&nbsp;</td>
      <td align="right" ><b><?php echo number_format($totkgs,'2'); ?> Kgs</b></td>
      <td align="right" ><b><?php echo number_format($totyds,'2'); ?> Yds</b></td>
      <td align="center" >&nbsp;</td>
      <td align="center" >&nbsp;</td>
      <td align="center" >&nbsp;</td>
      <td align="center" >&nbsp;</td>
    </tr>  
    
  </table>
  <?php }else if($_POST[template]=="2"){ ?>
  <?php
$snkk1=mysql_query("SELECT
	count(b.weight) as roll,
	sum(b.weight) as berat,sum(b.yard_) as yard
FROM
	pergerakan_stok a 
LEFT JOIN detail_pergerakan_stok b ON a.id = b.id_stok
LEFT JOIN tbl_kite c ON b.nokk = c.nokk
WHERE
	b.sisa !='FKTH' AND b.sisa !='TH' AND b.sisa !='FOC' AND a.typestatus='2'
AND c.nokk='".$pk['nokk']."'");
$rowkk1=mysql_fetch_array($snkk1);
?>
  *<b> Total Roll <?php echo $rowkk1['roll']; ?> ,Total Berat <?php echo number_format($rowkk1['berat'],'2'); ?> Kg, Total Yard <?php echo number_format($rowkk1['yard'],'2'); ?></b>
<table width="75%" border="1">
    <tr>
      <th width="69" bgcolor="#9966CC" scope="col">LOT NO.</th>
      <th width="69" bgcolor="#9966CC" scope="col">C/No</th>
      <th width="75" bgcolor="#9966CC" scope="col">Qty</th>
      <th width="77" bgcolor="#9966CC" scope="col">FOC</th>
      <th width="77" bgcolor="#9966CC" scope="col">Yard</th>
      <th width="77" bgcolor="#9966CC" scope="col">WeiKg</th>
      <th width="77" bgcolor="#9966CC" scope="col">Meter</th>
    </tr>
   <?php
      $datacek=mysql_query("SELECT
	*, b.id AS kd
FROM
	pergerakan_stok a
INNER JOIN detail_pergerakan_stok b ON a.id = b.id_stok
INNER JOIN tmp_detail_kite d ON d.id = b.id_detail_kj
INNER JOIN tbl_kite c ON d.id_kite = c.id
WHERE
	(
		b.sisa != 'FKTH'
		AND b.sisa != 'TH'
		AND a.typestatus = '2'
		AND b.nokk = '$pk[nokk]'
		AND not d.nokkKite=''
	)
GROUP BY
	b.`id`
ORDER BY
	c.`nokk`,
	d.`no_roll` ASC");
	$no=1;
	$n=1;
	$c=0;
	 while($rowd=mysql_fetch_array($datacek)){ 
		
		    $bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99';
			if($_GET[pk]=="Rolls"){$gw=0.6;}else{$gw=0.2;}
		 ?> 
    
    <tr bgcolor="<?php echo $bgcolor;?>">
      <td align="center" ><?PHP echo $rowd['no_lot']; ?></td>
      <td align="center" ><?PHP if($_GET[pk]=="Rolls"){echo $rowd['no_roll'];}else{echo"-";} ?></td>
      <td align="center" ><?PHP echo number_format($rowd['weight'],'2','.',','); ?></td>
      <td align="center" ><?PHP 
	  if($rowd['sisa']=="FOC"){
	  echo $rowd['sisa'];}else{echo"-";} ?></td>
      <td align="center" ><?PHP echo number_format($rowd['yard_'],'2','.',','); ?></td>
      <td align="center" ><?PHP if($rowd['weight']==""){echo"-";}else{echo number_format($rowd['weight']+$gw,'2','.',',');} ?></td>
      <td align="center" ><?PHP echo number_format($rowd['yard_']*0.9144,'2','.',','); ?></td>
    </tr>
    
  <?php 
		 $totkgs=$totkgs+$rowd['weight'];
		 $totyds=$totyds+$rowd['yard_'];
	$no++;  }?>
     <tr bgcolor="#3399FF">
      <td align="center" ><strong>Total</strong></td>
      <td align="center" ><b><?php echo $no-1; ?> Roll</b></td>
      <td align="right" ><b><?php echo number_format($totkgs,'2'); ?> Kgs</b></td>
      <td align="center" >&nbsp;</td>
      <td align="right" ><b><?php echo number_format($totyds,'2'); ?> Yds</b></td>
      <td align="center" >&nbsp;</td>
      <td align="center" >&nbsp;</td>
    </tr>  
    
  </table>
  <?php }else if($_POST[template]=="3"){?>
<?php
$snkk1=mysql_query("SELECT
	count(b.weight) as roll,
	sum(b.weight) as berat,sum(b.yard_) as yard
FROM
	pergerakan_stok a 
LEFT JOIN detail_pergerakan_stok b ON a.id = b.id_stok
LEFT JOIN tbl_kite c ON b.nokk = c.nokk
WHERE
	b.sisa !='FKTH' AND b.sisa !='TH' AND b.sisa !='FOC' AND a.typestatus='2'
AND c.nokk='".$pk['nokk']."'");
$rowkk1=mysql_fetch_array($snkk1);
?>
  *<b> Total Roll <?php echo $rowkk1['roll']; ?> ,Total Berat <?php echo number_format($rowkk1['berat'],'2'); ?> Kg, Total Yard <?php echo number_format($rowkk1['yard'],'2'); ?></b>
<table width="75%" border="1">
    <tr>
      <th width="69" bgcolor="#9966CC" scope="col">LOT</th>
      <th width="69" bgcolor="#9966CC" scope="col">PACK NO</th>
      <th width="75" bgcolor="#9966CC" scope="col">BALES NO</th>
      <th width="75" bgcolor="#9966CC" scope="col">KGS</th>
      <th width="77" bgcolor="#9966CC" scope="col">YDS</th>
      <th width="77" bgcolor="#9966CC" scope="col">METER</th>
      <th width="77" bgcolor="#9966CC" scope="col">UKURAN (FLATKNIT)</th>
      <th width="77" bgcolor="#9966CC" scope="col">GW</th>
      <th width="77" bgcolor="#9966CC" scope="col">KET(EXTRA QTY)</th>
    </tr>
   <?php
      $datacek=mysql_query("SELECT
	*, b.id AS kd
FROM
	pergerakan_stok a
INNER JOIN detail_pergerakan_stok b ON a.id = b.id_stok
INNER JOIN tmp_detail_kite d ON d.id = b.id_detail_kj
INNER JOIN tbl_kite c ON d.id_kite = c.id
WHERE
	(
		b.sisa != 'FKTH'
		AND b.sisa != 'TH'
		AND a.typestatus = '2'
		AND b.nokk = '$pk[nokk]'
		AND not d.nokkKite=''
	)
GROUP BY
	b.`id`
ORDER BY
	c.`nokk`,
	d.`no_roll` ASC");
	$no=1;
	$n=1;
	$c=0;
	 while($rowd=mysql_fetch_array($datacek)){ 
		
		    $bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99';
			if($_GET[pk]=="Rolls"){$gw=0.6;}else{$gw=0.2;}
		 ?> 
    
    <tr bgcolor="<?php echo $bgcolor;?>">
      <td align="center" ><?PHP echo $rowd['no_lot']; ?></td>
      <td align="center" ><?PHP if($_GET[pk]=="Rolls"){echo $rowd['no_roll'];}else{echo"-";} ?></td>
      <td align="center" ><?PHP if($_GET[pk]=="Bales"){echo $rowd['no_roll'];}else{echo"-";} ?></td>
      <td align="center" ><?PHP echo number_format($rowd['weight'],'2','.',','); ?></td>
      <td align="center" ><?PHP echo number_format($rowd['yard_'],'2','.',','); ?></td>
      <td align="center" ><?PHP echo number_format($rowd['yard_']*0.9144,'2','.',','); ?></td>
      <td align="center" ><?PHP if($rowd['ukuran']==""){echo"-";}else{echo $rowd['ukuran']."CM";} ?></td>
      <td align="center" ><?PHP if($rowd['weight']==""){echo"-";}else{echo number_format($rowd['weight']+$gw,'2','.',',');} ?></td>
      <td align="center" ><?PHP 
	  if($rowd['sisa']=="FOC"){
	  echo $rowd['sisa'];}else{echo"-";} ?></td>
    </tr>
    
  <?php 
		 $totkgs=$totkgs+$rowd['weight'];
		 $totyds=$totyds+$rowd['yard_'];
	$no++;  }?>
     <tr bgcolor="#3399FF">
      <td align="center" ><strong>Total</strong></td>
      <td align="center" ><b><?php echo $no-1; ?> Roll</b></td>
      <td align="right" >&nbsp;</td>
      <td align="right" ><b><?php echo number_format($totkgs,'2'); ?> Kgs</b></td>
      <td align="right" ><b><?php echo number_format($totyds,'2'); ?> Yds</b></td>
      <td align="center" >&nbsp;</td>
      <td align="center" >&nbsp;</td>
      <td align="center" >&nbsp;</td>
      <td align="center" >&nbsp;</td>
    </tr>  
    
  </table>
	<?php } ?>
</form>
</body>
</html>