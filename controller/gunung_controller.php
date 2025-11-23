<?php
require_once '../koneksi.php';
session_start();

if (!isset($_GET['id'])) {
    die("Gunung tidak ditemukan!");
}

$id = intval($_GET['id']);

$sql = "SELECT Nama_Gunung, Lokasi, Ketinggian, Basecamp FROM gunung WHERE id_gunung = ?";
$stmt = $koneksi->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Data tidak ditemukan!");
}

$data = $result->fetch_assoc();

// simpan ke session
$_SESSION['gunung_data'] = $data;

// arahkan ke halaman detail sesuai ID
switch ($id) {
    case 1: $halaman = "Slamet.php"; break;
    case 2: $halaman = "Merapi.php"; break;
    case 3: $halaman = "Sindoro.php"; break;
    case 4: $halaman = "Sumbing.php"; break;
    case 5: $halaman = "Prau.php"; break;
    case 6: $halaman = "Merbabu.php"; break;
    case 7: $halaman = "Lawu.php"; break;
    default:
        die("Halaman belum tersedia!");
}

header("Location: ../view/$halaman");
exit();
