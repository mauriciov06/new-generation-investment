<!-- Modal -->
<div class="modal fade modalcustom-app modalsoli-retiro" id="modalsoli-retiro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document" style="max-width: 400px;width: 400px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Solicitud de retiro</h5>
      </div>
      <div class="modal-body">
        <p>El valor minimo que puedes solitar en su retiro es de 50 USD, debes tener en cuenta que el valor solicitado se descontara unicamente de su utilidad y no de su inversi贸n inicial.</p>
        <input type="text" name="valor_soli_retiro" class="form-control valor_soli_retiro input-custom-app" placeholder="Valor a retirar">
        
        <div id="options-disponibles"></div>
        <div id="request-valor_soli_retiro"></div>
        <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
      </div>
      <div class="modal-footer">
          <a id="confir-soliretiro" style="display: block;margin: 0 auto;width: 60%;" class="btn btn-primary" data-idusersoli="{{Auth::user()->id_user}}">Solicitar</a>
      </div>
    </div>
  </div>
</div>