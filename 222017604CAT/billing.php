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
    <title>Billing page </title>
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
 background-color: #63869e;
 padding: 20px;
}
   section{
     padding:32px;
   }
   footer{
 background-color: #63869e;
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
<body bgcolor="green">

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
    <h1>Billing  Form</h1>
    <form method="post" onsubmit="return confirmInsert();">
        <label for="BillID">Billing Id:</label>
        <input type="number" id="BillID" name="BillID" required><br><br>

        <label for="PatientID">PATIENT Id:</label>
        <input type="number" id="PatientID" name="PatientID" required><br><br>

        <label for="DoctorID">DOCTOR Id:</label>
        <input type="number" id="DoctorID" name="DoctorID" required><br><br>

        <label for="BillDate">Billing DATE:</label>
        <input type="date" id="BillDate" name="BillDate" required><br><br>

        <label for="Amount">Amount:</label>
        <input type="number" id="Amount" name="Amount" required><br><br>

       

        <input type="submit" name="insert" value="Insert"><br><br>

        <a href="./home.html">Go Back to Home</a>
    </form>





<?php
include('database_connection.php');

 // Check if the form is submitted for insert
 if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['insert'])) {

  $gms = $connection->prepare("INSERT INTO billing(BillID, PatientID, DoctorID, BillDate,Amount) VALUES (?, ?, ?, ?,?)");
     $gms->bind_param("iisss", $BillID, $PatientID, $DoctorID, $BillDate, $Amount);

     // Set parameters from POST and execute
     $BillID = $_POST['BillID'];
     $PatientID = $_POST['PatientID'];
     $DoctorID = $_POST['DoctorID'];
 
     $BillDate = $_POST['BillDate'];
     $Amount = $_POST['Amount'];

 if ($gms->execute()) {
         echo "New record has been added successfully.<br><br>
              <a href='billing.html'>Back to Form</a>";
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
    <title>Detail information Of billing</title>
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

 <center><h2>Table of Billing</h2></center>
 <table border="3">
     <tr>
         <th>BillID</th>
         <th>PatientID</th>
         <th>DoctorID</th>
         
         <th>BillDate</th>
         <th>Amount</th>

         <th>Delete</th>
         <th>Update</th>
     </tr>

     <?php
      include('database_connection.php');
     // SQL query to fetch data from the Appointment table
     $sql = "SELECT * FROM billing";
     $result = $connection->query($sql);

     if ($result->num_rows > 0) {
         while ($row = $result->fetch_assoc()) {
             $BillID = $row["BillID"]; // Added this line to fetch BillID
             echo "<tr>
                 <td>" . $row["BillID"] . "</td>
                 <td>" . $row["PatientID"] . "</td>
                 <td>" . $row["DoctorID"] . "</td> 
                 <td>" . $row["BillDate"] . "</td>
                 
                 <td>" . $row["Amount"] . "</td>
                 <td><a style='padding:4px' href='delete_billing.php?BillID=$BillID'>Delete</a></td> 
                 <td><a style='padding:4px' href='update_billing.php?BillID=$BillID'>Update</a></td> 
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



