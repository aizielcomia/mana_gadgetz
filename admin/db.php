<?php
$host = 'localhost'; // Database host
$dbname = 'mana_gadgetz'; // Database name
$username = 'root'; // Database username
$password = ''; // Database password

try {
    $db = new PDO("mysql:host=$host;port=4306;dbname=$dbname", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    file_put_contents('error_log.txt', date('Y-m-d H:i:s') . " - Connection failed: " . $e->getMessage() . PHP_EOL, FILE_APPEND);
    echo 'Connection failed: ' . $e->getMessage();
}
?>
