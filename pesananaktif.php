<?php
include 'koneksiDB.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pesanan Aktif - Laundry Modern</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h2><span class="laundry-icon">🧺</span>Daftar Pesanan Aktif Laundry</h2>
        </div>
           <table class="data-table">
                <tr>
                    <th>No</th>
                    <th>ID Pesanan</th>
                    <th>Nama Pelanggan</th>
                    <th>Tanggal Masuk</th>
                    <th>Tanggal Selesai Estimasi</th>
                    <th>Berat (kg)</th>
                    <th>Jenis Layanan</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                </tr>

                <?php
                    $no = 1;
                    $query = mysqli_query($koneksi, "SELECT * FROM view_pesanan_aktif");
                    while ($data = mysqli_fetch_array($query)) {
                ?>
                <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $data['id_pesanan'] ?></td>
                    <td><?php echo $data['nama_pelanggan'] ?></td>
                    <td><?php echo $data['tanggal_masuk'] ?></td>
                    <td><?php echo $data['tanggal_selesai_estimasi'] ?></td>
                    <td><?php echo $data['berat_kg'] ?></td>
                    <td><?php echo $data['jenis_layanan'] ?></td>
                    <td>Rp <?php echo number_format($data['total_harga'], 0, ',', '.') ?></td>
                    <td><?php echo $data['status_pesanan'] ?></td>
                </tr>
                <?php } ?>
            </table>
    </div>
</body>
</html>
