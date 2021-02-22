<?php
session_start();
if(isset($_SESSION['admin']) && $_SESSION['admin']==true) {
require_once "../functions/database_functions.php";
$ID = $_POST['delete'];

$conn = db_connect();

$query = "DELETE FROM cases WHERE ID=$ID";
$result = mysqli_query($conn, $query);

if(!$result) {
    echo "<script>
			alert('Error in deleting case. Please try again!');
			window.location.href='./cases.php';
		  </script>";
}
else {
    echo "<script>
			alert('Case deleted successfully!');
			window.location.href='./cases.php';
		  </script>";
}
}
else {
	header("Location: ../index.php");
}
?>