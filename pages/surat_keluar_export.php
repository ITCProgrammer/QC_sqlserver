<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script>
function roundToTwo(num) {    
    return +(Math.round(num + "e+2")  + "e-2");
}   
           function ganti()
{     var lprn= document.forms['form1']['lprn'].value;  
if(lprn=="Krah-Manset"){
	window.location.href="index1.php?p=surat_keluar_krah";
	}
if(lprn=="Kain"){
	window.location.href="index1.php?p=surat_keluar";
	}
}
function myFungsi() {
                var no_ref= document.forms['form1']['no_ref'].value;
				
                if(no_ref==null || no_ref=="")
                    {
                        alert("No list Belum di Input!!!");
                        return false;
                    }
					
					        }
//check all checkbox
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

			var total = 0 ;
            function calculate (checkbox)
            {
                var resultLabel = document.getElementById ( "result_label" ) ;
                
 				var value = parseFloat(checkbox.value);
                if (checkbox.checked)
                    total += value ;
                else
                    total -= value ;
 
                resultLabel.innerHTML = total.toFixed(2);
            }
           </script> 
</head>

<body>
<form name="form1" action="pages/simpan_cetak_sj_export.php" method="post" onsubmit="return myFungsi();">
<?php
ini_set('error_reporting',1);
		
function listurut(){
include"koneksi.php";	
date_default_timezone_set("Asia/Jakarta");
$format = date("y");
$sqlnu=sqlsrv_query($con,"SELECT no_sj FROM packing_list WHERE substr(no_sj,1,2) like '%".$format."%' ORDER BY no_sj DESC LIMIT 1 ") or die (mysql_error());
$d=sqlsrv_num_rows($sqlnu);
if($d>0){
$r=sqlsrv_fetch_array($sqlnu);
$d=$r['no_sj'];
$str=substr($d,2,4);
$Urut = (int)$str;
}else{
$Urut = 0;
}
$Urut = $Urut + 1;
$Nol="";
$nilai=4-strlen($Urut);
for ($i=1;$i<=$nilai;$i++){
$Nol= $Nol."0";
}
$nipbr =$format.$Nol.$Urut;
return $nipbr;
}
$no=listurut();

?>
<?php 
	  
	  if($_GET['dono']!='')
	{ 
	$sqllist= sqlsrv_query($con,"SELECT listno from packing_list where `no_order`='".$_GET['dono']."' GROUP BY listno order by listno asc"); 
		
	}
	  ?>
<table width="100%" border="0">
  <tr>
    <th height="22" colspan="6" scope="row">&nbsp;</th>
    </tr>
  <tr>
    <th colspan="6" scope="row">SURAT JALAN</th>
    </tr>
  <tr>
    <th colspan="6" scope="row">&nbsp;</th>
    </tr>
  <tr>
    <th scope="row" align="right">Mutasi Keluar</th>
    <td>:</td>
    <td><label for="select"></label>
      <select name="lprn" onchange="ganti()">
      	  <option value="Export" selected="selected">Export</option>
     	 <option value="Kain" >Kain</option>
        <option value="Krah-Manset" >Krah-Manset</option>
        
      </select></td>
    <td align="right">Buyer</td>
    <td>:</td>
    <td><input name="buyer" type="text" id="buyer" size="30" /></td>
      <?php if($_GET['nosj']!='')
	{ 
	$sqltgl= sqlsrv_query($con,"SELECT `tgl_update` from packing_list where `no_sj`='".$_GET['nosj']."' and DATE_FORMAT(tgl_update,'%y')=DATE_FORMAT(NOW(),'%y') GROUP BY no_sj"); $rtgl=sqlsrv_fetch_array($sqltgl);
		
	}
	  ?>
    </tr>
  <tr>
    <th align="right" valign="top" scope="row">No Order</th>
    <td align="left" valign="top">:</td>
    <td align="left" valign="top"><textarea name="dono" cols="20" rows="3" id="dono" tabindex="1" onchange="window.location='index1.php?p=surat_keluar_export&amp;dono='+this.value"><?php echo $_GET['dono'];?></textarea>
      *</td>
    <td align="right" valign="top">Alamat</td>
    <td valign="top">:</td>
    <td><label for="alamat"></label>
      <textarea name="alamat" cols="20" rows="3" id="alamat"></textarea></td>
      
    </tr>
  <tr>
    <th align="right">No Surat Jalan</th>
    <td>:
      <label for="buyer"></label></td>
    <td><input name="ket" type="text" id="ket"  tabindex="2" onchange="window.location='index1.php?p=surat_keluar_export&amp;dono=<?php echo $_GET['dono']?>&amp;nosj='+this.value"  value="<?php echo $_GET['nosj'];?>" size="15"/>
