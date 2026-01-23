<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
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
<script>
function ganti()
{     var lprn= document.forms['form1']['lprn'].value;  
if(lprn=="KRAH"){
	window.location.href="index1.php?p=packing_list_krah";
	}
	if(lprn=="KAIN"){
	window.location.href="index1.php?p=packing_list";
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
<?php
 //$ip_num = $_SERVER['REMOTE_ADDR']; //untuk mendeteksi alamat IP
 //$host_name = gethostbyaddr($_SERVER['REMOTE_ADDR']); //untuk mendeteksi computer name
 
 //echo"Alamat IP : $ip_num";
 //echo"<br />";
 //echo"Nama Komputer : $host_name";
?>
<form id="form1" name="form1" method="POST" action="pages/simpan_packing_list_export.php" onsubmit="return myFungsi()">
<?php
function listurut(){
include("koneksi.php");	
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
     	 <option value="KAIN" >Kain</option>
        <option value="KRAH" >Krah-Manset</option>
        <option value="KAIN-EXPORT" selected="selected">Kain-EXPORT</option>
                
      </select></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <th scope="row" align="right">No Order</th>
    <td>:</td>
    <td><input name="dono" type="text" id="dono" onchange="window.location='index1.php?p=packing_list_export&amp;dono='+this.value"  value="<?php echo $_GET['dono'];?>" size="20" tabindex="1"/>
      *</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <th width="15%" scope="row" align="right">Buyer</th>
    <td width="1%">:</td>
    <td width="33%"><select name="langgan" tabindex="5" onchange="window.location='index1.php?p=packing_list_export&amp;dono=<?php echo $_GET['dono'];?>&amp;lgn='+this.value">
    <option value="">PILIH</option>
      <?php $sqllanggan=sqlsrv_query($con,"SELECT trim(pelanggan) as langgan
FROM `tbl_kite`
WHERE `tbl_kite`.`no_order` = '$_GET[dono]'
GROUP BY pelanggan");
while($rp=sqlsrv_fetch_array($sqllanggan)){?>
     <option value="<?php echo $rp['langgan'];?>" <?php if($rp['langgan']==$_GET['lgn']){echo"selected";}?>><?php echo $rp['langgan'];?></option>
      <?php  } ?>
    </select>
*</td>
    <td width="12%">&nbsp;</td>
    <td width="1%">&nbsp;</td>
    <td width="38%">* wajib di isi</td>
  </tr>
  <?php if($_SESSION['password']=='ppc01' or $_SESSION['password']=='exim'){ ?>
  <tr>
    <th scope="row" align="right" valign="top">No PO</th>
    <td>:</td>
    <td colspan="4"><select name="nopo"  onchange="window.location='index1.php?p=packing_list_export&amp;dono=<?php echo $_GET['dono'];?>&amp;lgn=<?php echo $_GET['lgn']; ?>&amp;nopo='+this.value" tabindex="3">
      <option value="">PILIH</option>
      <?php $sqlnopo=sqlsrv_query($con,"SELECT id,trim(no_po) as no_po,nokk
FROM `tbl_kite`
WHERE `tbl_kite`.`no_order` = '$_GET[dono]' AND  `tbl_kite`.`pelanggan` = '$_GET[lgn]'
GROUP BY id");
while($rp=sqlsrv_fetch_array($sqlnopo)){?>
      <option value="<?php echo $rp['id'];?>" <?php if($rp['id']==$_GET['nopo']){echo "SELECTED";}?>><?php echo $rp['no_po']." | ".$rp['nokk'];?></option>
      <?php  } ?>
     </select></td>
  </tr>
  <tr>
    <th scope="row" align="right" valign="top">No ITEM</th>
    <td>:</td>
    <td colspan="4"><select name="noitem"  onchange="window.location='index1.php?p=packing_list_export&amp;dono=<?php echo $_GET['dono'];?>&amp;lgn=<?php echo $_GET['lgn']; ?>&amp;nopo=<?php echo $_GET['nopo'];?>&amp;noitem='+this.value" tabindex="4">
      <option value="">PILIH</option>
      <?php $sqlnoitem=sqlsrv_query($con,"SELECT trim(no_item) as no_item
FROM `tbl_kite`
WHERE `tbl_kite`.`no_order` = '$_GET[dono]' AND  `tbl_kite`.`pelanggan` = '$_GET[lgn]' AND  `tbl_kite`.`id` = '$_GET[nopo]'
GROUP BY no_item ");
while($rp=sqlsrv_fetch_array($sqlnoitem)){?>
      <option value="<?php echo str_replace("'", "''",$rp['no_item']);?>" <?php if($rp['no_item']==$_GET['noitem']){echo"SELECTED";}?>><?php echo str_replace("'", "''",$rp['no_item']);?></option>
      <?php  } ?>
      </select></td>
  </tr>
  <tr>
    <th scope="row" align="right" valign="top">Warna</th>
    <td>:</td>
    <td colspan="4"><select name="warna"  onchange="window.location='index1.php?p=packing_list_export&amp;dono=<?php echo $_GET['dono'];?>&amp;lgn=<?php echo $_GET['lgn']; ?>&amp;nopo=<?php echo $_GET['nopo'];?>&amp;noitem=<?php echo $_GET['noitem'];?>&amp;warna='+this.value" tabindex="5">
      <option value="">PILIH</option>
      <?php $sqlwarna=sqlsrv_query($con,"SELECT trim(warna) as warna
FROM `tbl_kite`
WHERE `tbl_kite`.`no_order` = '$_GET[dono]' AND  `tbl_kite`.`pelanggan` = '$_GET[lgn]' AND  `tbl_kite`.`id` = '$_GET[nopo]' AND  `tbl_kite`.`no_item` = '$_GET[noitem]'
GROUP BY warna ");
while($rp=sqlsrv_fetch_array($sqlwarna)){?>
      <option value="<?php echo str_replace("'", "''",$rp['warna']);?>" <?php  if($rp['warna']==$_GET['warna']){echo "SELECTED";}?>><?php echo str_replace("'", "''",$rp['warna']);?></option>
      <?php  } ?>
        </select></td>
  </tr>
  <tr>
    <th scope="row" align="right" valign="top">Lot</th>
    <td>:</td>
    <td colspan="4"><select name="lot"  onchange="window.location='index1.php?p=packing_list_export&amp;dono=<?php echo $_GET['dono'];?>&amp;lgn=<?php echo $_GET['lgn']; ?>&amp;nopo=<?php echo $_GET['nopo'];?>&amp;noitem=<?php echo $_GET['noitem'];?>&amp;warna=<?php echo $_GET['warna'];?>&amp;lot='+this.value" tabindex="6">
      <option value="">PILIH</option>
      <?php $sqllot=sqlsrv_query($con,"SELECT trim(no_lot) as no_lot
FROM `tbl_kite`
WHERE `tbl_kite`.`no_order` = '$_GET[dono]' AND  `tbl_kite`.`pelanggan` = '$_GET[lgn]' AND  `tbl_kite`.`id` = '$_GET[nopo]' AND  `tbl_kite`.`no_item` = '$_GET[noitem]' AND  `tbl_kite`.`warna` = '$_GET[warna]'
GROUP BY no_lot ");
while($rp=sqlsrv_fetch_array($sqllot)){?>
      <option value="<?php echo str_replace("'", "''",$rp['no_lot']);?>" <?php if($rp['no_lot']==$_GET['lot']){echo"SELECTED";}?>><?php echo str_replace("'", "''",$rp['no_lot']);?></option>
      <?php  } ?>
        </select></td>
  </tr>
  <tr>
    <th scope="row" align="right" valign="top">Pack</th>
    <td>:</td>
    <td colspan="4"><label for="pack"></label>
      <select name="pack" id="pack">
       <?php 
	   /* AND `tbl_kite`.`pelanggan` = '$_GET[byer]' */
	   $sqlpack=sqlsrv_query($con,"SELECT trim(no_mc) as no_mc,nokk
FROM `tbl_kite`
WHERE `tbl_kite`.`no_order` = '$_GET[dono]' AND `tbl_kite`.`no_po` like '%$_GET[nopo]%' AND `tbl_kite`.`no_item` = '$_GET[noitem]' AND `tbl_kite`.`warna` = '$_GET[warna]'
GROUP BY no_mc");
$pk=sqlsrv_fetch_array($sqlpack); 
?>
        <option value="" <?php if($_GET['warna']==""){echo "SELECTED";}?>>Pilih</option>
        <option value="ROLLS" <?php if(substr($pk['no_mc'],0,1)=="R"){echo "SELECTED";}?>>ROLLS</option>
        <option value="BALES" <?php if($_GET['warna']==""){}else{if(substr($pk['no_mc'],0,1)!="R"){echo "SELECTED";}}?>>BALES</option>
      </select>
      *</td>
  </tr>
  <tr>
    <th scope="row" align="right" valign="top">No List</th>
    <td>:</td>
    <td colspan="4">
      <input type="text" name="no_list" id="no_list"  tabindex="2" value=""/>
*
</td>
  </tr><?php } ?>
  <tr>
    <th scope="row" align="right" valign="top">&nbsp;</th>
    <td>&nbsp;</td>
    <td colspan="4">&nbsp;</td>
  </tr>   
</table>
<div align="center"> DETAIL DATA</div>
<table width="100%" border="1">
    <tr>
      <th width="42" bgcolor="#9966CC" scope="col">No</th>
      <th width="163" bgcolor="#9966CC" scope="col">Nokk</th>
      <th width="69" bgcolor="#9966CC" scope="col">PO</th>
      <th width="69" bgcolor="#9966CC" scope="col">ITEM</th>
      <th width="69" bgcolor="#9966CC" scope="col">No Warna/Warna</th>
      <th width="75" bgcolor="#9966CC" scope="col">LOT</th>
      <th width="77" bgcolor="#9966CC" scope="col">No Roll</th>
      <th width="77" bgcolor="#9966CC" scope="col">Netto (KG)</th>
      <th width="77" bgcolor="#9966CC" scope="col">Yard</th>
      <th width="77" bgcolor="#9966CC" scope="col">MEAS</th>
      <th width="77" bgcolor="#9966CC" scope="col">PCS</th>
      <th width="60" bgcolor="#9966CC" scope="col">POTONG</th>
      <th width="60" bgcolor="#9966CC" scope="col">
        <label for="checkbox"></label>
      <input type="checkbox" name="allbox" value="check" onClick="checkAll(0);" /><font color="red">Check ALL</font></th>
    </tr>
   <?php
if($_GET['dono']!='')
	{ $cwhere2.= $_GET['dono']; 
		}else{ $cwhere2.="null"; }
if($_GET['nopo']!='')
	{ $cwhere1.= " AND `tbl_kite`.`id`='$_GET[nopo]'"; 
		}else{ $cwhere1.= " "; }
if($_GET['noitem']!='')
	{ $cwhere10.= " AND `tbl_kite`.`no_item`='$_GET[noitem]'"; 
		}else{ $cwhere10.= " "; }
if($_GET['warna']!='')
	{ $cwhere11.= " AND `tbl_kite`.`warna`='$_GET[warna]'"; }else{ $cwhere11.= " "; }
if($_GET['lot']!='')
	{ $cwhere12.= " AND `tbl_kite`.`no_lot`='$_GET[lot]'"; }else{ $cwhere12.= " "; }
   $datacek=sqlsrv_query($con,"SELECT
	*, detail_pergerakan_stok.id AS kd
FROM
	pergerakan_stok
INNER JOIN detail_pergerakan_stok ON pergerakan_stok.id = detail_pergerakan_stok.id_stok
INNER JOIN tmp_detail_kite ON tmp_detail_kite.id = detail_pergerakan_stok.id_detail_kj
INNER JOIN tbl_kite ON tbl_kite.id = tmp_detail_kite.id_kite
WHERE
	(detail_pergerakan_stok.sisa !='FKTH' AND detail_pergerakan_stok.sisa !='TH' AND typestatus='2'
AND `tbl_kite`.`no_order`='".$cwhere2."'
 )".$cwhere1.$cwhere10.$cwhere11.$cwhere12." GROUP BY tmp_detail_kite.id  
 ORDER BY `pergerakan_stok`.`typestatus`,
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
      <td align="center" ><?PHP echo $rowd['no_po']; ?></td>
      <td align="center" ><?PHP echo $rowd['no_item']; ?></td>
      <td align="center" ><?PHP echo $rowd['no_warna']; ?> / <?PHP echo $rowd['warna']; ?></td>
      <td align="center" ><?PHP echo $rowd['no_lot']; ?></td>
      <td align="center" ><?PHP echo $rowd['no_roll']; ?></td>
      <td align="center" ><?PHP echo number_format($rowd['weight'],'2','.',','); ?></td>
      <td align="center" ><?PHP echo $rowd['yard_']; ?></td>
      <td align="center" ><?PHP echo $rowd['ukuran']; ?></td>
      <td align="center" ><?PHP echo $rowd['netto']; ?></td>
      <td align="center" ><input name="potong" type="button" value="..." onclick="NewWindow('pages/potong_kain.php?id=<?PHP echo $rowd['kd']; ?>&sn=<?PHP echo $rowd['SN']; ?>','MyWindow','width=150,height=220');"/></td>
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
  <?php if($_SESSION['password']=='ppc01' or $_SESSION['password']=='ppc1' or $_SESSION['password']=='ppc2' or $_SESSION['password']=='ppc3' or $_SESSION['password']=='exim'){ ?>
  <?php if($_GET['dono']!=''){?>
  <input name="submit" type="submit" value="SIMPAN">
  <?php }?>
  <a href="index1.php?p=cetak_list">LIHAT LIST SURAT JALAN</a>
   <?php }?>
</form>
</body>
</html>
<?php sqlsrv_close($con); ?>