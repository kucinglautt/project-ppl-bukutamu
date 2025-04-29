<?= $this->extend('/templates/admin/index'); ?>
<?= $this->section('page-content'); ?>

<title>Sistem Informasi Buku Tamu - Dashboard Admin</title>

    <?php if(session()->getFlashdata('Pesan')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('Pesan'); ?>
        </div>
    <?php endif; ?>

<div class="container-fluid">

    <!-- Kartu Statistik -->
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Tamu Hari Ini</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlahTamuHariIni; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar-day fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah Petugas</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlahPetugas; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-shield fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Kunjungan Bulan Ini</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $kunjunganBulanIni; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Instansi</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $totalInstansi; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-building fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
    <!-- Bar Chart -->
    <div class="col-md-6 mb-4">
        <div class="card shadow h-100">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tren Kunjungan 5 Bulan Terakhir</h6>
            </div>
            <div class="card-body">
                <canvas id="barChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Pie Chart -->
    <div class="col-md-6 mb-4">
        <div class="card shadow h-100">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Instansi Terbanyak</h6>
            </div>
            <div class="card-body">
            <canvas id="pieChart" style="max-width: 100%; height: 250px;"></canvas>
            </div>
        </div>
    </div>
</div>

</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const barCtx = document.getElementById('barChart').getContext('2d');
    const pieCtx = document.getElementById('pieChart').getContext('2d');

    new Chart(barCtx, {
        type: 'bar',
        data: {
            labels: <?= json_encode($barLabels); ?>,
            datasets: [{
                label: 'Jumlah Kunjungan',
                data: <?= json_encode($barData); ?>,
                backgroundColor: 'rgba(54, 162, 235, 0.7)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    precision: 0
                }
            }
        }
    });

    new Chart(pieCtx, {
        type: 'pie',
        data: {
            labels: <?= json_encode($pieLabels); ?>,
            datasets: [{
                label: 'Jumlah Tamu',
                data: <?= json_encode($pieData); ?>,
                backgroundColor: [
                    '#007bff',
                    '#28a745',
                    '#ffc107',
                    '#dc3545',
                    '#6c757d'
                ]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
</script>

<?= $this->endSection(); ?>
