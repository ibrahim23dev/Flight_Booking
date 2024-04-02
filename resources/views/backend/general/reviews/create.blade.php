@extends('backend.layouts.main')
@section('title', 'Reviews-create')

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
                                        <h4>Create Reviews</h4>
                                        <span>You can create new Review</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="page-header-breadcrumb">
                                    <ul class="breadcrumb-title">
                                        <li class="breadcrumb-item">
                                            <a href="{{route('dashboard')}}"> <i class="feather icon-home"></i> </a>
                                        </li>
                                        <li class="breadcrumb-item"><a href="{{route('reviews.index')}}">Reviews</a>
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
                                        <h5>Create Reviews</h5>
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
                                                                Reviews Information
                                                            </a>
                                                   
                                                        </li>

                                                    </ul>
                                                    <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active" id="home7" role="tabpanel">
                                        <form class="md-float-material card-block" action="{{route('reviews.store')}}" method="post">
                                          @method('POST')
                                          @csrf
                                          <div class="row">
                                            <div class="col-sm-4">
                                                <label for="">Select User</label>
                                                    <select name="user_id"
                                                        class="form-control form-control-primary" >
                                                        <option value="">Select User
                                                        </option>
                                                        @foreach ($users as $user)
                                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                                        @endforeach

                                                    </select>
                                                    <x-input-error :messages="$errors->get('user_id')" class="mt-2" />
                                                </div>
                                          <div class="col-sm-4">
                                            <label for="">Select Status</label>
                                            <select name="status"
                                                class="form-control form-control-primary">
                                                <option value="">Select Status
                                                </option>
                                                <option value="active">Active</option>
                                                <option value="inactive" selected>Inactive</option>


                                            </select>
                                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                                        </div>
                                        <div class="col-sm-4">
                                            <label for=""> Rating (1-5) </label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i
                                                        class="icofont icofont-ui-user"></i></span>
                                                <input type="text" class="form-control"
                                                    placeholder=" Rating (1-5)" name="rating" value="{{old('rating')}}">
                                            </div>
                                            <x-input-error :messages="$errors->get('rating')" class="mt-2" />

                                        </div>
                                        </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label for=""> Review Text </label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="icofont icofont-ui-user"></i></span>
                                                        <input type="text" class="form-control"
                                                            placeholder="Review Text" name="review_text" value="{{old('review_text')}}">
                                                    </div>
                                                    <x-input-error :messages="$errors->get('review_text')" class="mt-2" />

                                                </div>

                                            </div>


                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="text-center m-t-20">
                                                        <button type="submit"
                                                            class="btn btn-primary waves-effect waves-light m-r-10 btn-spinner">Save
                                                        </button>
                                                        <a href="{{route('reviews.index')}}"
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
