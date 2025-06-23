<?php
    @include 'koneksiDB.php';

    $id = $_GET['id'];
    $query = mysqli_query($koneksi,"SELECT * FROM pelanggan WHERE id_pelanggan = '$id'");
    $data = mysqli_fetch_array($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pelanggan - Laundry Modern</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h2><span class="laundry-icon">🧺</span>Edit Data Pelanggan</h2>
        </div>
        
        <div class="card">
            <a href="tampilpelanggan.php" class="nav-link">Kembali ke Daftar Pelanggan</a>
            
            <form action="" method="post">
                <table class="form-table">
                    <tr>
                        <td width="20%">Nama</td>
                        <td width="5%">:</td>
                        <td><input type="text" name="nama" value="<?php echo $data['nama'] ?>" required></td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>:</td>
                        <td><input type="text" name="alamat" value="<?php echo $data['alamat'] ?>" required></td>
                    </tr>
                    <tr>
                        <td>No HP</td>
                        <td>:</td>
                        <td><input type="text" name="no_hp" value="<?php echo $data['no_hp'] ?>" required></td>
                    </tr>
                    <tr>
                        <td colspan="3" align="center">
                            <button type="submit" name="update" value="update" class="btn btn-primary">Update Data</button>
                        </td>
                    </tr>
                </table>
            </form>
            
            <?php
                if (isset($_POST['update'])) {
                    $nama = $_POST['nama'];
                    $alamat = $_POST['alamat'];
                    $no_hp = $_POST['no_hp'];

                    $query = "UPDATE pelanggan SET nama = '$nama', alamat = '$alamat', no_hp = '$no_hp' WHERE id_pelanggan = '$id'";

                    if (mysqli_query($koneksi, $query)) {
                        header("Location: tampilpelanggan.php");
                    } else {
                        echo "<div class='error-message'>Gagal update data!</div>";
                    }
                }     
            ?>
        </div>
    </div>
</body>
</html>