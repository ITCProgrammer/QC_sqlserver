<?php
ini_set("error_reporting",1);
include("../koneksi.php");

if ($_POST['awal'] == "" and $_POST['akhir'] == "" and $_POST['shift'] == "" and $_POST['order'] == "") : ?>
<?php echo "SILAHKAN ISI DATA "; ?>
<button onclick="goBack()">Go Back</button>
<script>
function goBack() {
  window.history.back();
}
</script>
<?php else : ?>
<?php 
  date_default_timezone_set('Asia/Jakarta');

  $ip_address   = $_SERVER['REMOTE_ADDR'];
  $date         = date('Y-m-d H:i:s');
  $range_date   = $_POST['awal'].' s/d '.$_POST['akhir'];

  mysqli_query($con,"INSERT INTO log_laporan (ip_address, `date`, range_date) VALUES('$ip_address','$date', '$range_date')");
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
.blink { -webkit-animation: blink .75s linear infinite; -moz-animation: blink .75s linear infinite; -ms-animation: blink .75s linear infinite; -o-animation: blink .75s linear infinite; animation: blink .75s linear infinite; } @-webkit-keyframes blink { 0% { opacity: 1; } 50% { opacity: 1; } 50.01% { opacity: 0; } 100% { opacity: 0; } } @-moz-keyframes blink { 0% { opacity: 1; } 50% { opacity: 1; } 50.01% { opacity: 0; } 100% { opacity: 0; } } @-ms-keyframes blink { 0% { opacity: 1; } 50% { opacity: 1; } 50.01% { opacity: 0; } 100% { opacity: 0; } } @-o-keyframes blink { 0% { opacity: 1; } 50% { opacity: 1; } 50.01% { opacity: 0; } 100% { opacity: 0; } } @keyframes blink { 0% { opacity: 1; } 50% { opacity: 1; } 50.01% { opacity: 0; } 100% { opacity: 0; } }
-->
</style>
<script language="javascript">
var win = null;
function NewWindow(mypage,myname,w,h,scroll){
LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
TopPosition = (screen.height) ? (screen.height-h)/2 : 0;
settings =
'height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',resizable'
win = window.open(mypage,myname,settings)
}
</script>
<link rel="icon" type="image/png" href="../images/icon.png">
<link rel="stylesheet" type="text/css" href="../css/datatable.css" />
<link rel="stylesheet" type="text/css" href="../css/jquery-ui.css" />
<script src="../js/jquery.js" type="text/javascript"></script>
<script src="../js/jquery.dataTables.js" type="text/javascript"></script>
<script>
	$(document).ready(function(){
		$('#datatables').dataTable({
			"sScrollY": "400px",
			"sScrollX": "100%",
			"bScrollCollapse": true,
			"bPaginate": false,
			"bJQueryUI": true
		});
	})
</script>
<style>
th,td{
	border-top: 1px solid;
	border-bottom: 1px solid;
	border-left: 1px solid;
	border-right: 1px solid;
	}
