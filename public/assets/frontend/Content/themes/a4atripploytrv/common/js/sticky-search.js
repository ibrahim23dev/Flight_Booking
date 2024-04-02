// sticky search box
$(window).scroll(function () {

    var scroll = $(window).scrollTop();

    if ($(window).width() > 767) {
        if (scroll >= 400) {
            $("#sticky_cls .search-section").addClass("search-fixed");
            $("#sticky_cls .search-box").addClass("container");
            $("#sticky_cls .search-box").addClass("custom-container");
            $(".home_section").css("z-index", "3");
        } else {
            $("#sticky_cls .search-section").removeClass("search-fixed");
            $("#sticky_cls .search-box").removeClass("container");
            $("#sticky_cls .search-box").removeClass("custom-container");
            $(".home_section").css("z-index", "unset");
        }
    }

});