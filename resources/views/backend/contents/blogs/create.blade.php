@extends('backend.layouts.main')
@section('title', 'Blogs-Create')

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
                                        <h4>Manage Blog-Create </h4>
                                        <span>You can blog create from here</span>
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
                                        <li class="breadcrumb-item"><a href="">Blog-Create</a>
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
                                        <h5>Blog-Create Information</h5>
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
                                                                Blog-Create Information
                                                            </a>
                                                   
                                                        </li>

                                                    </ul>
                                                    <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active" id="home7" role="tabpanel">

                                        <form action="{{ route('blogs.store') }}" method="post" id="mainFormHtml" enctype="multipart/form-data">
                                            @csrf
                                           
                                            <div class="row p-t-10 p-b-10">
                                                <div class="col-lg-3 col-md-6 col-sm-12">
                                                  
                                                  <img src="#"
                                                      class="img-fluid width-100 m-b-20"
                                                      alt="Featured Image" id="db_user_image_upload">
                                                      
                                                </div>
                                                <div class="col-lg-9 col-md-6 col-sm-12">
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i
                                                                        class="icofont icofont-all-caps"></i></span>
                                                                <input type="file"
                                                                    class="form-control"
                                                                    placeholder="Label Name" onchange="readURL(this)" name="image" id="image">
                                                            </div>
                                                         <x-input-error :messages="$errors->get('image')" class="mt-2" />
                                                          
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>
    
                                            <div class="row mt-2">
                                                
                                                <div class="col-sm-6">
                                                  <label for="">Select Category</label>
  
                                                  <select name="category"
                                                  class="form-control form-control-primary" required>
  
                                                  <option value="travel">Travel</option>
                                                  <option value="tech">Tech</option>
                                                  <option value="tour">Tour</option>
  
                                                 </select>
                                                  <x-input-error :messages="$errors->get('category')" class="mt-2" />
                                              </div>

                                              <div class="col-sm-6">
                                                <label for="">Select Status</label>

                                                <select name="status"
                                                class="form-control form-control-primary" required>

                                                <option value="active">Active</option>
                                                <option value="inactive">Inactive</option>

                                               </select>
                                                <x-input-error :messages="$errors->get('status')" class="mt-2" />
                                            </div>
                                            
                                            <div class="col-sm-12">
                                              <label for="">Blog Title</label>
                                              <div class="input-group">
                                                  <span class="input-group-addon"><i class="icofont icofont-ui-user"></i></span>
                                                  <input type="text" class="form-control" placeholder="Blog Title" name="title" value="{{old('title')}}">
                                              </div>
                                              <x-input-error :messages="$errors->get('title')" class="mt-2" />
                                          </div>

                                              
                                            </div>
                                            <div class=" row col-12">
                                              <label for="">Description</label>
                                              <textarea rows="5" cols="5" class="form-control" placeholder="Blog Description" name="description"></textarea>
                                              <x-input-error :messages="$errors->get('description')" class="mt-2" />
                                          </div>
                                          <div class=" row col-12">
                                            <label for="">Content</label>
                                            <textarea rows="5" cols="5" class="form-control"  name="content" id="editor"></textarea>
                                            <x-input-error :messages="$errors->get('content')" class="mt-2" />
                                        </div>
                                          
                                            
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="text-center m-t-20">
                                                        <button type="submit" class="btn btn-primary waves-effect waves-light m-r-10 btn-spinner" id="submit_btn">Save</button>
                                                        <a href="{{ route('blogs.index') }}" class="btn btn-warning waves-effect waves-light">Discard</a>
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
   
    <script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>

   
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
        
        ClassicEditor
        .create(document.querySelector('#editor'), {
            ckfinder: {
                uploadUrl: '{{ route("blogs.uploadImage") }}?_token={{ csrf_token() }}'
            }
        })
        .catch(error => {
            console.error(error);
        });

    </script>
      
@endsection
