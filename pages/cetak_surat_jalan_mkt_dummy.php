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
.pagebreak { page-break-before:always; }
}
</style>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SURAT JALAN</title>
<script>

// set portrait orientation

jsPrintSetup.setOption('orientation', jsPrintSetup.kPortraitOrientation);

// set top margins in millimeters
jsPrintSetup.setOption('marginTop', 0);
jsPrintSetup.setOption('marginBottom', 0);
jsPrintSetup.setOption('marginLeft', 0);
jsPrintSetup.setOption('marginRight', 0);

// set page header
jsPrintSetup.setOption('headerStrLeft', '');
jsPrintSetup.setOption('headerStrCenter', '');
jsPrintSetup.setOption('headerStrRight', '');

// set empty page footer
jsPrintSetup.setOption('footerStrLeft', '');
jsPrintSetup.setOption('footerStrCenter', '');
jsPrintSetup.setOption('footerStrRight', '');

// clears user preferences always silent print value
// to enable using 'printSilent' option
jsPrintSetup.clearSilentPrint();

// Suppress print dialog (for this context only)
jsPrintSetup.setOption('printSilent', 1);

// Do Print 
// When print is submitted it is executed asynchronous and
// script flow continues after print independently of completetion of print process! 
jsPrintSetup.print();

window.addEventListener('load', function () {
    var rotates = document.getElementsByClassName('rotate');
    for (var i = 0; i < rotates.length; i++) {
        rotates[i].style.height = rotates[i].offsetWidth + 'px';
    }
});
// next commands

</script>
<link rel="icon" type="image/png" href="../images/icon.png">
</head>

<body>
<?php
ini_set('display_errors',0);
	include"../koneksi.php";
	?>

