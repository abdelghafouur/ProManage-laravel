    <div class="invoice-header" >
        <div class="row">
          <div class="col-xs-6 col-sm-6" style="margin-left: -8px">
            <div class="media">
              <div class="media-left">
                @if($EntrepriseData->typelogo == 'svg')
                <img class="logo" alt="logoImayweb" height="30px" width="300px"
                src="data:image/svg+xml;base64,{{ base64_encode(file_get_contents(public_path('storage/' . $EntrepriseData->logo))) }}"
                >
                @else
                <img class="logo" alt="logoImayweb" height="90px" width="240px"
                src="data:image/{{ $EntrepriseData->typelogo }};base64,{{ base64_encode(file_get_contents(public_path('storage/' . $EntrepriseData->logo))) }}">
                @endif
              </div>
            </div>
          </div>      
          <div class="col-xs-6 col-sm-6 text-right mt-50" style="margin-left: -55px">
            <h4 class="text-gra" style="margin-left: 26px;">Devis N° {{ $DevisData->codeDevis }} </h4>
            <dd style="font-size: 10px;margin-left: 66px;" class="text-gra"> Date devis : {{ $DevisData->date }}</dd>
            <dd style="font-size: 10px;margin-left: 66px;" class="text-gra"> Date d'écheance : {{ (new
              DateTime($DevisData->date))->modify('+' . $EntrepriseData->validite . ' days')->format('Y-m-d') }}</dd>
            <dd style="font-size: 10px;margin-left: 60px;" class="text-gra"> Code Client : {{ $ClientData->codeClient }}
            </dd>
          </div>
        </div>
      </div>
