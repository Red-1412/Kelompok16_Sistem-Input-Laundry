<?php
    include 'koneksiDB.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pelanggan - Laundry Modern</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h2><span class="laundry-icon">🧺</span>Tambah Data Pelanggan</h2>
        </div>
        
        <div class="card">
            <a href="tampilpelanggan.php" class="nav-link">Kembali ke Daftar Pelanggan</a>
            
            <form action="" method="post">
                <table class="form-table">
                    <tr>
                        <td width="20%">Nama</td>
                        <td width="5%">:</td>
                        <td><input type="text" name="nama" placeholder="Masukkan nama pelanggan" required></td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>:</td>
                        <td><input type="text" name="alamat" placeholder="Masukkan alamat pelanggan" required></td>
                    </tr>
                    <tr>
                        <td>No HP</td>
                        <td>:</td>
                        <td><input type="text" name="no_hp" placeholder="Masukkan nomor HP" required></td>
                    </tr>
                    <tr>
                        <td colspan="3" align="center">
                            <button type="submit" name="tambah" value="tambah" class="btn btn-success">Tambah Pelanggan</button>
                        </td>
                    </tr>
                </table>
            </form>
            
            <?php
                if (isset($_POST['tambah'])) {
                    $nama = $_POST['nama'];
                    $alamat = $_POST['alamat'];
                    $no_hp = $_POST['no_hp'];

                    $query = "INSERT INTO pelanggan(nama,alamat,no_hp) VALUES ('$nama','$alamat','$no_hp')";

                    if (mysqli_query($koneksi, $query)) {
                        header("Location: tampilpelanggan.php");
                    } else {
                        echo "<div class='error-message'>Gagal menambahkan data!</div>";
                    }
                }     
            ?>
        </div>
    </div>
</body>
</html>