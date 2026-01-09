 
   <!--
    Created by Artisteer v2.3.0.21098
    Base template (without user's data) checked by http://validator.w3.org : "This page is valid XHTML 1.0 Transitional"
    -->
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
    <td colspan="20" align="center"><b>BUKTI MUTASI KAIN</b></td>
  </tr>
  <tr>
  <?php $tgl_cetak1= $_POST['awal'];
   if($_POST['sift']=="3"){$tgl_cetak2=date("Y-m-d",strtotime ( '1 day' , strtotime ($tgl_cetak1)));}else{$tgl_cetak2= $_POST['awal'];} ?>
    <td colspan="22"><b>Tanggal : <?php echo  date("d-M-Y", strtotime($tgl_cetak1))." s/d ".date("d-M-Y", strtotime($tgl_cetak2)); ?> <br>GROUP SHIFT: <?php echo $_POST['user_name']; ?> <br> SHIFT : <?php echo $_POST['sift'];?></b></td>
  </tr>
  <tr align="center" bgcolor="#0099FF">
    <td rowspan="2"><input type="checkbox" name="allbox" value="check" onClick="checkAll(0);" /><font color="red">Pilih Semua</font></td>
    <td rowspan="2">No MC</td>
    <td rowspan="2">Tanggal</td>
    <td rowspan="2">Langganan</td>
    <td rowspan="2" width="15">PO</td>
    <td rowspan="2" width="15">Order</td>
    <td rowspan="2">Jenis__Kain</td>
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

	if(substr($_POST['user_name'],0,6)=="INSPEK"){$ket=" and detail_pergerakan_stok.ket!=''";}else{$ket=" and detail_pergerakan_stok.ket=''";}
  if($_POST['sift']=="1"){	  
  $sql=mysql_query("select pergerakan_stok.id,bruto,satuan,
no_mc,pelanggan,pergerakan_stok.no_po,pergerakan_stok.no_order,tgl_update,
jenis_kain,no_warna,warna,no_item,no_lot,
lebar,berat,detail_pergerakan_stok.nokk,grade,
detail_pergerakan_stok.ket,count(yard_) as tot_rol,sum(yard_) as tot_yard ,
sum(weight) as tot_qty,sisa
from pergerakan_stok 
inner join detail_pergerakan_stok on pergerakan_stok.id=detail_pergerakan_stok.id_stok 
inner join tbl_kite on tbl_kite.nokk=detail_pergerakan_stok.nokk
WHERE tgl_update
BETWEEN '$tgl_cetak1 07:00:00'
AND '$tgl_cetak2 14:59:59'
AND tbl_kite.user_packing = '$_POST[user_name]' ".$ket."
GROUP BY  pergerakan_stok.id, no_dok,sisa
ORDER BY pergerakan_stok.id ASC");}else if($_POST['sift']=="2"){
	  
	  $sql=mysql_query("select pergerakan_stok.id,bruto,satuan,
no_mc,pelanggan,pergerakan_stok.no_po,pergerakan_stok.no_order,tgl_update,
jenis_kain,no_warna,warna,no_item,no_lot,
lebar,berat,detail_pergerakan_stok.nokk,grade,
detail_pergerakan_stok.ket,count(yard_) as tot_rol,sum(yard_) as tot_yard ,
sum(weight) as tot_qty,sisa
from pergerakan_stok 
inner join detail_pergerakan_stok on pergerakan_stok.id=detail_pergerakan_stok.id_stok 
inner join tbl_kite on tbl_kite.nokk=detail_pergerakan_stok.nokk
WHERE tgl_update
BETWEEN '$tgl_cetak1 15:00:00'
AND '$tgl_cetak2 22:59:59'
AND tbl_kite.user_packing = '$_POST[user_name]' ".$ket."
GROUP BY  pergerakan_stok.id, no_dok,sisa
ORDER BY pergerakan_stok.id ASC");
	  
	  }else{
	$sql=mysql_query("select pergerakan_stok.id,bruto,satuan,
no_mc,pelanggan,pergerakan_stok.no_po,pergerakan_stok.no_order,tgl_update,
jenis_kain,no_warna,warna,no_item,no_lot,
lebar,berat,detail_pergerakan_stok.nokk,grade,
detail_pergerakan_stok.ket,count(yard_) as tot_rol,sum(yard_) as tot_yard ,
sum(weight) as tot_qty,sisa
from pergerakan_stok 
inner join detail_pergerakan_stok on pergerakan_stok.id=detail_pergerakan_stok.id_stok 
inner join tbl_kite on tbl_kite.nokk=detail_pergerakan_stok.nokk
WHERE tgl_update
BETWEEN '$tgl_cetak1 23:00:00'
AND '$tgl_cetak2 06:59:59'
AND tbl_kite.user_packing = '$_POST[user_name]' ".$ket."
GROUP BY  pergerakan_stok.id, no_dok,sisa
ORDER BY pergerakan_stok.id ASC");	  
		  
		 }
  $c=0;
  $n=1;
  while($row=mysql_fetch_array($sql))
  {
	  $cek=mysql_query("select * from mutasi_kain
		where id_stok='$row[id]' limit 1 ");
		   $crow=mysql_fetch_array($cek);
	  if($crow>0){}else{ 
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
	
	  ?>
    <tr bgcolor="<?php echo $bgcolor; ?>">
      <td><?php
   
     echo '<input type="checkbox" name="check['.$n.']" value="'.$row['id'].'" /> - Pilihan / opsi ke '.$n;
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
    <td align="right">
      <?php echo number_format($row['tot_yard'],'2','.',',')." ".$row['satuan']; ?></td>
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
    <td align="right"><b><?php echo number_format($totab,'2','.',',');?></b></td>
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