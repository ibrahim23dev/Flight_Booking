$(document).ready(function () {
    flyTypeSelect();
})

$('body').on("click", ".beSwapCity", function (event) {
    event.preventDefault();
    var ele = $(this);
    ele.toggleClass("jsRotateClass");

    var inp1 = ele.parent("li").prev("li").children("div").first().children("div").first().children("input").first();
    var inp2 = ele.parent("li").next("li").children("div").first().children("div").first().children("input").first();
    var d1 = inp1.val();
    var d2 = inp2.val();

    var inp3 = ele.parent("li").prev("li").children("div").first().children("input").first();
    var inp4 = ele.parent("li").next("li").children("div").first().children("input").first();
    var code1 = inp3.val();
    var code2 = inp4.val();


    var inp5 = inp3.next("input");
    var inp6 = inp4.next("input");
    var city1 = inp5.val();
    var city2 = inp6.val();

    var inp7 = inp5.next("input");
    var inp8 = inp6.next("input");
    var airport1 = inp7.val();
    var airport2 = inp8.val();


    inp1.toggleClass("goToRight");
    inp2.toggleClass("goToLeft");

    ele.parent("li").prev("li").children("div").first().children("div").first().children("div").first().children("ul").html("");
    ele.parent("li").next("li").children("div").first().children("div").first().children("div").first().children("ul").html("");

    inp1.addClass("focus-action");
    inp2.addClass("focus-action");

    setTimeout(function () {
        inp1.toggleClass("goToRight");
        inp2.toggleClass("goToLeft");
        inp1.val(d2);
        inp2.val(d1);

        inp3.val(code2);
        inp4.val(code1);

        inp5.val(city2);
        inp6.val(city1);

        inp7.val(airport2);
        inp8.val(airport1);

    }, 300);
});
/*********************************************************************/
$('body').on('focus', '.focus-action', function (event) {
    $(this).select();
});
///*********************************************************************/
function flyTypeSelect() {
    var v = $('input[name="JourneyType"]:checked').val();
    if (v === "1" || v === "3") {
        $("#mc-0").removeClass("jt-round").addClass("jt-oneway");

        if (v === "1") {
            $(".round-pass").append($(".passenger_info"));
            $('#mc-0').show();
            $('#mc-box').hide();
        }
        if (v === "3") {
            $(".multi-pass").append($(".passenger_info"));
            $("#mc-2").show();
            $("#mc-3").show();
            $("#dp-0").attr("data-next", "dp-3");
            $("#dp-3").attr("data-next", "dp-4");
            $("#s-2").val("0");
            $("#s-3").val("1");
            $('#mc-0').hide();
            $('#mc-box').show();
        }
    } else if (v === "2") {
        //********************************************************
        $(".round-pass").append($(".passenger_info"));
        $("#dp-0").attr("data-next", "dp-1");
        $('#mc-0').show();
        $('#mc-box').hide();
        //********************************************************

        $("#mc-0").removeClass("jt-oneway").addClass("jt-round");
        InitNextDate($('#dp-0'), moment($('#dp-0').val()).format("YYYY-MM-DD"))

    }
    multicityBtns()
}

$('body').on('click', 'input[name=JourneyType]', function (event) {
    flyTypeSelect();
});

