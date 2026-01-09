<style>
input{
text-align:center;
border:hidden;
}
body,td,th {
  /*font-family: Courier New, Courier, monospace; */ 
  font-family:sans-serif, Roman, serif;
}
body{
	margin:0px auto 0px;
	padding:1px;
	font-size:10px;
	color:#333;
	width:98%;
	background-position:top;
	background-color:#fff;
}
.table-list {
	clear: both;
	text-align: left;
	border-collapse: collapse;
	margin: 0px 0px 2px 0px;
	background:#fff;	
}
.table-list td {
	color: #333;
	font-size:12px;
	border-color: #fff;
	border-collapse: collapse;
	vertical-align: center;
	padding: 0px 1px;
	border-bottom:0px #000000 solid;
	border-top:0px #000000 solid;
	border-left:0px #000000 solid;
	border-right:0px #000000 solid;

	
}
.table-list1 {
	clear: both;
	text-align: left;
	border-collapse: collapse;
	margin: 0px 0px 2px 0px;
	background:#fff;	
}
.table-list1 td {
	color: #333;
	font-size:12px;
	border-color: #fff;
	border-collapse: collapse;
	vertical-align: center;
	padding: 0px 1px;
	border-bottom:1px #000000 solid;
	border-top:1px #000000 solid;
	border-left:1px #000000 solid;
	border-right:1px #000000 solid;
	
	
}
@media print {
#nocetak {
	display:none;
	}
}
</style>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SURAT JALAN</title>

<link rel="icon" type="image/png" href="../images/icon.png">
</head>

<body>
<?php
//ini_set('error_reporting',1);
include"../koneksi.php";
	?> 
