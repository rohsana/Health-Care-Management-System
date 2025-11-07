<!DOCTYPE html>
<?php
include('func1.php');
$con = mysqli_connect("localhost", "root", "", "myhmsdb");

// Dummy Session Data (replace later with actual login)
$_SESSION['doctor_id'] = "DOC123";
$_SESSION['doctor_name'] = "Dr. John Doe";
$_SESSION['doctor_email'] = "dr.john@example.com";
$_SESSION['specialization'] = "Cardiology";
?>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Doctor Panel - Ethicure</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
  <a class="navbar-brand" href="#"><i class="fa fa-user-md"></i> Ethicure Doctor Panel</a>
  <div class="collapse navbar-collapse" id="navbarContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item"><a class="nav-link" href="logout1.php"><i class="fa fa-sign-out"></i> Logout</a></li>
    </ul>
    <form class="form-inline" method="post" action="search.php">
      <input class="form-control mr-sm-2" type="text" placeholder="Search Patient" name="contact">
      <input type="submit" class="btn btn-light" name="search_submit" value="Search">
    </form>
  </div>
</nav>

<div class="container-fluid mt-5 pt-4">
  <h4 class="text-center">Welcome, <?php echo htmlspecialchars($_SESSION['doctor_name']); ?></h4>
  <div class="row mt-4">
    <div class="col-md-3">
      <div class="list-group" id="list-tab">
        <a class="list-group-item list-group-item-action active" id="list-dashboard" data-toggle="list" href="#dashboard">Dashboard</a>
        <a class="list-group-item list-group-item-action" id="list-appointments" data-toggle="list" href="#appointments">Appointments</a>
        <a class="list-group-item list-group-item-action" id="list-prescriptions" data-toggle="list" href="#prescriptions">Prescriptions</a>
        <a class="list-group-item list-group-item-action" id="list-profile" data-toggle="list" href="#profile">Doctor Profile</a>
      </div>
    </div>

    <div class="col-md-9">
      <div class="tab-content">
        <div class="tab-pane fade show active" id="dashboard">
          <h5>Dashboard</h5><p>Select a section to manage appointments or view profile.</p>
        </div>

        <div class="tab-pane fade" id="appointments">
          <h5>Appointments</h5>
          <table class="table table-bordered">
            <thead><tr><th>Patient ID</th><th>Name</th><th>Date</th><th>Time</th><th>Status</th></tr></thead>
            <tbody><!-- Appointment rows go here --></tbody>
          </table>
        </div>

        <div class="tab-pane fade" id="prescriptions">
          <h5>Prescriptions</h5>
          <table class="table table-bordered">
            <thead><tr><th>Patient ID</th><th>Disease</th><th>Allergy</th><th>Prescription</th><th>Date</th></tr></thead>
            <tbody><!-- Prescription rows go here --></tbody>
          </table>
        </div>

        <div class="tab-pane fade" id="profile">
          <h5>Doctor Profile</h5>
          <table class="table table-bordered w-75">
            <tr><th>Doctor ID</th><td><?php echo htmlspecialchars($_SESSION['doctor_id']); ?></td></tr>
            <tr><th>Name</th><td><?php echo htmlspecialchars($_SESSION['doctor_name']); ?></td></tr>
            <tr><th>Email</th><td><?php echo htmlspecialchars($_SESSION['doctor_email']); ?></td></tr>
            <tr><th>Specialization</th><td><?php echo htmlspecialchars($_SESSION['specialization']); ?></td></tr>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
</body>
</html>
