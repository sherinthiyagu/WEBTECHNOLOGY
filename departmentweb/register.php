<?php

include "db.php";

$message = "";
$message_type = "";

if (isset($_POST["register"])) {

    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    // Check if email already exists
    $check_sql = "SELECT id FROM users WHERE email = ?";

    $check_stmt = $conn->prepare($check_sql);

    if ($check_stmt) {

        $check_stmt->bind_param("s", $email);
        $check_stmt->execute();

        $check_result = $check_stmt->get_result();

        if ($check_result->num_rows > 0) {

            $message = "This email is already registered.";
            $message_type = "error";

        } else {

            // Hash password
            $hashed_password = password_hash(
                $password,
                PASSWORD_DEFAULT
            );

            $sql = "INSERT INTO users (name, email, password)
                    VALUES (?, ?, ?)";

            $stmt = $conn->prepare($sql);

            if ($stmt) {

                $stmt->bind_param(
                    "sss",
                    $name,
                    $email,
                    $hashed_password
                );

                if ($stmt->execute()) {

                    $message = "Registration successful! You can now login.";
                    $message_type = "success";

                } else {

                    $message = "Registration failed. Please try again.";
                    $message_type = "error";

                }

                $stmt->close();

            } else {

                $message = "Something went wrong. Please try again.";
                $message_type = "error";

            }
        }

        $check_stmt->close();

    } else {

        $message = "Database error. Please try again.";
        $message_type = "error";

    }
}

?>

<!DOCTYPE html>
<html>
<head>

    <title>Register</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<div class="form-box">

    <h2>Registration</h2>

    <?php if (!empty($message)): ?>

        <div class="message <?php echo $message_type; ?>">
            <?php echo htmlspecialchars($message); ?>
        </div>

    <?php endif; ?>

    <form method="POST" onsubmit="return validateForm()">

        <label>Name</label>

        <input
            type="text"
            name="name"
            id="name"
            required
        >

        <label>Email</label>

        <input
            type="email"
            name="email"
            required
        >

        <label>Password</label>

        <input
            type="password"
            name="password"
            id="password"
            required
        >

        <button type="submit" name="register">
            Register
        </button>

    </form>

    <p>Already registered?</p>

    <a href="login.php">
        Login
    </a>

</div>

<script src="script.js"></script>

</body>
</html>