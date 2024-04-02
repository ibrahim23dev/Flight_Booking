$(document).ready(function () {
    InitSpinnersTour()
});
/*********************************************************************/
$('body').on("click", "#hlyds-search-btn", function (event) {
    event.preventDefault();
    var frm = $("#hlyds-search-form");
    if (frm.valid()) {
        var l = Ladda.create(this);
        l.start();
        frm.submit();
    }
});


///**********************************************************************/



function InitTourDestinationLooksup() {
    console.log('Inside');
    var id = "tour-destination-txt";
    var options = {
        url: function (query) {
            $("#" + id).parent("div").prev("i").show();
            $("#" + id).removeClass("focus-action");
            return "/Tour/SearchDestination?query=" + query;
        },
        getValue: "title",
        list: {

            maxNumberOfElements: 25,
            onClickEvent: function () {
                var country = $("#" + id).getSelectedItemData().conuntry;
                var destination = $("#" + id).getSelectedItemData().title;

                $("#" + id).parent("div").next("input").val(country);

            },
            onLoadEvent: function () {
                $("#" + id).parent("div").prev("i").hide();
            }
        },
        template: {
            type: "custom",
            method: function (value, item) {
                var html = '<div class="row"><div class="col-12">' + value + '</div></div>';
                return html;
            }
        },
        theme: "round"
    };

    $("#" + id).easyAutocomplete(options);
}



function InitTourTheme() {
    var selectedTheme = $("#selectedTheme").val().trim();



    $.ajax({
        url: '/Tour/SearchTheme',

        success: function (data) {

            var objData = JSON.parse(data)
            var uc_selector = document.getElementById("tour_theme_select");

            while (uc_selector.options.length > 0) {
                uc_selector.remove(0);
            }
            var newOption;

            //ading please select at index 0
            newOption = document.createElement("option");
            newOption.value = "";
            newOption.text = "Please Select Tour Category";
            try {
                uc_selector.add(newOption);
            }
            catch (e) {
                uc_selector.appendChild(newOption);
            }


            // create and add new options 
            for (var i = 0; i < objData.length; i++) {
                newOption = document.createElement("option");
                newOption.value = objData[i].Text;
                newOption.text = objData[i].Text;
                if (newOption.text.trim() == selectedTheme) {
                    newOption.selected = "selected";
                }

                try {
                    uc_selector.add(newOption);
                }
                catch (e) {
                    uc_selector.appendChild(newOption);
                }
            }

        },
        error: function (e) {
        }
    });
}

$("#tour_theme_select").change(function () {

    $('#Theme').val(this.value);
    //alert(this.value);
});


$('body').on("click", "#tour-search-btn", function (event) {

    event.preventDefault();

    var packageForm = $("#package");

    if (packageForm.valid()) {
        var l = Ladda.create(this);
        l.start();
        var model = {
            'RequestType': 1,
            'Destination': $('#autocomplete-textbox').val(),
            'DepartureDate': $('#dp-tour').val(),
            'ReturnDate': $('#rt-tour').val(),
            'Phone': $('#tour-phone').val(),
            'Email': $('#tour-email').val(),
            'NoOfRooms': $('#tour-guest-room').val(),
            'PaxCount': $('#tour-guest-no').val(),

        }

        $.ajax({
            url: '/Home/SendtravelRequest',
            type: 'POST',
            data: {
                'model': model
            },
            success: function (data) {
                l.stop();
                console.log(data);
                if (data.result) {
                    swal("Success", "Package request has been sent successfully", "success");
                } else {
                    swal("Warning", "Something Went Wrong !", "warning");
                }

            },
            error: function (e) {
                console.log(e);
            }
        });
    }
   

})
//$('#tour-search-btn').click(function () {
//    var formIsValid = true;

//    $("#package :input[required]").each(function () {
//        if ($.trim($(this).val()) == "") {
//            formIsValid = false;
//            $(this).addClass("is-invalid");
//        }
//        else {
//            $(this).removeClass("is-invalid");
//        }
//    });
//    $("#package :input[required]").on("input change", function () {
//        if ($.trim($(this).val()) != "") {
//            $(this).removeClass("is-invalid");
//            $(this).siblings(".invalid-feedback").hide();
//        }
//    });

//    if (formIsValid) {
       
//    }
  
 

//});



