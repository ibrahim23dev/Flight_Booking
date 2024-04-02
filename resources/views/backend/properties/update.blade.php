@extends('backend.layouts.main')
@section('title', 'Property-update')

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
                                        <h4>Update Property </h4>
                                        <span>You can update property from here</span>
                                    </div>

                                </div>
                              

                            </div>
                            <div class="col-lg-4">
                                <div class="page-header-breadcrumb">
                                    <ul class="breadcrumb-title">
                                        <li class="breadcrumb-item">
                                            <a href="{{route('dashboard')}}"> <i class="feather icon-home"></i> </a>
                                        </li>
                                        <li class="breadcrumb-item"><a href="#">Property</a>
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
                                        <h5>Property Information</h5>
                                        <a href="{{route('properties.edit-surroundings',$property->id)}}" class="btn btn-primary adn-50 adn-right float-right">
                                            <i class="icofont icofont-edit"></i>Edit Surroundings  
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
                                                                Property Information
                                                            </a>
                                                   
                                                        </li>
                                                    
                                                        <li class="nav-item">
                                                            <a class="nav-link" data-toggle="tab" href="#amenities_tab"
                                                                role="tab">
                                                                <div class="f-20">
                                                                    <i class="icofont icofont-edit"></i>
                                                                </div>
                                                                Amenities
                                                            </a>
                                                   
                                                        </li>
                                                    </ul>
                                                    <!-- Tab panes -->
                                  <div class="tab-content">
                                <div class="tab-pane active" id="home7" role="tabpanel">

                                    <form action="{{route('properties.update',$property->id)}}" method="post" enctype="multipart/form-data">
                                          @csrf
                                        @method('PATCH')
                                         <!-- Image upload card start -->
                                        <div class="card">
                                          
                                            @if ($property->images!='')

                                            <div class="wall-img-preview lightgallery-popup">
                                                @foreach (json_decode($property->images) as $key => $image)
                                                <div class="col-md-2 p-0 wall-item" data-src="{{ Storage::url($image) }}">
                                                    <a href="">
                                                        <img src="{{ Storage::url($image) }}" class="img-fluid" alt="" style="width:10rem;height:10rem">
                                                    </a>
                                                    <a href="{{ route("properties.delete-image", ['property' => $property->id, 'index' => $key]) }}" class="delete-link text-danger" >
                                                        <i class="fa fa-trash"></i> Delete
                                                    </a>
                                                </div>
                                                @endforeach
                                            </div>
                                            @endif 

                                            <div class="card-header">
                                                <h5>Image Upload</h5>
    
                                            </div>
                                            <div class="card-block">
                                                <div class="sub-title">Add Hotel Images</div>
                                                <input type="file" name="images[]" id="filer_input" multiple="multiple">
                                            </div>
                                        </div>
                                        <!-- Image upload card end -->

                                            <div class="row mt-2">
                                                <div class="col-sm-6">
                                                    <label for="">Property Title</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="icofont icofont-ui-user"></i></span>
                                                        <input type="text" class="form-control"
                                                            placeholder="Property Title" name="title" value="{{old('title',$property->title)}}">
                                                    </div>
                                                    <x-input-error :messages="$errors->get('title')" class="mt-2" />

                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="">Type</label>
                                                    <select name="type"
                                                        class="form-control form-control-primary">

                                                        <option value="hotel" {{$property->status=='hotel' ? 'selected' : ''}}>Hotel</option>
                                                        <option value="villa" {{$property->status=='villa' ? 'selected' : ''}}>Villa</option>
                                                        <option value="apartment" {{$property->status=='apartment' ? 'selected' : ''}}>Apartment</option>
                                                        <option value="guest house" {{$property->status=='guest house' ? 'selected' : ''}}>Guest House</option>

                                                    </select>
                                                    <x-input-error :messages="$errors->get('type')" class="mt-2" />
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="">Location</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="fa fa-map-marker"></i></span>
                                                        <input type="text" class="form-control"
                                                            placeholder="Location" name="location" value="{{old('location',$property->location)}}">
                                                    </div>
                                                    <x-input-error :messages="$errors->get('location')" class="mt-2" />

                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="">Cordinates <span class="text-primary">(seperate coordinates by comma.)</span></label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="fa fa-map-marker"></i></span>
                                                        <input type="text" class="form-control"
                                                            placeholder="Cordinates" name="cordinates" value="{{old('cordinates',$property->cordinates)}}">
                                                    </div>
                                                    <x-input-error :messages="$errors->get('cordinates')" class="mt-2" />

                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="">Price Per Night</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="fa fa-dollar"></i></span>
                                                        <input type="text" class="form-control"
                                                            placeholder="Per night Price for standard room" name="price_per_night" value="{{old('price_per_night',$property->price_per_night)}}">
                                                    </div>
                                                    <x-input-error :messages="$errors->get('price_per_night')" class="mt-2" />

                                                </div>

                                                <div class="col-sm-4">
                                                    <label for="">Cancellation Charges <span class="text-primary">( if any)</span></label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="icofont icofont-ui-user"></i></span>
                                                        <input type="text" class="form-control"
                                                            placeholder="Cancellation Charges " name="cancellation_charges" value="{{old('cancellation_charges',$property->cancellation_charges)}}">
                                                    </div>
                                                    <x-input-error :messages="$errors->get('cancellation_charges')" class="mt-2" />

                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="">Payment Type</label>
                                                    <select name="payment_allowed"
                                                        class="form-control form-control-primary">

                                                        <option value="cash" {{$property->payment_allowed=='cash' ? 'selected': ''}}>Cash</option>
                                                        <option value="card" {{$property->payment_allowed=='card' ? 'selected': ''}}>Cards</option>
                                                        <option value="both" {{$property->payment_allowed=='both' ? 'selected': ''}}>Both</option>

                                                    </select>
                                                    <x-input-error :messages="$errors->get('payment_allowed')" class="mt-2" />
                                                </div>

                                                <div class="col-sm-4">
                                                    <label for="">Check In Time</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="fa fa-clock-o"></i></span>
                                                        <input type="text" class="form-control hour"
                                                            placeholder="hh:mm:ss" name="check_in_time" value="{{old('check_in_time',$property->check_in_time)}}" data-mask="99:99:99">
                                                    </div>
                                                    <x-input-error :messages="$errors->get('check_in_time')" class="mt-2" />

                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="">Check Out Time</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="fa fa-clock-o"></i></span>
                                                        <input type="text" class="form-control hour"
                                                            placeholder="hh:mm:ss" name="check_out_time" value="{{old('check_out_time',$property->check_out_time)}}" data-mask="99:99:99">
                                                    </div>
                                                    <x-input-error :messages="$errors->get('check_out_time')" class="mt-2" />

                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="">Select Status</label>
                                                    <select name="status"
                                                        class="form-control form-control-primary">
                                                        <option value="inactive" {{$property->status=='inactive' ? 'selected' : ''}}>Inactive</option>
                                                        <option value="active" {{$property->status=='active' ? 'selected' : ''}}>Active</option>
                                                    </select>
                                                    <x-input-error :messages="$errors->get('status')" class="mt-2" />
                                                </div>
                                            <div class="col-sm-12">
                                                <textarea rows="5" cols="5" class="form-control" placeholder="Description about property" name="description">{{$property->description}}</textarea>
                                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                                            </div>
                                        </div>

                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="text-center m-t-20">
                                                        <button type="submit"
                                                            class="btn btn-primary waves-effect waves-light m-r-10 btn-spinner">Save
                                                        </button>
                                                        <a href="{{route('properties.index')}}"
                                                            class="btn btn-warning waves-effect waves-light btn-spinner">Discard
                                                      </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="tab-pane" id="amenities_tab" role="tabpanel">

                                        <form action="{{ route('update-amenities', $property->id) }}" method="post" id="amenities-form">
                                            @csrf
                                            @method('PATCH')
                                            <div class="row mt-3">
                                                <div class="col-sm-12" id="amenities-container">
                                                    <!-- Loop through property amenities -->
                                                    @foreach (json_decode($property->amenities) as $index => $amenityGroup)
                                                        <div class="input-group-container">
                                                            <div class="input-group-button">
                                                               <label>{{$amenityGroup->heading}} </label>
                                                               <span class="text-primary">(Uncheck if not available)</span> 
                                                            </div>
                                                            <div class="points-container" data-index="{{ $index }}">
                                                                @foreach ($amenityGroup->points as $point)
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon">
                                                                            <input type="checkbox" aria-label="Checkbox for following text input" @if ($point->available) checked @endif>
                                                                        </span>
                                                                        <input type="text" class="form-control" name="amenities[{{ $index }}][]"
                                                                               placeholder="New Point" value="{{ $point->point }}">
                                                                            <span class="input-group-addon btn btn-primary add-more-btn" data-toggle="tooltip"
                                                                            data-placement="top" title="Add more">
                                                                            <span class=""><i class="fa fa-plus"></i></span>
                                                                        </span>

                                                                    </div>
                                                                    <div class="error-container text-danger" id="error-container-{{ $index }}"></div>

                                                                @endforeach
                                                            </div>


                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="text-center m-t-20">
                                                        <button type="button" class="btn btn-primary waves-effect waves-light m-r-10 " onclick="saveAmenities()">Save</button>
                                                        <a href="{{ route('properties.index') }}" class="btn btn-warning waves-effect waves-light ">Discard</a>
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

    <script>
