@extends('backend.layouts.main')
@section('title', 'Tour-booking-update')

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
                                        <h4>Update Tour Booking</h4>
                                        <span>You can update tour booking</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="page-header-breadcrumb">
                                    <ul class="breadcrumb-title">
                                        <li class="breadcrumb-item">
                                            <a href="{{route('dashboard')}}"> <i class="feather icon-home"></i> </a>
                                        </li>
                                        <li class="breadcrumb-item"><a href="{{route('tour-bookings.index')}}">Tour Booking</a>
                                        </li>
                                        <li class="breadcrumb-item"><a href="">update</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Page-header end -->


                    <!-- Page body start -->
                    <div class="page-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <!-- Product edit card start -->
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Booking Ref | <span class="badge badge-primary text-white"> {{ $query->ref_code }}  </span></h5>

                                        <h5 class="float-right">Booking By | <span class="badge badge-primary text-white"> {{ ucfirst($query->user->name) .' ( '. $query->user->email .' )'}}  </span></h5>
                                    </div>
                                    <div class="card-block">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="product-edit">
                                                    <ul class="nav nav-tabs nav-justified md-tabs " role="tablist">
                                                        <li class="nav-item">
                                                            <a class="nav-link active" data-toggle="tab" href="#home7"
                                                                role="tab">
                                                                <div class="f-20">
                                                                    <i class="icofont icofont-edit"></i>
                                                                </div>
                                                                Booking Information
                                                            </a>
                                                   
                                                        </li>

                                                    </ul>
                                                    <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active" id="home7" role="tabpanel">
                                        <form class="md-float-material card-block" action="{{route('tour-bookings.update',$query->id)}}" method="post">
                                          @method('PATCH')
                                          @csrf
                                          <div class="row">
                                            <div class="col-sm-8">
                                                <label for="">Package Name</label>

                                                <div class="input-group">
                                                    <span class="input-group-addon"><i
                                                            class="icofont icofont-ui-user"></i></span>
                                                    <input type="text" class="form-control"
                                                        placeholder="Package Name" name="package_name" value="{{old('package_name',$query->package->package_name)}}" readonly>
                                                </div>
                                              
                                                </div>
                                            <div class="col-sm-4">
                                                <label for="">Category</label>

                                                <div class="input-group">
                                                    <span class="input-group-addon"><i
                                                            class=" fa fa-map-marker"></i></span>
                                                    <input type="text" class="form-control"
                                                        placeholder="Category Name" name="category_name" value="{{old('category_name',$query->package->packageCategory->package_category_name)}}" readonly>
                                                </div>
                                                
                                                </div>
                                               

                                                    <div class="col-sm-4">
                                                        <label for="">Booking Date Time </label>
        
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i
                                                                    class="fa fa-calendar-check-o"></i></span>
                                                            <input type="text" class="form-control"
                                                                name="date" value="{{old('date',$query->created_at->format('M-d-Y h:i a'))}}" autocomplete="off" readonly>
                                                        </div>
                                                       
                                                        </div>

                                                            <div class="col-sm-4">
                                                                <label for="">Payment Status</label>
                                                                <select name="payment_status"
                                                                    class="form-control form-control-primary">
                                                                    <option value="">Select Status
                                                                    </option>
                                                                    <option value="pending" {{$query->payment_status=='pending'? 'selected' : ''}}>Pending</option>
                                                                    <option value="completed" {{$query->payment_status=='completed'? 'selected' : ''}}>Completed</option>
                    
                    
                                                                </select>
                                                                <x-input-error :messages="$errors->get('payment_status')" class="mt-2" />
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label for="">Booking Status</label>
                                                                <select name="booking_status"
                                                                    class="form-control form-control-primary">
                                                                    <option value="">Select Status
                                                                    </option>
                                                                    <option value="pending" {{$query->booking_status=='pending'? 'selected' : ''}}>Pending</option>
                                                                    <option value="confirmed" {{$query->booking_status=='confirmed'? 'selected' : ''}}>Confirmed</option>

                                                                    <option value="canceled" {{$query->booking_status=='canceled'? 'selected' : ''}}>Canceled</option>
                    
                    
                                                                </select>
                                                                <x-input-error :messages="$errors->get('booking_status')" class="mt-2" />
                                                            </div>
                                                           
                                                            <div class="col-sm-3">
                                                                <label for="">Payment Method</label>
                
                                                                <div class="input-group">
                                                                    <span class="input-group-addon"><i
                                                                            class=" icofont icofont-ui-user"></i></span>
                                                                    <input type="text" class="form-control"
                                                                        placeholder="Payment Method" name="payment_method" value="{{old('payment_method',$query->payment_method)}}" >
                                                                </div>
                                                                <x-input-error :messages="$errors->get('payment_method')" class="mt-2" />
                                                                </div>
                                                
                                                            <div class="col-sm-3">
                                                                <label for="">Trx-Id </label>
                                                                <div class="input-group">
                                                                    <span class="input-group-addon"><i
                                                                            class="icofont icofont-ui-user"></i></span>
                                                                    <input type="text" class="form-control"
                                                                        placeholder="Trx Id" name="trx_id" value="{{old('trx_id',$query->trx_id)}}" >
                                                                </div>
                                                                <x-input-error :messages="$errors->get('trx_id')" class="mt-2" />

                                                            </div>
                                                            <div class="col-sm-3">
                                                                <label for="">Paid </label>
                                                                <div class="input-group">
                                                                    <span class="input-group-addon"><i
                                                                            class="icofont icofont-ui-user"></i></span>
                                                                    <input type="text" class="form-control"
                                                                        placeholder="Paid Amount" name="paid_amount" value="{{old('paid_amount',$query->paid_amount)}}">
                                                                </div>
                                                                <x-input-error :messages="$errors->get('paid_amount')" class="mt-2" />

                                                            </div>

                                                            <div class="col-sm-3">
                                                                <label for="">Currency </label>
                                                                <div class="input-group">
                                                                    <span class="input-group-addon"><i
                                                                            class="icofont icofont-ui-user"></i></span>
                                                                    <input type="text" class="form-control"
                                                                        placeholder="Currency" name="currency" value="{{old('currency',$query->currency)}}">
                                                                </div>
                                                                <x-input-error :messages="$errors->get('currency')" class="mt-2" />

                                                            </div>
                                                           
                                                           
                                                            </div>
                                          
                                        </div>
                                           
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="text-center m-t-20">
                                                        <button type="submit"
                                                            class="btn btn-primary waves-effect waves-light m-r-10 btn-spinner">Save
                                                        </button>
                                                        <a href="{{route('tour-bookings.index')}}"
                                                            class="btn btn-warning waves-effect waves-light btn-spinner">Discard
                                                      </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Product edit card end -->
                            </div>

                        </div>
                    </div>
                    <!-- Page body end -->
                </div>
            </div>
            <!-- Main-body end -->
            <div id="styleSelector">

            </div>
        </div>
    </div>
    <script type="text/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#db_user_image_upload').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

        <script>
          $(function() {
            $('input[name="expiry_date"]').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                timePicker: true, // Enable time picker
                timePickerIncrement: 1, // Time increment in minutes
                timePicker24Hour:true,
                minDate: moment(), // Set the minimum date to today
                locale: {
                    format: 'YYYY-MM-DD HH:mm' // Format the date as YYYY-MM-DD HH:mm
                },
                autoApply: true,
            });
        });

        </script>
@endsection
