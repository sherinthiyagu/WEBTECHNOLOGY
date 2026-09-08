<?php

session_start();

/* Only logged-in approved employees can access this page */

if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "employee") {
    header("Location: login.php");
    exit();
}

$user_name = $_SESSION["user_name"];
$user_email = $_SESSION["user_email"];

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description"
          content="Nexora Technologies - Employee Portal">

    <title>Nexora Technologies | Home</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

    <!-- ================= NAVBAR ================= -->

    <header class="navbar">

        <div class="logo">
            NEXORA
            <span>TECHNOLOGIES</span>
        </div>

        <nav>

            <a href="#home">Home</a>
            <a href="#about">About</a>
            <a href="#services">Services</a>
            <a href="#contact">Contact</a>

            <a href="logout.php" class="logout-btn">
                Logout
            </a>

        </nav>

    </header>


    <!-- ================= HOME ================= -->

    <section id="home" class="hero">

        <div class="hero-content">

            <p class="welcome-label">
                WELCOME TO NEXORA TECHNOLOGIES
            </p>

            <h1>
                Innovating Today.<br>
                <span>Building Tomorrow.</span>
            </h1>

            <p class="hero-text">
                Welcome to the NEXORA employee portal.
                We create innovative digital solutions that
                help businesses grow, connect and succeed.
            </p>

            <div class="hero-buttons">

                <a href="#about" class="primary-btn">
                    Explore Company
                </a>

                <a href="#services" class="secondary-btn">
                    Our Services
                </a>

            </div>

        </div>

    </section>


    <!-- ================= EMPLOYEE WELCOME ================= -->

    <section class="employee-section">

        <div class="employee-card">

            <div class="employee-icon">
                👤
            </div>

            <div>

                <p class="small-title">
                    EMPLOYEE PORTAL
                </p>

                <h2>
                    Welcome, <?php echo htmlspecialchars($user_name); ?>!
                </h2>

                <p>
                    You are successfully logged in as an
                    approved NEXORA Technologies employee.
                </p>

                <p class="employee-email">
                    <?php echo htmlspecialchars($user_email); ?>
                </p>

            </div>

            <div class="approved-badge">
                ✓ Approved Employee
            </div>

        </div>

    </section>


    <!-- ================= ABOUT ================= -->

    <section id="about" class="section">

        <div class="section-heading">

            <p class="section-label">
                WHO WE ARE
            </p>

            <h2>
                About NEXORA Technologies
            </h2>

            <p>
                Technology that transforms ideas into reality.
            </p>

        </div>


        <div class="about-content">

            <div class="about-text">

                <h3>
                    Empowering businesses through technology
                </h3>

                <p>
                    NEXORA TECHNOLOGIES is a technology company
                    focused on creating reliable, scalable and
                    innovative digital solutions.
                </p>

                <p>
                    Our team combines creativity, technology and
                    business knowledge to develop solutions that
                    solve real-world problems.
                </p>

                <div class="about-points">

                    <div>
                        <strong>01</strong>
                        <span>Innovation</span>
                    </div>

                    <div>
                        <strong>02</strong>
                        <span>Quality</span>
                    </div>

                    <div>
                        <strong>03</strong>
                        <span>Trust</span>
                    </div>

                </div>

            </div>


            <div class="about-box">

                <div class="about-box-icon">
                    🚀
                </div>

                <h3>
                    Our Vision
                </h3>

                <p>
                    To become a trusted technology partner by
                    delivering meaningful and innovative digital
                    experiences.
                </p>

            </div>

        </div>

    </section>


    <!-- ================= SERVICES ================= -->

    <section id="services" class="section services-section">

        <div class="section-heading">

            <p class="section-label">
                WHAT WE DO
            </p>

            <h2>
                Our Services
            </h2>

            <p>
                Technology solutions designed for modern businesses.
            </p>

        </div>


        <div class="service-grid">


            <div class="service-card">

                <div class="service-icon">
                    💻
                </div>

                <h3>
                    Web Development
                </h3>

                <p>
                    Modern, responsive and user-friendly websites
                    designed for businesses and organizations.
                </p>

            </div>


            <div class="service-card">

                <div class="service-icon">
                    📱
                </div>

                <h3>
                    Application Development
                </h3>

                <p>
                    Scalable applications that provide powerful
                    digital experiences across platforms.
                </p>

            </div>


            <div class="service-card">

                <div class="service-icon">
                    ☁️
                </div>

                <h3>
                    Cloud Solutions
                </h3>

                <p>
                    Secure and flexible cloud-based solutions
                    that help businesses operate efficiently.
                </p>

            </div>


            <div class="service-card">

                <div class="service-icon">
                    🔐
                </div>

                <h3>
                    Cyber Security
                </h3>

                <p>
                    Security-focused solutions that help protect
                    business systems and valuable information.
                </p>

            </div>


        </div>

    </section>


    <!-- ================= WHY US ================= -->

    <section class="why-section">

        <div class="section-heading">

            <p class="section-label">
                WHY NEXORA
            </p>

            <h2>
                Why Choose Us?
            </h2>

        </div>


        <div class="why-grid">

            <div class="why-card">

                <h3>
                    Innovation
                </h3>

                <p>
                    We continuously explore new technologies
                    to create better solutions.
                </p>

            </div>


            <div class="why-card">

                <h3>
                    Experienced Team
                </h3>

                <p>
                    Our team works together to turn ideas into
                    practical and effective solutions.
                </p>

            </div>


            <div class="why-card">

                <h3>
                    Customer Focus
                </h3>

                <p>
                    We focus on understanding requirements and
                    delivering solutions that create value.
                </p>

            </div>


            <div class="why-card">

                <h3>
                    Reliable Solutions
                </h3>

                <p>
                    Quality and reliability are at the center
                    of everything we build.
                </p>

            </div>

        </div>

    </section>


    <!-- ================= CONTACT ================= -->

    <section id="contact" class="section contact-section">

        <div class="section-heading">

            <p class="section-label">
                GET IN TOUCH
            </p>

            <h2>
                Contact Us
            </h2>

            <p>
                Have a question? We'd love to hear from you.
            </p>

        </div>


        <div class="contact-grid">

            <div class="contact-card">

                <div class="contact-icon">
                    📧
                </div>

                <h3>
                    Email
                </h3>

                <p>
                    info@nexoratechnologies.com
                </p>

            </div>


            <div class="contact-card">

                <div class="contact-icon">
                    📞
                </div>

                <h3>
                    Phone
                </h3>

                <p>
                    +91 98765 43210
                </p>

            </div>


            <div class="contact-card">

                <div class="contact-icon">
                    📍
                </div>

                <h3>
                    Location
                </h3>

                <p>
                    Bengaluru, India
                </p>

            </div>

        </div>

    </section>


    <!-- ================= FOOTER ================= -->

    <footer class="footer">

        <div class="footer-logo">
            NEXORA TECHNOLOGIES
        </div>

        <p>
            Innovation. Technology. Growth.
        </p>

        <p class="copyright">
            &copy; <?php echo date("Y"); ?>
            NEXORA TECHNOLOGIES. All Rights Reserved.
        </p>

    </footer>


</body>

</html>