<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
include "../koneksi.php";
ini_set("error_reporting",1);
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Data Stok Gudang Kain Jadi</title>
<link rel="stylesheet" type="text/css" href="../css/datatable.css" />
<link rel="stylesheet" type="text/css" href="../css/jquery-ui.css" />
<script src="../js/jquery.js" type="text/javascript"></script>
<script src="../js/jquery.dataTables.js" type="text/javascript"></script>
<script>
	$(document).ready(function(){
		$('#datatables').dataTable({
			"sScrollY": "400px",
			"sScrollX": "100%",
			"bScrollCollapse": true,
			"bPaginate": false,
			"bJQueryUI": true,
		});			
	})
</script>
</head>

<body>
<table width="100%" border="0" id="datatables" class="display">
 <thead>
  <tr>
    <th>TGL</th>
    <th>NO ITEM</th>
    <th>LANGGANAN</th>
    <th width="15">PO</th>
    <th width="15">ORDER</th>
    <th>JENIS_KAIN</th>
    <th >NO WARNA</th>
    <th>WARNA</th>
    <th>NO CARD</th>
    <th>LOT</th>
    <th>ROLL</th>
    <th>Grade<br />
      A+B</th>
    <th>Grade <br />
      C</th>
    <th>Keterangan<br />
      (Grade C)</th>
    <th>Yard / Meter</th>
    <th>UNIT</th>
    <th>EXTRA Q</th>
    <th>LBR</th>
    <th>GRMS</th>
    <th>OL</th>
    <th>Keterangan</th>
  </tr>
  </thead>
  <tbody>
  <?php 
  $sql=mysqli_query($con,"SELECT * FROM tbl_stok_kj WHERE tgl_tutup='$_GET[tgl]' ORDER BY id ASC");
  $c=1;
  $i=1;
  $no=1;
  while($row=mysqli_fetch_array($sql))
  {  ?>
  <tr >
    <td><?php echo $row['tgl_in'];?></td>
    <td><?php echo $row['no_item'];?></td>
    <td><?php echo $row['langganan'];?></td>
    <td><?php echo $row['no_po'];?></td>
    <td><?php echo $row['no_order'];?></td>
    <td><?php echo $row['jenis_kain'];?></td>
    <td><?php echo $row['no_warna'];?></td>
    <td><?php echo $row['warna'];?></td>
    <td><?php echo $row['nokk'];?></td>
    <td><?php echo $row['lot'];?></td>
    <td align="right"><?php echo $row['rol'];?></td>
    <td align="right"><?php echo $row['qty_ab'];?></td>
    <td align="right"><?php echo $row['qty_c'];?></td>
    <td><?php echo $row['ket_c'];?></td>
    <td align="right"><?php echo $row['panjang']." ".$row['satuan'];?></td>
    <td><?php echo $row['tempat'];?></td>
    <td><?php echo $row['ket_extra'];?></td>
    <td><?php echo $row['lebar'];?></td>
    <td><?php echo $row['gramasi'];?></td>
    <td>&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
  <?php
		  $no++;
   		  $totrol=$totrol+$row['rol'];
   		  $totab=$totab+$row['qty_ab'];
   		  $tota=$tota+$row['qty_c'];
   		  
   		  
	  }	   
  ?>
  </tbody>
  <tfoot>
  </tfoot>
</table>
  <b>( Roll : <?php echo  number_format($totrol);  ?> ) (GRADE A+B: <?php echo  number_format($totab,'2','.',',');  ?> Kg, Roll: <?php echo  number_format($rolab);  ?>)  (GRADE C: <?php echo  number_format($tota,'2','.',',');  ?> Kg, Roll: <?php echo  number_format($rolac);  ?>) (TOTAL : <?php echo  number_format($totab+$tota,'2','.',',');  ?> Kg) </b>
</body>
</html>
