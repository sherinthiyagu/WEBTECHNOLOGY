<?php
include "db.php";

if (isset($_POST['submit'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $sql = "INSERT INTO contacts (name, email, phone, address)
            VALUES ('$name', '$email', '$phone', '$address')";

    if ($conn->query($sql)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>

<head>

    <title>Add Contact</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<div class="form-container">

    <h1>Add Contact</h1>

    <form method="POST">

        <label>Name</label>
        <input type="text" name="name" required>

        <label>Email</label>
        <input type="email" name="email" required>

        <label>Phone</label>
        <input type="text" name="phone" required>

        <label>Address</label>
        <textarea name="address"></textarea>

        <button type="submit" name="submit">
            Add Contact
        </button>

    </form>

    <a href="index.php">← Back to Contacts</a>

</div>

</body>

</html>