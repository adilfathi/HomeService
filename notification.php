<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications - Home Service</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <?php 
    require 'connect.php';
    include 'navbar.php';
     
     ?> <!-- Include navbar untuk navigasi -->

    <div class="container">
        <h2 class="text-center">Notifications</h2>
        <div class="mt-5">
            <?php
            // Mengambil data notifikasi dari database
            // Sertakan file koneksi database

            $sql = "SELECT * FROM bookings ORDER BY created_at DESC";
            $result = $connect->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='alert alert-info'>";
                    echo "<strong>Status Pesanan</strong>: " . ucfirst($row['approved']);
                    echo " | <strong>ID Pesanan</strong>: " . $row['id'];

                    echo "</div>";
                }
            } else {
                echo "<div class='alert alert-warning'>Tidak ada notifikasi yang ditemukan.</div>";
            }
            
            // Tutup koneksi database
            $connect->close();
            ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
