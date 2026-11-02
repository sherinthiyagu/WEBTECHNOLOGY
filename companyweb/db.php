<?php

$host = "sql104.infinityfree.com";
$username = "if0_43283131";
$password = "12she34rin";
$database = "if0_43283131_company";

$conn = new mysqli(
    $host,
    $username,
    $password,
    $database
);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");

?>