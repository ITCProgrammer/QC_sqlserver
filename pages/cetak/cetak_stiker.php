<html>
<head>
<title></title>
<link href="../styles_cetak.css" rel="stylesheet" type="text/css">
</head>
<body>
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
   
          function ganti(id,thn1,bln1,hr1,thn2,bln2,hr2,sift)
{     var yrd= document.forms['form2']['yrd_'].value;  
var x,meter;
if(yrd=="meter"){
	window.location.href="form-Packing?p=mutasi_detail_meter&id="+ id +"&tgl1="+ thn1 +"-"+ bln1 +"-"+ hr1 +"&tgl2="+ thn2 +"-"+ bln2 +"-"+ hr2 + "&sift="+ sift;
	}

}
           </script>
<?php 
 	$sql=mysql_query("SELECT * , detail_kite.yard_ AS yard_, detail_kite.yard_ AS roll, detail_kite.net_wight AS bruto,detail_kite.satuan,sisa
FROM tbl_kite
INNER JOIN detail_kite ON detail_kite.nokkKite = tbl_kite.nokk
WHERE tbl_kite.nokk = '$_GET[id]'
ORDER BY detail_kite.sisa ASC"); 
	$no=1;
  $row1=mysql_fetch_array($sql1)
  ?>
  <table  border="1" class="table-list1">
 <?php
  while($row=mysql_fetch_array($sql))
  {	
	  ?>
      <tr style="height:0.7cm">
    <td style="width:0.5cm"><?php echo $row['no_roll'];?></td>
    <td style="width:1.3cm" align="right"><?php echo number_format($row['bruto'],'2','.',','); ?></td>
    <td style="width:1.3cm" align="right"><?php echo number_format($row['yard_'],'2','.',',');?></td>
    </tr>
      <?php
	  if($row['sisa']=="SISA" ||$row['sisa']=="EXTRA"){$netto=0; $ukuran=0;}else{$netto=$row['bruto']; $ukuran=$row['yard_'];}
	  $totbruto=$totbruto+ $netto;
	  $totyard=$totyard+ $ukuran;
	  $totrol=$totrol+$row['roll'];
	  
	  $no++;
	  }
  
  
  ?>
  </table> 
  
 <table  border="0" class="table-list" align="left">
  <tr align="right">
     
    <td style="width:0.5cm"><b>Tot</b></td>
    <td style="width:1.3cm"><b><?php echo number_format($totbruto,'2','.',',');?></td>
    <td style="width:1.3cm"><b><?php echo number_format($totyard,'2','.',',');?></b></td>
 
    </tr></table>
	<br><br>
<img src="../btn_print.png" height="20" id="nocetak" onClick="javascript:window.print()" />                       

</body>