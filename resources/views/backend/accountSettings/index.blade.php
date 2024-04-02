@extends('backend.layouts.main')
@section('title', 'Account-Settings')

@section('main-container')
  
  
<div class="pcoded-content">
  <div class="pcoded-inner-content">
      <!-- Main-body start -->
      <div class="main-body">
          <div class="page-wrapper">
              <!-- Page-header start -->
              <div class="page-header">
                  <div class="row align-items-end">
                      <div class="col-lg-8">
                          <div class="page-header-title">
                              <div class="d-inline">
                                  <h4>Account Settings</h4>
                                  <span>You can find your account settings from here</span>
                              </div>
                          </div>
                          
                      </div>
                      <div class="col-lg-4">
                          <div class="page-header-breadcrumb">
                              <ul class="breadcrumb-title">
                                  <li class="breadcrumb-item">
                                      <a href="{{route('dashboard')}}"> <i class="feather icon-home"></i> </a>
                                  </li>
                                  <li class="breadcrumb-item"><a href="#!">Account Settings</a>
                                  </li>
                                  <li class="breadcrumb-item"><a href="">All</a>
                                  </li>
                              </ul>
                          </div>
                      </div>
                      
                  </div>
                 
              </div>
              <!-- Page-header end -->
                  
                  <div class="page-body">
                   
                   
                  <div class="row">
               
                    <div class="col-xl-6 col-md-6">
                        <div class="card social-card ">
                            <div class="card-block">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <i class="fa fa-user-plus f-34 text-c-blue social-icon"></i>
                                    </div>
                                    <div class="col">
                                        <h6 class="m-b-0 text-dark"><b>Personal Details</b></h6>
                                        <p class="m-b-0 text-dark">Update your personal info.</p>

                                       <a href="{{ route('accountSettings',['index'=>1,'name'=>'personal']) }}" ><span class="m-b-0 text-dark" style="border-bottom: 1px solid #000000">Manage Personal Details</span></a> 
                                    </div>
                                </div>
                            </div>
                            <a href="{{ route('accountSettings',['index'=>1,'name'=>'personal']) }}" class="download-icon bg-primary"><i class="fa fa-location-arrow"></i></a>
                        </div>
                    </div>

                    <div class="col-xl-6 col-md-6">
                        <div class="card social-card">
                            <div class="card-block">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <i class="fa fa-tasks f-34 text-c-blue social-icon"></i>
                                    </div>
                                    <div class="col">
                                        <h6 class="m-b-0 text-dark"><b>Preferences</b></h6>
                                        <p class="m-b-0 text-dark">Change your preferences.</p>

                                       <a href="{{ route('accountSettings',['index'=>2,'name'=>'preferences']) }}" ><span class="m-b-0 text-dark" style="border-bottom: 1px solid #000000">Manage Preferences</span></a> 
                                    </div>
                                </div>
                            </div>
                            <a href="{{ route('accountSettings',['index'=>2,'name'=>'preferences']) }}" class="download-icon bg-primary"><i class="fa fa-location-arrow"></i></a>
                        </div>
                    </div>

                    <div class="col-xl-6 col-md-6">
                        <div class="card social-card">
                            <div class="card-block">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <i class="fa fa-lock f-34 text-c-blue social-icon"></i>
                                    </div>
                                    <div class="col">
                                        <h6 class="m-b-0 text-dark"><b>Security</b></h6>
                                        <p class="m-b-0 text-dark">Change your security settings, set up  authentication.</p>

                                       <a href="{{ route('accountSettings',['index'=>3,'name'=>'security']) }}" ><span class="m-b-0 text-dark" style="border-bottom: 1px solid #000000">Manage account security</span></a> 
                                    </div>
                                </div>
                            </div>
                            <a href="{{ route('accountSettings',['index'=>3,'name'=>'security']) }}" class="download-icon bg-primary"><i class="fa fa-location-arrow"></i></a>
                        </div>
                    </div>

                    <div class="col-xl-6 col-md-6">
                        <div class="card social-card">
                            <div class="card-block">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <i class="fa fa-credit-card f-34 text-c-blue social-icon"></i>
                                    </div>
                                    <div class="col">
                                        <h6 class="m-b-0 text-dark"><b>Payment Details</b></h6>
                                        <p class="m-b-0 text-dark">Add or remove payment methods for easy booking.</p>

                                       <a href="{{ route('accountSettings',['index'=>4,'name'=>'payment']) }}" ><span class="m-b-0 text-dark" style="border-bottom: 1px solid #000000">Manage Payment Details</span></a> 
                                    </div>
                                </div>
                            </div>
                            <a href="{{ route('accountSettings',['index'=>4,'name'=>'payment']) }}" class="download-icon bg-primary"><i class="fa fa-location-arrow"></i></a>
                        </div>
                    </div>

                    <div class="col-xl-6 col-md-6">
                        <div class="card social-card">
                            <div class="card-block">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <i class="fa fa-thumbs-up f-34 text-c-blue social-icon"></i>
                                    </div>
                                    <div class="col">
                                        <h6 class="m-b-0 text-dark"><b>Privacy</b></h6>
                                        <p class="m-b-0 text-dark">Exercise your privacy rights and control your data.</p>

                                       <a href="{{ route('accountSettings',['index'=>5,'name'=>'privacy']) }}" ><span class="m-b-0 text-dark" style="border-bottom: 1px solid #000000">Manage Privacy</span></a> 
                                    </div>
                                </div>
                            </div>
                            <a href="{{ route('accountSettings',['index'=>5,'name'=>'privacy']) }}" class="download-icon bg-primary"><i class="fa fa-location-arrow"></i></a>
                        </div>
                    </div>

                    <div class="col-xl-6 col-md-6">
                        <div class="card social-card">
                            <div class="card-block">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <i class="fa fa-bell f-34 text-c-blue social-icon"></i>
                                    </div>
                                    <div class="col">
                                        <h6 class="m-b-0 text-dark"><b>Email Notifications</b></h6>
                                        <p class="m-b-0 text-dark">Decide what you want to be notified or not.</p>

                                       <a href="{{ route('accountSettings',['index'=>6,'name'=>'notifications']) }}" ><span class="m-b-0 text-dark" style="border-bottom: 1px solid #000000">Manage Notifications</span></a> 
                                    </div>
                                </div>
                            </div>
                            <a href="{{ route('accountSettings',['index'=>6,'name'=>'notifications']) }}" class="download-icon bg-primary"><i class="fa fa-location-arrow"></i></a>
                        </div>
                    </div>
               
                </div>
                  </div>
              </div>
          </div>
          <!-- Warning Section Starts -->
          <div id="styleSelector">

          </div>
      </div>
  </div> 

           
  @endsection
