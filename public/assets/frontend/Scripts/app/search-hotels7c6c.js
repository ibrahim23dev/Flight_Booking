/*********************************************************************/
$('body').on("click", "#htl-search-btn", function (event) {
    event.preventDefault();
    var frm = $("#htl-search-form");
    if (frm.valid()) {
        var l = Ladda.create(this);
        l.start();
        frm.submit();
    }
});
/*********************************************************************/
$('body').on('focus', '.focus-action', function (event) {
    $(this).select();
});

/**********************************************************************/
$('body').on('click', '.htl-room-spinner-btn', function (event) {
    SetPeopleTxt();
});
/**********************************************************************/
$('body').on('click', '.htl-adult-spinner-btn', function (event) {

    SetPeopleTxt();
});
/**********************************************************************/
function SetPeopleTxt() {
    var r = parseInt($("#htl-people-room").val());
    var txt = "1 Room, ";
    if (r > 1) {
        txt = r + " Rooms, "
    }

    var a = 0; var c = 0;
    $("#htl-people-room-box").children("div").hide();
    for (var i = 0; i < r; i++) {
        $("#htl-people-room-box").children("div").eq(i).show();
        a += parseInt($("#htl-people-room-box").children("div").eq(i).find(".htl-people-adult").val());
        c += parseInt($("#htl-people-room-box").children("div").eq(i).find(".htl-people-child").val());
    }
    var t = a + c;
    if (t == 1) {
        txt += t + " Guest";
    } else {
        txt += t + " Guests";
    }

    $("#guest-summary").val(txt);
}

/**********************************************************************/
$('body').on('click', '.htl-child-spinner-btn', function (event) {

    var inp = $(this).closest("div").find("input");
    var idx = inp.attr("data-idx");
    var c = parseInt(inp.val());
    //alert(c)
    $("#htl-people-child-age-box-" + idx).hide();
    $(".htl-people-child-age-box-" + idx).hide();//hide all
    if (c > 0) {
        $("#htl-people-child-age-box-" + idx).show();
        for (var i = 0; i < c; i++) {
            $(".htl-people-child-age-box-" + idx).eq(i).show();
        }
    }

    SetPeopleTxt();
});

/**********************************************************************/
$("body").on("click", "#new-search", function (event) {
    event.preventDefault();

    var l = Ladda.create(this);
    l.start();
    $("#back-to-search").prop("disabled", true);
    window.location.href = "/";
});

