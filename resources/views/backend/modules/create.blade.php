@extends('backend.layouts.main')
@section('title', 'Module-create')

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
                                        <h4>Create Module</h4>
                                        <span>You can create new module from here</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="page-header-breadcrumb">
                                    <ul class="breadcrumb-title">
                                        <li class="breadcrumb-item">
                                            <a href="{{route('dashboard')}}"> <i class="feather icon-home"></i> </a>
                                        </li>
                                        <li class="breadcrumb-item"><a href="{{route('modules.index')}}">Modules</a>
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
                        <div class="row">
                            <div class="col-sm-12">
                                <!-- Product edit card start -->
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Create Module</h5>
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
                                                                Module Information
                                                            </a>
                                                   
                                                        </li>

                                                    </ul>
                                                    <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active" id="home7" role="tabpanel">
                                        <form class="md-float-material card-block" action="{{route('modules.store')}}" method="post" enctype="multipart/form-data">
                                          @method('POST')
                                          @csrf
                                          <div class="row p-t-10 p-b-10">
                                            <div class="col-lg-3 col-md-6 col-sm-12">
                                              
                                              <img src="#"
                                                  class="img-fluid width-100 m-b-20"
                                                  alt="img-edit" id="db_user_image_upload">
                                                
                                            </div>
                                            <div class="col-lg-9 col-md-6 col-sm-12">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i
                                                                    class="icofont icofont-all-caps"></i></span>
                                                            <input type="file"
                                                                class="form-control"
                                                                placeholder="Label Name" onchange="readURL(this)" name="image">
                                                        </div>
                                                     <x-input-error :messages="$errors->get('image')" class="mt-2" />
                                                      
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                            <div class="row mt-3">
                                                <div class="col-sm-6">
                                                    <label for="">Select Type</label>
                                                    <select name="type"
                                                        class="form-control form-control-primary">
                                                        <option value="">Select Type
                                                        </option>
                                                        <option value="flights">Flights</option>
                                                        <option value="hotels">Hotels</option>
                                                        <option value="cars">Cars</option>
                                                        <option value="tours">Tours</option>
                                                        <option value="activity">Activity</option>
  
                                                    </select>
                                                    <x-input-error :messages="$errors->get('type')" class="mt-2" />
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="">Status</label>
                                                    <select name="status"
                                                        class="form-control form-control-primary">
                                                        <option value="">Select Status
                                                        </option>
                                                        <option value="active">active
                                                        </option>                                                        <option value="inactive">inactive
                                                        </option>
  
                                                    </select>
                                                    <x-input-error :messages="$errors->get('status')" class="mt-2" />
                                                </div>

                                            </div>
                                            <div class="row">
                                               
                                               
                                                <div class="col-sm-12">
                                                    <label >Description</label>

                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="icofont icofont-ui-user"></i></span>
                                                        <input type="text" class="form-control"
                                                            placeholder="Description" name="description" value="{{old('description')}}">
                                                    </div>
                                                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="text-center m-t-20">
                                                        <button type="submit"
                                                            class="btn btn-primary waves-effect waves-light m-r-10 btn-spinner">Save
                                                        </button>
                                                        <a href="{{route('modules.index')}}"
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
