<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Register</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url(assets/background.jpg);
            background-repeat: no-repeat;
            background-position: center center;
            background-attachment: fixed;
            background-size: cover;
        }

        .register-container {
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-top: 50px;
            margin-bottom: 50px;
        }

        .register-container h2 {
            margin-bottom: 30px;
        }

        .form-group label {
            font-weight: bold;
        }

        .btn-custom {
            background: #007bff;
            border-color: #007bff;
        }

        .btn-custom:hover {
            background: #0056b3;
            border-color: #004085;
        }
    </style>
</head>

<body>
    <?php
    session_start();
    require_once 'connect.php';
    if (isset($_SESSION['is_login']) || isset($_COOKIE['_logged'])) {
        header('Location: /');
        exit();
    }

    if (isset($_POST['submit'])) {
        $email    = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        $name     = htmlspecialchars($_POST['name']);
        $phone    = htmlspecialchars($_POST['phone']);
        $alamat   = htmlspecialchars($_POST['address']);
        $messages = [];

        if (empty($email) || empty($password) || empty($name) || empty($phone) || empty($alamat)) {
            $messages[] = 'Silahkan isi data yang diperlukan!';
        } else {
            $password_hashed = password_hash($password, PASSWORD_BCRYPT);
            $insert = mysqli_query($connect, "INSERT INTO `user`(`email`, `password`, `nama`, `notelp`, `alamat`) VALUES('$email', '$password_hashed', '$name', '$phone', '$alamat')");
            if ($insert) {
                $messages[] = 'Pendaftaran berhasil!, Silahkan Masuk Ke Halaman Login';
            } else {
                $messages[] = 'Pendaftaran gagal!';
            }
        }
    }
    ?>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="register-container">
                    <h2 class="text-center">Register</h2>
                    <p class="text-center">Masukkan Data Diri Lengkap Anda!</p>
                    <?php
                    if (!empty($messages)) {
                        foreach ($messages as $message) {
                            echo '<div class="alert alert-info mt-3">' . $message . '</div>';
                        }
                    }
                    ?>
                    <form id="registerForm" method="post">
                        <div class="form-group">
                            <label for="name">Nama Lengkap</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">No HP</label>
                            <input type="tel" class="form-control" name="phone" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Alamat</label>
                            <textarea class="form-control" name="address" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block btn-custom" name="submit">Register</button>
                        <p class="text-center mt-5">Sudah Memiiliki Akun?<a href="login.php">Login Disini</a></p>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
</body>

</html>