/**********************************************************************/
function InitDestinationLooksup() {

    var id = "destination-txt";
    var options = {
        url: function (query) {
            $("#" + id).parent("div").prev("i").show();
            $("#" + id).removeClass("focus-action");
            return "/Hotels/SearchDestination?query=" + query;
        },
        getValue: "title",
        list: {
            //match: {
            //    enabled: true
            //},
            maxNumberOfElements: 25,
            onClickEvent: function () {
                var codehp = $("#" + id).getSelectedItemData().data;
                var destination = $("#" + id).getSelectedItemData().title;
                //var airport = $("#" + id).getSelectedItemData().data2;
                //var title = $("#" + id).getSelectedItemData().title;
                $("#" + id).parent("div").next("input").val(codehp);
                //$("#" + id).parent("div").next("input").next("input").val(city);
                //$("#" + id).parent("div").next("input").next("input").next("input").val(airport);
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

function CountryLooksup() {
    /******************* search country   *************************/
    $('.country-lookup').autocomplete({
        serviceUrl: '/Hotels/SearchCountries',
        minChars: 2,
        width: '300',
        maxHeight: '400',
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

/******************* Init Spiners ********************/
function InitHotelsSpinners() {

    var mx = 6;

    $("#htl-people-room").TouchSpin({
        min: 1,
        max: 5,
        buttondown_class: "btn spinner-btn  htl-room-spinner-btn",
        buttonup_class: "btn spinner-btn  htl-room-spinner-btn"
    });
    $(".htl-people-adult").TouchSpin({
        min: 1,
        max: 6,
        buttondown_class: "btn spinner-btn htl-adult-spinner-btn",
        buttonup_class: "btn spinner-btn  htl-adult-spinner-btn"
    });
    $(".htl-people-child").TouchSpin({
        min: 0,
        max: 4,
        buttondown_class: "btn spinner-btn  htl-child-spinner-btn",
        buttonup_class: "btn spinner-btn  htl-child-spinner-btn"
    });
    $(".htl-people-child-age").TouchSpin({
        min: 1,
        max: 21,
        buttondown_class: "btn spinner-btn  htl-child-btn",
        buttonup_class: "btn spinner-btn  htl-child-btn"
    });

}

//function ReInitSpinner() {
//    var adt = parseInt($(".htl-people-adult").val());
//    var chd = parseInt($(".htl-people-child").val());
//    var mx = 6 - adt;

//    $("#htl-people-adult").trigger("touchspin.updatesettings", { max: mx });
//    $("#flt-people-infant").trigger("touchspin.updatesettings", { max: adt });
//}

function InitChekInOutDates() {
    $(".date-input-htl").each(function () {
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
                InitcheckoutDateEl(dp, start);
            });
    });
}
function InitcheckoutDateEl(dp, start) {
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
            InitcheckoutDateEl(dp2, start);
        });

        dp2.data('daterangepicker').toggle();
    }
}

/******************* search city   *************************/
$(document).ready(function () {
    InitHotelCity()
    InitHotelDates('hotelFromDate', 'hotelToDate', 0);
});

function InitHotelCity() {


    var options = {

        url: function (phrase) {
            return "/hotels/searchCity";
        },

        getValue: function (element) {
            return element.Name + ' - ' + element.Country;
        },

        ajaxSettings: {
            dataType: "json",
            method: "POST",
            data: {
                dataType: "json"
            }
        },

        preparePostData: function (data) {
            data.query = $("#hotelCity").val();
            return data;
        },

        requestDelay: 400
    };

    $("#hotelCity").easyAutocomplete(options);
}

$(document).on("click", "#hotelSearchButton", function () {
    var city = $("#hotelCity").val().trim();
    var hotelFromDate = $("#hotelFromDate").val();
    var hotelToDate = $("#hotelToDate").val();
    var hotelRooms = $("#hotelRooms").val();
    window.open(`https://almstravel.hotelplanner.com/Search/?CheckIn=${hotelFromDate}&CheckOut=${hotelToDate}&city=${city}&Rooms=${hotelRooms}#dir-bar`)
})

function InitHotelDates(from, to, i) {
    var checkinDate = new Date().fp_incr(1);
    var checkoutDate = new Date().fp_incr(2);
    $("#hotelFromDate").flatpickr({
        disableMobile: "true",
        dateFormat: 'M d, Y',
        defaultDate: moment(checkinDate).format('MMM DD, YY'),
        minDate: "today",
        onChange: function (selectedDates, dateStr, instance) {
            var formatedDate = moment(selectedDates[0]).format('MMM DD, YY');
            checkinDate = formatedDate
            checkoutDate = new Date(selectedDates).fp_incr(1)
            intReturnDate(checkinDate, checkoutDate)
        }
    })
    intReturnDate(checkinDate, checkoutDate)
}
function intReturnDate(checkinDate, checkoutDate) {
    var defaultdate = moment(checkinDate) > moment(checkoutDate) ? moment(checkinDate) : moment(checkoutDate);
    $("#hotelToDate").flatpickr({
        disableMobile: "true",
        dateFormat: 'M d, Y',
        defaultDate: defaultdate.format('MMM DD, YY'),
        minDate: moment(checkoutDate).format('MMM DD, YY'),
        onChange: function (selectedDates, dateStr, instance) {
            var formatedDate = moment(selectedDates[0]).format('MMM DD, YY');
            checkoutDate = (formatedDate)
        },
    })
}