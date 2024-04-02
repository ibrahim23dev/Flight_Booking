@extends('backend.layouts.main')
@section('title', 'Dashboard')
@section('main-container')


<div class="pcoded-content">
  <div class="pcoded-inner-content">
      <div class="main-body">
          <div class="page-wrapper">

              <div class="page-body">
                  <div class="row">
                      <!-- task, page, download counter  start -->
                      @can('manage users')
                      <div class="col-xl-3 col-md-6">
                          <div class="card bg-c-yellow update-card">
                              <div class="card-block">
                                  <div class="row align-items-end">
                                      <div class="col-9">
                                       
                                        <h4 class="text-white">{{ $usersCount }}</h4>

                                          <h6 class="text-white m-b-0">Users</h6>
                                      </div>
                                      <div class="col-3 text-right">
                                        <i class="fa fa-users font-2"></i>
                                          <canvas id="update-chart-1" height="50" class="d-none" ></canvas>
                                      </div>
                                  </div>
                              </div>
                              <div class="card-footer">
                                <a href="{{ route('users.index') }}" class="text-white">  View </a>
                              </div>
                          </div>
                      </div>
                     @endcan

                      <div class="col-xl-3 col-md-6">
                          <div class="card bg-c-green update-card">
                              <div class="card-block">
                                  <div class="row align-items-end">
                                      <div class="col-9">
                                          <h4 class="text-white">{{ countBookingStatus('confirmed') }}</h4>
                                          <h6 class="text-white m-b-0">Confirmed Bookings</h6>
                                      </div>
                                      <div class="col-3 text-right">
                                        <i class="fa fa-shopping-bag font-2"></i>

                                          <canvas id="update-chart-2" height="50" class="d-none"></canvas>
                                      </div>
                                  </div>
                              </div>
                              <div class="card-footer">
                                <a href="{{ route('/booking-list',['booking_status'=>'confirmed']) }}" class="text-white">  View </a>

                              </div>
                          </div>
                      </div>
                      <div class="col-xl-3 col-md-6">
                          <div class="card bg-c-pink update-card">
                              <div class="card-block">
                                  <div class="row align-items-end">
                                      <div class="col-9">
                                          <h4 class="text-white">{{ countBookingStatus('canceled') }}</h4>
                                          <h6 class="text-white m-b-0">Cancelled Bookings</h6>
                                      </div>
                                      <div class="col-3 text-right">
                                        <i class="fa fa-times font-2"></i>

                                          <canvas id="update-chart-3" height="50" class="d-none"></canvas>
                                      </div>
                                  </div>
                              </div>
                              <div class="card-footer">
                                <a href="{{ route('/booking-list',['booking_status'=>'canceled']) }}" class="text-white">  View </a>

                              </div>
                          </div>
                      </div>
                      <div class="col-xl-3 col-md-6">
                          <div class="card bg-c-lite-green update-card">
                              <div class="card-block">
                                  <div class="row align-items-end">
                                      <div class="col-9">
                                          <h4 class="text-white">{{ countBookingStatus('pending') }}</h4>
                                          <h6 class="text-white m-b-0">Pending Bookings</h6>
                                      </div>
                                      <div class="col-3 text-right">
                                        <i class="fa fa-info font-2"></i>

                                          <canvas id="update-chart-4" height="50" class="d-none"></canvas>
                                      </div>
                                  </div>
                              </div>
                              <div class="card-footer">
                                <a href="{{ route('/booking-list',['booking_status'=>'pending']) }}" class="text-white">  View </a>

                              </div>
                          </div>
                      </div>
                      <!-- task, page, download counter  end -->

                      <!--  booking table start-->
                      
                      <div class="col-xl-9 col-md-12">
                        <div class="card table-card">
                            <div class="card-header">
                                <h5>Latest Bookings</h5>
                                <div class="card-header-right">
                                    <ul class="list-unstyled card-option">
                                        <li><i class="feather icon-maximize full-card"></i></li>
                                        <li><i class="feather icon-minus minimize-card"></i></li>
                                        <li><i class="feather icon-trash-2 close-card"></i></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-block">
                                <div class="table-responsive">
                                    <table class="table table-hover  table-borderless">
                                        <thead>
                                            <tr>
                                                <th>Details</th>
                                                <th>Ref-Id</th>
                                                <th>Booking Status</th>
                                                <th>Booking Type</th>
                                                <th>Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($tickets as $ticket)
                                                
                                            <tr>
                                                <td>
                                                   
                                                    <div class="d-inline-block align-middle">
                                                        <h6>{{$ticket->user->name}}</h6>
                                                        <p class="text-muted m-b-0">{{ $ticket->created_at->format('M-d-Y') }}</p>
                                                    </div>
                                                </td>
                                                <td>{{ $ticket->ref_code }}</td>
                                                <td>{{ $ticket->status }}</td>
                                                <td>{{ $ticket->booking_type }}</td>
                                                <td class="text-c-blue">{{ $ticket->price }}</td>
                                            </tr>
                                            @endforeach


                                        </tbody>
                                    </table>
                                    @if ($tickets->count()>0)
                                    <div class="text-center">
                                        <a href="{{route('/booking-list')}}" class=" b-b-primary text-primary">View all bookings</a>
                                    </div>
                                    @else
                                    <div class="text-center">
                                        <a href="#" class=" b-b-primary text-primary">No Bookings Data </a>
                                    </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                      </div>
                      <!--  booking table end -->

                      <div class="col-xl-3 col-md-12">
                          <div class="card user-card2">
                              <div class="card-block text-center">
                                  <h6 class="m-b-15">Total Bookings</h6>
                                  <div class="risk-rate">
                                      <span><b>{{ countBookingStatus() }}</b></span>
                                  </div>
                                  <h6 class="m-b-10 m-t-10"></h6>
                                  <a href="{{route('/booking-list')}}" class="text-c-yellow b-b-warning">View</a>
                                  <div class="row justify-content-center m-t-10 b-t-default m-l-0 m-r-0">
                                      <div class="col m-t-15 b-r-default">
                                          <h6 class="text-muted">Last On</h6>
                                          <h6>
                                            @if ($tickets->count() > 0)
                                            {{ $tickets[0]->created_at->format('M-d-Y') }}
                                           
                                            @endif
                                          </h6>
                                      </div>
                                      <div class="col m-t-15">
                                          <h6 class="text-muted">Ref-Id</h6>
                                          <h6>
                                            @if ($tickets->count() > 0)
                                            {{ $tickets[0]->ref_code }}
                                            @endif
                                          </h6>
                                      </div>
                                  </div>
                              </div>
                              
                          </div>
                      </div>
                      <!--  sale analytics end -->

                      <div class="col-xl-12 col-md-12">
                          <div class="card user-card-full">
                              <div class="row m-l-0 m-r-0">
                                  <div class="col-sm-4 bg-c-lite-green user-profile">
                                      <div class="card-block text-center text-white">
                                          <div class="m-b-25">
                                              <img src="{{ asset('storage/images/users/' . auth()->user()->image) }}" class="user-img img-radius" alt="User-Profile-Image" style="width: 8rem;height:8rem">
                                          </div>
                                          <h6 class="f-w-600">{{ auth()->user()->name }}</h6>
                                          <p>{{ auth()->user()->roles[0]->name }}</p>
                                          <i class="feather icon-edit m-t-10 f-16"></i>
                                      </div>
                                  </div>
                                  <div class="col-sm-8">
                                      <div class="card-block">
                                          <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Contact Information</h6>
                                          <div class="row">
                                              <div class="col-sm-6">
                                                  <p class="m-b-10 f-w-600">Email</p>
                                                  <h6 class="text-muted f-w-400">{{ auth()->user()->email }}</h6>
                                              </div>
                                              <div class="col-sm-6">
                                                  <p class="m-b-10 f-w-600">Phone</p>
                                                  <h6 class="text-muted f-w-400">{{ auth()->user()->mobile }}</h6>
                                              </div>
                                          </div>
                                          <h6 class="m-b-20 m-t-40 p-b-5 b-b-default f-w-600">Other Information</h6>
                                          <div class="row">
                                              <div class="col-sm-6">
                                                  <p class="m-b-10 f-w-600">Address</p>
                                                  <h6 class="text-muted f-w-400">{{ auth()->user()->address }}</h6>
                                              </div>
                                              <div class="col-sm-6">
                                                  <p class="m-b-10 f-w-600">Joind At</p>
                                                  <h6 class="text-muted f-w-400">{{ auth()->user()->created_at->format('M-d-Y h:i: a') }}</h6>
                                              </div>
                                          </div>
                                          <ul class="social-link list-unstyled m-t-40 m-b-10">
                                              <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="facebook"><i class="feather icon-facebook facebook" aria-hidden="true"></i></a></li>
                                              <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="twitter"><i class="feather icon-twitter twitter" aria-hidden="true"></i></a></li>
                                              <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="instagram"><i class="feather icon-instagram instagram" aria-hidden="true"></i></a></li>
                                          </ul>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <!-- wather user -->

                      <!-- social download  start -->
                      <div class="col-xl-4 col-md-6">
                          <div class="card social-card bg-simple-c-blue">
                              <div class="card-block">
                                  <div class="row align-items-center">
                                      <div class="col-auto">
                                          <i class="feather icon-mail f-34 text-c-blue social-icon"></i>
                                      </div>
                                      <div class="col">
                                          <h6 class="m-b-0">Mail</h6>
                                          <p>231.2w downloads</p>
                                          <p class="m-b-0">Lorem Ipsum is simply dummy text of the printing</p>
                                      </div>
                                  </div>
                              </div>
                              <a href="#!" class="download-icon"><i class="feather icon-arrow-down"></i></a>
                          </div>
                      </div>
                      <div class="col-xl-4 col-md-6">
                          <div class="card social-card bg-simple-c-pink">
                              <div class="card-block">
                                  <div class="row align-items-center">
                                      <div class="col-auto">
                                          <i class="feather icon-twitter f-34 text-c-pink social-icon"></i>
                                      </div>
                                      <div class="col">
                                          <h6 class="m-b-0">twitter</h6>
                                          <p>231.2w downloads</p>
                                          <p class="m-b-0">Lorem Ipsum is simply dummy text of the printing</p>
                                      </div>
                                  </div>
                              </div>
                              <a href="#!" class="download-icon"><i class="feather icon-arrow-down"></i></a>
                          </div>
                      </div>
                      <div class="col-xl-4 col-md-12">
                          <div class="card social-card bg-simple-c-green">
                              <div class="card-block">
                                  <div class="row align-items-center">
                                      <div class="col-auto">
                                          <i class="feather icon-instagram f-34 text-c-green social-icon"></i>
                                      </div>
                                      <div class="col">
                                          <h6 class="m-b-0">Instagram</h6>
                                          <p>231.2w downloads</p>
                                          <p class="m-b-0">Lorem Ipsum is simply dummy text of the printing</p>
                                      </div>
                                  </div>
                              </div>
                              <a href="#!" class="download-icon"><i class="feather icon-arrow-down"></i></a>
                          </div>
                      </div>
                      <!-- social download  end -->

                  </div>
              </div>
          </div>

          <div id="styleSelector">

          </div>
      </div>
  </div>
</div> 
      
@endsection