<?php
session_start();
include "../koneksi.php";

if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();
}

$sql = "SELECT * 
        FROM pemesanan 
        ORDER BY Jadwal DESC";

$result = $koneksi->query($sql);

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Resi Pengunjung</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: url('bg.jpg') center/cover no-repeat;
            height: 100vh;
            backdrop-filter: brightness(40%);
        }

        .resi-card {
            margin-top: 120px;
            background: #ffffff;
            border-radius: 10px;
            padding: 25px;
            width: 95%;
            max-width: 900px;
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
            margin: -25px -25px 20px -25px;
        }

        th {
            background-color: #0d6832 !important;
            color: white;
            text-align: center;
        }

        td {
            vertical-align: middle;
        }

        .no-data {
            text-align: center;
            font-weight: bold;
            color: #666;
        }
    </style>
</head>

<body>

<header class="position-absolute w-100 z-3">
    <nav class="navbar navbar-expand-lg navbar-dark bg-transparent px-4 py-3">
        <a class="navbar-brand fs-3 fw-bold text-white" href="index.php">
            Hiking<span class="text-success">Hub</span>
        </a>

        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navMenu">
            <ul class="navbar-nav fw-semibold">
                <li class="nav-item mx-2">
                    <a href="index.php" class="nav-link">Beranda</a>
                </li>
                <li class="nav-item mx-2">
                    <a href="../controller/logout_controller.php"
                       class="nav-link bg-success bg-gradient px-3 text-white rounded">
                       Logout
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</header>

<div
    style="
      position: relative;
      min-height: 100vh;
      width: 100%;
      background-image: url('https://i.ytimg.com/vi/K_WcmSbPyTw/maxresdefault.jpg');
      background-size: cover;
      background-position: center;
      display: flex;
      justify-content: center;
      align-items: flex-start;
    "
>

<div class="resi-card">

    <div class="header-title">
        Riwayat Resi Booking Pengunjung
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-bordered align-middle">

            <thead>
                <tr>
                    <th>No</th>
                    <th>ID Resi</th>
                    <th>Nama Pengunjung</th>
                    <th>Gunung</th>
                    <th>Basecamp</th>
                    <th>Jadwal</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

                <?php if($result->num_rows > 0): 
                    $no = 1;
                    while($row = $result->fetch_assoc()):
                ?>

                <tr>
                    <td align="center"><?= $no++ ?></td>
                    <td align="center">#<?= $row['ID_Pemesanan'] ?></td>
                    <td><?= htmlspecialchars($row['Nama_Pengunjung']) ?></td>
                    <td><?= htmlspecialchars($row['Nama_Gunung']) ?></td>
                    <td><?= htmlspecialchars($row['Via_Basecamp']) ?></td>
                    <td align="center">
                        <?= date("d-m-Y", strtotime($row['Jadwal'])) ?>
                    </td>
                    <td align="center">
                        <a href="cek_resi.php?id=<?= $row['ID_Pemesanan'] ?>"
                           class="btn btn-success btn-sm">
                           Lihat Resi
                        </a>
                    </td>
                </tr>

                <?php endwhile; else: ?>

                <tr>
                    <td colspan="7" class="no-data">
                        Data resi belum tersedia
                    </td>
                </tr>

                <?php endif; ?>

            </tbody>
            
        </table>
    </div>

</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
