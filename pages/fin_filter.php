<?php
    if (isset($_POST['cari_delivery'])) {
        $mesin = $_POST['mesin'];
        $tgl1 = $_POST['tgl1'];
        $tgl2 = $_POST['tgl2'];
        header("Location: fin_harian.php?mesin=$mesin&tgl1=$tgl1&tgl2=$tgl2");
    }
?>
<?php require_once 'header.php'; ?>
<title><?php $title = "FIN - Filter Laporan Harian"; echo $title; ?></title>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><i class="nav-icon fas fa-search"></i> FILTER PENCARIAN LAPORAN HARIAN FINISHING</h1>
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
            <div class="col-4">
                <div class="card">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">A. Filter By <b>Date Begin Operation</b></h3>
                        </div>
                        <div class="card-body">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label>Jenis Mesin:</label>
                                    <div class="input-group">
                                        <select name="mesin" class="form-control select2" style="width: 100%;">
                                            <option disabled selected>Pilih jenis mesin</option>
                                            <?php 
                                                require_once "koneksi.php"; 
                                                $sqlDB2="SELECT * FROM WORKCENTER WHERE COSTCENTERCODE = 'C021'";
                                                $stmt=db2_exec($conn1,$sqlDB2, array('cursor'=>DB2_SCROLLABLE));
                                                while ($rowdb2 = db2_fetch_assoc($stmt)) {
                                            ?>
                                            <option value="<?= $rowdb2['CODE']; ?>"><?= $rowdb2['CODE'].' - '.$rowdb2['LONGDESCRIPTION']; ?></option>
                                            <?php  } ?> 
                                            <!-- <option value="CPT1">CPT1 - Compact</option>
                                            <option value="DRY1">DRY1 - Drying (Fabric)</option>
                                            <option value="FIN1">FIN1 - Finishing 1</option>
                                            <option value="FIN2">FIN2 - Finishing 2</option>
                                            <option value="FNJ1">FNJ1 - Final Finishing</option>
                                            <option value="JHP1">JHP1 - Re-tubing (jahit pinggir)</option>
                                            <option value="LIP1">LIP1 - Folding</option>
                                            <option value="OPW1">OPW1 - Slitting and washing</option>
                                            <option value="OVN1">OVN1 - Oven</option>
                                            <option value="PAD1">PAD1 - Padding</option>
                                            <option value="PDR1">PDR1 - Padder</option>
                                            <option value="PRE1">PRE1 - Preset</option> -->
                                        </select>
                                    </div>
                                    <hr>
                                    <label>Dari Tanggal:</label>
                                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                        <input type="date" name="tgl1" class="form-control" required/>
                                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                    <label>Sampai Tanggal:</label>
                                    <div class="input-group date" id="reservationdate2" data-target-input="nearest">
                                        <input type="date" name="tgl2" class="form-control" required/>
                                        <div class="input-group-append" data-target="#reservationdate2" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                    <label>Shift:</label>
                                    <div class="input-group">
                                        <select name="shift" class="form-control" style="width: 100%;">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                        </select>
                                    </div>
                                </div>
                                <button type="submit" name="cari_delivery" class="btn btn-primary">Cari data</button>
                            </form>
                        </div>
                        <div class="card-footer">
                            Gunakan <a href="#">Filter Pencarian </a> Cari laporan berdasarkan <b>Begin Operation</b>. Data pencarian berdasarkan data yang tersimpan dalam database NOW. Untuk data pada program lama tidak dapat dicari menggunakan sistem ini.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once 'footer.php'; ?>