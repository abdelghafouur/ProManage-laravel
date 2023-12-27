<!-- resources/views/devis/create.blade.php -->

@extends('layouts.app')

@section('content')

<h4 class="py-3 mb-4"><span class="text-muted fw-light"><a href="{{ route('devis.index') }}" style="color:#a1acb8 !important">Gestion Devis/</a></span> Ajouter Devis</h4>

<!-- Basic Layout & Basic with Icons -->
<div class="row">
    <div class="col-xxl">
        <div class="card mb-4">
            <div class="card-body">
                <form method="post" action="{{ route('devis.store') }}" enctype="multipart/form-data" id="devis-form">
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-lg-6 col-md-6">
                            <label class="form-label" for="designationDev">Designation</label>
                            <input type="text" class="form-control" id="designationDev" name="designationDev" value="{{ $devis !== null ? $devis->designationDev : '' }}" />
                        </div>
                        <div class="mb-3 col-lg-6 col-md-6">
                            <label class="form-label" for="basic-default-fullname">Conditions de Règlement</label>
                            {{-- <input type="text" class="form-control" required id="basic-default-fullname"
                                name="conditionsDeReglement" /> --}}
                            <select id="defaultSelect" class="form-select" name="conditionsDeReglement" required>
                                <option value="A l'avance" {{ $devis !==null && $devis->conditionsDeReglement == "A
                                    l'avance" ? 'selected' : '' }}>A l'avance</option>
                                <option value="A réception" {{ $devis !==null && $devis->conditionsDeReglement == "A
                                    réception" ? 'selected' : '' }}>A réception</option>
                                <option value="50/50" {{ $devis !==null && $devis->conditionsDeReglement == "50/50" ?
                                    'selected' : '' }}>50/50</option>
                            </select>
                        </div>
                        <div class="mb-3 col-lg-6 col-md-6">
                            <label class="form-label" for="basic-default-company">Devise</label>
                            {{-- <input type="text" class="form-control" id="basic-default-company" name="devis"
                                required /> --}}
                            <select id="defaultSelect" class="form-select" name="devis" required>
                                <option value="DH - MAD" {{ $devis !==null && $devis->devis == "DH - MAD" ? 'selected' :
                                    '' }}>DH - MAD</option>
                                <option value="€ - EURO" {{ $devis !==null && $devis->devis == "€ - EURO" ? 'selected' :
                                    '' }}>€ - EURO</option>
                                <option value="$ - USD" {{ $devis !==null && $devis->devis == "$ - USD" ? 'selected' :
                                    '' }}>$ - USD</option>
                            </select>
                        </div>
                        <div class="mb-3 col-lg-6 col-md-6">
                            <label for="defaultSelect" class="form-label">Client</label>
                            <select id="defaultSelect" class="form-select" name="client_id" required>
                                @foreach($clients as $client)
                                <option value="{{ $client->id }}" {{ $devis !==null && $devis->client_id == $client->id
                                    ? 'selected' : '' }}>{{ $client->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 col-lg-6 col-md-6">
                            <label for="html5-date-input" class="col-md-2 col-form-label">Date</label>
                            <div class="col-md-12">
                                <input class="form-control" value="{{ $devis !== null ? $devis->date : '' }}" type="date" name="date" id="html5-date-input" />
                            </div>
                        </div>
                        <!-- Basic Layout -->
                        <div class="row">
                            <div class="col-xl">
                                <div class="card mb-4">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0">Ajouter Detail Devis : </h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="col-lg-4 col-md-6">
                                            <div class="mt-3">
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalCenter">
                                                    Ajouter Detail Facture
                                                </button>
                                                <!-- Modal -->
                                                <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="modalCenterTitle">Détail de
                                                                    la facture</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <input type="hidden" name="detail_deviss[]" id="detail-deviss">
                                                                <div class="row g-2" style="margin-bottom: 10px">
                                                                    <div class="col mb-0">
                                                                        <label for="designation" class="form-label">Description:</label>
                                                                        <input type="text" name="designation[]" id="designation" class="form-control" required />
                                                                    </div>
                                                                    <div class="col mb-0">
                                                                        <label for="puht" class="form-label">Prix
                                                                            HT:</label>
                                                                        <input type="number" name="puht[]" id="puht" class="form-control" required />
                                                                    </div>
                                                                </div>
                                                                <div class="row g-2">
                                                                    <div class="col mb-0">
                                                                        <label for="qte" class="form-label">Qte:</label>
                                                                        <input type="number" name="qte[]" id="qte" class="form-control" required />
                                                                    </div>
                                                                    <div class="col mb-0">
                                                                        <label class="form-label" for="tva[]">TVA:</label>
                                                                        <select id="defaultSelect" class="form-select" name="tva[]" id="tva" required>
                                                                            <option value="7">7%</option>
                                                                            <option value="10">10%</option>
                                                                            <option value="14">14%</option>
                                                                            <option value="20">20%</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                                                    Close
                                                                </button>
                                                                <button type="button" onclick="insertData()" class="btn btn-primary">Save
                                                                    changes</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <h5 class="card-header">Liste Details Devis : </h5>
                                        <div class="table-responsive text-nowrap">
                                            <table class="table" id="entered-details-table">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>Description</th>
                                                        <th>Prix Unitaire HT</th>
                                                        <th>Quantité</th>
                                                        <th>TVA</th>
                                                        <th>Total HT</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="table-border-bottom-0">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row text-end">
                            <div class="col-sm-12">
                                <button type="button" class="btn btn-primary text-end mx-4" onclick="submitForm()">Create Devis</button>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<div class="col-lg-4 col-md-6">
    <div class="mt-3">
        <div class="modal fade" id="modalCenter2" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalCenterTitle">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-2" style="margin-bottom: 10px">
                            <div class="col mb-0">
                                <label for="designation" class="form-label">Description:</label>
                                <input type="text" class="form-control" name="designation" id="designationEdite">
                            </div>
                            <div class="col mb-0">
                                <label for="puht" class="form-label">Prix HT:</label>
                                <input type="number" class="form-control" name="puht" id="puhtEdite">
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col mb-0">
                                <label for="qte" class="form-label">Qte:</label>
                                <input type="number" class="form-control" name="qte" id="qteEdite">
                            </div>
                            <div class="col mb-0">
                                <label for="tva" class="form-label">TVA:</label>
                                <select class="form-select" name="tva" id="tvaEdite" required>
                                    <option value="7">7%</option>
                                    <option value="10">10%</option>
                                    <option value="14">14%</option>
                                    <option value="20">20%</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="button" onclick="updateRow()" class="btn btn-primary">Save
                            changes</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // Initialize an array to store details
    var enteredDetails = [];
    @if($devis !== null)
    var countnp = 1;
    @foreach($devis->detaildevis as $detail)
    var detail = {
        'designation': '{{ $detail->designation }}'
        , 'puht': '{{ $detail->puht }}'
        , 'qte': '{{ $detail->qte }}'
        , 'tva': '{{ $detail->tva }}'
    };
    enteredDetails.push(detail);
    updateTable();
    @endforeach
    @endif

    function insertData() {
        var designations = document.getElementsByName('designation[]');
        var puhts = document.getElementsByName('puht[]');
        var qtes = document.getElementsByName('qte[]');
        var tvas = document.getElementsByName('tva[]');
        var ReqInput = false;

        for (var i = 0; i < designations.length; i++) {
            var etat1 = designations[i].value;
            var etat2 = puhts[i].value;
            var etat3 = qtes[i].value;
            var etat4 = tvas[i].value;
            if (etat1 != "" && etat2 != "" && etat3 != "" && etat4 != "") {
                ReqInput = true;
            } else {
                if (etat1.trim() === '') designations[i].style.borderColor = 'red';
                else designations[i].style.borderColor = '';

                if (etat2.trim() === '') puhts[i].style.borderColor = 'red';
                else puhts[i].style.borderColor = '';

                if (etat3.trim() === '') qtes[i].style.borderColor = 'red';
                else qtes[i].style.borderColor = '';

                if (etat4.trim() === '') tvas[i].style.borderColor = 'red';
                else tvas[i].style.borderColor = '';
            }
        }

        if (ReqInput) {
            for (var i = 0; i < designations.length; i++) {
                var detail = {
                    'designation': designations[i].value
                    , 'puht': puhts[i].value
                    , 'qte': qtes[i].value
                    , 'tva': tvas[i].value
                };
                enteredDetails.push(detail);
            }

            for (var i = 0; i < designations.length; i++) {
                designations[i].style.borderColor = '';
                puhts[i].style.borderColor = '';
                qtes[i].style.borderColor = '';
                tvas[i].style.borderColor = '';
            }

            updateTable();
            clearInputFields();
            $('#modalCenter').modal('hide');
        }
    }


    function validateField(fieldName) {
        var fieldValue = $('[name="' + fieldName + '"]').val().trim();
        if (fieldValue === '') {
            $('[name="' + fieldName + '"]').css('border-color', 'red');
            return false;
        } else {
            $('[name="' + fieldName + '"]').css('border-color', ''); // Remove red border
            return true;
        }
    }

    function deleteRow(index) {
        enteredDetails.splice(index, 1);
        updateTable();
    }

    function updateTable() {
        var tableBody = document.getElementById('entered-details-table').getElementsByTagName('tbody')[0];

        tableBody.innerHTML = '';
        var totalTTC = 0;
        var totalTVA = 0;
        var totalHT = 0;

        for (var i = 0; i < enteredDetails.length; i++) {
            var newRow = tableBody.insertRow(tableBody.rows.length);
            var cell1 = newRow.insertCell(0);
            var cell2 = newRow.insertCell(1);
            var cell3 = newRow.insertCell(2);
            var cell4 = newRow.insertCell(3);
            var cell5 = newRow.insertCell(4);
            var cell6 = newRow.insertCell(5);

            cell1.innerHTML = enteredDetails[i].designation;
            cell2.innerHTML = enteredDetails[i].puht;
            cell3.innerHTML = enteredDetails[i].qte;
            cell4.innerHTML = enteredDetails[i].tva + '%';
            cell5.innerHTML = (enteredDetails[i].puht * enteredDetails[i].qte);

            cell6.innerHTML = '<button onclick="editRow(' + i + ')">Edit</button> ' +
                '<button onclick="deleteRow(' + i + ')">Delete</button>';

            totalHT += (enteredDetails[i].puht * enteredDetails[i].qte);
            totalTTC += (enteredDetails[i].puht * enteredDetails[i].qte) * (1 + (enteredDetails[i].tva / 100));
            totalTVA = totalTVA + ((enteredDetails[i].puht * enteredDetails[i].qte * enteredDetails[i].tva) / 100);
        }

        if (totalTTC !== 0) {
            var newRow2 = tableBody.insertRow(tableBody.rows.length);
            var cell_1 = newRow2.insertCell(0);
            var cell_2 = newRow2.insertCell(1);
            var cell_3 = newRow2.insertCell(2);
            var cell_4 = newRow2.insertCell(3);
            var cell_5 = newRow2.insertCell(4);
            var cell_6 = newRow2.insertCell(5);
            cell_4.innerHTML = "Total HT : ";
            cell_5.innerHTML = totalHT;

            var newRow4 = tableBody.insertRow(tableBody.rows.length);
            var cell3_1 = newRow4.insertCell(0);
            var cell3_2 = newRow4.insertCell(1);
            var cell3_3 = newRow4.insertCell(2);
            var cell3_4 = newRow4.insertCell(3);
            var cell3_5 = newRow4.insertCell(4);
            var cell3_6 = newRow4.insertCell(5);
            cell3_4.innerHTML = "Total TVA : ";
            cell3_5.innerHTML = totalTVA;

            var newRow3 = tableBody.insertRow(tableBody.rows.length);
            var cell2_1 = newRow3.insertCell(0);
            var cell2_2 = newRow3.insertCell(1);
            var cell2_3 = newRow3.insertCell(2);
            var cell2_4 = newRow3.insertCell(3);
            var cell2_5 = newRow3.insertCell(4);
            var cell2_6 = newRow3.insertCell(5);
            cell2_4.innerHTML = "Total TTC : ";
            cell2_5.innerHTML = totalTTC;
        }
    }


    function submitForm() {

        // Validation for the second input
        if (!validateField('conditionsDeReglement')) return;
        if (!validateField('devis')) return;
        if (!validateField('client_id')) return;
        if (!validateField('date')) return;

        // If all validations pass, update the hidden input and submit the form
        $('#detail-deviss').val(JSON.stringify(enteredDetails));
        $('#devis-form').submit();
    }

    function clearInputFields() {
        var designations = document.getElementsByName('designation[]');
        var puhts = document.getElementsByName('puht[]');
        var qtes = document.getElementsByName('qte[]');
        var tvas = document.getElementsByName('tva[]');

        for (var i = 0; i < designations.length; i++) {
            designations[i].value = '';
            puhts[i].value = '';
            qtes[i].value = '';
            tvas[i].value = '';
        }
    }

    function editRow(index) {

        // Populate the modal with the values from enteredDetails[index]
        var detail = enteredDetails[index];

        // Assuming you have input fields with IDs for editing
        document.getElementById('designationEdite').value = detail.designation;
        document.getElementById('puhtEdite').value = detail.puht;
        document.getElementById('qteEdite').value = detail.qte;
        document.getElementById('tvaEdite').value = detail.tva;

        // Save the index of the row being edited
        window.editingIndex = index;
        $('#modalCenter2').modal('show');
    }

    function updateRow() {
        // Retrieve values from the edited input fields
        var editedDetail = {
            'designation': document.getElementById('designationEdite').value
            , 'puht': document.getElementById('puhtEdite').value
            , 'qte': document.getElementById('qteEdite').value
            , 'tva': document.getElementById('tvaEdite').value
        , };

        // Update the enteredDetails array at the specified index
        enteredDetails[window.editingIndex] = editedDetail;

        // Update the table
        updateTable();

        // Clear the editingIndex variable
        window.editingIndex = null;

        // Hide the modal
        $('#modalCenter2').modal('hide');
    }

</script>
@endsection
