@extends('backend.layouts.main')
@section('title', 'Support-Tickets-Create')

@section('main-container')
  
  
<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">

                    <!-- Page-body start -->
                    <div class="page-body">
                        <div class="card">
                          @if(session()->has('success'))
                          <div class="alert alert-success">
                              {{ session('success') }}
                          </div>
                          @endif
                          @if(session()->has('error'))
                          <div class="alert alert-danger">
                              {{ session('error') }}
                          </div>
                          @endif
                            <!-- Email-card start -->
                            <div class="card-block email-card">
                                <div class="row">
                                    <div class="col-lg-12 col-xl-3">
                                        <div class="user-head row">
                                            <div class="user-face">
                                               <span class="text-white">Change Password</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-xl-9">
                                        <div class="mail-box-head row">
                                            <div class="col-md-12">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <!-- Left-side section start -->
                                    <div class="col-lg-12 col-xl-3">
                                        <div class="user-body">
            

                                        </div>
                                    </div>
                                    <!-- Left-side section end -->
                                    <!-- Right-side section start -->
                                    <div class="col-lg-12 col-xl-9">
                                        <div class="tab-content" id="pills-tabContent">
                                            <div class="tab-pane fade show active" id="e-inbox" role="tabpanel">

                                                <div class="mail-body">
                                                    <div class="mail-body-header">

                                                    </div>
                                                    <div class="mail-body-content">
                                                                                                                                                                    <div class="col-lg-12 col-xl-9">
                                                        <div class="mail-body">
                                                            <div class="mail-body">

                                                                <div class="mail-body-content">
                                                                    <form action="{{route('password.update')}}" method="POST">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <div class="form-group">
                                                                            <input type="password" class="form-control" placeholder="current password" name="current_password">
                                                                        </div>
                                                                        <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                                                                          <div class="form-group">
                                                                            <input type="password" class="form-control" placeholder="new password" name="password">
                                                                        </div>
                                                                        <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />

                                                                          <div class="form-group">
                                                                            <input type="password" class="form-control" placeholder="confirm password" name="password_confirmation">
                                                                        </div>
                                                                        <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                                                                        <div class="text-center m-t-20">
                                                                            <button type="submit" class="btn btn-primary waves-effect waves-light m-r-10">Change
                                                                            </button>
                        
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <!-- Right-side section end -->
                                </div>
                            </div>
                            <!-- Email-card end -->
                        </div>
                    </div>
                    <!-- Page-body start -->
                </div>
            </div>
            <!-- Main-body end -->
            <div id="styleSelector">

            </div>
        </div>
    </div>


  @endsection
