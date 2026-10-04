<?php
session_set_cookie_params([
    "httponly" => true,
    "samesite" => "Lax"
]);

session_start();

if (!isset($_SESSION["admin_logged_in"])) {
    header("Location: login.php");
    exit();
}

include "db.php";

$statement = $conn->prepare("SELECT * FROM bookings ORDER BY id DESC");
$statement->execute();
$result = $statement->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Admin Bookings - CarRent Connect</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <h1>Admin Booking Details</h1>
    <p class="subtitle">Bookings saved in MySQL Database</p>

    <div style="background:white; max-width:1200px; margin:30px auto; padding:25px; border-radius:12px; box-shadow:0 2px 10px gray; overflow-x:auto;">

        <table border="1" cellpadding="10" style="width:100%; border-collapse:collapse;">
            <tr>
                <th>ID</th>
                <th>Customer</th>
                <th>Phone</th>
                <th>Car</th>
                <th>Pickup</th>
                <th>Drop</th>
                <th>Distance</th>
                <th>Total</th>
            </tr>

            <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo htmlspecialchars($row["id"]); ?></td>
                <td><?php echo htmlspecialchars($row["name"]); ?></td>
                <td><?php echo htmlspecialchars($row["phone"]); ?></td>
                <td><?php echo htmlspecialchars($row["car"]); ?></td>
                <td><?php echo htmlspecialchars($row["pickup_location"]); ?></td>
                <td><?php echo htmlspecialchars($row["drop_location"]); ?></td>
                <td><?php echo htmlspecialchars($row["distance"]); ?> KM</td>
                <td>₹<?php echo htmlspecialchars($row["total_amount"]); ?></td>
            </tr>
            <?php } ?>
        </table>

        <br>

        <a href="logout.php" class="book-btn">Logout</a>
        <a href="index.html" class="book-btn">Back to Home</a>

    </div>

</body>
</html>