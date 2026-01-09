<?php 
mysql_connect("svr1","root","itc0920");
mysql_select_db("db_qc")or die("Gagal Koneksi");
    
  $sql=mysql_query("SELECT * from mutasi_kain
WHERE 
mutasi_kain.no_mutasi = '$_POST[no_mutasi]'");
  $i=1;
  while($row=mysql_fetch_array($sql))
  {
$tempat=$_POST['tempat'][$i];
mysql_query("Update mutasi_kain SET tempat='$tempat' where id='$row[id]'")or die("Gagal"); 
$i++;
  }
?>
<script>
alert("Data Tersimpan");
document.location.href="lihat_data_mutasi_kain_masuk_online.php?no_mutasi=<?php echo $_POST['no_mutasi'];?>";
</script>