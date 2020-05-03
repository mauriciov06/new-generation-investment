@extends('layouts.adminv2')

@section('content')
	<div class="col-xl-12">
		<div class="card">
			<div class="card-header">
				<h5>Listado de Retiros</h5>
			</div>
			<div class="card-block table-border-style">
				@if(count($retiros) > 0)
					@if(!isset($noBuscador))
						<div class="col-md-4 m-auto">
							{!!Form::model(Request::all(), ['route'=>'retiros.index', 'method'=>'GET', 'role'=>'search'])!!}
							  <div class="input-group search_filter">
							    @include('search.search_retiros')
							    <span class="input-group-btn">
						        {!!Form::submit('Buscar',['class'=>'btn btn-primary'])!!}
						      </span>
							  </div>
							{!!Form::close()!!}
						</div>
					@endif
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr>
									<th>ID Retiro</th>
									<th>Datos del Usuario</th>
									<th>Valor a retirar</th>
									<th>Dirección de billetera</th>
									<th>Fecha/hora de solicitud</th>
									<th>Estado</th>
									@if(Auth::user()->id_tipo_cuenta == 1)
										<th>Acciones</th>
									@endif
								</tr>
							</thead>
							@foreach($retiros as $retiro)
								<tbody>
									<td>RE{{$retiro->id_retiros}}</td>
									<?php 
										$infoUsu = \App\Http\Controllers\CuentaController::infoUsuario($retiro->id_user);
									?>
									<td class="first-item-table" style="line-height: 15px !important;">
										{!! $infoUsu->name !!} (Codigo: <small>{!! $infoUsu->codigo_referido_users !!}</small>)
			    						<small style="display: block;color: #00576e;font-weight: 600;">{!! $infoUsu->email !!}</small>
			    						@if(Auth::user()->id_tipo_cuenta == 1)
			    							<small>ID Contrato: CO{!! $retiro->id_referidos_contratos !!}N <br>
			    							{!! \App\Http\Controllers\RetirosController::infoContrato($retiro->id_user, $retiro->id_referidos_contratos) !!}</small>
			    						@endif
									</td>
									<td>{{$retiro->valor_retirar}} USD</td>
									<td>{{$infoUsu->direccion_billetera}}</td>
									<td>
										{!! \App\Http\Controllers\CuentaController::formatDate($retiro->fecha_solicitud_retiro) !!}
									</td>
									<td style="position: relative;">
										@if(Auth::user()->id_tipo_cuenta == 1)
											<select name="estado_refPago" id="estado_retiCo_{{$retiro->id_retiros}}" data-idretiros="{{$retiro->id_retiros}}" class="form-control estado_retiCo">
													<option value="0" <?php echo ($retiro->estado_retiro == 0)?'selected': '' ?> >En espera</option>
													<option value="1" <?php echo ($retiro->estado_retiro == 1)?'selected': '' ?> >Pagado</option>
											</select>
										@else
											@if($retiro->estado_retiro != 0)
												<span class="label label-success">Pagado</span>
											@else
												<span class="label label-default">En espera</span>
											@endif
										@endif
										<input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">
									</td>
									@if(Auth::user()->id_tipo_cuenta == 1)
										<td class="acciones-btns">
											<div class="btn-group" role="group" aria-label="Basic example">
												<a class="btn-eliminar" data-toggle="modal" data-target="#modaleliminar" data-toggle="tooltip" data-placement="top" title="Eliminar" data-ideliminar="{{$retiro->id_retiros}}">
													<i class="far fa-trash-alt"></i>
												</a>
											</div>
										</td>
									@endif
								</tbody>
							@endforeach
						</table>
						@if(!isset($noPaginado))
							<div class="m-t-10 m-b-10 m-l-20 m-r-20">
								{!!$retiros->appends(Request::all())->render()!!}
							</div>
						@endif
					</div>
				@else
					<div class="col-xl-12">
						<div class="alert alert-info background-info m-b-20">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<i class="icofont icofont-close-line-circled text-white"></i>
							</button>
							No se encontraron retiros
						</div>
					</div>
				@endif
			</div>
		</div>
	</div>
@stop