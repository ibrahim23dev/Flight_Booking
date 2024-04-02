@extends('backend.layouts.main')
@section('title', 'Section-Create-Content')

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
                                        <h4> Section Add Content </h4>
                                        <span>You can add section content from here</span>
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
                                        <li class="breadcrumb-item"><a href="">Section-Update</a>
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
                                        <h5>Section-Add Information</h5>
                                        <a href="{{route('/settings/section.edit',$section->id)}}" class="btn btn-primary adn-50 adn-right float-right">
                                            <i class="icofont icofont-plus"></i>View All  
                                          </a>
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
                                                                Section-Add Information
                                                            </a>
                                                   
                                                        </li>

                                                    </ul>
                                                    <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active" id="home7" role="tabpanel">

                                        <form action="{{ route('/settings/section.create',$section->id) }}" method="post" id="mainFormHtml" enctype="multipart/form-data">
                                            @csrf
                                            
                                            <div class="row mt-2">
                                                
                                                <div class="col-sm-6">
                                                    <label for="">Heading</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="icofont icofont-ui-user"></i></span>
                                                        <input type="text" class="form-control" placeholder="Section Heading" name="section_heading" value="{{old('section_heading',$section->section_heading)}}" readonly>
                                                    </div>
                                                    <x-input-error :messages="$errors->get('section_heading')" class="mt-2" />
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="">Short Title</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="icofont icofont-ui-user"></i></span>
                                                        <input type="text" class="form-control" placeholder="Short Title" name="short_title" value="{{old('short_title',$section->short_title)}}" readonly>
                                                    </div>
                                                    <x-input-error :messages="$errors->get('short_title')" class="mt-2" />
                                                </div>

                                            
                                            </div>
                                          
                                            <div class="row p-t-10 p-b-10">
                                                <div class="col-lg-3 col-md-6 col-sm-12">
                                                  
                                                      <img src="" alt="image" class="img-fluid width-100 m-b-20" id="image">
                                                </div>
                                                <div class="col-lg-9 col-md-6 col-sm-12">
                                                    <div class="row ">
                                                        <div class="col-lg-5">
                                                            <label for="">Content Picture</label>
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i
                                                                        class="icofont icofont-all-caps"></i></span>
                                                                <input type="file"
                                                                    class="form-control"
                                                                    placeholder="Label Name" onchange="readURL(this)" name="image" data-image-container="image">
                                                            </div>
                                                            <x-input-error class="mt-2" :messages="$errors->get('image')" />
                                                          
                                                        </div>
                                                        <div class="col-lg-5">
                                                            <label for=""> Title</label>

                                                        <textarea required="" rows="5"class="form-control" name="title"></textarea>
                                             
                                                        </div>

                                                       
                                                    </div>
                                                </div>
                                                
                                            </div>

                                            <div class=" row col-12">
                                                <label for="">Content</label>
                                                <textarea rows="5" cols="5" class="form-control"  name="description"></textarea>

                                                <x-input-error class="mt-2" :messages="$errors->get('description')" />

                                               </div>
                                         
                                            
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="text-center m-t-20">
                                                        <button type="submit" class="btn btn-primary waves-effect waves-light m-r-10 btn-spinner" id="submit_btn">Save</button>
                                                        <a href="{{ route('/settings/section.index') }}" class="btn btn-warning waves-effect waves-light">Discard</a>
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

                    reader.onload = function (e) {
                        var imageContainerId = $(input).data('image-container'); // Get the ID of the image container
                        $('#' + imageContainerId).attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }
        
    </script>
      
@endsection
