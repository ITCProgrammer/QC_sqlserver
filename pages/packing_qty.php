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

?>
<table width="100%" border="0">
  <tr>
    <th height="22" colspan="6" scope="row">&nbsp;</th>
  </tr>
  <tr>
    <th colspan="6" scope="row">Data Packing Pas QTY</th>
  </tr>
 
  
  <tr>
    <th width="8%" align="left" valign="top" scope="row">Nokk</th>
    <th width="1%" align="right" valign="top" scope="row">:</th>
    <td width="91%" colspan="4"><input name="bon" type="text" id="bon" onchange="window.location='index1.php?p=packing_qty&amp;nokk='+this.value"  value="<?php echo $_GET['nokk'];?>" size="20" tabindex="1"/></td>
  </tr>
  <tr>
    <th colspan="2" align="left" valign="top" scope="row">Template</th>
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
$snkk1=mysql_query("SELECT count(*) as roll,sum(net_wight) as berat,sum(yard_) as yard FROM tbl_tembakqty a 
INNER JOIN detail_tembakqty b ON a.id=b.id_kite WHERE nokkkite='$_GET[nokk]'");
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
      $datacek=mysql_query("SELECT * FROM tbl_tembakqty a 
INNER JOIN detail_tembakqty b ON a.id=b.id_kite WHERE  nokkkite='$_GET[nokk]' ORDER BY no_roll ASC");
	$no=1;
	$n=1;
	$c=0;
	 while($rowd=mysql_fetch_array($datacek)){ 
		
		    $bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99';
			if($rowd[jns_pack]=="Rolls"){$gw=0.6;}else{$gw=0.2;}
		 ?> 
    
    <tr bgcolor="<?php echo $bgcolor;?>">
      <td align="center" ><?PHP echo $rowd['no_lot']; ?></td>
      <td align="center" ><?PHP if($rowd[jns_pack]=="Rolls"){echo $rowd['no_roll'];}else{echo"-";} ?></td>
      <td align="center" ><?PHP if($rowd[jns_pack]=="Bales"){echo $rowd['no_roll'];}else{echo"-";} ?></td>
      <td align="center" ><?PHP echo number_format($rowd['net_wight'],'2','.',','); ?></td>
      <td align="center" ><?PHP echo number_format($rowd['yard_'],'2','.',','); ?></td>
      <td align="center" ><?PHP if($rowd['netto']==""){echo"-";}else{echo $rowd['netto'];} ?></td>
      <td align="center" ><?PHP if($rowd['ukuran']==""){echo"-";}else{echo $rowd['ukuran']."CM";} ?></td>
      <td align="center" ><?PHP if($rowd['net_wight']==""){echo"-";}else{echo number_format($rowd['net_wight']+$gw,'2','.',',');} ?></td>
      <td align="center" ><?PHP 
	  if($rowd['sisa']=="FOC"){
	  echo $rowd['sisa'];}else{echo"-";} ?></td>
    </tr>
    
  <?php 
		 $totkgs=$totkgs+$rowd['net_wight'];
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
$snkk1=mysql_query("SELECT count(*) as roll,sum(net_wight) as berat,sum(yard_) as yard FROM tbl_tembakqty a 
INNER JOIN detail_tembakqty b ON a.id=b.id_kite WHERE nokkkite='$_GET[nokk]'");
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
      $datacek=mysql_query("SELECT * FROM tbl_tembakqty a 
INNER JOIN detail_tembakqty b ON a.id=b.id_kite WHERE  nokkkite='$_GET[nokk]' ORDER BY no_roll ASC");
	$no=1;
	$n=1;
	$c=0;
	 while($rowd=mysql_fetch_array($datacek)){ 
		
		    $bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99';
			if($rowd[jns_pack]=="Rolls"){$gw=0.6;}else{$gw=0.2;}
		 ?> 
    
    <tr bgcolor="<?php echo $bgcolor;?>">
      <td align="center" ><?PHP echo $rowd['no_lot']; ?></td>
      <td align="center" ><?PHP if($rowd[jns_pack]=="Rolls"){echo $rowd['no_roll'];}else{echo"-";} ?></td>
      <td align="center" ><?PHP echo number_format($rowd['net_wight'],'2','.',','); ?></td>
      <td align="center" ><?PHP 
	  if($rowd['sisa']=="FOC"){
	  echo $rowd['sisa'];}else{echo"-";} ?></td>
      <td align="center" ><?PHP echo number_format($rowd['yard_'],'2','.',','); ?></td>
      <td align="center" ><?PHP if($rowd['net_wight']==""){echo"-";}else{echo number_format($rowd['net_wight']+$gw,'2','.',',');} ?></td>
      <td align="center" ><?PHP echo number_format($rowd['yard_']*0.9144,'2','.',','); ?></td>
    </tr>
    
  <?php 
		 $totkgs=$totkgs+$rowd['net_wight'];
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
$snkk1=mysql_query("SELECT count(*) as roll,sum(net_wight) as berat,sum(yard_) as yard FROM tbl_tembakqty a 
INNER JOIN detail_tembakqty b ON a.id=b.id_kite WHERE nokkkite='$_GET[nokk]'");
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
      $datacek=mysql_query("SELECT * FROM tbl_tembakqty a 
INNER JOIN detail_tembakqty b ON a.id=b.id_kite WHERE  nokkkite='$_GET[nokk]' ORDER BY no_roll ASC");
	$no=1;
	$n=1;
	$c=0;
	 while($rowd=mysql_fetch_array($datacek)){ 
		
		    $bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99';
			if($rowd[jns_pack]=="Rolls"){$gw=0.6;}else{$gw=0.2;}
		 ?> 
    
    <tr bgcolor="<?php echo $bgcolor;?>">
      <td align="center" ><?PHP echo $rowd['no_lot']; ?></td>
      <td align="center" ><?PHP if($rowd[jns_pack]=="Rolls"){echo $rowd['no_roll'];}else{echo"-";} ?></td>
      <td align="center" ><?PHP if($rowd[jns_pack]=="Bales"){echo $rowd['no_roll'];}else{echo"-";} ?></td>
      <td align="center" ><?PHP echo number_format($rowd['net_wight'],'2','.',','); ?></td>
      <td align="center" ><?PHP echo number_format($rowd['yard_'],'2','.',','); ?></td>
      <td align="center" ><?PHP echo number_format($rowd['yard_']*0.9144,'2','.',','); ?></td>
      <td align="center" ><?PHP if($rowd['ukuran']==""){echo"-";}else{echo $rowd['ukuran']."CM";} ?></td>
      <td align="center" ><?PHP if($rowd['net_wight']==""){echo"-";}else{echo number_format($rowd['net_wight']+$gw,'2','.',',');} ?></td>
      <td align="center" ><?PHP 
	  if($rowd['sisa']=="FOC"){
	  echo $rowd['sisa'];}else{echo"-";} ?></td>
    </tr>
    
  <?php 
		 $totkgs=$totkgs+$rowd['net_wight'];
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