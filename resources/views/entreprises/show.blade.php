@extends('layouts.app')

@section('content')
<div class="container-xxl flex-grow-1">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light"><a href="{{ route('entreprises.index') }}"
                style="color:#a1acb8 !important">Gestion Entreprises/</a></span> Show Entreprise</h4>

    <div class="row">
        <div class="col-lg">
            <div class="card">
                <h5 class="card-header">Information Entreprise : </h5>
                <div class="d-flex align-items-start align-items-sm-center gap-4">
                    <img src="{{ $entreprise->logo ? asset('storage/' . $entreprise->logo) : asset('/assets/img/image/defaultEntreprise.jpg') }}"
                        alt="user-avatar" class="d-block rounded" style="margin-left: 60px" height="130" width="255"
                        id="uploadedAvatar" />
                </div>
                <div class="card-body">
                    <dl class="row mt-2">
                        <dt class="col-sm-3"><strong>Logo</strong></dt>
                        <dd class="col-sm-9">{{ $entreprise->nom }}</dd>
                        <dt class="col-sm-3"><strong>Nom</strong></dt>
                        <dd class="col-sm-9">{{ $entreprise->nom }}</dd>
                        <dt class="col-sm-3"><strong>Email</strong> </dt>
                        <dd class="col-sm-9">{{ $entreprise->email }}</dd>
                        <dt class="col-sm-3"><strong>Adresse</strong> </dt>
                        <dd class="col-sm-9">{{ $entreprise->adresse }}</dd>
                        <dt class="col-sm-3"><strong>Telephone</strong> </dt>
                        <dd class="col-sm-9">{{ $entreprise->telephone }}</dd>
                        <dt class="col-sm-3"><strong>Site</strong> </dt>
                        <dd class="col-sm-9">{{ $entreprise->site }}</dd>
                        <dt class="col-sm-3"><strong>Patente </strong> </dt>
                        <dd class="col-sm-9">{{ $entreprise->patente }}</dd>
                        <dt class="col-sm-3"><strong>ICE</strong> </dt>
                        <dd class="col-sm-9">{{ $entreprise->ice }}</dd>
                        <dt class="col-sm-3"><strong>I.F</strong> </dt>
                        <dd class="col-sm-9">{{ $entreprise->if }}</dd>
                        <dt class="col-sm-3"><strong>C.N.S.S</strong> </dt>
                        <dd class="col-sm-9">{{ $entreprise->cnss }}</dd>
                        <dt class="col-sm-3"><strong>Banque</strong> </dt>
                        <dd class="col-sm-9">{{ $entreprise->banque }}</dd>
                        <dt class="col-sm-3"><strong>RIB</strong> </dt>
                        <dd class="col-sm-9">{{ $entreprise->rib }}</dd>
                        <dt class="col-sm-3"><strong>Swift</strong> </dt>
                        <dd class="col-sm-9">{{ $entreprise->swift }}</dd>
                        <dt class="col-sm-3"><strong>Iban</strong> </dt>
                        <dd class="col-sm-9">{{ $entreprise->iban }}</dd>
                        <dt class="col-sm-3"><strong>Validite</strong> </dt>
                        <dd class="col-sm-9">{{ $entreprise->validite }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection