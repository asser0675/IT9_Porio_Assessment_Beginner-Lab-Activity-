<?php
include "../db.php";
 
$id = $_GET['IdNumber'];
 
$get = mysqli_query($conn, "SELECT * FROM clients WHERE IdNumber = '$id'");
$client = mysqli_fetch_assoc($get);
 
$message = "";
 
if (isset($_POST['update'])) {
  $full_name = $_POST['Name'];
  $email = $_POST['Email'];
  $phone = $_POST['Phone'];
  $address = $_POST['Address'];
 
  if ($full_name == "" || $email == "") {
    $message = "Name and Email are required!";
  } else {
    $sql = "UPDATE clients
            SET Name='$full_name', Email='$email', Phone='$phone', Address='$address'
            WHERE IdNumber='$id'";
    mysqli_query($conn, $sql);
    header("Location: clients_list.php");
    exit;
  }
}
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8"><title>Edit Client</title>
  <link rel="stylesheet" href="/assessment_beginner/style.css">
</head>
<body>
<?php include "../nav.php"; ?>
 
<h2 id="title">Edit Client</h2>

<form id="form" method="post">
    <p id="form-message"><?php echo $message; ?></p>

    <label>Full Name*</label>
    <input type="text" name="Name" value="<?php echo $client['Name']; ?>">

    <label>Email*</label>
    <input type="text" name="Email" value="<?php echo $client['Email']; ?>">

    <label>Phone</label>
    <input type="text" name="Phone" value="<?php echo $client['Phone']; ?>">

    <label>Address</label>
    <input type="text" name="Address" value="<?php echo $client['Address']; ?>">

    <div class="form-actions">
        <button type="button" id="cancel-btn" onclick="window.location='clients_list.php'">Cancel</button>
        <button type="submit" name="update" id="update-btn">Update</button>
    </div>
</form>
</body>
</html>