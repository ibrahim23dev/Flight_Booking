@extends('backend.layouts.main')
@section('title', 'Contact-Details')

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
                                        <h4>Manage Contact-Details </h4>
                                        <span>You can manage contact details from here</span>
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
                                        <li class="breadcrumb-item"><a href="">Contact-Details</a>
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
                                        <h5>Contact-Details Information</h5>
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
                                                                Contact-Details Information
                                                            </a>
                                                   
                                                        </li>

                                                    </ul>
                                                    <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active" id="home7" role="tabpanel">

                                        <form action="{{ route('/settings/pages/contactPage.update',$contact->id) }}" method="post" id="mainFormHtml" data-id="{{ $contact->id }}" enctype="multipart/form-data">
                                            @csrf
                                            @method('POST')
                                           
                                            <div class="row mt-2">
                                                <div class="col-sm-6">
                                                    <label for="">Email</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                                        <input type="text" class="form-control" placeholder="Business Email" name="email" value="{{old('email',$contact->email)}}">
                                                    </div>
                                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="">Phone</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                                        <input type="text" class="form-control" placeholder="Business phone" name="phone" value="{{old('phone',$contact->phone)}}">
                                                    </div>
                                                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                                                </div>
                                                <div class="col-sm-12">
                                                    <label for="">Address</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-location-arrow"></i></span>
                                                        <input type="text" class="form-control" placeholder="Business Address" name="address" value="{{old('address',$contact->address)}}">
                                                    </div>
                                                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
                                                </div>

                                                <div class="col-sm-12">
                                                    <label for=""> Maps Address</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                                        <input type="text" class="form-control" placeholder="Maps Address" name="maps_address" value="{{old('maps_address',$contact->maps_address)}}">
                                                    </div>
                                                    <x-input-error :messages="$errors->get('maps_address')" class="mt-2" />
                                                </div>
                                        
                                              
                                            </div>
                                             
                                          
                                            
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="text-center m-t-20">
                                                        <button type="submit" class="btn btn-primary waves-effect waves-light m-r-10 btn-spinner" id="submit_btn">Save</button>
                                                        <a href="#" class="btn btn-warning waves-effect waves-light">Discard</a>
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
