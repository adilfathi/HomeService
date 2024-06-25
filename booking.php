<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .form-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: auto;
        }

        .form-title {
            text-align: center;
            margin-bottom: 20px;
            color: #343a40;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-custom {
            background-color: #28a745;
            color: #ffffff;
            border: none;
        }

        .btn-custom:hover {
            background-color: #218838;
        }
    </style>
</head>

<body>
<?php
    require 'connect.php'; 
    include 'navbar.php'; ?>
    <div class="container mt-5">
        <div class="form-container">
            <h2 class="form-title">Booking Form</h2>
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $name = $_POST['name'];
                $address = $_POST['address'];
                $serviceType = $_POST['serviceType'];
                $cleaningSpec = $_POST['cleaningSpec'];
                $date = $_POST['date'];
                $startTime = $_POST['startTime'];
                $duration = $_POST['duration'];
                $paymentMethod = $_POST['paymentMethod'];
                $totalPrice = $_POST['total'];

                $totalPrice = str_replace('Rp ', '', $totalPrice); // Hapus 'Rp '
                $totalPrice = str_replace('.', '', $totalPrice); // Hapus pemisah ribuan            

                $minDuration = 2;
                $prices = [
                    'cleaning' => 65000,
                    'dishwash' => 50000,
                    'carwash' => 100000,
                ];

                $startTimeObj = new DateTime($startTime);
                $endTimeObj = clone $startTimeObj;
                $endTimeObj->modify("+{$duration} hours");
                $operationalStart = new DateTime('08:00');
                $operationalEnd = new DateTime('21:00');
                $lastOrderTime = new DateTime('19:00');

                if ($duration < $minDuration) {
                    echo '<div class="alert alert-danger">Minimal pemesanan adalah 2 jam.</div>';
                } elseif ($startTimeObj < $operationalStart || $endTimeObj > $operationalEnd) {
                    echo '<div class="alert alert-danger">Jam operasional adalah 08:00 - 21:00 WIB.</div>';
                } elseif ($startTimeObj > $lastOrderTime && $duration > 2) {
                    echo '<div class="alert alert-danger">Pukul 19:00 adalah last order untuk 2 jam, berakhir pada pukul 21:00 WIB.</div>';
                } else {
                    $sql = "INSERT INTO bookings (name, address, service_type, cleaning_spec, date, start_time, duration, payment_method, total) 
            VALUES ('$name', '$address', '$serviceType', '$cleaningSpec', '$date', '$startTime', '$duration', '$paymentMethod', '$totalPrice')";

                    if (mysqli_query($connect, $sql)) {
                        echo '<div class="alert alert-success">Pemesanan berhasil! Total yang harus dibayarkan adalah Rp ' . number_format($totalPrice, 0, ',', '.') . '.</div>';
                    } else {
                        echo '<div class="alert alert-danger">Terjadi kesalahan, silakan coba lagi.</div>';
                    }
                }
            }
            ?>
            <form method="POST" action="" oninput="calculateTotal()">
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama Anda" required>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Alamat</label>
                    <textarea class="form-control" id="address" name="address" rows="3" placeholder="Masukkan alamat Anda" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="serviceType" class="form-label">Jenis Layanan</label>
                    <select class="form-select" id="serviceType" name="serviceType" required>
                        <option value="" selected>Pilih jenis layanan</option>
                        <option value="GenerakClean" data-price="65000">General Cleaning</option>
                        <option value="DishWash" data-price="50000">Dish Wash</option>
                        <option value="CarWash" data-price="100000">Car Wash</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="cleaningSpec" class="form-label">Spesifik Pembersihan</label>
                    <input type="text" class="form-control" id="cleaningSpec" name="cleaningSpec" placeholder="Masukkan spesifikasi pembersihan" required>
                </div>
                <div class="mb-3">
                    <label for="date" class="form-label">Tanggal Pengerjaan</label>
                    <input type="date" class="form-control" id="date" name="date" required>
                </div>
                <div class="mb-3">
                    <label for="startTime" class="form-label">Waktu Mulai</label>
                    <input type="time" class="form-control" id="startTime" name="startTime" required>
                </div>
                <div class="mb-3">
                    <label for="duration" class="form-label">Durasi (jam)</label>
                    <input type="number" class="form-control" id="duration" name="duration" min="2" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Metode Pembayaran</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="paymentMethod" id="cash" value="cash" required>
                        <label class="form-check-label" for="cash">
                            Tunai
                        </label>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="total" class="form-label">Total yang Harus Dibayarkan</label>
                    <input type="text" class="form-control" id="total" name="total" readonly>
                </div>
                <button type="submit" class="btn btn-primary w-100">Submit</button>
            </form>
        </div>
    </div>

    <script>
        function calculateTotal() {
            const serviceTypeElement = document.getElementById('serviceType');
            const durationElement = document.getElementById('duration');
            const totalElement = document.getElementById('total');

            const selectedOption = serviceTypeElement.options[serviceTypeElement.selectedIndex];
            const pricePerHour = selectedOption.getAttribute('data-price');
            const duration = durationElement.value;

            if (pricePerHour && duration) {
                const totalPrice = pricePerHour * duration;
                totalElement.value = 'Rp ' + totalPrice.toLocaleString('id-ID');
            } else {
                totalElement.value = '';
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>