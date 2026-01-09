<?php
    if (isset($_POST['cari_delivery'])) {
        $mesin = $_POST['mesin'];
        $tgl1 = $_POST['tgl1'];
        $tgl2 = $_POST['tgl2'];
        header("Location: brs_harian.php?mesin=$mesin&tgl1=$tgl1&tgl2=$tgl2");
    }
?>
<?php require_once 'header.php'; ?>
<title><?php $title = "FIN - Filter Laporan Harian"; echo $title; ?></title>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><i class="nav-icon fas fa-search"></i> FILTER PENCARIAN LAPORAN HARIAN BRUSHING</h1>
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
                                            <!-- <?php 
                                                // $sqlDB2="SELECT * FROM ";
                                                // $stmt=db2_exec($conn1,$sqlDB2, array('cursor'=>DB2_SCROLLABLE));
                                                // while ($rowdb2 = db2_fetch_assoc($stmt)) {
                                            ?>
                                            <?php // } ?> -->
                                            <option value="AIR1">AIR1 - Airo</option>
                                            <option value="COM1">COM1 - Combing Face</option>
                                            <option value="COM2">COM2 - Combing Back</option>
                                            <option value="POL1">POL1 - Polishing</option>
                                            <option value="RSE1">RSE1 - Raising greige face</option>
                                            <option value="RSE2">RSE2 - Raising greige back</option>
                                            <option value="RSE3">RSE3 - Raising finished face</option>
                                            <option value="RSE4">RSE4 - Raising finished back</option>
                                            <option value="RSE4-R1">RSE4-R1 - Raising finished back reproces</option>
                                            <option value="RSE5">RSE5 - Raising finished 2 side</option>
                                            <option value="SHR1">SHR1 - Shearing greige face</option>
                                            <option value="SHR2">SHR2 - Shearing greige back</option>
                                            <option value="SHR3">SHR3 - Shearing finished face</option>
                                            <option value="SHR4">SHR4 - Shearing finished back</option>
                                            <option value="SUE1">SUE1 - Sueding greige face</option>
                                            <option value="SUE2">SUE2 - Sueding greige back</option>
                                            <option value="SUE3">SUE3 - Sueding greige face</option>
                                            <option value="SUE4">SUE4 - Sueding finished back</option>
                                            <option value="TDR1">TDR1 - Tumble dry</option>
                                            <option value="TDR2">TDR2 - Tumble dry-greige</option>
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