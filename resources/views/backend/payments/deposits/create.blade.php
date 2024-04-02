@extends('backend.layouts.main')
@section('title', 'Deposit-create')

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
                                        <h4>Create Deposit</h4>
                                        <span>You can create new deposit from here</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="page-header-breadcrumb">
                                    <ul class="breadcrumb-title">
                                        <li class="breadcrumb-item">
                                            <a href="{{route('dashboard')}}"> <i class="feather icon-home"></i> </a>
                                        </li>
                                        <li class="breadcrumb-item"><a href="{{route('deposits.index')}}">Users</a>
                                        </li>
                                        <li class="breadcrumb-item"><a href="">Deposit</a>
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
                                        <h5>Create Deposit</h5>
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
                                                                Deposit Information
                                                            </a>
                                                   
                                                        </li>

                                                    </ul>
                                                    <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active" id="home7" role="tabpanel">
                                        <form class="md-float-material card-block" action="{{route('deposits.store')}}" method="post" enctype="multipart/form-data">
                                          @method('POST')
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

                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label for=""> Amount </label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="icofont icofont-ui-user"></i></span>
                                                        <input type="text" class="form-control"
                                                            placeholder="Amount" name="amount" value="{{old('amount')}}">
                                                    </div>
                                                    <x-input-error :messages="$errors->get('amount')" class="mt-2" />

                                                </div>
                                                <div class="col-sm-6">
                                                    <label for=""> Branch</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="icofont icofont-ui-user"></i></span>
                                                        <input type="text" class="form-control"
                                                            placeholder="Branch" name="branch" value="{{old('branch')}}">
                                                    </div>
                                                    <x-input-error :messages="$errors->get('branch')" class="mt-2" />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label for="">City</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="icofont icofont-ui-user"></i></span>
                                                        <input type="text" class="form-control"
                                                            placeholder="City" name="city" value="{{old('city')}}">
                                                    </div>
                                                    <x-input-error :messages="$errors->get('city')" class="mt-2" />
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="">Remarks</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="icofont icofont-ui-user"></i></span>
                                                        <input type="text" class="form-control"
                                                            placeholder="Remarks" name="remarks">
                                                    </div>
                                                    <x-input-error :messages="$errors->get('remarks')" class="mt-2" />
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="">Transaction No</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="icofont icofont-ui-user"></i></span>
                                                        <input type="text" class="form-control"
                                                            placeholder="Transaction No" name="transaction_no">
                                                    </div>
                                                    <x-input-error :messages="$errors->get('transaction_no')" class="mt-2" />
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="">Date Of Deposit</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="icofont icofont-ui-calendar"></i></span>
                                                        <input type="date" class="form-control"
                                                            placeholder="Date Of Deposit" name="date_of_deposit">
                                                    </div>
                                                    <x-input-error :messages="$errors->get('date_of_deposit')" class="mt-2" />
                                                </div>
                                            </div>
                                            <div class="row">
                                              <div class="col-sm-6">
                                                <select name="mode"
                                                    class="form-control form-control-primary" required>
                                                    <option value="">Select Mode
                                                    </option>
                                                    <option value="cash">Cash</option>
                                                    <option value="check">Check</option>
                                                    <option value="dd">DD</option>
                                                    <option value="etransfer">e-transfer</option>

                                                </select>
                                                <x-input-error :messages="$errors->get('mode')" class="mt-2" />
                                            </div>
                                            <div class="col-sm-6">
                                              <select name="deposited_bank"
                                                  class="form-control form-control-primary" required>
                                                  <option value="">Select Bank
                                                  </option>
                                                  @foreach ($banks as $bank)
                                                      <option value="{{$bank->bank_name.'-'.$bank->account_number}}">{{$bank->bank_name.'-'.$bank->account_number}}</option>
                                                  @endforeach
                                              </select>
                                              <x-input-error :messages="$errors->get('deposited_bank')" class="mt-2" />
                                          </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="text-center m-t-20">
                                                        <button type="submit"
                                                            class="btn btn-primary waves-effect waves-light m-r-10 btn-spinner">Save
                                                        </button>
                                                        <a href="{{route('deposits.index')}}"
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
