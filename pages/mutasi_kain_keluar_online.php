<?php
$host="10.0.0.4";
$username="timdit";
$password="4dm1n";
$db_name="TM";
 set_time_limit(600);
	$conn=mssql_connect($host,$username,$password) or die ("Sorry our web is under maintenance. Please visit us later");
	mssql_select_db($db_name) or die ("Under maintenance");
		
	?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script>
   
          function ganti()
{     var lprn= document.forms['form1']['lprn'].value;  
if(lprn=="Manual"){
	window.location.href="index1.php?p=mutasi_kain_keluar";
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
<form name="form1" action="pages/simpan_mutasi_kain_keluar_online.php" method="post" onsubmit="return myFungsi();">

<?php
 
		$lotp=substr($_GET['lot'],0,6);
if($_GET['nowarna']!=''){$where1.= "and productmaster.color='$_GET[nowarna]'";}
if($_GET['lot']!=''){$where2.= "and productprop.pcbid='$lotp'";}
	if($_GET['nokk']!='')
	{
	$sql="select stockmovement.id as kd,productprop.id as iddt,productprop.pcbid,SN,rollno,stockmovementdetails.Length,stockmovementdetails.weight,productprop.pono as pono,productprop.batchno,productprop.Width,productprop.WeightPerArea from stockmovement 
left join stockmovementdetails on  stockmovementdetails.stockmovementid=stockmovement.id
left join productprop on productprop.id = stockmovementdetails.productpropid
left join productmaster on productmaster.id = stockmovementdetails.productid
where stockmovement.wid=22 and stockmovement.transactiontype=4 and stockmovement.transactionstatus=1 and productprop.batchno='$_GET[nokk]'order by rollno";
$data=mssql_query($sql);
 
$sql21="select stockmovement.id as kd,productprop.id as iddt,productprop.pcbid,SN,rollno,productprop.pcbid,SN,rollno,stockmovementdetails.Length,stockmovementdetails.weight,productprop.pono as pono,productprop.batchno,productprop.Width,productprop.WeightPerArea,productmaster.colorno,productmaster.color from stockmovement 
left join stockmovementdetails on  stockmovementdetails.stockmovementid=stockmovement.id
left join productprop on productprop.id = stockmovementdetails.productpropid
left join productmaster on productmaster.id = stockmovementdetails.productid
where stockmovement.wid=22 and stockmovement.transactiontype=4 and stockmovement.transactionstatus=1 and productprop.batchno='$_GET[nokk]'order by rollno";
$data21=mssql_query($sql21); 
$r21=mssql_fetch_array($data21);

$sqlsvr9=mssql_query("select otherdesc,salesorders.ponumber,processcontrol.productid,salesorders.customerid,joborders.documentno,
salesorders.buyerid,processcontrolbatches.lotno,hangerno,color,colorno,shortdescription,weight,cuttablewidth from Joborders 
left join processcontrolJO on processcontrolJO.joid = Joborders.id
left join salesorders on soid= salesorders.id
left join sogarmentstyle on sogarmentstyle.soid= salesorders.id
left join processcontrol on processcontrolJO.pcid = processcontrol.id
left join processcontrolbatches on processcontrolbatches.pcid = processcontrol.id
left join productmaster on productmaster.id= processcontrol.productid  
where processcontrolbatches.documentno='$_GET[nokk]'

");
$row9=mssql_fetch_array($sqlsvr9);

 $p1=mssql_query("select partnername from partners where id='$row9[customerid]'");
 	  $r5=mssql_fetch_array($p1);
	  $p2=mssql_query("select partnername from partners where id='$row9[buyerid]'");
 	  $r6=mssql_fetch_array($p2);

	}?>
<table width="50%" border="0">
  <tr>
    <th colspan="6" scope="row">&nbsp;</th>
  </tr>
  <tr>
    <th colspan="6" scope="row">Mutasi Kain Keluar Online</th>
  </tr>
  <tr>
    <th scope="row">&nbsp;</th>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <th scope="row" align="right">Mutasi Keluar</th>
    <td>:</td>
    <td><label for="select"></label>
      <select name="lprn" onchange="ganti()">
        <option value="Online" selected="selected" >Online</option>
        <option value="Manual">Manual</option>
      </select></td>
    <td>No Warna</td>
    <td>:</td>
    <td><select name="nowarna"  onchange="window.location='form-Packing?p=mutasi_kain_keluar_online&amp;nokk=<?php echo $_GET['nokk'];?>&amp;nowarna='+this.value">
      <?php
	  
	$sql1="select color from stockmovement 
left join stockmovementdetails on  stockmovementdetails.stockmovementid=stockmovement.id
left join productprop on productprop.id = stockmovementdetails.productpropid
left join productmaster on productmaster.id = stockmovementdetails.productid
where stockmovement.wid=22 and stockmovement.transactiontype=4 and stockmovement.transactionstatus=1 and productprop.batchno='$_GET[nokk]' group by color ";
$data1=mssql_query($sql1);
 ?>
      <?php 
	  if($_GET['nokk']!='') {
		  
	  while ($r1=mssql_fetch_array($data1)){ ?>
      <option value="<?php echo $r1['color']; ?>"><?php echo $r1['color']; ?></option>
      ";
		  
      
      <?php } }?>
      <option value="<?php echo $_GET['nowarna']; ?>" selected="selected"><?php echo $_GET['nowarna']; ?></option>
      <option value="" ></option>
    </select></td>
  </tr>
  <tr>
    <th width="13%" scope="row" align="right">No. KK</th>
    <td width="2%">:</td>
    <td width="54%"><input type="text" name="nokk" id="nokk" onchange="window.location='form-Packing?p=mutasi_kain_keluar_online&amp;nokk='+this.value" value="<?php echo $_GET['nokk'];?>" /></td>
    <td width="10%">Lot</td>
    <td width="2%">:</td>
    <td width="19%"><select name="lot">
      <?php
	$sql2="select productprop.pcbid,lotno from stockmovement 
left join stockmovementdetails on  stockmovementdetails.stockmovementid=stockmovement.id
left join productmaster on productmaster.id = stockmovementdetails.productid
left join productprop on productprop.id = stockmovementdetails.productpropid
left join processcontrolbatches on processcontrolbatches.id=productprop.pcbid
where stockmovement.wid=22 and stockmovement.transactiontype=4 and stockmovement.transactionstatus=1 and productprop.batchno='$_GET[nokk]'  and productmaster.color='$_GET[nowarna]' group by productprop.pcbid,processcontrolbatches.LotNo";
$data2=mssql_query($sql2); ?>
      <?php 
	  
	  while ($r2=mssql_fetch_array($data2)){
		   
	  $lot1=mssql_query("select pcid from processcontrolbatches where id='$r2[pcbid]'");
	  $r8=mssql_fetch_array($lot1);
	  $nokkb=substr($_GET['nokk'],0,12);
	  
	   $lot2=mssql_query("select count(CID)as jmllot from processcontrolbatches where pcid='$r8[pcid]' and substring(documentno,0,13)='$nokkb'
group by processcontrolbatches.CID");
	  $r9=mssql_fetch_array($lot2);
	  
	  ?>
      <option value="<?php echo $r2['pcbid']; ?>'<?php echo $r9['jmllot']."-".$r2['lotno']; ?>"><?php echo $r9['jmllot']."-".$r2['lotno']; ?></option>
      <?php } ?>
      <option value="<?php echo substr($_GET['lot'],7,14);?>" selected="selected">
        <?php  echo substr($_GET['lot'],7,14); ?>
        </option>
      <option value="" ></option>
    </select></td>
  </tr>
  <tr>
    <th scope="row" align="right">No. PO</th>
    <td>:</td>
    <td><input name="no_po" type="text" id="no_po" 
    onchange="window.location='form-Packing?p=mutasi_kain_keluar_online&amp;nokk=<?php echo $_GET['nokk'];?>&amp;nopo='+this.value"
    value="<?php if($data2>0) {echo $r21['pono'];}?>" size="30" /></td>
    <td>No Ref/Bon</td>
    <td>:</td>
    <td><input name="no_ref" type="text" id="no_ref" size="20" /></td>
  </tr>
  <tr>
    <th scope="row" align="right">Langganan</th>
    <td>:</td>
    <td colspan="4"><input name="langgan" type="text" id="langgan" size="50" value="<?php echo $r5['partnername']." / ".$r6['partnername']; ?>" /></td>
    </tr>
  <tr>
    <th scope="row" align="right" valign="top">Keterangan</th>
    <td>:</td>
    <td colspan="4"><label for="ket"></label>
      <textarea name="ket" id="ket" cols="45" rows="5"></textarea></td>
    </tr>
  <tr>
    <th scope="row" align="right">&nbsp;</th>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<div align="center"> DETAIL DATA</div>
  <table width="670" border="1">
    <tr>
      <th width="42" bgcolor="#9966CC" scope="col">No</th>
      <th width="163" bgcolor="#9966CC" scope="col">S/N</th>
      <th width="69" bgcolor="#9966CC" scope="col">No Roll</th>
      <th width="75" bgcolor="#9966CC" scope="col">Netto (KG)</th>
      <th width="77" bgcolor="#9966CC" scope="col">Yard</th>
 
      <th width="60" bgcolor="#9966CC" scope="col"><input type="checkbox" name="allbox" value="check" onClick="checkAll(0);" /><font color="red">Check ALL</font></th>
    </tr>
    
    <?php
	//tambahan
	$no=1;
	$n=1;
	$c=0;
	 while($rowd=mssql_fetch_array($data)){
		 $cek=mysql_query("select * from pergerakan_stok 
		 left join detail_pergerakan_stok on pergerakan_stok.id= detail_pergerakan_stok.id_stok
		 where id_detail_kj='$rowd[iddt]'");
		   $crow=mysql_fetch_array($cek);
		 $bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99';
		 if($crow>0){}else{
		 ?>
    <tr bgcolor="<?php echo $bgcolor;?>">
      <td align="center" ><?php echo $no; ?></td>
      <td align="center" ><?PHP echo $rowd['SN']; ?></td>
      <td align="center" ><?PHP echo $rowd['rollno']; ?></td>
      <td align="center" ><?PHP echo number_format($rowd['weight'],'2','.',','); ?></td>
      <td align="center" ><?PHP echo number_format(round($rowd['Length'],2),'2','.',','); ?></td>
      <td align="center" ><?php
	  $yard_=number_format(round($rowd['Length'],2),'2','.',',');
   
     echo '<input type="checkbox" name="check['.$n.']" value="'.$n.'" />';
  $n++;
   ?></td>
    </tr>
    <?php 
	$totalyard=$totalyard+$yard_;
	$totalqty=$totalqty+$rowd['weight'];
	$no++;}}?>
    <p align="right"><font color="red">
    <b>Total Yard : <?php echo number_format($totalyard,'2','.',','); ?><br />
    <b>Total Qty : <?php echo number_format($totalqty,'2','.',','); ?></b> </font></p>
  </table>
  <input name="submit" type="submit" value="Mutasi Keluar"><input name="cetak" type="button" value="Cetak" onclick="window.location.href='form-Packing?p=cetak_list'">
</form>
</body>
</html>