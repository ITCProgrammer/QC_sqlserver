<?php 
ini_set("error_reporting",1);
include("../../koneksi.php");
?>
<html>
<head>
<title>:: Cetak MUTASI KAIN BS</title>
<link href="../styles_cetak.css" rel="stylesheet" type="text/css">
<style>
input{
text-align:center;
border:hidden;
}
@media print {
  ::-webkit-input-placeholder { /* WebKit browsers */
      color: transparent;
  }
  :-moz-placeholder { /* Mozilla Firefox 4 to 18 */
      color: transparent;
  }
  ::-moz-placeholder { /* Mozilla Firefox 19+ */
      color: transparent;
  }
  :-ms-input-placeholder { /* Internet Explorer 10+ */
      color: transparent;
  }
  ::-webkit-textarea-placeholder { /* WebKit browsers */
      color: transparent;
  }
  :-moz-textarea-placeholder { /* Mozilla Firefox 4 to 18 */
      color: transparent;
  }
  ::-moz-textarea-placeholder { /* Mozilla Firefox 19+ */
      color: transparent;
  }
  :-ms-textarea-placeholder { /* Internet Explorer 10+ */
      color: transparent;
  }
 textarea {
  background: transparent;
  color: white;
  border: 0 none;
  } 
}
</style>
<link rel="icon" type="image/png" href="../../images/icon.png">
</head>
<body>

 
  <table width="100%" border="0" class="table-list1">
  <tr>
   <?php   	
	$lth=sqlsrv_query($con,"select pergerakan_stok.tgl_update as tanggal_update ,pergerakan_stok.userid as user_packing ,mutasi_kain.no_mutasi 
from mutasi_kain
inner JOIN pergerakan_stok on pergerakan_stok.id=mutasi_kain.id_stok
where mutasi_kain.no_mutasi='$_GET[mutasi]'
GROUP BY no_mutasi");
	$rowlth=sqlsrv_fetch_array($lth);	
	?>
   <div align="center"> <h2>MUTASI KAIN BS(WASTE)</h2></div>
   <?php ?>
    <td colspan="21"><table width="100%"  class="table-list1">
      <tr>
        <td width="79%" ><b>Tanggal : <?php if($rowlth['tanggal_update']!=""){ echo date("d F Y",strtotime($rowlth['tanggal_update']));}?> <br>
          <br>
          No Mutasi : <?php echo $rowlth['no_mutasi'];?></b></td>
        <td width="21%"><table width="100%" border="0" class="table-list1">
          <tr>
            <td width="43%" scope="col">No Form</td>
            <td width="10%" scope="col">:</td>
            <td width="47%" scope="col">19-02</td>
          </tr>
          <tr>
            <td>No. Revisi</td>
            <td>:</td>
            <td>03</td>
          </tr>
          <tr>
            <td>Tgl. Terbit</td>
            <td>:</td>
            <td>02 Januari 2018</td>
          </tr>
        </table></td>
      </tr>
    </table></td>
    </tr>
  <tr align="center" bgcolor="#CCCCCC" nowrap>
    <td width="69" bgcolor="#F5F5F5">Langganan</td>
    <td width="22" bgcolor="#F5F5F5">PO</td>
    <td width="39" bgcolor="#F5F5F5">Order</td>
    <td width="95" bgcolor="#F5F5F5" style="width:1in;">Jenis Kain</td>
    <td width="63" bgcolor="#F5F5F5">No. Warna</td>
    <td width="43" bgcolor="#F5F5F5">Warna</td>
    <td width="49" bgcolor="#F5F5F5">L/Grm<sup>2</sup></td>
    <td width="22" bgcolor="#F5F5F5">Lot</td>
    <td width="28" bgcolor="#F5F5F5"style="width:0.05in;">Jml. Roll</td>
    <td width="64" bgcolor="#F5F5F5">Netto (KG)</td>
    <td width="82" bgcolor="#F5F5F5">Kategori BS</td>
    <td width="104" bgcolor="#F5F5F5">Penanggung Jawab</td>
    <td width="114" bgcolor="#F5F5F5">Masalah</td>
    <td width="91" bgcolor="#F5F5F5">No.Kartu Kerja</td>
    <td width="49" bgcolor="#F5F5F5">Tempat</td>
    <td width="95" bgcolor="#F5F5F5">No Waste</td>
    <td width="99" bgcolor="#F5F5F5">Ket</td>
  </tr>
  <?php
 $usr=substr($rowlth['user_packing'],0,3);
 if($usr=="INS" or $usr=="ins"){$kt="AND detail_pergerakan_stok.ket='INSPEK'"; $ktc="INSPEK"; $usr1="INS";}elseif($usr=="KRA" or $usr=="kra"){$kt=""; $ktc="";$usr1="KRA";}else{$kt=""; $ktc="";$usr1="PAC";}
 $sql=sqlsrv_query($con,"select pergerakan_stok.id,bruto,satuan,pergerakan_stok.no_mutasi,
no_mc,pelanggan,tbl_kite.no_po,tbl_kite.no_order,tgl_update,
jenis_kain,no_warna,warna,no_item,no_lot,tbl_kite.user_packing,
lebar,berat,detail_pergerakan_stok.nokk,grade,
detail_pergerakan_stok.ket,count(yard_) as tot_rol,sum(yard_) as tot_yard ,
sum(weight) as tot_qty,
SUM(case when grade='A' or grade='B' or grade='' then weight else 0 end) as grd_ab,
SUM(case when grade='C' then weight else 0 end) as grd_c,
SUM(if(grade='A' or grade='B' or grade='', 1, 0)) as jml_ab,
SUM(if(grade = 'C', 1, 0)) as jml_grd_c,
sisa
from pergerakan_stok 
inner join detail_pergerakan_stok on pergerakan_stok.id=detail_pergerakan_stok.id_stok 
inner join tbl_kite on tbl_kite.nokk=detail_pergerakan_stok.nokk
where pergerakan_stok.no_mutasi='$_GET[mutasi]' and tbl_kite.user_packing like '%$usr1%' $kt
GROUP BY  pergerakan_stok.id, no_dok,sisa
ORDER BY pergerakan_stok.id ASC");
$totqty=0;
$totqty1=0;
$grab=0;
$grc=0;	
  while($row=sqlsrv_fetch_array($sql))
  {	 
  	$sqlket=sqlsrv_query($con,"select nokk,ket_c,sisa from detail_pergerakan_stok where nokk ='$row[nokk]' and ket_c !='' and sisa !='TH' and sisa !='FKTH' and grade='C'
GROUP BY ket_c");
$rowket=sqlsrv_fetch_array($sqlket);
	
	?>
    <tr >
    <td><?php echo $row['pelanggan'];?></td>
    <td><?php echo substr($row['no_po'],0,13)." ".substr($row['no_po'],13,13)." ".substr($row['no_po'],26,13);?></td>
    <td><?php echo substr($row['no_order'],0,6)." ".substr($row['no_order'],6,10);?></td>
    <td><?php echo $row['jenis_kain'];?></td>
    <td><?php echo substr($row['no_warna'],0,7)." ".substr($row['no_warna'],7,20);?></td>
    <td><?php echo substr($row['warna'],0,7)." ".substr($row['warna'],7,20);?></td>
    <td><?php if($rowlth['user_packing']=="KRAH"){echo "<center>-</center>";}else{echo $row['lebar']."/".$row['berat'];}?> </td>
    <td><?php echo $row['no_lot'];?></td>
    <td align="right"><?php $rol=$row['tot_rol'];if(($row['jml_grd_c']>0) and ($row['jml_ab']>0)){$rol1=$row['jml_ab']."+".$row['jml_grd_c'];}else if($row['jml_grd_c']>0){$rol1=$row['jml_grd_c'];}else{$rol1=$row['jml_ab'];}
	echo $rol1;
	?></td>
    <td align="right"><?php	echo number_format($row['grd_ab']+$row['grd_c'],'2','.',',');?></td>
    <td align="center" valign="top"><textarea name="nama4" cols="5" rows="3" placeholder="Ketik disini"></textarea></td>
    <td align="center" valign="top"><textarea name="nama5" cols="10" rows="3" placeholder="Ketik disini"></textarea></td>
    <td align="center" valign="top"><textarea name="nama6" cols="13" rows="3" placeholder="Ketik disini"></textarea></td>
    <td>
  <?php echo substr($row['nokk'],0,7)." ".substr($row['nokk'],7,20);?>  
    </td>
    <td>&nbsp;</td>
    <td><textarea name="nama7" cols="13" rows="3" placeholder="Ketik disini"></textarea></td>
    <td><textarea name="nama8" cols="13" rows="3" placeholder="Ketik disini"></textarea></td>
  </tr>
 
      <?php
	 if($row['sisa']=="SISA" || $row['sisa']=="FKSI" || $row['sisa']=="FOC"){$brtoo=0;}else{$brtoo=$row['bruto'];}
	 $grdab=$grab;
	 $grdc=$grc;
	 $totbruto=$totbruto+$brtoo;
	  $totyard=$totyard+$row['tot_yard'];
	  $totrol=$totrol+$rol;
	  $totqty=$totqty+$row['grd_ab'];
	  $totqty1=$totqty1+$row['grd_c'];
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
  </tr>
  <tr bgcolor="#99FFFF">
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td colspan="3" bgcolor="#FFFFFF"><b>Total</b></td>
    <td align="right" bgcolor="#FFFFFF"><?php echo $totrol;?><b></td>
    <td align="right" bgcolor="#FFFFFF"><b><?php echo number_format($totqty+$totqty1,'2','.',',');?></b></td>
    <td align="right" bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td align="right" bgcolor="#FFFFFF">&nbsp;</td>
    
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
  </tr>  
  
  <tr>
    <td colspan="17">&nbsp;</td>
    </tr> 
  </table> 
   <table width="100%" border="0" class="table-list1"> 
  <tr align="center">
    <td colspan="3">&nbsp;</td>
    <td colspan="8" >Departemen :</td>
    <td width="16%" rowspan="2">Disetujui Oleh :</td>
    <td colspan="5">Departemen Gudang Kain Jadi BS</td>
    </tr>
  <tr align="center">
    <td colspan="3">&nbsp;</td>
    <td colspan="3">Diserahkan Oleh :</td>
    <td colspan="5">Diketahui Oleh :</td>
    <td width="21%">Diterima Oleh :</td>
    <td width="21%" colspan="4"> Diketahui Oleh :</td>
  </tr>
  <tr>
    <td colspan="3">Nama</td>
    <td colspan="3" align="center"><input type=text name="nama" placeholder="Ketik disini"></td>
    <td colspan="5" align="center"><input type=text name="nama1" placeholder="Ketik disini"></td>
    <td align="center"><input type=text name="nama3" placeholder="Ketik disini"></td>
    <td>&nbsp;</td>
    <td colspan="4" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">Jabatan</td>
    <td colspan="3" align="center"><input type=text name="nama2" placeholder="Ketik disini"></td>
    <td colspan="5" align="center"><input type=text name="nama9" placeholder="Ketik disini"></td>
    <td align="center"><input type=text name="nama10" placeholder="Ketik disini"></td>
    <td align="center">&nbsp;</td>
    <td colspan="4" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">Tanggal</td>
    <td colspan="3" align="center"><?php if($rowlth['tanggal_update']!=""){ echo date("d F Y",strtotime($rowlth['tanggal_update']));}?></td>
    <td colspan="5" align="center"><?php if($rowlth['tanggal_update']!=""){ echo date("d F Y",strtotime($rowlth['tanggal_update']));}?></td>
    <td align="center"><?php if($rowlth['tanggal_update']!=""){ echo date("d F Y",strtotime($rowlth['tanggal_update']));}?></td>
    <td align="center"><?php if($rowlth['tanggal_update']!=""){ echo date("d F Y",strtotime($rowlth['tanggal_update']));}?></td>
    <td colspan="4" align="center"><?php if($rowlth['tanggal_update']!=""){ echo date("d F Y",strtotime($rowlth['tanggal_update']));}?></td>
  </tr>
  <tr>
    <td colspan="3" height="60" valign="top">Tanda Tangan</td>
    <td colspan="3"><p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p></td>
    <td colspan="5">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="4">&nbsp;</td>
  </tr>
</table>
                          

Lembar asli untuk departement QCF
<script>
alert('cetak');window.print();
</script>
</body>
                            
                            
      