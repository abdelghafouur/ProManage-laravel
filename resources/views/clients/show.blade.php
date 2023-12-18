<!-- resources/views/clients/show.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container-xxl flex-grow-1">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light"><a href="{{ route('clients.index') }}" style="color:#a1acb8 !important">Gestion Clients/</a></span> Show Client</h4>
    <div class="row">
        <div class="col-lg">
            <div class="card">
                <h5 class="card-header">Information client : </h5>
                <div class="card-body">
                <dl class="row mt-2">
                    <dt class="col-sm-3"><strong>Code</strong></dt>
                    <dd class="col-sm-9">{{ $client->codeClient }}</dd>
                    <dt class="col-sm-3"><strong>Nom Complete</strong> </dt>
                    <dd class="col-sm-9">{{ $client->nom }}</dd>
                    <dt class="col-sm-3"><strong>Type</strong> </dt>
                    <dd class="col-sm-9">{{ $client->type }}</dd>
                    <dt class="col-sm-3"><strong>Email</strong> </dt>
                    <dd class="col-sm-9">{{ $client->email }}</dd>
                    <dt class="col-sm-3"><strong>Téléphone</strong> </dt>
                    <dd class="col-sm-9">{{ $client->telephone }}</dd>
                    <dt class="col-sm-3"><strong>Adresse </strong> </dt>
                    <dd class="col-sm-9">{{ $client->adresse }}</dd>
                    <dt class="col-sm-3"><strong>ICE</strong> </dt>
                    <dd class="col-sm-9">{{ $client->ice }}</dd>
                </dl>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection