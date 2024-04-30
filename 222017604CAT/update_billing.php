<?php
include('Database_Connection.php');

// Check if BillID is set
if(isset($_REQUEST['BillID'])) {
    $billid = $_REQUEST['BillID'];
    
    $stmt = $connection->prepare("SELECT * FROM billing WHERE BillID=?");
    $stmt->bind_param("i", $billid);
    $stmt->execute();
    $result = $stmt->get_result();
   
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['BillID'];
        $y = $row['PatientID'];
        $z = $row['DoctorID'];
        $w = $row['BillDate'];
        $p = $row['Amount'];
    } else {
        echo "Bill not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update new record in Billing</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update billing form -->
    <h2><u>Update Form of Billing</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">

        <label for="patientid">Patient ID:</label>
        <input type="text" name="patientid" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="doctorid">Doctor ID:</label>
        <input type="text" name="doctorid" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="billdate">Bill Date:</label>
        <input type="date" name="billdate" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>

        <label for="amount">Amount:</label>
        <input type="number" name="amount" value="<?php echo isset($p) ? $p : ''; ?>">
        <br><br>
        <input type="submit" name="up" value="Update">
        
    </form></center> 
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $patientid = $_POST['patientid'];
    $doctorid = $_POST['doctorid'];
    $billdate = $_POST['billdate'];
    $amount = $_POST['amount'];
    
    // Update the billing in the database
    $stmt = $connection->prepare("UPDATE billing SET PatientID=?, DoctorID=?, BillDate=?, Amount=? WHERE BillID=?");
    $stmt->bind_param("iisdi", $patientid, $doctorid, $billdate, $amount, $billid);
    $stmt->execute();
     
    // Redirect to billing.php
    header('Location: billing.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>