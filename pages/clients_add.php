  <?php
  include "../db.php";
  
  $message = "";
  
  if (isset($_POST['save'])) {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
  
    if ($full_name == "" || $email == "") {
      $message = "Name and Email are required!";
    } else {
      $sql = "INSERT INTO clients (full_name, email, phone, address)
              VALUES ('$full_name', '$email', '$phone', '$address')";
      mysqli_query($conn, $sql);
      header("Location: clients_list.php");
      exit;
    }
  }
  ?>
  <!doctype html>
  <html>
  <head>
    <meta charset="utf-8">
    <title>Add Client</title>
    <link rel="stylesheet" href="/assessment_beginner/style.css">
  </head>
  <body>

  <?php include "../nav.php"; ?>
  
  <h2 id="page-title">Add Client</h2>

  <p id="form-message"><?php echo $message; ?></p>
  
  <form method="post" id="client-form">
    
    <label class="form-label">Full Name*</label><br>
    <input type="text" name="full_name" class="form-input"><br><br>
  
    <label class="form-label">Email*</label><br>
    <input type="text" name="email" class="form-input"><br><br>
  
    <label class="form-label">Phone</label><br>
    <input type="text" name="phone" class="form-input"><br><br>
  
    <label class="form-label">Address</label><br>
    <input type="text" name="address" class="form-input"><br><br>

    <div class="form-actions">
      <button type="button" id="cancel-btn" onclick="window.location.href='clients_list.php'">Cancel</button>
      <button type="submit" name="save" id="submit-btn">Save</button>
    </div>
  </form>

  </body>
  </html>