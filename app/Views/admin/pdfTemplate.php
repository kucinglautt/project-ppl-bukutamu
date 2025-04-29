<!DOCTYPE html>
<html>
<head>
    <title>Riwayat Tamu</title>
    <style>
        table { width: 100%; border-collapse: collapse; font-size: 12px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
    </style>
</head>
<body>
    <h2>Riwayat Tamu</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Nama</th>
                <th>Institusi</th>
                <th>Tujuan</th>
                <th>No Telp</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach ($users as $user): ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= date('d-m-Y', strtotime($user['created_at'])); ?></td>
                <td><?= esc($user['name']); ?></td>
                <td><?= esc($user['institution']); ?></td>
                <td><?= esc($user['purpose']); ?></td>
                <td><?= esc($user['phone_number']); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
