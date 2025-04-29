<?= $this->extend('templates/admin/index'); ?>

<?= $this->section('page-content'); ?>

<title>Sistem Informasi Buku Tamu - Kelola Petugas</title>

<?php if(session()->getFlashdata('errors')): ?>
    <div class="alert alert-danger">
        <ul class="mb-0">
            <?php foreach(session()->getFlashdata('errors') as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach ?>
        </ul>
    </div>
<?php endif; ?>

<!-- Begin Page Content -->
<div class="container-fluid">

<h1 class="h3 mb-2 text-gray-800">Tambah Petugas</h1>

<form action="<?= base_url('/kelola-petugas/create'); ?>" method="post">
    <?= csrf_field(); ?>

    <div class="form-group">
        <label for="username">Username </label>
        <div class="col-sm-6">
        <input type="text" class="form-control" id="username" name="username" value="<?= old('username'); ?>" required>
        </div>
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <div class="col-sm-6">
        <input type="password" class="form-control" id="password" name="password" required>
        </div>
    </div>

    <div class="form-group">
        <label for="role">Role</label>
        <div class="col-sm-6">
        <?php $selectedRole = old('role') ?? 'petugas'; ?>
        <select class="form-control" id="role" name="role" required>
            <option value="admin" <?= $selectedRole == 'admin' ? 'selected' : ''; ?>>Admin</option>
            <option value="petugas" <?= $selectedRole == 'petugas' ? 'selected' : ''; ?>>Petugas</option>
        </select>
        </div>
    </div>

    <div class="d-flex">
        <a href="<?= base_url('/kelola-petugas'); ?>" class="btn btn-secondary mb-3 mr-2">Kembali</a>
        <button type="submit" class="btn btn-primary mb-3">Simpan</button>
    </div>


</form>

</div>
<!-- /.container-fluid -->

<?= $this->endSection(); ?>
