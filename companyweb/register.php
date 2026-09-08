<?php

require_once "db.php";

$message = "";
$message_type = "";


/* =========================
   REGISTRATION
========================= */

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $username = trim($_POST["username"]);
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];


    /* Check empty fields */

    if (
        empty($name) ||
        empty($email) ||
        empty($username) ||
        empty($password) ||
        empty($confirm_password)
    ) {

        $message = "Please fill in all fields.";
        $message_type = "error";

    }


    /* Check passwords */

    elseif ($password !== $confirm_password) {

        $message = "Passwords do not match.";
        $message_type = "error";

    }


    /* Check email */

    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $message = "Please enter a valid email address.";
        $message_type = "error";

    }


    else {

        /* Check duplicate username/email */

        $check_sql = "
            SELECT id
            FROM employees
            WHERE username = ?
            OR email = ?
        ";

        $check_stmt = $conn->prepare($check_sql);

        $check_stmt->bind_param(
            "ss",
            $username,
            $email
        );

        $check_stmt->execute();

        $result = $check_stmt->get_result();


        if ($result->num_rows > 0) {

            $message = "Username or email already exists.";
            $message_type = "error";

        }

        else {

            /* Hash password */

            $hashed_password = $password;

            /* New employees are pending */

            $insert_sql = "
                INSERT INTO employees
                (name, email, username, password, status)
                VALUES
                (?, ?, ?, ?, 'pending')
            ";

            $insert_stmt = $conn->prepare($insert_sql);

            $insert_stmt->bind_param(
                "ssss",
                $name,
                $email,
                $username,
                $hashed_password
            );


            if ($insert_stmt->execute()) {

                $message =
                    "Registration successful! Your account is waiting for admin approval.";

                $message_type = "success";

                /* Clear form values */

                $name = "";
                $email = "";
                $username = "";

            }

            else {

                $message =
                    "Registration failed. Please try again.";

                $message_type = "error";

            }


            $insert_stmt->close();
        }


        $check_stmt->close();
    }
}

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Employee Registration | Nexora Technologies
    </title>

    <link rel="stylesheet" href="style.css">

</head>

<body>


    <div class="register-container">

        <h1 class="company-name">
            NEXORA TECHNOLOGIES
        </h1>

        <h2 class="register-title">
            Employee Registration
        </h2>


        <?php if (!empty($message)): ?>

            <div class="message <?php echo $message_type; ?>">

                <?php
                echo htmlspecialchars($message);
                ?>

            </div>

        <?php endif; ?>


        <form method="POST" action="">


            <label for="name">
                Full Name
            </label>

            <input
                type="text"
                id="name"
                name="name"
                placeholder="Enter your full name"
                value="<?php echo htmlspecialchars($name ?? ''); ?>"
                required
            >


            <label for="email">
                Email
            </label>

            <input
                type="email"
                id="email"
                name="email"
                placeholder="Enter your email"
                value="<?php echo htmlspecialchars($email ?? ''); ?>"
                required
            >


            <label for="username">
                Username
            </label>

            <input
                type="text"
                id="username"
                name="username"
                placeholder="Create a username"
                value="<?php echo htmlspecialchars($username ?? ''); ?>"
                required
            >


            <label for="password">
                Password
            </label>

            <input
                type="password"
                id="password"
                name="password"
                placeholder="Create a password"
                required
            >


            <label for="confirm_password">
                Confirm Password
            </label>

            <input
                type="password"
                id="confirm_password"
                name="confirm_password"
                placeholder="Confirm your password"
                required
            >


            <button type="submit">
                Register
            </button>


        </form>


        <p class="login-text">

            Already have an account?

            <a href="login.php">
                Login
            </a>

        </p>


    </div>


</body>

</html>