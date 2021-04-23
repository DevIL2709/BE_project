<?php
session_start();
error_reporting(0);
if(isset($_SESSION['assistant']) && $_SESSION['assistant']==true) {
    require_once "../functions/database_functions.php";
    $conn = db_connect();
    
}
else{
    header("Location: ../index.php");
}
?>