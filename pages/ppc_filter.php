<?php
    if (isset($_POST['cari_delivery'])) {
        $tgl1 = $_POST['tgl1'];
        $tgl2 = $_POST['tgl2'];
        header("Location: ppc_memopenting.php?tgl1=$tgl1&tgl2=$tgl2");
    }
?>
<?php require_once 'header.php'; ?>
<title><?php $title = "PPC - Filter Memo Penting"; echo $title; ?></title>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><i class="nav-icon fas fa-search"></i> FILTER PENCARIAN MEMO PENTING PPC</h1>
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
                            <h3 class="card-title">A. Filter By <b>Date Delivery</b></h3>
                        </div>
                        <div class="card-body">
                            <form action="" method="post">
                                <div class="form-group">
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
                            Gunakan <a href="#">Filter Pencarian </a> Cari laporan berdasarkan <b>tanggal delivery sales order</b>. Data pencarian berdasarkan data yang tersimpan dalam database NOW. Untuk data pada program lama tidak dapat dicari menggunakan sistem ini.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once 'footer.php'; ?>