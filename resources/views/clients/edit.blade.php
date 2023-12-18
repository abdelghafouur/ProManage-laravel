@extends('layouts.app')

@section('content')
<div class="container-xxl flex-grow-1">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light"> <a href="{{ route('clients.index') }}" style="color:#a1acb8 !important">Gestion Clients/</a></span> Modifier Client</h4>

    <!-- Basic Layout & Basic with Icons -->
    <div class="row">
      <!-- Basic with Icons -->
      <div class="col-xxl">
        <div class="card mb-4">
          <div class="card-header d-flex align-items-center justify-content-between">
          </div>
          <div class="card-body">
            <form method="post" action="{{ route('clients.update', $client->id) }}">
              @csrf
              @method('PATCH')
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Nom Complete</label>
                <div class="col-sm-10">
                  <div class="input-group input-group-merge">
                    <span id="basic-icon-default-fullname2" class="input-group-text"
                      ><i class="bx bx-user"></i
                    ></span>
                    <input
                      type="text"
                      class="form-control"
                      type="text" name="nom" value="{{ $client->nom }}"
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
                      class="form-control"
                      name="adresse" value="{{ $client->adresse }}"
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
                      class="form-control"
                      name="email" value="{{ $client->email }}"
                      aria-describedby="basic-icon-default-email2" />
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
                      class="form-control phone-mask"
                      name="telephone" value="{{ $client->telephone }}"
                      aria-describedby="basic-icon-default-phone2" />
                  </div>
                </div>
              </div>
              <div class="row mb-3">
                <label for="defaultSelect" class="col-sm-2 form-label">Default select</label>
                <div class="col-sm-10">
                  <select id="defaultSelect"  class="form-select" name="type" required>
                    <option value="Entreprise" {{ $client->type === 'Entreprise' ? 'selected' : '' }}>Entreprise</option>
                    <option value="Particulier" {{ $client->type === 'Particulier' ? 'selected' : '' }}>Particulier</option>
                    <option value="Autre" {{ $client->type === 'Autre' ? 'selected' : '' }}>Autre</option>
                  </select>
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
                      name="ice" value="{{ $client->ice }}"
                      aria-describedby="basic-icon-default-message2" />
                  </div>
                </div>
              </div>
              <div class="row justify-content-end">
                <div class="col-sm-10">
                  <button type="submit" class="btn btn-primary">Modifier</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection
