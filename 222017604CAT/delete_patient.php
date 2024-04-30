<?php

include('database_connection.php');

// Check if PatientID is set
if(isset($_REQUEST['PatientID'])) {
    $PatientID = $_REQUEST['PatientID'];
    
    // Prepare and execute the DELETE statement
    $gms = $connection->prepare("DELETE FROM patient WHERE PatientID=?");
    $gms->bind_param("i", $PatientID);
    ?>
    <html>
        <head>
        <title>delete</title>
        <script>
            function confirmDelete(){
                return confirm('are you sure you want to delete this record');
            }
        </script>
        </head>
        <body>
        <form method="post" onsubmit="return confirmDelete();">
            <input type="hidden" name="PatientID" value="<?php echo $PatientID; ?>">
            <input type="submit" value="Delete">
        </form>

        <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($gms->execute()) {
        echo "Record deleted successfully.<br><br>
        <a href='patient.php'>ok</a>";
    } else {
        echo "Error deleting data: " . $gms->error;
    }
}
?>
</body>
</html>
<?php

    $gms->close();
} else {
    echo "PatientID is not set.";
}

$connection->close();


?>