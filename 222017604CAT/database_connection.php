<?php
    // Connection details
    $host = "localhost";
    $user = "222017604";
    $pass = "222017604";
    $database = "muragijimana_louise_pt";

    // Creating connection
    $connection = new mysqli($host, $user, $pass, $database);

    // Check connection
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
?>