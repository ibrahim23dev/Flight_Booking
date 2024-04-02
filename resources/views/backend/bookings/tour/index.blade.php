@extends('backend.layouts.main')
@section('title', 'Tour Booking List')

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
                                  <h4>All Tour Booking List</h4>
                                  <span>List of all tour bookings </span>
                              </div>
                          </div>

                      </div>
                      <div class="col-lg-4">
                          <div class="page-header-breadcrumb">
                              <ul class="breadcrumb-title">
                                  <li class="breadcrumb-item">
                                      <a href="{{route('dashboard')}}"> <i class="feather icon-home"></i> </a>
                                  </li>
                                  <li class="breadcrumb-item"><a href="#!">Tour Booking List</a>
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
                   
                    <div class="card">
                      <div class="card-header">
                          <h5 class="card-header-text">Booking List</h5>
                      </div>
                      <div class="card-block">
                        <div class="table-responsive dt-responsive">
                            <table id="simpletable" class="table table-striped table-bordered table-responsive">
                               
                                  <thead>
                                      <tr>

                                          <th>#</th>
                                          <th>Ref-Id</th>
                                          <th>User</th>
                                         
                                          
                                          <th>Email</th>
                                          <th>phone Nunber</th>
                                          <th>Package</th>
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
                                        <td><a href="#" class="text-primary">{{$value->ref_code}}</a></td>
                                        <td>{{$value['user']['name']}}</td>
                                        <td>{{$value['user']['email']}}</td>
                                        <td>{{$value['user']['mobile']}}</td>
                                       
                                        <td data-toggle="tooltip" data-placement="top" title="{{ $value->package->package_name }}">{{ Str::words($value->package->package_name, 3, '...') }}</td>

                                      
                                        <td>
                                            <span class="text-white badge badge-{{ $value->booking_status == 'confirmed' ? 'success' : ($value->booking_status == 'pending' ? 'warning' : 'danger') }} badge-pill">{{ $value->booking_status }}</span>

                                        </td>
                                        <td>
                                           
                                            <span class="badge badge-{{$value->payment_status=='completed' ? 'success' : 'danger'}} badge-pill"> {{ number_format($value['total_amount']) .' - '.$value['currency']}}</span>

                                           
                                        </td>
                                        <td>{{ $value->created_at->format('M-d-Y h:i a') }}</td>
                                          <td class="dropdown">
                                              <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></button>
                                              <div class="dropdown-menu dropdown-menu-right b-none contact-menu">
                                                  <a class="dropdown-item" href="{{ route('tour-bookings.edit',$value->id) }}"><i class="icofont icofont-edit"></i>Edit/View</a>

                                              </div>
                                          </td>
                                      </tr>
                                    @endforeach

                                  </tbody>
                                
                              </table>
                          </div>
                      </div>
                  </div>

                  <div class="card">
                    <div class="card-header">
                        <h5 class="card-header-text">Payments Information</h5>
                    </div>
                    <div class="card-block ">
                        <div class="table-responsive dt-responsive">
                            <table id="second_table" class="table table-striped table-bordered ">
                                <thead>
                                    <tr>

                                        <th>#</th>
                                        <th>Ref-Id</th>
                                        <th>Method</th>
                                        <th>Status</th>
                                        <th>Trx Id</th>
                                        <th>Paid</th>

                                        <th>Booking Date</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach ($tickets as $key=> $value)
                                      
                                    <tr>
                                      <td>{{$key+1}}</td>
                                      <td><a href="#" class="text-primary">{{$value->ref_code}}</a></td>
                                      <td>{{$value->payment_method}}</td>

                                      <td>
                                        <span class="badge badge-{{$value->payment_status=='completed' ? 'success' : 'danger'}} badge-pill"> {{ number_format($value['total_amount']) .' - '.$value['currency']}}</span> 
                                        <br>
                                        <span>{{ $value->payment_status=='pending' ? 'Verification Needed' : 'Verified' }}</span>

                                    </td>
                                      <td>{{ $value->trx_id }}</td>
                                      <td>{{ $value->paid_amount}}</td>

                                     
                                      <td>{{ $value->created_at->format('M-d-Y h:i a') }}</td>
                                       
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
