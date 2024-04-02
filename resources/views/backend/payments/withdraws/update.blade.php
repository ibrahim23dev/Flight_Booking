@extends('backend.layouts.main')
@section('title', 'Withdraw-update')

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
                                        <h4>Withdaw update</h4>
                                        <span>You can update withdraw from here</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="page-header-breadcrumb">
                                    <ul class="breadcrumb-title">
                                        <li class="breadcrumb-item">
                                            <a href="{{route('dashboard')}}"> <i class="feather icon-home"></i> </a>
                                        </li>
                                        <li class="breadcrumb-item"><a href="{{route('withdraw.index')}}">Withdraw</a>
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
                                        <h5>Update Withdraw Requested by: ({{$withdraw->user->name .'|'.$withdraw->user->email}})</h5>
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
                                                                Withdraw Information
                                                            </a>
                                                   
                                                        </li>

                                                    </ul>
                                                    <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active" id="home7" role="tabpanel">


                                            <div class="row">

                                                <div class="col-sm-6">
                                                    <label for="">Withdaw Amount</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="fa fa-usd"></i></span>
                                                        <input type="text" class="form-control"
                                                            placeholder="Amount to withdraw" name="amount" value="{{old('amount',$withdraw->amount)}}">
                                                    </div>
                                                    <x-input-error :messages="$errors->get('amount')" class="mt-2" />
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for=""> Method</label>
                                                    <select name="method"
                                                        class="form-control form-control-primary">
                                                        <option value=""> Method
                                                        </option>
                                                        <option value="cash" {{$withdraw->method=='cash' ?'selected' : ''}}>Cash</option>
                                                        <option value="check" {{$withdraw->method=='check' ?'selected' : ''}}>Check</option>
                                                        <option value="dd" {{$withdraw->method=='dd' ?'selected' : ''}}>DD</option>
                                                        <option value="etransfer" {{$withdraw->method=='etransfer' ?'selected' : ''}}>e-transfer</option>
    
                                                    </select>
                                                    <x-input-error :messages="$errors->get('method')" class="mt-2" />
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="">Comment if any</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="fa fa-comment"></i></span>
                                                        <input type="text" class="form-control"
                                                            placeholder="Comment" name="comments" value="{{old('comments',$withdraw->comments)}}">
                                                    </div>
                                                    <x-input-error :messages="$errors->get('comments')" class="mt-2" />
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="text-center m-t-20">

                                                        <a href="{{route('withdraw.index')}}"
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
