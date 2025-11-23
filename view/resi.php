<?php

include "../koneksi.php";

// Ambil ID dari URL
$id = isset($_GET['id']) ? $_GET['id'] : 0;

// Query ambil data pemesanan
$sql = "SELECT * FROM pemesanan WHERE ID_Pemesanan = '$id'";
$result = $koneksi->query($sql);

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
    </style>
</head>

<body class="d-flex justify-content-center align-items-start">

    <div class="resi-card">

        <div class="header-title">Resi Booking Pendakian</div>

        <div class="p-3">
            <div class="detail-row">
                <span class="label">ID Pemesanan:</span> <?= $data['ID_Pemesanan'] ?>
            </div>

            <div class="detail-row">
                <span class="label">Nama Pengunjung:</span> <?= $data['Nama_Pengunjung'] ?>
            </div>

            <div class="detail-row">
                <span class="label">Nama Gunung:</span> <?= $data['Nama_Gunung'] ?>
            </div>

            <div class="detail-row">
                <span class="label">Via Basecamp:</span> <?= $data['Via_Basecamp'] ?>
            </div>

            <div class="detail-row">
                <span class="label">Jadwal Pendakian:</span> <?= date("d-m-Y", strtotime($data['Jadwal'])) ?>
            </div>

            <hr>

        <div class="text-center">
            <button class="btn btn-success" onclick="window.location.href='index.php'">
            Kembali ke Beranda
            </button>
        </div>

    </div>

</body>
</html>
