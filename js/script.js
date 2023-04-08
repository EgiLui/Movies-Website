$(document).ready(function() {


    // Load XML data and populate movie cards and filter dropdown
    $.ajax({
        url: "listing.xml",
        dataType: "xml",
        success: function(xml) {
            let actors = new Set();
            $(xml).find("movie").each(function() {
                const id = $(this).attr("id");
                const name = $(this).find("name").text();
                const actor = $(this).find("actor").text();
                const img = $(this).find("picture").first().text();

                actors.add(actor);

                const movieCard = `
    <div class="col-md-4 mb-3 movie-card" data-actor="${actor}">
        <div class="card">
            <img src="${img}" class="card-img-top" alt="${name}">
            <div class="card-body">
                <h3 class="card-title">${name}</h3>
                <p class="card-text">${actor}</p>
            </div>
        </div>
    </div>
`;


                const movieCardWrapper = $(movieCard);
                movieCardWrapper.on("click", function() {
                    location.href = `listing.php?movie=${id}`;
                });
                $(".movie-cards").append(movieCardWrapper);
            });

            $("#actors-filter").append("<option>All Actors</option>");
            actors.forEach(actor => {
                $("#actors-filter").append(`<option>${actor}</option>`);
            });
        }
    });

    // Toggle between Login and Registration forms

    $("#register-link").click(function() {
        $("#login-modal").modal("hide");
        $("#register-modal").modal("show");
    });

    $("#login-link").click(function() {
        $("#register-modal").modal("hide");
        $("#login-modal").modal("show");
    });

    // Login form validation
    $("#login-form").submit(function(e) {
        e.preventDefault(); // prevent the default form submission behavior
        
        let isValid = true;

        // check if the email is valid using the validateEmail function
        if (!validateEmail($("#email").val())) {
            $("#email").addClass("is-invalid");
            isValid = false;
        } else {
            $("#email").removeClass("is-invalid");
        }

        // check if the password is not empty
        if ($("#password").val().trim() === "") {
            $("#password").addClass("is-invalid");
            isValid = false;
        } else {
            $("#password").removeClass("is-invalid");
        }

        // if the form is valid, send a POST request to login.php with the form data
        if (isValid) {
            const email = $("#email").val();
            const password = $("#password").val();

        // use the jQuery $.post() method to submit the form data as a POST request to login.php
        $.post("login.php", { email: email, password: password }, function(data) {
            if (data === "Login successful.") {
                // If successful, reload the page
                location.reload();
            } else {
                alert(data); // Show error message
            }
        });
    }
});

// Logout button click event
    $("#logout").click(function() {
        // Send a GET request to logout.php
        location.href = "logout.php";
    });

    // jQuery function that is triggered when the registration form is submitted
    $("#register-form").submit(function(e) {
        e.preventDefault(); // Prevent the form from submitting normally
    
        let isValid = true; // Flag to track if the form is valid or not

        // Check if the name field is empty
        if ($("#name").val().trim() === "") {
            $("#name").addClass("is-invalid"); // Add the "is-invalid" class to highlight the field as invalid
            isValid = false; // Set the flag to false since the form is not valid
        } else {
            $("#name").removeClass("is-invalid"); // Remove the "is-invalid" class to indicate that the field is valid
        }

        // Check if the email field is a valid email address
        if (!validateEmail($("#reg-email").val())) {
            $("#reg-email").addClass("is-invalid"); // Add the "is-invalid" class to highlight the field as invalid
            isValid = false; // Set the flag to false since the form is not valid
        } else {
            $("#reg-email").removeClass("is-invalid"); // Remove the "is-invalid" class to indicate that the field is valid
        }

        // Check if the password field is empty
        if ($("#reg-password").val().trim() === "") {
            $("#reg-password").addClass("is-invalid"); // Add the "is-invalid" class to highlight the field as invalid
            isValid = false; // Set the flag to false since the form is not valid
        } else {
            $("#reg-password").removeClass("is-invalid"); // Remove the "is-invalid" class to indicate that the field is valid
        }

        // If the form is valid, send a POST request to the server to register the user
        if (isValid) {
            const name = $("#name").val();
            const email = $("#reg-email").val();
            const password = $("#reg-password").val();

            // Send a POST request to register.php with the form data
            $.post("register.php", { name: name, email: email, password: password }, function(data) {
                // If registration is successful, hide the registration modal and show the login modal
                if (data === "Registration successful.") {
                    $("#register-modal").modal("hide");
                    $("#login-modal").modal("show");
                } else {
                    alert(data); // Show an error message if registration failed
                }
            });
        }
    });

    // Email validation function
    function validateEmail(email) {
        const regex = /^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/;
        return regex.test(email);
    }
});

// Event listener for the "actors-filter" select element
$("#actors-filter").on("change", function() {
// Get the selected actor value
var selectedActor = $(this).val();
    // Iterate over each movie card
    $(".movie-card").each(function() {
        // Get the actor data attribute value of the current movie card
        var movieActor = $(this).data("actor");

        // If the selected actor is "All Actors" or the movie actor matches the selected actor, show the movie card
        if (selectedActor === "All Actors" || movieActor === selectedActor) {
            $(this).show();
        } else {
            // Otherwise, hide the movie card
            $(this).hide();
        }
    });
});

// Declare a variable called bookMovie and assign an empty string to it
var bookMovie = "";

