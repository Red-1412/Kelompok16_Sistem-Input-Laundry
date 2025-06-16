<?php
include 'koneksiDB.php';
include 'function.php'; // Include the file with HitungHargaLaundry function

$message = '';

// Handle Add/Edit Order
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_order'])) {
        $id_pelanggan = $_POST['id_pelanggan'];
        $tanggal_masuk = $_POST['tanggal_masuk'];
        $tanggal_selesai_estimasi = $_POST['tanggal_selesai_estimasi'];
        $berat_kg = $_POST['berat_kg'];
        $jenis_layanan = $_POST['jenis_layanan'];
        $status_pesanan = $_POST['status_pesanan'];

        // Calculate total_harga using the PHP function
        $total_harga = HitungHargaLaundry($berat_kg, $jenis_layanan);

        $sql = "INSERT INTO Pesanan (id_pelanggan, tanggal_masuk, tanggal_selesai_estimasi, berat_kg, jenis_layanan, total_harga, status_pesanan) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $koneksi->prepare($sql);
        $stmt->bind_param("isssdss", $id_pelanggan, $tanggal_masuk, $tanggal_selesai_estimasi, $berat_kg, $jenis_layanan, $total_harga, $status_pesanan);

        if ($stmt->execute()) {
            $message = "<div class='message'>Pesanan laundry baru berhasil ditambahkan!</div>";
        } else {
            $message = "<div class='message' style='background-color:#f8d7da; color:#721c24; border-color:#f5c6cb;'>Error: " . $stmt->error . "</div>";
        }
        $stmt->close();
    } elseif (isset($_POST['edit_order'])) {
        $id_pesanan = $_POST['id_pesanan'];
        $id_pelanggan = $_POST['id_pelanggan'];
        $tanggal_masuk = $_POST['tanggal_masuk'];
        $tanggal_selesai_estimasi = $_POST['tanggal_selesai_estimasi'];
        $berat_kg = $_POST['berat_kg'];
        $jenis_layanan = $_POST['jenis_layanan'];
        $status_pesanan = $_POST['status_pesanan'];

        // Recalculate total_harga
        $total_harga = HitungHargaLaundry($berat_kg, $jenis_layanan);

        $sql = "UPDATE Pesanan SET id_pelanggan=?, tanggal_masuk=?, tanggal_selesai_estimasi=?, berat_kg=?, jenis_layanan=?, total_harga=?, status_pesanan=? WHERE id_pesanan=?";
        $stmt = $koneksi->prepare($sql);
        $stmt->bind_param("isssdssi", $id_pelanggan, $tanggal_masuk, $tanggal_selesai_estimasi, $berat_kg, $jenis_layanan, $total_harga, $status_pesanan, $id_pesanan);

        if ($stmt->execute()) {
            $message = "<div class='message'>Pesanan laundry berhasil diperbarui!</div>";
        } else {
            $message = "<div class='message' style='background-color:#f8d7da; color:#721c24; border-color:#f5c6cb;'>Error: " . $stmt->error . "</div>";
        }
        $stmt->close();
    }
}

// Handle Delete Order
if (isset($_GET['action']) && $_GET['action'] == 'delete_order' && isset($_GET['id'])) {
    $id_pesanan = $_GET['id'];
    $sql = "DELETE FROM Pesanan WHERE id_pesanan=$id_pesanan";
    if ($koneksi->query($sql) === TRUE) {
        $message = "<div class='message'>Pesanan berhasil dihapus!</div>";
    } else {
        $message = "<div class='message' style='background-color:#f8d7da; color:#721c24; border-color:#f5c6cb;'>Error menghapus pesanan: " . $koneksi->error . "</div>";
    }
}

// Fetch order data for editing
$edit_order = null;
if (isset($_GET['action']) && $_GET['action'] == 'edit_order' && isset($_GET['id'])) {
    $id_pesanan = $_GET['id'];
    $sql = "SELECT * FROM Pesanan WHERE id_pesanan=$id_pesanan";
    $result = $koneksi->query($sql);
    if ($result->num_rows > 0) {
        $edit_order = $result->fetch_assoc();
    }
}

