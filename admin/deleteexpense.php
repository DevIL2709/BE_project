<?php
session_start();
if(isset($_SESSION['admin']) && $_SESSION['admin']==true) {
require_once "../functions/database_functions.php";
$id = $_POST['delete'];

$conn = db_connect();

$query = "DELETE FROM expense WHERE ID=$id";
$result = mysqli_query($conn, $query);

if(!$result) {
    echo "<script>
			alert('Error in deleting data. Please try again!');
			window.location.href='./expense.php';
		  </script>";
}
else {
    echo "<script>
			alert('Data deleted successfully!');
			window.location.href='./expense.php';
		  </script>";
}
}
else {
	header("Location: ../index.php");
}
?>