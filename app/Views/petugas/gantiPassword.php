<?= $this->extend('templates/petugas/index'); ?>

<?= $this->section('page-content'); ?>

<title>Sistem Informasi Buku Tamu - Change Password</title>

    <!-- Tampilkan error jika ada -->
    <?php if(session()->getFlashdata('errors')): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach(session()->getFlashdata('errors') as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php endif; ?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <h2>Ganti Password</h2>

    <form method="post" action="<?= base_url('/ganti-password-petugas/change'); ?>">
        <?= csrf_field(); ?>

        <!-- Password Lama -->
        <div class="form-group">
            <label for="old_password">Password Lama</label>
            <div class="col-sm-6">
            <input type="password" class="form-control" id="old_password" name="old_password">
            </div>
        </div>

        <!-- Password Baru -->
        <div class="form-group">
            <label for="new_password">Password Baru</label>
            <div class="col-sm-6">
            <input type="password" class="form-control" id="new_password" name="new_password">
            </div>
        </div>

        <!-- Konfirmasi Password Baru -->
        <div class="form-group">
            <label for="confirm_password">Konfirmasi Password Baru</label>
            <div class="col-sm-6">
            <input type="password" class="form-control" id="confirm_password" name="confirm_password">
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Ganti Password</button>
    </form>
</div>

<?= $this->endSection(); ?>
