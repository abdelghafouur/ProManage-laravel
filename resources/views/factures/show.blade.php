@extends('layouts.app')

@section('content')
<h4 class="py-3 mb-4"><span class="text-muted fw-light"><a href="{{ route('factures.index') }}"
            style="color:#a1acb8 !important">Gestion Factures/</a></span> {{ $facture->codeFacture }}</h4>
<div class="row">
    <div class="col-lg">
        <div class="card">
            <h5 class="card-header">Information Facture : </h5>
            <div class="card-body">
                <div class="row">
                    <dl class="row mt-2 col-md-8 col-xl-8">
                        <dt class="col-sm-3"><strong>Code Facture: </strong></dt>
                        <dd class="col-sm-9">{{ $facture->codeFacture }}</dd>
                        <dt class="col-sm-3"><strong>Client: </strong> </dt>
                        <dd class="col-sm-9">{{ $facture->client->nom }}</dd>
                        <dt class="col-sm-3"><strong>Entreprise: </strong> </dt>
                        <dd class="col-sm-9">{{ $facture->entreprise->nom }}</dd>
                        @if($facture->devis_id != null)
                        <dt class="col-sm-3"><strong>Code Devis: </strong> </dt>
                        <dd class="col-sm-9">{{ $codeDevisFC }}</dd>
                        @endif
                        <dt class="col-sm-3"><strong>Devis:</strong> </dt>
                        <dd class="col-sm-9">{{ $facture->devis }}</dd>
                        <dt class="col-sm-3"><strong>date:</strong> </dt>
                        <dd class="col-sm-9">{{ $facture->date }}</dd>
                    </dl>
                    <div class="col-md-4 col-xl-4">
                        <div class="card bg-secondary text-white mb-3">
                            <div class="card-body">
                                <h5 class="card-title text-white">Liste Detail Paiments : </h5>
                                <dl class="row mt-2">
                                    <dt class="col-sm-4"><strong>Total TTC: </strong></dt>
                                    @php
                                    $totalTTC = 0;
                                    @endphp
                                    @if($facture->detailFacture->isNotEmpty())

                                    @foreach($facture->detailFacture as $detail)
                                    @php
                                    $totalTTC += ($detail->puht * $detail->qte) * (1 + ($detail->tva / 100));
                                    @endphp
                                    @endforeach
                                    @endif
                                    <dd class="col-sm-8">{{ number_format($totalTTC, 2, ',', '') }}</dd>
                                    <dt class="col-sm-4"><strong>Total Paiment: </strong></dt>
                                    <dd class="col-sm-8">{{ number_format($totalMontant, 2, ',', '') }}</dd>
                                    <dt class="col-sm-4"><strong>Total Rest: </strong></dt>
                                    <dd class="col-sm-8">{{ number_format($totalTTC - $totalMontant, 2, ',', '') }}
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-xxl flex-grow-1 container-p-y">
                <!-- Bootstrap Table with Header - Light -->
                <div class="card">
                    <h5 class="card-header">Details Facture :</h5>
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
                            @if($facture->detailFacture->isNotEmpty())
                            <tbody class="table-border-bottom-0">
                                @php
                                $totalTTC = 0;
                                $totalTVA = 0;
                                $totalHT = 0;
                                @endphp
                                @foreach($facture->detailFacture as $detail)
                                <tr>
                                    <td>{{ $detail->designation }}</td>
                                    <td>{{ $detail->puht }}</td>
                                    <td>{{ $detail->qte }}</td>
                                    <td>{{ $detail->tva }} % </td>
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
                                    <td class="fw-bold">Total TTC : </td>
                                    <td>{{ number_format($totalTTC, 2, ',', '') }}</td>
                                </tr>
                            </tbody>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
            <!-- Basic Layout -->
            <div class="container-xxl flex-grow-1">
                <!-- Bootstrap Table with Header - Light -->
                <div class="card">
                    <h5 class="card-header">Details Paiments : </h5>
                    <div class="card-body">
                        <!-- Vertically Centered Modal -->
                        <div class="col-lg-4 col-md-6">
                            <div class="mt-3">
                                <!-- Button trigger modal -->
                                @unless(auth()->user()->hasRole('comptable'))
                                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                                    data-bs-target="#modalCenter">
                                    Ajouter Paiment
                                </button>
                                @endunless

                                <form method="post" id="innerForm" action="{{ route('paiments.store') }}">
                                    @csrf
                                    <!-- Modal -->
                                    <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <input type="hidden" name="facture_id" value="{{ $facture->id }}" />
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalCenterTitle">Modal title</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row g-2" style="margin-bottom: 10px">
                                                        <div class="col mb-0">
                                                            <label for="date" class="form-label">Date</label>
                                                            <input type="date" name="date" id="dateAdd"
                                                                class="form-control" />
                                                        </div>
                                                        <div class="col mb-0">
                                                            <label for="montant" class="form-label">Montant</label>
                                                            <input type="text" name="montant" id="montantAdd"
                                                                class="form-control" />
                                                        </div>
                                                    </div>
                                                    <div class="row g-2">
                                                        <div class="col mb-0">
                                                            <label for="defaultSelect" class="form-label">Method</label>
                                                            <select id="methodAdd" class="form-select" name="method"
                                                                required>
                                                                <option value="Cheque">Cheque</option>
                                                                <option value="VirementBancaire">Virement Bancaire
                                                                </option>
                                                                <option value="Bspece">Bspece</option>
                                                                <option value="Autre">Autre</option>
                                                            </select>
                                                        </div>

                                                        <div class="col mb-0">
                                                            <label for="note" class="form-label">Note
                                                            </label>
                                                            <input type="text" name="note" id="noteAdd"
                                                                class="form-control" />
                                                        </div>
                                                        <div class="col mb-0">
                                                            <label for="numero" class="form-label">Numero
                                                            </label>
                                                            <input type="text" name="numero" id="numeroAdd"
                                                                class="form-control" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-secondary"
                                                        data-bs-dismiss="modal">
                                                        Close
                                                    </button>
                                                    <button type="button" onclick="submitInnerForm()"
                                                        class="btn btn-primary">Save
                                                        changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="table-responsive text-nowrap">
                            <table class="table" id="entered-details-table">
                                <thead class="table-light">
                                    <tr>
                                        <th>Date</th>
                                        <th>Montant</th>
                                        <th>Method</th>
                                        <th>Note</th>
                                        <th>Numero</th>
                                        @unless(auth()->user()->hasRole('comptable'))
                                        <th>Actions</th>
                                        @endunless
                                    </tr>
                                </thead>
                                @if($facture->paiments->isNotEmpty())
                                <tbody>
                                    @foreach($facture->paiments as $paiment)
                                    <tr>
                                        <td>{{ $paiment->date }}</td>
                                        <td>{{ $paiment->montant }}</td>
                                        <td>{{ $paiment->method }}</td>
                                        <td>{{ $paiment->note }}</td>
                                        <td>{{ $paiment->numero }}</td>
                                        @unless(auth()->user()->hasRole('comptable'))
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item edit-detailpaiment" href="#"
                                                        data-bs-toggle="modal" data-bs-target="#modalCenter2"
                                                        data-detailpaiment-id="{{ $paiment->id }}"
                                                        data-detailpaiment-date="{{ $paiment->date }}"
                                                        data-detailpaiment-method="{{ $paiment->method }}"
                                                        data-detailpaiment-montant="{{ $paiment->montant }}"
                                                        data-detailpaiment-numero="{{ $paiment->numero }}"
                                                        data-detailpaiment-note="{{ $paiment->note }}">
                                                        <i class="bx bx-edit-alt me-1"></i> Edit
                                                    </a>
                                                    @unless(auth()->user()->hasRole('admin'))
                                                    <form id="deleteForm{{ $paiment->id }}"
                                                        action="{{ route('paiments.destroy', $paiment->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a href="javascript:void(0);"
                                                            class="dropdown-item delete-paiment"
                                                            data-paiment-id="{{ $paiment->id }}">
                                                            <i class="bx bx-trash me-1"></i> Delete
                                                        </a>
                                                    </form>
                                                    @endunless

                                                </div>
                                            </div>
                                        </td>
                                        @endunless
                                    </tr>
                                    @endforeach
                                </tbody>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row text-end">
                <div class="col-sm-11 mt-3 mb-3">
                    <div class="btn-group dropup">
                        <button type="button" class="btn btn-primary text-end" onclick="window.open('{{ route('Fac.generate', ['FactureId' => $facture->id]) }}', '_blank')">
                            <i class="bx bx-export me-1"></i> Export Facture
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-lg-4 col-md-6">
    <div class="mt-3">
        <form id="editDetailPaimentForm" method="post"
            action="{{ route('paiments.update', ['paiment' => $facture->id]) }}">
            @csrf
            @method('PUT')
            <div class="modal fade" id="modalCenter2" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-body">

                            <div class="modal-header">
                                <h5 class="modal-title" id="modalCenterTitle">Modal title</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="detailpaiment_id" id="detailpaiment_id">

                                <div class="row g-2" style="margin-bottom: 10px">
                                    <div class="col mb-0">
                                        <label for="designation" class="form-label">date</label>
                                        <input type="date" class="form-control" name="date" id="date">
                                    </div>
                                    <div class="col mb-0">
                                        <label for="puht" class="form-label">Montant</label>
                                        <input type="text" class="form-control" name="montant" id="montant">
                                    </div>
                                </div>
                                <div class="row g-2">
                                    <div class="col mb-0">
                                        <label for="method" class="form-label">Method</label>
                                        <select id="method" class="form-select" name="method" required>
                                            <option value="Cheque">Cheque</option>
                                            <option value="VirementBancaire">Virement Bancaire</option>
                                            <option value="Bspece">Bspece</option>
                                            <option value="Autre">Autre</option>
                                        </select>
                                    </div>
                                    <div class="col mb-0">
                                        <label for="qte" class="form-label">Note</label>
                                        <input type="text" class="form-control" name="note" id="note">
                                    </div>

                                    <div class="col mb-0">
                                        <label for="numero" class="form-label">Numero</label>
                                        <input type="text" class="form-control" name="numero" id="numero">
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                    Close
                                </button>
                                <button type="button" onclick="submitInnerForm2()" class="btn btn-primary">Save
                                    changes</button>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Vertically Centered Modal -->
