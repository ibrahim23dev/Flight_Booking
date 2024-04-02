@extends('backend.layouts.main')
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
                                        <h4>Create flight Package</h4>
                                        <span>You can create flight package from here</span>
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
                                        <li class="breadcrumb-item"><a href="">Create flight package</a>
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

                                    <form action="{{route('flight-packages.store')}}" method="post" enctype="multipart/form-data">
                                          @csrf

                                            <div class="row mt-2">
                                                <div class="col-lg-6">
                                                    <label for="">Airline Or Airport Name</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="icofont icofont-ui-user"></i></span>
                                                        <input type="text" class="form-control"
                                                            placeholder="Airline Or Airport Name" name="airline" value="{{old('airline')}}">
                                                    </div>
                                                    <x-input-error :messages="$errors->get('airline')" class="mt-2" />

                                                </div>
                                                <div class="col-lg-6">
                                                    <label for="">Type</label>
                                                    <select name="package_type"
                                                        class="form-control form-control-primary">

                                                        @foreach ($packages as $package)
                                                            <option value="{{$package->package_id}}">{{$package->package_type}}</option>
                                                        @endforeach

                                                    </select>
                                                    <x-input-error :messages="$errors->get('package_type')" class="mt-2" />
                                                </div>
                                                <div class="col-lg-4">
                                                    <label for="">Arrival (City)</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="icofont icofont-ui-user"></i></span>
                                                        <input type="text" class="form-control"
                                                            placeholder="Arrival City" name="arrival_city" value="{{old('arrival_city')}}">
                                                    </div>
                                                    <x-input-error :messages="$errors->get('arrival_city')" class="mt-2" />

                                                </div>
                                                <div class="col-lg-2">
                                                    <label for="">Package Price</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="fa fa-dollar"></i></span>
                                                        <input type="text" class="form-control"
                                                            placeholder="Package Price" name="price" value="{{old('price')}}">
                                                    </div>
                                                    <x-input-error :messages="$errors->get('price')" class="mt-2" />

                                                </div>
                                                <div class="col-lg-2">
                                                    <label for="">Currency</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="fa fa-dollar"></i></span>
                                                        <input type="text" class="form-control"
                                                            placeholder="Currency" name="currency" value="{{old('currency')}}">
                                                    </div>
                                                    <x-input-error :messages="$errors->get('currency')" class="mt-2" />

                                                </div>
                                                {{-- <div class="col-sm-6">
                                                    <label for="">Departure</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="icofont icofont-ui-user"></i></span>
                                                        <input type="text" class="form-control"
                                                            placeholder="Departure City" name="departure_city" value="{{old('departure_city')}}">
                                                    </div>
                                                    <x-input-error :messages="$errors->get('departure_city')" class="mt-2" />

                                                </div> --}}
                                               
                                                <div class="col-lg-2">
                                                    <label for="">Arrival (Iata Code)</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="icofont icofont-ui-user"></i></span>
                                                        <input type="text" class="form-control"
                                                            placeholder="Arrival IataCode" name="arrival_iataCode" value="{{old('arrival_iataCode')}}">
                                                    </div>
                                                    <x-input-error :messages="$errors->get('arrival_iataCode')" class="mt-2" />

                                                </div>
                                                <div class="col-lg-2">
                                                    <label for="">Status</label>
                                                    <select name="status"
                                                        class="form-control form-control-primary">

                                                            <option value="active">Active</option>
                                                            <option value="inactive">Inactive</option>
                                                       
                                                    </select>
                                                    <x-input-error :messages="$errors->get('status')" class="mt-2" />
                                                </div>
                                            </div>
         
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="text-center m-t-20">
                                                        <button type="submit"
                                                            class="btn btn-primary waves-effect waves-light m-r-10 btn-spinner">Save
                                                        </button>
                                                        <a href="{{route('flight-packages.index')}}"
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
