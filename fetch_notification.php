<?php
// Sertakan file koneksi database
require 'connect.php';

// Query untuk mengambil data notifikasi
$sql = "SELECT * FROM bookings ORDER BY created_at DESC";
$result = $connect->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $statusClass = $row['approved'] == 'approved' ? 'alert-success' : 'alert-danger'; // Sesuaikan dengan kolom status
        echo "<li class='dropdown-item notification-item'>";
        echo "<div class='alert $statusClass'>";
        echo "<strong>Status Pesanan</strong>: " . ucfirst($row['approved']);
        echo " | <strong>ID Pesanan</strong>: " . $row['id'];
        echo "</div>";
        echo "</li>";
    }
} else {
    echo "<li class='dropdown-item notification-item'>Tidak ada notifikasi yang ditemukan.</li>";
}

// Tutup koneksi database
$connect->close();
?>
