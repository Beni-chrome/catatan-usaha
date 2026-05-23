<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Penjualan</h2>

    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
        Catat Penjualan
    </button>
</div>

<form method="get" class="card card-body shadow border-0 mb-4">
    <div class="row align-items-end">
        <div class="col-md-4">
            <label>Filter Tanggal</label>
            <input type="date" name="tanggal" value="<?= esc($tanggal ?? '') ?>" class="form-control">
        </div>

        <div class="col-md-4">
            <button class="btn btn-primary">Filter</button>
            <a href="<?= site_url('/penjualan') ?>" class="btn btn-secondary">Reset</a>
        </div>
    </div>
</form>

<div class="card shadow border-0">
    <div class="card-body table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>Tanggal</th>
                    <th>Produk</th>
                    <th>Jumlah</th>
                    <th>Harga Jual</th>
                    <th>Total</th>
                    <th>Keterangan</th>
                    <th width="180">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($penjualan as $item): ?>
                    <tr>
                        <td><?= esc($item['tanggal']) ?></td>
                        <td><?= esc($item['produk']['nama'] ?? '-') ?></td>
                        <td><?= esc($item['jumlah']) ?></td>
                        <td>Rp <?= number_format($item['harga_jual'], 0, ',', '.') ?></td>
                        <td>Rp <?= number_format($item['total'], 0, ',', '.') ?></td>
                        <td><?= esc($item['keterangan'] ?? '-') ?></td>
                        <td>
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit<?= $item['id'] ?>">
                                Edit
                            </button>

                            <a href="<?= site_url('/penjualan/delete/' . $item['id']) ?>"
                               onclick="return confirm('Hapus transaksi ini?')"
                               class="btn btn-danger btn-sm">
                                Hapus
                            </a>
                        </td>
                    </tr>

                    <div class="modal fade" id="edit<?= $item['id'] ?>" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="post" action="<?= site_url('/penjualan/update/' . $item['id']) ?>">
                                    <div class="modal-header">
                                        <h5>Edit Penjualan</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label>Tanggal</label>
                                            <input type="date" name="tanggal" class="form-control" value="<?= esc($item['tanggal']) ?>" required>
                                        </div>

                                        <div class="mb-3">
                                            <label>Produk</label>
                                            <select name="produk_id" class="form-control" required>
                                                <?php foreach ($produk as $p): ?>
                                                    <option value="<?= $p['id'] ?>" <?= (($item['produk']['id'] ?? null) == $p['id']) ? 'selected' : '' ?>>
                                                        <?= esc($p['nama']) ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label>Jumlah</label>
                                            <input type="number" step="0.01" name="jumlah" id="jumlah_edit_<?= $item['id'] ?>"
                                                   class="form-control" value="<?= esc($item['jumlah']) ?>" required
                                                   oninput="hitungTotal('jumlah_edit_<?= $item['id'] ?>','harga_edit_<?= $item['id'] ?>','total_edit_<?= $item['id'] ?>')">
                                        </div>

                                        <div class="mb-3">
                                            <label>Harga Jual</label>
                                            <input type="number" step="0.01" name="harga_jual" id="harga_edit_<?= $item['id'] ?>"
                                                   class="form-control" value="<?= esc($item['harga_jual']) ?>" required
                                                   oninput="hitungTotal('jumlah_edit_<?= $item['id'] ?>','harga_edit_<?= $item['id'] ?>','total_edit_<?= $item['id'] ?>')">
                                        </div>

                                        <div class="mb-3">
                                            <label>Total</label>
                                            <input type="number" step="0.01" name="total" id="total_edit_<?= $item['id'] ?>"
                                                   class="form-control" value="<?= esc($item['total']) ?>" readonly>
                                        </div>

                                        <div class="mb-3">
                                            <label>Keterangan</label>
                                            <textarea name="keterangan" class="form-control"><?= esc($item['keterangan'] ?? '') ?></textarea>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="<?= site_url('/penjualan/store') ?>">
                <div class="modal-header">
                    <h5>Catat Penjualan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label>Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" value="<?= date('Y-m-d') ?>" required>
                    </div>

                    <div class="mb-3">
                        <label>Produk</label>
                        <select name="produk_id" class="form-control" required>
                            <?php foreach ($produk as $p): ?>
                                <option value="<?= $p['id'] ?>"><?= esc($p['nama']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Jumlah</label>
                        <input type="number" step="0.01" name="jumlah" id="jumlah_tambah" class="form-control" required
                               oninput="hitungTotal('jumlah_tambah','harga_tambah','total_tambah')">
                    </div>

                    <div class="mb-3">
                        <label>Harga Jual</label>
                        <input type="number" step="0.01" name="harga_jual" id="harga_tambah" class="form-control" required
                               oninput="hitungTotal('jumlah_tambah','harga_tambah','total_tambah')">
                    </div>

                    <div class="mb-3">
                        <label>Total</label>
                        <input type="number" step="0.01" name="total" id="total_tambah" class="form-control" readonly>
                    </div>

                    <div class="mb-3">
                        <label>Keterangan</label>
                        <textarea name="keterangan" class="form-control"></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
