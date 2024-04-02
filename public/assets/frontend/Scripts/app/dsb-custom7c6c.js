var l;
/************************************************/
jQuery("body").on("click", ".redirect-btn", function (event) {
    event.preventDefault();
    var url = jQuery(this).attr("data-url");
    var data = PrepearJasonData("filter-item");
    window.location.href = url + EncodeQueryData(data);
});
/************************************************/
jQuery("body").on("click", ".redirect-only-btn", function (event) {
    event.preventDefault();
    var url = jQuery(this).attr("data-url");
    window.location.href = url;
});
/************************************************/
jQuery("body").on("click", ".redirect-link", function (event) {
    event.preventDefault();
    var url = jQuery(this).attr("href");
    var data = PrepearJasonData("filter-item");
    window.location.href = url + EncodeQueryData(data);
});

jQuery('body').on('click', '.goto', function (event) {
    event.preventDefault();
    //alert("OK")
    //jQuery('body').animate({ scrollTop: jQuery(this.hash).offset().top }, 1000);
    var id = jQuery(this).attr("href");

    //// Scroll
    jQuery('html, body').animate({ scrollTop: jQuery(id).offset().top }, 1000);
    //return false; 
    //alert(id)
});
jQuery('body').on('focus', '.airport-lookup', function (event) {
    $(this).select();
});
jQuery('body').on('focus', '#hotelCity', function (event) {
    $(this).select();
});


/*******************toggle- check value ******************************/
jQuery("body").on("click", ".toggle-value", function (event) {
    var v = jQuery(this).val();
    if (v == "True") jQuery(this).val("False");
    else jQuery(this).val("True");
});
/*********************number validation*******************************/
jQuery("body").on("keypress", ".num-val", function (e) {
    //e.preventDefault();
    if (e.which != 46 && e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        return false;
    }
});

/*********************number validation*******************************/
jQuery("body").on("keypress", ".num-val-m", function (e) {
    //e.preventDefault();
    if (e.which != 45 && e.which != 46 && e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        return false;
    }
});

/*******************validate - looksup*************************/
$('body').on("change", ".validate-looksup", function (event) {
    //event.preventDefault();
    var ele = $(this);
    setTimeout(function () {
        ValidateLookups(ele)
    }, 300);
});
/*******************validate - looksup*************************/
$('body').on("click", ".clear-txt", function (event) {
    event.preventDefault();
    $(this).next("i").next("input").val("");
    $(this).next("i").next("input").next("input").val("");
    $(this).hide();
});

/********************* only backspace allowed*******************************/
$("body").on("keypress", ".hasDatepicker", function (e) {
    //e.preventDefault();
    if (e.which != 8) {
        return false;
    }
});
/**********************event prevent**************************/
$("body").on("click", ".disabledTab a", function (event) {
    event.preventDefault();
});
/**********************event prevent**************************/
$("body").on("click", ".treegrid-expander", function (event) {
    event.preventDefault();
    ReSizeSidebar();
});

$("body").on("click", ".show-details-info", function (event) {
    event.preventDefault();
    $("#modal-d-body").html($(this).next("div").html());
    $('#modal-d').modal('toggle');
});

$("body").on("click", ".block-links", function (event) {
    event.preventDefault();
    $(this).children("span").toggleClass("fa-plus fa-minus");
});
$("body").on("click", ".dropdown-link", function (event) {
    event.preventDefault();
    $(this).children("i").toggleClass("la-chevron-up la-chevron-down");
    var cls = $(this).attr("data-cls");
    $("." + cls).toggle();
});

$("body").on("click", ".options-toggle", function (event) {
    var cls1 = $(this).attr("data-cls1");
    var cls = $(this).attr("data-cls");
    $("." + cls1).hide();
    $("." + cls).show();
});
$("body").on("click", ".rs-list", function (event) {
    var json = $(this).attr("data-json");
    var t = $(this).attr("data-type");
    $.ajax({
        type: 'POST',
        url: '/home/GetFormData',
        data: { "json": json, "t": t },
        success: function (data) {
            $("#rs-form-data").html(data);
            var frm = $("#rs-form-data form");

            frm.submit();
        },
        error: function (e) {
        }
    });
});


