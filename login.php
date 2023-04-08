<?php
session_start();
require_once 'config.php';

// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Check if the email and password match any user in the database
    $sql = "SELECT * FROM users WHERE email = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // If the email and password match, set the session variable and return success
        $user = $result->fetch_assoc();
        if (isset($user["email"])) { // Update the field name here
            $_SESSION["user_id"] = $user["email"]; // And update the field name here
            $_SESSION["user_name"] = $user["name"];
            echo "Login successful.";
        } else {
            echo "Error: User ID not found.";
        }
    } else {
        echo "Invalid email or password.";
    }

    $stmt->close();
    $conn->close();
}
?>