// Define a function called showMovieDetails that takes in a movieId parameter
function showMovieDetails(movieId) {
    // Make an AJAX request to retrieve movie details from a listing.xml file
    $.ajax({
      url: "listing.xml",
      dataType: "xml",
      success: function(xml) {
            // Find the movie with the given ID
            const movie = $(xml).find(`movie[id="${movieId}"]`);
            // Get the movie name, actor, description, and pictures from the XML data
            const name = movie.find("name").text();
            const actor = movie.find("actor").text();
            const description = movie.find("description").text();
            const pictures = movie.find("picture");
    
            // Create an HTML string to display the movie details on the page
            const movieDetails = `
          <h2>${name}</h2>
          <p><strong>Actor:</strong> ${actor}</p>
          <p class="text-justify">${description}</p>
          <div class="row">
            ${pictures.map((_, pic) => `
              <div class="col-md-4">
                <img src="${$(pic).text()}" class="img-fluid movie-image mb-3" alt="${name}">
              </div>
            `).get().join('')}
          </div>
  
          <div class="mt-3 listing-buttons">
            <button class="btn btn-primary" onclick="location.href='index.php'">Back to Listing</button>
            <button class="btn btn-primary" onclick="showMovieDetails(${movieId - 1})"${movieId === 1 ? ' disabled' : ''}>Previous Movie</button>
            <button class="btn btn-primary" onclick="showMovieDetails(${movieId + 1})"${movieId === 9 ? ' disabled' : ''}>Next Movie</button>
            <button id="bookMovieBtn" onclick="bookNowModal()" class="btn btn-primary">Book This Movie</button>
          </div>
        `;
  
        // Display the movie details on the page
        $("#movie-details").html(movieDetails);
      }
    });
  }
  
  // When the document is ready...
  $(document).ready(function () {
    // Get the movie ID parameter from the URL
    const urlParams = new URLSearchParams(window.location.search);
    const movieId = urlParams.get("movie");
    // If the page is the listing page and a movie ID is specified in the URL, display the movie details
    if (movieId && window.location.pathname.includes("listing.php")) {
      showMovieDetails(parseInt(movieId));
    }
  });  

// Show the booking modal when the "Book This Movie" button is clicked
function bookNowModal(){
    const movieName = bookMovie;
    
    // Set values for the booking form inputs
    $("#bookingMovie").val(movieName);
    $("#bookingEmail").val(userEmail);
    $("#bookingName").val(userName);
    $("#bookingModal").fadeIn();
}

// Hide the booking modal when the "Discard" button is clicked
$("#discardBooking").click(function() {
    $("#bookingModal").fadeOut();
});

// Handle the booking form submission
$("#bookingForm").submit(function(event) {
    event.preventDefault();

    // Get values from the booking form inputs
    const movieName = $("#bookingMovie").val();
    const userEmail = $("#bookingEmail").val();
    const userName = $("#bookingName").val();
    const cinema = $("#bookingCinema").val();
    const bookingDateTime = $("#bookingDateTime").val();

    // Send an AJAX request to book the movie
    $.ajax({
        url: "book_movie.php",
        type: "POST",
        data: {
            movie: movieName,
            bookingDateTime: bookingDateTime,
            email: userEmail,
            name: userName,
            cinema: cinema
        },
        success: function(response) {
            // Show a success message if booking is successful
            if (response === "success") {
                alert("Your booking has been successfully saved!");
                $("#bookingModal").fadeOut();
                window.location.href = "index.php";
            } else {
                alert("There was an error saving your booking. Please try again.");
            }
        },
        error: function() {
            alert("There was an error saving your booking. Please try again.");
        }
    });
});

// Define function to set the cookie with the name "email" and the value of the email address
function setEmailCookie(email, days) {
// Create a new Date object and add the number of days specified to it
const date = new Date();
date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
// Convert the date to UTC format and add it to the cookie as an expiration time
const expires = "expires="+ date.toUTCString();
// Set the cookie with the name "email", the value of the email address, the expiration time, and a path
document.cookie = "email=" + email + ";" + expires + ";path=/";
}

// Define function to get the cookie value of the email
function getEmailCookie() {
// Set the name of the cookie to "email"
const name = "email=";
// Decode the cookie and split it into an array of separate cookies
const decodedCookie = decodeURIComponent(document.cookie);
const cookieArray = decodedCookie.split(';');
// Loop through the array of cookies and find the one with the name "email"
for(let i = 0; i < cookieArray.length; i++) {
let cookie = cookieArray[i];
while (cookie.charAt(0) == ' ') {
cookie = cookie.substring(1);
}
if (cookie.indexOf(name) == 0) {
// Return the value of the "email" cookie
return cookie.substring(name.length, cookie.length);
}
}
// If the "email" cookie is not found, return an empty string
return "";
}

// Example usage: set email cookie to "example@email.com" for 30 days
setEmailCookie("example@email.com", 30);

// Example usage: get the email cookie value and display it on the page
const email = getEmailCookie();
if (email != "") {
// Display the value of the "email" cookie on the page
document.getElementById("email-display").innerHTML = "Email: " + email;
} else {
// If the "email" cookie is not found, prompt the user to enter their email address and store it in a cookie
const promptEmail = prompt("Please enter your email address:");
setEmailCookie(promptEmail, 30);
}