//btn
var active_btn = false;
jQuery("body").on("mouseover", ".btn-inline", function (event) {
    active_btn = true;
});
jQuery("body").on("mouseout", ".btn-inline", function (event) {
    active_btn = false;
});
//input
jQuery("body").on("focus", ".input-inline", function (event) {
    jQuery(".btn-inline").hide();
    jQuery(this).prev("button").show();
});
jQuery("body").on("blur", ".input-inline", function (event) {
    if (!active_btn) {
        jQuery(this).prev("button").hide();
    }
});
/*******************change inline input ************************************/
jQuery("body").on("change", ".input-inline", function (event) {
    event.preventDefault();

    var cValue = parseFloat(jQuery(this).val());
    var oValue = parseFloat(jQuery(this).attr("data-old"));

    if (cValue != oValue) {
        jQuery(this).addClass("change-value");
    } else {
        jQuery(this).removeClass("change-value");
    }
});


// Panel Dropdown
function close_panel_dropdown() {
    $('.panel-dropdown').removeClass("active");
}
$('.panel-dropdown-open').on('click', function (e) {
    if ($(this).parent().is(".active")) {
        close_panel_dropdown();
    } else {
        close_panel_dropdown();
        $(this).parent().addClass('active');
    }
    e.preventDefault();
});

// Closes dropdown on click outside the conatainer
var mouse_is_inside = false;

$('.panel-dropdown').hover(function () {
    mouse_is_inside = true;
}, function () {
    mouse_is_inside = false;
});

$("body").mouseup(function () {
    if (!mouse_is_inside) close_panel_dropdown();
});





function EncodeQueryData(data) {
    var ret = [];
    for (var d in data) {
        if (data[d] != "" && data[d] != null)
            ret.push(encodeURIComponent(d) + "=" + encodeURIComponent(data[d]));
    }
    return "?" + ret.join("&");
}
function AlterDateStr(date) {
    if (date != "") {
        var arr = date.split('/');
        return arr[1] + "/" + arr[0] + "/" + arr[2];
    }
    else {
        return null;
    }
}
function AlterDMY2MDY(date) {
    if (date != "") {
        var arr = date.split('/');
        return arr[1] + "/" + arr[0] + "/" + arr[2];
    }
    else {
        return null;
    }
}
function AlterYMD2MDY(date) {
    if (date != "") {
        var arr = date.replace(' 00:00:00', '').split('-');
        return arr[1] + "/" + arr[2] + "/" + arr[0];
    }
    else {
        return null;
    }
}
function PrepearJasonData(classname) {

    classname = "." + classname

    var jsonData = {};
    jQuery("input" + classname).each(function (index) {
        if (jQuery(this).attr("datepicker") == "datepicker") {
            jsonData[jQuery(this).attr("name")] = AlterDMY2MDY(jQuery(this).val());
        } else {
            jsonData[jQuery(this).attr("name")] = jQuery(this).val();
        }
    });

    jQuery("select" + classname).each(function (index) {
        jsonData[jQuery(this).attr("name")] = jQuery(this).val();
    });

    jQuery("textarea" + classname).each(function (index) {
        jsonData[jQuery(this).attr("name")] = jQuery(this).val();
    });

    //var data = "{'model':" + JSON.stringify(jsonData) + ", 'conditions':" + JSON.stringify(items) + ", 'medications':" + JSON.stringify(items2) + "}";


    return jsonData;

}
function PrepearJasonFormData(classname) {

    classname = "." + classname

    var jsonData = {};

    jQuery(classname + " input[type=text]").each(function (index) {
        if (jQuery(this).attr("datepicker") == "datepicker") {
            jsonData[jQuery(this).attr("name")] = AlterDMY2MDY(jQuery(this).val());
        } else {
            jsonData[jQuery(this).attr("name")] = jQuery(this).val();
        }
    });

    jQuery(classname + " input[type=email]").each(function (index) {
        jsonData[jQuery(this).attr("name")] = jQuery(this).val();
    });

    jQuery(classname + " input[type=password]").each(function (index) {
        jsonData[jQuery(this).attr("name")] = jQuery(this).val();
    });

    //for textarea input
    jQuery(classname + " textarea").each(function (index) {
        jsonData[jQuery(this).attr("name")] = jQuery(this).val();
    });
    //for select input
    jQuery(classname + " select").each(function (index) {
        jsonData[jQuery(this).attr("name")] = jQuery(this).val();
    });

    //for text inputs
    jQuery(classname + " input[type=hidden]").each(function (index) {
        jsonData[jQuery(this).attr("name")] = jQuery(this).val();
    });

    var ary = "";
    jQuery(classname + " input[type=checkbox]:checked").each(function (index) {
        var name = jQuery(this).attr("name");
        if (ary == name) {
            jsonData[jQuery(this).attr("name")] += "," + jQuery(this).val();
        } else {
            jsonData[jQuery(this).attr("name")] = jQuery(this).val();
        }
        ary = name;
    });

    ary = "";
    jQuery(classname + " input[type=checkbox]:not(:checked)").each(function (index) {
        var name = jQuery(this).attr("name");
        if (ary == name) {
            jsonData[jQuery(this).attr("name")] += "," + jQuery(this).val();
        } else {
            jsonData[jQuery(this).attr("name")] = jQuery(this).val();
        }
        ary = name;
    });


    jQuery(classname + " input[type=radio]:checked").each(function (index) {
        jsonData[jQuery(this).attr("name")] = jQuery(this).val();
    });

    return jsonData;
}
function SetPageNumberForDelete() {

    var currentPage = jQuery("#page-number").val();
    if (isNaN(currentPage) || currentPage == "" || currentPage == null)
        currentPage = 1;

    var rows = jQuery(".table tbody tr").length;
    if (currentPage > 1 && rows == 1) {
        currentPage = currentPage - 1;
    }

    jQuery("#page-number").val(currentPage)
}

