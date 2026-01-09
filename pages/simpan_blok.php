<?php

mysql_connect("svr1","root","itc0920");
mysql_select_db("db_qc")or die("Gagal Koneksi");
if($_POST['masuk']=="SIMPAN"){
$sql=mysql_query("SELECT
	a.tgl_update,a.no_po,a.no_order,a.blok,b.weight,b.yard_,b.no_roll,
	b.satuan,b.grade,b.sisa,b.nokk,c.jenis_kain,c.pelanggan,c.no_lot,c.no_warna,
	c.warna,c.lebar,c.berat,c.no_item, sum(b.weight) as tot_qty,count(b.yard_) as tot_rol,sum(b.yard_) as tot_yard,
	SUM(case when b.grade='A' or b.grade='B' or b.grade='' then b.weight else 0 end) as grd_ab,
	SUM(case when b.grade='C' then b.weight else 0 end) as grd_c,
	SUM(if(b.grade='A' or b.grade='B' or b.grade='', 1, 0)) as jml_ab,
	SUM(if(b.grade = 'C', 1, 0)) as jml_grd_c
	FROM
	pergerakan_stok a
	LEFT JOIN detail_pergerakan_stok b ON a.id = b.id_stok
	LEFT JOIN tbl_kite c ON c.nokk = b.nokk
	WHERE
	a.typestatus = '2'
	AND a.tgl_update='$_POST[tgl]'
	GROUP BY
	a.id,b.nokk
	ORDER BY
	a.id");
  $i=1;
  while($row=mysql_fetch_array($sql))
  {
	  /* 
	  $tempat=$_POST['tempat'][$i];
	  $sqls=mysql_query("INSERT INTO tbl_blok(blok,nokk)  values('$tempat','$row[nokk]')")or die("Gagal Simpan");
	*/
	  $mySql =mysql_query("SELECT * FROM tbl_blok WHERE tbl_blok.nokk='$row[nokk]'");
	  $myQty = mysql_num_rows($mySql);
	  $tempat=$_POST['tempat'][$i];
	  if($myQty == 0){
		$sqls=mysql_query("INSERT INTO tbl_blok(blok,nokk)  values('$tempat','$row[nokk]')")or die("Gagal Simpan");
		}else{
			$sqls=mysql_query("Update tbl_blok SET blok='$tempat' where nokk='$row[nokk]'")or die("Gagal Update");
		}
		
	$i++;
  }
}

?>
<script>
alert("Data Tersimpan");
document.location.href="../index1.php?p=laporan_harian_kain";
</script>