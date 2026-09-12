<?php
include "db.php";

$result = $conn->query("SELECT * FROM bookings ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Admin Bookings</title>
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
        <td><?php echo $row["id"]; ?></td>
        <td><?php echo $row["name"]; ?></td>
        <td><?php echo $row["phone"]; ?></td>
        <td><?php echo $row["car"]; ?></td>
        <td><?php echo $row["pickup_location"]; ?></td>
        <td><?php echo $row["drop_location"]; ?></td>
        <td><?php echo $row["distance"]; ?> KM</td>
        <td>₹<?php echo $row["total_amount"]; ?></td>
      </tr>
      <?php } ?>

    </table>

    <br>

    <a href="index.html" class="book-btn">Back to Home</a>

  </div>

</body>
</html>