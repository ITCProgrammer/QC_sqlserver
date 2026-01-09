 
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
                            <?php if($_SESSION['status']==0){ ?><input type="button" class="art-button" onClick="window.location.href='../index1.php?p=mutasi_kain_masuk'" value="Home"/><br /><?php } ?>
                       
             <form action="simpan_masuk_kain_coba.php" method="post">           
       <table width="100%">
  <tr>
    <td>&nbsp;</td>
    <td colspan="20" align="center"><b>BUKTI MUTASI KAIN</b></td>
  </tr>
  <tr>
   <?php  if($_POST['no_mutasi']==""){$no=$_GET['no_mutasi'];}else{$no=$_POST['no_mutasi'];}?>
    <td colspan="21"><b>Tanggal : <?php echo  date("d-M-Y"); ?> <br>
        No Mutasi: <?php echo $no;?></b></td>
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
  </tr>
  <tr align="center" bgcolor="#0099FF">
    <td>Grade<br /> A+B</td>
    <td>Grade <br /> C</td>
    <td>Keterangan<br />(Grade C)</td>
    </tr>
  <?php 
  	mysql_connect("192.168.0.3","root","itc0920");
mysql_select_db("db_qc")or die("Gagal Koneksi");

   
	
  $sql=mysql_query("select pergerakan_stok.id,bruto,satuan,mutasi_kain.tempat,mutasi_kain.no_mutasi,
no_mc,pelanggan,pergerakan_stok.no_po,pergerakan_stok.no_order,tgl_update,
jenis_kain,no_warna,warna,no_item,no_lot,tbl_kite.user_packing,
lebar,berat,detail_pergerakan_stok.nokk,grade,
detail_pergerakan_stok.ket,count(yard_) as tot_rol,sum(yard_) as tot_yard ,
sum(weight) as tot_qty,sisa
from pergerakan_stok 
inner join detail_pergerakan_stok on pergerakan_stok.id=detail_pergerakan_stok.id_stok 
inner join mutasi_kain on pergerakan_stok.id=mutasi_kain.id_stok 
inner join tbl_kite on tbl_kite.nokk=detail_pergerakan_stok.nokk
where mutasi_kain.no_mutasi='$no'
GROUP BY  pergerakan_stok.id, no_dok,sisa
ORDER BY pergerakan_stok.id ASC");
$c=0;
  $i=1;
  while($row=mysql_fetch_array($sql))
  {
	 $bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99'; 
	  	 $sql1=mysql_query("SELECT sum(detail_pergerakan_stok.weight) as grd_c
FROM pergerakan_stok left join detail_pergerakan_stok on detail_pergerakan_stok.id_stok=pergerakan_stok.id
WHERE pergerakan_stok.id='$row[id]' and grade='C'
GROUP BY pergerakan_stok.id
ORDER BY pergerakan_stok.id ASC");
		 $row1=mysql_fetch_array($sql1);
		 
		 $sql2=mysql_query("SELECT sum(detail_pergerakan_stok.weight) as grd_a_b
FROM pergerakan_stok inner join detail_pergerakan_stok on detail_pergerakan_stok.id_stok=pergerakan_stok.id
WHERE pergerakan_stok.id='$row[id]' and grade between 'A' and 'B'
GROUP BY pergerakan_stok.id
ORDER BY pergerakan_stok.id ASC");
$row2=mysql_fetch_array($sql2);
$sql3=mysql_query("SELECT sum(detail_pergerakan_stok.weight) as sisa_c
FROM pergerakan_stok inner join detail_pergerakan_stok on detail_pergerakan_stok.id_stok=pergerakan_stok.id
WHERE pergerakan_stok.id='$row[id]' and grade='C' and (detail_pergerakan_stok.sisa='SISA' or detail_pergerakan_stok.sisa='FKSI') 
ORDER BY pergerakan_stok.id ASC");
	$row3=mysql_fetch_array($sql3);
	$sql4=mysql_query("SELECT sum(detail_pergerakan_stok.weight) as sisa_ab
FROM pergerakan_stok inner join detail_pergerakan_stok on detail_pergerakan_stok.id_stok=pergerakan_stok.id
WHERE pergerakan_stok.id='$row[id]' and grade between 'A' and 'B' and (detail_pergerakan_stok.sisa='SISA' or detail_pergerakan_stok.sisa='FKSI') 
ORDER BY pergerakan_stok.id ASC");
	$row4=mysql_fetch_array($sql4);	
	
	$sql5=mysql_query("SELECT sum(detail_pergerakan_stok.weight) as sisa_c
FROM pergerakan_stok inner join detail_pergerakan_stok on detail_pergerakan_stok.id_stok=pergerakan_stok.id
WHERE pergerakan_stok.id='$row[id]' and grade='C' and (detail_pergerakan_stok.sisa='FOC' ) 
ORDER BY pergerakan_stok.id ASC");
	$row5=mysql_fetch_array($sql5);
	$sql6=mysql_query("SELECT sum(detail_pergerakan_stok.weight) as sisa_ab
FROM pergerakan_stok inner join detail_pergerakan_stok on detail_pergerakan_stok.id_stok=pergerakan_stok.id
WHERE pergerakan_stok.id='$row[id]' and grade between 'A' and 'B' and (detail_pergerakan_stok.sisa='FOC') 
ORDER BY pergerakan_stok.id ASC");
	$row6=mysql_fetch_array($sql6);	
	$sql7=mysql_query("select pergerakan_stok.tgl_update as tanggal_update ,userid as user_packing ,no_mutasi,tempat 
from mutasi_kain
inner JOIN pergerakan_stok on pergerakan_stok.id=mutasi_kain.id_stok
where mutasi_kain.id_stok='$row[id]' and keterangan='$row[sisa]'
GROUP BY no_mutasi");
	$row7=mysql_fetch_array($sql7);	
	  ?>
    <tr bgcolor="<?php echo $bgcolor; ?>">
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
    <td align="right"><?php echo $row['tot_rol'];
	?></td>
    <td align="right"><?php echo number_format($row['bruto'],'2','.',',');?></td>
    <td align="right"><?php 
	if($row['sisa']=="SISA"||$row['sisa']=="FKSI")
	{$grab=number_format($row4['sisa_ab'],'2','.',',');}
	else if($row['sisa']=="FOC"){$grab=number_format($row6['sisa_ab'],'2','.',',');}
	else{$grab=number_format($row2['grd_a_b'],'2','.',',');}
	echo $grab;?></td>
    <td align="right"><?php 
	if($row['sisa']=="SISA"||$row['sisa']=="FKSI"){$grc=number_format($row3['sisa_c'],'2','.',',');}
	else if($row['sisa']=="FOC"){$grc=number_format($row5['sisa_c'],'2','.',',');}
	else{$grc=number_format($row1['grd_c'],'2','.',',');}
	echo $grc;?></td>
    <td><?php if($row['sisa']=="SISA" || $row['sisa']=="FKSI"){echo "SISA";}else if($row['sisa']=="FOC"){echo "EXTRA FULL";}?></td>
    <td align="right"><?php echo number_format($row['tot_yard'],'2','.',',')." ".$row['satuan']; ?></td>
    <td><?php echo $row['nokk']?></td>
    <td><input class="input1" name="tempat[<?php echo $i;?>]" type="text" value="<?php echo $row7['tempat'];?>">
    <input name="no_mutasi" type="hidden" value="<?php echo $no;?>"></td>
    <td><?php echo $row['no_item'];?></td>
  </tr>
 
       <?php
	  if($row['sisa']=="SISA" || $row['sisa']=="FKSI" || $row['sisa']=="FOC"){$brtoo=0;}else{$brtoo=number_format($row['bruto'],'2','.',',');}
	   $totbruto=$totbruto+$brtoo;
	  $totyard=$totyard+$row['tot_yard'];
	  $totrol=$totrol+$row['tot_rol'];
	  $totab=$totab+$grab;
	  $tota=$tota+$grc;
	  	if($row['satuan']=='Meter')
		{$kartot=$kartot + $row['tot_yard']; $totrolm = $totrolm + $row['tot_rol'];}
		if($row['satuan']=='Yard')
		{$pltot=$pltot + $row['tot_yard'];   $totroly = $totroly + $row['tot_rol'];}
	  
	  }
  ?>
  <?php
 if($_POST['sift']=="1"){
  
   $sql3=mysql_query("SELECT *
FROM tbl_kite
LEFT JOIN detail_kite ON detail_kite.nokkKite = tbl_kite.nokk
WHERE 
tanggal_update
BETWEEN '$tgl_cetak1 07:00:00'
AND '$tgl_cetak2 14:59:59'
AND tbl_kite.user_packing = '$_POST[user_name]' AND sisa = 'SISA'
ORDER BY tbl_kite.id DESC");
 }else  if($_POST['sift']=="2"){$sql3=mysql_query("SELECT *
FROM tbl_kite
LEFT JOIN detail_kite ON detail_kite.nokkKite = tbl_kite.nokk
WHERE
tanggal_update
BETWEEN '$tgl_cetak1 15:00:00'
AND '$tgl_cetak2 22:59:59'
AND tbl_kite.user_packing = '$_POST[user_name]' AND sisa = 'SISA'
ORDER BY tbl_kite.id ASC");
 }else{$sql3=mysql_query("SELECT *
FROM tbl_kite
LEFT JOIN detail_kite ON detail_kite.nokkKite = tbl_kite.nokk
WHERE 
tanggal_update
BETWEEN '$tgl_cetak1 23:00:00'
AND '$tgl_cetak2 06:59:59'
AND tbl_kite.user_packing = '$_POST[user_name]' AND sisa = 'SISA'
ORDER BY tbl_kite.id ASC");}


		 while($row3=mysql_fetch_array($sql3)){
			 
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
    <td></td>
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
    <td align="right"><?php echo $totrol;?></td>
    <td align="right"><b><?php echo number_format($totbruto,'2','.',',');?></b></td>
    <td align="right"><b><?php echo number_format($totab,'2','.',',');?></b></td>
    <td align="right"><b><?php echo number_format($tota,'2','.',',');?></b></td>
    <td>&nbsp;</td>
    <td align="right">&nbsp;</td>
    
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  
</table>
      <input name="masuk" type="submit" value="masuk kain">  </form>                      


                            
                            
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