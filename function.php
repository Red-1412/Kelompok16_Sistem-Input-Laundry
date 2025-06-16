<?php
function HitungHargaLaundry($berat, $layanan) {
    $harga_per_kg = 0;
    switch ($layanan) {
        case 'Cuci Kering':
            $harga_per_kg = 7000;
            break;
        case 'Cuci Setrika':
            $harga_per_kg = 10000;
            break;
        case 'Cuci Basah':
            $harga_per_kg = 5000;
            break;
        default:
            $harga_per_kg = 0; // Handle unknown service
            break;
    }
    return $berat * $harga_per_kg;
}
?>