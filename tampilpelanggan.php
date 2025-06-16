<?php
    include 'koneksiDB.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pelanggan - Laundry Modern</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h2><span class="laundry-icon">🧺</span>Daftar Pelanggan Laundry</h2>
        </div>
        
        <div class="card">
            <a href="tambahpelanggan.php" class="nav-link">+ Tambah Pelanggan Baru</a>
            
            <table class="data-table">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>No HP</th>
                    <th>Aksi</th>
                </tr>

                <?php
                    $no = 1;
                    $query = mysqli_query($koneksi, "SELECT * FROM pelanggan");
                    while ($data = mysqli_fetch_array($query)) {
                ?>
                <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $data['nama'] ?></td>
                    <td><?php echo $data['alamat'] ?></td>
                    <td><?php echo $data['no_hp'] ?></td>
                    <td class="action-links">
                        <a href="edit.php?id=<?php echo $data['id_pelanggan'] ?>" class="edit-link">Edit</a>
                        <a href="hapus.php?id=<?php echo $data['id_pelanggan'] ?>" class="delete-link" onclick="return confirm('Yakin ingin menghapus pelanggan ini?')">Hapus</a>
                        <a href="add.php?id=<?php echo $data['id_pelanggan'] ?>" class="add-link" onclick="return confirm('Yakin ingin menambah pesananan?')">Tambah Pesanan</a>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</body>
</html>