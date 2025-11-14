<!DOCTYPE html>
<?php
include('func1.php');
$con = mysqli_connect("localhost","root","","myhmsdb");
$doctor = $_SESSION['dname'] ?? '';

// cancel appointment (doctor)
if (isset($_GET['cancel'])) {
    $query = mysqli_query($con, "UPDATE appointmenttb SET doctorStatus='0' WHERE ID = '" . $_GET['ID'] . "'");
    if ($query) echo "<script>alert('Your appointment successfully cancelled');</script>";
}
?>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="style.css">
<link rel="shortcut icon" type="image/x-icon" href="images/favicon.png" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css">
<link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans&display=swap" rel="stylesheet">
<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
  <a class="navbar-brand" href="#"><i class="fa fa-user-plus"></i> Ethicure</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"><span class="navbar-toggler-icon"></span></button>
  <style>.bg-primary{background:-webkit-linear-gradient(left,#3931af,#00c6ff)} .list-group-item.active{z-index:2;color:#fff;background:#342ac1;border-color:#007bff}.text-primary{color:#342ac1!important} .btn-outline-light:hover{color:#25bef7;background:#f8f9fa;border-color:#f8f9fa} button:hover{cursor:pointer} #inputbtn:hover{cursor:pointer}</style>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto"><li class="nav-item"><a class="nav-link" href="logout1.php"><i class="fa fa-sign-out"></i>Logout</a></li></ul>
    <form class="form-inline my-2 my-lg-0" method="post" action="search.php"><input class="form-control mr-sm-2" type="text" placeholder="Enter contact number" name="contact"><input type="submit" class="btn btn-outline-light" id="inputbtn" name="search_submit" value="Search"></form>
  </div>
</nav>
</head>
<body style="padding-top:50px;">
<div class="container-fluid" style="margin-top:50px;">
  <h3 style="margin-left:40%;padding-bottom:20px;font-family:'IBM Plex Sans',sans-serif;"> Welcome &nbsp;<?php echo htmlspecialchars($_SESSION['dname'] ?? '', ENT_QUOTES); ?></h3>
  <div class="row">
    <div class="col-md-4" style="max-width:18%;margin-top:3%;">
      <div class="list-group" id="list-tab" role="tablist">
        <a class="list-group-item list-group-item-action active" href="#list-dash" data-toggle="list">Dashboard</a>
        <a class="list-group-item list-group-item-action" href="#list-app" id="list-app-list" data-toggle="list">Appointments</a>
        <a class="list-group-item list-group-item-action" href="#list-pres" id="list-pres-list" data-toggle="list">Prescription List</a>
      </div><br>
    </div>

    <div class="col-md-8" style="margin-top:3%;">
      <div class="tab-content" id="nav-tabContent" style="width:950px;">

        <!-- Dashboard -->
        <div class="tab-pane fade show active" id="list-dash">
          <div class="container-fluid container-fullw bg-white">
            <div class="row">
              <div class="col-sm-4" style="left:10%">
                <div class="panel panel-white no-radius text-center"><div class="panel-body">
                  <span class="fa-stack fa-2x"><i class="fa fa-square fa-stack-2x text-primary"></i><i class="fa fa-list fa-stack-1x fa-inverse"></i></span>
                  <h4 class="StepTitle" style="margin-top:5%;">View Appointments</h4>
                  <p class="links cl-effect-1"><a href="#list-app" onclick="document.getElementById('list-app-list').click();">Appointment List</a></p>
                </div></div>
              </div>
              <div class="col-sm-4" style="left:15%">
                <div class="panel panel-white no-radius text-center"><div class="panel-body">
                  <span class="fa-stack fa-2x"><i class="fa fa-square fa-stack-2x text-primary"></i><i class="fa fa-list-ul fa-stack-1x fa-inverse"></i></span>
                  <h4 class="StepTitle" style="margin-top:5%;">Prescriptions</h4>
                  <p class="links cl-effect-1"><a href="#list-pres" onclick="document.getElementById('list-pres-list').click();">Prescription List</a></p>
                </div></div>
              </div>
            </div>
          </div>
        </div>

        <!-- APPOINTMENTS (doctor-specific) -->
        <div class="tab-pane fade" id="list-app">
          <table class="table table-hover"><thead><tr>
            <th>Patient ID</th><th>Appointment ID</th><th>First Name</th><th>Last Name</th><th>Gender</th><th>Email</th><th>Contact</th>
            <th>Date</th><th>Time</th><th>Current Status</th><th>Action</th><th>Prescribe</th>
          </tr></thead>
          <tbody>
          <?php
            $dname = $doctor;
            $q = "SELECT pid,ID,fname,lname,gender,email,contact,appdate,apptime,userStatus,doctorStatus FROM appointmenttb WHERE doctor='" . mysqli_real_escape_string($con,$dname) . "';";
            $res = mysqli_query($con,$q);
            while ($r = mysqli_fetch_array($res)) {
              $status = ($r['userStatus']==1 && $r['doctorStatus']==1) ? "Active" : (($r['userStatus']==0 && $r['doctorStatus']==1) ? "Cancelled by Patient" : "Cancelled by You");
              echo "<tr><td>{$r['pid']}</td><td>{$r['ID']}</td><td>{$r['fname']}</td><td>{$r['lname']}</td><td>{$r['gender']}</td><td>{$r['email']}</td><td>{$r['contact']}</td><td>{$r['appdate']}</td><td>{$r['apptime']}</td><td>$status</td><td>";
              if ($r['userStatus']==1 && $r['doctorStatus']==1) { echo "<a href=\"doctor-panel.php?ID={$r['ID']}&cancel=update\" onclick=\"return confirm('Are you sure you want to cancel this appointment ?')\"><button class=\"btn btn-danger\">Cancel</button></a>"; } else { echo "Cancelled"; }
              echo "</td><td>";
              if ($r['userStatus']==1 && $r['doctorStatus']==1) echo "<a href=\"prescribe.php?pid={$r['pid']}&ID={$r['ID']}&fname={$r['fname']}&lname={$r['lname']}&appdate={$r['appdate']}&apptime={$r['apptime']}\"><button class=\"btn btn-success\">Prescibe</button></a>";
              else echo "-";
              echo "</td></tr>";
            }
          ?>
          </tbody></table>
        </div>

        <!-- PRESCRIPTIONS for this doctor -->
        <div class="tab-pane fade" id="list-pres">
          <table class="table table-hover"><thead><tr>
            <th>Patient ID</th><th>First Name</th><th>Last Name</th><th>Appointment ID</th><th>Date</th><th>Time</th><th>Disease</th><th>Allergy</th><th>Prescribe</th>
          </tr></thead><tbody>
          <?php
            $q2 = "SELECT pid,fname,lname,ID,appdate,apptime,disease,allergy,prescription FROM prestb WHERE doctor='" . mysqli_real_escape_string($con,$doctor) . "';";
            $res2 = mysqli_query($con,$q2);
            if (!$res2) echo "<tr><td colspan='9'>".mysqli_error($con)."</td></tr>";
            while ($p = mysqli_fetch_array($res2)) {
              echo "<tr><td>{$p['pid']}</td><td>{$p['fname']}</td><td>{$p['lname']}</td><td>{$p['ID']}</td><td>{$p['appdate']}</td><td>{$p['apptime']}</td><td>{$p['disease']}</td><td>{$p['allergy']}</td><td>{$p['prescription']}</td></tr>";
            }
          ?>
          </tbody></table>
        </div>

        <!-- ALL APPOINTMENTS (full list) -->
        <div class="tab-pane fade" id="list-app-all">
          <table class="table table-hover"><thead><tr><th>First Name</th><th>Last Name</th><th>Email</th><th>Contact</th><th>Doctor</th><th>Fees</th><th>Date</th><th>Time</th></tr></thead><tbody>
          <?php
            $q3 = "SELECT fname,lname,email,contact,doctor,docFees,appdate,apptime FROM appointmenttb;";
            $r3 = mysqli_query($con,$q3);
            while ($a = mysqli_fetch_array($r3)) echo "<tr><td>{$a['fname']}</td><td>{$a['lname']}</td><td>{$a['email']}</td><td>{$a['contact']}</td><td>{$a['doctor']}</td><td>{$a['docFees']}</td><td>{$a['appdate']}</td><td>{$a['apptime']}</td></tr>";
          ?>
          </tbody></table>
        </div>

      </div>
    </div>
  </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.1/sweetalert2.all.min.js"></script>
</body>
</html>
