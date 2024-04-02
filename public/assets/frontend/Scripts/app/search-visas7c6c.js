$(document).ready(function () {
    InitSpinnersVisa()
});

/*********************************************************************/


///**********************************************************************/


function InitVisaCountry() {
    var selectedVisa = $("#selectedVisa").val().trim();



    $.ajax({
        url: '/Visa/LoadVisaCountryListCombo',

        success: function (data) {

            var objData = JSON.parse(data)
            var uc_selector = document.getElementById("visa_country_select");

            while (uc_selector.options.length > 0) {
                uc_selector.remove(0);
            }
            var newOption;

            //ading please select at index 0
            newOption = document.createElement("option");
            newOption.value = "";
            newOption.text = "Please Select A Country";
            try {
                uc_selector.add(newOption);
            }
            catch (e) {
                uc_selector.appendChild(newOption);
            }


            // create and add new options 
            for (var i = 0; i < objData.length; i++) {
                newOption = document.createElement("option");
                newOption.value = objData[i].Value;
                newOption.text = objData[i].Text;
                if (newOption.text.trim() == selectedVisa) {
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

$('#visa_country_select').change(function () {

    var selectedValue = $(this).val();
    LoadVisaTypeList(selectedValue);
  

});


function LoadVisaTypeList(countryId) {
    $.ajax({
        type: 'POST',
        url: '/visa/LoadVisaTypeCountryMappingComboByCountryId',
        data: {
            "countryId": countryId
        },

        success: function (data) {

            var objData = JSON.parse(data)
            var uc_selector = document.getElementById("visa_type_select");

            while (uc_selector.options.length > 0) {
                uc_selector.remove(0);
            }
            var newOption;

            //ading please select at index 0
            newOption = document.createElement("option");
            newOption.value = "";
            newOption.text = "Please Select A Type";
            try {
                uc_selector.add(newOption);
            }
            catch (e) {
                uc_selector.appendChild(newOption);
            }


            // create and add new options 
            for (var i = 0; i < objData.length; i++) {
                newOption = document.createElement("option");
                newOption.value = objData[i].Value;
                newOption.text = objData[i].Text;
                if (newOption.text.trim() == selectedVisa) {
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

/******************* Init Spiners ********************/
function InitSpinnersVisa() {
    var mx = 20;
    var adt = parseInt($("#visa-traveller-no").val());

    $("#visa-traveller-no").TouchSpin({
        min: 1,
        max: mx,
        buttondown_class: "btn spinner-btn  visa-spinner-btn",
        buttonup_class: "btn spinner-btn  visa-spinner-btn"
    });


}
/*********************************************************************/
$('body').on('click', '.visa-spinner-btn', function (event) {

    SetDisplayTextVisa();
});
/*********************************************************************/

$('body').on("click", "#visa-search-btn", function (event) {

    event.preventDefault();

    var visaForm = $("#visa");

    if (visaForm.valid()) {
        var l = Ladda.create(this);
        l.start();
        var model = {
            'RequestType': 2,
            'Destination': $('#searchcountry').val(),
            'DepartureDate': $('#dp-visa').val(),
            'ReturnDate': $('#rt-visa').val(),
            'Phone': $('#tour-phone').val(),
            'Email': $('#tour-email').val(),
            'Nationality': $('#auto-nationality').val(),
            'NoOfRooms': $('#tour-guest-room').val(),
            'PaxCount': $('#visa-traveller-no').val(),

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
                    swal("Success", "Visa request has been sent successfully", "success");
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

//$('#visa-search-btn').click(function () {
//    var formIsValid = true;

//    $("#visa :input[required]").each(function () {
//        if ($.trim($(this).val()) == "") {
//            formIsValid = false;
//            $(this).addClass("is-invalid");
//        }
//        else {
//            $(this).removeClass("is-invalid");
//        }
//    });

//    $("#visa :input[required]").on("input change", function () {
//        if ($.trim($(this).val()) != "") {
//            $(this).removeClass("is-invalid");
//            $(this).siblings(".invalid-feedback").hide();
//        }
//    });

//    if (formIsValid) {
//        var model = {
//            'RequestType': 2,
//            'Destination': $('#searchcountry').val(),
//            'DepartureDate': $('#dp-visa').val(),
//            'ReturnDate': $('#rt-visa').val(),
//            'Phone': $('#tour-phone').val(),
//            'Email': $('#tour-email').val(),
//            'Nationality': $('#nationality').val(),
//            'NoOfRooms': $('#tour-guest-room').val(),
//            'PaxCount': $('#visa-traveller-no').val(),

//        }

//        $.ajax({
//            url: '/Home/SendtravelRequest',
//            type: 'POST',
//            data: {
//                'model': model
//            },
//            success: function (data) {
//                console.log(data);
//                if (data.result) {
//                    swal("Success", "Send Visa request has been sent successfully", "success");
//                } else {
//                    swal("Warning", "Something Went Wrong !", "warning");
//                }

//            },
//            error: function (e) {
//                console.log(e);
//            }
//        });
//    }



//});

function SetDisplayTextVisa() {
    var a = parseInt($("#visa-traveller-no").val());

    var txt = a + " Traveller";
    if (a > 1) {
        txt += "s";
    }

    $("#guest-summary-visa").val(txt);
}