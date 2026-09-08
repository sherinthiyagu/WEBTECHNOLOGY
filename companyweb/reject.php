<?php

session_start();

require_once "db.php";


/* Only admin can reject employees */

if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "admin") {

    header("Location: login.php");
    exit();

}


/* Check employee ID */

if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {

    header("Location: admin.php");
    exit();

}


$employee_id = (int) $_GET["id"];


/* Reject only pending employees */

$sql = "
    UPDATE employees
    SET status = 'rejected'
    WHERE id = ?
    AND status = 'pending'
";


$stmt = $conn->prepare($sql);

$stmt->bind_param(
    "i",
    $employee_id
);

$stmt->execute();

$stmt->close();


/* Return to admin dashboard */

header("Location: admin.php");

exit();

?>