<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index</title>
</head>
<body>
    <h1>JOBS FOR YOU</h1>
    <?php
        include 'connection.php';
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } else {
            $user_id=4;
            $stmt=$conn->prepare("SELECT Course FROM student_details where student_id= ?");
            $stmt->bind_param("i",$user_id);
            $stmt->execute();
            $stmt->bind_result($course);
            $stmt=$conn->prepare("SELECT * FROM job_posting where course= ?");
            if ($) {
                echo "Error in SQL query: " . $conn->error . "<br>";
            } 
            if ($result->num_rows > 0) {
                echo "<table>
                        <tr>
                            <th>ApplicationID</th>
                            <th>UserName</th>
                            <th>JobID</th>
                            <th>ApplicationDate</th>
                            <th>Status</th>
                        </tr>";
                
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row["ApplicationID"]. "</td>
                            <td>" . $row["UserName"]. "</td>
                            <td>" . $row["JobID"]. "</td>
                            <td>" . $row["ApplicationDate"]. "</td>
                            <td>" . $row["Status"]. "</td>
                          </tr>";
                }
                echo "</table>";
            } else {
                echo "0 results";
            }
        }
        $conn->close();
    ?>
</body>
</html>