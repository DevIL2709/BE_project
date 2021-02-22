<?php
session_start();
if(isset($_SESSION['admin']) && $_SESSION['admin']==true) {
  require_once "../functions/database_functions.php";
  $conn = db_connect();
  $id = trim($_POST['id']);
  $status = $_POST['selectedStatusValue'];
  $date = $_POST['selectedDateValue'];
  $time = $_POST['selectedTimeValue'];
  $conn = db_connect();

  $query = "UPDATE appointment SET status='$status', date='$date', time='$time' WHERE ID='$id'";
  $result = mysqli_query($conn, $query);
  header('Content-type: application/json');
  echo json_encode($result);
}
else {
  header("Location: ../index.php");
}
?>