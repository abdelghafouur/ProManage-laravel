@extends('layouts.app')

@section('content')
<div class="container-xxl flex-grow-1">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light"><a href="{{ route('entreprises.index') }}" style="color:#a1acb8 !important">Gestion Entreprises/</a></span> Liste Entreprises</h4>
    <!-- Bootstrap Table with Header - Light -->
    <div class="card">

        <div class="table-responsive text-nowrap"> 
            
          <div class="dt-action-buttons text-end mt-4" style="margin-right: 20px;">
            <label class="mx-3">
              <input type="search" id="entrepriseSearch" placeholder="Search by Name" class="form-control "/>
            </label>
            <button type="button" onclick="window.location.href='{{ route('entreprises.create') }}'" class="btn btn-outline-primary">
              Ajouter Entreprise
          </button>
          </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Adresse</th>
                        <th>Telephone</th>
                        <th>Default</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($entreprises as $entreprise)
                    <tr>
                        <td>{{ $entreprise->nom }}</td>
                        <td>{{ $entreprise->email }}</td>
                        <td>{{ $entreprise->adresse }}</td>
                        <td>{{ $entreprise->telephone }}</td>
                        <td>
                            <form id="updateForm" action="{{ route('updateDEf.entreprise') }}" method="POST">
                                @csrf
                                <input type="hidden" name="entreprise_id" id="entrepriseIdInput">
                            </form>
                            <label class="switch switch-info">
                                <input type="radio" 
                                       name="default" 
                                       class="switch-input"
                                       data-entreprise-id="{{ $entreprise->id }}"  
                                       {{ $entreprise->default == 1 ? 'checked' : '' }}> <!-- Set the checked attribute based on the default value -->
                                <span class="switch-toggle-slider">
                                    <span class="switch-on">
                                        <i class="bx bx-check"></i>
                                    </span>
                                    <span class="switch-off">
                                        <i class="bx bx-x"></i>
                                    </span>
                                </span>
                            </label>
                        </td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('entreprises.show', $entreprise->id) }}"><i class='bx bx-show-alt me-1'></i> Show</a>
                                    <a class="dropdown-item" href="{{ route('entreprises.edit', $entreprise->id) }}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                    @unless(auth()->user()->hasRole('admin'))
                                    <form id="deleteForm{{ $entreprise->id }}" action="{{ route('entreprises.destroy', $entreprise->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <a href="javascript:void(0);" class="dropdown-item delete-entreprise" data-entreprise-id="{{ $entreprise->id }}">
                                            <i class="bx bx-trash me-1"></i> Delete
                                        </a>
                                    </form>
                                    @endunless

                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $entreprises->links('custom-pagination') }}
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
              <h4 style="text-align: center">Are you sure you want to delete this entreprise? </h4>
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
      $(document).on('click', '.delete-entreprise', function(event) {
        var triggerElement = $(this); // Element that triggered the modal
        var entrepriseId = triggerElement.data('entreprise-id');
        var deleteForm = $('#deleteForm' + entrepriseId);

        // Set the entreprise ID for the "Delete" button in the modal
        $('#deleteButton').data('entreprise-id', entrepriseId);

        // Show the Bootstrap modal
        $('#modalCenter').modal('show');
    });
    $(document).on('click', '#deleteButton', function(event) {
        // Handle the deletion process here
        var entrepriseId = $(this).data('entreprise-id');
        var deleteForm = $('#deleteForm' + entrepriseId);

        // Perform form submission
        deleteForm.submit();

        // Close the Bootstrap modal
        $('#modalCenter').modal('hide');
    });
document.querySelectorAll('.switch-input').forEach(function (switchInput) {
    switchInput.addEventListener('change', function () {
        const entrepriseId = this.getAttribute('data-entreprise-id');
        document.getElementById('entrepriseIdInput').value = entrepriseId;
        document.getElementById('updateForm').submit();
    });
});
$(document).ready(function() {
      // Handle entreprise search by name
      $("#entrepriseSearch").on("input", function() {
          var searchValue = $(this).val().toLowerCase();

          $("tbody tr").filter(function() {
              var entrepriseName = $(this).find("td:eq(0)").text().toLowerCase(); // Index 1 corresponds to the "Nom" column
              $(this).toggle(entrepriseName.indexOf(searchValue) > -1);
          });
      });
  });
</script>

@endsection
