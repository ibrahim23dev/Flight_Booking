@extends('backend.layouts.main')
@section('title', 'Site-Identity')

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
                                        <h4>Manage Site-Identity </h4>
                                        <span>You can manage site identity from here</span>
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
                                        <li class="breadcrumb-item"><a href="">Site-Identity</a>
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
                                        <h5>Site-Identity Information</h5>
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
                                                                Site-Identity Information
                                                            </a>
                                                   
                                                        </li>

                                                    </ul>
                                                    <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active" id="home7" role="tabpanel">

                                        <form action="{{ route('site-identity.update',$site->id) }}" method="post" id="mainFormHtml" data-id="{{ $site->id }}" enctype="multipart/form-data">
                                            @csrf
                                            @method('POST')
                                            <div class="row p-t-10 p-b-10">
                                                <div class="col-lg-3 col-md-6 col-sm-12">
                                                  
                                                  <img src="{{asset('storage/images/site_identity/'.$site->logo_image)}}"
                                                      class="img-fluid width-100 m-b-20"
                                                      alt="img-edit" id="db_user_image_upload">
                                                      Site Logo
                                                </div>
                                                
                                                <div class="col-lg-9 col-md-6 col-sm-12">
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i
                                                                        class="icofont icofont-all-caps"></i></span>
                                                                <input type="file"
                                                                    class="form-control"
                                                                    placeholder="Label Name" onchange="readURL(this)" name="logo_image" id="logo_image">
                                                            </div>
                                                         <x-input-error :messages="$errors->get('logo_image')" class="mt-2" />
                                                          
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>
    
                                            <div class="row mt-2">
                                                <!-- SMTP fields -->
                                                <div class="col-sm-12">
                                                    <label for="">Site Title</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="icofont icofont-ui-user"></i></span>
                                                        <input type="text" class="form-control" placeholder="Site Title" name="site_title" value="{{old('site_title',$site->site_title)}}">
                                                    </div>
                                                    <x-input-error :messages="$errors->get('site_title')" class="mt-2" />
                                                </div>
                                        
                                              
                                            </div>
                                             @foreach (json_decode($site->social_links) as $key=> $item)
                                                 
                                            <div class="row json-data">
                                                <div class="col-sm-6">
                                                    <label for="">Social Name eg: (facebook)</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="icofont icofont-ui-user"></i></span>
                                                        <input type="text" class="form-control" placeholder="Social Name" name="social_name" value="{{old('social_name',$item->social_name)}}">
                                                    </div>
                                                    <x-input-error :messages="$errors->get('social_name')" class="mt-2" />
                                                </div>
                                        
                                                <div class="col-sm-6">
                                                    <label for="">Url eg:(https://www.facebook.com/siteidentiy)</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="icofont icofont-ui-user"></i></span>
                                                        <input type="url" class="form-control" placeholder="Social Url" name="social_url" value="{{old('social_url',$item->social_url)}}">
                                                    </div>
                                                    <x-input-error :messages="$errors->get('social_url')" class="mt-2" />
                                                </div>
                                        
                                            </div>

                                            @endforeach

                                          
                                            <div class="col-sm-12">
                                                
                                                <div class="input-group d-flex justify-content-end">
                                                    <span class="input-group-addon add-email-setting"><i class="fa fa-plus "></i></span>
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
        
        document.querySelector('.add-email-setting').addEventListener('click', function () {
            // Find the JSON data container
            const jsonDataContainer = document.querySelector('.json-data');
            
            // Clone the JSON data container
            const clone = jsonDataContainer.cloneNode(true);

            // Clear the input values in the cloned container
            const inputs = clone.querySelectorAll('input');
            inputs.forEach(input => {
                input.value = '';
            });

            // Insert the cloned container above the previous JSON data container
            jsonDataContainer.parentNode.insertBefore(clone, jsonDataContainer);
        });

document.addEventListener('DOMContentLoaded', function() {
            const mainForm = document.getElementById('mainFormHtml');

            mainForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);

                const social_links = [];

                const socialLinksTemplates = document.querySelectorAll('.json-data');
                socialLinksTemplates.forEach(template => {
                    const inputs = template.querySelectorAll('input');
                    if(inputs[0].value.trim() !=''){
                    const setting = {
                        social_name: inputs[0].value,
                        social_url: inputs[1].value,
                    };
                
                    social_links.push(setting);
                   }
                });
                const socialLinksJSON = JSON.stringify(social_links);

                // Append the JSON string to the FormData
                formData.append('social_links', socialLinksJSON);
                
                fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    document.getElementById('submit_btn').innerHTML='Save';
                // console.log(data);
                    if (data.success) {
                            showToast('success', data.message);
                        } else if (data.errors) {
                            for (const fieldName in data.errors) {
                                const errorMessages = data.errors[fieldName];
                                errorMessages.forEach(errorMessage => {
                                    showToast('error', errorMessage);
                                });
                            }
                        } else if (data.error) {
                            showToast('error', 'Server error');
                        } else {
                            showToast('error', 'Unexpected error occurred');
                        }
                })
                .catch(error => {
                    // console.error('Server error occurred:', error);
                    showToast('error', 'Server error occurred');
            });
          });

        function showToast(type, message) {
        const toastMain = document.getElementById('toast_ajax');
        const toastHeader = toastMain.querySelector('.toast-header');
        const toastBody = toastMain.querySelector('.toast-body');

        // Set the appropriate classes and message based on the type
        if (type == 'success') {
            toastMain.classList.remove('bg-danger','hide');
            toastMain.classList.add('bg-success', 'show');
            toastHeader.querySelector('.error-heading').textContent = 'Success';
        } else if (type == 'error') {
            toastMain.classList.remove('bg-success','hide');
            toastMain.classList.add('bg-danger', 'show');
            toastHeader.querySelector('.error-heading').textContent = 'Error';
        } else {
            // Hide the toast if the type is not 'success' or 'error'
            toastMain.classList.remove('show');
            toastMain.classList.add('hide');
        }

        // Set the message in the toast body
        toastBody.textContent = message;

        // Show the toast for a few seconds
        setTimeout(() => {
            toastMain.classList.remove('show');
            toastMain.classList.add('hide');
        }, 8000); // Adjust the delay as needed
    }
});

    </script>
        <div class="toast hide" role="alert" aria-live="assertive" aria-atomic="true" id="toast_ajax" >
            <i class="fa fa-times close-icon-toast"></i>
            <div class="toast-header">
               
              <strong class="me-auto error-heading">
               
                </strong>
              <small>Just Now</small>
              
            </div>
            <div class="toast-body">
               
            </div>
        </div>
@endsection
