@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="row">              
                <div class="order-1">
                  <div class="row">
                    <div class="col-lg-3 col-md-3 col-6 mb-4">
                      <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0 rounded me-3">
                              <span class="avatar-initial rounded bg-label-primary"
                                ><i class='bx bx-line-chart'></i></span>
                            </div>
                          </div>
                          <h3 class="card-title mb-2">$12,628</h3>
                          <span class="fw-medium d-block mb-1">Chiffre d'affaire Mensuel</span>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-6 mb-4">
                      <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0 rounded me-3">
                              <span class="avatar-initial rounded bg-label-primary"
                                ><i class='bx bx-user'></i></span>
                            </div>
                          </div>
                          <h3 class="card-title mb-2"><p>{{ str_pad($totalClients, 2, '0', STR_PAD_LEFT) }}</p>
                          </h3>
                          <span class="fw-medium d-block mb-1">Total clients</span>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-6 mb-4">
                      <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0 rounded me-3">
                              <span class="avatar-initial rounded bg-label-primary"
                                ><i class='bx bx-dollar'></i></span>
                            </div>
                          </div>
                          <h3 class="card-title text-nowrap mb-1">$4,679</h3>
                          <span class="fw-medium d-block mb-1">Situation caisse</span>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-6 mb-4">
                        <div class="card">
                          <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                              <div class="avatar flex-shrink-0 rounded me-3">
                                <span class="avatar-initial rounded bg-label-primary"
                                  ><i class='bx bx-book-bookmark'></i></span>
                              </div>
                            </div>
                            <h3 class="card-title text-nowrap mb-1">$4,679</h3>
                            <span class="fw-medium d-block mb-1">Factures Non Payées</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                </div>
                <!-- Total Revenue -->
                <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
                  <div class="card">
                    <div class="row row-bordered g-0">
                      <div class="col-md-12">
                        <h5 class="card-header m-0 me-2 pb-3">Rapport Mensuel</h5>
                        <div id="chart" class="px-2"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <!--/ Total Revenue -->
                <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
                  <!-- Order Statistics -->
                  <div class="card h-90">
                    <div class="card-header d-flex align-items-center justify-content-between pb-0">
                      <div class="card-title mb-0">
                        <h5 class="m-0 me-2">Derniers Clients</h5>
                        <small class="text-muted">{{ str_pad($totalClients, 2, '0', STR_PAD_LEFT) }} Total Clients</small>
                      </div>
                    </div>
                    <div class="card-body">
                      <ul class="p-0 m-0 mt-3">
                        @foreach ($latestClients as $latestClient)
                        <li class="d-flex mb-4 pb-1">
                          <div class="avatar flex-shrink-0 rounded me-3">
                            <a href="{{ route('clients.show', $latestClient->id) }}">
                            <span class="avatar-initial rounded bg-label-primary"
                              ><i class='bx bx-user'></i></span>
                            </a>
                          </div>
                          <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                              <h6 class="mb-0 text-uppercase"><a href="{{ route('clients.show', $latestClient->id) }}">{{ $latestClient->nom }}</a></h6>
                              <small class="text-muted">{{ $latestClient->codeClient }}</small>
                            </div>
                            <div class="user-progress">
                              <small class="fw-medium">{{ $latestClient->created_at->format('Y-m-d') }}</small>
                            </div>
                          </div>
                        </li>
                        @endforeach
                      </ul>
                    </div>
                  </div>
                <!--/ Order Statistics -->
                </div>
              </div>
              <div class="row">
                <!-- Transactions -->
                <div class="col-md-6 col-lg-6 order-2 mb-4">
                  <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h5 class="card-title m-0 me-2">Dernières Factures</h5>
                      <div class="dropdown">
                        <button
                          class="btn p-0"
                          type="button"
                          id="transactionID"
                          data-bs-toggle="dropdown"
                          aria-haspopup="true"
                          aria-expanded="false">
                          <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="transactionID">
                          <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
                          <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                          <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
                        </div>
                      </div>
                    </div>
                    <div class="card-body">
                      <ul class="p-0 m-0">
                        @foreach ($latestFactures as $latestFacture)
                        <li class="d-flex mb-4 pb-1">
                          <div class="avatar flex-shrink-0 rounded me-3">
                            <a href="{{ route('factures.show', $latestFacture->id) }}">
                            <span class="avatar-initial rounded bg-label-primary"
                              ><i class='bx bx-book book-mark'></i></span>
                            </a>
                          </div>
                          <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                              <small class="text-muted d-block mb-1"> {{ $latestFacture->codeFacture }}</small>
                              <h6 class="mb-0 text-uppercase"><a href="{{ route('factures.show', $latestFacture->id) }}">{{ $latestFacture->client->nom }} </a></h6>
                            </div>
                            <div class="user-progress">
                              <small class="fw-medium">{{ $latestFacture->date }}</small>
                            </div>
                          </div>
                        </li>
                        @endforeach
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-lg-6 order-2 mb-4">
                  <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h5 class="card-title m-0 me-2">Dernières Devis</h5>
                      <div class="dropdown">
                        <button
                          class="btn p-0"
                          type="button"
                          id="transactionID"
                          data-bs-toggle="dropdown"
                          aria-haspopup="true"
                          aria-expanded="false">
                          <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="transactionID">
                          <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
                          <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                          <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
                        </div>
                      </div>
                    </div>
                    <div class="card-body">
                      <ul class="p-0 m-0">
                        @foreach ($latestDevis as $latestDevise)
                        <li class="d-flex mb-4 pb-1">
                          <div class="avatar flex-shrink-0 me-3 rounded">
                            <a href="{{ route('devis.show', $latestDevise->id) }}">
                            <span class="avatar-initial rounded bg-label-primary"
                              ><i class='bx bx-notepad'></i></span>
                            </a>
                          </div>
                          <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                              <small class="text-muted d-block mb-1">{{ $latestDevise->codeDevis }}</small>
                              <h6 class="mb-0 text-uppercase"><a href="{{ route('devis.show', $latestDevise->id) }}">{{ $latestDevise->client->nom }} </a></h6>
                            </div>
                            <div class="user-progress">
                              <small class="fw-medium">{{ $latestDevise->date }}</small>
                            </div>
                          </div>
                        </li>
                        @endforeach
                      </ul>
                    </div>
                  </div>
                </div>
                <!--/ Transactions -->
              </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
      var options = {
          series: [{
              name: "Factures",
              data: {!! json_encode(array_values($factureCounts)) !!}
          }],
          chart: {
              height: 300,
              type: 'line',
              zoom: {
                  enabled: false
              }
          },
          dataLabels: {
              enabled: false
          },
          stroke: {
              curve: 'straight'
          },
          grid: {
              row: {
                  colors: ['#f3f3f3', 'transparent'],
                  opacity: 0.5
              },
          },
          xaxis: {
              categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
          }
      };
  
      var chart = new ApexCharts(document.querySelector("#chart"), options);
      chart.render();
    </script>
  
   
@endsection