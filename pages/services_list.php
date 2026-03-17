<?php
include "../db.php";

/* ============================
   SOFT DELETE (Deactivate)
   ============================ */
if (isset($_GET['delete_id'])) {
  $delete_id = $_GET['delete_id'];

  // Soft delete (set is_active to 0)
  mysqli_query($conn, "UPDATE services SET is_active=0 WHERE service_id=$delete_id");

  header("Location: services_list.php");
  exit;
}

/* ============================
   FETCH ALL SERVICES
   ============================ */
$result = mysqli_query($conn, "SELECT * FROM services ORDER BY service_id DESC");
?>

<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Services</title>
  <link rel="stylesheet" href="/assessment_beginner/style.css">
</head>
<body>

<?php include "../nav.php"; ?>

<h2>Services</h2>

<p class="addbutton">
  <a href="services_add.php" class="btn-primary">+ Add Service</a>
</p>

<div class="table-card">
    <table class="modern-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Rate</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php while($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo $row['service_id']; ?></td>
                <td><?php echo $row['service_name']; ?></td>
                <td>₱<?php echo number_format($row['hourly_rate'],2); ?></td>

                <td>
                    <?php echo ($row['is_active'] == 1) ? "Active" : "Inactive"; ?>
                </td>

                <td>
                    <a href="services_edit.php?id=<?php echo $row['service_id']; ?>">Edit</a>

                    <?php if ($row['is_active'] == 1) { ?>
                        |
                        <a href="services_list.php?delete_id=<?php echo $row['service_id']; ?>"
                           onclick="return confirm('Deactivate this service?')">
                           Deactivate
                        </a>
                    <?php } ?>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

</body>
</html>