function InitSortingHeader(id) {
    jQuery('#' + id + ' .table  thead  th').on("click", function (event) {
        event.preventDefault();
        var action = jQuery(this).attr("class");
        var suffix = jQuery(this).attr("data-suffix");

        if (suffix != null && suffix != "") {
            jQuery("body").attr("data-list", suffix);
            suffix = "-" + suffix
        }

        if (action != "" && action != null) {
            if (action == "sorting") {
                jQuery('#' + id + " .sorting_asc").removeClass("sorting_asc").addClass("sorting");
                jQuery('#' + id + " .sorting_desc").removeClass("sorting_desc").addClass("sorting");
                jQuery(this).removeClass("sorting").addClass("sorting_asc");
                jQuery("#sort-direction" + suffix).val("asc");
            } else if (action == "sorting_asc") {
                jQuery('#' + id + " .sorting_asc").removeClass("sorting_asc").addClass("sorting_desc");
                jQuery("#sort-direction" + suffix).val("desc");
            }
            else if (action == "sorting_desc") {
                jQuery('#' + id + " .sorting_desc").removeClass("sorting_desc").addClass("sorting_asc");
                jQuery("#sort-direction" + suffix).val("asc");
            }

            jQuery("#sort-name" + suffix).val(jQuery(this).attr("data-sort"));
            jQuery("#page-number" + suffix).val("1");

            LoadTableData();
        }
    });
}
function SetErrorMessage(fieldId, message) {

    jQuery(".field-validation-valid").each(function (i) {
        var t = jQuery(this).attr("data-valmsg-for");
        if (t == fieldId) {
            //alert(message);
            jQuery(this).removeClass("field-validation-valid");
            jQuery(this).addClass("field-validation-error");
            jQuery("#" + fieldId).addClass("input-validation-error");

            jQuery(this).html('<span for="' + fieldId + '" generated="true" class="">' + message + '</span>');

        }
    });
}
function RemoveErrorMessage(fieldId) {

    jQuery(".field-validation-error").each(function (i) {
        var t = jQuery(this).attr("data-valmsg-for");
        if (t == fieldId) {
            //alert(message);
            jQuery(this).removeClass("field-validation-error");
            jQuery(this).addClass("field-validation-valid");
            jQuery(this).html('');
            jQuery("#" + fieldId).removeClass("input-validation-error");
        }
    });
}
function EmptyFormData(classname) {

    classname = "." + classname

    var jsonData = {};

    jQuery(classname + " input[type=text]").each(function (index) {
        jQuery(this).val("");
    });

    jQuery(classname + " input[type=email]").each(function (index) {
        jQuery(this).val("");
    });

    jQuery(classname + " input[type=password]").each(function (index) {
        jQuery(this).val("");
    });

    //for textarea input
    jQuery(classname + " textarea").each(function (index) {
        jQuery(this).val("");
    });
}

