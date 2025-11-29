<?php
include "../koneksi.php";

/* ==========================
   AMBIL & VALIDASI ID
   ========================== */
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if($id <= 0){
    echo "ID tidak valid!";
    exit();
}

/* ==========================
   PROSES SELESAIKAN RESI
   ========================== */
if(isset($_POST['selesai'])){

    // hapus data resi dari database
    $stmt = $koneksi->prepare(
        "DELETE FROM pemesanan WHERE ID_Pemesanan = ?"
    );
    $stmt->bind_param("i", $id);
    $stmt->execute();

    // redirect ke daftar resi
    header("Location: resi_pengunjung.php?status=success");
    exit();
}

/* ==========================
   AMBIL DATA PEMESANAN
   ========================== */
$stmt = $koneksi->prepare(
    "SELECT * FROM pemesanan WHERE ID_Pemesanan = ?"
);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "Data tidak ditemukan!";
    exit();
}

$data = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Resi Booking Pendakian</title>

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
            width: 600px;
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
        }

        .detail-row {
            margin: 8px 0;
            font-size: 16px;
        }

        .label {
            font-weight: bold;
            color: #333;
        }

        .btn-group-custom button{
            min-width:160px;
            margin:5px;
        }
    </style>
</head>

<body class="d-flex justify-content-center align-items-start">

<header class="position-absolute w-100 z-3">
  <nav class="navbar navbar-expand-lg navbar-dark bg-transparent px-4 py-3">
    <a class="navbar-brand fs-3 fw-bold text-white" href="index.php">
        Hiking<span class="text-success">Hub</span>
    </a>

    <button class="navbar-toggler" 
        type="button" 
        data-bs-toggle="collapse" 
        data-bs-target="#navMenu">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navMenu">
      <ul class="navbar-nav text-white fw-semibold">
        <li class="nav-item mx-2">
            <a href="../controller/logout_controller.php" 
               class="nav-link bg-success bg-gradient">
                Logout
            </a>
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

    <div class="header-title">Resi Booking Pendakian</div>

    <div class="p-3">

        <div class="detail-row">
            <span class="label">ID Pemesanan:</span> 
            <?= htmlspecialchars($data['ID_Pemesanan']) ?>
        </div>

        <div class="detail-row">
            <span class="label">Nama Pengunjung:</span> 
            <?= htmlspecialchars($data['Nama_Pengunjung']) ?>
        </div>

        <div class="detail-row">
            <span class="label">Nama Gunung:</span> 
            <?= htmlspecialchars($data['Nama_Gunung']) ?>
        </div>

        <div class="detail-row">
            <span class="label">Via Basecamp:</span> 
            <?= htmlspecialchars($data['Via_Basecamp']) ?>
        </div>

        <div class="detail-row">
            <span class="label">Jadwal Pendakian:</span> 
            <?= date("d-m-Y", strtotime($data['Jadwal'])) ?>
        </div>

        <hr>

        <!-- AKSI -->
        <div class="text-center btn-group-custom">

            <button class="btn btn-outline-success" onclick="window.print()">
                Cetak Resi
            </button>

            <!-- FORM SELESAIKAN -->
            <form method="POST" 
                  class="d-inline"
                  onsubmit="return confirm('Yakin resi ini sudah selesai dan akan dihapus?')">

                <button type="submit" 
                        name="selesai" 
                        class="btn btn-secondary">
                    Selesaikan Resi
                </button>

            </form>

            <br>

            <button class="btn btn-success"
                    onclick="window.location.href='resi_pengunjung.php'">
                Kembali
            </button>

        </div>

    </div>

</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
