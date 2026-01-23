<?php
session_start();
ini_set("error_reporting",1);
include("../koneksi.php");
?>
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
.blink { -webkit-animation: blink .75s linear infinite; -moz-animation: blink .75s linear infinite; -ms-animation: blink .75s linear infinite; -o-animation: blink .75s linear infinite; animation: blink .75s linear infinite; } @-webkit-keyframes blink { 0% { opacity: 1; } 50% { opacity: 1; } 50.01% { opacity: 0; } 100% { opacity: 0; } } @-moz-keyframes blink { 0% { opacity: 1; } 50% { opacity: 1; } 50.01% { opacity: 0; } 100% { opacity: 0; } } @-ms-keyframes blink { 0% { opacity: 1; } 50% { opacity: 1; } 50.01% { opacity: 0; } 100% { opacity: 0; } } @-o-keyframes blink { 0% { opacity: 1; } 50% { opacity: 1; } 50.01% { opacity: 0; } 100% { opacity: 0; } } @keyframes blink { 0% { opacity: 1; } 50% { opacity: 1; } 50.01% { opacity: 0; } 100% { opacity: 0; } }
-->
</style>
</head>
<body>
    <div id="art-main">
      <input type="button" class="art-button" onClick="window.location.href='../index_login.php?act=logout'" value="Logout"/>
                            <?php if($_SESSION['status']==0){ ?><input type="button" class="art-button" onClick="window.location.href='../index1.php'" value="Home"/><input type="button" class="art-button" onClick="window.location.href='../index1.php?p=laporan_harian_manager'" value="Laporan"/><br /><?php } ?>
                       
                        
       <table width="100">
  <tr>
    <td>&nbsp;</td>
    <td colspan="21" align="center"><b>MUTASI KAIN </b></td>
  </tr>
  <tr>
   <?php $tgl_cetak1= $_POST['awal'];
   if($_POST['sift']=="3"){$tgl_cetak2=date("Y-m-d",strtotime ( '1 day' , strtotime ($tgl_cetak1)));}else{$tgl_cetak2= $_POST['awal'];} ?>
    <td colspan="22"><b>Tanggal : <?php echo  date("d-M-Y", strtotime($tgl_cetak1))." s/d ".date("d-M-Y", strtotime($tgl_cetak2)); ?> <br>
        SHIFT : <?php if($_POST['semua']=='1'){echo "ALL SHIFT";}else{echo $_POST['sift'];}?><br>
        GROUP SHIFT : <?php if($_POST['semua']=='1'){echo "ALL SHIFT";}else{echo $_POST['user_name'];}?></b></td>
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
    <td rowspan="2">Yard / Meter</td>
    <td rowspan="2">No.Kartu Kerja</td>
    <td rowspan="2">Tempat</td>
    <td rowspan="2">Item</td>
    <td rowspan="2">Keterangan</td>
  </tr>
  <tr align="center" bgcolor="#0099FF">
    <td>Grade<br /> A+B</td>
    <td>Grade <br /> C</td>
    <td>Keterangan<br />(Grade C)</td>
    </tr>
  <?php 
