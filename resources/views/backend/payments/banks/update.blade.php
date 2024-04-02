@extends('backend.layouts.main')
@section('title', 'Bank-update')

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
                                        <h4>Update Bank</h4>
                                        <span>You can update new bank from here</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="page-header-breadcrumb">
                                    <ul class="breadcrumb-title">
                                        <li class="breadcrumb-item">
                                            <a href="{{route('dashboard')}}"> <i class="feather icon-home"></i> </a>
                                        </li>
                                        <li class="breadcrumb-item"><a href="{{route('banks.index')}}">banks</a>
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
                                        <h5>Update Bank</h5>
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
                                                                Bank Information
                                                            </a>
                                                   
                                                        </li>

                                                    </ul>
                                                    <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active" id="home7" role="tabpanel">
                                        <form class="md-float-material card-block" action="{{route('banks.update',$bank->id)}}" method="post" enctype="multipart/form-data">
                                          @method('PATCH')
                                          @csrf

                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label>Bank Name</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="icofont icofont-ui-user"></i></span>
                                                        <input type="text" class="form-control"
                                                            placeholder="Bank Name" name="bank_name" value="{{old('bank_name',$bank->bank_name)}}">
                                                    </div>
                                                    <x-input-error :messages="$errors->get('bank_name')" class="mt-2" />

                                                </div>
                                                <div class="col-sm-6">
                                                    <label>Account Number</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="icofont icofont-ui-user"></i></span>
                                                        <input type="text" class="form-control"
                                                            placeholder="Account Number" name="account_number" value="{{old('account_number',$bank->account_number)}}">
                                                    </div>
                                                    <x-input-error :messages="$errors->get('account_number')" class="mt-2" />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label>Branch Code</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="icofont icofont-ui-user"></i></span>
                                                        <input type="text" class="form-control"
                                                            placeholder="Branch Code" name="branch_code" value="{{old('branch_code',$bank->branch_code)}}">
                                                    </div>
                                                    <x-input-error :messages="$errors->get('branch_code')" class="mt-2" />
                                                </div>
                                                <div class="col-sm-6">
                                                    <label>Account Title</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="icofont icofont-ui-user"></i></span>
                                                        <input type="text" class="form-control"
                                                            placeholder="Account Title" name="account_title" value="{{old('account_title',$bank->account_title)}}">
                                                    </div>
                                                    <x-input-error :messages="$errors->get('account_title')" class="mt-2" />
                                                </div>
                                                <div class="col-sm-6">
                                                    <label>Swift Code</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="icofont icofont-ui-user"></i></span>
                                                        <input type="text" class="form-control"
                                                            placeholder="Swift Code" name="swift_code" value="{{old('swift_code',$bank->swift_code)}}">
                                                    </div>
                                                    <x-input-error :messages="$errors->get('swift_code')" class="mt-2" />
                                                </div>
                                                <div class="col-sm-6">
                                                    <label>Branch Name</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="icofont icofont-ui-user"></i></span>
                                                        <input type="text" class="form-control"
                                                            placeholder="Branch Name" name="branch_name" value="{{old('branch_name',$bank->branch_name)}}">
                                                    </div>
                                                    <x-input-error :messages="$errors->get('branch_name')" class="mt-2" />
                                                </div>
                                                <div class="col-sm-12">
                                                    <label>Bank Address</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="icofont icofont-ui-user"></i></span>
                                                        <input type="text" class="form-control"
                                                            placeholder="Bank Address" name="bank_address" value="{{old('bank_address',$bank->bank_address)}}">
                                                    </div>
                                                    <x-input-error :messages="$errors->get('bank_address')" class="mt-2" />
                                                </div>
                                            </div>

                                            <div class="row mt-3">

                                                <div class="col-sm-6">
                                                    <select name="status"
                                                        class="form-control form-control-primary">
   
                                                        <option value="active" {{$bank->status=='active'? 'selected' : ''}}>active
                                                        </option>                                                        <option value="inactive" {{$bank->status=='inactive'? 'selected' : ''}}>inactive
                                                        </option>
  
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="text-center m-t-20">
                                                        <button type="submit"
                                                            class="btn btn-primary waves-effect waves-light m-r-10 btn-spinner">Save
                                                        </button>
                                                        <a href="{{route('banks.index')}}"
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
