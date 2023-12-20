<!-- resources/views/factures/edit.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container-xxl flex-grow-1">
  <h4 class="py-3 mb-4"><span class="text-muted fw-light"><a href="{{ route('factures.index') }}"
        style="color:#a1acb8 !important">Gestion Factures/</a></span> {{ $facture->codeFacture }}</h4>

  <!-- Basic Layout & Basic with Icons -->
  <div class="row">
    <div class="col-xxl">
      <div class="card mb-4">
        <div class="card-body">
          <form method="post" id="outerForm" action="{{ route('factures.update', $facture->id) }}">
            @csrf
            @method('PATCH')
            <div class="row">

              <div class="mb-3 col-lg-6 col-md-6">
                <label for="client_id" class="form-label">Client:</label>
                <select name="client_id" class="form-select">
                  @foreach($clients as $client)
                  <option value="{{ $client->id }}" {{ $facture->client_id == $client->id ? 'selected' : '' }}>
                    {{ $client->nom }}
                  </option>
                  @endforeach
                </select>
              </div>
              <div class="mb-3 col-lg-6 col-md-6">
                <label for="devis_id" class="form-label">Code Devis:</label>
                <select name="devis_id" class="form-select">
                  <option value="" {{ $facture->devis_id == null ? 'selected' : '' }}>No Devis</option>
                  @foreach($devisList as $devis)
                  <option value="{{ $devis->id }}" {{ $facture->devis_id == $devis->id ? 'selected' : '' }}>
                    {{ $devis->codeDevis }}
                  </option>
                  @endforeach
                </select>
              </div>
              <div class="mb-3 col-lg-6 col-md-6">
                <label class="form-label" for="date">Date</label>
                <input class="form-control" type="date" name="date" value="{{ $facture->date }}" />
              </div>
              <div class="mb-3 col-lg-6 col-md-6">
                <label for="devis" class="col-md-2 col-form-label">Devis:</label>
                <div class="col-md-12">
                  <input class="form-control" type="text" name="devis" value="{{ $facture->devis }}" />
                </div>
              </div>
          </form>

          <!-- Basic Layout -->
          <div class="container-xxl flex-grow-1">
            <!-- Bootstrap Table with Header - Light -->
            <div class="card">
              <h5 class="card-header">Detail Facture : </h5>
              <div class="card-body">
                <!-- Vertically Centered Modal -->
                <div class="col-lg-4 col-md-6">
                  <div class="mt-3">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-outline-primary mb-3" data-bs-toggle="modal"
                      data-bs-target="#modalCenter">
                      Ajouter Detail Facture
                    </button>

                    <form method="post" id="innerForm" action="{{ route('detailsFac.store') }}">
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
                                  <label for="designation" class="form-label">DESIGNATION</label>
                                  <input type="text" name="designation" id="emailWithTitle1" class="form-control" />
                                </div>
                                <div class="col mb-0">
                                  <label for="puht" class="form-label">PUHT</label>
                                  <input type="text" name="puht" id="dobWithTitle2" class="form-control" />
                                </div>
                              </div>
                              <div class="row g-2">
                                <div class="col mb-0">
                                  <label for="qte" class="form-label">QTE</label>
                                  <input type="text" name="qte" id="emailWithTitle3" class="form-control" />
                                </div>
                                <div class="col mb-0">
                                  <label for="tva" class="form-label">TVA
                                  </label>
                                  <input type="text" name="tva" id="dobWithTitle4" class="form-control" />
                                </div>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                Close
                              </button>
                              <button type="button" onclick="submitInnerForm()" class="btn btn-primary">Save
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
                        <th>Designation</th>
                        <th>PUHT</th>
                        <th>Qte</th>
                        <th>TVA</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if($facture->detailFacture->isNotEmpty())
                      @foreach($facture->detailFacture as $detail)
                      <tr>
                        <td>{{ $detail->designation }}</td>
                        <td>{{ $detail->puht }}</td>
                        <td>{{ $detail->qte }}</td>
                        <td>{{ $detail->tva }}</td>
                        <td>
                          <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                              <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">

                              <a class="dropdown-item edit-detailfacture" href="#" data-bs-toggle="modal"
                                data-bs-target="#modalCenter2" data-detailfacture-id="{{ $detail->id }}"
                                data-detailfacture-designation="{{ $detail->designation }}"
                                data-detailfacture-puht="{{ $detail->puht }}"
                                data-detailfacture-qte="{{ $detail->qte }}" data-detailfacture-tva="{{ $detail->tva }}">
                                <i class="bx bx-edit-alt me-1"></i> Edit
                              </a>
                              @unless(auth()->user()->hasRole('admin'))
                              <form id="deleteForm{{ $detail->id }}"
                                action="{{ route('detailsFac.destroy', $detail->id,$facture->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <a href="javascript:void(0);" class="dropdown-item delete-detail"
                                  data-detail-id="{{ $detail->id }}">
                                  <i class="bx bx-trash me-1"></i> Delete
                                </a>
                              </form>
                              @endunless

                            </div>
                          </div>
                        </td>
                      </tr>
                      @endforeach
                      @endif
                    </tbody>
                    <tbody>

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="row justify-content-end">
            <div class="col-sm-2">
              <button type="button" onclick="submitOuterForm()" class="btn btn-primary mt-4">Edite Facture</button>
            </div>
          </div>
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

          <form id="editDetailFactureForm" method="post"
            action="{{ route('detailsFac.update', ['detailsFac' => $facture->id]) }}">

            @csrf
            @method('PUT')
            <div class="modal-header">
              <h5 class="modal-title" id="modalCenterTitle">Modal title</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="row g-2" style="margin-bottom: 10px">
                <input type="hidden" name="detailfacture_id" id="detailfacture_id">
                <div class="col mb-0">
                  <label for="designation" class="form-label">Designation</label>
                  <input type="text" class="form-control" name="designation" id="designationEdite">
                </div>
                <div class="col mb-0">
                  <label for="puht" class="form-label">PUHT</label>
                  <input type="text" class="form-control" name="puht" id="puhtEdite">
                </div>
              </div>
              <div class="row g-2">
                <div class="col mb-0">
                  <label for="qte" class="form-label">QTE</label>
                  <input type="text" class="form-control" name="qte" id="qteEdite">
                </div>
                <div class="col mb-0">
                  <label for="tva" class="form-label">TVA</label>
                  <input type="text" class="form-control" name="tva" id="tvaEdite">
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                Close
              </button>
              <button type="button" onclick="submitInnerForm2()" class="btn btn-primary">Save changes</button>
            </div>

          </form>

        </div>
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
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body modal-confirm">
          <div class="icon-box">
            <i class='material-icons bx bx-x'></i>
          </div>
          <br />
          <h4 style="text-align: center">Are you sure you want to delete this detail facture? </h4>
          <p style="color: #999;"> Do you really want to delete these records? This <br /> process cannot be undone.
          </p>
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
  $(document).on('click', '.delete-detail', function(event) {
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
        var deleteForm = $('#deleteForm' + detailId);

        // Perform form submission
        deleteForm.submit();

        // Close the Bootstrap modal
        $('#modalCenter01').modal('hide');
    });
  
  $('.edit-detailfacture').on('click', function (event) {
      var triggerElement = $(this); // Element that triggered the modal

      // Set values in the modal form
      $('#detailfacture_id').val(triggerElement.data('detailfacture-id'));
      $('#designationEdite').val(triggerElement.data('detailfacture-designation'));
      $('#puhtEdite').val(triggerElement.data('detailfacture-puht'));
      $('#qteEdite').val(triggerElement.data('detailfacture-qte'));
      $('#tvaEdite').val(triggerElement.data('detailfacture-tva'));

      // Show the modal
      $('#modalCenter2').modal('show');
  });
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
  function submitOuterForm() {
      // Process the outer form
      if (!validateField('client_id')) return;
        if (!validateField('date')) return;
        if (!validateField('devis')) return;
      $('#outerForm').submit();
  }

  function submitInnerForm() {
    if (!validateField('designation')) return;
        if (!validateField('puht')) return;
        if (!validateField('qte')) return;
        if (!validateField('tva')) return;
      // Process the inner form
      $('#innerForm').submit();
  }

  // Add your logic to submit the form or handle the click event
  function submitInnerForm2() {
    if (!validateFieldId('designationEdite')) return;
        if (!validateFieldId('puhtEdite')) return;
        if (!validateFieldId('qteEdite')) return;
        if (!validateFieldId('tvaEdite')) return;
    // Process the inner form
    $('#editDetailFactureForm').submit();
  }
</script>
@endsection