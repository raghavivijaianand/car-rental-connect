<?php

include "db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name = trim($_POST["name"] ?? "");
    $phone = trim($_POST["phone"] ?? "");
    $car = trim($_POST["car"] ?? "");
    $pickupDate = $_POST["pickup_date"] ?? "";
    $returnDate = $_POST["return_date"] ?? "";
    $pickupLocation = trim($_POST["pickup_location"] ?? "");
    $dropLocation = trim($_POST["drop_location"] ?? "");
    $distance = filter_input(INPUT_POST, "distance", FILTER_VALIDATE_INT);

    /* Car rate server-la fixed-a irukkum */
    $carRates = [
        "Maruti Swift" => 12,
        "Hyundai Creta" => 15,
        "Toyota Innova" => 18
    ];

    if (
        $name === "" || $phone === "" || $pickupDate === "" ||
        $returnDate === "" || $pickupLocation === "" ||
        $dropLocation === "" || $distance === false || $distance <= 0 ||
        !array_key_exists($car, $carRates)
    ) {
        die("Invalid booking details. Please go back and try again.");
    }

    if (strtotime($returnDate) < strtotime($pickupDate)) {
        die("Return date must be after pickup date.");
    }

    /*
      Important:
      Browser-la irundhu total_amount edukkala.
      Server dhaan correct amount calculate pannudhu.
    */
    $baseCharge = 500;
    $perKmRate = $carRates[$car];
    $totalAmount = $baseCharge + ($distance * $perKmRate);

    $sql = "INSERT INTO bookings
    (name, phone, car, pickup_date, return_date, pickup_location, drop_location, distance, total_amount)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $statement = $conn->prepare($sql);

    if (!$statement) {
        die("Booking could not be saved.");
    }

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
    $statement->close();

    header("Location: confirmation.html");
    exit();
}
?>