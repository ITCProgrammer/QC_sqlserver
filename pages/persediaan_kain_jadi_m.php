 <?php
include("../koneksi.php");
ini_set("error_reporting",1);
?>
   <!--
    Created by Artisteer v2.3.0.21098
    Base template (without user's data) checked by http://validator.w3.org : "This page is valid XHTML 1.0 Transitional"
    -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <title>Persediaan Gudang</title>

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
</head>
<body>
    <div id="art-main">
      <div class=""></div>
            <div class=""></div>
            <input type="button" class="art-button" onClick="window.location.href='../index_login.php?act=logout'" value="Logout"/>
                            <?php if($_SESSION['status']==0){ ?><input type="button" class="art-button" onClick="window.location.href='../index1.php'" value="Home"/><input type="button" class="art-button" onClick="window.location.href='../index1.php?p=laporan_harian_kain'" value="Laporan"/><br /><?php } ?>
                   <center><b>LAPORAN PERSEDIAAN KAIN JADI</b></center>    
   <div align="right"><a href="persediaan_kain_jadi_m_excel.php?awal=<?php echo $_POST['awal'];?>&akhir=<?php echo $_POST['akhir'];?>&no_order=<?php echo $_POST['no_order'];?>">Cetak Excel</a></div> 
<?php $tgl_cetak1=$_POST['awal'];$tgl_cetak2=$_POST['akhir']; ?>
<?php 
	if($_POST['no_order']!='')
	{ $where.= " AND c.no_order ='".$_POST['no_order']."' "; 
		}else{ $where.= " "; }
	if($_POST['awal']!='' and $_POST['akhir']!='')
	{ $where1.= " AND DATE_FORMAT(a.tgl_update,'%Y-%m-%d') BETWEEN '".$_POST['awal']."'"." AND '$tgl_cetak2' "; 
		}else{ $where1.= " "; }
	
		echo "<b>TGL : ".$_POST['awal']." s/d ". $_POST['akhir']."</b><br>";
	?>
                   
       <table width="100" align="center" style="font-size:11px">
  <tr align="center" bgcolor="#0099FF">
    <td rowspan="2" bgcolor="#3366CC">TGL</td>
    <td rowspan="2" bgcolor="#3366CC">NO ITEM</td>
    <td rowspan="2" bgcolor="#3366CC">LANGGANAN</td>
    <td width="15" rowspan="2" bgcolor="#3366CC">PO</td>
    <td width="15" rowspan="2" bgcolor="#3366CC">ORDER</td>
    <td rowspan="2" bgcolor="#3366CC">JENIS_KAIN</td>
    <td rowspan="2" bgcolor="#3366CC" >NO WARNA</td>
    <td rowspan="2" bgcolor="#3366CC">WARNA</td>
    <td rowspan="2" bgcolor="#3366CC">NO CARD</td>
    <td rowspan="2" bgcolor="#3366CC">LOT</td>
    <td rowspan="2" bgcolor="#3366CC">ROLL</td>
    <td colspan="3" bgcolor="#3366CC">Netto (KG)</td>
    <td rowspan="2" bgcolor="#3366CC">Yard / Meter</td>
    <td rowspan="2" bgcolor="#3366CC">UNIT</td>
    <td rowspan="2" bgcolor="#3366CC">EXTRA Q</td>
    <td rowspan="2" bgcolor="#3366CC">LBR</td>
    <td rowspan="2" bgcolor="#3366CC">X</td>
    <td rowspan="2" bgcolor="#3366CC">GRMS</td>
    <td rowspan="2" bgcolor="#3366CC">OL</td>
    <td rowspan="2" bgcolor="#3366CC">Keterangan</td>
  </tr>
  <tr align="center" bgcolor="#0099FF">
    <td bgcolor="#3366CC">Grade<br /> A+B</td>
    <td bgcolor="#3366CC">Grade <br /> C</td>
    <td bgcolor="#3366CC">Keterangan<br />(Grade C)</td>
    </tr>
  <?php 
 
  $sql=sqlsrv_query($con," SELECT
	a.tgl_update,c.no_po,c.no_order,a.blok,
	b.sisa,b.nokk,c.jenis_kain,c.pelanggan,c.no_lot,c.no_warna,
	c.warna,c.lebar,c.berat,c.no_item
	FROM
	pergerakan_stok a
	LEFT JOIN detail_pergerakan_stok b ON a.id = b.id_stok
  	LEFT JOIN tmp_detail_kite d ON d.id=b.id_detail_kj
	LEFT JOIN tbl_kite c ON c.id = d.id_kite
	WHERE
	(a.typestatus = '1' OR a.typestatus = '2')
	AND (a.fromtoid = 'GUDANG KAIN JADI' OR a.fromtoid = 'PACKING') ".$where.$where1." 
	GROUP BY
	b.nokk,b.sisa
	ORDER BY
	a.tgl_update,a.id ");
  $c=1;
  $i=1;
  while($row=sqlsrv_fetch_array($sql))
  {
	   $bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99';
	   $mySql =sqlsrv_query($con,"SELECT tempat FROM mutasi_kain WHERE nokk='".$row['nokk']."' AND keterangan='".$row['sisa']."' order by id asc");
	   $myBlk = sqlsrv_fetch_array($mySql);
	   
	   $mysqlCek=sqlsrv_query($con," SELECT
	SUM(case when b.grade='A' or b.grade='B' or b.grade='C' or b.grade='' then b.weight else 0 end) as tot_qty,
	SUM(if(b.grade='A' or b.grade='B' or b.grade='C' or b.grade='', 1, 0)) as tot_rol,
	SUM(case when b.grade='A' or b.grade='B' or b.grade='C' or b.grade='' then b.yard_ else 0 end) as tot_yard,
	SUM(case when b.grade='A' or b.grade='B' or b.grade='' then b.weight else 0 end) as grd_ab,
	SUM(case when b.grade='C' then b.weight else 0 end) as grd_c,
	SUM(if(b.grade='A' or b.grade='B' or b.grade='', 1, 0)) as jml_ab,
	SUM(if(b.grade = 'C', 1, 0)) as jml_grd_c,b.sisa,b.satuan,SUM(d.netto) as netto
	FROM
	pergerakan_stok a 
	LEFT JOIN detail_pergerakan_stok b  ON a.id = b.id_stok
  LEFT JOIN tmp_detail_kite d ON d.id=b.id_detail_kj
	LEFT JOIN tbl_kite c ON c.id = d.id_kite
	WHERE
	b.`transtatus`='1' and b.nokk='".$row['nokk']."' and b.sisa='".$row['sisa']."'
	GROUP BY
	b.sisa
	ORDER BY
	a.id ");
	$myro = sqlsrv_fetch_array($mysqlCek);
	$mySql1 =sqlsrv_query($con,"SELECT * FROM tbl_kite WHERE nokk='".$row['nokk']."'");
	$myBlk1 = sqlsrv_fetch_array($mySql1);
	if($myro['tot_rol']>0 and $myBlk1['no_order'] == ""){
			  ?>
    <tr bgcolor="<?php echo $bgcolor; ?>">
    <td><?php echo date("d-M-Y", strtotime($row['tgl_update']));?></td>
    <td><?php echo $myBlk1['no_item'];?></td>
    <td><?php echo $myBlk1['pelanggan'];?></td>
    <td><?php echo $myBlk1['no_po'];?></td>
    <td><?php echo $myBlk1['no_order'];?></td>
    <td><?php echo htmlentities($myBlk1['jenis_kain'],ENT_QUOTES);?></td>
    <td><?php echo $myBlk1['no_warna'];?></td>
    <td><?php echo $myBlk1['warna'];?></td>
    <td><a href="#" onClick="window.open('detail-persediaan.php?nokk=<?php echo $row['nokk'];?>&ket=<?php echo $myBlk1['sisa'];?>','MyWindow','height=400,width=500');"><?php echo $row['nokk'];?></a></td>
    <td><?php echo $myBlk1['no_lot'];?></td>
    <td align="right"><?php 
	echo $myro['tot_rol'];
	?></td>
    <td align="right"><?php 
	echo number_format($myro['grd_ab'],'2','.',',');?></td>
    <td align="right"><?php 
	echo number_format($myro['grd_c'],'2','.',',');
	?></td>
    <td><?php if($myBlk1['sisa']=="SISA" || $myBlk1['sisa']=="FKSI"){echo "SISA";}?></td>
    <td align="right"><?php 
	if($myro['satuan']=="PCS"){echo number_format($myro['netto'])." ".$myro['satuan'];}else{
	echo number_format($myro['tot_yard'],'2','.',',')." ".$myro['satuan'];} ?></td>
    <td><input class="input1" name="tempat[<?php echo $i;?>]" type="hidden" value="<?php echo $myBlk['blok'];?>" >
    <input name="nokk" type="hidden" value="<?php echo $row['nokk'];?>"><a href="#"onClick="window.open('tempat-persediaan.php?nokk=<?php echo $row['nokk'];?>&ket=<?php echo $row['sisa'];?>','MyWindow','height=200,width=500');"><?php if($myBlk['tempat']==""){echo "N/A";}else{echo $myBlk['tempat'];}?></a></td>
    <td><?php if($myro['sisa']=="FOC"){echo "EXTRA FULL";}?></td>
    <td><?php echo $myBlk1['lebar'];?></td>
    <td>X</td>
    <td><?PHP echo $myBlk1['berat']; ?></td>
    <td>&nbsp;</td>
    <td align="center"><?php  $i++; ?></td>
  </tr>
 
      <?php
	}
	  	 if($myro['sisa']=="SISA" || $myro['sisa']=="FKSI" || $myro['sisa']=="FOC"){$brtoo=0;}else{$brtoo=number_format($myBlk1['bruto'],'2','.',',');}
	   $totbruto=$totbruto+$brtoo;
	  $totyard=$totyard+$myro['tot_yard'];
	  $totrol=$totrol+$myro['tot_rol'];
	  $totab=$totab+$myro['grd_ab'];
	  $tota=$tota+$myro['grd_c'];
	  $totpcs=$totpcs +$myro['netto'];
	  $rolab=$rolab + $myro['jml_ab'];
	  $rolac=$rolac + $myro['jml_grd_c'];
	  	if($myro['satuan']=='Meter')
		{$kartot=$kartot + $myro['tot_yard']; $totrolm = $totrolm + $myro['tot_rol'];}
		if($myro['satuan']=='Yard')
		{$pltot=$pltot + $myro['tot_yard'];   $totroly = $totroly + $myro['tot_rol'];}
		if($myro['satuan']=='PCS')
		{$totrolp = $totrolp + $myro['tot_rol'];}
	  
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
    <td bgcolor="#CCFF99"></td>
    <td bgcolor="#CCFF99"></td>
    <td bgcolor="#CCFF99">&nbsp;</td>
    <td bgcolor="#CCFF99">&nbsp;</td>
    <td bgcolor="#CCFF99">&nbsp;</td>
    <td bgcolor="#CCFF99">&nbsp;</td>
    <td bgcolor="#CCFF99">PCS</td>
    <td align="right" bgcolor="#CCFF99"><?php echo number_format($totrolp); ?></td>
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
    <td align="right" bgcolor="#CCFF99"><?php echo number_format($totpcs); ?></td>
    <td bgcolor="#CCFF99">PCS</td>
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
    <td align="right" bgcolor="#CCFF99"><b><?php echo $totrol;?></td>
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
  <tr bgcolor="#99FFFF">
    <td colspan="22" bgcolor="#CCFF99"><b>( Roll : <?php echo  number_format($totrol);  ?> ) (GRADE A+B: <?php echo  number_format($totab,'2','.',',');  ?> Kg, Roll: <?php echo  number_format($rolab);  ?>)  (GRADE C: <?php echo  number_format($tota,'2','.',',');  ?> Kg, Roll: <?php echo  number_format($rolac);  ?>) (TOTAL : <?php echo  number_format($totab+$tota,'2','.',',');  ?> Kg) </b></td>
    </tr>
  <b>( Roll : <?php echo  number_format($totrol);  ?> ) (GRADE A+B: <?php echo  number_format($totab,'2','.',',');  ?> Kg, Roll: <?php echo  number_format($rolab);  ?>)  (GRADE C: <?php echo  number_format($tota,'2','.',',');  ?> Kg, Roll: <?php echo  number_format($rolac);  ?>) (TOTAL : <?php echo  number_format($totab+$tota,'2','.',',');  ?> Kg) </b>
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
