<?php
$host="svr4:3306";
$username="dit";
$password="4dm1n";
$db_name="db_qc";

mysql_connect($host,$username,$password);
mysql_select_db($db_name) or die("Gagal Koneksi");


?>