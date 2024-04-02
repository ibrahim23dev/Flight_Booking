@extends('backend.layouts.main')
@section('title', 'Sections')

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
                                  <h4>All Sections</h4>
                                  <span>List of all sections</span>
                              </div>
                          </div>
                        
                      </div>
                      <div class="col-lg-4">
                          <div class="page-header-breadcrumb">
                              <ul class="breadcrumb-title">
                                  <li class="breadcrumb-item">
                                      <a href="{{route('dashboard')}}"> <i class="feather icon-home"></i> </a>
                                  </li>
                                  <li class="breadcrumb-item"><a href="#!">Sections</a>
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
                    
                      <div class="card-block contact-details">
                          <div class="data_table_main table-responsive dt-responsive">
                              <table id="simpletable" class="table  table-striped table-bordered nowrap">
                                  <thead>
                                      <tr>
                                          <th>Type</th>
                                          <th>Heading</th>
                                          <th>Short Title</th>
                                          <th>Updated At</th>
                                          <th>Action</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                    @foreach ($sections as $key=> $value)
                                        
                                      <tr>
                                         
                                          <td>{{Str::words($value->section_type, 4, '...')}}</td>
                                          <td>{{ Str::words($value->section_heading, 4, '...') }}</td>
                                          
                                          <td>{{ Str::words($value->short_title, 3, '...') }}</td>
                                          <td>{{ $value->updated_at->format('M-d-Y h:i a') }}</td>
                                          <td class="dropdown">
                                              <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></button>
                                              <div class="dropdown-menu dropdown-menu-right b-none contact-menu">
                                                  <a class="dropdown-item" href="{{route('/settings/section.edit',$value->id)}}"><i class="icofont icofont-edit"></i>Edit</a>
                                                 
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
