<?php
include('database_connection.php');

// Check if BillID is set
if(isset($_REQUEST['BillID'])) {
    $BillID = $_REQUEST['BillID'];
    
    // Prepare and execute the DELETE statement
    $gms = $connection->prepare("DELETE FROM billing WHERE BillID=?");
    $gms->bind_param("i", $BillID);
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
            <input type="hidden" name="BillID" value="<?php echo $BillID; ?>">
            <input type="submit" value="Delete">
        </form>

        <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($gms->execute()) {
        echo "Record deleted successfully.<br><br>
        <a href='billing.php'>ok</a>";
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
    echo "BillID is not set.";
}

$connection->close();

?>