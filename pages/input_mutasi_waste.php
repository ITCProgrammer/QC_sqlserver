<?php 
ini_set("error_reporting",1);
include("../koneksi.php");
?>
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
 function myFungsi() {
 		var kategori_bs = document.getElementById('kategori_bs').value;
 		var p_jawab = document.getElementById('p_jawab').value;
    var masalah_bs = document.getElementById('masalah_bs').value;
 			if(kategori_bs==null || kategori_bs=="")
         {
           alert("Kategori BS Belum Diisi!");
           return false;
         }else
 		  if(p_jawab==null || p_jawab=="")
         {
             alert("Penanggung Jawab Belum Diisi!");
             return false;
         }else
       if(masalah_bs==null || masalah_bs=="")
         {
             alert("Masalah BS Belum Diisi!");
             return false;
         }
 			if($('input:checked').length > 0)
     		{ alert("Anda Belum ceklist data");
         		return false; } else {
         		alert("Anda Belum ceklist data");
         		return false;
     		}	
 }
// function myFungsi(){
//   $(document).ready(function () {
//       var kategori_bs = $.trim($("kategori_bs").val());
//       var p_jawab = $.trim($("p_jawab").val());
//       var masalah_bs = $.trim($("masalah_bs").val());
//       if (kategori_bs == "") {
//           alert("Kategori BS Belum Diisi!");
//       }else
//       if (p_jawab == "") {
//           alert("Penanggung Jawab Belum Diisi!");
//       }else
//       if (masalah_bs == "") {
//           alert("Masalah BS Belum Diisi!");
//       }
//       if($('input:checked').length > 0)
// 	    { alert("Anda Belum ceklist data");
//         return false; } else {
//         alert("Anda Belum ceklist data");
//         return false;
//       }	
//     });
// }				

</script>
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
.warnaa {
	color: #808040;
	
}
.blink { -webkit-animation: blink .75s linear infinite; -moz-animation: blink .75s linear infinite; -ms-animation: blink .75s linear infinite; -o-animation: blink .75s linear infinite; animation: blink .75s linear infinite; } @-webkit-keyframes blink { 0% { opacity: 1; } 50% { opacity: 1; } 50.01% { opacity: 0; } 100% { opacity: 0; } } @-moz-keyframes blink { 0% { opacity: 1; } 50% { opacity: 1; } 50.01% { opacity: 0; } 100% { opacity: 0; } } @-ms-keyframes blink { 0% { opacity: 1; } 50% { opacity: 1; } 50.01% { opacity: 0; } 100% { opacity: 0; } } @-o-keyframes blink { 0% { opacity: 1; } 50% { opacity: 1; } 50.01% { opacity: 0; } 100% { opacity: 0; } } @keyframes blink { 0% { opacity: 1; } 50% { opacity: 1; } 50.01% { opacity: 0; } 100% { opacity: 0; } }

</style>
<link rel="icon" type="image/png" href="../images/icon.png">
</head>
<body>
<form  action="simpan-input-waste.php" method="POST" name="form1" id="form1"  onSubmit="return myFungsi();">
    <div id="art-main">
      <div class="art-Sheet-bl"></div>
            <div class="art-Sheet-br"></div>
            <input type="button" class="art-button" onClick="window.location.href='../index_login.php?act=logout'" value="Logout"/>
                            <?php if($_SESSION['status']==0){ ?><input type="button" class="art-button" onClick="window.location.href='../index1.php'" value="Home"/><input type="button" class="art-button" onClick="window.location.href='../index1.php?p=laporan_harian_kain'" value="Laporan"/><br /><?php } ?>
                       
                        
<table width="100%" align="center">
  <tr>
    <td width="100%" align="center"><b>INPUT DATA WASTE</b></td>
  </tr>
  <tr>
   <?php $tgl_cetak1=$_POST['awal'];?>
    <td width="100%"><b>No Mutasi : <?php echo $_GET['mutasi'];?></b></td>
  </tr>
  <tr>
  <td align="left"><input type="hidden" name="no_mutasi" value="<?php echo $_GET['mutasi'];?>"/></td>
  </tr>
