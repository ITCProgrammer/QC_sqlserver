 
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
</head>
<body>
    <div id="art-main">
      <div class=""></div>
            <div class=""></div>
            <input type="button" class="art-button" onClick="window.location.href='../index_login.php?act=logout'" value="Logout"/>
                            <?php if($_SESSION['status']==0){ ?><input type="button" class="art-button" onClick="window.location.href='../index1.php'" value="Home"/><input type="button" class="art-button" onClick="window.location.href='../index1.php?p=laporan_harian_kain'" value="Laporan"/><br /><?php } ?>
                       
  <form action="simpan_blok.php" method="post" name="form1"/>  
                      
       <table width="100" align="center" style="font-size:12px">
  <tr>
    <td colspan="22" align="center" style="font-size:18px"><b>LAPORAN HARIAN KAIN JADI <?php if($_POST['ganti_stiker']=="1"){echo "GANTI STIKER";}else if($_POST['ganti_stiker']=="2"){echo"POTONG SISA";}?></b></td>
    </tr>
  <tr>
   <?php $tgl_cetak1=$_POST['awal']; $tgl_cetak2=$_POST['akhir']; if($_POST[shift]!=""){$shft=$_POST[shift];}else{$shft="All";}?>
  <input name="tgl" type="hidden" value="<?php echo $tgl_cetak1;?>">
  <input name="tgl1" type="hidden" value="<?php echo $tgl_cetak2;?>">  
    <td colspan="8"><strong>Shift :<?php echo $shft;?></strong></td>
    <td colspan="14"><div align="right"><a href="data_kain_jadi_excel.php?awal=<?php echo $_POST['awal'];?>&akhir=<?php echo $_POST['akhir'];?>&no_order=<?php echo $_POST['order'];?>&ganti_stiker=<?php echo $_POST['ganti_stiker'];?>&shft=<?php echo $shft; ?>">Cetak Excel</a></div></td>
    </tr>
  <tr align="center" bgcolor="#0099FF">
    <td rowspan="2" bgcolor="#3366CC"><strong>TGL</strong></td>
    <td rowspan="2" bgcolor="#3366CC"><strong>NO ITEM</strong></td>
    <td rowspan="2" bgcolor="#3366CC"><strong>LANGGANAN</strong></td>
    <td width="15" rowspan="2" bgcolor="#3366CC"><strong>PO</strong></td>
    <td width="15" rowspan="2" bgcolor="#3366CC"><strong>ORDER</strong></td>
    <td rowspan="2" bgcolor="#3366CC"><strong>JENIS_KAIN</strong></td>
    <td rowspan="2" bgcolor="#3366CC" ><strong>NO WARNA</strong></td>
    <td rowspan="2" bgcolor="#3366CC"><strong>WARNA</strong></td>
    <td rowspan="2" bgcolor="#3366CC"><strong>NO CARD</strong></td>
    <td rowspan="2" bgcolor="#3366CC"><strong>LOT</strong></td>
    <td rowspan="2" bgcolor="#3366CC"><strong>ROLL</strong></td>
    <td colspan="3" bgcolor="#3366CC"><strong>Netto (KG)</strong></td>
    <td rowspan="2" bgcolor="#3366CC"><strong>Yard / Meter</strong></td>
    <td rowspan="2" bgcolor="#3366CC"><strong>UNIT</strong></td>
    <td rowspan="2" bgcolor="#3366CC"><strong>EXTRA Q</strong></td>
    <td rowspan="2" bgcolor="#3366CC"><strong>LBR</strong></td>
    <td rowspan="2" bgcolor="#3366CC"><strong>X</strong></td>
    <td rowspan="2" bgcolor="#3366CC"><strong>GRMS</strong></td>
    <td rowspan="2" bgcolor="#3366CC"><strong>OL</strong></td>
    <td rowspan="2" bgcolor="#3366CC"><strong>Keterangan</strong></td>
  </tr>
  <tr align="center" bgcolor="#0099FF">
    <td bgcolor="#3366CC"><strong>Grade<br /> A+B</strong></td>
    <td bgcolor="#3366CC"><strong>Grade <br /> C</strong></td>
    <td bgcolor="#3366CC"><strong>Keterangan<br />(Grade C)</strong></td>
    </tr>
  <?php 
  mysql_connect("192.168.0.4","dit","4dm1n");
  mysql_select_db("db_qc")or die("Gagal Koneksi");
  if($tgl_cetak1!="" and $tgl_cetak2!="")
  {$tgll=" AND a.tgl_update between '$tgl_cetak1' AND '$tgl_cetak2' ";}
  else if($tgl_cetak1="")
  {$tgll=" ";} else if($tgl_cetak2="")
  {$tgll=" ";}
  if($_POST['shift']!="")
  {$shift=" AND a.shift='$_POST[shift]' ";}else{$shift=" ";}
  if($_POST['order']!="")
  {$order=" AND c.no_order='$_POST[order]' ";}
   else if($tgl_cetak1="" and $_POST['order']="")
  {$tgll=" AND a.tgl_update='$tgl_cetak1' ";}
    if($_POST['ganti_stiker']=="1"){
	  $transfer=" AND ( a.fromtoid = 'GANTI STIKER') ";
	}else if($_POST['ganti_stiker']=="2"){
	  $transfer=" AND ( a.fromtoid = 'POTONG SISA') ";
	}else{$transfer=" AND (a.fromtoid = 'PACKING' OR a.fromtoid='LAIN' OR a.fromtoid='INSPEK MEJA') ";}
  $sql=mysql_query("SELECT
	a.id,a.tgl_update,a.blok,a.ket,c.no_po,c.no_order,b.weight,b.yard_,b.no_roll,
	b.satuan,b.grade,b.sisa,b.nokk,c.jenis_kain,c.pelanggan,c.no_lot,c.no_warna,
	c.warna,c.lebar,c.berat,c.no_item,
  SUM(case when b.grade='A' or b.grade='B' or b.grade='C' or b.grade='' then b.weight else 0 end) as tot_qty,
  SUM(if(b.grade='A' or b.grade='B' or b.grade='C' or b.grade='', 1, 0)) as tot_rol,
  SUM(case when b.grade='A' or b.grade='B' or b.grade='C' or b.grade='' then b.yard_ else 0 end) as tot_yard,
	SUM(case when b.grade='A' or b.grade='B' or b.grade='' then b.weight else 0 end) as grd_ab,
	SUM(case when b.grade='C' then b.weight else 0 end) as grd_c,
	SUM(if(b.grade='A' or b.grade='B' or b.grade='', 1, 0)) as jml_ab,
	SUM(if(b.grade = 'C', 1, 0)) as jml_grd_c,SUM(d.netto) as netto
	FROM
	detail_pergerakan_stok b
	LEFT JOIN  pergerakan_stok a ON a.id = b.id_stok
    LEFT JOIN tmp_detail_kite d ON d.id=b.id_detail_kj
	LEFT JOIN tbl_kite c ON c.id = d.id_kite
	WHERE
	(b.transtatus='1' or b.transtatus='0')
	$tgll $order $shift $transfer
	GROUP BY
	a.id,b.nokk,b.sisa
	ORDER BY
	a.id");
  $c=1;
  $i=1;
  while($row=mysql_fetch_array($sql))
  {
	   $bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99';
	   $mutasi=date("Ymd", strtotime($row['tgl_update']));
	   $mySql =mysql_query("SELECT tempat FROM mutasi_kain WHERE nokk='$row[nokk]' and no_mutasi like '%$mutasi%' order by id asc");
	   $myBlk = mysql_fetch_array($mySql);
	   $sqlPtg=mysql_query("SELECT 
SUM(case when grade='C' then weight else 0 end) as grd_c,
SUM(case when grade='A' or grade='B' or grade='' then weight else 0 end) as grd_ab,SUM(yard_) as yard_
from detail_pergerakan_stok WHERE nokk='$row[nokk]' and transtatus='3' and id_ref='$row[id]' and (sisa='' or sisa= 'KITE') ");
	   $dPtg=mysql_fetch_array($sqlPtg);
	  $sqlPtgs=mysql_query("SELECT 
SUM(case when grade='C' then weight else 0 end) as grd_c,
SUM(case when grade='A' or grade='B' or grade='' then weight else 0 end) as grd_ab,SUM(yard_) as yard_
from detail_pergerakan_stok WHERE nokk='$row[nokk]' and transtatus='3' and id_ref='$row[id]' and (sisa='SISA' or sisa='FKSI')");
	   $dPtgs=mysql_fetch_array($sqlPtgs);
	  ?>
    <tr bgcolor="<?php echo $bgcolor; ?>">
      <td><a href="#" onClick="window.open('ubah-tgl-masuk-kain.php?no=<?php echo $row['id'];?>&tgl=<?php echo date("Y-m-d", strtotime($row['tgl_update']));?>','MyWindow','height=100,width=300');"><?php echo date("d-M-Y", strtotime($row['tgl_update']));?></a></td>
    <td><?php echo $row['no_item'];?></td>
    <td><?php echo $row['pelanggan'];?></td>
    <td><?php echo $row['no_po'];?></td>
    <td><?php echo $row['no_order'];?></td>
    <td><?php echo htmlentities($row['jenis_kain'],ENT_QUOTES);?></td>
    <td><?php echo $row['no_warna'];?></td>
    <td><?php echo $row['warna'];?></td>
    <td><a href="#" onClick="window.open('detail-masuk-kain.php?nokk=<?php echo $row['nokk'];?>&ket=<?php echo $row['sisa'];?>','MyWindow','height=400,width=500');"><?php echo $row['nokk'];?></a></td>
    <td><?php echo $row['no_lot'];?></td>
    <td align="right"><?php 
	$rol=$row['tot_rol'];
	echo $rol;
	?></td>
    <td align="right"><?php 
	if($row['sisa']=="SISA" || $row['sisa']=="FKSI"){$grab=$row['grd_ab']+$dPtgs['grd_ab'];}else{
	$grab=$row['grd_ab']+$dPtg['grd_ab'];}echo number_format($grab,'2','.',',');?></td>
    <td align="right"><?php 
	if($row['sisa']=="SISA" || $row['sisa']=="FKSI"){$grc=$row['grd_c']+$dPtgs['grd_c'];}else{
	$grc=$row['grd_c']+$dPtg['grd_c'];
	}echo number_format($grc,'2','.',',');?></td>
    <td><?php if($row['sisa']=="SISA" || $row['sisa']=="FKSI"){echo "SISA";}?></td>
    <td align="right"><?php 
	if($row['satuan']=="PCS"){echo number_format($row['netto'])." ".$row['satuan'];}else{
	echo number_format($row['tot_yard']+$dPtg['yard_'],'2','.',',')." ".$row['satuan'];} ?></td>
    <td><input class="input1" name="tempat[<?php echo $i;?>]" type="hidden" value="<?php echo $myBlk['blok'];?>" >
    <input name="nokk" type="hidden" value="<?php echo $row['nokk'];?>"> <a href="#"><?php if($row['blok']!=''){echo $row['blok'];}else{echo $myBlk['tempat'];}?></a></td>
    <td><?php if($row['sisa']=="FOC"){echo "EXTRA FULL";}?></td>
    <td><?php echo $row['lebar'];?></td>
    <td>X</td>
    <td><?PHP echo $row['berat']; ?></td>
    <td>&nbsp;</td>
    <td align="center"><?php  echo $row['ket'];$i++; ?></td>
  </tr>
 
      <?php
	  	 if($row['sisa']=="SISA" || $row['sisa']=="FKSI" || $row['sisa']=="FOC"){$brtoo=0;}else{$brtoo=number_format($row['bruto'],'2','.',',');}
	   $totbruto=$totbruto+$brtoo;
	  $totyard=$totyard+$row['tot_yard'];
	  $totrol=$totrol+$rol;
	  $totab=$totab+$grab;
	  $tota=$tota+$grc;
	  	if($row['satuan']=='Meter')
		{$kartot=$kartot + $row['tot_yard']; $totrolm = $totrolm + $row['tot_rol'];}
		if($row['satuan']=='Yard')
		{$pltot=$pltot + $row['tot_yard'];   $totroly = $totroly + $row['tot_rol'];}
	  
	  }
	  
	  
  ?>
  <tr bgcolor="#99FFFF">
    <td bgcolor="#CCFF99">&nbsp;</td>
    <td bgcolor="#CCFF99">&nbsp;</td>
    <td bgcolor="#CCFF99">&nbsp;</td>
    <td bgcolor="#CCFF99"></td>
    <td bgcolor="#CCFF99"></td>
    <td bgcolor="#CCFF99">&nbsp;</td>
    <td bgcolor="#CCFF99">&nbsp;</td>
    <td bgcolor="#CCFF99">&nbsp;</td>
    <td bgcolor="#CCFF99">&nbsp;</td>
    <td bgcolor="#CCFF99">&nbsp;</td>
    <td bgcolor="#CCFF99">&nbsp;</td>
    <td bgcolor="#CCFF99">&nbsp;</td>
    <td bgcolor="#CCFF99">&nbsp;</td>
    <td bgcolor="#CCFF99">&nbsp;</td>
    <td bgcolor="#CCFF99">&nbsp;</td>
    <td bgcolor="#CCFF99"></td>
    <td bgcolor="#CCFF99">&nbsp;</td>
    <td bgcolor="#CCFF99">&nbsp;</td>
    <td bgcolor="#CCFF99">&nbsp;</td>
    <td bgcolor="#CCFF99">&nbsp;</td>
    <td bgcolor="#CCFF99">&nbsp;</td>
    <td bgcolor="#CCFF99">&nbsp;</td>
  </tr>
 <tr bgcolor="#99FFFF">
   <td bgcolor="#CCFF99">&nbsp;</td>
    <td bgcolor="#CCFF99">&nbsp;</td>
    <td bgcolor="#CCFF99">&nbsp;</td>
    <td bgcolor="#CCFF99">&nbsp;</td>
    <td bgcolor="#CCFF99">&nbsp;</td>
    <td bgcolor="#CCFF99">&nbsp;</td>
    <td bgcolor="#CCFF99">&nbsp;</td>
    <td bgcolor="#CCFF99">&nbsp;</td>
    <td bgcolor="#CCFF99">&nbsp;</td>
    <td bgcolor="#CCFF99">Meter</td>
    <td align="right" bgcolor="#CCFF99"><?php echo number_format($totrolm); ?></td>
    <td bgcolor="#CCFF99">&nbsp;</td>
    <td bgcolor="#CCFF99">&nbsp;</td>
    <td bgcolor="#CCFF99">Meter</td>
    <td align="right" bgcolor="#CCFF99"><?php echo number_format($kartot,'2','.',','); ?></td>
    <td bgcolor="#CCFF99">&nbsp;</td>
    <td bgcolor="#CCFF99">&nbsp;</td>
    <td bgcolor="#CCFF99">&nbsp;</td>
    <td bgcolor="#CCFF99">&nbsp;</td>
    <td bgcolor="#CCFF99">&nbsp;</td>
    <td bgcolor="#CCFF99">&nbsp;</td>
    <td bgcolor="#CCFF99">&nbsp;</td>
  </tr>
  <tr bgcolor="#99FFFF">
    <td bgcolor="#CCFF99">&nbsp;</td>
    <td bgcolor="#CCFF99">&nbsp;</td>
    <td bgcolor="#CCFF99">&nbsp;</td>
    <td bgcolor="#CCFF99">&nbsp;</td>
    <td bgcolor="#CCFF99">&nbsp;</td>
    <td bgcolor="#CCFF99">&nbsp;</td>
    <td bgcolor="#CCFF99">&nbsp;</td>
    <td bgcolor="#CCFF99">&nbsp;</td>
    <td bgcolor="#CCFF99">&nbsp;</td>
    <td bgcolor="#CCFF99">Yard</td>
    <td align="right" bgcolor="#CCFF99"><?php echo  number_format($totroly);?></td>
    <td bgcolor="#CCFF99">&nbsp;</td>
    <td bgcolor="#CCFF99">&nbsp;</td>
    <td bgcolor="#CCFF99">Yard</td>
    <td align="right" bgcolor="#CCFF99"><?php echo  number_format($pltot,'2','.',',');?></td>
    <td bgcolor="#CCFF99">&nbsp;</td>
    <td bgcolor="#CCFF99">&nbsp;</td>
    <td bgcolor="#CCFF99">&nbsp;</td>
    <td bgcolor="#CCFF99">&nbsp;</td>
    <td bgcolor="#CCFF99">&nbsp;</td>
    <td bgcolor="#CCFF99">&nbsp;</td>
    <td bgcolor="#CCFF99">&nbsp;</td>
  </tr>
  <tr bgcolor="#99FFFF">
    <td bgcolor="#CCFF99">&nbsp;</td>
    <td bgcolor="#CCFF99">&nbsp;</td>
    <td bgcolor="#CCFF99">&nbsp;</td>
    <td bgcolor="#CCFF99">&nbsp;</td>
    <td bgcolor="#CCFF99">&nbsp;</td>
    <td bgcolor="#CCFF99">&nbsp;</td>
    <td bgcolor="#CCFF99">&nbsp;</td>
    <td bgcolor="#CCFF99"><b>Total</b></td>
    <td bgcolor="#CCFF99">&nbsp;</td>
    <td bgcolor="#CCFF99">&nbsp;</td>
    <td align="right" bgcolor="#CCFF99"><b><?php  echo $totrol;?></td>
    <td align="right" bgcolor="#CCFF99"><b><?php echo number_format($totab,'2','.',',');?></b></td>
    <td align="right" bgcolor="#CCFF99"><b><?php echo number_format($tota,'2','.',',');?></b></td>
    <td bgcolor="#CCFF99">&nbsp;</td>
    <td align="right" bgcolor="#CCFF99">&nbsp;</td>
    
    <td bgcolor="#CCFF99">&nbsp;</td>
    <td bgcolor="#CCFF99">&nbsp;</td>
    <td bgcolor="#CCFF99">&nbsp;</td>
    <td bgcolor="#CCFF99">&nbsp;</td>
    <td bgcolor="#CCFF99">&nbsp;</td>
    <td bgcolor="#CCFF99">&nbsp;</td>
    <td bgcolor="#CCFF99">&nbsp;</td>
  </tr>
  
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
