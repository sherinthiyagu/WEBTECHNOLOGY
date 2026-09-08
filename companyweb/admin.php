<?php

session_start();

require_once "db.php";

/* Only admin can access this page */

if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "admin") {
    header("Location: login.php");
    exit();
}


/* =========================
   PENDING EMPLOYEES
========================= */

$pending_sql = "
    SELECT id, name, email, username, created_at
    FROM employees
    WHERE status = 'pending'
    ORDER BY created_at DESC
";

$pending_result = $conn->query($pending_sql);


/* =========================
   APPROVED EMPLOYEES
========================= */

$approved_sql = "
    SELECT id, name, email, username, created_at
    FROM employees
    WHERE status = 'approved'
    ORDER BY name ASC
";

$approved_result = $conn->query($approved_sql);


/* =========================
   REJECTED EMPLOYEES
========================= */

$rejected_sql = "
    SELECT id, name, email, username, created_at
    FROM employees
    WHERE status = 'rejected'
    ORDER BY name ASC
";

$rejected_result = $conn->query($rejected_sql);

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Dashboard | Nexora Technologies</title>

    <link rel="stylesheet" href="style.css">

</head>

<body class="admin-page">


    <!-- =========================
         ADMIN HEADER
    ========================== -->

    <header class="admin-header">

        <h1>
            NEXORA TECHNOLOGIES
        </h1>

        <p>
            Administrator Dashboard
        </p>

    </header>


    <main class="admin-container">


        <!-- =========================
             WELCOME
        ========================== -->

        <div class="admin-welcome">

            <h2>
                Welcome, <?php echo htmlspecialchars($_SESSION["admin_username"]); ?>
            </h2>

            <p>
                Manage employee registrations and account approvals.
            </p>

        </div>


        <!-- =========================
             PENDING EMPLOYEES
        ========================== -->

        <section class="admin-section">

            <h2>
                Pending Employee Registrations
            </h2>

            <?php if ($pending_result->num_rows > 0): ?>

                <div class="admin-table-container">

                    <table>

                        <thead>

                            <tr>

                                <th>Name</th>

                                <th>Email</th>

                                <th>Username</th>

                                <th>Registered On</th>

                                <th>Action</th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php while ($employee = $pending_result->fetch_assoc()): ?>

                                <tr>

                                    <td>
                                        <?php echo htmlspecialchars($employee["name"]); ?>
                                    </td>

                                    <td>
                                        <?php echo htmlspecialchars($employee["email"]); ?>
                                    </td>

                                    <td>
                                        <?php echo htmlspecialchars($employee["username"]); ?>
                                    </td>

                                    <td>
                                        <?php echo htmlspecialchars($employee["created_at"]); ?>
                                    </td>

                                    <td>

                                        <a
                                            href="approve.php?id=<?php echo $employee["id"]; ?>"
                                            class="approve-btn"
                                        >
                                            Approve
                                        </a>

                                        <a
                                            href="reject.php?id=<?php echo $employee["id"]; ?>"
                                            class="reject-btn"
                                        >
                                            Reject
                                        </a>

                                    </td>

                                </tr>

                            <?php endwhile; ?>

                        </tbody>

                    </table>

                </div>

            <?php else: ?>

                <p class="empty-message">
                    No pending employee registrations.
                </p>

            <?php endif; ?>

        </section>


        <!-- =========================
             APPROVED EMPLOYEES
        ========================== -->

        <section class="admin-section">

            <h2>
                Approved Employees
            </h2>

            <?php if ($approved_result->num_rows > 0): ?>

                <div class="admin-table-container">

                    <table>

                        <thead>

                            <tr>

                                <th>Name</th>

                                <th>Email</th>

                                <th>Username</th>

                                <th>Status</th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php while ($employee = $approved_result->fetch_assoc()): ?>

                                <tr>

                                    <td>
                                        <?php echo htmlspecialchars($employee["name"]); ?>
                                    </td>

                                    <td>
                                        <?php echo htmlspecialchars($employee["email"]); ?>
                                    </td>

                                    <td>
                                        <?php echo htmlspecialchars($employee["username"]); ?>
                                    </td>

                                    <td class="status-approved">
                                        ✓ Approved
                                    </td>

                                </tr>

                            <?php endwhile; ?>

                        </tbody>

                    </table>

                </div>

            <?php else: ?>

                <p class="empty-message">
                    No approved employees yet.
                </p>

            <?php endif; ?>

        </section>


        <!-- =========================
             REJECTED EMPLOYEES
        ========================== -->

        <section class="admin-section">

            <h2>
                Rejected Employees
            </h2>

            <?php if ($rejected_result->num_rows > 0): ?>

                <div class="admin-table-container">

                    <table>

                        <thead>

                            <tr>

                                <th>Name</th>

                                <th>Email</th>

                                <th>Username</th>

                                <th>Status</th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php while ($employee = $rejected_result->fetch_assoc()): ?>

                                <tr>

                                    <td>
                                        <?php echo htmlspecialchars($employee["name"]); ?>
                                    </td>

                                    <td>
                                        <?php echo htmlspecialchars($employee["email"]); ?>
                                    </td>

                                    <td>
                                        <?php echo htmlspecialchars($employee["username"]); ?>
                                    </td>

                                    <td class="status-rejected">
                                        ✕ Rejected
                                    </td>

                                </tr>

                            <?php endwhile; ?>

                        </tbody>

                    </table>

                </div>

            <?php else: ?>

                <p class="empty-message">
                    No rejected employees.
                </p>

            <?php endif; ?>

        </section>


        <!-- =========================
             LOGOUT
        ========================== -->

        <div class="admin-actions">

            <a href="logout.php" class="admin-logout">
                Logout
            </a>

        </div>


    </main>

</body>

</html>