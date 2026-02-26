<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "../db.php";

$message = "";

if (isset($_POST['assign'])) {

    $booking_id = (int)$_POST['booking_id'];
    $tool_id    = (int)$_POST['tool_id'];
    $qty        = (int)$_POST['qty_used'];

    $toolResult = mysqli_query($conn, 
        "SELECT quantity_available FROM tools WHERE tool_id = $tool_id"
    );

    if ($toolResult && mysqli_num_rows($toolResult) > 0) {

        $toolRow = mysqli_fetch_assoc($toolResult);

        if ($qty > $toolRow['quantity_available']) {
            $message = "Not enough available tools!";
        } else {

            mysqli_query($conn, 
                "INSERT INTO booking_tools (booking_id, tool_id, qty_used)
                 VALUES ($booking_id, $tool_id, $qty)"
            );

            mysqli_query($conn,
                "UPDATE tools 
                 SET quantity_available = quantity_available - $qty
                 WHERE tool_id = $tool_id"
            );

            $message = "Tool assigned successfully!";
        }

    } else {
        $message = "Tool not found.";
    }
}


$tools = mysqli_query($conn, 
    "SELECT * FROM tools ORDER BY tool_name ASC"
);

$bookings = mysqli_query($conn, 
    "SELECT booking_id FROM bookings ORDER BY booking_id DESC"
);
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Tools / Inventory</title>

<link rel="stylesheet" href="../style.css">

</head>
<body>

<?php include "../nav.php"; ?>

<div class="container">

    <h2>Tools / Inventory</h2>

    <?php if (!empty($message)) { ?>
        <p id="form-message"><?php echo $message; ?></p>
    <?php } ?>

    <div class="table-card">
        <table class="modern-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Total</th>
                    <th>Available</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($tools && mysqli_num_rows($tools) > 0) { ?>
                    <?php while($t = mysqli_fetch_assoc($tools)) { ?>
                        <tr>
                            <td><?php echo $t['tool_name']; ?></td>
                            <td><?php echo $t['quantity_total']; ?></td>
                            <td><?php echo $t['quantity_available']; ?></td>
                        </tr>
                    <?php } ?>
                <?php } else { ?>
                    <tr>
                        <td colspan="3">No tools found.</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <br><br>

    <h2>Assign Tool to Booking</h2>

    <form method="post" id="client-form">

        <label class="form-label">Booking ID</label>
        <select name="booking_id" class="form-input" required>
            <?php if ($bookings && mysqli_num_rows($bookings) > 0) { ?>
                <?php while($b = mysqli_fetch_assoc($bookings)) { ?>
                    <option value="<?php echo $b['booking_id']; ?>">
                        #<?php echo $b['booking_id']; ?>
                    </option>
                <?php } ?>
            <?php } else { ?>
                <option disabled>No bookings available</option>
            <?php } ?>
        </select>

        <br><br>

        <label class="form-label">Tool</label>
        <select name="tool_id" class="form-input" required>
            <?php
            $tools2 = mysqli_query($conn, 
                "SELECT * FROM tools ORDER BY tool_name ASC"
            );

            if ($tools2 && mysqli_num_rows($tools2) > 0) {
                while($t2 = mysqli_fetch_assoc($tools2)) {
            ?>
                <option value="<?php echo $t2['tool_id']; ?>">
                    <?php echo $t2['tool_name']; ?> 
                    (Avail: <?php echo $t2['quantity_available']; ?>)
                </option>
            <?php
                }
            } else {
                echo "<option disabled>No tools available</option>";
            }
            ?>
        </select>

        <br><br>

        <label class="form-label">Quantity Used</label>
        <input type="number" 
               name="qty_used" 
               min="1" 
               value="1" 
               class="form-input" 
               required>

        <div class="form-actions">
            <button type="submit" name="assign" id="submit-btn">
                Assign Tool
            </button>
        </div>

    </form>

</div>

</body>
</html>