document.addEventListener("DOMContentLoaded", function() {
    const addMoreButtons = document.querySelectorAll(".add-more-btn");

    addMoreButtons.forEach(button => {
        button.addEventListener("click", function() {
            const pointsContainer = this.closest(".points-container");
            const inputGroup = pointsContainer.querySelector(".input-group");

            const cloneInputGroup = inputGroup.cloneNode(true);
            const clonedErrorContainer = pointsContainer.querySelector('.error-container').cloneNode(true);

            // Remove the "add more" button
            cloneInputGroup.querySelector(".add-more-btn").remove();

            // Clear the value of the input
            const input = cloneInputGroup.querySelector(".form-control");
            input.value = '';

            // Clear cloned error messages
            clonedErrorContainer.innerHTML = '';

            // Create and add delete button
            const deleteButton = document.createElement("span");
            deleteButton.classList.add("input-group-addon", "btn", "btn-danger", "delete-btn");
            deleteButton.innerHTML = '<i class="fa fa-trash"></i>';

            deleteButton.addEventListener("click", () => {
                cloneInputGroup.nextElementSibling.innerHTML='';
                cloneInputGroup.remove();
            });

            // Append elements to the pointsContainer
            pointsContainer.appendChild(cloneInputGroup);
            pointsContainer.appendChild(clonedErrorContainer);
            cloneInputGroup.appendChild(deleteButton);
        });
    });
});