</table>
<?php
$sql=sqlsrv_query($con,"select a.id,bruto,satuan,a.no_mutasi,
no_mc,pelanggan,d.no_po,d.no_order,tgl_update,
jenis_kain,no_warna,warna,no_item,no_lot,d.user_packing,
lebar,berat,c.nokk,grade,
c.ket,count(yard_) as tot_rol,sum(yard_) as tot_yard ,
sum(weight) as tot_qty,
SUM(case when grade='A' or grade='B' or grade='' then weight else 0 end) as grd_ab,
SUM(case when grade='C' then weight else 0 end) as grd_c,
SUM(if(grade='A' or grade='B' or grade='', 1, 0)) as jml_ab,
SUM(if(grade = 'C', 1, 0)) as jml_grd_c,
sisa,b.kategori_bs,b.p_jawab,b.masalah_bs,b.no_waste,b.ket_bs
from pergerakan_stok a
inner join mutasi_kain b on a.id=b.id_stok
inner join detail_pergerakan_stok c on a.id=c.id_stok 
inner join tbl_kite d on d.nokk=c.nokk
where a.no_mutasi='".$_GET['mutasi']."'
GROUP BY  pergerakan_stok.id, no_dok,sisa
ORDER BY pergerakan_stok.id ASC");
?>
<table width="100%" border="1" class="table-list1">
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
    <td width="82" bgcolor="#F5F5F5">Penanggung Jawab</td>
    <td width="90" bgcolor="#F5F5F5">Masalah</td>
    <td width="91" bgcolor="#F5F5F5">No.Kartu Kerja</td>
    <td width="49" bgcolor="#F5F5F5">Tempat</td>
    <td width="95" bgcolor="#F5F5F5">No Waste</td>
    <td width="50" bgcolor="#F5F5F5">Ket</td>
    <td width="12%"><input type="checkbox" name="allbox" value="check" onClick="checkAll(0);" /><font color="red">Pilih Semua</font></td>
    <!-- <td width="50" bgcolor="#F5F5F5">Test</td> -->
  </tr>
  <?php
 $sql=sqlsrv_query($con,"SELECT a.id,b.id AS idb,bruto,satuan,a.no_mutasi,
 no_mc,pelanggan,d.no_po,d.no_order,tgl_update,
 jenis_kain,no_warna,warna,no_item,no_lot,d.user_packing,
 lebar,berat,c.nokk,grade,
 c.ket,COUNT(yard_) AS tot_rol,SUM(yard_) AS tot_yard ,
 SUM(weight) AS tot_qty,
 SUM(CASE WHEN grade='A' OR grade='B' OR grade='' THEN weight ELSE 0 END) AS grd_ab,
 SUM(CASE WHEN grade='C' THEN weight ELSE 0 END) AS grd_c,
 SUM(IF(grade='A' OR grade='B' OR grade='', 1, 0)) AS jml_ab,
 SUM(IF(grade = 'C', 1, 0)) AS jml_grd_c,
 sisa,b.kategori_bs,b.p_jawab,b.masalah_bs,b.no_waste,b.ket_bs,b.tempat_bs
 FROM pergerakan_stok a
 INNER JOIN mutasi_kain b ON a.id=b.id_stok
 INNER JOIN detail_pergerakan_stok c ON a.id=c.id_stok 
 INNER JOIN tbl_kite d ON d.nokk=c.nokk
 WHERE b.no_mutasi='".$_GET['mutasi']."'
 GROUP BY  a.id, no_dok,sisa
 ORDER BY a.id ASC");
$totqty=0;
$totqty1=0;
$grab=0;
$grc=0;
$n=1;	
  while($row=sqlsrv_fetch_array($sql))
  {	 
  	$sqlket=sqlsrv_query($con,"select nokk,ket_c,sisa from detail_pergerakan_stok where nokk ='".$row['nokk']."' and ket_c !='' and sisa !='TH' and sisa !='FKTH' and grade='C'
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
    <td align="center" valign="top"><textarea name="kategori_bs[]" id="kategori_bs" cols="5" rows="3" placeholder="Ketik disini"><?php echo $row['kategori_bs'];?></textarea></td>
    <td align="center" valign="top"><textarea name="p_jawab[]" id="p_jawab" cols="8" rows="3" placeholder="Ketik disini"><?php echo $row['p_jawab'];?></textarea></td>
    <td align="center" valign="top"><textarea name="masalah_bs[]" id="masalah_bs" cols="10" rows="3" placeholder="Ketik disini"><?php echo $row['masalah_bs'];?></textarea></td>
    <td>
  <?php echo substr($row['nokk'],0,7)." ".substr($row['nokk'],7,20);?>  
    </td>
    <td align="center" valign="top"><textarea name="tempat_bs[]" id="tempat_bs" cols="8" rows="3" placeholder="Ketik disini"><?php echo $row['tempat_bs'];?></textarea></td>
    <td align="center" valign="top"><textarea name="no_waste[]" id="no_waste" cols="8" rows="3" placeholder="Ketik disini"><?php echo $row['no_waste'];?></textarea></td>
    <td align="center" valign="top"><textarea name="ket_bs[]" id="ket_bs" cols="10" rows="3" placeholder="Ketik disini"><?php echo $row['ket_bs'];?></textarea></td>
    <td align="center"><input type="checkbox" name="check[]" value="<?php echo $row['idb']; ?>"/></td>
    <!-- <td align="center"><input type="text" name="test" value="<?php echo $row['idb']; ?>"/></td> -->
    <!-- <td align="center"><?php
      echo '<input type="checkbox" name="check['.$n.']" value="'.$row['idb'].'">';
      $n++;?>
    </td> -->
  </tr>
 
      <?php
    $n++;
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
</table>
<p>
   <input type="submit" name="submit" value="Save" class="art-button" />
  <input type="button" value="Back" onclick="location.href = document.referrer; return false;" class="art-button" />
</p>
</form>
</body>
</html>