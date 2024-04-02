@extends('backend.layouts.main')
@section('title', 'Flight-booking-update')

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
                                        <h4>Update Flight Booking</h4>
                                        <span>You can update flight booking</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="page-header-breadcrumb">
                                    <ul class="breadcrumb-title">
                                        <li class="breadcrumb-item">
                                            <a href="{{route('dashboard')}}"> <i class="feather icon-home"></i> </a>
                                        </li>
                                        <li class="breadcrumb-item"><a href="{{route('promo-codes.index')}}">Flight Booking</a>
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
                                        <h5>Booking Ref | <span class="badge badge-primary text-white"> {{ $query->pnr_no }}  </span></h5>

                                        <h5 class="float-right">Booking By | <span class="badge badge-primary text-white"> {{ ucfirst($query->user->name) .' ( '. $query->user->email .' )'}}  </span></h5>

                                        <h5 class="float-right">Contact | <span class="badge badge-primary text-white"> {{ ucfirst($query->contact_no) .' ( '. $query->email .' )'}}  </span></h5>

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
                                        <form class="md-float-material card-block" action="{{route('flight.update',$query->id)}}" method="post">
                                          @method('PATCH')
                                          @csrf
                                          <div class="row">
                                            <div class="col-sm-3">
                                                <label for="">Airline</label>

                                                <div class="input-group">
                                                    <span class="input-group-addon"><i
                                                            class="icofont icofont-ui-user"></i></span>
                                                    <input type="text" class="form-control"
                                                        placeholder="Airline" name="company" value="{{old('company',$query->company)}}">
                                                </div>
                                                <x-input-error :messages="$errors->get('company')" class="mt-2" />
                                                </div>
                                            <div class="col-sm-3">
                                                <label for="">Destinations</label>

                                                <div class="input-group">
                                                    <span class="input-group-addon"><i
                                                            class=" fa fa-map-marker"></i></span>
                                                    <input type="text" class="form-control"
                                                        placeholder="Destinations" name="destinations" value="{{old('destinations',$query->destinations)}}">
                                                </div>
                                                <x-input-error :messages="$errors->get('destinations')" class="mt-2" />
                                                </div>
                                               

                                                    <div class="col-sm-3">
                                                        <label for="">Dep Date </label>
        
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i
                                                                    class="fa fa-calendar-check-o"></i></span>
                                                            <input type="date" class="form-control"
                                                                placeholder="Dep Date" name="departure_date" value="{{old('departure_date',$query->departure_date)}}" autocomplete="off">
                                                        </div>
                                                        <x-input-error :messages="$errors->get('departure_date')" class="mt-2" />
                                                        </div>

                                                        <div class="col-sm-3">
                                                            <label for="">Ret Date </label>
            
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i
                                                                        class="fa fa-calendar-check-o"></i></span>
                                                                <input type="date" class="form-control"
                                                                    placeholder="RetDate" name="return_date" value="{{old('return_date',$query->return_date)}}" autocomplete="off">
                                                            </div>
                                                            <x-input-error :messages="$errors->get('return_date')" class="mt-2" />
                                                            </div>

                                                            <div class="col-sm-3">
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
                                                            <div class="col-sm-3">
                                                                <label for="">Payment Method</label>
                
                                                                <div class="input-group">
                                                                    <span class="input-group-addon"><i
                                                                            class=" icofont icofont-ui-user"></i></span>
                                                                    <input type="text" class="form-control"
                                                                        placeholder="Payment Method" name="payment_method" value="{{old('payment_method',$query->payment_method)}}" disabled>
                                                                </div>
                                                                <x-input-error :messages="$errors->get('destinations')" class="mt-2" />
                                                                </div>
                                                
                                                            <div class="col-sm-4">
                                                                <label for="">Trx-Id </label>
                                                                <div class="input-group">
                                                                    <span class="input-group-addon"><i
                                                                            class="icofont icofont-ui-user"></i></span>
                                                                    <input type="text" class="form-control"
                                                                        placeholder="Trx Id" name="trx_id" value="{{old('trx_id',$query->trx_id)}}" disabled>
                                                                </div>
                                                                <x-input-error :messages="$errors->get('trx_id')" class="mt-2" />

                                                            </div>
                                                            <div class="col-sm-2">
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
                                                                <label for="">Ticket Status</label>
                                                                <select name="ticket_status"
                                                                    class="form-control form-control-primary">
                                                                    <option value="">Select Status
                                                                    </option>
                                                                    <option value="processing" {{$query->ticket_status=='processing'? 'selected' : ''}}>Processing</option>
                                                                    <option value="issued" {{$query->ticket_status=='issued'? 'selected' : ''}}>issued</option>

                                                                    <option value="canceled" {{$query->ticket_status=='canceled'? 'selected' : ''}}>Canceled</option>
                    
                    
                                                                </select>
                                                                <x-input-error :messages="$errors->get('ticket_status')" class="mt-2" />
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <label for="">Ticket No</label>
                
                                                                <div class="input-group">
                                                                    <span class="input-group-addon"><i
                                                                            class=" icofont icofont-ui-user"></i></span>
                                                                    <input type="text" class="form-control"
                                                                        placeholder="Ticket No" name="ticket_num" value="{{old('ticket_num',$query->ticket_num)}}">
                                                                </div>
                                                                <x-input-error :messages="$errors->get('ticket_num')" class="mt-2" />
                                                                </div>

                                                                <div class="col-sm-3">
                                                                    <label for="">Issue Date </label>
                    
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon"><i
                                                                                class="fa fa-calendar-check-o"></i></span>
                                                                        <input type="date" class="form-control"
                                                                            name="issued_from" value="{{old('issued_from',$query->issued_from)}}" autocomplete="off">
                                                                    </div>
                                                                    <x-input-error :messages="$errors->get('issued_from')" class="mt-2" />
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        <label for="">Trip Type</label>
                                                                        <select name="tripType"
                                                                            class="form-control form-control-primary">
                                                                            <option value="">Select Status
                                                                            </option>
                                                                            <option value="oneway" {{$query->tripType=='oneway'? 'selected' : ''}}>OneWay</option>
                                                                            <option value="round" {{$query->tripType=='round'? 'selected' : ''}}>Round</option>
        
                            
                                                                        </select>
                                                                        <x-input-error :messages="$errors->get('tripType')" class="mt-2" />
                                                                    </div>

                                                                    <div class="col-sm-3">
                                                                        <label for="">Api Used</label>
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon"><i
                                                                                    class="icofont icofont-ui-user"></i></span>
                                                                            <input type="text" class="form-control"
                                                                                placeholder="Paid Amount" name="api_used" value="{{old('api_used',$query->api_used)}}" disabled>
                                                                        </div>
                                                                        <x-input-error :messages="$errors->get('api_used')" class="mt-2" />
        
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        <label for="">Api Status</label>
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon"><i
                                                                                    class="icofont icofont-ui-user"></i></span>
                                                                            <input type="text" class="form-control"
                                                                                name="api_status" value="{{old('api_status',$query->api_status)}}" disabled>
                                                                        </div>
                                                                        <x-input-error :messages="$errors->get('api_status')" class="mt-2" />
        
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        <label for="">Bags</label>
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon"><i
                                                                                    class="icofont icofont-ui-user"></i></span>
                                                                            <input type="text" class="form-control"
                                                                                name="bags" value="{{old('bags',$query->bags)}}" placeholder="bags">
                                                                        </div>
                                                                        <x-input-error :messages="$errors->get('bags')" class="mt-2" />
        
                                                                    </div>
                                                                    <!--passport-->
                                                                    
                                                            </div>
                                          
                                        </div>
                                           
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="text-center m-t-20">
                                                        <button type="submit"
                                                            class="btn btn-primary waves-effect waves-light m-r-10 btn-spinner">Save
                                                        </button>
                                                        <a href="{{route('flight.index')}}"
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

                            <div class="row">
                                <div class="col-sm-12">
                                    <!-- Product edit card start -->
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Booking Ref | <span class="badge badge-primary text-white"> {{ $query->pnr_no }}  </span></h5>
    
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
                                                                    Passengers Information
                                                                </a>
                                                       
                                                            </li>
    
                                                        </ul>
                                                        <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="home7" role="tabpanel">
                                            <form class="md-float-material card-block" action="{{route('/update-passengers',$query->id)}}" method="post">
                                              @method('POST')
                                              @csrf
                                             @foreach ($query->passengers as $pKey=> $passenger)
                                             
                                                <input type="hidden" name="passenger_ids[]" value="{{ $passenger['id'] }}">

                                              <div class="row">

                                                <div class="col-sm-2">
                                                    <label for="">Title</label>
                                                    <select name="title[]"
                                                        class="form-control form-control-primary">
                                                        <option value="">Select Status
                                                        </option>
                                                        <option value="Mr" {{$passenger->title=='Mr' ?'selected':''}}>Mr.</option>
                                                        <option value="Mrs"  {{$passenger->title=='Mrs' ?'selected':''}}>Mrs.</option>
                                                        <option value="Miss"  {{$passenger->title=='Miss' ?'selected':''}}>Miss.</option>

        
                                                    </select>
                                                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                                                </div>
                                                <div class="col-sm-2">
                                                    <label for="">Type</label>
    
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="icofont icofont-ui-user"></i></span>
                                                        <input type="text" class="form-control"
                                                            placeholder="Pax Type" name="passType[]" value="{{old('passType',$passenger->passType)}}" readonly>
                                                    </div>
                                                    
                                                    </div>
                                                <div class="col-sm-4">
                                                    <label for="">Name</label>
    
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="icofont icofont-ui-user"></i></span>
                                                        <input type="text" class="form-control"
                                                            placeholder="Name" name="name[]" value="{{old('name',$passenger->name)}}">
                                                    </div>
                                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                                    </div>
                                                   
                                                    <div class="col-sm-4">
                                                        <label for="">Sur-Name</label>
        
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i
                                                                    class="icofont icofont-ui-user"></i></span>
                                                            <input type="text" class="form-control"
                                                                placeholder="Surname" name="surname[]" value="{{old('surname',$passenger->surname)}}">
                                                        </div>
                                                        <x-input-error :messages="$errors->get('surname')" class="mt-2" />
                                                    </div>
    
                                                    <div class="col-sm-2">
                                                        <label for="">Gender</label>
                                                        <select name="gender[]"
                                                            class="form-control form-control-primary">
                                                            <option value="">Gender
                                                            </option>
                                                            <option value="male" {{$passenger->gender=='male'? 'selected' : ''}}>Male</option>
                                                            <option value="female" {{$passenger->gender=='female'? 'selected' : ''}}>Female</option>
                                                          
                                                        </select>
                                                        <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label for="">Contact No</label>
        
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i
                                                                    class="icofont icofont-ui-user"></i></span>
                                                            <input type="text" class="form-control"
                                                                placeholder="Contact No" name="contact_no[]" value="{{old('contact_no',$passenger->contact_no)}}">
                                                        </div>
                                                        <x-input-error :messages="$errors->get('contact_no')" class="mt-2" />
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label for="">Date Of Birth </label>
        
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i
                                                                    class="fa fa-calendar-check-o"></i></span>
                                                            <input type="date" class="form-control"
                                                                name="dob[]" value="{{$passenger->dob}}" autocomplete="off">
                                                        </div>
                                                        <x-input-error :messages="$errors->get('dob')" class="mt-2" />
                                                        </div>
                                                          <div class="col-sm-4">
                                                        <label for="">Passport Number </label>
        
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i
                                                                    class="fa fa-card-check-o"></i></span>
                                                            <input type="text" class="form-control"
                                                                name="pidno[]" value="{{$passenger->pidno}}" autocomplete="off">
                                                        </div>
                                                        <x-input-error :messages="$errors->get('pidno')" class="mt-2" />
                                                        </div>
                                                          <div class="col-sm-4">
                                                        <label for="">Passport Expiry </label>
        
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i
                                                                    class="fa fa-card-check-o"></i></span>
                                                            <input type="text" class="form-control"
                                                                name="pied[]" value="{{$passenger->pied}}" autocomplete="off">
                                                        </div>
                                                        <x-input-error :messages="$errors->get('pied')" class="mt-2" />
                                                        </div>
                                                       
                                                        
                                                </div>
                                             @endforeach
                                              
                                              </div>
                                               
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="text-center m-t-20">
                                                            <button type="submit"
                                                                class="btn btn-primary waves-effect waves-light m-r-10 btn-spinner">Save
                                                            </button>
                                                            <a href="{{route('flight.index')}}"
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