<?php
if($_GET['no_sj1']!=""){

if($_GET['tgl_kirim1']!=""){$tglbuat1=" and tgl_update='$_GET[tgl_kirim1]' ";}else{$tglbuat1=" and DATE_FORMAT(tgl_update,'%y')=DATE_FORMAT(NOW(),'%y')";}

//PAGE 1 BEGIN// 
$sqllist= mysql_query("SELECT a.*,d.pelanggan, d.no_po as nopo, b.satuan, b.sisa from packing_list a
LEFT JOIN detail_pergerakan_stok b ON a.listno=b.refno
LEFT JOIN tmp_detail_kite c ON b.id_detail_kj=c.id
LEFT JOIN tbl_kite d ON c.id_kite=d.id
WHERE a.`no_sj`='$_GET[no_sj1]' ".$tglbuat1."  
GROUP BY a.`no_sj`
"); 
     $dr=mysql_fetch_array($sqllist);
	 $order=trim($dr['no_order']);
	$sqlb=mssql_query("SELECT 
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
$rbuyer=mssql_fetch_array($sqlb);
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
    <strong> <font size="+2"><center>NO.: <?php echo $dr['no_sj']; if($a=='4'){echo "(B)";}else if($a=='8'){echo "(C)";}else if($a=='12'){echo "(D)";}else if($a=='16'){echo "(E)";}else if($a=='20'){echo "(F)";}else if($a=='24'){echo "(G)";}else if($a=='28'){echo "(H)";}else if($a=='32'){echo "(I)";}else if($a=='36'){echo "(J)";}?></center>
    </font>
    <font align="left" ><strong>Tanggal: <?php  echo date("d-F-Y", strtotime($dr['tgl_buat']));?></strong></font>
    
    <br /><strong>No. Order:</strong>
    <font align="center" size="+1"></font><font align="left" size="+1"><strong><?php echo $dr['no_order'];?></strong></font>
    </strong></td>
    <td width="49%" valign="top"><strong>Kepada Yth.<br /> <?php 
	$sql=mssql_query("select * from partners where id='$rbuyer[id]'"); 
	$data=mssql_fetch_array($sql);
	$name = $dr['pelanggan'];
$nama1=strpos($name, "/");
$nama2=trim(substr($name,0,$nama1));
$nama3=trim(substr($name,$nama1,100));
echo $nama2;
//echo $data['PartnerName']; ?><?php
$sql2=mssql_query("select * from partners where partnername like '$nama2%'");
$data2=mssql_fetch_array($sql2);
$sqlalamat=mysql_query("SELECT alamat1 FROM packing_list WHERE no_sj='$dr[no_sj]' and tgl_update='$dr[tgl_update]'  LIMIT 1");
	$rAlt=mysql_fetch_array($sqlalamat);		
if($data[ID]!=$data2[ID]){
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
	if($_GET['no_sj1']!='')
	{ 
$a=0;
	$sql= "SELECT *,count(detail_pergerakan_stok.no_roll) as roll,sum(detail_pergerakan_stok.weight) as _berat,sum(detail_pergerakan_stok.yard_) as _yard_ ,detail_pergerakan_stok.sisa from packing_list 
LEFT JOIN detail_pergerakan_stok ON packing_list.listno=detail_pergerakan_stok.refno
LEFT JOIN tmp_detail_kite ON detail_pergerakan_stok.id_detail_kj=tmp_detail_kite.id
LEFT JOIN tbl_kite ON tmp_detail_kite.id_kite=tbl_kite.id
WHERE  `packing_list`.`no_sj`='$_GET[no_sj1]' ".$tglbuat1."
GROUP BY SUBSTR(detail_pergerakan_stok.nokk,1,11),tbl_kite.no_lot LIMIT $a,4"; 
	}
		$data=mysql_query($sql);
		$jrow1= mysql_num_rows($data);
	$nb=1;
	$n=1;
	$c=0;
	 while($rowd=mysql_fetch_array($data)){
		 $sqlcr=mysql_query("SELECT * from tmp_detail_kite a
		 		INNER JOIN tbl_kite b ON a.id_kite=b.id
				WHERE a.id='$rowd[id_detail_kj]'");
		 $cr=mysql_num_rows($sqlcr);
		 if($cr>0){
			 $sql_ = " SELECT * from tmp_detail_kite a
		 		INNER JOIN tbl_kite b ON a.id_kite=b.id
				WHERE a.id='$rowd[id_detail_kj]'";
		 }else{
			 $sql_ = "SELECT * from tbl_kite where nokk='$rowd[nokk]'";
		 }
		 /* $sql_ = "SELECT * from tbl_kite where nokk='$rowd[nokk]'";  */
		 

         $data_=mysql_query($sql_);
		 $rowd_=mysql_fetch_array($data_);

		 $sqlPR=mysql_query("SELECT * FROM tbl_pengiriman WHERE tgl_kirim='$_GET[tgl_kirim1]' AND no_sj='$_GET[no_sj1]' AND no_item='$rowd[no_item]' AND no_po='$rowd[no_po]' AND warna='$rowd[warna]'");
		 $rowPR=mysql_fetch_array($sqlPR);
		 ?>
  <tr>
    <td height="58"><div align="center"><strong><font size="+1"><?php echo $rowd['roll']; ?></font></strong></div></td>
    <td><div align="right"><strong><font size="+1"><?php echo number_format($rowd['_berat'],'2','.',','); ?></font></strong></div></td>
    <td><div align="right"><strong><font size="+1"><?php echo number_format($rowd['_yard_'],'2','.',','); ?></font></strong></div></td>
    <?php 
	$nokk=substr($rowd['nokk'],0,15);
	$sqljns=mssql_query("SELECT 
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
$rjns=mssql_fetch_array($sqljns);
 $sqlitm=mssql_query("select colorcode,color,productcode from productpartner 
 where productid='$rjns[productid]' And  partnerid='$rjns[buyerid]'");
 $rowitm=mssql_fetch_array($sqlitm);
 ?>
       <td><?php
	   
	   $sqltb=mysql_query("Select * from tbl_kite where nokk='$nokk'"); 
	   $rowtb=mysql_fetch_array($sqltb);	 
	   $itemno=$rowtb['no_item'];
	   $nowarna=$rowtb['no_warna'];
	   $jenis_kain=$rowtb['jenis_kain'];
	   $sqlHS=mysql_query("SELECT hs_code FROM tbl_hs_code WHERE item='$itemno' LIMIT 1");
	   $rHS=mysql_fetch_array($sqlHS);	 
	   if($rHS[hs_code]!=""){$hscode=" / ".$rHS[hs_code];}else{ $hscode=" ";}	 
	   
	   $sqlitmp=mssql_query("select top 1 ProductId from productpartner where productcode='$itemno' AND ColorCode='$nowarna' ORDER BY ProductId DESC");
$rowitmp=mssql_fetch_array($sqlitmp);
	    $sqlitmp1=mssql_query("SELECT * FROM   
(SELECT ROW_NUMBER() 
        OVER (ORDER BY ProductMaster.id ) AS Row, 
       description
    FROM 
 ProductMaster WHERE ID='$rowitmp[ProductId]'
 ) AS EMP
 WHERE Row = 1");
$sqlitm1=mssql_query("SELECT description from ProductMaster where ProductNumber='".$itemno."-".$nowarna."'");
 $rowitm1=mssql_fetch_array($sqlitm1);
 $rowitm2=mssql_fetch_array($sqlitmp1);
	   if($rowitm['productcode']!="" and $rjns['description']!="")
	   {
	   echo $rowitm['productcode']."/". htmlentities($rjns['description'],ENT_QUOTES).$hscode; } 
	   
	   else if($rowitm['productcode']=="" and $rjns['description']!=""){
		   echo $itemno."/". htmlentities($rjns['description'],ENT_QUOTES).$hscode;
		   } 
		   else if($rowitm['productcode']=="" and $rowitm1['description']!=""){
		   echo $itemno."/". htmlentities($rowitm1['description'],ENT_QUOTES).$hscode;
		   } 
		   else if($rowitm['productcode']=="" and $rjns['description']==""){
		   echo $itemno."/". htmlentities($jenis_kain,ENT_QUOTES).$hscode;
		   } 
	   else if($itemno==""){
		  
		   }
		   else{
			   if($rowitm1['description']==""){
			   echo $itemno."/". htmlentities($rowitm2['description'],ENT_QUOTES).$hscode; }else{
			   echo $itemno."/". htmlentities($rowitm1['description'],ENT_QUOTES).$hscode;
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
    <td><div align="left"><b><font size="+1"><?php echo $rowd_['no_lot'];?></font>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <font  size="-1"><?php if($rowPR['price']!="" OR $rowPR['price']!=NULL){echo $rowPR['currency']." ".$rowPR['price'];}else{echo "0";}?></font></b></div></td>
  </tr>
  
  <?php  $totrol1=$totrol1 + $rowd['roll'];
  		 $totbrt1=$totbrt1 + $rowd['_berat'];
		 $totyrd1=$totyrd1 + $rowd['_yard_']; } ?>
  <?php if($jrow1==3){$list1=1;} if($jrow1==2){$list1=2;} if($jrow1==1){$list1=3;}
  for($i1=0;$i1<$list1;$i1++){?>
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
    <td><div align="center"><strong><font size="+1"><?php echo $totrol1;?></font></strong></div></td>
    <td><div align="right"><strong><font size="+1"><?php echo number_format($totbrt1,'2','.',',');?></font></strong></div></td>
    <td><div align="right"><strong><font size="+1"><?php echo number_format($totyrd1,'2','.',',');?></font></strong></div></td>
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
$qryt=mysql_query("SELECT  now() as tgl");
$dtgl=mysql_fetch_array($qryt);
?>
<b>PrintDate :
      <?php echo date("d F Y H:i:s", strtotime($dtgl['tgl']));?></b>
<div class="pagebreak"></div>
<!-- PAGE 1 END -->
<!-- PAGE 2 BEGIN -->
<?php
$sqlr= "SELECT *,count(b.no_roll) as roll,sum(b.weight) as _berat,sum(b.yard_) as _yard_ ,b.sisa from packing_list a 
LEFT JOIN detail_pergerakan_stok b ON a.listno=b.refno
LEFT JOIN tmp_detail_kite c ON b.id_detail_kj=c.id
LEFT JOIN tbl_kite d ON c.id_kite=d.id
WHERE a.`no_sj`='$_GET[no_sj1]' ".$tglbuat1."
GROUP BY SUBSTR(b.nokk,1,11),d.no_lot";
$data1=mysql_query($sqlr);
$jml= mysql_num_rows($data1);
$rt=ceil($jml/4);

if($rt>1){
$a=4;

$sqllist2= mysql_query("SELECT a.*,d.pelanggan, d.no_po as nopo, b.satuan, b.sisa from packing_list a
LEFT JOIN detail_pergerakan_stok b ON a.listno=b.refno
LEFT JOIN tmp_detail_kite c ON b.id_detail_kj=c.id
LEFT JOIN tbl_kite d ON c.id_kite=d.id
WHERE a.`no_sj`='$_GET[no_sj1]' ".$tglbuat1."  
GROUP BY a.`no_sj`
"); 
     $dr=mysql_fetch_array($sqllist2);
	 $order2=trim($dr['no_order']);
	$sqlb2=mssql_query("SELECT 
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
where  JobOrders.documentno = '$order2' and not Description='' 
) AS EMP
WHERE Row = 1");
$rbuyer=mssql_fetch_array($sqlb2);
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
    <strong> <font size="+2"><center>NO.: <?php echo $dr['no_sj']; if($a=='4'){echo "(B)";}else if($a=='8'){echo "(C)";}else if($a=='12'){echo "(D)";}else if($a=='16'){echo "(E)";}else if($a=='20'){echo "(F)";}else if($a=='24'){echo "(G)";}else if($a=='28'){echo "(H)";}else if($a=='32'){echo "(I)";}else if($a=='36'){echo "(J)";}?></center>
    </font>
    <font align="left" ><strong>Tanggal: <?php  echo date("d-F-Y", strtotime($dr['tgl_buat']));?></strong></font>
    
    <br /><strong>No. Order:</strong>
    <font align="center" size="+1"></font><font align="left" size="+1"><strong><?php echo $dr['no_order'];?></strong></font>
    </strong></td>
    <td width="49%" valign="top"><strong>Kepada Yth.<br /> <?php 
	$sql=mssql_query("select * from partners where id='$rbuyer[id]'"); 
	$data=mssql_fetch_array($sql);
	$name = $dr['pelanggan'];
$nama1=strpos($name, "/");
$nama2=trim(substr($name,0,$nama1));
$nama3=trim(substr($name,$nama1,100));
echo $nama2;
//echo $data['PartnerName']; ?><?php
$sql2=mssql_query("select * from partners where partnername like '$nama2%'");
$data2=mssql_fetch_array($sql2);
$sqlalamat=mysql_query("SELECT alamat1 FROM packing_list WHERE no_sj='$dr[no_sj]' and tgl_update='$dr[tgl_update]'  LIMIT 1");
	$rAlt=mysql_fetch_array($sqlalamat);		
if($data[ID]!=$data2[ID]){
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
	if($_GET['no_sj1']!='')
	{ 
	$sql= "SELECT *,count(detail_pergerakan_stok.no_roll) as roll,sum(detail_pergerakan_stok.weight) as _berat,sum(detail_pergerakan_stok.yard_) as _yard_ ,detail_pergerakan_stok.sisa from packing_list 
LEFT JOIN detail_pergerakan_stok ON packing_list.listno=detail_pergerakan_stok.refno
LEFT JOIN tmp_detail_kite ON detail_pergerakan_stok.id_detail_kj=tmp_detail_kite.id
LEFT JOIN tbl_kite ON tmp_detail_kite.id_kite=tbl_kite.id
WHERE  `packing_list`.`no_sj`='$_GET[no_sj1]' ".$tglbuat1."
GROUP BY SUBSTR(detail_pergerakan_stok.nokk,1,11),tbl_kite.no_lot LIMIT $a,4"; 
	}
		$data=mysql_query($sql);
		$jrow2= mysql_num_rows($data);
	$nb=1;
	$n=1;
	$c=0;
	 while($rowd=mysql_fetch_array($data)){
		 $sqlcr=mysql_query("SELECT * from tmp_detail_kite a
		 		INNER JOIN tbl_kite b ON a.id_kite=b.id
				WHERE a.id='$rowd[id_detail_kj]'");
		 $cr=mysql_num_rows($sqlcr);
		 if($cr>0){
			 $sql_ = " SELECT * from tmp_detail_kite a
		 		INNER JOIN tbl_kite b ON a.id_kite=b.id
				WHERE a.id='$rowd[id_detail_kj]'";
		 }else{
			 $sql_ = "SELECT * from tbl_kite where nokk='$rowd[nokk]'";
		 }
		 /* $sql_ = "SELECT * from tbl_kite where nokk='$rowd[nokk]'";  */
		 

         $data_=mysql_query($sql_);
		 $rowd_=mysql_fetch_array($data_);

		 $sqlPR=mysql_query("SELECT * FROM tbl_pengiriman WHERE tgl_kirim='$_GET[tgl_kirim1]' AND no_sj='$_GET[no_sj1]' AND no_item='$rowd[no_item]' AND no_po='$rowd[no_po]' AND warna='$rowd[warna]'");
		 $rowPR=mysql_fetch_array($sqlPR);
		 ?>
  <tr>
    <td height="58"><div align="center"><strong><font size="+1"><?php echo $rowd['roll']; ?></font></strong></div></td>
    <td><div align="right"><strong><font size="+1"><?php echo number_format($rowd['_berat'],'2','.',','); ?></font></strong></div></td>
    <td><div align="right"><strong><font size="+1"><?php echo number_format($rowd['_yard_'],'2','.',','); ?></font></strong></div></td>
    <?php 
	$nokk=substr($rowd['nokk'],0,15);
	$sqljns=mssql_query("SELECT 
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
$rjns=mssql_fetch_array($sqljns);
 $sqlitm=mssql_query("select colorcode,color,productcode from productpartner 
 where productid='$rjns[productid]' And  partnerid='$rjns[buyerid]'");
 $rowitm=mssql_fetch_array($sqlitm);
 ?>
       <td><?php
	   
	   $sqltb=mysql_query("Select * from tbl_kite where nokk='$nokk'"); 
	   $rowtb=mysql_fetch_array($sqltb);	 
	   $itemno=$rowtb['no_item'];
	   $nowarna=$rowtb['no_warna'];
	   $jenis_kain=$rowtb['jenis_kain'];
	   $sqlHS=mysql_query("SELECT hs_code FROM tbl_hs_code WHERE item='$itemno' LIMIT 1");
	   $rHS=mysql_fetch_array($sqlHS);	 
	   if($rHS[hs_code]!=""){$hscode=" / ".$rHS[hs_code];}else{ $hscode=" ";}	 
	   
	   $sqlitmp=mssql_query("select top 1 ProductId from productpartner where productcode='$itemno' AND ColorCode='$nowarna' ORDER BY ProductId DESC");
$rowitmp=mssql_fetch_array($sqlitmp);
	    $sqlitmp1=mssql_query("SELECT * FROM   
(SELECT ROW_NUMBER() 
        OVER (ORDER BY ProductMaster.id ) AS Row, 
       description
    FROM 
 ProductMaster WHERE ID='$rowitmp[ProductId]'
 ) AS EMP
 WHERE Row = 1");
$sqlitm1=mssql_query("SELECT description from ProductMaster where ProductNumber='".$itemno."-".$nowarna."'");
 $rowitm1=mssql_fetch_array($sqlitm1);
 $rowitm2=mssql_fetch_array($sqlitmp1);
	   if($rowitm['productcode']!="" and $rjns['description']!="")
	   {
	   echo $rowitm['productcode']."/". htmlentities($rjns['description'],ENT_QUOTES).$hscode; } 
	   
	   else if($rowitm['productcode']=="" and $rjns['description']!=""){
		   echo $itemno."/". htmlentities($rjns['description'],ENT_QUOTES).$hscode;
		   } 
		   else if($rowitm['productcode']=="" and $rowitm1['description']!=""){
		   echo $itemno."/". htmlentities($rowitm1['description'],ENT_QUOTES).$hscode;
		   } 
		   else if($rowitm['productcode']=="" and $rjns['description']==""){
		   echo $itemno."/". htmlentities($jenis_kain,ENT_QUOTES).$hscode;
		   } 
	   else if($itemno==""){
		  
		   }
		   else{
			   if($rowitm1['description']==""){
			   echo $itemno."/". htmlentities($rowitm2['description'],ENT_QUOTES).$hscode; }else{
			   echo $itemno."/". htmlentities($rowitm1['description'],ENT_QUOTES).$hscode;
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
    <td><div align="left"><b><font size="+1"><?php echo $rowd_['no_lot'];?></font>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <font  size="-1"><?php if($rowPR['price']!="" OR $rowPR['price']!=NULL){echo $rowPR['currency']." ".$rowPR['price'];}else{echo "0";}?></font></b></div></td>
  </tr>
  
  <?php  $totrol2=$totrol2 + $rowd['roll'];
  		 $totbrt2=$totbrt2 + $rowd['_berat'];
		 $totyrd2=$totyrd2 + $rowd['_yard_']; } ?>
  <?php if($jrow2==3){$list2=1;} if($jrow2==2){$list2=2;} if($jrow2==1){$list2=3;}
  for($i2=0;$i2<$list2;$i2++){?>
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
    <td><div align="center"><strong><font size="+1"><?php echo $totrol2;?></font></strong></div></td>
    <td><div align="right"><strong><font size="+1"><?php echo number_format($totbrt2,'2','.',',');?></font></strong></div></td>
    <td><div align="right"><strong><font size="+1"><?php echo number_format($totyrd2,'2','.',',');?></font></strong></div></td>
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
$qryt=mysql_query("SELECT  now() as tgl");
$dtgl=mysql_fetch_array($qryt);
?>
<b>PrintDate :
      <?php echo date("d F Y H:i:s", strtotime($dtgl['tgl']));?></b>
<div class="pagebreak"></div>
<?php }?>
<!-- PAGE 2 END -->
<!-- PAGE 3 BEGIN -->
<?php
if($rt>2){
    $a=8;
    
    $sqllist3= mysql_query("SELECT a.*,d.pelanggan, d.no_po as nopo, b.satuan, b.sisa from packing_list a
    LEFT JOIN detail_pergerakan_stok b ON a.listno=b.refno
    LEFT JOIN tmp_detail_kite c ON b.id_detail_kj=c.id
    LEFT JOIN tbl_kite d ON c.id_kite=d.id
    WHERE a.`no_sj`='$_GET[no_sj1]' ".$tglbuat1."  
    GROUP BY a.`no_sj`
    "); 
         $dr=mysql_fetch_array($sqllist3);
         $order3=trim($dr['no_order']);
        $sqlb3=mssql_query("SELECT 
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
    where  JobOrders.documentno = '$order3' and not Description='' 
    ) AS EMP
    WHERE Row = 1");
    $rbuyer=mssql_fetch_array($sqlb3);
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
    <strong> <font size="+2"><center>NO.: <?php echo $dr['no_sj']; if($a=='4'){echo "(B)";}else if($a=='8'){echo "(C)";}else if($a=='12'){echo "(D)";}else if($a=='16'){echo "(E)";}else if($a=='20'){echo "(F)";}else if($a=='24'){echo "(G)";}else if($a=='28'){echo "(H)";}else if($a=='32'){echo "(I)";}else if($a=='36'){echo "(J)";}?></center>
    </font>
    <font align="left" ><strong>Tanggal: <?php  echo date("d-F-Y", strtotime($dr['tgl_buat']));?></strong></font>
    
    <br /><strong>No. Order:</strong>
    <font align="center" size="+1"></font><font align="left" size="+1"><strong><?php echo $dr['no_order'];?></strong></font>
    </strong></td>
    <td width="49%" valign="top"><strong>Kepada Yth.<br /> <?php 
	$sql=mssql_query("select * from partners where id='$rbuyer[id]'"); 
	$data=mssql_fetch_array($sql);
	$name = $dr['pelanggan'];
$nama1=strpos($name, "/");
$nama2=trim(substr($name,0,$nama1));
$nama3=trim(substr($name,$nama1,100));
echo $nama2;
//echo $data['PartnerName']; ?><?php
$sql2=mssql_query("select * from partners where partnername like '$nama2%'");
$data2=mssql_fetch_array($sql2);
$sqlalamat=mysql_query("SELECT alamat1 FROM packing_list WHERE no_sj='$dr[no_sj]' and tgl_update='$dr[tgl_update]'  LIMIT 1");
	$rAlt=mysql_fetch_array($sqlalamat);		
if($data[ID]!=$data2[ID]){
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
	if($_GET['no_sj1']!='')
	{ 
	$sql= "SELECT *,count(detail_pergerakan_stok.no_roll) as roll,sum(detail_pergerakan_stok.weight) as _berat,sum(detail_pergerakan_stok.yard_) as _yard_ ,detail_pergerakan_stok.sisa from packing_list 
LEFT JOIN detail_pergerakan_stok ON packing_list.listno=detail_pergerakan_stok.refno
LEFT JOIN tmp_detail_kite ON detail_pergerakan_stok.id_detail_kj=tmp_detail_kite.id
LEFT JOIN tbl_kite ON tmp_detail_kite.id_kite=tbl_kite.id
WHERE  `packing_list`.`no_sj`='$_GET[no_sj1]' ".$tglbuat1."
GROUP BY SUBSTR(detail_pergerakan_stok.nokk,1,11),tbl_kite.no_lot LIMIT $a,4"; 
	}
		$data=mysql_query($sql);
		$jrow3= mysql_num_rows($data);
	$nb=1;
	$n=1;
	$c=0;
	 while($rowd=mysql_fetch_array($data)){
		 $sqlcr=mysql_query("SELECT * from tmp_detail_kite a
		 		INNER JOIN tbl_kite b ON a.id_kite=b.id
				WHERE a.id='$rowd[id_detail_kj]'");
		 $cr=mysql_num_rows($sqlcr);
		 if($cr>0){
			 $sql_ = " SELECT * from tmp_detail_kite a
		 		INNER JOIN tbl_kite b ON a.id_kite=b.id
				WHERE a.id='$rowd[id_detail_kj]'";
		 }else{
			 $sql_ = "SELECT * from tbl_kite where nokk='$rowd[nokk]'";
		 }
		 /* $sql_ = "SELECT * from tbl_kite where nokk='$rowd[nokk]'";  */
		 

         $data_=mysql_query($sql_);
		 $rowd_=mysql_fetch_array($data_);

		 $sqlPR=mysql_query("SELECT * FROM tbl_pengiriman WHERE tgl_kirim='$_GET[tgl_kirim1]' AND no_sj='$_GET[no_sj1]' AND no_item='$rowd[no_item]' AND no_po='$rowd[no_po]' AND warna='$rowd[warna]'");
		 $rowPR=mysql_fetch_array($sqlPR);
		 ?>
  <tr>
    <td height="58"><div align="center"><strong><font size="+1"><?php echo $rowd['roll']; ?></font></strong></div></td>
    <td><div align="right"><strong><font size="+1"><?php echo number_format($rowd['_berat'],'2','.',','); ?></font></strong></div></td>
    <td><div align="right"><strong><font size="+1"><?php echo number_format($rowd['_yard_'],'2','.',','); ?></font></strong></div></td>
    <?php 
	$nokk=substr($rowd['nokk'],0,15);
	$sqljns=mssql_query("SELECT 
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
$rjns=mssql_fetch_array($sqljns);
 $sqlitm=mssql_query("select colorcode,color,productcode from productpartner 
 where productid='$rjns[productid]' And  partnerid='$rjns[buyerid]'");
 $rowitm=mssql_fetch_array($sqlitm);
 ?>
       <td><?php
	   
	   $sqltb=mysql_query("Select * from tbl_kite where nokk='$nokk'"); 
	   $rowtb=mysql_fetch_array($sqltb);	 
	   $itemno=$rowtb['no_item'];
	   $nowarna=$rowtb['no_warna'];
	   $jenis_kain=$rowtb['jenis_kain'];
	   $sqlHS=mysql_query("SELECT hs_code FROM tbl_hs_code WHERE item='$itemno' LIMIT 1");
	   $rHS=mysql_fetch_array($sqlHS);	 
	   if($rHS[hs_code]!=""){$hscode=" / ".$rHS[hs_code];}else{ $hscode=" ";}	 
	   
	   $sqlitmp=mssql_query("select top 1 ProductId from productpartner where productcode='$itemno' AND ColorCode='$nowarna' ORDER BY ProductId DESC");
$rowitmp=mssql_fetch_array($sqlitmp);
	    $sqlitmp1=mssql_query("SELECT * FROM   
(SELECT ROW_NUMBER() 
        OVER (ORDER BY ProductMaster.id ) AS Row, 
       description
    FROM 
 ProductMaster WHERE ID='$rowitmp[ProductId]'
 ) AS EMP
 WHERE Row = 1");
$sqlitm1=mssql_query("SELECT description from ProductMaster where ProductNumber='".$itemno."-".$nowarna."'");
 $rowitm1=mssql_fetch_array($sqlitm1);
 $rowitm2=mssql_fetch_array($sqlitmp1);
	   if($rowitm['productcode']!="" and $rjns['description']!="")
	   {
	   echo $rowitm['productcode']."/". htmlentities($rjns['description'],ENT_QUOTES).$hscode; } 
	   
	   else if($rowitm['productcode']=="" and $rjns['description']!=""){
		   echo $itemno."/". htmlentities($rjns['description'],ENT_QUOTES).$hscode;
		   } 
		   else if($rowitm['productcode']=="" and $rowitm1['description']!=""){
		   echo $itemno."/". htmlentities($rowitm1['description'],ENT_QUOTES).$hscode;
		   } 
		   else if($rowitm['productcode']=="" and $rjns['description']==""){
		   echo $itemno."/". htmlentities($jenis_kain,ENT_QUOTES).$hscode;
		   } 
	   else if($itemno==""){
		  
		   }
		   else{
			   if($rowitm1['description']==""){
			   echo $itemno."/". htmlentities($rowitm2['description'],ENT_QUOTES).$hscode; }else{
			   echo $itemno."/". htmlentities($rowitm1['description'],ENT_QUOTES).$hscode;
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
    <td><div align="left"><b><font size="+1"><?php echo $rowd_['no_lot'];?></font>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <font  size="-1"><?php if($rowPR['price']!="" OR $rowPR['price']!=NULL){echo $rowPR['currency']." ".$rowPR['price'];}else{echo "0";}?></font></b></div></td>
  </tr>
  
  <?php  $totrol3=$totrol3 + $rowd['roll'];
  		 $totbrt3=$totbrt3 + $rowd['_berat'];
		 $totyrd3=$totyrd3 + $rowd['_yard_']; } ?>
  <?php if($jrow3==3){$list3=1;} if($jrow3==2){$list3=2;} if($jrow3==1){$list3=3;}
  for($i3=0;$i3<$list3;$i3++){?>
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
    <td><div align="center"><strong><font size="+1"><?php echo $totrol3;?></font></strong></div></td>
    <td><div align="right"><strong><font size="+1"><?php echo number_format($totbrt3,'2','.',',');?></font></strong></div></td>
    <td><div align="right"><strong><font size="+1"><?php echo number_format($totyrd3,'2','.',',');?></font></strong></div></td>
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
$qryt=mysql_query("SELECT  now() as tgl");
$dtgl=mysql_fetch_array($qryt);
?>
<b>PrintDate :
      <?php echo date("d F Y H:i:s", strtotime($dtgl['tgl']));?></b>
<div class="pagebreak"></div>
<?php }?>
<!-- PAGE 3 END -->

<!-- PAGE 4 BEGIN -->
<?php
if($rt>3){
    $a=12;
    
    $sqllist4= mysql_query("SELECT a.*,d.pelanggan, d.no_po as nopo, b.satuan, b.sisa from packing_list a
    LEFT JOIN detail_pergerakan_stok b ON a.listno=b.refno
    LEFT JOIN tmp_detail_kite c ON b.id_detail_kj=c.id
    LEFT JOIN tbl_kite d ON c.id_kite=d.id
    WHERE a.`no_sj`='$_GET[no_sj1]' ".$tglbuat1."  
    GROUP BY a.`no_sj`
    "); 
         $dr=mysql_fetch_array($sqllist4);
         $order4=trim($dr['no_order']);
        $sqlb4=mssql_query("SELECT 
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
    where  JobOrders.documentno = '$order4' and not Description='' 
    ) AS EMP
    WHERE Row = 1");
    $rbuyer=mssql_fetch_array($sqlb4);
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
    <strong> <font size="+2"><center>NO.: <?php echo $dr['no_sj']; if($a=='4'){echo "(B)";}else if($a=='8'){echo "(C)";}else if($a=='12'){echo "(D)";}else if($a=='16'){echo "(E)";}else if($a=='20'){echo "(F)";}else if($a=='24'){echo "(G)";}else if($a=='28'){echo "(H)";}else if($a=='32'){echo "(I)";}else if($a=='36'){echo "(J)";}?></center>
    </font>
    <font align="left" ><strong>Tanggal: <?php  echo date("d-F-Y", strtotime($dr['tgl_buat']));?></strong></font>
    
    <br /><strong>No. Order:</strong>
    <font align="center" size="+1"></font><font align="left" size="+1"><strong><?php echo $dr['no_order'];?></strong></font>
    </strong></td>
    <td width="49%" valign="top"><strong>Kepada Yth.<br /> <?php 
	$sql=mssql_query("select * from partners where id='$rbuyer[id]'"); 
	$data=mssql_fetch_array($sql);
	$name = $dr['pelanggan'];
$nama1=strpos($name, "/");
$nama2=trim(substr($name,0,$nama1));
$nama3=trim(substr($name,$nama1,100));
echo $nama2;
//echo $data['PartnerName']; ?><?php
$sql2=mssql_query("select * from partners where partnername like '$nama2%'");
$data2=mssql_fetch_array($sql2);
$sqlalamat=mysql_query("SELECT alamat1 FROM packing_list WHERE no_sj='$dr[no_sj]' and tgl_update='$dr[tgl_update]'  LIMIT 1");
	$rAlt=mysql_fetch_array($sqlalamat);		
if($data[ID]!=$data2[ID]){
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
	if($_GET['no_sj1']!='')
	{ 
	$sql= "SELECT *,count(detail_pergerakan_stok.no_roll) as roll,sum(detail_pergerakan_stok.weight) as _berat,sum(detail_pergerakan_stok.yard_) as _yard_ ,detail_pergerakan_stok.sisa from packing_list 
LEFT JOIN detail_pergerakan_stok ON packing_list.listno=detail_pergerakan_stok.refno
LEFT JOIN tmp_detail_kite ON detail_pergerakan_stok.id_detail_kj=tmp_detail_kite.id
LEFT JOIN tbl_kite ON tmp_detail_kite.id_kite=tbl_kite.id
WHERE  `packing_list`.`no_sj`='$_GET[no_sj1]' ".$tglbuat1."
GROUP BY SUBSTR(detail_pergerakan_stok.nokk,1,11),tbl_kite.no_lot LIMIT $a,4"; 
	}
		$data=mysql_query($sql);
		$jrow4= mysql_num_rows($data);
	$nb=1;
	$n=1;
	$c=0;
	 while($rowd=mysql_fetch_array($data)){
		 $sqlcr=mysql_query("SELECT * from tmp_detail_kite a
		 		INNER JOIN tbl_kite b ON a.id_kite=b.id
				WHERE a.id='$rowd[id_detail_kj]'");
		 $cr=mysql_num_rows($sqlcr);
		 if($cr>0){
			 $sql_ = " SELECT * from tmp_detail_kite a
		 		INNER JOIN tbl_kite b ON a.id_kite=b.id
				WHERE a.id='$rowd[id_detail_kj]'";
		 }else{
			 $sql_ = "SELECT * from tbl_kite where nokk='$rowd[nokk]'";
		 }
		 /* $sql_ = "SELECT * from tbl_kite where nokk='$rowd[nokk]'";  */
		 

         $data_=mysql_query($sql_);
		 $rowd_=mysql_fetch_array($data_);

		 $sqlPR=mysql_query("SELECT * FROM tbl_pengiriman WHERE tgl_kirim='$_GET[tgl_kirim1]' AND no_sj='$_GET[no_sj1]' AND no_item='$rowd[no_item]' AND no_po='$rowd[no_po]' AND warna='$rowd[warna]'");
		 $rowPR=mysql_fetch_array($sqlPR);
		 ?>
  <tr>
    <td height="58"><div align="center"><strong><font size="+1"><?php echo $rowd['roll']; ?></font></strong></div></td>
    <td><div align="right"><strong><font size="+1"><?php echo number_format($rowd['_berat'],'2','.',','); ?></font></strong></div></td>
    <td><div align="right"><strong><font size="+1"><?php echo number_format($rowd['_yard_'],'2','.',','); ?></font></strong></div></td>
    <?php 
	$nokk=substr($rowd['nokk'],0,15);
	$sqljns=mssql_query("SELECT 
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
$rjns=mssql_fetch_array($sqljns);
 $sqlitm=mssql_query("select colorcode,color,productcode from productpartner 
 where productid='$rjns[productid]' And  partnerid='$rjns[buyerid]'");
 $rowitm=mssql_fetch_array($sqlitm);
 ?>
       <td><?php
	   
	   $sqltb=mysql_query("Select * from tbl_kite where nokk='$nokk'"); 
	   $rowtb=mysql_fetch_array($sqltb);	 
	   $itemno=$rowtb['no_item'];
	   $nowarna=$rowtb['no_warna'];
	   $jenis_kain=$rowtb['jenis_kain'];
	   $sqlHS=mysql_query("SELECT hs_code FROM tbl_hs_code WHERE item='$itemno' LIMIT 1");
	   $rHS=mysql_fetch_array($sqlHS);	 
	   if($rHS[hs_code]!=""){$hscode=" / ".$rHS[hs_code];}else{ $hscode=" ";}	 
	   
	   $sqlitmp=mssql_query("select top 1 ProductId from productpartner where productcode='$itemno' AND ColorCode='$nowarna' ORDER BY ProductId DESC");
$rowitmp=mssql_fetch_array($sqlitmp);
	    $sqlitmp1=mssql_query("SELECT * FROM   
(SELECT ROW_NUMBER() 
        OVER (ORDER BY ProductMaster.id ) AS Row, 
       description
    FROM 
 ProductMaster WHERE ID='$rowitmp[ProductId]'
 ) AS EMP
 WHERE Row = 1");
$sqlitm1=mssql_query("SELECT description from ProductMaster where ProductNumber='".$itemno."-".$nowarna."'");
 $rowitm1=mssql_fetch_array($sqlitm1);
 $rowitm2=mssql_fetch_array($sqlitmp1);
	   if($rowitm['productcode']!="" and $rjns['description']!="")
	   {
	   echo $rowitm['productcode']."/". htmlentities($rjns['description'],ENT_QUOTES).$hscode; } 
	   
	   else if($rowitm['productcode']=="" and $rjns['description']!=""){
		   echo $itemno."/". htmlentities($rjns['description'],ENT_QUOTES).$hscode;
		   } 
		   else if($rowitm['productcode']=="" and $rowitm1['description']!=""){
		   echo $itemno."/". htmlentities($rowitm1['description'],ENT_QUOTES).$hscode;
		   } 
		   else if($rowitm['productcode']=="" and $rjns['description']==""){
		   echo $itemno."/". htmlentities($jenis_kain,ENT_QUOTES).$hscode;
		   } 
	   else if($itemno==""){
		  
		   }
		   else{
			   if($rowitm1['description']==""){
			   echo $itemno."/". htmlentities($rowitm2['description'],ENT_QUOTES).$hscode; }else{
			   echo $itemno."/". htmlentities($rowitm1['description'],ENT_QUOTES).$hscode;
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
    <td><div align="left"><b><font size="+1"><?php echo $rowd_['no_lot'];?></font>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <font  size="-1"><?php if($rowPR['price']!="" OR $rowPR['price']!=NULL){echo $rowPR['currency']." ".$rowPR['price'];}else{echo "0";}?></font></b></div></td>
  </tr>
  
  <?php  $totrol4=$totrol4 + $rowd['roll'];
  		 $totbrt4=$totbrt4 + $rowd['_berat'];
		 $totyrd4=$totyrd4 + $rowd['_yard_']; } ?>
  <?php if($jrow4==3){$list4=1;} if($jrow4==2){$list4=2;} if($jrow4==1){$list4=3;}
  for($i4=0;$i4<$list4;$i4++){?>
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
    <td><div align="center"><strong><font size="+1"><?php echo $totrol4;?></font></strong></div></td>
    <td><div align="right"><strong><font size="+1"><?php echo number_format($totbrt4,'2','.',',');?></font></strong></div></td>
    <td><div align="right"><strong><font size="+1"><?php echo number_format($totyrd4,'2','.',',');?></font></strong></div></td>
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
$qryt=mysql_query("SELECT  now() as tgl");
$dtgl=mysql_fetch_array($qryt);
?>
<b>PrintDate :
      <?php echo date("d F Y H:i:s", strtotime($dtgl['tgl']));?></b>
<div class="pagebreak"></div>
<?php }?>
<!-- PAGE 4 END -->

<!-- PAGE 5 BEGIN -->
<?php
if($rt>4){
    $a=16;
    
    $sqllist5= mysql_query("SELECT a.*,d.pelanggan, d.no_po as nopo, b.satuan, b.sisa from packing_list a
    LEFT JOIN detail_pergerakan_stok b ON a.listno=b.refno
    LEFT JOIN tmp_detail_kite c ON b.id_detail_kj=c.id
    LEFT JOIN tbl_kite d ON c.id_kite=d.id
    WHERE a.`no_sj`='$_GET[no_sj1]' ".$tglbuat1."  
    GROUP BY a.`no_sj`
    "); 
         $dr=mysql_fetch_array($sqllist5);
         $order5=trim($dr['no_order']);
        $sqlb5=mssql_query("SELECT 
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
    where  JobOrders.documentno = '$order5' and not Description='' 
    ) AS EMP
    WHERE Row = 1");
    $rbuyer=mssql_fetch_array($sqlb5);
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
    <strong> <font size="+2"><center>NO.: <?php echo $dr['no_sj']; if($a=='4'){echo "(B)";}else if($a=='8'){echo "(C)";}else if($a=='12'){echo "(D)";}else if($a=='16'){echo "(E)";}else if($a=='20'){echo "(F)";}else if($a=='24'){echo "(G)";}else if($a=='28'){echo "(H)";}else if($a=='32'){echo "(I)";}else if($a=='36'){echo "(J)";}?></center>
    </font>
    <font align="left" ><strong>Tanggal: <?php  echo date("d-F-Y", strtotime($dr['tgl_buat']));?></strong></font>
    
    <br /><strong>No. Order:</strong>
    <font align="center" size="+1"></font><font align="left" size="+1"><strong><?php echo $dr['no_order'];?></strong></font>
    </strong></td>
    <td width="49%" valign="top"><strong>Kepada Yth.<br /> <?php 
	$sql=mssql_query("select * from partners where id='$rbuyer[id]'"); 
	$data=mssql_fetch_array($sql);
	$name = $dr['pelanggan'];
$nama1=strpos($name, "/");
$nama2=trim(substr($name,0,$nama1));
$nama3=trim(substr($name,$nama1,100));
echo $nama2;
//echo $data['PartnerName']; ?><?php
$sql2=mssql_query("select * from partners where partnername like '$nama2%'");
$data2=mssql_fetch_array($sql2);
$sqlalamat=mysql_query("SELECT alamat1 FROM packing_list WHERE no_sj='$dr[no_sj]' and tgl_update='$dr[tgl_update]'  LIMIT 1");
	$rAlt=mysql_fetch_array($sqlalamat);		
if($data[ID]!=$data2[ID]){
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
	if($_GET['no_sj1']!='')
	{ 
	$sql= "SELECT *,count(detail_pergerakan_stok.no_roll) as roll,sum(detail_pergerakan_stok.weight) as _berat,sum(detail_pergerakan_stok.yard_) as _yard_ ,detail_pergerakan_stok.sisa from packing_list 
LEFT JOIN detail_pergerakan_stok ON packing_list.listno=detail_pergerakan_stok.refno
LEFT JOIN tmp_detail_kite ON detail_pergerakan_stok.id_detail_kj=tmp_detail_kite.id
LEFT JOIN tbl_kite ON tmp_detail_kite.id_kite=tbl_kite.id
WHERE  `packing_list`.`no_sj`='$_GET[no_sj1]' ".$tglbuat1."
GROUP BY SUBSTR(detail_pergerakan_stok.nokk,1,11),tbl_kite.no_lot LIMIT $a,4"; 
	}
		$data=mysql_query($sql);
		$jrow5= mysql_num_rows($data);
	$nb=1;
	$n=1;
	$c=0;
	 while($rowd=mysql_fetch_array($data)){
		 $sqlcr=mysql_query("SELECT * from tmp_detail_kite a
		 		INNER JOIN tbl_kite b ON a.id_kite=b.id
				WHERE a.id='$rowd[id_detail_kj]'");
		 $cr=mysql_num_rows($sqlcr);
		 if($cr>0){
			 $sql_ = " SELECT * from tmp_detail_kite a
		 		INNER JOIN tbl_kite b ON a.id_kite=b.id
				WHERE a.id='$rowd[id_detail_kj]'";
		 }else{
			 $sql_ = "SELECT * from tbl_kite where nokk='$rowd[nokk]'";
		 }
		 /* $sql_ = "SELECT * from tbl_kite where nokk='$rowd[nokk]'";  */
		 

         $data_=mysql_query($sql_);
		 $rowd_=mysql_fetch_array($data_);

		 $sqlPR=mysql_query("SELECT * FROM tbl_pengiriman WHERE tgl_kirim='$_GET[tgl_kirim1]' AND no_sj='$_GET[no_sj1]' AND no_item='$rowd[no_item]' AND no_po='$rowd[no_po]' AND warna='$rowd[warna]'");
		 $rowPR=mysql_fetch_array($sqlPR);
		 ?>
  <tr>
    <td height="58"><div align="center"><strong><font size="+1"><?php echo $rowd['roll']; ?></font></strong></div></td>
    <td><div align="right"><strong><font size="+1"><?php echo number_format($rowd['_berat'],'2','.',','); ?></font></strong></div></td>
    <td><div align="right"><strong><font size="+1"><?php echo number_format($rowd['_yard_'],'2','.',','); ?></font></strong></div></td>
    <?php 
	$nokk=substr($rowd['nokk'],0,15);
	$sqljns=mssql_query("SELECT 
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
$rjns=mssql_fetch_array($sqljns);
 $sqlitm=mssql_query("select colorcode,color,productcode from productpartner 
 where productid='$rjns[productid]' And  partnerid='$rjns[buyerid]'");
 $rowitm=mssql_fetch_array($sqlitm);
 ?>
       <td><?php
	   
	   $sqltb=mysql_query("Select * from tbl_kite where nokk='$nokk'"); 
	   $rowtb=mysql_fetch_array($sqltb);	 
	   $itemno=$rowtb['no_item'];
	   $nowarna=$rowtb['no_warna'];
	   $jenis_kain=$rowtb['jenis_kain'];
	   $sqlHS=mysql_query("SELECT hs_code FROM tbl_hs_code WHERE item='$itemno' LIMIT 1");
	   $rHS=mysql_fetch_array($sqlHS);	 
	   if($rHS[hs_code]!=""){$hscode=" / ".$rHS[hs_code];}else{ $hscode=" ";}	 
	   
	   $sqlitmp=mssql_query("select top 1 ProductId from productpartner where productcode='$itemno' AND ColorCode='$nowarna' ORDER BY ProductId DESC");
$rowitmp=mssql_fetch_array($sqlitmp);
	    $sqlitmp1=mssql_query("SELECT * FROM   
(SELECT ROW_NUMBER() 
        OVER (ORDER BY ProductMaster.id ) AS Row, 
       description
    FROM 
 ProductMaster WHERE ID='$rowitmp[ProductId]'
 ) AS EMP
 WHERE Row = 1");
$sqlitm1=mssql_query("SELECT description from ProductMaster where ProductNumber='".$itemno."-".$nowarna."'");
 $rowitm1=mssql_fetch_array($sqlitm1);
 $rowitm2=mssql_fetch_array($sqlitmp1);
	   if($rowitm['productcode']!="" and $rjns['description']!="")
	   {
	   echo $rowitm['productcode']."/". htmlentities($rjns['description'],ENT_QUOTES).$hscode; } 
	   
	   else if($rowitm['productcode']=="" and $rjns['description']!=""){
		   echo $itemno."/". htmlentities($rjns['description'],ENT_QUOTES).$hscode;
		   } 
		   else if($rowitm['productcode']=="" and $rowitm1['description']!=""){
		   echo $itemno."/". htmlentities($rowitm1['description'],ENT_QUOTES).$hscode;
		   } 
		   else if($rowitm['productcode']=="" and $rjns['description']==""){
		   echo $itemno."/". htmlentities($jenis_kain,ENT_QUOTES).$hscode;
		   } 
	   else if($itemno==""){
		  
		   }
		   else{
			   if($rowitm1['description']==""){
			   echo $itemno."/". htmlentities($rowitm2['description'],ENT_QUOTES).$hscode; }else{
			   echo $itemno."/". htmlentities($rowitm1['description'],ENT_QUOTES).$hscode;
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
    <td><div align="left"><b><font size="+1"><?php echo $rowd_['no_lot'];?></font>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <font  size="-1"><?php if($rowPR['price']!="" OR $rowPR['price']!=NULL){echo $rowPR['currency']." ".$rowPR['price'];}else{echo "0";}?></font></b></div></td>
  </tr>
  
  <?php  $totrol5=$totrol5 + $rowd['roll'];
  		 $totbrt5=$totbrt5 + $rowd['_berat'];
		 $totyrd5=$totyrd5 + $rowd['_yard_']; } ?>
  <?php if($jrow5==3){$list5=1;} if($jrow5==2){$list5=2;} if($jrow5==1){$list5=3;}
  for($i5=0;$i5<$list5;$i5++){?>
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
    <td><div align="center"><strong><font size="+1"><?php echo $totrol5;?></font></strong></div></td>
    <td><div align="right"><strong><font size="+1"><?php echo number_format($totbrt5,'2','.',',');?></font></strong></div></td>
    <td><div align="right"><strong><font size="+1"><?php echo number_format($totyrd5,'2','.',',');?></font></strong></div></td>
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
$qryt=mysql_query("SELECT  now() as tgl");
$dtgl=mysql_fetch_array($qryt);
?>
<b>PrintDate :
      <?php echo date("d F Y H:i:s", strtotime($dtgl['tgl']));?></b>
<div class="pagebreak"></div>
<?php }?>
<!-- PAGE 5 END -->
<?php }?>
