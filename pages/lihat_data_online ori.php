  <?php
$host="10.0.0.4";
$username="timdit";
$password="4dm1n";
$db_name="TM";
 set_time_limit(600);
	$conn=mssql_connect($host,$username,$password) or die ("Sorry our web is under maintenance. Please visit us later");
	mssql_select_db($db_name) or die ("Under maintenance");
		
	mysql_connect("192.168.0.3","root","itc0920");
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
<div id="art-page-background-simple-gradient">
    </div>
    <div id="art-page-background-glare">
        <div id="art-page-background-glare-image"></div>
    </div>
    <div id="art-main">
      <div class="art-Sheet-tl"></div>
            <div class="art-Sheet-tr"></div>
      <div class="art-Sheet-bl"></div>
            <div class="art-Sheet-br"></div>
            <div class="art-Sheet-tc"></div>
            <div class="art-Sheet-bc"></div>
            <div class="art-Sheet-cl"></div>
            <div class="art-Sheet-cr"></div>
            <div class="art-Sheet-cc"></div>
           
                
                     <input type="button" class="art-button" onClick="window.location.href='login.QC-PACKING?act=logout'" value="Logout"/>
                            <?php if($_SESSION['status']==0){ ?><input type="button" class="art-button" onClick="window.location.href='form-Packing'" value="Home"/><input type="button" class="art-button" onClick="window.location.href='form-Packing?p=laporan_harian_online'" value="Laporan"/><br /><?php } ?>
                       
                        
       <table width="100%">
  <tr>
    <td>&nbsp;</td>
    <td colspan="22" align="center"><b>BUKTI MUTASI KAIN ONLINE <?php echo $_POST['user_name']; ?></b></td>
  </tr>
  <tr>
   <?php $tgl_cetak1= trim($_POST['thn1']."-".$_POST['bln1']."-".$_POST['tgl1']);
   	$tgl_cetak2= trim($_POST['thn2']."-".$_POST['bln2']."-".$_POST['tgl2']);?>
    <td colspan="23"><b>Tanggal : <?php echo  date("d-M-Y", strtotime($tgl_cetak1))." s/d ".date("d-M-Y", strtotime($tgl_cetak2)); ?><br> SHIFT : <?php echo $_POST['sift'];?>
    <br />GROUP SHIFT: <?php echo $_POST['user_name']; ?></b></td>
  </tr>
  <tr align="center" bgcolor="#0099FF">
    <td  rowspan="2">No MC</td>
    
    
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
    <td rowspan="2">Keterangan</td>
  </tr>
  <tr align="center" bgcolor="#0099FF">
    <td>Grade<br /> A+B</td>
    <td>Grade <br /> C</td>
    <td>Keterangan<br />(Grade C)</td>
    <td>Jml. Roll</td>
    <td>Qty(KG)</td>
    </tr>
  <?php 
  if(substr($_POST['user_name'],0,7)=="PACKING"){$bgn="not";}else{$bgn=" ";}
  if($_POST['sift']=="1"){
	  $sqlsvr1=mssql_query("select count(stockmovementdetails.weight)as rol,stockmovement.pono as dono,productprop.pono as pono,productprop.batchno,productprop.Width,productprop.WeightPerArea from stockmovement 
left join stockmovementdetails on  stockmovementdetails.stockmovementid=stockmovement.id
left join productprop on productprop.id = stockmovementdetails.productpropid
where stockmovement.wid=22 and stockmovement.transactiontype=4 and stockmovement.transactionstatus=1
and productprop.productiondate between '$tgl_cetak1 07:00:00' and '$tgl_cetak2 14:59:59' and CAST(TM.dbo.stockmovement.[note] AS VARCHAR(8000)) $bgn like '%IM%'
group by stockmovement.ID,stockmovement.PONo,productprop.BatchNo,productprop.PONo,productprop.Width,productprop.WeightPerArea");
	  }else if($_POST['sift']=="2"){
	  
	   $sqlsvr1=mssql_query("select count(stockmovementdetails.weight)as rol,stockmovement.pono as dono,productprop.pono as pono,productprop.batchno,productprop.Width,productprop.WeightPerArea from stockmovement 
left join stockmovementdetails on  stockmovementdetails.stockmovementid=stockmovement.id
left join productprop on productprop.id = stockmovementdetails.productpropid
where stockmovement.wid=22 and stockmovement.transactiontype=4 and stockmovement.transactionstatus=1
and productprop.productiondate between '$tgl_cetak1 15:00:00' and '$tgl_cetak2 22:59:59' and CAST(TM.dbo.stockmovement.[note] AS VARCHAR(8000)) $bgn like '%IM%'
group by stockmovement.ID,stockmovement.PONo,productprop.BatchNo,productprop.PONo,productprop.Width,productprop.WeightPerArea");
	  
	  }else{
	  $sqlsvr1=mssql_query("select count(stockmovementdetails.weight)as rol,stockmovement.pono as dono,productprop.pono as pono,productprop.batchno,productprop.Width,productprop.WeightPerArea from stockmovement 
left join stockmovementdetails on  stockmovementdetails.stockmovementid=stockmovement.id
left join productprop on productprop.id = stockmovementdetails.productpropid
where stockmovement.wid=22 and stockmovement.transactiontype=4 and stockmovement.transactionstatus=1
and productprop.productiondate between '$tgl_cetak1 23:00:00' and '$tgl_cetak2 06:59:59' and CAST(TM.dbo.stockmovement.[note] AS VARCHAR(8000)) $bgn like '%IM%'
group by stockmovement.ID,stockmovement.PONo,productprop.BatchNo,productprop.PONo,productprop.Width,productprop.WeightPerArea");  
		  
		 }
  while($row=mssql_fetch_array($sqlsvr1))
  {
	  	   $cek=mysql_query("select * from mutasi_kain where nokk='$row[batchno]'");
		   $crow=mysql_fetch_array($cek);
	  if($crow>0){$keterangan="OUT";}else{$keterangan="";}
	  
	  
if($_POST['sift']=="1"){

	$svr2=mssql_query("select count(id) as total ,PCBID,PCJOID,SODID from productprop 
where BatchNo='$row[batchno]' and 
productprop.productiondate between '$tgl_cetak1 07:00:00' 
and '$tgl_cetak2 15:59:59'
group by productprop.PCBID,productprop.PCJOID,productprop.SODID,productprop.PONo");
      $r1=mssql_fetch_array($svr2);
	  	
	$sqlsvr2=mssql_query("select sum(stockmovementdetails.weight)as berat_ab from stockmovement 
left join stockmovementdetails on  stockmovementdetails.stockmovementid=stockmovement.id
left join productprop on productprop.id = stockmovementdetails.productpropid
left join  processflowinspectionprocessno on processflowinspectionprocessno.id=productprop.pfipnid
where stockmovement.wid=22 and stockmovement.transactiontype=4 and stockmovement.transactionstatus=1
and productprop.productiondate between '$tgl_cetak1 07:00:00' and '$tgl_cetak2 14:59:59' and productprop.BatchNo='$row[batchno]' and (processflowinspectionprocessno.PointGradeID='1' or processflowinspectionprocessno.PointGradeID='2')");
$row1=mssql_fetch_array($sqlsvr2); 

$sqlsvr3=mssql_query(" select sum(stockmovementdetails.weight)as berat_c from stockmovement 
left join stockmovementdetails on  stockmovementdetails.stockmovementid=stockmovement.id
left join productprop on productprop.id = stockmovementdetails.productpropid
left join  processflowinspectionprocessno on processflowinspectionprocessno.id=productprop.pfipnid
where stockmovement.wid=22 and stockmovement.transactiontype=4 and stockmovement.transactionstatus=1
and productprop.productiondate between '$tgl_cetak1 07:00:00' and '$tgl_cetak2 14:59:59' and productprop.BatchNo='$row[batchno]' and  processflowinspectionprocessno.PointGradeID='3'");
$row2=mssql_fetch_array($sqlsvr3); 
	
	$sqlsvr4=mssql_query("select sum(stockmovementdetails.weight)as berat_sisa,count(stockmovementdetails.weight)as rol_sisa from stockmovement 
left join stockmovementdetails on  stockmovementdetails.stockmovementid=stockmovement.id
left join productprop on productprop.id = stockmovementdetails.productpropid
left join  processflowinspectionprocessno on processflowinspectionprocessno.id=productprop.pfipnid
where stockmovement.wid=22 and stockmovement.transactiontype=4 and stockmovement.transactionstatus=1
and productprop.productiondate between '$tgl_cetak1 07:00:00' and '$tgl_cetak2 14:59:59' and productprop.BatchNo='$row[batchno]' and (stockmovementdetails.RefNo like'%sisa%' or productprop.rollno like'%sisa%')
");
$row3=mssql_fetch_array($sqlsvr4);

$sqlsvr5=mssql_query("select sum(stockmovementdetails.weight)as berat_sisa_ab,count(stockmovementdetails.weight)as rol_sisa from stockmovement 
left join stockmovementdetails on  stockmovementdetails.stockmovementid=stockmovement.id
left join productprop on productprop.id = stockmovementdetails.productpropid
left join  processflowinspectionprocessno on processflowinspectionprocessno.id=productprop.pfipnid
where stockmovement.wid=22 and stockmovement.transactiontype=4 and stockmovement.transactionstatus=1
and  (processflowinspectionprocessno.PointGradeID='1' or processflowinspectionprocessno.PointGradeID='2')
and productprop.productiondate between '$tgl_cetak1 07:00:00' and '$tgl_cetak2 14:59:59' and productprop.BatchNo='$row[batchno]' and stockmovementdetails.RefNo like'%sisa%'

");
$row4=mssql_fetch_array($sqlsvr5);

}else if($_POST['sift']=="2"){	  
	$sqlsvr2=mssql_query(" select sum(stockmovementdetails.weight)as berat_ab from stockmovement 
left join stockmovementdetails on  stockmovementdetails.stockmovementid=stockmovement.id
left join productprop on productprop.id = stockmovementdetails.productpropid
left join  processflowinspectionprocessno on processflowinspectionprocessno.id=productprop.pfipnid
where stockmovement.wid=22 and stockmovement.transactiontype=4 and stockmovement.transactionstatus=1
and productprop.productiondate between '$tgl_cetak1 15:00:00' and '$tgl_cetak2 22:59:59' and productprop.BatchNo='$row[batchno]' and (processflowinspectionprocessno.PointGradeID='1' or processflowinspectionprocessno.PointGradeID='2')");
$row1=mssql_fetch_array($sqlsvr2); 
 
 $svr2=mssql_query("select count(id) as total ,PCBID,PCJOID,SODID from productprop 
where BatchNo='$row[batchno]' and 
productprop.productiondate between '$tgl_cetak1 15:00:00' 
and '$tgl_cetak2 22:59:59'
group by productprop.PCBID,productprop.PCJOID,productprop.SODID,productprop.PONo");
      $r1=mssql_fetch_array($svr2);
 
 $sqlsvr3=mssql_query(" select sum(stockmovementdetails.weight)as berat_c from stockmovement 
left join stockmovementdetails on  stockmovementdetails.stockmovementid=stockmovement.id
left join productprop on productprop.id = stockmovementdetails.productpropid
left join  processflowinspectionprocessno on processflowinspectionprocessno.id=productprop.pfipnid
where stockmovement.wid=22 and stockmovement.transactiontype=4 and stockmovement.transactionstatus=1
and productprop.productiondate between '$tgl_cetak1 15:00:00' and '$tgl_cetak2 22:59:59' and productprop.BatchNo='$row[batchno]' and  processflowinspectionprocessno.PointGradeID='3'");
$row2=mssql_fetch_array($sqlsvr3); 
	
	$sqlsvr4=mssql_query("select sum(stockmovementdetails.weight)as berat_sisa,count(stockmovementdetails.weight)as rol_sisa from stockmovement 
left join stockmovementdetails on  stockmovementdetails.stockmovementid=stockmovement.id
left join productprop on productprop.id = stockmovementdetails.productpropid
left join  processflowinspectionprocessno on processflowinspectionprocessno.id=productprop.pfipnid
where stockmovement.wid=22 and stockmovement.transactiontype=4 and stockmovement.transactionstatus=1
and productprop.productiondate between '$tgl_cetak1 15:00:00' and '$tgl_cetak2 22:59:59' and productprop.BatchNo='$row[batchno]' and stockmovementdetails.RefNo like'%sisa%'
");
$row3=mssql_fetch_array($sqlsvr4);

$sqlsvr5=mssql_query("select sum(stockmovementdetails.weight)as berat_sisa_ab,count(stockmovementdetails.weight)as rol_sisa from stockmovement 
left join stockmovementdetails on  stockmovementdetails.stockmovementid=stockmovement.id
left join productprop on productprop.id = stockmovementdetails.productpropid
left join  processflowinspectionprocessno on processflowinspectionprocessno.id=productprop.pfipnid
where stockmovement.wid=22 and stockmovement.transactiontype=4 and stockmovement.transactionstatus=1
and  (processflowinspectionprocessno.PointGradeID='1' or processflowinspectionprocessno.PointGradeID='2')
and productprop.productiondate between '$tgl_cetak1 15:00:00' and '$tgl_cetak2 22:59:59' and productprop.BatchNo='$row[batchno]' and stockmovementdetails.RefNo like'%sisa%'
");
$row4=mssql_fetch_array($sqlsvr5);
}else{	  
	$sqlsvr2=mssql_query(" select sum(stockmovementdetails.weight)as berat_ab from stockmovement 
left join stockmovementdetails on  stockmovementdetails.stockmovementid=stockmovement.id
left join productprop on productprop.id = stockmovementdetails.productpropid
left join  processflowinspectionprocessno on processflowinspectionprocessno.id=productprop.pfipnid
where stockmovement.wid=22 and stockmovement.transactiontype=4 and stockmovement.transactionstatus=1
and productprop.productiondate between '$tgl_cetak1 23:00:00' and '$tgl_cetak2 06:59:59' and productprop.BatchNo='$row[batchno]' and (processflowinspectionprocessno.PointGradeID='1' or processflowinspectionprocessno.PointGradeID='2')");
$row1=mssql_fetch_array($sqlsvr2); 
 
 $svr2=mssql_query("select count(id) as total ,PCBID,PCJOID,SODID from productprop 
where BatchNo='$row[batchno]' and 
productprop.productiondate between '$tgl_cetak1 23:00:00' 
and '$tgl_cetak2 06:59:59'
group by productprop.PCBID,productprop.PCJOID,productprop.SODID,productprop.PONo");
      $r1=mssql_fetch_array($svr2);
 
 $sqlsvr3=mssql_query(" select sum(stockmovementdetails.weight)as berat_c from stockmovement 
left join stockmovementdetails on  stockmovementdetails.stockmovementid=stockmovement.id
left join productprop on productprop.id = stockmovementdetails.productpropid
left join  processflowinspectionprocessno on processflowinspectionprocessno.id=productprop.pfipnid
where stockmovement.wid=22 and stockmovement.transactiontype=4 and stockmovement.transactionstatus=1
and productprop.productiondate between '$tgl_cetak1 23:00:00' and '$tgl_cetak2 06:59:59' and productprop.BatchNo='$row[batchno]' and  processflowinspectionprocessno.PointGradeID='3'");
$row2=mssql_fetch_array($sqlsvr3); 
	
	$sqlsvr4=mssql_query("select sum(stockmovementdetails.weight)as berat_sisa,count(stockmovementdetails.weight)as rol_sisa from stockmovement 
left join stockmovementdetails on  stockmovementdetails.stockmovementid=stockmovement.id
left join productprop on productprop.id = stockmovementdetails.productpropid
left join  processflowinspectionprocessno on processflowinspectionprocessno.id=productprop.pfipnid
where stockmovement.wid=22 and stockmovement.transactiontype=4 and stockmovement.transactionstatus=1
and productprop.productiondate between '$tgl_cetak1 23:00:00' and '$tgl_cetak2 06:59:59' and productprop.BatchNo='$row[batchno]' and stockmovementdetails.RefNo like'%sisa%'
");
$row3=mssql_fetch_array($sqlsvr4);

$sqlsvr5=mssql_query("select sum(stockmovementdetails.weight)as berat_sisa_ab,count(stockmovementdetails.weight)as rol_sisa from stockmovement 
left join stockmovementdetails on  stockmovementdetails.stockmovementid=stockmovement.id
left join productprop on productprop.id = stockmovementdetails.productpropid
left join  processflowinspectionprocessno on processflowinspectionprocessno.id=productprop.pfipnid
where stockmovement.wid=22 and stockmovement.transactiontype=4 and stockmovement.transactionstatus=1
and  (processflowinspectionprocessno.PointGradeID='1' or processflowinspectionprocessno.PointGradeID='2')
and productprop.productiondate between '$tgl_cetak1 23:00:00' and '$tgl_cetak2 06:59:59' and productprop.BatchNo='$row[batchno]' and stockmovementdetails.RefNo like'%sisa%'
");
$row4=mssql_fetch_array($sqlsvr5);
}
	 
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
    <tr bgcolor="#9999FF">
    <td>&nbsp;</td>
    
    
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
	echo $yardd;?></td>
    <td>
	 <a href="form-Packing?p=mutasi_detail_online&id=<?php echo $row['batchno'];?>&tgl1=<?php echo $tgl_cetak1; ?>&tgl2=<?php echo $tgl_cetak2; ?>&sift=<?php echo $_POST['sift'];?>"><?php echo $row['batchno']; ?></a>
	
	</td>
    <td>&nbsp;</td>
    <td><?php echo $r3['hangerno']; ?></td>
    <td align="center"><font color="#FF0000"><?php echo $keterangan; ?></font></td>
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
 
  ?>
   
  <tr bgcolor="#99FFFF">
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
    <td>&nbsp;</td>
  </tr>
  <tr bgcolor="#99FFFF">
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
    <td>&nbsp;</td>
  </tr>
  
</table>
    <a href="pages/cetak/cetak_online.php?tgl1=<?php echo $tgl_cetak1; ?>&tgl2=<?php echo $tgl_cetak2; ?>&user_name=<?php echo $_POST['user_name']; ?>&sift=<?php echo $_POST['sift']; ?>" target="_blank">Cetak</a>                        


                            
                            
<div class="cleared"></div>
                            </div>
                        </div>
                        <div class="art-Post"></div>
                    </div>
                </div>
                <div class="cleared"></div><div class="art-Footer">
                    <div class="art-Footer-inner">
                        <div class="art-Footer-text">
                          <p><br />
                              Copyright &copy; 2014 ---. All Rights Reserved.</p>
                        </div>
                    </div>
                    <div class="art-Footer-background"></div>
                </div>
        		<div class="cleared"></div>
            </div>
        </div>
        <div class="cleared"></div>
      
    </div>
    
</body>
</html>