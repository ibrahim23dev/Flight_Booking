var curd_url = "";
/*******************load form ***************************************************/
$("body").on("click", ".load-form", function (event) {
    event.preventDefault();
    var id = $(this).attr("data-id");
    var title = $(this).attr("data-title");
    var n = $(this).attr("data-curd");
    var url1 = $(this).attr("data-url-load");
    var url2 = $(this).attr("data-url-save");
    $("#modal-1-footer").hide();
    $("#modal-1-header").html(title);
    $('#modal-1').modal('toggle');

    $("#modal-1-save-btn").attr("data-curd", n);
    $("#modal-1-save-btn").attr("data-url", url2);

    LoadForm(id, url1)
});
/*******************save form****************************************************/
$("body").on("click", "#modal-1-save-btn", function (event) {
   
    var n = $(this).attr("data-curd");
    var url = $(this).attr("data-url");
    var cls = n + "-form";
    var frm = $("." + cls);

    if (frm.valid()) { // validation passed
        // Automatically trigger the loading animation on click
        var l = Ladda.create(this);
        l.start();

        $("#modal-cancel-btn").prop("disabled", true);

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
                if (data.Result) {
                    $('#modal-1').modal('toggle');
                    AlertSuccess(data.Message);
                   LoadList();
                } else {
                    AlertError(data.Message);
                }

                l.stop();
                $("#modal-cancel-btn").prop("disabled", false);
            },
            error: function (e) {
                //alert(e.responseText);
                l.stop();
                $("#modal-cancel-btn").prop("disabled", false);
            }
        });
    }
});
/*******************delete ******************************************************/
$("body").on("click", ".link-delete", function (event) {
    event.preventDefault();
    $("#modal-delete-name").html($(this).attr("data-name"));
    $("#delete-ok-button").attr("data-url", $(this).attr("data-url"));
    $('#modal-delete').modal('toggle');
    $("#delete-ok-button").attr("class", "btn btn-danger ladda-button delete-ok");
});
/***********************delete ok***********************************************/
$("body").on("click", ".delete-ok", function (event) {
    event.preventDefault();
    var url = $(this).attr("data-url");
    l = Ladda.create(this);
    l.start();
    $("#delete-cancel-btn").prop("disabled", true);
    $.ajax({
        type: 'POST',
        url: url,
        success: function (data) {
            if (data.Result) {
                LoadList();
                $('#modal-delete').modal('toggle');;
                AlertSuccess(data.Message);
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


function LoadForm(id, url) {
    $("#modal-1-ok-btn").addClass("role-ok");

    // Retrieve CSRF token from meta tag
    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        type: 'POST',
        data: { 'id': id },
        url: url,
        headers: {
            'X-CSRF-TOKEN': csrfToken // Include CSRF token in the headers
        },
        success: function (data) {
            // Check if data is successfully received
            if(data && data.content){
                $('#modal-1-body').html(data.content);
                $("#modal-1-footer").show();
            } else {
                // console.error('Data or content is missing.');
            }
        },
        error: function (xhr, status, error) {
            // console.error('Error:', error);
         
        }
    }).done(function () {
        // Additional actions after AJAX request completion
    });
}


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
            ReSizeSidebar();
            InitAfterLoadList();
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