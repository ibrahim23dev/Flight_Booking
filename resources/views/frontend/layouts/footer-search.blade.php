 <!-- ========== FOOTER ========== -->
 <footer class="footer footer-border-top" style="background-color: #1a0b24;">
    <div class=" space-top-1">
        <div class="container">
            <div class="row justify-content-center">
                
                
            </div>

            <div class="row pb-3 pt-4">
                <div class="col-12 col-lg-3 col-md-6 order-md-0">
                    <!-- Contacts -->
                    <div class="d-md-flex d-lg-block">
                        <div class="mb-5 mr-md-7 mr-lg-0">
                            <h4 class="h6 mb-4 font-weight-bold"><img width="100%" src="{{ url('storage/images/site_identity/'.getSiteIdentity()->logo_image) }}" alt=""></h4>
                            <p style="color:#d5d5d5">Travel lines is the Registered Travel Agency  providing the best travel solution around the globe.</p>

                        </div>

                    </div>
                    <!-- End Contacts -->
                </div>
                <div class="col-12 col-lg-2 col-md-4 order-md-2 mb-4">
                    <h4 class="h4 font-weight-bold mb-2 mb-xl-4" style="color:#fff">Support</h4>
                    <!-- List Group -->
                    <ul class="list-group  mb-0">
                        <li>
                            <a class=" list-group-item-action text-decoration-on-hover" href="{{ route('/faq') }}">FAQ's</a>
                        </li>
                        <li>
                            <a class=" list-group-item-action text-decoration-on-hover" href="{{ route('/terms') }}">Terms Conditions</a>
                        </li>
                        <li>
                            <a class=" list-group-item-action text-decoration-on-hover" href="{{ route('/terms') }}">Privacy Policy</a>
                        </li>
                        <li>
                            <a class=" list-group-item-action text-decoration-on-hover" href="{{ route('/about') }}">About Us</a>
                        </li>
                        <li>
                            <a class=" list-group-item-action text-decoration-on-hover" href="{{ route('/contact') }}">Contact Us</a>
                        </li>
                    </ul>
                    <!-- End List Group -->
                </div>
                <div class="col-12 col-lg-3 col-md-6 order-md-1">
                    <div class="ml-lg-0">
                        <div class="mb-4">
                            <h4 class="h4 font-weight-bold mb-2 mb-xl-4" style="color:#fff;margin-bottom: 1.50rem;">Contact Info</h4>
                            <div>
                                <a href="tel:{{ getContactDetails()->phone }}">
                                    <p class=" h6 font-weight-normal text-gray-1" style="color:#d5d5d5 !important">
                                        <i class="fa fa-light fa-phone mr-2 text-primary" style="transform: rotate(90deg)"></i>
                                        {{ getContactDetails()->phone }}
                                    </p>
                                </a>
                                <a href="mailto:{{ getContactDetails()->email }}">
                                    <p class=" h6 font-weight-normal text-gray-1" style="color:#d5d5d5 !important">
                                        <i class="fa fa-light fa-envelope mr-2 text-primary"></i>
                                        {{ getContactDetails()->email }}
                                    </p>
                                </a>
                               
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-8 order-md-3">
                    <div class="mb-4 mb-xl-2">
                        <h4 class="h4 font-weight-bold mb-2 mb-xl-4 text-light">Mailing List</h4>
                        <p class="m-0 text-gray-1" style="color:#d5d5d5 !important">Sign up for our mailing list to get latest updates and offers.</p>
                    </div>
                    <form class="js-validate js-focus-state js-form-message" novalidate="novalidate">
                        <label class="sr-only text-gray-1" for="subscribeSrEmailExample1">  </label>
                        <div class="input-group">
                            <input type="email" class="form-control height-54 font-size-14 border-radius-3 border-width-2 border-color-8" name="email" id="subscribeSrEmailExample1" placeholder="Your Email" aria-label="Your email address" aria-describedby="subscribeButtonExample3" required="" data-msg="Please enter a valid email address." data-error-class="u-has-error" data-success-class="u-has-success">
                            <div class="input-group-append ml-3">
                                <button class="btn btn-primary border-radius-3 height-54 min-width-112 font-size-14" type="submit" id="subscribeButtonExample3">Subscribes</button>
                            </div>
                        </div>
                    </form>
                </div>





            </div>

        </div>
    </div>
  <div style="align-items: center">
        <div class="container">
            <div class="d-lg-flex d-md-block justify-content-between align-items-center" style=" display: flex  !important;justify-content: center !important;">
                <!-- Copyright -->
                <p class="text-muted text-gray-1">
                    ©{{ date('Y') }} All Rights Reserved by {{ env('APP_NAME') }}</p>
                <!-- End Copyright -->
                <!-- Social Networks -->
                <!-- End Social Networks -->
            </div>
        </div>
    </div>
    


</footer>
<!-- ========== End FOOTER ========== -->

<!-- Page Preloader -->
<!-- <div id="jsPreloader" class="page-preloader">
    <div class="page-preloader__content-centered">
        <div class="spinner-grow text-primary" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
</div> -->
<!-- End Page Preloader -->

