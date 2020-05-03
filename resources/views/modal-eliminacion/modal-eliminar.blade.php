<!-- Modal -->
<div class="modal fade modalcustom-app modaleliminar" id="modaleliminar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document" style="max-width: 400px;width: 400px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirmación de Eliminación</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="outline: none;">
          <span aria-hidden="true" style="text-shadow: none;color: #fff;">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p style="line-height: 1.2;font-size: 16px;">Esta seguro de eliminar este usuario?</p>
        @include('modal-eliminacion.confirmacion-eliminacion')
      </div>
      <div class="modal-footer">
        <a id="confirmacion-eliminar" class="btn btn-primary" data-idconfieliminar="">Eliminar</a>
        <a class="btn btn-secondary" data-dismiss="modal">Cerrar</a>
      </div>
    </div>
  </div>
</div>