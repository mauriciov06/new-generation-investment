<!-- Modal -->
<div class="modal fade modalcustom-app modal-upgrade-contrato" id="modal-upgrade-contrato" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document" style="max-width: 400px;width: 400px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upgrade de contrato</h5>
      </div>
      <div class="modal-body" style="padding: 15px 30px;">
        <p>El valor minimo del upgrade es de 100 USD y solo se permiten valores multiplos de 100.</p>
        <input type="text" name="upgrade_valor" class="form-control upgrade_valor input-custom-app" placeholder="Ingresa el valor de su upgrade">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
        <div id="request-upgrade"></div>
      </div>
      <div class="modal-footer">
        <a id="confir-upgrade" style="display: block;margin: 0 auto;width: 60%;" class="btn btn-primary" data-iduserup="" data-idrefconup="" data-idfinanzaupmo="">Upgrade</a>
      </div>
    </div>
  </div>
</div>