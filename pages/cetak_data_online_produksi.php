<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=kain_jadi_ol.xls");//ganti nama sesuai keperluan
header("Pragma: no-cache");
header("Expires: 0");
//disini script laporan anda
?>
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
<body>
<table width="100%" border="1">
  <tr>
    <td colspan="23" align="center"><b>LAPORAN HARIAN ONLINE KAIN JADI </b></td>

  </tr>
  <tr>
    <td colspan="23"><b>Tanggal : <?php echo  date("d-M-Y", strtotime($_GET['tgl1']))." s/d ".date("d-M-Y", strtotime($_GET['tgl2'])); ?></b></td>

  </tr>
  <tr align="center" >
    <td  rowspan="2">NO ITEM</td>
    
    
    <td rowspan="2">LANGGANAN</td>
    <td rowspan="2">PO</td>
    <td rowspan="2">ORDER</td>
    <td rowspan="2">JENIS KAIN</td>
    <td rowspan="2">NO WARNA</td>
    <td rowspan="2">WARNA</td>
    <td rowspan="2">No CARD</td>
    <td rowspan="2">LOT</td>
    <td rowspan="2">ROLL</td>
    <td colspan="3">NETTO (KG)</td>
    <td colspan="2">SISA</td>
    <td rowspan="2">Yard</td>
    <td rowspan="2">UNIT</td>
    <td rowspan="2">EXTRA Q</td>
    <td rowspan="2">LBR</td>
    <td rowspan="2">X</td>
    <td rowspan="2">GRMS</td>
    <td rowspan="2">OL</td>
    <td rowspan="2">Keterangan</td>
  </tr>
  <tr align="center" >
    <td>GRADE<br /> A+B</td>
    <td>GRADE<br /> C</td>
    <td>Keterangan<br />(Grade C)</td>
    <td> ROLL</td>
    <td>QTY(KG)</td>
    </tr>
  <?php 
	  $sqlsvr1=mssql_query("select count(stockmovementdetails.weight)as rol,stockmovement.pono as dono,productprop.pono as pono,productprop.batchno,productprop.Width,productprop.WeightPerArea from stockmovement 
left join stockmovementdetails on  stockmovementdetails.stockmovementid=stockmovement.id
left join productprop on productprop.id = stockmovementdetails.productpropid
where stockmovement.wid=22 and stockmovement.transactiontype=4 and stockmovement.transactionstatus=1
and productprop.productiondate between '$_GET[tgl1] 07:00:00' and '$_GET[tgl2] 07:00:00' 
group by stockmovement.ID,stockmovement.PONo,productprop.BatchNo,productprop.PONo,productprop.Width,productprop.WeightPerArea");
	 
  while($row=mssql_fetch_array($sqlsvr1))
  {
	  	   $cek=mysql_query("select * from mutasi_kain where nokk='$row[batchno]'");
		   $crow=mysql_fetch_array($cek);
	  if($crow>0){$keterangan="OUT";}else{$keterangan="";}

	$svr2=mssql_query("select count(id) as total ,PCBID,PCJOID,SODID from productprop 
where BatchNo='$row[batchno]' and 
productprop.productiondate between '$_GET[tgl1] 07:00:00' 
and '$_GET[tgl2] 07:00:00'
group by productprop.PCBID,productprop.PCJOID,productprop.SODID,productprop.PONo");
      $r1=mssql_fetch_array($svr2);
	  	
	$sqlsvr2=mssql_query("select sum(stockmovementdetails.weight)as berat_ab from stockmovement 
left join stockmovementdetails on  stockmovementdetails.stockmovementid=stockmovement.id
left join productprop on productprop.id = stockmovementdetails.productpropid
left join  processflowinspectionprocessno on processflowinspectionprocessno.id=productprop.pfipnid
where stockmovement.wid=22 and stockmovement.transactiontype=4 and stockmovement.transactionstatus=1
and productprop.productiondate between '$_GET[tgl1] 07:00:00' and '$_GET[tgl2] 07:00:00' and productprop.BatchNo='$row[batchno]' and (processflowinspectionprocessno.PointGradeID='1' or processflowinspectionprocessno.PointGradeID='2')");
$row1=mssql_fetch_array($sqlsvr2); 

$sqlsvr3=mssql_query(" select sum(stockmovementdetails.weight)as berat_c from stockmovement 
left join stockmovementdetails on  stockmovementdetails.stockmovementid=stockmovement.id
left join productprop on productprop.id = stockmovementdetails.productpropid
left join  processflowinspectionprocessno on processflowinspectionprocessno.id=productprop.pfipnid
where stockmovement.wid=22 and stockmovement.transactiontype=4 and stockmovement.transactionstatus=1
and productprop.productiondate between '$_GET[tgl1] 07:00:00' and '$_GET[tgl2] 07:00:00' and productprop.BatchNo='$row[batchno]' and  processflowinspectionprocessno.PointGradeID='3'");
$row2=mssql_fetch_array($sqlsvr3); 
	
	$sqlsvr4=mssql_query("select sum(stockmovementdetails.weight)as berat_sisa,count(stockmovementdetails.weight)as rol_sisa from stockmovement 
left join stockmovementdetails on  stockmovementdetails.stockmovementid=stockmovement.id
left join productprop on productprop.id = stockmovementdetails.productpropid
left join  processflowinspectionprocessno on processflowinspectionprocessno.id=productprop.pfipnid
where stockmovement.wid=22 and stockmovement.transactiontype=4 and stockmovement.transactionstatus=1
and productprop.productiondate between '$_GET[tgl1] 07:00:00' and '$_GET[tgl2] 07:00:00' and productprop.BatchNo='$row[batchno]' and (stockmovementdetails.RefNo like'%sisa%' or productprop.rollno like'%sisa%')
");
$row3=mssql_fetch_array($sqlsvr4);

$sqlsvr5=mssql_query("select sum(stockmovementdetails.weight)as berat_sisa_ab,count(stockmovementdetails.weight)as rol_sisa from stockmovement 
left join stockmovementdetails on  stockmovementdetails.stockmovementid=stockmovement.id
left join productprop on productprop.id = stockmovementdetails.productpropid
left join  processflowinspectionprocessno on processflowinspectionprocessno.id=productprop.pfipnid
where stockmovement.wid=22 and stockmovement.transactiontype=4 and stockmovement.transactionstatus=1
and  (processflowinspectionprocessno.PointGradeID='1' or processflowinspectionprocessno.PointGradeID='2')
and productprop.productiondate between '$_GET[tgl1] 07:00:00' and '$_GET[tgl2] 07:00:00' and productprop.BatchNo='$row[batchno]' and stockmovementdetails.RefNo like'%sisa%'

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
		  $extra= mssql_query("select stockmovementdetails.refno,stockmovementdetails.weight from stockmovement 
left join stockmovementdetails on  stockmovementdetails.stockmovementid=stockmovement.id
left join productprop on productprop.id = stockmovementdetails.productpropid
where stockmovement.wid=22 and stockmovement.transactiontype=4 and stockmovement.transactionstatus=1 and productprop.productiondate between '$tgl_cetak1 07:00:00' and '$tgl_cetak2 07:00:00' and stockmovementdetails.refno like '%extra%' and productprop.BatchNo='$row[batchno]'");
  		 $r10=mssql_fetch_array($extra);
	  ?>
    <tr >
    <td><?php echo $r3['hangerno']; ?></td>
    
    
    <td><?php echo $r5['partnername']." / ".$r6['partnername']; ?></td>
    <td><?php echo $row['pono']; ?></td>
    <td><?php echo $row['dono']; ?></td>
    <td><?php echo htmlentities($r3['shortdescription'],ENT_QUOTES); ?></td>
    <td><?php echo $r3['colorno']; ?></td>
    <td><?php echo $r3['color']; ?></td>
    <td>' <?php echo $row['batchno']; ?></td>
    <td>'  <?php echo $r8['lot']."-".$r7['lotno']; ?></td>
    <td align="right"><?php echo $row['rol']-$row3['rol_sisa']; ?></td>
    <td align="right"><?php if($row3['berat_sisa']!=""){echo number_format($row1['berat_ab']-$row4['berat_sisa_ab'],'2','.',',');}else {echo  number_format($row1['berat_ab'],'2','.',',');} ?></td>
    <td align="right"><?php echo number_format($row2['berat_c'],'2','.',',') ;?></td>
    <td>&nbsp;</td>
    <td align="right"><?php echo $row3['rol_sisa'];?></td>
    <td align="right"><?php echo number_format($row3['berat_sisa'],'2','.',',') ;?></td>
    <td align="right"><?php 
	$X=1000/(($row['Width']*$row['WeightPerArea'])/43.05);
	$yardd1=round($X,2);
	$yd=round(($row1['berat_ab']+$row2['berat_c'])*$X,2);
	echo number_format($yd,'2','.',',');?></td>
    <td>&nbsp;</td>
    <td><?php echo number_format($r10['weight'],'2','.',',');?></td>
    <td><?php echo number_format($row['Width']-2); ?></td>
    <td>X</td>
    <td><?php echo number_format($row['WeightPerArea']); ?></td>
    <td align="center">&nbsp;</td>
    <td align="center"><font color="#FF0000"><?php echo $keterangan; ?></font></td>
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
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr >
    <td>&nbsp;</td>
    
    
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><b>Total</b></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><b><?php echo $totrol;?></b></td>
    <td align="right"><b><?php echo number_format($totab,'2','.',',');?></b></td>
    <td align="right"><b><?php echo number_format($tota,'2','.',',');?></b></td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td align="right"><b><?php echo number_format($totyard,'2','.',',');?></b></td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr >
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
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr >
    <td colspan="23">&nbsp;</td>
  </tr>
  <tr >
    <td colspan="3" align="center">&nbsp;</td>
    <td colspan="4" align="center">Dibuat Oleh</td>
    <td colspan="6" align="center">Diperiksa oleh</td>
    <td colspan="10" align="center">Diketahui oleh</td>
  </tr>
  <tr >
    <td colspan="3" >Nama </td>
    <td colspan="4" align="center">&nbsp;</td>
    <td colspan="6" align="center">&nbsp;</td>
    <td colspan="10" align="center">&nbsp;</td>
  </tr>
  <tr >
    <td colspan="3" >Jabatan</td>
    <td colspan="4" align="center">Clerk</td>
    <td colspan="6" align="center">Supervisor</td>
    <td colspan="10" align="center">Asst. Manager</td>
  </tr>
  <tr >
    <td colspan="3" >Tanggal</td>
    <td colspan="4" align="center">&nbsp;</td>
    <td colspan="6" align="center">&nbsp;</td>
    <td colspan="10" align="center">&nbsp;</td>
  </tr>
  <tr >
    <td colspan="3" ><p>Tanda Tangan</p>
    <p>&nbsp;</p></td>
    <td colspan="4" align="center">&nbsp;</td>
    <td colspan="6" align="center">&nbsp;</td>
    <td colspan="10" align="center">&nbsp;</td>
  </tr>
  
</table>                   


    
</body>
</html>