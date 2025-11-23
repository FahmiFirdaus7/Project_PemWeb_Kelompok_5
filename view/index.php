<?php

    require_once '../koneksi.php';

    session_start();

    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit();
    } 

    $username = $_SESSION['username'];
    $role = $_SESSION['role'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Hiking Hub</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    .hero {
      height: 100vh;
      background-size: cover;
      background-position: center;
      position: relative;
    }
    .hero::after {
      content: "";
      position: absolute;
      inset: 0;
      background: rgba(0,0,0,0.6);
    }
    .hero-content {
      position: relative;
      z-index: 2;
    }

    .scroll-card-wrapper {
      display: flex;
      gap: 1.5rem;
      overflow-x: auto;
      padding-bottom: 1rem;
      scroll-snap-type: x mandatory;
    }
    .scroll-card {
      min-width: 280px;
      scroll-snap-align: center;
    }
    .scroll-card-wrapper::-webkit-scrollbar {
      display: none;
    }
    body {
            transition: background-image 1s ease-in-out;
            body {background-color: #111;
            }
          }
    
    #home {
            margin-bottom: -3px;
          }
    #home iframe {
            display: block;
          }
    #tentang {
            padding: 0;
            margin: 0;
          }
    #tentang h3 {
            margin-bottom: 10px !important;
          }
    #tentang p {
            margin: 0 !important;
            padding-bottom: 20px;
          }

    #galeri img {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
          }

    #galeri img:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgba(255, 255, 255, 0.3);
          }

    .image-popup {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.8);
            backdrop-filter: blur(3px);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 99999;
            display: none;
          }

      .image-popup img {
            max-width: 90%;
            max-height: 90%;
            border-radius: 10px;
            box-shadow: 0 0 25px rgba(0,0,0,0.5);
            transition: transform 0.3s ease;
          }

      .image-popup.show {
            display: flex;
          }

      .scroll-card .card-body {
            display: flex;
            flex-direction: column;
            height: 100%;
          }

      .scroll-card .card-body a {
            margin-top: auto;
            display: inline-block;
          }


  </style>
</head>
<body onload="showAlert()">
<audio id="bg-music" src="sweden.mp3" autoplay loop hidden></audio>

<header class="position-absolute w-100 z-3">
  <nav class="navbar navbar-expand-lg navbar-dark bg-transparent px-4 py-3">
    <a class="navbar-brand fs-3 fw-bold text-white" href="index.php">Hiking<span class="text-success">Hub</span></a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navMenu">
      <ul class="navbar-nav text-white fw-semibold">
        <li class="nav-item mx-2"><a href="index.php" class="nav-link">Beranda</a></li>
        <li class="nav-item mx-2"><a href="#tentang" class="nav-link">Tentang</a></li>
        <li class="nav-item mx-2"><a href="#rute" class="nav-link">Rute</a></li>
        <li class="nav-item mx-2"><a href="#galeri" class="nav-link">Galeri</a></li>
        <li class="nav-item mx-2"><a href="../controller/logout_controller.php" class="nav-link bg-success bg-gradient
">Logout</a></li>
      </ul>
    </div>
  </nav>
</header>

<section id="home" class="position-relative vh-100 d-flex justify-content-center align-items-center text-white text-center overflow-hidden">

    <div class="position-absolute top-0 start-0 w-100 h-100 overflow-hidden" style="z-index: -1;">
        <iframe 
            src="https://www.youtube.com/embed/1V_4-f5Ocy4?autoplay=1&mute=1&controls=0&loop=1&playlist=1V_4-f5Ocy4&modestbranding=1&showinfo=0"
            class="w-100 h-100"
            style="object-fit: cover;"
            frameborder="0"
            allow="autoplay; encrypted-media"
            allowfullscreen>
        </iframe>
    </div>

    <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-50"></div>

    <div class="position-relative container">
        <h1 class="display-4 fw-bold mb-3">Selamat datang! <br> <?php echo $role; ?>: <?php echo $username; ?> </h1>
        <h2 class="display-4 fw-bold mb-3">di Hiking Hub</h2>
        <p class="lead mb-4 ">
            panduan lengkap tentang The Seven Summits Jawa Tengah 
        </p>
        <a href="#tentang" class="btn btn-success btn-lg shadow">Mulai Petualangan</a>
    </div>

