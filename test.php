<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Laundry Dashboard</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <style>
    * {
      box-sizing: border-box;
      font-family: 'Inter', sans-serif;
    }
    body {
      margin: 0;
      background: #f4f7fa;
      color: #333;
    }
    header {
      background: linear-gradient(90deg, #3f51b5, #5c6bc0);
      color: white;
      padding: 1rem 2rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }
    header h1 {
      font-size: 1.6rem;
      margin: 0;
    }
    nav ul {
      list-style: none;
      display: flex;
      gap: 1.5rem;
      margin: 0;
      padding: 0;
    }
    nav a {
      color: white;
      font-weight: bold;
      text-decoration: none;
      transition: color 0.2s;
    }
    nav a:hover {
      color: #ffeb3b;
    }
    .container {
      padding: 2rem;
      max-width: 1200px;
      margin: auto;
    }
    .dashboard-cards {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
      gap: 1.5rem;
      margin-bottom: 2rem;
    }
    .card {
      background: white;
      border-radius: 14px;
      padding: 1.5rem;
      box-shadow: 0 6px 20px rgba(0,0,0,0.05);
      transition: transform 0.2s ease;
    }
    .card:hover {
      transform: translateY(-4px);
    }
    .card h3 {
      font-size: 1.1rem;
      margin: 0 0 0.5rem 0;
      color: #555;
    }
    .card p {
      font-size: 1.4rem;
      font-weight: bold;
      color: #3f51b5;
    }
    table {
      width: 100%;
      background: white;
      border-collapse: collapse;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }
    th, td {
      padding: 1rem;
      text-align: left;
      border-bottom: 1px solid #eee;
    }
    th {
      background: #f5f7fa;
      font-weight: bold;
      font-size: 0.95rem;
    }
    .btn {
      padding: 0.4rem 0.9rem;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-size: 0.9rem;
      font-weight: 600;
    }
    .btn-edit {
      background-color: #42a5f5;
      color: white;
    }
    .btn-delete {
      background-color: #ef5350;
      color: white;
    }
    .btn:hover {
      opacity: 0.9;
    }
    .form-group {
      margin-bottom: 1rem;
    }
    .form-group label {
      display: block;
      margin-bottom: 0.5rem;
      font-weight: 500;
    }
    .form-group input, .form-group select {
      width: 100%;
      padding: 0.5rem;
      border-radius: 8px;
      border: 1px solid #ccc;
    }
    .form-actions {
      margin-top: 1rem;
    }
    .message {
      padding: 1rem;
      background-color: #e8f5e9;
      border-left: 5px solid #43a047;
      border-radius: 8px;
      margin-bottom: 1.5rem;
    }
    .stats-list li {
      margin-bottom: 0.5rem;
    }
    h2, h3 {
      color: #3f51b5;
    }
  </style>
</head>
<body>
  <header>
    <h1><i class="fa-solid fa-shirt"></i> Laundry Dashboard</h1>
    <nav>
      <ul>
        <li><a href="#">Pesanan Aktif</a></li>
        <li><a href="#">Pelanggan</a></li>
        <li><a href="#">Tambah Pesanan</a></li>
      </ul>
    </nav>
  </header>

  <div class="container">
    <div class="dashboard-cards">
      <div class="card">
        <h3>Total Pendapatan</h3>
        <p>Rp 12.345.000</p>
      </div>
      <div class="card">
        <h3>Total Berat Juni</h3>
        <p>57,3 kg</p>
      </div>
      <div class="card">
        <h3>Pesanan Diproses</h3>
        <p>12</p>
      </div>
      <div class="card">
        <h3>Total Pelanggan</h3>
        <p>24</p>
      </div>
    </div>

    <h2>Daftar Pesanan Laundry</h2>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Pelanggan</th>
          <th>Tgl Masuk</th>
          <th>Tgl Selesai</th>
          <th>Berat</th>
          <th>Layanan</th>
          <th>Harga</th>
          <th>Status</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>1001</td>
          <td>Andi</td>
          <td>2025-06-21</td>
          <td>2025-06-23</td>
          <td>3.5 kg</td>
          <td>Cuci Kering</td>
          <td>Rp 35.000</td>
          <td>Diproses</td>
          <td><button class="btn btn-edit">Edit</button> <button class="btn btn-delete">Hapus</button></td>
        </tr>
        <!-- More rows -->
      </tbody>
    </table>

    <h3>Statistik Tambahan</h3>
    <ul class="stats-list">
      <li><strong>Berat Terendah:</strong> 1.2 kg</li>
      <li><strong>Berat Tertinggi:</strong> 12.4 kg</li>
      <li><strong>Rata-rata Berat:</strong> 4.6 kg</li>
    </ul>
  </div>
</body>
</html>
