<?php
$servername = "localhost";
$username = "root";
$password = "Mysql123[]";
$dbname = "chill_escapades";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $query = "SELECT * FROM bookings WHERE user_id = ?";
    $statement = $conn->prepare($query);
    $statement->bind_param("i", $user_id);
    $statement->execute();
    $result = $statement->get_result();
    
    
    $bookings = [];
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $bookings[] = $row;
        }
    }
} else { 
    $bookings = [];
}
?>

