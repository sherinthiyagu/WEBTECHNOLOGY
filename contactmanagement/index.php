<?php
include "db.php";

$result = $conn->query("SELECT * FROM contacts ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Contact Management</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

    <h1>Contact Management System</h1>

    <a href="add.php" class="add-btn">+ Add Contact</a>

    <table>

        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Actions</th>
        </tr>

        <?php while ($row = $result->fetch_assoc()) { ?>

        <tr>

            <td><?php echo $row['id']; ?></td>

            <td><?php echo htmlspecialchars($row['name']); ?></td>

            <td><?php echo htmlspecialchars($row['email']); ?></td>

            <td><?php echo htmlspecialchars($row['phone']); ?></td>

            <td><?php echo htmlspecialchars($row['address']); ?></td>

            <td>

                <a href="edit.php?id=<?php echo $row['id']; ?>"
                   class="edit-btn">
                    Edit
                </a>

                <a href="delete.php?id=<?php echo $row['id']; ?>"
                   class="delete-btn"
                   onclick="return confirmDelete();">
                    Delete
                </a>

            </td>

        </tr>

        <?php } ?>

    </table>

</div>

<script src="script.js"></script>

</body>
</html>