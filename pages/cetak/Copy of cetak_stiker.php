
<html>
<head>
  <title>CETAK</title>
  <style type="text/css">
*{
font-family: sans-serif, Roman, serif; 
margin:0px;
padding:0px;
}
@page {
 margin-left:3cm 2cm 2cm 2cm; 
}
table.grid{
font-size: 8pt;  
border-collapse:collapse;
}
table.grid th{
padding-top:1mm;
padding-bottom:1mm;
}
table.grid th{
background: #F0F0F0;
border-top: 0.2mm solid #000;
border-bottom: 0.2mm solid #000;
text-align:left;
padding-left:0.2cm;
}
table.grid tr td{
padding-top:0.5mm;
padding-bottom:0.5mm;
padding-right:0.5mm;
padding-left:2mm;
border-bottom:0.2mm solid #000;
border-left:0.1mm solid #000;
border-right:0.1mm solid #000;
}
h1{
font-size: 18pt;       
}
h2{
font-size: 14pt;       
}
.header{
display: block;
width:15.6cm ;
margin-bottom: 0.3cm;
text-align: center;
}
.attr{
font-size:9pt;
width: 100%;
padding-top:2pt;
padding-bottom:2pt;
border-top: 0.2mm solid;
border-bottom: 0.2mm solid #000;
}
.pagebreak {
page-break-after: always;
}
</style>
<link href="../styles_cetak.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php
function myheader(){
?>
  <div class="header">
  </div>
  <table class="table-list">
  <hr style='width:4cm'>
<?php

}
function myfooter(){
    echo "</table>";
}

mysql_connect("192.168.0.254","root","gogogo");
mysql_select_db("db_qc")or die("Gagal Koneksi");
$jumlah=mysql_query("SELECT *,detail_kite.yard_ as yard_, detail_kite.yard_ as roll, detail_kite.net_wight as bruto
FROM tbl_kite left join detail_kite on detail_kite.nokkKite=tbl_kite.nokk
WHERE tbl_kite.nokk='$_GET[id]'
ORDER BY tbl_kite.id ASC");
$jml=mysql_num_rows($jumlah);
$j=1;
while($row1=mysql_fetch_array($jumlah))
{
	$ar[$j]=$row1['no_roll'];
	$ar1[$j]=$row1['bruto'];
	$ar2[$j]=$row1['yard_'];
	$ar3[$j]=$row1['sisa'];
	$ar4[$j]=$row1['roll'];
	$j++;
}
for($i=1;$i<=$jml;$i++){

if(($i%20)==1){
   if($i > 1){
        myfooter();
        echo "<div class=\"pagebreak\"> </div>";
   }
   myheader();
}

echo "<tr align=right style='height:0.7cm'>";
echo "<td style='width:0.5cm'>$ar[$i]</td>";
echo "<td style='width:1.3cm'>$ar1[$i]</td>";
echo "<td style='width:1.3cm'>$ar2[$i]</td>";
//echo "<td style='width:1.3cm'>$ar3[$j]</td>";
echo "</tr>";
if($ar3[$i]=="SISA" ||$ar3[$i]=="EXTRA"){$netto=0; $ukuran=0;}else{$netto=$ar1[$i]; $ukuran=$ar2[$i];}
	  $totbruto=$totbruto+ $netto;
	  $totyard=$totyard+ $ukuran;

}

myfooter();
	
?>
</table>
<table class="grid">
<tr align="right">
<td style="width:0.5cm">Tot</td>
<td style="width:1.3cm"><?php echo $totbruto ;?></td>
<td style="width:1.3cm"><?php echo $totyard ;?></td>
</tr>
</table>

<img src="../btn_print.png" height="20" onClick="javascript:window.print()" /> 
</body>
</html>