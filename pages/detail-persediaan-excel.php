<?php
ini_set("error_reporting",1);
include("../koneksi.php");
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=data-".$_GET['nokk'].".xls");
header("Pragma: no-cache");
header("Expires: 0");

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
<title>Detail Kain Jadi</title>
</head>

<body>
<table width="100%" border="0">
  <tr align="center">
    <td width="5%">no</td>
    <td width="13%">noroll</td>
    <td width="18%">berat (KG)</td>
    <td width="18%">nopo</td>
    <td width="18%">item</td>
    <td width="18%">warna</td>
    <td width="18%">nowarna</td>
    <td width="18%">jeniskain</td>
    <td width="18%">lot</td>
    <td width="12%">panjang</td>
    <td width="11%">satuan</td>
    <td width="9%">grade</td>
    <td width="17%">sn</td>
    <td width="6%">ket</td>
    <td width="6%">Lokasi</td>
  </tr>
  <?php
  $sqlnk=sqlsrv_query($con,"SELECT * FROM tbl_kite WHERE nokk='".$_GET['nokk']."' ORDER BY id DESC LIMIT 1");
  $r=sqlsrv_fetch_array($sqlnk);	
  $sql=sqlsrv_query($con,"SELECT
	no_roll,
	weight,
	yard_,
	satuan,
	grade,
	sisa,
	SN,
	lokasi,
	transtatus
FROM
	detail_pergerakan_stok
WHERE
	nokk = '".$_GET['nokk']."'
AND (
	(status = '0' or status = '1') and transtatus='1'
) AND sisa='".$_GET['ket']."'
 Order by no_roll ASC");
  $c=1;
  $no=1;
  while($row=sqlsrv_fetch_array($sql))
  {
	     
  ?>
  <tr>
    <td><?php echo $no;?></td>
    <td align="center">'<?php echo $row['no_roll'];?></td>
    <td align="right"><?php echo number_format($row['weight'],'2','.',',');?></td>
    <td align="right"><?php echo $r['no_po'];?></td>
    <td align="right"><?php echo $r['no_item'];?></td>
    <td align="right"><?php echo $r['warna'];?></td>
    <td align="right"><?php echo $r['no_warna'];?></td>
    <td align="right"><?php echo $r['jenis_kain'];?></td>
    <td align="right">'<?php echo $r['no_lot'];?></td>
    <td align="right"><?php echo number_format($row['yard_'],'2','.',',');?></td>
    <td align="center"><?php echo $row['satuan'];?></td>
    <td align="center"><?php echo $row['grade'];?></td>
    <td align="right">'<?php echo $row['SN'];?></td>
    <td align="center"><?php if($row['sisa']=="SISA" || $row['sisa']=="FKSI"){$sisa= "SISA";}else{$sisa=$row['sisa'];}echo $sisa;?></td>
    <td align="center"><?php echo $row['lokasi'];?></td>
    <?php  if($row['transtatus']=='0'){$kt="Sudah Keluar"; $rn="RED";}else{$kt="Ada"; $rn="";}?>
  </tr>  
  <?php $no++;} ?>
</table>
</body>
</html>