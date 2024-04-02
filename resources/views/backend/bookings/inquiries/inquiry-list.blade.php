@extends('backend.layouts.main')
@section('title', 'Booking Inquiry')

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
                                  <h4>All Booking Inquiry</h4>
                                  <span>List of all bookings inquiry</span>
                              </div>
                          </div>

                      </div>
                      <div class="col-lg-4">
                          <div class="page-header-breadcrumb">
                              <ul class="breadcrumb-title">
                                  <li class="breadcrumb-item">
                                      <a href="{{route('dashboard')}}"> <i class="feather icon-home"></i> </a>
                                  </li>
                                  <li class="breadcrumb-item"><a href="#!">Inquiry List</a>
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
                          <h5 class="card-header-text">Inquiry List</h5>
                      </div>
                      <div class="card-block contact-details">
                          <div class="data_table_main table-responsive dt-responsive">
                              <table id="simpletable" class="table  table-striped table-bordered wrap">
                                  <thead>
                                      <tr>

                                        <th>#</th>
                                        <th>Picked By</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Departure</th>
                                        <th>Arrival</th>
                                        <th>Dep-Date</th>
                                        <th>Ret-Date</th>
                                        <th>Adult</th>
                                        <th>Child</th>
                                        <th>Infant</th>
                                        <th>Trip Type</th>
                                        <th>Status</th>
                                        <th>Inquiry Date</th>
                                        <th>Action</th>

                                      </tr>
                                  </thead>
                                  <tbody>
                                    @foreach ($inquiries as $key=> $value)
                                        
                                      <tr>
                                        <td>{{$key+1}}</td>
                                        <td>
                                            @if (!empty($value->viewedBy))
                                            <span class="text-success">{{ $value->viewedBy->name }}</span>
                                            @else
                                                <a href="{{route('booking-inquiry',$value['id'])}}" class="text-info">Pick</a>
                                            @endif
                                            </td>
                                        <td><b>{{Str::words($value['name'], 1 ,'..')}}</b></td>
                                        <td>{{$value['email']}}</td>
                                        <td>{{$value['mobile']}}</td>
                                        <td>{{Str::words($value['departure_code'], 2 ,'..')}}</td>
                                        <td>{{Str::words($value['arrival_code'], 2 ,'..')}}</td>
                                        <td>{{$value['departure_date']}}</td>
                                        <td>{{$value['return_date']}}</td>
                                        <td>{{$value['adult']}}</td>
                                        <td>{{$value['child']}}</td>
                                        <td>{{$value['infant']}}</td>
                                        <td>{{ $value['return_date']!=null ? 'Round' :'Single' }}</td>

                                        <td><span class="badge badge-{{$value->status=='active' ? 'success' : 'danger'}} badge-pill">{{$value->status}}</span></td>
                                        <td>{{ $value->created_at->format('M, d Y h:i a') }}</td>
                                          <td class="dropdown">
                                              <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></button>
                                              <div class="dropdown-menu dropdown-menu-right b-none contact-menu">
                                                  <a class="dropdown-item" href="{{route('booking-inquiry',$value['id'])}}"><i class="icofont icofont-edit"></i>Edit</a>

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
