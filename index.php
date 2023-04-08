<?php
// Start a new session
session_start();

// Check if a user is logged in by checking if their user ID is set in the session
if (isset($_SESSION["user_id"])) {
    $loggedIn = true;
} else {
    $loggedIn = false;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="Images/favicon-32x32.png">

    <title>Sci-fi flick</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Orbitron&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/styles.css">

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Bootstrap JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#">Sci-fi flick</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar items -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Home</a>
                    </li>

                    <!-- Show the login button if the user is not logged in -->
                    <?php if(!$loggedIn){?>
                    <li class="nav-item">
                        <a class="nav-link" id="open-login" href="#">Login</a>
                    </li>
                    <?php } ?>

                    <!-- Show the logout button if the user is logged in -->
                    <?php if (isset($_SESSION["user_id"])): ?>
                    <li class="nav-item">
                        <a class="nav-link" id="logout" href="#">Logout</a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>


    <div class="container">
        <!-- Login Modal -->
        <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true" data-backdrop="true" data-keyboard="false">
            <!-- Login Modal dialog -->
            <div class="modal-dialog" role="document">
                <!-- Login Modal content -->
                <div class="modal-content">
                    <!-- Login Modal header -->
                    <div class="modal-header">
                        <h5 class="modal-title">Login</h5>
                    </div>
                    <!-- Login Modal body -->
                    <div class="modal-body">
                        <form id="login-form">
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" required>
                                <div class="invalid-feedback">Please enter a valid email.</div>
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" id="password" required>
                                <div class="invalid-feedback">Please enter a valid password.</div>
                            </div>
                            <button type="submit" class="btn btn-primary">Login</button>
                        </form>
                    </div>
                    <!-- Login Modal footer -->
                    <div class="modal-footer">
                        <p>New user? <a href="#" id="register-link">Register Here</a></p>
                    </div>
                </div>
            </div>
        </div>

    <!-- Registration Form Modal -->
    <div class="modal" tabindex="-1" role="dialog" id="register-modal">
        <!-- Registration Form dialog -->
        <div class="modal-dialog" role="document">
            <!-- Registration Form content -->
            <div class="modal-content">
                <!-- Registration Form header -->
                <div class="modal-header">
                    <h5 class="modal-title">Register</h5>
                </div>
                <!-- Registration Form body -->
                <div class="modal-body">
                    <form id="register-form">
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" id="name" required>
                            <div class="invalid-feedback">Please enter a valid name.</div>
                        </div>
                        <div class="form-group">
                            <label for="reg-email">Email:</label>
                            <input type="email" class="form-control" id="reg-email" required>
                            <div class="invalid-feedback">Please enter a valid email.</div>
                        </div>
                        <div class="form-group">
                            <label for="reg-password">Password:</label>
                            <input type="password" class="form-control" id="reg-password" required>
                            <div class="invalid-feedback">Please enter a valid password.</div>
                        </div>
                        <button type="submit" class="btn btn-primary">Register Now</button>
                    </form>
                </div>
                <!-- Registration Form footer -->
                <div class="modal-footer">
                    <p>Already have an account? <a href="#" id="login-link">Login Here</a></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Display filter and movie cards -->
    <div class="movies-section">
            <!-- Section where users can filter the movies -->
            <div class="filter">
                <label for="actors-filter">Filter:</label>
                <!-- Dropdown menu for the filter options -->
                <select class="form-control" id="actors-filter">
                    <!-- The dropdown options will be added dynamically using JavaScript/jQuery -->
                </select>
            </div>
            <!-- Container for the movie cards -->
            <div class="row movie-cards">
                <!-- The movie cards will be added dynamically using JavaScript/jQuery -->
            </div>
        </div>
    </div>
    <!-- Link the external JavaScript file to the HTML file -->
    <script src="js/script.js"></script>
    <script>
        $(document).ready(function() {
            // Open the login modal when the login button is clicked
            var loginLink = $('#open-login');
            loginLink.on('click', function(event) {
                $("#loginModal").modal("show");
            });
        });
    </script>
</body>
</html>
