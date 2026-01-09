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
  	mysql_connect("svr1","root","itc0920");
mysql_select_db("db_qc")or die("Gagal Koneksi");
	function mutasiurut(){
$format = date("Ymd");
$sql=mysql_query("SELECT no_mutasi FROM tbl_kite WHERE substr(no_mutasi,1,8) like '%".$format."%' ORDER BY no_mutasi DESC LIMIT 1 ") or die (mysql_error());
$d=mysql_num_rows($sql);
if($d>0){
$r=mysql_fetch_array($sql);
$d=$r['no_mutasi'];
$str=substr($d,8,2);
$Urut = (int)$str;
}else{
$Urut = 0;
}
$Urut = $Urut + 1;
$Nol="";
$nilai=2-strlen($Urut);
for ($i=1;$i<=$nilai;$i++){
$Nol= $Nol."0";
}
$nipbr =$format.$Nol.$Urut;
return $nipbr;
}
$no=mutasiurut();
	
	?>
   <div align="center"> <h2>MUTASI KAIN JADI</h2></div>
   <?php $tgl_cetak1= trim($_POST['thn1']."-".$_POST['bln1']."-".$_POST['tgl1']);
   	$tgl_cetak2= trim($_POST['thn2']."-".$_POST['bln2']."-".$_POST['tgl2']);?>
    <td colspan="21">
    <table width="100%"  class="table-list1">
  <tr>
    <td width="79%" ><b>Tanggal : <?php echo  date("d-M-Y", strtotime($_POST['tgl1']))." s/d ".date("d-M-Y", strtotime($_POST['tgl2'])); ?> <br>GROUP SHIFT: <?php echo $_POST['user_name']; ?> <br> SHIFT : <?php echo $_POST['sift'];?> <br> No Mutasi : <?php echo $no;?></b></td>
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
    <td colspan="2" bgcolor="#F5F5F5">SISA</td>
    <td rowspan="2" bgcolor="#F5F5F5">Yard</td>
    <td rowspan="2" bgcolor="#F5F5F5">No.Kartu Kerja</td>
    <td rowspan="2" bgcolor="#F5F5F5">Tempat</td>
    <td rowspan="2" bgcolor="#F5F5F5">Item</td>
  </tr>
  <tr align="center" bgcolor="#0099FF">
    <td bgcolor="#F5F5F5">Grade<br /> A+B</td>
    <td bgcolor="#F5F5F5">Grade <br /> C</td>
    <td bgcolor="#F5F5F5">Keterangan<br />(Grade C)</td>
    <td bgcolor="#F5F5F5">Jml. Roll</td>
    <td bgcolor="#F5F5F5">Qty(KG)</td>
    </tr>
 <?php
 if(substr($_POST['user_name'],0,6)=="INSPEK"){$ket=" and ket!=''";}else{$ket=" and ket=''";}
  if($_POST['sift']=="1"){
  $sql=mysql_query("SELECT * , tbl_kite.id, sum( detail_kite.yard_ ) AS yard_, count( detail_kite.yard_ ) AS roll, sum( detail_kite.net_wight ) AS bruto1
FROM tbl_kite
INNER JOIN detail_kite ON detail_kite.nokkKite = tbl_kite.nokk
WHERE tanggal_update
BETWEEN '$_POST[tgl1] 07:00:00'
AND '$_POST[tgl2] 14:59:59'
AND tbl_kite.user_packing = '$_POST[user_name]' ".$ket."
AND tbl_kite.no_mutasi = ''
GROUP BY tbl_kite.id
ORDER BY tbl_kite.id ASC");}else if($_POST['sift']=="2"){
	  
	  $sql=mysql_query("SELECT * , tbl_kite.id, sum( detail_kite.yard_ ) AS yard_, count( detail_kite.yard_ ) AS roll, sum( detail_kite.net_wight ) AS bruto1
FROM tbl_kite
INNER JOIN detail_kite ON detail_kite.nokkKite = tbl_kite.nokk
WHERE tanggal_update
BETWEEN '$_POST[tgl1] 15:00:00'
AND '$_POST[tgl2] 22:59:59'
AND tbl_kite.user_packing = '$_POST[user_name]' ".$ket."
AND tbl_kite.no_mutasi = ''
GROUP BY tbl_kite.id
ORDER BY tbl_kite.id ASC");
	  
	  }else{
	$sql=mysql_query("SELECT * , tbl_kite.id, sum( detail_kite.yard_ ) AS yard_, count( detail_kite.yard_ ) AS roll, sum( detail_kite.net_wight ) AS bruto1
FROM tbl_kite
INNER JOIN detail_kite ON detail_kite.nokkKite = tbl_kite.nokk and ket=''
where tanggal_update
BETWEEN '$_POST[tgl1] 23:00:00'
AND '$_POST[tgl2] 06:59:59'
AND tbl_kite.user_packing = '$_POST[user_name]' ".$ket."
AND tbl_kite.no_mutasi = ''
GROUP BY tbl_kite.id
ORDER BY tbl_kite.id ASC");	   
		  
		 }
  $n=1;
  while($row=mysql_fetch_array($sql))
  {
 if($_POST['check'][$n]==$n)
		  {
			  
			  		
		mysql_query("Update tbl_kite SET no_mutasi='$no' where id='$row[id]'")or die("Gagal");  
	  $n++;
	  	 $sql1=mysql_query("SELECT sum(detail_kite.net_wight) as grd_c
FROM tbl_kite inner join detail_kite on detail_kite.nokkKite=tbl_kite.nokk
WHERE tbl_kite.id='$row[id]' and grade='C'
GROUP BY tbl_kite.id
ORDER BY tbl_kite.id ASC");
		 $row1=mysql_fetch_array($sql1);
		 
		 $sql2=mysql_query("SELECT sum(detail_kite.net_wight) as grd_a_b
FROM tbl_kite inner join detail_kite on detail_kite.nokkKite=tbl_kite.nokk
WHERE tbl_kite.id='$row[id]' and grade between 'A' and 'B'
GROUP BY tbl_kite.id
ORDER BY tbl_kite.id ASC");
$row2=mysql_fetch_array($sql2);
$sql4=mysql_query("SELECT *, sum(detail_kite.net_wight) as qty,count(detail_kite.sisa) as jml , grade
FROM tbl_kite
INNER JOIN detail_kite ON detail_kite.nokkKite = tbl_kite.nokk
WHERE (sisa = 'SISA' or sisa = 'FKSI')
AND nokkKite = '$row[nokk]'
GROUP BY tbl_kite.id
ORDER BY tbl_kite.id ASC");
		 $row4=mysql_fetch_array($sql4);
		 $sql5=mysql_query("SELECT sum(detail_kite.net_wight) as grd_c
FROM tbl_kite inner join detail_kite on detail_kite.nokkKite=tbl_kite.nokk
WHERE tbl_kite.id='$row[id]' and grade='C' and
(sisa = 'SISA' or sisa = 'FKSI')
AND nokkKite = '$row[nokk]'
GROUP BY tbl_kite.id
ORDER BY tbl_kite.id ASC");
		 $row5=mysql_fetch_array($sql5);
		 
		 $sql6=mysql_query("SELECT sum(detail_kite.net_wight) as grd_a_b
FROM tbl_kite inner join detail_kite on detail_kite.nokkKite=tbl_kite.nokk
WHERE tbl_kite.id='$row[id]' and grade between 'A' and 'B' and (sisa = 'SISA' or sisa = 'FKSI')
AND nokkKite = '$row[nokk]'
GROUP BY tbl_kite.id
ORDER BY tbl_kite.id ASC");
$row6=mysql_fetch_array($sql6);	

$sql8=mysql_query("SELECT *, sum(detail_kite.net_wight) as qty, sum(detail_kite.yard_) as yrd12,count(detail_kite.ket) as jml , grade
FROM tbl_kite
INNER JOIN detail_kite ON detail_kite.nokkKite = tbl_kite.nokk
WHERE ket='INSPEK'
AND nokkKite = '$row[nokk]'
GROUP BY tbl_kite.id
ORDER BY tbl_kite.id ASC");
 $row8=mysql_fetch_array($sql8);
 
  $sql9=mysql_query("SELECT sum(detail_kite.net_wight) as grd_c
FROM tbl_kite inner join detail_kite on detail_kite.nokkKite=tbl_kite.nokk
WHERE tbl_kite.id='$row[id]' and grade='C' and ket='INSPEK'
GROUP BY tbl_kite.id
ORDER BY tbl_kite.id ASC");
 	$row9=mysql_fetch_array($sql9);
	
	$sqlextra=mysql_query("SELECT * , tbl_kite.id, sum( detail_kite.yard_ ) AS yard_, count( detail_kite.yard_ ) AS roll, sum( detail_kite.net_wight ) AS bruto1
FROM tbl_kite
INNER JOIN detail_kite ON detail_kite.nokkKite = tbl_kite.nokk
WHERE sisa='FOC' and nokk='$row[nokk]' and ket='$ket'

GROUP BY tbl_kite.id
ORDER BY tbl_kite.id ASC");
	$rowextra=mysql_fetch_array($sqlextra);	
	  ?>
    <tr >
    <td><?php echo $row['no_mc'];?></td>
   
    <td><?php echo $row['pelanggan'];?></td>
    <td><?php echo $row['no_po'];?></td>
    <td><?php echo $row['no_order'];?></td>
    <td><?php echo $row['jenis_kain'];?></td>
    <td><?php echo $row['no_warna'];?></td>
    <td><?php echo $row['warna'];?></td>
    <td><?php echo $row['lebar']."/".$row['berat'];?> </td>
    <td><?php echo $row['no_lot'];?></td>
    <td align="right"><?php if($row8['ket']!="" and substr($_POST['user_name'],0,6)=="INSPEK"){$rl=$row8['jml']-$row4['jml'];}else{$rl=$row['roll']-$row4['jml'];}
	echo $rl;
	?></td>
    <td align="right"><?php echo number_format($row['bruto'],'2','.',',');?></td>
    <td align="right"><?php if($row8['ket']!="" and substr($_POST['user_name'],0,6)=="INSPEK"){$grab= number_format($row8['qty']-$row9['grd_c'],'2','.',',');}else{
	
	if($row4['grade']=="A" || $row4['grade']=="B"){$grab= number_format($row2['grd_a_b']-$row6['grd_a_b'],'2','.',',');}else{$grab= number_format($row2['grd_a_b'],'2','.',',');} }
	echo $grab;
	?></td>
    <td align="right"><?php 
	if($row4['grade']=="C"){echo number_format($row2['grd_a_b']-$row5['grd_c'],'2','.',',');}else{
	echo number_format($row1['grd_c'],'2','.',',');}?></td>
    <td><?php if($rowextra['sisa']=="FOC"){echo "Ada EXTRA ".$rowextra['roll']." Roll"; }?></td>
    <td align="right"><?php if($row4>0){echo $row4['jml'];}else{echo "0";}?></td>
    <td align="right"><?php if($row4>0){echo number_format($row4['qty'],'2','.',',');}else{echo "0.00";}?></td>
    <td align="right"><?php if($row8['ket']!=""){$yrdmer=$row8['yrd12'];}else{ $yrdmer=$row['yard_'];}?>
      <?php echo number_format($yrdmer,'2','.',',')." ".$row['satuan']; ?></td>
    <td>
  <?php echo $row['nokk'];?>  
    </td>
    <td>&nbsp;</td>
    <td><?php echo $row['no_item'];?></td>
  </tr>
 
      <?php
	  $totbruto=$totbruto+$row['bruto'];
	  $totyard=$totyard+$yrdmer;
	  $totrol=$totrol+$rl;
	  $totab=$totab+$grab;
	  $tota=$tota+$row1['grd_c'];
	  	if($row['satuan']=='Meter')
		{$kartot=$kartot + $row['yard_']; $totkar = $totkar + $row['roll'];}
		if($row['satuan']=='Yard')
		{$pltot=$pltot + $yrdmer;   $totpl = $totpl + $rl;}
	  
	  }else{$n++;}
	  
	  
	  
	  }

echo "<script>alert('berhasil');window.open('cetak_mutasi_ulang.php?mutasi=$no','_blank');</script>";

echo "<script>window.location.href='../../index1.php?p=laporan_harian_mutasi'; </script>";
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
    <td align="right" bgcolor="#FFFFFF"><?php echo number_format($totkar); ?></td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">Meter</td>
    <td align="right" bgcolor="#FFFFFF">&nbsp;</td>
    <td align="right" bgcolor="#FFFFFF">&nbsp;</td>
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
    <td align="right" bgcolor="#FFFFFF"><?php echo  number_format($totpl);?></td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">Yard</td>
    <td align="right" bgcolor="#FFFFFF">&nbsp;</td>
    <td align="right" bgcolor="#FFFFFF">&nbsp;</td>
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
    <td align="right" bgcolor="#FFFFFF"><b><?php echo $totrol;?></td>
    <td align="right" bgcolor="#FFFFFF"><b><?php echo number_format($totbruto,'2','.',',');?></b></td>
    <td align="right" bgcolor="#FFFFFF"><b><?php echo number_format($totab,'2','.',',');?></b></td>
    <td align="right" bgcolor="#FFFFFF"><b><?php echo number_format($tota,'2','.',',');?></b></td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td align="right" bgcolor="#FFFFFF">&nbsp;</td>
    <td align="right" bgcolor="#FFFFFF">&nbsp;</td>
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
    <td colspan="3">&nbsp;</td>
    <td colspan="5">&nbsp;</td>
    <td colspan="6">&nbsp;</td>
    <td colspan="4">&nbsp;</td>
  </tr>
</table>                     

</body>
                            
                            
      