<?php

include('database_connection.php');

// Check if RecordID is set
if(isset($_REQUEST['RecordID'])) {
    $RecordID = $_REQUEST['RecordID'];
    
    $stmt = $connection->prepare("SELECT * FROM medical_record WHERE RecordID=?");
    $stmt->bind_param("i", $RecordID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['RecordID'];
        $y = $row['PatientID'];
        $z = $row['DoctorID'];
        $w = $row['Diagnosis'];
        $v = $row['Prescription'];
    } else {
        echo "Medical record not found.";
    }

}

?>

<html>
    <head>
    <title>Medical Record</title>
    <script>
        function confirmUpdate(){
            return confirm('Are you sure you want to update this record?');
        }
    </script>
    <head>
<body>
    <form method="POST" onsubmit="return confirmUpdate();">
        <!-- Corrected field names and added missing input type -->

        <label for="PatientID">PatientID:</label> <!-- Corrected label -->
        <input type="number" name="PatientID" value="<?php echo isset($y) ? $y : ''; ?>"> <!-- Corrected input name -->
        <br><br>

        <label for="DoctorID">DoctorID:</label> <!-- Corrected label -->
        <input type="number" name="DoctorID" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>
       
        <label for="Diagnosis">Diagnosis:</label>
        <input type="text" name="Diagnosis" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>

        <label for="Prescription">Prescription:</label>
        <input type="text" name="Prescription" value="<?php echo isset($v) ? $v : ''; ?>">
        <br><br>
                
        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php

if (isset($_POST['up'])) {
    // Retrieve updated values from the form

    $PatientID = $_POST['PatientID']; // Corrected variable name
    $DoctorID = $_POST['DoctorID']; // Corrected variable name
    $Diagnosis = $_POST['Diagnosis']; // Corrected variable name
    $Prescription = $_POST['Prescription'];
    

    // Update the medical record in the database
    $gms = $connection->prepare("UPDATE medical_record SET PatientID=?, DoctorID=?, Diagnosis=?, Prescription=? WHERE RecordID=?");
    $gms->bind_param("ssssi", $PatientID, $DoctorID, $Diagnosis, $Prescription, $RecordID);
    $gms->execute();

    // Redirect to medical_record.php
    header('Location: medical_record.php');
    exit(); // Ensure that no other content is sent after the header redirection
}

?>
