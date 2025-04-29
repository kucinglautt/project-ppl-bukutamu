<?= $this->extend('/templates/admin/index'); ?>

<?= $this->section('page-content'); ?>

<title>Sistem Informasi Buku Tamu - Kelola Petugas</title>

    <?php if(session()->getFlashdata('Pesan')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('Pesan'); ?>
        </div>
    <?php endif; ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Kelola Petugas</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
            <a href="<?= base_url('/kelola-petugas/add'); ?>" class="btn btn-primary">Tambah</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Username</th>
                                <th>Role</th>
                                <th>Dibuat Pada</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; foreach($activeUsers as $user): ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $user['username']; ?></td>
                                    <td><?= $user['role']; ?></td>
                                    <td><?= $user['created_at']; ?></td>
                                    <td class="d-flex justify-content-start align-items-center">
                                        <a href="<?= base_url('/kelola-petugas/edit/' . $user['id']); ?>" class="btn btn-warning btn-sm mr-2">Edit</a>
                                        <!-- Form Delete -->
                                        <form action="<?= base_url('/kelola-petugas/delete/' . $user['id']); ?>" method="post" onsubmit="return confirm('Yakin ingin menghapus petugas ini?')">
                                            <?= csrf_field(); ?>
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
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