$(document).ready(function () {

    $('#signIn').click(function (e) {
        e.preventDefault();
        var formIsValid = true;
        $("#loginForm :input[required]").each(function () {
            if ($.trim($(this).val()) == "") {
                formIsValid = false;
                $(this).addClass("is-invalid");
            }
            else {
                $(this).removeClass("is-invalid");
            }
        });
        $("#loginForm :input[required]").on("input change", function () {
            if ($.trim($(this).val()) != "") {
                $(this).removeClass("is-invalid");
                $(this).siblings(".invalid-feedback").hide();
            }
        });
        if (formIsValid) {
            var userName = $('#email').val();
            var password = $('#password').val();
            // Get CSRF token from meta tag
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            var model = {
                "email": userName,
                "password": password
            };
            $.ajax({
                url: baseUrl +'/login',
                type: 'POST',
                data: {
                    model: model,
                    '_token': csrfToken
                },
                success: function (data) {
                   
                    if (data.success) {
                        swal('Success', data.message, "success");
                        // window.location.assign(data.Url);
                    } else {
                        displayError(response.errors, response.message, messageBox);
                    }
                },
                error: function (e) {
                    console.log(e);
                }
            });
        }
    });

    $('#guestlogin').click(function (e) {
        e.preventDefault();
        $.ajax({
            url: '/Account/LoginAsGuest',
            type: 'POST',
            data: {},
            success: function (data) {
                if (data.Result) {
                    swal("Success", data.Message, "success");
                    window.location.assign(data.Url);
                }
            },
            error: function (e) {
                console.log(e);
            }
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