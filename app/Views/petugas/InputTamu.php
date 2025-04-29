<?= $this->extend('templates/petugas/index'); ?>

<?= $this->section('page-content'); ?>

<title>Sistem Informasi Buku Tamu - Input Tamu</title>

<!-- Menampilkan pesan sukses jika ada -->
<?php if(session()->getFlashdata('Pesan')): ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('Pesan'); ?>
    </div>
<?php endif; ?>

<!-- Menampilkan pesan error jika ada -->
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

<h1 class="h3 mb-2 text-gray-800">Input Data Tamu</h1>

<form action="<?= base_url('/input-tamu/create'); ?>" method="post">
    <?= csrf_field(); ?>

    <input type="hidden" name="redirectTo" value="input-tamu"> <!-- hidden field untuk redirect ke input-tamu -->

    <div class="form-group">
        <label for="name">Nama Tamu</label>
        <div class="col-sm-6">
        <input type="text" class="form-control" id="name" name="name" value="<?= old('name'); ?>" required>
        </div>
    </div>

    <div class="form-group">
        <label for="institution">Instansi</label>
        <div class="col-sm-6">
        <input type="text" class="form-control" id="institution" name="institution" value="<?= old('institution'); ?>" required>
        </div>
    </div>

    <div class="form-group">
        <label for="purpose">Tujuan</label>
        <div class="col-sm-6">
        <input type="text" class="form-control" id="purpose" name="purpose" value="<?= old('purpose'); ?>" required>
        </div>
    </div>

    <div class="form-group">
        <label for="phone_number">Nomor Telepon (opsional)</label>
        <div class="col-sm-6">
        <input type="text" class="form-control" id="phone_number" name="phone_number" value="<?= old('phone_number'); ?>">
        </div>
    </div>

    <div class="d-flex">
        <a href="<?= base_url('/dashboard-petugas'); ?>" class="btn btn-secondary mb-3 mr-2">Kembali</a>
        <button type="submit" class="btn btn-primary mb-3">Simpan</button>
    </div>

</form>

</div>
<!-- /.container-fluid -->

<?= $this->endSection(); ?>
