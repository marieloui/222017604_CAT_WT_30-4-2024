<?php
include('database_connection.php');

// Check if the 'query' GET parameter is set
if (isset($_GET['query'])) {
    // Sanitize input to prevent SQL injection
    $searchTerm = $connection->real_escape_string($_GET['query']);

    // Perform the search query for appointment
    $sql = "SELECT * FROM appointment WHERE AppointmentDate LIKE '%$searchTerm%'";
    $result_appointment = $connection->query($sql);

    // Perform the search query for billing
    $sql = "SELECT * FROM billing WHERE BillDate LIKE '%$searchTerm%'";
    $result_billing = $connection->query($sql);

    // Perform the search query for patient
    $sql = "SELECT * FROM patient WHERE PhoneNumber LIKE '%$searchTerm%'";
    $result_patient = $connection->query($sql);

    // Perform the search query for doctor
    $sql = "SELECT * FROM doctor WHERE FirstName LIKE '%$searchTerm%'";
    $result_doctor = $connection->query($sql);

    // Perform the search query for medical_record
    $sql = "SELECT * FROM medical_record WHERE RecordID LIKE '%$searchTerm%'";
    $result_medical_record = $connection->query($sql);

    // Output search results
    echo "<h2><u>Search Results:</u></h2>";
    
    echo "<h3>appointment:</h3>";
    if ($result_appointment->num_rows > 0) {
        while ($row = $result_appointment->fetch_assoc()) {
            echo "<p>" . $row['AppointmentDate'] . "</p>"; // Removed unnecessary space after 'AppointmentDate'
        }
    } else {
        echo "<p>No appointment found matching the search term: " . $searchTerm . "</p>";
    }

    echo "<h3>billing:</h3>";
    if ($result_billing->num_rows > 0) { // Corrected variable name and added -> before num_rows
        while ($row = $result_billing->fetch_assoc()) { // Corrected variable name
            echo "<p>" . $row['BillDate'] . "</p>";
        }
    } else {
        echo "<p>No billing found matching the search term: " . $searchTerm . "</p>";
    }

    echo "<h3>patient:</h3>";
    if ($result_patient->num_rows > 0) { // Corrected variable name
        while ($row = $result_patient->fetch_assoc()) {
            echo "<p>" . $row['PhoneNumber'] . "</p>";
        }
    } else {
        echo "<p>No patient found matching the search term: " . $searchTerm . "</p>";
    }

    echo "<h3>doctor:</h3>";
    if ($result_doctor->num_rows > 0) {
        while ($row = $result_doctor->fetch_assoc()) {
            echo "<p>" . $row['FirstName'] . "</p>";
        }
    } else {
        echo "<p>No doctor found matching the search term: " . $searchTerm . "</p>";
    }

    echo "<h3>medical_record:</h3>";
    if ($result_medical_record->num_rows > 0) {
        while ($row = $result_medical_record->fetch_assoc()) {
            echo "<p>" . $row['RecordID'] . "</p>"; // Corrected variable name
        }
    } else {
        echo "<p>No medical_record found matching the search term: " . $searchTerm . "</p>";
    }
    $connection->close();
} else {
    echo "No search term was provided.";
}
?>

<?php
// Starts the session if not already started
if (!isset($_SESSION)) {
    session_start();
}

// Check if the logout has been confirmed
if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    session_destroy();  // Destroy the session data
    header("Location: home.html");  // Redirect to home page
    exit;
}
?>