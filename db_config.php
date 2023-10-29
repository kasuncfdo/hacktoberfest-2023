<?php
$host = "localhost";
$username = "u986916771_xuvindu";
$password = "Bro#2006";
$database = "u986916771_blog_db";

// Create a connection
$conn = mysqli_connect($host, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
