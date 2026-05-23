<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<h2 class="mb-4">Laporan</h2>

<div class="card shadow border-0 mb-4">
    <div class="card-body">
        <h5>Laporan Harian</h5>

        <form method="get" action="<?= site_url('/laporan') ?>" class="row align-items-end">
            <div class="col-md-4">
                <label>Tanggal</label>
                <input type="date" name="tanggal" value="<?= esc($tanggal) ?>" class="form-control">
            </div>

            <div class="col-md-4">
                <button class="btn btn-primary">Tampilkan</button>
                <a class="btn btn-danger" href="<?= site_url('/laporan/export-pdf?tanggal=' . $tanggal) ?>">PDF</a>
                <a class="btn btn-success" href="<?= site_url('/laporan/export-excel?tanggal=' . $tanggal) ?>">Excel</a>
            </div>
        </form>

        <hr>

        <h6>Total Harian: Rp <?= number_format($harian['total'] ?? 0, 0, ',', '.') ?></h6>
    </div>
</div>

<div class="card shadow border-0">
    <div class="card-body">
        <h5>Laporan Bulanan</h5>

        <form method="get" action="<?= site_url('/laporan') ?>" class="row align-items-end">
            <div class="col-md-3">
                <label>Bulan</label>
                <input type="number" name="bulan" min="1" max="12" value="<?= esc($bulan) ?>" class="form-control">
            </div>

            <div class="col-md-3">
                <label>Tahun</label>
                <input type="number" name="tahun" value="<?= esc($tahun) ?>" class="form-control">
            </div>

            <div class="col-md-6">
                <button class="btn btn-primary">Tampilkan</button>
                <a class="btn btn-danger" href="<?= site_url('/laporan/export-pdf?bulan=' . $bulan . '&tahun=' . $tahun) ?>">PDF</a>
                <a class="btn btn-success" href="<?= site_url('/laporan/export-excel?bulan=' . $bulan . '&tahun=' . $tahun) ?>">Excel</a>
            </div>
        </form>

        <hr>

        <h6>Total Bulanan: Rp <?= number_format($bulanan['total'] ?? 0, 0, ',', '.') ?></h6>
    </div>
</div>

<?= $this->endSection() ?>
