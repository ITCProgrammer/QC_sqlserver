<?php
 ini_set("error_reporting",1);
include("../koneksi.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style>
.rol{
    width: 100%;
    height: 300px;
    overflow: scroll;
} 
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Detail Masuk Kain Jadi</title>
</head>

<body>
No Kartu Kerja : <strong><em><?php echo $_GET["nokk"];?></em></strong>
<strong>
<?php $sql1=mysqli_query($con,"SELECT
	COUNT(weight) as totrol,
	SUM(weight) as totba,
	SUM(yard_) as totya
FROM
	detail_pergerakan_stok
WHERE
	nokk = '$_GET[nokk]' and id_stok='$_GET[id]'
AND (
	status = '0'
) AND sisa='$_GET[ket]'
 Order by no_roll ASC");
 $row1=mysqli_fetch_array($sql1);
 ?>
<br />
Total Roll : <?php echo $row1["totrol"];?> || Berat : <?php echo number_format($row1["totba"],'2','.',',');?> ||  Panjang:<?php echo number_format($row1["totya"],'2','.',',');?>
</strong>
<div class="rol">
<table width="41%" border="0">
  <tr align="center" bgcolor="#3366FF">
    <td width="5%">No</td>
    <td width="13%">No Roll</td>
    <td width="18%">Berat (KG)</td>
    <td width="12%">Panjang</td>
    <td width="11%">Satuan</td>
    <td width="9%">Grade</td>
    <td width="17%">SN</td>
    <td width="6%">Ket</td>
    <td width="9%">Status</td>
  </tr>
  <?php
  $sql=mysqli_query($con,"SELECT
	no_roll,
	weight,
	yard_,
	satuan,
	grade,
	sisa,
	SN,
	transtatus
FROM
	detail_pergerakan_stok
WHERE
	nokk = '$_GET[nokk]' and id_stok='$_GET[id]'
AND (
	status = '0'
) AND sisa='$_GET[ket]'
 Order by no_roll ASC");
  $c=1;
  $no=1;
  while($row=mysqli_fetch_array($sql))
  {
	   $bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99';
	  
  ?>
  <tr bgcolor="<?php echo $bgcolor;?>">
    <td><?php echo $no;?></td>
    <td align="center"><?php echo $row['no_roll'];?></td>
    <td align="right"><?php echo number_format($row['weight'],'2','.',',');?></td>
    <td align="right"><?php echo number_format($row['yard_'],'2','.',',');?></td>
    <td align="center"><?php echo $row['satuan'];?></td>
    <td align="center"><?php echo $row['grade'];?></td>
    <td align="right"><?php echo $row['SN'];?></td>
    <td align="center"><?php if($row['sisa']=="SISA" || $row['sisa']=="FKSI"){$sisa= "SISA";}else{$sisa=$row['sisa'];}echo $sisa;?></td>
    <?php  if($row['transtatus']=='0'){$kt="Sudah Keluar"; $rn="RED";}else{$kt="Ada"; $rn="";}?>
    <td bgcolor="<?php echo $rn;?>"> <?php echo $kt;?></td>
  </tr>  
  <?php $no++;} ?>
</table>
</div>
<strong>
<?php $sql2=mysqli_query($con,"SELECT
	COUNT(weight) as totrol,
	SUM(weight) as totba,
	SUM(yard_) as totya
FROM
	detail_pergerakan_stok
WHERE
	nokk = '$_GET[nokk]' AND (
	 status = '1'
) AND sisa='$_GET[ket]'
 Order by no_roll ASC");
 $row2=mysqli_fetch_array($sql2);
 ?>
 <font color="RED">
SISA Roll : <?php echo $row2["totrol"];?> || Berat : <?php echo number_format($row2["totba"],'2','.',',');?> || Panjang:<?php echo number_format($row2["totya"],'2','.',',');?></font>
</strong>
</body>
</html>