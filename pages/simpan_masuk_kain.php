<?php 
include_once("../koneksi.php");
ini_set("error_reporting",1);

    
  $sql=sqlsrv_query($con,"select mutasi_kain.id as id_kain 
from mutasi_kain 
INNER JOIN pergerakan_stok on pergerakan_stok.no_mutasi=mutasi_kain.no_mutasi and pergerakan_stok.id=mutasi_kain.id_stok
INNER JOIN detail_pergerakan_stok on pergerakan_stok.id=detail_pergerakan_stok.id_stok
where pergerakan_stok.no_mutasi='".$_POST['no_mutasi']."'
GROUP BY mutasi_kain.id
ORDER BY mutasi_kain.id ASC");
  $i=1;
  while($row=sqlsrv_fetch_array($sql))
  {
$tempat=$_POST['tempat'][$i];
$nokk=$_POST['kk'];	  
$qry="Update mutasi_kain SET tempat='$tempat' where id='".$row['id_kain']."'";
$sql1=sqlsrv_query($con,$qry);
//echo $tempat=$_POST['tempat'][$i]."<br>";	
//echo "Query yang dijalankan: $qry";
//echo "<br />";
//echo "Pesan error: ".mysql_error();	  
$i++;
  }
?>
<script>
	
alert("Data Tersimpan");
window.location.href='../index1.php?p=mutasi_kain_masuk'; 	

</script>