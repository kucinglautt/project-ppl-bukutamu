<?= $this->extend('/templates/admin/index'); ?>

<?= $this->section('page-content'); ?>

<title>Sistem Informasi Buku Tamu - Log Aktivitas</title>

<?php if(session()->getFlashdata('Pesan')): ?>
    <div class="alert alert-warning">
        <?= session()->getFlashdata('Pesan'); ?>
    </div>
<?php endif; ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Log Aktivitas</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
            <tr>
            <th>Waktu</th>
            <th>User</th>
            <th>Aksi</th>
            <th>Detail</th>
            <th>IP</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($logs as $log): ?>
        <tr>
            <td><?= date('d-m-Y H:i:s', strtotime($log['created_at'])) ?></td>
            <td><?= esc($log['username']) ?></td>
            <td><?= esc($log['action']) ?></td>
            <td><?= esc($log['detail']) ?></td>
            <td><?= esc($log['ip_address']) ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
                </table>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<?= $this->endSection(); ?>
