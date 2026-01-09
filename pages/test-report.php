<?php
include("../koneksi.php");
//request page
$page	= isset($_GET['p'])?$_GET['p']:'';
$act	= isset($_GET['act'])?$_GET['act']:'';
$id		= isset($_GET['id'])?$_GET['id']:'';
$page	= strtolower($page);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>test-report</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="45%" border="0">
    <tr>
      <th width="89%" bgcolor="#0099CC" scope="col"><font color="#000033">TEST PROPERTY</font></th>
      <th width="11%" bgcolor="#0099CC" scope="col"><font color="#000033">PRINT</font></th>
    </tr>
   <?php 
   $n=1;
   $qry=mysql_query("SELECT id,jenis_test FROM tbl_jenis_test ORDER BY id ASC"); 
		while($r=mysql_fetch_array($qry)){
		$bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99'; ?>
	  <tr bgcolor="<?php echo $bgcolor;?>">
      <td><strong><?php echo $r[jenis_test];?></td>
      <td align="center" valign="middle"><?php 
     echo '<input type="checkbox" name="check['.$n.']" value="'.$r[jenis_test].'"';
  $n++;
   ?></td>
    </tr>
    <?php } ?>
    <tr>
      <td bgcolor="#0099CC"><input type="submit" name="Cetak" id="Cetak" value="Cetak"  class="art-button"/></td>
      <td align="center" valign="middle" bgcolor="#0099CC">&nbsp;</td>
    </tr>
  </table>
</form>
</body>
</html>