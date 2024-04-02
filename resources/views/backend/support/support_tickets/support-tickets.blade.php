@extends('backend.layouts.main')
@section('title', 'Support-Tickets')

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
                                               <span class="text-white">All Support Tickets</span>
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
                                            <div class="p-20 text-center">
                                                <a href="{{route('tickets.create')}}" class="btn btn-primary">New</a>
                                            </div>
                                            <ul class="page-list nav nav-tabs flex-column" id="pills-tab" role="tablist">
                                                <li class="nav-item mail-section">
                                                    <a class="nav-link active" data-toggle="pill" href="#e-inbox" role="tab">
                                                        <i class="icofont icofont-inbox"></i> Open
                                                        <span class="label label-primary f-right">{{getTicketsCountByStatus('open')}}</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item mail-section">
                                                    <a class="nav-link" data-toggle="pill" href="#e-starred" role="tab">
                                                        <i class="icofont icofont-star"></i> Closed
                                                        <span class="label label-danger f-right">{{getTicketsCountByStatus('closed')}}</span>
                                                    </a>
                                                </li>


                                            </ul>

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
                                                        <div class="data_table_main table-responsive dt-responsive">
                                                            <table id="simpletable" class="table  table-striped table-bordered nowrap">
                                                                <thead>
                                                                    <tr>
                                                                        <th>#</th>
                                                                        <th>Name</th>
                                                                        <th>Subject</th>
                                                                        <th>New reply</th>
                                                                        <th>Date</th>
                                                                        <th>Status</th>
                                                                        <th>Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($openTickets as $openKey => $openticket)

                                                                    <tr>
                                                                        <td>{{$openKey+1}}</td>
                                                                        <td>{{ $openticket->user->name }}</td>
                                                                        <td>{{ $openticket->subject }}
                                                                        </td>

                                                                        <td>
                                                                            @if ($openticket->last_reply_at && $user->last_reply_seen_at)
                                                                            @php
                                                                                $lastReplyAtUnix = strtotime($openticket->last_reply_at);
                                                                                $lastReplySeenAtUnix = strtotime($user->last_reply_seen_at);
                                                                            @endphp
                                                                            @if ($lastReplyAtUnix > $lastReplySeenAtUnix) <!-- If the last reply is newer -->
                                                                                <span class="label label-primary f-right">New replies</span>
                                                                            @else
                                                                                <span class="label label-danger f-right">No new replies</span>
                                                                            @endif
                                                                        @else
                                                                            <span class="label label-danger f-right">No new replies</span>
                                                                        @endif
  
                                                                        </td>
                                                                        <td>{{ $openticket->created_at->format('M d, Y h:i a') }}</td>
                                                                        <td><span class="badge badge-primary badge-pill">{{ $openticket->status }}</span></td>
                                                                        <td class="dropdown">
                                                                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></button>
                                                                            <div class="dropdown-menu dropdown-menu-right b-none contact-menu">
                                                                                <a class="dropdown-item" href="{{route('tickets.edit',$openticket->id)}}"><i class="icofont icofont-eye"></i>View</a>
                                                                                <form action="{{route('tickets.changeStatus',$openticket->id)}}" method="post" onsubmit="return confirm('Are you sure to close the ticket.')">
                                                                                    @csrf
                                                                                    @method('PATCH')
                                  
                                                                                    <button class="dropdown-item"><i class="fa fa-power-off"></i>Close</button>
                                                                                    </form>
                           
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                               
                                                                    @endforeach
                                                                </tbody>
                              
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="e-starred" role="tabpanel">
                                                <div class="mail-body">
                                                    <div class="mail-body-header">

                                                    </div>
                                                    <div class="mail-body-content">
                                                        <div class="data_table_main table-responsive dt-responsive col-md-12">
                                                            <table id="second_table" class="table  table-striped table-bordered nowrap w-100">
                                                                <thead>
                                                                    <tr>
                                                                        <th>#</th>
                                                                        <th>Name</th>
                                                                        <th>Email</th>
                                                                        <th> Start Date</th>
                                                                        <th> Closed Date</th>
                                                                        <th>Status</th>
                                                                        <th>Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($closedTickets as $closeKey=> $closeticket)
                                                                    <tr>
                                                                        <td>{{$closeKey+1}}</td>
                                                                        <td>{{ $closeticket->user->name }}</td>
                                                                        <td>{{ $closeticket->subject }}</td>
                                                                        <td>{{ $closeticket->created_at->format('M d, Y h:i a') }}</td>
                                                                        <td>{{ date('M d, h:i a', strtotime($closeticket->closed_date)) }}</td>
                                                                        <td><span class="badge badge-danger badge-pill">{{ $closeticket->status }}</span></td>
                                                                        <td class="dropdown">
                                                                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></button>
                                                                            <div class="dropdown-menu dropdown-menu-right b-none contact-menu">
                                                                                <a class="dropdown-item" href="{{route('tickets.edit',$closeticket->id)}}"><i class="icofont icofont-eye"></i>View</a>

                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    @endforeach
                              
                                                                </tbody>
                              
                                                            </table>
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
