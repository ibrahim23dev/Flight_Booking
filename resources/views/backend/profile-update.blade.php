@extends('backend.layouts.main')
@section('title', 'Profile')

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
                                  <h4>User Profile</h4>
                                  <span>You can edit you profile from here</span>
                              </div>
                          </div>
                      </div>
                      <div class="col-lg-4">
                          <div class="page-header-breadcrumb">
                              <ul class="breadcrumb-title">
                                  <li class="breadcrumb-item">
                                      <a href="index-1.htm"> <i class="feather icon-home"></i> </a>
                                  </li>
                                  <li class="breadcrumb-item"><a href="#!">User Profile</a>
                                  </li>
                                  <li class="breadcrumb-item"><a href="#!">User Profile</a>
                                  </li>
                              </ul>
                          </div>
                      </div>
                  </div>
              </div>
              <!-- Page-header end -->

                  <!-- Page-body start -->
                  <div class="page-body">
                      <!--profile cover start-->
                    <form action="{{route('profile.update')}}" method="post" enctype="multipart/form-data" id="updateForm">
                        @csrf
                        @method('PATCH')
                      <div class="row">
                          <div class="col-lg-12">
                              <div class="cover-profile">
                                  <div class="profile-bg-img">

                                      <img class="profile-bg-img img-fluid" src="{{asset('assets/backend')}}\files\assets\images\user-profile\bg-img1.jpg" alt="bg-img">
                                      <div class="card-block user-info">
                                          <div class="col-md-12">
                                              <div class="media-left">
                                                  <a href="#" class="profile-image">

                                                    @if (auth()->user()->image)
                                                    <img src="{{ asset('storage/images/users/' . auth()->user()->image) }}" alt="image" class="user-img img-radius" style="width: 10rem;height: 10rem;" id="db_user_image_upload">
                                                    @else
                                                       <img src="{{asset('assets/backend')}}\files\assets\images\avatar-4.jpg" alt="image" class=" user-img img-radius" style="width: 10rem;height: 10rem;" id="db_user_image_upload"> 
                                                    @endif

                                                  </a>
                                              </div>
                                              <div class="media-body row">
                                                  <div class="col-lg-12">
                                                      <div class="user-title">
                                                          <h2>{{auth()->user()->name}}</h2>
                                                          <span class="text-white">@foreach (auth()->user()->roles as $role)
                                                              {{$role->name}}
                                                          @endforeach</span>
                                                      </div>

                                                  </div>

                                              </div>

                                          </div>

                                      </div>

                                  </div>
                              </div>

                          </div>

                      </div>
                      <!--profile cover end-->
                      <div class="row">
                          <div class="col-lg-12">
                              <!-- tab header start -->
                              <div class="tab-header card">
                                  <ul class="nav nav-tabs md-tabs tab-timeline" role="tablist" id="mytab">
                                      <li class="nav-item">
                                          <a class="nav-link active" data-toggle="tab" href="#personal" role="tab">Personal Info</a>
                                          <div class="slide"></div>
                                      </li>

                                  </ul>
                              </div>
                              <!-- tab header end -->
                              <!-- tab content start -->
                              <div class="tab-content">
                                  <!-- tab panel personal start -->
                                  <div class="tab-pane active" id="personal" role="tabpanel">
                                      <!-- personal card start -->
                                      <div class="card">
                                          <div class="card-header">
                                              <h5 class="card-header-text">About Me</h5>
                                              <button id="edit-btn" type="button" class="btn btn-sm btn-primary waves-effect waves-light f-right">
                                  <i class="icofont icofont-edit"></i>
                                </button>
                                          </div>
                                          <div class="card-block">
                                              <div class="view-info">
                                                  <div class="row">
                                                      <div class="col-lg-12">
                                                          <div class="general-info">
                                                              <div class="row">
                                                                  <div class="col-lg-12 col-xl-6">
                                                                      <div class="table-responsive">
                                                                          <table class="table m-0">
                                                                              <tbody>
                                                                                  <tr>
                                                                                      <th scope="row">Full Name</th>
                                                                                      <td>{{auth()->user()->name}}</td>
                                                                                  </tr>
                                                                                  <tr>
                                                                                      <th scope="row">Gender</th>
                                                                                      <td>{{auth()->user()->gender}}</td>
                                                                                  </tr>
                                                                                  <tr>
                                                                                      <th scope="row">Created Date</th>
                                                                                      <td>{{date('M-d-Y',strtotime(auth()->user()->created_at))}}</td>
                                                                                  </tr>
  
                                                                              </tbody>
                                                                          </table>
                                                                      </div>
                                                                  </div>
                                                                  <!-- end of table col-lg-6 -->
                                                                  <div class="col-lg-12 col-xl-6">
                                                                      <div class="table-responsive">
                                                                          <table class="table">
                                                                              <tbody>
                                                                                  <tr>
                                                                                      <th scope="row">Email</th>
                                                                                      <td>{{auth()->user()->email}}</td>
                                                                                  </tr>
                                                                                  <tr>
                                                                                      <th scope="row">Mobile Number</th>
                                                                                      <td>{{auth()->user()->mobile}}</td>
                                                                                  </tr>
                                                                                  <tr>
                                                                                    <th scope="row">Address </th>
                                                                                    <td>{{auth()->user()->address}}</td>
                                                                                </tr>

                                                                              </tbody>
                                                                          </table>
                                                                      </div>
                                                                  </div>
                                                                  <!-- end of table col-lg-6 -->
                                                              </div>
                                                              <!-- end of row -->
                                                          </div>
                                                          <!-- end of general info -->
                                                      </div>
                                                      <!-- end of col-lg-12 -->
                                                  </div>
                                                  <!-- end of row -->
                                              </div>
                                              <!-- end of view-info -->
                                              <div class="edit-info">
                                                  <div class="row">
                                                      <div class="col-lg-12">
                                                          <div class="general-info">
                                                              <div class="row">
                                                                  <div class="col-lg-6">
                                                                      <table class="table">
                                                                          <tbody>
                                                                              <tr>
                                                                                  <td>
                                                                                      <div class="input-group">
                                                                                          <span class="input-group-addon"><i class="icofont icofont-user"></i></span>
                                                                                          <input type="text" class="form-control" placeholder="Full Name" name="name" value="{{auth()->user()->name}}">
                                                                                      </div>
                                                                                      <div id="nameError" class="text-danger"></div>

                                                                                  </td>
                                                                              </tr>
                                                                              <tr>
                                                                                  <td>
                                                                                      <div class="form-radio">
                                                                                          <div class="group-add-on">
                                                                                              <div class="radio radiofill radio-inline">
                                                                                                  <label>
                                                                              <input type="radio" name="gender"
                                                                              {{(auth()->user()->gender=='male') ? 'checked' : ''}} value="male"><i class="helper" ></i> Male
                                                                          </label>
                                                                                              </div>
                                                                                              <div class="radio radiofill radio-inline">
                                                                                                  <label>
                                                                              <input type="radio" name="gender" {{(auth()->user()->gender=='female') ? 'checked' : ''}} value="female"><i class="helper"></i> Female
                                                                          </label>
                                                                                              </div>
                                                                                          </div>
                                                                                      </div>
                                                                                
                                                                                  </td>
                                                                                  <div id="genderError" class="text-danger"></div>
                                                                              </tr>


                                                                              <tr>
                                                                                  <td>
                                                                                      <div class="input-group">
                                                                                          <span class="input-group-addon"><i class="icofont icofont-location-pin"></i></span>
                                                                                          <input type="text" class="form-control" placeholder="Address" name="address" value="{{auth()->user()->address}}">
                                                                                    

                                                                                      </div> 
                                                                                       <div id="addressError" class="text-danger"></div>
                                                                                  </td>
                                                                              </tr>
                                                                          </tbody>
                                                                      </table>
                                                                  </div>
                                                                  <!-- end of table col-lg-6 -->
                                                                  <div class="col-lg-6">
                                                                      <table class="table">
                                                                          <tbody>
                                                                              <tr>
                                                                                  <td>
                                                                                      <div class="input-group">
                                                                                          <span class="input-group-addon"><i class="icofont icofont-mobile-phone"></i></span>
                                                                                          <input type="text" class="form-control" placeholder="Mobile Number" name="mobile" value="{{auth()->user()->mobile}}">
                                                                                          

                                                                                      </div>
                                                                                      <div id="mobileError" class="text-danger"></div>
                                                                                  </td>
                                                                              </tr>
                                                                              <tr>
                                                                                <td>
                                                                                    <div class="input-group">
                                                                                        <span class="input-group-addon"><i class="icofont icofont-envelope"></i></span>
                                                                                        <input type="email" class="form-control" placeholder="Email" name="email" value="{{auth()->user()->email}}">
                                                                                       
                                                                                    </div>
                                                                                    <div id="emailError" class="text-danger"></div>
                                                                                </td>
                                                                            </tr>

                                                                            <tr>
                                                                                <td>
                                                                                    <div class="input-group mb-0">
                                                                       
                                                                                        <input type="file" name="image"  onchange="readURL(this);">

                                                                                    </div>
                                                                                    <div id="imageError" class="text-danger"></div>
                                                                                </td>
                                                                            </tr>

                                                                          </tbody>
                                                                      </table>
                                                                  </div>
                                                                  <!-- end of table col-lg-6 -->
                                                              </div>
                                                              <!-- end of row -->
                                                              <div class="text-center">
                                                                  <button type="submit" class="btn btn-primary waves-effect waves-light m-r-20">Save</button>
                                                                  <a href="#!" id="edit-cancel" class="btn btn-default waves-effect">Cancel</a>
                                                              </div>
                                                          </div>
                                                          <!-- end of edit info -->
                                                      </div>
                                                      <!-- end of col-lg-12 -->
                                                  </div>
                                                  <!-- end of row -->
                                              </div>
                                              <!-- end of edit-info -->
                                          </div>
                                          <!-- end of card-block -->
                                      </div>

                                      <!-- personal card end-->
                                  </div>
                                  <!-- tab pane personal end -->


                              </div>
                              <!-- tab content end -->
                          </div>
                      </div>
                    </form>

                  </div>
                  <!-- Page-body end -->
              </div>
          </div>
          <!-- Main body end -->
          <div id="styleSelector">

          </div>
      </div>
  </div>
        <script type="text/javascript">
          function readURL(input) {
              if (input.files && input.files[0]) {
                  var reader = new FileReader();
      
                  reader.onload = function (e) {
                      $('#db_user_image_upload').attr('src', e.target.result);
                  }
      
                  reader.readAsDataURL(input.files[0]);
              }
          }
        </script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const profileForm = document.getElementById('updateForm');
        const errorElements = profileForm.querySelectorAll('.error-message');

        profileForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            console.log(formData);
            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Profile updated successfully.');
                    location.reload();
                } else {
                    for (const fieldName in data.errors) {
                        const errorElement = profileForm.querySelector(`#${fieldName}Error`);
                        if (errorElement) {
                            errorElement.innerHTML = data.errors[fieldName].join('<br>');
                        }
                    }
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });
</script>


  @endsection
     