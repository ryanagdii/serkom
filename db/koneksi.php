<?php
// Database configuration
$host = 'localhost';
$dbname = 'serkom_beasiswa';
$username = 'root';
$password = '';
$connection = new mysqli($host, $username, $password, $dbname);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
?>
