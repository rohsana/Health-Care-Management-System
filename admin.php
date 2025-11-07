<?php
// Simple connection (adjust credentials as needed)
$con = new mysqli("localhost", "root", "", "myhmsdb");
if ($con->connect_error) die("DB Conn Error: " . $con->connect_error);

class Admin {
    private $con;
    public $adminID, $name, $email;

    public function __construct($con, $adminID, $name, $email) {
        $this->con = $con;
        $this->adminID = $adminID;
        $this->name = $name;
        $this->email = $email;
    }

    public function createDoctor($username, $password, $email, $spec, $docFees) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->con->prepare("INSERT INTO doctb(username,password,email,spec,docFees) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssd", $username, $hash, $email, $spec, $docFees);
        return $stmt->execute();
    }

    public function deleteDoctor($email) {
        $stmt = $this->con->prepare("DELETE FROM doctb WHERE email=?");
        $stmt->bind_param("s", $email);
        return $stmt->execute();
    }

    public function viewDoctorDetails() {
        $res = $this->con->query("SELECT username,spec,email,docFees FROM doctb");
        return $res->fetch_all(MYSQLI_ASSOC);
    }

    public function viewPatientDetails() {
        $res = $this->con->query("SELECT pid,fname,lname,gender,email,contact FROM patreg");
        return $res->fetch_all(MYSQLI_ASSOC);
    }
}

// Instantiate admin (hardcoded sample)
$admin = new Admin($con, 1, "Admin", "admin@example.com");

// Handle form submissions
$msg = "";
if (isset($_POST['addDoctor'])) {
    if ($admin->createDoctor($_POST['username'], $_POST['password'], $_POST['email'], $_POST['spec'], floatval($_POST['docFees']))) {
        $msg = "Doctor added successfully.";
    } else {
        $msg = "Error adding doctor.";
    }
}
if (isset($_POST['delDoctor'])) {
    if ($admin->deleteDoctor($_POST['email'])) {
        $msg = "Doctor deleted successfully.";
    } else {
        $msg = "Error deleting doctor.";
    }
}

$doctors = $admin->viewDoctorDetails();
$patients = $admin->viewPatientDetails();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>Admin Dashboard</title>
<style>
  body { font-family: Arial, sans-serif; background:#f9f9f9; padding:20px; max-width:900px; margin:auto; }
  h1, h2 { color:#333; }
  form { background:#fff; padding:15px; margin-bottom:20px; border-radius:5px; box-shadow: 0 0 5px #ccc; }
  input, select, button { margin:5px 0; padding:8px; width:100%; max-width:300px; }
  button { background:#007bff; color:#fff; border:none; cursor:pointer; }
  button:hover { background:#0056b3; }
  table { border-collapse: collapse; width: 100%; background:#fff; }
  th, td { border:1px solid #ccc; padding:8px; text-align:left; }
  th { background:#007bff; color:#fff; }
  .msg { margin-bottom:20px; color: green; }
</style>
</head>
<body>

<h1>Admin Dashboard</h1>
<p>Welcome, <?= htmlspecialchars($admin->name) ?> (<?= htmlspecialchars($admin->email) ?>)</p>

<?php if ($msg): ?>
  <div class="msg"><?= htmlspecialchars($msg) ?></div>
<?php endif; ?>

<h2>Add Doctor</h2>
<form method="post">
  <input type="text" name="username" placeholder="Name" required />
  <input type="email" name="email" placeholder="Email" required />
  <input type="password" name="password" placeholder="Password" required />
  <select name="spec" required>
    <option value="" disabled selected>Select Specialization</option>
    <option>General</option>
    <option>Cardiologist</option>
    <option>Neurologist</option>
    <option>Pediatrician</option>
  </select>
  <input type="number" step="0.01" name="docFees" placeholder="Fees" required />
  <button name="addDoctor" type="submit">Add Doctor</button>
</form>

<h2>Delete Doctor</h2>
<form method="post">
  <input type="email" name="email" placeholder="Doctor Email" required />
  <button name="delDoctor" type="submit" style="background:#dc3545;">Delete Doctor</button>
</form>

<h2>Doctors List</h2>
<table>
  <thead><tr><th>Name</th><th>Specialization</th><th>Email</th><th>Fees</th></tr></thead>
  <tbody>
    <?php foreach ($doctors as $doc): ?>
      <tr>
        <td><?= htmlspecialchars($doc['username']) ?></td>
        <td><?= htmlspecialchars($doc['spec']) ?></td>
        <td><?= htmlspecialchars($doc['email']) ?></td>
        <td>$<?= number_format($doc['docFees'], 2) ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<h2>Patients List</h2>
<table>
  <thead><tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Gender</th><th>Email</th><th>Contact</th></tr></thead>
  <tbody>
    <?php foreach ($patients as $pat): ?>
      <tr>
        <td><?= htmlspecialchars($pat['pid']) ?></td>
        <td><?= htmlspecialchars($pat['fname']) ?></td>
        <td><?= htmlspecialchars($pat['lname']) ?></td>
        <td><?= htmlspecialchars($pat['gender']) ?></td>
        <td><?= htmlspecialchars($pat['email']) ?></td>
        <td><?= htmlspecialchars($pat['contact']) ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

</body>
</html>
