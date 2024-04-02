@include('frontend.layouts.header-search')


<!-- ========== MAIN CONTENT ========== -->
<main id="content">
   
    <div class="border-bottom border-color-8 pb-6 pb-lg-9 mb-6 mb-lg-8">
        <div class="container mb-10">
            <div class="w-md-80 w-lg-50 text-center mx-md-auto my-3">
                <h2 class="section-title text-black font-size-30 font-weight-bold mb-5 pb-xl-1">Sends us a Message</h2>
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }} </div>
                @endif
            </div>
            <div class="comment-section max-width-810 mx-auto"> 
                <form class="js-validate" novalidate="novalidate" action="{{ route('/contactSave') }}" method="post">
                    @csrf
                    <div class="row">
                        <!-- Input -->
                        <div class="col-sm-6 mb-5">
                            <div class="js-form-message">
                                <input type="text" class="form-control" name="name" placeholder="Name" aria-label="Jack Wayley" required="" data-error-class="u-has-error" data-msg="Please enter your name." data-success-class="u-has-success">
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />

                            </div>
                        </div>
                        <!-- End Input -->

                        <!-- Input -->
                        <div class="col-sm-6 mb-5">
                            <div class="js-form-message">
                                <input type="email" class="form-control" name="email" placeholder="Email" aria-label="jackwayley@gmail.com" required="" data-msg="Please enter a valid email address." data-error-class="u-has-error" data-success-class="u-has-success">
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />

                            </div>
                        </div>
                        <!-- End Input -->
                        <div class="col-sm-12 mb-5">
                            <div class="js-form-message">
                                <div class="input-group">
                                    <textarea class="form-control" rows="6" cols="77" name="message" placeholder="Message" aria-label="Hi there, I would like to ..." required="" data-msg="Please enter a reason." data-error-class="u-has-error" data-success-class="u-has-success"></textarea>
                                </div>
                                <x-input-error :messages="$errors->get('message')" class="mt-2" />

                            </div>
                        </div>
                        <!-- End Input -->
                        <div class="col d-flex justify-content-lg-start">
                            <button type="submit" class="btn rounded-xs bg-blue-dark-1 text-white height-51 width-190 transition-3d-hover">Send Message</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
       
    </div>
</main>
<!-- ========== END MAIN CONTENT ========== -->
@include('frontend.layouts.footer-search')
