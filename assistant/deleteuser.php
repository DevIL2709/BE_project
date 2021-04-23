<?php
session_start();
error_reporting(0);
if(isset($_SESSION['assistant']) && $_SESSION['assistant']==true) {
require_once "../functions/database_functions.php";
$ID = $_POST['delete'];

$conn = db_connect();



$query = "DELETE FROM users WHERE ID=$ID";
$result = mysqli_query($conn, $query);

$query1 = "DELETE FROM profile WHERE ID=$ID";
$result1 = mysqli_query($conn, $query1);

if(!$result || !$result1) {
    echo "<script>
			alert('Error in deleting user. Please try again!');
			window.location.href='./teammembers.php';
		  </script>";
}
else {
    echo "<script>
			alert('User deleted successfully!');
			window.location.href='./teammembers.php';
		  </script>";
}
}
else {
	header("Location: ../index.php");
}
?>