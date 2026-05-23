<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Produk</h2>

    <button class="btn btn-primary"
            data-bs-toggle="modal"
            data-bs-target="#modalTambah">
        Tambah Produk
    </button>
</div>

<div class="card shadow border-0">

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-bordered align-middle">

                <thead class="table-light">
                    <tr>
                        <th>Nama</th>
                        <th>Satuan</th>
                        <th>Harga</th>
                        <th width="180">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    <?php foreach ($produk as $item): ?>

                        <tr>

                            <td><?= esc($item['nama']) ?></td>

                            <td><?= esc($item['satuan']) ?></td>

                            <td>
                                Rp <?= number_format($item['harga'], 0, ',', '.') ?>
                            </td>

                            <td>

                                <button
                                    class="btn btn-warning btn-sm"
                                    data-bs-toggle="modal"
                                    data-bs-target="#edit<?= $item['id'] ?>">
                                    Edit
                                </button>

                                <a href="<?= site_url('/produk/delete/' . $item['id']) ?>"
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Hapus produk ini?')">
                                    Hapus
                                </a>

                            </td>

                        </tr>

                        <div class="modal fade"
                             id="edit<?= $item['id'] ?>"
                             tabindex="-1">

                            <div class="modal-dialog">

                                <div class="modal-content">

                                    <form method="post"
                                          action="<?= site_url('/produk/update/' . $item['id']) ?>">

                                        <div class="modal-header">
                                            <h5>Edit Produk</h5>

                                            <button type="button"
                                                    class="btn-close"
                                                    data-bs-dismiss="modal"></button>
                                        </div>

                                        <div class="modal-body">

                                            <div class="mb-3">
                                                <label>Nama</label>

                                                <input type="text"
                                                       name="nama"
                                                       class="form-control"
                                                       value="<?= esc($item['nama']) ?>"
                                                       required>
                                            </div>

                                            <div class="mb-3">
                                                <label>Satuan</label>

                                                <input type="text"
                                                       name="satuan"
                                                       class="form-control"
                                                       value="<?= esc($item['satuan']) ?>"
                                                       required>
                                            </div>

                                            <div class="mb-3">
                                                <label>Harga</label>

                                                <input type="number"
                                                       name="harga"
                                                       class="form-control"
                                                       value="<?= esc($item['harga']) ?>"
                                                       required>
                                            </div>

                                        </div>

                                        <div class="modal-footer">

                                            <button class="btn btn-primary">
                                                Simpan
                                            </button>

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

</div>

<div class="modal fade" id="modalTambah" tabindex="-1">

    <div class="modal-dialog">

        <div class="modal-content">

            <form method="post" action="<?= site_url('/produk/store') ?>">

                <div class="modal-header">

                    <h5>Tambah Produk</h5>

                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"></button>

                </div>

                <div class="modal-body">

                    <div class="mb-3">
                        <label>Nama Produk</label>

                        <input type="text"
                               name="nama"
                               class="form-control"
                               required>
                    </div>

                    <div class="mb-3">
                        <label>Satuan</label>

                        <input type="text"
                               name="satuan"
                               class="form-control"
                               required>
                    </div>

                    <div class="mb-3">
                        <label>Harga</label>

                        <input type="number"
                               name="harga"
                               class="form-control"
                               required>
                    </div>

                </div>

                <div class="modal-footer">

                    <button class="btn btn-primary">
                        Simpan
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

<?= $this->endSection() ?>
