@extends('layouts.adminv2')

@section('content')
	<div class="sub-nav-item">
		<i class="fa fa-cog fa-2x" aria-hidden="true"></i>  <h4>Mis contratos</h4>
	</div>
	<div id="conten-form">
		<div class="row">
			<div class="col-xs-12">
				<div class="alert alert-info" role="alert">
				 	<strong>Importante</strong>, los contratos inactivos sean activados 12 horas despues de la confirmación del pago.
				</div>
			</div>
		</div>
		<div class="row">
			@if(count($listadoContratos) > 0)
				@foreach($listadoContratos as $contrato)
					<div class="col-xs-3 text-center item-contrato-cuenta">
						<div class="item-contr-deta">
						    <h5 class="card-title">{!! \App\Http\Controllers\CuentaController::infoContrato($contrato->id_contrato) !!}</h5>
						    @if($contrato->id_paquete != 0)
						    	<h6 class="card-subtitle mb-2 text-muted">{!! \App\Http\Controllers\CuentaController::infoPaquete($contrato->id_paquete) !!}</h6>
						    @else
								<h6 class="card-subtitle mb-2 text-muted">{!! $contrato->valor_inversion !!} USD</h6>
						    @endif
						    @if($contrato->estado_referido_contratos == 1)
						    	<span class="label label-success">Activo</span>
						    	{{-- <a data-toggle="modal" data-target="#modal-upgrade-contrato" data-iduser="{{$contrato->id_user}}" data-idreferidocontrato="{{$contrato->id_referidos_contratos}}" data-idfinanzaup="{{\App\Http\Controllers\CuentaController::infoFinanzas($contrato->id_user, $contrato->id_referidos_contratos)}}" class="btn-upgrade">Upgrade</a> --}}
						    @else
						    	<span class="label label-danger">Inactivo</span>
						    @endif
					   	</div>
					</div>
				@endforeach
			@else
				<div class="alert alert-info" role="alert" style="margin: 0 15px;">
				 	No tiene contratos asignados.
				</div>
			@endif
		</div>
	</div>
@stop

@section('scripts')
	{!!Html::script('js/custom-file-input.js')!!}
	{!!Html::script('js/script.js')!!}
@endsection