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
                            <!-- Email-card start -->
                            <div class="card-block email-card">
                                <div class="row">
                                    <div class="col-lg-12 col-xl-3">
                                        <div class="user-head row">
                                            <div class="user-face">
                                               <span class="text-white">Create Support Tickets</span>
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
                                                                    <form action="{{route('tickets.store')}}" method="POST">
                                                                        @csrf
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control" placeholder="Subject" name="subject">
                                                                        </div>
                                                                        <x-input-error :messages="$errors->get('subject')" class="mt-2" />
                                                                        <div class="form-group">
                                                                            <textarea rows="5" cols="5" class="form-control" placeholder="Your message" name="message"></textarea>
                                                                        </div>
                                                                        <x-input-error :messages="$errors->get('message')" class="mt-2" />
                                                                        <div class="text-center m-t-20">
                                                                            <button type="submit" class="btn btn-primary waves-effect waves-light m-r-10 btn-spinner">Create
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
