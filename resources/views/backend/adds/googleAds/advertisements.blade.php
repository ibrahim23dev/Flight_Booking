@extends('backend.layouts.main')
@section('title', 'Google Advertisements')

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
                                  <h4>All Google Advertisements</h4>
                                  <span>List of all google advertisements</span>
                              </div>
                          </div>
                         
                      </div>
                      <div class="col-lg-4">
                          <div class="page-header-breadcrumb">
                              <ul class="breadcrumb-title">
                                  <li class="breadcrumb-item">
                                      <a href="{{route('dashboard')}}"> <i class="feather icon-home"></i> </a>
                                  </li>
                                  <li class="breadcrumb-item"><a href="#!">Advertisements</a>
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
                          <h5 class="card-header-text">Advertisements</h5>
                          <a href="{{route('google-ads.create')}}" class="btn btn-primary adn-50 adn-right float-right">
                            <i class="icofont icofont-plus"></i>Create New  
                          </a>
                      </div>
                      <div class="card-block contact-details">
                          <div class="data_table_main table-responsive dt-responsive">
                              <table id="simpletable" class="table  table-striped table-bordered nowrap">
                                  <thead>
                                      <tr>
                                          <th>#</th>
                                          <th>Position</th>
                                          <th>Ad Code</th>
                                          <th>Created At</th>
                                          <th>Status</th>

                                          <th>Action</th>
                                
                                      </tr>
                                  </thead>
                                  <tbody>
                                    @foreach ($ads as $key=> $adds)
                                        
                                      <tr>
                                          <td>{{$key+1}}</td>
                                          <td>{{$adds->position}}</td>
                                          <td>{{Str::words($adds->ad_code,3,'...')}}</td>
                                          <td>{{date('M,d-Y h:i a',strtotime($adds->created_at) )}}</td>

                                          <td> 
                                            @if ($adds->status === 'active')
                                            <span class="badge badge-success badge-pill">
                                                {{ $adds->status }}
                                            </span>
                                        @elseif ($adds->status === 'inactive')
                                            <span class="badge badge-danger badge-pill">
                                                {{ $adds->status }}
                                            </span>
                                       
                                        @endif
                                      </td>
                     
                                          <td class="dropdown">
                                              <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></button>
                                              <div class="dropdown-menu dropdown-menu-right b-none contact-menu">
                                                  <a class="dropdown-item" href="{{route('google-ads.edit',$adds->id)}}"><i class="icofont icofont-edit"></i>Edit</a>
                        
                                                  <form action="{{route('google-ads.destroy',$adds->id)}}" method="post" onsubmit="return confirm('Are you sure to delete')">
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