<?php

include('database_connection.php');

// Check if DoctorID is set
if(isset($_REQUEST['DoctorID'])) {
    $DoctorID = $_REQUEST['DoctorID'];
    
    $stmt = $connection->prepare("SELECT * FROM doctor WHERE DoctorID=?");
    $stmt->bind_param("i", $DoctorID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['DoctorID'];
        $y = $row['FirstName'];
        $z = $row['LastName'];
        $w = $row['Specialty'];
        $f = $row['PhoneNumber']; // Corrected variable assignment
        $g = $row['Email']; // Corrected variable assignment
    } else {
        echo "Doctor not found."; // Corrected message
    }
}

?>
<html>
    <head>
    <title>Update Doctor</title>
    <script>
        function confirmUpdate(){
            return confirm('Are you sure you want to update this record?'); // Corrected message
        }
        </script>
    <head>
<body>
    <form method="POST" onsubmit="return confirmUpdate();">
        <!-- Corrected field names and added missing input type -->
       
        <label for="FirstName">FirstName:</label> <!-- Corrected label -->
        <input type="text" name="FirstName" value="<?php echo isset($y) ? $y : ''; ?>"> <!-- Corrected input type and variable -->
        <br><br>

        <label for="LastName">LastName:</label> <!-- Corrected label -->
        <input type="text" name="LastName" value="<?php echo isset($z) ? $z : ''; ?>"> <!-- Corrected input type and variable -->
        <br><br>

        <label for="Specialty">Specialty:</label>
        <input type="text" name="Specialty" value="<?php echo isset($w) ? $w : ''; ?>"> <!-- Corrected input type and variable -->
        <br><br>

        <label for="PhoneNumber">PhoneNumber:</label>
        <input type="text" name="PhoneNumber" value="<?php echo isset($f) ? $f : ''; ?>">
        <br><br>
        <label for="Email">Email:</label>
        <input type="email" name="Email" value="<?php echo isset($g) ? $g : ''; ?>"> <!-- Corrected variable -->
        <br><br>
                
        <input type="submit" name="up" value="Update">
        <input type="hidden" name="DoctorID" value="<?php echo isset($DoctorID) ? $DoctorID : ''; ?>"> <!-- Added hidden input field -->
    </form>
</body>
</html>

<?php

if (isset($_POST['up'])) {
    // Retrieve updated values from the form
    $DoctorID = $_POST['DoctorID'];
    $FirstName = $_POST['FirstName'];
    $LastName = $_POST['LastName'];
    $Specialty = $_POST['Specialty'];
    $PhoneNumber = $_POST['PhoneNumber'];
    $Email = $_POST['Email'];

    // Update the doctor in the database
    $stmt = $connection->prepare("UPDATE doctor SET FirstName=?, LastName=?, Specialty=?, PhoneNumber=?, Email=? WHERE DoctorID=?");
    $stmt->bind_param("sssssi", $FirstName, $LastName, $Specialty, $PhoneNumber, $Email, $DoctorID);
    $stmt->execute();

    // Redirect to doctor.php
    header('Location: doctor.php');
    exit(); // Ensure that no other content is sent after the header redirection
}

?>