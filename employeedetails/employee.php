<?php

mysqli_report(MYSQLI_REPORT_OFF);

$conn = new mysqli("localhost", "root", "", "employee_db");

if ($conn->connect_error) {
    die("Connection failed");
}

$error = "";

$name = "";
$email = "";
$phone = "";
$gender = "";
$dob = "";
$department = "";
$designation = "";
$salary = "";
$joining_date = "";
$address = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $gender = $_POST["gender"];
    $dob = $_POST["dob"];
    $department = $_POST["department"];
    $designation = $_POST["designation"];
    $salary = $_POST["salary"];
    $joining_date = $_POST["joining_date"];
    $address = $_POST["address"];


    $sql = "INSERT INTO employees
    (name, email, phone, gender, dob, department, designation, salary, joining_date, address)
    VALUES
    ('$name', '$email', '$phone', '$gender', '$dob', '$department', '$designation', '$salary', '$joining_date', '$address')";


    if ($conn->query($sql) === TRUE) {

        $employee_id = $conn->insert_id;

        header("Location: view.php?id=$employee_id&success=1");
        exit();

    } else {

        if ($conn->errno == 1062) {

            $error = "Email already exists!";

        } else {

            $error = "Error: " . $conn->error;

        }
    }
}

?>


<!DOCTYPE html>
<html>

<head>

    <title>Employee Details</title>

    <link rel="stylesheet" href="employee.css">

    <style>

        .error-message {

            background-color: #f8d7da;

            color: #842029;

            border: 1px solid #f5c2c7;

            padding: 12px;

            margin-bottom: 20px;

            border-radius: 5px;

            text-align: center;

            font-weight: bold;

            font-size: 18px;

        }

    </style>

</head>


<body>


<div class="form-box">


    <h2>Employee Details</h2>


    <?php if ($error != "") { ?>

        <div class="error-message">

            <?php echo $error; ?>

        </div>

    <?php } ?>


    <form action="employee.php" method="POST">


        <label>Employee Name</label>

        <input type="text"
               name="name"
               placeholder="Enter employee name"
               value="<?php echo htmlspecialchars($name); ?>"
               required>


        <label>Email</label>

        <input type="email"
               name="email"
               placeholder="Enter email"
               value="<?php echo htmlspecialchars($email); ?>"
               required>


        <label>Phone</label>

        <input type="text"
               name="phone"
               placeholder="Enter phone number"
               value="<?php echo htmlspecialchars($phone); ?>"
               required>


        <label>Gender</label>

        <select name="gender" required>

            <option value="">Select Gender</option>

            <option value="Male"
                <?php if ($gender == "Male") echo "selected"; ?>>
                Male
            </option>

            <option value="Female"
                <?php if ($gender == "Female") echo "selected"; ?>>
                Female
            </option>

            <option value="Other"
                <?php if ($gender == "Other") echo "selected"; ?>>
                Other
            </option>

        </select>


        <label>Date of Birth</label>

        <input type="date"
               name="dob"
               value="<?php echo htmlspecialchars($dob); ?>"
               required>


        <label>Department</label>

        <select name="department" required>

            <option value="">Select Department</option>

            <option value="IT"
                <?php if ($department == "IT") echo "selected"; ?>>
                IT
            </option>

            <option value="HR"
                <?php if ($department == "HR") echo "selected"; ?>>
                HR
            </option>

            <option value="Finance"
                <?php if ($department == "Finance") echo "selected"; ?>>
                Finance
            </option>

            <option value="Marketing"
                <?php if ($department == "Marketing") echo "selected"; ?>>
                Marketing
            </option>

        </select>


        <label>Designation</label>

        <input type="text"
               name="designation"
               placeholder="Enter designation"
               value="<?php echo htmlspecialchars($designation); ?>"
               required>


        <label>Salary</label>

        <input type="number"
               name="salary"
               placeholder="Enter salary"
               value="<?php echo htmlspecialchars($salary); ?>"
               required>


        <label>Joining Date</label>

        <input type="date"
               name="joining_date"
               value="<?php echo htmlspecialchars($joining_date); ?>"
               required>


        <label>Address</label>

        <textarea name="address"
                  placeholder="Enter address"
                  required><?php echo htmlspecialchars($address); ?></textarea>


        <button type="submit">

            Submit

        </button>


    </form>


</div>


</body>

</html>


<?php

$conn->close();

?>