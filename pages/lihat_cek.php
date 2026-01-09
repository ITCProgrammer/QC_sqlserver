<?php
session_start();
include("../koneksi.php");
ini_set("error_reporting",1);
$sqlcka=mysqli_query($con,"select akses from user_login where user='".$_SESSION['username']."' and password='".$_SESSION['password']."' limit 1");
$rcka=mysqli_fetch_array($sqlcka);
$ckk=$rcka['akses'];
?>
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
.ukuran
{
	size:landscape;
	font-size:12px;
	
	}
.blink { -webkit-animation: blink .75s linear infinite; -moz-animation: blink .75s linear infinite; -ms-animation: blink .75s linear infinite; -o-animation: blink .75s linear infinite; animation: blink .75s linear infinite; } @-webkit-keyframes blink { 0% { opacity: 1; } 50% { opacity: 1; } 50.01% { opacity: 0; } 100% { opacity: 0; } } @-moz-keyframes blink { 0% { opacity: 1; } 50% { opacity: 1; } 50.01% { opacity: 0; } 100% { opacity: 0; } } @-ms-keyframes blink { 0% { opacity: 1; } 50% { opacity: 1; } 50.01% { opacity: 0; } 100% { opacity: 0; } } @-o-keyframes blink { 0% { opacity: 1; } 50% { opacity: 1; } 50.01% { opacity: 0; } 100% { opacity: 0; } } @keyframes blink { 0% { opacity: 1; } 50% { opacity: 1; } 50.01% { opacity: 0; } 100% { opacity: 0; } }
-->
</style>
<link rel="icon" type="image/png" href="../images/icon.png">
</head>
<body>
    <div id="art-main">
      <div class="art-Sheet-bl"></div>
            <div class="art-Sheet-br"></div>
            <input type="button" class="art-button" onClick="window.location.href='../index_login.php?act=logout'" value="Logout"/>
                            <?php if($_SESSION['status']==0){ ?><input type="button" class="art-button" onClick="window.location.href='../index1.php'" value="Home"/><input type="button" class="art-button" onClick="window.location.href='../index1.php?p=laporan_harian_kain'" value="Laporan"/><br /><?php } ?>
                       
                        
       <table width="100" align="center">
  <tr>
    <td colspan="31" align="center"><b>CEK LAPORAN HARIAN KAIN JADI PER MUTASI</b></td>
    </tr>
  <tr>
   <?php $tgl_cetak1=$_POST['awal'];?>
    
    <td colspan="31"><b>No Mutasi : <?php echo $_GET['mutasi'];?>   
      </b>
      <?php 
	$lth=mysqli_query($con,"select pergerakan_stok.tgl_update as tanggal_update ,pergerakan_stok.userid as user_packing ,mutasi_kain.no_mutasi 
from mutasi_kain
inner JOIN pergerakan_stok on pergerakan_stok.id=mutasi_kain.id_stok
where mutasi_kain.no_mutasi='".$_GET['mutasi']."'
GROUP BY no_mutasi");
	$rowlth=mysqli_fetch_array($lth);	
	?></td>
    </tr>
  <tr align="center" bgcolor="#0099FF" class="ukuran">
    <td rowspan="3">NO ITEM</td>
    <td rowspan="3">LANGGANAN</td>
    <td rowspan="3">PO</td>
    <td rowspan="3" width="15">ORDER</td>
    <td rowspan="3" width="15">JENIS KAIN</td>
    <td rowspan="3">NO WARNA</td>
    <td rowspan="3" >WARNA</td>
    <td rowspan="3">NO CARD</td>
    <td rowspan="3">LOT</td>
    <td rowspan="3">ROLL</td>
    <td colspan="4">QC</td>
    <td colspan="5">MASUK KAIN JADI</td>
    <td colspan="5">KELUAR KAIN JADI</td>
    <td rowspan="3">UNIT</td>
    <td rowspan="3">EXTRA Q</td>
    <td rowspan="3">LBR</td>
    <td rowspan="3">X</td>
    <td rowspan="3">GRMS</td>
    </tr>
  <tr align="center" bgcolor="#0099FF" class="ukuran">
    <td colspan="3">Grade</td>
    <td>&nbsp;</td>
    <td rowspan="2">ROLL</td>
    <td colspan="3">Grade</td>
    <td>&nbsp;</td>
    <td rowspan="2">ROLL</td>
    <td colspan="3">Grade</td>
    <td>&nbsp;</td>
  </tr>
  <tr align="center" bgcolor="#0099FF" class="ukuran">
    <td>      A</td>
    <td>B</td>
    <td>C</td>
    <td>Keterangan<br />(Grade C)</td>
    <td>A</td>
    <td>B</td>
    <td>C</td>
    <td>Keterangan<br />
      (Grade C</td>
    <td>      A</td>
    <td>B</td>
    <td>C</td>
    <td>Keterangan<br />
(Grade C</td>
    </tr>
  <?php 
  $usr=substr($rowlth['user_packing'],0,3);
 if($usr=="INS" or $usr=="ins"){$kt="AND detail_pergerakan_stok.ket='INSPEK'"; $ktc="INSPEK"; $usr1="INS";}elseif($usr=="KRA" or $usr=="kra"){$kt=""; $ktc="";$usr1="KRA";}else{$kt=""; $ktc="";$usr1="PAC";}
  if($usr=='INS'){$kt1="AND b.ket='INSPEK'"; }else{$kt1="";}
  $sql=mysqli_query($con,"select pergerakan_stok.id,bruto,satuan,
no_mc,pelanggan,tbl_kite.no_po,tbl_kite.no_order,DATE_FORMAT(tgl_update,'%Y-%m-%d') as tgl_update,
jenis_kain,no_warna,warna,no_item,no_lot,
lebar,berat,detail_pergerakan_stok.nokk,grade,
detail_pergerakan_stok.ket,count(yard_) as tot_rol,sum(yard_) as tot_yard ,
sum(weight) as tot_qty,
SUM(case when grade='A' or grade='B' or grade='' then weight else 0 end) as grd_ab,
SUM(case when grade='A' or grade='' then weight else 0 end) as grd_a,
SUM(case when grade='B' then weight else 0 end) as grd_b,
SUM(case when grade='C' then weight else 0 end) as grd_c,sisa
from pergerakan_stok 
inner join detail_pergerakan_stok on pergerakan_stok.id=detail_pergerakan_stok.id_stok 
inner join tbl_kite on tbl_kite.nokk=detail_pergerakan_stok.nokk
WHERE 
pergerakan_stok.no_mutasi='".$_GET['mutasi']."' and tbl_kite.user_packing like'%$usr1%' $kt
AND (fromtoid='GUDANG KAIN JADI' or fromtoid='GUDANG BS')
GROUP BY  pergerakan_stok.id, no_dok,sisa
ORDER BY pergerakan_stok.id ASC");
  $c=1;
  while($row=mysqli_fetch_array($sql))
  {
	   $bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99';
	  	  $sql1=mysqli_query($con,"SELECT sum(detail_pergerakan_stok.weight) as grd_c
FROM pergerakan_stok left join detail_pergerakan_stok on detail_pergerakan_stok.id_stok=pergerakan_stok.id
WHERE pergerakan_stok.id='".$row['id']."' and grade='C' and sisa='".$row['sisa']."'
GROUP BY pergerakan_stok.id
ORDER BY pergerakan_stok.id ASC");
		 $row1=mysqli_fetch_array($sql1);
		 
		 $sql2=mysqli_query($con,"SELECT sum(detail_pergerakan_stok.weight) as grd_a_b
FROM pergerakan_stok inner join detail_pergerakan_stok on detail_pergerakan_stok.id_stok=pergerakan_stok.id
WHERE pergerakan_stok.id='".$row['id']."' and ((grade between 'A' and 'B') or grade='') and sisa='".$row['sisa']."' GROUP BY pergerakan_stok.id
ORDER BY pergerakan_stok.id ASC");
$row2=mysqli_fetch_array($sql2);
$sql3=mysqli_query($con,"SELECT sum(detail_pergerakan_stok.weight) as sisa_c
FROM pergerakan_stok inner join detail_pergerakan_stok on detail_pergerakan_stok.id_stok=pergerakan_stok.id
WHERE pergerakan_stok.id='".$row['id']."' and grade='C' and (detail_pergerakan_stok.sisa='SISA' or detail_pergerakan_stok.sisa='FKSI') 
ORDER BY pergerakan_stok.id ASC");
	$row3=mysqli_fetch_array($sql3);
	$sql4=mysqli_query($con,"SELECT sum(detail_pergerakan_stok.weight) as sisa_ab
FROM pergerakan_stok inner join detail_pergerakan_stok on detail_pergerakan_stok.id_stok=pergerakan_stok.id
WHERE pergerakan_stok.id='".$row['id']."' and ((grade between 'A' and 'B') or grade='') and (detail_pergerakan_stok.sisa='SISA' or detail_pergerakan_stok.sisa='FKSI') 
ORDER BY pergerakan_stok.id ASC");
	$row4=mysqli_fetch_array($sql4);	
	
	$sql5=mysqli_query($con,"SELECT sum(detail_pergerakan_stok.weight) as sisa_c
FROM pergerakan_stok inner join detail_pergerakan_stok on detail_pergerakan_stok.id_stok=pergerakan_stok.id
WHERE pergerakan_stok.id='".$row['id']."' and grade='C' and (detail_pergerakan_stok.sisa='FOC' ) 
ORDER BY pergerakan_stok.id ASC");
	$row5=mysqli_fetch_array($sql5);
	$sql6=mysqli_query($con,"SELECT sum(detail_pergerakan_stok.weight) as sisa_ab
FROM pergerakan_stok inner join detail_pergerakan_stok on detail_pergerakan_stok.id_stok=pergerakan_stok.id
WHERE pergerakan_stok.id='".$row['id']."' and ((grade between 'A' and 'B') or grade='') and (detail_pergerakan_stok.sisa='FOC') 
ORDER BY pergerakan_stok.id ASC");
	$row6=mysqli_fetch_array($sql6);
	$stmpt=mysqli_query($con,"select mutasi_kain.id as id_kain,mutasi_kain.tempat  
from mutasi_kain 
INNER JOIN pergerakan_stok on pergerakan_stok.id=mutasi_kain.id_stok
where pergerakan_stok.id='".$row['id']."' and mutasi_kain.keterangan='".$row['sisa']."'
GROUP BY mutasi_kain.id,mutasi_kain.keterangan
ORDER BY pergerakan_stok.id ASC");
$rtmpt=mysqli_fetch_array($stmpt);
	$sqlket=mysqli_query($con,"select nokk,ket_c,sisa from detail_pergerakan_stok where nokk ='".$row['nokk']."' and ket_c !='' and sisa !='TH' and sisa !='FKTH' and grade='C'
GROUP BY ket_c");
$rowket=mysqli_fetch_array($sqlket);
// query masuk gudang
$sqlmskg=mysqli_query($con,"SELECT
	a.id,b.nokk,b.sisa,
  SUM(case when b.grade='A' or b.grade='B' or b.grade='C' or b.grade='' then b.weight else 0 end) as tot_qty,
  SUM(if(b.grade='A' or b.grade='B' or b.grade='C' or b.grade='', 1, 0)) as tot_rol,
  SUM(case when b.grade='A' or b.grade='B' or b.grade='C' or b.grade='' then b.yard_ else 0 end) as tot_yard,
	SUM(case when b.grade='A' or b.grade='B' or b.grade='' then b.weight else 0 end) as grd_ab,
	SUM(case when b.grade='A' or b.grade='' then b.weight else 0 end) as grd_a,
	SUM(case when b.grade='B' then b.weight else 0 end) as grd_b,
	SUM(case when b.grade='C' then b.weight else 0 end) as grd_c,
	SUM(if(b.grade='A' or b.grade='B' or b.grade='', 1, 0)) as jml_ab,
	SUM(if(b.grade = 'C', 1, 0)) as jml_grd_c,SUM(d.netto) as netto
	FROM
	detail_pergerakan_stok b
	LEFT JOIN  pergerakan_stok a ON a.id = b.id_stok
    LEFT JOIN tmp_detail_kite d ON d.id=b.id_detail_kj
	LEFT JOIN tbl_kite c ON c.id = d.id_kite
	WHERE
	b.nokk='".$row['nokk']."' and b.status='1' and b.sisa='".$row['sisa']."' and a.tgl_update='".$row['tgl_update']."'
	GROUP BY
	b.nokk,b.sisa,b.id_stok
	ORDER BY
	a.id ");
	$rmskg=mysqli_fetch_array($sqlmskg);
	// query keluar gudang
	$sqlklrg=mysqli_query($con,"SELECT
	a.id,b.nokk,b.sisa,b.id_stok,
  SUM(case when b.grade='A' or b.grade='B' or b.grade='C' or b.grade='' then b.weight else 0 end) as tot_qty,
  SUM(if(b.grade='A' or b.grade='B' or b.grade='C' or b.grade='', 1, 0)) as tot_rol,
  SUM(case when b.grade='A' or b.grade='B' or b.grade='C' or b.grade='' then b.yard_ else 0 end) as tot_yard,
	SUM(case when b.grade='A' or b.grade='B' or b.grade='' then b.weight else 0 end) as grd_ab,
	SUM(case when b.grade='A' or b.grade='' then b.weight else 0 end) as grd_a,
	SUM(case when b.grade='B' then b.weight else 0 end) as grd_b,
	SUM(case when b.grade='C' then b.weight else 0 end) as grd_c,
	SUM(if(b.grade='A' or b.grade='B' or b.grade='', 1, 0)) as jml_ab,
	SUM(if(b.grade = 'C', 1, 0)) as jml_grd_c,SUM(d.netto) as netto
	FROM
	detail_pergerakan_stok b
	LEFT JOIN  pergerakan_stok a ON a.id = b.id_stok
    LEFT JOIN tmp_detail_kite d ON d.id=b.id_detail_kj
	LEFT JOIN tbl_kite c ON c.id = d.id_kite
	WHERE
	b.nokk='".$row['nokk']."' and b.status='1' and transtatus='0' and b.sisa='".$row['sisa']."' and a.tgl_update='".$row['tgl_update']."'
	GROUP BY
	b.nokk,b.sisa
	ORDER BY
	a.id ");
	$rklrg=mysqli_fetch_array($sqlklrg);
	  ?>
    <tr bgcolor="#CC9933" class="ukuran">
    <td><?php echo $row['no_item'];?></td>
    <td><?php echo $row['pelanggan'];?></td>
    <td><?php echo $row['no_po'];?></td>
    <td><?php echo $row['no_order'];?></td>
    <td><?php echo htmlentities($row['jenis_kain'],ENT_QUOTES);?></td>
    <td><?php echo $row['no_warna'];?></td>
    <td><?php echo $row['warna'];?></td>
    <td>'<a href="#"onClick="window.open('logscan.php?nokk=<?php echo $row['nokk'];?>','MyWindow','height=450,width=500');"><?php echo $row['nokk'];?></a></td>
    <td>'<?php echo $row['no_lot'];?></td>
    <td bgcolor="#CCCC33"><?php if($ckk=='admin'){ ?><a href="#" onClick="window.open('detail-masuk-kain-m.php?nokk=<?php echo $row['nokk'];?>&ket=<?php echo $row['sisa'];?>&id=<?php echo $row['id'];?>','MyWindow','height=400,width=500');"><?php 
	$rol=$row['tot_rol'];
	echo $rol;
	?></a> <?php }else{ ?><?php 
	$rol=$row['tot_rol'];
	echo $rol;
	?><?php } ?></td>
    <td align="right" bgcolor="#CCCC33"><?php 
	echo number_format($row['grd_a'],'2','.',',');
	?></td>
    <td align="right" bgcolor="#CCCC33"><?php 
	echo number_format($row['grd_b'],'2','.',',');
	?></td>
    <td align="right" bgcolor="#CCCC33"><?php 
	echo number_format($row['grd_c'],'2','.',',');?></td>
    <td bgcolor="#CCCC33"><?php if($row['sisa']=="SISA" || $row['sisa']=="FKSI"){echo "SISA";} if($row['sisa']=="SISA" || $row['sisa']=="FKSI"){}else{echo " ".$rowket['ket_c'];} ?></td>
    <td bgcolor="#CCCC66"><a href="#" onClick="window.open('detail-masuk-kain.php?nokk=<?php echo $row['nokk'];?>&ket=<?php echo $row['sisa'];?>&id=<?php echo $row['id'];?>','MyWindow','height=400,width=500');"><?php 
	$rol=$rmskg['tot_rol'];
	echo $rol;
	?></a></td>
    <td bgcolor="#CCCC66"><?php 
	echo number_format($rmskg['grd_a'],'2','.',',');
	?></td>
    <td bgcolor="#CCCC66"><?php 
	echo number_format($rmskg['grd_b'],'2','.',',');
	?></td>
    <td bgcolor="#CCCC66"><?php 
	echo number_format($rmskg['grd_c'],'2','.',',');?></td>
    <td bgcolor="#CCCC66"><?php if($row['sisa']=="SISA" || $row['sisa']=="FKSI"){echo "SISA";} if($row['sisa']=="SISA" || $row['sisa']=="FKSI"){}else{echo " ".$rowket['ket_c'];} ?></td>
    <td bgcolor="#FF6666"><a href="#"><?php 
	$rol1=$rklrg['tot_rol'];
	echo $rol1;
	?></a></td>
    <td bgcolor="#FF6666"><?php 
	echo number_format($rklrg['grd_a'],'2','.',',');
	?></td>
    <td bgcolor="#FF6666"><?php 
	echo number_format($rklrg['grd_b'],'2','.',',');
	?></td>
    <td bgcolor="#FF6666"><?php 
	echo number_format($rklrg['grd_c'],'2','.',',');?></td>
    <td bgcolor="#FF6666"><?php if($row['sisa']=="SISA" || $row['sisa']=="FKSI"){echo "SISA";} if($row['sisa']=="SISA" || $row['sisa']=="FKSI"){}else{echo " ".$rowket['ket_c'];} ?></td>
    <td><?php echo $rtmpt['tempat']; ?></td>
    <td><?php if($row['sisa']=="FOC"){echo "EXTRA FULL";}?></td>
    <td><?php echo $row['lebar'];?></td>
    <td>X</td>
    <td><?PHP echo $row['berat']; ?></td>
    </tr>
 
      <?php
	  	 if($row['sisa']=="SISA" || $row['sisa']=="FKSI" || $row['sisa']=="FOC"){$brtoo=0;}else{$brtoo=number_format($row['bruto'],'2','.',',');}
	   $totbruto=$totbruto+$brtoo;
	  $totyard=$totyard+$row['tot_yard'];
	  $totrol=$totrol+$rol;
	  $tota=$tota+$row['grd_a'];
	  $totb=$totb+$row['grd_b'];
	  $totc=$totc+$row['grd_c'];
	  	if($row['satuan']=='Meter')
		{$kartot=$kartot + $row['tot_yard']; $totrolm = $totrolm + $row['tot_rol'];}
		if($row['satuan']=='Yard')
		{$pltot=$pltot + $row['tot_yard'];   $totroly = $totroly + $row['tot_rol'];}
	  
	  }
	  
	  
  ?>
  <tr bgcolor="#99FFFF">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td></td>
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
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
 <tr bgcolor="#99FFFF" class="ukuran">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Meter</td>
    <td><?php echo number_format($totrolm); ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Meter</td>
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
  <tr bgcolor="#99FFFF" class="ukuran">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Yard</td>
    <td><?php echo  number_format($totroly);?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Yard</td>
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
  <tr bgcolor="#99FFFF" class="ukuran">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><b>Total</b></td>
    <td>&nbsp;</td>
    <td><?php echo $totrol;?></td>
    <td align="right"><b><?php echo number_format($tota,'2','.',',');?></b></td>
    <td align="right"><b><?php echo number_format($totb,'2','.',',');?></b></td>
    <td align="right"><b><?php echo number_format($totc,'2','.',',');?></b></td>
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
  
</table>


                            
                            
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