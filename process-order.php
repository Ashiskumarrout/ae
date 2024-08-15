<?php
$servername = "localhost";
$username = "root"; // your MySQL username
$password = "password"; // your MySQL password
$dbname = "ashis"; // your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$full_name = $_POST['full-name'];
$phone = $_POST['phone'];
$pincode = $_POST['pincode'];
$state = $_POST['state'];
$city = $_POST['city'];
$house_no = $_POST['house-no'];
$building_name = $_POST['building-name'];
$road = $_POST['road'];
$colony = $_POST['colony'];
$payment_method = $_POST['payment'];

// Insert the data into the database
$sql = "INSERT INTO orders (full_name, phone, pincode, state, city, house_no, building_name, road, colony, payment_method)
VALUES ('$full_name', '$phone', '$pincode', '$state', '$city', '$house_no', '$building_name', '$road', '$colony', '$payment_method')";

if ($conn->query($sql) === TRUE) {
    // Redirect to thank-you page
    header("Location: thank-you.html");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the connection
$conn->close();
?>
