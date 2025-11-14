<!DOCTYPE html>
<?php
// admin-panel1.php (condensed)
// kept original behaviour; single-file version
$con = mysqli_connect("localhost","root","","myhmsdb");
include('newfunc.php');

// Add doctor
if (isset($_POST['docsub'])) {
    $doctor = $_POST['doctor'] ?? '';
    $dpassword = $_POST['dpassword'] ?? '';
    $demail = $_POST['demail'] ?? '';
    $spec = $_POST['special'] ?? '';
    $docFees = $_POST['docFees'] ?? '';
    $query = "INSERT INTO doctb(username,password,email,spec,docFees) VALUES('$doctor','$dpassword','$demail','$spec','$docFees')";
    $result = mysqli_query($con, $query);
    if ($result) echo "<script>alert('Doctor added successfully!');</script>";
}

// Delete doctor
if (isset($_POST['docsub1'])) {
    $demail = $_POST['demail'] ?? '';
    $query = "DELETE FROM doctb WHERE email='$demail'";
    $result = mysqli_query($con, $query);
    if ($result) echo "<script>alert('Doctor removed successfully!');</script>";
    else echo "<script>alert('Unable to delete!');</script>";
}
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans&display=swap" rel="stylesheet">
    <!-- single Bootstrap include -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
      <a class="navbar-brand" href="#"><i class="fa fa-user-plus" aria-hidden="true"></i> Ethicure</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
        <span class="navbar-toggler-icon"></span>
      </button>
      <script>
        function check() {
          var p = document.getElementById('dpassword').value;
          var c = document.getElementById('cdpassword').value;
          var msg = document.getElementById('message');
          if (p === c) { msg.style.color = '#5dd05d'; msg.innerHTML = 'Matched'; }
          else { msg.style.color = '#f55252'; msg.innerHTML = 'Not Matching'; }
        }
        function alphaOnly(e){ var k = e.keyCode; return ((k>=65&&k<=90)||k==8||k==32); }
      </script>
      <style>
        .bg-primary{background:-webkit-linear-gradient(left,#3931af,#00c6ff);}
        .list-group-item.active{z-index:2;color:#fff;background:#342ac1;border-color:#007bff;}
        .text-primary{color:#342ac1!important}.btn-primary{background:#3c50c1;border-color:#3c50c1}
        button:hover{cursor:pointer} #inputbtn:hover{cursor:pointer} .col-md-4{max-width:20%!important}
        #cpass{display:-webkit-box} #list-app{font-size:15px}
      </style>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item"><a class="nav-link" href="logout1.php"><i class="fa fa-sign-out"></i> Logout</a></li>
        </ul>
      </div>
    </nav>
  </head>
  <body style="padding-top:50px;">
   <div class="container-fluid" style="margin-top:50px;">
    <h3 style="margin-left:40%;padding-bottom:20px;font-family:'IBM Plex Sans',sans-serif;">WELCOME RECEPTIONIST</h3>
    <div class="row">
      <div class="col-md-4" style="max-width:25%;margin-top:3%;">
        <div class="list-group" id="list-tab" role="tablist">
          <a class="list-group-item list-group-item-action active" id="list-dash-list" data-toggle="list" href="#list-dash">Dashboard</a>
          <a class="list-group-item list-group-item-action" href="#list-doc" id="list-doc-list" data-toggle="list">Doctor List</a>
          <a class="list-group-item list-group-item-action" href="#list-pat" id="list-pat-list" data-toggle="list">Patient List</a>
          <a class="list-group-item list-group-item-action" href="#list-app" id="list-app-list" data-toggle="list">Appointment Details</a>
          <a class="list-group-item list-group-item-action" href="#list-pres" id="list-pres-list" data-toggle="list">Prescription List</a>
          <a class="list-group-item list-group-item-action" href="#list-settings" id="list-adoc-list" data-toggle="list">Add Doctor</a>
          <a class="list-group-item list-group-item-action" href="#list-settings1" id="list-ddoc-list" data-toggle="list">Delete Doctor</a>
          <a class="list-group-item list-group-item-action" href="#list-mes" id="list-mes-list" data-toggle="list">Queries</a>
        </div><br>
      </div>

      <div class="col-md-8" style="margin-top:3%;">
        <div class="tab-content" id="nav-tabContent" style="width:950px;">

          <!-- DASHBOARD -->
          <div class="tab-pane fade show active" id="list-dash">
            <div class="container-fluid container-fullw bg-white">
              <div class="row">
                <div class="col-sm-4">
                  <div class="panel panel-white no-radius text-center"><div class="panel-body">
                    <span class="fa-stack fa-2x"><i class="fa fa-square fa-stack-2x text-primary"></i><i class="fa fa-users fa-stack-1x fa-inverse"></i></span>
                    <h4 class="StepTitle" style="margin-top:5%;">Doctor List</h4>
                    <p class="links cl-effect-1"><a href="#list-doc" onclick="document.getElementById('list-doc-list').click();">View Doctors</a></p>
                  </div></div>
                </div>

                <div class="col-sm-4" style="left:-3%"><div class="panel panel-white no-radius text-center"><div class="panel-body">
                    <span class="fa-stack fa-2x"><i class="fa fa-square fa-stack-2x text-primary"></i><i class="fa fa-users fa-stack-1x fa-inverse"></i></span>
                    <h4 class="StepTitle" style="margin-top:5%;">Patient List</h4>
                    <p class="cl-effect-1"><a href="#app-hist" onclick="document.getElementById('list-pat-list').click();">View Patients</a></p>
                </div></div></div>

                <div class="col-sm-4"><div class="panel panel-white no-radius text-center"><div class="panel-body">
                    <span class="fa-stack fa-2x"><i class="fa fa-square fa-stack-2x text-primary"></i><i class="fa fa-paperclip fa-stack-1x fa-inverse"></i></span>
                    <h4 class="StepTitle" style="margin-top:5%;">Appointment Details</h4>
                    <p class="cl-effect-1"><a href="#app-hist" onclick="document.getElementById('list-app-list').click();">View Appointments</a></p>
                </div></div></div>
              </div>

              <div class="row mt-4">
                <div class="col-sm-4" style="left:13%;"><div class="panel panel-white no-radius text-center"><div class="panel-body">
                  <span class="fa-stack fa-2x"><i class="fa fa-square fa-stack-2x text-primary"></i><i class="fa fa-list-ul fa-stack-1x fa-inverse"></i></span>
                  <h4 class="StepTitle" style="margin-top:5%;">Prescription List</h4>
                  <p class="cl-effect-1"><a href="#list-pres" onclick="document.getElementById('list-pres-list').click();">View Prescriptions</a></p>
                </div></div></div>

                <div class="col-sm-4" style="left:18%;"><div class="panel panel-white no-radius text-center"><div class="panel-body">
                  <span class="fa-stack fa-2x"><i class="fa fa-square fa-stack-2x text-primary"></i><i class="fa fa-plus fa-stack-1x fa-inverse"></i></span>
                  <h4 class="StepTitle" style="margin-top:5%;">Manage Doctors</h4>
                  <p class="cl-effect-1"><a href="#app-hist" onclick="document.getElementById('list-adoc-list').click();">Add Doctors</a> &nbsp;|&nbsp; <a href="#app-hist" onclick="document.getElementById('list-ddoc-list').click();">Delete Doctors</a></p>
                </div></div></div>
              </div>
            </div>
          </div>

          <!-- DOCTOR LIST -->
          <div class="tab-pane fade" id="list-doc">
            <div class="col-md-8">
              <form action="doctorsearch.php" method="post" class="form-group row">
                <div class="col-md-10"><input type="text" name="doctor_contact" class="form-control" placeholder="Enter Email ID"></div>
                <div class="col-md-2"><input type="submit" name="doctor_search_submit" class="btn btn-primary" value="Search"></div>
              </form>
            </div>
            <table class="table table-hover"><thead><tr><th>Doctor Name</th><th>Specialization</th><th>Email</th><th>Password</th><th>Fees</th></tr></thead><tbody>
            <?php
              $query = "SELECT * FROM doctb";
              $result = mysqli_query($con,$query);
              while ($row = mysqli_fetch_array($result)){
                echo "<tr><td>{$row['username']}</td><td>{$row['spec']}</td><td>{$row['email']}</td><td>{$row['password']}</td><td>{$row['docFees']}</td></tr>";
              }
            ?>
            </tbody></table>
          </div>

          <!-- PATIENT LIST -->
          <div class="tab-pane fade" id="list-pat">
            <div class="col-md-8">
              <form action="patientsearch.php" method="post" class="form-group row">
                <div class="col-md-10"><input type="text" name="patient_contact" class="form-control" placeholder="Enter Contact"></div>
                <div class="col-md-2"><input type="submit" name="patient_search_submit" class="btn btn-primary" value="Search"></div>
              </form>
            </div>
            <table class="table table-hover"><thead><tr><th>Patient ID</th><th>First Name</th><th>Last Name</th><th>Gender</th><th>Email</th><th>Contact</th><th>Password</th></tr></thead><tbody>
            <?php
              $query = "SELECT * FROM patreg";
              $result = mysqli_query($con,$query);
              while ($row = mysqli_fetch_array($result)){
                echo "<tr><td>{$row['pid']}</td><td>{$row['fname']}</td><td>{$row['lname']}</td><td>{$row['gender']}</td><td>{$row['email']}</td><td>{$row['contact']}</td><td>{$row['password']}</td></tr>";
              }
            ?>
            </tbody></table>
          </div>

          <!-- PRESCRIPTIONS -->
          <div class="tab-pane fade" id="list-pres">
            <table class="table table-hover"><thead><tr><th>Doctor</th><th>Patient ID</th><th>Appointment ID</th><th>First Name</th><th>Last Name</th><th>Date</th><th>Time</th><th>Disease</th><th>Allergy</th><th>Prescription</th></tr></thead><tbody>
            <?php
              $query = "SELECT * FROM prestb";
              $result = mysqli_query($con,$query);
              while ($row = mysqli_fetch_array($result)){
                echo "<tr><td>{$row['doctor']}</td><td>{$row['pid']}</td><td>{$row['ID']}</td><td>{$row['fname']}</td><td>{$row['lname']}</td><td>{$row['appdate']}</td><td>{$row['apptime']}</td><td>{$row['disease']}</td><td>{$row['allergy']}</td><td>{$row['prescription']}</td></tr>";
              }
            ?>
            </tbody></table>
          </div>

          <!-- APPOINTMENTS -->
          <div class="tab-pane fade" id="list-app">
            <div class="col-md-8">
              <form action="appsearch.php" method="post" class="form-group row">
                <div class="col-md-10"><input type="text" name="app_contact" class="form-control" placeholder="Enter Contact"></div>
                <div class="col-md-2"><input type="submit" name="app_search_submit" class="btn btn-primary" value="Search"></div>
              </form>
            </div>
            <table class="table table-hover"><thead><tr><th>Appointment ID</th><th>Patient ID</th><th>First Name</th><th>Last Name</th><th>Gender</th><th>Email</th><th>Contact</th><th>Doctor</th><th>Fees</th><th>Date</th><th>Time</th><th>Status</th></tr></thead><tbody>
            <?php
              $query = "SELECT * FROM appointmenttb";
              $result = mysqli_query($con,$query);
              while ($row = mysqli_fetch_array($result)){
                $status = ($row['userStatus']==1 && $row['doctorStatus']==1) ? "Active" : (($row['userStatus']==0 && $row['doctorStatus']==1) ? "Cancelled by Patient" : "Cancelled by Doctor");
                echo "<tr><td>{$row['ID']}</td><td>{$row['pid']}</td><td>{$row['fname']}</td><td>{$row['lname']}</td><td>{$row['gender']}</td><td>{$row['email']}</td><td>{$row['contact']}</td><td>{$row['doctor']}</td><td>{$row['docFees']}</td><td>{$row['appdate']}</td><td>{$row['apptime']}</td><td>$status</td></tr>";
              }
            ?>
            </tbody></table>
          </div>

          <!-- ADD DOCTOR -->
          <div class="tab-pane fade" id="list-settings">
            <form method="post" action="admin-panel1.php" class="form-group">
              <div class="row">
                <div class="col-md-4"><label>Doctor Name:</label></div><div class="col-md-8"><input type="text" name="doctor" onkeydown="return alphaOnly(event);" class="form-control" required></div>
                <div class="col-md-4"><label>Specialization:</label></div>
                <div class="col-md-8"><select name="special" class="form-control" required><option disabled selected>Select Specialization</option><option>General</option><option>Cardiologist</option><option>Neurologist</option><option>Pediatrician</option></select></div>
                <div class="col-md-4"><label>Email ID:</label></div><div class="col-md-8"><input type="email" name="demail" class="form-control" required></div>
                <div class="col-md-4"><label>Password:</label></div><div class="col-md-8"><input type="password" id="dpassword" name="dpassword" onkeyup="check()" class="form-control" required></div>
                <div class="col-md-4"><label>Confirm Password:</label></div><div class="col-md-8" id="cpass"><input type="password" id="cdpassword" name="cdpassword" onkeyup="check()" class="form-control" required>&nbsp;&nbsp;<span id="message"></span></div>
                <div class="col-md-4"><label>Consultancy Fees:</label></div><div class="col-md-8"><input type="text" name="docFees" class="form-control" required></div>
              </div>
              <br>
              <input type="submit" name="docsub" value="Add Doctor" class="btn btn-primary">
            </form>
          </div>

          <!-- DELETE DOCTOR -->
          <div class="tab-pane fade" id="list-settings1">
            <form method="post" action="admin-panel1.php" class="form-group">
              <div class="row">
                <div class="col-md-4"><label>Email ID:</label></div><div class="col-md-8"><input type="email" name="demail" class="form-control" required></div>
              </div><br>
              <input type="submit" name="docsub1" value="Delete Doctor" class="btn btn-primary" onclick="return confirm('Do you really want to delete?')">
            </form>
          </div>

          <!-- MESSAGES -->
          <div class="tab-pane fade" id="list-mes">
            <div class="col-md-8">
              <form action="messearch.php" method="post" class="form-group row">
                <div class="col-md-10"><input type="text" name="mes_contact" placeholder="Enter Contact" class="form-control"></div>
                <div class="col-md-2"><input type="submit" name="mes_search_submit" class="btn btn-primary" value="Search"></div>
              </form>
            </div>
            <table class="table table-hover"><thead><tr><th>User Name</th><th>Email</th><th>Contact</th><th>Message</th></tr></thead><tbody>
            <?php
              $query = "SELECT * FROM contact";
              $result = mysqli_query($con,$query);
              while ($row = mysqli_fetch_array($result)){
                echo "<tr><td>{$row['name']}</td><td>{$row['email']}</td><td>{$row['contact']}</td><td>{$row['message']}</td></tr>";
              }
            ?>
            </tbody></table>
          </div>

        </div> <!-- tab-content -->
      </div> <!-- col -->
    </div> <!-- row -->
   </div> <!-- container -->

   <!-- Scripts -->
   <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.1/sweetalert2.all.min.js"></script>
  </body>
</html>
