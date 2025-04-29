<?= $this->extend('auth/templates/index'); ?>/

<?= $this->section('content'); ?>/

    <title>Sistem Informasi Buku Tamu - Login</title>

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
                            <div class="col-lg">
                                <div class="p-5">
                                    <?php if (session()->getFlashdata('Pesan')): ?>
                                        <div class="alert alert-danger">
                                            <?= session()->getFlashdata('Pesan'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Masuk Sebagai Admin</h1>
                                    </div>
                                        <?php
                                            if(session()->getFlashdata('pesan'))
                                            echo '<div class="alert alert-danger">'.session()->getFlashdata('pesan').'</div>';
                                        ?>

                                        <form class="user" method="post" action="<?= base_url('/login'); ?>">
                                            <?= csrf_field(); ?> <!-- Ini untuk menghindari CSRF -->
                                            
                                            <div class="form-group">
                                                <input type="text" class="form-control form-control-user" id="InputUsername" placeholder="Username" name="username" value="<?= isset($_COOKIE['loginId']) ? $_COOKIE['loginId'] : ''; ?>">
                                            </div>

                                            <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="InputPassword" placeholder="Password" name="password" value="<?= isset($_COOKIE['loginPass']) ? $_COOKIE['loginPass'] : ''; ?>">
                                            </div>

                                            <!-- Mulai diubah di sini -->
                                            <div class="form-group d-flex justify-content-between align-items-center">
                                                <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="remember_me" name="remember_me" <?= isset($_COOKIE['loginId']) ? 'checked' : ''; ?>>
                                                <label class="custom-control-label" for="remember_me">Remember Me</label>
                                                </div>
                                                <div>
                                                    <a class="small" href="<?= base_url('/lupa-password'); ?>">Lupa Password?</a>
                                                </div>
                                            </div>
                                            <!-- Sampai sini -->

                                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                                Login
                                            </button>
                                        </form>
                                    <hr>
                                    <div class="text-center mt-3">
                                        <a href="<?= base_url('/form'); ?>"><b>Isi Daftar Tamu</b></a>
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