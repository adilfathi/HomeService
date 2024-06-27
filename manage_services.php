<?php
require 'connect.php';

// Periksa apakah pengguna telah login
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Tangani permintaan hapus
if (isset($_GET['delete'])) {
    $service_id = $_GET['delete'];
    $sql = "DELETE FROM services WHERE id = $service_id";
    $connect->query($sql);
    header('Location: manage_services.php');
    exit();
}

// Tangani permintaan edit
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_service'])) {
    $service_id = $_POST['service_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image = $_POST['image'];
    $details = $_POST['details'];

    $sql = "UPDATE services SET name='$name', description='$description', price='$price', image='$image', details='$details' WHERE id=$service_id";
    $connect->query($sql);
    header('Location: manage_services.php');
    exit();
}

// Tangani permintaan tambah
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_service'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image = $_POST['image'];
    $details = $_POST['details'];

    $sql = "INSERT INTO services (name, description, price, image, details) VALUES ('$name', '$description', '$price', '$image', '$details')";
    $connect->query($sql);
    header('Location: manage_services.php');
    exit();
}

// Ambil data layanan dari database
$sql = "SELECT * FROM services";
$result = $connect->query($sql);

$services = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $services[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Services</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .table-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
        }
    </style>
</head>

<body>
<?php include 'navbar.php'; ?>
<div class="container">
    <div class="table-container">
        <h2 class="mb-4">Manage Services</h2>
        <a class="btn btn-success mb-3" href="add_service.php">Add Service</a>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price (Rp)</th>
                <th>Image</th>
                <th>Details</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($services as $service): ?>
                <tr>
                    <td><?php echo $service['id']; ?></td>
                    <td><?php echo $service['name']; ?></td>
                    <td><?php echo $service['description']; ?></td>
                    <td><?php echo number_format($service['price'], 0, ',', '.'); ?></td>
                    <td><img src="<?php echo $service['image']; ?>" alt="<?php echo $service['name']; ?>" style="height: 50px;"></td>
                    <td><?php echo $service['details']; ?></td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Actions">
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $service['id']; ?>">Edit</button>
                            <a href="manage_services.php?delete=<?php echo $service['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this service?');">Delete</a>
                        </div>
                    </td>
                </tr>

                <!-- Edit Modal -->
                <div class="modal fade" id="editModal<?php echo $service['id']; ?>" tabindex="-1" aria-labelledby="editModalLabel<?php echo $service['id']; ?>" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form method="POST" action="manage_services.php">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel<?php echo $service['id']; ?>">Edit Service</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="service_id" value="<?php echo $service['id']; ?>">
                                    <div class="mb-3">
                                        <label for="name<?php echo $service['id']; ?>" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="name<?php echo $service['id']; ?>" name="name" value="<?php echo $service['name']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="description<?php echo $service['id']; ?>" class="form-label">Description</label>
                                        <textarea class="form-control" id="description<?php echo $service['id']; ?>" name="description" rows="3" required><?php echo $service['description']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="price<?php echo $service['id']; ?>" class="form-label">Price</label>
                                        <input type="number" class="form-control" id="price<?php echo $service['id']; ?>" name="price" value="<?php echo $service['price']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="image<?php echo $service['id']; ?>" class="form-label">Image URL</label>
                                        <input type="text" class="form-control" id="image<?php echo $service['id']; ?>" name="image" value="<?php echo $service['image']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="details<?php echo $service['id']; ?>" class="form-label">Details</label>
                                        <textarea class="form-control" id="details<?php echo $service['id']; ?>" name="details" rows="3" required><?php echo $service['details']; ?></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="edit_service">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Add Modal -->


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
