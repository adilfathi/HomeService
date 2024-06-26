<?php
require_once 'connect.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $details = $_POST['details'];

    // Handle image upload
    $image = $_FILES['image']['name'];
    $target_dir = "assets/";
    $target_file = $target_dir . basename($image);

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES['image']['tmp_name']);
    if ($check !== false) {
        move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
        // Insert data into the database
        $sql = "INSERT INTO services (name, description, price, details, image) VALUES ('$name', '$description', '$price', '$details', '$target_file')";
        if ($connect->query($sql) === TRUE) {
            $message = "New service added successfully";
        } else {
            $message = "Error: " . $sql . "<br>" . $connect->error;
        }
    } else {
        $message = "File is not an image.";
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Jasa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            background-color: #fff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        .form-label {
            font-weight: 500;
        }
    </style>
</head>

<body>
    <?php
    include 'navbar.php';

    ?>
    <div class="container">
        <h2 class="text-center">Tambah Jasa Baru</h2>
        <?php if (!empty($message)) : ?>
            <div class="alert alert-info"><?php echo $message; ?></div>
        <?php endif; ?>
        <form method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="name" class="form-label">Nama Jasa</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Harga</label>
                <input type="text" class="form-control" id="price" name="price" required>
            </div>
            <div class="mb-3">
                <label for="details" class="form-label">Detail</label>
                <textarea class="form-control" id="details" name="details" rows="5" required></textarea>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Gambar</label>
                <input class="form-control" type="file" id="image" name="image" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Tambah Jasa</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>