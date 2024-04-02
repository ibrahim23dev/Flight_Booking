@extends('backend.layouts.main')
@section('title', 'Promo-create')

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
                                        <h4>Create Promo</h4>
                                        <span>You can create new Promo</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="page-header-breadcrumb">
                                    <ul class="breadcrumb-title">
                                        <li class="breadcrumb-item">
                                            <a href="{{route('dashboard')}}"> <i class="feather icon-home"></i> </a>
                                        </li>
                                        <li class="breadcrumb-item"><a href="{{route('promo-codes.index')}}">Promo</a>
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
                                        <h5>Create Promo</h5>
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
                                                                Promo Information
                                                            </a>
                                                   
                                                        </li>

                                                    </ul>
                                                    <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active" id="home7" role="tabpanel">
                                        <form class="md-float-material card-block" action="{{route('promo-codes.store')}}" method="post">
                                          @method('POST')
                                          @csrf
                                          <div class="row">
                                            <div class="col-sm-4">
                                                <label for="">Discount Price / Percentage</label>

                                                <div class="input-group">
                                                    <span class="input-group-addon"><i
                                                            class=" fa fa-dollar"></i></span>
                                                    <input type="number" class="form-control"
                                                        placeholder=" Discount eg:5$ / Percentage" name="discount" value="{{old('discount')}}">
                                                </div>
                                                <x-input-error :messages="$errors->get('discount')" class="mt-2" />
                                                </div>


                                                <div class="col-sm-4">
                                                    <label for="">Expiray Date </label>
    
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="fa fa-calendar-check-o"></i></span>
                                                        <input type="text" class="form-control"
                                                            placeholder="Expiray Date" name="expiry_date" value="{{old('expiry_date')}}" autocomplete="off">
                                                    </div>
                                                    <x-input-error :messages="$errors->get('expiry_date')" class="mt-2" />
                                                    </div>

                                        <div class="col-sm-4">
                                            <label for="">Usage limit </label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i
                                                        class="icofont icofont-ui-user"></i></span>
                                                <input type="number" class="form-control"
                                                    placeholder="Usage limit" name="usage_limit" value="{{old('usage_limit')}}">
                                            </div>
                                            <x-input-error :messages="$errors->get('usage_limit')" class="mt-2" />

                                        </div>
                                        <div class="col-sm-4">
                                            <label for="">Discount Type</label>
                                            <select name="discount_type"
                                                class="form-control form-control-primary">
                                                <option value="">Discount Type
                                                </option>
                                                <option value="percentage">Percentage</option>
                                                <option value="value">Fixed Price</option>


                                            </select>
                                            <x-input-error :messages="$errors->get('discount_type')" class="mt-2" />
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
                                        </div>
                                           
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="text-center m-t-20">
                                                        <button type="submit"
                                                            class="btn btn-primary waves-effect waves-light m-r-10 btn-spinner">Save
                                                        </button>
                                                        <a href="{{route('promo-codes.index')}}"
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

        <script>
          $(function() {
            $('input[name="expiry_date"]').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                timePicker: true, // Enable time picker
                timePickerIncrement: 1, // Time increment in minutes
                timePicker24Hour:true,
                minDate: moment(), // Set the minimum date to today
                locale: {
                    format: 'YYYY-MM-DD HH:mm' // Format the date as YYYY-MM-DD HH:mm
                },
                autoApply: true,
            });
        });

        </script>
@endsection
