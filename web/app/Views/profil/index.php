<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<h2 class="mb-4">Profil Usaha</h2>

<div class="row">
    <div class="col-md-8">
        <div class="card shadow border-0">
            <div class="card-body">
                <form method="post" action="<?= site_url('/profil/update') ?>">
                    <div class="mb-3">
                        <label>Nama Usaha</label>
                        <input type="text" name="nama_usaha" value="<?= esc($profil['nama_usaha'] ?? '') ?>" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Nama Pemilik</label>
                        <input type="text" name="nama_pemilik" value="<?= esc($profil['nama_pemilik'] ?? '') ?>" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Telepon</label>
                        <input type="text" name="telepon" value="<?= esc($profil['telepon'] ?? '') ?>" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control" required><?= esc($profil['alamat'] ?? '') ?></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Warna Primer</label>
                            <input type="color" name="warna_primer" class="form-control form-control-color" value="<?= esc($profil['warna_primer'] ?? '#8B4513') ?>">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Warna Sekunder</label>
                            <input type="color" name="warna_sekunder" class="form-control form-control-color" value="<?= esc($profil['warna_sekunder'] ?? '#D2691E') ?>">
                        </div>
                    </div>

                    <button class="btn btn-primary">Simpan Profil</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow border-0">
            <div class="card-body">
                <h5>Logo Usaha</h5>

                <?php if (!empty($profil['logo'])): ?>
                    <img src="http://127.0.0.1:8000/storage/<?= esc($profil['logo']) ?>" class="img-fluid rounded mb-3">
                <?php endif; ?>

                <form method="post" action="<?= site_url('/profil/logo') ?>" enctype="multipart/form-data">
                    <input type="file" name="logo" class="form-control mb-3" required>
                    <button class="btn btn-secondary w-100">Upload Logo</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
