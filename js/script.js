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