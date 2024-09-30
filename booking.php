<?php
$servername = "localhost";
$username = "root";
$password = "Mysql123[]";
$dbname = "chill_escapades";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $firstName = $_POST['firstName'];
    $destination = $_POST['tour'];
    $travel_date = $_POST['departure'];
    $num_people = $_POST['num_people'];
    $total_price = $_POST['total_price'];

    $userQuery = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $userQuery->bind_param("s", $email);
    $userQuery->execute();
    $userQuery->bind_result($user_id);
    $userQuery->fetch();
    $userQuery->close();

    if ($user_id) {
        $sql = "INSERT INTO bookings (user_id, destination, travel_date, num_people, total_price, booking_date) VALUES (?, ?, ?, ?, ?, NOW())";
        $statement = $conn->prepare($sql);
        $statement->bind_param("issid", $user_id, $destination, $travel_date, $num_people, $total_price);

        if ($statement->execute()) {
            echo "Booking successful! Your booking to $destination for $num_people people on $travel_date has been confirmed.";
        } else {
            echo "Error: " . $statement->error;
        }

        $statement->close();
    } else {
        echo "User not found. Please register before booking.";
    }
}

$conn->close();
?>
