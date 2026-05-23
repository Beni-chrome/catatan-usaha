<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2>Dashboard</h2>
        <p class="text-muted mb-0">
            Selamat datang di aplikasi Catatan Usaha
        </p>
    </div>
</div>

<div class="row">

    <div class="col-md-4 mb-4">
        <div class="card card-dashboard bg-primary shadow">
            <div class="card-body">
                <h6>Total Penjualan Hari Ini</h6>

                <h3>
                    Rp <?= number_format($data['total_penjualan_hari_ini'] ?? 0, 0, ',', '.') ?>
                </h3>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card card-dashboard bg-secondary shadow">
            <div class="card-body">
                <h6>Jumlah Transaksi</h6>

                <h3>
                    <?= $data['jumlah_transaksi_hari_ini'] ?? 0 ?>
                </h3>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card card-dashboard bg-dark shadow">
            <div class="card-body">
                <h6>Omzet Bulan Ini</h6>

                <h3>
                    Rp <?= number_format($data['omzet_bulan_ini'] ?? 0, 0, ',', '.') ?>
                </h3>
            </div>
        </div>
    </div>

</div>

<div class="card shadow border-0 mb-4">
    <div class="card-body">
        <h5 class="mb-3">Grafik 7 Hari Terakhir</h5>

        <canvas id="chartPenjualan"></canvas>
    </div>
</div>

<div class="card shadow border-0">
    <div class="card-body">

        <h5 class="mb-3">5 Transaksi Terbaru</h5>

        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Tanggal</th>
                        <th>Produk</th>
                        <th>Total</th>
                    </tr>
                </thead>

                <tbody>

                    <?php foreach (($data['transaksi_terbaru'] ?? []) as $item): ?>

                        <tr>
                            <td><?= esc($item['tanggal']) ?></td>

                            <td>
                                <?= esc($item['produk']['nama'] ?? '-') ?>
                            </td>

                            <td>
                                Rp <?= number_format($item['total'], 0, ',', '.') ?>
                            </td>
                        </tr>

                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>

    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>

<script>
const grafik = <?= json_encode($data['grafik_7_hari'] ?? []) ?>;

const labels = grafik.map(item => item.tanggal);
const totals = grafik.map(item => item.total);

new Chart(document.getElementById('chartPenjualan'), {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: 'Penjualan',
            data: totals
        }]
    }
});
</script>

<?= $this->endSection() ?>