/******************* set time zone cookie ************/
function SetTimezoneCookie() {

    var timezone_cookie = "timezoneoffset";

    // if the timezone cookie not exists create one.
    if (!jQuery.cookie(timezone_cookie)) {
        // create a new cookie
        jQuery.cookie(timezone_cookie, new Date().getTimezoneOffset(), { expires: 120, path: '/' });
    }
    // if the current timezone and the one stored in cookie are different
    // then store the new timezone in the cookie and refresh the page.
    else {
        var storedOffset = parseInt(jQuery.cookie(timezone_cookie));
        var currentOffset = new Date().getTimezoneOffset();

        // user may have changed the timezone
        if (storedOffset !== currentOffset) {
            jQuery.cookie(timezone_cookie, new Date().getTimezoneOffset(), { expires: 120, path: '/' });
        }
    }
}
function LoadCurrentBalance() {
    $.ajax({
        type: 'POST',
        url: '/account/currentbalance',
        success: function (data) {
            $('#current-balance').html(data);
        },
        error: function (e) {
            //alert(e.responseText);
        }
    }).done(function () {
    });
}


function ReSizeSidebar() {
    app.accordionFullHeightResize(); app.features.gallery.controlHeight(); app.spy();
}

function InitSortingHeaderTab(id) {

    $('#' + id + ' .table  thead  th').on("click", function (event) {
        event.preventDefault();
        var action = $(this).attr("class");
        var suffix = $(this).attr("data-suffix");

        if (suffix != null && suffix != "") {
            $("body").attr("data-tab", suffix);
            suffix = "-" + suffix
        }

        //alert(suffix)
        if (action != "" && action != null) {
            if (action == "sorting") {
                $('#' + id + " .sorting_asc").removeClass("sorting_asc").addClass("sorting");
                $('#' + id + " .sorting_desc").removeClass("sorting_desc").addClass("sorting");
                $(this).removeClass("sorting").addClass("sorting_asc");
                $("#sort-direction" + suffix).val("asc");
            } else if (action == "sorting_asc") {
                $('#' + id + " .sorting_asc").removeClass("sorting_asc").addClass("sorting_desc");
                $("#sort-direction" + suffix).val("desc");
            }
            else if (action == "sorting_desc") {
                $('#' + id + " .sorting_desc").removeClass("sorting_desc").addClass("sorting_asc");
                $("#sort-direction" + suffix).val("asc");
            }

            $("#sort-name" + suffix).val($(this).attr("data-sort"));
            $("#page-number" + suffix).val("1");

            LoadTableDataTab();
        }
    });
}

function InitDate(s) {
    $(s).daterangepicker({
        singleDatePicker: true,
        autoUpdateInput: true,
        autoApply: true,
        showDropdowns: true,
        minDate: $(s).attr("data-start"),
        maxDate: $(s).attr("data-end"),
        locale: {
            cancelLabel: 'Clear',
            format: 'MMM DD, YYYY'
        }
    }, function (start, end, label) {
        var fid = this.element[0].id;
        $("#" + fid).prev("input").val(start.format('MM/DD/YYYY'));
    });
}

function InitDates() {
    $(".date-input").each(function () {
        var dp = $(this);
        var minDate = dp.attr("data-start");
        if (dp.attr("data-id") > 2) {
            minDate = $('#dp-' + (dp.attr("data-id") - 1)).val();
        }
        //alert(dp.attr("id"))
        dp.daterangepicker({
            singleDatePicker: true,
            autoUpdateInput: false,
            showDropdowns:true,
            autoApply: true,
            minDate: minDate,
            maxDate: dp.attr("data-end"),
            locale: {
                cancelLabel: 'Clear',
                format: 'MMM DD, YYYY'
            }
        },
            function (start, end, label) {
                InitNextDate(dp, start);
            });
    });
}
function InitNextDate(dp, start) {
    dp.prev("input").val(moment(start).format("MM/DD/YYYY"));
    dp.val(moment(start).format("MMM DD, YYYY"));
    var n = dp.attr("data-next");
    var addDays = 0;
    var maxLoopCount = 6;

    if (n != "" && n != null) {
        var dp2 = $("#" + n);
        var trimmedNo = n.replace(/\D/g, '');
        if (trimmedNo == "1") {
            // dp2.prev("input").val(moment(start).add("days", addDays).format("MM/DD/YYYY"));
            // dp2.val(moment(start).add("days", addDays).format("MMM DD, YYYY"));
        } else if (trimmedNo == "2") {
            return;
        } else {
            for (var j = trimmedNo; j <= maxLoopCount; j++) {
                var dpId = $("#dp-" + j);
                if (dpId) {
                    dpId.prev("input").val("");
                    dpId.val("");
                }
            }
        }
        dp2.daterangepicker({
            singleDatePicker: true,
            autoUpdateInput: false,
            showDropdowns:true,
            autoApply: true,
            minDate: moment(start).format("MMM DD, YYYY"),
            // maxDate: dp2.attr("data-end"),
            locale: {
                cancelLabel: 'Clear',
                format: 'MMM DD, YYYY'
            }
        }, function (start, end, label) {
            InitNextDate(dp2, start);
        });

    }
}

