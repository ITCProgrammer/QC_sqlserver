<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

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
                var no_ref = document.forms['form1']['no_ref'].value;
				var tgls = document.forms['form1']['tgl_transfer'].value;
				var partners = document.forms['form1']['partners'].value;
				
				
                if(no_ref==null || no_ref=="" )
                    {
                        alert("No Ref Masih Kosong!!!");
                        return false;
                    } else
					if(tgls==null || tgls=="" )
                    {
                        alert("Tgl Transfer Masih Kosong!!!");
                        return false;
                    }else
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
				

</script>
</head>

<body>
<form  action="pages/simpan-detail-list.php" method="POST" name="form1" id="form1" onSubmit="return myFungsi();">
 <div align="center"><h1>INPUT DATA BENANG WARNA</h1></div><hr />
 <fieldset>
 <legend>Data Pokok</legend>
  <table width="679" border="0">
    <tr>
      <td colspan="6">      
      TGL:
        <?PHP 
	$tgl1=date("Y-M-d H:i:s");
	
	  echo $tgl1; 
	
	
	  ?>
     
        
        <input type="hidden" name="nokku" value="<?php echo $nou; ?>" />
        
      
        <table width="624" border="0">
          <tr>
            <td width="132">Nomor</td>
            <td width="10">:</td>
            <td width="468"><input name="nokk" type="text"  onchange="window.location='?module=benang-out-partner&kkno='+this.value"  value="<?php echo $_GET['kkno'];?>"  tabindex="1"/></td>
           <?php $cari2=mysql_query("Select * from `db_yarn`.`benang_warna` 
left join `db_yarn`.`detail_benang_warna` on `db_yarn`.`detail_benang_warna`.`id_benang`= `db_yarn`.`benang_warna`.`id`		   
left join `db_yarn`.`pergerakan_stok` on `db_yarn`.`pergerakan_stok`.`id_benang`= `db_yarn`.`benang_warna`.`id` 
where nokk='$_GET[kkno]'")or die("Gagal");
	$r2=mysql_fetch_array($cari2); ?>
          </tr>
          <tr>
            <td>No Order</td>
            <td>:</td>
            <td><input type="text" name="no_do" id="no_do" value="<?php if($cari2>0){echo $r2['pono'];}?>" tabindex="2" /></td>
          </tr>
          <tr>
            <td>No Ref</td>
            <td>:</td>
            <td><input name="no_ref" type="text" id="no_ref" tabindex="3" value="" size="6" /> 
            Harus di isikan</td>
          </tr>
          <tr>
            <td valign="top">Tgl Transfer Out</td>
            <td>:</td>
            <td><label for="tgl_transfer"></label>
              <input name="tgl_transfer" type="text" id="tgl_transfer" onClick="if(self.gfPop)gfPop.fPopCalendar(document.form1.tgl_transfer);return false;" size="15"  tabindex="4"/></td>
          </tr>
          <tr>
            <td valign="top">Catatan</td>
            <td>:</td>
            <td><label for="catatan"></label>
              <textarea name="catatan" id="catatan" cols="40" rows="2" tabindex="5"></textarea></td>
          </tr>
        </table>
      
        </td>
      
    </tr>
   
    <tr>
      <td width="88">PELANGGAN</td>
      <td width="5">:</td>
      <td width="252"><label for="partners"></label>
        <select name="partners" id="partners" tabindex="6">
        <option value="">PILIH</option>
		<?php 
        $ptr=mysql_query("select * from partners order by id asc");
		while($r1=mysql_fetch_array($ptr))
		{ echo" <option value='$r1[id]' >$r1[partnername]</option>";
		
			}
      ?>
	  </select></td>
      <td width="63">Keterangan</td>
      <td width="5">:</td>
      <td width="197"><input name="tketerangan" type="text" id="tketerangan" size="30"  value=""  tabindex="9"/></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    
    <tr>
      <td colspan="6" align="center">

  </td>
    </tr>
    
  </table>
  </fieldset>

<p>&nbsp;</p>
<p>
  <?php 
$qry=mysql_query("Select *,count(`detail_benang_warna`.weight) as unit,`detail_benang_warna`.`id` as kd from `db_yarn`.`benang_warna` 
left join `db_yarn`.`detail_benang_warna` on `db_yarn`.`detail_benang_warna`.`id_benang`= `db_yarn`.`benang_warna`.`id`		   
left join `db_yarn`.`pergerakan_stok` on `db_yarn`.`pergerakan_stok`.`id_benang`= `db_yarn`.`benang_warna`.`id` 
where nokk='$_GET[kkno]' and `pergerakan_stok`.`typestatus`=0 and `pergerakan_stok`.`typetrans`=1 
GROUP BY `db_yarn`.`detail_benang_warna`.`id`");

?>
</p>
<div align="center">
<h1>Detail  Benang Warna</h1></div><hr />
<table width="100%" border="0">
  <tr bgcolor="#7FFF55" align="center">
    <td><input type="checkbox" name="allbox" value="check" onClick="checkAll(0);" /><font color="red">Pilih Semua</font></td>
    <td>NO</td>
    <td>NO SERI</td>
    <td>JENIS BENANG</td>
    <td>WARNA</td>
    <td>NO. WARNA</td>
    <td>KEIR NO</td>
    <td>QTY</td>
    <td>BERAT(KG)</td>
    <td>KETERANGAN</td>
  </tr>
  <?php $n=1;$no=1;while($row=mysql_fetch_array($qry)){
	  
	     $cek=mysql_query("select * from pergerakan_stok 
		 left join detail_pergerakan_stok on pergerakan_stok.id= detail_pergerakan_stok.id_stok
		 where id_detail_benang='$row[kd]'");
		   $crow=mysql_fetch_array($cek);
	  if($crow>0){}else{
		  
	  ?>
  
 
  
  <tr >
    <td><?php
   
     echo '<input type="checkbox" name="check['.$n.']" value="'.$n.'">ke '.$n;
  $n++;
   ?></td>
    <td><?php echo $no;?></td>
    <td><?php echo $row[docno];?></td>
    <td><?php echo $row[desck];?></td>
    <td><?php echo $row[colorname];?></td>
    <td><?php echo $row[colorno];?></td>
    <td align="right"><?php echo $row[lotno];?></td>
    <td align="right"><?php echo $row[unit];?></a></td>
    <td align="right"><?php echo number_format($row[weight],"2",",",".");?></td>
    <td><?php echo $row[ket];?></td>
  </tr>
  <?php $no++;
  $totunit=$totunit+$row[unit];
  $totwarna=$totwarna+$row[weight];
  } }?>
  <tr bgcolor="#7FFF55"  align="center">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="right"><strong><?php echo $totunit; ?></strong></td>
    <td align="right"><strong><?php echo number_format($totwarna,"2",",",".");?></strong></td>
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