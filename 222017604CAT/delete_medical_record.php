<?php
include('database_connection.php');

// Check if RecordID is set
if(isset($_REQUEST['RecordID'])) {
    $RecordID = $_REQUEST['RecordID'];
    
    // Prepare and execute the DELETE statement
    $gms = $connection->prepare("DELETE FROM medical_record WHERE RecordID=?");
    $gms->bind_param("i", $RecordID);
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
            <input type="hidden" name="RecordID" value="<?php echo $RecordID; ?>">
            <input type="submit" value="Delete">
        </form>

        <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($gms->execute()) {
        echo "Record deleted successfully.<br><br>
        <a href='medical_record.php'>ok</a>";
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
    echo "RecordID is not set.";
}

$connection->close();

?>