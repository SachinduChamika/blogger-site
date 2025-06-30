<?php
include "./../includes/db-connection.php";

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT username, password, role_id FROM user WHERE username = '$username'";
$result = $connection->query($sql);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if ($password == $row['password']) {
        setcookie("session", $username, time() + 604800, "/");
        setcookie("session_id", $row['role_id'], time() + 604800, "/");

        header("Location: ./../index.php");
        exit();    
    } else {
        echo "<script>alert('Invalid password'); window.location.href = './login.html'; </script>";
    exit();    
    }
} else {
    echo "<script>alert('Invalid username'); window.location.href = './login.html'; </script>";
    exit();
}

$connection->close();
?>

