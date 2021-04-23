<?php
session_start();
error_reporting(0);
if(isset($_SESSION['staff']) && $_SESSION['staff']==true) {
  require_once "../functions/database_functions.php";
  $conn = db_connect();
  $id = $_GET['id'];
  $query = "SELECT status FROM cases WHERE ID='$id'";
  $result = mysqli_query($conn, $query);
  $result = mysqli_fetch_all($result);
//   print_r($result);
//   header('Access-Control-Allow-Origin: *');
  header('Content-type: application/json');
  echo json_encode($result);
}
?>