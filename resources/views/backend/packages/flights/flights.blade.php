@extends('backend.layouts.main')
@section('title', 'Flight-Packages')

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
                                  <h4>All flight packages</h4>
                                  <span>List of all flight packges</span>
                              </div>
                          </div>
                        
                      </div>
                      <div class="col-lg-4">
                          <div class="page-header-breadcrumb">
                              <ul class="breadcrumb-title">
                                  <li class="breadcrumb-item">
                                      <a href="{{route('dashboard')}}"> <i class="feather icon-home"></i> </a>
                                  </li>
                                  <li class="breadcrumb-item"><a href="#!">Packages</a>
                                  </li>
                                  <li class="breadcrumb-item"><a href="">Flights</a>
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
                          <h5 class="card-header-text">Packages</h5>
                          <a href="{{route('flight-packages.create')}}" class="btn btn-primary adn-50 adn-right float-right">
                            <i class="icofont icofont-plus"></i>Create New  
                          </a>
                      </div>
                      <div class="card-block contact-details">
                          <div class="data_table_main table-responsive dt-responsive">
                              <table id="simpletable" class="table  table-striped table-bordered nowrap">
                                  <thead>
                                      <tr>
                                          <th>Airline/Airport</th>
                                          <th>Package Name</th>
                                          <th>Arrival City</th>
                                          <th>Price</th>
                                          <th>Status</th>
                                          <th>Updated At</th>
                                          <th>Action</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                    @foreach ($flights as $key=> $package)
                                        
                                      <tr>
                                          <td>{{ Str::words($package->airline, 3, '...') }}</td>
                                          <td>{{$package->package->package_name}}</td>
                                          <td>{{$package->arrival_city.' - '.$package->arrival_iataCode}}</td>
                                          <td>
                                            <span class="badge badge-primary badge-pill">{{$package->price.'  - '.$package->currency}}</span>
                                            </td>
                                            <td><span class="badge badge-{{$package->status=='active'? 'primary': 'danger'}} badge-pill">{{$package->status}}</span></td>
   
                                            <td>{{date('M,d-Y h:i a',strtotime($package->updated_at) )}}</td>
                                          <td class="dropdown">
                                              <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></button>
                                              <div class="dropdown-menu dropdown-menu-right b-none contact-menu">
                                                  <a class="dropdown-item" href="{{route('flight-packages.edit',$package->flight_id)}}"><i class="icofont icofont-edit"></i>Edit</a>

                                                  <form action="{{route('flight-packages.destroy',$package->flight_id)}}" method="post" onsubmit="return confirm('Are you sure to delete')">
                                                    @csrf
                                                    @method('DELETE')
  
                                                    <button class="dropdown-item"><i class="fa fa-trash"></i>Delete</button>
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
              </div>
          </div>
          <!-- Warning Section Starts -->
          <div id="styleSelector">

          </div>
      </div>
  </div> 


  @endsection
