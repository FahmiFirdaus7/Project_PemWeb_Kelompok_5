<?php

    include_once '../koneksi.php';
    session_start();

?>


<!doctype html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Booking Pendakian</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>

  <body class="bg-light">

  <!-- BACKGROUND FIX -->
  <div style="
    position: relative;
    min-height: 100vh;
    width: 100%;
    background-image: url('https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=1500&q=80');
    background-size: cover;
    background-position: center;
    display: flex;
    align-items: center;
    justify-content: center;
  ">

    <!-- Overlay -->
    <div style="
      position: absolute;
      inset: 0;
      background: rgba(0, 0, 0, 0.6);
    "></div>

    <div class="container mt-5 position-relative" style="z-index: 5;">
      <div class="row justify-content-center">
        <div class="col-md-7">

          <div class="card shadow-lg">
            <div class="card-header bg-success text-white text-center">
              <h3 class="m-0">Form Booking Pendakian</h3>
            </div>

            <div class="card-body">

              <form action="../controller/booking_controller.php" method="POST">

                <!-- Nama -->
                <div class="mb-3">
                  <label class="form-label">Nama Lengkap</label>
                  <input type="text" class="form-control" placeholder="Masukkan nama lengkap" required name="namaBooking">
                </div>

                <!-- Gunung -->
                <div class="mb-3">
                  <label class="form-label">Pilih Gunung</label>
                  <select class="form-select" name="gunungBooking" id="gunungSelect" required>
                    <option value="" disabled selected>Pilih gunung</option>
                    <option value="Slamet">Gunung Slamet</option>
                    <option value="Sumbing">Gunung Sumbing</option>
                    <option value="Sindoro">Gunung Sindoro</option>
                    <option value="Lawu">Gunung Lawu</option>
                    <option value="Merbabu">Gunung Merbabu</option>
                    <option value="Prau">Gunung Prau</option>
                    <option value="Merapi">Gunung Merapi</option>
                  </select>
                </div>

                <!-- Basecamp -->
                <div class="mb-3">
                  <label class="form-label">Basecamp</label>
                  <select class="form-select" id="basecampSelect" name="basecampBooking" required>
                    <option value="" disabled selected>Pilih basecamp</option>
                  </select>
                </div>

                <!-- Jadwal -->
                <div class="mb-3">
                  <label class="form-label">Jadwal Pendakian</label>
                  <input type="date" class="form-control" required name="date">
                </div>

                <!-- Submit -->
                <div class="text-center mt-4">
                  <button class="btn btn-success px-5">Booking Sekarang</button>
                </div>

              </form>

            </div>
          </div>

        </div>
      </div>
    </div>

    <!-- BASECAMP DINAMIS -->
    <script>
      const basecampData = {
        "Slamet": ["Bambangan", "Gunungsari", "Dipajaya", "Blambangan"],
        "Sumbing": ["Garung", "Cepit Parakan", "Bowongso"],
        "Sindoro": ["Kledung", "Sigedang"],
        "Lawu": ["Candi Cetho", " Cemoro Sewu", "Cemoro Kandang"],
        "Merbabu": ["Selo", "Wekas", "Thekelan", "Cunthel"],
        "Prau": ["Patak Banteng", "Dieng", "Wates"],
        "Merapi": ["Selo New Basecamp", "Balerante", "Selo Lama"]
      };

      document.getElementById("gunungSelect").addEventListener("change", function () {
        const gunung = this.value;
        const basecampSelect = document.getElementById("basecampSelect");

        basecampSelect.innerHTML = `<option value="" disabled selected>Pilih basecamp</option>`;

        if (basecampData[gunung]) {
          basecampData[gunung].forEach(b => {
            let option = document.createElement("option");
            option.value = b;
            option.textContent = b;
            basecampSelect.appendChild(option);
          });
        }
      });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

  </div>
  </body>
</html>