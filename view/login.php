<?php
require_once '../koneksi.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | Hiking Hub</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>

    .glass-card {
      background: rgba(255, 255, 255, 0.12);
      backdrop-filter: blur(12px);
      border-radius: 18px;
      border: 1px solid rgba(255, 255, 255, 0.25);
    }

    .form-control {
      background: rgba(255, 255, 255, 0.25);
      color: white;
      border: none;
    }

    .form-control::placeholder {
      color: #e0e0e0;
    }

    .form-control:focus {
      background: rgba(255, 255, 255, 0.35);
      color: white;
      box-shadow: 0 0 0 3px rgba(40, 167, 69, 0.5);
    }
  </style>
</head>

<body>

  <div class="min-vh-100 d-flex justify-content-center align-items-center position-relative"
       style="background-image: url('https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=1500&q=80');
              background-size: cover;
              background-position: center;">

      <div class="position-absolute top-0 start-0 w-100 h-100" 
           style="background: rgba(0,0,0,0.6);"></div>

      <div class="glass-card p-4 p-md-5 text-white position-relative" style="width: 380px; z-index: 5;">

          <h2 class="text-center fw-bold mb-4">Login</h2>

          <form action="../controller/login_controller.php" method="POST" class="mb-3">

              <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="Nama" required class="form-control py-2" placeholder="Masukkan username">
              </div>

              <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="Pass" required class="form-control py-2" placeholder="Masukkan password">
              </div>

              <button class="btn btn-success w-100 py-2 fw-semibold">
                Masuk
              </button>

          </form>

          <p class="text-center mt-3">
            Belum punya akun?
            <a href="register.php" class="text-success fw-bold text-decoration-none">Daftar di sini</a>
          </p>

          <p class="text-center mt-4 text-white-50">© 2025 Hiking Hub</p>

      </div>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
