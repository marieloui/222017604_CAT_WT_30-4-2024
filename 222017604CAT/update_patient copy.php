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
        $w = $row['PhoneNumber'];
        
    } else {
        echo "patient not found.";
    }

}

?>

<html>
    <head>
    <title>update patient</title>
    <script>
        function confirmUpdate(){
            return confirm('are you sure you want to update this record');
        }
        </script>
    <head>
<body>
    <form method="POST" onsubmit="return confirmUpdate();">
        <!-- Corrected field names and added missing input type -->
        <label for="PatientID">PatientID:</label>
        <input type="number" name="PatientID" value="<?php echo isset($b) ? $b : ''; ?>">
        <br><br>

        <label for="FirstName">FirstName:</label> <!-- Corrected label -->
        <input type="number" name="FirstName" value="<?php echo isset($c) ? $c : ''; ?>"> <!-- Corrected input name -->
        <br><br>

        <label for="LastName">LastName:</label> <!-- Corrected label -->
        <input type="number" name="LastName" value="<?php echo isset($d) ? $d : ''; ?>">
        <br><br>

        <label for="Gender">Gender:</label>
        <input type="date" name="Gender" value="<?php echo isset($e) ? $e : ''; ?>">
        <br><br>

        <label for="PhoneNumber">PhoneNumber:</label>
        <input type="text" name="PhoneNumber" value="<?php echo isset($f) ? $f : ''; ?>">
        <br><br>
        
                
        <input type="submit" name="up" value="Update">
        <input type="hidden" name="PatientID" value="<?php echo isset($PatientID) ? $PatientID : ''; ?>"> <!-- Added hidden input field -->
    </form>
</body>
</html>

<?php

if (isset($_POST['up'])) {
    // Retrieve updated values from the form
    $patientID = $_POST['patientID'];
    $FirstName = $_POST['FirstName']; // Corrected variable name
    $lastName = $_POST['LastName']; // Corrected variable name
    $Gendder = $_POST['Gendder']; // Corrected variable name
    $PhoneNumber = $_POST['PhoneNumber'];
    ;

    // Update the employee in the database
    $gms = $connection->prepare("UPDATE patient SET FirstName=?, LastName=?, Gendder=?, PhoneNumber=?WHERE patientID=?");
    $gms->bind_param("ssdssi", $FirstName, $lastName, $Gendder, $PhoneNumber,  $patientID);
    $gms->execute();

    // Redirect to patient.php
    header('Location: patient.php');
    exit(); // Ensure that no other content is sent after the header redirection
}



?>