function InitDates2(s) {
    $("." + s).each(function (index) {
        $(this).daterangepicker({
            singleDatePicker: true,
            autoUpdateInput: true,
            autoApply: true,
            showDropdowns: true,
            minDate: $(this).attr("data-start"),
            maxDate: $(this).attr("data-end"),
            locale: {
                cancelLabel: 'Clear',
                format: 'MMM DD, YYYY'
            }
        }, function (start, end, label) {
            var fid = this.element[0].id;
            $("#" + fid).prev("input").val(start.format('MM/DD/YYYY'));
        });
    });

}


$('body').on("click", ".date-items-bg", function (event) {
    event.preventDefault();
    jQuery(this).datetimepicker('show');
});
$('body').on("click", ".date-icon", function (event) {
    event.preventDefault();
    $(this).prev("input").data('daterangepicker').show();

});
$("body").on('change', '#select-currency', function () {
    //alert("OK")
    var jsonData = PrepearJasonFormData("curr-form");
    var curr = jsonData["curr"];
    var token = jsonData["__RequestVerificationToken"];
    jQuery.ajax({
        type: 'POST',
        //contentType: "application/json; charset=utf-8",
        url: '/Home/ChangeCurrency',
        //dataType: 'json',
        data: { "curr": curr },
        headers: { "__RequestVerificationToken": token },
        success: function (data) {
            if (data.Result) {
                window.location.reload();
            }
        },
        error: function (e) {
        }
    });
});


function LoadingEffectFlt() {
    $('#modal-loading-flt').modal({ backdrop: 'static', keyboard: false });
    //$('#modal-loading-flt').modal('toggle');
}
function LoadingEffectHtl() {
    $('#modal-loading-htl').modal('toggle');
}

/**********************event prevent**************************/
$("body").on("click", ".sortClass", function (event) {
    event.preventDefault();
    var id = $(this).attr("data-id");
    var cls = "asc";
    $(".sortClass").each(function (index) {
        if ($(this).attr("data-id") != id) {
            $(this).addClass("default-st").removeClass("desc").removeClass("asc");
            $(this).html($(this).attr("data-normaltype"));
        }
    });
    $(this).removeClass("default-st");
    if ($(this).hasClass("asc")) {
        cls = "desc";
        $(this).removeClass("asc").addClass("desc");
        $(this).html($(this).attr("data-hightype"));
        $("#Sorting-FLT").attr("data-dr", "desc");
    } else {
        cls = "asc";
        $(this).removeClass("desc").addClass("asc");
        $(this).html($(this).attr("data-lowtype"));
        $("#Sorting-FLT").attr("data-dr", "asc");
    }

    SortingCallBack(id, cls);
});

function WaitMeStart() {
    jQuery('.app-container').waitMe({
        effect: 'win8',
        text: 'Please wait...',
        bg: 'rgba(0, 0, 0, 0.75)',
        //bg: 'rgba(255,255,255, 0.75)',
        color: '#fff',
        maxSize: '',
        source: 'img.svg',
        onClose: function () { }
    });
}

function WaitMeStop() {
    jQuery('.app-container').waitMe('hide');
}

function AlertError(mes) {
    Swal({
        type: 'error',
        title: 'Oops...',
        text: mes
    })
}
function AlertSuccess(mes) {
    Swal({
        type: 'success',
        title: 'Success',
        text: mes
    })
}

