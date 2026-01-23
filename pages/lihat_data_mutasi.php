<?php  
include("../koneksi.php");
ini_set("error_reporting",1); ?>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <title>QC</title>

    <script type="text/javascript" src="../script.js"></script>
<script type="text/javascript"> 
//check all checkbox
function checkAll(form){
    for (var i=0;i<document.forms[form].elements.length;i++)
    {
        var e=document.forms[form].elements[i];
        if ((e.name !='allbox') && (e.type=='checkbox'))
        {
            e.checked=document.forms[form].allbox.checked;
        }
    }
}
</script>
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
 <form  action="simpan_cetak_mutasi.php" method="POST" name="form1">                          
                        
       <table width="100%">
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="21" align="center"><b>BUKTI MUTASI KAIN <?php echo $_POST['bs'];?></b></td>
  </tr>
  <tr>
  <?php $tgl_cetak1= $_POST['awal'];
   if($_POST['sift']=="3"){$tgl_cetak2=date("Y-m-d",strtotime ( '1 day' , strtotime ($tgl_cetak1)));}else{$tgl_cetak2= $_POST['awal'];} ?>
    <td colspan="23"><b>Tanggal : <?php echo  date("d-M-Y", strtotime($tgl_cetak1))." s/d ".date("d-M-Y", strtotime($tgl_cetak2)); ?> <br>GROUP SHIFT: <?php echo $_POST['user_name']; ?> <br> SHIFT : <?php echo $_POST['sift'];?></b></td>
  </tr>
  <tr align="center" bgcolor="#0099FF">
    <td rowspan="3"><input type="checkbox" name="allbox" value="check" onClick="checkAll(0);" /><font color="red">Pilih Semua</font></td>
    <td rowspan="3">No MC</td>
    <td rowspan="3">Tanggal</td>
    <td rowspan="3">Langganan</td>
    <td rowspan="3" width="15">PO</td>
    <td rowspan="3" width="15">Order</td>
    <td rowspan="3">Jenis__Kain</td>
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
    <td>A</td>
    <td>B</td>
    <td> C</td>
    </tr>
