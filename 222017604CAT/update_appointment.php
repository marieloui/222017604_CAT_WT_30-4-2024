<?php

include('database_connection.php');

// Check if AppointmentID is set
if(isset($_REQUEST['AppointmentID'])) {
    $AppointmentID = $_REQUEST['AppointmentID'];
    
    $stmt = $connection->prepare("SELECT * FROM appointment WHERE AppointmentID=?");
    $stmt->bind_param("i", $AppointmentID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['AppointmentID'];
        $y = $row['PatientID'];
        $z = $row['DoctorID'];
        $w = $row['AppointmentDate'];
        $f = $row['Reason']; // Corrected variable name
    } else {
        echo "Appointment not found.";
    }
}

?>

<html>
<head>
    <title>Update Appointment</title>
    <script>
        function confirmUpdate(){
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <form method="POST" onsubmit="return confirmUpdate();">
        <!-- Corrected field names and added missing input type -->

        <label for="PatientID">PatientID:</label> <!-- Corrected label -->
        <input type="number" name="PatientID" value="<?php echo isset($y) ? $y : ''; ?>"> <!-- Corrected input name -->
        <br><br>

        <label for="DoctorID">DoctorID:</label> <!-- Corrected label -->
        <input type="number" name="DoctorID" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="AppointmentDate">AppointmentDate:</label>
        <input type="date" name="AppointmentDate" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>

        <label for="Reason">Reason:</label>
        <input type="text" name="Reason" value="<?php echo isset($f) ? $f : ''; ?>">
        <br><br>
                
        <input type="submit" name="up" value="Update">
        <input type="hidden" name="AppointmentID" value="<?php echo isset($x) ? $x : ''; ?>"> <!-- Added hidden input field -->
    </form>
</body>
</html>

<?php

if (isset($_POST['up'])) {
    // Retrieve updated values from the form
    $AppointmentID = $_POST['AppointmentID'];
    $PatientID = $_POST['PatientID']; // Corrected variable name
    $DoctorID = $_POST['DoctorID']; // Corrected variable name
    $AppointmentDate = $_POST['AppointmentDate']; // Corrected variable name
    $Reason = $_POST['Reason'];
    

    // Update the appointment in the database
    $stmt = $connection->prepare("UPDATE appointment SET PatientID=?, DoctorID=?, AppointmentDate=?, Reason=? WHERE AppointmentID=?");
    $stmt->bind_param("iissi", $PatientID, $DoctorID, $AppointmentDate, $Reason, $AppointmentID);
    $stmt->execute();

    // Redirect to appointment.php
    header('Location: appointment.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>