@extends('backend.layouts.main')
@section('title', 'Flight Booking List')

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
                                  <h4>All Flight Booking List</h4>
                                  <span>List of all flight bookings </span>
                              </div>
                          </div>

                      </div>
                      <div class="col-lg-4">
                          <div class="page-header-breadcrumb">
                              <ul class="breadcrumb-title">
                                  <li class="breadcrumb-item">
                                      <a href="{{route('dashboard')}}"> <i class="feather icon-home"></i> </a>
                                  </li>
                                  <li class="breadcrumb-item"><a href="#!">flight Booking List</a>
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
                                          <th>Booked By</th>
                                          <th>Contact</th>
                                          <th>Destinations</th>
                                          <th>Passengers</th>
                                          <th>Dep/Ret Date</th>
                                          <th>Booking Status</th>
                                          <th>Trip</th>
                                          <th>Total Payment</th>
                                          <th>Booking Date</th>
                                          <th>Action</th>

                                      </tr>
                                  </thead>
                                  <tbody>
                                    @foreach ($tickets as $key=> $value)
                                        
                                      <tr>
                                        <td>{{$key+1}}</td>
                                        <td><a href="#" class="text-primary">{{$value->pnr_no}}</a></td>
                                     
                                        <td>
                                            @if (auth()->user()->hasPermissionTo('manage all bookings'))
                                                <a href="{{ route('users.edit',$value->user->id) }}" class="text-primary">{{$value['user']['name']}}</a>
                                          
                                            @else
                                            <a href="{{ route('profile.edit') }}" class="text-primary">{{$value['user']['name']}}</a>
                                            @endif

                                        </td>
                                        <td> {{ $value->contact_no }} | {{ $value->email }}</td>
                                        <td>{{ $value->tripType!='multi' ? $value->destinations : 'Multi' }}</td>
                                        <td>{{ count($value->passengers) }}</td>
                                        <td>{{ $value->departure_date . ' / ' . $value->return_date}}</td>
                                        <td>
                                            <span class="text-white badge badge-{{ $value->booking_status == 'confirmed' ? 'success' : ($value->booking_status == 'pending' ? 'warning' : 'danger') }} badge-pill">{{ $value->booking_status }}</span>

                                        </td>
                                        <td>{{ $value->tripType }}</td>
                                        <td>
                                           
                                            <span class="badge badge-{{$value->payment_status=='completed' ? 'success' : 'danger'}} badge-pill"> {{$value['total_amount'] .' - '.$value['currency']}}</span>

                                           
                                        </td>
                                        <td>{{ $value->created_at->format('M-d-Y h:i a') }}</td>
                                          <td class="dropdown">
                                              <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></button>
                                              <div class="dropdown-menu dropdown-menu-right b-none contact-menu">
                                                  <a class="dropdown-item" href="{{ route('flight.edit',$value->id) }}"><i class="icofont icofont-edit"></i>Edit</a>

                                                  @canany(['cancel bookings', 'cancel all bookings'])
                                                      
                                                  <a class="dropdown-item" href="{{ route('flight.show',$value->id) }}"><i class="icofont icofont-edit"></i>Manage</a>

                                                  @endcanany


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

                                        @can('manage all bookings')
                 
                                        <th>Actual Price</th>
                                        <th>Sale Price</th>
                                        {{-- <th>Profit/Loss</th> --}}

                                        @endcan

                                        <th>Booking Date</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach ($tickets as $key=> $value)
                                      
                                    <tr>
                                      <td>{{$key+1}}</td>
                                      <td><a href="#" class="text-primary">{{$value->pnr_no}}</a></td>
                                      <td>{{$value->payment_method}}</td>

                                      <td>
                                        <span class="badge badge-{{$value->payment_status=='completed' ? 'success' : 'danger'}} badge-pill"> {{$value['total_amount'] .' - '.$value['currency']}}</span> 
                                        <br>
                                        <span>{{ $value->payment_status=='pending' ? 'Verification Needed' : 'Verified' }}</span>

                                    </td>
                                      <td>{{ $value->trx_id }}</td>
                                      <td>{{ $value->paid_amount}}</td>

                                      @can('manage all bookings')

                                      <td>{{ $value->total_amount }}</td>
                                      <td>{{ $value->total_amount }}</td>

                                      {{-- <td>
                                         
                                        <span class="badge badge-{{ $value->admin_profit >= 0 ? 'success' : 'danger' }} badge-pill">
                                            {{ $value->admin_profit .' - '.$value['currency'] }}
                                        </span>
                                        

                                      </td> --}}
                                      @endcan
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
