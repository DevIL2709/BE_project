<?php
session_start();
error_reporting(0);
if(isset($_SESSION['assistant']) && $_SESSION['assistant']==true) {
  require_once "../functions/database_functions.php";
  $conn = db_connect();
  $id = $_GET['id'];
  $query = "SELECT status FROM appointment WHERE ID='$id'";
  $result = mysqli_query($conn, $query);
  $result = mysqli_fetch_all($result);
//   print_r($result);
//   header('Access-Control-Allow-Origin: *');
  header('Content-type: application/json');
  echo json_encode($result);
}
?>