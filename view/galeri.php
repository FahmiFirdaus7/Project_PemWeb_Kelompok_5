<?php
session_start();

$isAdmin = (isset($_SESSION['role']) && $_SESSION['role'] === 'Admin');

include "../koneksi.php";
$galeri = mysqli_query($koneksi, "SELECT * FROM galeri ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Galeri Pendakian</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
/* === FIX NAVBAR DAN LAYERING === */
header, .navbar {
    position: fixed;
    top: 0; left: 0;
    width: 100%;
    z-index: 9999 !important;
    background: rgba(0, 0, 0, 0.3);
    backdrop-filter: blur(3px);
}

/* Memberi jarak konten dari navbar */
body {
    padding-top: 80px;
}

/* Card gallery */
.gallery-card img {
    height: 220px;
    object-fit: cover;
    border-radius: 12px;
    cursor: pointer;
}

/* Video Background */
.video-wrapper {
    position: fixed;
    inset: 0;
    width: 100%;
    height: 100%;
    z-index: -3 !important;
    overflow: hidden;
}

.video-wrapper iframe {
    position: absolute;
    top: 50%;
    left: 50%;
    width: 120vw;
    height: 120vh;
    transform: translate(-50%, -50%);
    object-fit: cover;
    pointer-events: none;
}

.bg-video-overlay {
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.45);
    z-index: -2 !important;
}

/* Popup Viewer */
.viewer-overlay {
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.9);
    display: none;
    justify-content: center;
    align-items: center;
    z-index: 99999;
}

.viewer-img {
    max-width: 90%;
    max-height: 90%;
    border-radius: 12px;
}

.viewer-close {
    position: absolute;
    top: 20px;
    right: 40px;
    font-size: 40px;
    color: white;
    cursor: pointer;
}

.viewer-prev, .viewer-next {
    position: absolute;
    top: 50%;
    padding: 20px;
    color: white;
    font-size: 50px;
    cursor: pointer;
    transform: translateY(-50%);
}

.viewer-prev { left: 20px; }
.viewer-next { right: 20px; }
</style>

</head>
<body>

<header>
<nav class="navbar navbar-expand-lg navbar-dark">
  <div class="container">
    <a class="navbar-brand fs-3 fw-bold text-white" href="index.php">Hiking<span class="text-success">Hub</span></a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navMenu">
      <ul class="navbar-nav text-white fw-semibold">
        <li class="nav-item mx-2"><a href="index.php" class="nav-link">Beranda</a></li>
        <li class="nav-item mx-2"><a href="../controller/logout_controller.php" class="nav-link bg-success rounded px-2">Logout</a></li>
      </ul>
    </div>
  </div>
</nav>
</header>

<div class="video-wrapper">
    <iframe src="https://www.youtube.com/embed/1V_4-f5Ocy4?autoplay=1&mute=1&controls=0&loop=1&playlist=1V_4-f5Ocy4&modestbranding=1&showinfo=0"
    allow="autoplay; encrypted-media"></iframe>
</div>
<div class="bg-video-overlay"></div>

<div class="container py-5">
  <?php if ($isAdmin): ?>
  <div class="d-flex justify-content-between align-items-center mb-4 text-white">
    <h2 class="fw-bold">Galeri Pendakian</h2>
    <a href="galeri_tambah.php" class="btn btn-success">+ Tambah Foto</a>
  </div>
  <?php else: ?>
    <h2 class="fw-bold text-white mb-4">Galeri Pendakian</h2>
  <?php endif; ?>

  <div class="row g-4">
    <?php while ($g = mysqli_fetch_assoc($galeri)) : ?>
    <div class="col-lg-3 col-md-4 col-sm-6">
      <div class="card border-0 shadow-sm gallery-card p-2 rounded-4">
        <img src="uploads/<?= $g['foto'] ?>" class="w-100 gallery-img">
        <div class="p-2">
          <h6 class="fw-bold mb-1"><?= $g['judul'] ?></h6>
          <p class="text-muted small"><?= $g['deskripsi'] ?></p>
        </div>

        <?php if ($isAdmin): ?>
        <div class="d-flex justify-content-between p-2">
          <a href="galeri_edit.php?id=<?= $g['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
          <a onclick="return confirm('Hapus foto ini?')" href="../controller/galeri_controller_hapus.php?id=<?= $g['id'] ?>" class="btn btn-danger btn-sm">Hapus</a>
        </div>
        <?php endif; ?>

      </div>
    </div>
    <?php endwhile; ?>
  </div>
</div>

<!-- Popup Viewer -->
<div id="imageViewer" class="viewer-overlay">
  <span class="viewer-close">&times;</span>
  <img id="viewerImage" class="viewer-img">
  <a class="viewer-prev">&#10094;</a>
  <a class="viewer-next">&#10095;</a>
</div>

<script>
const viewer = document.getElementById("imageViewer");
const viewerImg = document.getElementById("viewerImage");
const closeBtn = document.querySelector(".viewer-close");
const nextBtn = document.querySelector(".viewer-next");
const prevBtn = document.querySelector(".viewer-prev");
const imgs = [...document.querySelectorAll(".gallery-img")];
let currentIndex = 0;

imgs.forEach((img, i) => {
  img.addEventListener("click", () => {
    currentIndex = i;
    showImage();
    viewer.style.display = "flex";
  });
});

function showImage() {
  viewerImg.src = imgs[currentIndex].src;
}

closeBtn.onclick = () => viewer.style.display = "none";
nextBtn.onclick = () => { currentIndex = (currentIndex+1)%imgs.length; showImage(); };
prevBtn.onclick = () => { currentIndex = (currentIndex-1+imgs.length)%imgs.length; showImage(); };

viewer.addEventListener("click", e => { if (e.target === viewer) viewer.style.display = "none"; });
document.addEventListener("keydown", e => {
  if (viewer.style.display === "flex") {
    if (e.key === "ArrowRight") nextBtn.onclick();
    if (e.key === "ArrowLeft") prevBtn.onclick();
    if (e.key === "Escape") closeBtn.onclick();
  }
});
</script>

</body>
</html>
