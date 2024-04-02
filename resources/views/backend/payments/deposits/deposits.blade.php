@extends('backend.layouts.main')
@section('title', 'Deposits')

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
                                  <h4>All Deposits</h4>
                                  <span>List of all deposits</span>
                              </div>
                          </div>
                         
                      </div>
                      <div class="col-lg-4">
                          <div class="page-header-breadcrumb">
                              <ul class="breadcrumb-title">
                                  <li class="breadcrumb-item">
                                      <a href="{{route('dashboard')}}"> <i class="feather icon-home"></i> </a>
                                  </li>
                                  <li class="breadcrumb-item"><a href="#!">Deposits</a>
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
                          <h5 class="card-header-text">Deposits</h5>
                          <a href="{{route('deposits.create')}}" class="btn btn-primary adn-50 adn-right float-right">
                            <i class="icofont icofont-plus"></i>Create New  
                          </a>
                      </div>
                      <div class="card-block contact-details">
                          <div class="data_table_main table-responsive dt-responsive">
                              <table id="simpletable" class="table  table-striped table-bordered nowrap">
                                  <thead>
                                      <tr>
                                          <th>Amount</th>
                                          <th>Deposited From </th>
                                          <th>Mode</th>
                                          <th>Deposited Bank</th>
                                          <th>Branch</th>
                                          <th>Transaction No</th>
                                          <th>File</th>
                                          <th>Status</th>
                                          @if (auth()->user()->hasPermissionTo('manage all deposits')) 
                                          <th>Action</th>
                                          @endif

                                      </tr>
                                  </thead>
                                  <tbody>
                                    @foreach ($deposits as $key=> $deposit)
                                        
                                      <tr>
                                          <td>{{$deposit->amount}}</td>
                                          <td>
                                            @if (auth()->user()->hasPermissionTo('manage all deposits'))
                                            <a href="{{route('users.edit',$deposit->depositor->id)}}" class="text-primary">{{$deposit->depositor->name}}</a>
                                            @else
                                            <a href="{{route('profile.edit')}}" class="text-primary">{{$deposit->depositor->name}}</a>
                                            @endif
                                          </td>
                                          <td>{{$deposit->mode}}</td>
                                          <td>{{$deposit->deposited_bank}}</td>
                                          <td>{{$deposit->branch}}</td>
                                          <td>{{$deposit->transaction_no}}</td>
                                          <td> @if ($deposit->image)

                                            <a href="{{ Storage::url($deposit->image) }}" class="text-primary">File</a>
                                        @else
                                            No File
                                        @endif</td>
                                          <td> 
                                            @if ($deposit->status === 'pending')
                                            <span class="badge badge-primary badge-pill">
                                                {{ $deposit->status }}
                                            </span>
                                        @elseif ($deposit->status === 'accepted')
                                            <span class="badge badge-success badge-pill">
                                                {{ $deposit->status }}
                                            </span>
                                        @else
                                            <span class="badge badge-danger badge-pill">
                                                {{ $deposit->status }}
                                            </span>
                                        @endif
                                      </td>
                                      @if (auth()->user()->hasPermissionTo('manage all deposits')) 

                                          <td class="dropdown">
                                              <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></button>
                                              <div class="dropdown-menu dropdown-menu-right b-none contact-menu">
                                                  <a class="dropdown-item" href="{{route('deposits.edit',$deposit->id)}}"><i class="icofont icofont-edit"></i>Edit</a>
                                                    @if ($deposit->status!='accepted')
                                                        
                                                  <form action="{{route('deposits.accepts',$deposit->id)}}" method="post" onsubmit="return confirm('Are you sure to accept ? Once you accept, it cannot be revised')">
                                                    @csrf
                                                    @method('PATCH')
  
                                                    <button class="dropdown-item"><i class="fa fa-check"></i>Accept</button>
                                                    </form>
                                                    @endif

                                              </div>
                                          </td>
                                          @endif
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
