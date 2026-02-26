<?php
include "../db.php";

$sql = "
SELECT b.*, c.full_name AS client_name, s.service_name
FROM bookings b
JOIN clients c ON b.client_id = c.client_id
JOIN services s ON b.service_id = s.service_id
ORDER BY b.booking_id DESC
";
$result = mysqli_query($conn, $sql);
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Bookings</title>
<link rel="stylesheet" href="../style.css">
</head>
<body>

<?php include "../nav.php"; ?>

<div class="container">

    <h2>Bookings</h2>

    <div style="text-align:right; margin-bottom:10px;">
        <a href="bookings_create.php" class="btn-primary">+ Create Booking</a>
    </div>

    <div class="table-card">
        <table class="modern-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Client</th>
                    <th>Service</th>
                    <th>Date</th>
                    <th>Hours</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Payment / Action</th>
                </tr>
            </thead>

            <tbody>
                <?php if ($result && mysqli_num_rows($result) > 0): ?>
                    <?php while($b = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?php echo $b['booking_id']; ?></td>
                            <td><?php echo $b['client_name']; ?></td>
                            <td><?php echo $b['service_name']; ?></td>
                            <td><?php echo $b['booking_date']; ?></td>
                            <td><?php echo $b['hours']; ?></td>
                            <td>₱<?php echo number_format($b['total_cost'], 2); ?></td>
                            <td><?php echo $b['status']; ?></td>
                            <td>
                                <?php if ($b['status'] == 'PENDING'): ?>
                                    <a href="payment_process.php?booking_id=<?php echo $b['booking_id']; ?>" class="btn-edit">
                                        Process Payment
                                    </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" style="text-align:center;">No bookings found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>

</body>
</html>