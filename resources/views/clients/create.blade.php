<!-- resources/views/clients/create.blade.php -->

@extends('layouts.app')

@section('content')


<h4 class="py-3 mb-4"><span class="text-muted fw-light"> <a href="{{ route('clients.index') }}"
      style="color:#a1acb8 !important">Gestion Clients/</a></span> Ajouter Client</h4>

<!-- Basic Layout & Basic with Icons -->
<div class="row">
  <!-- Basic with Icons -->
  <div class="col-xxl">
    <div class="card mb-4">
      <div class="card-header d-flex align-items-center justify-content-between">
      </div>
      <div class="card-body">
        <form method="post" onsubmit="return validateForm()" action="{{ route('clients.store') }}">
          @csrf
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Nom Complete</label>
            <div class="col-sm-10">
              <div class="input-group input-group-merge" id="nomdiv">
                <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-user"></i></span>
                <input type="text" id="nom" class="form-control" name="nom"
                  aria-describedby="basic-icon-default-fullname2" />
              </div>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-icon-default-company">Adresse</label>
            <div class="col-sm-10">
              <div class="input-group input-group-merge" id="adressediv">
                <span id="basic-icon-default-company2" class="input-group-text"><i class="bx bx-buildings"></i></span>
                <input type="text" id="adresse" name="adresse" class="form-control"
                  aria-describedby="basic-icon-default-company2" />
              </div>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-icon-default-email">Email</label>
            <div class="col-sm-10">
              <div class="input-group input-group-merge" id="emaildiv">
                <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                <input type="text" id="email" name="email" class="form-control"
                  aria-describedby="basic-icon-default-email2" />
                <span id="basic-icon-default-email2" class="input-group-text">@example.com</span>
              </div>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 form-label" for="basic-icon-default-phone">Téléphone</label>
            <div class="col-sm-10">
              <div class="input-group input-group-merge" id="telephonediv">
                <span id="basic-icon-default-phone2" class="input-group-text"><i class="bx bx-phone"></i></span>
                <input type="text" id="telephone" name="telephone" class="form-control phone-mask"
                  aria-describedby="basic-icon-default-phone2" />
              </div>
            </div>
          </div>
          <div class="row mb-3">
            <label for="defaultSelect" class="col-sm-2 form-label">Type</label>
            <div class="col-sm-10">
              <div class="input-group input-group-merge" id="typediv">
                <span id="basic-icon-default-message2" class="input-group-text"><i class='bx bx-spreadsheet'></i></span>
                <select id="type" class="form-select" name="type">
                  <option value="Entreprise">Entreprise</option>
                  <option value="Particulier">Particulier</option>
                  <option value="Autre">Autre</option>
                </select>
              </div>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 form-label" for="basic-icon-default-message">ICE</label>
            <div class="col-sm-10">
              <div class="input-group input-group-merge" id="icediv">
                <span id="basic-icon-default-message2" class="input-group-text"><i class="bx bx-comment"></i></span>
                <input type="number" class="form-control" id="ice" name="ice"
                  aria-describedby="basic-icon-default-message2" />
              </div>
            </div>
          </div>
          <div class="row justify-content-end">
            <div class="col-sm-10">
              <button type="submit" class="btn btn-primary">Ajouter Client</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
  function validateForm() {
      var nomField = document.getElementById('nom');
      var adresseField = document.getElementById('adresse');
      var emailField = document.getElementById('email');
      var telephoneField = document.getElementById('telephone');
      var typeField = document.getElementById('type');
      var iceField = document.getElementById('ice');

      var nomdivField = document.getElementById('nomdiv');
      var adressedivField = document.getElementById('adressediv');
      var emaildivField = document.getElementById('emaildiv');
      var telephonedivField = document.getElementById('telephonediv');
      var typedivField = document.getElementById('typediv');
      var icedivField = document.getElementById('icediv');

      var isError = false;
      if (nomField.value.trim() === '') {
        nomdivField.style.border = '1px red solid';
          isError = true;
      } else {
        nomdivField.style.border = '';
      }

      if (adresseField.value.trim() === '') {
        adressedivField.style.border = '1px red solid';
          isError = true;
      } else {
        adressedivField.style.border = '';
      }

      if (emailField.value.trim() === '') {
        emaildivField.style.border = '1px red solid';
          isError = true;
      } else {
        emaildivField.style.border = '';
      }

      if (telephoneField.value.trim() === '') {
        telephonedivField.style.border = '1px red solid';
          isError = true;
      } else {
        telephonedivField.style.border = '';
      }
      if (typeField.value.trim() === '') {
        typedivField.style.border = '1px red solid';
          isError = true;
      } else {
        typedivField.style.border = '';
      }
      if (iceField.value.trim() === '') {
        icedivField.style.border = '1px red solid';
          isError = true;
      } else {
        icedivField.style.border = '';
      }

      return !isError;
  }
</script>
@endsection