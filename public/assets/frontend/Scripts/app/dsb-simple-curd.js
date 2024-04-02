var curd_url = "";
/**********************************************************************/
$("body").on("click", "#filter-btn", function (event) {
    event.preventDefault();
    $("#page-number").val("1");
    l = Ladda.create(this);
    l.start();
    LoadList();
});
/**********************************************************************/
$('body').on("change", "#select-page-size", function (event) {
    $('#page-number').val("1");
    $('#page-size').val($(this).val());
    LoadList();
});
/**********************************************************************/
$('body').on("click", ".pagination a", function (event) {
    event.preventDefault();
    var link = $(this).attr("href");
    $('#page-number').val(link.replace("/?page=", ""));
    LoadList();
});
/**********************************************************************/
$("body").on("click", "#save-btn", function (event) {
    event.preventDefault();
    
    var n = $(this).attr("data-curd");
    var url = $(this).attr("data-url");
    var cls = n + "-form";
    var frm = $("." + cls);

    if (frm.valid()) { // validation passed
        // Automatically trigger the loading animation on click
        var l = Ladda.create(this);
        l.start();
       
        $("#delete-btn").prop("disabled", true);
        $("#back-btn").prop("disabled", true);
   
        var jsonData = PrepearJasonFormData(cls);
        var data = "{'model':" + JSON.stringify(jsonData) + "}";
        //alert(data); return;
        $.ajax({
            type: 'POST',
            contentType: "application/json; charset=utf-8",
            url: url,
            dataType: 'json',
            data: data,
            success: function (data) {
                l.stop();
                $("#delete-btn").prop("disabled", false);
                $("#back-btn").prop("disabled", false);

                if (data.Result) {
                    AlertSuccess(data.Message);
                    $("." + n + "-id").val(data.Id);
                    $("." + n + "-data-id").attr("data-id", data.Id);
                    $("." + n + "-hidden").show();
                    $("#save-btn").html("Save");
                    try{
                        InitAfterSave();
                    }
                    catch(e){}
                } else {
                    AlertError(data.Message);
                }
            },
            error: function (e) {
                //alert(e.responseText);
                l.stop();
                $("#delete-btn").prop("disabled", false);
                $("#back-btn").prop("disabled", false);
            }
        });
    }
});
/**********************************************************************/
$("body").on("click", ".link-delete", function (event) {
    event.preventDefault();
    $("#modal-delete-name").html($(this).attr("data-name"));
    $("#delete-ok-button").attr("data-url", $(this).attr("href"));
    $("#delete-ok-button").attr("data-type", "list");
    //$('#modal-delete').modal('toggle');
    $.magnificPopup.open({
        items: { src: '#modal-delete' },
        type: 'inline',
        fixedContentPos: true,
        fixedBgPos: true,
        overflowY: 'auto',
        closeBtnInside: true,
        preloader: false,
        midClick: true,
        removalDelay: 300,
        //closeMarkup: '<button title="%title%" type="button" class="mfp-close"></button>',
        mainClass: 'my-mfp-zoom-in'
    });
    $("#delete-ok-button").attr("class", "btn btn-danger ladda-button delete-ok");
});
/**********************************************************************/
$("body").on("click", "#delete-btn", function (event) {
    event.preventDefault();
    $("#modal-delete-name").html($(this).attr("data-name"));
    $("#delete-ok-button").attr("data-url", $(this).attr("data-url") + $(this).attr("data-id"));
    $("#delete-ok-button").attr("data-type", "form");
    $('#modal-delete').modal('toggle');
    $("#delete-ok-button").attr("class","btn btn-danger ladda-button delete-ok");
});
/**********************************************************************/
$("body").on("click", ".delete-ok", function (event) {
    event.preventDefault();
    var url = $(this).attr("data-url");
    var type = $(this).attr("data-type");
    l = Ladda.create(this);
    l.start();
    $("#delete-cancel-btn").prop("disabled", true);
    $.ajax({
        type: 'POST',
        url: url,
        success: function (data) {
            $(".mfp-close").click();
            if (data.Result) {
                if (type == "list") {
                    SetPageNumberForDelete();
                    LoadList();
                } else {
                    $("#back-btn").click();
                }
                //AlertSuccess(data.Message);
            } else {
                AlertError(data.Message);
            }
        },
        error: function (e) {
            l.stop();
            $("#delete-cancel-btn").prop("disabled", false);
        }
    }).done(function () {
        l.stop();
        $("#delete-cancel-btn").prop("disabled", false);
    });
});
/**********************************************************************/


/**********************************************************************/
function LoadList() {  
    var jdata = PrepearJasonData('filter-item');
    $.ajax({
        type: 'POST',
        url: curd_url,
        contentType: "application/json; charset=utf-8",
        data: JSON.stringify(jdata),
        success: function (data) {
            $('#content-box').html(data);
            InitSortingHeader("content-box");
            try{
                InitAfterLoadList();
            }catch(e){}
        },
        error: function (e) {
            //alert(e.responseText);
            l.stop();
        }
    }).done(function () {
        l.stop();
    });
}
/**********************************************************************/
function LoadTableData() {
    LoadList();
}
/**********************************************************************/
function SetCurdUrl(url) {
    curd_url = url;
}