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
                                                                Surroundings
                                                            </a>
                                                   
                                                        </li>

                                                    </ul>
                                                    <!-- Tab panes -->
                                  <div class="tab-content">

                                    <div class="tab-pane active" id="amenities_tab" role="tabpanel">

                                        <form action="{{ route('properties.update-surroundings', $property->id) }}" method="post" id="surroundings-form">
                                            @csrf
                                            @method('PATCH')
                                            <div class="row mt-3">
                                                <div class="col-sm-12" id="surroundings-container">
                                                    <!-- Loop through property surroundings -->
                                                    @foreach (json_decode($property->surroundings) as $index => $surroundingGroup)
                                                        <div class="input-group-container">
                                                            <div class="input-group-button">
                                                                <label>{{$surroundingGroup->heading}}</label>
                                                                
                                                            </div>
                                                            <div class="points-container" data-index="{{ $index }}">
                                                                @foreach ($surroundingGroup->points as $point)
                                                                    <div class="input-group">

                                                                        <input type="text" class="form-control" name="surroundings[{{ $index }}][]"
                                                                               placeholder="Property Name" value="{{ $point->location }} ">

                                                                               <input type="text" class="form-control" name="surroundings[{{ $index }}][]"
                                                                               placeholder="Distance" value="{{ $point->distance }}">

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
                                                        <button type="button" class="btn btn-primary waves-effect waves-light m-r-10" onclick="saveSurroundings()">Save</button>
                                                        <a href="{{ route('properties.index') }}" class="btn btn-warning waves-effect waves-light">Discard</a>
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

function validateSurroundings() {
    const inputContainers = document.querySelectorAll('.input-group-container');
    clearErrorMessages();

    let valid = true;

    inputContainers.forEach(container => {
        const inputs = container.querySelectorAll('input[name^="surroundings"]');
        let groupValid = true;

        inputs.forEach(input => {
            const inputValue = input.value.trim();
            const errorContainer = input.parentElement.nextElementSibling; // Get the corresponding error container

            if (inputValue === '') {
                groupValid = false;
                const errorMessage = document.createElement('div');
                errorMessage.classList.add('text-danger');
                errorMessage.innerText = 'One or more fields are required.';
                errorContainer.appendChild(errorMessage);
            }
        });

        if (!groupValid) {
            valid = false;
        }
    });

    return valid;
}



function collectSurroundingData() {
    const formData = [];

    document.querySelectorAll(".input-group-container").forEach(group => {
        const heading = group.querySelector(".input-group-button label").innerText;
        const points = [];

        group.querySelectorAll(".input-group:not(.input-group-button)").forEach(inputGroup => {
            const inputFields = inputGroup.querySelectorAll(".form-control");
            const locationValue = inputFields[0].value.trim();
            const distanceValue = inputFields[1].value.trim();

            if (locationValue !== "" && distanceValue !== "") {
                points.push({
                    location: locationValue,
                    distance: distanceValue
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

function saveSurroundings() {
    if (validateSurroundings()) {
        const formData = collectSurroundingData();
        const action = document.querySelector('#surroundings-form').getAttribute('action');

        fetch(action, {
            method: 'PATCH',
            body: JSON.stringify({ surroundings: formData }),
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Surroundings updated successfully");
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
