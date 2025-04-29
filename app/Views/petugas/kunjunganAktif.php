<?= $this->extend('/templates/petugas/index'); ?>

<?= $this->section('page-content'); ?>

<title>Sistem Informasi Buku Tamu - Kunjungan Aktif</title>

<?php if(session()->getFlashdata('Pesan')): ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('Pesan'); ?>
    </div>
<?php endif; ?>

<div class="container-fluid">

    <h1 class="h3 mb-2 text-gray-800">Kunjungan Aktif</h1>

<div class="card shadow mb-4">
    <div class="card-body">
    <h6 class="m-0 font-weight-bold text-dark">Kunjungan Aktif</h6>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTableAktif" width="100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Tamu</th>
                        <th>Institusi</th>
                        <th>Tujuan</th>
                        <th>No Telepon</th>
                        <th>Check In</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach ($kunjunganAktif as $visit): ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= esc($visit['guest_name']); ?></td>
                        <td><?= esc($visit['institution']); ?></td>
                        <td><?= esc($visit['purpose']); ?></td>
                        <td><?= esc($visit['phone_number']); ?></td>
                        <td><?= date('d-m-Y H:i', strtotime($visit['check_in'])); ?></td>
                        <td><?= ucfirst($visit['status']); ?></td>
                        <td>
                                <!-- Tombol Check Out -->
                                <form action="<?= base_url('/kunjungan-aktif/checkout/'.$visit['id']) ?>" method="post" style="display: inline;">
                                    <?= csrf_field(); ?>
                                    <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Yakin check out tamu ini?')">
                                        Check Out
                                    </button>
                                </form>

                                <!-- Tombol Batal -->
                                <form action="<?= base_url('/kunjungan-aktif/batal/'.$visit['id']) ?>" method="post" style="display: inline;">
                                    <?= csrf_field(); ?>
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin batalin tamu ini?')">
                                        Batal
                                    </button>
                                </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if (empty($kunjunganAktif)): ?>
                    <tr>
                        <td colspan="8" class="text-center">Belum ada kunjungan aktif.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
    <h6 class="m-0 font-weight-bold text-dark">Riwayat Kunjungan Terbaru</h6>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTableTerbaru" width="100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Tamu</th>
                        <th>Institusi</th>
                        <th>Tujuan</th>
                        <th>No Telepon</th>
                        <th>Check In</th>
                        <th>Check Out</th>
                        <th>Status</th>
                        <th>Petugas</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach ($kunjunganTerbaru as $visit): ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= esc($visit['guest_name']); ?></td>
                        <td><?= esc($visit['institution']); ?></td>
                        <td><?= esc($visit['purpose']); ?></td>
                        <td><?= esc($visit['phone_number']); ?></td>
                        <td><?= date('d-m-Y H:i', strtotime($visit['check_in'])); ?></td>
                        <td><?= $visit['check_out'] ? date('d-m-Y H:i', strtotime($visit['check_out'])) : '-' ?></td>
                        <td><?= ucfirst($visit['status']); ?></td>
                        <td><?= $visit['handled_by'] ? esc($visit['handled_by']) : '-'; ?></td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if (empty($kunjunganTerbaru)): ?>
                    <tr>
                        <td colspan="8" class="text-center">Belum ada kunjungan terbaru.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


</div>

<?= $this->endSection(); ?>
