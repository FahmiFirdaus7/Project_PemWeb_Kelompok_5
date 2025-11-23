<?php
require_once '../koneksi.php';
session_start();

$pemesan  = $_POST['namaBooking'] ?? '';
$hiking   = $_POST['gunungBooking'] ?? '';
$basecamp = $_POST['basecampBooking'] ?? '';
$date     = $_POST['date'] ?? '';

if (empty($pemesan) || empty($hiking) || empty($basecamp) || empty($date)) {
    die("ERROR: Form tidak lengkap!");
}

$sql = "INSERT INTO pemesanan (Nama_Pengunjung, Nama_Gunung, Via_Basecamp, Jadwal)
        VALUES (?, ?, ?, ?)";

$stmt = mysqli_prepare($koneksi, $sql);
mysqli_stmt_bind_param($stmt, "ssss", $pemesan, $hiking, $basecamp, $date);

if (mysqli_stmt_execute($stmt)) {

    $id = mysqli_insert_id($koneksi);

    header("Location: ../view/resi.php?id=" . $id);
    exit;

} else {
    echo "Query Error: " . mysqli_error($koneksi);
}
