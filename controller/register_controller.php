<?php
require_once '../koneksi.php';
session_start();

if (isset($_POST['register'])) {

    $nama = $_POST['nama_lengkap'];
    $email = $_POST['email'];
    $hp   = $_POST['hp'];
    $pass = $_POST['password'];
    $passConfirm = $_POST['password_confirm'];

    if ($pass !== $passConfirm) {
        die("Password dan konfirmasi password tidak sesuai.");
    }

    $sql = "INSERT INTO pengunjung (Nama_Pengunjung, Email, No_HP, Password) 
            VALUES ('$nama', '$email', '$hp', '$pass')";

    $stmt = $koneksi->prepare($sql);

    // Cek prepare berhasil?
    if (!$stmt) {
        die("Prepare failed: " . $koneksi->error);
        echo "gagal";
    }

    if ($stmt->execute()) {
        header("Location: ../view/login.php");
        echo "berhasil2";
        exit();
    } else {
        die("Execute failed: " . $stmt->error);
        echo "gagal2";
    }
    echo "gagal";
}
?>
