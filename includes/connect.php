<?php
$host = "sql107.infinityfree.com";
$username = "if0_37201949";
$password = "Hk@5318008";
$database = "if0_37201949_mystore";

// Create a new mysqli object for the connection
$con = new mysqli($host, $username, $password, $database);

// Check for connection errors
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

?>
