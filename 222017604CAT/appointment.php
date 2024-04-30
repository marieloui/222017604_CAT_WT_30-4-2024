<!DOCTYPE html>
<html lang="en">
<head>
 <!-- Linking to external stylesheet -->
 <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>appointment  </title>
    <style>
   /* Normal link */
   a {
     padding: 10px;
     color: rgb(21, 22, 22);
     background-color: rgb(69, 122, 131);
     text-decoration: none;
     margin-right: 15px;
   }

   /* Visited link */
   a:visited {
     color: rgb(2, 15, 22);
   }
   /* Unvisited link */
   a:link {
     color: rgb(13, 14, 13); /* Changed to lowercase */
   }
   /* Hover effect */
   a:hover {
     background-color: rgb(144, 215, 233);
   }

   /* Active link */
   a:active {
     background-color: rgb(65, 147, 153);
   }

   /* Extend margin left for search button */
   button.btn {
     margin-left: 15px; /* Adjust this value as needed */
     margin-top: 4px;
   }
   /* Extend margin left for search button */
   input.form-control {
     margin-left: 1300px; /* Adjust this value as needed */
     padding: 8px;  
   }
   header{
 background-color:  #63869e;
 padding: 20px;
}
   section{
     padding:32px;
   }
   footer{
 background-color:  #63869e;
 padding: 20px;
}

 </style>

 <!-- JavaScript validation and content load for insert data-->
 <script>
            function confirmInsert() {
                return confirm('Are you sure you want to insert this record?');
            }
        </script>

</head>
<header>
<body bgcolor="greenyellow">
<form class="d-flex" role="search" action="search.php">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="query">
            <button class="btn btn-outline-success" type="submit">Search</button>
          </form>
        
          <ul style="list-style-type: none; padding: 0;">
            <li style="display: inline; margin-right: 10px;">
              <img src="./ho.jpeg" width="90" height="60" alt="Logo">
            </li>
            <li style="display: inline; margin-right: 10px;"><a href="./home.html">HOME</a></li>
            <li style="display: inline; margin-right: 10px;"><a href="./about.html">ABOUT</a></li>
            <li style="display: inline; margin-right: 10px;"><a href="./contact.html">CONTACT</a></li>
            <li style="display: inline; margin-right: 10px;"><a href="./patient.php">PATIENT</a></li>
            <li style="display: inline; margin-right: 10px;"><a href="./billing.php">BILLING</a></li>
            <li style="display: inline; margin-right: 10px;"><a href="./doctor.php">DOCTOR</a></li>
            <li style="display: inline; margin-right: 10px;"><a href="./medical_record.php">MEDICAL_RECORD</a></li>
            <li style="display: inline; margin-right: 10px;"><a href="./appointment.php">APPOINTMENT</a></li>
            
            <li class="dropdown" style="display: inline; margin-right: 10px;">
              <a href="#" style="padding: 10px; color: rgb(2, 17, 19); background-color: rgb(101, 178, 197); text-decoration: none; margin-right: 15px;">Settings</a>
              <div class="dropdown-contents">
                <!-- Links inside the dropdown menu -->
                <a href="login.html">Login</a>
                <a href="admin.html">Register</a>
                <a href="logout.php">Logout</a>
              </div>
            </li><br><br>
          </ul>
        </header>

        <section>
    <h1>Appointment Form</h1>
    <form method="post" onsubmit="return confirmInsert();">
        <label for="AppointmentID">Appointment Id:</label>
        <input type="number" id="AppointmentID" name="AppointmentID" required><br><br>

        <label for="PatientID">PATIENT Id:</label>
        <input type="number" id="PatientID" name="PatientID" required><br><br>

        <label for="DoctorID">DOCTOR Id:</label>
        <input type="number" id="DoctorID" name="DoctorID" required><br><br>

        <label for="AppointmentDate">APPOINTMENT DATE:</label>
        <input type="date" id="AppointmentDate" name="AppointmentDate" required><br><br>

        <label for="Reason">Reason:</label>
        <input type="text" id="Reason" name="Reason" required><br><br>

       

        <input type="submit" name="insert" value="Insert"><br><br>

        <a href="./home.html">Go Back to Home</a>
    </form>





<?php
 include('database_connection.php');
 // Check if the form is submitted for insert
 if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['insert'])) {
     // Insert section
     $gms = $connection->prepare("INSERT INTO appointment(AppointmentID, PatientID, DoctorID, AppointmentDate,Reason) VALUES (?, ?, ?, ?, ?, ?)");
     $gms->bind_param("iiiss", $Aid, $PID, $DID, $Adate, $Rn);

     // Set parameters from POST and execute
     $Aid = $_POST['AppointmentID'];
     $PID = $_POST['PatientID'];
     $DID = $_POST['DoctorID'];
 
     $Adate = $_POST['Appointdate'];
     $Rn = $_POST['Reason'];

     if ($gms->execute()) {
         echo "New record has been added successfully.<br><br>
              <a href='Appointment.html'>Back to Form</a>";
     } else {
         echo "Error inserting data: " . $gms->error;
     }

     $gms->close();
 } 
 ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail information Of Products</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>

 <center><h2>Table of Appointment</h2></center>
 <table borde="3">
     <tr>
         <th>AppointmentID</th>
         <th>PatientID</th>
         <th>DoctorID</th>
         
         <th>AppointmentDate</th>
         <th>Reason</th>

         <th>Delete</th>
         <th>Update</th>
     </tr>

     <?php
      include('database_connection.php');
     // SQL query to fetch data from the Appointment table
     $sql = "SELECT * FROM appointment";
     $result = $connection->query($sql);

     if ($result->num_rows > 0) {
         while ($row = $result->fetch_assoc()) {
             $AID = $row["AppointmentID"]; // Added this line to fetch AppointmentID
             echo "<tr>
                 <td>" . $row["AppointmentID"] . "</td>
                 <td>" . $row["PatientID"] . "</td>
                 <td>" . $row["DoctorID"] . "</td> 
                 <td>" . $row["AppointmentDate"] . "</td>
                 
                 <td>" . $row["Reason"] . "</td>
                 <td><a style='padding:4px' href='delete_Appointment.php?AppointmentID=$AID'>Delete</a></td> 
                 <td><a style='padding:4px' href='update_Appointment.php?AppointmentID=$AID'>Update</a></td> 
             </tr>";
         }
     } else {
         echo "<tr><td colspan='8'>No data found</td></tr>";
     }
     // Close connection
     $connection->close();
     ?>
 </table>
    </body>
    </section>

 <footer>

 <marquee> 
            <b><h2>UR CBE BIT &copy; 2024 &reg; 222017604, Designed by: MARIE LOUISE</h2></b>
        </marquee>
    </footer>
</body>
</html>

