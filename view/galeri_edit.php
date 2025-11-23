<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'Admin') {
    header("Location: index.php");
    exit;
}

include "../koneksi.php";

$id = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT * FROM galeri WHERE id=$id");
$g = mysqli_fetch_assoc($data);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Foto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light p-4">

<div class="container">

    <h3 class="mb-4">Edit Foto Galeri</h3>

    <form action="../controller/galeri_controller_edit.php" method="POST" enctype="multipart/form-data">

        <input type="hidden" name="id" value="<?= $g['id'] ?>">
        <input type="hidden" name="foto_lama" value="<?= $g['foto'] ?>">

        <div class="mb-3">
            <label class="form-label">Judul</label>
            <input type="text" name="judul" value="<?= $g['judul'] ?>" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea name="deskripsi" class="form-control" required><?= $g['deskripsi'] ?></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Foto Sekarang</label><br>
            <img src="uploads/<?= $g['foto'] ?>" width="200" class="rounded">
        </div>

        <div class="mb-3">
            <label class="form-label">Ganti Foto (opsional)</label>
            <input type="file" name="foto" accept="image/*" class="form-control">
        </div>

        <button class="btn btn-warning">Update</button>
        <a href="galeri.php" class="btn btn-secondary">Kembali</a>
    </form>

</div>

</body>
</html>