*</td>
    <td align="right">Courier/Container </td>
    <td>:</td>
    <td><input name="kendaraan" type="text" id="kendaraan" size="30" /></td>
    </tr>
  <tr>
    <th scope="row" align="right" valign="top">No List</th>
    <td>:</td>
    <td><label for="tujuan">
      <input tabindex="3" onchange="window.location='index1.php?p=surat_keluar_export&amp;dono=<?php echo $_GET['dono']?>&amp;nosj=<?php echo $_GET['nosj']?>&amp;nolist='+this.value"  type="text" name="nolist" value="<?php echo $_GET['nolist'];?>" />
    *</label></td>
    <td align="right">Term Of Payment</td>
    <td>:</td>
    <td><label for="term"></label>
      <input type="text" name="term" id="term" />      
      <label for="kendaraan"></label></td>
  </tr>
  <tr>
    <th scope="row" align="right" valign="top">Tujuan</th>
    <td>:</td>
    <td><input name="tujuan" type="text" id="tujuan" size="30" /></td>
    <td align="right">Tgl Surat Jalan</td>
    <td>:</td>
    <td><input name="tglawal" type="text" id="tglawal" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.tglawal);return false;" size="20"/ value="<?php echo $rtgl['tgl_update'];?>" />
*
  <?php if($_GET['nolist']!=''){?>
  <input name="submit" type="submit" value="TAMBAH" />
  <?php }?></td>
  </tr>
  <tr>
  <th scope="row" align="right" valign="top">&nbsp;</th>
  <td>&nbsp;</td>
  <td colspan="4"> <label for="ket"></label>
    <label for="langgan">* wajib di isi</label></td>
</tr>   
</table>
<div align="center"> DETAIL DATA LIST</div>
  <table width="100%" border="1">
    <tr>
      <th width="20" rowspan="2" bgcolor="#9966CC" scope="col">No</th>
      <th colspan="4" bgcolor="#9966CC" scope="col">BANYAK</th>
      <th width="169" rowspan="2" bgcolor="#9966CC" scope="col">NAMA BARANG<div align="left"><?php echo $_GET['dono'];?></div></th>
      <th width="76" rowspan="2" bgcolor="#9966CC" scope="col">LAIN</th>
      <th width="76" rowspan="2" bgcolor="#9966CC" scope="col">AKSI</th>
    </tr>
    <tr>
      <th width="44" bgcolor="#9966CC" scope="col">ROLL</th>
      <th width="34" bgcolor="#9966CC" scope="col">KG</th>
      <th width="60" bgcolor="#9966CC" scope="col">YARD</th>
      <th width="60" bgcolor="#9966CC" scope="col">METER</th>
    </tr>
    
    <?php
	if($_GET['nolist']!='')
	{ 
	$sql= "SELECT *,count(detail_pergerakan_stok.no_roll) as roll,sum(detail_pergerakan_stok.weight) as _berat,sum(detail_pergerakan_stok.yard_) as _yard_ from packing_list 
LEFT JOIN detail_pergerakan_stok ON packing_list.listno=detail_pergerakan_stok.refno
LEFT JOIN tmp_detail_kite ON detail_pergerakan_stok.id_detail_kj=tmp_detail_kite.id
LEFT JOIN tbl_kite ON tmp_detail_kite.id_kite=tbl_kite.id
where packing_list.listno='".$_GET['nolist']."'
GROUP BY no_item,no_lot,no_warna,warna"; 
		
		$data=sqlsrv_query($con,$sql);
	$nb=1;
	$n=1;
	$c=0;
	 while($rowd=sqlsrv_fetch_array($data)){
		    $bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99';
	  {
		 ?>
    <tr bgcolor="<?php echo $bgcolor;?>">
      <td align="center" ><?php echo $nb; ?></td>
      <td align="center" ><?php echo $rowd['roll']; ?></td>
      <td align="center" ><?php echo number_format($rowd['_berat'],'2','.',','); ?></td>
      <td align="center" ><?php echo number_format($rowd['_yard_'],'2','.',','); ?></td>
      <td align="center" >&nbsp;</td>
      <td align="left" ><?php echo $rowd['no_item']."/".$rowd['jenis_kain']; ?>
        <table width="100%" border="0">
          <tr>
            <td><?php echo $rowd['no_warna']; ?></td>
            <td><?php echo $rowd['warna']; ?></td>
            <td><?php echo $rowd['lebar']; ?>"</td>
          </tr>
      </table></td>
      <td align="center" ><?php echo $rowd['no_lot']; ?></td>
      <td align="center" ><a href="?p=hapus_rlist&dono=<?php echo $_GET['dono'];?>&nosj=<?php echo $_GET['nosj'];?>&nolist=<?php echo $_GET['nolist'];?>&nokk=<?php echo $rowd['nokkKite']; ?>">HAPUS</a></td>
    </tr>
    <?php 
	$totalyard=$totalyard+$rowd['roll'];
	$totalqty=$totalqty+$rowd['_berat'];
	$nb++; } }}?>
    <p align="right"><font color="red">
    <b>Total ROLL : <?php echo $totalyard; ?></b><br />
    <b>Total BERAT : <?php echo $totalqty; ?></b> <br />
    </font></p>
    
    
  </table>
  
  <br />
