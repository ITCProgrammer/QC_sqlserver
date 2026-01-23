<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script>
function ganti()
{     var lprn= document.forms['form1']['lprn'].value;  
if(lprn=="KAIN"){
	window.location.href="index1.php?p=packing_list";
	}
if(lprn=="KAIN-EXPORT"){
	window.location.href="index1.php?p=packing_list_export";
	}
	if(lprn=="KRAH-EXPORT"){
	window.location.href="index1.php?p=packing_list_krah_export";
	}
}

function myFungsi() {
                var no_ref= document.forms['form1']['no_list'].value;
				var partners= document.forms['form1']['langgan'].value;
				
                if(no_ref==null || no_ref=="")
                    {
                        alert("No Ref Belum di Input!!!");
                        return false;
                    }
				if(partners==null || partners=="" )
                    {
                        alert("Pelanggan Belum diPilih!!!");
                        return false;
                    }
					if($("input:checked").length > 0)
    				{ } else {
        		alert("Anda Belum ceklist data");
        		return false;
    			}		
}	
function checkAll(form1){
    for (var i=0;i<document.forms['form1'].elements.length;i++)
    {
        var e=document.forms['form1'].elements[i];
        if ((e.name !='allbox') && (e.type=='checkbox'))
        {
            e.checked=document.forms['form1'].allbox.checked;
			
        }
    }
}


           </script> 
</head>

<body>
<form id="form1" name="form1" method="POST" action="pages/simpan_packing_list.php" onsubmit="return myFungsi()">
<?php
function listurut(){
//include("koneksi.php");	
$con=sqlsrv_connect("10.0.0.10","dit","4dm1n","db_qc");	
date_default_timezone_set("Asia/Jakarta");
$format = date("y");
$sqlnu=sqlsrv_query($con,"SELECT listno FROM packing_list WHERE substr(listno,1,2) like '%".$format."%' ORDER BY listno DESC LIMIT 1 ") or die (mysql_error());
$d=sqlsrv_num_rows($sqlnu);
if($d>0){
$r=sqlsrv_fetch_array($sqlnu);
$d=$r['listno'];
$str=substr($d,2,5);
$Urut = (int)$str;
}else{
$Urut = 0;
}
$Urut = $Urut + 1;
$Nol="";
$nilai=5-strlen($Urut);
for ($i=1;$i<=$nilai;$i++){
$Nol= $Nol."0";
}
$nipbr =$format.$Nol.$Urut;
return $nipbr;
}
$nou=listurut();
if($_GET['nokk']!='')
	{ $where.= " AND `tbl_kite`.`nokk`='$_GET[nokk]'"; 
		}else{ $where.= " "; }
if($_GET['nopo']!='')
	{ $where1.= " AND `tbl_kite`.`no_po`='$_GET[nopo]'"; 
		}else{ $where1.= " "; }
	$sql="SELECT `detail_kite`.`id` as kd,`detail_kite`.`sisa`,`detail_kite`.`grade`,`detail_kite`.`nokkKite`,`detail_kite`.`no_roll`,`detail_kite`.`net_wight`,`detail_kite`.`yard_`,`detail_kite`.`satuan`,`tbl_kite`.`no_warna`,`tbl_kite`.`warna`,`tbl_kite`.`no_lot`,`tbl_kite`.`pelanggan`
