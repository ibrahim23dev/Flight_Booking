@extends('backend.layouts.main')
@section('title', 'Currency Exchange Rates Create')

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
                                        <h4>Currency Exchange Rates Create </h4>
                                        <span>You can create currency exchange rate from here</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="page-header-breadcrumb">
                                    <ul class="breadcrumb-title">
                                        <li class="breadcrumb-item">
                                            <a href="{{route('dashboard')}}"> <i class="feather icon-home"></i> </a>
                                        </li>
                                        <li class="breadcrumb-item"><a href="#">Settings</a>
                                        </li>
                                        <li class="breadcrumb-item"><a href="">Currency Exchange Rates</a>
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
                                        <h5>Currency Exchange Rates</h5>
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
                                                                Currency Exchange Rates
                                                            </a>
                                                   
                                                        </li>

                                                    </ul>
                                                    <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active" id="home7" role="tabpanel">

                                        <form action="{{ route('currency-rates.store') }}" method="post" id="mainFormHtml" enctype="multipart/form-data">
                                            @csrf
                                           
                                            <div class="row mt-2">
                                                <!-- SMTP fields -->
                                                <div class="col-sm-4">
                                                    <label for="">USD Currency Code</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="icofont icofont-ui-user"></i></span>
                                                        <input type="text" class="form-control" placeholder="From Currency Code" name="currency_from" value="{{old('currency_from')}}">
                                                    </div>
                                                    <x-input-error :messages="$errors->get('currency_from')" class="mt-2" />
                                                </div>
<div class="col-sm-2">
                                                <label for="">USD Exchange Rate</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="icofont icofont-ui-user"></i></span>
                                                    <input type="text" class="form-control" placeholder="Exchange Rate" name="BDT_value" value="{{old('BDT_value')}}">
                                                </div>
                                                <x-input-error :messages="$errors->get('BDT_value')" class="mt-2" />
                                            </div>
                                                <div class="col-sm-4">
                                                  <label for="">BDT Currency Code</label>
                                                  <div class="input-group">
                                                      <span class="input-group-addon"><i class="icofont icofont-ui-user"></i></span>
                                                      <input type="text" class="form-control" placeholder="To Currency Code" name="currency_to" value="{{old('currency_to')}}">
                                                  </div>
                                                  <x-input-error :messages="$errors->get('currency_to')" class="mt-2" />
                                              </div>
                                              <div class="col-sm-2">
                                                <label for="">BDT Exchange Rate</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="icofont icofont-ui-user"></i></span>
                                                    <input type="text" class="form-control" placeholder="Exchange Rate" name="exchange_rate" value="{{old('exchange_rate')}}">
                                                </div>
                                                <x-input-error :messages="$errors->get('exchange_rate')" class="mt-2" />
                                            </div>
                                           
                                           
                                           
                                            
                                           
                                           
                                           
                                           
                                           
                                          
                                            </div>
                                          
                                            
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="text-center m-t-20">
                                                        <button type="submit" class="btn btn-primary waves-effect waves-light m-r-10 btn-spinner" id="submit_btn">Save</button>
                                                        <a href="{{ route('currency-rates.index') }}" class="btn btn-warning waves-effect waves-light">Discard</a>
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