</style>
</head>
<body>
    <div id="art-main">
      <div class=""></div>
            <div class=""></div>
            <input type="button" class="art-button" onClick="window.location.href='../index_login.php?act=logout'" value="Logout"/>
                            <?php if($_SESSION['status']==0){ ?><input type="button" class="art-button" onClick="window.location.href='../index1.php'" value="Home"/><input type="button" class="art-button" onClick="window.location.href='../index1.php?p=laporan_harian_kain'" value="Laporan"/><br /><?php } ?>

  <form action="simpan_blok.php" method="post" name="form1"/> <div align="center"><font size="+3"><strong>LAPORAN HARIAN KAIN JADI <?php if($_POST['ganti_stiker']=="1"){echo "GANTI STIKER";}else if($_POST['ganti_stiker']=="2"){echo"POTONG SISA";}else if($_POST['ganti_stiker']=="3"){echo"BS";}else if($_POST['ganti_stiker']=="4"){echo"REVISI STIKER";} else if($_POST['ganti_stiker']=="5"){echo"INSPEK MEJA";}?></strong></font></div>
     <?php $tgl_cetak1=$_POST['awal']; $tgl_cetak2=$_POST['akhir']; if($_POST['shift']!=""){$shft=$_POST['shift'];}else{$shft="All";}?>
  <input name="tgl" type="hidden" value="<?php echo $tgl_cetak1;?>">
  <input name="tgl1" type="hidden" value="<?php echo $tgl_cetak2;?>">
      <div align="right"><a href="data_kain_jadi_excel.php?awal=<?php echo $_POST['awal'];?>&akhir=<?php echo $_POST['akhir'];?>&no_order=<?php echo $_POST['order'];?>&ganti_stiker=<?php echo $_POST['ganti_stiker'];?>&shft=<?php echo $shft; ?>&ckKite=<?php echo $_POST['ckKite'];?>"><font size="+2">Cetak Excel</font></a>||
      <a href="data_kain_jadi_detail_now_excel.php?awal=<?php echo $_POST['awal'];?>&akhir=<?php echo $_POST['akhir'];?>&no_order=<?php echo $_POST['order'];?>&ganti_stiker=<?php echo $_POST['ganti_stiker'];?>&shft=<?php echo $shft; ?>&ckKite=<?php echo $_POST['ckKite'];?>"><font size="+2">Cetak Detail NOW Excel</font></a></div>
      <strong>Shift :<?php echo $shft;?> Tgl :<?php echo $tgl_cetak1." s/d ".$tgl_cetak2; ?></strong>
      <table width="100%" class="display" id="datatables">
    <thead>
      <tr>
        <th rowspan="3"><strong>TGL</strong></th>
        <th rowspan="3"><strong>NO ITEM</strong></th>
        <th rowspan="3"><strong>LANGGANAN</strong></th>
        <th width="15" rowspan="3"><strong>PO</strong></th>
        <th width="15" rowspan="3"><strong>ORDER</strong></th>
        <th rowspan="3"><strong>JENIS_KAIN</strong></th>
        <th rowspan="3" ><strong>NO WARNA</strong></th>
        <th rowspan="3"><strong>WARNA</strong></th>
        <th rowspan="3"><strong>NO CARD</strong></th>
        <th rowspan="3"><strong>LOT</strong></th>
        <th rowspan="3"><strong>ROLL</strong></th>
        <th colspan="4"><strong>Netto (KG)</strong></th>
        <th rowspan="3"><strong>Yard / Meter</strong></th>
        <th rowspan="3"><strong>LOKASI</strong></th>
        <th rowspan="3"><strong>EXTRA Q</strong></th>
        <th rowspan="3"><strong>LBR</strong></th>
        <th rowspan="3"><strong>X</strong></th>
        <th rowspan="3"><strong>GRMS</strong></th>
        <th rowspan="3"><strong>OL</strong></th>
        <th rowspan="3"><strong>Keterangan</strong></th>
      </tr>
      <tr>
        <th colspan="3"><strong>Grade</strong></th>
        <th rowspan="2"><strong>Keterangan<br /></strong></th>
      </tr>
      <tr>
        <th>A</th>
        <th><strong>B</strong></th>
        <th><strong>C</strong></th>
      </tr>
    </thead>
    <tbody>
  <?php
    if($tgl_cetak1!="" and $tgl_cetak2!="")
  {$tgll=" AND a.tgl_update between '$tgl_cetak1' AND '$tgl_cetak2' ";}
  else if($tgl_cetak1="")
  {$tgll=" ";} else if($tgl_cetak2="")
  {$tgll=" ";}
  if($_POST['shift']!="")
  {$shift=" AND a.shift='".$_POST['shift']."' ";}else{$shift=" ";}
  if($_POST['order']!="")
  {$order=" AND c.no_order='".$_POST['order']."' ";}
   else if($tgl_cetak1="" and $_POST['order']="")
  {$tgll=" AND a.tgl_update='$tgl_cetak1' ";}
    if($_POST['ganti_stiker']=="1"){
	  $transfer=" AND ( a.fromtoid = 'GANTI STIKER') ";
	}else if($_POST['ganti_stiker']=="2"){
	  $transfer=" AND ( a.fromtoid = 'POTONG SISA') ";
	}else if($_POST['ganti_stiker']=="4"){
	  $transfer=" AND ( a.fromtoid = 'REVISI STIKER') ";
	}else if($_POST['ganti_stiker']=="5"){
	  $transfer=" AND ( a.fromtoid='INSPEK MEJA') ";	
	}else{$transfer=" AND (a.fromtoid = 'PACKING' OR a.fromtoid='LAIN') ";}
   if($_POST['ckKite']=="1"){$kite="AND (b.sisa='KITE' OR b.sisa='FKSI')";}else{$kite="";}
  $sql=mysqli_query($con,"SELECT
	a.id,b.id_stok,a.tgl_update,a.blok,a.ket,c.no_po,c.no_order,b.weight,b.yard_,b.no_roll,
	b.satuan,b.grade,b.sisa,b.nokk,c.jenis_kain,c.pelanggan,c.no_lot,c.no_warna,
	c.warna,c.lebar,c.berat,c.no_item,
  SUM(case when b.grade='A' or b.grade='B' or b.grade='C' or b.grade='' then b.weight else 0 end) as tot_qty,
  SUM(if(b.grade='A' or b.grade='B' or b.grade='C' or b.grade='', 1, 0)) as tot_rol,
  SUM(case when b.grade='A' or b.grade='B' or b.grade='C' or b.grade='' then b.yard_ else 0 end) as tot_yard,
	SUM(case when b.grade='A' or b.grade='B' or b.grade='' then b.weight else 0 end) as grd_ab,
	SUM(case when b.grade='A' or b.grade='' then b.weight else 0 end) as grd_a,
	SUM(case when b.grade='B' then b.weight else 0 end) as grd_b,
	SUM(case when b.grade='C' then b.weight else 0 end) as grd_c,
	SUM(if(b.grade='A' or b.grade='B' or b.grade='', 1, 0)) as jml_ab,
	SUM(if(b.grade = 'C', 1, 0)) as jml_grd_c,SUM(d.netto) as netto,
	GROUP_CONCAT(DISTINCT lokasi) as lokasi
	FROM
	detail_pergerakan_stok b
	LEFT JOIN  pergerakan_stok a ON a.id = b.id_stok
    LEFT JOIN tmp_detail_kite d ON d.id=b.id_detail_kj
	LEFT JOIN tbl_kite c ON c.id = d.id_kite
	WHERE
	(b.transtatus='1' or b.transtatus='0')
	$tgll $order $shift $transfer $kite
	GROUP BY
	a.id,b.nokk,b.sisa
	ORDER BY
	a.id");
  $c=1;
  $i=1;
  while($row=mysqli_fetch_array($sql))
  {
	   $bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99';
	   $mutasi=date("Ymd", strtotime($row['tgl_update']));
	  // $mySql =mysqli_query($con,"SELECT tempat FROM mutasi_kain WHERE nokk='".$row['nokk']."' and no_mutasi like '%$mutasi%' order by id asc");
	  $mySql=mysqli_query($con,"select mutasi_kain.tempat
from mutasi_kain
INNER JOIN pergerakan_stok on pergerakan_stok.no_mutasi=mutasi_kain.no_mutasi
INNER join detail_pergerakan_stok on pergerakan_stok.id=detail_pergerakan_stok.id_stok
where mutasi_kain.nokk='".$row['nokk']."' and mutasi_kain.keterangan='".$row['sisa']."'
GROUP BY mutasi_kain.id,mutasi_kain.keterangan");
	   $myBlk = mysqli_fetch_array($mySql);
	   $sqlPtg=mysqli_query($con,"SELECT
SUM(case when grade='C' then weight else 0 end) as grd_c,
SUM(case when grade='A' or grade='B' or grade='' then weight else 0 end) as grd_ab,
SUM(case when grade='A' or grade='' then weight else 0 end) as grd_a,
SUM(case when grade='B' then weight else 0 end) as grd_b,
SUM(yard_) as yard_
from detail_pergerakan_stok WHERE nokk='".$row['nokk']."' and transtatus='3' and id_ref='".$row['id']."' and sisa='".$row['sisa']."' ");
	   $dPtg=mysqli_fetch_array($sqlPtg);
	  $sqlPtgs=mysqli_query($con,"SELECT
SUM(case when grade='C' then weight else 0 end) as grd_c,
SUM(case when grade='A' or grade='B' or grade='' then weight else 0 end) as grd_ab,
SUM(case when grade='A' or grade='' then weight else 0 end) as grd_a,
SUM(case when grade='B' then weight else 0 end) as grd_b,
SUM(yard_) as yard_
from detail_pergerakan_stok WHERE nokk='".$row['nokk']."' and transtatus='3' and id_ref='".$row['id']."' and (sisa='SISA' or sisa='FKSI')");
	   $dPtgs=mysqli_fetch_array($sqlPtgs);
	  $sqlkrup=mysqli_query($con,"SELECT * FROM tbl_kite WHERE nokk='".$row['nokk']."'");
	  $rkrup=mysqli_fetch_array($sqlkrup);
	  ?>
    <tr>
      <td><a href="#" onClick="window.open('ubah-tgl-masuk-kain.php?no=<?php echo $row['id'];?>&tgl=<?php echo date("Y-m-d", strtotime($row['tgl_update']));?>','MyWindow','height=100,width=300');"><?php echo date("d-M-Y", strtotime($row['tgl_update']));?></a></td>
    <td><?php if($row['no_item']!=""){echo $row['no_item'];}else{echo $rkrup['no_item'];}?></td>
    <td><?php if($row['pelanggan']!=""){echo $row['pelanggan'];}else{echo $rkrup['pelanggan'];} ?></td>
    <td><?php if($row['no_po']!=""){echo $row['no_po'];}else{echo $rkrup['no_po'];}?></td>
    <td><?php if($row['no_order']!=""){echo $row['no_order'];}else{echo $rkrup['no_order'];}?></td>
    <td><?php if($row['jenis_kain']!=""){echo htmlentities($row['jenis_kain'],ENT_QUOTES);}else{echo htmlentities($rkrup['jenis_kain'],ENT_QUOTES);}?></td>
    <td><?php if($row['no_warna']!=""){echo $row['no_warna'];}else{echo $rkrup['no_warna'];}?></td>
    <td><?php if($row['warna']!=""){echo $row['warna'];}else{echo $rkrup['warna'];}?></td>
    <td><a href="#" onClick="window.open('detail-masuk-kain.php?nokk=<?php echo $row['nokk'];?>&ket=<?php echo $row['sisa'];?>&idstok=<?php echo $row['id_stok'];?>&uid=<?php echo $_SESSION['username']; ?>','MyWindow','height=400,width=500');"><?php echo $row['nokk'];?></a></td>
    <td><?php if($row['no_lot']!=""){echo $row['no_lot'];}else{echo $rkrup['no_lot'];}?></td>
    <td align="right"><?php
	$rol=$row['tot_rol'];
	echo $rol;
	?></td>
    <td align="right"><?php
	if($row['sisa']=="SISA" || $row['sisa']=="FKSI"){$gra=$row['grd_a']+$dPtgs['grd_a'];}else{
	$gra=$row['grd_a']+$dPtg['grd_a'];}echo number_format($gra,'2','.',',');?></td>
    <td align="right"><?php
	if($row['sisa']=="SISA" || $row['sisa']=="FKSI"){$grb=$row['grd_b']+$dPtgs['grd_b'];}else{
	$grb=$row['grd_b']+$dPtg['grd_b'];}echo number_format($grb,'2','.',',');?></td>
    <td align="right"><?php
	if($row['sisa']=="SISA" || $row['sisa']=="FKSI"){$grc=$row['grd_c']+$dPtgs['grd_c'];}else{
	$grc=$row['grd_c']+$dPtg['grd_c'];
	}echo number_format($grc,'2','.',',');?></td>
    <td><?php if($row['sisa']=="SISA" || $row['sisa']=="FKSI"){echo "SISA";}?></td>
    <td align="right"><?php
	if($row['satuan']=="PCS"){echo number_format($row['netto'])." ".$row['satuan'];}else{
	echo number_format($row['tot_yard']+$dPtg['yard_'],'2','.',',')." ".$row['satuan'];} ?></td>
    <td><a href="#"onClick="window.open('lokasi-persediaan.php?id=<?php echo $row['id_stok'];?>&nokk=<?php echo $row['nokk'];?>&ket=<?php echo $row['sisa'];?>','MyWindow','height=200,width=500,top=250,left=500');"><?php
	if($row['lokasi']!=""){echo $row['lokasi'];}else{echo "N/A";}?></a></td>
    <td><?php if($row['sisa']=="FOC"){echo "FOC";}?></td>
    <td><?php if($row['lebar']!=""){echo $row['lebar'];}else{echo $rkrup['lebar'];}?></td>
    <td>X</td>
    <td><?PHP if($row['berat']!=""){echo $row['berat'];}else{echo $rkrup['berat'];} ?></td>
    <td><?php if($row['sisa']=="KITE" || $row['sisa']=="FKSI"){echo "Fasilitas KITE";}?></td>
    <td align="center"><?php  echo $row['ket'];$i++; ?></td>
  </tr>

      <?php
	  	 if($row['sisa']=="SISA" || $row['sisa']=="FKSI" || $row['sisa']=="FOC"){$brtoo=0;}else{$brtoo=number_format($row['bruto'],'2','.',',');}
	   $totbruto=$totbruto+$brtoo;
	  $totyard=$totyard+$row['tot_yard'];
	  $totrol=$totrol+$rol;
	  $tota=$tota+$gra;
	  $totb=$totb+$grb;
	  $totc=$totc+$grc;
	  	if($row['satuan']=='Meter')
		{$kartot=$kartot + $row['tot_yard']; $totrolm = $totrolm + $row['tot_rol'];}
		if($row['satuan']=='Yard')
		{$pltot=$pltot + $row['tot_yard'];   $totroly = $totroly + $row['tot_rol'];}

	  }


  ?>
  </tbody>
  <tfoot>
 <tr bgcolor="#99FFFF">
   <td>&nbsp;</td>
   <td>&nbsp;</td>
   <td>&nbsp;</td>
   <td>&nbsp;</td>
   <td>&nbsp;</td>
   <td>&nbsp;</td>
   <td>&nbsp;</td>
   <td>&nbsp;</td>
   <td>&nbsp;</td>
   <td>Meter</td>
   <td align="right"><?php echo number_format($totrolm); ?></td>
   <td>&nbsp;</td>
   <td>&nbsp;</td>
   <td>&nbsp;</td>
   <td>Meter</td>
   <td align="right"><?php echo number_format($kartot,'2','.',','); ?></td>
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
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Yard</td>
    <td align="right"><?php echo  number_format($totroly);?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Yard</td>
    <td align="right"><?php echo  number_format($pltot,'2','.',',');?></td>
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
    <td><b>Total</b></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="right"><b><?php  echo $totrol;?></td>
    <td align="right"><b><?php echo number_format($tota,'2','.',',');?></b></td>
    <td align="right"><b><?php echo number_format($totb,'2','.',',');?></b></td>
    <td align="right"><b><?php echo number_format($totc,'2','.',',');?></b></td>
    <td>&nbsp;</td>
    <td align="right">&nbsp;</td>

    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  </tfoot>
</table>
</form>
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
<?php endif; ?>