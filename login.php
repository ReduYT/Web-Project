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
    $email = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT id, password FROM users WHERE email = ?";
    $statement = $conn->prepare($sql);
    $statement->bind_param("s", $email);
    $statement->execute();
    $result = $statement->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        echo "Password entered: " . ($password) . "<br>";
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            header("Location: secondthoughts.html");
            exit();
        } else {
            echo "Invalid email or password!";
        }
    } else {
        echo "No user found with that email.";
    }

    $statement->close();
}

$conn->close();
?>
