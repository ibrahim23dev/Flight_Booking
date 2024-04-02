@extends('backend.layouts.main')
@section('title', 'Users')

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
                                  <h4>All Users</h4>
                                  <span>List of all users</span>
                              </div>
                          </div>
                        
                      </div>
                      <div class="col-lg-4">
                          <div class="page-header-breadcrumb">
                              <ul class="breadcrumb-title">
                                  <li class="breadcrumb-item">
                                      <a href="{{route('dashboard')}}"> <i class="feather icon-home"></i> </a>
                                  </li>
                                  <li class="breadcrumb-item"><a href="#!">Users</a>
                                  </li>
                                  <li class="breadcrumb-item"><a href="">All</a>
                                  </li>
                              </ul>
                          </div>
                      </div>
                  </div>
              </div>
              <!-- Page-header end -->
                @php
                    // dd(session()->all());
                @endphp
                  <div class="page-body">
                   
                    <div class="card">
                      <div class="card-header">
                          <h5 class="card-header-text">Users</h5>
                          <a href="{{route('users.create')}}" class="btn btn-primary adn-50 adn-right float-right">
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
                                          <th>Gender</th>
                                          <th>Type</th>
                                          <th>Status</th>
                                          <th>Action</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                    @foreach ($users as $key=> $user)
                                        
                                      <tr>
                                          <td>{{$user->name}}</td>
                                          <td>{{$user->email}}</td>
                                          <td>{{$user->mobile}}</td>
                                          <td>{{$user->gender}}</td>
                                          <td>@foreach ($user->roles as $role)
                                              @if ($role->name=='admin')
                                              <span class="badge badge-success badge-pill">{{$role->name}}</span>
                                              @elseif($role->name=='B2B')
                                              <span class="badge badge-primary badge-pill">{{$role->name}} - agent</span>
                                              @else 
                                              <span class="badge badge-info badge-pill">{{$role->name}} - user</span>
                                              @endif
                                          @endforeach</td>
                                          <td><span class="badge badge-{{$user->status=='active'? 'primary': 'danger'}} badge-pill">{{$user->status}}</span></td>
                                          <td class="dropdown">
                                              <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></button>
                                              <div class="dropdown-menu dropdown-menu-right b-none contact-menu">
                                                  <a class="dropdown-item" href="{{route('users.edit',$user->id)}}"><i class="icofont icofont-edit"></i>Edit</a>
                                                  <form action="{{route('users.destroy',$user->id)}}" method="post" onsubmit="return confirm('Are you sure to delete')">
                                                  @csrf
                                                  @method('DELETE')

                                                  <button class="dropdown-item"><i class="icofont icofont-ui-delete"></i>Delete</button>
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
