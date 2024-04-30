<?php

include('database_connection.php');

// Check if DoctorID is set
if(isset($_REQUEST['DoctorID'])) {
    $DoctorID = $_REQUEST['DoctorID'];
    
    // Prepare and execute the DELETE statement
    $gms = $connection->prepare("DELETE FROM doctor WHERE DoctorID=?");
    $gms->bind_param("i", $DoctorID);
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
            <input type="hidden" name="DoctorID" value="<?php echo $DoctorID; ?>">
            <input type="submit" value="Delete">
        </form>

        <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($gms->execute()) {
        echo "Record deleted successfully.<br><br>
        <a href='doctor.php'>ok</a>";
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
    echo "DoctorID is not set.";
}

$connection->close();

?>