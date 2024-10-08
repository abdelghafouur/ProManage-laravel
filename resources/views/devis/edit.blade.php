@extends('layouts.app')

@section('content')
<h4 class="py-3 mb-4"><span class="text-muted fw-light"><a href="{{ route('devis.index') }}"
      style="color:#a1acb8 !important">Gestion Devis/</a></span> {{ $devis->codeDevis }}</h4>

<!-- Basic Layout & Basic with Icons -->
<div class="row">
  <div class="col-xxl">
    <div class="card mb-4">
      <div class="card-body">
        <form method="post" id="outerForm" action="{{ route('devis.update', $devis->id) }}">
          @csrf
          @method('put')

          <div class="row">
            <div class="mb-3 col-lg-6 col-md-6">
              <label class="form-label" for="designationDev">Designation</label>
              <input type="text" class="form-control" id="designationDev" name="designationDev"
                value="{{ $devis->designationDev }}" />
            </div>
            <div class="mb-3 col-lg-6 col-md-6">
              <label class="form-label" for="basic-default-fullname">Conditions de Règlement</label>
              <select id="defaultSelect" class="form-select" id="basic-default-fullname" name="conditionsDeReglement"
                required>
                <option value="A l'avance" {{ $devis->conditionsDeReglement == "A l'avance" ? 'selected' : '' }}>A
                  l'avance</option>
                <option value="A réception" {{ $devis->conditionsDeReglement == "A réception" ? 'selected' : '' }}>A
                  réception</option>
                <option value="50/50" {{ $devis->conditionsDeReglement == "50/50" ? 'selected' : '' }}>50/50</option>
              </select>
            </div>
            <div class="mb-3 col-lg-6 col-md-6">
              <label class="form-label" for="basic-default-company">Devis</label>
              <select id="defaultSelect" class="form-select" name="devis" required>
                <option value="DH - MAD" {{ $devis->devis == "DH - MAD" ? 'selected' : '' }}>DH - MAD</option>
                <option value="€ - EURO" {{ $devis->devis == "€ - EURO" ? 'selected' : '' }}>€ - EURO</option>
                <option value="$ - USD" {{ $devis->devis == "$ - USD" ? 'selected' : '' }}>$ - USD</option>
              </select>
            </div>
            <div class="mb-3 col-lg-6 col-md-6">
              <label for="defaultSelect" class="form-label">Client</label>
              <select id="defaultSelect" class="form-select" name="client_id" required>
                @foreach($clients as $client)
                <option value="{{ $client->id }}" {{ $devis->client_id == $client->id ? 'selected' : '' }}>{{
                  $client->nom }}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-3 col-lg-6 col-md-6">
              <label for="devis_id" class="form-label">Banque:</label>
              <select name="banque_id" class="form-select">
                  @foreach($banqueList as $banque)
                  <option value="{{ $banque->id }}" {{ $devis->banque_id == $banque->id ? 'selected' : ''
                      }}>
                      {{ $banque->nom }}
                  </option>
                  @endforeach
              </select>
          </div>
            <div class="mb-3 col-lg-6 col-md-6">
              <label for="html5-date-input" class="col-md-2 col-form-label">Date</label>
              <div class="col-md-12">
                <input class="form-control" type="date" value="{{ $devis->date }}" name="date" id="html5-date-input"
                  required />
              </div>
            </div>

        </form>
        <!-- Basic Layout -->
        <div class="container-xxl flex-grow-1">
          <!-- Bootstrap Table with Header - Light -->
          <div class="card">
            <h5 class="card-header">Detail Devis : </h5>
            <div class="card-body">
              <!-- Vertically Centered Modal -->
              <div class="col-lg-4 col-md-6">
                <div class="mt-3">
                  <!-- Button trigger modal -->
                  <button type="button" class="btn btn-outline-primary mb-3" data-bs-toggle="modal"
                    data-bs-target="#modalCenter">
                    Ajouter Detail Devis
                  </button>

                  <form method="post" id="innerForm" action="{{ route('details.store') }}">
                    @csrf
                    <!-- Modal -->
                    <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <input type="hidden" name="devis_id" value="{{ $devis->id }}" />

                          <div class="modal-header">
                            <h5 class="modal-title" id="modalCenterTitle">Ajouter Detail Devis</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <div class="row g-2" style="margin-bottom: 10px">
                              <div class="col mb-0">
                                <label for="designation" class="form-label">Description:</label>
                                <input type="text" name="designation" id="emailWithTitle1" class="form-control"
                                  required />
                              </div>
                              <div class="col mb-0">
                                <label for="puht" class="form-label">Prix HT:</label>
                                <input type="number" name="puht" id="dobWithTitle2" class="form-control" required />
                              </div>
                            </div>
                            <div class="row g-2">
                              <div class="col mb-0">
                                <label for="qte" class="form-label">Qte:</label>
                                <input type="number" name="qte" id="emailWithTitle3" class="form-control" required />
                              </div>
                              <div class="col mb-0">
                                <label for="tva" class="form-label">TVA:
                                </label>
                                <select id="defaultSelect" class="form-select" name="tva" required>
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
                    @if($devis->detailDevis->isNotEmpty())
                    @foreach($devis->detailDevis as $detail)
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

                            <a class="dropdown-item edit-detaildevis" href="#" data-bs-toggle="modal"
                              data-bs-target="#modalCenter2" data-detaildevis-id="{{ $detail->id }}"
                              data-detaildevis-designation="{{ $detail->designation }}"
                              data-detaildevis-puht="{{ $detail->puht }}" data-detaildevis-qte="{{ $detail->qte }}"
                              data-detaildevis-tva="{{ $detail->tva }}">
                              <i class="bx bx-edit-alt me-1"></i> Edit
                            </a>
                            @unless(auth()->user()->hasRole('admin'))
                            <form id="deleteForm{{ $detail->id }}"
                              action="{{ route('details.destroy', $detail->id,$devis->id) }}" method="POST">
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
        <div class="row text-end mt-3">
          <div class="col-sm-12">
            <button type="button" onclick="submitOuterForm()" class="btn btn-primary mx-4">Modifier Devis</button>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
