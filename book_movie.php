<?php
// Include the configuration file
require_once "config.php";

// Check if the request is a POST request and anti-spam field is empty
if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($_POST['humanCheck'])) {

    // Get the values from the POST request
    $movie = $_POST['movie'];
    $bookingDateTime = $_POST['bookingDateTime'];
    $email = $_POST['email'];
    $name = $_POST['name'];
    $cinema = $_POST['cinema'];

    // SQL statement to insert data into the booking table
    $sql = "INSERT INTO booking (movie, bookingDateTime, email, name, cinema) VALUES (?, ?, ?, ?, ?)";

    // Prepare the SQL statement
    $stmt = $conn->prepare($sql);

    // Check if the statement was prepared successfully
    if ($stmt) {

        // Bind the parameters to the statement
        $stmt->bind_param("sssss", $movie, $bookingDateTime, $email, $name, $cinema);

        // Execute the statement and check if it was successful
        if ($stmt->execute()) {
            echo "success";
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        echo "Error: " . $conn->error;
    }

    // Close the statement and the database connection
    $stmt->close();
    $conn->close();
}
?>