</section>

<section id="tentang" class="py-20 bg-dark w-full block m-0 p-0">
  <div class="max-w-6xl mx-auto text-center px-6 text-white">
    <h3 class="text-3xl font-bold mb-4">Tentang Kami</h3>
    <p class="max-w-3xl mx-auto">
      Kami adalah komunitas pecinta alam yang berdedikasi untuk mengajak siapa pun menikmati keindahan alam Indonesia melalui kegiatan hiking yang aman, seru, dan penuh edukasi lingkungan.
    </p>
  </div>
</section>

<section id="rute" class="py-5 bg-dark">
  <div class="container">
    <h2 class="fw-bold text-center mb-4" style="color:white">The Seven Summits</h2>

    <div class="scroll-card-wrapper">
      <div class="card shadow scroll-card">
        <img src="https://tse3.mm.bing.net/th/id/OIP.iQ38tdy3CIBjj7GPLfnRtQHaED?rs=1&pid=ImgDetMain&o=7&rm=3" class="card-img-top" height="200">
        <div class="card-body">
          <h5 class="card-title fw-semibold">Gunung Sindoro</h5>
          <p class="card-text text-muted small">View lautan awan termewah di Jawa Tengah dengan panorama Gunung Sumbing.</p>
          <a href="../controller/gunung_controller.php?id=3" class="text-success fw-semibold">Lihat Detail →</a>
        </div>
      </div>

      <div class="card shadow scroll-card">
        <img src="https://upload.wikimedia.org/wikipedia/commons/c/ce/Gunung_Sumbing.png" class="card-img-top" height="200">
        <div class="card-body">
          <h5 class="card-title fw-semibold">Gunung Sumbing</h5>
          <p class="card-text text-muted small">Trek ekstrim dengan kemiringan 70° ditambah panorama Sindoro dan Segara Banjaran.</p>
          <a href="../controller/gunung_controller.php?id=4" class="text-success fw-semibold">Lihat Detail →</a>
        </div>
      </div>

      <div class="card shadow scroll-card">
        <img src="https://kabarbaik.co/wp-content/uploads/2025/02/gunung-slamet.jpeg" class="card-img-top" height="200">
        <div class="card-body">
          <h5 class="card-title fw-semibold">Gunung Slamet</h5>
          <p class="card-text text-muted small">Gunung tertinggi di Jawa Tengah favorit pejuang Seven Summit.</p>
          <a href="../controller/gunung_controller.php?id=1" class="text-success fw-semibold">Lihat Detail →</a>
        </div>
      </div>

      <div class="card shadow scroll-card">
        <img src="https://wallpaperaccess.com/full/14476998.jpg" class="card-img-top" height="200">
        <div class="card-body">
          <h5 class="card-title fw-semibold">Gunung Merapi</h5>
          <p class="card-text text-muted small">Gunung paling aktif di Indonesia dengan sunrise epik.</p>
          <a href="../controller/gunung_controller.php?id=2" class="text-success fw-semibold">Lihat Detail →</a>
        </div>
      </div>

      <div class="card shadow scroll-card">
        <img src="https://cdn.pixabay.com/photo/2018/12/03/13/59/mount-prau-3853487_1280.jpg" class="card-img-top" height="200">
        <div class="card-body">
          <h5 class="card-title fw-semibold">Gunung Prau</h5>
          <p class="card-text text-muted small">King golden sunrise Dieng dengan view asli gunung Aqua loh ya, ramah untuk pendaki pemula,</p>
          <a href="../controller/gunung_controller.php?id=5" class="text-success fw-semibold">Lihat Detail →</a>
        </div>
      </div>

      <div class="card shadow scroll-card">
        <img src="https://wisatago.com/wp-content/uploads/local-images/local-gunung-merbabu-1744396402-7.webp" class="card-img-top" height="200">
        <div class="card-body">
          <h5 class="card-title fw-semibold">Gunung Merbabu</h5>
          <p class="card-text text-muted small">Padang savana luas dengan view Merapi dari dekat.</p>
          <a href="../controller/gunung_controller.php?id=6" class="text-success fw-semibold">Lihat Detail →</a>
        </div>
      </div>

      <div class="card shadow scroll-card">
        <img src="https://static.vecteezy.com/system/resources/thumbnails/025/068/688/original/aerial-view-of-mount-lawu-above-the-clouds-at-sunrise-indonesia-video.jpg" class="card-img-top" height="200">
        <div class="card-body">
          <h5 class="card-title fw-semibold">Gunung Lawu</h5>
          <p class="card-text text-muted small">Gunung penuh mistis & budaya, terkenal dengan Warung Mbok Yem.</p>
          <a href="../controller/gunung_controller.php?id=7" class="text-success fw-semibold">Lihat Detail →</a>
        </div>
      </div>
    </div>
  </div>
