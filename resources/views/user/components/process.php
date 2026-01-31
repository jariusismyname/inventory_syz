<?php
// Database connection details
$servername = "localhost";
$username = "root"; // e.g., "root"
$password = ""; // e.g., ""
$dbname = "inventory";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$name = $_POST['name'];
$price = $_POST['price'];
$quantity = $_POST['quantity'];
$lineTotal = $_POST['total'];

// Prepare and execute the SQL INSERT query
// Use prepared statements for security to prevent SQL injection
$stmt = $conn->prepare("INSERT INTO inventories (name, quantity, price,total) VALUES (?, ?, ?,?)");
$stmt->bind_param("sss", $name,$quantity, $price, $total);

if ($stmt->execute()) {
    echo "New record inserted successfully";
} else {
    echo "Error: " . $stmt->error;
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
