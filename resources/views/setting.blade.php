@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row">
        <!-- Left column -->
        <div class="col-md-3 bg-light border border-black">
            <form action="/avatar/update/{{$user->id}}" method="POST" enctype="multipart/form-data" id="avatar-form">
                @csrf
                <!-- Avatar -->
                <div class="text-center mt-3">
                    <img src="{{ asset('/img/' . $user->avatar) }}" alt="User Avatar" id="avatar-preview" class="rounded-circle" width="150" height="150">
                    <label for="avatar-upload" class="mt-2">
                        <b><i class="fs-4 bi bi-upload me-2"></i> Upload/Change Avatar</b>
                    </label>
                    <input type="file" id="avatar-upload" class="d-none" name="avatar" onchange="showPreview(this)">
                </div>
                <button type="button" class="me-2 ms-4 btn btn-secondary mt-3 d-none" id="cancel-button" onclick="cancelChanges()">Cancel</button>
                <button type="submit" class="me-2 ms-4 btn btn-aqua mt-3 d-none" id="save-button">Save Changes</button>
            </form>

            <!-- Profile navigation -->
            <ul class="nav flex-column nav-pills mt-4">
                <li class="nav-item">
                    <a class="nav-link active" href="#profile-form" data-bs-toggle="tab">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#portfolio-form" data-bs-toggle="tab">Portfolio</a>
                </li>
                <li class="nav-item mt-2">
                <a class=" ms-3 text-decoration-none fw-bold navl-color" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete Account</a>
                </li>
            </ul>
        </div>

        <!-- Right column -->
        <div class="col-md-9">
            <!-- Tab content -->
            <div class="tab-content bg-setting  border border-black">
                <!-- Profile form -->
                <div class="tab-pane fade show active mt-3" id="profile-form">
                    <form method="POST" action="/profile/update/{{$user->id}}">
                        @csrf
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$user->email}}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$user->name}}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Address -->
                        <div class="row mb-3">
                            <label for="address" class="col-md-4 col-form-label text-md-end">{{ __('Address') }}</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{$user->address}}" required autocomplete="new-address">

                                @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Contact Number -->
                        <div class="row mb-3">
                            <label for="contact" class="col-md-4 col-form-label text-md-end">{{ __('Contact') }}</label>

                            <div class="col-md-6">
                                <input id="contact" type="text" class="form-control @error('contact') is-invalid @enderror" name="contact" value="{{$user->contact}}" required autocomplete="new-contact">

                                @error('contact')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- User Type -->
                        <div class="row mb-3">
                            <label for="user_type" class="col-md-4 col-form-label text-md-end">{{ __('User Type') }}</label>

                            <div class="col-md-6">
                                <div class="input-group">
                                    <select id="user_type" class="form-control @error('user_type') is-invalid @enderror" name="user_type" value="" autocomplete="new-user_type">
                                        <option value="" selected disabled>{{$user->user_type}}</option>
                                        <option value="Customer">Customer</option>
                                        <option value="Studio Owner">Studio Owner</option>
                                        <option value="Photographer">Photographer</option>
                                    </select>
                                </div>

                                @error('user_type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Commission Fee -->
                        <div class="row mb-3">
                            <label for="fee" class="col-md-4 col-form-label text-md-end">{{ __('Fee') }}</label>

                            <div class="col-md-6">
                            <input id="fee" type="text" class="form-control @error('fee') is-invalid @enderror" name="fee" value="" placeholder="Enter Commission Fee"  autocomplete="new-fee">

                                @error('fee')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Availability -->
                        <div class="row mb-3">
                            <label for="availability" class="col-md-4 col-form-label text-md-end">{{ __('Availability') }}</label>

                            <div class="col-md-6">
                                <div class="input-group">
                                    <select id="availability" class="form-control @error('availability') is-invalid @enderror" name="availability" value="" autocomplete="new-availability">
                                        <option value="" selected disabled>Select Availability</option>
                                        <option value="Available">Available</option>
                                        <option value="Not Available">Not Available</option>
                                    </select>
                                </div>

                                @error('availability')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        
                        <!--Password-->
                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
                            <div class="col-md-6">
                                <input id="password" placeholder="Enter New Password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">
                                <small class="form-text text-muted text-black">Leave it blank if you don't want to change the password.</small>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Confirm password field -->
                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>
                            <div class="col-md-6">
                                <input id="password-confirm" placeholder="Confirm New Password" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                            </div>
                        </div>

                        <!-- Submit button -->
                        <div class="row">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>


                @if($user->user_type!="Customer")
                <!-- Portfolio form -->
                <div class="tab-pane fade" id="portfolio-form">
                    <div class="d-flex justify-content-center">
                        <form action="/portfolio/add" method="POST" enctype="multipart/form-data" class="col-lg-6">
                            @csrf
                            <div class="mt-3 mb-3">
                                <label for="images" class="form-label">Select Images:</label>
                                <input type="file" id="images" name="images[]" class="form-control" multiple onchange="previewImages(event)">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Preview:</label>
                                <div class="border rounded p-2" style="max-width: 300px;">
                                    <img src="{{ asset('/img/Upload Image.png') }}" alt="Preview Image" id="preview-image" class="img-fluid" style="max-width: 100%; height: auto;">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-aqua">Upload</button>
                        </form>
                    </div>
                </div>
                @endif


               

                    <!-- Delete confirmation modal -->
                    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="POST" action="/home/delete/{{$user->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel">Confirm Account Deletion</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <h2 class="text-center mt-5">Are you sure you want to delete your account?</h2>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                

            </div>
        </div>
    </div>
</div>

<script>
    function showPreview(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                document.getElementById('avatar-preview').src = e.target.result;
                showSaveButton();
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    function showSaveButton() {
        var saveButton = document.getElementById('save-button');
        var cancelButton = document.getElementById('cancel-button');
        saveButton.classList.remove('d-none');
        cancelButton.classList.remove('d-none');
    }

    function cancelChanges() {
        var fileInput = document.getElementById('avatar-upload');
        var saveButton = document.getElementById('save-button');
        var cancelButton = document.getElementById('cancel-button');
        fileInput.value = '';
        document.getElementById('avatar-preview').src = "{{ asset('/img/' . $user->avatar) }}";
        saveButton.classList.add('d-none');
        cancelButton.classList.add('d-none');
    }

    //previewing image in portfolio form
    function previewImages(event) {
        var preview = document.getElementById("preview-image");
        var files = event.target.files;

        if (files && files.length > 0) {
            var reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
            };

            reader.readAsDataURL(files[0]);
        }
    }
</script>

@endsection