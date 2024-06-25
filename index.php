<?php
require_once 'connect.php';

// Handle logout if requested
if (isset($_GET['logout'])) {
    session_destroy();
    setcookie('_logged', '', time() - 3600, '/'); // Remove cookie
    header('Location: index.php');
    exit();
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Home</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <style>
    .btn-custom {
      background-color: black;
      text-align: center;
      color: white;
    }

    .nav-link {
      color: black;
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Home Service</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Layanan</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Kontak</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="statuspesanan.php">Status Pesanan</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Notifikasi</a>
          </li>
          <?php if (isset($_SESSION['is_login']) || isset($_COOKIE['_logged'])): ?>
            <li class="nav-item">
              <a class="btn btn-custom" href="?logout">Keluar</a>
            </li>
          <?php else: ?>
            <li class="nav-item">
              <a class="nav-link" href="register.php">Daftar</a>
            </li>
            <li class="nav-item">
              <a class="btn btn-custom" href="login.php">Login</a>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>
  <div class="container mt-5 justify-content-center" id="ppp">
    <img src="assets/banner.jpg" class="img-fluid">
    <div class="container mt-5">
      <h2 class="text-center">Layanan Kebersihan Kami</h2>
      <p class="text-center">Pilih Jasa Cleaning terlengkap yang sesuai dengan kebutuhan hunian anda</p>
      <div class="card-group">
        <div class="card">
          <img src="assets/vacum.png" class="card-img-top mt-5" alt="General Cleaning">
          <div class="card-body">
            <h5 class="card-title text-center mt-5">General Cleaning</h5>
            <div class="list-group">
              <ul>
                <li>Membersihkan kamar Tidur</li>
                <li>Membersihkan Kamar Mandi atau Toilet</li>
                <li>Mengepel Lantai</li>
                <li>Harga Mulai 65.000/Jam</li>
              </ul>
            </div>
            <div class="d-grid">
              <button type="button" class="btn btn-primary btn-block" data-bs-toggle="modal"
                data-bs-target="#modal1">Book Now</button>
            </div>
          </div>
        </div>
        <div class="card">
          <img src="assets/piring.png" class="card-img-top mt-5" alt="Dish Wash">
          <div class="card-body">
            <h5 class="card-title text-center mt-5">Dish Wash</h5>
            <div class="list-group">
              <ul>
                <li>Cuci Piring</li>
                <li>Membantu Menyusun Rak Piring</li>
                <li>Merapihkan Alat Dapur</li>
                <li>Harga Mulai 50.000/Jam</li>
              </ul>
            </div>
            <div class="d-grid">
              <button type="button" class="btn btn-primary btn-block" data-bs-toggle="modal"
                data-bs-target="#modal2">Book Now</button>
            </div>
          </div>
        </div>
        <div class="card">
          <img src="assets/mobil.png" class="card-img-top mt-5" alt="Car Wash">
          <div class="card-body">
            <h5 class="card-title text-center mt-5">Car Wash</h5>
            <div class="list-group">
              <ul>
                <li>Menghilangkan Jamur & Baret</li>
                <li>Membersihkan Kerak dan Minyak Di Mobil</li>
                <li>Coating Mobil</li>
                <li>Harga Mulai 100.000/1 Mobil</li>
              </ul>
            </div>
            <div class="d-grid">
              <button type="button" class="btn btn-primary btn-block" data-bs-toggle="modal"
                data-bs-target="#modal3">Book Now</button>
            </div>
          </div>
        </div>
      </div>
      <div class="container mt-5" style="background-color: beige;">
        <div class="row gx-1 justify-content-between">
          <div class="col-md-6 mt-5">
            <h1>Kepuasan Pelanggan Terjamin</h1>
            <p class="mt-5" style="font-size: large;">Home Service adalah layanan jasa kebersihan dan pembersihan yang bertujuan untuk memudahkan
              pelanggan dalam membersihkan rumah, kos, gedung dengan kualitas terbaik dan harga terjangkau.</p>
          </div>
          <div class="col-md-6">
            <img src="assets/cleaner.png" alt="" class="img-responsive center-block">
          </div>
        </div>
      </div>
      <div class="container mt-5 justify-content-center">
        <div class="row justify-content-center">
          <div class="col-12">
            <h1 class="text-center">Rumah Bersih Dengan 1x Klik</h1>
            <div class="container">
              <div class="card-group mt-5">
                <div class="card">
                  <img src="assets/telp.png" class="card-img-top" alt="General Cleaning">
                  <div class="card-body">
                    <h5 class="card-title text-center mt-5">Pesan</h5>
                    <p>Pesan berbagai macam layanan jasa kebersihan dan perawatan peralatan rumah Anda melalui web Home
                      Service</p>
                  </div>
                </div>
                <div class="card">
                  <img src="assets/chat.png" class="card-img-top" alt="Chat" style="height: 400px;">
                  <div class="card-body">
                    <h5 class="card-title text-center mt-5">Chat</h5>
                    <p>Sambil menunggu layanan jasa tiba di rumah Anda, bisa chat dengan helper kami melalui fitur chat di web Home Service</p>
                  </div>
                </div>
                <div class="card">
                  <img src="assets/enjoy.png" class="card-img-top" alt="Enjoy">
                  <div class="card-body">
                    <h5 class="card-title text-center mt-5">Enjoy</h5>
                    <p>Kami melakukan perawatan dan pembersihan rumah dengan maksimal. Dibekali dengan perlengkapan cleaning service, semuanya dilakukan secara profesional untuk kualitas hasil yang memuaskan</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Modals -->
      <div class="modal fade" id="modal1" tabindex="-1" aria-labelledby="modal1Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modal1Label">General Cleaning</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <img src="assets/vacum.png" alt="" class="img-fluid">
              <ul class="mt-5">
                <li>Minimal pemesanan 2 jam</li>
                <li>Meliputi kamar tidur, kamar mandi, ruang tamu, dapur dan teras (untuk hasil maksimal, luas total +/-
                  45m2)</li>
                <li>Estimasi pengerjaan 20-30 menit setiap ruangan</li>
                <li>Jam operasional mulai pukul 08.00 – 19.00 WIB. Pukul 19.00 WIB adalah last order untuk 2 jam,
                  berakhir pada pukul 21.00 WIB.</li>
              </ul>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <a type="button" class="btn btn-primary" href="booking.php">Book Now</a>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modal2" tabindex="-1" aria-labelledby="modal2Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modal2Label">Dish Wash</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <img src="assets/piring.png" alt="" class="img-fluid">
              <ul class="mt-5">
                <li>Minimal pemesanan 2 jam</li>
                <li>Estimasi pengerjaan 20-30 menit</li>
                <li>Tidak diperuntukkan bagi acara besar ataupun pesta</li>
                <li>Jam operasional mulai pukul 08.00 – 19.00 WIB. Pukul 19.00 WIB adalah last order untuk 2 jam,
                  berakhir pada pukul 21.00 WIB.</li>
              </ul>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <a type="button" class="btn btn-primary" href="booking.php">Book Now</a>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modal3" tabindex="-1" aria-labelledby="modal3Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modal3Label">Car Wash</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <img src="assets/mobil.png" alt="" class="img-fluid">
              <ul class="mt-5">
                <li>Minimal pemesanan 2 jam</li>
                <li>Estimasi pengerjaan 1-2 jam</li>
                <li>Jam operasional mulai pukul 08.00 – 19.00 WIB. Pukul 19.00 WIB adalah last order untuk 2 jam,
                  berakhir pada pukul 21.00 WIB.</li>
              </ul>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <a type="button" class="btn btn-primary" href="booking.php">Book Now</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

<footer class="bg-dark text-white pt-4 mt-5">
  <div class="container">
      <div class="row">
          <div class="col-md-4">
              <h5>About Us</h5>
              <p>We are a company committed to providing the best services for your home and car cleaning needs. Our team of professionals is dedicated to ensuring your satisfaction with every service we offer.</p>
          </div>
          <div class="col-md-4">
              <h5>Quick Links</h5>
              <ul class="list-unstyled">
                  <li><a href="index.html" class="text-white">Home</a></li>
                  <li><a href="services.html" class="text-white">Services</a></li>
                  <li><a href="contact.html" class="text-white">Contact Us</a></li>
                  <li><a href="about.html" class="text-white">About Us</a></li>
              </ul>
          </div>
          <div class="col-md-4">
              <h5>Contact Us</h5>
              <ul class="list-unstyled">
                  <li><i class="bi bi-geo-alt"></i> 1234 Street Name, City, Country</li>
                  <li><i class="bi bi-telephone"></i> (123) 456-7890</li>
                  <li><i class="bi bi-envelope"></i> info@example.com</li>
              </ul>
          </div>
      </div>
      <div class="row mt-3">
          <div class="col text-center">
              <p>&copy; 2024 Your Company. All Rights Reserved.</p>
          </div>
      </div>
  </div>
</footer>

<!-- Bootstrap Icons -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.css" rel="stylesheet">

</html>
