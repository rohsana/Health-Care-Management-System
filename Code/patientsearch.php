
<!DOCTYPE html>
<?php 
    // include("func.php");  // optional include 
?>
<html>
<head>
    <title>Patient Details</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" 
          href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" 
          integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" 
          crossorigin="anonymous">

</head>

<body>

<?php

    // Include new functions + DB connection
    include("newfunc.php");

    // Check if search button is clicked
    if (isset($_POST['patient_search_submit'])) 
    {
        // Retrieve contact number from form POST
        $contact = $_POST['patient_contact'];

        // Query the patient based on contact number
        $query  = "SELECT * FROM patreg WHERE contact = '$contact'";

        // Execute query
        $result = mysqli_query($con, $query);

        // Fetch resulting row
        $row    = mysqli_fetch_array($result);

        // Validate that data exists
        if (
                $row['lname']    == "" && 
                $row['email']    == "" && 
                $row['contact']  == "" && 
                $row['password'] == ""
            ) 
        {
            // If no valid entry found, show alert and redirect
            echo "
                <script>
                    alert('No entries found! Please enter valid details');
                    window.location.href = 'admin-panel1.php#list-doc';
                </script>
            ";
        }

        else 
        {
            // If data exists, show patient details table
            echo "
            <div class='container-fluid' style='margin-top: 50px;'>

                <div class='card'>

                    <div class='card-body' 
                         style='background-color: #342ac1; color: #ffffff;'>

                        <table class='table table-hover'>

                            <thead>
                                <tr>
                                    <th scope='col'>First Name</th>
                                    <th scope='col'>Last Name</th>
                                    <th scope='col'>Email</th>
                                    <th scope='col'>Contact</th>
                                    <th scope='col'>Password</th>
                                </tr>
                            </thead>

                            <tbody>
            ";

                    // Extract fields from row
                    $fname     = $row['fname'];
                    $lname     = $row['lname'];
                    $email     = $row['email'];
                    $contact   = $row['contact'];
                    $password  = $row['password'];

                    // Print table row
                    echo "
                                <tr>
                                    <td>$fname</td>
                                    <td>$lname</td>
                                    <td>$email</td>
                                    <td>$contact</td>
                                    <td>$password</td>
                                </tr>
                    ";

            // Close table + card + container
            echo "
                            </tbody>
                        </table>

                        <center>
                            <a href='admin-panel1.php' class='btn btn-light'>
                                Back to dashboard
                            </a>
                        </center>

                    </div>

                </div>

            </div>
            ";
        }
    }

?>

<!-- JavaScript Files -->
<script 
    src="https://code.jquery.com/jquery-3.2.1.slim.min.js" 
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" 
    crossorigin="anonymous">
</script>

<script 
    src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" 
    integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" 
    crossorigin="anonymous">
</script>

<script 
    src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" 
    integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" 
    crossorigin="anonymous">
</script>

</body>
</html>
