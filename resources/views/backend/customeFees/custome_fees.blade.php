@extends('backend.layouts.main')
@section('title', 'Custome Fees')

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
                                  <h4>All Custom Fees</h4>
                                  <span>List of all Custom Fees</span>
                              </div>
                          </div>
                         
                      </div>
                      <div class="col-lg-4">
                          <div class="page-header-breadcrumb">
                              <ul class="breadcrumb-title">
                                  <li class="breadcrumb-item">
                                      <a href="{{route('dashboard')}}"> <i class="feather icon-home"></i> </a>
                                  </li>
                                  <li class="breadcrumb-item"><a href="#!">Custom Fees</a>
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
                          <h5 class="card-header-text">Custom Fees</h5>
                          <a href="{{route('custom-fees.create')}}" class="btn btn-primary adn-50 adn-right float-right">
                            <i class="icofont icofont-plus"></i>Create New  
                          </a>
                      </div>
                      <div class="card-block contact-details">
                          <div class="data_table_main table-responsive dt-responsive">
                              <table id="simpletable" class="table  table-striped table-bordered nowrap">
                                  <thead>
                                      <tr>
                                          <th>Iata Code</th>
                                          <th>Icao Code</th>
                                          <th>Price</th>
                                          <th>Price Type</th>
                                          <th>Status</th>
                                          <th>Created At</th>
                                          <th>Action</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                    @foreach ($custome as $key=> $value)
                                        
                                      <tr>
                                          <td>{{$value->iata_code}}</td>
                                          <td>{{$value->icao_code}}</td>
                                          <td> {{$value->price}} </td>
                                          <td>{{$value->price_type}}</td>
                                            <td>
                                                <span class="badge badge-{{$value->status=='active' ? 'success' : 'danger'}} badge-pill">{{$value->status}}</span>
                                                </td>
                                            <td>{{date('M,d-Y h:i a',strtotime($value->created_at) )}}</td>
                                          <td class="dropdown">
                                              <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></button>
                                              <div class="dropdown-menu dropdown-menu-right b-none contact-menu">
                                                  <a class="dropdown-item" href="{{route('custom-fees.edit',$value->id)}}"><i class="icofont icofont-edit"></i>Edit</a>

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