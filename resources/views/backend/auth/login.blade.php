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

                    <div class="authSecTitle text-center title">
                        <h2>Welcome to World of Explore  <span class="auth-name">Adbiyas Tour</span></h2>
                        <h3 class="text-center">Login</h3>
                    </div>
                    <div class="login-with">
                        
                        <div class="login-social row gap-2">
                            
                            <div class="col-md-6 offset-md-3">
                                <a class="boxes rounded text-white" style=" background: #ea4335;" href="https://accounts.google.com/o/oauth2/auth?response_type=code&amp;client_id=584364755700-ce5ak7gv3dgck4rqcbh1eomtjdhqrds4.apps.googleusercontent.com&amp;redirect_uri=https://adbiyastour.com/Account/SignInWithGoogle&amp;scope=https://www.googleapis.com/auth/plus.login%20https://www.googleapis.com/auth/userinfo.email">
                                    <i class="fa-brands fa-google"></i>
                                    <h6>google</h6>
                                </a>
                            </div>
                        </div>
                        <div class="divider">
                            <h6>OR</h6>
                        </div>
                    </div>
                    <div class="authBody">
                        <form id="login-form" method="POST" action="{{ route('login') }}">
                        <div class="message-box mb-2"></div>

                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">user name or Email address</label>
                                <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email" required name="email">
                                <div class="invalid-feedback">Please enter your User Name</div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" class="form-control" id="password" placeholder="Password" required name="password">
                                <div class="invalid-feedback">Please enter your password.</div>
                            </div>
                            <div class="form-group form-check d-flex justify-content-between">
                                <div>
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">remember me</label>
                                </div>
                                <a class="text-decoration-underline" href="{{ route('password.request') }}">Forgot Password?</a>
                            </div>
                            <div class="button-bottom">
                                <button type="submit" class="button has-spinner"><span class="button-text">Login</span></button>
                                <div class="divider">
                                    <h6>or</h6>
                                </div>
                                <div class="extra-auth">
                                   
                                    <p>If you donot have any account! <a href="{{ route('register') }}" type="submit" class="">Create Account</a></p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@section('scripts')

<script type="text/javascript" src="{{ asset('assets/frontend/js/authentications.js') }}"></script>

@endsection

@endsection
