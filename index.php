<?php
require_once 'connect.php';

// Handle logout if requested
if (isset($_GET['logout'])) {
    session_destroy();
    setcookie('_logged', '', time() - 3600, '/'); // Remove cookie
    header('Location: index.php');
    exit();
}

// Fetch services from the database
$sql = "SELECT * FROM services";
$result = $connect->query($sql);

$services = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $services[] = $row;
    }
}

// Function to format currency to Rupiah
function formatRupiah($amount) {
    return "Rp " . number_format($amount, 0, ',', '.');
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
    .card-img-top {
      height: 150px;
      object-fit: cover;
    }
    .modal-body img {
      height: 200px;
      object-fit: cover;
      width: 100%;
    }
  </style>
</head>
<body>
<?php 
    include 'navbar.php'; ?>
  
  <div class="container mt-5 justify-content-center" id="ppp">
    <img src="assets/banner.jpg" class="img-fluid">
    <div class="container mt-5">
      <h2 class="text-center">Layanan Kebersihan Kami</h2>
      <p class="text-center">Pilih Jasa Cleaning terlengkap yang sesuai dengan kebutuhan hunian anda</p>
      <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php foreach ($services as $service): ?>
          <div class="col">
            <div class="card h-100">
              <img src="<?php echo $service['image']; ?>" class="card-img-top mt-5" alt="<?php echo $service['name']; ?>">
              <div class="card-body">
                <h5 class="card-title text-center mt-5"><?php echo $service['name']; ?></h5>
                <p class="card-text"><?php echo $service['description']; ?></p>
                <p class="card-text"><strong> Mulai Dari Harga <?php echo formatRupiah($service['price']); ?></strong></p>
                <div class="d-grid">
                  <button type="button" class="btn btn-primary btn-block" data-bs-toggle="modal"
                    data-bs-target="#modal<?php echo $service['id']; ?>">Book Now</button>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>

  <!-- Modals -->
  <?php foreach ($services as $service): ?>
    <div class="modal fade" id="modal<?php echo $service['id']; ?>" tabindex="-1" aria-labelledby="modal<?php echo $service['id']; ?>Label" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modal<?php echo $service['id']; ?>Label"><?php echo $service['name']; ?></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <img src="<?php echo $service['image']; ?>" alt="" class="img-fluid">
            <ul class="mt-5">
              <?php echo $service['details']; ?>
            </ul>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <a type="button" class="btn btn-primary" href="booking.php">Book Now</a>
          </div>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
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
              <h5>Contact</h5>
              <ul class="list-unstyled">
                  <li>1234 Street Name, City, State</li>
                  <li>Email: info@homeservice.com</li>
                  <li>Phone: (123) 456-7890</li>
              </ul>
          </div>
          <div class="col-md-4">
              <h5>Follow Us</h5>
              <ul class="list-unstyled">
                  <li><a href="#" class="text-white">Facebook</a></li>
                  <li><a href="#" class="text-white">Twitter</a></li>
                  <li><a href="#" class="text-white">Instagram</a></li>
              </ul>
          </div>
      </div>
  </div>
  <div class="text-center py-3">
      &copy; 2023 Home Service. All rights reserved.
  </div>
</footer>
</html>
