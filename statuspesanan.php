<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Bookings - Home Service</title>
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
    include 'navbar.php'; ?>
    <div class="container">
        <h2 class="text-center">Status Pesanan</h2>
        <table class="table table-striped table-bordered mt-5">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Jenis Layanan</th>
                    <th scope="col">Spesifikasi Pembersihan</th>
                    <th scope="col">Tanggal Pengerjaan</th>
                    <th scope="col">Jam Mulai</th>
                    <th scope="col">Durasi (jam)</th>
                    <th scope="col">Metode Pembayaran</th>
                    <th scope="col">Total</th>
                    <th scope="col" class="text-center">Status Pesanan</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Mengambil data dari database
                // Sertakan file koneksi database

                $sql = "SELECT * FROM bookings";
                $result = $connect->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['address'] . "</td>";
                        echo "<td>" . $row['service_type'] . "</td>";
                        echo "<td>" . $row['cleaning_spec'] . "</td>";
                        echo "<td>" . $row['date'] . "</td>";
                        echo "<td>" . $row['start_time'] . "</td>";
                        echo "<td>" . $row['duration'] . "</td>";
                        echo "<td>" . $row['payment_method'] . "</td>";
                        echo "<td>Rp " . number_format($row['total'], 0, ',', '.') . "</td>";
                        echo "<td class='text-center'>";

                        // Memasukkan bagian kode dari contoh sebelumnya di sini
                        echo "<form action='update_status.php' method='post' class='d-flex justify-content-center'>";
                        echo "<input type='hidden' name='booking_id' value='" . $row['id'] . "'>";
                        $status = $row['approved']; // Misalnya 'approved', 'rejected', 'pending'
                        if ($status == 'pending') {
                            echo "<button type='submit' class='btn btn-success me-2' name='approve'><i class='bi bi-check'></i> Setujui</button>";
                            echo "<button type='submit' class='btn btn-danger' name='reject'><i class='bi bi-x'></i> Tidak Setujui</button>";
                        } elseif ($status == 'approved') {
                            echo "<span class='text-success'><i class='bi bi-check'></i> Disetujui</span>";
                        } elseif ($status == 'rejected') {
                            echo "<span class='text-danger'><i class='bi bi-x'></i> Tidak Disetujui</span>";
                        }
                        
                        echo "</form>";

                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='11'>Tidak ada data yang ditemukan</td></tr>";
                }
                
                // Tutup koneksi database
                $connect->close();
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
