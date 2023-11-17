<!DOCTYPE html>
<html>
<head>
    <title>Employee Details Form</title>
    <style>body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f2f2f2;
}

h2 {
    text-align: center;
    color: #333;
}

form {
    max-width: 400px;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}
label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
}

input[type="text"],
input[type="number"],
input[type="email"],
textarea {
    width: 100%;
    padding: 8px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 3px;
}

input[type="radio"] {
    margin-right: 5px;
}
input[type="submit"] {
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 10px 15px;
    border-radius: 3px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #0056b3;
}
</style>
</head>
<body>
    <h2>Employee Details Form</h2>
    <form action="employee_details.php" method="post">
        <label for="name">Name:</label>
        <input type="text" name="name" required><br><br>

        <label for="age">Age:</label>
        <input type="number" name="age" required><br><br>

        <label for="gender">Gender:</label>
        <input type="radio" name="gender" value="Male" required> Male
        <input type="radio" name="gender" value="Female" required> Female<br><br>

        <label for="phone_number">Phone Number:</label>
        <input type="text" name="phone_number" required><br><br>

        <label for="email">Email ID:</label>
        <input type="email" name="email" required><br><br>

        <label for="address">Address:</label>
        <textarea name="address" required></textarea><br><br>

        <label for="department">Department:</label>
        <select name="department" required>
            <option value="Physics">Physics</option>
            <option value="Mathematics">Mathematics</option>
            <option value="Chemistry">Chemistry</option>
            <option value="Biology">Biology</option>
            <option value="English">English</option>
            <option value="Computer Science">Computer Science</option>
        </select><br><br>

        <input type="submit" value="Submit">
    </form>
</body>
</html>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "employees";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = isset($_POST['name']) ? mysqli_real_escape_string($conn, $_POST['name']) : '';
$age = isset($_POST['age']) ? intval($_POST['age']) : 0;
$gender = isset($_POST['gender']) ? $_POST['gender'] : '';
$phone_number = isset($_POST['phone_number']) ? mysqli_real_escape_string($conn, $_POST['phone_number']) : '';
$email = isset($_POST['email']) ? mysqli_real_escape_string($conn, $_POST['email']) : '';
$address = isset($_POST['address']) ? mysqli_real_escape_string($conn, $_POST['address']) : '';
$department = isset($_POST['department']) ? mysqli_real_escape_string($conn, $_POST['department']) : '';

if (empty($name) || empty($age) || empty($gender) || empty($phone_number) || empty($email) || empty($address) || empty($department)) {
    echo "";
} else {
    $sql = "INSERT INTO employees (Name, Age, Gender, Phone, Email, Address, Department)
            VALUES ('$name', $age, '$gender', '$phone_number', '$email', '$address', '$department')";

    if ($conn->query($sql) === TRUE) {
        echo "Employee details added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>