<?php 
if($_POST['sift']=="1"){$sift=" tgl_update BETWEEN '$tgl_cetak1 07:00:00' AND '$tgl_cetak2 14:59:59' AND  ";}
else if($_POST['sift']=="2"){$sift=" tgl_update BETWEEN '$tgl_cetak1 15:00:00' AND '$tgl_cetak2 22:59:59' AND ";}
else{$sift=" tgl_update BETWEEN '$tgl_cetak1 23:00:00' AND '$tgl_cetak2 06:59:59' AND ";}

	if(substr($_POST['user_name'],0,6)=="INSPEK"){$ket=" and detail_pergerakan_stok.ket!=''";}else{$ket=" and detail_pergerakan_stok.ket=''";}
    if($_POST['bs']=="BS"){$bs=" fromtoid='GUDANG BS' ";}else if($_POST['bs']=="GUDANG GREIGE"){$bs=" fromtoid='GUDANG GREIGE' ";}else{$bs=" fromtoid='GUDANG KAIN JADI' ";}		   
  $sql=sqlsrv_query($con,"select pergerakan_stok.id,bruto,detail_pergerakan_stok.satuan,
no_mc,pelanggan,tbl_kite.no_po,tbl_kite.no_order,tgl_update,
jenis_kain,no_warna,warna,no_item,no_lot,
lebar,berat,detail_pergerakan_stok.nokk,detail_pergerakan_stok.grade,
detail_pergerakan_stok.ket,count(detail_pergerakan_stok.yard_) as tot_rol,sum(detail_pergerakan_stok.yard_) as tot_yard ,
sum(detail_pergerakan_stok.weight) as tot_qty,
SUM(case when detail_pergerakan_stok.grade='A' or detail_pergerakan_stok.grade='B' or detail_pergerakan_stok.grade='' then weight else 0 end) as grd_ab,
SUM(case when detail_pergerakan_stok.grade='A' or detail_pergerakan_stok.grade='' then weight else 0 end) as grd_a,
SUM(case when detail_pergerakan_stok.grade='B' then weight else 0 end) as grd_b,
SUM(case when detail_pergerakan_stok.grade='C' then detail_pergerakan_stok.weight else 0 end) as grd_c,
SUM(if(detail_pergerakan_stok.grade='A' or detail_pergerakan_stok.grade='B' or detail_pergerakan_stok.grade='', 1, 0)) as jml_ab,
SUM(if(detail_pergerakan_stok.grade = 'C', 1, 0)) as jml_grd_c,
detail_pergerakan_stok.sisa
from pergerakan_stok 
INNER JOIN detail_pergerakan_stok on pergerakan_stok.id=detail_pergerakan_stok.id_stok
LEFT JOIN tmp_detail_kite on tmp_detail_kite.id=detail_pergerakan_stok.id_detail_kj 
LEFT JOIN tbl_kite on tbl_kite.id=tmp_detail_kite.id_kite
WHERE ".$sift.$bs.$greige." AND userid = '".$_POST['user_name']."' ".$ket."
GROUP BY  pergerakan_stok.id, no_dok,sisa
ORDER BY pergerakan_stok.id ASC");
  $c=0;
  $n=1;
  while($row=sqlsrv_fetch_array($sql))
  {
	  $cek=sqlsrv_query($con,"select * from mutasi_kain
		where id_stok='".$row['id']."' limit 1 ");
		   $crow=sqlsrv_fetch_array($cek);
	  if($crow>0){}else{ 
	   $bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99';
	   
	   $sqlket=sqlsrv_query($con,"select nokk,ket_c,sisa from detail_pergerakan_stok where nokk ='".$row['nokk']."' and ket_c !='' and sisa !='TH' and sisa !='FKTH' and grade='C'
GROUP BY ket_c");
$rowket=sqlsrv_fetch_array($sqlket);

	  ?>
    <tr bgcolor="<?php echo $bgcolor; ?>">
      <td><?php
   
     echo '<input type="checkbox" name="check['.$n.']" value="'.$row['id']."/".$row['sisa'].'" /> - Pilihan / opsi ke '.$n;
  $n++;
   ?></td>
    <td><?php echo $row['no_mc'];?></td>
    <td><?php echo date("d-M-Y", strtotime($row['tgl_update']));?></td>
    <td><?php echo $row['pelanggan'];?></td>
    <td><?php echo $row['no_po'];?></td>
    <td><?php echo $row['no_order'];?></td>
    <td><?php echo $row['jenis_kain'];?></td>
    <td><?php echo $row['no_warna'];?></td>
    <td><?php echo $row['warna'];?></td>
    <td><?php if($_POST['user_name']=="KRAH"){echo "<center>-</center>";}else{echo $row['lebar']."/".$row['berat'];}?> </td>
    <td><?php echo $row['no_lot'];?></td>
    <td align="right"><?php $rol=$row['tot_rol'];if(($row['jml_grd_c']>0) and ($row['jml_ab']>0)){$rol1=$row['jml_ab']."+".$row['jml_grd_c'];}else if($row['jml_grd_c']>0){$rol1=$row['jml_grd_c'];}else{$rol1=$row['jml_ab'];}
	echo $rol1;
	?></td>
    <td align="right"><?php echo number_format($row['bruto'],'2','.',',');?></td>
    <td align="right"><?php echo number_format($row['grd_a'],'2','.',',');?></td>
    <td align="right"><?php echo number_format($row['grd_b'],'2','.',',');?></td>
    <td align="right"><?php echo number_format($row['grd_c'],'2','.',',');?></td>
    <td><?php if($row['sisa']=="SISA" || $row['sisa']=="FKSI"){echo "SISA";}else if($row['sisa']=="FOC"){echo "EXTRA FULL";} if($row['sisa']=="SISA" || $row['sisa']=="FKSI"){}else{echo " ".$rowket['ket_c'];}?></td>
    <td align="right">
      <?php  if($_POST['user_name']=="KRAH"){echo "<center>-</center>";}else{echo number_format($row['tot_yard'],'2','.',',')." ".$row['satuan'];} ?></td>
    <td>
    <?php echo $row['nokk']?>
    
    </td>
    <td>&nbsp;</td>
    <td><?php echo $row['no_item'];?></td>
  </tr>
 
      <?php
	  if($row['sisa']=="SISA" || $row['sisa']=="FKSI" || $row['sisa']=="FOC"){$brtoo=0;}else{$brtoo=number_format($row['bruto'],'2','.',',');}
	   $totbruto=$totbruto+$brtoo;
	  $totyard=$totyard+$row['tot_yard'];
	  $totrol=$totrol+$rol;
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
		 }
 ?>
  <tr bgcolor="#99FFFF">
    <td>&nbsp;</td>
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
    <td>&nbsp;</td>
    <td colspan="2"><b>Total</b></td>
    <td>&nbsp;</td>
    <td align="right"><b><?php echo $totrol;?></td>
    <td align="right"><b><?php echo number_format($totbruto,'2','.',',');?></b></td>
    <td align="right"><b><?php echo number_format($tota,'2','.',',');?></b></td>
    <td align="right"><b><?php echo number_format($totb,'2','.',',');?></b></td>
    <td align="right"><b><?php echo number_format($tota,'2','.',',');?></b></td>
    <td>&nbsp;</td>
    <td align="right">&nbsp;</td>
    
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  
</table>                       
 <input name="tgl1" type="hidden" value="<?php echo $tgl_cetak1; ?>">
    <input name="tgl2" type="hidden" value="<?php echo $tgl_cetak2; ?>">
    <input name="user_name" type="hidden" value="<?php echo $_POST['user_name']; ?>">
    <input name="sift" type="hidden" value="<?php echo $_POST['sift']; ?>">
    <input name="bs" type="hidden" value="<?php echo $_POST['bs']; ?>">
    <input name="cetak" type="submit" value="cetak"> 
</form>
                            
                            
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