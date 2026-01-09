<?php 
//include"koneksi.php";
$con=mysqli_connect("10.0.0.10","dit","4dm1n","db_qc");	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script>
   
function ganti()
{     var lprn= document.forms['form2']['lprn'].value;  
if(lprn=="Online"){
	window.location.href="index1.php?p=cek_harian_online";
	}

}
           </script> 
<style type="text/css">
.hurufs {
	color: #FFFFFF;
}
</style>
<script language="javascript">
var win = null;
function NewWindow(mypage,myname,w,h,scroll){
LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
TopPosition = (screen.height) ? (screen.height-h)/2 : 0;
settings =
'height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',resizable'
win = window.open(mypage,myname,settings)
}
</script>
</head>

<body>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_s = 10;
$pageNum_s = 0;
if (isset($_GET['pageNum_s'])) {
  $pageNum_s = $_GET['pageNum_s'];
}
$startRow_s = $pageNum_s * $maxRows_s;
$query_s = "SELECT no_sj,id,tgl_update,tgl_buat,ket FROM packing_list where no_sj like '%$_POST[no]%' GROUP BY no_sj,tgl_update order by id desc";
$query_limit_s = sprintf("%s LIMIT %d, %d", $query_s, $startRow_s, $maxRows_s);
$s = mysqli_query($con,$query_limit_s) or die(mysql_error());
$row_s = mysqli_fetch_assoc($s);

if (isset($_GET['totalRows_s'])) {
  $totalRows_s = $_GET['totalRows_s'];
} else {
  $all_s = mysqli_query($con,$query_s);
  $totalRows_s = mysqli_num_rows($all_s);
}
$totalPages_s = ceil($totalRows_s/$maxRows_s)-1;

$queryString_s = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_s") == false && 
        stristr($param, "totalRows_s") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_s = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_s = sprintf("&totalRows_s=%d%s", $totalRows_s, $queryString_s);
?><br />
      <br />
<form id="form1" name="form1" method="post" action="">
  <table width="517">
    <tr>
      <td colspan="3"><div align="center">CETAK PACKING LIST</div> 
	 </div>
	  <?php 
	  $user_name=$_SESSION['username'];
	  date_default_timezone_set('Asia/Jakarta');
	$tgl=date("Y-M-d h:i:s A");
	  echo $tgl;?><br />GROUP SHIFT: <strong><?php echo $_SESSION['username']; ?></strong></td>
    </tr>
    <tr>
      <td width="128">No Surat Jalan</td>
      <td width="5">:</td>
      <td width="368"><input type="text" id="no" name="no"/>
     </td>
    </tr>
    <tr>
      <td><input type="submit" name="button" id="button" value="Cari Data" 
      /></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>
<table width="40%" border="5">
  <tr class="hurufs">
    <td bgcolor="#0000FF"><div align="center">No</div></td>
    <td bgcolor="#0000FF"><div align="center">No Surat Jalan</div></td>
    <td bgcolor="#0000FF"><div align="center">Tgl Kirim</div></td>
    <td bgcolor="#0000FF"><div align="center">Tgl Buat</div></td>
	<td bgcolor="#0000FF"><div align="center">AKSI</div></td>
	<td bgcolor="#0000FF"><div align="center">Alamat</div></td>
  </tr>
  <?php 
   $no=1; do { ?>
  <tr>
    <td><?php echo $no;?></td>
    <td><?php echo $row_s['no_sj'];?></td>
    <td align="center"><?php echo $row_s['tgl_update'];?></td>
    <td align="center"><?php echo $row_s['tgl_buat'];?></td>
    <td align="center"><?php if($row_s['ket']=="KAIN"){?><a href="pages/cetak_surat_jalan.php?no_sj=<?php echo $row_s['no_sj']; ?>&tgl_kirim=<?php echo $row_s['tgl_update'];?>" target="_blank" >Cetak</a>
    <?php }else if($row_s['ket']=="KAIN-EXPORT"){?><a href="pages/cetak_surat_jalan_export.php?no_sj=<?php echo $row_s['no_sj']; ?>&tgl_kirim=<?php echo $row_s['tgl_update'];?>" target="_blank" >Cetak</a> 
	<?php }else if($row_s['ket']=="KRAH"){?> <a href="pages/cetak_surat_jalan_krah.php?no_sj=<?php echo $row_s['no_sj']; ?>&tgl_kirim=<?php echo $row_s['tgl_update'];?>" target="_blank" >Cetak</a><?php } ?></td>
    <td align="center"><input name="potong" type="button" value="..." onclick="NewWindow('pages/alamat_sj.php?id=<?PHP echo $row_s['id']; ?>&amp;no_sj=<?PHP echo $row_s['no_sj']; ?>&amp;tgl_kirim=<?PHP echo $row_s['tgl_update']; ?>','MyWindow','width=150,height=220,left=300,top=300');"/></td>
  </tr>
  <?php $no++;} while ($row_s = mysqli_fetch_assoc($s)); ?>
</table>
<table border="0">
    <tr>
      <td><?php if ($pageNum_s > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_s=%d%s", $currentPage, 0, $queryString_s); ?>"> First </a> || 
      <?php } // Show if not first page ?></td>
      <td><?php if ($pageNum_s > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_s=%d%s", $currentPage, max(0, $pageNum_s - 1), $queryString_s); ?>"> Previous </a>||
      <?php } // Show if not first page ?></td>
      <td><?php if ($pageNum_s < $totalPages_s) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_s=%d%s", $currentPage, min($totalPages_s, $pageNum_s + 1), $queryString_s); ?>"> Next </a>||
      <?php } // Show if not last page ?></td>
      <td><?php if ($pageNum_s < $totalPages_s) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_s=%d%s", $currentPage, $totalPages_s, $queryString_s); ?>"> Last </a>
          <?php } // Show if not last page ?></td>
  </tr>
</table>
</h3>
<hr />
<?php
mysqli_free_result($s);
?>
</body>
</html>
