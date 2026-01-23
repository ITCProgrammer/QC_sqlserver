<?php
ini_set("error_reporting",1);
include("../koneksi.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style>
.rol{
    width: 100%;
    height: 300px;
    overflow: scroll;
} 
#total {
    color: red;
}
td {
    font-size: 12px;
    padding: 3px;
}
input[type="text"] {
    text-align: right;
}	
</style>
<script type="text/javascript" src="checklist.js"></script>	
<script language="JavaScript">
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
function roundToTwo(num) {    
    return +(Math.round(num + "e+2")  + "e-2");
}
</script>	
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Detail Masuk Kain Jadi</title>
</head>

<body>
<form name="form1" id="form1" method="post"	enctype="multipart/form-data">	
<table>
  <tr>
    <th align="left" valign="top" scope="row">Status</th>
    <th align="left" valign="top" scope="row">:</th>
    <td colspan="4"><select name="sts" id="sts" tabindex="4" >
      <option value="">PILIH</option>
      <!-- <option value="Sisa Kirim">Sisa Kirim</option> -->
      <option value="Cancel Order">Cancel Order</option>
      <option value="Revisi">Revisi</option>
      <option value="Booking">Booking</option>
      <option value="Booking Miss Paulina">Booking Miss Paulina</option>
      <option value="Tunggu Kirim">Tunggu Kirim</option>
      <option value="Sisa Ganti Kain">Sisa Ganti Kain</option>
      <option value="Sisa Tembak Qty">Sisa Tembak Qty</option>
      <option value="Sisa Produksi">Sisa Produksi</option>
      <option value="Sisa Toleransi">Sisa Toleransi</option>
	  <option value="Tunggu Conform">Tunggu Conform</option>
	  <option value="Untuk Local">Untuk Local</option>
	  <option value="Sisa dibawah MOQ">Sisa dibawah MOQ</option>
	  <option value="Liability">Liability</option>
	  <option value="Masuk BB">Masuk BB</option>
		
    </select></td>
  </tr>
  <tr>
    <th align="left" valign="top" scope="row"><input type="submit" name="simpan" id="simpan" value="Simpan"/></th>
    <th align="left" valign="top" scope="row">&nbsp;</th>
    <td colspan="4" align="right">&nbsp;</td>
  </tr>
