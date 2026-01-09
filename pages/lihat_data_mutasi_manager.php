<?php
session_start();
ini_set("error_reporting",1);
include("koneksi.php");
?> 
   <!--
    Created by Artisteer v2.3.0.21098
    Base template (without user's data) checked by http://validator.w3.org : "This page is valid XHTML 1.0 Transitional"
    -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <title>QC</title>

    <script type="text/javascript" src="../script.js"></script>

    <link rel="stylesheet" href="../style.css" type="text/css" media="screen" />
    <link href="/..pages/styles_cetak.css" rel="stylesheet" type="text/css">
    <!--[if IE 6]><link rel="stylesheet" href="style.ie6.css" type="text/css" media="screen" /><![endif]-->
    <!--[if IE 7]><link rel="stylesheet" href="style.ie7.css" type="text/css" media="screen" /><![endif]-->
    <style type="text/css">
<!--
.warnaa {
	color: #808040;
}
-->
</style>
</head>
<body>
    <div id="art-main">
      <input type="button" class="art-button" onClick="window.location.href='../index_login.php?act=logout'" value="Logout"/>
                            <?php if($_SESSION['status']==0){ ?><input type="button" class="art-button" onClick="window.location.href='../index1.php'" value="Home"/><input type="button" class="art-button" onClick="window.location.href='../index1.php?p=laporan_harian'" value="Laporan"/><br /><?php } ?>
                       
                        
      <table width="100%">
  <tr>
    <td>&nbsp;</td>
    <td colspan="21" align="center"><b>BUKTI MUTASI KAIN</b></td>
  </tr>
  <tr>
   <?php $tgl_cetak1= $_POST['awal'];
   if($_POST['sift']=="3"){$tgl_cetak2=date("Y-m-d",strtotime ( '1 day' , strtotime ($tgl_cetak1)));}else{$tgl_cetak2=$_POST['awal'];} ?>
    <td colspan="22"><b>Tanggal : <?php echo  date("d-M-Y", strtotime($tgl_cetak1))." s/d ".date("d-M-Y", strtotime ($tgl_cetak2)); ?> <br>GROUP SHIFT: <?php echo $_POST['user_name']; ?> <br> SHIFT : <?php echo $_POST['sift'];?></b></td>
  </tr>
  <tr align="center" bgcolor="#0099FF">
    <td rowspan="2">No MC</td>
    <td rowspan="2">Tanggal</td>
    <td rowspan="2">Langganan</td>
    <td rowspan="2" width="15">PO</td>
    <td rowspan="2" width="15">Order</td>
    <td rowspan="2">Jenis Kain</td>
    <td rowspan="2" >No. Warna</td>
    <td rowspan="2">Warna</td>
    <td rowspan="2">L/Grm2</td>
    <td rowspan="2">Lot</td>
    <td rowspan="2">Jml.Roll</td>
    <td rowspan="2">Bruto(Kg)</td>
    <td colspan="3">Netto (KG)</td>
    <td colspan="2">SISA</td>
    <td rowspan="2">Yard</td>
    <td rowspan="2">No.Kartu Kerja</td>
    <td rowspan="2">Tempat</td>
    <td rowspan="2">Item</td>
    <td rowspan="2">Keterangan</td>
  </tr>
  <tr align="center" bgcolor="#0099FF">
    <td>Grade<br /> A+B</td>
    <td>Grade <br /> C</td>
    <td>Keterangan<br />(Grade C)</td>
    <td>Jml. Roll</td>
    <td>Qty(KG)</td>
    </tr>
    <?php
	include"../koneksi.php";
	?>
  <?php 
  	

  if($_POST['sift']=="1"){	  
  $sql=mysqli_query($con,"SELECT * , tbl_kite.id, sum( detail_kite.yard_ ) AS yard_, count( detail_kite.yard_ ) AS roll, sum( detail_kite.net_wight ) AS bruto1
FROM tbl_kite
INNER JOIN detail_kite ON detail_kite.nokkKite = tbl_kite.nokk
WHERE tanggal_update
BETWEEN '$tgl_cetak1 07:00:00'
AND '$tgl_cetak2 14:59:59'
AND tbl_kite.user_packing = '".$_POST['user_name']."'
GROUP BY tbl_kite.id
ORDER BY tbl_kite.id ASC");}else if($_POST['sift']=="2"){
	  
	  $sql=mysqli_query($con,"SELECT * , tbl_kite.id, sum( detail_kite.yard_ ) AS yard_, count( detail_kite.yard_ ) AS roll, sum( detail_kite.net_wight ) AS bruto1
FROM tbl_kite
INNER JOIN detail_kite ON detail_kite.nokkKite = tbl_kite.nokk
WHERE tanggal_update
BETWEEN '$tgl_cetak1 15:00:00'
AND '$tgl_cetak2 22:59:59'
AND tbl_kite.user_packing = '".$_POST['user_name']."'
GROUP BY tbl_kite.id
ORDER BY tbl_kite.id ASC");
	  
	  }else{
	$sql=mysqli_query($con,"SELECT * , tbl_kite.id, sum( detail_kite.yard_ ) AS yard_, count( detail_kite.yard_ ) AS roll, sum( detail_kite.net_wight ) AS bruto1
FROM tbl_kite
INNER JOIN detail_kite ON detail_kite.nokkKite = tbl_kite.nokk
WHERE tanggal_update
BETWEEN '$tgl_cetak1 23:00:00'
AND '$tgl_cetak2 06:59:59'
AND tbl_kite.user_packing = '".$_POST['user_name']."'
GROUP BY tbl_kite.id
ORDER BY tbl_kite.id ASC");	  
		  
		 }
  
  while($row=mysqli_fetch_array($sql))
  {
	  	 $sql1=mysqli_query($con,"SELECT sum(detail_kite.net_wight) as grd_c
FROM tbl_kite left join detail_kite on detail_kite.nokkKite=tbl_kite.nokk
WHERE tbl_kite.id='".$row['id']."' and grade='C'
GROUP BY tbl_kite.id
ORDER BY tbl_kite.id ASC");
		 $row1=mysqli_fetch_array($sql1);
		 
		 $sql2=mysqli_query($con,"SELECT sum(detail_kite.net_wight) as grd_a_b
FROM tbl_kite left join detail_kite on detail_kite.nokkKite=tbl_kite.nokk
WHERE tbl_kite.id='".$row['id']."' and grade between 'A' and 'B'
GROUP BY tbl_kite.id
ORDER BY tbl_kite.id ASC");
$row2=mysqli_fetch_array($sql2);
$sql4=mysqli_query($con,"SELECT *, sum(detail_kite.net_wight) as qty,count(detail_kite.sisa) as jml , grade
FROM tbl_kite
LEFT JOIN detail_kite ON detail_kite.nokkKite = tbl_kite.nokk
WHERE sisa = 'SISA'
AND nokkKite = '".$row['nokk']."'
GROUP BY tbl_kite.id
ORDER BY tbl_kite.id ASC");
		 $row4=mysqli_fetch_array($sql4);
		 $sql5=mysqli_query($con,"SELECT sum(detail_kite.net_wight) as grd_c
FROM tbl_kite left join detail_kite on detail_kite.nokkKite=tbl_kite.nokk
WHERE tbl_kite.id='".$row['id']."' and grade='C' and
sisa = 'SISA'
AND nokkKite = '".$row['nokk']."'
GROUP BY tbl_kite.id
ORDER BY tbl_kite.id ASC");
		 $row5=mysqli_fetch_array($sql5);
		 
		 $sql6=mysqli_query($con,"SELECT sum(detail_kite.net_wight) as grd_a_b
FROM tbl_kite left join detail_kite on detail_kite.nokkKite=tbl_kite.nokk
WHERE tbl_kite.id='".$row['id']."' and grade between 'A' and 'B' and sisa = 'SISA'
AND nokkKite = '".$row['nokk']."'
GROUP BY tbl_kite.id
ORDER BY tbl_kite.id ASC");
$row6=mysqli_fetch_array($sql6);		
	  ?>
    <tr bgcolor="#9999FF">
    <td><?php echo $row['no_mc'];?></td>
    <td><?php echo date("d-M-Y", strtotime($row['tanggal_update']));?></td>
    <td><?php echo $row['pelanggan'];?></td>
    <td><?php echo $row['no_po'];?></td>
    <td><?php echo $row['no_order'];?></td>
    <td><?php echo $row['jenis_kain'];?></td>
    <td><?php echo $row['no_warna'];?></td>
    <td><?php echo $row['warna'];?></td>
    <td><?php echo $row['lebar']."/".$row['berat'];?> </td>
    <td><?php echo $row['no_lot'];?></td>
    <td align="right"><?php echo $row['roll']-$row4['jml'];?></td>
    <td align="right"><?php echo number_format($row['bruto'],'2','.',',');?></td>
    <td align="right"><?php if($row4['grade']=="A" || $row4['grade']=="B"){echo number_format($row2['grd_a_b']-$row6['grd_a_b'],'2','.',',');}else{echo number_format($row2['grd_a_b'],'2','.',',');}?></td>
    <td align="right"><?php 
	if($row4['grade']=="C"){echo number_format($row2['grd_a_b']-$row5['grd_c'],'2','.',',');}else{
	echo number_format($row1['grd_c'],'2','.',',');}?></td>
    <td><?php echo $row1['sisa'];?></td>
    <td align="right"><?php if($row4>0){echo $row4['jml'];}else{echo "0";}?></td>
    <td align="right"><?php if($row4>0){echo number_format($row4['qty'],'2','.',',');}else{echo "0.00";}?></td>
    <td align="right"><?php echo number_format($row['yard_'],'2','.',',')." ".$row['satuan'];?></td>
    <td>
    <?php if($row['satuan']=="Yard"){?>
    <a href="../index1.php?p=mutasi_detail&id=<?php echo $row['nokk'];?>&tgl1=<?php echo $tgl_cetak1; ?>&tgl2=<?php echo $tgl_cetak2; ?>&sift=<?php echo $_POST['sift'];?>"><?php echo $row['nokk'];?></a>
    <?php }else{?>
    <a href="../index1.php?p=mutasi_detail_m&id=<?php echo $row['nokk'];?>&tgl1=<?php echo $tgl_cetak1; ?>&tgl2=<?php echo $tgl_cetak2; ?>&sift=<?php echo $_POST['sift'];?>"><?php echo $row['nokk'];?></a>
    <?php }?>
    
    </td>
    <td>&nbsp;</td>
    <td><?php echo $row['no_item'];?></td>
    <td align="center"><?php 
	if($row['no_mutasi']!=''){$keterangan="OUT";
	echo "<a href='pages/ubah.php?id=".$row['id']."'><font color='#FF0000'>".$keterangan."</font></a>";
	}else{$keterangan="IN PROCESS";
	echo "<font color='#FF0000'>".$keterangan."</font>";}
	
	?></td>
  </tr>
 
      <?php
	  $totbruto=$totbruto+$row['bruto'];
	  $totyard=$totyard+$row['yard_'];
	  $totrol=$totrol+$row['roll'];
	  $totab=$totab+$row2['grd_a_b'];
	  $tota=$tota+$row1['grd_c'];
	  	if($row['satuan']=='Meter')
		{$kartot=$kartot + $row['yard_']; $totkar = $totkar + $row['roll'];}
		if($row['satuan']=='Yard')
		{$pltot=$pltot + $row['yard_'];   $totpl = $totpl + $row['roll'];}
	  
	  }
  ?>
  <?php
 if($_POST['sift']=="1"){
  
   $sql3=mysqli_query($con,"SELECT *
FROM tbl_kite
LEFT JOIN detail_kite ON detail_kite.nokkKite = tbl_kite.nokk
WHERE 
tanggal_update
BETWEEN '$tgl_cetak1 07:00:00'
AND '$tgl_cetak2 14:59:59'
AND tbl_kite.user_packing = '".$_POST['user_name']."' AND sisa = 'SISA'
ORDER BY tbl_kite.id DESC");
 }else  if($_POST['sift']=="2"){$sql3=mysqli_query($con,"SELECT *
FROM tbl_kite
LEFT JOIN detail_kite ON detail_kite.nokkKite = tbl_kite.nokk
WHERE
tanggal_update
BETWEEN '$tgl_cetak1 15:00:00'
AND '$tgl_cetak2 22:59:59'
AND tbl_kite.user_packing = '".$_POST['user_name']."' AND sisa = 'SISA'
ORDER BY tbl_kite.id ASC");
 }else{$sql3=mysqli_query($con,"SELECT *
FROM tbl_kite
LEFT JOIN detail_kite ON detail_kite.nokkKite = tbl_kite.nokk
WHERE 
tanggal_update
BETWEEN '$tgl_cetak1 23:00:00'
AND '$tgl_cetak2 06:59:59'
AND tbl_kite.user_packing = '".$_POST['user_name']."' AND sisa = 'SISA'
ORDER BY tbl_kite.id ASC");}


		 while($row3=mysqli_fetch_array($sql3)){
			 
  ?>
 <?php
		 }
 ?>
  <tr bgcolor="#99FFFF">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td></td>
    <td></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
 <tr bgcolor="#99FFFF">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">Meter</td>
    <td align="right"><?php echo number_format($totkar); ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Meter</td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right"><?php echo number_format($kartot,'2','.',','); ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr bgcolor="#99FFFF">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">Yard</td>
    <td align="right"><?php echo  number_format($totpl);?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Yard</td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right"><?php echo  number_format($pltot,'2','.',',');?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr bgcolor="#99FFFF">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2"><b>Total</b></td>
    <td>&nbsp;</td>
    <td align="right"><b><?php echo $totrol;?></td>
    <td align="right"><b><?php echo number_format($totbruto,'2','.',',');?></b></td>
    <td align="right"><b><?php echo number_format($totab,'2','.',',');?></b></td>
    <td align="right"><b><?php echo number_format($tota,'2','.',',');?></b></td>
    <td>&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right"><b><?php echo number_format($totyard,'2','.',',');?></b></td>
    
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  
</table>
     <!-- <a href="pages/cetak/cetak_mutasi.php?tgl1=<?php /*echo $tgl_cetak1; ?>&tgl2=<?php echo $tgl_cetak2; ?>&user_name=<?php echo $_POST['user_name']; ?>&sift=<?php echo $_POST['sift'];  */?>" target="_blank">Cetak</a> -->                        


                            
                            
<div class="cleared"></div>
                            </div>
                        </div>
                    </div>
                </div>
</div>
        </div>
    </div>
    
</body>
</html>