<?php
$host = "localhost";  // Database host (usually 'localhost')
$username = "root";   // Database username
$password = "";       // Database password
$dbname = "mana_gadgets"; // Database name

// Create connection
$conn = mysqli_connect($host, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

echo "Connected successfully";
?>
