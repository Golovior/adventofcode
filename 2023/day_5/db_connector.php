<?php

$servername = "localhost";
$username = "aoc";
$password = "b*NaEBby*Ablnf]b";

// Create connection
$conn = new mysqli($servername, $username, $password, $username);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

 ?>
