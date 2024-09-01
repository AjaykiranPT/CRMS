<?php
include 'connection.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_POST['email'];


$query = $conn->prepare("SELECT * FROM account_login WHERE account_email= ? ");
$query->bind_param("s",$email);
$query->execute();
$query->store_result();

if ($query->num_rows > 0) {
    echo 'taken';
} else {
    echo 'available';
}

$query->close();
$conn->close();
?>