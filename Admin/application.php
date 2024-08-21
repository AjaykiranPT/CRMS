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
            $sql = "SELECT * FROM application";
            $result = $conn->query($sql);
            if ($result === false) {
                echo "Error in SQL query: " . $conn->error . "<br>"; // Debugging statement
            } 
            // Check if there are records
            if ($result->num_rows > 0) {
                // Start the HTML table and add headers
                echo "<table>
                        <tr>
                            <th>ApplicationID</th>
                            <th>UserName</th>
                            <th>JobID</th>
                            <th>ApplicationDate</th>
                            <th>Status</th>
                        </tr>";
                
                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row["ApplicationID"]. "</td>
                            <td>" . $row["UserName"]. "</td>
                            <td>" . $row["JobID"]. "</td>
                            <td>" . $row["ApplicationDate"]. "</td>
                            <td>" . $row["Status"]. "</td>
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
</div>
</body>
</html>
