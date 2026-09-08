<?php

$conn = new mysqli("localhost", "root", "", "employee_db");

if ($conn->connect_error) {
    die("Connection failed");
}

if (!isset($_GET["id"])) {
    die("Employee ID not found");
}

$id = $_GET["id"];

$sql = "SELECT * FROM employees WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    die("Employee not found");
}

$row = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html>

<head>

    <title>Employee Details</title>

    <link rel="stylesheet" href="employee.css">

    <style>

        .employee-card {
            width: 500px;
            margin: 50px auto;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px #ccc;
        }

        .employee-card h1 {
            text-align: center;
            color: #198754;
            margin-bottom: 5px;
        }

        .employee-card h2 {
            text-align: center;
            color: #555;
            margin-top: 5px;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #198754;
        }

        .success-message {
            text-align: center;
            color: #198754;
            font-weight: bold;
            font-size: 18px;
            margin-bottom: 20px;
        }

        .employee-detail {
            display: flex;
            padding: 12px 0;
            border-bottom: 1px solid #ddd;
        }

        .employee-detail label {
            width: 160px;
            margin: 0;
            font-weight: bold;
            color: #333;
        }

        .employee-detail span {
            flex: 1;
            color: #555;
            text-align: left;
            word-wrap: break-word;
        }

    </style>

</head>

<body>

<div class="employee-card">

    <?php

    if (isset($_GET["success"])) {

    ?>

        <div class="success-message">
            Employee added successfully!
        </div>

    <?php

    }

    ?>

    <h1>HexaNova</h1>

    <h2>Employee Details</h2>


    <div class="employee-detail">
        <label>Employee Name</label>
        <span><?php echo $row["name"]; ?></span>
    </div>


    <div class="employee-detail">
        <label>Email</label>
        <span><?php echo $row["email"]; ?></span>
    </div>


    <div class="employee-detail">
        <label>Phone</label>
        <span><?php echo $row["phone"]; ?></span>
    </div>


    <div class="employee-detail">
        <label>Gender</label>
        <span><?php echo $row["gender"]; ?></span>
    </div>


    <div class="employee-detail">
        <label>Date of Birth</label>
        <span><?php echo $row["dob"]; ?></span>
    </div>


    <div class="employee-detail">
        <label>Department</label>
        <span><?php echo $row["department"]; ?></span>
    </div>


    <div class="employee-detail">
        <label>Designation</label>
        <span><?php echo $row["designation"]; ?></span>
    </div>


    <div class="employee-detail">
        <label>Salary</label>
        <span>₹ <?php echo $row["salary"]; ?></span>
    </div>


    <div class="employee-detail">
        <label>Joining Date</label>
        <span><?php echo $row["joining_date"]; ?></span>
    </div>


    <div class="employee-detail">
        <label>Address</label>
        <span><?php echo $row["address"]; ?></span>
    </div>

</div>

</body>

</html>

<?php

$conn->close();

?>