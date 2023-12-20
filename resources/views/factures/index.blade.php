<!-- resources/views/factures/index.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container-xxl flex-grow-1">
  <h4 class="py-3 mb-4"><span class="text-muted fw-light"><a href="{{ route('factures.index') }}"
        style="color:#a1acb8 !important">Gestion Factures/</a></span> Liste Factures</h4>
  <!-- Bootstrap Table with Header - Light -->
  <div class="card">
    <div class="table-responsive text-nowrap">
      <div class="dt-action-buttons text-end mt-4 mb-3" style="margin-right: 20px;">
        <label class="mx-3">
          <input type="search" id="clientSearch" placeholder="Search by Name" class="form-control" />
        </label>
        @unless(auth()->user()->hasRole('comptable'))
        <button type="button" onclick="window.location.href='{{ route('factures.create') }}'"
          class="btn btn-outline-primary">
          Ajouter Facture
        </button>
        @endunless

      </div>
      <table class="table">
        <thead class="table-light">
          <tr>
            <th>Code Facture</th>
            <th>Client</th>
            <th>Entreprise</th>
            <th>Devis</th>
            <th>Date</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          @foreach($factures as $facture)
          <tr>
            <td>{{ $facture->codeFacture }}</td>
            <td>{{ $facture->client->nom }}</td>
            <td>{{ $facture->entreprise->nom }}</td>
            <td>{{ $facture->devis }}</td>
            <td>{{ $facture->date }}</td>
            <td>
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="{{ route('factures.show', $facture->id) }}"><i
                      class='bx bx-show-alt me-1'></i> Show</a>
                  @unless(auth()->user()->hasRole('comptable'))
                  <a class="dropdown-item" href="{{ route('factures.edit', $facture->id) }}"><i
                      class="bx bx-edit-alt me-1"></i> Edit</a>
                  @unless(auth()->user()->hasRole('admin'))
                  <form id="deleteForm{{ $facture->id }}" action="{{ route('factures.destroy', $facture->id) }}"
                    method="POST">
                    @csrf
                    @method('DELETE')
                    <a href="javascript:void(0);" class="dropdown-item delete-facture"
                      data-facture-id="{{ $facture->id }}">
                      <i class="bx bx-trash me-1"></i> Delete
                    </a>
                  </form>
                  @endunless
                  @endunless
                </div>
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      {{ $factures->links('custom-pagination') }}
    </div>
  </div>
</div>
<!-- Vertically Centered Modal -->
<div class="col-lg-4 col-md-6">
  <!-- Modal -->
  <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
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
          <h4 style="text-align: center">Are you sure you want to delete this facture? </h4>
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
  $(document).on('click', '.delete-facture', function(event) {
        var triggerElement = $(this); // Element that triggered the modal
        var factureId = triggerElement.data('facture-id');
        var deleteForm = $('#deleteForm' + factureId);

        // Set the facture ID for the "Delete" button in the modal
        $('#deleteButton').data('facture-id', factureId);

        // Show the Bootstrap modal
        $('#modalCenter').modal('show');
    });
    $(document).on('click', '#deleteButton', function(event) {
        // Handle the deletion process here
        var factureId = $(this).data('facture-id');
        var deleteForm = $('#deleteForm' + factureId);

        // Perform form submission
        deleteForm.submit();

        // Close the Bootstrap modal
        $('#modalCenter').modal('hide');
    });
  $(document).ready(function() {
      // Handle client search by name
      $("#clientSearch").on("input", function() {
          var searchValue = $(this).val().toLowerCase();

          $("tbody tr").filter(function() {
              var clientName = $(this).find("td:eq(1)").text().toLowerCase(); // Index 1 corresponds to the "Nom" column
              $(this).toggle(clientName.indexOf(searchValue) > -1);
          });
      });
  });
</script>
@endsection