<?php
session_start();

// Cek apakah data gunung tersedia
if (!isset($_SESSION['gunung_data'])) {
    die("Data gunung tidak ditemukan. Silakan kembali.");
}

// Ambil data dari session
$gunung = $_SESSION['gunung_data'];

// Gambar masih manual (boleh disimpan di tabel nanti)
$gambar = [
    "https://radartegal.disway.id/upload/0125614b78ad30216d1462d0739a25a7.jpg",
    "https://www.filosantara.com/wp-content/uploads/2023/04/gunung-sindoro-2.jpg",
    "https://tse2.mm.bing.net/th/id/OIP.tcPLjPaKYskBFrCn6bxNGAHaEH?rs=1&pid=ImgDetMain&o=7&rm=3",
    "https://cdn.idntimes.com/content-images/community/2020/08/fromandroid-3afa5b4f22ec15c01e15aec6c43ea977_600x400.jpg",
    "https://tse4.mm.bing.net/th/id/OIP.5rCgKnpXltQKMXArGKHovgHaFj?rs=1&pid=ImgDetMain&o=7&rm=3"

];

// Fakta dan deskripsi boleh manual
$fakta = $gunung['fakta'] ?? [
    "Kembaran Gunung Sumbing karena bentuknya mirip dan berhadapan.
Sunrise sangat cantik dengan lautan awan dan panorama Merapi–Merbabu–Slamet.
Punya sabana luas dan jalur pendakian yang fotogenik.
Banyak sumber belerang, menandakan aktivitas vulkanik aktif.
Jalur Kledung paling populer karena akses mudah dan medan stabil.
Dikelilingi perkebunan teh yang indah di kaki gunung.
Menjadi penanda musim bagi warga lokal melalui pola awan dan kabut.",];

// Jika kamu juga menyimpan deskripsi di session, gunakan:
// $deskripsi = $gunung['deskripsi'] ?? "Deskripsi manual di HTML...";
$deskripsi = "Gunung Sindoro (3.153 mdpl) adalah gunung berapi aktif di Jawa Tengah yang terkenal dengan sabana luas,
sunrise keemasan, dan pemandangan megah gunung-gunung sekitar. Jalur pendakiannya relatif ramah pendaki,
terutama via Kledung, sehingga jadi favorit pemula maupun pendaki berpengalaman.";
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $gunung['Nama_Gunung']; ?> - Detail Gunung</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    .header-full {
        height: 100vh;
        background-size: cover;
        background-position: center;
        transition: background-image 1s ease-in-out;
    }
    .header-overlay {
        position: absolute;
        inset: 0;
        background: rgba(0,0,0,0.55);
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .booking-box {
    background: #28a745;
    color: white;
    padding: 13px 20px;
    border-radius: 14px;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    font-weight: bold;
    text-decoration: none;
    transition: .3s;
}
.booking-box:hover {
    background: #1e7e34;
    color: #fff;
    text-decoration: none;
}

  </style>
</head>

<body class="bg-black text-white">

<!-- NAVBAR -->
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

<!-- HEADER GAMBAR -->
<section id="headerBg"
    class="header-full position-relative"
    style="background-image: url('<?= $gambar[0] ?>');">

    <div class="header-overlay">
        <h2 class="text-white fw-bold display-3">
            <?= $gunung['Nama_Gunung']; ?>
        </h2>
    </div>

</section>

<!-- DETAIL -->
<section class="container py-5">

    <div class="bg-dark p-5 rounded-4 shadow">

        <h3 class="fw-bold"><?= $gunung['Nama_Gunung']; ?></h3>
        <p class="text-white"><?= nl2br($deskripsi); ?></p>

        <div class="row my-4">
            <div class="col-md-6 mb-3">
                <h4>Ketinggian</h4>
                <p><?= $gunung['Ketinggian']; ?> mdpl</p>
            </div>

            <div class="col-md-6 mb-3">
                <h4>Lokasi</h4>
                <p><?= $gunung['Lokasi']; ?></p>
            </div>

            <div class="col-md-6 mb-3">
                <h4>Jumlah Basecamp</h4>
                <p><?= $gunung['Basecamp']; ?> basecamp</p>
            </div>
        </div>

<div class="col-md-8">
    <h4 class="fw-semibold mb-3">Fakta Menarik</h4>
    <ul class="text-white">
        <?php foreach ($fakta as $f): ?>
            <li class="mb-2"><?= htmlspecialchars($f); ?></li>
        <?php endforeach; ?>
    </ul>
</div>

    <!-- Tombol Booking (FULL WIDTH + Style sama) -->
    <div class="col-md-4 d-flex align-items-center">
        <a href="booking.php" class="booking-box w-100 justify-content-center">
            📞 Booking Sekarang!
        </a>
    </div>
</div>

            

        <a href="index.php" class="btn btn-success mt-4">← Kembali ke Daftar</a>
    </div>

</section>

<footer class="bg-success text-white text-center py-4">
  <p class="m-0">© 2025 Hiking Hub</p>
</footer>

<script>
    const images = <?= json_encode($gambar); ?>;
    let index = 0;

    setInterval(() => {
        index = (index + 1) % images.length;
        document.getElementById("headerBg").style.backgroundImage =
            `url('${images[index]}')`;
    }, 6000);
</script>

</body>
</html>
