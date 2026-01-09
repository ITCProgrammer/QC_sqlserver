<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Laporan Pengiriman</title>
<link rel="stylesheet" type="text/css" href="css/datatable.css" />
<link rel="stylesheet" type="text/css" href="css/jquery-ui.css" />
<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/jquery.dataTables.js" type="text/javascript"></script>
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
<?php 
$sqlKonv = mysql_query("SELECT * from tbl_konversi_accsj LIMIT 1");
$dtKonv = mysql_fetch_array($sqlKonv);
$cekKonv=mysql_num_rows($sqlKonv);
?>
<body>
<form id="form1" name="form1" method="POST" action="pages/simpan_approve_acc.php?tgl=<?php echo $_POST['awal']; ?>&nosj=<?php echo $_POST['no_sj']; ?>" onsubmit="return myFungsi()">
<?php 
$bulan=array("","JANUARI","FEBRUARI","MARET","APRIL","MEI","JUNI","JULI","AGUSTUS","SEPTEMBER","OKTOBER","NOVEMBER","DESEMBER");
$bln=number_format(date("m", strtotime($_POST['awal'])));
$thn=date("Y", strtotime($_POST['awal'])); ?>
<div align="center">LAPORAN HARIAN PENGIRIMAN LAIN-LAIN<br />
BULAN <?php echo $bulan[$bln]." ".$thn; ?> </div> 
<br />
<h3><a href="pages/excel_accsj.php?awal=<?php echo $_POST['awal'];?>&no_sj=<?php echo $_POST['no_sj'];?>">CETAK EXCEL</a></h3>
<table width="100%" border="0" class="display" id="datatables">
 <thead>
  <tr bgcolor="#3399CC">
    <th align="center" width="5%">NO</th>
    <th bgcolor="#9966CC" scope="col">
        <label for="checkbox"></label>
      <input type="checkbox" name="allbox" value="check" onClick="checkAll(0);" /><br /><font color="red"> APPROVE ALL</font></th>
    <th align="center" width="5%">TGL APPROVE</th>
    <th align="center" width="10%">TGL BUAT</th>
    <th align="center" width="10%">TGL KIRIM</th>
    <th align="center" width="8%">NO SJ</th>
    <th align="center" width="10%">WARNA</th>
    <th align="center" width="8%">ROLL</th>
    <th align="center" width="8%">QUANTITY (KG)</th>
    <th align="center" width="8%">PANJANG (YARD/METER)</th>
    <th align="center" width="8%">PCS</th>
    <th align="center" width="12%">BUYER</th>
    <th align="center" width="10%">NO PO</th>
    <th align="center" width="10%">NO ORDER</th>
    <th align="center" width="20%">JENIS KAIN</th>
    <th align="center" width="6%">LOT</th>
    <th align="center" width="5%">CURRENCY</th>
    <th align="center" width="5%">SATUAN</th>
    <th align="center" width="5%">UNIT PRICE</th>
    <th align="center" width="5%">&nbsp;</th>
  </tr>
  </thead>
  <tbody>
  <?php 
  $ttgl=date("d", strtotime($_POST['awal']));
  $newdate = strtotime( '-1 day' , strtotime ($_POST['awal']) );
  $ttglm=date("d", $newdate);
  if($_POST['awal']!=""){
	  $tgll= " a.tgl_update='$_POST[awal]' ";
	  }else {$tgll="";}
  if($_POST['no_sj']!="" and $_POST['awal']!=""){
	  $sj= " And a.no_sj='$_POST[no_sj]' ";
	  }	 
  if($_POST['no_sj']!="" and $_POST['awal']=="") 
	  { $sj= " a.no_sj='$_POST[no_sj]' "; }	  
  
