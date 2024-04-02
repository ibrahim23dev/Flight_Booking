@extends('backend.layouts.main')
@section('title', 'Permission-update')

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
                                        <h4>Update Permission</h4>
                                        <span>You can update permission from here</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="page-header-breadcrumb">
                                    <ul class="breadcrumb-title">
                                        <li class="breadcrumb-item">
                                            <a href="{{route('dashboard')}}"> <i class="feather icon-home"></i> </a>
                                        </li>
                                        <li class="breadcrumb-item"><a href="#">Permission</a>
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
                                        <h5>Permission Information</h5>
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
                                                                Permission Information
                                                            </a>
                                                   
                                                        </li>

                                                    </ul>
                                                    <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active" id="home7" role="tabpanel">

                                    <form action="{{route('/permission.Update',$permission->id)}}" method="post">
                                          @csrf

                                            <div class="row mt-2">
                                                <div class="col-sm-6">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="icofont icofont-ui-user"></i></span>
                                                        <input type="text" class="form-control"
                                                            placeholder="Permission Name" name="name" value="{{old('name',$permission->name)}}">
                                                    </div>
                                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />

                                                </div>
      
                                            </div>
         
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="text-center m-t-20">
                                                        <button type="submit"
                                                            class="btn btn-primary waves-effect waves-light m-r-10 btn-spinner">Save
                                                        </button>
                                                        <a href="{{route('/permissions.index')}}"
                                                            class="btn btn-warning waves-effect waves-light btn-spinner">Discard
                                                      </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-block">
                                      <div class="row">
                                          <div class="col-sm-12 col-xl-12 m-b-30">
                                              <h4 class="sub-title">Users this permission have</h4>
                                              <div class="border-checkbox-section">
                                                <form method="POST" action="{{ route('assignRevokePermission',$permission->id) }}" >
                                                  @csrf
                                                  @foreach ($users as $key=> $user)
 
                                                  <div class="border-checkbox-group border-checkbox-group-success">
                                                      <input class="border-checkbox" type="checkbox" id="checkbox{{$key}}" name="users[]" value="{{$user->id}}" {{ $user->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                                                      <label class="border-checkbox-label" for="checkbox{{$key}}">{{$user->name}}</label>
                                                  </div>

                                                  @endforeach
                                                   <h4 class="sub-title mt-3">Roles this permission have</h4>
                                                   @foreach ($roles as $rkey=> $role)
 
                                                   <div class="border-checkbox-group border-checkbox-group-success">
                                                       <input class="border-checkbox" type="checkbox" id="checkbox_{{$rkey}}" name="roles[]" value="{{$role->id}}" {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                                                       <label class="border-checkbox-label" for="checkbox_{{$rkey}}">{{$role->name}}</label>
                                                   </div>
 
                                                   @endforeach
                                                  <div class="text-center m-t-20">
                                                    <button type="submit" class="btn btn-primary waves-effect waves-light m-r-10">Assign/Revoke
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
