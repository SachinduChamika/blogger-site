<?php
include "./../includes/db-connection.php";

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$role_id = 2;

$sql = "INSERT INTO user (username, email, password, role_id) VALUES ('$username', '$email', '$password', '$role_id')";

if ($connection->query($sql) === TRUE) {
    header("Location: ./login.html");
    exit();
} else {
    header("Location: ./register.html");
    exit();
}

$connection->close();
?>
