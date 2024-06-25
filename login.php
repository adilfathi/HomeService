<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Login</title>
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
        header('Location: index.php');
        exit();
    }

    if (isset($_POST['submit'])) {
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        $remember = (!empty($_POST['remember_me']) ? $_POST['remember_me'] : '');
        $messages = [];

        if (empty($email) || empty($password)) {
            $messages[] = 'Silahkan isi semua data yang diperlukan!';
        } else {
            $result = mysqli_query($connect, 'SELECT email, password, nama FROM user WHERE email = "' . $email . '"');
            if (mysqli_num_rows($result) > 0) {
                $data = mysqli_fetch_assoc($result);
                if (password_verify($password, $data['password'])) {
                    $_SESSION['is_login'] = $data['nama'];
                    if ($remember) {
                        setcookie('_logged', substr(md5($email), 0, 10), time() + (60 * 60 * 24), '/');
                    }
                    header('Location: index.php');
                    exit();
                } else {
                    $messages[] = 'Kata sandi salah!';
                }
            } else {
                $messages[] = 'Email tidak terdaftar!';
            }
        }
    }
    ?>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="register-container">
                    <h2 class="text-center">Login</h2>
                    <p class="text-center">Selamat datang kembali! Silakan masukkan detail akun Anda untuk melanjutkan.</p>
                    <form id="loginForm" method="post">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" name="remember_me" id="remember_me">
                            <label class="form-check-label" for="remember_me">Remember me</label>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block btn-custom" name="submit">Login</button>
                        <p class="text-center mt-5">Belum Memiliki Akun?<a href="register.html"> Buat Akun</a></p>
                    </form>
                    <?php
                    if (!empty($messages)) {
                        foreach ($messages as $message) {
                            echo '<div class="alert alert-danger mt-3">' . $message . '</div>';
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
</body>

</html>
