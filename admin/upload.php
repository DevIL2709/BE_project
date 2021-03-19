<?php
session_start();
if(isset($_SESSION['admin']) && $_SESSION['admin']==true) {
    require_once "../functions/database_functions.php";
    $conn = db_connect();
    if(isset($_POST['submit'])){
        $clientname = trim($_POST['in']);
        $query = "SELECT ID FROM clients WHERE name='$clientname'";
        $result = mysqli_query($conn, $query);
        $array = mysqli_fetch_assoc($result);
        $ID = $array['ID'];
        $finalarray = array();
        foreach($_FILES['files']['name'] as $key => $name){
            $newFilename = time() . "_" . $name;
            move_uploaded_file($_FILES['files']['tmp_name'][$key], 'upload/' . $newFilename);
            $location = 'upload/' . $newFilename;
            
            $temparray = $location;
            array_push($finalarray, $temparray);

            // $finalquery = mysqli_query($conn,"INSERT INTO evidence (cid, files) VALUES ('$ID', '$location')");
        }
        print_r($finalarray);
    }
    $count = 0;
    while(count($finalarray)>$count) {
        mysqli_query($conn, "INSERT INTO evidence (cid, files) VALUES ('$ID', '$finalarray[$count]')");
        $count++;
    }
}
else{
    header("Location: ../index.php");
}
?>