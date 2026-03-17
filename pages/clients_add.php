  <?php
  include "../db.php";
  
  $message = "";
  
  if (isset($_POST['save'])) {
    $full_name = $_POST['Name'];
    $email = $_POST['Email'];
    $IdNumber = $_POST['IdNumber'];
    $course = $_POST['course'];
  
    if ($full_name == "" || $email == "") {
      $message = "Name and Email are required!";
    } else {
      $sql = "INSERT INTO clients (IdNumber, Name, Email, Course)
              VALUES ('$IdNumber', '$full_name', '$email', '$course')";
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
    <input type="text" name="Name" class="form-input"><br><br>
  
    <label class="form-label">Email*</label><br>
    <input type="text" name="Email" class="form-input"><br><br>

    <label class="form-label">ID Number*</label><br>
    <input type="text" name="IdNumber" class="form-input"><br><br>

    <label class="form-label">Course</label><br>
    <input type="text" name="course" class="form-input"><br><br>

    <div class="form-actions">
      <button type="button" id="cancel-btn" onclick="window.location.href='clients_list.php'">Cancel</button>
      <button type="submit" name="save" id="submit-btn">Save</button>
    </div>
  </form>

  </body>
  </html>