<?php
require_once "../PHPMailer/src/Exception.php";
require_once "../PHPMailer/src/PHPMailer.php";
require_once "../PHPMailer/src/SMTP.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
session_start();
error_reporting(0);
if(isset($_SESSION['admin']) && $_SESSION['admin']==true) {
  require_once "../functions/database_functions.php";
  $conn = db_connect();
  $query1 = "SELECT * FROM clients";
  $query2 = "SELECT * FROM cases";
  $query3 = "SELECT * FROM appointment WHERE STATUS='OPEN' OR STATUS='POSTPONED'";
  $query4 = "SELECT * FROM tasks WHERE STATUS='ASSIGNED' OR STATUS='IN-PROGRESS'";
  $clients = mysqli_query($conn, $query1);
  $clients = mysqli_fetch_all($clients);
  $cases = mysqli_query($conn, $query2);
  $cases = mysqli_fetch_all($cases);
  $appointment = mysqli_query($conn, $query3);
  $appointment = mysqli_fetch_all($appointment);
  $tasks = mysqli_query($conn, $query4);
  $tasks = mysqli_fetch_all($tasks);

  //case query for dashboard
  $casequery1 = "SELECT * FROM cases WHERE hearingdate >= CURDATE() ORDER BY hearingdate LIMIT 5";
  $casequery = mysqli_query($conn, $casequery1);

  //task query for dashboard
  $taskquery1 = "SELECT * FROM tasks WHERE deadline >= CURDATE() ORDER BY deadline LIMIT 5";
  $taskquery = mysqli_query($conn, $taskquery1);

  //appointment query for dashboard
  $appointmentquery1 = "SELECT * FROM appointment WHERE date >= CURDATE() ORDER BY date LIMIT 5";
  $appointmentquery = mysqli_query($conn, $appointmentquery1);

  //casenotif query
  $casenotifquery = "SELECT clientname, hearingdate FROM cases WHERE hearingdate >= CURDATE() ORDER BY hearingdate LIMIT 1";
  $casenotifresult = mysqli_query($conn, $casenotifquery);
  $casenotifresult = mysqli_fetch_assoc($casenotifresult);

  //tasknotif query
  $tasknotifquery = "SELECT related, deadline FROM tasks WHERE deadline >= CURDATE() ORDER BY deadline LIMIT 1";
  $tasknotifquery = mysqli_query($conn, $tasknotifquery);
  $tasknotifresult = mysqli_fetch_assoc($tasknotifquery);

  //appnotif query
  $appnotifquery = "SELECT cname, date, time FROM appointment WHERE date >= CURDATE() ORDER BY date LIMIT 1";
  $appnotifquery = mysqli_query($conn, $appnotifquery);
  $appnotifresult = mysqli_fetch_assoc($appnotifquery);

  $clientemailidquery = "SELECT email FROM clients, cases WHERE name = (SELECT clientname FROM cases WHERE hearingdate >= CURDATE() ORDER BY hearingdate LIMIT 1)";
  $clientemailid = mysqli_query($conn, $clientemailidquery);
  $clientemailid = mysqli_fetch_assoc($clientemailid);
  $clientemailid = $clientemailid['email'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Software for Advocates
  </title>
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="../assets/css/material-dashboard.css?v=2.1.2" rel="stylesheet" />
</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="purple" data-background-color="white">
      <div class="logo"><a href="#" class="simple-text logo-normal">
          Software for Advocates
        </a></div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="nav-item active  ">
            <a class="nav-link" href="./dashboard.php">
              <i class="material-icons">dashboard</i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="./client.php">
              <i class="material-icons">person_add</i>
              <p>Clients</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="./cases.php">
              <i class="material-icons">gavel</i>
              <p>Case</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="./task.php">
              <i class="material-icons">add_task</i>
              <p>Task</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="./appointment.php">
              <i class="material-icons">event</i>
              <p>Appointment</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="./teammembers.php">
              <i class="material-icons">groups</i>
              <p>Team members</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="./income.php">
              <i class="material-icons">money</i>
              <p>Income</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="./expense.php">
              <i class="material-icons">monetization_on</i>
              <p>Expense</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="./settings.php">
              <i class="material-icons">settings</i>
              <p>Settings</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <a class="navbar-brand" href="./dashboard.php">Dashboard</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end">
            <form class="navbar-form">
              <div class="input-group no-border">
                <input type="text" value="" class="form-control" placeholder="Search...">
                <button type="submit" class="btn btn-white btn-round btn-just-icon">
                  <i class="material-icons">search</i>
                  <div class="ripple-container"></div>
                </button>
              </div>
            </form>
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="./dashboard.php">
                  <i class="material-icons">dashboard</i>
                  <p class="d-lg-none d-md-block">
                    Dashboard
                  </p>
                </a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="material-icons">notifications</i>
                  <span class="notification">3</span>
                  <p class="d-lg-none d-md-block">
                    Notifications
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="#">Your next hearing date is: <?php echo $casenotifresult['hearingdate']; ?> for client: <?php echo $casenotifresult['clientname']; ?></a>
                  <a class="dropdown-item" href="#">Task assigned to: <?php echo $tasknotifresult['related']; ?> is due on: <?php echo $tasknotifresult['deadline']; ?></a>
                  <a class="dropdown-item" href="#">You have an appointment with: <?php echo $appnotifresult['cname']; ?> on date: <?php echo $appnotifresult['date']; ?> and time: <?php echo $appnotifresult['time']; ?></a>
                </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link" href="javascript:;" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="material-icons">person</i>
                  <p class="d-lg-none d-md-block">
                    Account
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                  <a class="dropdown-item" href="./profile.php">Profile</a>
                  <a class="dropdown-item" href="./settings.php">Settings</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="../logout.php">Log out</a>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
            <a href="./client.php">
              <div class="card card-stats">
                <div class="card-header card-header-warning card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">groups</i>
                  </div>
                  <p class="card-category">Clients</p>
                  <h3 class="card-title"><?php echo COUNT($clients) ?></h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                      Total Clients
                  </div>
                </div>
              </div>
            </a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
            <a href="./cases.php">
              <div class="card card-stats">
                <div class="card-header card-header-success card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">gavel</i>
                  </div>
                  <p class="card-category">Cases</p>
                  <h3 class="card-title"><?php echo COUNT($cases)?></h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    Total Cases
                  </div>
                </div>
              </div>
            </a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
            <a href="./appointment.php">
              <div class="card card-stats">
                <div class="card-header card-header-danger card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">book_online</i>
                  </div>
                  <p class="card-category">Appointments</p>
                  <h3 class="card-title"><?php echo COUNT($appointment)?></h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    Total Appointments Pending
                  </div>
                </div>
              </div>
            </a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
            <a href="./task.php">
              <div class="card card-stats">
                <div class="card-header card-header-info card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">task</i>
                  </div>
                  <p class="card-category">Tasks Pending</p>
                  <h3 class="card-title"><?php echo COUNT($tasks) ?></h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    Total Tasks Pending
                  </div>
                </div>
              </div>
            </div>
          </a>
          </div>
          <div class="row">
            <div class="col-lg-12 col-md-12">
              <div class="card">
                <div class="card-header card-header-tabs card-header-primary">
                  <div class="nav-tabs-navigation">
                    <div class="nav-tabs-wrapper">
                      <ul class="nav nav-tabs" data-tabs="tabs">
                        <li class="nav-item">
                          <a class="nav-link active" href="#cases" data-toggle="tab">
                            <i class="material-icons">gavel</i> Cases
                            <div class="ripple-container"></div>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#tasks" data-toggle="tab">
                            <i class="material-icons">task</i> Tasks
                            <div class="ripple-container"></div>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#appointments" data-toggle="tab">
                            <i class="material-icons">book_online</i> Appointments
                            <div class="ripple-container"></div>
                          </a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <div class="tab-content">
                    <div class="tab-pane active" id="cases">
                      <table class="table">
                      <tbody>
                        <thead class="text-primary">
                          <td>Client Name</td>
                          <td>Case Type</td>
                          <td>Date</td>
                        </thead>
                        <?php while($caseresult = mysqli_fetch_assoc($casequery)): ?>
                          <tr>
                            <td><?php echo $caseresult['clientname']; ?></td>
                            <td><?php echo $caseresult['casetype']; ?></td>
                            <td><?php echo $caseresult['hearingdate']; ?></td>
                          </tr>
                        <?php endwhile; ?>
                        </tbody>
                      </table>
                    </div>
                    <div class="tab-pane" id="tasks">
                      <table class="table">
                        <thead class="text-primary">
                          <td>Task Name</td>
                          <td>Assigned To</td>
                          <td>Deadline</td>
                        </thead>
                        <?php while($taskresult = mysqli_fetch_assoc($taskquery)): ?>
                          <tr>
                            <td><?php echo $taskresult['taskname']; ?></td>
                            <td><?php echo $taskresult['assto']; ?></td>
                            <td><?php echo $taskresult['deadline']; ?></td>
                          </tr>
                        <?php endwhile; ?>
                        </tbody>
                      </table>
                    </div>
                    <div class="tab-pane" id="appointments">
                      <table class="table">
                        <thead class="text-primary">
                          <td>Client Name</td>
                          <td>Mobile Number</td>
                          <td>Subject</td>
                          <td>Date</td>
                          <td>Time</td>
                        </thead>
                        <?php while($appointmentresult = mysqli_fetch_assoc($appointmentquery)): ?>
                          <tr>
                            <td><?php echo $appointmentresult['cname']; ?></td>
                            <td><?php echo $appointmentresult['mobno']; ?></td>
                            <td><?php echo $appointmentresult['subject']; ?></td>
                            <td><?php echo $appointmentresult['date']; ?></td>
                            <td><?php echo $appointmentresult['time']; ?></td>
                          </tr>
                        <?php endwhile; ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <footer class="footer">
        <div class="container-fluid">
          <nav class="float-left">
            <ul>
              <li>
                <a>
                  Software for Advocates
                </a>
              </li>
            </ul>
          </nav>
          <div class="copyright float-right">
            &copy;
            <script>
              document.write(new Date().getFullYear())
            </script>, made with <i class="material-icons">favorite</i> by
            Luy, Yash, Neha for a better web.
          </div>
        </div>
      </footer>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/jquery.min.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap-material-design.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!-- Plugin for the momentJs  -->
  <script src="../assets/js/plugins/moment.min.js"></script>
  <!--  Plugin for Sweet Alert -->
  <script src="../assets/js/plugins/sweetalert2.js"></script>
  <!-- Forms Validations Plugin -->
  <script src="../assets/js/plugins/jquery.validate.min.js"></script>
  <!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
  <script src="../assets/js/plugins/jquery.bootstrap-wizard.js"></script>
  <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
  <script src="../assets/js/plugins/bootstrap-datetimepicker.min.js"></script>
  <!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
  <script src="../assets/js/plugins/jquery.dataTables.min.js"></script>
  <!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
  <script src="../assets/js/plugins/bootstrap-tagsinput.js"></script>
  <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
  <script src="../assets/js/plugins/jasny-bootstrap.min.js"></script>
  <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
  <script src="../assets/js/plugins/fullcalendar.min.js"></script>
  <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
  <script src="../assets/js/plugins/jquery-jvectormap.js"></script>
  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="../assets/js/plugins/nouislider.min.js"></script>
  <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
  <!-- Library for adding dinamically elements -->
  <script src="../assets/js/plugins/arrive.min.js"></script>
  <!-- Chartist JS -->
  <script src="../assets/js/plugins/chartist.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="../assets/js/plugins/bootstrap-notify.js"></script>
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      md.initDashboardPageCharts();

    });
  </script>
</body>

</html>
<?php 
// if(COUNT($casenotifresult)>0) {
  
//   // Instantiation and passing `true` enables exceptions
//   $mail  = new PHPMailer(true);
//   $email = 'softwareforadv@gmail.com';
//   $body  = 'Your next hearing date is: '. $casenotifresult['hearingdate'] .' for client: '. $casenotifresult['clientname'];
//   try {
//     //Server settings
//     $mail->SMTPDebug = 0;                      // Enable verbose debug output
//     $mail->isSMTP();                                            // Send using SMTP
//     $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
//     $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
//     $mail->Username   = 'softwareforadv@gmail.com';                     // SMTP username
//     $mail->Password   = 'ABC@1234';                               // SMTP password
//     $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
//     $mail->Port       = 587;                                    // TCP port to connect to

//     //Recipients
//     $mail->setFrom($email);
//     $mail->addAddress($email);
//     $mail->addCC($clientemailid);

//     // Content
//     $mail->isHTML(true);                                  // Set email format to HTML
//     $mail->Subject = 'Case Reminder';
//     $mail->Body    = $body;

//     $mail->send();
//   } catch (Exception $e) {
//     echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
//   }
// }
}
else {
  header("Location: ../index.php");
}
?>