<?php
include "../koneksi.php";

$id = $_POST['id'];
$judul = $_POST['judul'];
$deskripsi = $_POST['deskripsi'];
$foto_lama = $_POST['foto_lama'];

$folder = "../view/uploads/";

if ($_FILES['foto']['name'] != "") {
    $foto_baru = time() . "_" . $_FILES['foto']['name'];
    $tmp = $_FILES['foto']['tmp_name'];

    // upload foto baru
    move_uploaded_file($tmp, $folder . $foto_baru);

    // hapus foto lama
    if (file_exists($folder . $foto_lama)) {
        unlink($folder . $foto_lama);
    }
} else {
    // tidak ganti foto
    $foto_baru = $foto_lama;
}

mysqli_query($koneksi, "UPDATE galeri SET 
    judul='$judul',
    deskripsi='$deskripsi',
    foto='$foto_baru'
    WHERE id=$id");

header("Location: ../view/galeri.php");
exit;
