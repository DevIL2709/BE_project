<?php
require_once "../functions/database_functions.php";
if(isset($_POST['submit'])) {
  $id = $_POST['submit'];
  $cname = $_POST['cname'];
  $mobno = trim($_POST['mobno']);
  $date = trim($_POST['date']);
  $time = trim($_POST['time']);
  $subject = trim($_POST['subject']);

  $conn = db_connect();

  $query = "UPDATE appointment SET cname='$cname', mobno='$mobno', date='$date', time='$time', subject='$subject' WHERE ID='$id'";
  $result = mysqli_query($conn, $query);

  if(!$result) {
      echo mysqli_error($conn);
  }
  
  else {
      echo "<script>alert('Appointment successfully rescheduled!');
			window.location.href='./appointment.php';
		  </script>";
  }
}
?>