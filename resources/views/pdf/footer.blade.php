<style>
    /* Add any other styles for your footer here */
</style>


    <div class="invoice-footer" style="position:absolute;bottom:-1%;left:0;right:0;text-align: center;font-size: 12px;">
        <hr style="margin:3px 0 5px" />
        <strong>Siege social:{{ $EntrepriseData->nom }} - {{ $EntrepriseData->adresse }} Quartier Industriel Marrakech,
          Maroc
        </strong>
        <br /> <strong>Telephone : {{ $EntrepriseData->telephone }} - {{ $EntrepriseData->site }} - {{
          $EntrepriseData->email }} </strong>
        <br />R.C.: {{ $EntrepriseData->rc }} - Patente: {{ $EntrepriseData->patente }}
        <br />I.F.: {{ $EntrepriseData->if }} - C.N.S.S.: {{ $EntrepriseData->cnss }} - ICE: {{ $EntrepriseData->ice }}
      </div>
