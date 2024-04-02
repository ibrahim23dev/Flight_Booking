<style>
/* Media query for large screens */
@media screen and (min-width: 768px) {
    .second-links {
        margin-top: -3rem;
    }
}

/* Media query for tablets and mobile */
@media screen and (max-width: 767px) {
    .second-links {
        margin-top: 1rem;
    }
}
</style>
<footer class="footer-block">
    <div class="container">
        <div class="row text-md-start text-center">
            <div class="col-12 col-md-12 col-lg-4 ">
                <div class="footer-content mb-3 d-block">
                    <div class="footer-logo">
                        <a href="{{ route('home') }}">
                            <div class="cusTomLogo">
                                <img src="{{ url('storage/images/site_identity/'.getSiteIdentity()->logo_image) }}"
                                     alt="logo"
                                     class="img-fluid"
                                     width="160" />
                            </div>
                        </a>
                    </div>

                    <ul class="address-area pe-3">
                        <li class="map pe-lg-3 pe-0">
                            <a href="#">
                                <span class="">
                                  Address:  {{ getContactDetails()->address }}
                                </span>
                            </a>
                        </li>
                        <li class="phone">
                            <a href="tel:+88-09611677800">Phone:  {{ getContactDetails()->phone }}</a>
                        </li>

                        <li class="email">
                            <a href="mailto:{{ getContactDetails()->email }}">Email:  {{ getContactDetails()->email }}</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-5 d-block">
                <div class="footer-content mt-3 d-block">
                    <h5 class="footer-title">QUICK LINKS</h5>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="footer-links">

                            <ul>
                                @php $pages = getActivePages(); $totalPages = count($pages); @endphp
                                @foreach ($pages->slice(0, 2) as $page)
                                    <li>
                                        <a href="#" class="load-form text-reset" data-id="{{ $page->id }}" data-title="{{ $page->slug }}" data-url-load="{{ route('getPageContent') }}">{{ $page->title }}</a>
                                    </li>
                                @endforeach
                                <li>
                                    <a href="{{ route('tours.list') }}" class="text-reset">Tour Packages</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="footer-links d-block second-links">
                            <h5 class="footer-title">IMPORTANT LINKS</h5>
                            <ul>
                                @foreach ($pages->slice(2) as $page)
                                    <li>
                                        <a href="#" class="load-form text-reset" data-id="{{ $page->id }}" data-title="{{ $page->slug }}" data-url-load="{{ route('getPageContent') }}">{{ $page->title }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                
                
            </div>

            <div class="col-12 col-md-6 col-lg-3 d-block">
                <div class="footer-content mt-3 d-block">
                   
                    <h5 class="footer-title social-line-heading">Follow On</h5>
                    <ul class="social-media-links">
                        
                        @foreach(json_decode(getSiteIdentity()->social_links) as $key => $value)
                      
                        <li>
                            <a class="{{ $value->social_name }}" href="{{ $value->social_url }}" target="_blank">
                              <i class="fa-brands  {{ getSocialMediaIconClass($value->social_name) }} "></i>
                            </a>

                          </li> 

                    @endforeach
                    </ul>
                </div>
            </div>

            {{-- <div class="col-lg-12 border-bottom">
                <img src="Content/themes/home/img/amar-pay.jpg" class="img-fluid mb-2" style="background-color: #fff; border-radius: 10px;"/>
            </div> --}}

           
        </div>
    </div>
    <div class="col-lg-12 bg-dark" style="padding: 1rem 0;
position: absolute;display: flex;justify-content:space-between">
        <div class=" col-lg-6">
            <p class="text-center text-white">
                ©
                <script data-cfasync="false" src="{{ asset('assets/frontend/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js') }}"></script><script>
                    document.write(new Date().getFullYear());
                </script>
                {{ getSiteIdentity()->site_title }} . All rights reserved.
            </p>
        </div>
        <div class=" col-lg-6">
            <p class="text-center">
                <img width="255" height="22" src="{{ asset('assets/frontend/images/payments.png') }}" class="attachment-large size-large wp-image-9619" alt="">
            </p>
        </div>
    </div>
</footer>
    <!-- ================================
           END FOOTER AREA
    ================================= -->
    <!-- tap to top -->
    <!-- mobile menu -->
    <div class="mobilebar-container mobile-layout">
    <div style="box-shadow: 0 10px 6px 0 rgba(0, 0, 0, 0.175);border-radius: 6px;border: 10px solid #fff;">
        <nav class="mobilebar-tab">

            <a href="{{ route('home') }}" id="applicationBarMobileButton1" class="mobilebar-tab-item active">
                <span class="mobilebar-tab__icon">
                    <i class="fas fa-home"></i>
                </span>
            </a>

            <a href="{{ route('tours.list') }}" class="mobilebar-tab-item booking-menu">
                <span class="mobilebar-tab__icon">
                    <i class="fas fa-ticket"></i>
                </span>
            </a>

            <a href="{{ auth()->user() ? route('dashboard') : route('login') }}" class="mobilebar-tab-item">
                <span class="mobilebar-tab__icon">
                    <i class="fas fa-user"></i>
                </span>
            </a>

            <div class="mobilebar-tab-overlay"></div>
        </nav>
    </div>

</div>
    <!-- mobile menu end -->


    <div class="tap-top">
        <div>
            <i class="fas fa-angle-up"></i>
        </div>
    </div>
    <!-- tap to top end -->
    <div id="modal-1" aria-labelledby="modal-success-header" role="dialog" class="modal fade" style="display: none;">
    <div role="document" class="modal-dialog modal-dialog-centered modal-success modal-dialog-scrollable modal-lg" id="modal-1-class">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white p-2">
                <div class="fs-6 fw-bold modal-title" id="modal-1-header"></div>
                <!--begin::Close-->
                <div class="btn btn-icon ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-2x">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="white"></rect>
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="white"></rect>
                        </svg>
                    </span>
                </div>
                <!--end::Close-->
            </div>
            <div id="modal-1-body" class="modal-body">
                <div class="d-flex justify-content-center">
                    <div class="spinner-grow text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
            <div id="modal-1-footer" class="modal-footer p-2">
                <button type="button" class="btn btn-primary text-capitalize" id="modal-cancel-btn" data-bs-dismiss="modal">Close</button>
                
            </div>
        </div>
    </div>
</div>



    <!-- setting start -->
    
    <!-- setting end -->
    <!-- latest jquery-->
    <script src="{{ asset('assets/frontend/Content/themes/a4atripploytrv/common/js/jquery-3.5.1.min.js') }}"></script>

    <!-- date-time picker js -->
    <script src="{{ asset('assets/frontend/Content/themes/a4atripploytrv/common/js/date-picker.js') }}"></script>

    <!-- tilt effect js-->
    <script src="{{ asset('assets/frontend/Content/themes/a4atripploytrv/common/js/tilt.jquery.js') }}"></script>

    <!-- video js-->
    <script src="{{ asset('assets/frontend/Content/themes/a4atripploytrv/common/js/jquery.vide.min.js') }}"></script>

    <!-- slick js-->
    <script src="{{ asset('assets/frontend/Content/themes/a4atripploytrv/common/js/slick.js') }}"></script>

    <!-- slick js-->
    <script src="{{ asset('assets/frontend/Content/themes/a4atripploytrv/common/js/sticky-search.js') }}"></script>

    <!-- Bootstrap js-->
    <script src="{{ asset('assets/frontend/Content/themes/a4atripploytrv/common/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('assets/frontend/Content/lib/lang-picker/js-lang-picker.js') }}"></script>
    <script src="{{ asset('assets/frontend/Content/themes/a4atripploytrv/common/js/select2.min.js') }}"></script>

    <!-- lazyload js-->
    <script src="{{ asset('assets/frontend/Content/themes/a4atripploytrv/common/js/lazysizes.min.js') }}"></script>

    <!-- lazyload js-->
    <script src="{{ asset('assets/frontend/Content/themes/a4atripploytrv/common/js/lazysizes.min.js') }}"></script>

    <!-- Theme js-->
    <script src="{{ asset('assets/frontend/Content/themes/a4atripploytrv/common/js/script.js') }}"></script>
    <!---->
    <script src="{{ asset('assets/frontend/Content/themes/home/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/Content/themes/home/js/swiper-bundle.min.js') }}"></script>
    <link href="{{ asset('assets/frontend/Content/lib/magnific/magnific-popup.css') }}" rel="stylesheet" />
    <script src="{{ asset('assets/frontend/Content/themes/home/js/main.js') }}"></script>

    <!-- Libs-->
    <script src="{{ asset('assets/frontend/Content/lib/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/Content/lib/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('assets/frontend/Content/lib/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('assets/frontend/Content/lib/ionrangeslider/ion.rangeSlider.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/Content/lib/ladda/spin.js') }}"></script>
    <script src="{{ asset('assets/frontend/Content/lib/ladda/ladda.js') }}"></script>
    <script src="{{ asset('assets/frontend/Content/lib/sweetalert2/sweetalert2.js') }}"></script>
    <script src="{{ asset('assets/frontend/Content/lib/magnific/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/Scripts/app/smart-auth7c6c.js?version=1.3') }}"></script>
    <script src="{{ asset('assets/frontend/Scripts/app/dsb-custom7c6c.js?version=1.3') }}"></script>
    <script src="{{ asset('assets/frontend/Scripts/app/dsb-onepage-curd.js') }}"></script>
    
    <script src="{{ asset('assets.frontend/bundles/jqueryval1da3?v=nsOwUc2j3GMqgidS30eLgZVJeHn83Wqmm2vMD4cUlKA1') }}"></script>


    <script src="{{ asset('assets/frontend/Content/lib/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/Content/lib/touchspin/jquery.bootstrap-touchspin.min.js') }}"></script>

    <script src="{{ asset('assets/frontend/Content/lib/easy-autocomplete/jquery.easy-autocomplete.min.js') }}"></script>
    <script src="{{ url('assets/frontend/js/airportautocomplete.js') }}"></script>

    <script src="{{ asset('assets/frontend/Scripts/app/search-flights7c6c.js?version=1.3') }}"></script>
    <script src="{{ asset('assets/frontend/Scripts/app/search-hotels7c6c.js?version=1.3') }}"></script>
    <script src="{{ asset('assets/frontend/Scripts/app/search-tours7c6c.js?version=1.3') }}"></script>
    <script src="{{ asset('assets/frontend/Scripts/app/search-visas7c6c.js?version=1.3') }}"></script>
    <script src="{{ asset('assets/frontend/Scripts/app/home7c6c.js?version=1.3') }}"></script>
    <script src="{{ asset('assets/frontend/Content/lib/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/scripts/app/dsb-simple-curd.js') }}"></script>

    @yield('scripts')

    <script>
        var swiper = new Swiper(".imgSwiper", {
            slidesPerView: 1,
            loop: true,
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },
        });
        /*******************load modal ***************************************************/


        $("body").on("click", ".popular", function (event) {
            event.preventDefault();
            var title = $(this).find('.pmodal').find('.pmodal-header').text();
            var content = $(this).find(".pmodal").find('.pmodal-text').text();
            //console.log(title + "" + content);

            $("#modal-1-header").html(title);
            $("#modal-1-body").html(content);
            $('#modal-1').modal('toggle');
        });
        function InitAfterSave() {
            $("#Email").val("");
        }

        $(document).ready(function () {
            var num = 50; //number of pixels before modifying styles

            $(window).bind('scroll', function () {
                if ($(window).scrollTop() > num) {
                    $('.light_header').addClass('fixed-header');
                } else {
                    $('.light_header').removeClass('fixed-header');
                }
            });
            $('.popularCity').click(function () {
                var dataOrigin = $(this).parent('div').children('input').attr('data-origin');
                var dataDestination = $(this).parent('div').children('input').attr('data-destination');
                var dataDate = $(this).parent('div').children('input').attr('data-date');
                $('#orginLocCode').val(dataOrigin);
                $('#from-0').val(dataOrigin);
                $('#destLocCode').val(dataDestination);
                $('#to-0').val(dataDestination);
                $('#depDate').val(dataDate);
                $('#dp-0').val(dataDate);
                $("#flt-search-btn").trigger("click");

            });

            var options = {
                url: function (query) {
                    if (query.length >= 3) {
                        return "/Home/GetCities?query=" + query;
                    }
                },
                getValue: "Name", // The property to display in the textbox
                list: {
                    match: {
                        enabled: true
                    }
                }
            };

            // Initialize the autocomplete plugin on the textbox
            $("#autocomplete-textbox").easyAutocomplete(options);

            var countyoptions = {
                url: function (countryquery) {
                    if (countryquery.length >= 3) {
                        return "/Home/GetCountries?countryquery=" + countryquery;
                    }
                },
                getValue: "Name", // The property to display in the textbox
                list: {
                    match: {
                        enabled: true
                    }
                }
            };

            // Initialize the autocomplete plugin on the textbox
            $("#searchcountry").easyAutocomplete(countyoptions);

            var nationalityoptions = {
                url: function (countryquery) {
                    if (countryquery.length >= 3) {
                        return "/Home/GetCountries?countryquery=" + countryquery;
                    }
                },
                getValue: "Name", // The property to display in the textbox
                list: {
                    match: {
                        enabled: true
                    }
                }
            };

            // Initialize the autocomplete plugin on the textbox
            $("#auto-nationality").easyAutocomplete(nationalityoptions);

        });


        $('#manage-booking-btn').click(function () {
            var code = $('#pnr-no').val();
            var lastName = $('#l-name').val();
            $.ajax({
                url: '/Booking/GuestFlightDetails',
                type: 'POST',
                data: {
                    'code': code,
                    'lastName': lastName,
                },
                success: function (data) {
                    console.log(data);
                    if (data) {
                        window.location.href = data.url;
                    } else {
                        swal("Warning", "PNR or Last Name not match", "warning");
                    }

                },
                error: function (e) {
                    console.log(e);
                }
            });
        });




    </script>

    <script>
        $('#datepicker').datepicker({
            uiLibrary: 'bootstrap4',
            format: 'dd mmmm'
        });
        $('#datepicker1').datepicker({
            uiLibrary: 'bootstrap4',
            format: 'dd mmmm'
        });
        $('#datepicker2').datepicker({
            uiLibrary: 'bootstrap4',
            format: 'dd mmmm'
        });
        $('#datepicker3').datepicker({
            uiLibrary: 'bootstrap4',
            format: 'dd mmmm'
        });
        $('#pickup').datetimepicker({
            uiLibrary: 'bootstrap4',
            modal: true,
            footer: true
        });
        $('#dropoff').datetimepicker({
            uiLibrary: 'bootstrap4',
            modal: true,
            footer: true
        });
        $('#departure').datepicker({
            uiLibrary: 'bootstrap4'
        });
        $('#return').datepicker({
            uiLibrary: 'bootstrap4'
        });
        $('#during').datepicker({
            uiLibrary: 'bootstrap4'
        });
    </script>
    <script>
        $(document).ready(function () {
            LoadAutoScrollMessage();
            LoadRecentSearch();
            $(".select2").select2({
                theme: "bootstrap-5",
            });
            $("select").on("select2:close", function (e) {
                $(this).valid();
            });
        });

        function LoadAutoScrollMessage() {
            $.ajax({
                type: 'POST',
                url: '/Home/GetAutoScrollmessage',
                success: function (data) {
                    $(".marqueeText").text(data);
                },
                error: function (e) {
                }
            }).done(function () { });
        };
    </script>


    
    <script>
        $(".mobilebar-tab-item").click(function () {
            $(".mobilebar-tab-item").removeClass("active");
            $(this).addClass("active");
            $(".mobilebar-tab-overlay").css({
                left: $(this).prevAll().length * document.getElementById('applicationBarMobileButton1').clientWidth + 'px'
            });

            /*alert($(this).prevAll().length + " et " + document.getElementById('applicationBarMobileButton1').clientWidth);*/
        });

        function checkHomeUrl() {
            const currentPath = window.location.pathname.split('index.html')[1];
            if (currentPath != "") {
                window.location.href = 'index.html';
            }
        };
        $(".booking-menu").click(function () {
            checkHomeUrl()
            var bookingTabTriggerEl = document.querySelector('#manageBooking-tab')
            var bookingTab = new bootstrap.Tab(bookingTabTriggerEl)

            bookingTab.show()
        })
        $("#packages-menu").click(function () {
            checkHomeUrl()
            var hotelTabTriggerEl = document.querySelector('#profile-tab')
            var hotelTab = new bootstrap.Tab(hotelTabTriggerEl)

            hotelTab.show()
        })
        $("#visa-menu").click(function () {
            checkHomeUrl()
            var hotelTabTriggerEl = document.querySelector('#contact-tab')
            var hotelTab = new bootstrap.Tab(hotelTabTriggerEl)

            hotelTab.show()
        })
    </script>
    <script>
        document.addEventListener('submit', function(event) {
        const form = event.target.closest('form');
        const button = form.querySelector('.has-spinner');
    
        if (!button) {
          return; // If the submitted element is not a form, exit the function
        }
    
        if (!form.checkValidity()) {
        event.preventDefault(); // Prevent the form submission for demonstration purposes
          return;
        }
    
        const spinner = document.createElement('span');
        spinner.classList.add('spinner');
        button.appendChild(spinner);
    
        button.classList.add('loading');
        button.disabled = true; // Disable the button while loading
    
      });
    </script>
</body>

</html>
