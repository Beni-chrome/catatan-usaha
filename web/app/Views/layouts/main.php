<?php
$usaha = session()->get('usaha') ?? [];
$primer = $usaha['warna_primer'] ?? '#8B4513';
$sekunder = $usaha['warna_sekunder'] ?? '#D2691E';

function hexToRgb($hex)
{
    $hex = str_replace('#', '', $hex);
    if (strlen($hex) === 3) {
        $r = hexdec(str_repeat($hex[0], 2));
        $g = hexdec(str_repeat($hex[1], 2));
        $b = hexdec(str_repeat($hex[2], 2));
    } else {
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));
    }
    return "$r, $g, $b";
}

$logoUrl = !empty($usaha['logo'])
    ? 'http://127.0.0.1:8000/storage/' . $usaha['logo']
    : base_url('assets/img/default-logo.png');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?= esc($title ?? 'Catatan Usaha') ?></title>

    <link rel="stylesheet" href="<?= base_url('assets/bootstrap/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/custom.css') ?>">

    <style>
        :root {
            --bs-primary: <?= esc($primer) ?>;
            --bs-primary-rgb: <?= hexToRgb($primer) ?>;
            --bs-secondary: <?= esc($sekunder) ?>;
        }

        .bg-primary,
        .btn-primary {
            background-color: var(--bs-primary) !important;
            border-color: var(--bs-primary) !important;
        }

        .text-primary {
            color: var(--bs-primary) !important;
        }

        .bg-secondary,
        .btn-secondary {
            background-color: var(--bs-secondary) !important;
            border-color: var(--bs-secondary) !important;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center gap-2" href="<?= site_url('/dashboard') ?>">
            <img src="<?= esc($logoUrl) ?>" class="logo-usaha" onerror="this.style.display='none'">
            <span><?= esc($usaha['nama_usaha'] ?? 'CATATAN USAHA') ?></span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarMenu">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="<?= site_url('/dashboard') ?>">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= site_url('/produk') ?>">Produk</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= site_url('/penjualan') ?>">Penjualan</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= site_url('/laporan') ?>">Laporan</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= site_url('/profil') ?>">Profil</a></li>

                <?php if (($usaha['role'] ?? '') === 'super_admin'): ?>
                    <li class="nav-item"><a class="nav-link" href="<?= site_url('/admin/usaha') ?>">Super Admin</a></li>
                <?php endif; ?>

                <li class="nav-item"><a class="nav-link" href="<?= site_url('/logout') ?>">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container py-4">

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <?= $this->renderSection('content') ?>

</div>

<script src="<?= base_url('assets/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= base_url('assets/chartjs/chart.min.js') ?>"></script>
<script src="<?= base_url('assets/js/custom.js') ?>"></script>

<?= $this->renderSection('script') ?>

</body>
</html>
