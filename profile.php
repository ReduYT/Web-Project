<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "Mysql123[]";
$dbname = "chill_escapades";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT fullname, email FROM users WHERE id = ?";
$statement = $conn->prepare($sql);
$statement->bind_param("i", $user_id);
$statement->execute();
$result = $statement->get_result();
$user = $result->fetch_assoc();
$statement->close();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm-password'];

    if (!empty($password) && $password !== $confirm_password) {
        echo "Passwords do not match!";
        exit;
    }

    $sql = "UPDATE users SET fullname = ?, email = ?";
    if (!empty($password)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql .= ", password = ?";
    }
    $sql .= " WHERE id = ?";

    $statement = $conn->prepare($sql);
    if (!empty($password)) {
        $statement->bind_param("sssi", $fullname, $email, $hashed_password, $user_id);
    } else {
        $statement->bind_param("ssi", $fullname, $email, $user_id);
    }

    if ($statement->execute()) {
        echo "Profile updated successfully!";
    } else {
        echo "Error: " . $statement->error;
    }

    $statement->close();
}

$conn->close();
?>
