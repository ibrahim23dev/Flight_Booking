@extends('backend.layouts.main')
@section('title', 'Transactions-all')

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
                                  <h4>All Transactions </h4>
                                  <span>List of transactions </span>
                              </div>
                          </div>

                      </div>
                      <div class="col-lg-4">
                          <div class="page-header-breadcrumb">
                              <ul class="breadcrumb-title">
                                  <li class="breadcrumb-item">
                                      <a href="{{route('dashboard')}}"> <i class="feather icon-home"></i> </a>
                                  </li>
                                  <li class="breadcrumb-item"><a href="#!">Payment</a>
                                  </li>
                                  <li class="breadcrumb-item"><a href="">transactions</a>
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
                          <h5 class="card-header-text">Transactions</h5>
                      </div>
                      <div class="card-block contact-details">
                          <div class="data_table_main table-responsive dt-responsive">
                              <table id="simpletable" class="table  table-striped table-bordered nowrap">
                                  <thead>
                                      <tr>
                                          <th>#</th>
                                          <th>Category</th>
                                          <th>Comments</th>
                                          <th>Amount</th>
                                          <th>Date</th>
                                          <th>User</th>
                                          <th>Status</th>
                                          <th>Action</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                    @foreach ($transactions as $key=> $transaction)
                                        
                                      <tr>
                                          <td>{{$key+1}}</td>
                                          <td>
                                            @if ($transaction->releted instanceof App\Models\Withdraw)
                                         <a href="{{route('withdraw.edit',$withdraw->withdraw_id)}}" class="text-danger">
                                        {{ $transaction->transection_category }}
                                        <i class="fa fa-eye"></i>

                                        </a>   
                                        @elseif ($transaction->releted instanceof App\Models\Deposit)
                                        <a href="{{route('deposits.edit',$deposit->id)}}" class="text-primary">
                                            {{ $transaction->transection_category }}
                                            <i class="fa fa-eye"></i>
                                            </a> 
                                        @endif
                                          </td>
                                          <td>{{$transaction->comments}}</td>
                                          <td>{{$transaction->amount}}</td>
                                          <td>{{$transaction->transection_date_timestamp}}</td>
                                          <td>{{$transaction->user->email}}</td>
                                          <td>
                                            <span class="badge badge-{{ 
                                                $transaction->status == 'completed' ? 'success' : 
                                                ($transaction->status == 'canceled' ? 'danger' : 
                                                ($transaction->status == 'pending' ? 'warning' : '')) 
                                            }} badge-pill text-white">
                                                {{ $transaction->status }}
                                            </span>
                                        </td>
                                        
                                          <td class="dropdown">
                                              <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></button>
                                              <div class="dropdown-menu dropdown-menu-right b-none contact-menu">
                                                  <a class="dropdown-item" href="{{route('transactions.edit',$transaction->transection_id )}}"><i class="icofont icofont-edit"></i>Edit</a>
                                                  <form action="{{route('transactions.destroy',$transaction->transection_id )}}" method="post" onsubmit="return confirm('Are you sure to delete')">
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
