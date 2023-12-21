@extends('layouts.app')

@section('content')
<div class="container-xxl flex-grow-1">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light"><a href="{{ route('users.index') }}" style="color:#a1acb8 !important">Gestion Comptes/</a></span> Liste Comptes</h4>
    <!-- Bootstrap Table with Header - Light -->
    <div class="card">

        <div class="table-responsive text-nowrap">

            <div class="dt-action-buttons text-end mt-4" style="margin-right: 20px;">
                <label class="mx-3">
                    <input type="search" id="userSearch" placeholder="Search by Name" class="form-control " />
                </label>
                <button type="button" onclick="window.location.href='{{ route('users.create') }}'"
                    class="btn btn-outline-primary">
                    Ajouter Compte
                </button>
            </div>


            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nom Complete</th>
                        <th>Email</th>
                        <th>Role</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @foreach ($user->getRoleNames() as $role)
                            <div class="demo-inline-spacing">
                                @if ( $role == 'superadmin')

                                <span class="badge rounded-pill bg-primary">{{ $role }}</span>

                                @elseif($role == 'admin')
                                <span class="badge rounded-pill bg-secondary">{{ $role }}</span>

                                @elseif( $role == 'comptable')
                                <span class="badge rounded-pill bg-info">{{ $role }}</span>
                                @endif
                            </div>
                            @endforeach
                        </td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                    data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('users.edit', $user->id) }}"><i
                                            class="bx bx-edit-alt me-1"></i> Edit</a>
                                    @unless(auth()->user()->hasRole('admin'))
                                    <form id="deleteForm{{ $user->id }}"
                                        action="{{ route('users.destroy', $user->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <a href="javascript:void(0);" class="dropdown-item delete-user"
                                            data-user-id="{{ $user->id }}">
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
            {{ $users->links('custom-pagination') }}
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
                    <h4 style="text-align: center">Are you sure you want to delete this user? </h4>
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
    $(document).on('click', '.delete-user', function(event) {
        var triggerElement = $(this); // Element that triggered the modal
        var userId = triggerElement.data('user-id');
        var deleteForm = $('#deleteForm' + userId);

        // Set the user ID for the "Delete" button in the modal
        $('#deleteButton').data('user-id', userId);

        // Show the Bootstrap modal
        $('#modalCenter').modal('show');
    });
    $(document).on('click', '#deleteButton', function(event) {
        // Handle the deletion process here
        var userId = $(this).data('user-id');
        var deleteForm = $('#deleteForm' + userId);

        // Perform form submission
        deleteForm.submit();

        // Close the Bootstrap modal
        $('#modalCenter').modal('hide');
    });

  $(document).ready(function() {
      // Handle user search by name
      $("#userSearch").on("input", function() {
          var searchValue = $(this).val().toLowerCase();

          $("tbody tr").filter(function() {
              var userName = $(this).find("td:eq(0)").text().toLowerCase(); // Index 1 corresponds to the "Nom" column
              $(this).toggle(userName.indexOf(searchValue) > -1);
          });
      });
  });
</script>
@endsection