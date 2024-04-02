@extends('backend.layouts.main')
@section('title', 'Google-Advertisements-update')

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
                                        <h4>Update Google Advertisements</h4>
                                        <span>You can update new google advertisement from here</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="page-header-breadcrumb">
                                    <ul class="breadcrumb-title">
                                        <li class="breadcrumb-item">
                                            <a href="{{route('dashboard')}}"> <i class="feather icon-home"></i> </a>
                                        </li>
                                        <li class="breadcrumb-item"><a href="{{route('google-ads.index')}}">Goolge Advertisements</a>
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
                                        <h5>Create Advertisements</h5>
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
                                                                Advertisements Information
                                                            </a>
                                                   
                                                        </li>

                                                    </ul>
                                                    <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active" id="home7" role="tabpanel">
                                        <form class="md-float-material card-block" action="{{route('google-ads.update',$ad->id)}}" method="post" enctype="multipart/form-data">
                                          @method('POST')
                                          @csrf 
                                          @method('PATCH')

                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label for=""> Ad Code </label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="icofont icofont-ui-user"></i></span>
                                                        <input type="text" class="form-control"
                                                            placeholder="Code of Ad" name="ad_code" value="{{old('ad_code',$ad->ad_code)}}">
                                                    </div>
                                                    <x-input-error :messages="$errors->get('ad_code')" class="mt-2" />

                                                </div>

                                            </div>

                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label for="">Select Position</label>
                                                    <select name="position"
                                                    class="form-control form-control-primary" >
                                                    <option value="">Select Position
                                                    </option>
                                                    <option value="top" {{$ad->position=='top' ? 'selected' : ''}}>Top</option>
                                                    <option value="bottom" {{$ad->position=='bottom' ? 'selected' : ''}}>Bottom</option>
                                                    <option value="left" {{$ad->position=='left' ? 'selected' : ''}}>Left</option>
                                                    <option value="right" {{$ad->position=='right' ? 'selected' : ''}}>Right</option>

                                                   </select>   
                                                        <x-input-error :messages="$errors->get('position')" class="mt-2" />
                                                    </div>
                                              <div class="col-sm-6">
                                                <label for="">Select Status</label>
                                                <select name="status"
                                                    class="form-control form-control-primary">
                                                    <option value="">Select Status
                                                    </option>
                                                    <option value="active" {{$ad->status=='active' ? 'selected' : ''}}>Active</option>
                                                    <option value="inactive" {{$ad->status=='inactive' ? 'selected' : ''}}>Inactive</option>


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
                                                        <a href="{{route('google-ads.index')}}"
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
