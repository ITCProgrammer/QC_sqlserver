 
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
<link rel="icon" type="image/png" href="../images/icon.png">
</head>
<body>
    <div id="art-main">
      <input type="button" class="art-button" onClick="window.location.href='../index_login.php?act=logout'" value="Logout"/>
                            <?php if($_SESSION['status']==0){ ?><input type="button" class="art-button" onClick="window.location.href='../index1.php?p=mutasi_kain_masuk'" value="Home"/><br /><?php } ?>
                       
             <form action="simpan_masuk_kain.php" method="post">           
       <table width="100%">
  <tr>
    <td>&nbsp;</td>
    <td colspan="21" align="center"><b>BUKTI MUTASI KAIN</b></td>
  </tr>
  <tr>
   <?php  
   mysql_connect("10.0.0.10","dit","4dm1n");
mysql_select_db("db_qc")or die("Gagal Koneksi");
   if($_POST['no_mutasi']==""){$no=$_GET['no_mutasi'];}else{$no=$_POST['no_mutasi'];}
   $lth=mysql_query("select pergerakan_stok.tgl_update as tanggal_update ,pergerakan_stok.userid as user_packing ,mutasi_kain.no_mutasi 
from mutasi_kain
inner JOIN pergerakan_stok on pergerakan_stok.id=mutasi_kain.id_stok
where mutasi_kain.no_mutasi='$no'
GROUP BY no_mutasi");
	$rowlth=mysql_fetch_array($lth);
   ?>
    <td colspan="22"><b>Tanggal : <?php echo  date("d-M-Y"); ?> <br>
        No Mutasi: <?php echo $no;?></b></td>
  </tr>
  <tr align="center" bgcolor="#0099FF">
    <td rowspan="3">No MC</td>
    <td rowspan="3">Tanggal</td>
    <td rowspan="3">Langganan</td>
    <td rowspan="3" width="15">PO</td>
    <td rowspan="3" width="15">Order</td>
    <td rowspan="3">Jenis Kain</td>
    <td rowspan="3" >No. Warna</td>
    <td rowspan="3">Warna</td>
    <td rowspan="3">L/Grm2</td>
    <td rowspan="3">Lot</td>
    <td rowspan="3">Jml.Roll</td>
    <td rowspan="3">Bruto(Kg)</td>
    <td colspan="4">Netto (KG)</td>
    <td rowspan="3">Yard / Meter</td>
    <td rowspan="3">No.Kartu Kerja</td>
    <td rowspan="3">Tempat</td>
    <td rowspan="3">Item</td>
  </tr>
  <tr align="center" bgcolor="#0099FF">
    <td colspan="3">Grade</td>
    <td rowspan="2">Keterangan<br />(Grade C)</td>
  </tr>
  <tr align="center" bgcolor="#0099FF">
    <td> A</td>
    <td>B</td>
    <td> C</td>
    </tr>
<?php 
mysql_connect("10.0.0.10","dit","4dm1n");
mysql_select_db("db_qc")or die("Gagal Koneksi");
$usr=substr($rowlth['user_packing'],0,3);
if($usr=="INS" or $usr=="ins"){$kt="AND detail_pergerakan_stok.ket='INSPEK'"; $ktc="INSPEK"; $usr1="INS";}
elseif($usr=="KRA" or $usr=="kra"){$kt=""; $ktc="";$usr1="KRA";}
else{$kt=""; $ktc="";$usr1="PAC";}
  $sql=mysql_query("select pergerakan_stok.id,bruto,satuan,pergerakan_stok.no_mutasi,
no_mc,pelanggan,tbl_kite.no_po,tbl_kite.no_order,tgl_update,
jenis_kain,no_warna,warna,no_item,no_lot,tbl_kite.user_packing,
lebar,berat,detail_pergerakan_stok.nokk,grade,
detail_pergerakan_stok.ket,count(yard_) as tot_rol,sum(yard_) as tot_yard ,
sum(weight) as tot_qty,
SUM(case when grade='A' or grade='B' or grade='' then weight else 0 end) as grd_ab,
SUM(case when grade='A' or grade='' then weight else 0 end) as grd_a,
SUM(case when grade='B' then weight else 0 end) as grd_b,
SUM(case when grade='C' then weight else 0 end) as grd_c,
SUM(if(grade='A' or grade='B' or grade='', 1, 0)) as jml_ab,
SUM(if(grade = 'C', 1, 0)) as jml_grd_c,
sisa
from pergerakan_stok 
inner join detail_pergerakan_stok on pergerakan_stok.id=detail_pergerakan_stok.id_stok 
inner join tbl_kite on tbl_kite.nokk=detail_pergerakan_stok.nokk
where pergerakan_stok.no_mutasi='$_POST[no_mutasi]' and tbl_kite.user_packing like '%$usr1%' $kt
GROUP BY  pergerakan_stok.id, no_dok,sisa
ORDER BY pergerakan_stok.id ASC");
$c=0;
  $i=1;
  while($row=mysql_fetch_array($sql))
  {
	 $bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99'; 
	  	 $sql1=mysql_query("SELECT sum(detail_pergerakan_stok.weight) as grd_c, count(detail_pergerakan_stok.weight) as jml_grd_c
FROM pergerakan_stok left join detail_pergerakan_stok on detail_pergerakan_stok.id_stok=pergerakan_stok.id
WHERE pergerakan_stok.id='$row[id]' and grade='C' and sisa='$row[sisa]'
GROUP BY pergerakan_stok.id
ORDER BY pergerakan_stok.id ASC");
		 $row1=mysql_fetch_array($sql1);
		 
		 $sql2=mysql_query("SELECT sum(detail_pergerakan_stok.weight) as grd_a_b, COUNT(detail_pergerakan_stok.weight) jml_ab
FROM pergerakan_stok inner join detail_pergerakan_stok on detail_pergerakan_stok.id_stok=pergerakan_stok.id
WHERE pergerakan_stok.id='$row[id]' and ((grade between 'A' and 'B') or grade='')and  sisa='$row[sisa]'
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
WHERE pergerakan_stok.id='$row[id]' and ((grade between 'A' and 'B') or grade='') and (detail_pergerakan_stok.sisa='SISA' or detail_pergerakan_stok.sisa='FKSI') 
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
	$sql7=mysql_query("select mutasi_kain.id as id_kain,mutasi_kain.tempat  
from mutasi_kain 
INNER JOIN pergerakan_stok on pergerakan_stok.no_mutasi=mutasi_kain.no_mutasi
inner join detail_pergerakan_stok on pergerakan_stok.id=detail_pergerakan_stok.id_stok
where mutasi_kain.id_stok='$row[id]' and mutasi_kain.keterangan='$row[sisa]'
GROUP BY mutasi_kain.id,mutasi_kain.keterangan");
	$row7=mysql_fetch_array($sql7);	
	  ?>
    <tr bgcolor="<?php echo $bgcolor; ?>">
    <td><?php echo $row['no_mc'];?></td>
    <td><?php echo date("d-M-Y", strtotime($row['tgl_update']));?></td>
    <td><?php echo $row['pelanggan'];?></td>
    <td><?php echo $row['no_po'];?></td>
    <td><?php echo $row['no_order'];?></td>
    <td><?php echo $row['jenis_kain'];?></td>
    <td><?php echo $row['no_warna'];?></td>
    <td><?php echo $row['warna'];?></td>
    <td><?php echo $row['lebar']."/".$row['berat'];?> </td>
    <td><?php echo $row['no_lot'];?></td>
    <td align="right"><?php $rol=$row['tot_rol'];if(($row['jml_grd_c']>0) and ($row['jml_ab']>0)){$rol1=$row['jml_ab']."+".$row['jml_grd_c'];}else if($row['jml_grd_c']>0){$rol1=$row['jml_grd_c'];}else{$rol1=$row['jml_ab'];}
	echo $rol1;?></td>
    <td align="right"><?php echo number_format($row['bruto'],'2','.',',');?></td>
    <td align="right"><?php	echo number_format($row['grd_a'],'2','.',',');?></td>
    <td align="right"><?php	echo number_format($row['grd_b'],'2','.',',');?></td>
    <td align="right"><?php echo number_format($row['grd_c'],'2','.',',');?></td>
    <td><?php if($row['sisa']=="SISA" || $row['sisa']=="FKSI"){echo "SISA";}else if($row['sisa']=="FOC"){echo "EXTRA FULL";}else if($row['sisa']=="BS"){echo "BS";}?></td>
    <td align="right"><?php echo number_format($row['tot_yard'],'2','.',',')." ".$row['satuan']; ?></td>
    <td><a href="#" onClick="window.open('detail-masuk-kain-m.php?nokk=<?php echo $row['nokk'];?>&ket=<?php echo $row['sisa'];?>&id=<?php echo $row['id'];?>','MyWindow','height=400,width=500');"><?php echo $row['nokk'];?></a></td>
    <td><input class="input1" name="tempat[<?php echo $i;?>]" type="text" value="<?php echo $row7['tempat'];?>">
    <input name="no_mutasi" type="hidden" value="<?php echo $no;?>">
	<input name="kk" type="hidden" value="<?php echo $row['nokk'];?>"></td>
    <td><?php echo $row['no_item'];?></td>
  </tr>
 
       <?php
	   $i++;
	  if($row['sisa']=="SISA" || $row['sisa']=="FKSI" || $row['sisa']=="FOC"){$brtoo=0;}else{$brtoo=$row['bruto'];}
	   $totbruto=$totbruto+$brtoo;
	  $totyard=$totyard+$row['tot_yard'];
	  $totrol=$totrol+$row['tot_rol'];
	  $tota=$tota+$row['grd_a'];
	  $totb=$totb+$row['grd_b'];
	  $totc=$totc+$row['grd_c'];
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
    <td align="right"><b><?php echo number_format($tota,'2','.',',');?></b></td>
    <td align="right"><b><?php echo number_format($totb,'2','.',',');?></b></td>
    <td align="right"><b><?php echo number_format($totc,'2','.',',');?></b></td>
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