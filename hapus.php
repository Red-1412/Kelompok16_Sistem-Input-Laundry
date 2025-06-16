<?php
    include 'koneksiDB.php';

    $id = $_GET['id'];
    $query = "DELETE FROM pelanggan WHERE id_pelanggan = '$id'";

    if (mysqli_query($koneksi, $query)) {
            header("Location: tampilpelanggan.php");
        } else {
            echo"Gagal menghapus data!";
        }
?>