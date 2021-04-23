<?php
session_start();
error_reporting(0);
require_once "./functions/database_functions.php";
$username = trim($_POST['username']);
$password = trim($_POST['password']);

$conn = db_connect();

if($username == "" OR $password == ""){
	echo "<script>
			alert('Username or Password empty!');
			window.location.href='index.php';
  		  </script>";
}

$username = mysqli_real_escape_string($conn, $username);
$password = mysqli_real_escape_string($conn, $password);
$password = sha1($password);

$_SESSION['user'] = $username;



$query = "SELECT username, password, role FROM users WHERE username='$username'";
$result = mysqli_query($conn, $query);
if(!$result){
	echo "<script>alert('Empty data');
			window.location.href='index.php';
	 	  </script>;";
}
$row = mysqli_fetch_assoc($result);
$role = $row['role'];
if($username != $row['username'] OR $password != $row['password']){
	echo "<script>
			alert('Username and Password Mismatch. Please fill again!');
			window.location.href='index.php';
		  </script>";
	$_SESSION['admin'] = false;
}

else if($username == $row['username'] AND $password == $row['password'] AND $role == 'admin' OR $role == 'Admin'){
	$_SESSION['admin'] = true;
	header("Location: admin/dashboard.php");
}

else if($username == $row['username'] AND $password == $row['password'] AND $role == 'staff' OR $role == 'Staff' OR $role == 'STAFF'){
    $_SESSION['staff'] = true;
	header("Location: staff/dashboard.php");
}   

else if($username == $row['username'] AND $password == $row['password'] AND $role == 'assistant' OR $role == 'Assistant' OR $role == 'ASSISTANT'){
    $_SESSION['assistant'] = true;
	header("Location: assistant/dashboard.php");
}   
?>