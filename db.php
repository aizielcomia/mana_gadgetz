<?php
$servername = "localhost";
$username = "root"; // Your DB username
$password = ""; // Your DB password
$dbname = "mana_gadgetz"; // Your DB name

$conn = new mysqli($servername, $username, $password, $dbname, 4306);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
