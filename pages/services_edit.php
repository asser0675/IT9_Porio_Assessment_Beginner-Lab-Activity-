<?php
include "../db.php";
$id = $_GET['id'];
 
$get = mysqli_query($conn, "SELECT * FROM services WHERE service_id = $id");
$service = mysqli_fetch_assoc($get);
 
if (isset($_POST['update'])) {
  $name = $_POST['service_name'];
  $desc = $_POST['description'];
  $rate = $_POST['hourly_rate'];
  $active = $_POST['is_active'];
 
  mysqli_query($conn, "UPDATE services
    SET service_name='$name', description='$desc', hourly_rate='$rate', is_active='$active'
    WHERE service_id=$id");
 
  header("Location: services_list.php");
  exit;
}
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8"><title>Edit Service</title>
  <link rel="stylesheet" href="/assessment_beginner/style.css">
<body>
<?php include "../nav.php"; ?>
 
<h2>Edit Service</h2>

<form method="post">
    <label>Service Name</label>
    <input type="text" name="service_name" value="<?php echo $service['service_name']; ?>">

    <label>Description</label>
    <textarea name="description" rows="4"><?php echo $service['description']; ?></textarea>

    <label>Hourly Rate</label>
    <input type="text" name="hourly_rate" value="<?php echo $service['hourly_rate']; ?>">

    <label>Active</label>
    <select name="is_active">
        <option value="1" <?php if($service['is_active']==1) echo "selected"; ?>>Yes</option>
        <option value="0" <?php if($service['is_active']==0) echo "selected"; ?>>No</option>
    </select>

    <div class="form-actions">
        <button type="button" id="cancel-btn" onclick="window.location='services_list.php'">Cancel</button>
        <button type="submit" name="update" id="submit-btn">Update</button>
    </div>
</form>
</body>
</html>