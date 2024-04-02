@extends('backend.layouts.main')
@section('title', 'Booking List')

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
                                  <h4>All Booking List</h4>
                                  <span>List of all bookings </span>
                              </div>
                          </div>

                      </div>
                      <div class="col-lg-4">
                          <div class="page-header-breadcrumb">
                              <ul class="breadcrumb-title">
                                  <li class="breadcrumb-item">
                                      <a href="{{route('dashboard')}}"> <i class="feather icon-home"></i> </a>
                                  </li>
                                  <li class="breadcrumb-item"><a href="#!">Booking List</a>
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
                          <h5 class="card-header-text">Booking List</h5>
                      </div>
                      <div class="card-block contact-details">
                          <div class="data_table_main table-responsive dt-responsive">
                              <table id="simpletable" class="table  table-striped table-bordered wrap">
                                  <thead>
                                      <tr>

                                          <th>#</th>
                                          <th>Ref-Id</th>
                                          <th>User</th>
                                          <th>Booking Type</th>
                                          <th>Pass/Guests</th>
                                          <th>Booking Status</th>
                                          <th>Total Payment</th>
                                          <th>Booking Date</th>
                                          <th>Action</th>

                                      </tr>
                                  </thead>
                                  <tbody>
                                    @foreach ($tickets as $key=> $value)
                                        
                                      <tr>
                                        <td>{{$key+1}}</td>
                                        <td><a href="" class="text-primary">{{$value['ref_code']}}</a></td>
                                        <td>{{$value['user']['name']}}</td>
                                        <td>{{$value['booking_type']}}</td>
                                        <td>{{$value['number_of_guests']}}</td>
                                        <td><span class="badge badge-{{$value->status=='confirmed' ? 'success' : 'danger'}} badge-pill">{{$value->status}}</span></td>
                                        <td>{{$value['price'] .' - '.$value['currency']}}</td>
                                        <td>{{ $value['created_at']->format('M-d-Y h:i a') }}</td>
                                          <td class="dropdown">
                                              <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></button>
                                              <div class="dropdown-menu dropdown-menu-right b-none contact-menu">
                                                  <a class="dropdown-item" href="#"><i class="icofont icofont-edit"></i>Edit</a>

                                                  {{-- <form action="#" method="post" onsubmit="return confirm('Are you sure to cancel')">
                                                    @csrf
                                                    
                                                    <button class="dropdown-item"><i class="fa fa-times-circle-o"></i>Cancel</button>
                                                    </form> --}}
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
          <!-- Warning Section Starts -->
          <div id="styleSelector">

          </div>
      </div>
  </div> 


  @endsection
