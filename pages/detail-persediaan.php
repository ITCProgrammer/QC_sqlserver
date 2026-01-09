<?php
ini_set("error_reporting",1);
include '../koneksi.php';
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
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Detail Masuk Kain Jadi</title>
</head>

<body>
No Kartu Kerja : <strong><em><?php echo $_GET["nokk"];?></em></strong>
<strong>
<?php $sql1=mysqli_query($con,"SELECT
	COUNT(weight) as totrol,
	SUM(weight) as totba,
	SUM(yard_) as totya
FROM
	detail_pergerakan_stok
WHERE
	nokk = '".$_GET['nokk']."'
AND (
	status = '0'
) AND sisa='".$_GET['ket']."'
 Order by no_roll ASC");
 $row1=mysqli_fetch_array($sql1);	
 ?>
<br />
Total Roll : <?php echo $row1["totrol"];?> || Berat : <?php echo number_format($row1["totba"],'2','.',',');?> ||  Panjang:<?php echo number_format($row1["totya"],'2','.',',');?>
</strong> <a href="detail-persediaan-excel.php?nokk=<?php echo $_GET['nokk'];?>&ket=<?php echo $_GET['ket'];?>">cetak ke excel</a>
<form name="form1" method="post" enctype="multipart/form-data" action="">	
<div class="rol"> 
  <table width="100%" border="0">
    <tr align="center" bgcolor="#3366FF">
      <td width="5%"><font color="white">No</font></td>
      <td width="13%"><font color="white">No Roll</font></td>
      <td width="18%"><font color="white">Berat (KG)</font></td>
      <td width="12%"><font color="white">Panjang</font></td>
      <td width="11%"><font color="white">Satuan</font></td>
      <td width="9%"><font color="white">Grade</font></td>
	  <?php if($_GET['uid']=="GB ADM" or $_GET['uid']=="GB ADM A" or $_GET['uid']=="GB ADM B"){ ?>	
      <td width="17%"><font color="white">SN</font></td>
	  <?php } ?>	
      <td width="6%"><font color="white">Ket</font></td>
      <td width="9%"><font color="white">Ket (Grade C)</font></td>
      <td width="9%"><font color="white">Status</font></td>
      <td width="9%"><font color="white">Lokasi</font></td>
    </tr>
    <?php
  $sql=mysqli_query($con,"SELECT
  	id,
	no_roll,
	weight,
	yard_,
	satuan,
	grade,
	sisa,
	SN,
	ket_c,
	transtatus,
	lokasi
FROM
	detail_pergerakan_stok
WHERE
	nokk = '".$_GET['nokk']."'
AND (
	(status = '0' or status = '1') and transtatus='1'
) AND sisa='".$_GET['ket']."'
 Order by no_roll ASC");
  $c=1;
  $no=1;
  while($row=mysqli_fetch_array($sql))
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
	  <?php if($_GET['uid']=="GB ADM" or $_GET['uid']=="GB ADM A" or $_GET['uid']=="GB ADM B") {?>	
      <td align="right"><?php echo $row['SN'];?></td>
	  <?php } ?>	
      <td align="center"><?php if($row['sisa']=="SISA" || $row['sisa']=="FKSI"){$sisa= "SISA";}else{$sisa=$row['sisa'];}echo $sisa;?></td>
      <td bgcolor="<?php echo $rn;?>"><?php echo $row['ket_c'];?></td>
      <?php  if($row['transtatus']=='0'){$kt="Sudah Keluar"; $rn="RED";}else{$kt="Ada"; $rn="";}?>
      <td bgcolor="<?php echo $rn;?>"> <?php echo $kt;?></td>
      <td align="center" bgcolor="<?php echo $rn;?>"><select name="lokasi[<?php echo $row['id']; ?>]">
        <option value="">Pilih</option>
        <?php $qryLok=mysqli_query($con,"SELECT lokasi FROM tbl_lokasi ORDER BY lokasi ASC");
		while($rLok=mysqli_fetch_array($qryLok)){ ?>
        <option value="<?php echo $rLok['lokasi']; ?>" <?php if($row['lokasi']==$rLok['lokasi']){ echo "SELECTED"; }?>><?php echo $rLok['lokasi']; ?></option>
        <?php } ?>
      </select></td>
    </tr>  
    <?php $no++;} ?>
</table>
</div>
<button name="ubah" type="submit">Update</button>	
</form>	
<strong>
<?php $sql2=mysqli_query($con,"SELECT
	COUNT(weight) as totrol,
	SUM(weight) as totba,
	SUM(yard_) as totya
FROM
	detail_pergerakan_stok
WHERE
	nokk = '".$_GET['nokk']."'
AND (
	 status = '1' and transtatus='1'
) AND sisa='".$_GET['ket']."'
 Order by no_roll ASC");
 $row2=mysqli_fetch_array($sql2);
 ?>
 <font color="RED">
SISA Roll : <?php echo $row2["totrol"];?> || Berat : <?php echo number_format($row2["totba"],'2','.',',');?> || Panjang:<?php echo number_format($row2["totya"],'2','.',',');?></font>
</strong><br>
<?php
	$sql3=mysqli_query($con,"SELECT
	lokasi,
	COUNT(weight) as totrol,
	SUM(weight) as totba,
	SUM(yard_) as totya
FROM
	detail_pergerakan_stok
WHERE
	nokk = '".$_GET['nokk']."'
AND (
	(status = '0' or status = '1') and transtatus='1'
) AND sisa='".$_GET['ket']."'
GROUP BY lokasi");
while($row3=mysqli_fetch_array($sql3)){
	 echo $row3['lokasi']." Rol: ".$row3['totrol']." Berat: ".$row3['totba']." Panjang: ".$row3['totya']."<br>";
	 }
	?>
</body>
</html>
<?php
if($_POST){ 
	extract($_POST);
	//tangkap data array dari form
    $lokasi = $_POST['lokasi'];
    //foreach
    foreach ($lokasi as $lokasi_key => $lokasi_value) {
    $query = "UPDATE `detail_pergerakan_stok` SET 
	`lokasi` =  '$lokasi_value'
    WHERE `id` = '$lokasi_key' LIMIT 1 ;";
    $result = mysqli_query($con,$query);
    }
    if (!$result) {
        die ('cant update:' .mysql_error());
    }else{
		echo " <script>window.close();</script>";
	}
				
						
		}		

?>