<?php

$conn = new mysqli("localhost", "root", "", "department");

if ($conn->connect_error) {
    die("Connection failed");
}

?>