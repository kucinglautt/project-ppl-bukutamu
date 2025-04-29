<?= $this->extend('/templates/petugas/index'); ?>

<?= $this->section('page-content'); ?>

<title>Sistem Informasi Buku Tamu - Dashboard</title>

    <?php if(session()->getFlashdata('Pesan')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('Pesan'); ?>
        </div>
    <?php endif; ?>

<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Card Jumlah Tamu Hari Ini -->
<div class="row">
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Tamu Hari Ini</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlahTamuHariIni; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Instansi Paling Banyak Bertamu -->
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Instansi Terbanyak</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $instansiTerbanyak['institution'] ?? 'Tidak Ada'; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-building fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Tamu Terbaru</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Nama</th>
                        <th>Institusi</th>
                        <th>Tujuan</th>
                        <th>Nomor Telepon</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($recentGuests as $index => $guest): ?>
                        <tr>
                            <td><?= esc($guest['created_at']); ?></td>
                            <td><?= esc($guest['name']); ?></td>
                            <td><?= esc($guest['institution']); ?></td>
                            <td><?= esc($guest['purpose']); ?></td>
                            <td><?= esc($guest['phone_number']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>
<!-- /.container-fluid -->

<?= $this->endSection(); ?>
