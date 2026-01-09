<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>FASILITAS KITE</title>
 	<script>
	function roundToTwo(num) {    
    return +(Math.round(num + "e+2")  + "e-2");
}
	function jumlah()
{
				var lebar = document.forms['form1']['txt_lebar'].value;
				var berat = document.forms['form1']['txt_berat'].value;
				var netto = document.forms['form1']['txt_net_weight'].value;
				var meter = document.forms['form1']['M'].value;
				var satuan = document.forms['form1']['satuan'].value;
				var read=document.getElementById("txt_yard");
        
				var x,yard,bulat,meter;
				if(document.forms['form1']['manual'].checked == false){
					read.setAttribute("readonly",true);
					if(netto==null || netto=="")
					
					{document.form1.txt_yard.value='0';}else
						{
					x=((parseInt(lebar)+2)*parseInt(berat))/43.05;
					x1=(1000/x);
					yard=x1*parseFloat(netto);
					meter=yard*(768/840);
					
					
					if(document.forms['form1']['M'].checked == false)
    				{document.form1.txt_yard.value=roundToTwo(yard).toFixed(2);document.form1.mtr.value='';document.form1.satuan.value='Yard';
						document.form1.txt_net_weight.value=roundToTwo(netto).toFixed(2);}
					else{
						
						document.form1.txt_yard.value=roundToTwo(meter).toFixed(2);document.form1.mtr.value=' Meter';document.form1.satuan.value='Meter';
						document.form1.txt_net_weight.value=roundToTwo(netto).toFixed(2);}
						
						}}else{
					if(document.forms['form1']['M'].checked == false)
    				{document.form1.mtr.value='';document.form1.satuan.value='Yard';}
					else{document.form1.mtr.value=' Meter';document.form1.satuan.value='Meter';}
							read.removeAttribute("readonly");
							}
					
}
	
            function myFungsi() {
                var nokk = document.forms['form1']['nokk'].value;
				var no_mc = document.forms['form1']['no_mc'].value;
				var bruto = document.forms['form1']['bruto'].value;
				var txt_pelanggan = document.forms['form1']['txt_pelanggan'].value;
				var txt_nopo = document.forms['form1']['txt_nopo'].value;
				var txt_berat = document.forms['form1']['txt_berat'].value;
				var txt_lebar = document.forms['form1']['txt_lebar'].value;
				var txt_roll = document.forms['form1']['txt_roll'].value;
				var txt_grade = document.forms['form1']['txt_grade'].value;
				var txt_net_weight = document.forms['form1']['txt_net_weight'].value;
				var txt_yard = document.forms['form1']['txt_yard'].value;
				
                if(nokk==null || nokk=="" || no_mc==null || no_mc=="" || bruto==null || bruto=="" || txt_pelanggan==null || txt_pelanggan=="" || txt_nopo==null || txt_nopo=="" || txt_berat==null || txt_berat=="" || txt_lebar==null || txt_lebar=="" || txt_roll==null || txt_roll=="" || txt_grade=="PILIH" || txt_net_weight==null || txt_net_weight=="" || txt_yard==null || txt_yard=="" || txt_yard=="0" )
                    {
                        alert("Data Harus Lengkap!!!");
                        return false;
                    }
					
					        }
			
			
			function angka(e) {
   if (!/^[0-9 .]+$/.test(e.value)) {
      e.value = e.value.substring(0,e.value.length-1);
   }
   
   
}
	
   	function td() {
		 var fs = document.forms['form1']['fasilitas'].value;
   if (fs=='TH' || fs=='BB' || fs=='BS' || fs=='FASILITAS KITE TH') {
	   document.form1.tdkm.checked=true; 
   }else  {document.form1.tdkm.checked=false;}
   
   }	
		
		
		
        </script>
</head>

