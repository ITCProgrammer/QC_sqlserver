    <script>
  function roundToTwo(num) {    
    return +(Math.round(num + "e+2")  + "e-2");
}                
</script>
   
    <?php 
   $host="10.0.0.4";
$username="timdit";
$password="4dm1n";
$db_name="TM";
 set_time_limit(600);
	$conn=mssql_connect($host,$username,$password) or die ("Sorry our web is under maintenance. Please visit us later");
	mssql_select_db($db_name) or die ("Under maintenance");
	
	if($_GET['sift']=="1"){$sift11="07:00:00";$sift12="14:59:59";}
	else if($_GET['sift']=="2"){$sift11="15:00:00";$sift12="22:59:59";}
	else if($_GET['sift']=="3"){$sift11="23:00:00";$sift12="06:59:59";}
  $sql1=mssql_query("select productprop.batchno, productprop.rollno,stockmovementdetails.weight,stockmovementdetails.refno from stockmovement 
left join stockmovementdetails on  stockmovementdetails.stockmovementid=stockmovement.id
left join productprop on productprop.id = stockmovementdetails.productpropid
where stockmovement.wid=22 and stockmovement.transactiontype=4 and stockmovement.transactionstatus=1
and productprop.productiondate between '$_GET[tgl1] $sift11' and '$_GET[tgl2] $sift12' and productprop.batchno='$_GET[id]'");
  $row1=mssql_fetch_array($sql1);
  $jumlah=mssql_num_rows($sql1);
   ?>
    <script>
   
          function ganti(id,thn1,bln1,hr1,thn2,bln2,hr2,sift)
{     var yrd= document.forms['form2']['yrd_'].value;  
var x,meter;
if(yrd=="meter"){
	window.location.href="form-Packing?p=mutasi_detail_meter_online&id="+ id +"&tgl1="+ thn1 +"-"+ bln1 +"-"+ hr1 +"&tgl2="+ thn2 +"-"+ bln2 +"-"+ hr2 + "&sift="+ sift;
	}

}
           </script>  
      <div align="center"><b>BUKTI MUTASI KAIN DETAIL ONLINE</b> </div><div><b>Tanggal : <?php echo $_GET['tgl1']." s/d ".$_GET['tgl2']; ?> <br>
      SHIFT : <?php echo $_GET['sift'];?><br>
      No Kartu Kerja : <?php echo $row1['batchno'];?><br>
      No Order :<?php echo $row1['no_order'];?><br>
      Pelanggan :<?php echo $row1['pelanggan'];
	$thn1=substr($_GET['tgl1'],0,4);
	$bln1=substr($_GET['tgl1'],5,2);
	$hr1=substr($_GET['tgl1'],8,2);
	$thn2=substr($_GET['tgl2'],0,4);
	$bln2=substr($_GET['tgl2'],5,2);
	$hr2=substr($_GET['tgl2'],8,2);?><br /></b></div>
      <?php 
$sql2=mssql_query("select productprop.batchno,productprop.Width,productprop.WeightPerArea, productprop.rollno,stockmovementdetails.weight,stockmovementdetails.refno from stockmovement 
left join stockmovementdetails on  stockmovementdetails.stockmovementid=stockmovement.id
left join productprop on productprop.id = stockmovementdetails.productpropid
where stockmovement.wid=22 and stockmovement.transactiontype=4 and stockmovement.transactionstatus=1
and productprop.productiondate between '$_GET[tgl1] $sift11' and '$_GET[tgl2] $sift12' and productprop.batchno='$_GET[id]'");
	
  $no=1;
  ?><div>
      <form name="form2">
        Satuan : 
        <select name="yrd_" 
    onchange="ganti(<?php echo $_GET['id']; ?>,<?php echo $thn1; ?>,<?php echo $bln1; ?>,<?php echo $hr1; ?>,<?php echo $thn2; ?>,<?php echo $bln2; ?>,<?php echo $hr2; ?>,<?php echo $_GET['sift']; ?>,<?php echo $_GET['tgl1']; ?>)">
          <option value="yard" >Yard</option>
          <option value="meter">Meter</option>
        </select>
      </form></div>
    <table width="100%" align="center">
  
  <tr><td width="75%" valign="top">
  <table width="236">
  <tr align="center" bgcolor="#0099FF">
     
    
    <td width="13%">No Roll</td>
    <td width="21%">Net Waight</td>
  
    <td width="22%">Yard</td>
    <td width="44%">Keterangan</td>
    
  </tr>
 <?php
  while($row2=mssql_fetch_array($sql2))
  {	
 $yardd1=round(1000/(($row2['Width']*$row2['WeightPerArea'])/43.05),2);
	
	
	$yardd=number_format(($row2['weight'])*$yardd1,'2','.',',');
	  ?>
      <tr bgcolor="#9999FF">
    <td><?php echo $row2['rollno'];?></td>
    <td align="right"><?php echo number_format($row2['weight'],'2','.',','); ?></td>
    <td align="right"><?php echo number_format($yardd,'2','.',',');?></td>
     <td><?php echo $row2['refno'];?></td>
    </tr>
      <?php
	   if($row2['refno']=="SISA" ||$row2['refno']=="FOC"){$netto=0; $ukuran=0;}else{$netto=$row2['weight']; $ukuran=$yardd;}
	 $totbruto=$totbruto+ $netto;
	  $totyard=$totyard+ $ukuran;
	  $totrol=$totrol+$row2['roll'];
	  $no++;
	  }
  
  
  ?>
  </table> </td>
   <?php if($jumlah>=21){?>
  <td width="22%" valign="top">&nbsp;</td><?php } ?>
  <?php if($jumlah >=41){?>
  <td width="3%" valign="top">&nbsp;</td>
  <?php  } ?>
  <tr >
    <td colspan="3" valign="baseline"><table width="100%"  align="left" ><tr bgcolor="#99FFFF" align="Right">
    <td width="75%">&nbsp;</td>
    <td width="15%">Net Waight</td>
    <td width="10%" colspan="2">Yard</td>  
   
    </tr>
  <tr bgcolor="#99FFFF" align="right">
    <td><b>Total</b></td>
    <td align="right"><b><?php echo number_format($totbruto,'2','.',',');?></td>
    <td align="right" colspan="2"><b><?php echo number_format($totyard,'2','.',',');?></b></td>
 
    </tr></table></td>
    </tr>
  
  
</table>
    <a href="pages/cetak/cetak_detail_form.php?id=<?php echo $_GET['id']; ?>&tgl1=<?php echo $_GET['tgl1']; ?>&tgl2=<?php echo $_GET['tgl2']; ?>&user_name=<?php echo $_SESSION['username']; ?>&sift=<?php echo $_GET['sift']; ?>" target="_blank"> Cetak </a>                         


                            
                            