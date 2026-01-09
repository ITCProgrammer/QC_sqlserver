<html>
<head>
<title>:: Cetak MUTASI KAIN JADI</title>
<link href="../styles_cetak.css" rel="stylesheet" type="text/css">
<style>
input{
text-align:center;
border:hidden;
}
</style>
</head>
<body>

 
  <table width="100%" border="0" class="table-list1">
  <tr>
   <?php 
  	mysql_connect("192.168.0.3","root","itc0920");
    mysql_select_db("db_qc")or die("Gagal Koneksi");
	$lth=mysql_query("select pergerakan_stok.tgl_update as tanggal_update ,userid as user_packing ,no_mutasi 
from mutasi_kain
inner JOIN pergerakan_stok on pergerakan_stok.id=mutasi_kain.id_stok
where mutasi_kain.no_mutasi='$_GET[mutasi]'
GROUP BY no_mutasi");
	$rowlth=mysql_fetch_array($lth);	
	?>
   <div align="center"> <h2>MUTASI KAIN JADI</h2></div>
   <?php ?>
    <td colspan="21">
    <table width="100%"  class="table-list1">
  <tr>
    <td width="79%" ><b>Tanggal : <?php echo date("d F Y",strtotime($rowlth['tanggal_update']));?>  <br>GROUP SHIFT: <?php
 echo $rowlth['user_packing']; ?> <br> SHIFT : <?php 
  if(date("H:i:s",strtotime($rowlth['tanggal_update']))>="23:00:00" && date("H:i:s",strtotime($rowlth['tanggal_update']))<="06:59:59")
  {$rsift=3;}
  else if(date("H:i:s",strtotime($rowlth['tanggal_update']))>="07:00:00" && date("H:i:s",strtotime($rowlth['tanggal_update']))<="14:59:59"){$rsift=1;}
  else if(date("H:i:s",strtotime($rowlth['tanggal_update']))>="15:00:00" && date("H:i:s",strtotime($rowlth['tanggal_update']))<="22:59:59")
  {$rsift=2;}
 echo 
 $rsift;?> <br> No Mutasi : <?php echo $rowlth['no_mutasi'];?></b></td>
    <td width="21%"><table width="100%" border="0" class="table-list1">
      <tr>
        <td width="43%" scope="col">No Form</td>
        <td width="10%" scope="col">:</td>
        <td width="47%" scope="col">19-13 (A)</td>
      </tr>
      <tr>
        <td>No. Revisi</td>
        <td>:</td>
        <td>00</td>
      </tr>
      <tr>
        <td>Tgl. Terbit</td>
        <td>:</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
    
    
</td>
  </tr>
  <tr align="center" bgcolor="#CCCCCC">
    <td rowspan="2" bgcolor="#F5F5F5">No MC</td>
    <td rowspan="2" bgcolor="#F5F5F5">Langganan</td>
    <td rowspan="2" bgcolor="#F5F5F5">PO</td>
    <td rowspan="2" bgcolor="#F5F5F5">Order</td>
    <td rowspan="2" bgcolor="#F5F5F5">Jenis.......Kain</td>
    <td rowspan="2" bgcolor="#F5F5F5">No. Warna</td>
    <td rowspan="2" bgcolor="#F5F5F5">Warna</td>
    <td rowspan="2" bgcolor="#F5F5F5">L/Grm2</td>
    <td rowspan="2" bgcolor="#F5F5F5">Lot</td>
    <td rowspan="2" bgcolor="#F5F5F5">Jml. Roll</td>
    <td rowspan="2" bgcolor="#F5F5F5">Bruto (Kg)</td>
    <td colspan="3" bgcolor="#F5F5F5">Netto (KG)</td>
    <td rowspan="2" bgcolor="#F5F5F5">Yard</td>
    <td rowspan="2" bgcolor="#F5F5F5">No.Kartu Kerja</td>
    <td rowspan="2" bgcolor="#F5F5F5">Tempat</td>
    <td rowspan="2" bgcolor="#F5F5F5">Item</td>
  </tr>
  <tr align="center" bgcolor="#0099FF">
    <td bgcolor="#F5F5F5">Grade<br /> A+B</td>
    <td bgcolor="#F5F5F5">Grade <br /> C</td>
    <td bgcolor="#F5F5F5">Keterangan<br />(Grade C)</td>
    </tr>
 <?php
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
where mutasi_kain.no_mutasi='$_GET[mutasi]'
GROUP BY  pergerakan_stok.id, no_dok,sisa
ORDER BY pergerakan_stok.id ASC");
  while($row=mysql_fetch_array($sql))
  {	  		
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
	$row6=mysql_fetch_array($sql6);	  ?>
    <tr >
    <td><?php echo $row['no_mc'];?></td>
   
    <td><?php echo $row['pelanggan'];?></td>
    <td><?php echo substr($row['no_po'],0,13)." ".substr($row['no_po'],13,13)." ".substr($row['no_po'],26,13);?></td>
    <td><?php echo substr($row['no_order'],0,6)." ".substr($row['no_order'],6,10);?></td>
    <td><?php echo $row['jenis_kain'];?></td>
    <td><?php echo substr($row['no_warna'],0,7)." ".substr($row['no_warna'],7,20);?></td>
    <td><?php echo substr($row['warna'],0,7)." ".substr($row['warna'],7,20);?></td>
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
    <td>
  <?php echo substr($row['nokk'],0,7)." ".substr($row['nokk'],7,20);?>  
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
 
 <tr >
    <td bgcolor="#F5F5F5">&nbsp;</td>
  
    <td bgcolor="#F5F5F5">&nbsp;</td>
    <td bgcolor="#F5F5F5">&nbsp;</td>
    <td bgcolor="#F5F5F5">&nbsp;</td>
    <td bgcolor="#F5F5F5">&nbsp;</td>
    <td bgcolor="#F5F5F5">&nbsp;</td>
    <td bgcolor="#F5F5F5">&nbsp;</td>
    <td bgcolor="#F5F5F5">&nbsp;</td>
    <td bgcolor="#F5F5F5">&nbsp;</td>
    <td bgcolor="#F5F5F5">&nbsp;</td>
    <td bgcolor="#F5F5F5">&nbsp;</td>
    <td bgcolor="#F5F5F5">&nbsp;</td>
    <td bgcolor="#F5F5F5">&nbsp;</td>
    <td bgcolor="#F5F5F5">&nbsp;</td>
    <td bgcolor="#F5F5F5">&nbsp;</td>
    <td bgcolor="#F5F5F5">&nbsp;</td>
    <td bgcolor="#F5F5F5">&nbsp;</td>
    <td bgcolor="#F5F5F5">&nbsp;</td>
  </tr><tr bgcolor="#99FFFF">
    <td bgcolor="#FFFFFF">&nbsp;</td>
    
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td colspan="2" bgcolor="#FFFFFF">Meter</td>
    <td align="right" bgcolor="#FFFFFF"><?php echo number_format($totrolm); ?></td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">Meter</td>
    <td align="right" bgcolor="#FFFFFF"><?php echo number_format($kartot,'2','.',','); ?></td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr bgcolor="#99FFFF">
    <td bgcolor="#FFFFFF">&nbsp;</td>
    
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td colspan="2" bgcolor="#FFFFFF">Yard</td>
    <td align="right" bgcolor="#FFFFFF"><?php echo  number_format($totroly);?></td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">Yard</td>
    <td align="right" bgcolor="#FFFFFF"><?php echo  number_format($pltot,'2','.',',');?></td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr bgcolor="#99FFFF">
    <td bgcolor="#FFFFFF">&nbsp;</td>
    
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td colspan="2" bgcolor="#FFFFFF"><b>Total</b></td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td align="right" bgcolor="#FFFFFF"><?php echo $totrol;?><b></td>
    <td align="right" bgcolor="#FFFFFF"><b><?php echo number_format($totbruto,'2','.',',');?></b></td>
    <td align="right" bgcolor="#FFFFFF"><b><?php echo number_format($totab,'2','.',',');?></b></td>
    <td align="right" bgcolor="#FFFFFF"><b><?php echo number_format($tota,'2','.',',');?></b></td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td align="right" bgcolor="#FFFFFF">&nbsp;</td>
    
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
  </tr>  
  
  <tr>
    <td colspan="21">&nbsp;</td>
  </tr> 
  </table> 
   <table width="100%" border="0" class="table-list1"> 
  <tr align="center">
    <td colspan="3">&nbsp;</td>
    <td colspan="8">Departemen QCF</td>
    <td colspan="10">Departemen Gudang Kain Jadi</td>
  </tr>
  <tr align="center">
    <td colspan="3">&nbsp;</td>
    <td colspan="3">Diserahkan Oleh :</td>
    <td colspan="5">Diketahui Oleh :</td>
    <td colspan="6">Diterima Oleh :</td>
    <td colspan="4"> Diketahui Oleh :</td>
  </tr>
  <tr>
    <td colspan="3">Nama</td>
    <td colspan="3" align="center"><input type=text name=nama placeholder="Ketik disini"></td>
    <td colspan="5" align="center"><input type=text name=nama1 placeholder="Ketik disini"></td>
    <td colspan="6">&nbsp;</td>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">Jabatan</td>
    <td colspan="3" align="center"><input type=text name=nama2 placeholder="Ketik disini"></td>
    <td colspan="5" align="center"><input type=text name=nama3 placeholder="Ketik disini"></td>
    <td colspan="6">&nbsp;</td>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">Tanggal</td>
    <td colspan="3" align="center"><?php echo date("d-M-Y"); ?></td>
    <td colspan="5" align="center"><?php echo date("d-M-Y"); ?></td>
    <td colspan="6">&nbsp;</td>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" height="60" valign="top">Tanda Tangan</td>
    <td colspan="3"><p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p></td>
    <td colspan="5">&nbsp;</td>
    <td colspan="6">&nbsp;</td>
    <td colspan="4">&nbsp;</td>
  </tr>
</table>
<script>
alert('cetak');window.print();
</script>                          

</body>
                            
                            
      