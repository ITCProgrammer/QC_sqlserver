<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script>
   
          function ganti()
{     var lprn= document.forms['form1']['lprn'].value;  
if(lprn=="Online"){
	window.location.href="index1.php?p=mutasi_kain_keluar_online";
	}

}
function myFungsi() {
                var no_ref= document.forms['form1']['no_ref'].value;
				
                if(no_ref==null || no_ref=="")
                    {
                        alert("No Ref Belum di Input!!!");
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

           </script> 
</head>

<body>
<form name="form1" action="pages/simpan_mutasi_kain_keluar.php" method="post" onsubmit="return myFungsi();">
<?php
if($_GET['no_sj']==''){
	$where.="pergerakan_stok.no_sj='0'";}else{$where.="pergerakan_stok.no_sj='$_GET[no_sj]'";}
$sqldt="SELECT  *
FROM `db_qc`.`pergerakan_stok`
LEFT JOIN `db_qc`.`detail_pergerakan_stok` ON `db_qc`.`detail_pergerakan_stok`.`id_stok` = `db_qc`.`pergerakan_stok`.`id`
LEFT JOIN tbl_kite on tbl_kite.id= detail_pergerakan_stok.id_kj
WHERE ".$where." and `detail_pergerakan_stok`.`status`='1'
order by detail_pergerakan_stok.id asc";
$data1=mysql_query($sqldt);
$sqlrd="SELECT *
FROM `tbl_kite`
LEFT JOIN `detail_kite` ON `tbl_kite`.nokk = `detail_kite`.nokkKite where  `tbl_kite`.nokk='$_GET[no_sj]' limit 1";
$datard=mysql_query($sqlrd);
$rd2=mysql_fetch_array($datard);
$rd3=mysql_fetch_array($data1); ?>
<table width="100%" border="0">
  <tr>
    <th colspan="6" scope="row">&nbsp;</th>
    </tr>
  <tr>
    <th colspan="6" scope="row">Mutasi Kain Keluar</th>
    </tr>
  <tr>
    <th colspan="6" scope="row">&nbsp;</th>
    </tr>
  <tr>
    <th scope="row" align="right">Mutasi_Keluar</th>
    <td>:</td>
    <td><label for="select"></label>
      <select name="lprn" onchange="ganti()">
     	 <option value="Manual" selected="selected">Manual</option>
        <option value="Online" >Online</option>
        
      </select></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <th scope="row" align="right">No Surat Jalan</th>
    <td>:</td>
    <td><input name="no_sj" type="text" id="no_sj"  onchange="window.location='index1.php?p=mutasi_kain_keluar&no_sj='+this.value"  value="<?php echo $_GET['no_sj'];?>" size="20"/></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <th width="18%" scope="row" align="right">No Order</th>
    <td width="1%">:</td>
    <td width="30%"><label for="no_order"></label>
      <input name="no_order" type="text" id="no_order" value="<?php if($datard > 0){if($_GET['nopo']==''){echo $rd3['no_order'];}else{echo $_GET['nopo'];}} ?>" size="30"/>
      </td>
    <td width="12%">&nbsp;</td>
    <td width="1%">&nbsp;</td>
    <td width="38%">&nbsp;</td>
  </tr>
  <tr>
    <th scope="row" align="right" valign="top">Langganan:</th>
    <td>:</td>
    <td colspan="4"><!-- <label for="ket"></label>
      <select name="langgan">
        <?php
	//$sqlw2="select LTRIM(RTRIM(partnername)) as partnername   from partners";
//$dataw2=mssql_query($sqlw2); ?>
        <?php 
	  
	 // while ($rw2=mssql_fetch_array($dataw2)){ ?>
        <option value="<?php //echo $rw2['partnername']; ?>"><?php//echo $rw2['partnername']; ?></option>
        
        
        
        <?php // } ?>
      </select> -->
         <?php
	$sqllanggan=mysql_query("SELECT pelanggan
FROM `tbl_kite`
LEFT JOIN `detail_kite` ON `tbl_kite`.nokk = `detail_kite`.nokkKite where `tbl_kite`.nokk='$_GET[nokk]' and `tbl_kite`.nokk='$_GET[nokk]' group by pelanggan"); 
$r4=mysql_fetch_array($sqllanggan);?>
      <label for="langgan"></label>
      <input name="langgan" type="text" id="langgan" size="50" value="<?php if($rd3['pelanggan']!=''){echo $rd3['fromtoid'];}else{echo $r4['pelanggan'];} ?>" /></td>
    </tr>
  <tr>
    <th scope="row" align="right" valign="top">Keterangan</th>
    <td>:</td>
    <td colspan="4"><textarea name="ket" id="ket" cols="45" rows="5"></textarea></td>
    </tr>
  
</table>
<div align="center"> DETAIL DATA</div>
  <table width="100%" border="1">
    <tr>
      <th width="42" bgcolor="#9966CC" scope="col">No</th>
      <th width="163" bgcolor="#9966CC" scope="col">No KK</th>
      <th width="69" bgcolor="#9966CC" scope="col">No Warna/Warna</th>
      <th width="69" bgcolor="#9966CC" scope="col">LOT</th>
      <th width="69" bgcolor="#9966CC" scope="col">No Roll</th>
      <th width="75" bgcolor="#9966CC" scope="col">Netto (KG)</th>
      <th width="77" bgcolor="#9966CC" scope="col">Yard</th>
      <th width="60" bgcolor="#9966CC" scope="col">GRADE</th>
      <th width="60" bgcolor="#9966CC" scope="col">KET</th>
      <th width="60" bgcolor="#9966CC" scope="col">AKSI</th>
    </tr>
    
    <?php
	$sql="SELECT  *, `detail_pergerakan_stok`.`id` as iddt
FROM `db_qc`.`pergerakan_stok`
LEFT JOIN `db_qc`.`detail_pergerakan_stok` ON `db_qc`.`detail_pergerakan_stok`.`id_stok` = `db_qc`.`pergerakan_stok`.`id`
LEFT JOIN tbl_kite on tbl_kite.id= detail_pergerakan_stok.id_kj
LEFT JOIN detail_kite on detail_kite.id=detail_pergerakan_stok.id_detail_kj
WHERE ".$where." and `detail_pergerakan_stok`.`status`='1'
order by detail_pergerakan_stok.id asc";
$data=mysql_query($sql);
	
	$no=1;
	$n=1;
	$c=0;
	 while($rowd=mysql_fetch_array($data)){
		 $cek=mysql_query("select * from pergerakan_stok 
		 left join detail_pergerakan_stok on pergerakan_stok.id= detail_pergerakan_stok.id_stok
		 where id_detail_kj='$rowd[d]'");
		   $crow=mysql_fetch_array($cek);
		    $bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99';
	  if($crow>0){}else{
		 ?>
    <tr bgcolor="<?php echo $bgcolor;?>">
      <td align="center" ><?php echo $no; ?></td>
      <td align="center" ><?PHP echo $rowd['nokkKite']; ?></td>
      <td align="center" ><?PHP echo $rowd['no_warna']; ?> / <?PHP echo $rowd['warna']; ?></td>
      <td align="center" ><?PHP echo $rowd['no_lot']; ?></td>
      <td align="center" ><?PHP echo $rowd['no_roll']; ?></td>
      <td align="center" ><?PHP echo number_format($rowd['net_wight'],'2','.',','); ?></td>
      <td align="center" ><?PHP echo number_format($rowd['yard_'],'2','.',','); ?></td>
      <td align="center" ><?PHP echo $rowd['grade']; ?></td>
      <td align="center" ><?php echo $rowd['sisa']; ?></td>
      <td align="center" ><a href="pages/simpan_mutasi_kain_keluar.php?id=<?php echo $rowd['iddt']; ?>&no_sj=<?php echo $_GET['no_sj'];?>" >HAPUS</a> </td>
    </tr>
    <?php 
	$totalyard=$totalyard+$rowd['yard_'];
	$totalqty=$totalqty+$rowd['net_wight'];
	$no++; } }?>
    <p align="right"><font color="red">
    <b>Total Yard : <?php echo $totalyard; ?><br />
    <b>Total Qty : <?php echo $totalqty; ?></b> </font></p>
  </table><input name="cetak" type="button" value="Cetak" onclick="window.location.href='pages/cetak_packing_list.php?no_sj=<?php echo $_GET['no_sj'];?>'">
</form>
</body>
</html>