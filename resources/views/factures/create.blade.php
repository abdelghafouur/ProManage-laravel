<!-- resources/views/factures/create.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container-xxl flex-grow-1">
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
                  <label for="defaultSelect1" class="form-label">Entreprise:</label>
                  <select id="defaultSelect1" class="form-select" name="entreprise_id" required>
                    @foreach($entreprises as $entreprise)
                        <option value="{{ $entreprise->id }}" {{ $entreprise->id == $EntrepriseDevis ? 'selected' : '' }}>{{ $entreprise->nom }}</option>
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
                  <label for="devis" class="col-md-2 col-form-label">Devis:</label>
                  <div class="col-md-12">
                    <input class="form-control" name="devis" value="{{ $DevisByID !== [] ? $DevisByID->devis : '' }}" type="text" id="devis" />
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
                                    <h5 class="modal-title" id="modalCenterTitle">Ajouter Detail Factutre</h5>
                                    <button
                                      type="button"
                                      class="btn-close"
                                      data-bs-dismiss="modal"
                                      aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body">
                                    <div class="row g-2" style="margin-bottom: 10px">
                                      <div class="col mb-0">
                                        <label for="designation" class="form-label">DESIGNATION</label>
                                        <input
                                          type="text"
                                          name="designation"
                                          id="designation"
                                          class="form-control"
                                          required
                                          />
                                      </div>
                                      <div class="col mb-0">
                                        <label for="puht" class="form-label">PUHT</label>
                                        <input type="text" name="puht" id="puht" class="form-control" required />
                                      </div>
                                    </div>
                                    <div class="row g-2">
                                      <div class="col mb-0">
                                        <label for="qte" class="form-label">QTE</label>
                                        <input
                                          type="text"
                                          name="qte"
                                          id="qte"
                                          class="form-control"
                                          required
                                          />
                                      </div>
                                      <div class="col mb-0">
                                        <label for="tva" class="form-label">TVA
                                        </label>
                                        <input type="text" name="tva" id="tva" class="form-control" required/>
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
                                        <input type="text" name="puht" id="puhtedit" class="form-control" required/>
                                      </div>
                                    </div>
                                    <div class="row g-2">
                                      <div class="col mb-0">
                                        <label for="qte" class="form-label">QTE</label>
                                        <input
                                          type="text"
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
                        <h5 class="card-header">Liste Details Facture</h5>
                        <div class="table-responsive text-nowrap">
                          <table class="table" id="dataArray">
                            <thead class="table-light">
                              <tr>
                                <th>Designation</th>
                                <th>PUHT</th>
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

  // Function to confirm and add a new item
  function confirmAddItem() {

    var newdesignation1 = document.getElementById('designation');
      var newpuht1 = document.getElementById('puht');
      var newqte1 = document.getElementById('qte');
      var newtva1 = document.getElementById('tva');
    
      var newdesignation = document.getElementById('designation').value;
      var newpuht = document.getElementById('puht').value;
      var newqte = document.getElementById('qte').value;
      var newtva = document.getElementById('tva').value;

      if (newdesignation && newpuht && newqte && newtva ) {
        if(dataArray.length == 0 )
          {
            var valueOfI = 0;
          }
        else
          {
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
           
          newdesignation1.value = '';
          newpuht1.value = '';
          newqte1.value = '';
          newtva1.value = '';
        renderTable();
        $('#modalCenter').modal('hide');

          // Reset the form and hide it
      } else {
          alert('Please enter All value.');
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

    // Function to update an item in the array and render the table
function updateItem() {
    var itemId = document.getElementById('idHideEdit').value;
    console.log(itemId);
    var itemToUpdate = dataArray.find(item => item.id == itemId);
    console.log(itemToUpdate);
    if (itemToUpdate) {
        // Get updated values from the modal form
        var updatedDesignation = document.getElementById('designationedit').value;
        var updatedPuht = document.getElementById('puhtedit').value;
        var updatedQte = document.getElementById('qteedit').value;
        var updatedTva = document.getElementById('tvaedit').value;

        console.log(updatedDesignation);

        // Update the item in the array
        itemToUpdate.designation = updatedDesignation;
        itemToUpdate.puht = updatedPuht;
        itemToUpdate.qte = updatedQte;
        itemToUpdate.tva = updatedTva;

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

  // Initial rendering of the table
  renderTable();
</script>
@endsection