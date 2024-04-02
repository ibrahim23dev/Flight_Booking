@extends('backend.layouts.main')
@section('title', 'Commission-update')

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
                                        <h4>Commission Setting</h4>
                                        <span>You can update commission from here</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="page-header-breadcrumb">
                                    <ul class="breadcrumb-title">
                                        <li class="breadcrumb-item">
                                            <a href="{{route('dashboard')}}"> <i class="feather icon-home"></i> </a>
                                        </li>
                                        <li class="breadcrumb-item"><a href="#">Commission</a>
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
                                        <h5>Commission Information</h5>
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
                                                                Commission Information
                                                            </a>
                                                   
                                                        </li>

                                                    </ul>
                                                    <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active" id="home7" role="tabpanel">

                                    <form action="{{route('commissions.update',$update->id)}}" method="post" enctype="multipart/form-data">
                                          @csrf
                                            @method('PATCH')
                                            <div class="row mt-2">
                                                <div class="col-sm-6">
                                                    <label for="">Fare Type</label>
                                                    <select name="fare_type"
                                                        class="form-control form-control-primary">
                                                        <option value="">Select Fare Type
                                                        </option>
                                                        <option value="discount" {{$update->fare_type=='discount' ? ' selected' : ''}}>Discount</option>
                                                        <option value="markup" {{$update->fare_type=='markup' ? ' selected' : ''}}>Markup</option>

                                                    </select>
                                                    <x-input-error :messages="$errors->get('fare_type')" class="mt-2" />
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="">Type</label>
                                                    <select name="type"
                                                        class="form-control form-control-primary">
                                                        <option value="">Select Type
                                                        </option>
                                                        <option value="flights" {{$update->type=='flights' ? ' selected' : ''}}>Flights</option>
                                                        <option value="hotels" {{$update->type=='hotels' ? ' selected' : ''}}>Hotels</option>
                                                        <option value="cars" {{$update->type=='cars' ? ' selected' : ''}}>Cars</option>

                                                    </select>
                                                    <x-input-error :messages="$errors->get('type')" class="mt-2" />
                                                </div>

                                                <div class="col-sm-6">
                                                    <label for="">Package Price</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="fa fa-dollar"></i></span>
                                                        <input type="text" class="form-control"
                                                            placeholder="Price to add or discount" name="price" value="{{old('price',$update->price)}}">
                                                    </div>
                                                    <x-input-error :messages="$errors->get('price')" class="mt-2" />

                                                </div>

                                                <div class="col-sm-6">
                                                    <label for="">Status</label>
                                                    <select name="status"
                                                        class="form-control form-control-primary">
                                                        <option value="">Select Status
                                                        </option>
                                                        <option value="active" {{$update->status=='active' ? ' selected' : ''}}>Active</option>
                                                        <option value="inactive" {{$update->status=='inactive' ? ' selected' : ''}}>Inactive</option>

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
                                                        <a href="{{route('commissions.index')}}"
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
