@extends('backend.layouts.main')
@section('title', 'Promo codes')

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
                                  <h4>All  Promo</h4>
                                  <span>List of all promo codes</span>
                              </div>
                          </div>
                         
                      </div>
                      <div class="col-lg-4">
                          <div class="page-header-breadcrumb">
                              <ul class="breadcrumb-title">
                                  <li class="breadcrumb-item">
                                      <a href="{{route('dashboard')}}"> <i class="feather icon-home"></i> </a>
                                  </li>
                                  <li class="breadcrumb-item"><a href="#!">Promo Codes</a>
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
                          <h5 class="card-header-text">Promo Codes</h5>
                          <a href="{{route('promo-codes.create')}}" class="btn btn-primary adn-50 adn-right float-right">
                            <i class="icofont icofont-plus"></i>Create New  
                          </a>
                          <a href="{{route('promo.usages')}}" class="btn btn-primary adn-50 adn-right float-right mr-3">
                            <i class="icofont icofont-eye"></i>View Usages  
                          </a>
                      </div>
                      <div class="card-block contact-details">
                          <div class="data_table_main table-responsive dt-responsive">
                              <table id="simpletable" class="table  table-striped table-bordered nowrap">
                                  <thead>
                                      <tr>
                                          <th>#</th>
                                          <th>Code</th>
                                          <th>Discount</th>
                                          <th>Usages</th>
                                          <th>Limit</th>
                                          <th>Expiry Date</th>
                                          <th>Created At</th>
                                          <th>Status</th>

                                          <th>Action</th>
                                
                                      </tr>
                                  </thead>
                                  <tbody>
                                    @foreach ($promoCodes as $key=> $value)
                                        
                                      <tr>
                                          <td>{{$key+1}}</td>
                                          <td>{{$value->code}}</td>
                                          <td>{{$value->discount}}{{ ($value->discount_type=='value') ?'($)':'(%)' }}</td>
                                          <td>{{ $value->usages_count }}</td>
                                          <td>{{ $value->usage_limit }}</td>
                                          <td>
                                             {{ date('M,d-Y h:i a',strtotime($value->expiry_date) )}}  <br>
                                            @if ($value->expiry_date)
                                            @php
                                                $expiryDate = \Carbon\Carbon::parse($value->expiry_date);
                                            @endphp
                                            @if ($expiryDate->isPast())
                                                <span class="badge badge-danger">Expired</span>
                                            @else
                                                <span class="badge badge-primary">Active</span>
                                            @endif
                                        @else
                                            <span class="badge badge-primary">Active</span>
                                        @endif
                                        </td>
                                          <td>{{date('M,d-Y h:i a',strtotime($value->created_at) )}}</td>

                                          <td> 
                                            @if ($value->status === 'active')
                                            <span class="badge badge-success badge-pill">
                                                {{ $value->status }}
                                            </span>
                                        @elseif ($value->status === 'inactive')
                                            <span class="badge badge-danger badge-pill">
                                                {{ $value->status }}
                                            </span>
                                       
                                        @endif
                                      </td>
                     
                                          <td class="dropdown">
                                              <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></button>
                                              <div class="dropdown-menu dropdown-menu-right b-none contact-menu">
                                                  <a class="dropdown-item" href="{{route('promo-codes.edit',$value->id)}}"><i class="icofont icofont-edit"></i>Edit</a>
                        
                                                  <a class="dropdown-item" href="{{route('promo.usages',$value->id)}}"><i class="icofont icofont-eye"></i>Usages</a>
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