<!-- Go to Top -->
<a class="js-go-to u-go-to-modern" href="#" data-position='{"bottom": 15, "right": 15 }' data-type="fixed" data-offset-top="400" data-compensation="#header" data-show-effect="slideInUp" data-hide-effect="slideOutDown">
    <span class="flaticon-arrow u-go-to-modern__inner"></span>
</a>
<!-- End Go to Top -->

<!-- JS Global Compulsory -->
<script src="{{ url('assets/frontend/vendor/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ url('assets/frontend/vendor/jquery-migrate/dist/jquery-migrate.min.js') }}"></script>
<script src="{{ url('assets/frontend/vendor/popper.js/dist/umd/popper.min.js') }}"></script>
<script src="{{ url('assets/frontend/vendor/bootstrap/bootstrap.min.js') }}"></script>

<!-- JS Implementing Plugins -->
<script src="{{ url('assets/frontend/vendor/hs-megamenu/src/hs.megamenu.js') }}"></script>
<script src="{{ url('assets/frontend/vendor/jquery-validation/dist/jquery.validate.min.js') }}"></script>
<script src="{{ url('assets/frontend/vendor/flatpickr/dist/flatpickr.min.js') }}"></script>
<script src="{{ url('assets/frontend/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
<script src="{{ url('assets/frontend/vendor/slick-carousel/slick/slick.js') }}"></script>
<script src="{{ url('assets/frontend/vendor/gmaps/gmaps.min.js') }}"></script>
<script src="{{ url('assets/frontend/vendor/ion-rangeslider/js/ion.rangeSlider.min.js') }}"></script>
<script src="{{ url('assets/frontend/vendor/custombox/dist/custombox.min.js') }}"></script>
<script src="{{ url('assets/frontend/vendor/custombox/dist/custombox.legacy.min.js') }}"></script>
<script src="{{ url('assets/frontend/vendor/fancybox/jquery.fancybox.min.js') }}"></script>
<script src="{{ url('assets/frontend/vendor/appear.js') }}"></script>

<!-- JS MyTravel -->
<script src="{{ url('assets/frontend/js/hs.core.js') }}"></script>
<script src="{{ url('assets/frontend/js/components/hs.header.js') }}"></script>
<script src="{{ url('assets/frontend/js/components/hs.unfold.js') }}"></script>
<script src="{{ url('assets/frontend/js/components/hs.validation.js') }}"></script>
<script src="{{ url('assets/frontend/js/components/hs.show-animation.js') }}"></script>
<script src="{{ url('assets/frontend/js/components/hs.range-datepicker.js') }}"></script>
<script src="{{ url('assets/frontend/js/components/hs.selectpicker.js') }}"></script>
<script src="{{ url('assets/frontend/js/components/hs.range-slider.js') }}"></script>
<script src="{{ url('assets/frontend/js/components/hs.go-to.js') }}"></script>
<script src="{{ url('assets/frontend/js/components/hs.slick-carousel.js') }}"></script>
<script src="{{ url('assets/frontend/js/components/hs.quantity-counter.js') }}"></script>
<script src="{{ url('assets/frontend/js/components/hs.g-map.js') }}"></script>

<script src="{{ url('assets/frontend/js/components/hs.fancybox.js') }}"></script>
<script src="{{ url('assets/frontend/js/components/hs.scroll-nav.js') }}"></script>
<script src="{{ url('assets/frontend/js/components/hs.sticky-block.js') }}"></script>
<script src="{{ url('assets/frontend/js/components/hs.focus-state.js') }}"></script>


<script src="{{ url('assets/frontend/js/components/hs.modal-window.js') }}"></script>
<script src="{{ url('assets/frontend/js/airportautocomplete.js') }}"></script>

<script src="{{ url('assets/frontend/js/authentications.js') }}"></script>
<script src="{{ url('assets/frontend/js/filters.js') }}"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/css/intlTelInput.css">
         <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/intlTelInput.min.js"></script>
