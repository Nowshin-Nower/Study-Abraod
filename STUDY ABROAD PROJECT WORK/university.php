<?php
// Check if a country is selected
if(isset($_GET['country'])) {
    // Sanitize the input
    $country = htmlspecialchars($_GET['country']);

    // Connect to the database (replace with your database connection code)
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

    // Prepare a SQL query to fetch universities based on the selected country
    $sql = "SELECT * FROM university WHERE country = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $country);
    $stmt->execute();
    $result = $stmt->get_result();

    // Display the universities
    echo "<h2>Universities in $country:</h2>";
    while($row = $result->fetch_assoc()) {
        echo "<p>Name: " . $row["name"] . "</p>";
        echo "<p>Location: " . $row["location"] . "</p>";
        // Add more university information fields as needed
    }

    // Close connection
    $conn->close();
} else {
    // Redirect if no country is selected
    header("Location: country.php");
    exit();
}
?>
