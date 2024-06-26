<?php

require_once 'connect.php';
include 'navbar.php';

if (!isset($_SESSION['is_login'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM bookings WHERE user_id = ?";
$stmt = mysqli_prepare($connect, $query);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .order-container {
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-top: 50px;
            margin-bottom: 50px;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="order-container">
                    <h2 class="text-center">My Orders</h2>
                    <?php if (mysqli_num_rows($result) > 0): ?>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Service Type</th>
                                    <th>Date</th>
                                    <th>Start Time</th>
                                    <th>Duration</th>
                                    <th>Payment Method</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($order = mysqli_fetch_assoc($result)): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($order['id']); ?></td>
                                        <td><?php echo htmlspecialchars($order['service_type']); ?></td>
                                        <td><?php echo htmlspecialchars($order['date']); ?></td>
                                        <td><?php echo htmlspecialchars($order['start_time']); ?></td>
                                        <td><?php echo htmlspecialchars($order['duration']); ?> hours</td>
                                        <td><?php echo htmlspecialchars($order['payment_method']); ?></td>
                                        <td><?php echo htmlspecialchars($order['total']); ?></td>
                                        <td><?php echo htmlspecialchars($order['approved']); ?></td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p class="text-center">You have no orders.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
