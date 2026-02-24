<?php 
$current = basename($_SERVER['PHP_SELF']);
?>

<nav>
  <div class="nav-container">
    <div class="logo">
      <a href="/assessment_beginner/index.php">Booking Service</a>
    </div>

    <div class="nav-links">
      <a href="/assessment_beginner/index.php" class="<?= $current == 'index.php' ? 'active' : '' ?>">Dashboard</a>
      <a href="/assessment_beginner/pages/clients_list.php" class="<?= $current == 'clients_list.php' ? 'active' : '' ?>">Clients</a>
      <a href="/assessment_beginner/pages/services_list.php" class="<?= $current == 'services_list.php' ? 'active' : '' ?>">Services</a>
      <a href="/assessment_beginner/pages/bookings_list.php" class="<?= $current == 'bookings_list.php' ? 'active' : '' ?>">Bookings</a>
      <a href="/assessment_beginner/pages/tools_list_assign.php" class="<?= $current == 'tools_list_assign.php' ? 'active' : '' ?>">Tools</a>
      <a href="/assessment_beginner/pages/payments_list.php" class="<?= $current == 'payments_list.php' ? 'active' : '' ?>">Payments</a>
    </div>
  </div>
</nav>