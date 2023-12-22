@extends('layouts.app')

@section('content')
    <h4 class="py-3 mb-4"><span class="text-muted fw-light"><a href="{{ route('paiments.index') }}" style="color:#a1acb8 !important">Gestion Paiments/</a></span> Liste Paiments</h4>
    <!-- Bootstrap Table with Header - Light -->
    <div class="card">
        <div class="table-responsive text-nowrap">
            <div class="dt-action-buttons text-end mt-4 mb-3" style="margin-right: 20px;">
                <div class="row">
                    <label class="col-sm-2 mx-3">
                      Date Debut : <input type="date" style="display: inline;width: 70%;" id="dateDebut" placeholder="Search by Date" class="form-control" />
                    </label>
                    <label class="col-sm-2 mx-3">
                      Date Fin : <input type="date" style="display: inline;width: 70%;" id="dateFin" placeholder="Search by Date" class="form-control" />
                    </label>
                    <label class="col-sm-7 mx-3">
                        <label class="mx-3">
                            <select id="filterSelect" style="display: inline-block;" class="form-select">
                                <option value="parDateCroissant">Par Date Croissant</option>
                                <option value="parDateDecroissant">Par Date Décroissant</option>
                            </select>
                        </label>
                        <label class="mx-3">
                            <input type="search" id="paimentSearch" placeholder="Search by Name" class="form-control " />
                        </label>
                    </label>
                </div>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Réf Client</th>
                        <th>Réf Facture</th>
                        <th>Date</th>
                        <th>Montant</th>
                        <th>Methode de paiement</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($paiments as $paiment)
                    <tr>
                        <td><a href="{{ route('factures.show', $paiment->facture_id ) }}">{{ $paiment->facture->client->nom }}</a></td>
                        <td>{{ $paiment->facture->codeFacture }}</td>
                        <td>{{ $paiment->date }}</td>
                        <td>{{ $paiment->montant }}</td>
                        <td>{{ $paiment->method }}</td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                    data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item"
                                        href="{{ route('factures.show', $paiment->facture_id ) }}"><i
                                            class='bx bx-show-alt me-1'></i> Show</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $paiments->links('custom-pagination') }}
        </div>
    </div>

<script>
       // Handle date range search

       $("#dateDebut, #dateFin").on("change", function() {
        var startDate = $("#dateDebut").val();
        var endDate = $("#dateFin").val();    
        if(startDate && endDate)
        {
            $("tbody tr").each(function() {
            var currentDate = $(this).find("td:eq(2)").text(); // Index 4 corresponds to the "Date" column
            var isInRange = isDateInRange(currentDate, startDate, endDate);
            $(this).toggle(isInRange);
            });
        }
    });

    function convertDateFormat(dateString) {
        // Assuming the current date format is DD/MM/YYYY, convert it to YYYY-MM-DD
        var parts = dateString.split('/');
        return parts[2] + '-' + parts[1] + '-' + parts[0];
    }

    function isDateInRange(currentDate, startDate, endDate) {
        // Convert the dates to Date objects for proper comparison
        var currentDateTime = currentDate;
        var startDateTime = startDate;
        var endDateTime = endDate;

        // Check if the current date is within the specified range
        return currentDateTime >= startDateTime && currentDateTime <= endDateTime;
    }
    $(document).ready(function() {
      // Handle paiment search by name
      $("#paimentSearch").on("input", function() {
          var searchValue = $(this).val().toLowerCase();

          $("tbody tr").filter(function() {
              var paimentName = $(this).find("td:eq(0)").text().toLowerCase(); // Index 1 corresponds to the "Nom" column
              $(this).toggle(paimentName.indexOf(searchValue) > -1);
          });
      });
  });
  $(document).ready(function() {
    $("#filterSelect").change(function() {
        var selectedOption = $(this).val();
        var $rows = $("tbody tr");

        switch (selectedOption) {
            case "parDateCroissant":
                $rows.sort(function(a, b) {
                    var dateA = new Date($(a).find("td:eq(2)").text()); // Assuming index 1 is the date column
                    var dateB = new Date($(b).find("td:eq(2)").text());
                    return dateA - dateB;
                });
                break;
            case "parDateDecroissant":
                $rows.sort(function(a, b) {
                    var dateA = new Date($(a).find("td:eq(2)").text());
                    var dateB = new Date($(b).find("td:eq(2)").text());
                    return dateB - dateA;
                });
                break;
        }

        $("tbody").empty().append($rows);
    });
});
</script>
@endsection