document.addEventListener('DOMContentLoaded', function () {

    let loginForm = document.getElementById('login-form');
    if (loginForm) {
   
        loginForm.addEventListener('submit', function (e) {
            e.preventDefault();

            // Clear previous messages
            let messageBox = document.querySelector('#login-form .message-box');
            messageBox.innerHTML = '';

            let formBtn = document.querySelector('#login-form button');
            // Get CSRF token value from the meta tag
            let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Get form data
            let formData = new FormData(loginForm);
            let formAction=loginForm.getAttribute('action');
            fetch(formAction, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                body: formData
            })
            .then(function(response) {
                return response.json();
            })
            .then(function(response) {
                formBtn.classList.remove('loading');
                formBtn.disabled = false;

                if (response.success) {
                    // Redirect or perform any action for successful login
                    window.location.reload();
                } else {
                    // Display validation errors or other messages
                    displayError(response.errors, response.message, messageBox);
                }
            })
            .catch(function(error) {
                // Handle fetch error
                formBtn.classList.remove('loading');
                formBtn.disabled = false;

                displayError(null, 'Unexpected error happened', messageBox);
            });
        });
   }
    //////////////// sign-up code ////////////////
    let signupForm = document.getElementById('signup-form');
    signupForm.addEventListener('submit', function (e) {
        e.preventDefault();

        // Clear previous messages
        let messageBox = document.querySelector('#signup-form .message-box');
        messageBox.innerHTML = '';

        let formBtn = document.querySelector('#signup-form button');
        // Get CSRF token value from the meta tag
        let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Get form data
        let formData = new FormData(signupForm);
        let formAction = signupForm.getAttribute('action');

        fetch(formAction, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            body: formData
        })
        .then(function(response) {
            return response.json();
        })
        .then(function(response) {
            formBtn.classList.remove('loading');
            formBtn.disabled = false;

            if (response.success) {
                // Redirect or perform any action for successful signup
                messageBox.classList.remove('text-success', 'text-danger');
                messageBox.classList.add('text-success');
                messageBox.innerHTML = `<div>${response.message}</div>`;
                signupForm.reset();
                setTimeout(() => {
                    window.location.href = response.redirect_url;
                }, 3000);
                
            } else {
                // Display validation errors or other messages
                displayError(response.errors, response.message, messageBox);
            }
        })
        .catch(function(error) {
            // Handle fetch error
            formBtn.classList.remove('loading');
            formBtn.disabled = false;

            displayError(null, 'Unexpected error happened', messageBox);
        });
    });

    let forgotPasswordForm = document.getElementById('forgot-password-form');
       
            forgotPasswordForm.addEventListener('submit', function (e) {
                e.preventDefault();

                // Clear previous messages
                let messageBox = document.querySelector('#forgot-password-form .message-box');
                messageBox.innerHTML = '';

                let formBtn = document.querySelector('#forgot-password-form button');
                // Get CSRF token value from the meta tag
                let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                // Get form data
                let formData = new FormData(forgotPasswordForm);
                let formAction = forgotPasswordForm.getAttribute('action');
                fetch(formAction, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: formData
                })
                .then(function(response) {
                    return response.json();
                })
                .then(function(response) {
                    formBtn.classList.remove('loading');
                    formBtn.disabled = false;

                    if (response.success) {
                        // Redirect or perform any action for successful password reset request
                        displaySuccess(response.message, messageBox);
                    } else {
                        // Display validation errors or other messages
                        displayError(response.errors, response.message, messageBox);
                    }
                })
                .catch(function(error) {
                    // Handle fetch error
                    formBtn.classList.remove('loading');
                    formBtn.disabled = false;

                    displayError(null, 'Unexpected error happened', messageBox);
                });
            });

    // function to display errors
    function displayError(errors, message, messageBox) {
        if (errors) {
            // Display all errors in the message box
            messageBox.classList.remove('text-success', 'text-danger');
            messageBox.classList.add('text-danger');
            for (let key in errors) {
                if (errors.hasOwnProperty(key)) {
                    errors[key].forEach(errorMessage => {
                        messageBox.innerHTML += `<div>${errorMessage}</div>`;
                    });
                }
            }
        } else if (message) {
            // Display other messages, such as incorrect credentials
            messageBox.classList.remove('text-success', 'text-danger');
            messageBox.classList.add('text-danger');
            messageBox.innerHTML = `<div>${message}</div>`;
        } else {
            messageBox.classList.remove('text-success', 'text-danger');
            messageBox.classList.add('text-danger');
            messageBox.innerHTML = '<div>Unexpected error happened</div>';
        }
    }

});