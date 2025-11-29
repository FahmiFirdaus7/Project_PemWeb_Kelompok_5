<?php
include "../koneksi.php";

$id = $_GET['id'];

// ambil nama file
$data = mysqli_query($koneksi, "SELECT foto FROM galeri WHERE id=$id");
$g = mysqli_fetch_assoc($data);

$folder = "../view/uploads/";
$foto = $g['foto'];

// hapus file
if (file_exists($folder . $foto)) {
    unlink($folder . $foto);
}

// hapus dari db
mysqli_query($koneksi, "DELETE FROM galeri WHERE id=$id");

header("Location: ../view/galeri.php");
exit;
