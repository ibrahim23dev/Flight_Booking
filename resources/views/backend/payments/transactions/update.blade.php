@extends('backend.layouts.main')
@section('title', 'Transaction-update')

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
                                        <h4>Update Transaction</h4>
                                        <span>You can update new transaction from here</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="page-header-breadcrumb">
                                    <ul class="breadcrumb-title">
                                        <li class="breadcrumb-item">
                                            <a href="{{route('dashboard')}}"> <i class="feather icon-home"></i> </a>
                                        </li>
                                        <li class="breadcrumb-item"><a href="{{route('transactions.index')}}">Transaction</a>
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
                                        <h5>Update Transaction</h5>
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
                                                                Transaction Information
                                                            </a>
                                                   
                                                        </li>

                                                    </ul>
                                                    <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active" id="home7" role="tabpanel">

       
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label >User Name</label>

                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="icofont icofont-ui-user"></i></span>
                                                        <input type="text" class="form-control"
                                                            placeholder="User Name"  value="{{old('name',$transaction->user->name)}}" readonly>
                                                    </div>

                                                </div>
                                                <div class="col-sm-4">
                                                    <label >User Email</label>

                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="icofont icofont-ui-user"></i></span>
                                                        <input type="text" class="form-control"
                                                            placeholder="User Email" value="{{old('email',$transaction->user->name)}}" readonly>
                                                    </div>

                                                </div>
                                                <div class="col-sm-4">
                                                    <label >User Mobile</label>

                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="icofont icofont-mobile-phone"></i></span>
                                                        <input type="text" class="form-control"
                                                            placeholder="User Mobile" value="{{old('mobile',$transaction->user->mobile)}}" readonly>
                                                    </div>
  
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label >Transection Category</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="icofont icofont-lock"></i></span>
                                                        <input type="text" class="form-control"
                                                            placeholder="Transection Category" name="transection_category" value="{{old('transection_category',$transaction->transection_category)}}" readonly>
                                                    </div>
                                                    <x-input-error :messages="$errors->get('transection_category')" class="mt-2" />
                                                </div>
                                                <div class="col-sm-4">
                                                    <label >Comments</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="icofont icofont-lock"></i></span>
                                                        <input type="text" class="form-control"
                                                            placeholder="Comments" name="comments" value="{{old('comments',$transaction->comments)}}" readonly>
                                                    </div>
                                                    <x-input-error :messages="$errors->get('comments')" class="mt-2" />
                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="">Status</label>
                                                    <select name="status"
                                                        class="form-control form-control-primary" disabled>
    
                                                        <option value="pending" {{$transaction->status=='pending' ?' selected' : ''}}>Pending
                                                        </option>                                                        <option value="completed" {{$transaction->status=='completed' ?' selected' : ''}}>Completed
                                                        </option>
                                                        <option value="canceled" {{$transaction->status=='canceled' ?' selected' : ''}}>Canceled
                                                        </option>
    
                                                    </select>
                                                    <x-input-error :messages="$errors->get('status')" class="mt-2" />
                                                </div>
                                            </div>

                                            <div class="row mt-3">


                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="text-center m-t-20">

                                                        <a href="{{route('transactions.index')}}"
                                                            class="btn btn-warning waves-effect waves-light btn-spinner">Back
                                                      </a>
                                                    </div>
                                                </div>
                                            </div>
    
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