if($_POST['semua']=='1'){
	$tgl2=date("Y-m-d",strtotime( '1 day' , strtotime ($tgl_cetak1)));
	$sql=sqlsrv_query($con,"select pergerakan_stok.id,satuan,
pergerakan_stok.tgl_update,
detail_pergerakan_stok.nokk,
detail_pergerakan_stok.ket,count(detail_pergerakan_stok.yard_) as tot_rol,sum(detail_pergerakan_stok.yard_) as tot_yard ,
sum(detail_pergerakan_stok.weight) as tot_qty,sisa,pergerakan_stok.no_mutasi,pergerakan_stok.userid as user_packing
from pergerakan_stok 
LEFT JOIN detail_pergerakan_stok on pergerakan_stok.id=detail_pergerakan_stok.id_stok 
WHERE pergerakan_stok.tgl_update
BETWEEN '$tgl_cetak1 07:00:00'
AND '$tgl2 07:00:00'
AND pergerakan_stok.fromtoid='GUDANG KAIN JADI' AND detail_pergerakan_stok.id_stok !=''
GROUP BY  pergerakan_stok.id,pergerakan_stok.no_dok,detail_pergerakan_stok.sisa
ORDER BY pergerakan_stok.id ASC");
	
	}else{
  if($_POST['sift']=="1"){	  
  $sql=sqlsrv_query($con,"select pergerakan_stok.id,bruto,satuan,
no_mc,pelanggan,pergerakan_stok.no_po,pergerakan_stok.no_order,tgl_update,
jenis_kain,no_warna,warna,no_item,no_lot,
lebar,berat,detail_pergerakan_stok.nokk,grade,
detail_pergerakan_stok.ket,count(yard_) as tot_rol,sum(yard_) as tot_yard ,
sum(weight) as tot_qty,sisa,pergerakan_stok.no_mutasi
from pergerakan_stok 
inner join detail_pergerakan_stok on pergerakan_stok.id=detail_pergerakan_stok.id_stok 
inner join tbl_kite on tbl_kite.nokk=detail_pergerakan_stok.nokk
WHERE tgl_update
BETWEEN '$tgl_cetak1 07:00:00'
AND '$tgl_cetak2 14:59:59'
AND fromtoid='GUDANG KAIN JADI'
AND tbl_kite.user_packing = '".$_POST['user_name']."'
GROUP BY  pergerakan_stok.id, no_dok,sisa
ORDER BY pergerakan_stok.id ASC");}else if($_POST['sift']=="2"){
	  
	  $sql=sqlsrv_query($con,"select pergerakan_stok.id,bruto,satuan,
no_mc,pelanggan,pergerakan_stok.no_po,pergerakan_stok.no_order,tgl_update,
jenis_kain,no_warna,warna,no_item,no_lot,
lebar,berat,detail_pergerakan_stok.nokk,grade,
detail_pergerakan_stok.ket,count(yard_) as tot_rol,sum(yard_) as tot_yard ,
sum(weight) as tot_qty,sisa,pergerakan_stok.no_mutasi
from pergerakan_stok 
inner join detail_pergerakan_stok on pergerakan_stok.id=detail_pergerakan_stok.id_stok 
inner join tbl_kite on tbl_kite.nokk=detail_pergerakan_stok.nokk
WHERE tgl_update
BETWEEN '$tgl_cetak1 15:00:00'
AND '$tgl_cetak2 22:59:59'
AND fromtoid='GUDANG KAIN JADI'
AND tbl_kite.user_packing = '".$_POST['user_name']."'
GROUP BY  pergerakan_stok.id, no_dok,sisa
ORDER BY pergerakan_stok.id ASC");
	  
	  }else{
	$sql=sqlsrv_query($con,"select pergerakan_stok.id,bruto,satuan,
no_mc,pelanggan,pergerakan_stok.no_po,pergerakan_stok.no_order,tgl_update,
jenis_kain,no_warna,warna,no_item,no_lot,
lebar,berat,detail_pergerakan_stok.nokk,grade,
detail_pergerakan_stok.ket,count(yard_) as tot_rol,sum(yard_) as tot_yard ,
sum(weight) as tot_qty,sisa,pergerakan_stok.no_mutasi
from pergerakan_stok 
inner join detail_pergerakan_stok on pergerakan_stok.id=detail_pergerakan_stok.id_stok 
inner join tbl_kite on tbl_kite.nokk=detail_pergerakan_stok.nokk
WHERE tgl_update
BETWEEN '$tgl_cetak1 23:00:00'
AND '$tgl_cetak2 06:59:59'
AND fromtoid='GUDANG KAIN JADI'
AND tbl_kite.user_packing = '".$_POST['user_name']."'
GROUP BY  pergerakan_stok.id, no_dok,sisa
ORDER BY pergerakan_stok.id ASC");	  
		  
		 }
}
  $c=1;
  $totbruto=0;
  while($row=sqlsrv_fetch_array($sql))
  {
	  $bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99';
	  	 $sql1=sqlsrv_query($con,"SELECT sum(detail_pergerakan_stok.weight) as grd_c
FROM pergerakan_stok left join detail_pergerakan_stok on detail_pergerakan_stok.id_stok=pergerakan_stok.id
WHERE pergerakan_stok.id='".$row['id']."' and grade='C'
GROUP BY pergerakan_stok.id
ORDER BY pergerakan_stok.id ASC");
		 $row1=sqlsrv_fetch_array($sql1);
		 
		 $sql2=sqlsrv_query($con,"SELECT sum(detail_pergerakan_stok.weight) as grd_a_b
FROM pergerakan_stok inner join detail_pergerakan_stok on detail_pergerakan_stok.id_stok=pergerakan_stok.id
WHERE pergerakan_stok.id='".$row['id']."' and ((grade between 'A' and 'B') or grade='')
GROUP BY pergerakan_stok.id
ORDER BY pergerakan_stok.id ASC");
$row2=sqlsrv_fetch_array($sql2);
$sql3=sqlsrv_query($con,"SELECT sum(detail_pergerakan_stok.weight) as sisa_c
FROM pergerakan_stok inner join detail_pergerakan_stok on detail_pergerakan_stok.id_stok=pergerakan_stok.id
WHERE pergerakan_stok.id='".$row['id']."' and grade='C' and (detail_pergerakan_stok.sisa='SISA' or detail_pergerakan_stok.sisa='FKSI') 
ORDER BY pergerakan_stok.id ASC");
	$row3=sqlsrv_fetch_array($sql3);
	$sql4=sqlsrv_query($con,"SELECT sum(detail_pergerakan_stok.weight) as sisa_ab
FROM pergerakan_stok inner join detail_pergerakan_stok on detail_pergerakan_stok.id_stok=pergerakan_stok.id
WHERE pergerakan_stok.id='".$row['id']."' and ((grade between 'A' and 'B') or grade='') and (detail_pergerakan_stok.sisa='SISA' or detail_pergerakan_stok.sisa='FKSI') 
ORDER BY pergerakan_stok.id ASC");
	$row4=sqlsrv_fetch_array($sql4);	
	
	$sql5=sqlsrv_query($con,"SELECT sum(detail_pergerakan_stok.weight) as sisa_c
FROM pergerakan_stok inner join detail_pergerakan_stok on detail_pergerakan_stok.id_stok=pergerakan_stok.id
WHERE pergerakan_stok.id='".$row['id']."' and grade='C' and (detail_pergerakan_stok.sisa='FOC' ) 
ORDER BY pergerakan_stok.id ASC");
	$row5=sqlsrv_fetch_array($sql5);
	$sql6=sqlsrv_query($con,"SELECT sum(detail_pergerakan_stok.weight) as sisa_ab
FROM pergerakan_stok inner join detail_pergerakan_stok on detail_pergerakan_stok.id_stok=pergerakan_stok.id
WHERE pergerakan_stok.id='".$row['id']."' and ((grade between 'A' and 'B') or grade='') and (detail_pergerakan_stok.sisa='FOC') 
ORDER BY pergerakan_stok.id ASC");
	$row6=sqlsrv_fetch_array($sql6);
	$stmpt=sqlsrv_query($con,"select mutasi_kain.id as id_kain,mutasi_kain.userid  
from mutasi_kain 
INNER JOIN pergerakan_stok on pergerakan_stok.id=mutasi_kain.id_stok
where pergerakan_stok.id='".$row['id']."' and mutasi_kain.keterangan='".$row['sisa']."'
GROUP BY mutasi_kain.id,mutasi_kain.keterangan
ORDER BY pergerakan_stok.id ASC");
$rtmpt=sqlsrv_fetch_array($stmpt);
	$skain=sqlsrv_query($con,"SELECT * from tbl_kite where nokk='".$row['nokk']."'");
$rkain=sqlsrv_fetch_array($skain)
	  ?>
    <tr bgcolor="<?php echo $bgcolor;?>">
    <td><?php echo $rkain['no_mc'];?></td>
    <td><?php echo date("d-M-Y H:i:s", strtotime($row['tgl_update']));?></td>
    <td><?php echo $rkain['pelanggan'];?></td>
    <td><?php echo $rkain['no_po'];?></td>
    <td><?php echo $rkain['no_order'];?></td>
    <td><?php echo $rkain['jenis_kain'];?></td>
    <td><?php echo $rkain['no_warna'];?></td>
    <td><?php echo $rkain['warna'];?></td>
    <td><?php echo $rkain['lebar']."/".$rkain['berat'];?> </td>
    <td><?php echo $rkain['no_lot'];?></td>
    <td align="right"><?php 
	echo $row['tot_rol'];
	?></td>
    <td align="right"><?php echo number_format($rkain['bruto'],'2','.',',');?></td>
    <td align="right"><?php 
	if($row['sisa']=="SISA"||$row['sisa']=="FKSI")
	{$grab=number_format($row4['sisa_ab'],'2','.',',');}
	else if($row['sisa']=="FOC"){$grab=number_format($row6['sisa_ab'],'2','.',',');}
	else{$grab=number_format($row2['grd_a_b']-$row4['sisa_ab'],'2','.',',');}
	echo $grab;?></td>
    <td align="right"><?php 
	if($row['sisa']=="SISA"||$row['sisa']=="FKSI"){$grc=number_format($row3['sisa_c'],'2','.',',');}
	else if($row['sisa']=="FOC"){$grc=number_format($row5['sisa_c'],'2','.',',');}
	else{$grc=number_format($row1['grd_c']-$row3['sisa_c'],'2','.',',');}
	echo $grc;?></td>
    <td><?php if($row['sisa']=="SISA" || $row['sisa']=="FKSI"){echo "SISA";}else if($row['sisa']=="FOC"){echo "EXTRA FULL";}?></td>
    <td align="right"><?php echo number_format($row['tot_yard'],'2','.',',')." ".$row['satuan']; ?></td>
    <td>
    <?php if($row['satuan']=="Yard"){?>
    <a href="../index1.php?p=mutasi_detail&id=<?php echo $row['nokk'];?>&tgl1=<?php echo $tgl_cetak1; ?>&tgl2=<?php echo $tgl_cetak2; ?>&sift=<?php echo $row['user_packing'];?>"><?php echo $row['nokk'];?></a>
    <?php }else if($row['satuan']=="PCS"){?>
    <a href="../index1.php?p=mutasi_detail_k&id=<?php echo $row['nokk'];?>&tgl1=<?php echo $tgl_cetak1; ?>&tgl2=<?php echo $tgl_cetak2; ?>&sift=<?php echo $row['user_packing'];?>"><?php echo $row['nokk'];?></a>
    <?php }else{?>
    <a href="../index1.php?p=mutasi_detail_m&id=<?php echo $row['nokk'];?>&tgl1=<?php echo $tgl_cetak1; ?>&tgl2=<?php echo $tgl_cetak2; ?>&sift=<?php echo $row['user_packing'];?>"><?php echo $row['nokk'];?></a>
    <?php }?>
    
    </td>
    <td>&nbsp;</td>
    <td><?php echo $row['no_item'];?></td>
    <td align="center"><?php 
	if($row['no_mutasi']!=''){echo "Sudah Mutasi";}else{echo "<font color='#FF0000' class='blink'>Belum Mutasi</font>";}
	if($_POST['semua']=='1'){echo "<br>".strtolower($row['user_packing']);}else{echo " ";}?>
	
	</td>
  </tr>
 
      <?php
	   if($row['sisa']=="SISA" || $row['sisa']=="FKSI" || $row['sisa']=="FOC"){$brtoo=0;}else{$brtoo=$rkain['bruto'];}
	   $totbruto=$totbruto+$brtoo;
	  $totyard=$totyard+$row['tot_yard'];
	  $totrol=$totrol+$rol;
	  $totab=$totab+$grab;
	  $tota=$tota+$grc;
	  if($row['satuan']=='PCS')
		{ $totrolk = $totrolk + $row['tot_rol'];}
	  	if($row['satuan']=='Meter')
		{$kartot=$kartot + $row['tot_yard']; $totrolm = $totrolm + $row['tot_rol'];}
		if($row['satuan']=='Yard')
		{$pltot=$pltot + $row['tot_yard'];   $totroly = $totroly + $row['tot_rol'];}
		
	  
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
    <td colspan="2">Krah</td>
    <td align="right"><?php echo number_format($totrolk); ?></td>
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
    <td align="right"><?php echo number_format($totrolm); ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Meter</td>
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
    <td align="right"><?php echo  number_format($totroly);?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Yard</td>
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
    
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  
</table>
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