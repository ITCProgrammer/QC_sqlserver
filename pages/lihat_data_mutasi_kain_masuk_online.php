  <?php
$host="10.0.0.4";
$username="timdit";
$password="4dm1n";
$db_name="TM";
 set_time_limit(600);
	$conn=mssql_connect($host,$username,$password) or die ("Sorry our web is under maintenance. Please visit us later");
	mssql_select_db($db_name) or die ("Under maintenance");
		
	mysql_connect("svr1","root","itc0920");
mysql_select_db("db_qc")or die("Gagal Koneksi");

?>

  
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
<!--
.warnaa {
	color: #808040;
}
-->
</style>
</head>
<body>
    <div id="art-main">
      <input type="button" class="art-button" onClick="window.location.href='../index_login.php?act=logout'" value="Logout"/>
                            <?php if($_SESSION['status']==0){ ?><input type="button" class="art-button" onClick="window.location.href='../index1.php?p=mutasi_kain_masuk_online'" value="Home"/><br /><?php } ?>
                       
         <form action="simpan_masuk_kain_online.php" method="post">             
       <table width="100%">
  <tr>
    <td>&nbsp;</td>
    <td colspan="22" align="center"><b>BUKTI MUTASI KAIN ONLINE</b></td>
  </tr>
  <tr>
   <?php  if($_POST['no_mutasi']==""){$no=$_GET['no_mutasi'];}else{$no=$_POST['no_mutasi'];}?>
    <td colspan="23"><b>Tanggal : <?php echo  date("d-M-Y"); ?><br> No Mutasi : <?php echo $no;?></b></td>
  </tr>
  <tr align="center" bgcolor="#0099FF">
    <td  rowspan="2">No MC</td>
    <td rowspan="2">Tanggal</td>
    
    
    <td rowspan="2">Langganan</td>
    <td rowspan="2">PO</td>
    <td rowspan="2">Order</td>
    <td rowspan="2">Jenis Kain</td>
    <td rowspan="2">No. Warna</td>
    <td rowspan="2">Warna</td>
    <td rowspan="2">L/Grm2</td>
    <td rowspan="2">Lot</td>
    <td rowspan="2">Jml.Roll</td>
    <td rowspan="2">Bruto(Kg)</td>
    <td colspan="3">Netto (KG)</td>
    <td colspan="2">SISA</td>
    <td rowspan="2">Yard</td>
    <td rowspan="2">No.Kartu Kerja</td>
    <td rowspan="2">Tempat</td>
    <td rowspan="2">Item</td>
  </tr>
  <tr align="center" bgcolor="#0099FF">
    <td>Grade<br /> A+B</td>
    <td>Grade <br /> C</td>
    <td>Keterangan<br />(Grade C)</td>
    <td>Jml. Roll</td>
    <td>Qty(KG)</td>
    </tr>
  <?php 
   
  $sql=mysql_query("SELECT *
FROM `mutasi_kain`
WHERE no_mutasi = '$no'");
  $i=1;
  $n=1;
  while($rowa=mysql_fetch_array($sql))
  {
	  $sqlsvr1=mssql_query("select stockmovement.dated,count(stockmovementdetails.weight)as rol,stockmovement.pono as dono,productprop.pono as pono,productprop.batchno,productprop.Width,productprop.WeightPerArea from stockmovement 
left join stockmovementdetails on  stockmovementdetails.stockmovementid=stockmovement.id
left join productprop on productprop.id = stockmovementdetails.productpropid
where stockmovement.wid=22 and stockmovement.transactiontype=4 and stockmovement.transactionstatus=1 and productprop.batchno='$rowa[nokk]' 
group by stockmovement.ID,stockmovement.PONo,productprop.BatchNo,productprop.PONo,productprop.Width,stockmovement.dated,productprop.WeightPerArea");
  
  $c=0;
  while($row=mssql_fetch_array($sqlsvr1))
  {
  $bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99';
	$svr2=mssql_query("select count(id) as total ,PCBID,PCJOID,SODID from productprop 
where BatchNo='$row[batchno]' group by productprop.PCBID,productprop.PCJOID,productprop.SODID,productprop.PONo");
      $r1=mssql_fetch_array($svr2);
	  	
	$sqlsvr2=mssql_query("select sum(stockmovementdetails.weight)as berat_ab from stockmovement 
left join stockmovementdetails on  stockmovementdetails.stockmovementid=stockmovement.id
left join productprop on productprop.id = stockmovementdetails.productpropid
left join  processflowinspectionprocessno on processflowinspectionprocessno.id=productprop.pfipnid
where stockmovement.wid=22 and stockmovement.transactiontype=4 and stockmovement.transactionstatus=1
and productprop.BatchNo='$row[batchno]' and (processflowinspectionprocessno.PointGradeID='1' or processflowinspectionprocessno.PointGradeID='2')");
$row1=mssql_fetch_array($sqlsvr2); 

$sqlsvr3=mssql_query(" select sum(stockmovementdetails.weight)as berat_c from stockmovement 
left join stockmovementdetails on  stockmovementdetails.stockmovementid=stockmovement.id
left join productprop on productprop.id = stockmovementdetails.productpropid
left join  processflowinspectionprocessno on processflowinspectionprocessno.id=productprop.pfipnid
where stockmovement.wid=22 and stockmovement.transactiontype=4 and stockmovement.transactionstatus=1
and productprop.BatchNo='$row[batchno]' and  processflowinspectionprocessno.PointGradeID='3'");
$row2=mssql_fetch_array($sqlsvr3); 
	
	$sqlsvr4=mssql_query("select sum(stockmovementdetails.weight)as berat_sisa,count(stockmovementdetails.weight)as rol_sisa from stockmovement 
left join stockmovementdetails on  stockmovementdetails.stockmovementid=stockmovement.id
left join productprop on productprop.id = stockmovementdetails.productpropid
left join  processflowinspectionprocessno on processflowinspectionprocessno.id=productprop.pfipnid
where stockmovement.wid=22 and stockmovement.transactiontype=4 and stockmovement.transactionstatus=1
and productprop.BatchNo='$row[batchno]' and (stockmovementdetails.RefNo like'%sisa%' or productprop.rollno like'%sisa%')
");
$row3=mssql_fetch_array($sqlsvr4);

$sqlsvr5=mssql_query("select sum(stockmovementdetails.weight)as berat_sisa_ab,count(stockmovementdetails.weight)as rol_sisa from stockmovement 
left join stockmovementdetails on  stockmovementdetails.stockmovementid=stockmovement.id
left join productprop on productprop.id = stockmovementdetails.productpropid
left join  processflowinspectionprocessno on processflowinspectionprocessno.id=productprop.pfipnid
where stockmovement.wid=22 and stockmovement.transactiontype=4 and stockmovement.transactionstatus=1
and  (processflowinspectionprocessno.PointGradeID='1' or processflowinspectionprocessno.PointGradeID='2')
and productprop.BatchNo='$row[batchno]' and stockmovementdetails.RefNo like'%sisa%'

");
$row4=mssql_fetch_array($sqlsvr5);
$svr3=mssql_query("select productid,weight as bruto,soid  from sodetails where id='$r1[SODID]'");
 	  $r2=mssql_fetch_array($svr3);
	  $produk=mssql_query("select shortdescription,colorno,color,hangerno from productmaster where id='$r2[productid]'");
 	  $r3=mssql_fetch_array($produk);
	  $so=mssql_query("select customerid,buyerid from salesorders where id='$r2[soid]'");
 	  $r4=mssql_fetch_array($so);
	  	  $p1=mssql_query("select partnername from partners where id='$r4[customerid]'");
 	  $r5=mssql_fetch_array($p1);
	  	  $p2=mssql_query("select partnername from partners where id='$r4[buyerid]'");
 	  $r6=mssql_fetch_array($p2);
	  $lot=mssql_query("select pcid,lotno from processcontrolbatches where id='$r1[PCBID]'");
 	  $r7=mssql_fetch_array($lot);	  
	  $lot1=mssql_query("select count(CID)as lot from processcontrolbatches where pcid='$r7[pcid]'
group by processcontrolbatches.CID");
	  $r8=mssql_fetch_array($lot1);	 
	 $gross1= mssql_query("select sum(stockmovementdetails.weight) as gross from stockmovement 
LEFT join stockmovementdetails on StockMovement.id=stockmovementdetails.StockmovementID
left join processcontrolbatches on processcontrolbatches.id=stockmovement.pcbid
where wid='12' and transactiontype='7' and processcontrolbatches.documentno='$row[batchno]'");
  		 $r9=mssql_fetch_array($gross1);
	  ?>
    <tr bgcolor="<?php echo $bgcolor; ?>">
    <td>&nbsp;</td>
    <td><?php echo  date("d-M-Y",strtotime($row['dated']));?></td>
    
    
    <td><?php echo $r5['partnername']." / ".$r6['partnername']; ?></td>
    <td><?php echo $row['pono']; ?></td>
    <td><?php echo $row['dono']; ?></td>
    <td><?php echo $r3['shortdescription']; ?></td>
    <td><?php echo $r3['colorno']; ?></td>
    <td><?php echo $r3['color']; ?></td>
    <td><?php echo number_format($row['Width']-2)."/".number_format($row['WeightPerArea']); ?></td>
    <td><?php echo $r8['lot']."/".$r7['lotno']; ?></td>
    <td align="right"><?php echo $row['rol']-$row3['rol_sisa']; ?></td>
    <td align="right"><?php echo number_format($r9['gross'],'2','.',','); ?></td>
    <td align="right"><?php if($row3['berat_sisa']!=""){echo number_format($row1['berat_ab']-$row4['berat_sisa_ab'],'2','.',',');}else {echo  number_format($row1['berat_ab'],'2','.',',');} ?></td>
    <td align="right"><?php echo number_format($row2['berat_c'],'2','.',',') ;?></td>
    <td>&nbsp;</td>
    <td align="right"><?php echo $row3['rol_sisa'];?></td>
    <td align="right"><?php echo number_format($row3['berat_sisa'],'2','.',',') ;?></td>
    <td align="right"><?php 
	$yardd1=round(1000/(($row['Width']*$row['WeightPerArea'])/43.05),2);
	
	
	$yardd=number_format(($row1['berat_ab']+ $row2['berat_c'])*$yardd1,'2','.',',');
	echo $yardd; $newdate = strtotime ( '-3 day' , strtotime ( $date ) ) ;?></td>
    <td>
	 <a href="../form-Packing?p=produksi_detail_online&id=<?php echo $row['batchno'];?>&tgl1=<?php echo date("Y-m-d",strtotime($row['dated'])) ; ?>&tgl2=<?php echo date("Y-m-d",strtotime ( '1 day' , strtotime ( $row['dated']))) ; ?>&sift=<?php echo $_POST['sift'];?>"><?php echo $row['batchno']; ?></a>
	
	</td>
    <td><input  class="input1" name="tempat[<?php echo $n;?>]" type="text" value="<?php echo $rowa['tempat'];?>">
    <input name="no_mutasi" type="hidden" value="<?php echo $no;?>"></td>
    <td><?php echo $r3['hangerno']; ?></td>
  </tr>
 
      <?php
	  $totbruto=$totbruto+$r9['gross'];
	  $totyard=$totyard+ round($yardd,2);
	  $totrol=$totrol+$row['rol'];
	  $totab=$totab+$row1['berat_ab'];
	  $tota=$tota+$row2['berat_c'];
	  	if($row['satuan']=='Meter')
		{$kartot=$kartot + $row['yard_']; $totkar = $totkar + $row['roll'];}
		if($row['satuan']=='Yard')
		{$pltot=$pltot + $row['yard_'];   $totpl = $totpl + $row['roll'];}
	 
	 $i++; 
	  }
	  $n++; 
  }
  ?>
   
  <tr bgcolor="#99FFFF">
    <td>&nbsp;</td>
    <td>&nbsp;</td>    
    <td>&nbsp;</td>
    <td></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr bgcolor="#99FFFF">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    
    
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2"><b>Total</b></td>
    <td>&nbsp;</td>
    <td align="right"><b><?php echo $totrol;?></td>
    <td align="right"><b><?php echo number_format($totbruto,'2','.',',');?></b></td>
    <td align="right"><b><?php echo number_format($totab,'2','.',',');?></b></td>
    <td align="right"><b><?php echo number_format($tota,'2','.',',');?></b></td>
    <td>&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right"><b><?php echo number_format($totyard,'2','.',',');?></b></td>
    
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  
</table>
<input name="masuk" type="submit" value="masuk kain">  </form>                        


                            
                            
<div class="cleared"></div>
                            </div>
                        </div>
                    </div>
                </div>
</div>
        </div>
    </div>
    
</body>
</html>