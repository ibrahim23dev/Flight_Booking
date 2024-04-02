@extends('backend.layouts.main')
@section('title', 'Payment-methods')

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
                                  <h4>All Payment Methods</h4>
                                  <span>List of payment methods</span>
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
                                  <li class="breadcrumb-item"><a href="">payments methods</a>
                                  </li>
                              </ul>
                          </div>
                      </div>
                      
                  </div>
                  <a href="{{route('payment-methods.create')}}" class="btn btn-primary adn-50 adn-right float-right mt-3">
                    <i class="icofont icofont-plus"></i>Create New  
                  </a>
              </div>
              <!-- Page-header end -->
                  
                  <div class="page-body">
                   
                    {{-- <div class="card">
                      <div class="card-header">
                          <h5 class="card-header-text">Payment Methods</h5>
                      </div>
                      <div class="card-block contact-details">
                          <div class="data_table_main table-responsive dt-responsive">
                              <table id="simpletable" class="table  table-striped table-bordered nowrap">
                                  <thead>
                                      <tr>
                                          <th>#</th>
                                          <th>Identity</th>
                                          <th>Agent</th>
                                          <th>Shop id</th>
                                          <th>Last Updated</th>
                                          <th>Status</th>
                                          <th>Action</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                    @foreach ($payments as $key=> $method)
                                        
                                      <tr>
                                          <td>{{$key+1}}</td>
                                          <td>{{$method->identity}}</td>
                                          <td>{{$method->agent}}</td>
                                          <td>{{$method->shop_id}}</td>
                                          <td>{{$method->updated_at}}</td>
                                          <td><span class="badge badge-{{$method->status=='active'? 'primary': 'danger'}} badge-pill">{{$method->status}}</span></td>
                                          <td class="dropdown">
                                              <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></button>
                                              <div class="dropdown-menu dropdown-menu-right b-none contact-menu">
                                                  <a class="dropdown-item" href="{{route('payment-methods.edit',$method->id)}}"><i class="icofont icofont-edit"></i>Edit</a>
                                                  <form action="{{route('payment-methods.destroy',$method->id)}}" method="post" onsubmit="return confirm('Are you sure to delete')">
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
                  </div> --}}
                  <div class="row">
                @foreach ($payments as $key=> $method)

                    <div class="col-md-6 col-xl-4">
                                
                        <div class="card widget-card-1">
                            <div class="card-block-small">
                                {{-- <i class=" bg-c-blue card1-icon"></i> --}}
                                <img src="{{ url('storage/'.$method->icon) }}" class="card1-icon">
                                <span class="text-c-blue f-w-600">{{ strtoupper($method->identity) }}</span>
                                <h6>{{$method->agent}}</h6>
                              
                                    <div class="row justify-content-between align-items-center">
                                        <div class="col-md-4 col-sm-6 d-flex justify-content-center">
                                            <div class="toggle-switch">
                                                <label for="cb-switch-{{ $method->id }}">
                                                  <input type="checkbox" id="cb-switch-{{ $method->id }}" class="switch-checkbox" {{$method->status=='active'? 'checked': ''}} data-id="{{ $method->id }}" data-action="{{ route('paymentMethodChangeStatus',$method->id) }}" >
                                                  <span>
                                                    <small></small>
                                                  </span>
                                                </label>
                                            </div>
                                        </div>
    
                                        <div class="col-md-4 col-sm-6 d-flex justify-content-center">
                                          
                                            <div class="dropdown">
                                                <button type="button" class="badge badge-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></button>
                                                <div class="dropdown-menu dropdown-menu-right b-none contact-menu">
                                                    <a class="dropdown-item" href="{{route('payment-methods.edit',$method->id)}}"><i class="icofont icofont-edit"></i>Edit</a>
                                                    <form action="{{route('payment-methods.destroy',$method->id)}}" method="post" onsubmit="return confirm('Are you sure to delete')">
                                                    @csrf
                                                    @method('DELETE')
  
                                                    <button class="dropdown-item"><i class="icofont icofont-ui-delete"></i>Delete</button>
                                                    </form>
  
                                                </div>
                                            </div>
                                          
                                        </div>
                                      
                                        
                                    </div>
                                
                            </div>
                        </div>
                    </div>
                 @endforeach
                    
                </div>
                  </div>
              </div>
          </div>
          <!-- Warning Section Starts -->
          <div id="styleSelector">

          </div>
      </div>
  </div> 

  <script>
$(document).ready(function() {
    $('.switch-checkbox').on('change', function() {
        var methodId = $(this).data('id');
        var status = this.checked ? 'active' : 'inactive';
        var action = $(this).data('action');
        // Get the CSRF token from the meta tag
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        // Make an Ajax request to update the status
        $.ajax({
            method: 'POST',
            url: action,
            data: { status: status },
            headers: {
                'X-CSRF-TOKEN': csrfToken,
            },
            success: function(response) {
                // Handle the response
                    if (response.success) {
                   showToast('success',response.message);
                }else{
                   showToast('error',response.message);

                }
            },
            error: function(xhr, status, error) {
               
                // You can also log additional error details if needed.
                showToast('error',xhr.responseJSON.message);

            }
        });


    });

    function showToast(type, message) {
            const toastMain = document.getElementById('toast_ajax');
            const toastHeader = toastMain.querySelector('.toast-header');
            const toastBody = toastMain.querySelector('.toast-body');

            // Set the appropriate classes and message based on the type
            if (type == 'success') {
                toastMain.classList.remove('bg-danger','hide');
                toastMain.classList.add('bg-success', 'show');
                toastHeader.querySelector('.error-heading').textContent = 'Success';
            } else if (type == 'error') {
                toastMain.classList.remove('bg-success','hide');
                toastMain.classList.add('bg-danger', 'show');
                toastHeader.querySelector('.error-heading').textContent = 'Error';
            } else {
                // Hide the toast if the type is not 'success' or 'error'
                toastMain.classList.remove('show');
                toastMain.classList.add('hide');
            }

            // Set the message in the toast body
            toastBody.textContent = message;

            // Show the toast for a few seconds
            setTimeout(() => {
                toastMain.classList.remove('show');
                toastMain.classList.add('hide');
            }, 8000); // Adjust the delay as needed
        }
});


  </script>
            <div class="toast hide" role="alert" aria-live="assertive" aria-atomic="true" id="toast_ajax" >
                <i class="fa fa-times close-icon-toast"></i>
                <div class="toast-header">
                   
                  <strong class="me-auto error-heading">
                   
                    </strong>
                  <small>Just Now</small>
                  
                </div>
                <div class="toast-body">
                   
                </div>
            </div>
  @endsection