$tt=date("Y-m-d", strtotime($_POST['awal']));
  $awal=date("Y-m-", strtotime($_POST['awal']));
  $nawal=$awal."01";
  $newdate1 = strtotime( '-1 day' , strtotime ($_POST['awal']) );
  $ttm=date("Y-m-d", $newdate1);
  $sql1=mysql_query("SELECT sum(qty) as qty from tbl_pengiriman 
WHERE tmp_hapus='0' AND not no_sj='' AND tgl_buat BETWEEN '$nawal' AND '$tt' AND kategori='lain-lain' ");
$row1=mysql_fetch_array($sql1);
 $sql2=mysql_query("SELECT sum(qty) as qty from tbl_pengiriman 
WHERE tmp_hapus='0' AND not no_sj='' AND tgl_buat BETWEEN '$nawal' AND '$ttm' AND kategori='lain-lain'");
$row2=mysql_fetch_array($sql2);	
    if($_POST['awal']!=""){
      $tgl2l= " tmp_hapus='0' AND tgl_buat='$_POST[awal]' ";
      }else{$tgl2l= " tmp_hapus='0' AND tgl_update!='' ";}	  
    if($_POST['no_sj']!=""){
      $sj2= " AND no_sj='$_POST[no_sj]' ";
      }
	$sqlbr=mysql_query("SELECT
	id,tgl_kirim,tgl_buat,no_sj,warna,rol,qty,panjang,netto,buyer,no_po,no_order,no_item,jenis_kain,lot,tujuan,ket,foc,satuan_mkt,currency,price,approve_acc,ipaddress_acc,tgl_approve_acc
FROM
	tbl_pengiriman
WHERE
	not no_sj='' AND kategori='lain-lain' AND $tgl2l $sj2
ORDER BY no_sj asc");
$no=1;
$c=0;
while($row3=mysql_fetch_array($sqlbr)){
  $bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99';
  ?>
  <tr bgcolor="<?php echo $bgcolor;?>" >
    <td><?php echo $no;?></td>
    <td align="center" >
    <?php if($row3['approve_acc']=="Approve"){?>
    <a href="#" onClick="window.open('pages/edit_approve_acc.php?id=<?php echo $row3['id']; ?>&nosj=<?php echo $row3['no_sj']; ?>','MyWindow','height=200,width=500,top=250,left=500');">
        <?php
        $sqlAppr = mysql_query("SELECT * from tbl_pengiriman where `id`='$row3[id]' LIMIT 1");
        $dtAppr = mysql_fetch_array($sqlAppr);
        if ($dtAppr['approve_acc'] != '') {
            echo $dtAppr['approve_acc'];
        } else {
            echo "Empty";
        }
        ?>
    </a>
      <?php } ?>
     <br>
     <?php if($row3['approve_acc']=="" OR $row3['approve_acc']==NULL){?>
		  <?php 
     echo '<input type="checkbox" name="check['.$n.']" value="'.$row3['id'].'"';
    $n++;
    ?>
    <?php } ?>
    </td>
    <td><?php echo $row3['tgl_approve_acc']; ?></td> 
    <td><?php echo date("d-M-Y", strtotime($row3['tgl_buat'])) ?></td>
    <td><?php echo date("d-M-Y", strtotime($row3['tgl_kirim'])) ?></td>
    <td><?php echo $row3['no_sj']; ?></td>
    <td><?php echo $row3['warna']; ?></td>
    <td align="right"><?php echo $row3['rol']; ?></td>
    <td align="right"><?php echo $row3['qty']; ?></td>
    <td align="right"><?php echo $row3['panjang']; ?></td>
    <td align="right"><?php echo $row3['netto']; ?></td>
    <td><?php echo $row3['buyer']; ?></td>
    <td><?php echo $row3['no_po']; ?></td>
    <td><?php echo $row3['no_order']; ?></td>
    <td><?php echo $row3['jenis_kain']; ?></td>
    <td><?php echo $row3['lot']; ?></td>
    <td><?php echo $row3['currency']; ?></td>
    <td><?php echo $row3['satuan_mkt']; ?></td>
    <td><?php echo $row3['price']; ?></td>
    <td align="right"><?php if($row3['currency']=="US$" AND ($row3['satuan_mkt']=='yard' OR $row3['satuan_mkt']=='meter')){echo number_format((($row3['price']*$row3['panjang'])*$dtKonv['konversi'])/$row3['panjang'],3);}
    else if($row3['currency']=="US$" AND $row3['satuan_mkt']=='kg'){echo number_format((($row3['price']*$row3['qty'])*$dtKonv['konversi'])/$row3['qty'],3);}
    else if($row3['currency']=="US$" AND $row3['satuan_mkt']=='pc'){echo number_format((($row3['price']*$row3['netto'])*$dtKonv['konversi'])/$row3['netto'],3);}
    else if($row3['currency']=="Rp" AND ($row3['satuan_mkt']=='yard' OR $row3['satuan_mkt']=='meter')){echo number_format(($row3['price']*$row3['panjang'])/$row3['panjang'],3);}
    else if($row3['currency']=="Rp" AND $row3['satuan_mkt']=='kg'){echo number_format(($row3['price']*$row3['qty'])/$row3['qty'],3);}
    else if($row3['currency']=="Rp" AND $row3['satuan_mkt']=='pc'){echo number_format(($row3['price']*$row3['netto'])/$row3['netto'],3);}
    else{echo "0.000";} ?></td>
  </tr>
  <?php $no++;
  } ?>
  </tbody>
  <tfoot>
  <tr bgcolor="#33CC99" style="">
    <td colspan="5">Total Tanggal <?php echo $ttgl;?></td>
    <td align="right"><?php echo $totrol; ?></td>
    <td align="right"><?php echo number_format(round($totqty,2),'2',',','.'); $qt1=round($totqty,2); ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr bgcolor="#33CC99" style="">
    <td colspan="6">Total
      <?php if($ttgl=="01"){}else{ ?>
      Tanggal 01 S/D <?php echo $ttglm; }?></td>
    <td align="right"><?php echo number_format(round($row2['qty'],2),'2',',','.');$qt2=round($row2['qty'],2);?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr bgcolor="#33CC99" style="border-bottom: 1px solid;">
    <td colspan="6">Total Tanggal 01 S/D <?php echo $ttgl;?></td>
    <td align="right"><?php echo number_format($qt1+$qt2,'2',',','.');?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
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
<?php if($_SESSION['password']=='accsj'){ ?>
  <?php if($_POST['no_sj']!="" or $_POST['awal']!=""){?>
  <input name="submit" type="submit" value="SIMPAN">
  <?php } }?>
</form>
<script>
function myFungsi() {
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
</body>
</html>