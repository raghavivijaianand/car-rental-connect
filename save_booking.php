<?php

include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $car = $_POST["car"];
    $pickupDate = $_POST["pickup_date"];
    $returnDate = $_POST["return_date"];
    $pickupLocation = $_POST["pickup_location"];
    $dropLocation = $_POST["drop_location"];
    $distance = $_POST["distance"];
    $totalAmount = $_POST["total_amount"];

    $sql = "INSERT INTO bookings
    (name, phone, car, pickup_date, return_date, pickup_location, drop_location, distance, total_amount)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $statement = $conn->prepare($sql);

    $statement->bind_param(
        "sssssssid",
        $name,
        $phone,
        $car,
        $pickupDate,
        $returnDate,
        $pickupLocation,
        $dropLocation,
        $distance,
        $totalAmount
    );

    $statement->execute();

    header("Location: confirmation.html");
    exit();
}

?>