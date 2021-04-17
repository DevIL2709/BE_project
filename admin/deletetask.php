<?php
session_start();
error_reporting(0);
if(isset($_SESSION['admin']) && $_SESSION['admin']==true) {
require_once "../functions/database_functions.php";
$ID = $_POST['delete'];

$conn = db_connect();



$query = "DELETE FROM tasks WHERE ID=$ID";
$result = mysqli_query($conn, $query);

if(!$result) {
    echo "<script>
			alert('Error in deleting task. Please try again!');
			window.location.href='./task.php';
		  </script>";
}
else {
    echo "<script>
			alert('Task deleted successfully!');
			window.location.href='./task.php';
		  </script>";
}
}
else {
	header("Location: ../index.php");
}
?>