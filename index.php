<?php
?>
<!DOCTYPE html>
<html>
<head>
  <title>Pemesanan Tiket Bioskop</title>
  <link rel="stylesheet" href="style.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Poppins', sans-serif;
    }

    .preview {
      margin-top: 20px;
      display: flex;
      flex-wrap: wrap;
      align-items: flex-start;
      gap: 20px;
      display: none; /* disembunyiin dulu sampai user milih film */
    }

    .preview img {
      width: 150px;
      height: auto;
      border-radius: 10px;
    }

    .desc {
      max-width: 200px;
    }

    /* Biar tampilan tetap oke di HP */
    @media (max-width: 600px) {
      .preview {
        flex-direction: column;
        align-items: center;
        text-align: center;
      }
      .desc {
        max-width: 100%;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Form Pemesanan Tiket Bioskop</h2>

    <!-- form ini bakal kirim data ke file proses.php -->
    <form action="proses.php" method="post">
      <label for="nama">Nama Lengkap:</label>
      <input type="text" id="nama" name="nama" required>

      <label for="email">Email:</label>
      <input type="email" id="email" name="email" required>

      <label for="film">Pilih Film:</label>
      <select id="film" name="film" required onchange="updatePreview()">
        <option value="" selected disabled>-- Pilih Film --</option>
        <option value="Final Destination Bloodlines">Final Destination Bloodlines</option>
        <option value="Omniscient Reader: The Prophet">Omniscient Reader: The Prophet</option>
        <option value="Sweet Home 3">Sweet Home 3</option>
      </select>

      <!-- ini buat nampilin preview poster & deskripsi film -->
      <div class="preview" id="preview">
        <img id="poster" src="" alt="Poster Film">
        <div class="desc" id="deskripsi"></div>
      </div>

      <label for="jadwal">Jam Tayang:</label>
      <select id="jadwal" name="jadwal" required>
        <option value="13:00">13:00</option>
        <option value="15:30">15:30</option>
        <option value="18:00">18:00</option>
      </select>

      <label for="jumlah">Jumlah Tiket:</label>
      <input type="number" id="jumlah" name="jumlah" min="1" max="5" required>
      <p><strong>Total Harga:</strong> <span id="totalHarga">Rp 0</span></p>

      <input type="submit" value="Pesan Tiket">
    </form>
  </div>

  <script>
    function updatePreview() {
      // Ambil nilai film yang dipilih
      const film = document.getElementById("film").value;
      const poster = document.getElementById("poster");
      const deskripsi = document.getElementById("deskripsi");
      const preview = document.getElementById("preview");

      if (!film) {
        // kalau belum pilih film, sembunyikan preview-nya
        preview.style.display = "none";
        poster.src = "";
        deskripsi.innerHTML = "";
        return;
      }

      preview.style.display = "flex";  // Tampilin preview kalau udah pilih

      // Ini bagian buat update poster & deskripsi berdasarkan film yg dipilih
      if (film === "Final Destination Bloodlines") {
        poster.src = "img/finaldestination.jpg";
        deskripsi.innerHTML = "<strong>Final Destination Bloodlines</strong><br>Nasib tidak bisa ditolak. Teror datang tanpa peringatan dalam babak baru Final Destination.";
      } else if (film === "Omniscient Reader: The Prophet") {
        poster.src = "img/omniscientreader.jpg";
        deskripsi.innerHTML = "<strong>Omniscient Reader: The Prophet</strong><br>Dunia berubah mengikuti isi novel—hanya satu pembaca yang tahu jalan ceritanya.";
      } else if (film === "Sweet Home 3") {
        poster.src = "img/sweethome3.jpg";
        deskripsi.innerHTML = "<strong>Sweet Home 3</strong><br>Manusia berubah jadi monster, dan hanya sedikit yang mampu bertahan hidup.";
      }
    }

    // Hitung total harga tiket otomatis pas user ngetik jumlah tiket
    const jumlahInput = document.getElementById("jumlah");
    const totalHargaSpan = document.getElementById("totalHarga");

    jumlahInput.addEventListener("input", function () {
      const hargaPerTiket = 35000; // harga satuan tiket
      let jumlah = parseInt(jumlahInput.value);
      if (isNaN(jumlah)) jumlah = 0;

      if (jumlah > 5) {
        // validasi biar gak bisa pesan lebih dari 5 tiket tp masih bingung gimana cara biar angkanya tetep ketulis wkwk
        alert("Maaf, maksimal pembelian hanya 5 tiket!");
        jumlahInput.value = 5;
        jumlah = 5;
      }

      const total = hargaPerTiket * jumlah;
      // Tampilkan total harga dalam format rupiah
      totalHargaSpan.innerText = "Rp " + total.toLocaleString("id-ID");
    });
  </script>
</body>
</html>
