@extends('backend.layouts.main')
@section('title', 'Account-Settings')

@section('main-container')

@if(in_array(request('index'), array_keys($indexArray)))
@php
     $value = $indexArray[request('index')];
@endphp
   
@else
@php
    return redirect()->route('accountSettings');
@endphp
@endif
  
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
                                  <h4>{{ $value }} </h4>
                                  <span>Setting of {{ $value }} </span>
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
                                  <li class="breadcrumb-item"><a href="">{{ $value }}</a>
                                  </li>
                              </ul>
                          </div>
                      </div>
                      
                  </div>
                 
              </div>
              <!-- Page-header end -->
                  
                  <div class="page-body">
                   
                   
                  {{-- <div class="row">
               
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
                            <a href="{{ route('accountSettings',['index'=>1,'name'=>'personal']) }}" class="download-icon"><i class="fa fa-location-arrow"></i></a>
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
                            <a href="{{ route('accountSettings',['index'=>2,'name'=>'preferences']) }}" class="download-icon"><i class="fa fa-location-arrow"></i></a>
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
                            <a href="{{ route('accountSettings',['index'=>3,'name'=>'security']) }}" class="download-icon"><i class="fa fa-location-arrow"></i></a>
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
                            <a href="{{ route('accountSettings',['index'=>4,'name'=>'payment']) }}" class="download-icon"><i class="fa fa-location-arrow"></i></a>
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
                            <a href="{{ route('accountSettings',['index'=>5,'name'=>'privacy']) }}" class="download-icon"><i class="fa fa-location-arrow"></i></a>
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
                            <a href="{{ route('accountSettings',['index'=>6,'name'=>'notifications']) }}" class="download-icon"><i class="fa fa-location-arrow"></i></a>
                        </div>
                    </div>
               
                </div> --}}
                <div class="row">

                    <div class="col-lg-12 col-xl-12">
                        <div class="sub-title"></div>
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs md-tabs b-none  tabs-left custom-tabs" role="tablist">

                            @foreach ($indexArray as $key=>$value)
                                
                            <li class="nav-item" style="width: fit-content">
                                <a class="nav-link {{ $key==request('index') ? 'active' : '' }}" data-toggle="tab" href="#home{{$key}}" role="tab">{{ $value }}</a>
                                {{-- <div class="slide"></div> --}}
                            </li>
                            
                            @endforeach

                           
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content tabs-left-content card-block w-100">
                           

                            <div class="tab-pane  {{ request('index')==='1' ? 'active' : '' }}" id="home1" role="tabpanel">
                                <p class="m-0">From here you can view/edit your profile.</p>

                                <div class="row mt-3">
                                    <div class="col-lg-2">
                                       <b>Edit-profile</b> 
                                    </div>
                                    <div class="col-lg-8">
                                          You can edit view and edit your profile through edit button.
                                    </div>
                                    <div class="col-lg-2">
                                        <a href="{{ route('profile.edit') }}" class="text-primary">Edit</a>
                                    </div>
                                </div>

                            </div>

                            <div class="tab-pane  {{ request('index')==='2' ? 'active' : '' }}" id="home2" role="tabpanel">
                                <p class="m-0">Preferences</p>
                            </div>

                            <div class="tab-pane  {{ request('index')==='3' ? 'active' : '' }}" id="home3" role="tabpanel">
                                <p class="m-0">Change your security settings, set up secure authentication.</p>

                                <div class="row mt-3">
                                    <div class="col-lg-2">
                                       <b>Password</b> 
                                    </div>
                                    <div class="col-lg-8">
                                        Reset your password regularly to keep your account safe and secure.
                                    </div>
                                    <div class="col-lg-2">
                                        <a href="{{ route('password.change') }}" class="text-primary">Reset</a>
                                    </div>
                                </div>
                                <hr>
                                <div class="row mt-3">
                                    <div class="col-lg-2">
                                       <b>Two-factor authentication</b> 
                                    </div>
                                    <div class="col-lg-8">
                                        Set up two-factor authentication by verifying your phone number .
                                    </div>
                                    <div class="col-lg-2">
                                        <a href="#" class="text-primary">Set up</a>
                                    </div>
                                </div>
                                <hr>
                                <div class="row mt-3">
                                    <div class="col-lg-2">
                                       <b>Delete Account</b> 
                                    </div>
                                    <div class="col-lg-8">
                                        Permanently delete your <em class="text-primary">{{ env('APP_NAME') }} </em> account.
                                    </div>
                                    <div class="col-lg-2">
                                        <a href="#" class="text-primary">Delete Account</a>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane  {{ request('index')==='4' ? 'active' : '' }}" id="home4" role="tabpanel">
                                <p class="m-0">Comming soon.</p>

                            </div>

                            <div class="tab-pane  {{ request('index')==='5' ? 'active' : '' }}" id="home5" role="tabpanel">
                                <p class="m-0">Comming soon.</p>
                            </div>

                            <div class="tab-pane  {{ request('index')==='6' ? 'active' : '' }}" id="home6" role="tabpanel">
                                <p class="m-0">Comming soon.</p>
                            </div>

                           
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

  <script>
    function updateClasses() {
        const customTabs = document.querySelector('.custom-tabs');

        if (window.innerWidth < 768) { 
            customTabs.classList.add('d-flex', 'justify-content-between');
            customTabs.classList.remove('tabs-left');
        } else {
            // Add classes for large screens
            customTabs.classList.add('tabs-left');
            customTabs.classList.remove('d-flex', 'justify-content-between');
        }
    }

    // Initial update on page load
    updateClasses();

    // Add event listener for window resize
    window.addEventListener('resize', updateClasses);
</script>    
  @endsection
