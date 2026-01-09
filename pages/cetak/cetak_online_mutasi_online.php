<?php
$host="svr4";
$username="timdit";
$password="4dm1n";
$db_name="TM";
 set_time_limit(600);
	$conn=mssql_connect($host,$username,$password) or die ("Sorry our web is under maintenance. Please visit us later");
	mssql_select_db($db_name) or die ("Under maintenance");
?>
 <?php 
mysql_connect("svr1","root","itc0920");
mysql_select_db("db_qc")or die("Gagal Koneksi");
	 $msql1=mysql_query("select * from mutasi_kain where no_mutasi='$_GET[mutasi]'");
	 $rowsql1=mysql_fetch_array($msql1);
	 
	 if(substr($rowsql1['userid'],0,7)=="PACKING"){$bgn="not";}else{$bgn=" ";}
	  $sqlsvrq=mssql_query("select stockmovement.dated,count(stockmovementdetails.weight)as rol,stockmovement.pono as dono,productprop.pono as pono,productprop.batchno,productprop.Width,productprop.WeightPerArea from stockmovement 
left join stockmovementdetails on  stockmovementdetails.stockmovementid=stockmovement.id
left join productprop on productprop.id = stockmovementdetails.productpropid
where stockmovement.wid=22 and stockmovement.transactiontype=4 and stockmovement.transactionstatus=1
and productprop.BatchNo='$rowsql1[nokk]' and CAST(TM.dbo.stockmovement.[note] AS VARCHAR(8000)) $bgn like '%IM%'
group by stockmovement.Dated,stockmovement.ID,stockmovement.PONo,productprop.BatchNo,productprop.PONo,productprop.Width,productprop.WeightPerArea");	
$rowq=mssql_fetch_array($sqlsvrq);	
	 
	?>
    
<html>
<head>
<title>:: Cetak MUTASI KAIN JADI Online</title>
<link href="../styles_cetak.css" rel="stylesheet" type="text/css">
<style>
input{
text-align:center;
border:hidden;
}
</style>
</head>
<body>
<div align="center"> <h2>MUTASI KAIN JADI ONLINE</h2></div>
<table border="0" width="100%" class="table-list1">
  <tr >
    

    <td colspan="20" bgcolor="#F5F5F5"><table width="100%" border="0" class="table-list1">
      <tr>
        <td width="79%" ><p><b>Tanggal : <?php echo date("d F Y",strtotime($rowq['dated'])); ?></b>
          <b><br>GROUP SHIFT: <?php echo $rowsql1['userid']; ?> <br>
            SHIFT : <?php ?><br>
          No Mutasi : <?php echo $rowsql1['no_mutasi']; ?></b></p></td>
        <td width="21%" ><table width="100%" border="0" class="table-list1">
          <tr>
            <td width="43%" scope="col">No Form</td>
            <td width="10%" scope="col">:</td>
            <td width="47%" scope="col">19-13</td>
          </tr>
          <tr>
            <td>No. Revisi</td>
            <td>:</td>
            <td>04</td>
          </tr>
          <tr>
            <td>Tgl. Terbit</td>
            <td>:</td>
            <td>&nbsp;</td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr align="center" bgcolor="#CCCCCC">
    <td  rowspan="2" bgcolor="#F5F5F5">No MC</td>
    <td  rowspan="2" bgcolor="#F5F5F5">Langganan</td>
    <td  rowspan="2" bgcolor="#F5F5F5">PO</td>
    <td  rowspan="2" bgcolor="#F5F5F5">Order</td>
    <td  rowspan="2" bgcolor="#F5F5F5">Jenis.......Kain</td>
    <td  rowspan="2" bgcolor="#F5F5F5">No. Warna</td>
    <td  rowspan="2" bgcolor="#F5F5F5">Warna</td>
    <td  rowspan="2" bgcolor="#F5F5F5">L/Grm2</td>
    <td  rowspan="2" bgcolor="#F5F5F5" >Lot</td>
    <td  rowspan="2" bgcolor="#F5F5F5">Jml<br>Roll</td>
    <td  rowspan="2" bgcolor="#F5F5F5">Bruto (Kg)</td>
    <td colspan="3" bgcolor="#F5F5F5">Netto (KG)</td>
    <td colspan="2" bgcolor="#F5F5F5">SISA</td>
    <td  rowspan="2" bgcolor="#F5F5F5">Yard</td>
    <td  rowspan="2" bgcolor="#F5F5F5">No.Kartu Kerja</td>
    <td  rowspan="2" bgcolor="#F5F5F5">Tempat</td>
    <td  rowspan="2" bgcolor="#F5F5F5">Item</td>
  </tr>
  <tr align="center" bgcolor="#0099FF">
    
    <td  bgcolor="#F5F5F5">Grade<br /> A+B</td>
    <td  bgcolor="#F5F5F5">Grade <br /> C</td>
    <td  bgcolor="#F5F5F5">Keterangan<br />(Grade C)</td>
    <td  bgcolor="#F5F5F5">Jml. Roll</td>
    <td  bgcolor="#F5F5F5">Qty(KG)</td>
    
    </tr>
 <?php 
  
	 	 $msql=mysql_query("select * from mutasi_kain where no_mutasi='$_GET[mutasi]'");
		 
  while($rowsql=mysql_fetch_array($msql))
  {
	  
	if(substr($rowsql['userid'],0,7)=="PACKING"){$bgn="not";}else{$bgn=" ";}
	  $sqlsvr1=mssql_query("select stockmovement.dated,count(stockmovementdetails.weight)as rol,stockmovement.pono as dono,productprop.pono as pono,productprop.batchno,productprop.Width,productprop.WeightPerArea from stockmovement 
left join stockmovementdetails on  stockmovementdetails.stockmovementid=stockmovement.id
left join productprop on productprop.id = stockmovementdetails.productpropid
where stockmovement.wid=22 and stockmovement.transactiontype=4 and stockmovement.transactionstatus=1
and productprop.BatchNo='$rowsql[nokk]' and CAST(TM.dbo.stockmovement.[note] AS VARCHAR(8000)) $bgn like '%IM%'
group by stockmovement.Dated,stockmovement.ID,stockmovement.PONo,productprop.BatchNo,productprop.PONo,productprop.Width,productprop.WeightPerArea");	
$row=mssql_fetch_array($sqlsvr1);	  
	  
	$svr2=mssql_query("select count(id) as total ,PCBID,PCJOID,SODID from productprop 
where BatchNo='$rowsql[nokk]'
group by productprop.PCBID,productprop.PCJOID,productprop.SODID,productprop.PONo");
      $r1=mssql_fetch_array($svr2);
	  	
	$sqlsvr2=mssql_query("select sum(stockmovementdetails.weight)as berat_ab from stockmovement 
left join stockmovementdetails on  stockmovementdetails.stockmovementid=stockmovement.id
left join productprop on productprop.id = stockmovementdetails.productpropid
left join  processflowinspectionprocessno on processflowinspectionprocessno.id=productprop.pfipnid
where stockmovement.wid=22 and stockmovement.transactiontype=4 and stockmovement.transactionstatus=1 and productprop.BatchNo='$rowsql[nokk]' and (processflowinspectionprocessno.PointGradeID='1' or processflowinspectionprocessno.PointGradeID='2')");
$row1=mssql_fetch_array($sqlsvr2); 

$sqlsvr3=mssql_query(" select sum(stockmovementdetails.weight)as berat_c from stockmovement 
left join stockmovementdetails on  stockmovementdetails.stockmovementid=stockmovement.id
left join productprop on productprop.id = stockmovementdetails.productpropid
left join  processflowinspectionprocessno on processflowinspectionprocessno.id=productprop.pfipnid
where stockmovement.wid=22 and stockmovement.transactiontype=4 and stockmovement.transactionstatus=1 and productprop.BatchNo='$rowsql[nokk]' and  processflowinspectionprocessno.PointGradeID='3'");
$row2=mssql_fetch_array($sqlsvr3); 
	
	$sqlsvr4=mssql_query("select sum(stockmovementdetails.weight)as berat_sisa,count(stockmovementdetails.weight)as rol_sisa from stockmovement 
left join stockmovementdetails on  stockmovementdetails.stockmovementid=stockmovement.id
left join productprop on productprop.id = stockmovementdetails.productpropid
left join  processflowinspectionprocessno on processflowinspectionprocessno.id=productprop.pfipnid
where stockmovement.wid=22 and stockmovement.transactiontype=4 and stockmovement.transactionstatus=1 and productprop.BatchNo='$rowsql[nokk]' and (stockmovementdetails.RefNo like'%sisa%' or productprop.rollno like'%sisa%')
");
$row3=mssql_fetch_array($sqlsvr4);

$sqlsvr5=mssql_query("select sum(stockmovementdetails.weight)as berat_sisa_ab,count(stockmovementdetails.weight)as rol_sisa from stockmovement 
left join stockmovementdetails on  stockmovementdetails.stockmovementid=stockmovement.id
left join productprop on productprop.id = stockmovementdetails.productpropid
left join  processflowinspectionprocessno on processflowinspectionprocessno.id=productprop.pfipnid
where stockmovement.wid=22 and stockmovement.transactiontype=4 and stockmovement.transactionstatus=1
and  (processflowinspectionprocessno.PointGradeID='1' or processflowinspectionprocessno.PointGradeID='2')
and productprop.BatchNo='$rowsql[nokk]' and stockmovementdetails.RefNo like'%sisa%'

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
where processcontrolbatches.documentno='$rowsql[nokk]'

");
$row9=mssql_fetch_array($sqlsvr9);


	 
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
where wid='12' and transactiontype='7' and processcontrolbatches.documentno='$rowsql[nokk]'");
  		 $r9=mssql_fetch_array($gross1);
$extra= mssql_query("select stockmovementdetails.weight, count(productprop.BatchNo) as roll,productprop.BatchNo  from stockmovement 
left join stockmovementdetails on  stockmovementdetails.stockmovementid=stockmovement.id
left join productprop on productprop.id = stockmovementdetails.productpropid
where stockmovement.wid=22 and stockmovement.transactiontype=4 and stockmovement.transactionstatus=1 
and productprop.BatchNo='$rowsql[nokk]'
and (stockmovementdetails.refno like '%extra%' or stockmovementdetails.refno like '%FOC%') 
group by stockmovementdetails.Weight,productprop.BatchNo");
  		 $r10=mssql_fetch_array($extra);
		 		 
		 if($r7['childlevel'] > 0){$lotn=number_format(substr($r7['lotno'],3,3))."K".$r7['childlevel'];}else{$lotn=$r7['lotno'];}
	  ?>
   <tr>
    <td>&nbsp;</td>
    
    <td><?php echo $r5['partnername']." / ".$r6['partnername']; ?></td>
    <td><?php echo substr($row['pono'],0,12)." ".substr($row['pono'],12,12)." ".substr($row['pono'],22,31); ?></td>
    <td><?php echo substr($row['dono'],0,7)." ".substr($row['dono'],7,11); ?></td>
    <td><?php echo $r3['shortdescription']; ?></td>
    <td><?php echo $r3['colorno']; ?></td>
    <td><?php echo $r3['color']; ?></td>
    <td><?php echo number_format($row['Width']-2)."/".number_format($row['WeightPerArea']); ?></td>
    <td><?php echo $r8['lot']."-".$lotn; ?></td>
    <td align="right"><?php echo $row['rol']-$row3['rol_sisa']; ?></td>
    <td align="right"><?php echo number_format($r9['gross'],'2','.',','); ?></td>
    <td align="right"><?php if($row3['berat_sisa']!=""){echo number_format($row1['berat_ab']-$row4['berat_sisa_ab'],'2','.',',');}else {echo  number_format($row1['berat_ab'],'2','.',',');} ?></td>
    <td align="right"><?php echo number_format($row2['berat_c'],'2','.',',') ;?></td>
    <td><?php if($r10['roll'] > 0){echo "Ada EXTRA ".$r10['roll']." Roll";}?></td>
    <td align="right"><?php echo $row3['rol_sisa'];?></td>
    <td align="right"><?php echo number_format($row3['berat_sisa'],'2','.',',') ;?></td>
    <td align="right"><?php 
	$X=1000/(($row['Width']*$row['WeightPerArea'])/43.05);
	$yardd1=round($X,2);
	$yd=round(($row1['berat_ab']+$row2['berat_c'])*$X,2);
	echo number_format($yd,'2','.',',');?></td>
    <td><?php echo substr($row['batchno'],0,7)." ".substr($row['batchno'],7,10); ?></td>
    <td>&nbsp;</td>
    <td><?php echo $item; ?></td>
  </tr>
 
      <?php
	  $totbruto=$totbruto+$r9['gross'];
	  $totyard=$totyard+ $yd;
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
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td colspan="2" bgcolor="#FFFFFF"><b>Total</b></td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td align="right" bgcolor="#FFFFFF"><b><?php echo $totrol;?></td>
    <td align="right" bgcolor="#FFFFFF"><b><?php echo number_format($totbruto,'2','.',',');?></b></td>
    <td align="right" bgcolor="#FFFFFF"><b><?php echo number_format($totab,'2','.',',');?></b></td>
    <td align="right" bgcolor="#FFFFFF"><b><?php echo number_format($tota,'2','.',',');?></b></td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td align="right" bgcolor="#FFFFFF">&nbsp;</td>
    <td align="right" bgcolor="#FFFFFF">&nbsp;</td>
    <td align="right" bgcolor="#FFFFFF"><b><?php echo number_format($totyard,'2','.',',');?></b></td>
    
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    
  </tr>  
  
  <tr>
    <td colspan="23">&nbsp;</td>
  </tr> 
</table> 
   <table border="0" class="table-list1" width="98%"> 
  <tr align="center">
    <td colspan="3">&nbsp;</td>
    <td colspan="8">Departemen QCF</td>
    <td colspan="10">Departemen Gudang Kain Jadi</td>
  </tr>
  <tr align="center">
    <td colspan="3">&nbsp;</td>
    <td colspan="3">Diserahkan Oleh :</td>
    <td colspan="5">Diketahui Oleh :</td>
    <td colspan="6">Diterima Oleh :</td>
    <td colspan="4"> Diketahui Oleh :</td>
  </tr>
  <tr>
    <td colspan="3">Nama</td>
    <td colspan="3" align="center"><input type=text name=nama placeholder="Ketik disini"></td>
    <td colspan="5" align="center"><input type=text name=nama1 placeholder="Ketik disini"></td>
    <td colspan="6">&nbsp;</td>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">Jabatan</td>
    <td colspan="3" align="center"><input type=text name=nama2 placeholder="Ketik disini"></td>
    <td colspan="5" align="center" ><input type=text name=nama3 placeholder="Ketik disini"></td>
    <td colspan="6">&nbsp;</td>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">Tanggal</td>
    <td colspan="3" align="center"><?php echo date("d-M-Y"); ?></td>
    <td colspan="5" align="center"><?php echo date("d-M-Y"); ?></td>
    <td colspan="6">&nbsp;</td>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" height="60" valign="top">Tanda Tangan</td>
    <td colspan="3">&nbsp;</td>
    <td colspan="5">&nbsp;</td>
    <td colspan="6">&nbsp;</td>
    <td colspan="4">&nbsp;</td>
  </tr>
</table>
<img src="../btn_print.png" height="20" id="nocetak" onClick="javascript:window.print()" />                          

</body>
                            
                            
      