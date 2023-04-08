<?php
// Start a session
session_start();

// Check if the user is logged in by checking if their user ID is set in the session
if (isset($_SESSION["user_id"])) {
    $loggedIn = true;
} else {
    $loggedIn = false;
}
?>

<!-- Start of the HTML code -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="Images/favicon-32x32.png">
    
    <title>Sci-fi flick</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Orbitron&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#">Sci-fi flick</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="movies_booked.php">Booked movies</a>
                    </li>
                    <!-- Show Login button if the user is not logged in -->
                    <?php if(!$loggedIn){?>
                    <li class="nav-item">
                        <a class="nav-link" id="open-login" href="#">Login</a>
                    </li><?php } ?>
                    <!-- Show Logout button if the user is logged in -->
                    <?php if (isset($_SESSION["user_id"])): ?>
                    <li class="nav-item">
                        <a class="nav-link" id="logout" href="#">Logout</a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Then add a container for the movie details -->
    <div class="container mt-5" id="movie-details">
        <!-- Movie details will be populated using JavaScript/jQuery -->
    </div>

   <!-- Booking Modal -->
<div id="bookingModal" class="modal">
    <div class="modal-content">
        <h2>Book This Movie</h2>
        <form id="bookingForm">
            <!-- Input field for Movie -->
            <div class="form-group">
                <label for="bookingMovie">Movie:</label>
                <input type="text" class="form-control" id="bookingMovie" name="bookingMovie" readonly>
            </div>
            <!-- Input field for Email -->
            <div class="form-group">
                <label for="bookingEmail">Email:</label>
                <input type="email" class="form-control" id="bookingEmail" name="bookingEmail" readonly>
            </div>
            <!-- Input field for Name -->
            <div class="form-group">
                <label for="bookingName">Name:</label>
                <input type="text" class="form-control" id="bookingName" name="bookingName" readonly>
            </div>
            <!-- Select field for Cinema -->
            <div class="form-group">
                <label for="bookingCinema">Cinema:</label>
                <select class="form-control" id="bookingCinema" name="bookingCinema">
                    <option>Select a Cinema</option>
                    <option>Savoy Cinema - Dublin</option>
                    <option>Light House Cinema - Dublin</option>
                    <option>Omniplex Cinema - Cork</option>
                    <option>Eye Cinema - Galway</option>
                    <option>IMC Cinema - Dun Laoghaire</option>
                </select>
                <!-- Add anti-spam field -->
                <label for="humanCheck" style="display:none;">Leave this field blank</label>
                <input type="text" id="humanCheck" name="humanCheck" style="display:none;visibility:hidden;">
                <input type="submit" value="Book Now" style="display:none;visibility:hidden;">
            </div>
            <!-- Select field for Date and Time -->
            <div class="form-group">
                <label for="bookingDateTime">Date and Time:</label>
                <select class="form-control" id="bookingDateTime" name="bookingDateTime" required>
                    <option value="">Select a date and time</option>
                    <option value="2023-04-02T10:30">April 2, 2023 10:30 AM</option>
                    <option value="2023-04-02T14:00">April 2, 2023 2:00 PM</option>
                    <option value="2023-04-03T09:00">April 3, 2023 9:00 AM</option>
                    <option value="2023-04-04T16:30">April 4, 2023 4:30 PM</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Book Now</button>
            <button type="button" class="btn btn-secondary" id="discardBooking">Discard</button>
        </form>
        <form>
            <br>
            <label for="captcha">Please enter the text from the image:</label>
            <br>
            <input type="text" id="captcha" name="captcha">
            <br>
            <img src="captcha.php" alt="Captcha image" id="captcha-image">
        </form>
    </div>
</div>
<div class="container">
        <!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true" data-backdrop="true" data-keyboard="false">

            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Login</h5>
                    </div>
                    <div class="modal-body">
                        <!-- Login Form -->
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
                    <div class="modal-footer">
                        <!-- Register link -->
                        <p>New user? <a href="#" id="register-link">Register Here</a></p>
                    </div>
                </div>
            </div>
        </div>

                  <!-- Registration Form -->
        <!-- A modal for registration with a form inside. -->
        <div class="modal" tabindex="-1" role="dialog" id="register-modal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <!-- A header containing the title of the modal. -->
                        <h5 class="modal-title">Register</h5>
                    </div>
                    <div class="modal-body">
                        <!-- A form to allow the user to input their registration information. -->
                        <form id="register-form">
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <!-- A text input field for the user to input their name. -->
                                <input type="text" class="form-control" id="name" required>
                                <!-- An error message to display if the user inputs an invalid name. -->
                                <div class="invalid-feedback">Please enter a valid name.</div>
                            </div>
                            <div class="form-group">
                                <label for="reg-email">Email:</label>
                                <!-- An email input field for the user to input their email address. -->
                                <input type="email" class="form-control" id="reg-email" required>
                                <!-- An error message to display if the user inputs an invalid email. -->
                                <div class="invalid-feedback">Please enter a valid email.</div>
                            </div>
                            <div class="form-group">
                                <label for="reg-password">Password:</label>
                                <!-- A password input field for the user to input their password. -->
                                <input type="password" class="form-control" id="reg-password" required>
                                <!-- An error message to display if the user inputs an invalid password. -->
                                <div class="invalid-feedback">Please enter a valid password.</div>
                            </div>
                            <!-- A button to submit the registration form. -->
                            <button type="submit" class="btn btn-primary">Register Now</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <!-- A link to allow users who already have an account to navigate to the login page. -->
                        <p>Already have an account? <a href="#" id="login-link">Login Here</a></p>
                    </div>
                </div>
            </div>
        </div>
    <!-- Scripts to include jQuery, Bootstrap, and a custom script file. -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
    <!-- PHP code to check if the user is logged in and get their session information. -->
    <script>
        const checkLoggedIn="<?php echo $loggedIn;?>"
        const userEmail = "<?php echo $_SESSION['user_id']; ?>";
        const userName = "<?php echo $_SESSION['user_name']; ?>";
    </script>
    <!-- JavaScript code to show the login modal when the "open-login" button is clicked. -->
    <script>
        $(document).ready(function() {
            var loginLink = $('#open-login');
            loginLink.on('click', function(event) {
                $("#loginModal").modal("show");
            });
        });
    </script>
</body>
</html>