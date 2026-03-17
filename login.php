<?php
session_start();

// If already logged in, redirect to index
if (isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Static admin login
    if ($username === "admin" && $password === "admin") {
        $_SESSION['username'] = "ADMIN";
        header("Location: index.php");
        exit();
    } else {
        $error = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="/assessment_beginner/style.css">
</head>
<body>

<div class="login-card">
    <h2>Login</h2>

    <?php if ($error != ""): ?>
        <p class="error-message"><?php echo $error; ?></p>
    <?php endif; ?>

    <form method="POST">
        <label class="form-label" for="username">Username:</label>
        <input class="form-input" type="text" name="username" id="username" required>

        <label class="form-label" for="password">Password:</label>
        <input class="form-input" type="password" name="password" id="password" required>

        <button class="btn-primary" type="submit">Login</button>
    </form>
</div>

</body>
</html>