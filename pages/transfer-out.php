<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Transfer Out</title>
<?php ini_set("error_reporting",1); ?>
<script type="text/javascript"> 
//check all checkbox
function checkAll(form){
    for (var i=0;i<document.forms[form].elements.length;i++)
    {
        var e=document.forms[form].elements[i];
        if ((e.name !='allbox') && (e.type=='checkbox'))
        {
            e.checked=document.forms[form].allbox.checked;
        }
    }
}
            function myFungsi() {
				var partners = document.forms['form1']['partners'].value;
				var ket = document.forms['form1']['catatan'].value;
					if(partners==null || partners=="" )
                    {
                        alert("Tansfer Ke Belum diPilih!!!");
                        return false;
                    }else
					if(ket==null || ket=="" )
                    {
                        alert("KETERANGAN Ke Belum diPilih!!!");
                        return false;
                    }
					if($('input:checked').length > 0)
    				{ alert("Anda Belum ceklist data");
        		return false; } else {
        		alert("Anda Belum ceklist data");
        		return false;
    			}	
					
					        }
				

</script>
</head>
<?php 

function mutasiurut(){
//include "koneksi.php";	
$con=sqlsrv_connect("10.0.0.10","dit","4dm1n","db_qc");		
date_default_timezone_set("Asia/Jakarta");
$format = date("y");
$sql=sqlsrv_query($con,"SELECT no_dok FROM pergerakan_stok WHERE substr(no_dok,1,2) like '%".$format."%' ORDER BY no_dok DESC LIMIT 1 ") or die (mysql_error());
$d=sqlsrv_num_rows($sql);
if($d>0){
$r=sqlsrv_fetch_array($sql);
$d=$r['no_dok'];
$str=substr($d,2,6);
$Urut = (int)$str;
}else{
$Urut = 0;
}
$Urut = $Urut + 1;
$Nol="";
$nilai=6-strlen($Urut);
for ($i=1;$i<=$nilai;$i++){
$Nol= $Nol."0";
}
$nipbr =$format.$Nol.$Urut;
return $nipbr;
}
$nou=mutasiurut();
?>
<body>

