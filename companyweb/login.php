<?php

session_start();

require_once "db.php";

$message = "";
$message_type = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = trim($_POST["username"]);
    $password = $_POST["password"];

    if (empty($username) || empty($password)) {

        $message = "Please enter username and password.";
        $message_type = "error";

    } else {

        /* =========================
           CHECK ADMIN LOGIN
        ========================= */

        $admin_sql = "
            SELECT id, username, password
            FROM admins
            WHERE username = ?
        ";

        $admin_stmt = $conn->prepare($admin_sql);
        $admin_stmt->bind_param("s", $username);
        $admin_stmt->execute();

        $admin_result = $admin_stmt->get_result();

        if ($admin_result->num_rows === 1) {

            $admin = $admin_result->fetch_assoc();

            /*
             * Admin password is currently stored as plain text
             * in the database, so compare directly.
             */

            if ($password === $admin["password"]) {

                session_regenerate_id(true);

                $_SESSION["role"] = "admin";
                $_SESSION["admin_id"] = $admin["id"];
                $_SESSION["admin_username"] = $admin["username"];

                header("Location: admin.php");
                exit();

            } else {

                $message = "Invalid username or password.";
                $message_type = "error";
            }

        } else {

            /* =========================
               CHECK EMPLOYEE LOGIN
            ========================= */

            $employee_sql = "
                SELECT id, name, email, username, password, status
                FROM employees
                WHERE username = ?
                OR email = ?
            ";
            $employee_stmt = $conn->prepare($employee_sql);

            $employee_stmt->bind_param("ss", $username, $username);
            $employee_stmt->execute();

            $employee_result = $employee_stmt->get_result();

            if ($employee_result->num_rows === 1) {

                $employee = $employee_result->fetch_assoc();

                /* =========================
                   PENDING
                ========================= */

                if ($employee["status"] === "pending") {

                    $message =
                        "Your registration is still waiting for admin approval.";

                    $message_type = "error";
                }

                /* =========================
                   REJECTED
                ========================= */

                elseif ($employee["status"] === "rejected") {

                    $message =
                        "Your registration has been rejected by the administrator.";

                    $message_type = "error";
                }

                /* =========================
                   APPROVED
                ========================= */

                elseif ($employee["status"] === "approved") {

                    if ($password === $employee["password"]) {
                        session_regenerate_id(true);

                        $_SESSION["role"] = "employee";
                        $_SESSION["employee_id"] = $employee["id"];
                        $_SESSION["user_name"] = $employee["name"];
                        $_SESSION["user_email"] = $employee["email"];

                        /*
                         * Approved employees go to
                         * the NEXORA company homepage.
                         */

                        header("Location: index.php");
                        exit();

                    } else {

                        $message =
                            "Invalid username or password.";

                        $message_type = "error";
                    }
                }

            } else {

                $message =
                    "Invalid username or password.";

                $message_type = "error";
            }

            $employee_stmt->close();
        }

        $admin_stmt->close();
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
        Login | Nexora Technologies
    </title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

    <div class="login-container">

        <h1 class="company-name">
            NEXORA TECHNOLOGIES
        </h1>

        <h2 class="login-title">
            Login
        </h2>


        <?php if (!empty($message)): ?>

            <div class="message <?php echo $message_type; ?>">

                <?php
                echo htmlspecialchars($message);
                ?>

            </div>

        <?php endif; ?>


        <form method="POST" action="">

            <label for="username">
                Username
            </label>

            <input
                type="text"
                id="username"
                name="username"
                placeholder="Enter username"
                required
            >


            <label for="password">
                Password
            </label>

            <input
                type="password"
                id="password"
                name="password"
                placeholder="Enter password"
                required
            >


            <button type="submit">
                Login
            </button>

        </form>


        <p class="register-text">

            New employee?

            <a href="register.php">
                Register here
            </a>

        </p>

    </div>

</body>

</html>