    <script>
  function roundToTwo(num) {    
    return +(Math.round(num + "e+2")  + "e-2");
}                
</script>
   
    <?php 
ini_set("error_reporting",1);
include("../koneksi.php");
  $sql1=sqlsrv_query($conn,"SELECT * FROM QtyAfterPacking WHERE NOKK='$_POST[kk2]'");
  $row1=sqlsrv_fetch_array($sql1,SQLSRV_FETCH_ASSOC);
  $jumlah=sqlsrv_num_rows($sql1);
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
      <div align="center"><b>BUKTI MUTASI KAIN DETAIL</b></div><div><b>      No Kartu Kerja : <?php echo $row1['NOKK'];?><br>
      <br /></b></div>
      <?php 
	  
$sql=sqlsrv_query($conn,"SELECT * FROM ( 
  SELECT *, ROW_NUMBER() OVER (ORDER BY ID) as row FROM QtyAfterPacking  WHERE NOKK='".$_POST['kk2']."'
 ) a WHERE a.row > 0 and a.row <= 20"); 
$sql2=sqlsrv_query($conn,"SELECT * FROM ( 
  SELECT *, ROW_NUMBER() OVER (ORDER BY ID) as row FROM QtyAfterPacking  WHERE NOKK='".$_POST['kk2']."'
 ) a WHERE a.row > 20 and a.row <= 40");
$sql3=sqlsrv_query($conn,"SELECT * FROM ( 
  SELECT *, ROW_NUMBER() OVER (ORDER BY ID) as row FROM QtyAfterPacking  WHERE NOKK='".$_POST['kk2']."'
 ) a WHERE a.row > 40 and a.row <= 60");	
  $no=1;
  $row1=sqlsrv_fetch_array($sql1,SQLSRV_FETCH_ASSOC)
  ?>
      
    <table width="30%" align="center">
  
  <tr><td valign="top">
  <table width="33">
  <tr align="center" bgcolor="#0099FF">
     
    
    <td>No Roll</td>
    <td width="27%"> Weight</td>
  
    <td width="54%">Yard</td>
    <td width="54%">No Inspek</td>
    </tr>
 <?php
  while($row=sqlsrv_fetch_array($sql,SQLSRV_FETCH_ASSOC))
  {	
	  ?>
      <tr bgcolor="#9999FF">
    <td><?php echo $row['ROLLNO'];?></td>
    <td align="right"><?php echo number_format($row['WEIGHT'],'2','.',','); ?></td>
    <td align="right"><?php echo number_format($row['LENGTH'],'2','.',',');?></td>
    <td><?php echo $row['ROLLNOEXP'];?></td>
     </tr>
      <?php
	   if($row['sisa']=="SISA" ||$row['sisa']=="EXTRA"){$netto=0; $ukuran=0;}else{$netto=$row['WEIGHT']; $ukuran=$row['LENGTH'];}
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
      <td width="27%"> Weight</td>
      <td width="54%">Yard</td>
      <td width="54%">No Inspek</td>
      </tr>
    <?php
  while($row2=sqlsrv_fetch_array($sql2,SQLSRV_FETCH_ASSOC))
  {	
	  ?>
    <tr bgcolor="#9999FF">
      <td><?php echo $row2['ROLLNO'];?></td>
      <td align="right"><?php echo number_format($row2['WEIGHT'],'2','.',','); ?></td>
      <td align="right"><?php echo number_format($row2['LENGTH'],'2','.',',');?></td>
      <td><?php echo $row2['ROLLNOEXP'];?></td>
      </tr>
    <?php
	 if($row2['sisa']=="SISA" ||$row2['sisa']=="EXTRA"){$netto=0; $ukuran=0;}else{$netto=$row2['WEIGHT']; $ukuran=$row2['LENGTH'];}
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
      <td width="54%">Yard</td>
      <td width="54%">No Inspek</td>
      </tr>
    <?php
  while($row3=sqlsrv_fetch_array($sql3,SQLSRV_FETCH_ASSOC))
  {	
	  ?>
    <tr bgcolor="#9999FF">
      <td><?php echo $row3['ROLLNO'];?></td>
      <td align="right"><?php echo number_format($row3['WEIGHT'],'2','.',','); ?></td>
      <td align="right"><?php echo number_format($row3['LENGTH'],'2','.',',');?></td>
      <td><?php echo $row3['ROLLNOEXP'];?></td>
      </tr>
    <?php
	if($row3['sisa']=="SISA" ||$row3['sisa']=="EXTRA"){$netto=0; $ukuran=0;}else{$netto=$row3['WEIGHT']; $ukuran=$row3['LENGTH'];}
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
    <td width="10%" colspan="2">Yards</td>  
   
    </tr>
  <tr bgcolor="#99FFFF" align="right">
    <td><b>Total</b></td>
    <td align="right"><b><?php echo number_format($totbruto,'2','.',',');?></td>
    <td align="right" colspan="2"><b><?php echo number_format($totyard,'2','.',',');?></b></td>
 
    </tr></table></td>
    </tr>
  
  
</table>
           