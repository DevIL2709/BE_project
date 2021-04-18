<?php
session_start();
error_reporting(0);
if(isset($_SESSION['admin']) && $_SESSION['admin']==true) {
  require_once "../functions/database_functions.php";
  $conn = db_connect();
  $query = "SELECT * from clients";
  $result = mysqli_query($conn, $query);
  //casenotif query
  $casenotifquery = "SELECT clientname, hearingdate FROM cases WHERE hearingdate >= CURDATE() ORDER BY hearingdate LIMIT 1";
  $casenotifresult = mysqli_query($conn, $casenotifquery);
  $casenotifresult = mysqli_fetch_assoc($casenotifresult);

  //tasknotif query
  $tasknotifquery = "SELECT assto, deadline FROM tasks WHERE deadline >= CURDATE() ORDER BY deadline LIMIT 1";
  $tasknotifquery = mysqli_query($conn, $tasknotifquery);
  $tasknotifresult = mysqli_fetch_assoc($tasknotifquery);

  //appnotif query
  $appnotifquery = "SELECT cname, date, time FROM appointment WHERE date >= CURDATE() ORDER BY date LIMIT 1";
  $appnotifquery = mysqli_query($conn, $appnotifquery);
  $appnotifresult = mysqli_fetch_assoc($appnotifquery);
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
    <div class="sidebar bg-white" data-color="purple" data-background-color="white">
      <div class="logo bg-white"><a href="#" class="simple-text logo-normal">
          Software for Advocates
        </a></div>
      <div class="sidebar-wrapper bg-white">
        <ul class="nav">
          <li class="nav-item ">
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
          <li class="nav-item active">
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
          <li class="nav-item">
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
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <a class="navbar-brand">Add Case</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end">
            <form class="navbar-form" style="display: none">
              <div class="input-group no-border">
                <input type="text" name="search" id="search" class="form-control" placeholder="Search...">
                <button type="button" class="btn btn-white btn-round btn-just-icon">
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
                    dashboard
                  </p>
                </a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="material-icons">notifications</i>
                  <span class="notification">3</span>
                  <p class="d-lg-none d-md-block">
                    notifications
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <?php if($casenotifresult == NULL) { ?>
                  <a class="dropdown-item" href="./cases.php">No Upcoming Cases</a>
                  <?php } else { ?>
                  <a class="dropdown-item" href="./cases.php">Your next hearing date is: <?php echo $casenotifresult['hearingdate']; ?> for client: <?php echo $casenotifresult['clientname']; ?></a>
                  <?php } if($tasknotifresult == NULL) { ?>
                  <a class="dropdown-item" href="./task.php">No Upcoming Tasks</a>
                  <?php } else { ?>
                  <a class="dropdown-item" href="./task.php">Task assigned to: <?php echo $tasknotifresult['assto']; ?> is due on: <?php echo $tasknotifresult['deadline']; ?></a>
                  <?php } if($appnotifresult == NULL) {?>
                  <a class="dropdown-item" href="./appointment.php">No Upcoming Appointments</a>
                  <?php } else { ?>
                  <a class="dropdown-item" href="./appointment.php">You have an appointment with: <?php echo $appnotifresult['cname']; ?> on date: <?php echo $appnotifresult['date']; ?> and time: <?php echo $appnotifresult['time']; ?></a>
                  <?php } ?>  
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
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Client Details</h4>
                </div>
                <div class="card-body">
                  <form method="post" action="<?=$_SERVER['PHP_SELF'];?>">
                    <div class="row">
                      <div class="col-md-6 col-lg-3 form-group">
                        <label for="clientname" class="text-primary">Client</label>
                        <select class="form-control" name="clientname">
                        <option></option>
                        <?php while($array = mysqli_fetch_assoc($result)): ?>
                        <option><?php echo $array['name']; ?></option>
                        <?php endwhile; ?>
                        </select>
                      </div>
                      <div class="col-md-4 col-lg-2 form-group">
                        <div class="form-check form-check-radio">
                            <label class="form-check-label text-primary">
                                <input class="form-check-input" type="radio" name="clienttype" value="petitioner" checked>
                                Petitioner
                                <span class="circle">
                                    <span class="check"></span>
                                </span>
                            </label>
                        </div>
                      </div>
                      <div class="col-md-4 col-lg-2 form-group">
                        <div class="form-check form-check-radio">
                            <label class="form-check-label text-primary">
                                <input class="form-check-input" type="radio" name="clienttype" value="respondent">
                                Respondent
                                <span class="circle">
                                    <span class="check"></span>
                                </span>
                            </label>
                        </div>
                      </div>
                    </div>
                    <div class="row"> 
                      <div class="col-md-6 col-lg-3 form-group">
                        <label for="oppositionname" class="text-primary pl-3">Opposition Name</label>
                        <input type="text" class="form-control" name="oppositionname">
                      </div>
                      <div class="col-md-6 col-lg-3 form-group">
                        <label for="oppositionadvocate" class="text-primary pl-3">Opposition Advocate</label>
                        <input type="text" class="form-control" name="oppositionadvocate">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card">
                  <div class="card-header card-header-primary">
                    <h4 class="card-title">Case Details</h4>
                  </div>
                  <div class="card-body">
                    <div class="row pt-3"> 
                      <div class="col-md-6 col-lg-3 form-group">
                        <label for="Case Number" class="text-primary pl-3">Case Number</label>
                        <input type="number" class="form-control" name="casenumber">
                      </div>
                      <div class="col-md-6 col-lg-3 form-group">
                        <label for="casetype" class="text-primary pl-3">Case Type</label>
                        <input type="text" class="form-control" name="casetype">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4 col-lg-2 form-group">
                        <label for="act" class="pt-3 text-primary pl-3">Act</label>
                        <br>
                        <input type="text" class="form-control pt-3" name="act">
                      </div>
                      <div class="col-md-4 col-lg-2 form-group">
                        <label for="filingnumber" class="pt-3 text-primary pl-3">Filing Number</label>
                        <br>
                        <input type="number" class="form-control" name="filingnumber">
                      </div>
                      <div class="col-md-4 col-lg-2 form-group">
                        <label for="filingdate" class="pt-3 text-primary pl-3">Filing Date</label>
                        <br>
                        <input type="date" class="form-control" name="filingdate">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4 col-lg-2 form-group">
                        <label for="regno" class="pt-3 text-primary pl-3">Registration Number</label>
                        <br>
                        <input type="text" class="form-control pt-3" name="regno">
                      </div>
                      <div class="col-md-4 col-lg-2 form-group">
                        <label for="regdate" class="pt-3 text-primary pl-3">Registration Date</label>
                        <br>
                        <input type="date" class="form-control" name="regdate">
                      </div>
                      <div class="col-md-4 col-lg-2 form-group">
                        <label for="hearingdate" class="pt-3 text-primary pl-3">Hearing Date</label>
                        <br>
                        <input type="date" class="form-control" name="hearingdate">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4 col-lg-2 form-group">
                        <label for="cnrno" class="pt-3 text-primary pl-3">CNR Number</label>
                        <br>
                        <input type="text" class="form-control pt-3" name="cnrno">
                      </div>
                      <div class="col-md-8 col-lg-4 form-group">
                        <label for="description" class="pt-3 text-primary pl-3">Description</label>
                        <br>
                        <input type="textarea" class="form-control" name="description">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card">
                  <div class="card-header card-header-primary">
                    <h4 class="card-title">Court Details</h4>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-4 col-lg-2 form-group">
                        <label for="courtno" class="pt-3 text-primary pl-3">Court Number</label>
                        <br>
                        <input type="number" class="form-control pt-3" name="courtno">
                      </div>
                      <div class="col-md-4 col-lg-2 form-group">
                        <label for="courttype" class="pt-3 text-primary pl-3">Court Type</label>
                        <br>
                        <input type="text" class="form-control" name="courttype">
                      </div>
                      <div class="col-md-4 col-lg-2 form-group">
                        <label for="courtname" class="pt-3 text-primary pl-3">Court</label>
                        <br>
                        <input type="text" class="form-control" name="courtname">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4 col-lg-2 form-group">
                        <label for="judgename" class="pt-3 text-primary pl-3">Judge Name</label>
                        <br>
                        <input type="text" class="form-control pt-3" name="judgename">
                      </div>
                      <div class="col-md-8 col-lg-4 form-group">
                        <label for="remarks" class="pt-3 text-primary pl-3">Remarks</label>
                        <br>
                        <input type="textarea" class="form-control" name="remarks">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
          </form>
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
  <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
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
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/material-dashboard.js?v=2.1.2" type="text/javascript"></script>
  <script>
    $(document).ready(function() {
      $().ready(function() {
        $sidebar = $('.sidebar');

        $full_page = $('.full-page');

        $sidebar_responsive = $('body > .navbar-collapse');

        window_width = $(window).width();

        fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();

        if (window_width > 767 && fixed_plugin_open == 'Dashboard') {
          if ($('.fixed-plugin .dropdown').hasClass('show-dropdown')) {
            $('.fixed-plugin .dropdown').addClass('open');
          }

        }

        $('.fixed-plugin a').click(function(event) {
          // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
          if ($(this).hasClass('switch-trigger')) {
            if (event.stopPropagation) {
              event.stopPropagation();
            } else if (window.event) {
              window.event.cancelBubble = true;
            }
          }
        });

        $('.fixed-plugin .active-color span').click(function() {
          $full_page_background = $('.full-page-background');

          $(this).siblings().removeClass('active');
          $(this).addClass('active');

          var new_color = $(this).data('color');

          if ($sidebar.length != 0) {
            $sidebar.attr('data-color', new_color);
          }

          if ($full_page.length != 0) {
            $full_page.attr('filter-color', new_color);
          }

          if ($sidebar_responsive.length != 0) {
            $sidebar_responsive.attr('data-color', new_color);
          }
        });

        $('.switch-sidebar-mini input').change(function() {
          $body = $('body');

          $input = $(this);

          if (md.misc.sidebar_mini_active == true) {
            $('body').removeClass('sidebar-mini');
            md.misc.sidebar_mini_active = false;

            $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar();

          } else {

            $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar('destroy');

            setTimeout(function() {
              $('body').addClass('sidebar-mini');

              md.misc.sidebar_mini_active = true;
            }, 300);
          }
        });
      });
    });
  </script>
</body>
</html>

<?php
if(isset($_POST['submit'])) {
  require_once "../functions/database_functions.php";
  $clientname = $_POST['clientname'];
  $clienttype = $_POST['clienttype'];
  $oppositionname = trim($_POST['oppositionname']);
  $oppositionadvocate = trim($_POST['oppositionadvocate']);
  $casenumber = trim($_POST['casenumber']);
  $casetype = trim($_POST['casetype']);
  $act = trim($_POST['act']);
  $filingnumber = trim($_POST['filingnumber']);
  $filingdate = trim($_POST['filingdate']);
  $regno = trim($_POST['regno']);
  $regdate = trim($_POST['regdate']);
  $hearingdate = trim($_POST['hearingdate']);
  $cnrno = trim($_POST['cnrno']);
  $description = trim($_POST['description']);
  $courtno = trim($_POST['courtno']);
  $courtname = trim($_POST['courtname']);
  $courttype = trim($_POST['courttype']);
  $judgename = trim($_POST['judgename']);
  $remarks = trim($_POST['remarks']);
  $status = "PRE-TRIAL";
  $priority = "NORMAL";
  $phyloc = trim($_POST['phyloc']);

  $prioritynumbers = 2;

  $conn = db_connect();
  $query = "INSERT INTO cases(ID, clientname, clienttype, oppositionname, oppositionadvocate, casenumber, casetype, act, filingnumber, filingdate, regno, 
  regdate, hearingdate, cnrno, description, courtno, courtname, courttype, judgename, remarks, status, priority, prioritynumber, phyloc) 
  VALUES('', '$clientname', '$clienttype', '$oppositionname', '$oppositionadvocate', '$casenumber', '$casetype', '$act', '$filingnumber', '$filingdate', '$regno',
  '$regdate', '$hearingdate', '$cnrno', '$description', '$courtno', '$courtname', '$courttype', '$judgename', '$remarks', '$status', '$priority', '$prioritynumber', '$phyloc');";
  $result = mysqli_query($conn, $query);

  if(!$result) {
      echo "<script>alert('Insertion Failed. Please retry!');
            window.location.href='./addcase.php';
		  </script>";
  }
  
  else {
      echo "<script>alert('Case has been successfully added!');
			window.location.href='./cases.php';
		  </script>";
  }
}
}
else {
  header("Location: ../index.php");
}
?>