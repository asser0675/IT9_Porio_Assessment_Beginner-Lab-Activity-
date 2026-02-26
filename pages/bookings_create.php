<?php
include "../db.php";

$clients = mysqli_query($conn, "SELECT * FROM clients ORDER BY full_name ASC");
$services = mysqli_query($conn, "SELECT * FROM services WHERE is_active=1 ORDER BY service_name ASC");

if (isset($_POST['create'])) {
    $client_id = $_POST['client_id'];
    $service_id = $_POST['service_id'];
    $booking_date = $_POST['booking_date'];
    $hours = $_POST['hours'];

    $s = mysqli_fetch_assoc(mysqli_query($conn, "SELECT hourly_rate FROM services WHERE service_id=$service_id"));
    $rate = $s['hourly_rate'];
    $total = $rate * $hours;

    mysqli_query($conn, "INSERT INTO bookings (client_id, service_id, booking_date, hours, hourly_rate_snapshot, total_cost, status)
        VALUES ($client_id, $service_id, '$booking_date', $hours, $rate, $total, 'PENDING')");

    header("Location: bookings_list.php");
    exit;
}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Create Booking</title>

<!-- Link CSS -->
<link rel="stylesheet" href="../style.css">

</head>
<body>

<?php include "../nav.php"; ?>

<div class="container">

    <h2>Create Booking</h2>

    <form method="post" id="client-form">

        <label class="form-label">Client</label>
        <select name="client_id" class="form-input" required>
            <?php while($c = mysqli_fetch_assoc($clients)) { ?>
                <option value="<?php echo $c['client_id']; ?>">
                    <?php echo $c['full_name']; ?>
                </option>
            <?php } ?>
        </select>

        <br><br>

        <label class="form-label">Service</label>
        <select name="service_id" class="form-input" required>
            <?php while($s = mysqli_fetch_assoc($services)) { ?>
                <option value="<?php echo $s['service_id']; ?>">
                    <?php echo $s['service_name']; ?> (₱<?php echo number_format($s['hourly_rate'],2); ?>/hr)
                </option>
            <?php } ?>
        </select>

        <br><br>

        <label class="form-label">Date</label>
        <input type="date" name="booking_date" class="form-input" required>

        <br><br>

        <label class="form-label">Hours</label>
        <input type="number" name="hours" min="1" value="1" class="form-input" required>

        <div class="form-actions">
            <a href="bookings_list.php" id="cancel-btn">Cancel</a>
            <button type="submit" name="create" id="submit-btn">Create Booking</button>
        </div>

    </form>

</div>

</body>
</html>