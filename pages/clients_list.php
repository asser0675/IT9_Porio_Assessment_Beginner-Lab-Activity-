<?php
include "../db.php";
$result = mysqli_query($conn, "SELECT * FROM clients ORDER BY client_id DESC");
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Clients</title>
  <link rel="stylesheet" href="/assessment_beginner/style.css">
</head>
<body>

<?php include "../nav.php"; ?>

<div class="container">

  <div class="page-header">
    <h2>Clients</h2>
    <a href="clients_add.php" class="btn-primary">+ Add Client</a>
  </div>

  <div class="table-card">
    <table class="modern-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php while($row = mysqli_fetch_assoc($result)) { ?>
          <tr>
            <td><?php echo $row['client_id']; ?></td>
            <td><?php echo $row['full_name']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['phone']; ?></td>
            <td>
              <a href="clients_edit.php?id=<?php echo $row['client_id']; ?>" class="btn-edit">Edit</a>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>

</div>

</body>
</html>