</section>

<section id="galeri" class="py-5 bg-dark">
  <div class="container text-center">
    <h2 class="fw-bold mb-4" style="color: white;">Galeri Kami</h2>

    <div class="row g-3 justify-content-center">
      <div class="col-md-3 col-6">
        <img class="img-fluid rounded shadow-sm"
          src="https://tse1.mm.bing.net/th/id/OIP.msFFL-P36VMJhVV3GlgiEwHaE7?rs=1&pid=ImgDetMain&o=7&rm=3"
          alt="">
      </div>
      <div class="col-md-3 col-6">
        <img class="img-fluid rounded shadow-sm"
          src="https://thumbs.dreamstime.com/b/aerial-view-mount-slamet-gunung-slamet-active-stratovolcano-purbalingga-regency-central-java-indonesia-aerial-263897364.jpg"
          alt="">
      </div>
      <div class="col-md-3 col-6">
        <img class="img-fluid rounded shadow-sm"
          src="https://www.gotravelly.com/blog/wp-content/uploads/2023/12/gunung-sindoro.jpg"
          alt="">
      </div>
      <div class="col-md-3 col-6">
        <img class="img-fluid rounded shadow-sm"
          src="https://cdn.idntimes.com/content-images/community/2022/07/mount-merbabu-7267828-1920-1-4c4e0935346233c8fec14261a45ff371-d607f41656ade22878b21d93fc0196f3.jpg"
          alt="">
      </div>
    </div>
    <div class="mt-4">
      <a href="galeri.php" class="btn btn-success px-4 py-2 shadow-sm">
        Lihat Selengkapnya >>
      </a>
    </div>
  </div>
</section>

<footer id="kontak" class="bg-success text-white text-center py-4">
  <h4 class="fw-semibold">Hiking Hub</h4>
  <p class="small mb-1">Website Zamsteks dan Fahmi poenya</p>
  <p class="small">© 2025 Hiking Hub. All rights reserved.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
      function showAlert() {
      alert("Selamat datang di Hiking Hub!");
    }
</script>
<script>
  document.addEventListener("click", function() {
      const music = document.getElementById("bg-music");
      if (music.paused) {
          music.play();
      }
  });
</script>

<div class="image-popup" id="imagePopup">
  <img id="popupImage" src="">
</div>

<script>
  const popup = document.getElementById("imagePopup");
  const popupImg = document.getElementById("popupImage");

  document.querySelectorAll("#galeri img").forEach(img => {
    img.addEventListener("click", () => {
      popupImg.src = img.src;
      popup.classList.add("show");
    });
  });

  popup.addEventListener("click", () => {
    popup.classList.remove("show");
  });
</script>

</body>
</html>
