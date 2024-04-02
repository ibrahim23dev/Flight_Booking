@extends('backend.layouts.main')
@section('title', 'User-update')

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
                                        <h4>Create User</h4>
                                        <span>You can create new user from here</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="page-header-breadcrumb">
                                    <ul class="breadcrumb-title">
                                        <li class="breadcrumb-item">
                                            <a href="{{route('dashboard')}}"> <i class="feather icon-home"></i> </a>
                                        </li>
                                        <li class="breadcrumb-item"><a href="{{route('users.index')}}">Users</a>
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
                                        <h5>Create User</h5>
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
                                                                User Information
                                                            </a>
                                                   
                                                        </li>

                                                    </ul>
                                                    <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active" id="home7" role="tabpanel">
                                        <form class="md-float-material card-block" action="{{route('users.update',$user->id)}}" method="post" enctype="multipart/form-data">
                                          @method('PUT')
                                          @csrf
                                          <div class="row p-t-10 p-b-10">
                                            <div class="col-lg-3 col-md-6 col-sm-12">
                                              
                                              <img src="{{ asset('storage/images/users/' . $user->image) }}"
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
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="icofont icofont-ui-user"></i></span>
                                                        <input type="text" class="form-control"
                                                            placeholder="Full Name" name="name" value="{{old('name',$user->name)}}">
                                                    </div>
                                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />

                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="icofont icofont-envelope"></i></span>
                                                        <input type="email" class="form-control"
                                                            placeholder="Email" name="email" value="{{old('email',$user->email)}}">
                                                    </div>
                                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="icofont icofont-mobile-phone"></i></span>
                                                        <input type="text" class="form-control"
                                                            placeholder="Mobile" name="mobile" value="{{old('mobile',$user->mobile)}}">
                                                    </div>
                                                    <x-input-error :messages="$errors->get('mobile')" class="mt-2" />
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="icofont icofont-lock"></i></span>
                                                        <input type="password" class="form-control"
                                                            placeholder="Password" name="password">
                                                    </div>
                                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                                </div>
                                            </div>
                                            <div class="row">
                                              <div class="col-sm-6">
                                                <select name="gender"
                                                    class="form-control form-control-primary" required>

                                                    <option value="male" {{$user->gender=='male' ? 'selected' : ''}}>Male</option>
                                                    <option value="female" {{$user->gender=='female' ? 'selected' : ''}}>Female</option>

                                                </select>
                                            </div>
                                            <div class="col-sm-6">
                                              <select name="role"
                                                  class="form-control form-control-primary" required>
                                                  @foreach ($user->roles as $userRole)
                                                      <option value="{{$userRole->name}}" selected>{{$userRole->name}}</option>
                                                  @endforeach
                                                  @foreach ($roles as $role)
                                                      <option value="{{$role->name}}">{{$role->name}}</option>
                                                  @endforeach
                                              </select>
                                              <x-input-error :messages="$errors->get('role')" class="mt-2" />
                                          </div>
                                            </div>
                                            <div class="row mt-3">

                                                <div class="col-sm-6">
                                                    <select name="status"
                                                        class="form-control form-control-primary" required>

                                                        <option value="active" {{$user->status=='active' ? 'selected' : ''}}>active
                                                        </option>                                                        <option value="inactive" {{$user->status=='inactive' ? 'selected' : ''}}>inactive
                                                        </option>
  
                                                    </select>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="fa fa-dollar"></i></span>
                                                        <input type="text" class="form-control"
                                                            placeholder="commission ex: 5$" name="commission" value="{{old('commission',$user->commission)}}">
                                                    </div>
                                                    <x-input-error :messages="$errors->get('commission')" class="mt-2" />
                                                </div>
                                                <div class="col-sm-6">
                                                    <label >Waive Fees</label>
                                                    <select name="waive_fees"
                                                        class="form-control form-control-primary" required>

                                                        <option value="true" {{$user->waive_fees=='true' ? 'selected' : ''}}>True
                                                        </option>                                                        <option value="false" {{$user->waive_fees=='false' ? 'selected' : ''}}>False
                                                        </option>
  
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="text-center m-t-20">
                                                        <button type="submit"
                                                            class="btn btn-primary waves-effect waves-light m-r-10 btn-spinner btn-spinner">Save
                                                        </button>
                                                        <a href="{{route('users.index')}}"
                                                            class="btn btn-warning waves-effect waves-light btn-spinner btn-spinner">Discard
                                                      </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>

                                    </div>

                                    <div class="card-block">
                                      <div class="row">
                                          <div class="col-sm-12 col-xl-12 m-b-30">
                                              <h4 class="sub-title">Permissions this user have</h4>
                                              <div class="border-checkbox-section">
                                                <form method="POST" action="{{ route('assignRevokePermissionUser',$user->id) }}" >
                                                  @csrf
                                                    @foreach ($permissions as $key=>$permission)
                                                        
                                                  <div class="border-checkbox-group border-checkbox-group-success">
                                                      <input class="border-checkbox" type="checkbox" id="checkbox{{$key}}" name="permissions[]" value="{{$permission->id}}" {{ $user->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                                                      <label class="border-checkbox-label" for="checkbox{{$key}}">{{$permission->name}}</label>
                                                  </div>
                                                  @endforeach
                                                  <div class="text-center m-t-20">
                                                    <button type="submit" class="btn btn-primary waves-effect waves-light m-r-10 btn-spinner">Assign/Revoke
                                                    </button>
      
                                                </div>
                                                </form>
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
