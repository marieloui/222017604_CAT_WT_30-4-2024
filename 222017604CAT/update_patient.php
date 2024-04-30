<?php

include('database_connection.php');

// Check if patientID is set
if(isset($_REQUEST['patientID'])) {
    $patientID = $_REQUEST['patientID'];
    
    $stmt = $connection->prepare("SELECT * FROM patient WHERE patientID=?");
    $stmt->bind_param("i", $patientID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['patientID'];
        $y = $row['FirstName'];
        $z = $row['LastName'];
        $w = $row['Gender'];
        $f = $row['PhoneNumber']; // Corrected variable name
    } else {
        echo "Patient not found.";
    }
}

?>

<html>
<head>
    <title>Update Patient</title>
    <script>
        function confirmUpdate(){
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <form method="POST" onsubmit="return confirmUpdate();">
        <!-- Corrected field names and added missing input type -->
        <label for="FirstName">First Name:</label> <!-- Corrected label -->
        <input type="text" name="FirstName" value="<?php echo isset($y) ? $y : ''; ?>"> <!-- Corrected input name -->
        <br><br>
        <label for="LastName">Last Name:</label> <!-- Corrected label -->
        <input type="text" name="LastName" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>
        <label for="Gender">Gender:</label>
        <input type="text" name="Gender" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>
        <label for="PhoneNumber">Phone Number:</label>
        <input type="text" name="PhoneNumber" value="<?php echo isset($f) ? $f : ''; ?>">
        <br><br>
        <input type="submit" name="up" value="Update">
        <input type="hidden" name="PatientID" value="<?php echo isset($x) ? $x : ''; ?>"> <!-- Added hidden input field -->
    </form>
</body>
</html>

<?php

if (isset($_POST['up'])) {
    // Retrieve updated values from the form
    $FirstName = $_POST['FirstName'];
    $lastName = $_POST['LastName'];
    $Gender = $_POST['Gender']; // Corrected variable name
    $PhoneNumber = $_POST['PhoneNumber'];

  // Update the employee in the database
$gms = $connection->prepare("UPDATE patient SET FirstName=?, LastName=?, Gender=?, PhoneNumber=? WHERE patientID=?");
$gms->bind_param("ssssi", $FirstName, $lastName, $Gender, $PhoneNumber, $patientID);
$gms->execute();


    // Redirect to patient.php
    header('Location: patient.php');
    exit(); // Ensure that no other content is sent after the header redirection
}



?>