$(document).ready(function () {
    $("[name=tab]").each(function (i, d) {
        var p = $(this).prop("checked");
        //   console.log(p);
        if (p) {
            $(".flightTab").eq(i).addClass("on");
        }
    });

    $("[name=tab]").on("change", function () {
        var p = $(this).prop("checked");

        // $(type).index(this) == nth-of-type
        var i = $("[name=tab]").index(this);

        $(".flightTab").removeClass("on");
        $(".flightTab").eq(i).addClass("on");
    });

    $(".multi-city").on("click", function () {
        $(".add-city-area").addClass("show");
    });

    $(".single-city").on("click", function () {
        $(".add-city-area").removeClass("show");
    });


    $("#ads-slider").owlCarousel({
        loop: true,
        margin: 0,
        padding: 0,
        nav: false,
        autoplay: true,
        responsive: {
            0: {
                items: 1,
            },
            600: {
                items: 1,
            },
            1000: {
                items: 1,
            },
        },
    });



    $(window)
        .scroll(function () {
            $scrollamount = $(window).scrollTop();

            if ($scrollamount > 150) {
                $(".custom-nav").addClass("fixed_nav");

            } else {
                $(".custom-nav").removeClass("fixed_nav");

            }
        });

    var swiper = new Swiper(".mySwiper", {
        loop: true,
        autoplay: {
            delay: 6000,
            disableOnInteraction: false,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });

    $("#destination-slider").owlCarousel({
        loop: true,
        margin: 0,
        padding: 0,
        nav: false,
        autoplay: true,
        responsive: {
            0: {
                items: 1,
            },
            600: {
                items: 2,
            },
            1000: {
                items: 4,
            },
        },
    });

    $("#hot-deals-offers").owlCarousel({
        loop: true,
        margin: 0,
        padding: 0,
        nav: false,
        autoplay: true,
        responsive: {
            0: {
                items: 1,
            },
            600: {
                items: 1,
            },
            1000: {
                items: 3,
            },
        },
    });

    $("#airlines-partner").owlCarousel({
        loop: true,
        margin: 0,
        padding: 0,
        nav: false,
        autoplay: true,
        responsive: {
            0: {
                items: 2,
            },
            600: {
                items: 2,
            },
            1000: {
                items: 6,
            },
        },
    });


    $('.video-popup').magnificPopup({
        type: 'iframe',
        iframe: {
            markup: '<div class="mfp-iframe-scaler">' +
                '<div class="mfp-close"></div>' +
                '<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>' +
                '</div>', // HTML markup of popup, `mfp-close` will be replaced by the close button

            patterns: {
                youtube: {
                    index: 'youtube.com/', // String that detects type of video (in this case YouTube). Simply via url.indexOf(index).

                    id: 'v=', // String that splits URL in a two parts, second part should be %id%
                    // Or null - full URL will be returned
                    // Or a function that should return %id%, for example:
                    // id: function(url) { return 'parsed id'; }

                    src: 'https://www.youtube.com/embed/%id%?autoplay=1' // URL that will be set as a source for iframe.
                },
                vimeo: {
                    index: 'vimeo.com/',
                    id: '/',
                    src: '//player.vimeo.com/video/%id%?autoplay=1'
                },
                gmaps: {
                    index: '//maps.google.',
                    src: '%id%&output=embed'
                }

                // you may add here more sources

            },

            srcAction: 'iframe_src', // Templating object key. First part defines CSS selector, second attribute. "iframe_src" means: find "iframe" and set attribute "src".
        }
    });


    //input flight swaper
    $("body").on("click", ".swapBtn", function (event) {
        var flyingFrom = $("#from-0").val();
        var flyingTo = $("#to-0").val();
        $("#to-0").val(flyingFrom);
        $("#from-0").val(flyingTo);
    });

    /*//Date picker
    $('input[name="daterange"]').daterangepicker();
  
    $('input[name="daterange"]').daterangepicker(
      {
        singleDatePicker: true,
        autoApply: true,
        showCustomRangeLabel: false,
        minDate: new Date(),
        startDate: "06/27/2023",
        endDate: "07/03/2023",
      },
      function (start, end, label) {
        console.log(
          "New date range selected: " +
            start.format("DD-MM-YYYY") +
            " to " +
            end.format("DD-MM-YYYY") +
            " (predefined range: " +
            label +
            ")"
        );
      }
    );*/
});

//

let radioBtn = document.querySelectorAll("input[name='cabin']");
let result = document.getElementById("cabinResult");

let findSelected = () => {
    let selected = document.querySelector("input[name='cabin']:checked").value;
    result.textContent = `${selected}`;
};
radioBtn.forEach((radioBtn) => {
    radioBtn.addEventListener("change", findSelected);
});

findSelected();

// function switchText() {
//   var obj1 = document.querySelector(".fromLocation").value;
//   var obj2 = document.querySelector(".toLocation").value;

//   var temp = obj1;
//   obj1 = obj2;
//   obj2 = temp;

//   // Save the swapped values to the input element.
//   document.querySelector(".fromLocation").value = obj1;
//   document.querySelector(".toLocation").value = obj2;
// }
