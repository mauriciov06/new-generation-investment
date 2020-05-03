@extends('layouts.adminv2')

@section('content')
	<div class="col-xl-12">
		<div class="card">
			<div class="card-header">
				<h5>Listado de Inversiones</h5>
			</div>
			<div class="card-block table-border-style">
				@if(count($listconfipago) > 0)
					@if(!isset($noBuscador))
						<div class="col-md-4 m-auto">
							{!!Form::model(Request::all(), ['route'=>'cuenta.index', 'method'=>'GET', 'role'=>'search'])!!}
							  <div class="input-group search_filter">
							    @include('search.search_referido')
							    <span class="input-group-btn">
									{!!Form::submit('Buscar',['class'=>'btn btn-primary'])!!}
								</span>
							  </div>
							{!!Form::close()!!}
						</div>
					@endif
					<div class="col-xl-12">
						<div class="table-responsive">
							<table class="table">
								<thead>
									<tr>
										<th>Datos del usuario</th>
										<th>Contrato</th>
										<th>Inversión/Paquete</th>
										<th>Fecha/Hora de solicitud</th>
										<th>Estado</th>
									</tr>
								</thead>
								@foreach($listconfipago as $confipago)
									<?php 
										$infoUsu = \App\Http\Controllers\CuentaController::infoUsuario($confipago->id_user);
									?>
									@if($infoUsu != null)
										<tr>
			    						<td class="first-item-table" style="line-height: 15px !important;">
			    							
			    							{!! $infoUsu->name !!} (Codigo: <small>{!! $infoUsu->codigo_referido_users !!}</small>)
			    							<small style="display: block;color: #00576e;font-weight: 600;">{!! $infoUsu->email !!}</small>
			    						</td>
			    						<td>
			    							<small style="display: block;">ID Contrato: CO{!! $confipago->id_referidos_contratos !!}N</small>
			    							{!! \App\Http\Controllers\CuentaController::infoContrato($confipago->id_contrato) !!}
			    						</td>
			    						<td>
			    							@if($confipago->id_paquete != 0)
			    								{!! \App\Http\Controllers\CuentaController::infoPaquete($confipago->id_paquete) !!}
			    							@else
			    								{!! $confipago->valor_inversion !!} USD
			    							@endif
			    						</td>
			    						<td>
			    							@if($confipago->datetime_solicitud == null)
			    								{!! \App\Http\Controllers\CuentaController::formatDate($confipago->created_at) !!}
			    							@else
			    								{!! \App\Http\Controllers\CuentaController::formatDate($confipago->datetime_solicitud) !!}
			    							@endif
			    						</td>
			    						<td style="position: relative;">
			    							<select name="estado_refPago" id="estado_refPago_{{$confipago->id_referidos_contratos}}" data-idconfpago="{{$confipago->id_referidos_contratos}}" class="form-control estado_refPagos">
			    								<option value="0" <?php echo ($confipago->estado_referido_contratos == 0)?'selected': '' ?> >En espera</option>
			    								<option value="1" <?php echo ($confipago->estado_referido_contratos == 1)?'selected': '' ?> >Activado</option>
			    							</select>
			    							<input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">
			    						</td>
			    					</tr>
									@endif
								@endforeach
							</table>
							@if(!isset($noPaginado))
								<div class="m-t-10 m-b-10 m-l-20 m-r-20">
									{!!$listconfipago->appends(Request::only(['codigo_r']))->render()!!}
								</div>
							@endif
						</div>
					</div>
				@else
					<div class="alert alert-info background-info m-b-20">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<i class="icofont icofont-close-line-circled text-white"></i>
						</button>
						No se encontraron confirmaciones de pagos.
					</div>
				@endif
			</div>
		</div>
	</div>
@stop