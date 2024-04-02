 @extends('backend.layouts.main')
@section('title', 'Property-create')

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
                                        <h4>Create Property </h4>
                                        <span>You can create property from here</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="page-header-breadcrumb">
                                    <ul class="breadcrumb-title">
                                        <li class="breadcrumb-item">
                                            <a href="{{route('dashboard')}}"> <i class="feather icon-home"></i> </a>
                                        </li>
                                        <li class="breadcrumb-item"><a href="#">Property</a>
                                        </li>
                                        <li class="breadcrumb-item"><a href="">Create</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Page-header end -->


                    <!-- Page body start -->
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
                        <div class="row">
                            <div class="col-sm-12">
                                <!-- Product edit card start -->
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Property Information</h5>
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
                                                                Property Information
                                                            </a>
                                                   
                                                        </li>

                                                    </ul>
                                                    <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active" id="home7" role="tabpanel">

                                    <form action="{{route('properties.store')}}" method="post" enctype="multipart/form-data">
                                          @csrf

                                         <!-- Image upload card start -->
                                        <div class="card">
                                          
                                            <div class="card-header">
                                                <h5>Image Upload</h5>
    
                                            </div>
                                            <div class="card-block">
                                                <div class="sub-title">Add Hotel Images</div>
                                                <input type="file" name="images[]" id="filer_input" multiple="multiple">
                                            </div>
                                        </div>
                                        <!-- Image upload card end -->

                                            <div class="row mt-2">
                                                <div class="col-sm-6">
                                                    <label for="">Property Title</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="icofont icofont-ui-user"></i></span>
                                                        <input type="text" class="form-control"
                                                            placeholder="Property Title" name="title" value="{{old('title')}}">
                                                    </div>
                                                    <x-input-error :messages="$errors->get('title')" class="mt-2" />

                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="">Type</label>
                                                    <select name="type"
                                                        class="form-control form-control-primary">

                                                        <option value="hotel">Hotel</option>
                                                        <option value="villa">Villa</option>
                                                        <option value="apartment">Apartment</option>
                                                        <option value="guest house">Guest House</option>

                                                    </select>
                                                    <x-input-error :messages="$errors->get('type')" class="mt-2" />
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="">Location</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="fa fa-map-marker"></i></span>
                                                        <input type="text" class="form-control"
                                                            placeholder="Location" name="location" value="{{old('location')}}">
                                                    </div>
                                                    <x-input-error :messages="$errors->get('location')" class="mt-2" />

                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="">Cordinates <span class="text-primary">(seperate coordinates by comma.)</span></label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="fa fa-map-marker"></i></span>
                                                        <input type="text" class="form-control"
                                                            placeholder="Cordinates" name="cordinates" value="{{old('cordinates')}}">
                                                    </div>
                                                    <x-input-error :messages="$errors->get('cordinates')" class="mt-2" />

                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="">Price Per Night</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="fa fa-dollar"></i></span>
                                                        <input type="text" class="form-control"
                                                            placeholder="Per night Price for standard room" name="price_per_night" value="{{old('price_per_night')}}">
                                                    </div>
                                                    <x-input-error :messages="$errors->get('price_per_night')" class="mt-2" />

                                                </div>

                                                <div class="col-sm-4">
                                                    <label for="">Cancellation Charges <span class="text-primary">( if any)</span></label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="icofont icofont-ui-user"></i></span>
                                                        <input type="text" class="form-control"
                                                            placeholder="Cancellation Charges " name="cancellation_charges" value="{{old('cancellation_charges')}}">
                                                    </div>
                                                    <x-input-error :messages="$errors->get('cancellation_charges')" class="mt-2" />

                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="">Payment Type</label>
                                                    <select name="payment_allowed"
                                                        class="form-control form-control-primary">

                                                        <option value="cash">Cash</option>
                                                        <option value="card">Cards</option>
                                                        <option value="both">Both</option>

                                                    </select>
                                                    <x-input-error :messages="$errors->get('payment_allowed')" class="mt-2" />
                                                </div>

                                                <div class="col-sm-4">
                                                    <label for="">Check In Time</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="fa fa-clock-o"></i></span>
                                                        <input type="text" class="form-control hour"
                                                            placeholder="hh:mm:ss" name="check_in_time" value="{{old('check_in_time')}}" data-mask="99:99:99">
                                                    </div>
                                                    <x-input-error :messages="$errors->get('check_in_time')" class="mt-2" />

                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="">Check Out Time</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="fa fa-clock-o"></i></span>
                                                        <input type="text" class="form-control hour"
                                                            placeholder="hh:mm:ss" name="check_out_time" value="{{old('check_out_time')}}" data-mask="99:99:99">
                                                    </div>
                                                    <x-input-error :messages="$errors->get('check_out_time')" class="mt-2" />

                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="">Select Status</label>
                                                    <select name="status"
                                                        class="form-control form-control-primary">
                                                        <option value="inactive">Inactive</option>
                                                        <option value="active">Active</option>
                                                    </select>
                                                    <x-input-error :messages="$errors->get('status')" class="mt-2" />
                                                </div>
                                            <div class="col-sm-12">
                                                <textarea rows="5" cols="5" class="form-control" placeholder="Description about property" name="description"></textarea>
                                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                                            </div>
                                        </div>

                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="text-center m-t-20">
                                                        <button type="submit"
                                                            class="btn btn-primary waves-effect waves-light m-r-10 btn-spinner">Save
                                                        </button>
                                                        <a href="{{route('properties.index')}}"
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
@endsection
