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
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

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

    $stmt = $conn->prepare($sql);
    if (!empty($password)) {
        $stmt->bind_param("sssi", $fullname, $email, $hashed_password, $user_id);
    } else {
        $stmt->bind_param("ssi", $fullname, $email, $user_id);
    }

    if ($stmt->execute()) {
        echo "Profile updated successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
