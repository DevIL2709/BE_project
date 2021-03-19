<?php
session_start();
if(isset($_SESSION['admin']) && $_SESSION['admin']==true) {
    require_once "../functions/database_functions.php";
    $conn = db_connect();
    
}
else{
    header("Location: ../index.php");
}
?>