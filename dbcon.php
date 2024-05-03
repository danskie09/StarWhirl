<?php

$conn = mysqli_connect('localhost','root','','washing');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>