$(document).ready(function () {

    $('#signUp').click(function (e) {
        e.preventDefault();
        var formIsValid = true;

        var l = Ladda.create(this);
        l.start();

        $("#signUpForm :input[required]").each(function () {
            if ($.trim($(this).val()) == "") {
                formIsValid = false;
                $(this).addClass("is-invalid");
            }
            else {
                $(this).removeClass("is-invalid");
            }
        });
        $("#signUpForm :input[required]").on("input change", function () {
            if ($.trim($(this).val()) != "") {
                $(this).removeClass("is-invalid");
                $(this).siblings(".invalid-feedback").hide();
            }
        });
        if (formIsValid) {
            var userName = $('#name').val();
            var email = $('#customerEmail').val();
            var password = $('#psd').val();
            var response = grecaptcha.getResponse();

            var model = {
                "Username": userName,
                "Password": password,
                "Email": email,
                "Recaptcha": response
            };
            $.ajax({
                url: '/Account/SaveRegisterForm',
                type: 'POST',
                data: {
                    model: model
                },
                success: function (data) {
                    l.stop();
                    console.log(data);
                    if (data.Result) {
                        swal("Success", data.Message, "success");
                        //window.location.assign(data.Url);
                        $("#signupFormContainer").hide();
                        $("#regi-verification-box").show();
                    }
                    else {
                        swal("Warning", data.Message, "wanring");
                    }
                },
                error: function (e) {
                    l.stop();
                    console.log(e);
                }
            });
        }
    });
});

/*********************************************************************/
$('body').on('click', '#regi-verify-btn', function (event) {
    var frm = $('.regi-verify-form');

    if (true) { //frm.valid()
        /// validation passed
        /// cal your jquery function here
        event.preventDefault();

        // Automatically trigger the loading animation on click
        l = Ladda.create(document.getElementById("regi-verify-btn"));
        l.start();

        var jsonData = PrepearJasonFormData("regi-verify-form");
        /*var token = jsonData["__RequestVerificationToken"];
        jsonData["__RequestVerificationToken"] = "";*/

        var data = "{'model':" + JSON.stringify(jsonData) + "}";

        $("#rv-code-error-box").html("").hide();
        $("#rv-code-success-box").html("").hide();
        jQuery.ajax({
            type: 'POST',
            contentType: "application/json; charset=utf-8",
            url: '/Account/VerifyCode',
            dataType: 'json',
            data: data,
            /*headers: { "__RequestVerificationToken": token },*/
            success: function (data) {
                l.stop();
                if (data.Result) {
                    var html = 'Your account has been verified. Please wait...';
                    $("#signupFormContainer").show();
                    $("#regi-verification-box").hide();
                    swal("Success", html, "success");
                    window.location.href = "/account/login";
                } else {
                    AlertError(data.Message);
                }
            },
            error: function (e) {
                l.stop
            }
        });
    }
});

/*********************************************************************/
jQuery('#rv-sa-send-code').on("click", function (event) {
    event.preventDefault();

    var un = $("#Username").val();
    if (un == "" || un == null) {
        AlertError("Please enter email address or mobile number");
        return;
    }

    var l = Ladda.create(this);
    l.start();
    $("#rv-code-error-box").html("").hide();
    $("#rv-code-success-box").html("").hide();

    var jsonData = PrepearJasonFormData("regi-verify-form");
    /*var token = jsonData["__RequestVerificationToken"];
    jsonData["__RequestVerificationToken"] = "";*/

    var data = "{'model':" + JSON.stringify(jsonData) + "}";

    jQuery.ajax({
        type: 'POST',
        contentType: "application/json; charset=utf-8",
        url: '/Account/SendCode',
        dataType: 'json',
        data: data,
        success: function (data) {
            l.stop();
            if (data.Result) {
                $("#rv-code-success-box").html(data.Message).show();
                StartOTPTimer(parseInt(data.Min), "rv-sa-code-timer", "rv-sa-send-code");
                $("#rv-sa-code-timer").show();
                $("#rv-sa-send-code").prop("disabled", true);
            } else {
                $("#rv-code-error-box").html(data.Message).show();
            }
        },
        error: function (e) {
            l.stop();
        }
    });
});