function validateAmenities() {
    const inputContainers = document.querySelectorAll('.input-group-container');
    clearErrorMessages();

    let valid = true;

    inputContainers.forEach(container => {
        const inputs = container.querySelectorAll('input[name^="amenities"]');
        let groupValid = true;

        inputs.forEach(input => {
            const inputValue = input.value.trim();
            const errorContainer = input.parentElement.nextElementSibling; // Get the corresponding error container

            if (inputValue === '') {
                groupValid = false;
                const errorMessage = document.createElement('div');
                errorMessage.classList.add('text-danger');
                errorMessage.innerText = 'This field is required.';
                errorContainer.appendChild(errorMessage);
            }
        });

        if (!groupValid) {
            valid = false;
        }
    });

    return valid;
}



function collectFormData() {
    const formData = [];

    document.querySelectorAll(".input-group-container").forEach(group => {
        const heading = group.querySelector(".input-group-button label").innerText;
        const points = [];

        group.querySelectorAll(".input-group:not(.input-group-button)").forEach(inputGroup => {
            const isChecked = inputGroup.querySelector("input[type='checkbox']").checked;
            const inputValue = inputGroup.querySelector(".form-control").value.trim();

            if (inputValue !== "") {
                points.push({
                    point: inputValue,
                    available: isChecked
                });
            }
        });

        if (points.length > 0) {
            formData.push({
                heading: heading,
                points: points
            });
        }
    });

    return formData;
}

function saveAmenities() {
    if (validateAmenities()) {
        const formData = collectFormData();
        const action = document.querySelector('#amenities-form').getAttribute('action');

        fetch(action, {
            method: 'PATCH',
            body: JSON.stringify({ amenities: formData }),
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Amenities updated successfully");
            } else if (data.error) {
                displayValidationErrors(data.error);
            }
        })
        .catch(error => {
            console.error("An error occurred:", error);
        });
    }
}

function clearErrorMessages() {
    const errorContainers = document.querySelectorAll('.error-container');
    errorContainers.forEach(container => {
        container.innerHTML = '';
    });
}
function displayValidationErrors(error) {
    alert(error);
}


    </script>

@endsection