/*********************************************************************/
$('body').on('click', '.city-add-btn', function (event) {
    event.preventDefault();
    var id = parseInt($(this).attr("data-id"));

    /// logic for previous and current dtp selected
    var dtpValPrev = $("#dp-" + (id - 1)).val();
    var dtpVal = $("#dp-" + id).val();
    console.log("selected ID:" + id);
    console.log("dtpValPrev & DTP:" + dtpValPrev + " & " + dtpVal);
    if (dtpValPrev === "" || dtpValPrev === null) {
        $("#dp-" + (id - 1)).focus();
        return false;
    }
    if (dtpVal === "" || dtpVal === null) {
        $("#dp-" + id).focus();
        return false;
    }

    var next = id + 1;
    $("#s-" + next).val(id - 1);

    var e1 = id + 1;
    $("#mc-" + e1).show();
    $("#dp-" + e1).attr("data-next", "dp-" + (e1 + 1));
    $(this).hide();
    if (id === 4) {
        $("#a-" + e1).hide();
    } else {
        $("#a-" + e1).show();
        $("#r-" + e1).show();
    }
    // $("#r-" + id).hide();
});
/*********************************************************************/
$('body').on('click', '.city-remove-btn', function (event) {
    event.preventDefault();
    var id = parseInt($(this).attr("data-id"));
    //$("#dp-" + id).attr("data-next", "");
    $("#s-" + id).val("-1");

    if (id === 1) {
        $('input[name=JourneyType]').filter('[value="1"]').prop("checked", true);
        $(".mc-boxes").hide();
        $(".journey-sn").val("-1");
    } else {
        $("#mc-" + id).hide().find('.remove-value').val('');
        var e1 = id - 1;
        $("#a-" + e1).show();
        $("#r-" + e1).show();
    }
    
});
/*****************************************/
function multicityBtns() {
    var elements = $(".journey-sn");
    var maxValue = 0;
    elements.each(function () {
        var elementValue = $(this).val();
        if (!isNaN(elementValue) && elementValue > maxValue) {
            maxValue = elementValue;

        }
    });
    elementVal = Number(maxValue) + 2;

    $("#a-" + elementVal).show();
    $("#r-" + elementVal).show();
}
/*********************************************************************/
$('body').on('click', '.calender-icon', function (event) {
    $(this).prev("input").focus();
});
/*********************************************************************/
$('#flt-people-adult').on('change', function (event) {

    $("#flt-people-child").val("0");
    $("#flt-people-infant").val("0");
    ReInitSpinner();

    SetDisplayText();
});
/*********************************************************************/
$('#flt-people-child').on('change', function (event) {
    SetDisplayText();
});
/*********************************************************************/
$('#flt-people-infant').on('change', function (event) {
    SetDisplayText();
});
/*********************************************************************/
$('body').on('click', 'input[name=TravelClass]', function (event) {
    SetDisplayText();
});
/*********************************************************************/
$('body').on("click", "#flt-search-btn", function (event) {
    event.preventDefault();
    var frm = $("#flt-search-form");

    //console.log($('#flt-people-adult').val());
    //console.log($('#flt-people-child').val());
    //console.log($('#flt-people-infant').val());

    $('#flt-people-adult-f').val($('#flt-people-adult').val());
    $('#flt-people-child-f').val($('#flt-people-child').val());
    $('#flt-people-infant-f').val($('#flt-people-infant').val());

    //var data = PrepearJasonData("tryotel-form");
    //console.log(data);

    if (frm.valid()) {
        var l = Ladda.create(this);
        l.start();
        frm.submit();
    }
});
/*********************************************************************/
function SetDisplayText() {
    var a = parseInt($("#flt-people-adult").val());
    var c = parseInt($("#flt-people-child").val());
    var i = parseInt($("#flt-people-infant").val());


    var t = a + c + i;
    var txt = t + " Traveller";
    if (t > 1) {
        txt += "s";
    }

    //var cType = $("input[name=TravelClass]:checked").attr('data-txt');
    //txt += ", " + cType;

    var tcv = $("#travel-class-select").val();
    if (tcv == "Y") {
        txt += ", Economy";
    }
    if (tcv == "C") {
        txt += ", Business";
    }
    if (tcv == "F") {
        txt += ", First";
    }
    if (tcv == "S") {
        txt += ", Premium Economy";
    }

    $("#traveller-summary").val(txt);
}
/*********************************************************************/
function InitSpinners() {
    var mx = 9;
    var adt = parseInt($("#flt-people-adult").val());

    $("#flt-people-adult").TouchSpin({
        min: 1,
        max: mx,
        buttondown_class: "btn spinner-btn  flt-adt-spinner-btn",
        buttonup_class: "btn spinner-btn  flt-adt-spinner-btn"
    });

    mx = parseInt($("#flt-people-max-adults").val()) - adt;
    $("#flt-people-child").TouchSpin({
        min: 0,
        max: mx,
        buttondown_class: "btn spinner-btn flt-child-spinner-btn",
        buttonup_class: "btn spinner-btn flt-child-spinner-btn"
    });

    $("#flt-people-infant").TouchSpin({
        min: 0,
        max: adt,
        buttondown_class: "btn spinner-btn flt-child-spinner-btn",
        buttonup_class: "btn spinner-btn flt-child-spinner-btn"
    });
}
/*********************************************************************/
function ReInitSpinner() {
    var adt = parseInt($("#flt-people-adult").val());
    var mx = 9 - adt;

    $("#flt-people-child").trigger("touchspin.updatesettings", { max: mx });
    $("#flt-people-infant").trigger("touchspin.updatesettings", { max: adt });
}
/*********************************************************************/
function InitDestinationAutocomplete(d1, d2) {
    // InitAirportAutocomplete(d1);
    // InitAirportAutocomplete(d2);
}
/*********************************************************************/
function InitAirportAutocomplete(id) {
    var options = {
        url: function (query) {
            //var isUmrahFlight = $('#IsUmrahFlight').val().toLowerCase();

            var fareType = $('#FareType').val().toLowerCase();
            var isUmrahFlight = "false";

            if (fareType == "umrah") {
                isUmrahFlight = "true";
            }

            $("#" + id).parent("div").prev("i").show();
            $("#" + id).removeClass("focus-action");
            return "/Flights/SearchAirports?query=" + query + "&isUmrahFlight=" + isUmrahFlight;
        },
        getValue: "title",
        list: {
            //match: {
            //    enabled: true
            //},
            maxNumberOfElements: 25,
            onClickEvent: function () {

                var code = $("#" + id).getSelectedItemData().iata;
                var city = $("#" + id).getSelectedItemData().data5;
                var airport = $("#" + id).getSelectedItemData().data2;
                var title = $("#" + id).getSelectedItemData().title;
                $("#" + id).parent("div").next("input").val(code);
                $("#" + id).parent("div").next("input").next("input").val(city);
                $("#" + id).parent("div").next("input").next("input").next("input").val(airport);

                var i = parseInt($("#" + id).attr("data-id")) + 1;
                if (i >= 1) {
                    $("#from-" + i).val(title);
                    $("#from-" + i).parent("div").next("input").val(code);
                    $("#from-" + i).parent("div").next("input").next("input").val(city);
                    $("#from-" + i).parent("div").next("input").next("input").next("input").val(airport);
                    $("#from-" + i).parent("div").next("input").next("input").next("input").next("input").val(airport);
                }
            },
            onKeyEnterEvent: function () {
                var code = $("#" + id).getSelectedItemData().value;
                var city = $("#" + id).getSelectedItemData().data5;
                var airport = $("#" + id).getSelectedItemData().data2;
                var title = $("#" + id).getSelectedItemData().title;
                $("#" + id).parent("div").next("input").val(code);
                $("#" + id).parent("div").next("input").next("input").val(city);
                $("#" + id).parent("div").next("input").next("input").next("input").val(airport);
                $("#from-" + i).parent("div").next("input").next("input").next("input").next("input").val(airport);

                var i = parseInt($("#" + id).attr("data-id")) + 1;
                if (i >= 1) {
                    $("#from-" + i).val(title);
                    $("#from-" + i).parent("div").next("input").val(code);
                    $("#from-" + i).parent("div").next("input").next("input").val(city);
                    $("#from-" + i).parent("div").next("input").next("input").next("input").val(airport);
                    $("#from-" + i).parent("div").next("input").next("input").next("input").next("input").val(airport);
                }
            },
            onLoadEvent: function () {
                $("#" + id).parent("div").prev("i").hide();
            }
        },
        template: {
            type: "custom",
            method: function (value, item) {

                var html = `<div class="row airline-name-mob"><div class="col-9 col-md-10"><div class="row flex-column"><div class="col-sm-12 eac-title-1 text-truncate"> <i class="fas fa-map-marker-alt"></i> ${item.name} ${item.city}, ${item.country} <span>(${item.iata}) </span></div><div class="col-sm-12 eac-title-3 text-truncate">${item.iata}</div></div></div>`;
                html += '<div class="col-3 col-md-2 eac-title-2">  </div></div>';

            return html;
            }
        },
        theme: "round"
    };

    $("#" + id).easyAutocomplete(options);
}

