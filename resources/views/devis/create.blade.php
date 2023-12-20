<!-- resources/views/devis/create.blade.php -->

@extends('layouts.app')

@section('content')

<div class="container-xxl flex-grow-1">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light"><a href="{{ route('devis.index') }}"
                style="color:#a1acb8 !important">Gestion Devis/</a></span> Ajouter Devis</h4>

    <!-- Basic Layout & Basic with Icons -->
    <div class="row">
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-body">
                    <form method="post" action="{{ route('devis.store') }}" enctype="multipart/form-data"
                        id="devis-form">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-lg-6 col-md-6">
                                <label class="form-label" for="designationDev">Designation</label>
                                <input type="text" class="form-control" id="designationDev" name="designationDev"
                                    required />
                            </div>
                            <div class="mb-3 col-lg-6 col-md-6">
                                <label class="form-label" for="basic-default-fullname">Conditions de Règlement</label>
                                <input type="text" class="form-control" required id="basic-default-fullname"
                                    name="conditionsDeReglement" />
                            </div>
                            <div class="mb-3 col-lg-6 col-md-6">
                                <label class="form-label" for="basic-default-company">Devis</label>
                                <input type="text" class="form-control" id="basic-default-company" name="devis"
                                    required />
                            </div>
                            <div class="mb-3 col-lg-6 col-md-6">
                                <label for="defaultSelect" class="form-label">Client</label>
                                <select id="defaultSelect" class="form-select" name="client_id" required>
                                    @foreach($clients as $client)
                                    <option value="{{ $client->id }}">{{ $client->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 col-lg-6 col-md-6">
                                <label for="html5-date-input" class="col-md-2 col-form-label">Date</label>
                                <div class="col-md-12">
                                    <input class="form-control" type="date" name="date" id="html5-date-input"
                                        required />
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
                                            <div class="row">
                                                <!-- Add this hidden input inside the form -->
                                                <input type="hidden" name="detail_deviss[]" id="detail-deviss">
                                                <div class="mb-3 col-lg-3 col-md-4">
                                                    <label class="form-label" for="designation[]">Designation:</label>
                                                    <input type="text" class="form-control" name="designation[]"
                                                        required />
                                                </div>
                                                <div class="mb-3 col-lg-3 col-md-4">
                                                    <label class="form-label" for="puht[]">PUHT:</label>
                                                    <input type="text" class="form-control" name="puht[]" required />
                                                </div>
                                                <div class="mb-3 col-lg-3 col-md-4">
                                                    <label class="form-label" for="qte[]">Qte:</label>
                                                    <input type="text" class="form-control" name="qte[]" required />
                                                </div>
                                                <div class="mb-3 col-lg-3 col-md-4">
                                                    <label class="form-label" for="tva[]">TVA:</label>
                                                    <input type="text" class="form-control" name="tva[]" required />
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-outline-primary"
                                                onclick="insertData()">Ajouter</button>
                                            <h5 class="card-header">Liste Details Devis : </h5>
                                            <div class="table-responsive text-nowrap">
                                                <table class="table" id="entered-details-table">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th>Designation</th>
                                                            <th>PUHT</th>
                                                            <th>Qte</th>
                                                            <th>TVA</th>
                                                            <th>Total HT</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="table-border-bottom-0">
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!--/ Striped Rows -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row text-end">
                                <div class="col-sm-12">
                                    <button type="button" class="btn btn-primary text-end mx-4"
                                        onclick="submitForm()">Create Devis</button>
                                </div>
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
   
    function insertData() {
    // Get detail devis field values
    var designations = document.getElementsByName('designation[]');
    var puhts = document.getElementsByName('puht[]');
    var qtes = document.getElementsByName('qte[]');
    var tvas = document.getElementsByName('tva[]');
    var ReqInput = false;

    // Check if any of the input fields is empty
    for (var i = 0; i < designations.length; i++) {
        var etat1 = designations[i].value;
        var etat2 = puhts[i].value;
        var etat3 = qtes[i].value;
        var etat4 = tvas[i].value;
        if (etat1 != "" && etat2 != "" && etat3 != "" && etat4 != "") {
            ReqInput = true;
        } else {
            // Set border color to red for empty fields
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

    // Loop through the detail devis fields and add values to the array
    if (ReqInput) {
        for (var i = 0; i < designations.length; i++) {
            var detail = {
                'designation': designations[i].value,
                'puht': puhts[i].value,
                'qte': qtes[i].value,
                'tva': tvas[i].value
            };
            enteredDetails.push(detail);
        }

        // Reset border colors
        for (var i = 0; i < designations.length; i++) {
            designations[i].style.borderColor = '';
            puhts[i].style.borderColor = '';
            qtes[i].style.borderColor = '';
            tvas[i].style.borderColor = '';
        }

        // Update the table with the entered details
        var tableBody = document.getElementById('entered-details-table').getElementsByTagName('tbody')[0];

        // Clear existing rows
        tableBody.innerHTML = '';
        var totalTTC = 0;
        var totalTVA = 0;
        var totalHT = 0;

        // Add new rows with entered details
        for (var i = 0; i < enteredDetails.length; i++) {
            var newRow = tableBody.insertRow(tableBody.rows.length);
            var cell1 = newRow.insertCell(0);
            var cell2 = newRow.insertCell(1);
            var cell3 = newRow.insertCell(2);
            var cell4 = newRow.insertCell(3);
            var cell5 = newRow.insertCell(4);

            cell1.innerHTML = enteredDetails[i].designation;
            cell2.innerHTML = enteredDetails[i].puht;
            cell3.innerHTML = enteredDetails[i].qte;
            cell4.innerHTML = enteredDetails[i].tva + '%';
            cell5.innerHTML = (enteredDetails[i].puht * enteredDetails[i].qte);

            totalHT += (enteredDetails[i].puht * enteredDetails[i].qte);
            totalTTC += (enteredDetails[i].puht * enteredDetails[i].qte) * (1 + (enteredDetails[i].tva / 100));
            totalTVA = totalTVA + ((enteredDetails[i].puht * enteredDetails[i].qte * enteredDetails[i].tva) / 100);
        }

        // Add total rows
        var newRow2 = tableBody.insertRow(tableBody.rows.length);
        var cell_1 = newRow2.insertCell(0);
        var cell_2 = newRow2.insertCell(1);
        var cell_3 = newRow2.insertCell(2);
        var cell_4 = newRow2.insertCell(3);
        var cell_5 = newRow2.insertCell(4);
        cell_4.innerHTML = "Total HT : ";
        cell_5.innerHTML = totalHT;

        var newRow4 = tableBody.insertRow(tableBody.rows.length);
        var cell3_1 = newRow4.insertCell(0);
        var cell3_2 = newRow4.insertCell(1);
        var cell3_3 = newRow4.insertCell(2);
        var cell3_4 = newRow4.insertCell(3);
        var cell3_5 = newRow4.insertCell(4);
        cell3_4.innerHTML = "Total TVA : ";
        cell3_5.innerHTML = totalTVA;

        var newRow3 = tableBody.insertRow(tableBody.rows.length);
        var cell2_1 = newRow3.insertCell(0);
        var cell2_2 = newRow3.insertCell(1);
        var cell2_3 = newRow3.insertCell(2);
        var cell2_4 = newRow3.insertCell(3);
        var cell2_5 = newRow3.insertCell(4);
        cell2_4.innerHTML = "Total TTC : ";
        cell2_5.innerHTML = totalTTC;

        // Clear input fields
        for (var i = 0; i < designations.length; i++) {
            designations[i].value = '';
            puhts[i].value = '';
            qtes[i].value = '';
            tvas[i].value = '';
        }

        console.log(JSON.stringify(enteredDetails)); // Output the current details for debugging
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

    function submitForm() {
        // Validation for the first input
        if (!validateField('designationDev')) return;

        // Validation for the second input
        if (!validateField('conditionsDeReglement')) return;
        if (!validateField('devis')) return;
        if (!validateField('client_id')) return;
        if (!validateField('date')) return;

        // If all validations pass, update the hidden input and submit the form
        $('#detail-deviss').val(JSON.stringify(enteredDetails));
        $('#devis-form').submit();
    }
</script>
@endsection