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
                                  <h4>All  Promo Usages</h4>
                                  <span>List of all promo code usages</span>
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
                                  <li class="breadcrumb-item"><a href="">All Usages</a>
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
                          <h5 class="card-header-text">Promo Codes Usages

                            @if ($totalUsedCount!=null)

                            | Total Used: <span class="badge badge-primary badge-pill text-white"> {{ $totalUsedCount }}    </span>
                            @endif
                            
                          </h5>
                          <a href="{{route('promo-codes.index')}}" class="btn btn-primary adn-50 adn-right float-right">
                            <i class="icofont icofont-swoosh-left"></i>Back 
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
                                          <th>Limit</th>
                                         
                                          <th>User Name</th>
                                          <th>Email</th>
                                          <th>Used At</th>
                                         
                                          <th>Action</th>
                                
                                      </tr>
                                  </thead>
                                  <tbody>
                                    @foreach ($promoCodeUsages as $key=> $value)
                                        
                                      <tr>
                                          <td>{{$key+1}}</td>
                                          <td>{{$value->promoCode->code}}</td>
                                          <td>{{$value->promoCode->discount}}{{ ($value->promoCode->discount_type=='value') ?'($)':'(%)' }}</td>
                                          <td>{{ $value->promoCode->usage_limit }}</td>
                                    
                                          <td>
                                            <span class="badge badge badge-primary badge-pill">
                                            {{ $value->user->name }}</td>
                                           </span>
                                           <td>
                                           {{ $value->user->email }}</td>
                                          
                                          <td>{{date('M,d-Y h:i a',strtotime($value->created_at) )}}</td>

                                          <td class="dropdown">
                                              <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></button>
                                              <div class="dropdown-menu dropdown-menu-right b-none contact-menu">
                                                 
                                                  <a class="dropdown-item" href="{{route('promo.usages',$value->promoCode->id)}}"><i class="icofont icofont-eye"></i>Usages</a>
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
