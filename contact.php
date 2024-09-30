<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "Mysql123[]";
$dbname = "chill_escapades";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = ($_POST['fullname']);
    $email = ($_POST['email']);
    $subject = ($_POST['subject']);
    $message = $_POST['message'];

    if (empty($fullname) || empty($email) || empty($subject) || empty($message)) {
        echo "Please fill in all fields.";
        exit;
    }

    $sql = "INSERT INTO contact_messages (fullname, email, subject, message) VALUES (?, ?, ?, ?)";
    $statement = $conn->prepare($sql);

    if ($statement === false) {
        die("Error preparing query: " . $conn->error); 
    }

    $statement->bind_param("ssss", $fullname, $email, $subject, $message);

    $statement->close();
}

$conn->close();
?>
