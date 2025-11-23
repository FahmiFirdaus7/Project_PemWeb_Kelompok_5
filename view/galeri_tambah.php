<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'Admin') {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Foto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light p-4">

<div class="container">
    <h3 class="mb-4">Tambah Foto Galeri</h3>

    <form action="../controller/galeri_controller_tambah.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">Judul Foto</label>
            <input type="text" name="judul" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea name="deskripsi" class="form-control" required></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Upload Foto</label>
            <input type="file" name="foto" accept="image/*" class="form-control" required>
        </div>

        <button class="btn btn-success">Simpan</button>
        <a href="galeri.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>

</body>
</html>