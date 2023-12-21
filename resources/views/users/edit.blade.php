@extends('layouts.app')

@section('content')
<div class="flex-grow-1">
    @if(Auth::user()->hasRole('superadmin'))
      <h4 class="py-3 mb-4"><span class="text-muted fw-light"> <a href="{{ route('users.index') }}" style="color:#a1acb8 !important">Gestion Comptes/</a></span> Modifier Compte</h4>
    @else
      <h4 class="py-3 mb-4" > <i class='bx bx-user-circle' style="font-size: 2.15rem;"></i> Modifier Profile</h4>
    @endif
    <!-- Basic Layout & Basic with Icons -->
    <div class="row">
      <!-- Basic with Icons -->
      <div class="col-xxl">
        <div class="card mb-4">
          <h5 class="card-header">Profile Details</h5>
          <!-- Account -->
          <form method="post" onsubmit="return validateForm()" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data">
              @csrf
              @method('PATCH')
              <div class="card-body">
                <div class="d-flex align-items-start align-items-sm-center gap-4">
                  <img src="{{ $user->profile_photo_path ? asset('storage/' . $user->profile_photo_path) : asset('/assets/img/image/admin1.png') }}" alt="user-avatar" class="d-block rounded" style="margin-left: 30px" height="100" width="100" id="uploadedAvatar" />
                  <div class="button-wrapper">
                      <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                          <span class="d-none d-sm-block">Upload new photo</span>
                          <i class="bx bx-upload d-block d-sm-none"></i>
                          <input
                              type="file"
                              id="upload"
                              name="profile_photo"
                              class="account-file-input"
                              hidden
                              accept="image/png, image/jpeg"
                              onchange="displayImage(this)"
                          />
                      </label>
                      <p class="text-muted mb-0">Allowed JPG, JPEG, or PNG.</p>
                  </div>
                </div>
              </div>
              <hr class="my-0" />
            <div class="card-body">
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Nom Complete</label>
                  <div class="col-sm-10">
                    <div class="input-group input-group-merge" id='namediv'>
                      <span id="basic-icon-default-fullname2" class="input-group-text"
                        ><i class="bx bx-user"></i
                      ></span>
                      <input
                        type="text"
                        id="name"
                        class="form-control"
                        name="name"
                        value="{{ $user->name }}"
                        aria-describedby="basic-icon-default-fullname2" />
                    </div>
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="basic-icon-default-email">Email</label>
                  <div class="col-sm-10">
                    <div class="input-group input-group-merge" id='emaildiv'>
                      <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                      <input
                        type="text"
                        id="email"
                        name="email" 
                        class="form-control"
                        value="{{ $user->email }}"
                        aria-describedby="basic-icon-default-email2" />
                      <span id="basic-icon-default-email2" class="input-group-text">@example.com</span>
                    </div>
                  </div>
                </div>
                @unless(auth()->user()->hasRole('comptable'))
                <div class="row mb-3">
                  <label for="defaultSelect" class="col-sm-2 form-label">Role</label>
                  <div class="col-sm-10">
                    <div class="input-group input-group-merge">
                      <span id="basic-icon-default-message2" class="input-group-text"
                      ><i class='bx bx-spreadsheet' ></i></span>
                    <select id="defaultSelect"  class="form-select" name="roles" required>
                      @foreach ($user->getRoleNames() as $role)
                        <option value="superadmin" {{ $role === 'superadmin' ? 'selected' : '' }}>Super Admin</option>
                        <option value="admin" {{ $role === 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="comptable" {{ $role === 'comptable' ? 'selected' : '' }}>Comptable</option>
                      @endforeach
                    </select>
                  </div>
                  </div>
                </div>
                @endunless
                <div class="row mb-3">
                  <label class="col-sm-2 form-label" for="basic-icon-default-message">Password</label>
                  <div class="col-sm-10">
                    <div class="input-group input-group-merge">
                      <span id="basic-icon-default-message2" class="input-group-text"
                        ><i class="bx bx-comment"></i
                      ></span>
                        <input
                        type="password"
                        class="form-control"
                        id="basic-icon-default-message"
                        name="password"
                        aria-describedby="basic-icon-default-message2" />
                    </div>
                  </div>
                </div>
                <div class="row justify-content-end">
                  <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Modifier Compte</button>
                  </div>
                </div>
            </div>
          </form>
        </div>
      </div>
    </div>
</div>
<script>
  function displayImage(input) {
      var uploadedAvatar = document.getElementById('uploadedAvatar');
      
      // Check if a file is selected
      if (input.files && input.files[0]) {
          var reader = new FileReader();

          reader.onload = function (e) {
              uploadedAvatar.src = e.target.result;
          };

          reader.readAsDataURL(input.files[0]);
      }
  }
  function validateForm() {
      var nameField = document.getElementById('name');
      var emailField = document.getElementById('email');

      var namedivField = document.getElementById('namediv');
      var emaildivField = document.getElementById('emaildiv');

      var isError = false;

      if (nameField.value.trim() === '') {
        namedivField.style.border = '1px red solid';
          isError = true;
      } else {
        namedivField.style.border = '';
      }

      if (emailField.value.trim() === '') {
        emaildivField.style.border = '1px red solid';
          isError = true;
      } else {
        emaildivField.style.border = '';
      }
      return !isError;
  }
</script>
@endsection
