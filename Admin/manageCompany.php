<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .application-results {
            margin-top: 40px;
        }

        .application-results table {
            width: 100%;
            border-collapse: collapse;
        }

        .application-results th, .application-results td {
            border: 1px solid #ddd; /* Light grey border */
            padding: 12px;
            text-align: center;
        }

        .application-results th {
            background-color: #89CFF0; /* Light blue background for headers */
            color: #333; /* Darker text color for contrast */
        }

        .application-results td {
            background-color: #f9f9f9; /* Light grey background for table cells */
        }
    </style>
</head>
<body>
<div class="application-results">
<?php
     include 'connection.php';
     if ($conn->connect_error) {
         die("Connection failed: " . $conn->connect_error);
     } else {
         // SQL query to select all records from the table
         $sql = "SELECT * FROM `company_details` WHERE 1;";
         $result = $conn->query($sql);
         if ($result === false) {
             echo "Error in SQL query: " . $conn->error . "<br>"; // Debugging statement
         } 
         // Check if there are records
         if ($result->num_rows > 0) {
             // Start the HTML table and add headers
             echo "<table>
                     <tr>
                         <th>CompanyID</th>
                         <th>CompanyName</th>
                         <th>ContactPerson</th>
                         <th>Contact Number</th>
                         <th>Email</th>
                         <th>JoinedDate</th>
                     </tr>";
             
             // Output data of each row
             while($row = $result->fetch_assoc()) {
                 echo "<tr>
                         <td>" . $row["Comapny_ID"]. "</td>
                         <td>" . $row["Company_name"]. "</td>
                         <td>" . $row["Contact_person"]. "</td>
                         <td>" . $row["account_email"]. "</td>
                         <td>" . $row["PhoneNum"]. "</td>
                        <td>" . $row["date_of_joined"]. "</td>
                       </tr>";
             }
             // End the HTML table
             echo "</table>";
         } else {
             echo "0 results";
         }
        }
     // Close connection
     $conn->close();
   ?>