<?php
############### Koneksi via username & password ###############
$serverName = "sql-db-prd.indotaichen.com"; // Contoh: localhost\SQLEXPRESS
$connectionInfo = array("Database" => "db_qc", "UID" => "sa", "PWD" => "Ind@taichen2024", "CharacterSet" => "UTF-8");
$con = sqlsrv_connect($serverName, $connectionInfo);

$dt = array();
$options = array(
    "Scrollable" => SQLSRV_CURSOR_STATIC
);

if ($con) {
    echo "";
} else {
    echo "Koneksi Gagal: " . sqlsrv_errors()[0]['message'];
    die(print_r(sqlsrv_errors(), true));
}
// ############### Koneksi via Windows Authentication ###############
// $serverName = "W-DIT-000162";
// $connectionInfo = array( "Database"=>"db_qc");

// // connect
// $conn = sqlsrv_connect( $serverName, $connectionInfo);

// if( $conn ) {
//      echo "Connection established bla..bla...<br />";
// }else{
//      echo "Connection could not be established.<br />";
//      die( print_r( sqlsrv_errors(), true));
// }

// // close connection
// sqlsrv_close( $conn);
?>