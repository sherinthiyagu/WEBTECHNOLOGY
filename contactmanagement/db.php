<?php

$conn = new mysqli(
    "sql104.infinityfree.com",
    "if0_43283131",
    "12she34rin",
    "if0_43283131_contacts"
);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");

?>