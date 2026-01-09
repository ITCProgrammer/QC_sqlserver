 <?php
include_once("koneksi.php");
ini_set("error_reporting",1);
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
</head>
<body>
    <div id="art-main">
      <div class=""></div>
            <div class=""></div>
            <input type="button" class="art-button" onClick="window.location.href='../index_login.php?act=logout'" value="Logout"/>
                            <?php if($_SESSION['status']==0){ ?><input type="button" class="art-button" onClick="window.location.href='../index1.php'" value="Home"/><input type="button" class="art-button" onClick="window.location.href='../index1.php?p=laporan_persediaan_kain_bs'" value="Laporan"/><br /><?php } ?>
                       
  <form action="simpan_blok.php" method="post" name="form1"/>  
  <div align="right"><a href="persediaan_kain_bs_excel.php?awal=<?php echo $_POST['awal'];?>&akhir=<?php echo $_POST['akhir'];?>&no_order=<?php echo $_POST['no_order'];?>">Cetak Excel</a></div>                    
       <table width="100%" align="center" style="font-size:11px">
  <tr>
    <td colspan="22" align="center" style="font-size:18px"><b>LAPORAN PERSEDIAAN KAIN BS </b></td>
    </tr>
  <tr>
   <?php $tgl_cetak1=$_POST['awal']; $tgl_cetak2=$_POST['akhir'];
	 if($_POST['no_order']!='')
	{ $where.= " AND c.no_order ='$_POST[no_order]' "; 
		}else{ $where.= " "; }
	 if($tgl_cetak1!='' and $tgl_cetak2!="")
	{ $where1.= " AND a.tgl_update between '$tgl_cetak1' AND '$tgl_cetak2' "; 
		}else{ $where1.= " "; }	
	$mysqry=mysql_query("SELECT
	SUM(case when b.grade='A' or b.grade='B' or b.grade='C' or b.grade='' then b.weight else 0 end) as tot_qty,
	SUM(if(b.grade='A' or b.grade='B' or b.grade='C' or b.grade='', 1, 0)) as tot_rol,
	SUM(case when b.grade='A' or b.grade='B' or b.grade='C' or b.grade='' then b.yard_ else 0 end) as tot_yard,
	SUM(case when b.grade='A' or b.grade='B' or b.grade='' then b.weight else 0 end) as grd_ab,
	SUM(case when b.grade='C' then b.weight else 0 end) as grd_c,
	SUM(if(b.grade='A' or b.grade='B' or b.grade='', 1, 0)) as jml_ab,
	SUM(if(b.grade = 'C', 1, 0)) as jml_grd_c
	FROM
	pergerakan_stok a 
	LEFT JOIN detail_pergerakan_stok b  ON a.id = b.id_stok
    LEFT JOIN tmp_detail_kite d ON d.id=b.id_detail_kj
	LEFT JOIN tbl_kite c ON c.id = d.id_kite
	WHERE
	b.transtatus='11' ".$where1.$where." 
	ORDER BY
	a.id");
	$myrow=mysql_fetch_array($mysqry);
	?>
  <input name="tgl" type="hidden" value="<?php echo $tgl_cetak1;?>">  
    <td colspan="22" style="font-size:14px"><b> ( Roll :  <?php echo  number_format($myrow[tot_rol]);  ?> ) (GRADE A+B: <?php echo  number_format($myrow[grd_ab],'2');  ?> Kg, Roll: <?php echo  number_format($myrow[jml_ab]);  ?>)  (GRADE C: <?php echo  number_format($myrow[grd_c],'2');  ?> Kg, Roll: <?php echo  number_format($myrow[jml_grd_c]);  ?>) (TOTAL : <?php echo  number_format($myrow[tot_qty],'2');  ?> Kg) </b></td>
    </tr>
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
 
  $sql=mysql_query("SELECT
	a.tgl_update,c.no_po,c.no_order,a.blok,b.weight,b.yard_,b.no_roll,
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
	pergerakan_stok a
	LEFT JOIN detail_pergerakan_stok b ON a.id = b.id_stok
    LEFT JOIN tmp_detail_kite d ON d.id=b.id_detail_kj
	LEFT JOIN tbl_kite c ON c.id = d.id_kite
	WHERE
	b.transtatus='11' ".$where1.$where." 
	GROUP BY
	a.id,b.nokk,b.sisa
	ORDER BY
	a.id");
  $c=1;
  $i=1;
  while($row=mysql_fetch_array($sql))
  {
	   $bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99';
	   $mySql =mysql_query("SELECT tempat FROM mutasi_kain WHERE nokk='$row[nokk]' order by id asc");
	   $myBlk = mysql_fetch_array($mySql);
	  ?>
    <tr bgcolor="<?php echo $bgcolor; ?>">
    <td><?php echo date("d-M-Y", strtotime($row['tgl_update']));?></td>
    <td><?php echo $row['no_item'];?></td>
    <td><?php echo $row['pelanggan'];?></td>
    <td><?php echo $row['no_po'];?></td>
    <td><?php echo $row['no_order'];?></td>
    <td><?php echo htmlentities($row['jenis_kain'],ENT_QUOTES);?></td>
    <td><?php echo $row['no_warna'];?></td>
    <td><?php echo $row['warna'];?></td>
    <td><a href="#" onClick="window.open('detail-persediaan-bs.php?nokk=<?php echo $row['nokk'];?>&ket=<?php echo $row['sisa'];?>','MyWindow','height=400,width=500');"><?php echo $row['nokk'];?></a></td>
    <td><?php echo $row['no_lot'];?></td>
    <td align="right"><?php 
	$rol=$row['tot_rol'];
	echo $rol;
	?></td>
    <td align="right"><?php 
	$grab=number_format($row['grd_ab'],'2','.',',');echo $grab;?></td>
    <td align="right"><?php 
	$grc=number_format($row['grd_c'],'2','.',',');
	echo $grc;?></td>
    <td><?php if($row['sisa']=="SISA" || $row['sisa']=="FKSI"){echo "SISA";}else if($row['sisa']=="BS"){echo "BS";}?></td>
    <td align="right"><?php 
	if($row['satuan']=="PCS"){echo number_format($row['netto'])." ".$row['satuan'];}else{
	echo number_format($row['tot_yard'],'2','.',',')." ".$row['satuan'];} ?></td>
    <td><input class="input1" name="tempat[<?php echo $i;?>]" type="hidden" value="<?php echo $myBlk['blok'];?>" >
    <input name="nokk" type="hidden" value="<?php echo $row['nokk'];?>"><a href="#"onClick="window.open('tempat-persediaan.php?id=<?php echo $row['id_stok'];?>&nokk=<?php echo $row['nokk'];?>&ket=<?php echo $row['sisa'];?>','MyWindow','height=200,width=500');"><?php 
	if($myBlk['tempat']!=""){echo $myBlk['tempat'];}else if($row['blok']!=""){echo $row['blok'];}else{echo "N/A";}?></a></td>
    <td><?php if($row['sisa']=="FOC"){echo "EXTRA FULL";}?></td>
    <td><?php echo $row['lebar'];?></td>
    <td>X</td>
    <td><?PHP echo $row['berat']; ?></td>
    <td>&nbsp;</td>
    <td align="center"><?php  $i++; ?></td>
  </tr>
 
      <?php
	  	 if($row['sisa']=="SISA" || $row['sisa']=="FKSI" || $row['sisa']=="FOC"){$brtoo=0;}else{$brtoo=number_format($row['bruto'],'2','.',',');}
	   $totbruto=$totbruto+$brtoo;
	  $totyard=$totyard+$row['tot_yard'];
	  $totrol=$totrol+$rol;
	  $totab=$totab+$row['grd_ab'];
	  $tota=$tota+$row['grd_c'];
	  $totpcs=$totpcs +$row['netto'];
	  	if($row['satuan']=='Meter')
		{$kartot=$kartot + $row['tot_yard']; $totrolm = $totrolm + $row['tot_rol'];}
		if($row['satuan']=='Yard')
		{$pltot=$pltot + $row['tot_yard'];   $totroly = $totroly + $row['tot_rol'];}
		if($row['satuan']=='PCS')
		{$totrolp = $totrolp + $row['tot_rol'];}
	  
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
    <td colspan="22" bgcolor="#CCFF99"><b>( Roll : <?php echo  number_format($myrow[tot_rol]);  ?> ) (GRADE A+B: <?php echo  number_format($myrow[grd_ab],'2');  ?> Kg, Roll: <?php echo  number_format($myrow[jml_ab]);  ?>)  (GRADE C: <?php echo  number_format($myrow[grd_c],'2');  ?> Kg, Roll: <?php echo  number_format($myrow[jml_grd_c]);  ?>) (TOTAL : <?php echo  number_format($myrow[tot_qty],'2');  ?> Kg) </b></td>
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
