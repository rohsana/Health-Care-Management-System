<!DOCTYPE html>
<?php
include("newfunc.php");
if(isset($_POST['doctor_search_submit'])){
  $contact = $_POST['doctor_contact'] ?? '';
  $query = "SELECT * FROM doctb WHERE email='$contact'";
  $result = mysqli_query($con,$query);
  $row = mysqli_fetch_array($result);
  if(empty($row['username']) && empty($row['password']) && empty($row['email']) && empty($row['docFees'])){
    echo "<script>alert('No entries found!');window.location.href='admin-panel1.php#list-doc';</script>";
    exit;
  }
  echo "<!doctype html><html><head><meta charset='utf-8'><link rel='shortcut icon' href='images/favicon.png'/><link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css'></head><body>";
  echo "<div class='container-fluid' style='margin-top:50px;'><div class='card'><div class='card-body' style='background:#342ac1;color:#fff;'><table class='table table-hover'><thead><tr><th>Username</th><th>Password</th><th>Email</th><th>Consultancy Fees</th></tr></thead><tbody>";
  $username = htmlspecialchars($row['username'] ?? '', ENT_QUOTES);
  $password = htmlspecialchars($row['password'] ?? '', ENT_QUOTES);
  $email = htmlspecialchars($row['email'] ?? '', ENT_QUOTES);
  $docFees = htmlspecialchars($row['docFees'] ?? '', ENT_QUOTES);
  echo "<tr><td>$username</td><td>$password</td><td>$email</td><td>$docFees</td></tr>";
  echo "</tbody></table><div class='text-center'><a href='admin-panel1.php' class='btn btn-light'>Back to dashboard</a></div></div></div></div>";
  echo "<script src='https://code.jquery.com/jquery-3.2.1.slim.min.js'></script><script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js'></script><script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js'></script></body></html>";
  exit;
}
?>
<html><head><title>Doctor Details</title></head><body></body></html>
