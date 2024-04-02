@include('backend.layouts.head-links')

<section class="login-block">
  <!-- Container-fluid starts -->
  <div class="container">
      <div class="row">
          <div class="col-sm-12">
              <!-- Authentication card start -->
                
                  <form class="md-float-material form-material" method="post" action="{{route('password.store')}}">
                 
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    @csrf
                      <div class="text-center">
                        <img  src="{{asset('assets/backend')}}\files\assets\images\logo\logo-blue-bx.png" alt="Theme-Logo">
                      </div>
                      <div class="auth-box card">
                          <div class="card-block">
                              <div class="row m-b-20">
                                  <div class="col-md-12">
                                      <h3 class="text-center">New Password</h3>
                                     
                                  </div>
                              </div>
                              <div class="form-group form-primary">
                                <x-input-label for="email" :value="__('Email')" />

                                <input type="text" name="email" class="form-control" required="" >
                                  <span class="form-bar"></span>
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />

                              </div>

                              <div class="form-group form-primary">
                                <x-input-label for="Password" :value="__('Password')" />

                                <input type="password" name="password" class="form-control" required="" >
                                  <span class="form-bar"></span>

                                  <x-input-error :messages="$errors->get('password')" class="mt-2" />
            
                              </div>

                              <span class="error-message"></span>
                              <span class="success-message"></span>

                              <div class="row m-t-25 text-left">
                                  <div class="col-12">
                                     
                                      <div class="forgot-phone text-right f-right">
                                          <a href="{{ route('login') }}" class="text-right f-w-600">Return to login </a>
                                      </div>
                                  </div>
                              </div>
                              <div class="row m-t-30">
                                  <div class="col-md-12">
                                      <button type="submit" class="btn btn-primary btn-md btn-block waves-effect waves-light text-center m-b-20 btn-spinner">Update Password</button>
                                  </div>
                              </div>
                              <hr>

                          </div>
                      </div>
                  </form>
                  <!-- end of form -->
          </div>
          <!-- end of col-sm-12 -->
      </div>
      <!-- end of row -->
  </div>
  <!-- end of container-fluid -->
</section>

    <script>

    // document.addEventListener('DOMContentLoaded', function () {
    //     const form = document.querySelector('form');
    //     const errorDiv = document.querySelector('.error-message');
    //     const successMessage = document.querySelector('.success-message');
    //     const btn =document.querySelector('.btn-spinner');
    //     form.addEventListener('submit', function (e) {
    //         e.preventDefault();
    //         errorDiv.innerHTML = ''; // Clear previous errors

    //         const formData = new FormData(form);
    //         fetch(form.action, {
    //             method: form.method,
    //             body: formData,
    //         })
    //         .then(response => response.json())
    //         .then(data => {
    //             if (data.success) {
    //                 // Password reset email sent successfully
    //                 successMessage.classList.add('text-success');
    //                 successMessage.innerHTML = data.message;
    //                 btn.innerHTML='Email Sent';
    //             } else {
    //                 btn.innerHTML='Error Sending Email';

    //                 // Display validation errors or other errors
    //                 if (data.errors) {
    //                     const errorList = document.createElement('ul');
    //                     errorList.classList.add('text-danger');
    //                     for (const error in data.errors) {
    //                         const listItem = document.createElement('li');
    //                         listItem.textContent = data.errors[error];
    //                         errorList.appendChild(listItem);
    //                     }
    //                     errorDiv.appendChild(errorList);
    //                 } else if (data.error) {
    //                     errorDiv.innerHTML = `<div class="text-danger">${data.error}</div>`;
    //                 }
    //             }
    //         })
    //         .catch(error => {
    //             errorDiv.innerHTML = `<div class="text-danger">${error}</div>`;
    //             btn.innerHTML='Error Sending Email';

    //         });
    //     });
    // });
</script>

@include('backend.layouts.dashboard-footer')

   