<?php
session_start();
if(isset($_SESSION['admin']) && $_SESSION['admin']==true) {
  require_once "../functions/database_functions.php";
  $conn = db_connect();
  $query = "SELECT * from appointment";
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
  <style>
    .select {
      font-size: 16px;
      position: relative;
      display: inline-block;
      margin-left: 30%;
    }
    .select select {
      outline: none;
      /* -webkit-appearance: none; */
      display: block;
      padding: 0.5em 5em 0.5em 0.5em;
      margin: 0;

      transition: border-color 0.2s;
      border: 2px solid #822c9c;
      border-radius: 5px;

      background: #fff;
      color: #555;
      line-height: normal;
      font-family: inherit;
      font-size: inherit;
      line-height: inherit;
    }
    .select .arr {
      background: #fff;
      position: absolute;
      right: 5px;
      top: 1.5em;
      width: 50px;
      pointer-events: none;
    }
    .select .arr:before {
      content: '';
      position: absolute;
      top: 50%;
      right: 24px;
      margin-top: -5px;
      pointer-events: none;
      border-top: 10px solid #822c9c;
      border-left: 10px solid transparent;
      border-right: 10px solid transparent;
    }

    .select .arr:after {
      content: '';
      position: absolute;
      top: 50%;
      right: 28px;
      margin-top: -5px;
      pointer-events: none;
      border-top: 6px solid #fff;
      border-left: 6px solid transparent;
      border-right: 6px solid transparent;
    }
  </style>
</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="purple" data-background-color="white">
      <div class="logo"><a href="#" class="simple-text logo-normal">
          Software for Advocates
        </a></div>
      <div class="sidebar-wrapper">
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
          <li class="nav-item active ">
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
            <a class="navbar-brand">Appointment</a>
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
                <input type="text" id="search" name="search" class="form-control" placeholder="Search..." onkeyup="searchItem()">
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
                  <a class="dropdown-item" href="#">Your next hearing date is: <?php echo $casenotifresult['hearingdate']; ?> for client: <?php echo $casenotifresult['clientname']; ?></a>
                  <a class="dropdown-item" href="#">Task assigned to: <?php echo $tasknotifresult['assto']; ?> is due on: <?php echo $tasknotifresult['deadline']; ?></a>
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
        <div class="row justify-content-end">
            <div class="col-2">
              <a href="./addappointment.php" class="btn btn-primary" role="button">Add Appointment</a>
            </div>  
          </div>  
          <div class="row">
            <div class="col-lg-12 col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Appointments</h4>
                  <p class="card-category">Total Appointments</p>
                </div>
                <div class="card-body table-responsive">
                  <table class="table table-hover" id="myTable">
                    <thead class="text-primary">
                      <th>No.</th>
                      <th>Client Name</th>
                      <th>Mobile</th>
                      <th>Date</th>
                      <th>Time</th>
                      <th>Subject</th>
                      <th>Status</th>
                      <th>Action</th>
                    </thead>
                    <tbody>
                    <?php while($array = mysqli_fetch_assoc($result)): ?>
                      <tr>
                        <td><?php echo $array['ID']; ?></td>
                        <td><?php echo $array['cname']; ?></td>
                        <td><?php echo $array['mobno']; ?></td>
                        <td><?php echo $array['date']; ?></td>
                        <td><?php echo $array['time']; ?></td>
                        <td><?php echo $array['subject']; ?></td>
                        <td>
                          <?php if($array['status']=='OPEN') { ?>
                          <button type="button" class="btn btn-success" onclick="fetchstatus(<?php echo $array['ID']?>);">
                          <?php echo $array['status']; ?>
                          </button>
                          <?php } else if($array['status']=='CLOSED') { ?>
                          <button type="button" class="btn btn-default" onclick="fetchstatus(<?php echo $array['ID']?>)">
                          <?php echo $array['status']; ?>
                          </button>
                          <?php } else if($array['status']=='CANCELLED') { ?>
                          <button type="button" class="btn btn-danger" onclick="fetchstatus(<?php echo $array['ID']?>)">
                          <?php echo $array['status']; ?>
                          </button>
                          <?php } else if($array['status']=='POSTPONED') { ?>
                          <button type="button" class="btn btn-warning" onclick="fetchstatus(<?php echo $array['ID']?>)">
                          <?php echo $array['status']; ?>
                          </button>
                          <?php } ?>
                          <div class="modal fade" id="updatestatus" tabindex="-1" data-id="<?php echo $array['ID']; ?>">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title">Update status</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <form method="post">
                                  <div class="select">
                                  <span class="arr"></span>
                                  <select for="status" id="status" name="status" onchange="showdiv()">
                                    <option>CANCELLED</option>
                                    <option>OPEN</option>
                                    <option>CLOSED</option>
                                    <option>POSTPONED</option>
                                  </select>
                                  <div class="row">
                                  <div class="form-group" id="date" style="display:none">
                                    <label for="date" class="ml-3 mt-3">Date</label>
                                    <br>
                                    <input type="date" class="form-control ml-3" name="date" id="date1" value="<?php echo $array['date'] ?>">
                                  </div>
                                  </div>
                                  <div class="row">
                                  <div class="form-group" id="time" style="display:none">
                                    <label for="time" class="ml-3 mt-3">Time</label>
                                    <br>
                                    <input type="time" class="form-control ml-3" name="time" id="time1" value="<?php echo $array['time'] ?>">
                                  </div>
                                  </div>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  <button type="button" class="btn btn-primary" name='submit' id="submit">Save changes</button>
                                </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td class="td-actions text-middle">
                          <div class='row'>
                          <div class='col-1 form-group'>
                          <form method= "post" action ="./editappointment.php">
                            <button type="submit" rel="tooltip" class="btn btn-info" name='edit' value="<?php echo $array['ID']; ?>">
                                <i class="material-icons">edit</i>
                            </button>
                          </form>
                          </div>
                          </div>
                        </td>
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
      <footer class="footer">
        <div class="container-fluid">
          <nav class="float-left">
            <ul>
              <li>
                <a>
                  Software for Advocates
                </a>
              </li>
              <li>
                <a href="#">
                  About Us
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <!-- Plugin for the momentJs  -->
  <script src="../assets/js/plugins/moment.min.js"></script>
  <!--  Plugin for Sweet Alert -->
  <script src="../assets/js/plugins/sweetalert2.js"></script>
  <!-- Forms Validations Plugin -->
  <script src="../assets/js/plugins/jquery.validate.min.js"></script>
  <!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
  <script src="../assets/js/plugins/jquery.bootstrap-wizard.js"></script>
  <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
  <!-- <script src="../assets/js/plugins/bootstrap-selectpicker.js"></script>    -->
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
  
    $(document).ready(function(){

    // Search all columns
    $('#search').keyup(function(){
      // Search Text
      var search = $(this).val();

      // Hide all table tbody rows
      $('table tbody tr').hide();

      // Count total search result
      var len = $('table tbody tr:not(.notfound) td:contains("'+search+'")').length;

      if(len > 0){
        // Searching text in columns and show match row
        $('table tbody tr:not(.notfound) td:contains("'+search+'")').each(function(){
          $(this).closest('tr').show();
        });
      }else{
        $('.notfound').show();
      }

    });
    // Case-insensitive searching (Note - remove the below script for Case sensitive search )
    $.expr[":"].contains = $.expr.createPseudo(function(arg) {
      return function( elem ) {
        return $(elem).text().toUpperCase().indexOf(arg.toUpperCase()) >= 0;
      };
    });
    });


  console.log("here");
  function fetchstatus(id){
    console.log(id);
    $(document).ready(function(){
      $.get("fetchappointmentstatus.php?id="+id, function(data, status){
        jQuery.noConflict();
        console.log("Data: " + data + "\nStatus: " + status);
        $("#updatestatus").modal('show');
        if(data == "CANCELLED") {
            console.log(data);
            $("#status").prop("selectedIndex", 0);
            $("#submit").val(id);
        }
        if(data == "OPEN") {
            console.log(data);
            $("#status").prop("selectedIndex", 1);
            $("#submit").val(id);
        }
        if(data == "CLOSED") {
            console.log(data);
            $("#status").prop("selectedIndex", 2);
            $("#submit").val(id);
        }
        if(data == "POSTPONED") {
            console.log(data);
            $("#status").prop("selectedIndex", 3);
            $("#submit").val(id);
        }
      });     
    });
  }

  $(document).ready(function(){
    $("#submit").on('click', function(){
      let id = $("#submit").val();
      var selectedStatusValue = $('#status').find(":selected").text();
      var selectedDateValue = document.getElementById("date1").value;
      var selectedTimeValue = document.getElementById("time1").value;
      console.log(id + " " + selectedStatusValue);
      $.post("updateappointmentstatus.php", {
        "id": id,
        "selectedStatusValue": selectedStatusValue,
        "selectedDateValue": selectedDateValue,
        "selectedTimeValue": selectedTimeValue,
      }, function(result){
        console.log(result);
        if(result) {
          alert("Updated status successfully!");
          $("#updatestatus").modal('hide');
          location.reload();
        }
        else {
          alert("Error in updating. Please try again later!");
          $("#updatestatus").modal('hide');
        }
      });
    });
  });

    function showdiv(){
      var status = document.getElementById("status").value;
      if(status=="POSTPONED") {
        document.getElementById("date").style.display = "block";
        document.getElementById("time").style.display = "block";
      }
    }
  </script>
</body>

</html>
<?php
}
else {
  header("Location: ../index.php");
}
?>