function InitSpinners(cls) {
    $("." + cls + " input.spinner2").each(function () {
        var max = parseInt($(this).attr("data-spinner-max"));
        var min = parseInt($(this).attr("data-spinner-min"));
        var step = parseFloat($(this).attr("data-spinner-step"));

        $(this).TouchSpin({
            min: min,
            max: max,
            step: step,
            decimals: 2,
            verticalbuttons: true,
            buttondown_class: "btn spinner-btn",
            buttonup_class: "btn spinner-btn",
            verticalupclass: 'fa fa-chevron-up',
            verticaldownclass: 'fa fa-chevron-down',
        });
    });
}

function MapBrand(id) {

    if (id == 1)
        return "S";
    else if (id == 2)
        return "M";
    else if (id == 3)
        return "D";
    else if (id == 4)
        return "B";
    else if (id == 5)
        return "U";
    else if (id == 6)
        return "R";
    else if (id == 7)
        return "N";
    else if (id == 8)
        return "O";
    else
        return "";
}

function IsInTime(id, time) {

    if (id == 1) {
        if (time >= 0 && time < 0600) return true;
    }
    else if (id == 2) {
        if (time >= 0600 && time < 1200) return true;
    }
    else if (id == 3) {
        if (time >= 1200 && time < 1800) return true;
    }
    else if (id == 4) {
        if (time >= 1800 && time <= 2359) return true;
    }

    return false;
}

function MapTime(id) {

    if (id == 1) {
        return "00:00 to 06:00";
    }
    else if (id == 2) {
        return "06:01 to 12:00";
    }
    else if (id == 3) {
        return "12:01 to 18:00";
    }
    else if (id == 4) {
        return "18:00 to 23:59";
    }

    return "";
}

function MapStop(id) {

    if (id == 0) {
        return "0";
    }
    else if (id == 1) {
        return "1";
    }
    else if (id == 2) {
        return "2";
    }
    else if (id == 3) {
        return "3+";
    }

    return "";
}

function InitUserLooksup() {
    /******************* search airline  *************************/
    $('.user-lookup').autocomplete({
        serviceUrl: '/Dashboard/SearchUser',
        minChars: 1,
        //maxWidth: '500',
        //maxHeight: '500',
        onSearchStart: function () {
            $(this).prev("i").show();
        },
        onSearchComplete: function () {
            $(this).prev("i").hide();
        },
        onSelect: function (suggestion) {
            $(this).val(suggestion.value).attr("data-txt", suggestion.value);
            $(this).next("input").val(suggestion.data);
            $(this).prev("i").prev("i").show();
        }
    });
}


function StartOTPTimer(min, did, bid) {
    var date = new Date();
    date.setMinutes(date.getMinutes() + min);

    // Set the date we're counting down to
    var countDownDate = date.getTime();
    //$("#countdown-box").show();
    // Update the count down every 1 second
    var x = setInterval(function () {
        // Get todays date and time
        var now = new Date().getTime();

        // Find the distance between now and the count down date
        var distance = countDownDate - now;

        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Output the result in an element with id="demo"
        $("#" + did + " span").html(minutes + " min " + seconds + " sec ");

        // If the count down is over, write some text
        if (distance < 0) {
            //clearInterval(x);
            $("#" + did).hide();
            $("#" + bid).prop("disabled", false);
        }
    }, 1000);
}

function LoadRecentSearch() {
    $.ajax({
        type: 'POST',
        url: '/home/RecentSearch',
        success: function (data) {
            $("#recent-search").html(data);
        },
        error: function (e) {
        }
    });
}

/*dynamic links*/

$(function () {
    $(".home-links .airlines a[href='#']").each(function () {
        var updated_link = $(this).attr('href').replace('#', '/airlines/') + $(this).text().replace(/\s+/g, '-').toLowerCase();
        $(this).attr('href', updated_link);
    });
    $(".home-links .topflightdestinations a[href='#']").each(function () {
        var updated_link = $(this).attr('href').replace('#', '/top-flight-destinations/') + $(this).text().replace(/\s+/g, '-').toLowerCase();
        $(this).attr('href', updated_link);
    });
    $(".home-links .topflightroutes a[href='#']").each(function () {
        var updated_link = $(this).attr('href').replace('#', '/top-flight-routes/') + $(this).text().replace(/\s+/g, '-').toLowerCase();
        $(this).attr('href', updated_link);
    });

});

