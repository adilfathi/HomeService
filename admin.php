<?php
// Koneksi ke database
require_once 'connect.php';

// Query untuk mengambil semua data user
$sql = "SELECT * FROM `user`";
$result = $connect->query($sql);

// Include header and navigation
include 'navbar.php';
?>

<div class="container mt-5">
    <h2 class="mb-3">User Management</h2>

    <a href="add_user.php" class="btn btn-primary mb-3">Add New User</a>

    <?php
    // Jika ada pesan setelah melakukan operasi (edit, delete, etc)
    if (isset($_SESSION['message'])) {
        echo '<div class="alert alert-info">' . $_SESSION['message'] . '</div>';
        unset($_SESSION['message']); // Hapus pesan setelah ditampilkan
    }
    ?>

    <?php if ($result->num_rows > 0): ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>No. Telepon</th>
                    <th>Alamat</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['nama']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['notelp']; ?></td>
                        <td><?php echo $row['alamat']; ?></td>
                        <td><?php echo $row['role']; ?></td>
                        <td>
                            <a href="edit_user.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                            <a href="delete_user.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="alert alert-warning">No users found.</p>
    <?php endif; ?>
</div>

<?php
// Tutup koneksi ke database
$connect->close();

// Include footer
include 'footer.php';
?>
