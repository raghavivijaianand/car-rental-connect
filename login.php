<?php
session_set_cookie_params([
    "httponly" => true,
    "samesite" => "Lax"
]);

session_start();

if (isset($_SESSION["admin_logged_in"])) {
    header("Location: admin.php");
    exit();
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"] ?? "");
    $password = $_POST["password"] ?? "";

    $adminUsername = "admin";

    /* Password: Admin@123 */
    $adminPasswordHash = '$2y$10$ej5/Tq4YL7yceKYjLSlTPesQImBHuxfROVc9UqTOIhY/eJn8xRrla';

    if ($username === $adminUsername && password_verify($password, $adminPasswordHash)) {
        session_regenerate_id(true);
        $_SESSION["admin_logged_in"] = true;

        header("Location: admin.php");
        exit();
    }

    $error = "Wrong username or password.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Admin Login - CarRent Connect</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <h1>Admin Login</h1>
    <p class="subtitle">CarRent Connect Admin Panel</p>

    <form class="booking-form" method="POST" action="login.php">
        <input type="text" name="username" placeholder="Enter Username" required>
        <input type="password" name="password" placeholder="Enter Password" required>

        <button type="submit">Login</button>

        <p style="color:red;">
            <?php echo htmlspecialchars($error); ?>
        </p>

        <br>
        <a href="index.html" class="book-btn">Back to Home</a>
    </form>

</body>
</html>