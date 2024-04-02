@extends('frontend.layouts.main')
@section('main-container')

@section('styles')
    <link href="{{ asset('assets/frontend/Content/themes/custom/account.css') }}" rel="stylesheet" />
@endsection
<section class="p-0 account-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <div class="account-sign-in">
                    <div class="authSecTitle title text-center">
                        <h2>Welcome To World Of Explore <span class="auth-name">Adbiyas Tour</span></h2>
                        <h3 class="text-center">SIGNUP</h3>
                    </div>
                    <div class="login-with">

                        <div class="login-social row gap-2">

                            <!--<div class="col-md-6 offset-md-3">-->
                            <!--    <a class="boxes rounded text-white" style=" background: #ea4335;"-->
                            <!--        href="https://accounts.google.com/o/oauth2/auth?response_type=code&amp;client_id=584364755700-ce5ak7gv3dgck4rqcbh1eomtjdhqrds4.apps.googleusercontent.com&amp;redirect_uri=https://adbiyastour.com/Account/SignInWithGoogle&amp;scope=https://www.googleapis.com/auth/plus.login%20https://www.googleapis.com/auth/userinfo.email">-->
                            <!--        <i class="fa-brands fa-google"></i>-->
                            <!--        <h6>google</h6>-->
                            <!--    </a>-->
                            <!--</div>-->
                        </div>
                        <div class="divider">
                            <h6>OR</h6>
                        </div>
                    </div>
                    <div class="authBody">
                        <form id="signup-form" action="{{ route('register') }}" method="POST">
                            @csrf
                            <div class="message-box mb-2"></div>
                            <div class="form-group">
                                <label for="name">Full name</label>
                                <input type="text" class="form-control" id="name" placeholder="Enter your name"
                                    required name="name">
                                <div class="invalid-feedback">Please enter your User Name</div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" class="form-control" id="customerEmail"
                                    placeholder="Enter email address" required name="email">
                                <div class="invalid-feedback">Please enter a valid email address.</div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" class="form-control" id="psd" placeholder="Password"
                                    required name="password">
                                <div class="invalid-feedback">Please enter a password.</div>
                            </div>
                            <div class="form-group">
                                <div class="g-recaptcha" data-sitekey="6LfWg80nAAAAABdFOey9yFvGenoc1WMhlPTOzSXj"></div>
                            </div>


                            <div class="button-bottom">
                                <button type="submit" class="button has-spinner"><span class="button-text">CREATE ACCOUNT</span></button>

                                <div class="divider">
                                    <h6>or</h6>
                                </div>
                                <div class="extra-auth">
                                    <p>If you already have an account! <a href="{{ route('login') }}" type="submit"
                                            class="">LOGIN</a></p>
                                </div>
                            </div>
                        </form>
                    </div>
                    {{-- <div class="content-area-in" id="regi-verification-box" style="display:none;">
                        <h5 class="my-3 text-center travel-details-header">Verify Your Account</h5>
                        <p class="mb-3">Verify the code, sent to your email address during registration process. If
                            expired, please send a re-send request.</p>
                        <p class="mb-4">
                            Don't have an account?
                            <a class="sm-form-link-2" href="signup.html">Sign Up</a>
                        </p>
                        <div class="">
                            <div class="text-center">
                                <div id="rv-code-success-box" class="alert alert-success" style="display:none;"></div>
                            </div>
                            <div class="authBody">
                                <form id="regi-verify-form" method="post"
                                    action="https://tripploy.travel/account/verifycode"
                                    class="form-horizontal regi-verify-form" role="form">

                                    <input id="rv-code-url" type="hidden" name="Url" value="" />
                                    <input id="rv-code-action" type="hidden" name="ActionType" value="3" />

                                    <div class="form-group">
                                        <label for="">Email address</label>
                                        <input data-type="form" autocomplete="off" id="Username" name="Username"
                                            class="form-control sa-username " data-val="true"
                                            data-val-length="Email must be a string with a maximum length of 50"
                                            data-val-length-max="50" data-val-required="Email field is required."
                                            placeholder="Your Email" type="text" value="">
                                        <span class="field-validation-valid" data-valmsg-for="Username"
                                            data-valmsg-replace="true"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Verification Code</label>
                                        <input type="text" class="form-control" id="VerificationCode"
                                            name="VerificationCode" placeholder="Enter verification code"
                                            data-val="true"
                                            data-val-length="The Code must be at least 6 characters long."
                                            data-val-length-max="20" data-val-length-min="6"
                                            data-val-required="The Code field is required." />
                                        <span class="field-validation-valid" data-valmsg-for="VerificationCode"
                                            data-valmsg-replace="true"></span>
                                    </div>
                                    <div class="form-group">
                                        <div id="rv-sa-code-timer"
                                            style="font-size: 12px;padding-top: 2px;display:none;">Enable re-send
                                            button in <span></span></div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <button type="button" id="rv-sa-send-code"
                                                class="w-100 btn btn-solid btn-outline ladda-button mb-3"
                                                data-style="slide-left">Re-SEND</button>
                                        </div>
                                        <div class="col-md-6">
                                            <button id="regi-verify-btn" class="w-100 btn btn-solid ladda-button mb-3"
                                                type="button" data-style="slide-left">VERIFY CODE</button>
                                        </div>
                                    </div>

                                    <div style="margin-top:30px;">
                                        <div class="row">
                                            <div class="col-12 col-sm-8 text-center-xs">
                                                <div id="rv-code-error-box" class="alert alert-warning"
                                                    style="display:none;"></div>
                                            </div>
                                            <div class="col-12 col-sm-4">

                                                <div class="clearfix"></div>
                                                <div class="validation-summary-valid" data-valmsg-summary="true">
                                                    <ul>
                                                        <li style="display:none"></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</section>

@section('scripts')
    <script type="text/javascript" src="{{ asset('assets/frontend/js/authentications.js') }}"></script>
@endsection

@endsection
