<?php
// Get input values from the form
$username = $_POST['username'];
$password = $_POST['password'];

// Database connection details
$servername = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "db 1"; // Updated to a name without spaces

// Create connection
$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully!<br>";

// Prepare the SQL statement
$stmt = $conn->prepare("INSERT INTO `user` (`username`, `password`) VALUES (?, ?)");

// Check if prepare() succeeded
if ($stmt === false) {
    die("Prepare failed: " . $conn->error);
}

// Bind parameters
$stmt->bind_param("ss", $username, $password); // "ss" specifies the variable types (string)

// Execute the prepared statement
if ($stmt->execute()) {
    echo "New record created successfully.";
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
