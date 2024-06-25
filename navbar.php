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

        .dropdown-menu {
            width: 300px; /* Adjust width as needed */
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

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
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
                    <li class="nav-item">
                        <a class="nav-link" href="statuspesanan.php">Status Pesanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="notification.php">Notifikasi</a>
                    </li>
                    <!-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-bell"></i> Icon notifikasi -->
                            <!-- <span class="badge bg-danger" id="notification-count">0</span>  Contoh badge jumlah notifikasi -->
                        <!-- </a> -->
                        <!-- <ul class="dropdown-menu" aria-labelledby="navbarDropdown" id="notifications"> -->
                            <!-- <li class="dropdown-item text-center">Memuat...</li> Pesan saat memuat notifikasi -->
                        <!-- </ul> -->
                    <!-- </li> --> 
                </ul>
            </div>
        </div>
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- <script>
        // Ajax untuk memuat data notifikasi saat halaman dimuat
        $(document).ready(function () {
            loadNotifications();
        });

        function loadNotifications() {
            $.ajax({
                url: 'fetch_notifications.php', // Ganti dengan file yang memuat data notifikasi dari database
                type: 'GET',
                success: function (response) {
                    $('#notifications').html(response);
                    updateNotificationCount(); // Update jumlah notifikasi
                }
            });
        }

        // Fungsi untuk mengupdate jumlah notifikasi
        function updateNotificationCount() {
            var count = $('#notifications .notification-item').length;
            $('#notification-count').text(count);
        }
    </script> -->
</body>

</html>
