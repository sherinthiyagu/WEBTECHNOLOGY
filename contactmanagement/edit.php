<?php

include "db.php";

$id = $_GET['id'];

$result = $conn->query("SELECT * FROM contacts WHERE id=$id");

$row = $result->fetch_assoc();

if (isset($_POST['update'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $sql = "UPDATE contacts SET
            name='$name',
            email='$email',
            phone='$phone',
            address='$address'
            WHERE id=$id";

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

    <title>Edit Contact</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<div class="form-container">

    <h1>Edit Contact</h1>

    <form method="POST">

        <label>Name</label>

        <input type="text"
               name="name"
               value="<?php echo htmlspecialchars($row['name']); ?>"
               required>


        <label>Email</label>

        <input type="email"
               name="email"
               value="<?php echo htmlspecialchars($row['email']); ?>"
               required>


        <label>Phone</label>

        <input type="text"
               name="phone"
               value="<?php echo htmlspecialchars($row['phone']); ?>"
               required>


        <label>Address</label>

        <textarea name="address"><?php
            echo htmlspecialchars($row['address']);
        ?></textarea>


        <button type="submit" name="update">
            Update Contact
        </button>

    </form>

    <a href="index.php">← Back to Contacts</a>

</div>

</body>

</html>