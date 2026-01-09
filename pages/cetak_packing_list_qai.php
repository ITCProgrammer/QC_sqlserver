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
	padding:3px;
	font-size:12px;
	color:#333;
	width:98%;
	background-position:top;
	background-color:#fff;
}
.table-list {
	clear: both;
	text-align: left;
	border-collapse: collapse;
	margin: 0px 0px 10px 0px;
	background:#fff;	
}
.table-list td {
	color: #333;
	font-size:12px;
	border-color: #fff;
	border-collapse: collapse;
	vertical-align: center;
	padding: 3px 5px;
	border-bottom:1px #CCCCCC solid;
	border-left:1px #CCCCCC solid;
	border-right:1px #CCCCCC solid;

	
}
.table-list1 {
	clear: both;
	text-align: left;
	border-collapse: collapse;
	margin: 0px 0px 10px 0px;
	background:#fff;	
}
.table-list1 td {
	color: #333;
	font-size:12px;
	border-color: #fff;
	border-collapse: collapse;
	vertical-align: center;
	padding: 1px 2px;
	border-bottom:1px #000000 solid;
	border-top:1px #000000 solid;
	border-left:1px #000000 solid;
	border-right:1px #000000 solid;
	
	
}
.noborder{
	color: #333;
	font-size:12px;
	border-color: #FFF;
	border-collapse: collapse;
	vertical-align: center;
	padding: 3px 5px;
	
	}
#nocetak {
	display:none;
	}
