@extends('layouts.app')

@section('content')

<h4 class="py-3 mb-4"><span class="text-muted fw-light"><a href="{{ route('devis.index') }}" style="color:#a1acb8 !important">Gestion Devis/</a></span>{{ $devis->codeDevis }}</h4>
<div class="row">
    <div class="col-lg">
        <div class="card">
            <h5 class="card-header">Information Devis : </h5>
            <div class="card-body">
                <dl class="row mt-2">
                    <dt class="col-sm-3"><strong>Code Devis: </strong></dt>
                    <dd class="col-sm-9">{{ $devis->codeDevis }}</dd>

                    @if($devis->designationDev != null)
                    <dt class="col-sm-3"><strong>Designation Devis: </strong> </dt>
                    <dd class="col-sm-9">{{ $devis->designationDev }}</dd>
                    @endif
                    <dt class="col-sm-3"><strong>Conditions de Règlement: </strong> </dt>
                    <dd class="col-sm-9">{{ $devis->conditionsDeReglement }}</dd>
                    <dt class="col-sm-3"><strong>Date: </strong> </dt>
                    <dd class="col-sm-9">{{ $devis->date }}</dd>
                    <dt class="col-sm-3"><strong>Devis:</strong> </dt>
                    <dd class="col-sm-9">{{ $devis->devis }}</dd>
                    <dt class="col-sm-3"><strong>Banque: </strong> </dt>
                    <dd class="col-sm-9">{{ $devis->banque->nom }}</dd>
                    <dt class="col-sm-3"><strong>Client:</strong> </dt>
                    <dd class="col-sm-9">{{ $devis->client->nom }}</dd>
                    <dt class="col-sm-3"><strong>Entreprise: </strong> </dt>
                    <dd class="col-sm-9">{{ $devis->entreprise->nom }}</dd>
                </dl>
            </div>
            <div class="container-xxl flex-grow-1">
                <!-- Bootstrap Table with Header - Light -->
                <div class="card">
                    <h5 class="card-header">Details Devis : </h5>
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                            <thead class="table-light">
                                <tr>
                                    <th>Designation</th>
                                    <th>PUHT</th>
                                    <th>Qte</th>
                                    <th>TVA</th>
                                    <th>Total HT</th>
                                </tr>
                            </thead>
                            @if($devis->detailDevis->isNotEmpty())
                            <tbody class="table-border-bottom-0">
                                @php
                                $totalTTC = 0;
                                $totalTVA = 0;
                                $totalHT = 0;
                                @endphp

                                @foreach($devis->detailDevis as $detail)
                                <tr>
                                    <td>{{ $detail->designation }}</td>
                                    <td>{{ $detail->puht }}</td>
                                    <td>{{ $detail->qte }}</td>
                                    <td>{{ $detail->tva }} %</td>
                                    <td>{{ number_format($detail->puht * $detail->qte, 2, ',', '') }}</td>

                                </tr>

                                @php
                                $totalHT += ($detail->puht * $detail->qte);
                                $totalTTC += ($detail->puht * $detail->qte) * (1 + ($detail->tva / 100));
                                $totalTVA += (($detail->puht * $detail->qte * $detail->tva)/100);
                                @endphp
                                @endforeach

                                <!-- Display the total TTC row -->
                                <tr>
                                    <td colspan="3"></td>
                                    <td class="fw-bold">Total HT : </td>
                                    <td>{{ number_format($totalHT, 2, ',', '') }}</td>

                                </tr>
                                <tr>
                                    <td colspan="3"></td>
                                    <td class="fw-bold">Total TVA : </td>
                                    <td>{{ number_format($totalTVA, 2, ',', '') }}</td>

                                </tr>
                                <tr>
                                    <td colspan="3"></td>
                                    <td class="fw-bold ">Total TTC : </td>
                                    <td>{{ number_format($totalTTC, 2, ',', '') }}</td>
                                </tr>
                            </tbody>

                            @endif
                        </table>
                    </div>
                </div>
            </div>
            <div class="row text-end">
                <div class="col-sm-11 mt-3 mb-3">
                    <div class="btn-group dropup">
                        <button type="button" class="btn btn-primary text-end" onclick="window.open('{{ route('Dev.generate', ['DevisId' => $devis->id]) }}', '_blank')">
                            <i class="bx bx-export me-1"></i> Export Devis
                        </button>
                    </div>
                    <button type="button" class="btn btn-primary text-end" onclick="window.location.href='{{ route('devis.create', ['devis_id' => $devis->id]) }}'">Copy
                        Devis</button>
                    <button type="button" class="btn btn-primary text-end" onclick="window.location.href='{{ route('factures.create', ['devis_id' => $devis->id]) }}'">Create
                        Facture</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