<?php
if($_GET['tgl_kirim']!=""){$tglkirim=" and tgl_update='".$_GET['tgl_kirim']."' ";}else{$tglkirim=" and DATE_FORMAT(tgl_update,'%y')=DATE_FORMAT(NOW(),'%y')";}
$sqlLot=mysqli_query($con,"select count(*) as `jmlLot` from (SELECT no_sj, count(detail_pergerakan_stok.no_roll) as roll,sum(detail_pergerakan_stok.weight) as _berat,sum(detail_pergerakan_stok.yard_) as _yard_  from packing_list 
LEFT JOIN detail_pergerakan_stok ON packing_list.listno=detail_pergerakan_stok.refno
LEFT JOIN tmp_detail_kite ON detail_pergerakan_stok.id_detail_kj=tmp_detail_kite.id
LEFT JOIN tbl_kite ON tmp_detail_kite.id_kite=tbl_kite.id
WHERE  `packing_list`.`no_sj`='".$_GET['no_sj']."' ".$tglkirim."
GROUP BY SUBSTR(detail_pergerakan_stok.nokk,1,11),tbl_kite.no_lot) a
group by a.no_sj");
$jdr=mysqli_fetch_array($sqlLot);
$rtLot=ceil($jdr['jmlLot']/4);	
	for($z=1;$z <=$rtLot; $z++){
$sqllist= mysqli_query($con,"SELECT packing_list.*,tbl_kite.pelanggan,tbl_kite.no_po as nopo,detail_pergerakan_stok.satuan,detail_pergerakan_stok.sisa from packing_list 
LEFT JOIN detail_pergerakan_stok ON packing_list.listno=detail_pergerakan_stok.refno
LEFT JOIN tmp_detail_kite ON detail_pergerakan_stok.id_detail_kj=tmp_detail_kite.id
LEFT JOIN tbl_kite ON tmp_detail_kite.id_kite=tbl_kite.id
WHERE  `packing_list`.`no_sj`='".$_GET['no_sj']."' ".$tglkirim."  
GROUP BY `packing_list`.`no_sj`
"); 
	
     $dr=mysqli_fetch_array($sqllist);
	 $order=trim($dr['no_order']);
	$sqlb=sqlsrv_query($conn,"SELECT 
*
 FROM
   
(SELECT ROW_NUMBER() 
        OVER (ORDER BY processcontrolJO.SODID) AS Row, 
       description,SODelivery.ConsigneeID AS id
    FROM 
Joborders 
left join processcontrolJO on processcontrolJO.joid = Joborders.id
left join salesorders on soid= salesorders.id
left join SODelivery on  salesorders.id= SODelivery.SOID
left join processcontrol on processcontrolJO.pcid = processcontrol.id
left join processcontrolbatches on processcontrolbatches.pcid = processcontrol.id
left join productmaster on productmaster.id= processcontrol.productid
left join productpartner on productpartner.productid= processcontrol.productid
where  JobOrders.documentno = '$order' and not Description='' 
) AS EMP
WHERE Row = 1");
$rbuyer=sqlsrv_fetch_array($sqlb,SQLSRV_FETCH_ASSOC);
?>

<table width="100%" border="0" class="table-list1">
  <tr>
    <td width="7%" rowspan="3"><center><img src="../images/logo.jpg" alt="" width="60" height="40"/></center></td>
    <td width="67%" rowspan="3"><strong><font size="+1"><center>SURAT JALAN</center></font></strong></td>
    <td width="12%" rowspan="3"><center><img src="../images/iso-ukas.jpg" alt="" width="120" height="40" /></center></td>
    <td width="14%"><strong><font size="-4">NO. FORM : 19-11</font></strong></td>
  </tr>
  <tr>
    <td><strong><font size="-43">NO.REVISI : 03</font></strong></td>
  </tr>
  <tr>
    <td height="19"><strong><font size="-4">TGL TERBIT :11-02-20</font></strong></td>
  </tr>
</table>

<table width="100%" border="0" class="table-list1">
  <tr>
    <td colspan="2" valign="top"><font size="+1"><strong>PT INDO TAICHEN<br>TEXTILE INDUSTRY</strong></font><br />Reg. No. CU 817577<br />
    <strong>PO : <font align="center" size="+1.5"><?php echo $dr['no_po']; ?></font></strong></td>
    <td width="26%" valign="top">
    <strong> <font size="+2"><center><?php  $aa=4*$z;?> NO.: <?php echo $dr['no_sj']; if($aa=='4'){echo "";} else if($aa=='8'){echo "(B)";}else if($aa=='12'){echo "(C)";}else if($aa=='16'){echo "(D)";}else if($aa=='20'){echo "(E)";}else if($aa=='24'){echo "(F)";}else if($aa=='28'){echo "(G)";}else if($aa=='32'){echo "(H)";}else if($aa=='36'){echo "(I)";}else if($aa=='40'){echo "(J)";}?></center>
    </font>
    <font align="left" ><strong>Tanggal: <?php  echo date("d-F-Y", strtotime($dr['tgl_buat']));?></strong></font>
    
    <br /><strong>No. Order:</strong>
    <font align="center" size="+1"></font><font align="left" size="+1"><strong><?php echo $dr['no_order'];?></strong></font>
    </strong></td>
    <td width="49%" valign="top"><strong>Kepada Yth.<br /> <?php 
	$sql=sqlsrv_query($conn,"select * from partners where id='".$rbuyer['id']."'"); 
	$data=sqlsrv_fetch_array($sql,SQLSRV_FETCH_ASSOC);
	$name = $dr['pelanggan'];
$nama1=strpos($name, "/");
$nama2=trim(substr($name,0,$nama1));
$nama3=trim(substr($name,$nama1,100));
echo $nama2;
//echo $data['PartnerName']; ?><?php
$sql2=sqlsrv_query($conn,"select * from partners where partnername like '$nama2%'");
$data2=sqlsrv_fetch_array($sql2,SQLSRV_FETCH_ASSOC);
$sqlalamat=mysqli_query($con,"SELECT alamat1 FROM packing_list WHERE no_sj='".$dr['no_sj']."' and tgl_update='".$dr['tgl_update']."'  LIMIT 1");
	$rAlt=mysqli_fetch_array($sqlalamat);		
if($data['ID']!=$data2['ID']){
	if($rAlt['alamat1']!=""){
		$kirim=" Kirim Ke: ".$rAlt['alamat1']." ";
	echo ", ".$data['CompanyTitle']."$nama3<br>".$kirim;
	}else{
		$kirim="Kirim Ke : ".$data['PartnerName']." ";
		echo ", ".$data['CompanyTitle']."$nama3<br>".$kirim.$data['Address']."<br>".$data['PostalCode']." ".$data['City']."<br> "."PHONE : ".trim($data['PhoneNumber'])."<br> FAX : ".$data['FaxNumber']; 
	}
}else{
	echo ", ".$data['CompanyTitle']."$nama3<br>".$data['Address']."<br>".$data['PostalCode']." ".$data['City']."<br> "."PHONE : ".trim($data['PhoneNumber'])."<br> FAX : ".$data['FaxNumber'];
}
	//echo " ".$data[id]." ".$data[ID]

?></strong></td>
  </tr>
  <tr>
    <td width="7%"><strong><font size="-3">Perhatian!!!</font></strong></td>
    <td colspan="3"><strong><font size="-4">Segala sesuatu yang terjadi atas barang yang tercantum atas Surat Jalan ini setelah 10 hari terhitung dari tgl Surat Jalan adalah resiko pembeli</font></strong></td>
  </tr>
</table><table width="100%" border="0" class="table-list1">
  <tr>
    <td colspan="3"><div align="center"><strong>JUMLAH</strong></div></td>
    <td width="75%" rowspan="2" valign="top"><div align="center"><strong>NAMA BARANG</strong></div>      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size="+1"><strong>
	  <?php if($dr['sisa']=="FOC"){echo $dr['sisa'];} ?>
	</strong></font></td>
    <td width="12%" rowspan="2"><div align="center"><strong>Lot</strong></div></td>
  </tr>
  <tr>
    <td width="4%"><div align="center"><strong>ROLL</strong></div></td>
    <td width="4%"><div align="center"><strong>KG</strong></div></td>
    <td width="5%"><div align="center"><strong><?php if($dr['satuan']=='Yard'){echo "YARD";}else{echo "METER";}?></strong></div></td>
  </tr>
   <?php
	if($_GET['no_sj']!='')
	{ 
	$sqlr= "SELECT *,count(detail_pergerakan_stok.no_roll) as roll,sum(detail_pergerakan_stok.weight) as _berat,sum(detail_pergerakan_stok.yard_) as _yard_ ,detail_pergerakan_stok.sisa from packing_list 
LEFT JOIN detail_pergerakan_stok ON packing_list.listno=detail_pergerakan_stok.refno
LEFT JOIN tmp_detail_kite ON detail_pergerakan_stok.id_detail_kj=tmp_detail_kite.id
LEFT JOIN tbl_kite ON tmp_detail_kite.id_kite=tbl_kite.id
WHERE  `packing_list`.`no_sj`='".$_GET['no_sj']."' ".$tglkirim."
GROUP BY SUBSTR(detail_pergerakan_stok.nokk,1,11),tbl_kite.no_lot";
$data1=mysqli_query($con,$sqlr);
$jrow1= mysqli_num_rows($data1);
$rt=ceil($jrow1/4);
$a=0 + ($aa-4);
	
	$sql= "SELECT *,count(detail_pergerakan_stok.no_roll) as roll,sum(detail_pergerakan_stok.weight) as _berat,sum(detail_pergerakan_stok.yard_) as _yard_ ,detail_pergerakan_stok.sisa from packing_list 
LEFT JOIN detail_pergerakan_stok ON packing_list.listno=detail_pergerakan_stok.refno
LEFT JOIN tmp_detail_kite ON detail_pergerakan_stok.id_detail_kj=tmp_detail_kite.id
LEFT JOIN tbl_kite ON tmp_detail_kite.id_kite=tbl_kite.id
WHERE  `packing_list`.`no_sj`='".$_GET['no_sj']."' ".$tglkirim."
GROUP BY SUBSTR(detail_pergerakan_stok.nokk,1,11),tbl_kite.no_lot LIMIT $a,4"; 
	}
		$data=mysqli_query($con,$sql);
		$jrow= mysqli_num_rows($data);
	$nb=1;
	$n=1;
	$c=0;
	 while($rowd=mysqli_fetch_array($data)){
		 $sqlcr=mysqli_query($con,"SELECT * from tmp_detail_kite a
		 		INNER JOIN tbl_kite b ON a.id_kite=b.id
				WHERE a.id='".$rowd['id_detail_kj']."'");
		 $cr=mysqli_num_rows($sqlcr);
		 if($cr>0){
			 $sql_ = " SELECT * from tmp_detail_kite a
		 		INNER JOIN tbl_kite b ON a.id_kite=b.id
				WHERE a.id='".$rowd['id_detail_kj']."'";
		 }else{
			 $sql_ = "SELECT * from tbl_kite where nokk='".$rowd['nokk']."'";
		 }
		 /* $sql_ = "SELECT * from tbl_kite where nokk='$rowd[nokk]'";  */
		 

         $data_=mysqli_query($con,$sql_);
		 $rowd_=mysqli_fetch_array($data_);
		 ?>
  <tr>
    <td height="58"><div align="center"><strong><font size="+1"><?php echo $rowd['roll']; ?></font></strong></div></td>
    <td><div align="right"><strong><font size="+1"><?php echo number_format($rowd['_berat'],'2','.',','); ?></font></strong></div></td>
    <td><div align="right"><strong><font size="+1"><?php echo number_format($rowd['_yard_'],'2','.',','); ?></font></strong></div></td>
    <?php 
	$nokk=substr($rowd['nokk'],0,15);
	$sqljns=sqlsrv_query($conn,"SELECT 
*
 FROM
   
(SELECT ROW_NUMBER() 
        OVER (ORDER BY processcontrolJO.SODID) AS Row, 
       description,processcontrol.productid,
	 salesorders.buyerid
    FROM 
Joborders 
left join processcontrolJO on processcontrolJO.joid = Joborders.id
left join salesorders on soid= salesorders.id
left join processcontrol on processcontrolJO.pcid = processcontrol.id
left join processcontrolbatches on processcontrolbatches.pcid = processcontrol.id
left join productmaster on productmaster.id= processcontrol.productid
left join productpartner on productpartner.productid= processcontrol.productid
where  processcontrolbatches.documentno='$nokk'
) AS EMP
WHERE Row = 1");
$rjns=sqlsrv_fetch_array($sqljns,SQLSRV_FETCH_ASSOC);
 $sqlitm=sqlsrv_query($conn,"select colorcode,color,productcode from productpartner 
 where productid='".$rjns['productid']."' And  partnerid='".$rjns['buyerid']."'");
 $rowitm=sqlsrv_fetch_array($sqlitm,SQLSRV_FETCH_ASSOC);
 ?>
       <td><?php
	   
	   $sqltb=mysqli_query($con,"Select * from tbl_kite where nokk='$nokk'"); 
	   $rowtb=mysqli_fetch_array($sqltb);	 
	   $itemno=$rowtb['no_item'];
	   $nowarna=$rowtb['no_warna'];
	   $jenis_kain=$rowtb['jenis_kain'];
	   $sqlHS=mysqli_query($con,"SELECT hs_code FROM tbl_hs_code WHERE item='$itemno' LIMIT 1");
	   $rHS=mysqli_fetch_array($sqlHS);	 
	   if($rHS['hs_code']!=""){$hscode=" / ".$rHS['hs_code'];}else{ $hscode=" ";}	 
	   
	   $sqlitmp=sqlsrv_query($conn,"select top 1 ProductId from productpartner where productcode='$itemno' AND ColorCode='$nowarna' ORDER BY ProductId DESC");
$rowitmp=sqlsrv_fetch_array($sqlitmp,SQLSRV_FETCH_ASSOC);
	    $sqlitmp1=sqlsrv_query($conn,"SELECT * FROM   
(SELECT ROW_NUMBER() 
        OVER (ORDER BY ProductMaster.id ) AS Row, 
       description
    FROM 
 ProductMaster WHERE ID='".$rowitmp['ProductId']."'
 ) AS EMP
 WHERE Row = 1");
$sqlitm1=sqlsrv_query($conn,"SELECT description from ProductMaster where ProductNumber='".$itemno."-".$nowarna."'");
 $rowitm1=sqlsrv_fetch_array($sqlitm1,SQLSRV_FETCH_ASSOC);
 $rowitm2=sqlsrv_fetch_array($sqlitmp1,SQLSRV_FETCH_ASSOC);
	   if($rowitm['productcode']!="" and $rjns['description']!="")
	   {
	   //echo $rowitm['productcode']."/". htmlentities($rjns['description'],ENT_QUOTES).$hscode; 
	   } 
	   
	   else if($rowitm['productcode']=="" and $rjns['description']!=""){
		  // echo $itemno."/". htmlentities($rjns['description'],ENT_QUOTES).$hscode;
		   } 
		   else if($rowitm['productcode']=="" and $rowitm1['description']!=""){
		  // echo $itemno."/". htmlentities($rowitm1['description'],ENT_QUOTES).$hscode;
		   } 
		   else if($rowitm['productcode']=="" and $rjns['description']==""){
		  // echo $itemno."/". htmlentities($jenis_kain,ENT_QUOTES).$hscode;
		   } 
	   else if($itemno==""){
		  
		   }
		   else{
			   if($rowitm1['description']==""){
			  // echo $itemno."/". htmlentities($rowitm2['description'],ENT_QUOTES).$hscode; }else{
			   //echo $itemno."/". htmlentities($rowitm1['description'],ENT_QUOTES).$hscode;
			   }
			   
			   } ?>
      <table width="100%">
        <tr>
          <th><font  size="-1"><?php echo $rowd_['no_warna']; ?></font></th>
          <th><font  size="-1"><?php echo $rowd_['warna']; ?></font></th>
          <th><font  size="-1"><?php echo $rowd_['lebar']; ?>&quot;</font></th>
        </tr>
    </table>
    </td>
    <td><div align="center"><b><font size="+1"><?php echo $rowd_['no_lot'];?></font></b></div></td>
  </tr>
  
  <?php  $totrol[$aa]=$totrol[$aa] + $rowd['roll'];
  		 $totbrt[$aa]=$totbrt[$aa] + $rowd['_berat'];
		 $totyrd1[$aa]=$totyrd1[$aa] + $rowd['_yard_']; } ?>
  <?php if($jrow==3){$list=1;} if($jrow==2){$list=2;} if($jrow==1){$list=3;}
  for($i=0;$i<$list;$i++){?>
  <tr>
    <td height="58"></td>
    <td></td>
    <td></td>
    <td>
      <table width="100%">
        <tr>
          <th></font></th>
          <th></th>
          <th></th>
        </tr>
    </table>
    </td>
    <td></td>
  </tr><?php } ?>
  <tr>
    <td><div align="center"><strong><font size="+1"><?php echo $totrol[$aa];?></font></strong></div></td>
    <td><div align="right"><strong><font size="+1"><?php echo number_format($totbrt[$aa],'2','.',',');?></font></strong></div></td>
    <td><div align="right"><strong><font size="+1"><?php echo number_format($totyrd1[$aa],'2','.',',');?></font></strong></div></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<table width="100%" border="0" class="table-list1">
  <tr>
    <td colspan="2"><div align="center"><strong>Dikeluarkan Oleh</strong></div></td>
    <td><div align="center"><strong>Pengemudi</strong></div></td>
    <td><div align="center"><strong>Disetujui Oleh</strong></div></td>
    <td><div align="center"><strong>Diterima Pada</strong></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><br /><br /><br /><br /><br /><br /></td>
    <td valign="top"><strong>Tanggal</strong></td>
  </tr>
  <tr>
    <td colspan="4"><div align="center"><strong>Tanda Tangan dan Nama Jelas</strong></div></td>
    <td><div align="center"><strong>Cap dan Tanda Tangan</strong></div></td>
  </tr>
</table>
<?php 	
$qryt=mysqli_query($con,"SELECT  now() as tgl");
$dtgl=mysqli_fetch_array($qryt);
?>
<b>PrintDate :
      <?php echo date("d F Y H:i:s", strtotime($dtgl['tgl']));?></b>

<?php } ?>
</body>
</html>
<script>

</script> 