-->
</style>
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
<?php
	include"../koneksi.php";
	function Indonesia2Tgl($tanggal){
	$namaBln = array("01" => "Januari", "02" => "Februari", "03" => "Maret", "04" => "April", "05" => "Mei", "06" => "Juni", 
					 "07" => "Juli", "08" => "Agustus", "09" => "September", "10" => "Oktober", "11" => "November", "12" => "Desember");
					 
	$tgl=substr($tanggal,8,2);
	$bln=substr($tanggal,5,2);
	$thn=substr($tanggal,0,4);
	$tanggal ="$tgl ".$namaBln[$bln]." $thn";
	return $tanggal;
}
	$qryt=mysql_query("SELECT  now() as tgl");
	$dtgl=mysql_fetch_array($qryt);
	$slq= mysql_query("SELECT
	*
FROM
	packing_list
LEFT JOIN detail_pergerakan_stok ON packing_list.listno = detail_pergerakan_stok.refno
LEFT JOIN tmp_detail_kite ON detail_pergerakan_stok.id_detail_kj = tmp_detail_kite.id
LEFT JOIN tbl_kite ON tbl_kite.id=tmp_detail_kite.id_kite
WHERE  `packing_list`.`listno`='$_GET[no_sj]'
GROUP BY SUBSTR(detail_pergerakan_stok.nokk,1,11)");
	$rslq=mysql_fetch_array($slq);
	?> 
    
     <link rel="icon" type="image/png" href="../images/icon.png">                  
       <title>Cetak PACKING LIST</title>
<table width="100%" border="0" class="noborder" style="width:7.8in ;height:12.7in" >
<tr style="height:0.1in;"><td valign="top"><center>
  <table width="100%" border="0" cellpadding="0"  class="noborder">
    <tr>
      <td width="8%">&nbsp;</td>
      <td width="77%" align="center">&nbsp;</td>
      <td width="7%" style="text-align:left;font-size:7px;">No. Form</td>
      <td width="8%" style="text-align:left;font-size:7px;">:17-08</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td style="text-align:left;font-size:7px;">No Revisi</td>
      <td style="text-align:left;font-size:7px;">: </td>
    </tr>
    <tr>
      <td><div style="text-align:left;font-size:7px;"><?php echo $_GET[no_sj];?></div></td>
      <td align="center">&nbsp;</td>
      <td style="text-align:left;font-size:7px;">Tgl Terbit</td>
      <td style="text-align:left;font-size:7px;">: </td>
    </tr>
  </table>
  <table width="100%" border="0" cellpadding="0"  class="noborder">
    <tr>
      <td width="8%"><img src="../images/logo.jpg" width="80" height="80" /></td>
      <td width="83%" align="center"><font size="5px"><strong>PT. INDO TAICHEN TEXTILE INDUSTRY</strong></font><br />
        <strong>KNITTING, DYEING, FINISHING, PRINTING, YARN DYE</strong><br />
        <font size="1px"><strong>OFFICE/FACTORY</strong> : JL. GATOT SUBROTO KM. 3 JL. KALISABI UWUNG JAYA, CIBODAS <br />
        KOTA TANGERANG BANTEN 15138. P.O.BOX 487 - BANTEN - INDONESIA<br />
        <strong>PHONE</strong> : ( 021 ) - 5520920(HUNTING), FAX : ( 021 ) - 5523763,55790329,5520035(ACC)<br />
E-MAIL: marketing@indotaichen.com Web-site: www.indotaichen.com</font></td>
      <td width="9%" style="text-align:right"><img src="../images/sgs-union-organik-p-hitam.jpg" width="140" height="100" /></td>
    </tr>
    </table><br />
  <u>PACKING LIST</u><br>
  No. : 
</center>
    <table width="100%" border="0" cellpadding="0"  class="noborder">
      <tr>
        <td width="58%">BUYER: <?php echo $rslq['pelanggan'];?></td>
        <td width="42%" style="text-align:right">Tangerang, <?php echo Indonesia2Tgl($rslq['tgl_buat_list']); // Indonesia2Tgl($dtgl['tgl']) //$dtgl['tgl'] ?></td>
      </tr>
      </table>
    </td></tr>
<tr><td valign="top" >

<!-- awal -->
<?php 
if($_GET['no_sj']!='')
	{ 
	$sql= "SELECT
	*,SUBSTR(detail_pergerakan_stok.nokk,1,11) as nokkh
FROM
	packing_list
LEFT JOIN detail_pergerakan_stok ON packing_list.listno = detail_pergerakan_stok.refno
LEFT JOIN tmp_detail_kite ON detail_pergerakan_stok.id_detail_kj = tmp_detail_kite.id
LEFT JOIN tbl_kite ON tbl_kite.id=tmp_detail_kite.id_kite
WHERE  `packing_list`.`listno`='$_GET[no_sj]'
GROUP BY SUBSTR(detail_pergerakan_stok.nokk,1,11),tbl_kite.no_lot"; 
	}
		$data=mysql_query($sql);
		$jrow= mysql_num_rows($data);
	$nb=1;
	$n=1;
	$c=0;
	 while($rowd=mysql_fetch_array($data)){ ?>
     <?php
	$po=str_replace("'","''",$rowd[no_po]);
	$nowarna=str_replace("'","''",$rowd[no_warna]);
		 
	$mySql =mysql_query("SELECT tempat,catatan FROM mutasi_kain WHERE nokk='$rowd[nokk]' AND keterangan='$rowd[sisa]' AND not tempat='' order by id desc");
	   $myBlk = mysql_fetch_array($mySql);
	$mySql1=mysql_query("SELECT
	a.blok,
	b.sisa,b.nokk
	FROM
	pergerakan_stok a
	INNER JOIN detail_pergerakan_stok b ON a.id = b.id_stok
  
	WHERE
	(a.typestatus = '1' OR a.typestatus = '2')
	AND not ISNULL(b.transtatus) AND (b.transtatus='1' OR b.transtatus='0') 
	AND b.nokk='$rowd[nokk]' and b.sisa='$rowd[sisa]'
	GROUP BY
	b.nokk,b.sisa
	ORDER BY
	a.tgl_update,a.id");
		$myBlk1 = mysql_fetch_array($mySql1); 
	$sqljns=mssql_query("SELECT 
*
 FROM
   
(SELECT ROW_NUMBER() 
        OVER (ORDER BY processcontrolJO.SODID DESC) AS Row, 
       description
    FROM 
Joborders 
left join processcontrolJO on processcontrolJO.joid = Joborders.id
left join salesorders on soid= salesorders.id
left join processcontrol on processcontrolJO.pcid = processcontrol.id
left join processcontrolbatches on processcontrolbatches.pcid = processcontrol.id
left join productmaster on productmaster.id= processcontrol.productid
left join productpartner on productpartner.productid= processcontrol.productid
where  productcode='$rowd[no_item]'
) AS EMP
WHERE Row = 2");
$rjns=mssql_fetch_array($sqljns);
	
	$sqla=mysql_query("SELECT count(no_lot)as roll,sum(detail_pergerakan_stok.weight) as berat,sum(detail_pergerakan_stok.yard_) as panjang,detail_pergerakan_stok.satuan FROM packing_list 
LEFT JOIN detail_pergerakan_stok ON detail_pergerakan_stok.refno = packing_list.listno
LEFT JOIN tmp_detail_kite ON tmp_detail_kite.id = detail_pergerakan_stok.id_detail_kj
LEFT JOIN tbl_kite ON tbl_kite.id = tmp_detail_kite.id_kite
WHERE tbl_kite.no_lot='$rowd[no_lot]' and tbl_kite.no_warna='$nowarna' and tbl_kite.no_po='$po' and SUBSTR(tbl_kite.nokk,1,11)='$rowd[nokkh]'
AND detail_pergerakan_stok.refno='$rowd[listno]'
GROUP BY detail_pergerakan_stok.satuan ");
 $jmldata=mysql_fetch_array($sqla);
	
$sqlb=mysql_query("SELECT * FROM packing_list 
LEFT JOIN detail_pergerakan_stok ON detail_pergerakan_stok.refno = packing_list.listno
LEFT JOIN tmp_detail_kite ON tmp_detail_kite.id = detail_pergerakan_stok.id_detail_kj
LEFT JOIN tbl_kite ON tbl_kite.id = tmp_detail_kite.id_kite
WHERE tbl_kite.no_lot='$rowd[no_lot]' and tbl_kite.no_warna='$nowarna' and tbl_kite.no_po='$po' and SUBSTR(tbl_kite.nokk,1,11)='$rowd[nokkh]'
AND detail_pergerakan_stok.refno='$rowd[listno]'
");

$jml=mysql_num_rows($sqlb);
$batas=ceil($jml/3);
$lawal=$batas*1-$batas;
$ltgh=$batas*2-$batas;
$lakhr=$batas*3-$batas;

//kolom 1
 $sql1=mysql_query("SELECT detail_pergerakan_stok.* FROM packing_list 
LEFT JOIN detail_pergerakan_stok ON detail_pergerakan_stok.refno = packing_list.listno
LEFT JOIN tmp_detail_kite ON tmp_detail_kite.id = detail_pergerakan_stok.id_detail_kj
LEFT JOIN tbl_kite ON tbl_kite.id = tmp_detail_kite.id_kite
WHERE tbl_kite.no_lot='$rowd[no_lot]' and tbl_kite.no_warna='$nowarna' and tbl_kite.no_po='$po' and SUBSTR(tbl_kite.nokk,1,11)='$rowd[nokkh]' 
AND detail_pergerakan_stok.refno='$rowd[listno]' 
order by detail_pergerakan_stok.no_roll,detail_pergerakan_stok.id asc LIMIT $lawal,$batas");

//kolom 2
 $sql2=mysql_query("SELECT detail_pergerakan_stok.* FROM packing_list 
LEFT JOIN detail_pergerakan_stok ON detail_pergerakan_stok.refno = packing_list.listno
LEFT JOIN tmp_detail_kite ON tmp_detail_kite.id = detail_pergerakan_stok.id_detail_kj
LEFT JOIN tbl_kite ON tbl_kite.id = tmp_detail_kite.id_kite
WHERE tbl_kite.no_lot='$rowd[no_lot]' and tbl_kite.no_warna='$nowarna' and tbl_kite.no_po='$po' and SUBSTR(tbl_kite.nokk,1,11)='$rowd[nokkh]'
AND detail_pergerakan_stok.refno='$rowd[listno]'
order by detail_pergerakan_stok.no_roll,detail_pergerakan_stok.id asc LIMIT $ltgh,$batas");
$row2=mysql_num_rows($sql2);
//kolom 3
 $sql3=mysql_query("SELECT detail_pergerakan_stok.* FROM packing_list 
LEFT JOIN detail_pergerakan_stok ON detail_pergerakan_stok.refno = packing_list.listno
LEFT JOIN tmp_detail_kite ON tmp_detail_kite.id = detail_pergerakan_stok.id_detail_kj
LEFT JOIN tbl_kite ON tbl_kite.id = tmp_detail_kite.id_kite
WHERE tbl_kite.no_lot='$rowd[no_lot]' and tbl_kite.no_warna='$nowarna' and tbl_kite.no_po='$po' and SUBSTR(tbl_kite.nokk,1,11)='$rowd[nokkh]'
AND detail_pergerakan_stok.refno='$rowd[listno]'
order by detail_pergerakan_stok.no_roll,detail_pergerakan_stok.id asc LIMIT $lakhr,$batas");
	if($rowd['no_item']!="")
	{$fbc=$rjns['description'];}
	else{$fbc=$rowd['jenis_kain'];}
	?>
    FABRIC : <?php echo $rowd['no_item']." ".$fbc."&nbsp; &nbsp; &nbsp; &nbsp;".number_format($rowd['lebar'],'2',',','.')."'' X ".number_format($rowd['berat'],'2',',','.')."''";?><br />
<table width="100%" border="0" align="center" class="table-list1">
  <tr>   
    <td colspan="7" valign="top">
    <table width="100%" border="0" class="noborder">
      <tr >
    <td width="92%">PO &nbsp; &nbsp; &nbsp; &nbsp;:
      <?php if($rowd['no_po']!=''){echo $rowd['no_po'];}?>
      <br />
COLOR :
<?php if($rowd['warna']!=''){echo $rowd['warna'];}?>
<br />
LOT  &nbsp; &nbsp; &nbsp;:
<?php if($rowd['no_lot']!=''){echo $rowd['no_lot'];}?></td>
    <td width="8%"><font size="+1"><?php 
	if($myBlk['tempat']!=""){echo $myBlk['tempat'];}else if($myBlk1['blok']!=""){echo $myBlk1['blok'];}else{echo "N/A";}?></font></td>
  </tr>
      </table>
      </td>
  </tr>
  <tr align="center"  class="tombol" >
    <td width="0" valign="top"><table width="100%" border="0">
      <tr align="center">
        <td width="15%" >Roll</td>
        <td>S/N</td>
        <td>Netto</td>
        <td><?php echo $rowd['satuan']; ?></td>
      </tr>
      <?php 
      while($row1=mysql_fetch_array($sql1))
  {
	  
	   
	  ?>
      <tr>
        <td align="center"><?php if($row1['no_roll']!=''){echo $row1['no_roll'];}else{echo $rsvr['rollno'];}?> <?php if($row1['sisa']=="FOC"){$foc=$row1['sisa'];}else{$foc="";}?></td>
        <td ><?php echo $row1['SN'];?> </td>
        <td align="right"><?php echo number_format($row1['weight'],'2','.',',');?></td>
        <td align="right"><?php echo  number_format($row1['yard_'],'2','.',','); ?></td>
      </tr>
       <?php
	  $totbruto=$totbruto+$row1['weight'];
	  $totyrd=$totyrd+$row1['yard_'];
	  $totroll=$totroll+1;
	  }  ?>
  </table></td>
    <td colspan="3" valign="top"><table width="100%" border="0">
      <tr align="center">
        <td width="15%">Roll</td>
        <td>S/N</td>
        <td>Netto</td>
        <td><?php echo $rowd['satuan']; ?></td>
      </tr>
      <?php 
      while($row2=mysql_fetch_array($sql2))
  {
	 
	  
	  
	  ?>
      <tr>
        <td align="center"><?php if($row2['no_roll']!=''){echo $row2['no_roll'];}?></td>
        <td ><?php echo $row2['SN'];?></td>
        <td align="right"><?php echo number_format($row2['weight'],'2','.',',');?></td>
        <td align="right"><?php echo  number_format($row2['yard_'],'2','.',','); ?></td>
      </tr>
      <?php
	  $totbruto=$totbruto+$row2['weight'];
	  $totyrd=$totyrd+$row2['yard_'];
	  $totroll=$totroll+1;
	  }  ?>
    </table></td>
    <td colspan="3" valign="top"><table width="100%" border="0">
      <tr align="center">
        <td width="15%">Roll</td>
        <td>S/N</td>
        <td>Netto</td>
        <td><?php echo $rowd['satuan']; ?></td>
      </tr>
      <?php 
      while($row3=mysql_fetch_array($sql3))
  {
	  
	  
	  
	  ?>
      <tr>
        <td align="center"><?php if($row3['no_roll']!=''){echo $row3['no_roll'];}else{echo $rsvr['rollno'];}?></td>
        <td><?php echo $row3['SN'];?></td>
        <td align="right"><?php echo number_format($row3['weight'],'2','.',',');?></td>
        <td align="right"><?php echo  number_format($row3['yard_'],'2','.',','); ?></td>
      </tr>
      <?php
	  $totbruto=$totbruto+$row3['weight'];
	  $totyrd=$totyrd+$row3['yard_'];
	  $totroll=$totroll+1;
	  }  ?>
    </table></td>
    </tr>
 
   
  <tr class='tombol'>
    <td colspan="4" align="right"><strong><?php echo $foc; ?> </strong> &nbsp;Total 
      <?php if($rowd['no_lot']!=''){echo $rowd['no_lot'];}?></td>
    <td  align="right"><strong><?php echo $jmldata['roll'];?> Roll</strong></td>
    <td  align="right"><strong><?php echo number_format($jmldata['berat'],'2','.',',');?> Kg</strong></td>
    <td  align="right"><strong><?php echo number_format($jmldata['panjang'],'2','.',',')." ".$jmldata['satuan'];?></strong></td>
    </tr>
  
</table>
<?php } ?>
<!-- akhir -->
<tr style="height:1in;"><td valign="bottom">

<table width="100%" border="0" cellpadding="0" class="table-list1">
  <tr style="text-align:center">
    <td><strong>Grand Total</strong></td>
    <td><strong>ROLL <?php echo $totroll;?></strong></td>
    <td>Weight<strong> <?php echo number_format($totbruto,'2','.',',');?></strong> <strong> Kg</strong></td>
    <td>Length: <strong><?php echo number_format($totyrd,'2','.',',');?></strong></td>
  </tr>
  <tr style="text-align:center">
    <td colspan="2">&nbsp;</td>
    <td>Dibuat Oleh</td>
    <td>Diterima Oleh</td>
  </tr>
  <tr>
    <td colspan="2">Nama</td>
    <td style="text-align:center">&nbsp;</td>
    <td style="text-align:center">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">Jabatan</td>
    <td style="text-align:center">PPC CLERK</td>
    <td style="text-align:center">B. GUDANG</td>
  </tr>
  <tr>
    <td colspan="2">Tanggal</td>
    <td style="text-align:center"><?php echo Indonesia2Tgl($rslq['tgl_buat_list']); //$dtgl['tgl']?></td>
    <td style="text-align:center"><?php echo Indonesia2Tgl($rslq['tgl_buat_list']);?></td>
  </tr>
  <tr style="height:0.4in;">
    <td colspan="2" valign="top">Tanda Terima</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</td></tr>
</td></tr></table>
<script>

</script> 