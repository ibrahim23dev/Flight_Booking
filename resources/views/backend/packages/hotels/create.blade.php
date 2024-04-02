 btn-spinner@extends('backend.layouts.main')
@section('title', 'Package-create')

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
                                        <h4>Create Hotel Package</h4>
                                        <span>You can create hotel package from here</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="page-header-breadcrumb">
                                    <ul class="breadcrumb-title">
                                        <li class="breadcrumb-item">
                                            <a href="{{route('dashboard')}}"> <i class="feather icon-home"></i> </a>
                                        </li>
                                        <li class="breadcrumb-item"><a href="#">Packages</a>
                                        </li>
                                        <li class="breadcrumb-item"><a href="">Create hotel package</a>
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
                                        <h5>Package Information</h5>
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
                                                                Package Information
                                                            </a>
                                                   
                                                        </li>

                                                    </ul>
                                                    <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active" id="home7" role="tabpanel">

                                    <form action="{{route('hotel-packages.store')}}" method="post" enctype="multipart/form-data">
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
                                                    <label for="">Hotel Name</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="icofont icofont-ui-user"></i></span>
                                                        <input type="text" class="form-control"
                                                            placeholder="Hotel Name" name="name" value="{{old('name')}}">
                                                    </div>
                                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />

                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="">Type</label>
                                                    <select name="package_type"
                                                        class="form-control form-control-primary">

                                                        @foreach ($packages as $package)
                                                            <option value="{{$package->package_id}}">{{$package->package_type}}</option>
                                                        @endforeach

                                                    </select>
                                                    <x-input-error :messages="$errors->get('package_type')" class="mt-2" />
                                                </div>

                                                <div class="col-sm-6">
                                                    <label for="">Price Per Night</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="fa fa-dollar"></i></span>
                                                        <input type="text" class="form-control"
                                                            placeholder="Package Price" name="price_per_night" value="{{old('price_per_night')}}">
                                                    </div>
                                                    <x-input-error :messages="$errors->get('price_per_night')" class="mt-2" />

                                                </div>

                                                <div class="col-sm-6">
                                                    <label for="">No of Rooms</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="icofont icofont-ui-user"></i></span>
                                                        <input type="text" class="form-control"
                                                            placeholder="No of Rooms" name="num_rooms" value="{{old('num_rooms')}}">
                                                    </div>
                                                    <x-input-error :messages="$errors->get('num_rooms')" class="mt-2" />

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

                                            </div>
         
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="text-center m-t-20">
                                                        <button type="submit"
                                                            class="btn btn-primary waves-effect waves-light m-r-10 btn-spinner">Save
                                                        </button>
                                                        <a href="{{route('hotel-packages.index')}}"
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
