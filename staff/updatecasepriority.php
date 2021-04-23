<?php
session_start();
error_reporting(0);
if(isset($_SESSION['staff']) && $_SESSION['staff']==true) {
  require_once "../functions/database_functions.php";
  $conn = db_connect();
  $id = trim($_POST['id']);
  $priority = $_POST['selectedValue'];

  $conn = db_connect();

  if($priority == "NORMAL") {
    $prioritynumber = 2;
  }
  elseif($priority == "HIGH PRIORITY") {
    $prioritynumber = 1;
  }
  else {
    $prioritynumber =3;
  }

  $query = "UPDATE cases SET priority='$priority', prioritynumber='$prioritynumber' WHERE ID='$id'";
  $result = mysqli_query($conn, $query);
  header('Content-type: application/json');
  echo json_encode($result);
}
else {
  header("Location: ../index.php");
}
?>