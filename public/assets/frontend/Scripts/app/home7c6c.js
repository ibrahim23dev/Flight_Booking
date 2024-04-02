InitDates();//both flights and hotels
InitSpinners();
InitDestinationAutocomplete('from-0', 'to-0');
InitDestinationAutocomplete('from-1', 'to-1');
InitDestinationAutocomplete('from-2', 'to-2');
InitDestinationAutocomplete('from-3', 'to-3');
InitDestinationAutocomplete('from-4', 'to-4');
InitDestinationAutocomplete('from-5', 'to-5');
InitDestinationAutocomplete('from-6', 'to-6');
InitDestinationAutocomplete('from-7', 'to-7');
InitDestinationAutocomplete('from-8', 'to-8');
InitDestinationAutocomplete('from-9', 'to-9');
InitDestinationAutocomplete('from-10', 'to-10');
InitDestinationAutocomplete('from-11', 'to-1');
InitDestinationAutocomplete('from-12', 'to-12');
InitDestinationAutocomplete('from-13', 'to-13');
InitDestinationAutocomplete('from-14', 'to-14');
InitDestinationAutocomplete('from-15', 'to-15');
$(document).ready(function () {
    $("#flt-search-form")[0].reset();
});

$('body').on('click', '.tab-links', function (event) {
    var id = $(this).attr("data-id");
    $(".tab-links").removeClass("active");
    $(this).addClass("active");
    $(".form-boxes").hide();
    $(".form-titles").hide();
    $("." + id).show();
});

InitChekInOutDates();
InitHotelsSpinners();
InitDestinationLooksup();
InitTourChekInOutDates();
InitTourTheme();
//InitVisaCountry();
InitTourDestinationLooksup();
$('.select-2').select2();
//$("#e1").select2();