////function CountryLooksup() {
////    /******************* search country   *************************/
////    $('.country-lookup').autocomplete({
////        serviceUrl: '/Hotels/SearchCountries',
////        minChars: 2,
////        width: '300',
////        maxHeight: '400',
////        onSearchStart: function () {
////            $(this).prev("i").show();
////        },
////        onSearchComplete: function () {
////            $(this).prev("i").hide();
////        },
////        onSelect: function (suggestion) {
////            $(this).val(suggestion.value).attr("data-txt", suggestion.value);
////            $(this).next("input").val(suggestion.data);
////            $(this).prev("i").prev("i").show();
////        }
////    });
////}

///******************* Init Spiners ********************/
////function InitHotelsSpinners() {
////    $("#hlyds-people-room").TouchSpin({
////        min: 1,
////        max: 5,
////        buttondown_class: "btn spinner-btn  hlyds-room-spinner-btn",
////        buttonup_class: "btn spinner-btn  hlyds-room-spinner-btn"
////    });
////    $(".hlyds-people-adult").TouchSpin({
////        min: 1,
////        max: 6,
////        buttondown_class: "btn spinner-btn hlyds-adult-spinner-btn",
////        buttonup_class: "btn spinner-btn  hlyds-adult-spinner-btn"
////    });
////    $(".hlyds-people-child").TouchSpin({
////        min: 0,
////        max: 6,
////        buttondown_class: "btn spinner-btn  hlyds-child-spinner-btn",
////        buttonup_class: "btn spinner-btn  hlyds-child-spinner-btn"
////    });
////    $(".hlyds-people-child-age").TouchSpin({
////        min: 1,
////        max: 21,
////        buttondown_class: "btn spinner-btn  hlyds-child-btn",
////        buttonup_class: "btn spinner-btn  hlyds-child-btn"
////    });

////}
function InitTourChekInOutDates() {
    $(".date-input-hlyds").each(function () {
        var dp = $(this);
        dp.daterangepicker({
            singleDatePicker: true,
            autoUpdateInput: false,
            autoApply: true,
            minDate: dp.attr("data-start"),
            maxDate: dp.attr("data-end"),
            locale: {
                cancelLabel: 'Clear',
                format: 'DD MMM YYYY'
            }
        },
            function (start, end, label) {
                InitCheckOutDate(dp, start);
            }
        );
    });
}

function InitCheckOutDate(dp, start) {
    dp.prev("input").val(start.format('MM/DD/YYYY'));
    dp.val(start.format('DD MMM YYYY'));
    var n = dp.attr("data-next");
    //alert(n)
    if (n != "" && n != null) {
        var dp2 = $("#" + n);
        dp2.prev("input").val("");
        dp2.val("");
        dp2.daterangepicker({
            singleDatePicker: true,
            autoUpdateInput: false,
            autoApply: true,
            minDate: start.format('DD MMM YYYY'),
            maxDate: dp2.attr("data-end"),
            locale: {
                cancelLabel: 'Clear',
                format: 'DD MMM YYYY'
            }
        }, function (start, end, label) {
            InitCheckOutDate(dp2, start);
        });

        dp2.data('daterangepicker').toggle();
    }
}


/******************* Init Spiners ********************/
function InitSpinnersTour() {
    var mx = 20;
    var adt = parseInt($("#tour-guest-room").val());

    $("#tour-guest-room").TouchSpin({
        min: 1,
        max: mx,
        buttondown_class: "btn spinner-btn  tour-room-spinner-btn",
        buttonup_class: "btn spinner-btn  tour-room-spinner-btn"
    });

    $("#tour-guest-no").TouchSpin({
        min: 0,
        max: mx,
        buttondown_class: "btn spinner-btn tour-guest-spinner-btn",
        buttonup_class: "btn spinner-btn tour-guest-spinner-btn"
    });

}
/*********************************************************************/
$('body').on('click', '.tour-room-spinner-btn', function (event) {

    SetDisplayTextTour();
});
/*********************************************************************/
$('body').on('click', '.tour-guest-spinner-btn', function (event) {
    SetDisplayTextTour();
});
function SetDisplayTextTour() {
    var a = parseInt($("#tour-guest-room").val());
    var c = parseInt($("#tour-guest-no").val());

    var txt = a + " Room";
    if (a > 1) {
        txt += "s";
    }

    txt += ", " + c + " Guest"
    if (c > 1) {
        txt += "s"
    }

    $("#guest-summary").val(txt);
}