<form  action="pages/simpan-detail-out.php" method="POST" name="form1" id="form1"  onSubmit="return myFungsi();">
 <div align="center">
  <h1>TRANSFET OUT</h1></div><hr />
 <fieldset>
 <legend>Data Pokok</legend>
 GROUP SHIFT: <strong><?php echo $_SESSION['username']; ?></strong><input type="hidden" name="user_name" value="<?php echo $_SESSION['username']; ?>" />
  <table width="100%" border="0">
    <tr>
      <td colspan="6">      
      TGL:
        <?PHP 
	$tgl1=date("Y-M-d H:i:s");
	
	  echo $tgl1; 
	
	
	  ?>
     
        
        <input type="hidden" name="no_dok" value="<?php echo $nou; ?>" />
        
      
        <table width="624" border="0">
          <tr>
            <td width="132">NO KK</td>
            <td width="10">:</td>
            <td width="468"><input name="nokk" type="text"  onchange="window.location='?p=transfer-out&kkno='+this.value"  value="<?php echo $_GET['kkno'];?>"  tabindex="1"/></td>
           <?php $cari2=sqlsrv_query($con,"Select * from `db_qc`.`tbl_kite` 
inner join `db_qc`.`tmp_detail_kite` on `db_qc`.`tmp_detail_kite`.`id_kite`= `db_qc`.`tbl_kite`.`id`		    
where `db_qc`.`tbl_kite`.`nokk`='".$_GET['kkno']."'")or die("Gagal");
	$jr2=sqlsrv_num_rows($cari2);
	$r2=sqlsrv_fetch_array($cari2); 
	$cari3=sqlsrv_query($con,"select * from detail_pergerakan_stok 
where nokk='".$_GET['kkno']."' and ket='INSPEK'")or die("Gagal");
	$r3=sqlsrv_num_rows($cari3);
	if($jr2=='0'){
	if(substr($_SESSION['username'],0,7)=="PACKING"){$bgn="not";}else{$bgn=" ";}
	/*$ssql=mssql_query("select stockmovement.dated,stockmovementdetails.weight,stockmovement.pono as dono,
productprop.pono as pono,productprop.batchno,productprop.Width,
productprop.WeightPerArea, productprop.Rollno 
from stockmovement 
left join stockmovementdetails on  stockmovementdetails.stockmovementid=stockmovement.id
left join productprop on productprop.id = stockmovementdetails.productpropid
where stockmovement.wid=22 and stockmovement.transactiontype=4 and stockmovement.transactionstatus=1
and productprop.BatchNo='$_GET[kkno]' and   CAST(TM.dbo.stockmovement.[note] AS VARCHAR(8000)) $bgn like '%IM%'");	
	$r4=mssql_fetch_array($ssql);
	*/
	}
	
	
	?>
          </tr>
          <tr>
            <td>No Order</td>
            <td>:</td>
            <td><input type="text" name="no_do" id="no_do" value="<?php if($r2>0){echo $r2['no_order'];}else{echo $r4['dono'];}?>" tabindex="2" /></td>
          </tr>
          <tr>
            <td>No PO</td>
            <td>:</td>
            <td><input name="no_po" type="text" id="no_po" tabindex="3" value="<?php if($r2>0){echo $r2['no_po'];}else{echo $r4['pono'];}?>" size="30" /> 
            </td>
          </tr>
          <tr>
            <td valign="top">&nbsp;</td>
            <td>&nbsp;</td>
            <td><label for="catatan"></label></td>
          </tr>
        </table>
      
        </td>
      
    </tr>
   
    <tr>
      <td width="88">Transfer Ke</td>
      <td width="5">:</td>
      <td width="252"><label for="partners"></label>
        <select name="partners" id="partners " onchange="window.location='?p=transfer-out&kkno=<?php echo $_GET['kkno']; ?>&ke='+this.value">
        <option value="">PILIH</option>
        <option value="GUDANG KAIN JADI" <?Php if($_GET['ke']=="GUDANG KAIN JADI") {echo "SELECTED";}?>>GUDANG KAIN JADI</option>
        <option value="INSPEK MEJA" <?Php if($_GET['ke']=="INSPEK MEJA") {echo "SELECTED";}?>>INSPEK MEJA</option>
        <option value="GUDANG BS" <?Php if($_GET['ke']=="GUDANG BS") {echo "SELECTED";}?>>GUDANG BS</option>
		<option value="GUDANG GREIGE" <?Php if($_GET['ke']=="GUDANG GREIGE") {echo "SELECTED";}?>>GUDANG GREIGE</option>	
	    </select></td>
      <td width="63">&nbsp;</td>
      <td width="5">&nbsp;</td>
      <td width="197">&nbsp;</td>
    </tr>
    <tr>
      <td>Keterangan</td>
      <td>:</td>
      <td><label for="catatan"></label>
        <select name="catatan" id="catatan">
          <option selected="selected" value="">PILIH</option>
          <option value="FK">FASILITAS KITE</option>
          <option value="EXFK">EXPORT/KITE</option>
          <option value="EXP">EXPORT</option>
          <option value="-">LOCAL</option>
          <option value="BS">BS</option>
          <option value="BB">BB</option>
          <option value="STOCK">STOCK</option>
        </select></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    
    <tr>
      <td colspan="6" align="center">

  </td>
    </tr>
    <tr>
      <td colspan="6">
	  <?php if($_GET['kkno']!="" and $_GET['ke']=="GUDANG KAIN JADI"){$sqlC=sqlsrv_query($con,"select pergerakan_stok.no_mutasi,pergerakan_stok.userid,pergerakan_stok.tgl_update,count(detail_pergerakan_stok.weight) as rol,sum(detail_pergerakan_stok.weight) as berat from pergerakan_stok 
left join detail_pergerakan_stok on pergerakan_stok.id= detail_pergerakan_stok.id_stok
where status='0' and nokk='".$_GET['kkno']."' and fromtoid !='HAPUS'
GROUP BY pergerakan_stok.id");?>Note:<br>
		<?php while($rC=sqlsrv_fetch_array($sqlC)){ echo "<font color=red>UserID: ".$rC['userid'].", No Mutasi: ".$rC['no_mutasi']." Jml Rol: ".$rC['rol'].", Qty: ".$rC['berat'].", Tgl Transfer Out: ".$rC['tgl_update']."</font><br>";} }?></td>
    </tr>
    
  </table>
  </fieldset>

<p>&nbsp;</p>
<p>
  <?php 
   ini_set('display_errors',0);
  if($_GET['ke']=="INSPEK MEJA"){
$qry=sqlsrv_query($con,"select * from tmp_detail_kite where nokkKite='".$_GET['kkno']."' and (sisa='TH' or sisa='FKTH' or sisa='BB') order by no_roll asc");}
 if($_GET['ke']=="GUDANG BS"){
	 if(substr($_SESSION['username'],0,6)=='INSPEK')
	{
		    	$qry=sqlsrv_query($con,"select * from tmp_detail_kite where nokkKite='".$_GET['kkno']."' and (sisa='BB' or sisa='BS' or sisa='STOCK') and ket='INSPEK' order by no_roll asc");
			}else{
				$qry=sqlsrv_query($con,"select * from tmp_detail_kite where nokkKite='".$_GET['kkno']."' and (sisa='BB' or sisa='BS' or sisa='STOCK') order by no_roll asc");}
 }
 
if($_GET['ke']=="GUDANG KAIN JADI" or $_GET['ke']=="GUDANG GREIGE"){
	if(substr($_SESSION['username'],0,6)=='INSPEK')
	{
		
		$qry=sqlsrv_query($con,"select * from tmp_detail_kite where nokkKite='".$_GET['kkno']."' and (sisa!='TH' and sisa!='FKTH' and sisa!='BS' and sisa!='BB') and ket='INSPEK' order by no_roll asc");}
		
	else{
		$qry=sqlsrv_query($con,"select * from tmp_detail_kite where nokkKite='".$_GET['kkno']."' and (sisa!='TH' and sisa!='FKTH' and sisa!='BS' and sisa!='BB')  order by no_roll asc");}
	
}	

?>
</p>
<div align="center">
<h1>Detail Kain JADI</h1></div><hr />
<table width="100%" border="0">
  <tr bgcolor="#7FFF55" align="center">
    <td width="12%"><input type="checkbox" name="allbox" value="check" onClick="checkAll(0);" /><font color="red">Pilih Semua</font></td>
    <td width="7%"><strong>NO</strong></td>
    <td width="13%"><strong>NO ROLL</strong></td>
    <td width="18%"><strong>QTY(KG</strong>)</td>
    <td width="14%"><strong>
      <?php if($r2['satuan']=="Yard"){echo"YARD"; }else if($r2['satuan']=="Meter"){echo"METER";}else{echo "SIZE";}?>
    </strong></td>
    <td width="15%"><strong>GRADE</strong></td>
    <td width="21%"><strong>KET</strong></td>
    </tr>
  <?php 
    $c=1;$n=1;$no=1;while($row=sqlsrv_fetch_array($qry)){
	  $bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99';
	     $cek=sqlsrv_query($con,"select * from pergerakan_stok 
		 left join detail_pergerakan_stok on pergerakan_stok.id= detail_pergerakan_stok.id_stok
		 where status='0' and SN='".$row['SN']."' and nokk='".$_GET['kkno']."' and fromtoid !='HAPUS' ");
		   $crow=sqlsrv_fetch_array($cek);
	  if($crow>0){}else{ 
	  ?>
  
 
  
  <tr bgcolor="<?php echo $bgcolor;?>" align="center">
    <td><?php
   
     echo '<input type="checkbox" name="check['.$n.']" value="'.$row['id'].'">ke '.$n;
  $n++;
   ?></td>
    <td><?php echo $no ;?></td>
    <td><?php echo $row['no_roll'];?></td>
    <td><?php echo number_format($row['net_wight'],'2','.',',');?></td>
    <td><?php if($r2['satuan']=="Yard" or $r2['satuan']=="Meter"){echo $row['yard_'];}else{echo $row['ukuran'];}?></td>
    <td><?php echo $row['grade'];?></td>
    <td><?php echo $row['sisa'];?></td>
    </tr>
  <?php $no++;
  $totrol=$no-1;
  $totkg=$totkg+$row['net_wight'];
  $totyard=$totyard+$row['yard_'];;
  } }?>
  <tr bgcolor="#7FFF55"  align="center">
    <td colspan="2"><strong>TOTAL</strong></td>
    <td><strong><?php echo $totrol; ?></strong></td>
    <td><strong><?php echo number_format($totkg,"2",",",".");?></strong></td>
    <td><strong><?php if($r2['satuan']=="Yard" or $r2['satuan']=="Meter"){echo number_format($totyard,"2",",",".");}?></strong></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
</table>
<p>
   <input type="submit" name="submit" value="Transfer Out" class="art-button" />
  <input type="button" value="Back" onclick="self.history.back()" class="art-button" />
</p>
</form>
</body>
</html>