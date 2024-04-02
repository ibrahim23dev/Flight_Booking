@extends('backend.layouts.main')
@section('title', 'Inquiry-update')

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
                                        <h4>Update Flight Inquiry</h4>
                                        <span>You can update flight inquiry</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="page-header-breadcrumb">
                                    <ul class="breadcrumb-title">
                                        <li class="breadcrumb-item">
                                            <a href="{{route('dashboard')}}"> <i class="feather icon-home"></i> </a>
                                        </li>
                                        <li class="breadcrumb-item"><a href="{{route('booking-inquiry')}}">Flight Inquiry</a>
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
                                        <h5>Inquiry Date | <span class="badge badge-primary text-white"> {{ $query->created_at->format('M, d Y h:i a') }}  </span></h5>

                                        <h5 class="float-right">Viewed By | <span class="badge badge-primary text-white"> {{ ucfirst($query->viewedBy->name) .' ( '. $query->viewedBy->email .' )'}}  </span></h5>
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
                                                                Inquiry Information
                                                            </a>
                                                   
                                                        </li>

                                                    </ul>
                                                    <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active" id="home7" role="tabpanel">
                                            <form action="{{ route('booking-inquiry-update',$query->id) }}" method="post">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <label for="">Comment</label>
        
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i
                                                                    class="icofont icofont-ui-user"></i></span>
                                                            <input type="text" class="form-control"
                                                                placeholder="Comment" name="comment" value="{{old('comment',$query->comment)}}">
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                                <button type="submit"
                                                class="btn btn-primary waves-effect waves-light m-r-10 btn-spinner float-right">Save
                                            </button>
                                            </form>
                                          <div class="row">
                                            <div class="col-lg-3">
                                                <label for="">Name</label>

                                                <div class="input-group">
                                                    <span class="input-group-addon"><i
                                                            class="icofont icofont-ui-user"></i></span>
                                                    <input type="text" class="form-control"
                                                        placeholder="Name" name="company" value="{{old('name',$query->name)}}">
                                                </div>
                                                
                                                </div>
                                                <div class="col-lg-3">
                                                    <label for="">Email</label>
    
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="icofont icofont-ui-user"></i></span>
                                                        <input type="text" class="form-control"
                                                            placeholder="Email" name="email" value="{{old('email',$query->email)}}">
                                                    </div>
                                                    
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <label for="">Mobile</label>
        
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i
                                                                    class="icofont icofont-ui-user"></i></span>
                                                            <input type="text" class="form-control"
                                                                placeholder="Mobile" name="mobile" value="{{old('mobile',$query->mobile)}}">
                                                        </div>
                                                        
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <label for="">Status</label>
                                                            <select name="tripType"
                                                                class="form-control form-control-primary">
                                                               
                                                                <option value="oneway" {{$query->status=='active'? 'selected' : ''}}>Active</option>
                                                                <option value="inactive" {{$query->status=='inactive'? 'selected' : ''}}>Inactive</option>

                
                                                            </select>
                                                          
                                                        </div>
                                            <div class="col-lg-6">
                                                <label for="">Departure</label>

                                                <div class="input-group">
                                                    <span class="input-group-addon"><i
                                                            class=" fa fa-map-marker"></i></span>
                                                    <input type="text" class="form-control"
                                                        placeholder="Departure" name="departure_full" value="{{old('departure_full',$query->departure_full)}}">
                                                </div>
                                               
                                                </div>
                                                <div class="col-lg-6">
                                                    <label for="">Arrival</label>
    
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class=" fa fa-map-marker"></i></span>
                                                        <input type="text" class="form-control"
                                                            placeholder="Arrival" name="arrival_full" value="{{old('arrival_full',$query->arrival_full)}}">
                                                    </div>
                                                   
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

                                                            <div class="col-lg-2">
                                                                <label for="">Adult </label>
                
                                                                <div class="input-group">
                                                                    <span class="input-group-addon"><i
                                                                            class="fa fa-calendar-check-o"></i></span>
                                                                    <input type="text" class="form-control"
                                                                        placeholder="Adult" name="adult" value="{{old('adult',$query->adult)}}" autocomplete="off">
                                                                </div>
                                                               
                                                                </div>
                                                                <div class="col-lg-2">
                                                                    <label for="">Child </label>
                    
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon"><i
                                                                                class="fa fa-calendar-check-o"></i></span>
                                                                        <input type="text" class="form-control"
                                                                            placeholder="Child" name="child" value="{{old('child',$query->child)}}" autocomplete="off">
                                                                    </div>
                                                                   
                                                                    </div>
                                                                    <div class="col-lg-2">
                                                                        <label for="">Infant </label>
                        
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon"><i
                                                                                    class="fa fa-calendar-check-o"></i></span>
                                                                            <input type="text" class="form-control"
                                                                                placeholder="Infant" name="infant" value="{{old('infant',$query->infant)}}" autocomplete="off">
                                                                        </div>
                                                                       
                                                                        </div>
                                                           
                                                               
                                                                    <div class="col-sm-3">
                                                                        <label for="">Trip Type</label>
                                                                        <select name="tripType"
                                                                            class="form-control form-control-primary">
                                                                            <option value="">Select Status
                                                                            </option>
                                                                            <option value="oneway" {{$query->return_date==''? 'selected' : ''}}>OneWay</option>
                                                                            <option value="round" {{$query->return_date!=''? 'selected' : ''}}>Round</option>
        
                            
                                                                        </select>
                                                                       
                                                                    </div>

                                                                    <div class="col-lg-3">
                                                                        <label for="">Travel Class  </label>
                        
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon"><i
                                                                                    class="fa fa-calendar-check-o"></i></span>
                                                                            <input type="text" class="form-control"
                                                                                placeholder="Travel Class " name="travel_class" value="{{old('travel_class',$query->travel_class)}}" autocomplete="off">
                                                                        </div>
                                                                       
                                                                        </div>

                                                            </div>
                                          
                                        </div>
                                           
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="text-center m-t-20">
                                                      
                                                        <a href="{{route('booking-inquiry')}}"
                                                            class="btn btn-warning waves-effect waves-light btn-spinner">Back
                                                      </a>
                                                    </div>
                                                </div>
                                            </div>
                                        
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
