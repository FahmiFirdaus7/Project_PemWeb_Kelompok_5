<?php
include "../koneksi.php";
session_start();

# =======================
# CEK LOGIN
# =======================
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

$username = $_SESSION['username'];


# =======================
# AMBIL DATA RIWAYAT
# =======================
$stmt = $koneksi->prepare("
    SELECT * FROM riwayat_pemesanan 
    WHERE Username = ?
    ORDER BY Tanggal_Selesai DESC
");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Histori Resi Pendakian</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: url('bg.jpg') center/cover no-repeat;
            height: 100vh;
            backdrop-filter: brightness(40%);
        }

        .resi-card {
            margin-top: 50px;
            background: #ffffff;
            border-radius: 10px;
            padding: 30px;
            width: 650px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.3);
        }

        .header-title {
            background: #0d6832;
            color: white;
            padding: 12px;
            border-radius: 7px 7px 0 0;
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .detail-row {
            margin: 6px 0;
            font-size: 16px;
        }

        .label {
            font-weight: bold;
            color: #333;
        }

        .divider {
            margin: 18px 0;
            border-top: 1px dashed #aaa;
        }
    </style>
</head>

<body class="d-flex justify-content-center align-items-start">

<header class="position-absolute w-100 z-3">
  <nav class="navbar navbar-expand-lg navbar-dark bg-transparent px-4 py-3">
    <a class="navbar-brand fs-3 fw-bold text-white" href="index.php">Hiking<span class="text-success">Hub</span></a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navMenu">
      <ul class="navbar-nav text-white fw-semibold">
        <li class="nav-item mx-2">
            <a href="index.php" class="nav-link bg-primary bg-gradient">Beranda</a>
        </li>
        <li class="nav-item mx-2">
            <a href="../controller/logout_controller.php" class="nav-link bg-danger bg-gradient">Logout</a>
        </li>
      </ul>
    </div>
  </nav>
</header>

<div style="
    position: relative;
    min-height: 100vh;
    width: 100%;
    background-image: url('https://i.ytimg.com/vi/K_WcmSbPyTw/maxresdefault.jpg');
    background-size: cover;
    background-position: center;
    display: flex;
    align-items: center;
    justify-content: center;
">

<div class="resi-card">

    <div class="header-title">
        Riwayat Resi Pendakian<br>
        <small>(<?= htmlspecialchars($username) ?>)</small>
    </div>

<?php if ($result->num_rows == 0): ?>

    <div class="text-center text-muted">
        <p><b>Belum ada riwayat pendakian.</b></p>
        <a href="index.php" class="btn btn-success">
            Booking Sekarang
        </a>
    </div>

<?php else: ?>

<?php while ($data = $result->fetch_assoc()): ?>

    <div class="p-2">

        <div class="detail-row">
            <span class="label">ID Pemesanan:</span>
            <?= $data['ID_Pemesanan'] ?>
        </div>

        <div class="detail-row">
            <span class="label">Nama Pengunjung:</span>
            <?= htmlspecialchars($data['Nama_Pengunjung']) ?>
        </div>

        <div class="detail-row">
            <span class="label">Gunung:</span>
            <?= htmlspecialchars($data['Nama_Gunung']) ?>
        </div>

        <div class="detail-row">
            <span class="label">Via:</span>
            <?= htmlspecialchars($data['Via_Basecamp']) ?>
        </div>

        <div class="detail-row">
            <span class="label">Jadwal:</span>
            <?= date("d-m-Y", strtotime($data['Jadwal'])) ?>
        </div>

        <div class="detail-row">
            <span class="label">Tanggal Selesai:</span>
            <?= date("d-m-Y H:i", strtotime($data['Tanggal_Selesai'])) ?>
        </div>

    </div>

    <div class="divider"></div>

<?php endwhile; ?>

<?php endif; ?>

</div>
</div>

</body>
</html>
