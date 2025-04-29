<?= $this->extend('templates/admin/index'); ?>

<?= $this->section('page-content'); ?>

<!-- Tampilkan Pesan Error -->
<?php if (isset($error_message)): ?>
    <div class="col-md-12 mb-3">
        <div class="alert alert-danger" role="alert">
            <?= esc($error_message) ?>
        </div>
    </div>
<?php endif; ?>

<title>Sistem Informasi Buku Tamu - Statistik</title>

<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Statistik</h1>

    <form id="dateFilterForm" method="get" action="<?= base_url('/statistik'); ?>">
        <div class="row">
            <!-- Card Dari Tanggal -->
            <div class="col-md-3 mb-3">
                <div class="card h-100">
                    <div class="card-header">Dari Tanggal</div>
                    <div class="card-body">
                        <input type="date" class="form-control" id="start_date" name="start_date" value="<?= esc($start_date ?? '') ?>">
                    </div>
                </div>
            </div>

            <!-- Card Sampai Tanggal -->
            <div class="col-md-3 mb-3">
                <div class="card h-100">
                    <div class="card-header">Sampai Tanggal</div>
                    <div class="card-body">
                        <input type="date" class="form-control" id="end_date" name="end_date" value="<?= esc($end_date ?? '') ?>">
                    </div>
                </div>
            </div>

            <!-- Card Range Dropdown -->
            <div class="col-md-3 mb-3">
                <div class="card h-100">
                    <div class="card-header">Rentang Waktu</div>
                    <div class="card-body">
                        <select class="form-control" id="range" name="range">
                            <option value="week" <?= (isset($range) && $range == 'week') ? 'selected' : ''; ?>>Mingguan</option>
                            <option value="month" <?= (isset($range) && $range == 'month') ? 'selected' : ''; ?>>Bulanan</option>
                            <option value="year" <?= (isset($range) && $range == 'year') ? 'selected' : ''; ?>>Tahunan</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Card Tombol -->
            <div class="col-md-3 mb-3">
                <div class="card h-100">
                    <div class="card-header">Aksi</div>
                    <div class="card-body d-flex flex-column justify-content-end">
                        <a href="<?= base_url('/statistik'); ?>" class="btn btn-sm btn-secondary w-100 mb-2">Clear Filter</a>
                        <button type="submit" class="btn btn-sm btn-primary w-100">Apply</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

<!-- Grafik Garis dan Pie Dalam Satu Baris -->
<div class="row">
    <!-- Grafik Garis Statistik -->
    <div class="col-md-6 mb-4">
        <div class="card shadow h-100">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Statistik Tamu</h6>
            </div>
            <div class="card-body">
                <canvas id="myChart" ></canvas>
            </div>
        </div>
    </div>

    <!-- Pie Chart -->
    <div class="col-md-6 mb-4">
        <div class="card shadow h-100">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Jumlah Tamu per Instansi</h6>
            </div>
            <div class="card-body d-flex align-items-center">
    <!-- Pie Chart (kiri) -->
    <div class="flex-shrink-0 me-4" style="width: 100%;">
        <canvas id="pieChart"></canvas>
    </div>

    <!-- Legend (kanan) -->
    <div class="flex-grow-1">
        <ul id="pieChartLegend" class="list-unstyled mb-0"></ul>
    </div>
</div>
        </div>
    </div>
</div>

</div>

<script>
// Submit otomatis jika pilih rentang waktu, tapi hanya jika tidak ada tanggal custom
const start = document.getElementById('start_date');
const end = document.getElementById('end_date');
const rangeSelect = document.getElementById('range');
rangeSelect.addEventListener('change', function () {
    if (!start.value && !end.value) {
        document.getElementById('dateFilterForm').submit();
    }
});

// Grafik Garis
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
        plugins: {
            legend: { display: true }
        },
        scales: {
            y: {
                beginAtZero: true,
                precision: 0
            }
        }
    }
});

// Warna dinamis Pie Chart
const pieLabelsOriginal = <?= json_encode($pieLabels); ?>;
const pieDataOriginal = <?= json_encode($pieData); ?>;

// Proses top 4 + lainnya
let pieLabels = [];
let pieData = [];

const combined = pieLabelsOriginal.map((label, index) => ({ label, value: pieDataOriginal[index] }));
combined.sort((a, b) => b.value - a.value);

let top4 = combined.slice(0, 4);
let other = combined.slice(4);
let otherTotal = other.reduce((sum, item) => sum + item.value, 0);

pieLabels = top4.map(i => i.label);
pieData = top4.map(i => i.value);
if (otherTotal > 0) {
    pieLabels.push('Lainnya');
    pieData.push(otherTotal);
}

// Pie Chart
const pieCtx = document.getElementById('pieChart').getContext('2d');
const pieChart = new Chart(pieCtx, {
    type: 'pie',
    data: {
        labels: pieLabels,
        datasets: [{
            label: 'Jumlah Tamu',
            data: pieData,
            backgroundColor: [
                    '#007bff',
                    '#28a745',
                    '#ffc107',
                    '#dc3545',
                    '#6c757d'
                ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'right'
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        const label = context.label || '';
                        const value = context.raw;
                        const total = context.chart._metasets[0].total;
                        const percentage = ((value / total) * 100).toFixed(2);
                        return `${label}: ${value} (${percentage}%)`;
                    }
                }
            }
        }
    }
});
</script>

<?= $this->endSection(); ?>
