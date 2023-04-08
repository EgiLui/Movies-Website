<?php
session_start();

// Unset the user_id session variable and destroy the session
unset($_SESSION["user_id"]);
session_destroy();

// Redirect the user to the index.php page
header("Location: index.php");
exit();
?>