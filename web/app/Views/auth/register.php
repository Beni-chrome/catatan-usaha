<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Register - Catatan Usaha</title>
    <link rel="stylesheet" href="<?= base_url('assets/bootstrap/css/bootstrap.min.css') ?>">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="card shadow border-0 rounded-4">
        <div class="card-body p-4">
            <h3 class="mb-3">Daftar Usaha Baru</h3>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <form method="post" action="<?= site_url('/register') ?>" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Nama Usaha</label>
                        <input type="text" name="nama_usaha" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Nama Pemilik</label>
                        <input type="text" name="nama_pemilik" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Telepon</label>
                        <input type="text" name="telepon" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Logo Usaha</label>
                        <input type="file" name="logo" class="form-control">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control" required></textarea>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Warna Primer</label>
                        <input type="color" name="warna_primer" id="warna_primer" class="form-control form-control-color" value="#8B4513">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Warna Sekunder</label>
                        <input type="color" name="warna_sekunder" id="warna_sekunder" class="form-control form-control-color" value="#D2691E">
                    </div>

                    <div class="col-md-12 mb-3">
                        <div id="previewBox" class="p-3 rounded text-white" style="background:#8B4513;">
                            Preview tema usaha
                        </div>
                    </div>
                </div>

                <button class="btn btn-primary">Daftar</button>
                <a href="<?= site_url('/login') ?>" class="btn btn-secondary">Kembali Login</a>
            </form>
        </div>
    </div>
</div>

<script src="<?= base_url('assets/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<script>
const primer = document.getElementById('warna_primer');
const sekunder = document.getElementById('warna_sekunder');
const preview = document.getElementById('previewBox');

function updatePreview() {
    preview.style.background = `linear-gradient(90deg, ${primer.value}, ${sekunder.value})`;
}

primer.addEventListener('input', updatePreview);
sekunder.addEventListener('input', updatePreview);
</script>

</body>
</html>
