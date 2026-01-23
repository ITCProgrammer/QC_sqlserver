<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=tanda-terima-acc-".$_GET['nosj1']." s/d ".$_GET['nosj2'].".xls");
ini_set("error_reporting",1);
include '../koneksi.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Tanda Terima Accounting</title>
</head>

<body>
<div align="center">TANDA TERIMA ACCOUNTING</div>
<table width="100%" border="1">
    <tr bgcolor="#3399CC"> 
        <td width="3%" align="center" bgcolor="#FFFFFF">NO</td>
        <td width="9%" align="center" bgcolor="#FFFFFF">NO SJ</td>
        <td width="9%" align="center" bgcolor="#FFFFFF">CUSTOMER</td>
        <td width="6%" align="center" bgcolor="#FFFFFF">TGL APPROVE</td>
        <td width="8%" align="center" bgcolor="#FFFFFF">IP ADDRESS</td>
    </tr>
    <?php 
    $nosj1=$_GET['nosj1'];
    $nosj2=$_GET['nosj2'];
    $c=0;
    for ($no=$nosj1; $no<=$nosj2 ; $no++){
    $Urut=sprintf("%05s",$no);
    $sql=sqlsrv_query($con,"SELECT buyer, no_sj, approve_acc, ipaddress_acc, tgl_approve_acc FROM tbl_pengiriman WHERE no_sj='$Urut' AND ISNULL(kategori) AND YEAR(tgl_buat) = YEAR(CURRENT_DATE) GROUP BY no_sj");
    $row=sqlsrv_fetch_array($sql);
    $pos=strpos($row['buyer'], "/");
	$posbuyer=substr($row['buyer'],0,$pos);
    $cust=str_replace("'","''",$posbuyer);
    
    $bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99';
    ?>
    <tr >
        <td>'<?php echo $Urut; ?></td>
        <td>'<?php echo $row['no_sj']; ?></td>
        <td><?php echo $cust; ?></td>
        <td><?php echo $row['tgl_approve_acc']; ?></td>
        <td><?php echo $row['ipaddress_acc']; ?></td>
    </tr>
  <?php } ?>
</table>
</body>
</html>