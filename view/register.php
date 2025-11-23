<?php
require_once '../koneksi.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register | Hiking Adventure</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background-image: url('https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=1500&q=80');
      background-size: cover;
      background-position: center;
      height: 100vh;
    }

    .overlay {
      background: rgba(0, 0, 0, 0.6);
      position: absolute;
      inset: 0;
    }

    .glass-card {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(10px);
      border-radius: 15px;
      border: 1px solid rgba(255, 255, 255, 0.2);
      padding: 40px;
      width: 380px;
      color: white;
    }

    .glass-input {
      background: rgba(255, 255, 255, 0.15);
      border: none;
      color: white;
    }

    .glass-input::placeholder {
      color: #dcdcdc;
    }

    .glass-input:focus {
      background: rgba(255, 255, 255, 0.25);
      color: white;
      box-shadow: none;
      border: 1px solid #4ade80;
    }
  </style>
</head>

<body>
  <div class="overlay"></div>

  <div class="d-flex justify-content-center align-items-center" style="height: 100vh; position: relative; z-index: 10;">
    <div class="glass-card">

      <h2 class="text-center mb-4 fw-bold">Buat Akun</h2>

      <form action="../controller/register_controller.php" method="POST">

        <div class="mb-3">
          <label class="form-label">Nama Lengkap</label>
          <input type="text" class="form-control glass-input" name="nama_lengkap" required>
        </div>

        <div class="mb-3">
          <label class="form-label">No. Telepon</label>
          <input type="text" class="form-control glass-input" name="hp" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Email</label>
          <input type="email" class="form-control glass-input" name="email" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Password</label>
          <input type="password" class="form-control glass-input" name="password" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Konfirmasi Password</label>
          <input type="password" class="form-control glass-input" name="password_confirm" required>
        </div>

        <button type="submit" name="register"
                class="btn btn-success w-100 fw-semibold py-2 shadow">
          Daftar
        </button>
      </form>

      <p class="text-center small mt-3 text-light">
        Sudah punya akun?
        <a href="login.php" class="text-success fw-bold">Masuk di sini</a>
      </p>

      <p class="text-center small mt-3 text-light">
        © 2025 Hiking Hub
      </p>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
