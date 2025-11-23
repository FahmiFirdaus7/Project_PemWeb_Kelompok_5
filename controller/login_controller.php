<?php
include_once(__DIR__ . '/../koneksi.php');
session_start();

$nama = $_POST['Nama'];
$pass = $_POST['Pass'];

$sql_admin = "SELECT Nama, Pass FROM admin WHERE Nama = ? LIMIT 1";
$stmt = $koneksi->prepare($sql_admin);
$stmt->bind_param("s", $nama);
$stmt->execute();
$result_admin = $stmt->get_result();

if ($result_admin->num_rows === 1) {
    $row = $result_admin->fetch_assoc();

    if ($pass === $row['Pass']) {

        $_SESSION['username'] = $row['Nama'];
        $_SESSION['role'] = "Admin";

        header("Location: ../view/index.php");
        exit();
    }
}

$sql_user = "SELECT Nama_Pengunjung, Password FROM pengunjung WHERE Nama_Pengunjung = ? LIMIT 1";
$stmt = $koneksi->prepare($sql_user);
$stmt->bind_param("s", $nama);
$stmt->execute();
$result_user = $stmt->get_result();

if ($result_user->num_rows === 1) {
    $row = $result_user->fetch_assoc();

    if ($pass === $row['Password']) {

        $_SESSION['username'] = $row['Nama_Pengunjung'];
        $_SESSION['role'] = "Pengunjung";

        header("Location: ../view/index.php");
        exit();
    }
}

header("Location: ../view/login.php?error=1");
exit();
