<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Facture</title>
  <style>
    <?php include(public_path().'/assets/style/style.css');
    ?>
  </style>
  <style>

    .logo {
      margin-top: -26px;
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
      height: 590px !important;
      /* Optional: To collapse table borders */
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

<body>
  <div class="container invoice">
    <div class="invoice-header" style="margin-top: 50px; margin-right: 20px;">
      <div class="row">
        <div class="col-xs-7 col-sm-7" style="margin-left: 40px;margin-top: 50px;">
          <div class="media">
            <div class="media-left">
              
              @if($EntrepriseData->typelogo == 'svg')
              <img class="logo" alt="logoImayweb" height="130" width="255" src="data:image/{{ $EntrepriseData->typelogo }}+xml;base64,{{ base64_encode(file_get_contents(public_path('/storage/' . $EntrepriseData->logo))) }}">
              @else
              <img class="logo" alt="logoImayweb" height="130" width="255" src="data:image/{{ $EntrepriseData->typelogo }};base64,{{ base64_encode(file_get_contents(public_path('/storage/' . $EntrepriseData->logo))) }}">
              @endif
            </div>
          </div>
        </div>
        <div class="col-xs-1 col-sm-1"></div>
        <div class="col-xs-4 col-sm-4" style="margin-left: 90px;margin-top: 50px;">
          <h4 class="text-gra">Facture {{ $FactureData->codeFacture }} </h4>
          <dd style="font-size: 10px;margin-left: 46px;" class="text-gra"> Date facturation : {{ $FactureData->date  }}</dd>
          <dd style="font-size: 10px;margin-left: 50px;" class="text-gra"> Date echeance :  {{ (new DateTime($FactureData->date))->modify('+' . $EntrepriseData->validite . ' days')->format('Y-m-d') }}</dd>
          <dd style="font-size: 10px;margin-left: 63px;" class="text-gra"> Code Client : {{ $ClientData->codeClient  }}</dd>
        </div>
      </div>
    </div>
    <div class="invoice-body" style="margin-left: 34px; margin-right: 35px;">
      <div class="row">
        <div class="col-xs-12 col-sm-5">
          <h6 style="margin-left: 10px;"><strong>Emetteur</strong></h6>
          <div class="panel panel-default" style="height: 164px;width: 300px;background-color: #fbc838;">
            <div class="panel-body" style="font-size: 12px;">
              <dt>{{ $EntrepriseData->nom }}</dt>
              <dd>{{ $EntrepriseData->adresse }}</dd>
              <dd>Quartier Industriel</dd>
              <dd>Marrakech</dd>
              <br />
              <dd><strong>Tel.:</strong> {{ $EntrepriseData->telephone }}</dd>
              <dd><strong>Email: </strong> {{ $EntrepriseData->email }} </dd>
              <dd><strong>Siteweb:</strong> {{ $EntrepriseData->site }} </dd>
            </div>
          </div>
        </div>
        <div class="col-xs-12 col-sm-1"></div>
        <div class="col-xs-12 col-sm-6">
          <h6><strong style="margin-left: -100px;">Adresse a</strong> </h6>
          <div class="panel panel-default" style="height: 164px;width: 340px;margin-left:-110px;">
            <div class="panel-body" style="font-size: 13px;">
              <dl>
                <p><strong> Nom Client : {{ $ClientData->nom  }} </strong></p>
                <p> <strong>Type Client : </strong>{{ $ClientData->type  }} | <strong>ICE : </strong>{{ $ClientData->ice  }}</p>
                <p><strong>Adresee : </strong>{{ $ClientData->adresse  }}</p>
                <p><strong>Email :</strong> {{ $ClientData->email  }}</p>
                <p><strong>Telephone :</strong> {{ $ClientData->telephone  }}</p>
              </dl>
            </div>
          </div>
        </div>
      </div>
      <div class="panel panel-default">
        <table class="table table-bordered table-condensed" border="1px" style="font-size: 12px;">
          <thead>
            <th>Designation</th>
            <th style="text-align: center;">TVA</th>
            <th style="text-align: center;">P.U. HT</th>
            <th style="text-align: center;">Qte</th>
            <th style="text-align: center;">Total HT</th>
          </thead>
          <tbody>
            @php
                                    $totalTTC = 0;
                                    $totalTVA = 0;
                                    $totalHT = 0;
                                    @endphp
            @if($FactureData->detailFacture->isNotEmpty())
                                    
                                    @foreach($FactureData->detailFacture as $detail)
                                    <tr height="50px">
                                        <td>{{ $detail->designation }}</td>
                                        <td style="text-align: end;">{{ $detail->tva }} % </td>
                                        <td style="text-align: end;">{{ $detail->puht }}</td>
                                        <td style="text-align: end;">{{ $detail->qte }}</td>
                                        
                                        
                                        <td style="text-align: end;">{{ number_format($detail->puht * $detail->qte, 2, ',', '') }}</td>
                                    </tr>
                                    @php
                                        $totalHT += ($detail->puht * $detail->qte);
                                        $totalTTC += ($detail->puht * $detail->qte) * (1 + ($detail->tva / 100));
                                        $totalTVA += (($detail->puht * $detail->qte * $detail->tva)/100);
                                    @endphp
                                    @endforeach
                                </tbody>
                                @endif
          </tbody>
        </table>
      </div>
      <div class="row">
        <div class="col-xs-7 col-sm-7" style="font-size: 10px;">
          <dd><span style="font-weight:800;">Conditions de reglement: </span><span style="margin-left: 70px;"> <strong>A
                l'avance </strong></span></dd><br/>
          <dd><span style="font-weight:800;">Reglement par virement sur le compte bancaire suivant:</span> </dd>
          <dd><strong>Banque:  {{ $EntrepriseData->banque }}</strong></dd>
          <dd><strong>Numero de compte: {{ $EntrepriseData->rib }} </strong></dd>
          <dd>Adresse: SAADA MARRAKECH</dd>
          <dd>Nom du proprietaire du compte: {{ $EntrepriseData->nom }}</dd>
          <dd><span style="font-weight:800;">Code IBAN: {{ $EntrepriseData->iban }} </span> </dd>
          <dd><span style="font-weight:800;">Code BIC/SWIFT: {{ $EntrepriseData->swift }} </span></dd>
        </div>
        <div class="col-xs-4 col-sm-4" style="font-size: 11px;margin-left: 61px;">
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
    <div class="invoice-footer" style="margin-top: 90px;text-align: center;font-size: 11px;">
      <hr style="margin:3px 0 5px" />
      <strong>Siege social:{{ $EntrepriseData->nom }} - {{ $EntrepriseData->adresse }} Quartier Industriel Marrakech, Maroc
      </strong>
      <br /> <strong>Telephone : {{ $EntrepriseData->telephone }} - {{ $EntrepriseData->site }} - {{ $EntrepriseData->email }} </strong>
      <br />R.C.: {{ $EntrepriseData->rc }} - Patente: {{ $EntrepriseData->patente }}
      <br />I.F.: {{ $EntrepriseData->if }} - C.N.S.S.: {{ $EntrepriseData->cnss }} - ICE: {{ $EntrepriseData->ice }}
    </div>
  </div>

</body>

</html>