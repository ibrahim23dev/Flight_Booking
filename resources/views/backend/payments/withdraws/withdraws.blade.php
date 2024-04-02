@extends('backend.layouts.main')
@section('title', 'Withdraws')

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
                                  <h4>All Withdraws</h4>
                                  <span>List of all withdraws</span>
                              </div>
                          </div>
                         
                      </div>
                      <div class="col-lg-4">
                          <div class="page-header-breadcrumb">
                              <ul class="breadcrumb-title">
                                  <li class="breadcrumb-item">
                                      <a href="{{route('dashboard')}}"> <i class="feather icon-home"></i> </a>
                                  </li>
                                  <li class="breadcrumb-item"><a href="#!">Withdraws</a>
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
                    <div class="card">
                      <div class="card-header">
                          <h5 class="card-header-text">Withdraws</h5>
                          <a href="{{route('withdraw.create')}}" class="btn btn-primary adn-50 adn-right float-right">
                            <i class="icofont icofont-plus"></i>Create New  
                          </a>
                      </div>
                      <div class="card-block contact-details">
                          <div class="data_table_main table-responsive dt-responsive">
                              <table id="simpletable" class="table  table-striped table-bordered nowrap">
                                  <thead>
                                      <tr>
                                          <th>Requested Amount</th>
                                          <th>Requested From </th>
                                          <th data-toggle="tooltip" data-placement="top" title="Remaining balance of user after accepted withdraw request without tax deduction">Remaining Balance</th>
                                          <th>Method</th>
                                          <th>Charge</th>
                                          <th>Fees</th>
                                          <th>Request Date</th>
                                          <th>Request Ip</th>
                                          <th>Status</th>
                                          @if (auth()->user()->hasPermissionTo('manage all withdraws')) 
                                          <th>Action</th>
                                          @endif

                                      </tr>
                                  </thead>
                                  <tbody>
                                    @foreach ($withdraws as $key=> $withdraw)
                                        
                                      <tr>
                                          <td>{{$withdraw->amount}}</td>
                                          <td>
                                            @if (auth()->user()->hasPermissionTo('manage all withdraws'))
                                            <a href="{{route('users.edit',$withdraw->user->id)}}" class="text-primary">{{$withdraw->user->name}}</a>
                                            @else
                                            <a href="{{route('profile.edit')}}" class="text-primary">{{$withdraw->user->name}}</a>
                                            @endif
                                          </td>
                                          <td>{{$withdraw->remaining_balance}}</td>
                                          <td>{{$withdraw->method}}</td>
                                          <td>{{$withdraw->charge}}</td>
                                          <td>{{$withdraw->fees}}</td>
                                          <td>{{date('M d, Y h:i a',strtotime($withdraw->request_date))}}</td>
                                          <td>{{$withdraw->request_ip}}</td>
                                          <td> 
                                            @if ($withdraw->status === 'pending')
                                            <span class="badge badge-primary badge-pill">
                                                {{ $withdraw->status }}
                                            </span>
                                        @elseif ($withdraw->status === 'accepted')
                                            <span class="badge badge-success badge-pill">
                                                {{ $withdraw->status }}
                                            </span>
                                        @else
                                            <span class="badge badge-danger badge-pill">
                                                {{ $withdraw->status }}
                                            </span>
                                        @endif
                                      </td>
                                      @if (auth()->user()->hasPermissionTo('manage all withdraws')) 

                                          <td class="dropdown">
                                              <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></button>
                                              <div class="dropdown-menu dropdown-menu-right b-none contact-menu">
                                                  <a class="dropdown-item" href="{{route('withdraw.edit',$withdraw->withdraw_id)}}"><i class="fa fa-eye"></i>View</a>
                                                    @if ($withdraw->status!='accepted')
                                                        
                                                  <form action="{{route('withdraw.withdrawAccept',$withdraw->withdraw_id)}}" method="post" onsubmit="return confirm('Are you sure to accept ? Once you accept, it cannot be revised')">
                                                    @csrf
                                                    @method('PATCH')
  
                                                    <button class="dropdown-item"><i class="fa fa-check"></i>Accept</button>
                                                    </form>
                                                    @endif

                                              </div>
                                          </td>
                                          @endif
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
          <!-- Warning Section Starts -->
          <div id="styleSelector">

          </div>
      </div>
  </div> 


  @endsection
