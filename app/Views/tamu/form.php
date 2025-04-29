<?= $this->extend('auth/templates/index'); ?>/

<?= $this->section('content'); ?>/

    <title>Sistem Informasi Buku Tamu - Guest Form</title>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <a href="<?= base_url('/'); ?>" class="text-decoration-none">
                <div class="d-flex align-items-center">
                    <img src="<?= base_url('img/Lambang_Kota_Kendari.png'); ?>" alt="Logo Kota" style="width: 50px; height: 50px;">
                    <h5 class="ml-3 mb-0 text-white font-weight-bold">Sistem Informasi Buku Tamu</h5>
                </div>
            </a>
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Identitas Pengunjung</h1>
                                </div>

                                <?php if(session()->getFlashdata('errors')): ?>
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            <?php foreach(session()->getFlashdata('errors') as $error): ?>
                                                <li><?= esc($error) ?></li>
                                            <?php endforeach ?>
                                        </ul>
                                    </div>
                                <?php endif ?>

                                    <form action="<?= base_url('/form/save'); ?>" method="post">

                                    <input type="hidden" name="redirectTo" value="thankyou"> <!-- hidden field untuk redirect ke halaman thankyou -->

                                        <div class="form-group">
                                                <input type="text" name="name" class="form-control form-control-user mb-3" id="name" placeholder="Nama" value="<?= old('name') ?>">
                                            
                                                <input type="text" name="institution" class="form-control form-control-user mb-3" id="institution" placeholder="Institusi" value="<?= old('institution') ?>">
                                            
                                                <input type="text" name="purpose" class="form-control form-control-user mb-3" id="purpose" placeholder="Tujuan" value="<?= old('purpose') ?>">
                                    
                                                <input type="text" name="phone_number" class="form-control form-control-user mb-5" id="no_hp" placeholder="Nomor Telepon (opsional)" value="<?= old('phone_number') ?>">
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Submit
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>/