<?php
//header("Content-type: application/octet-stream");
//header("Content-Disposition: attachment; filename=persediaan_kain_jadi_".date($_GET['tglrpt']).".xls");//ganti nama sesuai keperluan
//header("Pragma: no-cache");
//header("Expires: 0");
//disini script laporan anda
?>
<?php
ini_set("error_reporting",1);
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");
header("Content-Disposition: attachment;filename=persediaan_kain_jadi_" . date($_GET['tglrpt']) . ".xls");
header("Content-Transfer-Encoding: binary ");
include '../koneksi.php';
?>

<body>
  <center><b>LAPORAN PERSEDIAAN KAIN JADI</b></center>
  <?php $tgl_cetak1 = $_GET['awal'];
  $tgl_cetak2 = $_GET['akhir']; ?>
  <?php
  if ($_GET['rak'] != '') {
        $rak = trim($_GET['rak']);
        $where2 .= " AND b.lokasi LIKE '$rak%' ";
      } else {
        $where2 .= " ";
      }	
  if ($_GET['lokasi']!= '') {
    $lokasi = trim($_GET['lokasi']);
    $where3 .= " AND b.lokasi='$lokasi' ";
  } else {
    $where3 .= " ";
  }
  if ($_GET['ket'] == 'SISA') {
    $where4 .= " AND (b.sisa='SISA' OR b.sisa='FKSI') ";
  } elseif ($_GET['ket'] == '') {
    $where4 .= " AND (b.sisa='' OR b.sisa='KITE') ";
  } else {
    $where4 .= " ";
  }
  if ($_GET['no_order'] != '') {
    $where .= " AND c.no_order ='".$_GET['no_order']."' ";
  } else {
    $where .= " ";
  }
  if ($_GET['po'] != '') {
    $where10 .= " AND c.no_po ='".$_GET['po']."' ";
  } else {
    $where10 .= " ";
  }	
  if ($_GET['no_item'] != '') {
    $item = trim($_GET['no_item']);
    $where5 .= " AND trim(c.no_item)='$item' ";
  } else {
    $where5 .= " ";
  }
  if ($_GET['no_warna'] != '') {
    $warna = trim($_GET['no_warna']);
    $where6 .= " AND trim(c.no_warna)='$warna' ";
  } else {
    $where6 .= " ";
  }

  if ($_GET['buyer'] != '') {
    $buyer = trim($_GET['buyer']);
    $where8 .= " AND trim(c.pelanggan) LIKE '%$buyer' ";
  } else {
    $where8 .= " ";
  }

  if ($_GET['bs'] != '') {
    $bs = trim($_GET['bs']);
    $where9 .= " AND ( a.fromtoid = 'QC BS') ";
  } else {
    $where9 .= " AND (a.fromtoid = 'GUDANG KAIN JADI' OR a.fromtoid = 'PACKING' OR a.fromtoid='LAIN' OR a.fromtoid='INSPEK MEJA' OR a.fromtoid ='GANTI STIKER' OR a.fromtoid ='REVISI STIKER' OR a.fromtoid = 'POTONG SISA') ";
  }

  if ($_GET['lbr'] != '' and $_GET['grms'] != '') {
    $lebar = trim($_GET['lbr']);
    $berat = trim($_GET['grms']);
    $where7 .= " AND trim(c.lebar)='$lebar' AND trim(c.berat)='$berat' ";
  } else {
    $where7 .= " ";
  }

  if ($_GET['awal'] != '' and $_GET['akhir'] != '') {
    $where1 .= " AND DATE_FORMAT(a.tgl_update,'%Y-%m-%d') BETWEEN '".$_GET['awal']."'" . " AND '$tgl_cetak2' ";
  } else {
    $where1 .= " ";
  }

  echo "<b>TGL : " . $_GET['awal'] . " s/d " . $_GET['akhir'] . "</b><br>";
  ?>

  <table border="1" align="center" style="font-size:11px">
    <tr align="center">
      <td rowspan="3">TGL</td>
      <td rowspan="3">NO ITEM</td>
      <td rowspan="3">LANGGANAN</td>
      <td rowspan="3">PO</td>
      <td rowspan="3">ORDER</td>
      <td rowspan="3">JENIS_KAIN</td>
      <td rowspan="3">NO WARNA</td>
      <td rowspan="3">WARNA</td>
      <td rowspan="3">NO CARD</td>
      <td rowspan="3">LOT</td>
      <td rowspan="3">ROLL</td>
      <td colspan="7">Netto (KG)</td>
      <td rowspan="3">Yard / Meter</td>
      <td rowspan="3">UNIT</td>
      <td rowspan="3">LOKASI</td>
      <td rowspan="3">FOC</td>
      <td rowspan="3">LBR</td>
      <td rowspan="3">X</td>
      <td rowspan="3">GRMS</td>
      <td rowspan="3">OL</td>
      <td rowspan="3">Status</td>
      <td rowspan="3">Keterangan</td>
      <td rowspan="3">Status Warna</td>
    </tr>
    <tr align="center">
      <td colspan="2">GRADE A</td>
      <td colspan="2">GRADE B</td>
      <td colspan="2">GRADE C</td>
      <td>&nbsp;</td>
    </tr>
    <tr align="center">
      <td>ROLL</td>
      <td>KG</td>
      <td>ROLL</td>
      <td>KG</td>
      <td>ROLL</td>
      <td>KG</td>
      <td>Keterangan</td>
    </tr>
    <?php

    $sql = sqlsrv_query($con," SELECT
	a.tgl_update,c.no_po,c.no_order,a.blok,
	b.sisa,b.nokk,c.jenis_kain,c.pelanggan,c.no_lot,c.no_warna,
	c.warna,c.lebar,c.berat,c.no_item, b.id as id_detail, b.id_stok, a.sts_stok,b.ket_stok,
	GROUP_CONCAT(DISTINCT lokasi) as lokasi, ket_selain_tungmung
	FROM
	pergerakan_stok a
	LEFT JOIN detail_pergerakan_stok b ON a.id = b.id_stok
  	LEFT JOIN tmp_detail_kite d ON d.id=b.id_detail_kj
	LEFT JOIN tbl_kite c ON c.id = d.id_kite
	WHERE
	(a.typestatus = '1' OR a.typestatus = '2')
	 AND not ISNULL(b.transtatus) AND b.transtatus='1' " . $where10 . $where9 . $where8 . $where7 . $where6 . $where5 . $where4 . $where3 . $where2 . $where . $where1 . "
	GROUP BY
	b.nokk,b.sisa,b.id_stok,b.ket_stok
	ORDER BY
	a.tgl_update,a.id ");
    $c = 1;
    $i = 1;
    while ($row = sqlsrv_fetch_array($sql)) {
      $sql_get_stts = sqlsrv_query($con,"SELECT * FROM `tbl_status_warna` WHERE id_pergerakan='".$row['id_stok']."' AND id_detail='".$row['id_detail']."' AND nokk='".$row['nokk']."' LIMIT 1");
      $data_stts = sqlsrv_fetch_array($sql_get_stts);
      if ($data_stts['note'] != '') {
        $stts =  $data_stts['note'];
      } else {
        $stts = " ";
      }
      $bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99';
      $mySql = sqlsrv_query($con,"SELECT tempat,catatan FROM mutasi_kain WHERE nokk='".$row['nokk']."' AND keterangan='".$row['sisa']."' AND not tempat='' order by id desc LIMIT 1");
      $myBlk = sqlsrv_fetch_array($mySql);
      $mySqlC = sqlsrv_query($con,"SELECT tempat,catatan FROM mutasi_kain WHERE nokk='".$row['nokk']."' AND keterangan='".$row['sisa']."' order by id desc LIMIT 1");
      $myBlkC = sqlsrv_fetch_array($mySqlC);
      $mySqlC1 = sqlsrv_query($con,"SELECT GROUP_CONCAT(
		CONCAT(
			'Untuk Order ',
			no_order,
			' Qty ',
			qty_minta,
			' ',
			satuan,' Sisa '
		)
	) AS catatan,a.sisa
FROM
	tbl_catat_kain a
INNER JOIN tbl_catat_detail b ON a.id = b.id_catat
WHERE
	a.id_kain = '".$row['id_stok']."'
AND a.nokk = '".$row['nokk']."'
AND a.ket = '".$row['sisa']."'
AND b.tmp_hapus='0' ");
      $myBlkC1 = sqlsrv_fetch_array($mySqlC1);
      $catat = "";
      if ($myBlkC1['catatan'] != "") {
        $catat = $myBlkC1['catatan'] . $myBlkC1['sisa'];
      } else {
        $scek = sqlsrv_query($con,"SELECT COUNT(*)
FROM
	tbl_catat_kain a
INNER JOIN tbl_catat_detail b ON a.id = b.id_catat
WHERE
	a.id_kain = '".$row['id_stok']."'
AND a.nokk = '".$row['nokk']."'
AND a.ket = '".$row['sisa']."'");
        $ck = sqlsrv_num_rows($scek);
        if ($ck > 0) {
        } else {
          $catat = $myBlkC['catatan'];
        }
      }
      if ($row['ket_stok'] != "") {
        $stks = " and b.ket_stok='".$row['ket_stok']."' ";
      } else {
        $stks = "";
      }
      if ($row['lokasi'] != "") {
        $slok = " and b.lokasi='".$row['lokasi']."' ";
      } else {
        $slok = "";
      }
      $mysqlCek = sqlsrv_query($con," SELECT
	SUM(case when b.grade='A' or b.grade='B' or b.grade='C' or b.grade='' then b.weight else 0 end) as tot_qty,
	SUM(if(b.grade='A' or b.grade='B' or b.grade='C' or b.grade='', 1, 0)) as tot_rol,
	SUM(if(b.grade='A' or b.grade='', 1, 0)) as rol_a,
	SUM(if(b.grade='B', 1, 0)) as rol_b,
	SUM(if(b.grade='C', 1, 0)) as rol_c,
	SUM(case when b.grade='A' or b.grade='B' or b.grade='C' or b.grade='' then b.yard_ else 0 end) as tot_yard,
	SUM(case when b.grade='A' or b.grade='B' or b.grade='' then b.weight else 0 end) as grd_ab,
	SUM(case when b.grade='A' or b.grade='' then b.weight else 0 end) as grd_a,
	SUM(case when b.grade='B' then b.weight else 0 end) as grd_b,
	SUM(case when b.grade='C' then b.weight else 0 end) as grd_c,
	SUM(if(b.grade='A' or b.grade='B' or b.grade='', 1, 0)) as jml_ab,
	SUM(if(b.grade = 'C', 1, 0)) as jml_grd_c,b.sisa,b.satuan,SUM(d.netto) as netto,
	a.blok,a.tgl_update
	FROM
	pergerakan_stok a
	LEFT JOIN detail_pergerakan_stok b  ON a.id = b.id_stok
    LEFT JOIN tmp_detail_kite d ON d.id=b.id_detail_kj
	LEFT JOIN tbl_kite c ON c.id = d.id_kite
	WHERE
	b.`transtatus`='1' and b.nokk='".$row['nokk']."' and b.sisa='".$row['sisa']."' and b.id_stok='".$row['id_stok']."' $stks 
	AND (a.fromtoid = 'GUDANG KAIN JADI' OR a.fromtoid = 'PACKING' OR a.fromtoid='LAIN' OR a.fromtoid='INSPEK MEJA' OR a.fromtoid ='GANTI STIKER' OR a.fromtoid ='REVISI STIKER' OR a.fromtoid ='POTONG SISA') AND if(b.grade='A' or b.grade='B' or b.grade='C' or b.grade='', 1, 0)>0
	GROUP BY
	b.sisa,b.id_stok,b.ket_stok
	ORDER BY
	a.id, b.ket_stok LIMIT 1 ");
      $myro = sqlsrv_fetch_array($mysqlCek);
      /*if($myro['tot_rol']>0){*/
      $mySql1 = sqlsrv_query($con,"SELECT berat,lebar,no_item,pelanggan,no_po,no_order,
	   jenis_kain,warna,no_warna,no_lot FROM tbl_kite WHERE nokk='".$row['nokk']."' LIMIT 1");
      $myBlk1 = sqlsrv_fetch_array($mySql1);
      $mySql2 = sqlsrv_query($con,"SELECT a.no_po,a.no_order FROM pergerakan_stok a
INNER JOIN detail_pergerakan_stok b ON a.id=b.id_stok
WHERE b.nokk='".$row['nokk']."' and ISNULL(b.transtatus)
GROUP BY b.nokk LIMIT 1");
      $myBlk2 = sqlsrv_fetch_array($mySql2);
      if ($row['sisa'] == "SISA" || $row['sisa'] == "FKSI") {
        $brt_sisa = $myro['grd_a'] + $myro['grd_b'] + $myro['grd_c'];
        if ($brt_sisa > 10 and substr($row['tgl_update'], 0, 10) >= "2019-01-01") {
          $sts_sisa = "Sisa Produksi";
        } else if ($brt_sisa <= 10 and substr($row['tgl_update'], 0, 10) >= "2019-01-01") {
          $sts_sisa = "Sisa Toleransi";
        }
      } else {
        $sts_sisa = "";
      }
      $brt_sisa1 = $myro['grd_a'] + $myro['grd_b'] + $myro['grd_c'];
      if ($myBlk1['no_po'] != "") {
        $p0 = $myBlk1['no_po'];
      } else {
        $p0 = $myBlk2['no_po'];
      }
      $strp0 = strtoupper($p0);
      $strp1 = strtoupper($p0);
      $cBooking = strpos($strp0, "BOOKING");
      $cMiniBulk = strpos($strp0, "MINI BULK");
    ?>
      <tr>
        <td><?php echo date("d-M-Y", strtotime($row['tgl_update'])); ?></td>
        <td>'<?php echo $myBlk1['no_item']; ?></td>
        <td><?php echo $myBlk1['pelanggan']; ?></td>
        <td>'
          <?php if ($myBlk1['no_po'] != "") {
            echo $myBlk1['no_po'];
          } else {
            echo $myBlk2['no_po'];
          } ?></td>
        <td><?php if ($myBlk1['no_order'] != "") {
              echo $myBlk1['no_order'];
            } else {
              echo $myBlk2['no_order'];
            } ?></td>
        <td><?php echo htmlentities($myBlk1['jenis_kain'], ENT_QUOTES); ?></td>
        <td><?php echo $myBlk1['no_warna']; ?></td>
        <td><?php echo $myBlk1['warna']; ?></td>
        <td>'<?php echo $row['nokk']; ?></td>
        <td>'<?php echo $myBlk1['no_lot']; ?></td>
        <td align="right"><?php
                          echo $myro['tot_rol'];
                          ?></td>
        <td align="right"><?php
                          echo $myro['rol_a'];
                          ?></td>
        <td align="right"><?php
                          echo number_format($myro['grd_a'], '2', '.', ','); ?></td>
        <td align="right"><?php
                          echo $myro['rol_b'];
                          ?></td>
        <td align="right"><?php
                          echo number_format($myro['grd_b'], '2', '.', ','); ?></td>
        <td align="right"><?php
                          echo $myro['rol_c'];
                          ?></td>
        <td align="right"><?php
                          echo number_format($myro['grd_c'], '2', '.', ',');
                          ?></td>
        <td><?php if ($row['sisa'] == "SISA" || $row['sisa'] == "FKSI") {
              echo "SISA";
            } ?></td>
        <td align="right"><?php
                          if ($myro['satuan'] == "PCS") {
                            echo number_format($myro['netto']) . " " . $myro['satuan'];
                          } else {
                            echo number_format($myro['tot_yard'], '2', '.', ',') . " " . $myro['satuan'];
                          } ?></td>
        <td><?php
            if ($myBlk['tempat'] != "") {
              echo $myBlk['tempat'];
            } else if ($row['blok'] != "") {
              echo $row['blok'];
            } else {
              echo "N/A";
            } ?></td>
        <td><?php if ($row['lokasi'] != "") {
              echo $row['lokasi'];
            } else {
              echo "N/A";
            } ?></td>
        <td><?php if ($myro['sisa'] == "FOC") {
              echo "FOC";
            } ?></td>
        <td><?php echo $myBlk1['lebar']; ?></td>
        <td>X</td>
        <td><?PHP echo $myBlk1['berat']; ?></td>
        <td><?php if ($row['sisa'] == "KITE" || $row['sisa'] == "FKSI") {
              echo "Fasilitas KITE";
            } ?></td>
        <td align="center"><?php if ($row['ket_stok'] != "") {
                              echo trim($row['ket_stok']);
                            } else if ($cBooking > -1 or $cMiniBulk > -1) {
                              echo "Booking";
                            } else if (($row['sisa'] == "FKSI" or $row['sisa'] == "SISA")) {
                              echo trim($sts_sisa);
                            } else {
                              echo trim($row['sts_stok']);
                            } ?></td>
        <td align="center"><?php if ($catat != "") {
                              echo $catat;
                            } ?>
			<?php if ($row['ket_selain_tungmung'] == "1") {
                                  echo "<br> (Untuk Selain Tungmung)";
                                } ?></td>
        <td align="center">
          <?php echo $stts; ?>
        </td>
      </tr>
      <?php $i++; ?>
    <?php
      /*}*/
      if ($myro['sisa'] == "SISA" || $myro['sisa'] == "FKSI" || $myro['sisa'] == "FOC") {
        $brtoo = 0;
      } else {
        $brtoo = number_format($row['bruto'], '2', '.', ',');
      }
      $totbruto = $totbruto + $brtoo;
      $totyard = $totyard + $myro['tot_yard'];
      $totrol = $totrol + $myro['tot_rol'];
      $totrola = $totrola + $myro['rol_a'];
      $totrolb = $totrolb + $myro['rol_b'];
      $totrolc = $totrolc + $myro['rol_c'];
      $tota = $tota + $myro['grd_a'];
      $totb = $totb + $myro['grd_b'];
      $totc = $totc + $myro['grd_c'];
      $totpcs = $totpcs + $myro['netto'];
      $rolab = $rolab + $myro['jml_ab'];
      $rolac = $rolac + $myro['jml_grd_c'];
      if ($myro['satuan'] == 'Meter') {
        $kartot = $kartot + $myro['tot_yard'];
        $totrolm = $totrolm + $myro['tot_rol'];
      }
      if ($myro['satuan'] == 'Yard') {
        $pltot = $pltot + $myro['tot_yard'];
        $totroly = $totroly + $myro['tot_rol'];
      }
      if ($myro['satuan'] == 'PCS') {
        $totrolp = $totrolp + $myro['tot_rol'];
      }
    }


    ?>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>PCS</td>
      <td align="right"><?php echo number_format($totrolp); ?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>Meter</td>
      <td align="right"><?php echo number_format($totrolm); ?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>Meter</td>
      <td align="right"><?php echo number_format($kartot, '2', '.', ','); ?></td>
      <td>&nbsp;</td>
      <td align="right">&nbsp;</td>
      <td align="right"><?php echo number_format($totpcs); ?></td>
      <td>PCS</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>Yard</td>
      <td align="right"><?php echo  number_format($totroly); ?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>Yard</td>
      <td align="right"><?php echo  number_format($pltot, '2', '.', ','); ?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><b>Total</b></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td align="right"><b><?php echo $totrol; ?></td>
      <td align="right"><?php echo $totrola; ?></td>
      <td align="right"><b><?php echo number_format($tota, '2', '.', ','); ?></b></td>
      <td align="right"><?php echo $totrolb; ?></td>
      <td align="right"><b><?php echo number_format($totb, '2', '.', ','); ?></b></td>
      <td align="right"><?php echo $totrolc; ?></td>
      <td align="right"><b><?php echo number_format($totc, '2', '.', ','); ?></b></td>
      <td>&nbsp;</td>
      <td align="right">&nbsp;</td>

      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
  <b>
    ( Roll : <?php echo  number_format($totrol);  ?> )
    <font color="Blue">(GRADE A: <?php echo  number_format($tota, '2', '.', ',');  ?> Kg, Roll: <?php echo  number_format($totrola);  ?>)</font>
    <font color="Green">(GRADE B: <?php echo  number_format($totb, '2', '.', ',');  ?> Kg, Roll: <?php echo  number_format($totrolb);  ?>)</font>
    <font color="Red">(GRADE C: <?php echo  number_format($totc, '2', '.', ',');  ?> Kg, Roll: <?php echo  number_format($totrolc);  ?>)</font>
    (TOTAL : <?php echo  number_format($tota + $totb + $totc, '2', '.', ',');  ?> Kg)
  </b>
</body>

</html>