<div align="center"> DETAIL DATA SURAT JALAN</div>
  <table width="100%" border="1">
    <tr>
      <th width="20" rowspan="2" bgcolor="#9966CC" scope="col">No</th>
      <th colspan="4" bgcolor="#9966CC" scope="col">BANYAK</th>
      <th width="169" rowspan="2" bgcolor="#9966CC" scope="col">NAMA BARANG<div align="left"><?php echo $_GET['dono'];?></div></th>
      <th width="76" rowspan="2" bgcolor="#9966CC" scope="col">LAIN</th>
      <th width="76" rowspan="2" bgcolor="#9966CC" scope="col">AKSI</th>
    </tr>
    <tr>
      <th width="44" bgcolor="#9966CC" scope="col">ROLL</th>
      <th width="34" bgcolor="#9966CC" scope="col">KG</th>
      <th width="60" bgcolor="#9966CC" scope="col">YARD</th>
      <th width="60" bgcolor="#9966CC" scope="col">METER</th>
    </tr>
    
    <?php
	if($_GET['nosj']!='')
	{ 
	$sql= "SELECT *,count(detail_pergerakan_stok.no_roll) as roll,sum(detail_pergerakan_stok.weight) as _berat,sum(detail_pergerakan_stok.yard_) as _yard_ ,packing_list.id as ids from packing_list 
LEFT JOIN detail_pergerakan_stok ON packing_list.listno=detail_pergerakan_stok.refno
LEFT JOIN tmp_detail_kite ON detail_pergerakan_stok.id_detail_kj=tmp_detail_kite.id
LEFT JOIN tbl_kite ON tmp_detail_kite.id_kite=tbl_kite.id
where packing_list.no_sj='".$_GET['nosj']."' and DATE_FORMAT(tgl_update,'%y')=DATE_FORMAT(NOW(),'%y')
GROUP BY no_item,no_lot,no_warna,warna"; 
		
		$data=sqlsrv_query($con,$sql);
	$nb=1;
	$n=1;
	$c=0;
	 while($rowd=sqlsrv_fetch_array($data)){
		    $bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99';
	  {
		 ?>
    <tr bgcolor="<?php echo $bgcolor;?>">
      <td align="center" ><?php echo $nb; ?></td>
      <td align="center" ><?php echo $rowd['roll']; ?></td>
      <td align="center" ><?php echo number_format($rowd['_berat'],'2','.',','); ?></td>
      <td align="center" ><?php echo number_format($rowd['_yard_'],'2','.',','); ?></td>
      <td align="center" >&nbsp;</td>
      <td align="left" ><?php echo $rowd['no_item']."/".$rowd['jenis_kain']; ?>
        <table width="100%" border="0">
          <tr>
            <td><?php echo $rowd['no_warna']; ?></td>
            <td><?php echo $rowd['warna']; ?></td>
            <td><?php echo $rowd['lebar']; ?>"</td>
          </tr>
      </table></td>
      <td align="center" ><?php echo $rowd['no_lot']; ?></td>
      <td align="center" ><a href="pages/hapus_sj.php?id=<?php echo $rowd['ids']?>&dono=<?php echo $_GET['dono']; ?>&nosj=<?php echo $_GET['nosj'];?>">HAPUS</a></td>
    </tr>
    <?php 
	$totalyard=$totalyard+$rowd['roll'];
	$totalqty=$totalqty+$rowd['_berat'];
	$nb++; } }}?>
    <p align="right"><font color="red">
    <b>Total ROLL : <?php echo $totalyard; ?></b><br />
    <b>Total BERAT : <?php echo $totalqty; ?></b> <br />
    </font></p>
    
    
  </table>
  <input name="cetak" type="button" value="Lihat LIST" onclick="window.location.href='index1.php?p=cetak_list'" />
  <input name="cetak" type="button" value="Lihat Surat Jalan" onclick="window.location.href='index1.php?p=cetak_list_sj'" /> 
  <a href="pages/cetak_surat_jalan_export.php?no_sj=<?php echo $_GET['nosj']; ?>" target="_blank">Cetak Surat Jalan </a>
  <a href="?p=surat_keluar&amp;po=<?php echo $myData['nopo']; ?>&amp;kd=<?php echo $Kode; ?>#popup"></a>
</form>


</body>
</html>
<?php sqlsrv_close($con); ?>