<?php
require_once 'connect.php';

// Contoh kondisi status login (disesuaikan dengan logika sesungguhnya)
$is_admin = isset($_SESSION['role']) && $_SESSION['role'] == 'Admin';
$is_logged_in = isset($_SESSION['is_login']) || isset($_COOKIE['_logged']);

// Pesan contoh, bisa disesuaikan dengan logika notifikasi yang sesungguhnya
$notification_count = 0; // Ganti dengan jumlah notifikasi yang sebenarnya

// Tentukan kelas untuk navbar sesuai dengan peran pengguna
$navbar_class = $is_admin ? 'navbar navbar-expand-lg navbar-dark bg-dark' : 'navbar navbar-expand-lg navbar-light bg-light';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Service</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .btn-custom {
            background-color: black;
            color: white;
        }

        .navbar-nav .nav-link {
            color: black;
        }

        .navbar-dark .navbar-nav .nav-link {
            color: white;
        }

        .dropdown-menu {
            width: 300px;
            /* Adjust width as needed */
        }

        .notification-item {
            padding: 10px;
            border-bottom: 1px solid #dee2e6;
        }

        .notification-item:last-child {
            border-bottom: none;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
</head>

<body>

    <nav class="<?php echo $navbar_class; ?>">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Home Service</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Layanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Kontak</a>
                    </li>
                    <?php if ($is_logged_in): ?>
                        <?php if ($is_admin): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="statuspesanan.php">Pesanan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="admin.php">User Control</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="manage_services.php">Manage Service</a>
                            </li>
                        <?php else: ?>
                            <li class="nav-item">
                                <a class="nav-link" href="my_orders.php">My Orders</a>
                            </li>
                        <?php endif; ?>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</body>

</html>
