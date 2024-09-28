<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "country";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to select all countries
$sql = "SELECT country_id, country_name FROM country";
$result = $conn->query($sql);

// Fetch data and return as JSON
$countries = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $countries[] = $row;
    }
}
echo json_encode($countries);

// Close connection
$conn->close();
?>
