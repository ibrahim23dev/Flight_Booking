@extends('backend.layouts.main')
@section('title', 'Payment-method-update')

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
                                        <h4>Update Payment method</h4>
                                        <span>You can update new payment method from here</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="page-header-breadcrumb">
                                    <ul class="breadcrumb-title">
                                        <li class="breadcrumb-item">
                                            <a href="{{route('dashboard')}}"> <i class="feather icon-home"></i> </a>
                                        </li>
                                        <li class="breadcrumb-item"><a href="{{route('payment-methods.index')}}">Payment Method</a>
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
                                        <h5>Update Payment Method</h5>
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
                                                                Payment Method Information
                                                            </a>
                                                   
                                                        </li>

                                                    </ul>
                                                    <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active" id="home7" role="tabpanel">
                                        <form class="md-float-material card-block" action="{{route('payment-methods.update',$payment->id)}}" method="post" enctype="multipart/form-data">
                                          @method('PATCH')
                                          @csrf
                                          <div class="row p-t-10 p-b-10">
                                            <div class="col-lg-3 col-md-6 col-sm-12">
                                              
                                              <img src="{{ url('storage/'.$payment->icon) }}"
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
                                                                placeholder="Label Name" onchange="readURL(this)" name="icon">
                                                        </div>
                                                     <x-input-error :messages="$errors->get('icon')" class="mt-2" />
                                                      
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label >Identity</label>

                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="icofont icofont-ui-user"></i></span>
                                                        <input type="text" class="form-control"
                                                            placeholder="identity" name="identity" value="{{old('identity',$payment->identity)}}">
                                                    </div>
                                                    <x-input-error :messages="$errors->get('identity')" class="mt-2" />

                                                </div>
                                                <div class="col-sm-4">
                                                    <label >Agent</label>

                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="icofont icofont-ui-user"></i></span>
                                                        <input type="text" class="form-control"
                                                            placeholder="agent" name="agent" value="{{old('agent',$payment->agent)}}">
                                                    </div>
                                                    <x-input-error :messages="$errors->get('agent')" class="mt-2" />

                                                </div>
                                                <div class="col-sm-4">
                                                    <label >Shop Id</label>

                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="icofont icofont-ui-user"></i></span>
                                                        <input type="text" class="form-control"
                                                            placeholder="shop Id" name="shop_id" value="{{old('shop_id',$payment->shop_id)}}">
                                                    </div>
                                                    <x-input-error :messages="$errors->get('shop_id')" class="mt-2" />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label >Public key</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="icofont icofont-lock"></i></span>
                                                        <input type="text" class="form-control"
                                                            placeholder="Public key" name="public_key" value="{{old('public_key',$payment->public_key)}}">
                                                    </div>
                                                    <x-input-error :messages="$errors->get('public_key')" class="mt-2" />
                                                </div>
                                                <div class="col-sm-6">
                                                    <label >Private key</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="icofont icofont-lock"></i></span>
                                                        <input type="text" class="form-control"
                                                            placeholder="Private key" name="private_key" value="{{old('private_key',$payment->private_key)}}">
                                                    </div>
                                                    <x-input-error :messages="$errors->get('private_key')" class="mt-2" />
                                                </div>
                                            </div>
       
                                            <div class="row mt-3">
                                                <div class="col-sm-6">
                                                    <label >Secret key</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="icofont icofont-lock"></i></span>
                                                        <input type="text" class="form-control"
                                                            placeholder="Secret key" name="secret_key" value="{{old('secret_key',$payment->secret_key)}}">
                                                    </div>
                                                    <x-input-error :messages="$errors->get('secret_key')" class="mt-2" />
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="">Status</label>
                                                    <select name="status"
                                                        class="form-control form-control-primary">

                                                        <option value="active" {{$payment->status=='active' ?' selected' : ''}}>active
                                                        </option>                                                        <option value="inactive" {{$payment->status=='inactive' ?' selected' : ''}}>inactive
                                                        </option>
  
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
                                                        <a href="{{route('payment-methods.index')}}"
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
