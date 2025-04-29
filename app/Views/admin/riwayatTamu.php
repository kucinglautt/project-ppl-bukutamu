<?= $this->extend('/templates/admin/index'); ?>

<?= $this->section('page-content'); ?>

<title>Sistem Informasi Buku Tamu - Riwayat Tamu</title>

<?php if(session()->getFlashdata('Pesan')): ?>
    <div class="alert alert-warning">
        <?= session()->getFlashdata('Pesan'); ?>
    </div>
<?php endif; ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Riwayat Tamu</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Nama</th>
                            <th>Institusi</th>
                            <th>Tujuan</th>
                            <th>No Telp</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach ($users as $user): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= date('d-m-Y', strtotime($user['created_at'])); ?></td>
                            <td><?= esc($user['name']); ?></td>
                            <td><?= esc($user['institution']); ?></td>
                            <td><?= esc($user['purpose']); ?></td>
                            <td><?= esc($user['phone_number']); ?></td>
                        </tr>
                        <?php endforeach; ?>

                        <?php if (empty($users)): ?>
                        <tr>
                            <td colspan="6" class="text-center">Belum ada data tamu.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
                <hr>
            </div>
            <a href="<?= base_url('/riwayat-tamu/export-pdf'); ?>" class="btn btn-danger mb-3">
                <i class="fas fa-file-pdf"></i> Export PDF
            </a>

            <a href="<?= base_url('/riwayat-tamu/export-excel'); ?>" class="btn btn-success mb-3">
                <i class="fas fa-file-excel"></i> Export Excel
            </a>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<?= $this->endSection(); ?>
