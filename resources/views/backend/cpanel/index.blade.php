@extends('backend.layouts.main')
@section('title', 'Cpanel Accounts')

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
                                  <h4>Cpanel Accounts</h4>
                                  <span>List of Cpanel accounts</span>
                              </div>
                          </div>
                        
                      </div>
                      <div class="col-lg-4">
                          <div class="page-header-breadcrumb">
                              <ul class="breadcrumb-title">
                                  <li class="breadcrumb-item">
                                      <a href="{{route('dashboard')}}"> <i class="feather icon-home"></i> </a>
                                  </li>
                                  <li class="breadcrumb-item"><a href="#!">Cpanel</a>
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
                          <h5 class="card-header-text">Cpanel Accounts</h5>
                          <a href="{{route('cpanel.create')}}" class="btn btn-primary adn-50 adn-right float-right">
                            <i class="icofont icofont-plus"></i>Create New  
                          </a>
                      </div>
                      <div class="card-block contact-details">
                          <div class="data_table_main table-responsive dt-responsive">
                              <table id="simpletable" class="table  table-striped table-bordered nowrap">
                                  <thead>
                                      <tr>
                                          <th>Name</th>
                                          <th>Email</th>
                                          <th>Mobile.</th>
                                          <th>Domain</th>
                                          <th>Action</th>
                                      </tr>
                                  </thead>
                                  <tbody>

                                    {{-- @foreach ($tenants as $key=> $value)
                                        
                                      <tr>
                                          <td>{{$value->name}}</td>
                                          <td>{{$value->email}}</td>
                                          <td>{{$value->mobile}}</td>
                                          <td>
                                            @foreach ($value->domains as $domain)

                                            {{ $domain->domain }} {{ $loop->last ? '' :',' }}
                                                
                                            @endforeach    
                                        </td>   
                                          <td class="dropdown">
                                              <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></button>
                                              <div class="dropdown-menu dropdown-menu-right b-none contact-menu">
                                                  <a class="dropdown-item" href="{{route('tenants.edit',$value->id)}}"><i class="icofont icofont-edit"></i>Edit</a>
                                                  <form action="{{route('tenants.destroy',$value->id)}}" method="post" onsubmit="return confirm('Are you sure to delete')">
                                                  @csrf
                                                  @method('DELETE')

                                                  <button class="dropdown-item"><i class="icofont icofont-ui-delete"></i>Delete</button>
                                                  </form>


                                              </div>
                                          </td>
                                      </tr>
                                    @endforeach --}}



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
