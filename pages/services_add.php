<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Add Service</title>
  <link rel="stylesheet" href="/assessment_beginner/style.css">
</head>
<body>

<?php include "../nav.php"; ?>

<h2 id="page-title">Add Service</h2>

<div id="service-form">

  <p id="service-message"><?php echo $message; ?></p>

  <form method="post">

    <label class="form-label">Service Name*</label>
    <input type="text" name="service_name" class="form-input">

    <label class="form-label">Description</label>
    <textarea name="description" rows="4" class="form-textarea"></textarea>

    <label class="form-label">Hourly Rate (₱)*</label>
    <input type="text" name="hourly_rate" class="form-input">

    <label class="form-label">Active?</label>
    <select name="is_active" class="form-select">
      <option value="1">Yes</option>
      <option value="0">No</option>
    </select>

    <div class="form-actions">
      <a href="services_list.php">
        <button type="button" id="cancel-btn">Cancel</button>
      </a>

      <button type="submit" name="save" id="submit-btn">
        Save Service
      </button>
    </div>

  </form>

</div>

</body>
</html>