FROM `tbl_kite`
INNER JOIN `detail_kite` ON `tbl_kite`.`nokk` = `detail_kite`.`nokkKite` where  `tbl_kite`.`no_order`='$_GET[dono]'".$where.$where1."
group by `detail_kite`.`nokkkite`,`detail_kite`.`no_roll`
order by `detail_kite`.`nokkkite`,`detail_kite`.`no_roll` asc";
$data=sqlsrv_query($con,$sql);
$sqlrd="SELECT *
FROM `tbl_kite`
INNER JOIN `detail_kite` ON `tbl_kite`.nokk = `detail_kite`.nokkKite where  `tbl_kite`.nokk='$_GET[nokk]' limit 1";
$datard=sqlsrv_query($con,$sqlrd);
$rd2=sqlsrv_fetch_array($datard);
$slgn=sqlsrv_query($con,"SELECT `detail_kite`.`id` as kd,`detail_kite`.`sisa`,`detail_kite`.`grade`,`detail_kite`.`nokkKite`,`detail_kite`.`no_roll`,`detail_kite`.`net_wight`,`detail_kite`.`yard_`,	`tbl_kite`.`no_warna`,`tbl_kite`.`warna`,`tbl_kite`.`no_lot`,`tbl_kite`.`pelanggan`
FROM `tbl_kite`
INNER JOIN `detail_kite` ON `tbl_kite`.`nokk` = `detail_kite`.`nokkKite` where  `tbl_kite`.`no_order`='$_GET[dono]' group by `detail_kite`.`nokkkite`,`detail_kite`.`no_roll`
order by `detail_kite`.`nokkkite`,`detail_kite`.`no_roll` asc");
$rg=sqlsrv_fetch_array($slgn);
$nou=listurut(); ?>
<table width="100%" border="0">
  <tr>
    <th height="22" colspan="6" scope="row">&nbsp;</th>
  </tr>
  <tr>
    <th colspan="6" scope="row">Packing LIST</th>
  </tr>
  <tr>
    <th colspan="6" scope="row">&nbsp;</th>
  </tr>
  <tr>
    <th scope="row" align="right">Mutasi Keluar</th>
    <td>:</td>
    <td><label for="select"></label>
      <select name="lprn" onchange="ganti()" >
     	 <option value="KRAH" selected="selected">Krah-Manset</option>
        <option value="KAIN" >Kain</option>
        <option value="KAIN-EXPORT" >Kain-EXPORT</option>
                
      </select></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <th scope="row" align="right">No Order</th>
    <td>:</td>
    <td><input name="dono" type="text" id="dono" onchange="window.location='index1.php?p=packing_list_krah&amp;dono='+this.value"  value="<?php echo $_GET['dono'];?>" size="20" tabindex="1"/>
      *</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <th width="15%" scope="row" align="right">Po No</th>
    <td width="1%">:</td>
    <td width="33%"><select name="nopo"  onchange="window.location='index1.php?p=packing_list_krah&amp;dono=<?php echo $_GET['dono'];?>&amp;nopo='+this.value" tabindex="3">
      <option value="">PILIH</option>
      <?php $sqlnopo=sqlsrv_query($con,"SELECT trim(no_po) as no_po
FROM `tbl_kite`
WHERE `tbl_kite`.`no_order` = '$_GET[dono]'
GROUP BY no_po");
while($rp=sqlsrv_fetch_array($sqlnopo)){?>
      <option value="<?php echo str_replace("'", "''",$rp['no_po']);?>" <?php if($rp['no_po']==$_GET['nopo']){echo "SELECTED";}?>><?php echo str_replace("'", "''",$rp['no_po']);?></option>
      <?php  } ?>      
    </select></td>
    <td width="12%">&nbsp;</td>
    <td width="1%">&nbsp;</td>
    <td width="38%">* wajib di isi</td>
  </tr>
  <tr>
    <th height="26" align="right" valign="top" scope="row">No KK 1</th>
    <td>:</td>
    <td colspan="4"><select name="nokk"  onchange="window.location='index1.php?p=packing_list_krah&dono=<?php echo $_GET['dono'];?>&nopo=<?php echo $_GET['nopo']; ?>&nokk='+this.value" tabindex="4">
      <option value="">PILIH</option>
      <?php 
	   $snkk1=sqlsrv_query($con,"SELECT
	count(detail_pergerakan_stok.weight) AS roll,
	sum(detail_pergerakan_stok.weight) AS berat,
	sum(detail_pergerakan_stok.yard_) AS yard
FROM
pergerakan_stok
INNER JOIN detail_pergerakan_stok ON pergerakan_stok.id = detail_pergerakan_stok.id_stok
INNER JOIN tmp_detail_kite ON tmp_detail_kite.id = detail_pergerakan_stok.id_detail_kj
INNER JOIN tbl_kite ON tbl_kite.id = tmp_detail_kite.id_kite
WHERE
	detail_pergerakan_stok.nokk = '$_GET[nokk]'
AND typestatus = '2'
AND detail_pergerakan_stok.sisa != 'FKTH'
AND detail_pergerakan_stok.sisa != 'TH'");
$rowkk1=sqlsrv_fetch_array($snkk1);
	  $sqlnokk=sqlsrv_query($con,"SELECT nokk
FROM `tbl_kite` where `tbl_kite`.no_order='$_GET[dono]' group by nokk");
while($rk=sqlsrv_fetch_array($sqlnokk)){?>     
      <option value="<?php echo $rk['nokk'];?>" <?php if($rk['nokk']==$_GET['nokk']){echo "SELECTED";}?>><?php echo $rk['nokk'];?></option>
	 <?php  } ?>	
    </select> <b>Total Roll <?php echo $rowkk1['roll']; ?>  ,Total Berat <?php echo $rowkk1['berat']; ?> Kg, Total Yard <?php echo $rowkk1['yard']; ?> </b></td>
  </tr>
  <tr>
    <th height="26" align="right" valign="top" scope="row">No KK 2</th>
    <td>:</td>
    <td colspan="4"><select name="nokk2"  onchange="window.location='index1.php?p=packing_list_krah&dono=<?php echo $_GET['dono'];?>&nopo=<?php echo $_GET['nopo']; ?>&nokk=<?php echo $_GET['nokk'];?>&nokk2='+this.value" tabindex="4">
      <option value="">PILIH</option>
      <?php 
	  $snkk2=sqlsrv_query($con,"SELECT
	count(detail_pergerakan_stok.weight) AS roll,
	sum(detail_pergerakan_stok.weight) AS berat,
	sum(detail_pergerakan_stok.yard_) AS yard
FROM
pergerakan_stok
INNER JOIN detail_pergerakan_stok ON pergerakan_stok.id = detail_pergerakan_stok.id_stok
INNER JOIN tmp_detail_kite ON tmp_detail_kite.id = detail_pergerakan_stok.id_detail_kj
INNER JOIN tbl_kite ON tbl_kite.id = tmp_detail_kite.id_kite
WHERE
	detail_pergerakan_stok.nokk = '$_GET[nokk2]'
AND typestatus = '2'
AND detail_pergerakan_stok.sisa != 'FKTH'
AND detail_pergerakan_stok.sisa != 'TH'");
$rowkk2=sqlsrv_fetch_array($snkk2);
	  $sqlnokk=sqlsrv_query($con,"SELECT nokk
FROM `tbl_kite` where `tbl_kite`.no_order='$_GET[dono]' group by nokk");
while($rk=sqlsrv_fetch_array($sqlnokk)){?>
      <option value="<?php echo $rk['nokk'];?>" <?php if($rk['nokk']==$_GET['nokk2']){echo "SELECTED";}?>><?php echo $rk['nokk'];?></option>
      <?php  } ?>
    </select>
      <b>Total Roll <?php echo $rowkk2['roll']; ?> ,Total Berat <?php echo $rowkk2['berat']; ?> Kg, Total Yard <?php echo $rowkk2['yard']; ?></b></td>
  </tr>
  <tr>
    <th height="26" align="right" valign="top" scope="row">No KK 3</th>
    <td>:</td>
    <td colspan="4"><select name="nokk3"  onchange="window.location='index1.php?p=packing_list_krah&dono=<?php echo $_GET['dono'];?>&nopo=<?php echo $_GET['nopo']; ?>&nokk=<?php echo $_GET['nokk'];?>&nokk2=<?php echo $_GET['nokk2'];?>&nokk3='+this.value" tabindex="4">
      <option value="">PILIH</option>
      <?php 
	  $snkk3=sqlsrv_query($con,"SELECT
	count(detail_pergerakan_stok.weight) AS roll,
	sum(detail_pergerakan_stok.weight) AS berat,
	sum(detail_pergerakan_stok.yard_) AS yard
FROM
pergerakan_stok
INNER JOIN detail_pergerakan_stok ON pergerakan_stok.id = detail_pergerakan_stok.id_stok
INNER JOIN tmp_detail_kite ON tmp_detail_kite.id = detail_pergerakan_stok.id_detail_kj
INNER JOIN tbl_kite ON tbl_kite.id = tmp_detail_kite.id_kite
WHERE
	detail_pergerakan_stok.nokk = '$_GET[nokk3]'
AND typestatus = '2'
AND detail_pergerakan_stok.sisa != 'FKTH'
AND detail_pergerakan_stok.sisa != 'TH'");
$rowkk3=sqlsrv_fetch_array($snkk3);
	  
	  $sqlnokk=sqlsrv_query($con,"SELECT nokk
FROM `tbl_kite` where `tbl_kite`.no_order='$_GET[dono]' group by nokk");
while($rk=sqlsrv_fetch_array($sqlnokk)){?>
      <option value="<?php echo $rk['nokk'];?>" <?php if($rk['nokk']==$_GET['nokk3']){echo "SELECTED";}?>><?php echo $rk['nokk'];?></option>
      <?php  } ?>
    </select>
      <b>Total Roll <?php echo $rowkk3['roll']; ?> ,Total Berat <?php echo $rowkk3['berat']; ?> Kg, Total Yard <?php echo $rowkk3['yard']; ?></b></td>
  </tr>
  <tr>
    <th height="26" align="right" valign="top" scope="row">No KK 4</th>
    <td>:</td>
    <td colspan="4"><select name="nokk4"  onchange="window.location='index1.php?p=packing_list_krah&dono=<?php echo $_GET['dono'];?>&nopo=<?php echo $_GET['nopo']; ?>&nokk=<?php echo $_GET['nokk'];?>&nokk2=<?php echo $_GET['nokk2'];?>&nokk3=<?php echo $_GET['nokk3'];?>&nokk4='+this.value" tabindex="4">
      <option value="">PILIH</option>
      <?php 
	  $snkk4=sqlsrv_query($con,"SELECT
	count(detail_pergerakan_stok.weight) AS roll,
	sum(detail_pergerakan_stok.weight) AS berat,
	sum(detail_pergerakan_stok.yard_) AS yard
FROM
pergerakan_stok
INNER JOIN detail_pergerakan_stok ON pergerakan_stok.id = detail_pergerakan_stok.id_stok
INNER JOIN tmp_detail_kite ON tmp_detail_kite.id = detail_pergerakan_stok.id_detail_kj
INNER JOIN tbl_kite ON tbl_kite.id = tmp_detail_kite.id_kite
WHERE
	detail_pergerakan_stok.nokk = '$_GET[nokk4]'
AND typestatus = '2'
AND detail_pergerakan_stok.sisa != 'FKTH'
AND detail_pergerakan_stok.sisa != 'TH'");
$rowkk4=sqlsrv_fetch_array($snkk4);
	  
	  $sqlnokk=sqlsrv_query($con,"SELECT nokk
FROM `tbl_kite` where `tbl_kite`.no_order='$_GET[dono]' group by nokk");
while($rk=sqlsrv_fetch_array($sqlnokk)){?>
      <option value="<?php echo $rk['nokk'];?>" <?php if($rk['nokk']==$_GET['nokk4']){echo "SELECTED";}?>><?php echo $rk['nokk'];?></option>
      <?php  } ?>
    </select>
      <b>Total Roll <?php echo $rowkk4['roll']; ?> ,Total Berat <?php echo $rowkk4['berat']; ?> Kg, Total Yard <?php echo $rowkk4['yard']; ?></b></td>
  </tr>
  <?php if($_SESSION['password']=='ppc'){ ?>
  <tr>
    <th scope="row" align="right" valign="top">No List</th>
    <td>:</td>
    <td colspan="4">
      <input type="text" name="no_list" id="no_list"  tabindex="2" value="<?php echo $nou;?>"/>
*
</td>
  </tr><?php } ?>
  <tr>
    <th scope="row" align="right" valign="top">Langganan</th>
    <td>:</td>
    <td colspan="4"><select name="langgan" tabindex="5">
      <option value="<?php echo $rg['pelanggan']; ?>" selected="selected"><?php echo $rg['pelanggan']; ?></option>
      <?php
	$sqlw2="select id,LTRIM(RTRIM(partnername)) as partnername   from partners";
$dataw2=sqlsrv_query($conn,$sqlw2); ?>
      <?php 
	  
	  while ($rw2=sqlsrv_fetch_array($dataw2,SQLSRV_FETCH_ASSOC)){ ?>
      <option value="<?php echo $rw2['id']; ?>"><?php echo $rw2['partnername']; ?></option>
      <?php  } ?>
    </select>
*</td>
  </tr>   
</table>
<div align="center"> DETAIL DATA</div>
<table width="100%" border="1">
    <tr>
      <th width="42" bgcolor="#9966CC" scope="col">No</th>
      <th width="163" bgcolor="#9966CC" scope="col">Nokk</th>
      <th width="69" bgcolor="#9966CC" scope="col">SN</th>
      <th width="69" bgcolor="#9966CC" scope="col">No Warna/Warna</th>
      <th width="69" bgcolor="#9966CC" scope="col">LOT</th>
      <th width="69" bgcolor="#9966CC" scope="col">No Roll</th>
      <th width="75" bgcolor="#9966CC" scope="col">Netto (KG)</th>
      <th width="77" bgcolor="#9966CC" scope="col">PCS</th>
      <th width="77" bgcolor="#9966CC" scope="col">Ukuran</th>
      <th width="77" bgcolor="#9966CC" scope="col">GRADE</th>
      <th width="77" bgcolor="#9966CC" scope="col">KET</th>
      <th width="60" bgcolor="#9966CC" scope="col">
        <label for="checkbox"></label>
      <input type="checkbox" name="allbox" value="check" onClick="checkAll(0);" /><font color="red">Check ALL</font></th>
    </tr>
   <?php
   if($_GET['dono']!='')
	{ $cwhere2.= $_GET['dono']; 
		}else{ $cwhere2.="null"; }
	if($_GET['nokk']!='')
	{ $cwhere.= " AND (detail_pergerakan_stok.nokk ='$_GET[nokk]' AND detail_pergerakan_stok.`status`='1') "; 
		}else{ $cwhere.= " "; }
	if($_GET['nokk2']!='')
	{ $cwherek2.= " OR (detail_pergerakan_stok.nokk ='$_GET[nokk2]' AND detail_pergerakan_stok.`status`='1') "; 
		}else{ $cwherek2.= " "; }	
	if($_GET['nokk3']!='')
	{ $cwherek3.= " OR (detail_pergerakan_stok.nokk ='$_GET[nokk3]' AND detail_pergerakan_stok.`status`='1')"; 
		}else{ $cwherek3.= " "; }	
	if($_GET['nokk4']!='')
	{ $cwherek4.= " OR (detail_pergerakan_stok.nokk ='$_GET[nokk4]' AND detail_pergerakan_stok.`status`='1')";}else{ $cwherek4.= " "; }				
if($_GET['nopo']!='')
	{ $cwhere1.= " AND `tbl_kite`.`no_po`='$_GET[nopo]'"; 
		}else{ $cwhere1.= " "; }
   $datacek=sqlsrv_query($con,"SELECT
	*, detail_pergerakan_stok.id AS kd
FROM
	pergerakan_stok
INNER JOIN detail_pergerakan_stok ON pergerakan_stok.id = detail_pergerakan_stok.id_stok
INNER JOIN tmp_detail_kite ON tmp_detail_kite.id = detail_pergerakan_stok.id_detail_kj
INNER JOIN tbl_kite ON tbl_kite.id = tmp_detail_kite.id_kite
WHERE
	(detail_pergerakan_stok.sisa !='FKTH' AND detail_pergerakan_stok.sisa !='TH' AND typestatus='2' AND detail_pergerakan_stok.`status`='1' AND ISNULL(detail_pergerakan_stok.`refno`)
AND `tbl_kite`.`no_order`='".$cwhere2."'
 )".$cwhere.$cwherek2.$cwherek3.$cwherek4." ".$cwhere1."
 GROUP BY tmp_detail_kite.id
  ORDER BY
	`detail_pergerakan_stok`.`nokk`,
	`detail_pergerakan_stok`.`no_roll` ASC");
	$no=1;
	$n=1;
	$c=0;
	 while($rowd=sqlsrv_fetch_array($datacek)){ 
		 $cek=sqlsrv_query($con,"select * from detail_pergerakan_stok 
		  where id='$rowd[kd]' and refno!=''");
		   $crow=sqlsrv_fetch_array($cek);
		    $bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99';
			if($_SESSION['password']=='user'){$crow=0;}
	  if($crow>0){}else{
		 ?> 
    
    <tr bgcolor="<?php echo $bgcolor;?>">
      <td align="center" ><?php echo $no; ?></td>
      <td align="center" ><?PHP echo $rowd['nokk']; ?></td>
      <td align="center" ><?PHP echo $rowd['SN']; ?></td>
      <td align="center" ><?PHP echo $rowd['no_warna']; ?> / <?PHP echo $rowd['warna']; ?></td>
      <td align="center" ><?PHP echo $rowd['no_lot']; ?></td>
      <td align="center" ><?PHP echo $rowd['no_roll']; ?></td>
      <td align="center" ><?PHP echo number_format($rowd['weight'],'2','.',','); ?></td>
      <td align="center" ><?PHP echo $rowd['netto']; ?></td>
      <td align="center" ><?PHP echo $rowd['ukuran']; ?></td>
      <td align="center" ><?PHP echo $rowd['grade']; ?></td>
      <td align="center" ><?PHP echo $rowd['sisa']; ?></td>
      <td align="center" ><?php 
     echo '<input type="checkbox" name="check['.$n.']" value="'.$rowd['kd'].'"';
  $n++;
   ?> 
     </td>
    </tr>
  <?php 
	$totalyard=$totalyard+$rowd['yard_'];
	$totalqty=$totalqty+$rowd['weight'];
	$no++; } }?>
    <p align="right"><font color="red">
    <b>Total Yard : <?php echo $totalyard; ?></b><br />
    <b>Total Qty : <?php echo $totalqty; ?></b> <br />
     <b>Total Qty yang di ceklist: <label id="result_label">0</label></b></font></p>
    
    
  </table>
  <?php if($_SESSION['password']=='ppc01' or $_SESSION['password']=='ppc1' or $_SESSION['password']=='ppc2' or $_SESSION['password']=='ppc3'){ ?>
  <?php if($_GET['dono']!=''){?>
  <input name="submit" type="submit" value="SIMPAN">
  <?php }?>
  <a href="index1.php?p=cetak_list">LIHAT LIST SURAT JALAN</a>
   <?php }?>
</form>
</body>
</html>
<?php sqlsrv_close($con) ?>