</table>
No Kartu Kerja : <strong><em><?php echo $_GET["nokk"];?></em></strong>
<strong>
<?php $sql1=sqlsrv_query($con,"SELECT
	COUNT(b.weight) as totrol,
	SUM(b.weight) as totba,
	SUM(b.yard_) as totya
	from
pergerakan_stok a
	LEFT JOIN detail_pergerakan_stok b ON a.id = b.id_stok
  	LEFT JOIN tmp_detail_kite d ON d.id=b.id_detail_kj
	LEFT JOIN tbl_kite c ON c.id = d.id_kite
	WHERE
	(a.typestatus = '1' OR a.typestatus = '2') and (b.status = '0' or b.status = '1')
	AND not ISNULL(b.transtatus) AND b.transtatus='1' AND trim(c.no_order)='".$_GET['order']."'");
 $row1=sqlsrv_fetch_array($sql1);
 ?>
<br />
Total Roll : <?php echo $row1["totrol"];?> || Berat : <?php echo number_format($row1["totba"],'2','.',',');?> ||  Panjang:<?php echo number_format($row1["totya"],'2','.',',');?>
</strong> 
<div class="rol">
<table width="45%" border="0">
  <tr align="center" bgcolor="#3366FF">
    <td width="5%">No</td>
    <td width="13%">No Roll</td>
    <td width="18%">Berat (KG)</td>
    <td width="12%">Panjang</td>
    <td width="11%">Satuan</td>
    <td width="9%">Grade</td>
    <td width="17%">SN</td>
    <td width="6%">Ket</td>
    <td width="9%">Status</td>
    <td width="9%">Ket Status</td>
    <td width="9%"><input type="checkbox" name="allbox" value="check" onClick="checkAll(0);" /><br><font color="red">Cek ALL</font></td>
    </tr>
  <?php
	if($_GET['ketstok']!=""){$ktstok=" AND ket_stok='".$_GET['ketstok']."' ";}else{$ktstok=" AND ISNULL(ket_stok) ";}
  $sql=sqlsrv_query($con,"SELECT
	b.id,
	b.no_roll,
	b.weight,
	b.yard_,
	b.satuan,
	b.grade,
	b.sisa,
	b.SN,
	b.transtatus,
	b.ket_stok
	FROM
	pergerakan_stok a
	LEFT JOIN detail_pergerakan_stok b ON a.id = b.id_stok
  	LEFT JOIN tmp_detail_kite d ON d.id=b.id_detail_kj
	LEFT JOIN tbl_kite c ON c.id = d.id_kite
	WHERE
	(a.typestatus = '1' OR a.typestatus = '2') and (b.status = '0' or b.status = '1')
	AND not ISNULL(b.transtatus) AND b.transtatus='1' AND trim(c.no_order)='".$_GET['order']."'
	GROUP BY
	b.id
	ORDER BY
	a.tgl_update,a.id,b.no_roll");
  $c=1;
  $no=1;
  $n=1;	
  while($row=sqlsrv_fetch_array($sql))
  {
	   $bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99';
	  
  ?>
  <tr bgcolor="<?php echo $bgcolor;?>">
    <td><?php echo $no;?></td>
    <td align="center"><?php echo $row['no_roll'];?></td>
    <td align="right"><?php echo number_format($row['weight'],'2','.',',');?></td>
    <td align="right"><?php echo number_format($row['yard_'],'2','.',',');?></td>
    <td align="center"><?php echo $row['satuan'];?></td>
    <td align="center"><?php echo $row['grade'];?></td>
    <td align="right"><?php echo $row['SN'];?></td>
    <td align="center"><?php if($row['sisa']=="SISA" || $row['sisa']=="FKSI"){$sisa= "SISA";}else{$sisa=$row['sisa'];}echo $sisa;?></td>
    <td bgcolor="<?php echo $rn;?>"><?php echo $kt;?></td>
    <td bgcolor="<?php echo $rn;?>"><?php echo $row['ket_stok'];?></td>
    <td bgcolor="<?php echo $rn;?>"><?php echo '<input type="checkbox" name="check['.$n.']" value="'.$row['id'].'"';
  $n++;
   ?></td>
    <?php  if($row['transtatus']=='0'){$kt="Sudah Keluar"; $rn="RED";}else{$kt="Ada"; $rn="";}?>
    </tr>  
  <?php $no++;} ?>
</table>
</div>
</form>	
<strong>
<?php $sql2=sqlsrv_query($con,"SELECT
	COUNT(b.weight) as totrol,
	SUM(b.weight) as totba,
	SUM(b.yard_) as totya
	from
pergerakan_stok a
	LEFT JOIN detail_pergerakan_stok b ON a.id = b.id_stok
  	LEFT JOIN tmp_detail_kite d ON d.id=b.id_detail_kj
	LEFT JOIN tbl_kite c ON c.id = d.id_kite
	WHERE
	(a.typestatus = '1' OR a.typestatus = '2') and (b.status = '0' or b.status = '1')
	AND not ISNULL(b.transtatus) AND b.transtatus='1' AND trim(c.no_order)='".$_GET['order']."'");
 $row2=sqlsrv_fetch_array($sql2);
 ?>
 <font color="RED">
SISA Roll : <?php echo $row2["totrol"];?> || Berat : <?php echo number_format($row2["totba"],'2','.',',');?> || Panjang:<?php echo number_format($row2["totya"],'2','.',',');?></font>
</strong>


</body>
</html>
<?php
if($_POST['simpan']=="Simpan"){
$n1=1;	
$sqlss=sqlsrv_query($con,"SELECT
	b.id,
	b.no_roll,
	b.weight,
	b.yard_,
	b.satuan,
	b.grade,
	b.sisa,
	b.SN,
	b.transtatus,
	b.ket_stok
	FROM
	pergerakan_stok a
	LEFT JOIN detail_pergerakan_stok b ON a.id = b.id_stok
  	LEFT JOIN tmp_detail_kite d ON d.id=b.id_detail_kj
	LEFT JOIN tbl_kite c ON c.id = d.id_kite
	WHERE
	(a.typestatus = '1' OR a.typestatus = '2') and (b.status = '0' or b.status = '1')
	AND not ISNULL(b.transtatus) AND b.transtatus='1' AND trim(c.no_order)='".$_GET['order']."' 
	GROUP BY
	b.id
	ORDER BY
	a.tgl_update,a.id,b.no_roll");
while($rowss=sqlsrv_fetch_array($sqlss))
  {	
	if($_POST['check'][$n1] !="") 
		  {
$id=$_POST['check'][$n1];
$sts_stk=$_POST['sts'];
if($sts_stk!=""){		
sqlsrv_query($con,"UPDATE detail_pergerakan_stok SET ket_stok='$sts_stk' WHERE id='$id'")or die("Gagal update");
}else{
sqlsrv_query($con,"UPDATE detail_pergerakan_stok SET ket_stok=null WHERE id='$id'")or die("Gagal update");	
}
$n1++;}else{$n1++;}	
}
	echo"<script>
	window.alert('data simpan');
	window.location.href='?order=".$_GET['order']."';
	</script>";
}
?>