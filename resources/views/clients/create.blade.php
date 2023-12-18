<!-- resources/views/clients/create.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container-xxl flex-grow-1">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light"> <a href="{{ route('clients.index') }}" style="color:#a1acb8 !important">Gestion Clients/</a></span> Ajouter Client</h4>

    <!-- Basic Layout & Basic with Icons -->
    <div class="row">
      <!-- Basic with Icons -->
      <div class="col-xxl">
        <div class="card mb-4">
          <div class="card-header d-flex align-items-center justify-content-between">
          </div>
          <div class="card-body">
            <form method="post" action="{{ route('clients.store') }}">
              @csrf
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Nom Complete</label>
                <div class="col-sm-10">
                  <div class="input-group input-group-merge">
                    <span id="basic-icon-default-fullname2" class="input-group-text"
                      ><i class="bx bx-user"></i
                    ></span>
                    <input
                      type="text"
                      id="basic-icon-default-fullname"
                      class="form-control"
                      name="nom" required

                      aria-describedby="basic-icon-default-fullname2" />
                  </div>
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-icon-default-company">Adresse</label>
                <div class="col-sm-10">
                  <div class="input-group input-group-merge">
                    <span id="basic-icon-default-company2" class="input-group-text"
                      ><i class="bx bx-buildings"></i
                    ></span>
                    <input
                      type="text"
                      id="basic-icon-default-company"
                      name="adresse"
                      class="form-control"
                     
                      aria-describedby="basic-icon-default-company2" />
                  </div>
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-icon-default-email">Email</label>
                <div class="col-sm-10">
                  <div class="input-group input-group-merge">
                    <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                    <input
                      type="text"
                      id="basic-icon-default-email"
                      name="email" required
                      class="form-control"
                      
                      aria-describedby="basic-icon-default-email2" />
                    <span id="basic-icon-default-email2" class="input-group-text">@example.com</span>
                  </div>
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-2 form-label" for="basic-icon-default-phone">Téléphone</label>
                <div class="col-sm-10">
                  <div class="input-group input-group-merge">
                    <span id="basic-icon-default-phone2" class="input-group-text"
                      ><i class="bx bx-phone"></i
                    ></span>
                    <input
                      type="text"
                      id="basic-icon-default-phone"
                      name="telephone" required
                      class="form-control phone-mask"
                      aria-describedby="basic-icon-default-phone2" />
                  </div>
                </div>
              </div>
              <div class="row mb-3">
                <label for="defaultSelect" class="col-sm-2 form-label">Type</label>
                <div class="col-sm-10">
                  <div class="input-group input-group-merge">
                    <span id="basic-icon-default-message2" class="input-group-text"
                    ><i class='bx bx-spreadsheet' ></i></span>
                  <select id="defaultSelect"  class="form-select" name="type" required>
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
                  <div class="input-group input-group-merge">
                    <span id="basic-icon-default-message2" class="input-group-text"
                      ><i class="bx bx-comment"></i
                    ></span>
                      <input
                      type="number"
                      class="form-control"
                      id="basic-icon-default-message"
                      name="ice"
                      required
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
</div>
@endsection
