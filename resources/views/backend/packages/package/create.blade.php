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
                                        <h4>Create Package</h4>
                                        <span>You can create package from here</span>
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

                                    <form action="{{route('packages.store')}}" method="post" enctype="multipart/form-data">
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
                                            <div class="row mt-2">
                                                <div class="col-sm-10">
                                                    <label for="">Package Name</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="icofont icofont-ui-user"></i></span>
                                                        <input type="text" class="form-control"
                                                            placeholder="Package Name" name="package_name" value="{{old('package_name')}}">
                                                    </div>
                                                    <x-input-error :messages="$errors->get('package_name')" class="mt-2" />

                                                </div>
                                                <div class="col-sm-2">
                                                    <label for="">Duration (Days)</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="icofont icofont-ui-user"></i></span>
                                                        <input type="number" class="form-control"
                                                            placeholder="Duration" name="duration" value="{{old('duration')}}">
                                                    </div>
                                                    <x-input-error :messages="$errors->get('duration')" class="mt-2" />

                                                </div>
                                                <div class="col-sm-3">
                                                    <label for="">Package Category</label>
                                                    <select name="package_category_id"
                                                        class="form-control form-control-primary">
                                                        <option value="">Select Category
                                                        </option>
                                                        @foreach ($packageCategories as $category)
                                                            
                                                        <option value="{{ $category->id }}">
                                                            {{ $category->package_category_name }}
                                                        </option>

                                                        @endforeach

                                                       
                                                    </select>
                                                    <x-input-error :messages="$errors->get('package_category_id  ')" class="mt-2" />
                                                </div>
                                                <div class="col-sm-3">
                                                    <label for="">Package Type</label>
                                                    <select name="package_type"
                                                        class="form-control form-control-primary">
                                                        <option value="">Select Type
                                                        </option>
                                                        <option value="business_tour">Business Tour
                                                        </option>
                                                        <option value="honeymoon">Honeymoon</option>
                                                        <option value="religious">Religious</option>
                                                        <option value="holidays">Holidays</option>
                                                        <option value="study_tour">Study tour</option>
                                                        <option value="tours_sightseeing">Tours & Sightseeing</option>
                                                        <option value="sightseeing">Sightseeing</option>
                                                        <option value="adventures">Adventures</option>

                                                    </select>
                                                    <x-input-error :messages="$errors->get('package_type')" class="mt-2" />
                                                </div>
                                                <div class="col-sm-2">
                                                    <label for="">Package Price</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="fa fa-dollar"></i></span>
                                                        <input type="text" class="form-control"
                                                            placeholder="Package Price" name="total_package_price" value="{{old('total_package_price')}}">
                                                    </div>
                                                    <x-input-error :messages="$errors->get('total_package_price')" class="mt-2" />

                                                </div>
                                               
                                                <div class="col-sm-3">
                                                    <label for="">Status</label>
                                                    <select name="status"
                                                        class="form-control form-control-primary">
                                                        <option value="">Select Status
                                                        </option>
                                                        <option value="active">Active</option>
                                                        <option value="inactive">Inactive</option>

                                                    </select>
                                                    <x-input-error :messages="$errors->get('status')" class="mt-2" />
                                                </div>
                                                <div class="col-sm-12">
                                                    <label for="">Package Short Description (50 to 60 words ideal)</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="icofont icofont-ui-user"></i></span>
                                                        <input type="text" class="form-control"
                                                            placeholder="Package short Description" name="short_description" value="{{old('short_description')}}">
                                                    </div>
                                                    <x-input-error :messages="$errors->get('short_description')" class="mt-2" />

                                                </div>
                                                <div class=" row col-12">
                                                    <label for="">Description</label>
                                                    <textarea rows="5" cols="5" class="form-control"  name="description" id="editor"></textarea>
                                                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                                                </div>
                                            </div>
         
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="text-center m-t-20">
                                                        <button type="submit"
                                                            class="btn btn-primary waves-effect waves-light m-r-10 btn-spinner">Save
                                                        </button>
                                                        <a href="{{route('packages.index')}}"
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

    <script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>

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

        ClassicEditor
        .create(document.querySelector('#editor'), {
            ckfinder: {
                uploadUrl: '{{ route("pages.uploadImage") }}?_token={{ csrf_token() }}'
            }
        })
        .catch(error => {
            console.error(error);
        });
    </script>
@endsection
