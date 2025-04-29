<?= $this->extend('templates/petugas/index'); ?>

<?= $this->section('page-content'); ?>

<title>Sistem Informasi Buku Tamu - Statistik Tamu</title>

<div class="container-fluid">

    <h1 class="h3 mb-2 text-gray-800">Statistik Tamu</h1>

    <div class="row">
    <!-- Form Dropdown Pilihan Rentang Waktu -->
    <div class="col-md-6 mb-3">
        <div class="card h-100">
            <div class="card-header">
                Rentang Waktu
            </div>
            <div class="card-body">
                <form method="get" action="<?= base_url('/statistik-tamu'); ?>">
                    <div class="form-group">
                        <select class="form-control" id="range" name="range" onchange="this.form.submit()">
                            <option value="week" <?= (isset($range) && $range == 'week') ? 'selected' : ''; ?>>Mingguan</option>
                            <option value="month" <?= (isset($range) && $range == 'month') ? 'selected' : ''; ?>>Bulanan</option>
                            <option value="year" <?= (isset($range) && $range == 'year') ? 'selected' : ''; ?>>Tahunan</option>
                        </select>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Card Menampilkan Rentang Tanggal -->
    <div class="col-md-6 mb-3">
        <div class="card h-100">
            <div class="card-header">
                Rentang Tanggal
            </div>
            <div class="card-body d-flex align-items-center">
                <?= isset($rangeDates) ? esc($rangeDates) : ''; ?>
            </div>
        </div>
    </div>
</div>

<!-- Grafik Garis Statistik -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Statistik Tamu</h6>
    </div>
    <div class="card-body" style="height: 325px;">
        <!-- Mengatur ukuran canvas agar chart lebih lebar -->
        <canvas id="myChart"></canvas> <!-- Canvas tanpa pengaturan width dan height, biarkan Chart.js mengatur -->
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('myChart').getContext('2d');

    const myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: <?= json_encode($labels); ?>,
        datasets: [{
            label: 'Jumlah Tamu',
            data: <?= json_encode($data); ?>,
            borderColor: 'rgba(75, 192, 192, 1)',
            backgroundColor: 'rgba(75, 192, 192, 0.1)',
            tension: 0.4,
            pointRadius: 5,
            pointHoverRadius: 7,
            pointBackgroundColor: 'white',
            pointBorderColor: 'rgba(75, 192, 192, 1)',
            fill: true
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,  // Jangan pakai aspectRatio agar lebih lebar secara otomatis
        plugins: {
            legend: {
                display: true
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                precision: 0
            }
        }
    }
});
})
</script>

<?= $this->endSection(); ?>