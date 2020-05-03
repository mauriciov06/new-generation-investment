<!-- Modal -->
<div class="modal fade modalcustom-app modaldirec-billetera" id="modaldirec-billetera" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document" style="max-width: 400px;width: 400px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirme su dirección de billetera</h5>
      </div>
      <div class="modal-body">
        <p>Por motivos de pagos y retiros debemos guardar su direccion de billetera.</p>
        <input type="text" name="dire_billetera" class="form-control dire_billetera input-custom-app" placeholder="Dirección de billetera">
        <div id="request-direcbillete"></div>
      </div>
      <div class="modal-footer">
        <a id="confir-direcBill" style="display: block;margin: 0 auto;width: 60%;" class="btn btn-primary" data-idUserbilletera="{{Auth::user()->id_user}}">Guardar</a>
      </div>
    </div>
  </div>
</div>