<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Laporan Pengiriman</title>
<link rel="stylesheet" type="text/css" href="css/datatable.css" />
<link rel="stylesheet" type="text/css" href="css/jquery-ui.css" />
<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/jquery.dataTables.js" type="text/javascript"></script>
<script>
	$(document).ready(function(){
		$('#datatables').dataTable({
			"sScrollY": "400px",
			"sScrollX": "100%",
			"bScrollCollapse": true,
			"bPaginate": false,
			"bJQueryUI": true
		});			
	})
</script>
<style>
th,td{
	border-top: 1px solid;
	border-bottom: 1px solid;
	border-left: 1px solid;
	border-right: 1px solid;
	}
</style>

</head>

<body>
<div align="center">TANDA TERIMA SURAT JALAN<br /> </div>
<h3><a href="pages/lihat_data_tanda_terima_excel.php?nosj1=<?php echo $_POST['no_sj1'];?>&nosj2=<?php echo $_POST['no_sj2'];?>">CETAK EXCEL</a></h3>
<table width="100%" border="0" class="display" id="datatables">
 <thead>
  <tr bgcolor="#3399CC">
    <th align="center">NO</th>
    <th align="center">NO SJ</th>
    <th align="center">CUSTOMER</th>
    <th align="center">TGL APPROVE</th>
    <th align="center">IP ADDRESS</th>
  </tr>
  </thead>
  <tbody>
  <?php 
    $nosj1=$_POST['no_sj1'];
    $nosj2=$_POST['no_sj2'];
    $c=0;
    //$NoUrut=(int)substr($nosj1,0,5);
    //$NoUrut++;
    //$Urut=sprintf("%05s",$NoUrut);
    for ($no=$nosj1; $no<=$nosj2 ; $no++){
    $Urut=sprintf("%05s",$no);
    $sql=sqlsrv_query($con,"SELECT buyer, no_sj, approve_acc, ipaddress_acc, tgl_approve_acc FROM tbl_pengiriman WHERE no_sj='$Urut' AND ISNULL(kategori) AND YEAR(tgl_buat) = YEAR(CURRENT_DATE) GROUP BY no_sj");
    $row=sqlsrv_fetch_array($sql);
    $pos=strpos($row['buyer'], "/");
	$posbuyer=substr($row['buyer'],0,$pos);
	$cust=str_replace("'","''",$posbuyer);

    $bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99';
  ?>
    <tr bgcolor="<?php echo $bgcolor;?>" >
        <td><?php echo $Urut; ?></td>
        <td><?php echo $row['no_sj']; ?></td>
        <td><?php echo $cust; ?></td>
        <td><?php echo $row['tgl_approve_acc']; ?></td>
        <td><?php echo $row['ipaddress_acc']; ?></td>
    </tr>
  <?php } ?>
  </tbody>
</table>

</body>
</html>