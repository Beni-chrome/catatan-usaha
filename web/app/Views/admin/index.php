<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<h2 class="mb-4">Super Admin - Semua Usaha</h2>

<div class="card shadow border-0">
    <div class="card-body table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>Nama Usaha</th>
                    <th>Pemilik</th>
                    <th>Email</th>
                    <th>Telepon</th>
                    <th>Role</th>
                    <th width="120">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usaha as $item): ?>
                    <tr>
                        <td><?= esc($item['nama_usaha']) ?></td>
                        <td><?= esc($item['nama_pemilik']) ?></td>
                        <td><?= esc($item['email']) ?></td>
                        <td><?= esc($item['telepon']) ?></td>
                        <td><?= esc($item['role']) ?></td>
                        <td>
                            <?php if ($item['role'] !== 'super_admin'): ?>
                                <a href="<?= site_url('/admin/usaha/delete/' . $item['id']) ?>"
                                   onclick="return confirm('Hapus usaha ini?')"
                                   class="btn btn-danger btn-sm">
                                    Hapus
                                </a>
                            <?php else: ?>
                                -
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
