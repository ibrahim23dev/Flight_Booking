@extends('backend.layouts.main')
@section('title', 'Email-Settings')

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
                                        <h4>Manage Email-Settings </h4>
                                        <span>You can manage email settings from here</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="page-header-breadcrumb">
                                    <ul class="breadcrumb-title">
                                        <li class="breadcrumb-item">
                                            <a href="{{route('dashboard')}}"> <i class="feather icon-home"></i> </a>
                                        </li>
                                        <li class="breadcrumb-item"><a href="#">Configurations</a>
                                        </li>
                                        <li class="breadcrumb-item"><a href="">Email Settings</a>
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
                                        <h5>Email Information</h5>
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
                                                                Email Information
                                                            </a>
                                                   
                                                        </li>

                                                    </ul>
                                                    <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active" id="home7" role="tabpanel">

                                        <form action="{{ route('email-settings.update',$email->id) }}" method="post" id="mainForm" data-id="{{ $email->id }}">
                                            @csrf
                                            @method('PATCH')
                                            <div class="row mt-2">
                                                <!-- SMTP fields -->
                                                <div class="col-sm-4">
                                                    <label for="">SMTP Username</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="icofont icofont-ui-user"></i></span>
                                                        <input type="text" class="form-control" placeholder="SMTP Username" name="smtp_username" value="{{old('smtp_username',$email->smtp_username)}}">
                                                    </div>
                                                    <x-input-error :messages="$errors->get('smtp_username')" class="mt-2" />
                                                </div>
                                        
                                                <div class="col-sm-3">
                                                    <label for="">SMTP Password</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="icofont icofont-ui-user"></i></span>
                                                        <input type="text" class="form-control" placeholder="SMTP Password" name="smtp_password" value="{{old('smtp_password',$email->smtp_password)}}">
                                                    </div>
                                                    <x-input-error :messages="$errors->get('smtp_password')" class="mt-2" />
                                                </div>
                                        
                                                <div class="col-sm-3">
                                                    <label for="">SMTP Host</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="icofont icofont-ui-user"></i></span>
                                                        <input type="text" class="form-control" placeholder="SMTP Host" name="smtp_host" value="{{old('smtp_host',$email->smtp_host)}}">
                                                    </div>
                                                    <x-input-error :messages="$errors->get('smtp_host')" class="mt-2" />
                                                </div>
                                                <div class="col-sm-2">
                                                    <label for="">SMTP Port</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="icofont icofont-ui-user"></i></span>
                                                        <input type="text" class="form-control" placeholder="SMTP Port" name="smtp_port" value="{{old('smtp_port',$email->smtp_port)}}">
                                                    </div>
                                                    <x-input-error :messages="$errors->get('smtp_port')" class="mt-2" />
                                                </div>
                                            </div>
                                            @foreach (json_decode($email->email_type_settings) as $key=> $json)
                                                
                                            <div class="row json-data">
                                                <div class="col-sm-4">
                                                    <label for="">From Email</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="icofont icofont-ui-user"></i></span>
                                                        <input type="email" class="form-control" placeholder="From Email" name="from_email" value="{{old('from_email',$json->from_email)}}">
                                                    </div>
                                                    <x-input-error :messages="$errors->get('from_email')" class="mt-2" />
                                                </div>
                                        
                                                <div class="col-sm-4">
                                                    <label for="">From Name</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="icofont icofont-ui-user"></i></span>
                                                        <input type="text" class="form-control" placeholder="From Name" name="from_name" value="{{old('from_name',$json->from_name)}}">
                                                    </div>
                                                    <x-input-error :messages="$errors->get('from_name')" class="mt-2" />
                                                </div>
                                        
                                                <div class="col-sm-4">
                                                    <label for="">Type</label>
                                                    <select name="type" class="form-control form-control-primary">
                                                        <option value="booking" {{ ($json->type=='booking')?'selected': '' }}>Booking</option>
                                                        <option value="info" {{ ($json->type=='info')?'selected': '' }}>Info</option>
                                                        <option value="general" {{ ($json->type=='general')?'selected': '' }}>General</option>
                                                    </select>
                                                    <x-input-error :messages="$errors->get('type')" class="mt-2" />
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
   

    <script>
        let emailSettingCounter = 0;
      
        
        // Event listener for adding email settings
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

           
          // Event listener for the form submission
          document.querySelector('form').addEventListener('submit', function (event) {
            event.preventDefault();
            const mainForm = document.getElementById('mainForm');
            // Collect SMTP-related fields
            const smtpData = {
                smtp_username: document.querySelector('input[name="smtp_username"]').value,
                smtp_password: document.querySelector('input[name="smtp_password"]').value,
                smtp_host: document.querySelector('input[name="smtp_host"]').value,
                smtp_port: document.querySelector('input[name="smtp_port"]').value
            };
    
            // Collect email settings
            const emailSettings = [];
            const emailSettingTemplates = document.querySelectorAll('.json-data');
            emailSettingTemplates.forEach(template => {
                const inputs = template.querySelectorAll('input, select');
                const setting = {
                    from_name: inputs[1].value,
                    from_email: inputs[0].value,
                    type: inputs[2].value
                };
                emailSettings.push(setting);
            });
    
            // Create the final JSON object
            const jsonData = {
                id:mainForm.getAttribute('data-id'),
                smtp_host: smtpData.smtp_host,
                smtp_username: smtpData.smtp_username,
                smtp_password: smtpData.smtp_password,
                smtp_port: smtpData.smtp_port,
                email_setting: emailSettings
            };
    
            // Convert the JSON object to a string
            const jsonString = JSON.stringify(jsonData,null,2);
    
            fetch(mainForm.action, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{csrf_token()}}', 
                    },
                    body: jsonString,
                })
                .then(response => response.json()) // Parse the response body as JSON
                .then(data => {
                    document.getElementById('submit_btn').innerHTML='Save';
                // console.log(data);
                    if (data.success) {
                        // Handle successful response (e.g., show a success message)
                        showToast('success', data.message);
                    } else {
                        // Handle error response
                        if (data.errors) {
                        
                        // You can display the validation errors to the user here
                        showToast('error', 'Validation errors. Please fill out all fields.');
                    } else if (data.error) {
                        
                        // console.error('Server error:', data.error);
                        // You can display a general error message to the user here
                        showToast('error', 'Server error');
                    } else {
                        // Handle unexpected error format
                        console.error('Unexpected error format:', data);
                        showToast('error', 'Unexpected error occurred');
                    }
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
