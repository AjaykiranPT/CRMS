<html>
    <body>
    <?php
$servername = "localhost";
$username = "root";
$password = ""; // Empty string for null password
$dbname = "crms";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

</body>
</html>