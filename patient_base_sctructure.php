<?php

// ===== Database Connection =====
$con = mysqli_connect();

class Patient {
    private $patient_id, $name, $email, $mobile_number;

    public function __construct($id = null, $name = "", $email = "", $mobile = "") {
        $this->patient_id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->mobile_number = $mobile;
    }

    // ===== Getters & Setters =====
    function getPatientID() { return $this->patient_id; }
    function getName() { return $this->name; }
    function getEmail() { return $this->email; }
    function getMobileNumber() { return $this->mobile_number; }
    function setPatientID($id) { $this->patient_id = $id; }
    function setName($name) { $this->name = $name; }
    function setEmail($email) { $this->email = $email; }
    function setMobileNumber($mobile) { $this->mobile_number = $mobile; }

    // ===== UML Methods =====
    function register($password) {
        global $con;
        $q = "INSERT INTO patreg(fname,email,contact,password) 
              VALUES('$this->name','$this->email','$this->mobile_number','$password')";
        echo mysqli_query($con, $q)
            ? "<script>alert('Patient registered successfully!');</script>"
            : "<script>alert('Error: ".mysqli_error($con)."');</script>";
    }

    function bookAppointment($doctor, $date, $time, $fees) {
        global $con;
        $q = "INSERT INTO appointmenttb(pid,fname,email,contact,doctor,appdate,apptime,docFees,userStatus,doctorStatus)
              VALUES('$this->patient_id','$this->name','$this->email','$this->mobile_number',
              '$doctor','$date','$time','$fees',1,1)";
        echo mysqli_query($con, $q)
            ? "<script>alert('Appointment booked successfully!');</script>"
            : "<script>alert('Error booking: ".mysqli_error($con)."');</script>";
    }

    function viewAppointments() {
        global $con;
        $r = mysqli_query($con, "SELECT * FROM appointmenttb WHERE email='$this->email'");
        echo "<div class='container mt-4'><h4>Your Appointments</h4>
              <table class='table table-bordered'><thead><tr>
              <th>Doctor</th><th>Date</th><th>Time</th><th>Status</th></tr></thead><tbody>";
        while ($row = mysqli_fetch_assoc($r)) {
            $s = ($row['userStatus'] && $row['doctorStatus']) ? "Active" :
                 (!$row['userStatus'] ? "Cancelled by Patient" : "Cancelled by Doctor");
            echo "<tr><td>{$row['doctor']}</td><td>{$row['appdate']}</td>
                  <td>{$row['apptime']}</td><td>$s</td></tr>";
        }
        echo "</tbody></table></div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"><title>Patient Dashboard - Ethicure</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css">
</head>
<body class="bg-light">

<div class="container mt-5">
  <h3 class="text-center text-primary mb-3">Patient Registration</h3>
  <form method="POST" class="card p-3">
    <input class="form-control mb-2" name="name" placeholder="Full Name" required>
    <input class="form-control mb-2" name="email" type="email" placeholder="Email" required>
    <input class="form-control mb-2" name="mobile_number" placeholder="Mobile Number" required>
    <input class="form-control mb-2" name="password" type="password" placeholder="Password" required>
    <button class="btn btn-primary" name="register_submit">Register</button>
  </form>
</div>

<?php
if (isset($_POST['register_submit'])) {
    $p = new Patient(null, $_POST['name'], $_POST['email'], $_POST['mobile_number']);
    $p->register($_POST['password']);
}
?>
</body>
</html>