<body>
<form id="form1" name="form1" method="post" action="?p=simpan" onSubmit="return myFungsi()">
  <table width="679" border="0">
    <tr>
      <td colspan="6">      
      TGL:
        <?PHP 
		date_default_timezone_set('Asia/Jakarta');
	$tgl=date("Y-M-d H:i:s");
	
	  echo $tgl;?>
	  <br />GROUP SHIFT: <?php echo $_SESSION['username']; ?>
	  
      <div align="center"><font color="red"><?php if($_GET['status']!=""){echo $_GET['status']." <a href='pages/simpan_cetak.php?nokk=$_GET[kkno]&rol=$_GET[roll]'>cetak</a>";}?></font></div>
      <fieldset>
      <legend>Data Pokok</legend>
      <font color="blue">Data Harus di Input Semua</font>
        <table width="624" border="0">
          <tr>
            <td width="132">No. Kartu Kerja</td>
            <td width="10">:</td>
            <td width="468"><input name="nokk" type="text"  onchange="window.location='form-Packing?kkno='+this.value"  value="<?php echo $_GET['kkno'];?>" tabindex="1"/>
            Note:Tekan Tab pada keybord untuk input lagi</td>
            <?php 
			$sql=mysql_query("select * from tbl_kite left join
			tmp_detail_kite on nokk=nokkKite
			where nokk='$_GET[kkno]'");
			$r=mysql_fetch_array($sql);
			$sql_d=mysql_query("select satuan from tmp_detail_kite where nokkKite='$_GET[kkno]'");
			$rd=mysql_fetch_array($sql_d);
			?>
          </tr>
          <tr>
            <td>No. MC</td>
            <td>:</td>
            <td><input name="no_mc" type="text" id="no_mc" size="10" value="<?php if($sql>0){echo $r['no_mc'];}?>" tabindex="2"/></td>
          </tr>
          <tr>
            <td>Bruto</td>
            <td>:</td>
            <td><input name="bruto" type="text" id="bruto" tabindex="3" value="<?php if($sql>0){echo $r['bruto'];}?>" size="6" /></td>
          </tr>
        </table>
        </fieldset>
        <marquee behavior="alternate"><b><font color="#FF0000" size="+2"><?php echo $_SESSION['username']; ?></font></b></marquee>
      <br />
      <font color="blue">Data Harus di Input Semua</font></td>
      
    </tr>
   
    <tr>
      <td width="88">CUSTOMER</td>
      <td width="5">:</td>
      <td width="252"><label>
        <input name="txt_pelanggan" type="text" id="txt_pelanggan" size="35" value="<?php if($sql>0){echo $r['pelanggan'];}?>" tabindex="4"/>
      </label></td>
      <td width="63">P.O. NO.</td>
      <td width="5">:</td>
      <td width="197"><label>
        <input type="text" name="txt_nopo" id="txt_nopo" value="<?php if($sql>0){echo $r['no_po'];}?>" tabindex="12" />
      </label></td>
    </tr>
    <tr>
      <td>ITEM NO.</td>
      <td>:</td>
      <td><label>
        <input name="txt_item" type="text" id="txt_item" size="25"value="<?php if($sql>0){echo $r['no_item'];}?>"  tabindex="5"/>
      </label></td>
      <td>DESC.</td>
      <td>:</td>
      <td><label>
        <input name="txt_jenis_kain" type="text" id="txt_jenis_kain" size="30"  value="<?php if($sql>0){echo htmlentities($r[jenis_kain],ENT_QUOTES);}?>"  tabindex="13"/>
      </label></td>
    </tr>
    <tr>
      <td>COLOR</td>
      <td>:</td>
      <td><label>
        <input name="txt_warna" type="text" id="txt_warna" size="27" value="<?php if($sql>0){echo $r['warna'];}?>" tabindex="6"/>
      </label></td>
      <td>JOB ORD.</td>
      <td>:</td>
      <td><input type="text" name="txt_order" id="txt_order" value="<?php if($sql>0){echo $r['no_order'];}?>" tabindex="14"/></td>
    </tr>
    <tr>
      <td>COLOR NO.</td>
      <td>:</td>
      <td><input type="text" name="txt_no_warna" id="txt_no_warna" value="<?php if($sql>0){echo $r['no_warna'];}?>" tabindex="7"/></td>
      <td>STYLE NO.</td>
      <td>:</td>
      <td><input name="txt_style" type="text" id="txt_style" size="30" value="<?php if($sql>0){echo $r['no_style'];}?>" tabindex="15" /></td>
    </tr>
    <tr>
      <td>WIDTH</td>
      <td>:</td>
      <td><label>
        <input name="txt_lebar" type="text" id="txt_lebar" size="6" placeholder="0" value="<?php if($sql>0){echo $r['lebar'];}?>" tabindex="8" onkeyup="angka(this);"/>
      </label></td>
      <td>LOT NO.</td>
      <td>:</td>
      <td><input name="txt_lot" type="text" id="txt_lot" size="10"value="<?php if($sql>0){echo $r['no_lot'];}?>" tabindex="16"/></td>
    </tr>
    <tr>
      <td>WEIGHT</td>
      <td>:</td>
      <td><label>
        <input name="txt_berat" type="text" id="txt_berat" size="6" placeholder="0" value="<?php if($sql>0){echo $r['berat'];}?>" tabindex="9" onkeyup="angka(this);"/>
      G/M2</label></td>
      <td>ROLL NO.</td>
      <td>:</td>
      <td>
      
      <input name="txt_roll" type="text" id="txt_roll" size="10" value="" tabindex="17" onchange="">
      <?php 
						$sql1=mysql_query("select no_roll from detail_kite where nokkKite='$r[nokk]' and no_roll='$txt_roll'");
						$r1=mysql_num_rows($sql1);
						if($r1>0)
						{echo "";}
						$cekdata1=mysql_query("select * from tbl_kite left join tmp_detail_kite on nokk=nokkkite  where nokk='$r[nokk]' and no_mutasi='$r[no_mutasi]'");
						$cekdt1=mysql_fetch_array($cekdata1);
	if($cekdt1['no_mutasi']!='' and substr($cekdt1['user_packing'],0,7)=='PACKING')
	{
		$sql2=mysql_query("select * from tmp_detail_kite where nokkKite='$r[nokk]' and (sisa='TH' or sisa='FKTH')");
		$z=1;
		}else{$sql2=mysql_query("select sisa from detail_kite where nokkKite='$r[nokk]'");}
						$r12=mysql_fetch_array($sql2);
						?>
      <select name="fasilitas" id="fasilitas" onchange="td()">
        <option value="" >PILIH</option>
        <option value="FASILITAS KITE" <?php if($r12['sisa']=="KITE"){echo "selected";}?>>Fasilitas KITE</option>
        <option value="FASILITAS KITE TH" <?php if($r12['sisa']=="FKTH"){echo "selected";}?>>FS KITE/TH</option>
        <option value="FASILITAS KITE SISA">FS KITE/SISA</option>
        <option value="SISA">Sisa</option>
        <option value="FOC">FOC</option>
        <option value="TH" <?php if($r12['sisa']=="TH"){echo "selected";}?>>TH</option>
        <option value="BB" <?php if($r12['sisa']=="BB"){echo "selected";}?>>BB</option>
        <option value="BS" <?php if($r12['sisa']=="BS"){echo "selected";}?>>BS</option>
      </select></td>
    </tr>
    <tr>
      <td>YARD</td>
      <td>:</td>
      <td>
        <input name="txt_yard" type="text" id="txt_yard" size="10" placeholder="0" onkeyup="angka(this);" readonly="readonly" value="" tabindex="10"/> <label>
<input type="checkbox" name="M" id="checkbox" value="Meter" onclick="jumlah()" <?php if($rd['satuan']=="Meter"){ echo "checked disabled";} else if($rd['satuan']=="Yard"){ echo "disabled";}?>/>
      Meter</label>
        <input name="mtr" type="hidden" id="mtr" value=""  />
        <input name="satuan" type="hidden" id="satuan" value=""  />
        <label>
          <input type="checkbox" name="manual" id="manual" onclick="jumlah()" />
          Manual
      </label></td>
      <td>NET WEIGHT</td>
      <td>:</td>
      <td><input name="txt_net_weight" type="text" id="txt_net_weight" size="5" placeholder="0"  onchange="jumlah()" onkeyup="angka(this);" value="<?php if($sql>0){echo $r['net_weight'];}?>" tabindex="18"/> 
      KGS.  <label><input name="tdkm" type="checkbox" id="tdkm"  value="1" 
       <?php if($rd=="y" or $z=="1"){ echo "checked ";} else { echo " ";}?> />
      Tidak Masuk</label></td>
    </tr>
    <tr>
      <td>PACKED</td>
      <td>:</td>
      <td><label>
       <?php
	  $host="192.168.0.254";
$username="root";
$password="gogogo";
$db_name="db_qc";
$conn=mysql_connect($host,$username,$password) or die ("Sorry our web is under maintenance. Please visit us later");
	mysql_select_db($db_name) or die ("Under maintenance");
date_default_timezone_set('Asia/Jakarta');

$tanggal= mysql_query("SELECT date_format(curdate(),'%d-%M-%Y') as tgk");
$sr=mysql_fetch_array ($tanggal);
$tglsk=rtrim($sr['tgk']);
?>
        <input name="txt_paket" type="text" id="txt_paket" value="<?php echo $tglsk ;?>" size="20"  readonly="readonly" tabindex="11"/>
      </label></td>
      <td>GRADE</td>
      <td>:</td>
      <td><select name="txt_grade" tabindex="19" >
      	<option value="PILIH">PILIH</option>
        <option value="A" >A</option>
        <option value="B">B</option>
        <option value="C">C</option>
        <option value="" > </option>
      </select>
      <?php if($_GET['gd']=='C'){ ?>
      <input name="ket" type="text" />
      <?php } ?>
      </td>
    </tr>
    
    <tr>
      <td colspan="6" align="center">

  <button type="submit" name="submit" value="SIMPAN" tabindex="20">SIMPAN</button>
      <button type="reset" tabindex="21" onclick="window.location.href='form-Packing'"> BATAL</button>
      <?php if($_GET['kkno']!=""){?>
<div align="left">
<?php if($r['bruto']!=""){ ?>
<a href='pages/detail_cetak.php?id=<?php echo $_GET['kkno']; ?>' >Cetak Detail</a>
<?php }else {?> 
<a href='pages/detail_cetak_ONLINE.php?id=<?php echo $_GET['kkno']; ?>'> Cetak Detail</a></div>
<?php }

}?>
     </td>
    </tr>
  </table>
  
</form> 
<form id="form2" name="form2" method="post" action="">
<div align="center"> DETAIL DATA</div>
  <table width="670" border="1">
    <tr>
      <th width="42" bgcolor="#9966CC" scope="col">No</th>
      <th width="163" bgcolor="#9966CC" scope="col">No KK</th>
      <th width="69" bgcolor="#9966CC" scope="col">No Roll</th>
      <th width="75" bgcolor="#9966CC" scope="col">Qty (KG)</th>
      <th width="77" bgcolor="#9966CC" scope="col">Yard</th>
      <th width="50" bgcolor="#9966CC" scope="col">Grade</th>
      <th width="90" bgcolor="#9966CC" scope="col">Ket</th>
      <th width="60" bgcolor="#9966CC" scope="col">AKSI</th>
    </tr>
    
    <?php
	//tambahan
	$cekdata=mysql_query("select * from tbl_kite left join tmp_detail_kite on nokk=nokkkite  where nokk='$r[nokk]' and no_mutasi='$r[no_mutasi]'");
	$cekdt=mysql_fetch_array($cekdata);
	if($cekdt['no_mutasi']==''){
		$data=mysql_query("select * from tmp_detail_kite where nokkKite='$r[nokk]'");
		
	} else if($cekdt['no_mutasi']!='' and substr($cekdt['user_packing'],0,7)=='PACKING')
	{
		$data=mysql_query("select * from tmp_detail_kite where nokkKite='$r[nokk]' and (sisa='TH' or sisa='FKTH')");
		}
	else{$data=mysql_query("select * from tmp_detail_kite where nokkKite=''");echo"<font color=red>Data Sudah Di Mutasi Ke Gudang Kain Jadi</font>";}
	$no=1;
	 while($rowd=mysql_fetch_array($data)){?>
     <?php $data1=mysql_query("select * from detail_kite where nokkKite='$rowd[nokkKite]' and no_roll='$rowd[no_roll]'");
	 $rowd1=mysql_fetch_array($data1); ?>
    <tr>
      <td align="center" bgcolor="#CCCCCC"><?php echo $no; ?></td>
      <td align="center" bgcolor="#CCCCCC"><?PHP echo $rowd['nokkKite']; ?></td>
      <td align="center" bgcolor="#CCCCCC"><?PHP echo $rowd['no_roll']; ?></td>
      <td align="center" bgcolor="#CCCCCC"><?PHP echo number_format($rowd['net_wight'],'2','.',','); ?></td>
      <td align="center" bgcolor="#CCCCCC"><?PHP echo $rowd['yard_']; ?></td>
      <td align="center" bgcolor="#CCCCCC"><?PHP echo $rowd['grade']; ?></td>
      <td align="center" bgcolor="#CCCCCC"><?PHP echo $rowd['sisa']; ?></td>
      <td align="center" bgcolor="#CCCCCC"><a href="pages/simpan_cetak.php?nokk=<?PHP echo $rowd['nokkKite']; ?>&rol=<?PHP echo $rowd['no_roll']; ?>">CETAK</a>&nbsp;&nbsp;||&nbsp;&nbsp;<a href="pages/hapus.php?nokk=<?PHP echo $rowd['nokkKite']; ?>&id=<?PHP echo $rowd1['id']; ?>&idtmp=<?PHP echo $rowd['id']; ?>">HAPUS</a></td>
    </tr>
    <?php 
	$totalyard=$totalyard+$rowd['yard_'];
	$totalqty=$totalqty+$rowd['net_wight'];
	$no++;}?>
    <p align="right"><font color="red">
    <b>Total Yard : <?php echo $totalyard; ?><br />
    <b>Total Qty : <?php echo $totalqty; ?></b> </font></p>
  </table>
</form>


</body>
</html>
