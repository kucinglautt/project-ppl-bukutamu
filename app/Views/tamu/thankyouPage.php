<?= $this->extend('auth/templates/index'); ?>/

<?= $this->section('content'); ?>/

<title>Sistem Informasi Buku Tamu - Thank You</title>

    <div class="container">

        <!-- Outer Row -->
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
                            <div class="col">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">Terima Kasih</h1>
                                        <p class="mb-2">Formulir Anda Telah Terkirim</p>
                                    </div>
                                    <form class="user">
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="<?= base_url('/'); ?>">Kembali</a>
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