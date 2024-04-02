@extends('backend.layouts.main')
@section('title', 'Room-create')

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
                                        <h4>Create Room for: {{$property->title}}</h4>
                                        <span>You can create room from here</span>
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
                                        <li class="breadcrumb-item"><a href="">Rooms</a>
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
                                        <h5>Room Information</h5>
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
                                                                Room Information
                                                            </a>
                                                   
                                                        </li>

                                                    </ul>
                                                    <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active" id="home7" role="tabpanel">

                                    <form action="{{route('rooms.store',['property'=>$property->id])}}" method="post" enctype="multipart/form-data">
                                          @csrf

                                         <!-- Image upload card start -->
                                        <div class="card">
                                          
                                            <div class="card-header">
                                                <h5>Image Upload</h5>
    
                                            </div>
                                            <div class="card-block">
                                                <div class="sub-title">Add Room Images</div>
                                                <input type="file" name="images[]" id="filer_input" multiple="multiple">
                                            </div>
                                        </div>
                                        <!-- Image upload card end -->

                                            <div class="row mt-2">
                                                <div class="col-sm-6">
                                                    <label for="">Room Type (ex:Doube delux ,standard etc)</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="icofont icofont-ui-user"></i></span>
                                                        <input type="text" class="form-control"
                                                            placeholder="Room Type (ex:Doube delux ,standard etc)" name="type" value="{{old('type')}}">
                                                    </div>
                                                    <x-input-error :messages="$errors->get('type')" class="mt-2" />

                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="">Bed Type (ex:Doube ,standard etc)</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="icofont icofont-ui-user"></i></span>
                                                        <input type="text" class="form-control"
                                                            placeholder="Bed Type (ex:Doube ,standard etc)" name="bed_type" value="{{old('bed_type')}}">
                                                    </div>
                                                    <x-input-error :messages="$errors->get('bed_type')" class="mt-2" />

                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="">Price Per Night</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="fa fa-dollar"></i></span>
                                                        <input type="text" class="form-control"
                                                            placeholder="Per night Price for room" name="price" value="{{old('price')}}">
                                                    </div>
                                                    <x-input-error :messages="$errors->get('price')" class="mt-2" />

                                                </div>

                                                <div class="col-sm-4">
                                                    <label for="">Tax <span class="text-primary">( if any)</span></label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="icofont icofont-ui-user"></i></span>
                                                        <input type="text" class="form-control"
                                                            placeholder="Tax" name="tax" value="{{old('tax')}}">
                                                    </div>
                                                    <x-input-error :messages="$errors->get('tax')" class="mt-2" />

                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="">Break Fast <span class="text-primary">(Enter break fast conditions)</span></label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="icofont icofont-ui-user"></i></span>
                                                        <input type="text" class="form-control"
                                                            placeholder="Enter break fast conditions" name="breakfast" value="{{old('breakfast')}}">
                                                    </div>
                                                    <x-input-error :messages="$errors->get('breakfast')" class="mt-2" />

                                                </div>

                                                <div class="col-sm-4">
                                                    <label for="">Number of rooms</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="fa fa-dollar"></i></span>
                                                        <input type="text" class="form-control"
                                                            placeholder="Number of rooms" name="num_of_rooms" value="{{old('num_of_rooms')}}">
                                                    </div>
                                                    <x-input-error :messages="$errors->get('num_of_rooms')" class="mt-2" />

                                                </div>

                                                <div class="col-sm-4">
                                                    <label for="">Remaining rooms </label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="icofont icofont-ui-user"></i></span>
                                                        <input type="text" class="form-control"
                                                            placeholder="Remaining rooms" name="remaining_rooms" value="{{old('remaining_rooms')}}">
                                                    </div>
                                                    <x-input-error :messages="$errors->get('remaining_rooms')" class="mt-2" />

                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="">Room Dimensions </label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="icofont icofont-ui-user"></i></span>
                                                        <input type="text" class="form-control"
                                                            placeholder="Room Dimensions" name="room_size" value="{{old('room_size')}}">
                                                    </div>
                                                    <x-input-error :messages="$errors->get('room_size')" class="mt-2" />

                                                </div>
                                            <div class="col-sm-12">
                                                <textarea rows="5" cols="5" class="form-control" placeholder="Description about Room" name="description"></textarea>
                                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                                            </div>
                                        </div>

                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="text-center m-t-20">
                                                        <button type="submit"
                                                            class="btn btn-primary waves-effect waves-light m-r-10 btn-spinner">Save
                                                        </button>
                                                        <a href="{{route('rooms.index', ['property' => $property->id])}}"
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
