<?php
include_once("../koneksi.php");
ini_set("error_reporting",1);
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
#total {
    color: red;
}
td {
    font-size: 12px;
    padding: 3px;
}
input[type="text"] {
    text-align: right;
}	
</style>
<script type="text/javascript" src="checklist.js"></script>	
<script language="JavaScript">
$(document).ready(function () {

    function sumRows() {
        var sum = 0, sum1 = 0,
            total = $('#total'),total2 = $('#total2');
        $('tr').each(function () {
            var amount = $(this).find('input[name="amount"]'),
				amount2 = $(this).find('input[name="amount2"]'),
                checkbox = $(this).find('input[name="include"]');
            if (checkbox.is(':checked') && amount.val().length > 0) {
                sum += parseFloat(amount.val(), 10);
				sum1 += parseFloat(amount2.val(), 10);
            }
        });
        total.text(roundToTwo(sum).toFixed(2));
		total2.text(roundToTwo(sum1).toFixed(2));
    }

    // calculate sum anytime checkbox is checked or amount is changed
    $('input[name="amount"], input[name="include"]').on('change keyup blur', sumRows);

});	
function roundToTwo(num) {    
    return +(Math.round(num + "e+2")  + "e-2");
}
</script>	
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Detail Masuk Kain Jadi</title>
</head>

<body>
No Kartu Kerja : <strong><em><?php echo $_GET["nokk"];?></em></strong>
<strong>
<?php $sql1=sqlsrv_query($con,"SELECT
	COUNT(weight) as totrol,
	SUM(weight) as totba,
	SUM(yard_) as totya
FROM
	detail_pergerakan_stok
WHERE
	nokk = '".$_GET['nokk']."'
AND (
	status = '0'
) AND sisa='".$_GET['ket']."'
 Order by no_roll ASC");
 $row1=sqlsrv_fetch_array($sql1);
 ?>
<br />
Total Roll : <?php echo $row1["totrol"];?> || Berat : <?php echo number_format($row1["totba"],'2','.',',');?> ||  Panjang:<?php echo number_format($row1["totya"],'2','.',',');?>
</strong> <a href="detail-persediaan-excel.php?nokk=<?php echo $_GET['nokk'];?>&ket=<?php echo $_GET['ket'];?>">cetak ke excel</a> 
<div>Berat  : <span id="total" style="color:red">0</span></div>
<div>Panjang: <span id="total2" style="color:red">0</span></div>	
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
    <td width="9%">Pilih</td>
  </tr>
  <?php
  $sql=sqlsrv_query($con,"SELECT
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
	nokk = '".$_GET['nokk']."'
AND (
	(status = '0' or status = '1') and transtatus='1'
) AND sisa='".$_GET['ket']."'
 Order by no_roll ASC");
  $c=1;
  $no=1;
  while($row=sqlsrv_fetch_array($sql))
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
    <td bgcolor="<?php echo $rn;?>"><?php echo $kt;?></td>
    <?php  if($row['transtatus']=='0'){$kt="Sudah Keluar"; $rn="RED";}else{$kt="Ada"; $rn="";}?>
    <td bgcolor="<?php echo $rn;?>"><input type="hidden" value="<?php echo number_format($row['weight'],'2','.',',');?>" size="6" name="amount"><input type="hidden" value="<?php echo number_format($row['yard_'],'2','.',',');?>" size="6" name="amount2"><input type="checkbox" name="include"><?php 
     //echo '<input type="checkbox" name="check['.$n.']" value="'.$rowd['kd'].'"';
	 // echo '<input type="checkbox" name="include">';
  $n++;
   ?> </td>
  </tr>  
  <?php $no++;} ?>
</table>
</div>
<strong>
<?php $sql2=sqlsrv_query($con,"SELECT
	COUNT(weight) as totrol,
	SUM(weight) as totba,
	SUM(yard_) as totya
FROM
	detail_pergerakan_stok
WHERE
	nokk = '".$_GET['nokk']."'
AND (
	 status = '1' and transtatus='1'
) AND sisa='".$_GET['ket']."'
 Order by no_roll ASC");
 $row2=sqlsrv_fetch_array($sql2);
 ?>
 <font color="RED">
SISA Roll : <?php echo $row2["totrol"];?> || Berat : <?php echo number_format($row2["totba"],'2','.',',');?> || Panjang:<?php echo number_format($row2["totya"],'2','.',',');?></font>
</strong>


</body>
</html>