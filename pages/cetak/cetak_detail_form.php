<html>
<head>
<title></title>
<link href="../styles_cetak.css" rel="stylesheet" type="text/css">
</head>
<body>
 <script>
  function roundToTwo(num) {    
    return +(Math.round(num + "e+2")  + "e-2");
}                
</script>
   
    <?php 
   		ini_set("error_reporting",1);
include("../../koneksi.php");

	
  $sql1=mysqli_query($con,"SELECT *,detail_kite.yard_ as yard_, detail_kite.yard_ as roll, detail_kite.net_wight as bruto
FROM tbl_kite left join detail_kite on detail_kite.nokkKite=tbl_kite.nokk
WHERE tbl_kite.nokk='".$_GET['id']."'
ORDER BY detail_kite.id ASC");
  $row1=mysqli_fetch_array($sql1);
  $jumlah=mysqli_num_rows($sql1);
   ?>
<script>
   
          function ganti(id,thn1,bln1,hr1,thn2,bln2,hr2,sift)
{     var yrd= document.forms['form2']['yrd_'].value;  
var x,meter;
if(yrd=="meter"){
	window.location.href="form-Packing?p=mutasi_detail_meter&id="+ id +"&tgl1="+ thn1 +"-"+ bln1 +"-"+ hr1 +"&tgl2="+ thn2 +"-"+ bln2 +"-"+ hr2 + "&sift="+ sift;
	}

}
           </script>
<div><h3><b>BUKTI MUTASI KAIN DETAIL</b></h3>

<b>Tanggal : <?php echo $_GET['tgl1']." s/d ".$_GET['tgl2']; ?> <br>GROUP SHIFT: <?php echo $_GET['user_name']; ?> <br> SHIFT : <?php echo $_GET['sift'];?><br>
      No Kartu Kerja : <?php echo $row1['nokk'];?><br>
      No Order :<?php echo $row1['no_order'];?><br>
      Pelanggan :<?php echo $row1['pelanggan'];
	$thn1=substr($_GET['tgl1'],0,4);
	$bln1=substr($_GET['tgl1'],5,2);
	$hr1=substr($_GET['tgl1'],8,2);
	$thn2=substr($_GET['tgl2'],0,4);
	$bln2=substr($_GET['tgl2'],5,2);
	$hr2=substr($_GET['tgl2'],8,2);?><br /></b></div>
      <?php 
	   if(substr($_GET['user_name'],0,6)=="INSPEK"){
	  $ket="INSPEK";}else{$ket='';}
	  
 	$sql=mysqli_query($con,"SELECT * , detail_kite.yard_ AS yard_, detail_kite.yard_ AS roll, detail_kite.net_wight AS bruto,detail_kite.satuan,sisa
FROM tbl_kite
INNER JOIN detail_kite ON detail_kite.nokkKite = tbl_kite.nokk
WHERE tbl_kite.nokk = '".$_GET['id']."' and detail_kite.ket='$ket' group by no_roll
ORDER BY detail_kite.id ASC limit 0,20"); 
$sql2=mysqli_query($con,"SELECT * , detail_kite.yard_ AS yard_, detail_kite.yard_ AS roll, detail_kite.net_wight AS bruto,detail_kite.satuan,sisa
FROM tbl_kite
INNER JOIN detail_kite ON detail_kite.nokkKite = tbl_kite.nokk
WHERE tbl_kite.nokk = '".$_GET['id']."' and detail_kite.ket='$ket' group by no_roll
ORDER BY detail_kite.id ASC limit 20,20"); 
$sql3=mysqli_query($con,"SELECT * , detail_kite.yard_ AS yard_, detail_kite.yard_ AS roll, detail_kite.net_wight AS bruto,detail_kite.satuan,sisa
FROM tbl_kite
INNER JOIN detail_kite ON detail_kite.nokkKite = tbl_kite.nokk
WHERE tbl_kite.nokk = '".$_GET['id']."' and detail_kite.ket='$ket' group by no_roll
ORDER BY detail_kite.id ASC limit 40,20");
	$no=1;
  $row1=mysqli_fetch_array($sql1)
  ?>
    <table width="20%" align="center" border="0" class="table-list">
  
  <tr><td valign="top">
  <table width="33"  border="0" class="table-list">
  <tr align="center" >
     
    
    <td>No Roll</td>
    <td width="27%">Net Waight</td>
  
    <td width="54%">Yard</td>
    <td width="54%">Keterangan</td>
    
  </tr>
 <?php
  while($row=mysqli_fetch_array($sql))
  {	
	  ?>
      <tr >
    <td><?php echo $row['no_roll'];?></td>
    <td align="right"><?php echo number_format($row['bruto'],'2','.',','); ?></td>
    <td align="right"><?php echo number_format($row['yard_'],'2','.',',');?></td>
     <td><?php echo $row['sisa'];?></td>
    </tr>
      <?php
	  if($row['sisa']=="SISA" ||$row['sisa']=="EXTRA"){$netto=0; $ukuran=0;}else{$netto=$row['bruto']; $ukuran=$row['yard_'];}
	  $totbruto=$totbruto+ $netto;
	  $totyard=$totyard+ $ukuran;
	  $totrol=$totrol+$row['roll'];
	  
	  $no++;
	  }
  
  
  ?>
  </table> </td>
   <?php if($jumlah>=21){?>
  <td valign="top">
 
  <table width="33" border="0" class="table-list">
    <tr align="center">
      <td>No Roll</td>
      <td width="27%">Net Waight</td>
      <td width="54%">Yard</td>
      <td width="54%">Keterangan</td>
    </tr>
    <?php
  while($row2=mysqli_fetch_array($sql2))
  {	
	  ?>
    <tr >
      <td><?php echo $row2['no_roll'];?></td>
      <td align="right"><?php echo number_format($row2['bruto'],'2','.',','); ?></td>
      <td align="right"><?php echo number_format($row2['yard_'],'2','.',',');?></td>
      <td><?php echo $row2['sisa'];?></td>
    </tr>
    <?php
	if($row2['sisa']=="SISA" ||$row2['sisa']=="EXTRA"){$netto=0; $ukuran=0;}else{$netto=$row2['bruto']; $ukuran=$row2['yard_'];}
	  $totbruto=$totbruto+ $netto;
	  $totyard=$totyard+ $ukuran;
	  $totrol=$totrol+$row['roll'];
	  
	  $no++;
	  }
  
  
  ?>
  </table>
  </td><?php } ?>
  <?php if($jumlah>=41){?>
  <td valign="top">
  
  <table width="33" border="0" class="table-list">
    <tr align="center">
      <td>No Roll</td>
      <td width="27%">Net Waight</td>
      <td width="54%">Yard</td>
      <td width="54%">Keterangan</td>
    </tr>
    <?php
  while($row3=mysqli_fetch_array($sql3))
  {	
	  ?>
    <tr >
      <td><?php echo $row3['no_roll'];?></td>
      <td align="right"><?php echo number_format($row3['bruto'],'2','.',','); ?></td>
      <td align="right"><?php echo number_format($row3['yard_'],'2','.',',');?></td>
      <td><?php echo $row3['sisa'];?></td>
    </tr>
    <?php
	if($row3['sisa']=="SISA" ||$row3['sisa']=="EXTRA"){$netto=0; $ukuran=0;}else{$netto=$row3['bruto']; $ukuran=$row3['yard_'];}
	  $totbruto=$totbruto+ $netto;
	  $totyard=$totyard+ $ukuran;
	  $totrol=$totrol+$row['roll'];
	  
	  $no++;
	  }
  
  
  ?>
  </table>
  </td>
  <?php } ?>
  </tr>
 <tr >
    <td colspan="3" valign="baseline">
 <table width="100%"  align="left" ><tr  align="Right">
    <td width="75%">&nbsp;</td>
    <td width="15%">Net Waight</td>
    <td width="10%" colspan="2">Yard</td>  
   
    </tr>
  <tr align="right">
    <td><b>Total</b></td>
    <td align="right"><b><?php echo number_format($totbruto,'2','.',',');?></td>
    <td align="right" colspan="2"><b><?php echo number_format($totyard,'2','.',',');?></b></td>
 
    </tr></table></td>
    </tr>
  
  
</table>
     <br>
<a href="javascript:window.print()">Print</a>                        

</body>
</html>