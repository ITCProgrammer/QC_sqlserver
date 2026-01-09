<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Form Waste</title>
<style>
.rol{
    width: 100%;
    height: 270px;
    overflow: scroll;
} 
</style>
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
</script>
</head>

<body>
<?php
if(isset($_POST['btnsimpan'])){
	$pesanError = array();
	if (trim($_POST['nokk2'])=="") {
		$pesanError[] = "Data <b> Nokk Baru</b> belum diisi!";		
	}
			
	# JIKA ADA PESAN ERROR DARI VALIDASI
	if (count($pesanError)>=1 ){
		echo "<div class='mssgBox'>";
		//echo "<img src='../images/attention.png'> <br><hr>";
			$noPesan=0;
			foreach ($pesanError as $indeks=>$pesan_tampil) { 
			$noPesan++;
				echo "&nbsp;&nbsp; $noPesan. $pesan_tampil<br>";	
			} 
		echo "</div> <br>"; 
	}
	else {
	$sqlcek1=mysqli_query($con,"select count(*) as nokk from tbl_kite where nokk='".$_POST['nokk2']."'");
	$r=mysqli_fetch_array($sqlcek1);
	if($r['nokk']>0){}else{
	$jns=addslashes($_POST['txt_jenis_kain']);
	$stl=addslashes($_POST['txt_style']);
	$sqlsimpan=mysqli_query($con,"INSERT into tbl_kite values('','".$_POST['txt_pelanggan']."','.".$_POST['txt_item']."','".$_POST['txt_warna']."','".$_POST['txt_no_warna']."','".$_POST['txt_lebar']."','".$_POST['txt_berat']."',now(),'".$_POST['txt_nopo']."','$jns','".$_POST['txt_order']."','$stl','".$_POST['txt_lot']."',DATE_SUB(NOW(), INTERVAL 1 hour),'".$_POST['no_mc']."','".$_POST['nokk2']."','".$_POST['bruto']."','".$_SESSION['username']."','','')") or die("gagal");
	}
	
	$sql1=mysqli_query($con,"select * from tbl_kite left join
			tmp_detail_kite on nokk=nokkKite
			where nokk='".$_POST['nokk']."'");
	
  $n=1;
  $nom=1;
  while($row=mysqli_fetch_array($sql1))
  {
	  if($_POST['check'][$n]!=''){
			$id_kite=$_POST['check'][$n];
			$simpan=mysqli_query($con,"UPDATE `db_qc`.`tmp_detail_kite` SET `nokkKite` = '".$_POST['nokk2']."' WHERE `tmp_detail_kite`.`id`='$id_kite'") or die("Gagal");
			$n++;}else{$n++;}
  }
	echo "<script>";
		echo "alert('Data Tersimpan')";
		echo "</script>";
	
	}
}
?>
<form id="form1" name="form1" method="post" action="">
<fieldset>
    <legend>Data Lama</legend>
<table width="100%" border="0">
  <tr>
    <td width="44%"><table width="100%" border="0">
      <tr>
        <td colspan="6">
        <table width="336" border="0">
              <tr>
                <td width="132">No. Kartu Kerja</td>
                <td width="10">:</td>
                <td width="234"><input name="nokk" type="text"  onchange="window.location='?p=form_Qc_waste&kkno='+this.value"  value="<?php echo $_GET['kkno'];?>"tabindex="1"/>
				<?php 
				if($_GET['kkno']!=""){
			$sql=mysqli_query($con,"select * from tbl_kite left join
			tmp_detail_kite on nokk=nokkKite
			where nokk='".$_GET['kkno']."'");
			$r=mysqli_fetch_array($sql);
			$sql_d=mysqli_query($con,"select satuan from tmp_detail_kite where nokkKite='".$_GET['kkno']."'");
			$rd=mysqli_fetch_array($sql_d);
				}
			?></td>
                 </tr>
              <tr>
                <td>No. MC</td>
                <td>:</td>
                <td><input name="no_mc" type="text" id="no_mc" size="10" tabindex="2" value="<?php if($sql>0){echo $r['no_mc'];}?>" /></td>
              </tr>
              <tr>
                <td>Bruto</td>
                <td>:</td>
                <td><input name="bruto" type="text" id="bruto" value="<?php if($sql>0){echo $r['bruto'];}?>" tabindex="3" size="6" /></td>
              </tr>
            </table>
          </td>
      </tr>
      <tr>
        <td width="86">CUSTOMER</td>
        <td width="3">:</td>
        <td width="122"><label>
          <input name="txt_pelanggan" type="text" id="txt_pelanggan" tabindex="4" value="<?php if($sql>0){echo $r['pelanggan'];}?>" size="20"/>
        </label></td>
        <td width="68">P.O. NO.</td>
        <td width="3">:</td>
        <td width="154"><label>
          <input name="txt_nopo" type="text" id="txt_nopo" tabindex="12" value="<?php if($sql>0){echo $r['no_po'];}?>" size="20" />
        </label></td>
      </tr>
      <tr>
        <td>ITEM NO.</td>
        <td>:</td>
        <td><label>
          <input name="txt_item" type="text" id="txt_item"  tabindex="5" value="<?php if($sql>0){echo $r['no_item'];}?>" size="20"/>
        </label></td>
        <td>DESC.</td>
        <td>:</td>
        <td><label>
          <input name="txt_jenis_kain" type="text" id="txt_jenis_kain"  tabindex="13" value="<?php if($sql>0){echo htmlentities($r['jenis_kain'],ENT_QUOTES);}?>" size="20"/>
        </label></td>
      </tr>
      <tr>
        <td>COLOR</td>
        <td>:</td>
        <td><label>
          <input name="txt_warna" type="text" id="txt_warna" tabindex="6" value="<?php if($sql>0){echo $r['warna'];}?>" size="20"/>
        </label></td>
        <td>JOB ORD.</td>
        <td>:</td>
        <td><input name="txt_order" type="text" id="txt_order" tabindex="14" value="<?php if($sql>0){echo $r['no_order'];}?>" size="20"/></td>
      </tr>
      <tr>
        <td>COLOR NO.</td>
        <td>:</td>
        <td><input name="txt_no_warna" type="text" id="txt_no_warna" tabindex="7" value="<?php if($sql>0){echo $r['no_warna'];}?>" size="20"/></td>
        <td>STYLE NO.</td>
        <td>:</td>
        <td><input name="txt_style" type="text" id="txt_style" tabindex="15" value="<?php if($sql>0){echo $r['no_style'];}?>" size="20" /></td>
      </tr>
      <tr>
        <td>WIDTH</td>
        <td>:</td>
        <td><label>
          <input name="txt_lebar" type="text" id="txt_lebar" placeholder="0" tabindex="8" onkeyup="angka(this);" value="<?php if($sql>0){echo $r['lebar'];}?>" size="6"/>
        </label></td>
        <td>LOT NO.</td>
        <td>:</td>
        <td><input name="txt_lot" type="text" id="txt_lot" size="10"value="<?php if($sql>0){echo $r['no_lot'];}?>" tabindex="16"/></td>
        </tr>
      <tr>
        <td>WEIGHT</td>
        <td>:</td>
        <td><label>
          <input name="txt_berat" type="text" id="txt_berat" placeholder="0" tabindex="9" onkeyup="angka(this);" value="<?php if($sql>0){echo $r['berat'];}?>" size="6"/>
          G/M2</label></td>
        <td height="17" align="center"></td>
        <td height="17" align="center"></td>
        <td height="17" align="center"></td>
      </tr>
    </table></td>
    <td width="56%" valign="top">
    <div class="rol">
    <table width="100%" border="0">
      <tr>
        <th width="42" bgcolor="#9966CC" scope="col"><input type="checkbox" name="allbox" value="check" onClick="checkAll(0);" /><font color="red">Pilih Semua</font></th>
        <th width="42" bgcolor="#9966CC" scope="col">No</th>
        <th width="163" bgcolor="#9966CC" scope="col">SN</th>
        <th width="69" bgcolor="#9966CC" scope="col">No Roll</th>
        <th width="75" bgcolor="#9966CC" scope="col">Qty (KG)</th>
        <th width="77" bgcolor="#9966CC" scope="col">Yard</th>
        <th width="50" bgcolor="#9966CC" scope="col">Grade</th>
        <th width="90" bgcolor="#9966CC" scope="col">Ket</th>
        </tr>
        <?php
		if($_GET['kkno']!=""){
		$no=1;$c=1;$n=1;
$data=mysqli_query($con,"select * from tmp_detail_kite where nokkKite='".$_GET['kkno']."' ORDER BY no_roll");
        while($rowd=mysqli_fetch_array($data)){
			$bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99';
			?>
     <tr bgcolor="<?php echo $bgcolor;?>">
       <td align="center" ><?php
   
     echo '<input type="checkbox" name="check['.$n.']" value="'.$rowd['id'].'">';
  $n++;
   ?></td>
        <td align="center" ><?php echo $no;?></td>
        <td align="center" ><?php echo $rowd['SN'];?></td>
        <td align="center" ><?php echo $rowd['no_roll'];?></td>
        <td align="center" ><?php echo $rowd['net_wight'];?></td>
        <td align="center" ><?php echo $rowd['yard_'];?></td>
        <td align="center" ><?php echo $rowd['grade'];?></td>
        <td align="center" ><?php echo $rowd['sisa'];?></td>
        </tr>
        <?php $no++;} }?>
         </table></div></td>
  
  </tr>
</table>


</fieldset>
<fieldset>
      <legend>Data Baru</legend>
<table width="100%" border="0">
  <tr>
    <td width="11%">No. Kartu Kerja</td>
    <td width="1%">:</td>
    <td width="88%"><input name="nokk2" type="text"  onchange="window.location='?p=form_Qc_waste&kkno=<?php echo $_GET['kkno'];?>&kkno2='+this.value"  value="<?php echo $_GET['kkno2'];?>"tabindex="1"/>
      <input type="submit" name="btnsimpan" id="btnsimpan" value="SIMPAN" /></td>
  </tr>
</table>
<div class="rol">
    <table width="100%" border="0">
      <tr>
        <th width="42" bgcolor="#9966CC" scope="col">No</th>
        <th width="163" bgcolor="#9966CC" scope="col">SN</th>
        <th width="69" bgcolor="#9966CC" scope="col">No Roll</th>
        <th width="75" bgcolor="#9966CC" scope="col">Qty (KG)</th>
        <th width="77" bgcolor="#9966CC" scope="col">Yard</th>
        <th width="50" bgcolor="#9966CC" scope="col">Grade</th>
        <th width="90" bgcolor="#9966CC" scope="col">Ket</th>
        <th width="90" bgcolor="#9966CC" scope="col">Aksi</th>
        </tr>
        <?php
		$no1=1;$c1=1;$n1=1;
		$dt=mysqli_query($con,"select nokkKite from tmp_detail_kite where nokkKite='".$_GET['kkno2']."'");
		$r1=mysqli_fetch_array($dt);
		if($r1['nokkKite']!=""){
$data1=mysqli_query($con,"select * from tmp_detail_kite where nokkKite='".$_GET['kkno2']."' ORDER BY no_roll");
        while($rowd1=mysqli_fetch_array($data1)){
			$bgcolor1 = ($c++ & 1) ? '#33CCFF' : '#FFCC99';
			?>
     <tr bgcolor="<?php echo $bgcolor1;?>">
       <td align="center" ><?php echo $no1;?></td>
        <td align="center" ><?php echo $rowd1['SN'];?></td>
        <td align="center" ><?php echo $rowd1['no_roll'];?></td>
        <td align="center" ><?php echo $rowd1['net_wight'];?></td>
        <td align="center" ><?php echo $rowd1['yard_'];?></td>
        <td align="center" ><?php echo $rowd1['grade'];?></td>
        <td align="center" ><?php echo $rowd1['sisa'];?></td>
        <td align="center" ><a href="pages/hapus-waste.php?kkno=<?php echo $_GET['kkno']?>&kkno2=<?php echo $_GET['kkno2']?>&id=<?php echo $rowd1['id']?>" >Hapus</a></td>
        </tr>
        <?php $no1++;}}else{echo "Data Tidak Ditemukan";} ?>
         </table></div>

</fieldset>
</form>
</body>
</html>