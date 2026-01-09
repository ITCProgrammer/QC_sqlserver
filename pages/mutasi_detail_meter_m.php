<script>
  function roundToTwo(num) {    
    return +(Math.round(num + "e+2")  + "e-2");
}
     </script>            
       
    <?php 
   	mysql_connect("svr1","root","itc0920");
mysql_select_db("db_qc")or die("Gagal Koneksi");

	
  $sql1=mysql_query("SELECT *,detail_kite.yard_ as yard_, detail_kite.yard_ as roll, detail_kite.net_wight as bruto
FROM tbl_kite left join detail_kite on detail_kite.nokkKite=tbl_kite.nokk
WHERE tbl_kite.nokk='$_GET[id]'
ORDER BY detail_kite.id ASC");
  $row1=mysql_fetch_array($sql1);
  $jumlah=mysql_num_rows($sql1);
    ?>
    <script>
          function ganti()
{     var yrd= document.forms['form2']['yrd_'].value;  
      var x,meter;
if(yrd=="meter"){
	window.history.go(-1);
	return false;
	}

}
           </script>  
 <div align="center"><b>BUKTI MUTASI KAIN DETAIL</b></div><div><b>Tanggal : <?php echo $_GET['tgl1']." s/d ".$_GET['tgl2']; ?> <br>GROUP SHIFT: <?php echo $_SESSION['username']; ?> <br> SHIFT : <?php echo $_GET['sift'];?><br>
      No Kartu Kerja : <?php echo $row1['nokk'];?><br>
      No Order :<?php echo $row1['no_order'];?><br>
      Pelanggan :<?php echo $row1['pelanggan'];?><br /></b></div>
      <?php 
 	
 	$sql=mysql_query("SELECT * , detail_kite.yard_ AS yard_, detail_kite.yard_ AS roll, detail_kite.net_wight AS bruto,detail_kite.satuan,sisa
FROM tbl_kite
INNER JOIN detail_kite ON detail_kite.nokkKite = tbl_kite.nokk
WHERE tbl_kite.nokk = '$_GET[id]'
ORDER BY detail_kite.id ASC limit 0,20"); 
$sql2=mysql_query("SELECT * , detail_kite.yard_ AS yard_, detail_kite.yard_ AS roll, detail_kite.net_wight AS bruto,detail_kite.satuan,sisa
FROM tbl_kite
INNER JOIN detail_kite ON detail_kite.nokkKite = tbl_kite.nokk
WHERE tbl_kite.nokk = '$_GET[id]'
ORDER BY detail_kite.id ASC limit 20,20"); 
$sql3=mysql_query("SELECT * , detail_kite.yard_ AS yard_, detail_kite.yard_ AS roll, detail_kite.net_wight AS bruto,detail_kite.satuan,sisa
FROM tbl_kite
INNER JOIN detail_kite ON detail_kite.nokkKite = tbl_kite.nokk
WHERE tbl_kite.nokk = '$_GET[id]'
ORDER BY detail_kite.id ASC limit 40,20");
	
  $no=1;
  $row1=mysql_fetch_array($sql1)
  ?>
      <div><form name="form2">
        Satuan :<select name="yrd_" onchange="ganti()">
          <option value="yard">Yard</option>
          <option value="meter">Meter</option>
          </select>
      </form></div><table width="30%" align="center"><tr><td width="19%" valign="top">
  <table width="30">
  <tr align="center" bgcolor="#0099FF">
       
    <td>No Roll</td>
    <td width="27%">Net Waight</td>
  
    <td width="54%">Yard</td>
    <td width="54%">Keterangan</td>
    
  </tr>
<?php 
  while($row=mysql_fetch_array($sql))
  {
	  $meter1=$row['yard_']*(840/768);	
	  ?>
      <tr bgcolor="#9999FF">
    <td><?php echo $row['no_roll'];?></td>
    <td align="right"><?php echo number_format($row['bruto'],'2','.',','); ?></td>
    <td align="right"><?php echo number_format($meter1,'2','.',',');?></td>
    <td align="right"><?php echo $row['sisa'];?></td>
      </tr>
      <?php
	 if($row['sisa']=="SISA" ||$row['sisa']=="EXTRA"){$netto=0; $ukuran=0;}else{$netto=$row['bruto']; $ukuran=$meter1;}
	 $totbruto=$totbruto+ $netto;
	  $totyard=$totyard+ $ukuran;
	  $totrol=$totrol+$row['roll'];
	  
	  }
  
  
  ?>
  </table> </td>
   <?php if($jumlah>=21){?>
  <td valign="top">
  <table width="30">
  <tr align="center" bgcolor="#0099FF">
       
    <td>No Roll</td>
    <td width="27%">Net Waight</td>
  
    <td width="54%">Yard</td>
    <td width="54%">Keterangan</td>
    
  </tr>
<?php 
  while($row2=mysql_fetch_array($sql2))
  {
	  $meter1=$row['yard_']*(840/768);	
	  ?>
      <tr bgcolor="#9999FF">
    <td><?php echo $row2['no_roll'];?></td>
    <td align="right"><?php echo number_format($row2['bruto'],'2','.',','); ?></td>
    <td align="right"><?php echo number_format($meter1,'2','.',',');?></td>
    <td align="right"><?php echo $row2['sisa'];?></td>
      </tr>
      <?php
	  if($row2['sisa']=="SISA" ||$row2['sisa']=="EXTRA"){$netto=0; $ukuran=0;}else{$netto=$row2['bruto']; $ukuran=$meter1;}
	 $totbruto=$totbruto+ $netto;
	  $totyard=$totyard+ $ukuran;
	  $totrol=$totrol+$row['roll'];
	  
	  $no++;
	  }
  
  
  ?>
  </table> </td>
  <?php } ?>
   <?php if($jumlah>=41){?>
  <td valign="top">
  <table width="30">
  <tr align="center" bgcolor="#0099FF">
       
    <td>No Roll</td>
    <td width="27%">Net Waight</td>
  
    <td width="54%">Yard</td>
    <td width="54%">Keterangan</td>
    
  </tr>
<?php 
  while($row3=mysql_fetch_array($sql3))
  {
	  $meter1=$row['yard_']*(840/768);	
	  ?>
      <tr bgcolor="#9999FF">
    <td><?php echo $row3['no_roll'];?></td>
    <td align="right"><?php echo number_format($row3['bruto'],'2','.',','); ?></td>
    <td align="right"><?php echo number_format($meter1,'2','.',',');?></td>
    <td align="right"><?php echo $row3['sisa'];?></td>
      </tr>
      <?php
	 if($row3['sisa']=="SISA" ||$row3['sisa']=="EXTRA"){$netto=0; $ukuran=0;}else{$netto=$row3['bruto']; $ukuran=$meter1;}
	 $totbruto=$totbruto+ $netto;
	  $totyard=$totyard+ $ukuran;
	  $totrol=$totrol+$row['roll'];
	  
	  $no++;
	  }
  
  
  ?>
  </table> <?php } ?><td></td></tr>
   <tr align="center">
    <td colspan="4"><table width="100%"><tr bgcolor="#99FFFF" align="Right">
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
      <a href="pages/cetak/cetak_detail_m_form.php?id=<?php echo $_GET['id']; ?>&tgl1=<?php echo $_GET['tgl1']; ?>&tgl2=<?php echo $_GET['tgl2']; ?>&user_name=<?php echo $_SESSION['username']; ?>&sift=<?php echo $_GET['sift']; ?>" target="_blank"> Cetak </a>                          


                            
                            