<div class="col-lg-4 col-md-6">
    <!-- Modal -->
    <div class="modal fade" id="modalCenter01" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="text-align: center">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body modal-confirm">
                    <div class="icon-box">
                        <i class='material-icons bx bx-x'></i>
                    </div>
                    <br />
                    <h4 style="text-align: center">Are you sure you want to delete this paiment? </h4>
                    <p style="color: #999;"> Do you really want to delete these records? This <br /> process cannot be
                        undone. </p>
                </div>
                <div class="modal-footer1">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button id="deleteButton" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).on('click', '.delete-paiment', function(event) {
        var triggerElement = $(this); // Element that triggered the modal
        var paimentId = triggerElement.data('paiment-id');
        var deleteForm = $('#deleteForm' + paimentId);

        // Set the paiment ID for the "Delete" button in the modal
        $('#deleteButton').data('paiment-id', paimentId);

        // Show the Bootstrap modal
        $('#modalCenter01').modal('show');
    });
    $(document).on('click', '#deleteButton', function(event) {
        // Handle the deletion process here
        var paimentId = $(this).data('paiment-id');
        var deleteForm = $('#deleteForm' + paimentId);

        // Perform form submission
        deleteForm.submit();

        // Close the Bootstrap modal
        $('#modalCenter01').modal('hide');
    });
    $('.edit-detailpaiment').on('click', function(event) {
        var triggerElement = $(this); // Element that triggered the modal

        // Set values in the modal form
        $('#detailpaiment_id').val(triggerElement.data('detailpaiment-id'));
        $('#date').val(triggerElement.data('detailpaiment-date'));
        $('#montant').val(triggerElement.data('detailpaiment-montant'));
        var selectedMethod = triggerElement.data('detailpaiment-method');
        $('#method option').each(function() {
            if ($(this).val() === selectedMethod) {
                $(this).prop('selected', true);
            }
        });        
        $('#note').val(triggerElement.data('detailpaiment-note'));
        $('#numero').val(triggerElement.data('detailpaiment-numero'));

        // Show the modal
        $('#modalCenter2').modal('show');
    });
    function validateFieldId(fieldName) {
        var fieldValue = $('[id="' + fieldName + '"]').val().trim();
        if (fieldValue === '') {
            $('[id="' + fieldName + '"]').css('border-color', 'red');
            return false;
        } else {
            $('[id="' + fieldName + '"]').css('border-color', ''); // Remove red border
            return true;
        }
    }
    function submitInnerForm() {
        // Process the inner form
        if (!validateFieldId('dateAdd')) return;
        if (!validateFieldId('montantAdd')) return;
        if (!validateFieldId('methodAdd')) return;
        $('#innerForm').submit();
    }

    // Add your logic to submit the form or handle the click event
    function submitInnerForm2() {
        if (!validateFieldId('date')) return;
        if (!validateFieldId('montant')) return;
        if (!validateFieldId('method')) return;
        // Process the inner form
        $('#editDetailPaimentForm').submit();
    }
</script>
@endsection