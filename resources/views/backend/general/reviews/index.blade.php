@extends('backend.layouts.main')
@section('title', 'Reviews')

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
                                  <h4>All  Reviews</h4>
                                  <span>List of all reviews</span>
                              </div>
                          </div>
                        
                      </div>
                      <div class="col-lg-4">
                          <div class="page-header-breadcrumb">
                              <ul class="breadcrumb-title">
                                  <li class="breadcrumb-item">
                                      <a href="{{route('dashboard')}}"> <i class="feather icon-home"></i> </a>
                                  </li>
                                  <li class="breadcrumb-item"><a href="#!">Reviews</a>
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
                  
                    @if(session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                    @endif
                    <div class="card">
                      <div class="card-header ">
                          <h5 class="card-header-text">Reviews</h5>
                          <a href="{{route('reviews.create')}}" class="btn btn-primary adn-50 adn-right float-right">
                            <i class="icofont icofont-plus"></i>Create New  
                          </a>
                      </div>
                      <div class="card-block contact-details">
                          <div class="data_table_main table-responsive dt-responsive">
                              <table id="simpletable" class="table  table-striped table-bordered nowrap">
                                  <thead>
                                      <tr>
                                          <th>#</th>
                                          <th>User</th>
                                          <th>Rating</th>
                                          <th>Text</th>
                                          <th>Created At</th>
                                          <th>Status</th>

                                          <th>Action</th>
                                
                                      </tr>
                                  </thead>
                                  <tbody>
                                    @foreach ($reviews as $key=> $value)
                                        
                                      <tr>
                                          <td>{{$key+1}}</td>
                                          <td>{{$value->user->name}}</td>
                                          <td>{{$value->rating}}</td>
                                          <td>{{Str::words($value->review_text,4,'...')}}</td>
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
                                                  <a class="dropdown-item" href="{{route('reviews.edit',$value->id)}}"><i class="icofont icofont-edit"></i>Edit</a>
                        
                                                  <form action="{{route('reviews.destroy',$value->id)}}" method="post" onsubmit="return confirm('Are you sure to delete')">
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
