 <!--
    Created by Artisteer v2.3.0.21098
    Base template (without user's data) checked by http://validator.w3.org : "This page is valid XHTML 1.0 Transitional"
    -->
<?php
ini_set("error_reporting", 1);
include("../koneksi.php");
?>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
 <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
 <title>QC</title>

 <script type="text/javascript" src="../script.js"></script>

 <link rel="stylesheet" href="../style.css" type="text/css" media="screen" />
 <link href="/..pages/styles_cetak.css" rel="stylesheet" type="text/css">
 <!--[if IE 6]><link rel="stylesheet" href="style.ie6.css" type="text/css" media="screen" /><![endif]-->
 <!--[if IE 7]><link rel="stylesheet" href="style.ie7.css" type="text/css" media="screen" /><![endif]-->
 <style type="text/css">
   <!--
   .warnaa {
     color: #808040;

   }

   .blink {
     -webkit-animation: blink .75s linear infinite;
     -moz-animation: blink .75s linear infinite;
     -ms-animation: blink .75s linear infinite;
     -o-animation: blink .75s linear infinite;
     animation: blink .75s linear infinite;
   }

   @-webkit-keyframes blink {
     0% {
       opacity: 1;
     }

     50% {
       opacity: 1;
     }

     50.01% {
       opacity: 0;
     }

     100% {
       opacity: 0;
     }
   }

   @-moz-keyframes blink {
     0% {
       opacity: 1;
     }

     50% {
       opacity: 1;
     }

     50.01% {
       opacity: 0;
     }

     100% {
       opacity: 0;
     }
   }

   @-ms-keyframes blink {
     0% {
       opacity: 1;
     }

     50% {
       opacity: 1;
     }

     50.01% {
       opacity: 0;
     }

     100% {
       opacity: 0;
     }
   }

   @-o-keyframes blink {
     0% {
       opacity: 1;
     }

     50% {
       opacity: 1;
     }

     50.01% {
       opacity: 0;
     }

     100% {
       opacity: 0;
     }
   }

   @keyframes blink {
     0% {
       opacity: 1;
     }

     50% {
       opacity: 1;
     }

     50.01% {
       opacity: 0;
     }

     100% {
       opacity: 0;
     }
   }
   -->
 </style>
 <script language="javascript">
   var win = null;

   function NewWindow(mypage, myname, w, h, scroll) {
     LeftPosition = (screen.width) ? (screen.width - w) / 2 : 0;
     TopPosition = (screen.height) ? (screen.height - h) / 2 : 0;
     settings =
       'height=' + h + ',width=' + w + ',top=' + TopPosition + ',left=' + LeftPosition + ',scrollbars=' + scroll + ',resizable'
     win = window.open(mypage, myname, settings)
   }
 </script>
 </head>

 <body>
   <div id="art-main">
     <div class=""></div>
     <div class=""></div>
     <input type="button" class="art-button" onClick="window.location.href='../index_login.php?act=logout'" value="Logout" />
     <?php 
    //  if ($_SESSION['status'] == 0) { 
      ?>
     <input type="button" class="art-button" onClick="window.location.href='../index1.php'" value="Home" /><input type="button" class="art-button" onClick="window.location.href='../index1.php?p=laporan_harian_kain_bs'" value="Laporan" /><br />
     <?php 
    //  } 
     ?>

     <form action="simpan_blok.php" method="post" name="form1" />

     <table width="100" align="center" style="font-size:12px">
       <tr>
         <td colspan="20" align="center" style="font-size:18px"><b>LAPORAN HARIAN KAIN BS</b></td>
       </tr>
       <tr>
         <?php $tgl_cetak1 = $_POST['awal'];
          $tgl_cetak2 = $_POST['akhir']; ?>
         <input name="tgl" type="hidden" value="<?php echo $tgl_cetak1; ?>">
         <input name="tgl1" type="hidden" value="<?php echo $tgl_cetak2; ?>">
         <td colspan="20">
           <div align="right">&nbsp;<a href="cetak_kain_bs_masuk.php?tgl1=<?php echo $tgl_cetak1; ?>&tgl2=<?php echo $tgl_cetak2; ?>&order=<?php echo $_POST['order']; ?>&jlap=<?php echo $_POST['jenislap']; ?>">Cetak Ke Excel</a>&nbsp;</div>
           <b>Tanggal: <?php echo  $tgl_cetak1;  ?> s/d <?php echo  $tgl_cetak2;  ?></b>
         </td>
       </tr>
       <tr align="center" bgcolor="#0099FF">
         <td rowspan="2" bgcolor="#3366CC"><strong>TGL</strong></td>
         <td rowspan="2" bgcolor="#3366CC"><strong>LANGGANAN</strong></td>
         <td width="15" rowspan="2" bgcolor="#3366CC"><strong>PO</strong></td>
         <td width="15" rowspan="2" bgcolor="#3366CC"><strong>ORDER</strong></td>
         <td rowspan="2" bgcolor="#3366CC"><strong>JENIS_KAIN</strong></td>
         <td rowspan="2" bgcolor="#3366CC"><strong>NO WARNA</strong></td>
         <td rowspan="2" bgcolor="#3366CC"><strong>WARNA</strong></td>
         <td rowspan="2" bgcolor="#3366CC"><strong>NO CARD</strong></td>
         <td rowspan="2" bgcolor="#3366CC"><strong>LOT</strong></td>
         <td rowspan="2" bgcolor="#3366CC"><strong>ROLL</strong></td>
         <td colspan="4" bgcolor="#3366CC"><strong>Netto (KG)</strong></td>
         <td rowspan="2" bgcolor="#3366CC"><strong>Yard / Meter</strong></td>
         <td rowspan="2" bgcolor="#3366CC"><strong>UNIT</strong></td>
         <td rowspan="2" bgcolor="#3366CC"><strong>LBR</strong></td>
         <td rowspan="2" bgcolor="#3366CC"><strong>X</strong></td>
         <td rowspan="2" bgcolor="#3366CC"><strong>GRMS</strong></td>
         <td rowspan="2" bgcolor="#3366CC"><strong>Keterangan</strong></td>
       </tr>
       <tr align="center" bgcolor="#0099FF">
         <td bgcolor="#3366CC"><strong>Grade<br />
             A</strong></td>
         <td bgcolor="#3366CC"><strong>Grade B</strong></td>
         <td bgcolor="#3366CC"><strong>Grade <br /> C</strong></td>
         <td bgcolor="#3366CC"><strong>Keterangan<br />(Grade C)</strong></td>
       </tr>
       <?php
        // sqlsrv_connect("10.0.0.10", "dit", "4dm1n");
        // sqlsrv_select_db("db_qc") or die("Gagal Koneksi");
        if ($tgl_cetak1 != "" and $tgl_cetak2 != "") {
          $tgll = " AND a.tgl_update between '$tgl_cetak1' AND '$tgl_cetak2' ";
        } else if ($tgl_cetak1 = "") {
          $tgll = " ";
        } else if ($tgl_cetak2 = "") {
          $tgll = " ";
        }

        if ($_POST['order'] != "") {
          $order = " AND c.no_order='$_POST[order]' ";
        } else if ($tgl_cetak1 = "" and $_POST['order'] = "") {
          $tgll = " AND a.tgl_update='$tgl_cetak1' ";
        }
        $sql = sqlsrv_query($con, "SELECT
            a.id, a.no_mutasi, a.tgl_update, a.blok, a.ket, c.no_po, c.no_order, b.weight, b.yard_, b.no_roll, b.id_stok,
            b.satuan, b.grade, b.sisa, b.nokk, c.jenis_kain, c.pelanggan, c.no_lot, c.no_warna,
            c.warna, c.lebar, c.berat, c.no_item,
            SUM(CASE WHEN b.grade IN ('A', 'B', 'C', '') THEN b.weight ELSE 0 END) AS tot_qty,
            SUM(CASE WHEN b.grade IN ('A', 'B', 'C', '') THEN 1 ELSE 0 END) AS tot_rol,
            SUM(CASE WHEN b.grade IN ('A', 'B', 'C', '') THEN b.yard_ ELSE 0 END) AS tot_yard,
            SUM(CASE WHEN b.grade IN ('A', '') THEN b.weight ELSE 0 END) AS grd_a,
            SUM(CASE WHEN b.grade = 'B' THEN b.weight ELSE 0 END) AS grd_b,
            SUM(CASE WHEN b.grade = 'C' THEN b.weight ELSE 0 END) AS grd_c,
            SUM(CASE WHEN b.grade IN ('A', '') THEN 1 ELSE 0 END) AS jml_a,
            SUM(CASE WHEN b.grade = 'B' THEN 1 ELSE 0 END) AS jml_b,
            SUM(CASE WHEN b.grade = 'C' THEN 1 ELSE 0 END) AS jml_grd_c,
            SUM(ISNULL(d.netto, 0)) AS netto
        FROM
            db_qc.detail_pergerakan_stok b
            LEFT JOIN db_qc.pergerakan_stok a ON a.id = b.id_stok
            LEFT JOIN db_qc.tmp_detail_kite d ON d.id = b.id_detail_kj
            LEFT JOIN db_qc.tbl_kite c ON c.id = d.id_kite
        WHERE
            (b.transtatus = '11' OR b.transtatus = '10')
            $tgll $order
        GROUP BY
            -- Semua kolom non-agregat wajib dicantumkan di sini
            a.id, a.no_mutasi, a.tgl_update, a.blok, a.ket, c.no_po, c.no_order, b.weight, b.yard_, b.no_roll, b.id_stok,
            b.satuan, b.grade, b.sisa, b.nokk, c.jenis_kain, c.pelanggan, c.no_lot, c.no_warna,
            c.warna, c.lebar, c.berat, c.no_item
        ORDER BY
            a.id");
        $c = 1;
        $i = 1;
        while ($row = sqlsrv_fetch_array($sql)) {
          $bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99';
          //$mutasi=date("Ymd", strtotime($row['tgl_mutasi']));

          $sqlsrv = sqlsrv_query("SELECT tempat FROM db_qc.mutasi_kain WHERE nokk='$row[nokk]' and no_mutasi='$row[idmutasi]' order by id asc");
          $myBlk = sqlsrv_fetch_array($sqlsrv);
        ?>
         <tr bgcolor="<?php echo $bgcolor; ?>">
           <td><?php echo date("d-M-Y", strtotime($row['tgl_update'])); ?></td>
           <td><?php echo $row['pelanggan']; ?></td>
           <td><?php echo $row['no_po']; ?></td>
           <td><?php echo $row['no_order']; ?></td>
           <td><?php echo htmlentities($row['jenis_kain'], ENT_QUOTES); ?></td>
           <td><?php echo $row['no_warna']; ?></td>
           <td><?php echo $row['warna']; ?></td>
           <td><a href="#" onClick="window.open('detail-masuk-kain_bs.php?nokk=<?php echo $row['nokk']; ?>&ket=<?php echo $row['sisa']; ?>','MyWindow','height=400,width=500');"><?php echo $row['nokk']; ?></a></td>
           <td><?php echo $row['no_lot']; ?></td>
           <td align="right"><?php
                              $rol = $row['tot_rol'];
                              echo $rol;
                              ?></td>
           <td align="right"><?php
                              $grab = number_format($row['grd_a'], '2', '.', ',');
                              echo $grab; ?></td>
           <td align="right"><?php
                              $grab = number_format($row['grd_b'], '2', '.', ',');
                              echo $grab; ?></td>
           <td align="right"><?php
                              $grc = number_format($row['grd_c'], '2', '.', ',');
                              echo $grc; ?></td>
           <td><?php if ($row['sisa'] == "SISA" || $row['sisa'] == "FKSI") {
                  echo "SISA";
                } else if ($row['sisa'] == "BS") {
                  echo "BS";
                } ?></td>
           <td align="right"><?php
                              if ($row['satuan'] == "PCS") {
                                echo number_format($row['netto']) . " " . $row['satuan'];
                              } else {
                                echo number_format($row['tot_yard'], '2', '.', ',') . " " . $row['satuan'];
                              } ?></td>
           <td><input class="input1" name="tempat[<?php echo $i; ?>]" type="hidden" value="<?php echo $myBlk['blok']; ?>">
             <input name="nokk" type="hidden" value="<?php echo $row['nokk']; ?>"><a href="#" onClick="window.open('tempat-persediaan.php?id=<?php echo $row['id_stok']; ?>&nokk=<?php echo $row['nokk']; ?>&ket=<?php echo $row['sisa']; ?>','MyWindow','height=200,width=500');"><?php
                                                                                                                                                                                                                                                                                    if ($myBlk['tempat'] != "") {
                                                                                                                                                                                                                                                                                      echo $myBlk['tempat'];
                                                                                                                                                                                                                                                                                    } else if ($row['blok'] != "") {
                                                                                                                                                                                                                                                                                      echo $row['blok'];
                                                                                                                                                                                                                                                                                    } else {
                                                                                                                                                                                                                                                                                      echo "N/A";
                                                                                                                                                                                                                                                                                    } ?></a>
           </td>
           <td><?php echo $row['lebar']; ?></td>
           <td>X</td>
           <td><?PHP echo $row['berat']; ?></td>
           <td align="center"><?php echo $row['ket'];
                              $i++; ?></td>
         </tr>

       <?php
          if ($row['sisa'] == "SISA" || $row['sisa'] == "FKSI" || $row['sisa'] == "FOC") {
            $brtoo = 0;
          } else {
            $brtoo = number_format($row['bruto'], '2', '.', ',');
          }
          $totbruto = $totbruto + $brtoo;
          $totyard = $totyard + $row['tot_yard'];
          $totrol = $totrol + $rol;
          $totaba = $totaba + $row['grd_a'];
          $totabb = $totabb + $row['grd_b'];
          $tota = $tota + $row['grd_c'];
          if ($row['satuan'] == 'Meter') {
            $kartot = $kartot + $row['tot_yard'];
            $totrolm = $totrolm + $row['tot_rol'];
          }
          if ($row['satuan'] == 'Yard') {
            $pltot = $pltot + $row['tot_yard'];
            $totroly = $totroly + $row['tot_rol'];
          }
        }


        ?>
       <tr bgcolor="#99FFFF">
         <td bgcolor="#CCFF99">&nbsp;</td>
         <td bgcolor="#CCFF99">&nbsp;</td>
         <td bgcolor="#CCFF99"></td>
         <td bgcolor="#CCFF99"></td>
         <td bgcolor="#CCFF99">&nbsp;</td>
         <td bgcolor="#CCFF99">&nbsp;</td>
         <td bgcolor="#CCFF99">&nbsp;</td>
         <td bgcolor="#CCFF99">&nbsp;</td>
         <td bgcolor="#CCFF99">&nbsp;</td>
         <td bgcolor="#CCFF99">&nbsp;</td>
         <td bgcolor="#CCFF99">&nbsp;</td>
         <td bgcolor="#CCFF99">&nbsp;</td>
         <td bgcolor="#CCFF99">&nbsp;</td>
         <td bgcolor="#CCFF99">&nbsp;</td>
         <td bgcolor="#CCFF99">&nbsp;</td>
         <td bgcolor="#CCFF99"></td>
         <td bgcolor="#CCFF99">&nbsp;</td>
         <td bgcolor="#CCFF99">&nbsp;</td>
         <td bgcolor="#CCFF99">&nbsp;</td>
         <td bgcolor="#CCFF99">&nbsp;</td>
       </tr>
       <tr bgcolor="#99FFFF">
         <td bgcolor="#CCFF99">&nbsp;</td>
         <td bgcolor="#CCFF99">&nbsp;</td>
         <td bgcolor="#CCFF99">&nbsp;</td>
         <td bgcolor="#CCFF99">&nbsp;</td>
         <td bgcolor="#CCFF99">&nbsp;</td>
         <td bgcolor="#CCFF99">&nbsp;</td>
         <td bgcolor="#CCFF99">&nbsp;</td>
         <td bgcolor="#CCFF99">&nbsp;</td>
         <td bgcolor="#CCFF99">Meter</td>
         <td align="right" bgcolor="#CCFF99"><?php echo number_format($totrolm); ?></td>
         <td bgcolor="#CCFF99">&nbsp;</td>
         <td bgcolor="#CCFF99">&nbsp;</td>
         <td bgcolor="#CCFF99">&nbsp;</td>
         <td bgcolor="#CCFF99">Meter</td>
         <td align="right" bgcolor="#CCFF99"><?php echo number_format($kartot, '2', '.', ','); ?></td>
         <td bgcolor="#CCFF99">&nbsp;</td>
         <td bgcolor="#CCFF99">&nbsp;</td>
         <td bgcolor="#CCFF99">&nbsp;</td>
         <td bgcolor="#CCFF99">&nbsp;</td>
         <td bgcolor="#CCFF99">&nbsp;</td>
       </tr>
       <tr bgcolor="#99FFFF">
         <td bgcolor="#CCFF99">&nbsp;</td>
         <td bgcolor="#CCFF99">&nbsp;</td>
         <td bgcolor="#CCFF99">&nbsp;</td>
         <td bgcolor="#CCFF99">&nbsp;</td>
         <td bgcolor="#CCFF99">&nbsp;</td>
         <td bgcolor="#CCFF99">&nbsp;</td>
         <td bgcolor="#CCFF99">&nbsp;</td>
         <td bgcolor="#CCFF99">&nbsp;</td>
         <td bgcolor="#CCFF99">Yard</td>
         <td align="right" bgcolor="#CCFF99"><?php echo  number_format($totroly); ?></td>
         <td bgcolor="#CCFF99">&nbsp;</td>
         <td bgcolor="#CCFF99">&nbsp;</td>
         <td bgcolor="#CCFF99">&nbsp;</td>
         <td bgcolor="#CCFF99">Yard</td>
         <td align="right" bgcolor="#CCFF99"><?php echo  number_format($pltot, '2', '.', ','); ?></td>
         <td bgcolor="#CCFF99">&nbsp;</td>
         <td bgcolor="#CCFF99">&nbsp;</td>
         <td bgcolor="#CCFF99">&nbsp;</td>
         <td bgcolor="#CCFF99">&nbsp;</td>
         <td bgcolor="#CCFF99">&nbsp;</td>
       </tr>
       <tr bgcolor="#99FFFF">
         <td bgcolor="#CCFF99">&nbsp;</td>
         <td bgcolor="#CCFF99">&nbsp;</td>
         <td bgcolor="#CCFF99">&nbsp;</td>
         <td bgcolor="#CCFF99">&nbsp;</td>
         <td bgcolor="#CCFF99">&nbsp;</td>
         <td bgcolor="#CCFF99">&nbsp;</td>
         <td bgcolor="#CCFF99"><b>Total</b></td>
         <td bgcolor="#CCFF99">&nbsp;</td>
         <td bgcolor="#CCFF99">&nbsp;</td>
         <td align="right" bgcolor="#CCFF99"><b><?php echo $totrol; ?></td>
         <td align="right" bgcolor="#CCFF99"><b><?php echo number_format($totaba, '2', '.', ','); ?></b></td>
         <td align="right" bgcolor="#CCFF99"><b><?php echo number_format($totabb, '2', '.', ','); ?></b></td>
         <td align="right" bgcolor="#CCFF99"><b><?php echo number_format($tota, '2', '.', ','); ?></b></td>
         <td bgcolor="#CCFF99">&nbsp;</td>
         <td align="right" bgcolor="#CCFF99">&nbsp;</td>

         <td bgcolor="#CCFF99">&nbsp;</td>
         <td bgcolor="#CCFF99">&nbsp;</td>
         <td bgcolor="#CCFF99">&nbsp;</td>
         <td bgcolor="#CCFF99">&nbsp;</td>
         <td bgcolor="#CCFF99">&nbsp;</td>
       </tr>

     </table>
     </form>



     <div class="cleared"></div>
   </div>
   </div>
   </div>
   </div>
   </div>
   </div>
   </div>

 </body>

 </html>