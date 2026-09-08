<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Department of Computer Applications</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>


<nav>

    <div class="brand">

        <h2>Department of Computer Applications</h2>

        <p>School of Engineering and Technology</p>

        <span>Pondicherry University</span>

    </div>


    <div class="nav-links">

        <a href="index.php">Home</a>


        <?php if (isset($_SESSION['user_id'])): ?>

            <!-- AFTER LOGIN -->

            <a href="about.php">About Us</a>

            <a href="logout.php" class="logout-btn">
                Logout
            </a>


        <?php else: ?>

            <!-- BEFORE LOGIN -->

            <a href="login.php">Login</a>

            <a href="register.php">Register</a>


        <?php endif; ?>

    </div>

</nav>



<section class="hero">

    <div class="hero-content">

        <p class="welcome">
            WELCOME TO OUR DEPARTMENT
        </p>


        <h1>
            Department of<br>
            Computer Applications
        </h1>


        <p class="description">

            School of Engineering and Technology<br>
            Pondicherry University

        </p>


        <?php if (!isset($_SESSION['user_id'])): ?>

            <a href="register.php" class="button">
                Get Started
            </a>

        <?php else: ?>

            <a href="about.php" class="button">
                Explore Department
            </a>

        <?php endif; ?>


    </div>

</section>



<section class="info">


    <div class="info-card">

        <h3>
            Academic Excellence
        </h3>

        <p>
            Providing quality education and developing
            skilled professionals in computer applications.
        </p>

    </div>



    <div class="info-card">

        <h3>
            Innovation & Technology
        </h3>

        <p>
            Encouraging students to explore emerging
            technologies and innovative solutions.
        </p>

    </div>



    <div class="info-card">

        <h3>
            Student Community
        </h3>

        <p>
            Building a collaborative environment for
            learning, research and professional growth.
        </p>

    </div>


</section>


</body>

</html>