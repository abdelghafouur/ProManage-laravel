<!-- resources/views/clients/show.blade.php -->

@extends('layouts.app')

@section('content')

<h4 class="py-3 mb-4"><span class="text-muted fw-light"><a href="{{ route('clients.index') }}" style="color:#a1acb8 !important">Gestion Clients/</a></span> {{ $client->codeClient }}</h4>
<div class="row">
    <div class="col-lg">
        <div class="card">
            <h5 class="card-header">Information client : </h5>
            <div class="card-body">
                <div class="row">
                    <dl class="row mt-2 col-md-8 col-xl-8">
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
                    <div class="col-md-4 col-xl-4">
                        <div class="card bg-secondary text-white mb-3">
                            <div class="card-body">
                                <h5 class="card-title text-white">Liste Detail Paiments : </h5>
                                <dl class="row mt-2">
                                    <dt class="col-sm-4"><strong>Total TTC: </strong></dt>
                                    <dd class="col-sm-8">{{ $totalTTC }}</dd>
                                    <dt class="col-sm-4"><strong>Total Paiment: </strong></dt>
                                    <dd class="col-sm-8">{{ $totalPaiments }}</dd>
                                    <dt class="col-sm-4"><strong>Total Rest: </strong></dt>
                                    <dd class="col-sm-8">{{ $restPayee }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
