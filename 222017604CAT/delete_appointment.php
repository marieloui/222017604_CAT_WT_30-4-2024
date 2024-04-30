<?php

include('database_connection.php');

// Check if AppoiintmentID is set
if(isset($_REQUEST['AppoiintmentID'])) {
    $AppointmentID = $_REQUEST['AppoiintmentID'];
    
    // Prepare and execute the DELETE statement
    $gms = $connection->prepare("DELETE FROM appointment WHERE AppoiintmentID=?");
    $gms->bind_param("i", $AppointmentID);
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
            <input type="hidden" name="AppointmentID" value="<?php echo $AppointmentID; ?>">
            <input type="submit" value="Delete">
        </form>

        <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
    if ($gms->execute()) {
        echo "Record deleted successfully.<br><br>
        <a href='appointment.php'>ok</a>";
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
    echo "AppoiintmentID is not set.";
}

$connection->close();

?>