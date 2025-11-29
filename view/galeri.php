
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
  .gallery-card img {
      height: 220px;
      object-fit: cover;
      border-radius: 12px;
}

.navbar,
.container {
    position: relative;
    z-index: 10;
}


.bg-video {
  position: fixed;
  top: 0;
  left: 0;
  width: 100vw;
  height: 100vh;
  object-fit: cover;
  z-index: -2;
  pointer-events: none; /* agar tidak bisa di-klik */
}

.bg-video-overlay {
  position: fixed;
  inset: 0;
  background: rgba(0, 0, 0, 0.45);
  z-index: -1;
}

.viewer-overlay {
  position: fixed;
  inset: 0;
  background: rgba(0,0,0,0.9);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 99999;
}

.viewer-img {
  max-width: 90%;
  max-height: 90%;
  border-radius: 12px;
  transition: 0.3s;
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
  user-select: none;
  transform: translateY(-50%);
}

.viewer-prev { left: 20px; }
.viewer-next { right: 20px; }

.gallery-img {
  cursor: pointer;
}


  </style>
</head>

<body>
  <header class="position-absolute w-100 z-3">
  <nav class="navbar navbar-expand-lg navbar-dark bg-transparent px-4 py-3">
    <a class="navbar-brand fs-3 fw-bold text-white" href="index.php">Hiking<span class="text-success">Hub</span></a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navMenu">
      <ul class="navbar-nav text-white fw-semibold">
        <li class="nav-item mx-2"><a href="index.php" class="nav-link">Beranda</a></li>
        <li class="nav-item mx-2"><a href="../controller/logout_controller.php" class="nav-link bg-success bg-gradient
">Logout</a></li>
      </ul>
    </div>
  </nav>
</header>

<iframe 
    class="bg-video"
    src="https://www.youtube.com/embed/1V_4-f5Ocy4?autoplay=1&mute=1&controls=0&loop=1&playlist=1V_4-f5Ocy4&modestbranding=1&showinfo=0"
    frameborder="0"
    allow="autoplay; encrypted-media"
    allowfullscreen>
</iframe>

<div class="bg-video-overlay"></div>

<div class="bg-video-overlay"></div>

<div class="container py-5">
  <?php if ($isAdmin): ?>
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold text-white">Galeri Pendakian</h2>

    <a href="galeri_tambah.php" class="btn btn-success">
      + Tambah Foto
    </a>
  </div>
  <?php endif; ?>
  
  <div class="row g-4">

    <?php while ($g = mysqli_fetch_assoc($galeri)) : ?>
      <div class="col-lg-3 col-md-4 col-sm-6">
        <div class="card border-0 shadow-sm gallery-card p-2 rounded-4">

          <img src="uploads/<?= $g['foto'] ?>" 
     class="w-100 rounded-3 gallery-img"
     data-index="<?= $g['id'] ?>">


          <div class="p-2">
            <h6 class="fw-bold mb-1"><?= $g['judul'] ?></h6>
            <p class="text-muted small"><?= $g['deskripsi'] ?></p>
          </div>

          <?php if ($isAdmin): ?>
          <div class="d-flex justify-content-between p-2">
              <a href="galeri_edit.php?id=<?= $g['id'] ?>" class="btn btn-success btn-sm">Edit</a>
              <a onclick="return confirm('Hapus foto ini?')"
                href="../controller/galeri_controller_hapus.php?id=<?= $g['id'] ?>"
                class="btn btn-secondary btn-sm">Hapus</a>
          </div>
          <?php endif; ?>

        </div>
      </div>
    <?php endwhile; ?>

  </div>

</div>

<div id="imageViewer" class="viewer-overlay" style="display:none;">
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
  
  imgs.forEach((img, index) => {
    img.addEventListener("click", () => {
      currentIndex = index;
      showImage();
      viewer.style.display = "flex";
    });
  });

  function showImage() {
    viewerImg.src = imgs[currentIndex].src;
  }

  closeBtn.onclick = () => {
    viewer.style.display = "none";
  };

  nextBtn.onclick = () => {
    currentIndex = (currentIndex + 1) % imgs.length;
    showImage();
  };

  prevBtn.onclick = () => {
    currentIndex = (currentIndex - 1 + imgs.length) % imgs.length;
    showImage();
  };

  viewer.addEventListener("click", (e) => {
    if (e.target === viewer) viewer.style.display = "none";
  });

  document.addEventListener("keydown", (e) => {
    if (viewer.style.display === "flex") {
      if (e.key === "ArrowRight") nextBtn.onclick();
      if (e.key === "ArrowLeft") prevBtn.onclick();
      if (e.key === "Escape") viewer.style.display = "none";
    }
  });
</script>


</body>
</html>
