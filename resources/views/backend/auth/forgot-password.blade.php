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
                        <h3 class="text-center">Recover Password</h3>
                    </div>
                    <div class="authBody">
                        <form id="forgot-password-form" method="POST" action="#">
                            @csrf
                            <div class="message-box" ></div>
                            <div id="forgot-error-box" class="alert alert-danger" style="display:none;"></div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" class="form-control" id="Email" name="email" value="" aria-describedby="emailHelp" placeholder="Enter email" required>
                                <div class="invalid-feedback">Please enter your User Name</div>
                            </div>

                            <div class="button-bottom">
                                <button type="submit" class="button has-spinner"><span class="button-text">RECOVER PASSWORD</span></button>
                                <div class="divider">
                                    <h6>or</h6>
                                </div>
                                <div class="extra-auth">
                                    <p>If you do not have account <a href="{{ route('register') }}" type="submit" class="">Create Account</a></p>
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

</script>

@endsection

@endsection


