    <script>
  function roundToTwo(num) {    
    return +(Math.round(num + "e+2")  + "e-2");
}                
</script>
   
    <?php 
   	ini_set("error_reporting",1);
     include("koneksi.php"); 

  $sql1=mysqli_query($con,"SELECT *,tmp_detail_kite.yard_ as yard_, tmp_detail_kite.yard_ as roll, tmp_detail_kite.net_wight as bruto
FROM tbl_kite left join tmp_detail_kite on tmp_detail_kite.nokkKite=tbl_kite.nokk
WHERE tbl_kite.nokk='$_GET[id]'
AND (
	sisa != 'TH'
	AND sisa != 'FKTH'
	AND sisa != 'BS'
	AND sisa != 'BB'
)
ORDER BY tbl_kite.id ASC");
  $row1=mysqli_fetch_array($sql1);
  $jumlah=mysqli_num_rows($sql1);
   ?>
    <script>
   
          function ganti(id,thn1,bln1,hr1,thn2,bln2,hr2,sift)
{     var yrd= document.forms['form2']['yrd_'].value;  
var x,meter;
if(yrd=="meter"){
	window.location.href="index1.php?p=mutasi_detail_meter&id="+ id +"&tgl1="+ thn1 +"-"+ bln1 +"-"+ hr1 +"&tgl2="+ thn2 +"-"+ bln2 +"-"+ hr2 + "&sift="+ sift;
	}

}
           </script>  
      <div align="center"><b>BUKTI MUTASI KAIN DETAIL</b></div><div><b>Tanggal : <?php echo $_GET['tgl1']." s/d ".$_GET['tgl2']; ?> <br>GROUP SHIFT: <?php echo $_SESSION['username']; ?> <br> SHIFT : <?php echo $_GET['sift'];?><br>
      No Kartu Kerja : <?php echo $row1['nokk'];?><br>
      No Order :<?php echo $row1['no_order'];?><br>
      Pelanggan :<?php echo $row1['pelanggan'];
	$thn1=substr($_GET['tgl1'],0,4);
	$bln1=substr($_GET['tgl1'],5,2);
	$hr1=substr($_GET['tgl1'],8,2);
	$thn2=substr($_GET['tgl2'],0,4);
	$bln2=substr($_GET['tgl2'],5,2);
	$hr2=substr($_GET['tgl2'],8,2);?><br /></b></div>
      <?php 
	  if(substr($_GET['sift'],0,6)=="INSPEK"){
	  $ket=" and detail_pergerakan_stok.ket='INSPEK' ";}else if(substr($_GET['sift'],0,7)=="PACKING"){$ket=" and detail_pergerakan_stok.ket='' ";}else{$ket="";}
$sql=mysqli_query($con,"SELECT * FROM detail_pergerakan_stok
INNER JOIN  tmp_detail_kite on tmp_detail_kite.id = detail_pergerakan_stok.id_detail_kj
WHERE  nokk = '$_GET[id]'  
 $ket  AND (detail_pergerakan_stok.sisa!='TH' and detail_pergerakan_stok.sisa!='FKTH' and detail_pergerakan_stok.sisa!='BS' and detail_pergerakan_stok.sisa!='BB') group by detail_pergerakan_stok.no_roll
ORDER BY detail_pergerakan_stok.no_roll ASC limit 0,20"); 
$sql2=mysqli_query($con,"SELECT * FROM detail_pergerakan_stok 
INNER JOIN  tmp_detail_kite on tmp_detail_kite.id = detail_pergerakan_stok.id_detail_kj
WHERE  nokk = '$_GET[id]'  
 $ket AND (detail_pergerakan_stok.sisa!='TH' and detail_pergerakan_stok.sisa!='FKTH' and detail_pergerakan_stok.sisa!='BS' and detail_pergerakan_stok.sisa!='BB') group by detail_pergerakan_stok.no_roll
ORDER BY detail_pergerakan_stok.no_roll ASC limit 20,20"); 
$sql3=mysqli_query($con,"SELECT * FROM detail_pergerakan_stok 
INNER JOIN  tmp_detail_kite on tmp_detail_kite.id = detail_pergerakan_stok.id_detail_kj
WHERE  nokk = '$_GET[id]'  
 $ket AND (detail_pergerakan_stok.sisa!='TH' and detail_pergerakan_stok.sisa!='FKTH' and detail_pergerakan_stok.sisa!='BS' and detail_pergerakan_stok.sisa!='BB') group by detail_pergerakan_stok.no_roll
ORDER BY detail_pergerakan_stok.no_roll ASC limit 40,20");
	
  $no=1;
  $row1=mysqli_fetch_array($sql1)
  ?><div>
     <form name="form2">
        Satuan : PCS
     </form> </div>
    <table width="30%" align="center">
  
  <tr><td valign="top">
  <table width="33">
  <tr align="center" bgcolor="#0099FF">
     
    
    <td>No Roll</td>
    <td width="27%">Net Weight</td>
  
    <td width="54%">PCS</td>
    <td width="54%">Ukuran</td>
    <td width="54%">Keterangan</td>
    
  </tr>
 <?php
  while($row=mysqli_fetch_array($sql))
  {	
	  ?>
      <tr bgcolor="#9999FF">
    <td><?php echo $row['no_roll'];?></td>
    <td align="right"><?php echo number_format($row['weight'],'2','.',','); ?></td>
    <td align="right"><?php echo $row['netto'];?></td>
    <td align="center"><?php echo $row['ukuran'];?></td>
     <td><?php echo $row['sisa'];?></td>
    </tr>
      <?php
	   if($row['sisa']=="SISA" ||$row['sisa']=="EXTRA"){$netto=0; $ukuran=0;}else{$netto=$row['weight']; $ukuran=$row['netto'];}
	 $totbruto=$totbruto+ $netto;
	  $totyard=$totyard+ $ukuran;
	  $totrol=$totrol+$row['roll'];
	  $no++;
	  }
  
  
  ?>
  </table> </td>
   <?php if($jumlah>=21){?>
  <td valign="top">
 
  <table width="33">
    <tr align="center" bgcolor="#0099FF">
      <td>No Roll</td>
      <td width="27%">Net Weight</td>
      <td width="54%">PCS</td>
      <td width="54%">Ukuran</td>
      <td width="54%">Keterangan</td>
    </tr>
    <?php
  while($row2=mysqli_fetch_array($sql2))
  {	
	  ?>
    <tr bgcolor="#9999FF">
      <td><?php echo $row2['no_roll'];?></td>
      <td align="right"><?php echo number_format($row2['weight'],'2','.',','); ?></td>
      <td align="right"><?php echo $row2['netto'];?></td>
      <td align="center"><?php echo $row2['ukuran'];?></td>
      <td><?php echo $row2['sisa'];?></td>
    </tr>
    <?php
	 if($row2['sisa']=="SISA" ||$row2['sisa']=="EXTRA"){$netto=0; $ukuran=0;}else{$netto=$row2['weight']; $ukuran=$row2['netto'];}
	 $totbruto=$totbruto+ $netto;
	  $totyard=$totyard+ $ukuran;
	  $totrol=$totrol+$row['roll'];
	
	  $no++;
	  }
  
  
  ?>
  </table>
  </td><?php } ?>
  <?php if($jumlah >=41){?>
  <td valign="top">
  
  <table width="33">
    <tr align="center" bgcolor="#0099FF">
      <td>No Roll</td>
      <td width="27%">Net Weight</td>
      <td width="54%">PCS</td>
      <td width="54%">Ukuran</td>
      <td width="54%">Keterangan</td>
    </tr>
    <?php
  while($row3=mysqli_fetch_array($sql3))
  {	
	  ?>
    <tr bgcolor="#9999FF">
      <td><?php echo $row3['no_roll'];?></td>
      <td align="right"><?php echo number_format($row3['weight'],'2','.',','); ?></td>
      <td align="right"><?php echo $row3['netto'];?></td>
      <td align="center"><?php echo $row3['ukuran'];?></td>
      <td><?php echo $row3['sisa'];?></td>
    </tr>
    <?php
	if($row3['sisa']=="SISA" ||$row3['sisa']=="EXTRA"){$netto=0; $ukuran=0;}else{$netto=$row3['weight']; $ukuran=$row3['netto'];}
	 $totbruto=$totbruto+ $netto;
	  $totyard=$totyard+ $ukuran;
	  $totrol=$totrol+$row['roll'];
	  
	  $no++;
	  }
  
  
  ?>
  </table>
  </td>
  <?php  } ?>
  <tr >
    <td colspan="3" valign="baseline"><table width="100%"  align="left" ><tr bgcolor="#99FFFF" align="Right">
    <td width="75%">&nbsp;</td>
    <td width="15%">Net Weights</td>
    <td width="10%" colspan="2">PCS</td>  
   
    </tr>
  <tr bgcolor="#99FFFF" align="right">
    <td><b>Total</b></td>
    <td align="right"><b><?php echo number_format($totbruto,'2','.',',');?></td>
    <td align="right" colspan="2"><b><?php echo $totyard;?></b></td>
 
    </tr></table></td>
    </tr>
  
  
</table>
    <a href="pages/cetak/cetak_detail_form.php?id=<?php echo $_GET['id']; ?>&tgl1=<?php echo $_GET['tgl1']; ?>&tgl2=<?php echo $_GET['tgl2']; ?>&user_name=<?php echo $_SESSION['username']; ?>&sift=<?php echo $_GET['sift']; ?>" target="_blank"> Cetak </a>                         


                            
                            