</div>
<div class="col-lg-4 col-md-6">
  <div class="mt-3">
    <form id="editDetailDevisForm" method="post" action="{{ route('details.update', ['detail' => $devis->id]) }}">
      @csrf
      @method('PUT')
      <div class="modal fade" id="modalCenter2" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <!-- ... (Other modal content) ... -->
            <input type="hidden" name="detaildevis_id" id="detaildevis_id">

            <div class="modal-header">
              <h5 class="modal-title" id="modalCenterTitle">Modifier Detail Devis</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="row g-2" style="margin-bottom: 10px">
                <div class="col mb-0">
                  <label for="designation" class="form-label">Description:</label>
                  <input type="text" class="form-control" name="designation" id="designationEdite" required>
                </div>
                <div class="col mb-0">
                  <label for="puht" class="form-label">Prix HT:</label>
                  <input type="number" class="form-control" name="puht" id="puhtEdite" required>
                </div>
              </div>
              <div class="row g-2">
                <div class="col mb-0">
                  <label for="qte" class="form-label">Qte:</label>
                  <input type="number" class="form-control" name="qte" id="qteEdite" required>
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
              <button type="button" onclick="submitInnerForm2()" class="btn btn-primary">Save changes</button>
            </div>

            <!-- ... (Other form fields) ... -->


            <!-- ... (Other modal content) ... -->
          </div>
        </div>
      </div>
    </form>
  </div>

</div>
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
          <h4 style="text-align: center">Are you sure you want to delete this detail devis? </h4>
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
    $('.edit-detaildevis').on('click', function(event) {
        var triggerElement = $(this); // Element that triggered the modal

        // Set values in the modal form
        $('#detaildevis_id').val(triggerElement.data('detaildevis-id'));
        $('#designationEdite').val(triggerElement.data('detaildevis-designation'));
        $('#puhtEdite').val(triggerElement.data('detaildevis-puht'));
        $('#qteEdite').val(triggerElement.data('detaildevis-qte'));
        // Set selected option for the 'tvaedit' select element
        var tvaSelect = document.getElementById('tvaEdite');
        var selectedTva = triggerElement.data('detaildevis-tva');
        for (var i = 0; i < tvaSelect.options.length; i++) {
            if (tvaSelect.options[i].value == selectedTva) {
                tvaSelect.selectedIndex = i;
                break;
            }
        }

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
        // Validation for the first input

        // Validation for the second input
        if (!validateField('conditionsDeReglement')) return;
        if (!validateField('devis')) return;
        if (!validateField('client_id')) return;
        if (!validateField('date')) return;

        // Process the outer form
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
        $('#editDetailDevisForm').submit();
    }

</script>

@endsection