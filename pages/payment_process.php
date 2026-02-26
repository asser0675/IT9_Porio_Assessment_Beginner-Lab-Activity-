<?php
include "../db.php";

$booking_id = $_GET['booking_id'];

$booking = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT * FROM bookings WHERE booking_id=$booking_id")
);

$paidRow = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT IFNULL(SUM(amount_paid),0) AS paid FROM payments WHERE booking_id=$booking_id")
);

$total_paid = $paidRow['paid'];
$balance = $booking['total_cost'] - $total_paid;
$message = "";

if (isset($_POST['pay'])) {

    $amount = $_POST['amount_paid'];
    $method = $_POST['method'];

    if ($amount <= 0) {
        $message = "Invalid amount!";
    } else if ($amount > $balance) {
        $message = "Amount exceeds balance!";
    } else {

        mysqli_query($conn, 
            "INSERT INTO payments (booking_id, amount_paid, method)
             VALUES ($booking_id, $amount, '$method')"
        );

        $paidRow2 = mysqli_fetch_assoc(
            mysqli_query($conn, "SELECT IFNULL(SUM(amount_paid),0) AS paid FROM payments WHERE booking_id=$booking_id")
        );

        $total_paid2 = $paidRow2['paid'];
        $new_balance = $booking['total_cost'] - $total_paid2;

        if ($new_balance <= 0.009) {
            mysqli_query($conn, 
                "UPDATE bookings SET status='PAID' WHERE booking_id=$booking_id"
            );
        }

        header("Location: bookings_list.php");
        exit;
    }
}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Process Payment</title>

<!-- Link CSS -->
<link rel="stylesheet" href="../style.css">

</head>
<body>

<?php include "../nav.php"; ?>

<div class="container">

    <h2>Process Payment (Booking #<?php echo $booking_id; ?>)</h2>

    <!-- Payment Summary -->
    <div class="table-card" style="padding:20px; margin-bottom:30px;">
        <p><strong>Total Cost:</strong> ₱<?php echo number_format($booking['total_cost'],2); ?></p>
        <p><strong>Total Paid:</strong> ₱<?php echo number_format($total_paid,2); ?></p>
        <p><strong>Balance:</strong> ₱<?php echo number_format($balance,2); ?></p>
    </div>

    <!-- Error Message -->
    <?php if (!empty($message)) { ?>
        <p id="form-message"><?php echo $message; ?></p>
    <?php } ?>

    <!-- Payment Form -->
    <form method="post" id="client-form">

        <label class="form-label">Amount Paid</label>
        <input type="number"
               name="amount_paid"
               step="0.01"
               min="0.01"
               class="form-input"
               required>

        <br><br>

        <label class="form-label">Method</label>
        <select name="method" class="form-input">
            <option value="CASH">CASH</option>
            <option value="GCASH">GCASH</option>
            <option value="CARD">CARD</option>
        </select>

        <div class="form-actions">
            <a href="bookings_list.php" id="cancel-btn">Cancel</a>
            <button type="submit" name="pay" id="submit-btn">
                Save Payment
            </button>
        </div>

    </form>

</div>

</body>
</html>