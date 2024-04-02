@extends('backend.layouts.main')
@section('title', 'Module-api-update')

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
                                        <h4>Update Module api settings</h4>
                                        <span>You can update module api setting from here</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="page-header-breadcrumb">
                                    <ul class="breadcrumb-title">
                                        <li class="breadcrumb-item">
                                            <a href="{{route('dashboard')}}"> <i class="feather icon-home"></i> </a>
                                        </li>
                                        <li class="breadcrumb-item"><a href="{{route('modules-apis.index')}}">Modules Apis</a>
                                        </li>
                                        <li class="breadcrumb-item"><a href="">Update</a>
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
                                        <h5>Update Module Api Settings</h5>
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
                                                                Module Api Information
                                                            </a>
                                                   
                                                        </li>

                                                    </ul>
                                                    <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active" id="home7" role="tabpanel">
                                        <form class="md-float-material card-block" action="{{route('modules-apis.update',$api->id)}}" method="post" enctype="multipart/form-data">
                                          @method('PATCH')
                                          @csrf
                                          <div class="row p-t-10 p-b-10">
                                            <div class="col-lg-3 col-md-6 col-sm-12">
                                              
                                              <img src="{{ asset('storage/images/modules/'.$api->image) }}"
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
                                                <div class="col-sm-12 col-md-4 col-lg-3">
                                                    <label for="">Select Module</label>
                                                    <select name="module"
                                                        class="form-control form-control-primary">
                                                        <option value="">Select Type
                                                        </option>
                                                        @foreach ($modules as $module)
                                                            
                                                        <option value="{{$module->id}}" {{$module->id==$api->module_id ? 'selected' : ''}}>{{ $module->type }}</option>

                                                        @endforeach

  
                                                    </select>
                                                    <x-input-error :messages="$errors->get('module')" class="mt-2" />
                                                </div>
                                                <div class="col-sm-12 col-md-4 col-lg-3">
                                                    <label for="">Status</label>
                                                    <select name="status"
                                                        class="form-control form-control-primary">
                                                        <option value="">Select Status
                                                        </option>
                                                        <option value="active" {{ $api->status=='active' ? 'selected' : '' }}>active
                                                        </option>                                                        <option value="inactive" {{ $api->status=='inactive' ? 'selected' : '' }}>inactive
                                                        </option>
  
                                                    </select>
                                                    <x-input-error :messages="$errors->get('status')" class="mt-2" />
                                                </div>
                                                <div class="col-sm-12 col-md-4 col-lg-3">
                                                    <label for="">Api Mode</label>
                                                    <select name="api_mode"
                                                        class="form-control form-control-primary">
                                                        <option value="">Select Api Mode
                                                        </option>
                                                        <option value="test" {{ $api->api_mode=='test' ? 'selected' : '' }}>Test
                                                        </option>                                                        <option value="live" {{ $api->api_mode=='live' ? 'selected' : '' }}>Live
                                                        </option>
  
                                                    </select>
                                                    <x-input-error :messages="$errors->get('api_mode')" class="mt-2" />
                                                </div>

                                                <div class="col-sm-12 col-md-4 col-lg-3">
                                                    <label >Api Name eg:amadeus</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="icofont icofont-user"></i></span>
                                                        <input type="text" class="form-control"
                                                            placeholder="Api Name" name="api_name" value="{{old('api_name',$api->api_name)}}">
                                                    </div>
                                                    <x-input-error :messages="$errors->get('api_name')" class="mt-2" />
                                                </div>

                                            </div>
                                            <h5>Live Api Credentials</h5>

                                            <div class="row">
                                               
                                                <div class=" col-sm-12 col-md-4">
                                                    <label >Api Key</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="icofont icofont-user"></i></span>
                                                        <input type="text" class="form-control"
                                                            placeholder="Api Key" name="api_key" value="{{old('api_key',$api->api_key)}}">
                                                    </div>
                                                    <x-input-error :messages="$errors->get('api_key')" class="mt-2" />
                                                </div>
                                                <div class=" col-sm-12 col-md-4">
                                                    <label >Api Secret</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="icofont icofont-user"></i></span>
                                                        <input type="text" class="form-control"
                                                            placeholder="Api Secret" name="api_secret" value="{{old('api_secret',$api->api_secret)}}">
                                                    </div>
                                                    <x-input-error :messages="$errors->get('api_secret')" class="mt-2" />
                                                </div>
                                                <div class=" col-sm-12 col-md-4">
                                                    <label >Api Endpoint/Url</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="icofont icofont-user"></i></span>
                                                        <input type="text" class="form-control"
                                                            placeholder="Api Endpoint" name="api_endpoint" value="{{old('api_endpoint',$api->api_endpoint)}}">
                                                    </div>
                                                    <x-input-error :messages="$errors->get('api_endpoint')" class="mt-2" />
                                                </div>
                                            </div>
                                            <h5>Test Api Credentials</h5>
                                            <div class="row">
                                               
                                                <div class=" col-sm-12 col-md-4">
                                                    <label >Api Test Key</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="icofont icofont-user"></i></span>
                                                        <input type="text" class="form-control"
                                                            placeholder="Api Test Key" name="api_test_key" value="{{old('api_test_key',$api->api_test_key)}}">
                                                    </div>
                                                    <x-input-error :messages="$errors->get('api_test_key')" class="mt-2" />
                                                </div>
                                                <div class=" col-sm-12 col-md-4">
                                                    <label >Api Test Secret</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="icofont icofont-user"></i></span>
                                                        <input type="text" class="form-control"
                                                            placeholder="Api Test Secret" name="api_test_secret_key" value="{{old('api_test_secret_key',$api->api_test_secret_key)}}">
                                                    </div>
                                                    <x-input-error :messages="$errors->get('api_test_secret_key')" class="mt-2" />
                                                </div>
                                                <div class=" col-sm-12 col-md-4">
                                                    <label >Api Test Endpoint/Url</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="icofont icofont-user"></i></span>
                                                        <input type="text" class="form-control"
                                                            placeholder="Api Test Endpoint" name="api_test_endpoint" value="{{old('api_test_endpoint',$api->api_test_endpoint)}}">
                                                    </div>
                                                    <x-input-error :messages="$errors->get('api_test_endpoint')" class="mt-2" />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="text-center m-t-20">
                                                        <button type="submit"
                                                            class="btn btn-primary waves-effect waves-light m-r-10 btn-spinner">Save
                                                        </button>
                                                        <a href="{{route('modules-apis.index')}}"
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