/**********************************************************************/
$('body').on('click', '#modify-search-btn', function (event) {
    event.preventDefault();
    $("#search-form").slideToggle();
});

/*********************************************************************/
$("body").on("click", ".sortClass", function (event) {
    var value = $(this).attr('data-id');
    var title = $(this).text();
    $("#Sorting-FLT").val(value);
    changeSortSelectText(title)
    SortResults();
});

/*********************************************************/
function ResetDetailsBox(id) {
    $(".details-box").not("#d-" + id).hide();
    $("#d-" + id).toggle();
    $("#b-" + id).find("i").toggleClass("la-chevron-down la-chevron-up");
}
/**********************************************************************/
$('body').on('click', '.flight-details-btn', function (event) {
    event.preventDefault();
    var id = $(this).attr("data-id");
    ResetDetailsBox(id);
});
/**********************************************************************/
$('body').on('click', '.details-box-close', function (event) {
    event.preventDefault();
    var id = $(this).attr("data-id");
    ResetDetailsBox(id);
});
/***************************** FARE RULES ********************/
$('body').on('click', '.fare-rules-btn', function (event) {
    event.preventDefault();
    console.log("fare rules Clicked");

    if ($(this).attr("data-isloaded") === "false") {
        var ele = $(this);
        var id = $(this).attr("data-id");
        var b = $("#i-" + id).val();
        var searchrq = $("#searchrq-" + id).val();
        var data = "{'b': " + b + ",'s': " + searchrq + "}";

        $.ajax({
            type: 'POST',
            contentType: "application/json; charset=utf-8",
            data: data,
            url: '/Flights/FareRules/',
            success: function (data) {
                $('#pills-3-' + id).html(data);
                ele.attr("data-isloaded", "true");
            },
            error: function (e) {
            }
        });
    }
});
/**********************************************************************/

//input flight swaper
$('body').on("click", ".flt-swapper", function (event) {
    var flyingFrom = $('#from-0').val();
    var orginLocCode = $('#orginLocCode').val();
    var orginCity = $('#orginCity').val();
    var orginAirport = $('#orginAirport').val();

    var flyingTo = $('#to-0').val();
    var destLocCode = $('#destLocCode').val();
    var destCity = $('#destCity').val();
    var destAirport = $('#destAirport').val();

    $('#to-0').val(flyingFrom);
    $('#destLocCode').val(orginLocCode);
    $('#destCity').val(orginCity);
    $('#destAirport').val(orginAirport);

    $('#orginAirport').val(destAirport);
    $('#orginCity').val(destCity);
    $('#orginLocCode').val(destLocCode);
    $('#from-0').val(flyingTo);
});