@extends('backend.layouts.main')
@section('title', 'Support-Tickets-view/reply')

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
                                               <span class="text-white">View-Reply Support Ticket: </span>
                                            </div>
                                          <span class="text-white">{{$supportTicket->subject}}</span>  
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
                                    <div class="col-lg-12 col-xl-12">
                                        <div class="mail-body">
                                            <div class="mail-body-content email-read">
                                                <div class="card">
                                                    <div class="card-block p-0">
                                                        <div class="row">
                                                            <div class="col-lg-12 col-md-12 messages-content " style="max-height: 30rem; overflow-x:auto;">
                                                            {{-- messages content  --}}
                                                            </div>
                                                            <div class="col-md-12 mt-5">
                                                                {{-- @if ($supportTicket->status=='open') --}}
                                                                    
                                                            <form action="{{ route('tickets.update',  $supportTicket->id) }}" method="post" id="reply-form" data-ticket-id="{{ $supportTicket->id }}">
                                                                @method('PATCH')
                                                                @csrf
                                                                <div class="messages-send">
                                                                    <div class="form-group">
                                                                        <div class="input-group">
                                                                            <input type="text" id="reply-text" class="form-control new-msg" placeholder="Your reply.." name="message" required autocomplete="off">
                                                                            <button type="submit" style="border: none">
                                                                                <span class="input-group-addon bg-white" id="basic-addon2"><i class="icofont icofont-paper-plane f-18 text-primary"></i></span>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                    <div id="validation-errors" class="text-danger" style="display: none;"></div>

                                                                </div>
                                                            </form>
                                                            {{-- @endif --}}

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
