 
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
                   <center>
                   <b>LAPORAN PERSEDIAAN KAIN JADI</b>
                   </center>    
   <div align="right"><a href="persediaan_kain_jadi_excel.php?awal=<?php echo $_POST['awal'];?>&akhir=<?php echo $_POST['akhir'];?>&no_order=<?php echo $_POST['no_order'];?>&blok=<?php echo $_POST['blok'];?>&ket=<?php echo $_POST['ket'];?>&no_item=<?php echo $_POST['no_item'];?>&no_warna=<?php echo $_POST['no_warna'];?>&lbr=<?php echo $_POST['lbr'];?>&grms=<?php echo $_POST['grms'];?>&buyer=<?php echo $_POST['buyer'];?>">Cetak Excel</a></div> 
<?php $tgl_cetak1=$_POST['awal'];$tgl_cetak2=$_POST['akhir']; ?>
<?php 
mysql_connect("192.168.0.4","dit","4dm1n");
mysql_select_db("db_qc")or die("Gagal Koneksi");
	if($_POST['blok']!='')
	{ $where3.= " AND a.blok LIKE '$_POST[blok]%' "; 
		}else{ $where3.= " "; }
	if($_POST['ket']=='SISA')
	{ $where4.= " AND (b.sisa='SISA' OR b.sisa='FKSI') "; 
		}elseif($_POST['ket']==''){
			$where4.= " AND (b.sisa='' OR b.sisa='KITE') ";}else{ $where4.= " "; }
	if($_POST['no_order']!='')
	{
		$order=trim($_POST[no_order]); 
	$where.= " AND trim(c.no_order)='$order' "; 
		}else{ $where.= " "; }
	if($_POST['no_item']!='')
	{
		$item=trim($_POST[no_item]); 
	$where5.= " AND trim(c.no_item)='$item' "; 
		}else{ $where5.= " "; }	
		if($_POST['no_warna']!='')
	{
		$warna=trim($_POST[no_warna]); 
	$where6.= " AND trim(c.no_warna)='$warna' "; 
		}else{ $where6.= " "; }	
		if($_POST['buyer']!='')
	{
		$buyer=trim($_POST[buyer]); 
	$where8.= " AND trim(c.pelanggan) LIKE '%$buyer' "; 
		}else{ $where8.= " "; }	
		if($_POST['lbr']!='' and $_POST['grms']!='')
	{
		$lebar=trim($_POST[lbr]);
		$berat=trim($_POST[grms]); 
	$where7.= " AND trim(c.lebar)='$lebar' AND trim(c.berat)='$berat' "; 
		}else{ $where7.= " "; }
		
	if($_POST['awal']!='' and $_POST['akhir']!='')
	{ $where1.= " AND DATE_FORMAT(a.tgl_update,'%Y-%m-%d') BETWEEN '$_POST[awal]'"." AND '$tgl_cetak2' "; 
		}else{ $where1.= " "; }
	
		echo "<b>TGL : ".$_POST['awal']." s/d ". $_POST['akhir']."</b><br>";
	?>
                   
    <table width="100%" class="display" id="datatables" >
    <thead>
    <tr align="center">
    <th rowspan="2">NO</th>
    <th rowspan="2">TGL</th>
    <th rowspan="2">NO ITEM</th>
    <th rowspan="2">LANGGANAN</th>
    <th width="15" rowspan="2">PO</th>
    <th width="15" rowspan="2">ORDER</th>
    <th rowspan="2">JENIS_KAIN</th>
    <th rowspan="2" >NO WARNA</th>
    <th rowspan="2">WARNA</th>
    <th rowspan="2">NO CARD</th>
    <th rowspan="2">LOT</th>
    <th rowspan="2">ROLL</th>
    <th colspan="3">Netto (KG)</th>
    <th rowspan="2">Yard / Meter</th>
    <th rowspan="2">UNIT</th>
    <th rowspan="2">EXTRA Q</th>
    <th rowspan="2">LBR</th>
    <th rowspan="2">X</th>
    <th rowspan="2">GRMS</th>
    <th rowspan="2">OL</th>
    <th rowspan="2">Keterangan</th>
  </tr>
  <tr align="center">
    <th>Grade<br /> A+B</th>
    <th>Grade <br /> C</th>
    <th>Keterangan<br />(Grade C)</th>
    </tr>
   </thead>
   <tbody> 
  <?php 
 
  $sql=mysql_query(" SELECT
	a.tgl_update,c.no_po,c.no_order,a.blok,
	b.sisa,b.nokk,c.jenis_kain,c.pelanggan,c.no_lot,c.no_warna,
	c.warna,c.lebar,c.berat,c.no_item,b.id_stok
	FROM
	pergerakan_stok a
	LEFT JOIN detail_pergerakan_stok b ON a.id = b.id_stok
  	LEFT JOIN tmp_detail_kite d ON d.id=b.id_detail_kj
	LEFT JOIN tbl_kite c ON c.id = d.id_kite
	WHERE
	(a.typestatus = '1' OR a.typestatus = '2')
	AND (a.fromtoid = 'GUDANG KAIN JADI' OR a.fromtoid = 'PACKING' OR a.fromtoid='LAIN' OR a.fromtoid='INSPEK MEJA' OR a.fromtoid ='GANTI STIKER' OR a.fromtoid = 'POTONG SISA') AND not ISNULL(b.transtatus) AND b.transtatus='1' ".$where8.$where7.$where6.$where5.$where4.$where3.$where.$where1." 
	GROUP BY
	b.nokk,b.sisa,b.id_stok
	ORDER BY
	a.tgl_update,a.id ");
  $c=1;
  $i=1;
  $no=1;
  while($row=mysql_fetch_array($sql))
  {
	   $bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99';
	   $mySql =mysql_query("SELECT tempat FROM mutasi_kain WHERE nokk='$row[nokk]' AND keterangan='$row[sisa]' order by id asc");
	   $myBlk = mysql_fetch_array($mySql);
	   
	   $mysqlCek=mysql_query(" SELECT
	SUM(case when b.grade='A' or b.grade='B' or b.grade='C' or b.grade='' then b.weight else 0 end) as tot_qty,
	SUM(if(b.grade='A' or b.grade='B' or b.grade='C' or b.grade='', 1, 0)) as tot_rol,
	SUM(case when b.grade='A' or b.grade='B' or b.grade='C' or b.grade='' then b.yard_ else 0 end) as tot_yard,
	SUM(case when b.grade='A' or b.grade='B' or b.grade='' then b.weight else 0 end) as grd_ab,
	SUM(case when b.grade='C' then b.weight else 0 end) as grd_c,
	SUM(if(b.grade='A' or b.grade='B' or b.grade='', 1, 0)) as jml_ab,
	SUM(if(b.grade = 'C', 1, 0)) as jml_grd_c,b.sisa,b.satuan,SUM(d.netto) as netto,
	a.blok,a.tgl_update
	FROM
	pergerakan_stok a 
	LEFT JOIN detail_pergerakan_stok b  ON a.id = b.id_stok
    LEFT JOIN tmp_detail_kite d ON d.id=b.id_detail_kj
	LEFT JOIN tbl_kite c ON c.id = d.id_kite
	WHERE
	b.`transtatus`='1' and b.nokk='$row[nokk]' and b.sisa='$row[sisa]' and b.id_stok='$row[id_stok]'
	AND (a.fromtoid = 'GUDANG KAIN JADI' OR a.fromtoid = 'PACKING' OR a.fromtoid='LAIN' OR a.fromtoid='INSPEK MEJA' OR a.fromtoid ='GANTI STIKER')
	GROUP BY
	b.sisa,b.id_stok
	ORDER BY
	a.id ");
	$myro = mysql_fetch_array($mysqlCek);
	if($myro['tot_rol']>0){
	   $mySql1 =mysql_query("SELECT * FROM tbl_kite WHERE nokk='$row[nokk]'");
	   $myBlk1 = mysql_fetch_array($mySql1);
	   $mySql2 =mysql_query("SELECT a.no_po,a.no_order FROM pergerakan_stok a
INNER JOIN detail_pergerakan_stok b ON a.id=b.id_stok
WHERE b.nokk='$row[nokk]' and ISNULL(b.transtatus)
GROUP BY b.nokk");
	   $myBlk2 = mysql_fetch_array($mySql2);
	  ?>
    <tr bgcolor="<?php echo $bgcolor; ?>">
      <td><?php echo $no;?></td>
    <td><?php echo date("d-M-Y", strtotime($row['tgl_update']));?></td>
    <td><b title="<?php echo $myBlk1['no_item'];?>"><?php echo substr($myBlk1['no_item'],0,8)."...";?></b></td>
    <td><b title="<?php echo $myBlk1['pelanggan'];?>"><?php echo substr($myBlk1['pelanggan'],0,7)."...";?></b></td>
    <td><b title="<?php if($myBlk1['no_po']!=""){echo $myBlk1['no_po'];}else{echo $myBlk2['no_po'];}?>"><?php if($myBlk1['no_po']!=""){echo substr($myBlk1['no_po'],0,7)."...";}else{echo substr($myBlk2['no_po'],0,7)."...";}?></b></td>
    <td><?php if($myBlk1['no_order']!=""){echo $myBlk1['no_order'];}else{echo $myBlk2['no_order'];}?></td>
    <td><b title="<?php echo htmlentities($myBlk1['jenis_kain'],ENT_QUOTES);?>"><?php echo htmlentities(substr($myBlk1['jenis_kain'],0,7)."...",ENT_QUOTES);?></b></td>
    <td><b title="<?php echo $myBlk1['no_warna'];?>"><?php echo substr($myBlk1['no_warna'],0,7)."...";?></b></td>
    <td><b title="<?php echo $myBlk1['warna'];?>"><?php echo substr($myBlk1['warna'],0,7)."...";?></b></td>
    <td><a href="#" onClick="window.open('detail-persediaan.php?nokk=<?php echo $row['nokk'];?>&ket=<?php echo $row['sisa'];?>','MyWindow','height=400,width=500');"><?php echo $row['nokk'];?></a></td>
    <td><?php echo trim($myBlk1['no_lot']);?></td>
    <td align="right"><?php 
	echo $myro['tot_rol'];
	?></td>
    <td align="right"><?php 
	echo number_format($myro['grd_ab'],'2','.',',');?></td>
    <td align="right"><?php 
	echo number_format($myro['grd_c'],'2','.',',');
	?></td>
    <td><?php if($row['sisa']=="SISA" || $row['sisa']=="FKSI"){echo "SISA";}?></td>
    <td align="right"><?php 
	if($myro['satuan']=="PCS"){echo number_format($myro['netto'])." ".$myro['satuan'];}else{
	echo number_format($myro['tot_yard'],'2','.',',')." ".$myro['satuan'];} ?></td>
    <td><input class="input1" name="tempat[<?php echo $i;?>]" type="hidden" value="<?php echo $myBlk['blok'];?>" >
    <input name="nokk" type="hidden" value="<?php echo $row['nokk'];?>"><a href="#"onClick="window.open('tempat-persediaan.php?id=<?php echo $row['id_stok'];?>&nokk=<?php echo $row['nokk'];?>&ket=<?php echo $row['sisa'];?>','MyWindow','height=200,width=500');"><?php 
	if($myBlk['tempat']!=""){echo $myBlk['tempat'];}else if($row['blok']!=""){echo $row['blok'];}else{echo "N/A";}?></a></td>
    <td><?php if($myro['sisa']=="FOC"){echo "EXTRA FULL";}?></td>
    <td><?php echo $myBlk1['lebar'];?></td>
    <td>X</td>
    <td><?PHP echo $myBlk1['berat']; ?></td>
    <td>&nbsp;</td>
    <td align="center"><?php  $i++; ?></td>
  </tr>
 
      <?php
	}
	  	 if($myro['sisa']=="SISA" || $myro['sisa']=="FKSI" || $myro['sisa']=="FOC"){$brtoo=0;}else{$brtoo=number_format($row['bruto'],'2','.',',');}
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
	  $no++;
	  }
	  
	  
  ?></tbody>
     <tfoot>
      <tr bgcolor="#99FFFF">
        <td>&nbsp;</td>
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
        <td>&nbsp;</td>
        <td></td>
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
    <td></td>
    <td></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>PCS</td>
    <td align="right"><?php echo number_format($totrolp); ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td></td>
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
    <td>&nbsp;</td>
    <td>Meter</td>
    <td align="right"><?php echo number_format($totrolm); ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Meter</td>
    <td align="right"><?php echo number_format($kartot,'2','.',','); ?></td>
    <td>&nbsp;</td>
    <td align="right"><?php echo number_format($totpcs); ?></td>
    <td>PCS</td>
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
    <td>&nbsp;</td>
    <td>Yard</td>
    <td align="right"><?php echo  number_format($totroly);?></td>
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
    <td>&nbsp;</td>
    <td><b>Total</b></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="right"><b><?php echo $totrol;?></td>
    <td align="right"><b><?php echo number_format($totab,'2','.',',');?></b></td>
    <td align="right"><b><?php echo number_format($tota,'2','.',',');?></b></td>
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
 <b>( Roll : <?php echo  number_format($totrol);  ?> ) (GRADE A+B: <?php echo  number_format($totab,'2','.',',');  ?> Kg, Roll: <?php echo  number_format($rolab);  ?>)  (GRADE C: <?php echo  number_format($tota,'2','.',',');  ?> Kg, Roll: <?php echo  number_format($rolac);  ?>) (TOTAL : <?php echo  number_format($totab+$tota,'2','.',',');  ?> Kg) </b>


                            
                            
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