<!-- JS Plugins Init. -->
<script>
    $(window).on('load', function () {
        // initialization of HSMegaMenu component
        $('.js-mega-menu').HSMegaMenu({
            event: 'hover',
            pageContainer: $('.container'),
            breakpoint: 1199.98,
            hideTimeOut: 0
        });

        // Page preloader
        setTimeout(function() {
          $('#jsPreloader').fadeOut(500)
        }, 800);
    });

    $(document).on('ready', function () {
        // initialization of header
        $.HSCore.components.HSHeader.init($('#header'));

        // initialization of google map
        function initMap() {
            $.HSCore.components.HSGMap.init('.js-g-map');
        }

        // initialization of autonomous popups
        $.HSCore.components.HSModalWindow.init('[data-modal-target]', '.js-modal-window', {
            autonomous: true
        });

        // initialization of unfold component
        $.HSCore.components.HSUnfold.init($('[data-unfold-target]'));

        // initialization of form validation
        $.HSCore.components.HSValidation.init('.js-validate', {
                    rules: {
                        confirmPassword: {
                            equalTo: '#signupPassword'
                        }
                    }
       });

        // initialization of show animations
        $.HSCore.components.HSShowAnimation.init('.js-animation-link');

        // initialization of popups
        $.HSCore.components.HSFancyBox.init('.js-fancybox');

        // initialization of datepicker
        $.HSCore.components.HSRangeDatepicker.init('.js-range-datepicker');

        // initialization of forms
        $.HSCore.components.HSRangeSlider.init('.js-range-slider');

        // initialization of select
        $.HSCore.components.HSSelectPicker.init('.js-select');

        // initialization of quantity counter
        $.HSCore.components.HSQantityCounter.init('.js-quantity');

        // initialization of slick carousel
        $.HSCore.components.HSSlickCarousel.init('.js-slick-carousel');

        // initialization of form validation
        $.HSCore.components.HSValidation.init('.js-validate');
        // initialization of go to
        $.HSCore.components.HSGoTo.init('.js-go-to');

        // initialization of HSScrollNav component
        $.HSCore.components.HSScrollNav.init($('.js-scroll-nav'), {
                    duration: 700
        });
    });
        // single round trip code
        function updateDatePicker(type) {
            var returnDateElement = document.getElementById('return-date');
            var changeColElements = document.querySelectorAll('.nav-select .change-col');
            var travelersCol=document.querySelector('.travelers-col');
            if (type === 'range') {
                returnDateElement.classList.remove('disable-element');
                travelersCol.classList.remove('col-lg-2dot3');
                travelersCol.classList.add('col-lg-2');
                document.getElementById('return_date_input').setAttribute('data-auto-open','true');

                // Restore the original classes for elements with class 'change-col'
                changeColElements.forEach(function(element) {
                    element.classList.remove('col-lg-3');
                    element.classList.add('col-lg-2dot3');
                });
            } else {
                returnDateElement.classList.add('disable-element');
                travelersCol.classList.add('col-lg-2dot3');
                travelersCol.classList.remove('col-lg-2');
                document.getElementById('return_date_input').setAttribute('data-auto-open','false');
                document.getElementById('return_date_input').value='';

                // Change the classes for elements with class 'change-col'
                changeColElements.forEach(function(element) {
                    element.classList.remove('col-lg-2dot3');
                    element.classList.add('col-lg-3');
                });
            }
        }

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

       $('.travelers1 ').click(function () {
            var type=$(this).text();
            setTimeout(
                function() {
                   adults =  $(".adults1").val();
                    children =  $(".children1").val();
                    infants =  $(".infants1").val();
                    /*set values in search bar*/
                    $('#adult-count1').text(adults+' adult,');
                    if(children>0){
                    $('#child-count1').text(children+' child,');
                    }else{
                        $('#child-count1').text('');
                    }
                    if(infants>0){
                        $('#infants-count1').text(infants+' infant');
                    }else{
                        $('#infants-count1').text('');
                    }

                },
            500);
            if(type=='Done'){
                $('#close-selection').click();
            }
        });

        $('.travelers').click(function () {
            var type=$(this).text();

            setTimeout(
                function() {
            adults =  $(".adults").val();
           children =  $(".children").val();
           infants =  $(".infants").val();
            /*set values in search bar*/
            $('#adult-count').text(adults+' adult,');
            if(children>0){
                $('#child-count').text(children+' child,');
            }else{
                $('#child-count').text('');
            }
            if(infants>0){
                $('#infants-count').text(infants+' infant');
            }else{
                $('#infants-count').text('');
            }
         },
            500);
            if(type=='Done'){
                $('#close-selection').click();
            }
        });
        
        $('.travelers-done').click(function () {
           
           var type=$('.travelers-done').text();

               $('body').click();
       });

</script>

    <script>
        const input = document.querySelector("#phone-input");
        const iti = window.intlTelInput(input, {
        utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/utils.js",
        initialCountry: 'gb',
        preferredCountries: ['us','gb','br','ru','cn','es','it'],
        autoPlaceholder: 'aggressive',
        });

    </script>
    <script>
         function moveToNextInput(currentInput) {
            // Check if the current input value is not empty
            if (currentInput.value.trim() !== '') {
                // Find all inputs in the same form
                var formInputs = currentInput.form.elements;

                // Find the index of the current input in the NodeList
                var currentIndex = Array.prototype.indexOf.call(formInputs, currentInput);

                // Move to the next input with an empty value
                for (var i = currentIndex + 1; i < formInputs.length; i++) {
                    var nextInput = formInputs[i];
                  
                    // Check if the current input name is 'departure_full' or 'arrival_full'
                    if (currentInput.name === 'departure_full' || currentInput.name === 'arrival_full') {
                        // Check if the corresponding 'departure_code' or 'arrival_code' input is not empty
                        var codeInputName = (currentInput.name === 'departure_full') ? 'departure_code' : 'arrival_code';
                        var codeInput = document.getElementsByName(codeInputName)[0];
                        
                        if (codeInput && codeInput.value.trim() !== '') {
                            nextInput.focus();
                            break;
                        }
                        
                    } else if (nextInput.value.trim() === '') {
                        nextInput.focus();
                        break;
                    }
                }
            }
        }

    </script>
</body>
</html>
