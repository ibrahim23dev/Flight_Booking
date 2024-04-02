var l;
$(function () {
    'use strict';

    if (window.location.href.indexOf('#_=_') > 0) {
        window.location = window.location.href.replace(/#.*/, '');
    }

    // Modal Sign In
    $('.smart-auth-btn').magnificPopup({
        type: 'inline',
        fixedContentPos: true,
        fixedBgPos: true,
        overflowY: 'auto',
        closeBtnInside: true,
        preloader: false,
        midClick: true,
        removalDelay: 300,
        closeMarkup: '<button title="%title%" type="button" class="mfp-close"></button>',
        mainClass: 'my-mfp-zoom-in'
    });

    // Show Password
    //$('input[name=Password]').hidePassword('focus', {
    //    toggle: {
    //        className: 'my-toggle'
    //    }
    //});
});
/*********************************************************************/
jQuery('.regi-form').submit(function (event) {
    event.preventDefault();
    var frm = $('.regi-form');
    if (frm.valid()) { // validation passed
        // cal your jquery function here
        jQuery('#regi-error-box').hide();

        // Automatically trigger the loading animation on click
        l = Ladda.create(document.getElementById("regi-btn"));
        l.start();

        var jsonData = PrepearJasonFormData('regi-form');

        var data = "{'model':" + JSON.stringify(jsonData) + "}";
        var token = jsonData["__RequestVerificationToken"];
        jsonData["__RequestVerificationToken"] = "";
       
        //disabled other buttons
        $('.disabled-item').attr("disabled", "disabled");
        //alert(data); l.stop(); return;
        jQuery.ajax({
            type: 'POST',
            contentType: "application/json; charset=utf-8",
            url: '/Account/SaveRegisterForm',
            dataType: 'json',
            data: data,
            headers: { "__RequestVerificationToken": token },
            success: function (data) {
                l.stop();
                if (data.Result) {
                    jQuery('#regi-box').hide();
                    jQuery('#regi-verification-box').show();
                    $("#sm-header").html("Account Verification");
                    var u = window.location.pathname;
                    $("#code-url").val(u);
                    $("#code-username").val(data.Username);
                    $("#code-cc").val(data.CountryCode);
                    StartOTPTimer(data.Min, "code-timer", "send-code");
                    $("#code-timer").show();
                    $("#send-code").prop("disabled", true);
                } else {
                    jQuery('#regi-error-box').html(data.Message).show();
                }

                $('.disabled-item').attr("disabled", false);
            },
            error: function (e) {
                l.stop();
                $('.disabled-item').attr("disabled", false);
            }
        });
    }
});
/*********************************************************************/
jQuery('.login-form').submit(function (event) {
    event.preventDefault();
    var u = window.location.pathname;
    $("#login-url").val(u);

    var frm = $('.login-form');
    if (frm.valid()) { // validation passed
        // cal your jquery function here

        jQuery('#login-error-box').hide();
        var btn = frm.attr("data-btn");
        // Automatically trigger the loading animation on click
        l = Ladda.create(document.getElementById("login-btn"));
        l.start();
        
        var jsonData = PrepearJasonFormData("login-form");
        var token = jsonData["__RequestVerificationToken"];
        jsonData["__RequestVerificationToken"] = "";
        var data = "{'model':" + JSON.stringify(jsonData) + "}";
        //disabled other buttons
        $('.disabled-item').attr("disabled", "disabled");
        //alert(data); l.stop(); return;
        jQuery.ajax({
            type: 'POST',
            contentType: "application/json; charset=utf-8",
            url: '/Account/Login',
            headers: { "__RequestVerificationToken": token },
            dataType: 'json',
            data: data,
            success: function (data) {
                l.stop();
                if (data.Result) {
                    jQuery('.login-boxes').hide();
                    jQuery('#login-success-box').html(data.Message).show();
                    window.location.reload();
                } else {
                    jQuery('#login-error-box').html(data.Message).show();
                    $('.disabled-item').attr("disabled", false);
                }
            },
            error: function (e) {
                l.stop();
                $('.disabled-item').attr("disabled", false);
            }
        });
    }
});
/*********************************************************************/
jQuery('.forgot-form').submit(function (event) {
    if (jQuery(this).valid()) { // validation passed
        // cal your jquery function here
        event.preventDefault();

        // Automatically trigger the loading animation on click
        l = Ladda.create(document.getElementById("forgot-btn"));
        l.start();

        var jsonData = PrepearJasonFormData("forgot-form");

        var data = "{'model':" + JSON.stringify(jsonData) + "}";
        var token = jsonData["__RequestVerificationToken"];
        jsonData["__RequestVerificationToken"] = "";
        //alert(data); 
        //l.stop();return;
        jQuery('#forgot-error-box').hide();
        jQuery.ajax({
            type: 'POST',
            contentType: "application/json; charset=utf-8",
            url: '/Account/ForgotPassword',
            dataType: 'json',
            data: data,
            headers: { "__RequestVerificationToken": token },
            success: function (data) {
                l.stop();
                //jQuery('.forgot-boxes').hide();
                if (data.Result) {
                    jQuery('#forgot-success-box').html(data.Message).show();
                    jQuery('.forgot-form').hide();
                } else {
                    jQuery('#forgot-error-box').html(data.Message).show();
                }
            },
            error: function (e) {
                l.stop
            }
        });
    }
});
/*********************************************************************/
jQuery('.verify-form').submit(function (event) {
    if (jQuery(this).valid()) { // validation passed
        // cal your jquery function here
        event.preventDefault();

        // Automatically trigger the loading animation on click
        l = Ladda.create(document.getElementById("verify-btn"));
        l.start();

        var jsonData = PrepearJasonFormData("verify-form");

        var data = "{'model':" + JSON.stringify(jsonData) + "}";
        var token = jsonData["__RequestVerificationToken"];
        jsonData["__RequestVerificationToken"] = "";
        //alert(data); 
        //l.stop();return;
        jQuery('#code-error-box').hide();
        jQuery.ajax({
            type: 'POST',
            contentType: "application/json; charset=utf-8",
            url: '/Account/VerifyCode',
            dataType: 'json',
            data: data,
            headers: { "__RequestVerificationToken": token },
            success: function (data) {
                l.stop();
                //jQuery('.forgot-boxes').hide();
                if (data.Result) {
                    jQuery('#code-success-box').html(data.Message).show();
                    jQuery('.verify-form').hide();
                    window.location.reload();
                } else {
                    jQuery('#code-error-box').html(data.Message).show();
                }
            },
            error: function (e) {
                l.stop
            }
        });
    }
});

/*********************************************************************/
jQuery('.social_bt').on("click", function (event) {
    event.preventDefault();
    // Automatically trigger the loading animation on click
    l = Ladda.create(this);
    l.start();

    //disabled other butons
    $('.disabled-item').prop("disabled", true);

    var p = $(this).attr("data-id");
    var u = window.location.pathname;

    $(".ext-login-provider").val(p);
    $(".ext-login-url").val(u);

    var frm = $("#ext-login");
    frm.submit();
});
/*********************************************************************/
jQuery('.password-options a').on("click", function (event) {
    event.preventDefault();
    $('.password-options a').removeClass('active');
    $(this).addClass('active');
    $("#password-type").val($(this).attr("data-id"));
    $("#sm-password").attr("placeholder",$(this).attr("data-title"));
    if ($(this).attr("data-id") == "1") {
        $("#opt-option-box").show();
    } else {
        $("#opt-option-box").hide();
    }
});
/*********************************************************************/
jQuery('#sa-send-otp').on("click", function (event) {
    event.preventDefault();
    var un = $("#sa-username").val();
    if (un == "" || un == null) {
        SetErrorMessage("Username", "Mobile number or Email address is required");
    }
    var cc = $("#sa-country-code").val();
    var form = $('#auth-login');
    var token = $('input[name="__RequestVerificationToken"]', form).val();
    var l = Ladda.create(this);
    l.start();
    $(".login-error-box").html(""); 
    jQuery.ajax({
        type: 'POST',
        //contentType: "application/json; charset=utf-8",
        url: '/Account/SendOTP',
        dataType: 'json',
        data: {"cc":cc, "un": un, "__RequestVerificationToken": token },
        success: function (data) {
            l.stop();
            if (data.Result) {
                StartOTPTimer(parseInt(data.Min), "sa-otp-timer", "sa-send-otp");
                $("#sa-otp-timer").show();
                $("#sa-send-otp").prop("disabled", true);
            } else {
                $(".login-error-box").html(data.Message); 
            }
        },
        error: function (e) {
            l.stop();
        }
    });
});

/*********************************************************************/
jQuery('#sa-send-code').on("click", function (event) {
    event.preventDefault();
    var un = $("#code-username").val();
    var cc = $("#code-cc").val();
    var form = $('#verify-form');
    var token = $('input[name="__RequestVerificationToken"]', form).val();
    var l = Ladda.create(this);
    l.start();
    $("#code-error-box").html("").hide();
    $("#code-success-box").html("").hide();
    jQuery.ajax({
        type: 'POST',
        //contentType: "application/json; charset=utf-8",
        url: '/Account/SendCode',
        dataType: 'json',
        data: { "cc":cc,"un": un, "__RequestVerificationToken": token },
        success: function (data) {
            l.stop();
            if (data.Result) {
                $("#code-success-box").html(data.Message).show();
                StartOTPTimer(parseInt(data.Min), "sa-code-timer", "sa-send-code");
                $("#sa-code-timer").show();
                $("#sa-send-code").prop("disabled", true);
            } else {
                $("#code-error-box").html(data.Message).show();
            }
        },
        error: function (e) {
            l.stop();
        }
    });
});

/*********************************************************************/
jQuery('.sm-form-link').on("click", function (event) {
    event.preventDefault();
    $('.auth-forms').hide();
    $($(this).attr("href")).show();
    $("#sm-header").html($(this).attr("data-title"));
});


jQuery("body").on("change keyup", ".sa-username", function (e) {
    //e.preventDefault();
    var txt = $(this).val();
    if (txt.length <= 3 && (e.which == 8 || e.which == 46)) {
        ResetToEmail($(this))
    }
    else if (txt.length >= 4) {
        if (!isNaN(txt)) {
            ResetToMobile($(this))
        }
    }
});

jQuery("body").on("paste", ".sa-username", function (e) {
    //e.preventDefault();
    var txt = e.originalEvent.clipboardData.getData('text');
    if (txt.length >= 4) {
        if (!isNaN(txt)) {
            ResetToMobile($(this))
        }
    }
});



function ResetToMobile(t) {
    t.parent("div").addClass("input-group").addClass("combo-inputs");
    t.css("paddingLeft", "10px");
    t.prev("div").show();
    t.next("i").hide();
}
function ResetToEmail(t) {
    t.parent("div").removeClass("combo-inputs").removeClass("input-group");
    t.css("paddingLeft", "40px");;
    t.prev("div").hide();
    t.next("i").show();
}
/*********************************************************************/
function ResetForm(cls) {
    jQuery('#' + cls + '-error-box').html("").hide();
    jQuery('#' + cls + '-success-box').html("").hide();
    jQuery('#' + cls + '-close-box').hide();
    jQuery('.' + cls + '-boxes').show();
    EmptyFormData(cls + '-form');
    //Removes validation from input-fields
    $('.input-validation-error').addClass('input-validation-valid');
    $('.input-validation-error').removeClass('input-validation-error');
    //Removes validation message after input-fields
    $('.field-validation-error').addClass('field-validation-valid');
    $('.field-validation-error').removeClass('field-validation-error');
}

