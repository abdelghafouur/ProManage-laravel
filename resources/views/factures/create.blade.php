<!-- resources/views/factures/create.blade.php -->

@extends('layouts.app')

@section('content')

  <h4 class="py-3 mb-4"><span class="text-muted fw-light"><a href="{{ route('factures.index') }}" style="color:#a1acb8 !important">Gestion Factures/</a></span> Ajouter Facture</h4>

    <!-- Basic Layout & Basic with Icons -->
    <div class="row">
      <div class="col-xxl">
        <div class="card mb-4">
          <div class="card-body">
            <form method="post" action="{{ route('factures.store') }}" enctype="multipart/form-data" id="factures-form">
              @csrf
              <input type="hidden" name="detail_factures[]" id="detail-factures">
              <div class="row"> 
                <div class="mb-3 col-lg-6 col-md-6">
                  <label for="defaultSelect" class="form-label">Client:</label>
                  <select id="defaultSelect" class="form-select" name="client_id" required>
                    @foreach($clients as $client)
                        <option value="{{ $client->id }}" {{ $client->id == $ClientDevis ? 'selected' : '' }}>{{ $client->nom }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="mb-3 col-lg-6 col-md-6">
                  <label for="defaultSelect2" class="form-label">Code Devis:</label>
                  <!--                   <select id="defaultSelect1" class="form-select" name="devis_id" {/{ $selectedDevisId !== null ? 'disabled' : '' }}> -->
                  <select id="defaultSelect1" class="form-select" name="devis_id">
                    <option value="">No Devis</option>
                    @foreach($devisList as $devis)
                        <option value="{{ $devis->id }}" {{ $devis->id == $selectedDevisId ? 'selected' : '' }}>
                            {{ $devis->codeDevis }}
                        </option>
                    @endforeach
                  </select>
                </div>
                <div class="mb-3 col-lg-6 col-md-6">
                  <label for="devis" class="col-md-2 col-form-label">Devise:</label>
                  <div class="col-md-12">
                    {{-- <input class="form-control" name="devis" type="text" id="devis" /> --}}
                    <select id="defaultSelect" class="form-select" name="devis" required>
                      <option value="DH - MAD" value="{{ $DevisByID == "DH - MAD" ? selected : '' }}" >DH - MAD</option>
                      <option value="€ - EURO" value="{{ $DevisByID == "€ - EURO" ? selected : '' }}">€ - EURO</option>
                      <option value="$ - USD" value="{{ $DevisByID == "$ - USD" ? selected : '' }}">$ - USD</option>
                  </select>
                  </div>
                </div>
                <div class="mb-3 col-lg-6 col-md-6">
                  <label for="html5-date-input" class="col-md-2 col-form-label">Date: </label>
                  <div class="col-md-12">
                    <input class="form-control" name="date" type="date" id="html5-date-input" required />
                  </div>
                </div>
              </div>
              <!-- Basic Layout -->
              <div class="row">
                <div class="col-xl">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0"> Detail Facture : </h5>
                    </div>
                    <div class="card-body">
                            <!-- Vertically Centered Modal -->
                        <div class="col-lg-4 col-md-6">
                          <div class="mt-3">
                            <!-- Button trigger modal -->
                            <button
                              type="button"
                              class="btn btn-outline-primary"
                              data-bs-toggle="modal"
                              data-bs-target="#modalCenter">
                              Ajouter Detail Facture
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="modalCenterTitle">Détail de la facture</h5>
                                    <button
                                      type="button"
                                      class="btn-close"
                                      data-bs-dismiss="modal"
                                      aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body">
                                    <div class="row g-2" style="margin-bottom: 10px">
                                      <div class="col mb-0">
                                        <label for="designation" class="form-label">DESCRIPTION</label>
                                        <input
                                          type="text"
                                          name="designation"
                                          id="designation"
                                          class="form-control"
                                          required
                                          />
                                      </div>
                                      <div class="col mb-0">
                                        <label for="puht" class="form-label">PU HT</label>
                                        <input type="number" name="puht" id="puht" class="form-control" required />
                                      </div>
                                    </div>
                                    <div class="row g-2">
                                      <div class="col mb-0">
                                        <label for="qte" class="form-label">QTE</label>
                                        <input
                                          type="number"
                                          name="qte"
                                          id="qte"
                                          class="form-control"
                                          required
                                          />
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
                                    <button type="button" onclick="confirmAddItem()" class="btn btn-primary">Save changes</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                          <div class="mt-3">
                            <!-- Button trigger modal -->
                      
                            <div class="modal fade" id="modalCenter2" tabindex="-1" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="modalCenterTitle">Modifier Detail Facture</h5>
                                    <button
                                      type="button"
                                      class="btn-close"
                                      data-bs-dismiss="modal"
                                      aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body">
                                  <input type="hidden" name="idHideEdit" id="idHideEdit">
                                    <div class="row g-2" style="margin-bottom: 10px">
                                      <div class="col mb-0">
                                        <label for="designation" class="form-label">DESIGNATION</label>
                                        <input
                                          type="text"
                                          name="designation"
                                          id="designationedit"
                                          class="form-control"
                                          required
                                          />
                                      </div>
                                      <div class="col mb-0">
                                        <label for="puht" class="form-label">PUHT</label>
                                        <input type="number" name="puht" id="puhtedit" class="form-control" required/>
                                      </div>
                                    </div>
                                    <div class="row g-2">
                                      <div class="col mb-0">
                                        <label for="qte" class="form-label">QTE</label>
                                        <input
                                          type="number"
                                          name="qte"
                                          id="qteedit"
                                          class="form-control"
                                          required
                                          />
                                      </div>
                                      <div class="col mb-0">
                                        <label for="tva" class="form-label">TVA
                                        </label>
                                        <input type="text" name="tva" id="tvaedit" class="form-control" required />
                                      </div>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                      Close
                                    </button>
                                    <button type="button" onclick="updateItem()" class="btn btn-primary">Save changes</button>
                                  </div>
                                </div>
                              </div>
                          </div>
                          
                          </div>
                        </div>
                        
                        <div class="table-responsive text-nowrap">
                          <table class="table" id="dataArray">
                            <thead class="table-light">
                              <tr>
                                <th>Description</th>
                                <th>Prix Unitaire HT</th>
                                <th>Qte</th>
                                <th>TVA</th>
                                <th>Total HT</th>
                                <th>Actions</th>
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
              <div class="row justify-content-end">
                <div class="col-sm-2">
                  <button type="button" class="btn btn-primary mx-3" onclick="submitForm()">Create Facture</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
<!-- Vertically Centered Modal -->
<div class="col-lg-4 col-md-6">
  <!-- Modal -->
  <div class="modal fade" id="modalCenter01" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content" style="text-align: center">
        <div class="modal-header">
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"></button>
        </div>
        <div class="modal-body modal-confirm">
            <div class="icon-box">
                <i class='material-icons bx bx-x'></i>
            </div>
            <br/>
            <h4 style="text-align: center">Are you sure you want to delete this detail? </h4>
            <p style="color: #999;"> Do you really want to delete these records? This <br/> process cannot be undone. </p>
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

<script>
    // Sample array
    var dataArray = [];
    
    $(document).on('click', '.delete-detail1', function(event) {
        var triggerElement = $(this); // Element that triggered the modal
        var detailId = triggerElement.data('detail-id');
        var deleteForm = $('#deleteForm' + detailId);

        // Set the detail ID for the "Delete" button in the modal
        $('#deleteButton').data('detail-id', detailId);

        // Show the Bootstrap modal
        $('#modalCenter01').modal('show');
    });
    $(document).on('click', '#deleteButton', function(event) {
    // Handle the deletion process here
      var detailId = $(this).data('detail-id');

        // Filter the array to remove the item with the specified detailId
      dataArray = dataArray.filter(item => item.id !== detailId);

        // Render the table (replace this with your actual rendering logic)
        renderTable();
    // Close the Bootstrap modal
    $('#modalCenter01').modal('hide');
    });

    // Add values from the database to the array
    @if($selectedDevisId !== null)
        var countnp = 1;
        @foreach($detaildevis as $detail)
            var detail = {
                'id' : countnp,
                'designation': '{{ $detail->designation }}',
                'puht': '{{ $detail->puht }}',
                'qte': '{{ $detail->qte }}',
                'tva': '{{ $detail->tva }}'
            };
            dataArray.push(detail);
            countnp  = countnp + 1;
        @endforeach
    @endif

  // Submit the form with entered details
  function submitForm() {
        if (!validateField('client_id')) return;
        if (!validateField('devis')) return;
        if (!validateField('date')) return;

  // Update the hidden input with the JSON representation of entered details
  document.getElementById('detail-factures').value = JSON.stringify(dataArray);
  // Submit the form using its ID
  document.getElementById('factures-form').submit();
  }

  // Function to render the table based on the array
  function renderTable() {
    var designations = document.getElementsByName('designation[]');
    var puhts = document.getElementsByName('puht[]');
    var qtes = document.getElementsByName('qte[]');
    var tvas = document.getElementsByName('tva[]');
      var tableBody = document.getElementById('dataArray').getElementsByTagName('tbody')[0];
      tableBody.innerHTML = '';
      var totalTTC = 0;
        var totalTVA = 0;
        var totalHT = 0;

      dataArray.forEach(function(item) {
          var row = tableBody.insertRow();
          var celldesignation = row.insertCell(0);
          var cellpuht = row.insertCell(1);
          var cellqte = row.insertCell(2);
          var celltva = row.insertCell(3);
          var cell5 = row.insertCell(4);
          var cellAction = row.insertCell(5);

          celldesignation.innerHTML = item.designation;
          cellpuht.innerHTML = item.puht;
          cellqte.innerHTML = item.qte;
          celltva.innerHTML = item.tva + '%';
          cell5.innerHTML = (item.puht * item.qte);
          cellAction.innerHTML = '<div class="dropdown">' +
                              '<button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">' +
                              '<i class="bx bx-dots-vertical-rounded"></i>' +
                              '</button>' +
                              '<div class="dropdown-menu">' +
                              '<a class="dropdown-item " href="#"' +
                              'onclick="editItem(' + item.id + ')"' +
                              'data-bs-toggle="modal" data-bs-target="#modalCenter2">' +
                              '<i class="bx bx-edit-alt me-1"></i> Edit' +
                              '</a>' +
                              //'<a href="javascript:void(0);" class="dropdown-item" onclick="deleteItem(' + item.id + ')" data-detail-id="' + item.id + '">' +
                              '<a href="javascript:void(0);" class="dropdown-item delete-detail1" data-detail-id="' + item.id + '">'+
                              '<i class="bx bx-trash me-1"></i> Delete' +
                              '</a>' +
                              '</div>' +
                              '</div>';
          totalHT += (item.puht * item.qte);
          totalTTC += (item.puht * item.qte) * (1 + (item.tva / 100));
          totalTVA = totalTVA + ((item.puht * item.qte * item.tva)/100);
      });

        if (dataArray.length != 0)   
          {
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
          }
  }

  function confirmAddItem() {
    var newdesignation1 = document.getElementById('designation');
    var newpuht1 = document.getElementById('puht');
    var newqte1 = document.getElementById('qte');
    var newtva1 = document.getElementById('tva');

    var newdesignation = newdesignation1.value;
    var newpuht = newpuht1.value;
    var newqte = newqte1.value;
    var newtva = newtva1.value;

    // Check if any of the input fields is empty
    var isError = false;

    if (newdesignation.trim() === '') {
        newdesignation1.style.borderColor = 'red';
        isError = true;
    } else {
        newdesignation1.style.borderColor = ''; // Reset border color
    }

    if (newpuht.trim() === '') {
        newpuht1.style.borderColor = 'red';
        isError = true;
    } else {
        newpuht1.style.borderColor = ''; // Reset border color
    }

    if (newqte.trim() === '') {
        newqte1.style.borderColor = 'red';
        isError = true;
    } else {
        newqte1.style.borderColor = ''; // Reset border color
    }

    if (newtva.trim() === '') {
        newtva1.style.borderColor = 'red';
        isError = true;
    } else {
        newtva1.style.borderColor = ''; // Reset border color
    }

    if (isError) {
        // If there's an error, you may want to handle it accordingly (e.g., display a message)
        return;
    }

    if (newdesignation && newpuht && newqte && newtva) {
        if (dataArray.length == 0) {
            var valueOfI = 0;
        } else {
            var lastElement = dataArray[dataArray.length - 1];
            var valueOfI = lastElement['id'];
        }
        var newItem = {
            id: valueOfI + 1,
            designation: newdesignation,
            puht: newpuht,
            qte: newqte,
            tva: newtva,
        };

        dataArray.push(newItem);

        // Reset the form
        newdesignation1.value = '';
        newpuht1.value = '';
        newqte1.value = '';
        newtva1.value = '';

        // Optionally, reset the border colors after successful submission
        newdesignation1.style.borderColor = '';
        newpuht1.style.borderColor = '';
        newqte1.style.borderColor = '';
        newtva1.style.borderColor = '';

        renderTable();
        $('#modalCenter').modal('hide');
    }
}


   // Function to edit an item in the array and render the table
   function editItem(itemId) {
        var itemToEdit = dataArray.find(item => item.id === itemId);
        if (itemToEdit) {
            // Set current values in the modal form
            document.getElementById('designationedit').value = itemToEdit.designation;
            document.getElementById('puhtedit').value = itemToEdit.puht;
            document.getElementById('qteedit').value = itemToEdit.qte;
            document.getElementById('tvaedit').value = itemToEdit.tva;
            document.getElementById('idHideEdit').value = itemId;
        }
        

    }

    function updateItem() {
    var itemId = document.getElementById('idHideEdit').value;
    console.log(itemId);
    var itemToUpdate = dataArray.find(item => item.id == itemId);
    console.log(itemToUpdate);
    
    if (itemToUpdate) {
        // Get updated values from the modal form
        var updatedDesignation = document.getElementById('designationedit');
        var updatedPuht = document.getElementById('puhtedit');
        var updatedQte = document.getElementById('qteedit');
        var updatedTva = document.getElementById('tvaedit');

        // Check if any of the input fields is empty
        var isError = false;

        if (updatedDesignation.value.trim() === '') {
            updatedDesignation.style.borderColor = 'red';
            isError = true;
        } else {
            updatedDesignation.style.borderColor = ''; // Reset border color
        }

        if (updatedPuht.value.trim() === '') {
            updatedPuht.style.borderColor = 'red';
            isError = true;
        } else {
            updatedPuht.style.borderColor = ''; // Reset border color
        }

        if (updatedQte.value.trim() === '') {
            updatedQte.style.borderColor = 'red';
            isError = true;
        } else {
            updatedQte.style.borderColor = ''; // Reset border color
        }

        if (updatedTva.value.trim() === '') {
            updatedTva.style.borderColor = 'red';
            isError = true;
        } else {
            updatedTva.style.borderColor = ''; // Reset border color
        }

        if (isError) {
            // If there's an error, you may want to handle it accordingly (e.g., display a message)
            return;
        }

        // Update the item in the array
        itemToUpdate.designation = updatedDesignation.value;
        itemToUpdate.puht = updatedPuht.value;
        itemToUpdate.qte = updatedQte.value;
        itemToUpdate.tva = updatedTva.value;

        // Optionally, you can re-render the table to reflect the changes
        renderTable();
        $('#modalCenter2').modal('hide');
    }
}


  // Function to delete an item from the array and render the table
  function deleteItem(itemId) {
      var confirmDelete = confirm('Are you sure you want to delete this Details?');
      if (confirmDelete) {
          dataArray = dataArray.filter(item => item.id !== itemId);
          renderTable();
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

  // Initial rendering of the table
  renderTable();
</script>
@endsection