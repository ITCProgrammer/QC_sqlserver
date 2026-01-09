<?php require_once 'header.php'; ?>
<title><?php $title = "Harian Brushing"; echo $title; ?></title>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Laporan Harian Brushing</h1>
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
                                    <th>NO</th>
                                    <th>TGL</th>
                                    <th>SHIFT</th>
                                    <th>NO MESIN</th>
                                    <th>LANGGANAN</th>
                                    <th>BUYER</th>
                                    <th>NO ORDER</th>
                                    <th>JENIS KAIN</th>
                                    <th>WARNA</th>
                                    <th>ROLL</th>
                                    <th>QTY</th>
                                    <th>PROSES</th>
                                    <th>KETERANGAN</th>
                                    <th>JAM PROSES TGL</th>
                                    <th>JAM PROSES IN</th>
                                    <th>JAM PROSES TGL</th>
                                    <th>JAM PROSES OUT</th>
                                    <th>LAMA PROSES</th>
                                    <th>STOP MESIN TGL</th>
                                    <th>STOP MESIN JAM</th>
                                    <th>STOP MESIN TGL</th>
                                    <th>STOP MESIN S/D</th>
                                    <th>LAMA STOP</th>
                                    <th>KODE STOP</th>
                                    <th>OPERATOR</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    ini_set("error_reporting", 1);
                                    session_start();
                                    require_once "koneksi.php"; 
                                ?>
                                <?php
                                    $mesin = $_GET['mesin'];
                                    $sqlDB2="SELECT
                                                p.STDBEGINOPERATION AS TGL_PROSES,
                                                p.PRODUCTIONDEMANDCODE AS PRODUCTIONDEMAND,
                                                P.PRODUCTIONORDERCODE AS PRODUCTIONORDER,
                                                b.LEGALNAME1 AS LANGGANAN,
                                                s.ORDERPARTNERBRANDCODE AS BUYER,
                                                s.CODE AS SALESORDER,
                                                (trim( s2.SUBCODE01 ) || trim( s2.SUBCODE02 ) || trim( s2.SUBCODE03 )) AS HANGER,
                                                s2.ITEMDESCRIPTION AS JENISKAIN,
                                                (trim( s2.SUBCODE05 ) || ' ' || trim( u.LONGDESCRIPTION )) AS WARNA,
                                                trim(op.LONGDESCRIPTION) || ' | ' || trim(p.OPERATIONCODE) AS PROSES,
                                                trim( s2.SUBCODE01 ) AS SUBCODE01,
                                                trim( s2.SUBCODE02 ) AS SUBCODE02,
                                                trim( s2.SUBCODE03 ) AS SUBCODE03,
                                                trim( s2.SUBCODE04 ) AS SUBCODE04,
                                                trim( s2.SUBCODE05 ) AS SUBCODE05,
                                                trim( s2.SUBCODE06 ) AS SUBCODE06,
                                                trim( s2.SUBCODE07 ) AS SUBCODE07,
                                                trim( s2.SUBCODE08 ) AS SUBCODE08,
                                                trim( s2.SUBCODE09 ) AS SUBCODE09,
                                                trim( s2.SUBCODE10 ) AS SUBCODE10,
                                                trim(p.WORKCENTERCODE) AS MESIN
                                            FROM
                                                PRODUCTIONDEMANDSTEP p
                                                LEFT JOIN ( SELECT * FROM PRODUCTIONDEMAND p2 ) p2 ON p2.CODE = p.PRODUCTIONDEMANDCODE
                                                LEFT JOIN ( SELECT * FROM ORDERPARTNER o ) o ON o.CUSTOMERSUPPLIERCODE = p2.CUSTOMERCODE
                                                LEFT JOIN ( SELECT * FROM BUSINESSPARTNER b ) b ON b.NUMBERID = o.ORDERBUSINESSPARTNERNUMBERID
                                                LEFT JOIN ( SELECT * FROM SALESORDER s ) s ON s.CODE = p2.PROJECTCODE
                                                LEFT JOIN ( SELECT * FROM SALESORDERLINE s2 ) s2 ON s.CODE = s2.SALESORDERCODE
                                                LEFT JOIN ( SELECT * FROM USERGENERICGROUP u ) u ON u.CODE = s2.SUBCODE05
                                                LEFT JOIN ( SELECT * FROM OPERATION op ) op ON op.CODE = p.OPERATIONCODE
                                                LEFT JOIN ( SELECT * FROM QUALITYDOCUMENT qd ) qd ON qd.PRODUCTIONORDERCODE = p.PRODUCTIONORDERCODE 
                                            WHERE
                                                p.WORKCENTERCODE = '$mesin' AND p.STDBEGINOPERATION BETWEEN '$tgl1' AND '$tgl2'
                                            AND 
                                                year(p.STDBEGINOPERATION) = '2022' 
                                            ORDER BY
                                                p.STEPNUMBER ASC";
                                    $stmt=db2_exec($conn1,$sqlDB2, array('cursor'=>DB2_SCROLLABLE));
                                    $no = 1;
                                    while ($rowdb2 = db2_fetch_assoc($stmt)) {
                                        $demand = $rowdb2['PRODUCTIONDEMAND'];
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
                                        // KG BAGI KAN DI STEPS
                                        $sqlKg_bagikain = "SELECT * FROM PRODUCTIONDEMANDSTEP WHERE PRODUCTIONDEMANDCODE = '$demand' ORDER BY STEPNUMBER ASC limit 1";
                                        $stmt_kg_bagikain = db2_exec($conn1,$sqlKg_bagikain, array('cursor'=>DB2_SCROLLABLE));
                                        $rowdb2_kg_bagikain = db2_fetch_assoc($stmt_kg_bagikain);
                                ?>
                                <tr>
                                    <td><?= $no++; ?></td> <!-- NO -->
                                    <td><?= $rowdb2['TGL_PROSES']; ?></td> <!-- TGL_PROSES -->
                                    <td></td> <!-- SHIFT -->
                                    <td><?= $rowdb2['MESIN']; ?></td> <!-- NO MESIN -->
                                    <td><?= $rowdb2['LANGGANAN']; ?></td> <!-- LANGGANAN -->
                                    <td><?= $rowdb2['BUYER']; ?></td> <!-- BUYER -->
                                    <td><?= $rowdb2['SALESORDER']; ?></td> <!-- NO ORDER -->
                                    <td><?= $rowdb2['JENISKAIN']; ?></td> <!-- JENIS KAIN -->
                                    <td><?= $rowdb2['WARNA']; ?></td> <!-- WARNA -->
                                    <td></td> <!-- ROLL -->
                                    <td><?= $rowdb2_kg_bagikain['FINALUSERPRIMARYQUANTITY']; ?></td> <!-- QTY -->
                                    <td><?= $rowdb2['PROSES']; ?></td> <!-- PROSES -->
                                    <td></td> <!-- KETERANGAN -->
                                    <td style="color: red;">CAMS</td> <!-- JAM PROSES TGL -->
                                    <td style="color: red;">CAMS</td> <!-- JAM PROSES IN -->
                                    <td style="color: red;">CAMS</td> <!-- JAM PROSES TGL -->
                                    <td style="color: red;">CAMS</td> <!-- JAM PROSES OUT -->
                                    <td style="color: red;">RUMUS</td> <!-- LAMA PROSES -->
                                    <td style="color: red;">CAMS</td> <!-- STOP MESIN TGL -->
                                    <td style="color: red;">CAMS</td> <!-- STOP MESIN JAM -->
                                    <td style="color: red;">CAMS</td> <!-- STOP MESIN TGL -->
                                    <td style="color: red;">CAMS</td> <!-- STOP MESIN S/D -->
                                    <td style="color: red;">RUMUS</td> <!-- LAMA STOP -->
                                    <td style="color: red;">CAMS</td> <!-- KODE STOP -->
                                    <td style="color: red;">CAMS</td> <!-- OPERATOR -->
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