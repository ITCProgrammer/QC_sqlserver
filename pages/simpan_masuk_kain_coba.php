<?php 
mysql_connect("192.168.0.3","root","itc0920");
mysql_select_db("db_qc")or die("Gagal Koneksi");

    
  $sql=mysql_query("select pergerakan_stok.id,bruto,satuan,mutasi_kain.tempat,mutasi_kain.no_mutasi,
no_mc,pelanggan,pergerakan_stok.no_po,pergerakan_stok.no_order,tgl_update,
jenis_kain,no_warna,warna,no_item,no_lot,tbl_kite.user_packing,
lebar,berat,detail_pergerakan_stok.nokk,grade,
detail_pergerakan_stok.ket,count(yard_) as tot_rol,sum(yard_) as tot_yard ,
sum(weight) as tot_qty,sisa
from pergerakan_stok 
inner join detail_pergerakan_stok on pergerakan_stok.id=detail_pergerakan_stok.id_stok 
inner join mutasi_kain on pergerakan_stok.id=mutasi_kain.id_stok 
inner join tbl_kite on tbl_kite.nokk=detail_pergerakan_stok.nokk
where mutasi_kain.no_mutasi='$_POST[no_mutasi]'
GROUP BY  pergerakan_stok.id, no_dok,sisa
ORDER BY pergerakan_stok.id ASC");
  $i=1;
  while($row=mysql_fetch_array($sql))
  {
$tempat=$_POST['tempat'][$i];
mysql_query("Update mutasi_kain SET tempat='$tempat' where id_stok='$row[id]' and keterangan='$row[sisa]'")or die("Gagal"); 
$i++;
  }
?>
<script>
alert("Data Tersimpan");
document.location.href="lihat_data_mutasi_kain_masuk_coba.php?no_mutasi=<?php echo $_POST['no_mutasi'];?>";
</script>