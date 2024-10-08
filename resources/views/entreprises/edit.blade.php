@extends('layouts.app')

@section('content')

<h4 class="py-3 mb-4"><span class="text-muted fw-light"><a href="{{ route('entreprises.index') }}"
      style="color:#a1acb8 !important">Gestion Entreprises/</a></span> Modifier Entreprise</h4>
<!-- Basic Layout & Basic with Icons -->
<div class="row">
  <div class="col-xxl">
    <div class="card mb-4">
      <div class="card-body">
        <form method="post" onsubmit="return validateForm()" action="{{ route('entreprises.update', $entreprise->id) }}"
          enctype="multipart/form-data">
          @csrf
          @method('put')
          <div class="card-body">
            <div class="d-flex align-items-start align-items-sm-center gap-4">
              <img
                src="{{ $entreprise->logo ? asset('storage/' . $entreprise->logo) : asset('/assets/img/image/defaultEntreprise.jpg') }}"
                alt="user-avatar" class="d-block rounded" style="margin-left: 30px" height="100" width="100"
                id="uploadedAvatar" />
              <div class="button-wrapper">
                <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                  <span class="d-none d-sm-block">Upload new photo</span>
                  <i class="bx bx-upload d-block d-sm-none"></i>
                  <input type="file" id="upload" name="profile_photo" class="account-file-input" hidden
                    onchange="displayImage(this)" />
                </label>
                <p class="text-muted mb-0">Allowed JPG, JPEG, or PNG.</p>
              </div>
            </div>
          </div>
          <hr class="my-0" />
          <div class="row">
            <div class="mb-3 col-lg-6 col-md-6">
              <label class="form-label" for="basic-default-fullname1">Nom Entreprise</label>
              <input type="text" value="{{ $entreprise->nom }}" class="form-control" id="basic-default-fullname1"
                name="nom" />
            </div>
            <div class="mb-3 col-lg-6 col-md-6">
              <label class="form-label" for="basic-default-company2">Email</label>
              <input type="text" value="{{ $entreprise->email }}" class="form-control" id="basic-default-company2"
                name="email" />
            </div>
            <div class="mb-3 col-lg-6 col-md-6">
              <label for="html5-date-input3" class="col-md-2 col-form-label">Adresse</label>
              <div class="col-md-12">
                <input class="form-control" value="{{ $entreprise->adresse }}" type="text" name="adresse"
                  id="html5-date-input3" />
              </div>
            </div>
            <div class="mb-3 col-lg-6 col-md-6">
              <label class="form-label" for="basic-default-fullname4">Telephone</label>
              <input type="text" value="{{ $entreprise->telephone }}" class="form-control" id="basic-default-fullname4"
                name="telephone" />
            </div>
            <div class="mb-3 col-lg-6 col-md-6">
              <label class="form-label" for="basic-default-company5">Site</label>
              <input type="text" value="{{ $entreprise->site }}" class="form-control" id="basic-default-company5"
                name="site" />
            </div>
            <div class="mb-3 col-lg-6 col-md-6">
              <label for="html5-date-input6" class="col-md-2 col-form-label">patente</label>
              <div class="col-md-12">
                <input class="form-control" value="{{ $entreprise->patente }}" type="text" name="patente"
                  id="html5-date-input6" />
              </div>
            </div>
            <div class="mb-3 col-lg-6 col-md-6">
              <label class="form-label" for="basic-default-fullname7">ICE</label>
              <input type="text" value="{{ $entreprise->ice }}" class="form-control" id="basic-default-fullname7"
                name="ice" />
            </div>
            <div class="mb-3 col-lg-6 col-md-6">
              <label class="form-label" for="basic-default-company8">I.F</label>
              <input type="text" value="{{ $entreprise->if }}" class="form-control" id="basic-default-company8"
                name="if" />
            </div>
            <div class="mb-3 col-lg-6 col-md-6">
              <label for="html5-date-input" class="col-md-2 col-form-label9">C.N.S.S</label>
              <div class="col-md-12">
                <input class="form-control" value="{{ $entreprise->cnss }}" type="text" name="cnss"
                  id="html5-date-input9" />
              </div>
            </div>
            <div class="mb-3 col-lg-6 col-md-6">
              <label for="html5-date-input14" class="col-md-2 col-form-label">validite</label>
              <div class="col-md-12">
                <input class="form-control" value="{{ $entreprise->validite }}" type="text" name="validite"
                  id="html5-date-input14" />
              </div>
            </div>
            <div class="row text-end mt-3">
              <div class="col-sm-12">
                <button type="submit" class="btn btn-primary mx-4">Modifier Entreprise</button>
              </div>
            </div>
        </form>
      </div>
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
    var nomFields = document.getElementsByName('nom');
    var emailFields = document.getElementsByName('email');
    var adresseFields = document.getElementsByName('adresse');
    var telephoneFields = document.getElementsByName('telephone');
    var siteFields = document.getElementsByName('site');
    var patenteFields = document.getElementsByName('patente');
    var iceFields = document.getElementsByName('ice');
    var ifFields = document.getElementsByName('if');
    var cnssFields = document.getElementsByName('cnss');
    var validiteFields = document.getElementsByName('validite');

    var isError = false;

    // Check Nom Entreprise field
    for (var i = 0; i < nomFields.length; i++) {
        if (nomFields[i].value.trim() === '') {
            nomFields[i].style.borderColor = 'red';
            isError = true;
        } else {
            nomFields[i].style.borderColor = '';
        }
    }

    // Check Email field
    for (var i = 0; i < emailFields.length; i++) {
        if (emailFields[i].value.trim() === '') {
            emailFields[i].style.borderColor = 'red';
            isError = true;
        } else {
            emailFields[i].style.borderColor = '';
        }
    }

    // Check Validite field
    for (var i = 0; i < validiteFields.length; i++) {
        if (validiteFields[i].value.trim() === '') {
            validiteFields[i].style.borderColor = 'red';
            isError = true;
        } else {
            validiteFields[i].style.borderColor = '';
        }
    }

    // Return true if there is no error, false otherwise
    return !isError;
}
</script>
@endsection