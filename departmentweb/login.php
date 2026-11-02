
<?php
session_start();
include "db.php";

$message = "";
$message_type = "";

if (isset($_POST["login"])) {

    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE email = ?";

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        error_log("Login prepare failed: " . $conn->error);
        $message = "Unable to process login right now.";
        $message_type = "error";
    } else {
        $stmt->bind_param("s", $email);

        if (!$stmt->execute()) {
            error_log("Login execute failed: " . $stmt->error);
            $message = "Unable to process login right now.";
            $message_type = "error";
        } else {
            $result = $stmt->get_result();

            if ($result && $result->num_rows === 1) {
                $user = $result->fetch_assoc();

                if (password_verify($password, $user["password"])) {
                    $_SESSION["user_id"] = $user["id"];

                    // Use whichever column your table actually has.
                    $_SESSION["user_name"] = $user["name"]
                        ?? $user["username"]
                        ?? "";

                    header("Location: index.php");
                    exit();
                }
            }

            if (empty($message)) {
                $message = "Invalid email or password";
                $message_type = "error";
            }
        }

        $stmt->close();
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login | Department of Computer Applications</title>

    <link rel="stylesheet" href="style.css">

</head>


<body>


<div class="form-box">

    <h2>Login</h2>


    <?php if (!empty($message)): ?>

        <div class="message <?php echo $message_type; ?>">

            <?php echo htmlspecialchars($message); ?>

        </div>

    <?php endif; ?>


    <form method="POST">


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
            required
        >


        <button type="submit" name="login">

            Login

        </button>


    </form>


    <p>
        Don't have an account?
    </p>


    <a href="register.php">

        Register

    </a>


</div>


</body>

</html>