// Fetch all customers for dropdown
$customers = [];
$sql_customers = "SELECT id_pelanggan, nama FROM Pelanggan ORDER BY nama";
$result_customers = $koneksi->query($sql_customers);
if ($result_customers->num_rows > 0) {
    while($row = $result_customers->fetch_assoc()) {
        $customers[] = $row;
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pesanan Laundry</title>
    <link rel="stylesheet" href="styleadd.css">
</head>
<body>
    <div class="container">
        <h1>Manajemen Pesanan Laundry</h1>
        <nav>
            <ul>
                <li><a href="index.php">Pesanan Aktif</a></li>
                <li><a href="customers.php">Manajemen Pelanggan</a></li>
                <li><a href="add.php">Manajemen Pesanan</a></li>
            </ul>
        </nav>

        <?php echo $message; ?>

        <h2><?php echo $edit_order ? 'Edit Pesanan' : 'Tambah Pesanan Baru'; ?></h2>
        <form method="POST" action="add.php">
            <?php if ($edit_order): ?>
                <input type="hidden" name="id_pesanan" value="<?php echo $edit_order['id_pesanan']; ?>">
            <?php endif; ?>
            <div class="form-group">
                <label for="id_pelanggan">Pelanggan:</label>
                <select id="id_pelanggan" name="id_pelanggan" required>
                    <option value="">Pilih Pelanggan</option>
                    <?php foreach ($customers as $customer): ?>
                        <option value="<?php echo $customer['id_pelanggan']; ?>"
                            <?php echo ($edit_order && $edit_order['id_pelanggan'] == $customer['id_pelanggan']) ? 'selected' : ''; ?>>
                            <?php echo $customer['nama']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="tanggal_masuk">Tanggal Masuk:</label>
                <input type="date" id="tanggal_masuk" name="tanggal_masuk" value="<?php echo $edit_order ? $edit_order['tanggal_masuk'] : date('Y-m-d'); ?>" required>
            </div>
            <div class="form-group">
                <label for="tanggal_selesai_estimasi">Estimasi Selesai:</label>
                <input type="date" id="tanggal_selesai_estimasi" name="tanggal_selesai_estimasi" value="<?php echo $edit_order ? $edit_order['tanggal_selesai_estimasi'] : ''; ?>">
            </div>
            <div class="form-group">
                <label for="berat_kg">Berat (kg):</label>
                <input type="number" step="0.1" id="berat_kg" name="berat_kg" value="<?php echo $edit_order ? $edit_order['berat_kg'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="jenis_layanan">Jenis Layanan:</label>
                <select id="jenis_layanan" name="jenis_layanan" required>
                    <option value="Cuci Kering" <?php echo ($edit_order && $edit_order['jenis_layanan'] == 'Cuci Kering') ? 'selected' : ''; ?>>Cuci Kering</option>
                    <option value="Cuci Setrika" <?php echo ($edit_order && $edit_order['jenis_layanan'] == 'Cuci Setrika') ? 'selected' : ''; ?>>Cuci Setrika</option>
                    <option value="Cuci Basah" <?php echo ($edit_order && $edit_order['jenis_layanan'] == 'Cuci Basah') ? 'selected' : ''; ?>>Cuci Basah</option>
                </select>
            </div>
            <div class="form-group">
                <label for="status_pesanan">Status Pesanan:</label>
                <select id="status_pesanan" name="status_pesanan" required>
                    <option value="Diterima" <?php echo ($edit_order && $edit_order['status_pesanan'] == 'Diterima') ? 'selected' : ''; ?>>Diterima</option>
                    <option value="Diproses" <?php echo ($edit_order && $edit_order['status_pesanan'] == 'Diproses') ? 'selected' : ''; ?>>Diproses</option>
                    <option value="Selesai" <?php echo ($edit_order && $edit_order['status_pesanan'] == 'Selesai') ? 'selected' : ''; ?>>Selesai</option>
                    <option value="Diambil" <?php echo ($edit_order && $edit_order['status_pesanan'] == 'Diambil') ? 'selected' : ''; ?>>Diambil</option>
                </select>
            </div>
            <div class="form-actions">
                <button type="submit" name="<?php echo $edit_order ? 'edit_order' : 'add_order'; ?>" class="btn btn-add"><?php echo $edit_order ? 'Update Pesanan' : 'Tambah Pesanan'; ?></button>
            </div>
        </form>

        <h2>Daftar Pesanan Laundry</h2>
        <table>
            <thead>
                <tr>
                    <th>ID Pesanan</th>
                    <th>Nama Pelanggan</th>
                    <th>Tanggal Masuk</th>
                    <th>Estimasi Selesai</th>
                    <th>Berat (kg)</th>
                    <th>Jenis Layanan</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT pl.id_pesanan, p.nama, pl.tanggal_masuk, pl.tanggal_selesai_estimasi, pl.berat_kg, pl.jenis_layanan, pl.total_harga, pl.status_pesanan FROM Pesanan pl JOIN Pelanggan p ON pl.id_pelanggan = p.id_pelanggan ORDER BY pl.tanggal_masuk DESC";
                $result = mysqli_query($koneksi, "SELECT * FROM Pesanan");

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id_pesanan"] . "</td>";
                        echo "<td>" . $row["nama"] . "</td>";
                        echo "<td>" . $row["tanggal_masuk"] . "</td>";
                        echo "<td>" . $row["tanggal_selesai_estimasi"] . "</td>";
                        echo "<td>" . $row["berat_kg"] . "</td>";
                        echo "<td>" . $row["jenis_layanan"] . "</td>";
                        echo "<td>" . number_format($row["total_harga"], 0, ',', '.') . "</td>"; // Format harga
                        echo "<td>" . $row["status_pesanan"] . "</td>";
                        echo "<td>";
                        echo "<a href='orders.php?action=edit_order&id=" . $row["id_pesanan"] . "' class='btn btn-edit'>Edit</a> ";
                        echo "<a href='orders.php?action=delete_order&id=" . $row["id_pesanan"] . "' class='btn btn-delete' onclick='return confirm(\"Yakin ingin menghapus pesanan ini?\")'>Hapus</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='9'>Belum ada pesanan laundry.</td></tr>";
                }
                ?>
            </tbody>
        </table>

        ---

        <h2>Operasi Agregat</h2>
        <p>Berikut adalah beberapa statistik dari data pesanan Anda:</p>
        <ul>
            <?php
            // Total pendapatan dari pesanan yang sudah selesai
            $sql_sum_revenue = "SELECT SUM(total_harga) AS total_pendapatan FROM Pesanan WHERE status_pesanan = 'Selesai'";
            $result_sum_revenue = $koneksi->query($sql_sum_revenue);
            $total_revenue = $result_sum_revenue->fetch_assoc()['total_pendapatan'];
            echo "<li><strong>Total Pendapatan (Pesanan Selesai):</strong> Rp " . number_format($total_revenue, 0, ',', '.') . "</li>";

            // Total berat cucian bulan ini (Juni 2025)
            $sql_sum_berat = "SELECT SUM(berat_kg) AS total_berat FROM Pesanan WHERE tanggal_masuk BETWEEN '2025-06-01' AND '2025-06-30'";
            $result_sum_berat = $koneksi->query($sql_sum_berat);
            $total_berat = $result_sum_berat->fetch_assoc()['total_berat'];
            echo "<li><strong>Total Berat Cucian Bulan Juni 2025:</strong> " . number_format($total_berat, 2, ',', '.') . " kg</li>";

            // Berat cucian terendah
            $sql_min_berat = "SELECT MIN(berat_kg) AS min_berat FROM Pesanan";
            $result_min_berat = $koneksi->query($sql_min_berat);
            $min_berat = $result_min_berat->fetch_assoc()['min_berat'];
            echo "<li><strong>Berat Cucian Terendah:</strong> " . number_format($min_berat, 2, ',', '.') . " kg</li>";
            //Berat cucian tertinggi
            $sql_max_berat = "SELECT MAX(berat_kg) AS max_berat FROM Pesanan";
            $result_max_berat = $koneksi->query($sql_max_berat);
            $max_berat = $result_max_berat->fetch_assoc()['max_berat'];
            echo "<li><strong>Berat Cucian Tertinggi:</strong> " . number_format($max_berat, 2, ',', '.') . " kg</li>";

            // Rata-rata berat cucian per pesanan
            $sql_avg_berat = "SELECT AVG(berat_kg) AS avg_berat FROM Pesanan";
            $result_avg_berat = $koneksi->query($sql_avg_berat);
            $avg_berat = $result_avg_berat->fetch_assoc()['avg_berat'];
            echo "<li><strong>Rata-rata Berat Cucian per Pesanan:</strong> " . number_format($avg_berat, 2, ',', '.') . " kg</li>";

            // Jumlah pesanan yang sedang diproses
            $sql_count_diproses = "SELECT COUNT(*) AS count_diproses FROM Pesanan WHERE status_pesanan = 'Diproses'";
            $result_count_diproses = $koneksi->query($sql_count_diproses);
            $count_diproses = $result_count_diproses->fetch_assoc()['count_diproses'];
            echo "<li><strong>Jumlah Pesanan Sedang Diproses:</strong> " . $count_diproses . "</li>";

            // Jumlah pelanggan yang pernah melakukan pesanan
            $sql_count_customers = "SELECT COUNT(DISTINCT id_pelanggan) AS count_customers FROM Pesanan";
            $result_count_customers = $koneksi->query($sql_count_customers);
            $count_customers = $result_count_customers->fetch_assoc()['count_customers'];
            echo "<li><strong>Jumlah Pelanggan yang Pernah Melakukan Pesanan:</strong> " . $count_customers . "</li>";
            ?>
        </ul>
    </div>
</body>
</html>
<?php
$koneksi->close();
?>