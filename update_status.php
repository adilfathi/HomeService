<?php
require 'connect.php'; // Sertakan file koneksi database


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $booking_id = $_POST['booking_id'];

    if (isset($_POST['approve'])) {
        // Update status pesanan menjadi 'approved'
        $update_sql = "UPDATE bookings SET approved = 'approved' WHERE id = $booking_id";
        $connect->query($update_sql);

        // Tambahkan logika untuk mengirim notifikasi (contoh menggunakan echo)
        echo "Pesanan dengan ID $booking_id telah disetujui. Notifikasi telah dikirim.";

    } elseif (isset($_POST['reject'])) {
        // Update status pesanan menjadi 'rejected'
        $update_sql = "UPDATE bookings SET approved = 'rejected' WHERE id = $booking_id";
        $connect->query($update_sql);

        // Tambahkan logika untuk mengirim notifikasi (contoh menggunakan echo)
        echo "Pesanan dengan ID $booking_id tidak disetujui. Notifikasi telah dikirim.";
    }

    // Set notification_sent menjadi true
    $update_notification_sql = "UPDATE bookings SET notification_sent = 1 WHERE id = $booking_id";
    $connect->query($update_notification_sql);
}


// Redirect kembali ke halaman list_bookings.php
header("Location: statuspesanan.php");
exit();
?>
