  <?php
$host="svr4";
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
</script>
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
      <input type="button" class="art-button" onClick="window.location.href='login.QC-PACKING?act=logout'" value="Logout"/>
                            <?php if($_SESSION['status']==0){ ?><input type="button" class="art-button" onClick="window.location.href='form-Packing'" value="Home"/><input type="button" class="art-button" onClick="window.location.href='form-Packing?p=laporan_harian_online'" value="Laporan"/><br /><?php } ?>
           <form  action="pages/cetak/cetak_online_mutasi.php" method="POST" name="form1">            
                        
       <table width="100%">
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="21" align="center"><b>BUKTI MUTASI KAIN ONLINE</b></td>
  </tr>
  <tr>
  <?php $tgl_cetak1= $_POST['awal'];
   if($_POST['sift']=="3"){$tgl_cetak2=date("Y-m-d",strtotime ( '1 day' , strtotime ($tgl_cetak1)));}else{$tgl_cetak2= $_POST['awal'];} ?>
    <td colspan="23"><b>Tanggal : <?php echo  date("d-M-Y", strtotime($tgl_cetak1))." s/d ".date("d-M-Y", strtotime($tgl_cetak2)); ?><br> SHIFT : <?php echo $_POST['sift'];?>
    <br />GROUP SHIFT: <?php echo $_POST['user_name']; ?></b></td>
  </tr>
  <tr align="center" bgcolor="#0099FF">
    <td  rowspan="2"><input type="checkbox" name="allbox" value="check" onClick="checkAll(0);" /></td>
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
		 $n=1;
  while($row=mssql_fetch_array($sqlsvr1))
  {
	  	   $cek=mysql_query("select * from mutasi_kain where nokk='$row[batchno]' and userid like '%$_POST[user_name]%'");
		   $crow=mysql_fetch_array($cek);
	  if($crow>0){}else{
	  
	  
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

$sqlsvr9=mssql_query("select otherdesc,salesorders.ponumber,processcontrol.productid,salesorders.customerid,joborders.documentno,
salesorders.buyerid,processcontrolbatches.lotno,hangerno,color,colorno,shortdescription,weight,cuttablewidth from Joborders 
left join processcontrolJO on processcontrolJO.joid = Joborders.id
left join salesorders on soid= salesorders.id
left join sogarmentstyle on sogarmentstyle.soid= salesorders.id
left join processcontrol on processcontrolJO.pcid = processcontrol.id
left join processcontrolbatches on processcontrolbatches.pcid = processcontrol.id
left join productmaster on productmaster.id= processcontrol.productid  
where processcontrolbatches.documentno='$row[batchno]'

");
$row9=mssql_fetch_array($sqlsvr9);

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

$sqlsvr9=mssql_query("select otherdesc,salesorders.ponumber,processcontrol.productid,salesorders.customerid,joborders.documentno,
salesorders.buyerid,processcontrolbatches.lotno,hangerno,color,colorno,shortdescription,weight,cuttablewidth from Joborders 
left join processcontrolJO on processcontrolJO.joid = Joborders.id
left join salesorders on soid= salesorders.id
left join sogarmentstyle on sogarmentstyle.soid= salesorders.id
left join processcontrol on processcontrolJO.pcid = processcontrol.id
left join processcontrolbatches on processcontrolbatches.pcid = processcontrol.id
left join productmaster on productmaster.id= processcontrol.productid  
where processcontrolbatches.documentno='$row[batchno]'

");
$row9=mssql_fetch_array($sqlsvr9);

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

$sqlsvr9=mssql_query("select otherdesc,salesorders.ponumber,processcontrol.productid,salesorders.customerid,joborders.documentno,
salesorders.buyerid,processcontrolbatches.lotno,hangerno,color,colorno,shortdescription,weight,cuttablewidth from Joborders 
left join processcontrolJO on processcontrolJO.joid = Joborders.id
left join salesorders on soid= salesorders.id
left join sogarmentstyle on sogarmentstyle.soid= salesorders.id
left join processcontrol on processcontrolJO.pcid = processcontrol.id
left join processcontrolbatches on processcontrolbatches.pcid = processcontrol.id
left join productmaster on productmaster.id= processcontrol.productid  
where processcontrolbatches.documentno='$row[batchno]'

");
$row9=mssql_fetch_array($sqlsvr9);
}
$svr3=mssql_query("select productid,weight as bruto,soid  from sodetails where id='$r1[SODID]'");
 	  $r2=mssql_fetch_array($svr3);
	  $produk=mssql_query("select shortdescription,colorno,color,hangerno from productmaster where id='$row9[productid]'");
 	  $r3=mssql_fetch_array($produk);
	  $so=mssql_query("select customerid,buyerid from salesorders where id='$r2[soid]'");
 	  $r4=mssql_fetch_array($so);
	  $p1=mssql_query("select partnername from partners where id='$row9[customerid]'");
 	  $r5=mssql_fetch_array($p1);
	  $p2=mssql_query("select partnername from partners where id='$row9[buyerid]'");
 	  $r6=mssql_fetch_array($p2);
	  $lot=mssql_query("select pcid,lotno,childlevel from processcontrolbatches where id='$r1[PCBID]'");
 	  $r7=mssql_fetch_array($lot);	  
	  $lot1=mssql_query("select count(CID)as lot from processcontrolbatches where pcid='$r7[pcid]'
group by processcontrolbatches.CID");
	  $r8=mssql_fetch_array($lot1);	 
	$itm=mssql_query("select colorcode,color,productcode from productpartner where productid='$row9[productid]' and partnerid='$row9[customerid]'");
	$itm2=mssql_fetch_array($itm); 
	  if($itm2['productcode']!=''){$item=$itm2['productcode'];}else{$item=$row9['hangerno'];}	 
	 $gross1= mssql_query("select sum(stockmovementdetails.weight) as gross from stockmovement 
LEFT join stockmovementdetails on StockMovement.id=stockmovementdetails.StockmovementID
left join processcontrolbatches on processcontrolbatches.id=stockmovement.pcbid
where wid='12' and transactiontype='7' and processcontrolbatches.documentno='$row[batchno]'");
  		 $r9=mssql_fetch_array($gross1);
		 if($r7['childlevel'] > 0){$lotn=number_format(substr($r7['lotno'],3,3))."K".$r7['childlevel'];}else{$lotn=$r7['lotno'];}
	  ?>
    <tr bgcolor="#9999FF">
      <td><?php
   
     echo '<input type="checkbox" name="check['.$n.']" value="'.$n.'" /> - Pilihan / opsi ke '.$n;
  $n++;
   ?></td>
    <td>&nbsp;</td>
    
    
    <td><?php echo $r5['partnername']." / ".$r6['partnername']; ?></td>
    <td><?php echo $row['pono']; ?></td>
    <td><?php echo $row['dono']; ?></td>
    <td><?php echo $r3['shortdescription']; ?></td>
    <td><?php echo $r3['colorno']; ?></td>
    <td><?php echo $r3['color']; ?></td>
    <td><?php echo number_format($row['Width']-2)."/".number_format($row['WeightPerArea']); ?></td>
    <td><?php echo $r8['lot']."-".$lotn; ?></td>
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
	 <a href="form-Packing?p=mutasi_detail_online&id=<?php echo $row['batchno'];?>&tgl1=<?php echo $tgl_cetak1; ?>&tgl2=<?php echo $tgl_cetak2; ?>&sift=<?php echo $_POST['sift'];?>&bagian=<?php echo $_POST['user_name']; ?>"><?php echo $row['batchno']; ?></a>
	
	</td>
    <td>&nbsp;</td>
    <td><?php echo $item; ?></td>
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
    <input name="tgl1" type="hidden" value="<?php echo $tgl_cetak1; ?>">
    <input name="tgl2" type="hidden" value="<?php echo $tgl_cetak2; ?>">
    <input name="user_name" type="hidden" value="<?php echo $_POST['user_name']; ?>">
    <input name="sift" type="hidden" value="<?php echo $_POST['sift']; ?>">
    <input name="cetak" type="submit" value="cetak">                       
</form>
<input name="" type="hidden" value="tgl2">
                           
                            
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