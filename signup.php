<?php
session_start();
require_once "./functions/database_functions.php";
$username = trim($_POST['username']);
$email = trim($_POST['email']);
$role = trim($_POST['role']);
$password = trim($_POST['password']);

$conn = db_connect();

$password = sha1($password);

$query = "INSERT INTO users(username, email, password, role) VALUES ('$username', '$email', '$password', '$role');";
$result = mysqli_query($conn, $query);

if(!$result) {
    echo "<script>alert('Insertion Failed. Please retry!')</script>";
}

else {
    echo "<script>alert('Successfully registered!')</script>";
    header('Location: index.php');
}
?>