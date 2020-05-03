@extends('layouts.admin')

@section('content')
	<div class="sub-nav-item">
		<i class="fa fa-cog fa-2x" aria-hidden="true"></i>  <h4>Detalle de la cuenta</h4>
	</div>
	<div id="conten-form">
		<div class="col-xs-12 col-sm-6">
			<div class="form-group">
				{!!Form::label('# de referidos:')!!} <span class="count-bag-ref">{!! \App\Http\Controllers\ReferidoController::countReferidosList($usuario->codigo_referido_users) !!}</span> 
				@if(\App\Http\Controllers\ReferidoController::countReferidosList($usuario->codigo_referido_users) > 0)
					<a class="enlace-comp-ref" href="{!!URL::to('/referidos')!!}">Ver referidos</a>
				@endif
			</div>
			<div class="form-group">
				{!!Form::label('Url para referidos:')!!} <span class="enlace-referidos">{!!URL::to('/r/'.$usuario->codigo_referido_users)!!}</span>
			</div>
		</div>
		<div class="col-xs-12 col-sm-6">
			<label class="texto-referido-directo">Tu patrocinador es:</label>
			@if(isset($referidoDirecto[0]))
				<div class="datos-referidos-cuenta">
					<div class="item-datos-cuenta">ID: {{$referidoDirecto[0]->codigo_referido_users}}</div>
					<div class="item-datos-cuenta">{{$referidoDirecto[0]->name}}</div>
					<div class="item-datos-cuenta">Celular: {{$referidoDirecto[0]->celular_users}}</div>
					<div class="item-datos-cuenta">Ubicación: {!!\App\Http\Controllers\UsuarioController::nombreCiudad($referidoDirecto[0]->id_pais) !!}</div>
				</div>
			@else
				No tienes referido directo
			@endif
		</div>
	</div>
@stop

@section('scripts')
	{!!Html::script('js/custom-file-input.js')!!}
	{!!Html::script('js/script.js')!!}
@endsection