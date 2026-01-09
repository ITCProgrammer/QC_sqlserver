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
<!-- PAGE 1 BEGIN --> 
<?php
if($_GET['no_sj1']!=""){
if($_GET['tgl_kirim1']!=""){$tglbuat1=" and tgl_update='$_GET[tgl_kirim1]' ";}else{$tglbuat1=" and DATE_FORMAT(tgl_update,'%y')=DATE_FORMAT(NOW(),'%y')";}
$sqllist= mysql_query("SELECT packing_list.*,tbl_kite.pelanggan,tbl_kite.no_po as nopo,detail_pergerakan_stok.satuan,detail_pergerakan_stok.sisa from packing_list 
LEFT JOIN detail_pergerakan_stok ON packing_list.listno=detail_pergerakan_stok.refno
LEFT JOIN tmp_detail_kite ON detail_pergerakan_stok.id_detail_kj=tmp_detail_kite.id
LEFT JOIN tbl_kite ON tmp_detail_kite.id_kite=tbl_kite.id
WHERE  `packing_list`.`no_sj`='$_GET[no_sj1]' ".$tglbuat1."  
GROUP BY `packing_list`.`no_sj`
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
    <strong> <font size="+2"><center>NO.: <?php echo $dr['no_sj']; if($_GET['a1']=='4'){echo "(B)";}else if($_GET['a1']=='8'){echo "(C)";}else if($_GET['a1']=='12'){echo "(D)";}else if($_GET['a1']=='16'){echo "(E)";}else if($_GET['a1']=='20'){echo "(F)";}else if($_GET['a1']=='24'){echo "(G)";}else if($_GET['a1']=='28'){echo "(H)";}else if($_GET['a1']=='32'){echo "(I)";}else if($_GET['a1']=='36'){echo "(J)";}?></center>
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
	$sqlr= "SELECT *,count(detail_pergerakan_stok.no_roll) as roll,sum(detail_pergerakan_stok.weight) as _berat,sum(detail_pergerakan_stok.yard_) as _yard_ ,detail_pergerakan_stok.sisa from packing_list 
LEFT JOIN detail_pergerakan_stok ON packing_list.listno=detail_pergerakan_stok.refno
LEFT JOIN tmp_detail_kite ON detail_pergerakan_stok.id_detail_kj=tmp_detail_kite.id
LEFT JOIN tbl_kite ON tmp_detail_kite.id_kite=tbl_kite.id
WHERE  `packing_list`.`no_sj`='$_GET[no_sj1]' ".$tglbuat1."
GROUP BY SUBSTR(detail_pergerakan_stok.nokk,1,11),tbl_kite.no_lot";
$data1=mysql_query($sqlr);
$jrow1= mysql_num_rows($data1);
$rt=ceil($jrow1/4);
$a=0 + $_GET['a1'];
	
	$sql= "SELECT *,count(detail_pergerakan_stok.no_roll) as roll,sum(detail_pergerakan_stok.weight) as _berat,sum(detail_pergerakan_stok.yard_) as _yard_ ,detail_pergerakan_stok.sisa from packing_list 
LEFT JOIN detail_pergerakan_stok ON packing_list.listno=detail_pergerakan_stok.refno
LEFT JOIN tmp_detail_kite ON detail_pergerakan_stok.id_detail_kj=tmp_detail_kite.id
LEFT JOIN tbl_kite ON tmp_detail_kite.id_kite=tbl_kite.id
WHERE  `packing_list`.`no_sj`='$_GET[no_sj1]' ".$tglbuat1."
GROUP BY SUBSTR(detail_pergerakan_stok.nokk,1,11),tbl_kite.no_lot LIMIT $a,4"; 
	}
		$data=mysql_query($sql);
		$jrow11= mysql_num_rows($data);
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
  <?php if($jrow11==3){$list1=1;} if($jrow11==2){$list1=2;} if($jrow11==1){$list1=3;}
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
<?php if($rt>1){?>
<p><a href="cetak_surat_jalan_mkt.php?a1=4&no_sj=<?php echo $_GET['no_sj1'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim1'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<?php if($rt>2){?>
<p><a href="cetak_surat_jalan_mkt.php?a1=8&no_sj=<?php echo $_GET['no_sj1'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim1'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<?php if($rt>3){?>
<p><a href="cetak_surat_jalan_mkt.php?a1=12&no_sj=<?php echo $_GET['no_sj1'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim1'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<?php if($rt>4){?>
<p><a href="cetak_surat_jalan_mkt.php?a1=16&no_sj=<?php echo $_GET['no_sj1'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim1'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<?php if($rt>5){?>
<p><a href="cetak_surat_jalan_mkt.php?a1=20&no_sj=<?php echo $_GET['no_sj1'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim1'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<?php if($rt>6){?>
<p><a href="cetak_surat_jalan_mkt.php?a1=24&no_sj=<?php echo $_GET['no_sj1'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim1'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<?php if($rt>7){?>
<p><a href="cetak_surat_jalan_mkt.php?a1=28&no_sj=<?php echo $_GET['no_sj1'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim1'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<?php if($rt>8){?>
<p><a href="cetak_surat_jalan_mkt.php?a1=32&no_sj=<?php echo $_GET['no_sj1'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim1'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<?php if($rt>9){?>
<p><a href="cetak_surat_jalan_mkt.php?a1=36&no_sj=<?php echo $_GET['no_sj1'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim1'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<div class="pagebreak"></div>
<?php }?>
<!-- PAGE 1 END -->
<!-- PAGE 2 BEGIN -->
<?php
if($_GET['no_sj2']!=""){
if($_GET['tgl_kirim2']!=""){$tglbuat2=" and tgl_update='$_GET[tgl_kirim2]' ";}else{$tglbuat2=" and DATE_FORMAT(tgl_update,'%y')=DATE_FORMAT(NOW(),'%y')";}
$sqllist2= mysql_query("SELECT packing_list.*,tbl_kite.pelanggan,tbl_kite.no_po as nopo,detail_pergerakan_stok.satuan,detail_pergerakan_stok.sisa from packing_list 
LEFT JOIN detail_pergerakan_stok ON packing_list.listno=detail_pergerakan_stok.refno
LEFT JOIN tmp_detail_kite ON detail_pergerakan_stok.id_detail_kj=tmp_detail_kite.id
LEFT JOIN tbl_kite ON tmp_detail_kite.id_kite=tbl_kite.id
WHERE  `packing_list`.`no_sj`='$_GET[no_sj2]' ".$tglbuat2."  
GROUP BY `packing_list`.`no_sj`
"); 
	
     $dr2=mysql_fetch_array($sqllist2);
	 $order2=trim($dr2['no_order']);
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
$rbuyer2=mssql_fetch_array($sqlb2);
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
    <strong>PO : <font align="center" size="+1.5"><?php echo $dr2['no_po']; ?></font></strong></td>
    <td width="26%" valign="top">
    <strong> <font size="+2"><center>NO.: <?php echo $dr2['no_sj']; if($_GET['a2']=='4'){echo "(B)";}else if($_GET['a2']=='8'){echo "(C)";}else if($_GET['a2']=='12'){echo "(D)";}else if($_GET['a2']=='16'){echo "(E)";}else if($_GET['a2']=='20'){echo "(F)";}else if($_GET['a2']=='24'){echo "(G)";}else if($_GET['a2']=='28'){echo "(H)";}else if($_GET['a2']=='32'){echo "(I)";}else if($_GET['a2']=='36'){echo "(J)";}?></center>
    </font>
    <font align="left" ><strong>Tanggal: <?php  echo date("d-F-Y", strtotime($dr2['tgl_buat']));?></strong></font>
    
    <br /><strong>No. Order:</strong>
    <font align="center" size="+1"></font><font align="left" size="+1"><strong><?php echo $dr2['no_order'];?></strong></font>
    </strong></td>
    <td width="49%" valign="top"><strong>Kepada Yth.<br /> <?php 
	$sql=mssql_query("select * from partners where id='$rbuyer2[id]'"); 
	$data=mssql_fetch_array($sql);
	$name = $dr2['pelanggan'];
$nama1=strpos($name, "/");
$nama2=trim(substr($name,0,$nama1));
$nama3=trim(substr($name,$nama1,100));
echo $nama2;
//echo $data['PartnerName']; ?><?php
$sql2=mssql_query("select * from partners where partnername like '$nama2%'");
$data2=mssql_fetch_array($sql2);
$sqlalamat=mysql_query("SELECT alamat1 FROM packing_list WHERE no_sj='$dr2[no_sj]' and tgl_update='$dr2[tgl_update]'  LIMIT 1");
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
	  <?php if($dr2['sisa']=="FOC"){echo $dr2['sisa'];} ?>
	</strong></font></td>
    <td width="12%" rowspan="2"><div align="center"><strong>Lot</strong></div></td>
  </tr>
  <tr>
    <td width="4%"><div align="center"><strong>ROLL</strong></div></td>
    <td width="4%"><div align="center"><strong>KG</strong></div></td>
    <td width="5%"><div align="center"><strong><?php if($dr2['satuan']=='Yard'){echo "YARD";}else{echo "METER";}?></strong></div></td>
  </tr>
   <?php
	if($_GET['no_sj2']!='')
	{ 
	$sqlr2= "SELECT *,count(detail_pergerakan_stok.no_roll) as roll,sum(detail_pergerakan_stok.weight) as _berat,sum(detail_pergerakan_stok.yard_) as _yard_ ,detail_pergerakan_stok.sisa from packing_list 
LEFT JOIN detail_pergerakan_stok ON packing_list.listno=detail_pergerakan_stok.refno
LEFT JOIN tmp_detail_kite ON detail_pergerakan_stok.id_detail_kj=tmp_detail_kite.id
LEFT JOIN tbl_kite ON tmp_detail_kite.id_kite=tbl_kite.id
WHERE  `packing_list`.`no_sj`='$_GET[no_sj2]' ".$tglbuat2."
GROUP BY SUBSTR(detail_pergerakan_stok.nokk,1,11),tbl_kite.no_lot";
$data1=mysql_query($sqlr2);
$jrow1= mysql_num_rows($data1);
$rt2=ceil($jrow1/4);
$a2=0 + $_GET['a2'];
	
	$sql= "SELECT *,count(detail_pergerakan_stok.no_roll) as roll,sum(detail_pergerakan_stok.weight) as _berat,sum(detail_pergerakan_stok.yard_) as _yard_ ,detail_pergerakan_stok.sisa from packing_list 
LEFT JOIN detail_pergerakan_stok ON packing_list.listno=detail_pergerakan_stok.refno
LEFT JOIN tmp_detail_kite ON detail_pergerakan_stok.id_detail_kj=tmp_detail_kite.id
LEFT JOIN tbl_kite ON tmp_detail_kite.id_kite=tbl_kite.id
WHERE  `packing_list`.`no_sj`='$_GET[no_sj2]' ".$tglbuat2."
GROUP BY SUBSTR(detail_pergerakan_stok.nokk,1,11),tbl_kite.no_lot LIMIT $a2,4"; 
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

		 $sqlPR=mysql_query("SELECT * FROM tbl_pengiriman WHERE tgl_kirim='$_GET[tgl_kirim2]' AND no_sj='$_GET[no_sj2]' AND no_item='$rowd[no_item]' AND no_po='$rowd[no_po]' AND warna='$rowd[warna]'");
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
<?php if($rt2>1){?>
<p><a href="cetak_surat_jalan_mkt.php?a2=4&no_sj=<?php echo $_GET['no_sj2'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim2'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<?php if($rt2>2){?>
<p><a href="cetak_surat_jalan_mkt.php?a2=8&no_sj=<?php echo $_GET['no_sj2'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim2'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<?php if($rt2>3){?>
<p><a href="cetak_surat_jalan_mkt.php?a2=12&no_sj=<?php echo $_GET['no_sj2'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim2'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<?php if($rt2>4){?>
<p><a href="cetak_surat_jalan_mkt.php?a2=16&no_sj=<?php echo $_GET['no_sj2'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim2'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<?php if($rt2>5){?>
<p><a href="cetak_surat_jalan_mkt.php?a2=20&no_sj=<?php echo $_GET['no_sj2'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim2'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<?php if($rt2>6){?>
<p><a href="cetak_surat_jalan_mkt.php?a2=24&no_sj=<?php echo $_GET['no_sj2'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim2'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<?php if($rt2>7){?>
<p><a href="cetak_surat_jalan_mkt.php?a2=28&no_sj=<?php echo $_GET['no_sj2'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim2'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<?php if($rt2>8){?>
<p><a href="cetak_surat_jalan_mkt.php?a2=32&no_sj=<?php echo $_GET['no_sj2'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim2'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<?php if($rt2>9){?>
<p><a href="cetak_surat_jalan_mkt.php?a2=36&no_sj=<?php echo $_GET['no_sj2'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim2'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<div class="pagebreak"></div>
<?php }?> 
<!-- PAGE 2 END -->
<!-- PAGE 3 BEGIN -->
<?php
if($_GET['no_sj3']!=""){
if($_GET['tgl_kirim3']!=""){$tglbuat3=" and tgl_update='$_GET[tgl_kirim3]' ";}else{$tglbuat3=" and DATE_FORMAT(tgl_update,'%y')=DATE_FORMAT(NOW(),'%y')";}
$sqllist3= mysql_query("SELECT packing_list.*,tbl_kite.pelanggan,tbl_kite.no_po as nopo,detail_pergerakan_stok.satuan,detail_pergerakan_stok.sisa from packing_list 
LEFT JOIN detail_pergerakan_stok ON packing_list.listno=detail_pergerakan_stok.refno
LEFT JOIN tmp_detail_kite ON detail_pergerakan_stok.id_detail_kj=tmp_detail_kite.id
LEFT JOIN tbl_kite ON tmp_detail_kite.id_kite=tbl_kite.id
WHERE  `packing_list`.`no_sj`='$_GET[no_sj3]' ".$tglbuat3."  
GROUP BY `packing_list`.`no_sj`
"); 
	
     $dr3=mysql_fetch_array($sqllist3);
	 $order3=trim($dr3['no_order']);
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
$rbuyer3=mssql_fetch_array($sqlb3);
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
    <strong>PO : <font align="center" size="+1.5"><?php echo $dr3['no_po']; ?></font></strong></td>
    <td width="26%" valign="top">
    <strong> <font size="+2"><center>NO.: <?php echo $dr3['no_sj']; if($_GET['a3']=='4'){echo "(B)";}else if($_GET['a3']=='8'){echo "(C)";}else if($_GET['a3']=='12'){echo "(D)";}else if($_GET['a3']=='16'){echo "(E)";}else if($_GET['a3']=='20'){echo "(F)";}else if($_GET['a3']=='24'){echo "(G)";}else if($_GET['a3']=='28'){echo "(H)";}else if($_GET['a3']=='32'){echo "(I)";}else if($_GET['a3']=='36'){echo "(J)";}?></center>
    </font>
    <font align="left" ><strong>Tanggal: <?php  echo date("d-F-Y", strtotime($dr3['tgl_buat']));?></strong></font>
    
    <br /><strong>No. Order:</strong>
    <font align="center" size="+1"></font><font align="left" size="+1"><strong><?php echo $dr3['no_order'];?></strong></font>
    </strong></td>
    <td width="49%" valign="top"><strong>Kepada Yth.<br /> <?php 
	$sql=mssql_query("select * from partners where id='$rbuyer3[id]'"); 
	$data=mssql_fetch_array($sql);
	$name = $dr3['pelanggan'];
$nama1=strpos($name, "/");
$nama2=trim(substr($name,0,$nama1));
$nama3=trim(substr($name,$nama1,100));
echo $nama2;
//echo $data['PartnerName']; ?><?php
$sql2=mssql_query("select * from partners where partnername like '$nama2%'");
$data2=mssql_fetch_array($sql2);
$sqlalamat=mysql_query("SELECT alamat1 FROM packing_list WHERE no_sj='$dr3[no_sj]' and tgl_update='$dr3[tgl_update]'  LIMIT 1");
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
	  <?php if($dr3['sisa']=="FOC"){echo $dr3['sisa'];} ?>
	</strong></font></td>
    <td width="12%" rowspan="2"><div align="center"><strong>Lot</strong></div></td>
  </tr>
  <tr>
    <td width="4%"><div align="center"><strong>ROLL</strong></div></td>
    <td width="4%"><div align="center"><strong>KG</strong></div></td>
    <td width="5%"><div align="center"><strong><?php if($dr3['satuan']=='Yard'){echo "YARD";}else{echo "METER";}?></strong></div></td>
  </tr>
   <?php
	if($_GET['no_sj3']!='')
	{ 
	$sqlr= "SELECT *,count(detail_pergerakan_stok.no_roll) as roll,sum(detail_pergerakan_stok.weight) as _berat,sum(detail_pergerakan_stok.yard_) as _yard_ ,detail_pergerakan_stok.sisa from packing_list 
LEFT JOIN detail_pergerakan_stok ON packing_list.listno=detail_pergerakan_stok.refno
LEFT JOIN tmp_detail_kite ON detail_pergerakan_stok.id_detail_kj=tmp_detail_kite.id
LEFT JOIN tbl_kite ON tmp_detail_kite.id_kite=tbl_kite.id
WHERE  `packing_list`.`no_sj`='$_GET[no_sj3]' ".$tglbuat3."
GROUP BY SUBSTR(detail_pergerakan_stok.nokk,1,11),tbl_kite.no_lot";
$data1=mysql_query($sqlr);
$jrow1= mysql_num_rows($data1);
$rt3=ceil($jrow1/4);
$a3=0 + $_GET['a3'];
	
	$sql= "SELECT *,count(detail_pergerakan_stok.no_roll) as roll,sum(detail_pergerakan_stok.weight) as _berat,sum(detail_pergerakan_stok.yard_) as _yard_ ,detail_pergerakan_stok.sisa from packing_list 
LEFT JOIN detail_pergerakan_stok ON packing_list.listno=detail_pergerakan_stok.refno
LEFT JOIN tmp_detail_kite ON detail_pergerakan_stok.id_detail_kj=tmp_detail_kite.id
LEFT JOIN tbl_kite ON tmp_detail_kite.id_kite=tbl_kite.id
WHERE  `packing_list`.`no_sj`='$_GET[no_sj3]' ".$tglbuat3."
GROUP BY SUBSTR(detail_pergerakan_stok.nokk,1,11),tbl_kite.no_lot LIMIT $a3,4"; 
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

		 $sqlPR=mysql_query("SELECT * FROM tbl_pengiriman WHERE tgl_kirim='$_GET[tgl_kirim3]' AND no_sj='$_GET[no_sj3]' AND no_item='$rowd[no_item]' AND no_po='$rowd[no_po]' AND warna='$rowd[warna]'");
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
<?php if($rt3>1){?>
<p><a href="cetak_surat_jalan_mkt.php?a3=4&no_sj=<?php echo $_GET['no_sj3'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim3'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<?php if($rt3>2){?>
<p><a href="cetak_surat_jalan_mkt.php?a3=8&no_sj=<?php echo $_GET['no_sj3'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim3'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<?php if($rt3>3){?>
<p><a href="cetak_surat_jalan_mkt.php?a3=12&no_sj=<?php echo $_GET['no_sj3'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim3'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<?php if($rt3>4){?>
<p><a href="cetak_surat_jalan_mkt.php?a3=16&no_sj=<?php echo $_GET['no_sj3'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim3'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<?php if($rt3>5){?>
<p><a href="cetak_surat_jalan_mkt.php?a3=20&no_sj=<?php echo $_GET['no_sj3'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim3'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<?php if($rt3>6){?>
<p><a href="cetak_surat_jalan_mkt.php?a3=24&no_sj=<?php echo $_GET['no_sj3'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim3'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<?php if($rt3>7){?>
<p><a href="cetak_surat_jalan_mkt.php?a3=28&no_sj=<?php echo $_GET['no_sj3'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim3'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<?php if($rt3>8){?>
<p><a href="cetak_surat_jalan_mkt.php?a3=32&no_sj=<?php echo $_GET['no_sj3'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim3'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<?php if($rt3>9){?>
<p><a href="cetak_surat_jalan_mkt.php?a3=36&no_sj=<?php echo $_GET['no_sj3'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim3'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<div class="pagebreak"></div>
<?php }?>   
<!-- PAGE 3 END -->
<!-- PAGE 4 BEGIN -->
<?php
if($_GET['no_sj4']!=""){
if($_GET['tgl_kirim4']!=""){$tglbuat4=" and tgl_update='$_GET[tgl_kirim4]' ";}else{$tglbuat4=" and DATE_FORMAT(tgl_update,'%y')=DATE_FORMAT(NOW(),'%y')";}
$sqllist4= mysql_query("SELECT packing_list.*,tbl_kite.pelanggan,tbl_kite.no_po as nopo,detail_pergerakan_stok.satuan,detail_pergerakan_stok.sisa from packing_list 
LEFT JOIN detail_pergerakan_stok ON packing_list.listno=detail_pergerakan_stok.refno
LEFT JOIN tmp_detail_kite ON detail_pergerakan_stok.id_detail_kj=tmp_detail_kite.id
LEFT JOIN tbl_kite ON tmp_detail_kite.id_kite=tbl_kite.id
WHERE  `packing_list`.`no_sj`='$_GET[no_sj4]' ".$tglbuat4."  
GROUP BY `packing_list`.`no_sj`
"); 
	
     $dr4=mysql_fetch_array($sqllist4);
	 $order4=trim($dr4['no_order']);
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
$rbuyer4=mssql_fetch_array($sqlb4);
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
    <strong>PO : <font align="center" size="+1.5"><?php echo $dr4['no_po']; ?></font></strong></td>
    <td width="26%" valign="top">
    <strong> <font size="+2"><center>NO.: <?php echo $dr4['no_sj']; if($_GET['a4']=='4'){echo "(B)";}else if($_GET['a4']=='8'){echo "(C)";}else if($_GET['a4']=='12'){echo "(D)";}else if($_GET['a4']=='16'){echo "(E)";}else if($_GET['a4']=='20'){echo "(F)";}else if($_GET['a4']=='24'){echo "(G)";}else if($_GET['a4']=='28'){echo "(H)";}else if($_GET['a4']=='32'){echo "(I)";}else if($_GET['a4']=='36'){echo "(J)";}?></center>
    </font>
    <font align="left" ><strong>Tanggal: <?php  echo date("d-F-Y", strtotime($dr4['tgl_buat']));?></strong></font>
    
    <br /><strong>No. Order:</strong>
    <font align="center" size="+1"></font><font align="left" size="+1"><strong><?php echo $dr4['no_order'];?></strong></font>
    </strong></td>
    <td width="49%" valign="top"><strong>Kepada Yth.<br /> <?php 
	$sql=mssql_query("select * from partners where id='$rbuyer4[id]'"); 
	$data=mssql_fetch_array($sql);
	$name = $dr4['pelanggan'];
$nama1=strpos($name, "/");
$nama2=trim(substr($name,0,$nama1));
$nama3=trim(substr($name,$nama1,100));
echo $nama2;
//echo $data['PartnerName']; ?><?php
$sql2=mssql_query("select * from partners where partnername like '$nama2%'");
$data2=mssql_fetch_array($sql2);
$sqlalamat=mysql_query("SELECT alamat1 FROM packing_list WHERE no_sj='$dr4[no_sj]' and tgl_update='$dr4[tgl_update]'  LIMIT 1");
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
	  <?php if($dr4['sisa']=="FOC"){echo $dr4['sisa'];} ?>
	</strong></font></td>
    <td width="12%" rowspan="2"><div align="center"><strong>Lot</strong></div></td>
  </tr>
  <tr>
    <td width="4%"><div align="center"><strong>ROLL</strong></div></td>
    <td width="4%"><div align="center"><strong>KG</strong></div></td>
    <td width="5%"><div align="center"><strong><?php if($dr4['satuan']=='Yard'){echo "YARD";}else{echo "METER";}?></strong></div></td>
  </tr>
   <?php
	if($_GET['no_sj4']!='')
	{ 
	$sqlr= "SELECT *,count(detail_pergerakan_stok.no_roll) as roll,sum(detail_pergerakan_stok.weight) as _berat,sum(detail_pergerakan_stok.yard_) as _yard_ ,detail_pergerakan_stok.sisa from packing_list 
LEFT JOIN detail_pergerakan_stok ON packing_list.listno=detail_pergerakan_stok.refno
LEFT JOIN tmp_detail_kite ON detail_pergerakan_stok.id_detail_kj=tmp_detail_kite.id
LEFT JOIN tbl_kite ON tmp_detail_kite.id_kite=tbl_kite.id
WHERE  `packing_list`.`no_sj`='$_GET[no_sj4]' ".$tglbuat4."
GROUP BY SUBSTR(detail_pergerakan_stok.nokk,1,11),tbl_kite.no_lot";
$data1=mysql_query($sqlr);
$jrow1= mysql_num_rows($data1);
$rt4=ceil($jrow1/4);
$a4=0 + $_GET['a4'];
	
	$sql= "SELECT *,count(detail_pergerakan_stok.no_roll) as roll,sum(detail_pergerakan_stok.weight) as _berat,sum(detail_pergerakan_stok.yard_) as _yard_ ,detail_pergerakan_stok.sisa from packing_list 
LEFT JOIN detail_pergerakan_stok ON packing_list.listno=detail_pergerakan_stok.refno
LEFT JOIN tmp_detail_kite ON detail_pergerakan_stok.id_detail_kj=tmp_detail_kite.id
LEFT JOIN tbl_kite ON tmp_detail_kite.id_kite=tbl_kite.id
WHERE  `packing_list`.`no_sj`='$_GET[no_sj4]' ".$tglbuat4."
GROUP BY SUBSTR(detail_pergerakan_stok.nokk,1,11),tbl_kite.no_lot LIMIT $a4,4"; 
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

		 $sqlPR=mysql_query("SELECT * FROM tbl_pengiriman WHERE tgl_kirim='$_GET[tgl_kirim4]' AND no_sj='$_GET[no_sj4]' AND no_item='$rowd[no_item]' AND no_po='$rowd[no_po]' AND warna='$rowd[warna]'");
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
<?php if($rt4>1){?>
<p><a href="cetak_surat_jalan_mkt.php?a4=4&no_sj=<?php echo $_GET['no_sj4'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim4'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<?php if($rt4>2){?>
<p><a href="cetak_surat_jalan_mkt.php?a4=8&no_sj=<?php echo $_GET['no_sj4'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim4'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<?php if($rt4>3){?>
<p><a href="cetak_surat_jalan_mkt.php?a4=12&no_sj=<?php echo $_GET['no_sj4'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim4'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<?php if($rt4>4){?>
<p><a href="cetak_surat_jalan_mkt.php?a4=16&no_sj=<?php echo $_GET['no_sj4'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim4'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<?php if($rt4>5){?>
<p><a href="cetak_surat_jalan_mkt.php?a4=20&no_sj=<?php echo $_GET['no_sj4'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim4'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<?php if($rt4>6){?>
<p><a href="cetak_surat_jalan_mkt.php?a4=24&no_sj=<?php echo $_GET['no_sj4'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim4'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<?php if($rt4>7){?>
<p><a href="cetak_surat_jalan_mkt.php?a4=28&no_sj=<?php echo $_GET['no_sj4'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim4'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<?php if($rt4>8){?>
<p><a href="cetak_surat_jalan_mkt.php?a4=32&no_sj=<?php echo $_GET['no_sj4'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim4'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<?php if($rt4>9){?>
<p><a href="cetak_surat_jalan_mkt.php?a4=36&no_sj=<?php echo $_GET['no_sj4'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim4'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<div class="pagebreak"></div>
<?php }?>  
<!-- PAGE 4 END -->
<!-- PAGE 5 BEGIN -->
<?php
if($_GET['no_sj5']!=""){
if($_GET['tgl_kirim5']!=""){$tglbuat5=" and tgl_update='$_GET[tgl_kirim5]' ";}else{$tglbuat5=" and DATE_FORMAT(tgl_update,'%y')=DATE_FORMAT(NOW(),'%y')";}
$sqllist5= mysql_query("SELECT packing_list.*,tbl_kite.pelanggan,tbl_kite.no_po as nopo,detail_pergerakan_stok.satuan,detail_pergerakan_stok.sisa from packing_list 
LEFT JOIN detail_pergerakan_stok ON packing_list.listno=detail_pergerakan_stok.refno
LEFT JOIN tmp_detail_kite ON detail_pergerakan_stok.id_detail_kj=tmp_detail_kite.id
LEFT JOIN tbl_kite ON tmp_detail_kite.id_kite=tbl_kite.id
WHERE  `packing_list`.`no_sj`='$_GET[no_sj5]' ".$tglbuat5."  
GROUP BY `packing_list`.`no_sj`
"); 
	
     $dr5=mysql_fetch_array($sqllist5);
	 $order5=trim($dr5['no_order']);
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
$rbuyer5=mssql_fetch_array($sqlb5);
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
    <strong>PO : <font align="center" size="+1.5"><?php echo $dr5['no_po']; ?></font></strong></td>
    <td width="26%" valign="top">
    <strong> <font size="+2"><center>NO.: <?php echo $dr5['no_sj']; if($_GET['a5']=='4'){echo "(B)";}else if($_GET['a5']=='8'){echo "(C)";}else if($_GET['a5']=='12'){echo "(D)";}else if($_GET['a5']=='16'){echo "(E)";}else if($_GET['a5']=='20'){echo "(F)";}else if($_GET['a5']=='24'){echo "(G)";}else if($_GET['a5']=='28'){echo "(H)";}else if($_GET['a5']=='32'){echo "(I)";}else if($_GET['a5']=='36'){echo "(J)";}?></center>
    </font>
    <font align="left" ><strong>Tanggal: <?php  echo date("d-F-Y", strtotime($dr5['tgl_buat']));?></strong></font>
    
    <br /><strong>No. Order:</strong>
    <font align="center" size="+1"></font><font align="left" size="+1"><strong><?php echo $dr5['no_order'];?></strong></font>
    </strong></td>
    <td width="49%" valign="top"><strong>Kepada Yth.<br /> <?php 
	$sql=mssql_query("select * from partners where id='$rbuyer[id]'"); 
	$data=mssql_fetch_array($sql);
	$name = $dr5['pelanggan'];
$nama1=strpos($name, "/");
$nama2=trim(substr($name,0,$nama1));
$nama3=trim(substr($name,$nama1,100));
echo $nama2;
//echo $data['PartnerName']; ?><?php
$sql2=mssql_query("select * from partners where partnername like '$nama2%'");
$data2=mssql_fetch_array($sql2);
$sqlalamat=mysql_query("SELECT alamat1 FROM packing_list WHERE no_sj='$dr5[no_sj]' and tgl_update='$dr5[tgl_update]'  LIMIT 1");
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
	  <?php if($dr5['sisa']=="FOC"){echo $dr5['sisa'];} ?>
	</strong></font></td>
    <td width="12%" rowspan="2"><div align="center"><strong>Lot</strong></div></td>
  </tr>
  <tr>
    <td width="4%"><div align="center"><strong>ROLL</strong></div></td>
    <td width="4%"><div align="center"><strong>KG</strong></div></td>
    <td width="5%"><div align="center"><strong><?php if($dr5['satuan']=='Yard'){echo "YARD";}else{echo "METER";}?></strong></div></td>
  </tr>
   <?php
	if($_GET['no_sj5']!='')
	{ 
	$sqlr= "SELECT *,count(detail_pergerakan_stok.no_roll) as roll,sum(detail_pergerakan_stok.weight) as _berat,sum(detail_pergerakan_stok.yard_) as _yard_ ,detail_pergerakan_stok.sisa from packing_list 
LEFT JOIN detail_pergerakan_stok ON packing_list.listno=detail_pergerakan_stok.refno
LEFT JOIN tmp_detail_kite ON detail_pergerakan_stok.id_detail_kj=tmp_detail_kite.id
LEFT JOIN tbl_kite ON tmp_detail_kite.id_kite=tbl_kite.id
WHERE  `packing_list`.`no_sj`='$_GET[no_sj5]' ".$tglbuat5."
GROUP BY SUBSTR(detail_pergerakan_stok.nokk,1,11),tbl_kite.no_lot";
$data1=mysql_query($sqlr);
$jrow1= mysql_num_rows($data1);
$rt5=ceil($jrow1/4);
$a5=0 + $_GET['a5'];
	
	$sql= "SELECT *,count(detail_pergerakan_stok.no_roll) as roll,sum(detail_pergerakan_stok.weight) as _berat,sum(detail_pergerakan_stok.yard_) as _yard_ ,detail_pergerakan_stok.sisa from packing_list 
LEFT JOIN detail_pergerakan_stok ON packing_list.listno=detail_pergerakan_stok.refno
LEFT JOIN tmp_detail_kite ON detail_pergerakan_stok.id_detail_kj=tmp_detail_kite.id
LEFT JOIN tbl_kite ON tmp_detail_kite.id_kite=tbl_kite.id
WHERE  `packing_list`.`no_sj`='$_GET[no_sj5]' ".$tglbuat5."
GROUP BY SUBSTR(detail_pergerakan_stok.nokk,1,11),tbl_kite.no_lot LIMIT $a5,4"; 
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

		 $sqlPR=mysql_query("SELECT * FROM tbl_pengiriman WHERE tgl_kirim='$_GET[tgl_kirim5]' AND no_sj='$_GET[no_sj5]' AND no_item='$rowd[no_item]' AND no_po='$rowd[no_po]' AND warna='$rowd[warna]'");
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
<?php if($rt5>1){?>
<p><a href="cetak_surat_jalan_mkt.php?a5=4&no_sj=<?php echo $_GET['no_sj5'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim5'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<?php if($rt5>2){?>
<p><a href="cetak_surat_jalan_mkt.php?a5=8&no_sj=<?php echo $_GET['no_sj5'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim5'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<?php if($rt5>3){?>
<p><a href="cetak_surat_jalan_mkt.php?a5=12&no_sj=<?php echo $_GET['no_sj5'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim5'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<?php if($rt5>4){?>
<p><a href="cetak_surat_jalan_mkt.php?a5=16&no_sj=<?php echo $_GET['no_sj5'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim5'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<?php if($rt5>5){?>
<p><a href="cetak_surat_jalan_mkt.php?a5=20&no_sj=<?php echo $_GET['no_sj5'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim5'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<?php if($rt5>6){?>
<p><a href="cetak_surat_jalan_mkt.php?a5=24&no_sj=<?php echo $_GET['no_sj5'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim5'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<?php if($rt5>7){?>
<p><a href="cetak_surat_jalan_mkt.php?a5=28&no_sj=<?php echo $_GET['no_sj5'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim5'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<?php if($rt5>8){?>
<p><a href="cetak_surat_jalan_mkt.php?a5=32&no_sj=<?php echo $_GET['no_sj5'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim5'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<?php if($rt5>9){?>
<p><a href="cetak_surat_jalan_mkt.php?a5=36&no_sj=<?php echo $_GET['no_sj5'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim5'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<div class="pagebreak"></div>
<?php }?>    
<!-- PAGE 5 END -->
<!-- PAGE 6 BEGIN --> 
<?php
if($_GET['no_sj6']!=""){
if($_GET['tgl_kirim6']!=""){$tglbuat6=" and tgl_update='$_GET[tgl_kirim6]' ";}else{$tglbuat6=" and DATE_FORMAT(tgl_update,'%y')=DATE_FORMAT(NOW(),'%y')";}
$sqllist6= mysql_query("SELECT packing_list.*,tbl_kite.pelanggan,tbl_kite.no_po as nopo,detail_pergerakan_stok.satuan,detail_pergerakan_stok.sisa from packing_list 
LEFT JOIN detail_pergerakan_stok ON packing_list.listno=detail_pergerakan_stok.refno
LEFT JOIN tmp_detail_kite ON detail_pergerakan_stok.id_detail_kj=tmp_detail_kite.id
LEFT JOIN tbl_kite ON tmp_detail_kite.id_kite=tbl_kite.id
WHERE  `packing_list`.`no_sj`='$_GET[no_sj6]' ".$tglbuat6."  
GROUP BY `packing_list`.`no_sj`
"); 
	
     $dr6=mysql_fetch_array($sqllist6);
	 $order6=trim($dr6['no_order']);
	$sqlb6=mssql_query("SELECT 
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
where  JobOrders.documentno = '$order6' and not Description='' 
) AS EMP
WHERE Row = 1");
$rbuyer6=mssql_fetch_array($sqlb6);
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
    <strong>PO : <font align="center" size="+1.5"><?php echo $dr6['no_po']; ?></font></strong></td>
    <td width="26%" valign="top">
    <strong> <font size="+2"><center>NO.: <?php echo $dr6['no_sj']; if($_GET['a6']=='4'){echo "(B)";}else if($_GET['a6']=='8'){echo "(C)";}else if($_GET['a6']=='12'){echo "(D)";}else if($_GET['a6']=='16'){echo "(E)";}else if($_GET['a6']=='20'){echo "(F)";}else if($_GET['a6']=='24'){echo "(G)";}else if($_GET['a6']=='28'){echo "(H)";}else if($_GET['a6']=='32'){echo "(I)";}else if($_GET['a6']=='36'){echo "(J)";}?></center>
    </font>
    <font align="left" ><strong>Tanggal: <?php  echo date("d-F-Y", strtotime($dr6['tgl_buat']));?></strong></font>
    
    <br /><strong>No. Order:</strong>
    <font align="center" size="+1"></font><font align="left" size="+1"><strong><?php echo $dr6['no_order'];?></strong></font>
    </strong></td>
    <td width="49%" valign="top"><strong>Kepada Yth.<br /> <?php 
	$sql=mssql_query("select * from partners where id='$rbuyer6[id]'"); 
	$data=mssql_fetch_array($sql);
	$name = $dr6['pelanggan'];
$nama1=strpos($name, "/");
$nama2=trim(substr($name,0,$nama1));
$nama3=trim(substr($name,$nama1,100));
echo $nama2;
//echo $data['PartnerName']; ?><?php
$sql2=mssql_query("select * from partners where partnername like '$nama2%'");
$data2=mssql_fetch_array($sql2);
$sqlalamat=mysql_query("SELECT alamat1 FROM packing_list WHERE no_sj='$dr6[no_sj]' and tgl_update='$dr6[tgl_update]'  LIMIT 1");
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
	  <?php if($dr6['sisa']=="FOC"){echo $dr6['sisa'];} ?>
	</strong></font></td>
    <td width="12%" rowspan="2"><div align="center"><strong>Lot</strong></div></td>
  </tr>
  <tr>
    <td width="4%"><div align="center"><strong>ROLL</strong></div></td>
    <td width="4%"><div align="center"><strong>KG</strong></div></td>
    <td width="5%"><div align="center"><strong><?php if($dr6['satuan']=='Yard'){echo "YARD";}else{echo "METER";}?></strong></div></td>
  </tr>
   <?php
	if($_GET['no_sj6']!='')
	{ 
	$sqlr= "SELECT *,count(detail_pergerakan_stok.no_roll) as roll,sum(detail_pergerakan_stok.weight) as _berat,sum(detail_pergerakan_stok.yard_) as _yard_ ,detail_pergerakan_stok.sisa from packing_list 
LEFT JOIN detail_pergerakan_stok ON packing_list.listno=detail_pergerakan_stok.refno
LEFT JOIN tmp_detail_kite ON detail_pergerakan_stok.id_detail_kj=tmp_detail_kite.id
LEFT JOIN tbl_kite ON tmp_detail_kite.id_kite=tbl_kite.id
WHERE  `packing_list`.`no_sj`='$_GET[no_sj6]' ".$tglbuat6."
GROUP BY SUBSTR(detail_pergerakan_stok.nokk,1,11),tbl_kite.no_lot";
$data1=mysql_query($sqlr);
$jrow1= mysql_num_rows($data1);
$rt6=ceil($jrow1/4);
$a6=0 + $_GET['a6'];
	
	$sql= "SELECT *,count(detail_pergerakan_stok.no_roll) as roll,sum(detail_pergerakan_stok.weight) as _berat,sum(detail_pergerakan_stok.yard_) as _yard_ ,detail_pergerakan_stok.sisa from packing_list 
LEFT JOIN detail_pergerakan_stok ON packing_list.listno=detail_pergerakan_stok.refno
LEFT JOIN tmp_detail_kite ON detail_pergerakan_stok.id_detail_kj=tmp_detail_kite.id
LEFT JOIN tbl_kite ON tmp_detail_kite.id_kite=tbl_kite.id
WHERE  `packing_list`.`no_sj`='$_GET[no_sj6]' ".$tglbuat6."
GROUP BY SUBSTR(detail_pergerakan_stok.nokk,1,11),tbl_kite.no_lot LIMIT $a6,4"; 
	}
		$data=mysql_query($sql);
		$jrow6= mysql_num_rows($data);
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

		 $sqlPR=mysql_query("SELECT * FROM tbl_pengiriman WHERE tgl_kirim='$_GET[tgl_kirim6]' AND no_sj='$_GET[no_sj6]' AND no_item='$rowd[no_item]' AND no_po='$rowd[no_po]' AND warna='$rowd[warna]'");
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
  
  <?php  $totrol6=$totrol6 + $rowd['roll'];
  		 $totbrt6=$totbrt6 + $rowd['_berat'];
		 $totyrd6=$totyrd6 + $rowd['_yard_']; } ?>
  <?php if($jrow6==3){$list6=1;} if($jrow6==2){$list6=2;} if($jrow6==1){$list6=3;}
  for($i6=0;$i6<$list6;$i16+){?>
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
    <td><div align="center"><strong><font size="+1"><?php echo $totrol6;?></font></strong></div></td>
    <td><div align="right"><strong><font size="+1"><?php echo number_format($totbrt6,'2','.',',');?></font></strong></div></td>
    <td><div align="right"><strong><font size="+1"><?php echo number_format($totyrd6,'2','.',',');?></font></strong></div></td>
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
<?php if($rt6>1){?>
<p><a href="cetak_surat_jalan_mkt.php?a6=4&no_sj=<?php echo $_GET['no_sj6'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim6'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<?php if($rt6>2){?>
<p><a href="cetak_surat_jalan_mkt.php?a6=8&no_sj=<?php echo $_GET['no_sj6'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim6'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<?php if($rt6>3){?>
<p><a href="cetak_surat_jalan_mkt.php?a6=12&no_sj=<?php echo $_GET['no_sj6'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim6'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<?php if($rt6>4){?>
<p><a href="cetak_surat_jalan_mkt.php?a6=16&no_sj=<?php echo $_GET['no_sj6'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim6'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<?php if($rt6>5){?>
<p><a href="cetak_surat_jalan_mkt.php?a6=20&no_sj=<?php echo $_GET['no_sj6'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim6'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<?php if($rt6>6){?>
<p><a href="cetak_surat_jalan_mkt.php?a6=24&no_sj=<?php echo $_GET['no_sj6'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim6'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<?php if($rt6>7){?>
<p><a href="cetak_surat_jalan_mkt.php?a6=28&no_sj=<?php echo $_GET['no_sj6'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim6'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<?php if($rt6>8){?>
<p><a href="cetak_surat_jalan_mkt.php?a6=32&no_sj=<?php echo $_GET['no_sj6'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim6'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<?php if($rt6>9){?>
<p><a href="cetak_surat_jalan_mkt.php?a6=36&no_sj=<?php echo $_GET['no_sj6'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim6'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<div class="pagebreak"></div>
<?php }?>
<!-- PAGE 6 END -->
<!-- PAGE 7 BEGIN -->
<?php
if($_GET['no_sj7']!=""){
if($_GET['tgl_kirim7']!=""){$tglbuat7=" and tgl_update='$_GET[tgl_kirim7]' ";}else{$tglbuat2=" and DATE_FORMAT(tgl_update,'%y')=DATE_FORMAT(NOW(),'%y')";}
$sqllist7= mysql_query("SELECT packing_list.*,tbl_kite.pelanggan,tbl_kite.no_po as nopo,detail_pergerakan_stok.satuan,detail_pergerakan_stok.sisa from packing_list 
LEFT JOIN detail_pergerakan_stok ON packing_list.listno=detail_pergerakan_stok.refno
LEFT JOIN tmp_detail_kite ON detail_pergerakan_stok.id_detail_kj=tmp_detail_kite.id
LEFT JOIN tbl_kite ON tmp_detail_kite.id_kite=tbl_kite.id
WHERE  `packing_list`.`no_sj`='$_GET[no_sj7]' ".$tglbuat7."  
GROUP BY `packing_list`.`no_sj`
"); 
	
     $dr7=mysql_fetch_array($sqllist7);
	 $order7=trim($dr7['no_order']);
	$sqlb7=mssql_query("SELECT 
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
where  JobOrders.documentno = '$order7' and not Description='' 
) AS EMP
WHERE Row = 1");
$rbuyer7=mssql_fetch_array($sqlb7);
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
    <strong>PO : <font align="center" size="+1.5"><?php echo $dr7['no_po']; ?></font></strong></td>
    <td width="26%" valign="top">
    <strong> <font size="+2"><center>NO.: <?php echo $dr7['no_sj']; if($_GET['a7']=='4'){echo "(B)";}else if($_GET['a7']=='8'){echo "(C)";}else if($_GET['a7']=='12'){echo "(D)";}else if($_GET['a7']=='16'){echo "(E)";}else if($_GET['a7']=='20'){echo "(F)";}else if($_GET['a7']=='24'){echo "(G)";}else if($_GET['a7']=='28'){echo "(H)";}else if($_GET['a7']=='32'){echo "(I)";}else if($_GET['a7']=='36'){echo "(J)";}?></center>
    </font>
    <font align="left" ><strong>Tanggal: <?php  echo date("d-F-Y", strtotime($dr7['tgl_buat']));?></strong></font>
    
    <br /><strong>No. Order:</strong>
    <font align="center" size="+1"></font><font align="left" size="+1"><strong><?php echo $dr7['no_order'];?></strong></font>
    </strong></td>
    <td width="49%" valign="top"><strong>Kepada Yth.<br /> <?php 
	$sql=mssql_query("select * from partners where id='$rbuyer7[id]'"); 
	$data=mssql_fetch_array($sql);
	$name = $dr7['pelanggan'];
$nama1=strpos($name, "/");
$nama2=trim(substr($name,0,$nama1));
$nama3=trim(substr($name,$nama1,100));
echo $nama2;
//echo $data['PartnerName']; ?><?php
$sql2=mssql_query("select * from partners where partnername like '$nama2%'");
$data2=mssql_fetch_array($sql2);
$sqlalamat=mysql_query("SELECT alamat1 FROM packing_list WHERE no_sj='$dr7[no_sj]' and tgl_update='$dr7[tgl_update]'  LIMIT 1");
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
	  <?php if($dr7['sisa']=="FOC"){echo $dr7['sisa'];} ?>
	</strong></font></td>
    <td width="12%" rowspan="2"><div align="center"><strong>Lot</strong></div></td>
  </tr>
  <tr>
    <td width="4%"><div align="center"><strong>ROLL</strong></div></td>
    <td width="4%"><div align="center"><strong>KG</strong></div></td>
    <td width="5%"><div align="center"><strong><?php if($dr7['satuan']=='Yard'){echo "YARD";}else{echo "METER";}?></strong></div></td>
  </tr>
   <?php
	if($_GET['no_sj7']!='')
	{ 
	$sqlr7= "SELECT *,count(detail_pergerakan_stok.no_roll) as roll,sum(detail_pergerakan_stok.weight) as _berat,sum(detail_pergerakan_stok.yard_) as _yard_ ,detail_pergerakan_stok.sisa from packing_list 
LEFT JOIN detail_pergerakan_stok ON packing_list.listno=detail_pergerakan_stok.refno
LEFT JOIN tmp_detail_kite ON detail_pergerakan_stok.id_detail_kj=tmp_detail_kite.id
LEFT JOIN tbl_kite ON tmp_detail_kite.id_kite=tbl_kite.id
WHERE  `packing_list`.`no_sj`='$_GET[no_sj7]' ".$tglbuat7."
GROUP BY SUBSTR(detail_pergerakan_stok.nokk,1,11),tbl_kite.no_lot";
$data1=mysql_query($sqlr7);
$jrow1= mysql_num_rows($data1);
$rt7=ceil($jrow1/4);
$a7=0 + $_GET['a7'];
	
	$sql= "SELECT *,count(detail_pergerakan_stok.no_roll) as roll,sum(detail_pergerakan_stok.weight) as _berat,sum(detail_pergerakan_stok.yard_) as _yard_ ,detail_pergerakan_stok.sisa from packing_list 
LEFT JOIN detail_pergerakan_stok ON packing_list.listno=detail_pergerakan_stok.refno
LEFT JOIN tmp_detail_kite ON detail_pergerakan_stok.id_detail_kj=tmp_detail_kite.id
LEFT JOIN tbl_kite ON tmp_detail_kite.id_kite=tbl_kite.id
WHERE  `packing_list`.`no_sj`='$_GET[no_sj7]' ".$tglbuat7."
GROUP BY SUBSTR(detail_pergerakan_stok.nokk,1,11),tbl_kite.no_lot LIMIT $a7,4"; 
	}
		$data=mysql_query($sql);
		$jrow7= mysql_num_rows($data);
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

		 $sqlPR=mysql_query("SELECT * FROM tbl_pengiriman WHERE tgl_kirim='$_GET[tgl_kirim7]' AND no_sj='$_GET[no_sj7]' AND no_item='$rowd[no_item]' AND no_po='$rowd[no_po]' AND warna='$rowd[warna]'");
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
  
  <?php  $totrol7=$totrol7 + $rowd['roll'];
  		 $totbrt7=$totbrt7 + $rowd['_berat'];
		 $totyrd7=$totyrd7+ $rowd['_yard_']; } ?>
  <?php if($jrow7==3){$list7=1;} if($jrow7==2){$list7=2;} if($jrow7==1){$list7=3;}
  for($i7=0;$i7<$list7;$i7++){?>
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
    <td><div align="center"><strong><font size="+1"><?php echo $totrol7;?></font></strong></div></td>
    <td><div align="right"><strong><font size="+1"><?php echo number_format($totbrt7,'2','.',',');?></font></strong></div></td>
    <td><div align="right"><strong><font size="+1"><?php echo number_format($totyrd7,'2','.',',');?></font></strong></div></td>
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
<?php if($rt7>1){?>
<p><a href="cetak_surat_jalan_mkt.php?a7=4&no_sj=<?php echo $_GET['no_sj7'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim7'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<?php if($rt7>2){?>
<p><a href="cetak_surat_jalan_mkt.php?a7=8&no_sj=<?php echo $_GET['no_sj7'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim7'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<?php if($rt7>3){?>
<p><a href="cetak_surat_jalan_mkt.php?a7=12&no_sj=<?php echo $_GET['no_sj7'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim7'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<?php if($rt7>4){?>
<p><a href="cetak_surat_jalan_mkt.php?a7=16&no_sj=<?php echo $_GET['no_sj7'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim7'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<?php if($rt7>5){?>
<p><a href="cetak_surat_jalan_mkt.php?a7=20&no_sj=<?php echo $_GET['no_sj7'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim7'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<?php if($rt7>6){?>
<p><a href="cetak_surat_jalan_mkt.php?a7=24&no_sj=<?php echo $_GET['no_sj7'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim7'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<?php if($rt7>7){?>
<p><a href="cetak_surat_jalan_mkt.php?a7=28&no_sj=<?php echo $_GET['no_sj7'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim7'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<?php if($rt7>8){?>
<p><a href="cetak_surat_jalan_mkt.php?a7=32&no_sj=<?php echo $_GET['no_sj7'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim7'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<?php if($rt7>9){?>
<p><a href="cetak_surat_jalan_mkt.php?a7=36&no_sj=<?php echo $_GET['no_sj7'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim7'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<div class="pagebreak"></div>
<?php }?> 
<!-- PAGE 7 END -->
<!-- PAGE 8 BEGIN -->
<?php
if($_GET['no_sj8']!=""){
if($_GET['tgl_kirim8']!=""){$tglbuat8=" and tgl_update='$_GET[tgl_kirim8]' ";}else{$tglbuat8=" and DATE_FORMAT(tgl_update,'%y')=DATE_FORMAT(NOW(),'%y')";}
$sqllist8= mysql_query("SELECT packing_list.*,tbl_kite.pelanggan,tbl_kite.no_po as nopo,detail_pergerakan_stok.satuan,detail_pergerakan_stok.sisa from packing_list 
LEFT JOIN detail_pergerakan_stok ON packing_list.listno=detail_pergerakan_stok.refno
LEFT JOIN tmp_detail_kite ON detail_pergerakan_stok.id_detail_kj=tmp_detail_kite.id
LEFT JOIN tbl_kite ON tmp_detail_kite.id_kite=tbl_kite.id
WHERE  `packing_list`.`no_sj`='$_GET[no_sj8]' ".$tglbuat8."  
GROUP BY `packing_list`.`no_sj`
"); 
	
     $dr8=mysql_fetch_array($sqllist8);
	 $order8=trim($dr8['no_order']);
	$sqlb8=mssql_query("SELECT 
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
where  JobOrders.documentno = '$order8' and not Description='' 
) AS EMP
WHERE Row = 1");
$rbuyer8=mssql_fetch_array($sqlb8);
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
    <strong>PO : <font align="center" size="+1.5"><?php echo $dr8['no_po']; ?></font></strong></td>
    <td width="26%" valign="top">
    <strong> <font size="+2"><center>NO.: <?php echo $dr8['no_sj']; if($_GET['a8']=='4'){echo "(B)";}else if($_GET['a8']=='8'){echo "(C)";}else if($_GET['a8']=='12'){echo "(D)";}else if($_GET['a8']=='16'){echo "(E)";}else if($_GET['a8']=='20'){echo "(F)";}else if($_GET['a8']=='24'){echo "(G)";}else if($_GET['a8']=='28'){echo "(H)";}else if($_GET['a8']=='32'){echo "(I)";}else if($_GET['a8']=='36'){echo "(J)";}?></center>
    </font>
    <font align="left" ><strong>Tanggal: <?php  echo date("d-F-Y", strtotime($dr8['tgl_buat']));?></strong></font>
    
    <br /><strong>No. Order:</strong>
    <font align="center" size="+1"></font><font align="left" size="+1"><strong><?php echo $dr8['no_order'];?></strong></font>
    </strong></td>
    <td width="49%" valign="top"><strong>Kepada Yth.<br /> <?php 
	$sql=mssql_query("select * from partners where id='$rbuyer8[id]'"); 
	$data=mssql_fetch_array($sql);
	$name = $dr8['pelanggan'];
$nama1=strpos($name, "/");
$nama2=trim(substr($name,0,$nama1));
$nama3=trim(substr($name,$nama1,100));
echo $nama2;
//echo $data['PartnerName']; ?><?php
$sql2=mssql_query("select * from partners where partnername like '$nama2%'");
$data2=mssql_fetch_array($sql2);
$sqlalamat=mysql_query("SELECT alamat1 FROM packing_list WHERE no_sj='$dr8[no_sj]' and tgl_update='$dr8[tgl_update]'  LIMIT 1");
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
	  <?php if($dr8['sisa']=="FOC"){echo $dr3['sisa'];} ?>
	</strong></font></td>
    <td width="12%" rowspan="2"><div align="center"><strong>Lot</strong></div></td>
  </tr>
  <tr>
    <td width="4%"><div align="center"><strong>ROLL</strong></div></td>
    <td width="4%"><div align="center"><strong>KG</strong></div></td>
    <td width="5%"><div align="center"><strong><?php if($dr8['satuan']=='Yard'){echo "YARD";}else{echo "METER";}?></strong></div></td>
  </tr>
   <?php
	if($_GET['no_sj8']!='')
	{ 
	$sqlr= "SELECT *,count(detail_pergerakan_stok.no_roll) as roll,sum(detail_pergerakan_stok.weight) as _berat,sum(detail_pergerakan_stok.yard_) as _yard_ ,detail_pergerakan_stok.sisa from packing_list 
LEFT JOIN detail_pergerakan_stok ON packing_list.listno=detail_pergerakan_stok.refno
LEFT JOIN tmp_detail_kite ON detail_pergerakan_stok.id_detail_kj=tmp_detail_kite.id
LEFT JOIN tbl_kite ON tmp_detail_kite.id_kite=tbl_kite.id
WHERE  `packing_list`.`no_sj`='$_GET[no_sj8]' ".$tglbuat8."
GROUP BY SUBSTR(detail_pergerakan_stok.nokk,1,11),tbl_kite.no_lot";
$data1=mysql_query($sqlr);
$jrow1= mysql_num_rows($data1);
$rt8=ceil($jrow1/4);
$a8=0 + $_GET['a8'];
	
	$sql= "SELECT *,count(detail_pergerakan_stok.no_roll) as roll,sum(detail_pergerakan_stok.weight) as _berat,sum(detail_pergerakan_stok.yard_) as _yard_ ,detail_pergerakan_stok.sisa from packing_list 
LEFT JOIN detail_pergerakan_stok ON packing_list.listno=detail_pergerakan_stok.refno
LEFT JOIN tmp_detail_kite ON detail_pergerakan_stok.id_detail_kj=tmp_detail_kite.id
LEFT JOIN tbl_kite ON tmp_detail_kite.id_kite=tbl_kite.id
WHERE  `packing_list`.`no_sj`='$_GET[no_sj8]' ".$tglbuat8."
GROUP BY SUBSTR(detail_pergerakan_stok.nokk,1,11),tbl_kite.no_lot LIMIT $a8,4"; 
	}
		$data=mysql_query($sql);
		$jrow8= mysql_num_rows($data);
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

		 $sqlPR=mysql_query("SELECT * FROM tbl_pengiriman WHERE tgl_kirim='$_GET[tgl_kirim8]' AND no_sj='$_GET[no_sj8]' AND no_item='$rowd[no_item]' AND no_po='$rowd[no_po]' AND warna='$rowd[warna]'");
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
  
  <?php  $totrol8=$totrol8 + $rowd['roll'];
  		 $totbrt8=$totbrt8 + $rowd['_berat'];
		 $totyrd8=$totyrd8 + $rowd['_yard_']; } ?>
  <?php if($jrow8==3){$list8=1;} if($jrow8==2){$list8=2;} if($jrow8==1){$list8=3;}
  for($i8=0;$i8<$list8;$i8++){?>
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
    <td><div align="center"><strong><font size="+1"><?php echo $totrol8;?></font></strong></div></td>
    <td><div align="right"><strong><font size="+1"><?php echo number_format($totbrt8,'2','.',',');?></font></strong></div></td>
    <td><div align="right"><strong><font size="+1"><?php echo number_format($totyrd8,'2','.',',');?></font></strong></div></td>
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
<?php if($rt8>1){?>
<p><a href="cetak_surat_jalan_mkt.php?a8=4&no_sj=<?php echo $_GET['no_sj8'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim8'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<?php if($rt8>2){?>
<p><a href="cetak_surat_jalan_mkt.php?a8=8&no_sj=<?php echo $_GET['no_sj8'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim8'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<?php if($rt8>3){?>
<p><a href="cetak_surat_jalan_mkt.php?a8=12&no_sj=<?php echo $_GET['no_sj8'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim8'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<?php if($rt8>4){?>
<p><a href="cetak_surat_jalan_mkt.php?a8=16&no_sj=<?php echo $_GET['no_sj8'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim8'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<?php if($rt8>5){?>
<p><a href="cetak_surat_jalan_mkt.php?a8=20&no_sj=<?php echo $_GET['no_sj8'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim8'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<?php if($rt8>6){?>
<p><a href="cetak_surat_jalan_mkt.php?a8=24&no_sj=<?php echo $_GET['no_sj8'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim8'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<?php if($rt8>7){?>
<p><a href="cetak_surat_jalan_mkt.php?a8=28&no_sj=<?php echo $_GET['no_sj8'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim8'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<?php if($rt8>8){?>
<p><a href="cetak_surat_jalan_mkt.php?a8=32&no_sj=<?php echo $_GET['no_sj8'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim8'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<?php if($rt8>9){?>
<p><a href="cetak_surat_jalan_mkt.php?a8=36&no_sj=<?php echo $_GET['no_sj8'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim8'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<div class="pagebreak"></div>
<?php }?>   
<!-- PAGE 8 END -->
<!-- PAGE 9 BEGIN -->
<?php
if($_GET['no_sj9']!=""){
if($_GET['tgl_kirim9']!=""){$tglbuat9=" and tgl_update='$_GET[tgl_kirim9]' ";}else{$tglbuat9=" and DATE_FORMAT(tgl_update,'%y')=DATE_FORMAT(NOW(),'%y')";}
$sqllist9= mysql_query("SELECT packing_list.*,tbl_kite.pelanggan,tbl_kite.no_po as nopo,detail_pergerakan_stok.satuan,detail_pergerakan_stok.sisa from packing_list 
LEFT JOIN detail_pergerakan_stok ON packing_list.listno=detail_pergerakan_stok.refno
LEFT JOIN tmp_detail_kite ON detail_pergerakan_stok.id_detail_kj=tmp_detail_kite.id
LEFT JOIN tbl_kite ON tmp_detail_kite.id_kite=tbl_kite.id
WHERE  `packing_list`.`no_sj`='$_GET[no_sj9]' ".$tglbuat9."  
GROUP BY `packing_list`.`no_sj`
"); 
	
     $dr9=mysql_fetch_array($sqllist9);
	 $order9=trim($dr9['no_order']);
	$sqlb9=mssql_query("SELECT 
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
where  JobOrders.documentno = '$order9' and not Description='' 
) AS EMP
WHERE Row = 1");
$rbuyer9=mssql_fetch_array($sqlb9);
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
    <strong>PO : <font align="center" size="+1.5"><?php echo $dr9['no_po']; ?></font></strong></td>
    <td width="26%" valign="top">
    <strong> <font size="+2"><center>NO.: <?php echo $dr9['no_sj']; if($_GET['a9']=='4'){echo "(B)";}else if($_GET['a9']=='8'){echo "(C)";}else if($_GET['a9']=='12'){echo "(D)";}else if($_GET['a9']=='16'){echo "(E)";}else if($_GET['a9']=='20'){echo "(F)";}else if($_GET['a9']=='24'){echo "(G)";}else if($_GET['a9']=='28'){echo "(H)";}else if($_GET['a9']=='32'){echo "(I)";}else if($_GET['a9']=='36'){echo "(J)";}?></center>
    </font>
    <font align="left" ><strong>Tanggal: <?php  echo date("d-F-Y", strtotime($dr9['tgl_buat']));?></strong></font>
    
    <br /><strong>No. Order:</strong>
    <font align="center" size="+1"></font><font align="left" size="+1"><strong><?php echo $dr9['no_order'];?></strong></font>
    </strong></td>
    <td width="49%" valign="top"><strong>Kepada Yth.<br /> <?php 
	$sql=mssql_query("select * from partners where id='$rbuyer9[id]'"); 
	$data=mssql_fetch_array($sql);
	$name = $dr9['pelanggan'];
$nama1=strpos($name, "/");
$nama2=trim(substr($name,0,$nama1));
$nama3=trim(substr($name,$nama1,100));
echo $nama2;
//echo $data['PartnerName']; ?><?php
$sql2=mssql_query("select * from partners where partnername like '$nama2%'");
$data2=mssql_fetch_array($sql2);
$sqlalamat=mysql_query("SELECT alamat1 FROM packing_list WHERE no_sj='$dr9[no_sj]' and tgl_update='$dr9[tgl_update]'  LIMIT 1");
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
	  <?php if($dr9['sisa']=="FOC"){echo $dr9['sisa'];} ?>
	</strong></font></td>
    <td width="12%" rowspan="2"><div align="center"><strong>Lot</strong></div></td>
  </tr>
  <tr>
    <td width="4%"><div align="center"><strong>ROLL</strong></div></td>
    <td width="4%"><div align="center"><strong>KG</strong></div></td>
    <td width="5%"><div align="center"><strong><?php if($dr9['satuan']=='Yard'){echo "YARD";}else{echo "METER";}?></strong></div></td>
  </tr>
   <?php
	if($_GET['no_sj9']!='')
	{ 
	$sqlr= "SELECT *,count(detail_pergerakan_stok.no_roll) as roll,sum(detail_pergerakan_stok.weight) as _berat,sum(detail_pergerakan_stok.yard_) as _yard_ ,detail_pergerakan_stok.sisa from packing_list 
LEFT JOIN detail_pergerakan_stok ON packing_list.listno=detail_pergerakan_stok.refno
LEFT JOIN tmp_detail_kite ON detail_pergerakan_stok.id_detail_kj=tmp_detail_kite.id
LEFT JOIN tbl_kite ON tmp_detail_kite.id_kite=tbl_kite.id
WHERE  `packing_list`.`no_sj`='$_GET[no_sj9]' ".$tglbuat9."
GROUP BY SUBSTR(detail_pergerakan_stok.nokk,1,11),tbl_kite.no_lot";
$data1=mysql_query($sqlr);
$jrow1= mysql_num_rows($data1);
$rt9=ceil($jrow1/4);
$a9=0 + $_GET['a9'];
	
	$sql= "SELECT *,count(detail_pergerakan_stok.no_roll) as roll,sum(detail_pergerakan_stok.weight) as _berat,sum(detail_pergerakan_stok.yard_) as _yard_ ,detail_pergerakan_stok.sisa from packing_list 
LEFT JOIN detail_pergerakan_stok ON packing_list.listno=detail_pergerakan_stok.refno
LEFT JOIN tmp_detail_kite ON detail_pergerakan_stok.id_detail_kj=tmp_detail_kite.id
LEFT JOIN tbl_kite ON tmp_detail_kite.id_kite=tbl_kite.id
WHERE  `packing_list`.`no_sj`='$_GET[no_sj9]' ".$tglbuat9."
GROUP BY SUBSTR(detail_pergerakan_stok.nokk,1,11),tbl_kite.no_lot LIMIT $a9,4"; 
	}
		$data=mysql_query($sql);
		$jrow9= mysql_num_rows($data);
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

		 $sqlPR=mysql_query("SELECT * FROM tbl_pengiriman WHERE tgl_kirim='$_GET[tgl_kirim9]' AND no_sj='$_GET[no_sj9]' AND no_item='$rowd[no_item]' AND no_po='$rowd[no_po]' AND warna='$rowd[warna]'");
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
  
  <?php  $totrol9=$totrol9 + $rowd['roll'];
  		 $totbrt9=$totbrt9 + $rowd['_berat'];
		 $totyrd9=$totyrd9 + $rowd['_yard_']; } ?>
  <?php if($jrow9==3){$list9=1;} if($jrow9==2){$list9=2;} if($jrow9==1){$list9=3;}
  for($i9=0;$i9<$list9;$i9++){?>
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
    <td><div align="center"><strong><font size="+1"><?php echo $totrol9;?></font></strong></div></td>
    <td><div align="right"><strong><font size="+1"><?php echo number_format($totbrt9,'2','.',',');?></font></strong></div></td>
    <td><div align="right"><strong><font size="+1"><?php echo number_format($totyrd9,'2','.',',');?></font></strong></div></td>
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
<?php if($rt9>1){?>
<p><a href="cetak_surat_jalan_mkt.php?a9=4&no_sj=<?php echo $_GET['no_sj9'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim9'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<?php if($rt9>2){?>
<p><a href="cetak_surat_jalan_mkt.php?a9=8&no_sj=<?php echo $_GET['no_sj9'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim9'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<?php if($rt9>3){?>
<p><a href="cetak_surat_jalan_mkt.php?a9=12&no_sj=<?php echo $_GET['no_sj9'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim9'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<?php if($rt9>4){?>
<p><a href="cetak_surat_jalan_mkt.php?a9=16&no_sj=<?php echo $_GET['no_sj9'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim9'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<?php if($rt9>5){?>
<p><a href="cetak_surat_jalan_mkt.php?a9=20&no_sj=<?php echo $_GET['no_sj9'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim9'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<?php if($rt9>6){?>
<p><a href="cetak_surat_jalan_mkt.php?a9=24&no_sj=<?php echo $_GET['no_sj9'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim9'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<?php if($rt9>7){?>
<p><a href="cetak_surat_jalan_mkt.php?a9=28&no_sj=<?php echo $_GET['no_sj9'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim9'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<?php if($rt9>8){?>
<p><a href="cetak_surat_jalan_mkt.php?a9=32&no_sj=<?php echo $_GET['no_sj9'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim9'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<?php if($rt9>9){?>
<p><a href="cetak_surat_jalan_mkt.php?a9=36&no_sj=<?php echo $_GET['no_sj9'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim9'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<div class="pagebreak"></div>
<?php }?>  
<!-- PAGE 9 END -->
<!-- PAGE 10 BEGIN -->
<?php
if($_GET['no_sj10']!=""){
if($_GET['tgl_kirim10']!=""){$tglbuat10=" and tgl_update='$_GET[tgl_kirim10]' ";}else{$tglbuat10=" and DATE_FORMAT(tgl_update,'%y')=DATE_FORMAT(NOW(),'%y')";}
$sqllist10= mysql_query("SELECT packing_list.*,tbl_kite.pelanggan,tbl_kite.no_po as nopo,detail_pergerakan_stok.satuan,detail_pergerakan_stok.sisa from packing_list 
LEFT JOIN detail_pergerakan_stok ON packing_list.listno=detail_pergerakan_stok.refno
LEFT JOIN tmp_detail_kite ON detail_pergerakan_stok.id_detail_kj=tmp_detail_kite.id
LEFT JOIN tbl_kite ON tmp_detail_kite.id_kite=tbl_kite.id
WHERE  `packing_list`.`no_sj`='$_GET[no_sj10]' ".$tglbuat10."  
GROUP BY `packing_list`.`no_sj`
"); 
	
     $dr10=mysql_fetch_array($sqllist10);
	 $order10=trim($dr10['no_order']);
	$sqlb10=mssql_query("SELECT 
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
where  JobOrders.documentno = '$order10' and not Description='' 
) AS EMP
WHERE Row = 1");
$rbuyer10=mssql_fetch_array($sqlb10);
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
    <strong>PO : <font align="center" size="+1.5"><?php echo $dr10['no_po']; ?></font></strong></td>
    <td width="26%" valign="top">
    <strong> <font size="+2"><center>NO.: <?php echo $dr10['no_sj']; if($_GET['a10']=='4'){echo "(B)";}else if($_GET['a10']=='8'){echo "(C)";}else if($_GET['a10']=='12'){echo "(D)";}else if($_GET['a10']=='16'){echo "(E)";}else if($_GET['a10']=='20'){echo "(F)";}else if($_GET['a10']=='24'){echo "(G)";}else if($_GET['a10']=='28'){echo "(H)";}else if($_GET['a10']=='32'){echo "(I)";}else if($_GET['a10']=='36'){echo "(J)";}?></center>
    </font>
    <font align="left" ><strong>Tanggal: <?php  echo date("d-F-Y", strtotime($dr10['tgl_buat']));?></strong></font>
    
    <br /><strong>No. Order:</strong>
    <font align="center" size="+1"></font><font align="left" size="+1"><strong><?php echo $dr10['no_order'];?></strong></font>
    </strong></td>
    <td width="49%" valign="top"><strong>Kepada Yth.<br /> <?php 
	$sql=mssql_query("select * from partners where id='$rbuyer10[id]'"); 
	$data=mssql_fetch_array($sql);
	$name = $dr10['pelanggan'];
$nama1=strpos($name, "/");
$nama2=trim(substr($name,0,$nama1));
$nama3=trim(substr($name,$nama1,100));
echo $nama2;
//echo $data['PartnerName']; ?><?php
$sql2=mssql_query("select * from partners where partnername like '$nama2%'");
$data2=mssql_fetch_array($sql2);
$sqlalamat=mysql_query("SELECT alamat1 FROM packing_list WHERE no_sj='$dr10[no_sj]' and tgl_update='$dr10[tgl_update]'  LIMIT 1");
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
	  <?php if($dr10['sisa']=="FOC"){echo $dr10['sisa'];} ?>
	</strong></font></td>
    <td width="12%" rowspan="2"><div align="center"><strong>Lot</strong></div></td>
  </tr>
  <tr>
    <td width="4%"><div align="center"><strong>ROLL</strong></div></td>
    <td width="4%"><div align="center"><strong>KG</strong></div></td>
    <td width="5%"><div align="center"><strong><?php if($dr10['satuan']=='Yard'){echo "YARD";}else{echo "METER";}?></strong></div></td>
  </tr>
   <?php
	if($_GET['no_sj10']!='')
	{ 
	$sqlr= "SELECT *,count(detail_pergerakan_stok.no_roll) as roll,sum(detail_pergerakan_stok.weight) as _berat,sum(detail_pergerakan_stok.yard_) as _yard_ ,detail_pergerakan_stok.sisa from packing_list 
LEFT JOIN detail_pergerakan_stok ON packing_list.listno=detail_pergerakan_stok.refno
LEFT JOIN tmp_detail_kite ON detail_pergerakan_stok.id_detail_kj=tmp_detail_kite.id
LEFT JOIN tbl_kite ON tmp_detail_kite.id_kite=tbl_kite.id
WHERE  `packing_list`.`no_sj`='$_GET[no_sj10]' ".$tglbuat10."
GROUP BY SUBSTR(detail_pergerakan_stok.nokk,1,11),tbl_kite.no_lot";
$data1=mysql_query($sqlr);
$jrow1= mysql_num_rows($data1);
$rt10=ceil($jrow1/4);
$a10=0 + $_GET['a10'];
	
	$sql= "SELECT *,count(detail_pergerakan_stok.no_roll) as roll,sum(detail_pergerakan_stok.weight) as _berat,sum(detail_pergerakan_stok.yard_) as _yard_ ,detail_pergerakan_stok.sisa from packing_list 
LEFT JOIN detail_pergerakan_stok ON packing_list.listno=detail_pergerakan_stok.refno
LEFT JOIN tmp_detail_kite ON detail_pergerakan_stok.id_detail_kj=tmp_detail_kite.id
LEFT JOIN tbl_kite ON tmp_detail_kite.id_kite=tbl_kite.id
WHERE  `packing_list`.`no_sj`='$_GET[no_sj10]' ".$tglbuat10."
GROUP BY SUBSTR(detail_pergerakan_stok.nokk,1,11),tbl_kite.no_lot LIMIT $a10,4"; 
	}
		$data=mysql_query($sql);
		$jrow10= mysql_num_rows($data);
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

		 $sqlPR=mysql_query("SELECT * FROM tbl_pengiriman WHERE tgl_kirim='$_GET[tgl_kirim10]' AND no_sj='$_GET[no_sj10]' AND no_item='$rowd[no_item]' AND no_po='$rowd[no_po]' AND warna='$rowd[warna]'");
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
  
  <?php  $totrol10=$totrol10 + $rowd['roll'];
  		 $totbrt10=$totbrt10 + $rowd['_berat'];
		 $totyrd10=$totyrd10 + $rowd['_yard_']; } ?>
  <?php if($jrow10==3){$list10=1;} if($jrow10==2){$list10=2;} if($jrow10==1){$list10=3;}
  for($i10=0;$i10<$list10;$i10++){?>
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
    <td><div align="center"><strong><font size="+1"><?php echo $totrol10;?></font></strong></div></td>
    <td><div align="right"><strong><font size="+1"><?php echo number_format($totbrt10,'2','.',',');?></font></strong></div></td>
    <td><div align="right"><strong><font size="+1"><?php echo number_format($totyrd10,'2','.',',');?></font></strong></div></td>
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
<?php if($rt10>1){?>
<p><a href="cetak_surat_jalan_mkt.php?a10=4&no_sj=<?php echo $_GET['no_sj10'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim10'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<?php if($rt10>2){?>
<p><a href="cetak_surat_jalan_mkt.php?a10=8&no_sj=<?php echo $_GET['no_sj10'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim10'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<?php if($rt10>3){?>
<p><a href="cetak_surat_jalan_mkt.php?a10=12&no_sj=<?php echo $_GET['no_sj10'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim10'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<?php if($rt10>4){?>
<p><a href="cetak_surat_jalan_mkt.php?a10=16&no_sj=<?php echo $_GET['no_sj10'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim10'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<?php if($rt10>5){?>
<p><a href="cetak_surat_jalan_mkt.php?a10=20&no_sj=<?php echo $_GET['no_sj10'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim10'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<?php if($rt10>6){?>
<p><a href="cetak_surat_jalan_mkt.php?a10=24&no_sj=<?php echo $_GET['no_sj10'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim10'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<?php if($rt10>7){?>
<p><a href="cetak_surat_jalan_mkt.php?a10=28&no_sj=<?php echo $_GET['no_sj10'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim10'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<?php if($rt10>8){?>
<p><a href="cetak_surat_jalan_mkt.php?a10=32&no_sj=<?php echo $_GET['no_sj10'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim10'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<?php if($rt10>9){?>
<p><a href="cetak_surat_jalan_mkt.php?a10=36&no_sj=<?php echo $_GET['no_sj10'];?>&tgl_kirim=<?php echo $_GET['tgl_kirim10'];?>" target="_blank"><img src="btn_print.png" width="20" height="22" id="nocetak" /></a></p>
<?php }?>
<div class="pagebreak"></div>
<?php }?>    
<!-- PAGE 10 END -->
</body>
</html>
<script>

</script> 