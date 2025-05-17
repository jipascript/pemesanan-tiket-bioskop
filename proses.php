<?php
include 'koneksi.php';

$nama   = mysqli_real_escape_string($conn, $_POST['nama']);
$email  = mysqli_real_escape_string($conn, $_POST['email']);
$film   = mysqli_real_escape_string($conn, $_POST['film']);
$jadwal = mysqli_real_escape_string($conn, $_POST['jadwal']);
$jumlah = intval($_POST['jumlah']);

$harga_per_tiket = 35000;
$total_harga = $harga_per_tiket * $jumlah;

if (empty($nama) || empty($email) || empty($film) || empty($jadwal) || $jumlah < 1 || $jumlah > 5) {
  die("Data tidak valid. Pastikan semua field terisi dengan benar dan jumlah tiket antara 1-5.");
}

$sql = "INSERT INTO tiket (nama, email, film, jadwal, jumlah) 
        VALUES ('$nama', '$email', '$film', '$jadwal', '$jumlah')";

if (mysqli_query($conn, $sql)) {
  echo "
  <html>
  <head>
    <title>Konfirmasi Pemesanan</title>
    <link href='https://fonts.googleapis.com/css2?family=Poppins&display=swap' rel='stylesheet'>
    <style>
      body {
        font-family: 'Poppins', sans-serif;
        background-color: #fff6f6;
        color: #330000;
        margin: 0;
        padding: 40px;
      }
      .card {
        max-width: 600px;
        margin: auto;
        background: #ffecec;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 0 15px rgba(255, 0, 0, 0.15);
        border: 1px solid #ffcccc;
      }
      h2 {
        color: #800000;
        text-align: center;
        margin-bottom: 20px;
      }
      p {
        font-size: 16px;
        line-height: 1.6;
      }
      strong {
        color: #990000;
      }
      a {
        display: inline-block;
        margin-top: 20px;
        text-decoration: none;
        background-color: #cc0000;
        color: white;
        padding: 10px 20px;
        border-radius: 8px;
        transition: 0.3s ease;
      }
      a:hover {
        background-color: #800000;
      }
    </style>
  </head>
  <body>
    <div class='card'>
      <h2>Terima kasih, $nama!</h2>
      <p>Pesananmu untuk film <strong>$film</strong> pada jam <strong>$jadwal</strong> telah berhasil dipesan.</p>
      <p><strong>Jumlah Tiket:</strong> $jumlah</p>
      <p><strong>Total Bayar:</strong> Rp " . number_format($total_harga, 0, ',', '.') . "</p>
      <p>Tiket akan dikirim ke email: <strong>$email</strong></p>
      <a href='index.php'>Kembali ke Halaman Awal</a>
    </div>
  </body>
  </html>
  ";
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>
