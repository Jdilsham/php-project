<?php

// Parse JawsDB database URL from Heroku's environment variables
$url = parse_url(getenv("JAWSDB_URL"));
$host = $url["host"];   // Hostname (e.g., us-cdbr-iron-east-05.cleardb.net)
$user = $url["user"];   // Username (e.g., b6a8df35ff567b)
$pass = $url["pass"];   // Password (e.g., cc7dbf99c85b38)
$db   = substr($url["path"], 1); // Database name (e.g., heroku_23f4b7b441f37c2)

// Create a connection to the database
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>