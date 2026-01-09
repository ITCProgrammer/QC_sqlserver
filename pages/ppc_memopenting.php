<?php require_once 'header.php'; ?>
<title><?php $title = "PPC - Memo Penting"; echo $title; ?></title>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dashboard</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">DataTable with default features</h3>
                    </div>
                    <div class="card-body">
                        <table id="harian-fin" class="table table-bordered table-striped">
                            <thead>
                                <tr align="center">
                                    <th>PELANGGAN</th>
                                    <th>NO. ORDER</th>
                                    <th>NO. PO</th>
                                    <th>KETERANGAN PRODUK</th>
                                    <th>LEBAR</th>
                                    <th>GRAMASI</th>
                                    <th>WARNA</th>
                                    <th>NO WARNA</th>
                                    <th>DELIVERY</th>
                                    <th>BAGI KAIN TGL</th>
                                    <th>roll</th>
                                    <th>KG (Bruto)</th>
                                    <th>delay</th>
                                    <th>STATUS TERAKHIR</th>
                                    <th>NO KARTU KERJA</th>
                                    <th>catatan po greige</th>
                                    <th>target selesai</th>
                                    <th>ket</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    ini_set("error_reporting", 1);
                                    session_start();
                                    require_once "koneksi.php";
                                    $tgl1 = $_GET['tgl1'];
                                    $tgl2 = $_GET['tgl2'];
                                ?>
                                <?php 
                                    $sqlDB2="SELECT
                                                    ( b.LEGALNAME1 || s.ORDERPARTNERBRANDCODE ) AS PELANGGAN,
                                                    s.CODE AS ORDER,
                                                    s.EXTERNALREFERENCE AS PO,
                                                    p.CODE AS KK,
                                                    trim( p.SUBCODE01 ) AS SUBCODE01,
                                                    trim( p.SUBCODE02 ) AS SUBCODE02,
                                                    trim( p.SUBCODE03 ) AS SUBCODE03,
                                                    trim( p.SUBCODE04 ) AS SUBCODE04,
                                                    trim( p.SUBCODE05 ) AS SUBCODE05,
                                                    trim( p.SUBCODE06 ) AS SUBCODE06,
                                                    trim( p.SUBCODE07 ) AS SUBCODE07,
                                                    trim( p.SUBCODE08 ) AS SUBCODE08,
                                                    trim( p.SUBCODE09 ) AS SUBCODE09,
                                                    trim( p.SUBCODE10 ) AS SUBCODE10,
                                                    ( trim( p.SUBCODE05 ) || ' ' || trim( u.LONGDESCRIPTION )) AS WARNA,
                                                    s.REQUIREDDUEDATE AS DELIVERY,
                                                    pr.ISSUEDATE AS BAGIKAIN
                                                FROM
                                                    PRODUCTIONDEMAND p
                                                    LEFT JOIN ( SELECT * FROM SALESORDER s ) s ON s.CODE = p.PROJECTCODE
                                                    LEFT JOIN ( SELECT * FROM ORDERPARTNER o ) o ON o.CUSTOMERSUPPLIERCODE = s.FNCORDPRNCUSTOMERSUPPLIERCODE
                                                    LEFT JOIN ( SELECT * FROM BUSINESSPARTNER b ) b ON b.NUMBERID = o.ORDERBUSINESSPARTNERNUMBERID
                                                    LEFT JOIN ( SELECT * FROM USERGENERICGROUP u ) u ON u.CODE = p.SUBCODE05
                                                    LEFT JOIN ( SELECT * FROM PRODUCTIONRESERVATION pr ) pr ON pr.PROJECTCODE = s.CODE AND pr.ORDERCODE = p.CODE 
                                                WHERE
                                                    s.REQUIREDDUEDATE BETWEEN '$tgl1' AND '$tgl2'
                                                ORDER BY
                                                    DELIVERY ASC";
                                    $stmt=db2_exec($conn1,$sqlDB2, array('cursor'=>DB2_SCROLLABLE));
                                    while ($rowdb2 = db2_fetch_assoc($stmt)) {
                                        $order = $rowdb2['ORDER'];
                                        $demand = $rowdb2['KK'];
                                        $s1 = $rowdb2['SUBCODE01'];
                                        $s2 = $rowdb2['SUBCODE02'];
                                        $s3 = $rowdb2['SUBCODE03'];
                                        $s4 = $rowdb2['SUBCODE04'];
                                        $s5 = $rowdb2['SUBCODE05'];
                                        $s6 = $rowdb2['SUBCODE06'];
                                        $s7 = $rowdb2['SUBCODE07'];
                                        $s8 = $rowdb2['SUBCODE08'];
                                        $s9 = $rowdb2['SUBCODE09'];
                                        $s10 = $rowdb2['SUBCODE10'];
                                        // LEBAR
                                        $sqlLebar = "SELECT A.NAMENAME,A.VALUEDECIMAL AS LEBAR
                                                        FROM
                                                            ADSTORAGE a 
                                                            RIGHT JOIN (SELECT * FROM PRODUCT p )p ON p.ABSUNIQUEID = A.UNIQUEID
                                                        WHERE
                                                            a.NAMENAME = 'Width' AND
                                                            p.SUBCODE01 = '$s1' AND
                                                            p.SUBCODE02 = '$s2' AND
                                                            p.SUBCODE03 = '$s3' AND
                                                            p.SUBCODE04 = '$s4' AND
                                                            p.SUBCODE05 = '$s5' AND
                                                            p.SUBCODE06 = '$s6' AND
                                                            p.SUBCODE07 = '$s7' AND
                                                            p.SUBCODE08 = '$s8' AND
                                                            p.SUBCODE09 = '$s9' AND
                                                            p.SUBCODE10 = '$s10'";  
                                        $stmt_lebar = db2_exec($conn1,$sqlLebar, array('cursor'=>DB2_SCROLLABLE));
                                        $rowdb2_lebar = db2_fetch_assoc($stmt_lebar);
                                        // GRAMASI
                                        $sqlGramasi = "SELECT A.NAMENAME,A.VALUEDECIMAL AS GRAMASI
                                                        FROM
                                                            ADSTORAGE a 
                                                            RIGHT JOIN (SELECT * FROM PRODUCT p )p ON p.ABSUNIQUEID = A.UNIQUEID
                                                        WHERE
                                                            a.NAMENAME = 'GSM' AND
                                                            p.SUBCODE01 = '$s1' AND
                                                            p.SUBCODE02 = '$s2' AND
                                                            p.SUBCODE03 = '$s3' AND
                                                            p.SUBCODE04 = '$s4' AND
                                                            p.SUBCODE05 = '$s5' AND
                                                            p.SUBCODE06 = '$s6' AND
                                                            p.SUBCODE07 = '$s7' AND
                                                            p.SUBCODE08 = '$s8' AND
                                                            p.SUBCODE09 = '$s9' AND
                                                            p.SUBCODE10 = '$s10'";
                                        $stmt_gramasi = db2_exec($conn1,$sqlGramasi, array('cursor'=>DB2_SCROLLABLE));
                                        $rowdb2_gramasi = db2_fetch_assoc($stmt_gramasi);
                                        // KG BRUTO
                                        $sqlKg = "SELECT SUM(USERPRIMARYQUANTITY) AS KG_BRUTO FROM PRODUCTIONDEMAND WHERE SUBCODE03 = '$s3' AND PROJECTCODE = '$order' AND ITEMTYPEAFICODE = 'KGF'";
                                        $stmt_kg = db2_exec($conn1,$sqlKg, array('cursor'=>DB2_SCROLLABLE));
                                        $rowdb2_kg = db2_fetch_assoc($stmt_kg);
                                        // STATUS TERAKHIR
                                        $sqlstatus = "SELECT OPERATIONCODE, LONGDESCRIPTION FROM PRODUCTIONDEMANDSTEP WHERE PRODUCTIONDEMANDCODE = '$demand' ORDER BY STEPNUMBER DESC LIMIT 1";
                                        $stmt_status = db2_exec($conn1,$sqlstatus, array('cursor'=>DB2_SCROLLABLE));
                                        $rowdb2_status = db2_fetch_assoc($stmt_status);
                                        // CATATAN PO GREIGE
                                        $sqlcatatanpogreiege = "SELECT * FROM PRODUCTIONDEMAND WHERE SUBCODE03 = '$s3' AND PROJECTCODE = '$order' AND ITEMTYPEAFICODE = 'KGF'";
                                        $stmt_catatanpogreiege = db2_exec($conn1,$sqlcatatanpogreiege, array('cursor'=>DB2_SCROLLABLE));
                                        $rowdb2_catatanpogreiege = db2_fetch_assoc($stmt_catatanpogreiege);
                                        // JENIS KAIN
                                        $sqljeniskain = "SELECT trim( ITEMDESCRIPTION ) AS JENISKAIN FROM SALESORDERLINE WHERE SALESORDERCODE = '$order'";
                                        $stmt_jeniskain = db2_exec($conn1,$sqljeniskain, array('cursor'=>DB2_SCROLLABLE));
                                        $rowdb2_jeniskain = db2_fetch_assoc($stmt_jeniskain);
                                ?>
                                <tr>
                                    <td><?= $rowdb2['PELANGGAN']; ?></td>
                                    <td><?= $rowdb2['ORDER']; ?></td>
                                    <td><?= $rowdb2['PO']; ?></td>
                                    <td><?= $rowdb2_jeniskain['JENISKAIN'].' '.$rowdb2['SUBCODE01'].' '.$rowdb2['SUBCODE02'].' '.$rowdb2['SUBCODE03'].' '.$rowdb2['SUBCODE04'].' '.$rowdb2['SUBCODE05'].' '.$rowdb2['SUBCODE06'].' '.$rowdb2['SUBCODE07'].' '.$rowdb2['SUBCODE08']; ?></td>
                                    <td><?= $rowdb2_lebar['LEBAR']; ?></td>
                                    <td><?= $rowdb2_gramasi['GRAMASI']; ?></td>
                                    <td><?= $rowdb2['WARNA']; ?></td>
                                    <td><?= $rowdb2['SUBCODE05']; ?></td>
                                    <td><?= $rowdb2['DELIVERY']; ?></td>
                                    <td><?= $rowdb2['BAGIKAIN']; ?></td>
                                    <td></td>
                                    <td><?= $rowdb2_kg['KG_BRUTO']; ?></td>
                                    <td></td>
                                    <td><?= $rowdb2_status['OPERATIONCODE']."(".$rowdb2_status['LONGDESCRIPTION'].")"; ?></td>
                                    <td><?= $rowdb2['KK']; ?></td>
                                    <td><?= $rowdb2_catatanpogreiege['CODE'].' '.$rowdb2_catatanpogreiege['FINALPLANNEDDATE']; ?></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once 'footer.php'; ?>