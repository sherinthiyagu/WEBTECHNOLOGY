<?php

$conn = new mysqli(
    "sql104.infinityfree.com",
    "if0_43283131",
    "12she34rin",
    "if0_43283131_department"
);

if ($conn->connect_error) {
    die("Database connection failed");
}

?>