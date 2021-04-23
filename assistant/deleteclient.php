<?php
session_start();
error_reporting(0);
if(isset($_SESSION['assistant']) && $_SESSION['assistant']==true) {
require_once "../functions/database_functions.php";
$ID = $_POST['delete'];

$conn = db_connect();

$query = "DELETE FROM clients WHERE ID=$ID";
$result = mysqli_query($conn, $query);

$query1 = "DELETE FROM users WHERE ID=$ID";
$result1 = mysqli_query($conn, $query1);

$query2 = "DELETE FROM profile WHERE ID=$ID";
$result2 = mysqli_query($conn, $query2);

if(!$result || !$result1 || !$result2) {
    echo "<script>
			alert('Error in deleting client. Please try again!');
			window.location.href='./client.php';
		  </script>";
}
else {
    echo "<script>
			alert('Client deleted successfully!');
			window.location.href='./client.php';
		  </script>";
}
}
else {
	header("Location: ../index.php");
}
?>