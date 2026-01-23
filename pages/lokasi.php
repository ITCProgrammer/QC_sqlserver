<?php
include("../koneksi.php");
ini_set("error_reporting", 1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Lokasi Kain Jadi</title>
	<link rel="stylesheet" type="text/css" href="../css/datatable.css" />
	<link rel="stylesheet" type="text/css" href="../css/jquery-ui.css" />
	<script src="../js/jquery.js" type="text/javascript"></script>
	<script src="../js/jquery.dataTables.js" type="text/javascript"></script>
	<script>
		$(document).ready(function() {
			$('#datatables').dataTable({
				"sScrollY": "300px",
				"sScrollX": "100%",
				"bScrollCollapse": true,
				"bPaginate": false,
				"bJQueryUI": true
			});
		})
	</script>
</head>

<body>
	<table width="100%" border="0" class="display" id="datatables">
		<thead>
			<tr bgcolor="#64B7F4">
				<th scope="col">Nama</th>
				<th scope="col">Kapasitas (FLEECE)</th>
				<th scope="col">Kapasitas (Jenis Lain)</th>
				<th scope="col">Stock Terisi</th>
				<th scope="col">Lantai</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$qry = sqlsrv_query($con, "SELECT * FROM db_qc.tbl_lokasi ORDER BY lokasi ASC");
			while ($r = sqlsrv_fetch_array($qry)) {
				$qrystk = sqlsrv_query($con, "SELECT sum(weight) as stok FROM db_qc.detail_pergerakan_stok WHERE lokasi='" . $r['lokasi'] . "' AND transtatus='1'");
				$rstk = sqlsrv_fetch_array($qrystk);
			?>
				<tr align="center">
					<td><?php echo $r['lokasi']; ?></td>
					<td><?php echo $r['kapasitas']; ?></td>
					<td><?php echo $r['kapasitas_lain']; ?></td>
					<td><?php echo $rstk['stok']; ?></td>
					<td><?php echo $r['lantai']; ?></td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</body>

</html>