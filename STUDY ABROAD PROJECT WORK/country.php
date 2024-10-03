<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "study_abroad";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if a country is selected
if(isset($_GET['country'])) {
    $country = $_GET['country'];

    // Fetch universities based on the selected country
    $sql = "SELECT * FROM university WHERE country_id = (SELECT country_id FROM country WHERE country_name = '$country')";
    $result = $conn->query($sql);

    // Display universities
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<h3>" . $row["UNI_NAME"] . "</h3>";
            echo "<p>Location: " . $row["LOCATION"] . "</p>";
            // Display other information as needed
        }
    } else {
        echo "No universities found in $country.";
    }
}

// Close connection
$conn->close();
?>
