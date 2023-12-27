<!-- pdf.table.blade.php -->
<head>
    <style>
        {{ file_get_contents(public_path('/assets/style/style.css')) }}
    </style>
<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        border: 1px solid black;
        padding: 8px;
    }

    thead {
        display: table-header-group;
    }

    tfoot {
        display: table-footer-group;
    }

    tr {
        page-break-inside: avoid;
    }
    body{
      height: 100%;
    }
    .logo {
      border-radius: 37px;
    }
    .dl-horizontal {
      margin: 0;
    }
    .mono {
      font-family: monospace;
    }

    .text-gra {
      font-weight: bold;
    }

    .panel-title {
      margin-bottom: 10px;
    }

    table {
      /* Set the minimum height of the table */
      border-collapse: collapse;
  
      /* Optional: To collapse table borders */
    }
    tr{
      height: 40px;
    }
    /* Media Queries */
    @media (max-width: 768px) {
      .invoice {
        width: auto !important;
      }

      .invoice-body {
        padding: 15px;
      }

      .invoice-footer {
        font-size: 0.9em;
      }

      .colfix {
        width: 20%;
      }

      .invoice-header h1 {
        font-size: 1.5em;
      }

      .invoice-header .text-muted {
        font-size: 0.8em;
      }

      .media-body {
        font-size: 0.8em;
        word-wrap: break-word;
        /* Add this line to wrap long text */
      }
    }

    .container {
      width: 503px;
    }

    .row {
      display: -webkit-box;
      display: -webkit-flex;
      display: flex;
    }

    .row>div {
      -webkit-box-flex: 1;
      -webkit-flex: 1;
    }
</style>
</head>
<div class="container invoice">
    @include('pdf.header', ['EntrepriseData' => $EntrepriseData])
    <div class="invoice-body">
        <div class="row">
          <div class="col-xs-12 col-sm-6">
            <div class="panel" style="margin-left: -30px">
              <div class="panel-body" style="font-size: 15px;">
                <dt>{{ $EntrepriseData->nom }}</dt>
                <dd>{{ $EntrepriseData->adresse }}</dd>
                <br/>
                <dd><strong><i class='bx bx-line-chart'></i>Tel.:</strong> {{ $EntrepriseData->telephone }}</dd>
                <dd><strong>Email: </strong> {{ $EntrepriseData->email }} </dd>
                <dd><strong>Siteweb:</strong> {{ $EntrepriseData->site }} </dd>
              </div>
            </div>
          </div>
          <div class="col-xs-12 col-sm-6 text-right" style="margin-top: 25px">
            <div class=" panel-default">
              <div class="panel-body" style="font-size: 15px;">
                <dl>
                  <p><strong>{{ $ClientData->nom }} </strong></p>
                  <p>{{ $ClientData->adresse }}</p>
                  <p><strong>ICE : </strong>{{ $ClientData->ice }}</p>
                  <p>{{ $ClientData->telephone }}</p>
                </dl>
              </div>
            </div>
          </div>
        </div>
        @if($DevisData->designationDev != null)
        <h2 style="text-align: center;margin:25px 0;"><strong>{{
            $DevisData->designationDev}}.</strong></h2>
        @endif
        <div class="panel panel-default">
            <table>
                <thead>
                    <tr>
                        <th style="width:60% ;">Designation</th>
                        <th style="text-align: center;">P.U. HT</th>
                        <th style="text-align: center;">Qte</th>
                        <th style="text-align: center;">TVA</th>
                        <th style="text-align: center;">Total HT</th>
                    </tr>
                </thead>
                <tfoot>
                </tfoot>
                <tbody>
                    @php
    
            $rowsPerPage = 12; // 12 rows on the first page
            $currentRowCount = 0;
        @endphp
                    @foreach($DevisData->detailDevis as $index => $detail)
                        @php
                        $totalTTC = 0;
                        $totalTVA = 0;
                        $totalHT = 0;
                        @endphp
                        @if($DevisData->detailDevis->isNotEmpty())
        
                        <tr style="border-bottom:1px dashed #ddd">
                        <td>{{ $detail->designation }}</td>
                        <td style="text-align: center;">{{ $detail->puht }}</td>
                        <td style="text-align: center;">{{ $detail->qte }}</td>
                        <td style="text-align: center;">{{ $detail->tva }} % </td>
                        <td style="text-align: center;">{{ number_format($detail->puht * $detail->qte, 2, ',', '') }}</td>
                        </tr>
                        @php
                        $totalHT += ($detail->puht * $detail->qte);
                        $totalTTC += ($detail->puht * $detail->qte) * (1 + ($detail->tva / 100));
                        $totalTVA += (($detail->puht * $detail->qte * $detail->tva)/100);
                        $currentRowCount++;
                        @endphp
        @if (($currentRowCount % $rowsPerPage == 0 && $currentRowCount != 0) || $loop->last)
                </tbody>
            
            </table>
    </div>
</div>
@include('pdf.footer', ['EntrepriseData' => $EntrepriseData])
@if (!$loop->last)
            <div style="page-break-before: always;"></div>
            @php
                    $rowsPerPage = 18; // 18 rows on subsequent pages
                    $currentRowCount = 0;
                @endphp
            @include('pdf.header', ['EntrepriseData' => $EntrepriseData])
            <table>
                <thead>
                </thead>
                <tfoot>
                </tfoot>
                <tbody>
                   
            @endif
            @endif
            @endif
            @endforeach
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="col-xs-7 col-sm-7" style="font-size: 10px;">
              <dd><h4>Arrêté le présent devis à la somme de : {{ number_format($totalTTC, 2, ',', '') }}</h4></dd>
              <dd><span style="font-weight:800;">Conditions de reglement: </span><span style="margin-left: 70px;"> <strong>A
                    l'avance </strong></span></dd><br />
              <dd><span style="font-weight:800;">Reglement par virement sur le compte bancaire suivant:</span> </dd>
              <dd><strong>Banque: {{ $EntrepriseData->banque }}</strong></dd>
              <dd><strong>Numero de compte: {{ $EntrepriseData->rib }} </strong></dd>
              <dd>Adresse: SAADA MARRAKECH</dd>
              <dd>Nom du proprietaire du compte: {{ $EntrepriseData->nom }}</dd>
              <dd><span style="font-weight:800;">Code IBAN: {{ $EntrepriseData->iban }} </span> </dd>
              <dd><span style="font-weight:800;">Code BIC/SWIFT: {{ $EntrepriseData->swift }} </span></dd>
            </div>
            <div class="col-xs-3 col-sm-3" style="font-size: 11px;margin-left: 61px;">
              <p> <strong>Total HT</strong></p>
              <p> <strong>Total TVA 20%</strong></p>
              <p style="background-color: #d9d9d9;"> <strong>Total TTC</strong></p>
            </div>
            <div class="col-xs-1 col-sm-1" style="text-align: end;font-size: 11px;margin-left: -75px;">
              <p> <strong>{{ number_format($totalHT, 2, ',', '') }}</strong></p>
              <p> <strong> {{ number_format($totalTVA, 2, ',', '') }}</strong></p>
              <p> <strong>{{ number_format($totalTTC, 2, ',', '') }}</strong></p>
            </div>
        </div>
</div>
