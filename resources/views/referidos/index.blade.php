@extends('layouts.adminv2')

@section('content')
	<div class="col-xl-12">
		<div class="card">
			<div class="card-header">
				<h5>Listado de Referidos</h5>
			</div>
			<div class="card-block table-border-style">
				@if(count($referidos) > 0)
					@if(!isset($noBuscador))
						<div class="col-md-4 m-auto">
							{!!Form::model(Request::all(), ['route'=>'referidos.index', 'method'=>'GET', 'role'=>'search'])!!}
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
										<th>Nombre Completo</th>
										<th>Correo Electronico</th>
										@if(Auth::user()->id_tipo_cuenta == 1)
											<th>Balance</th>
										@endif
										<th>Pais</th>
										<th>Codigo personal</th>
										<th># Referidos</th>
										@if(Auth::user()->id_tipo_cuenta == 1)
											<th>Acciones</th>
										@endif
									</tr>
								</thead>
								@foreach($referidos as $referido)
									<tbody>
										<td class="first-item-table">{{$referido->name}}</td>
										<td>{{$referido->email}}</td>
										@if(Auth::user()->id_tipo_cuenta == 1)
											<td>
												<a style="cursor: pointer;" class="ver-balance pcoded-badge label label-success" data-toggle="modal" data-target="#verbalances" data-url="/balances/{{$referido->id_user}}/" data-idusers="{{$referido->id_user}}">Ver Balance</a>
											</td>
										@endif
										<td>
											{!! \App\Http\Controllers\UsuarioController::nombreCiudad($referido->id_pais) !!}
										</td>
										<td class="text-center">
											{{$referido->codigo_referido_users}}
										</td>
										<td class="text-center">
											@if(\App\Http\Controllers\ReferidoController::countReferidosList($referido->codigo_referido_users) > 0)
												<a href="/referidos/n/{{$referido->codigo_referido_users}}/<?php echo (isset($nivel))? $nivel : 2; ?>">{!! \App\Http\Controllers\ReferidoController::countReferidosList($referido->codigo_referido_users) !!}</a>
											@else
												{!! \App\Http\Controllers\ReferidoController::countReferidosList($referido->codigo_referido_users) !!}
											@endif
										</td>
										@if(Auth::user()->id_tipo_cuenta == 1)
											<td class="acciones-btns text-center">
												<div class="btn-group" role="group" aria-label="Basic example">
													<a class="btn-editar m-r-10" href="/referidos/{{$referido->id_user}}/edit" data-toggle="tooltip" data-placement="top" title="Editar">
														<i class="feather icon-edit"></i>
													</a>
													<a class="btn-eliminar" data-toggle="modal" data-target="#modaleliminar" data-toggle="tooltip" data-placement="top" title="Eliminar" data-ideliminar="{{$referido->id_user}}">
														<i class="feather icon-trash-2"></i>
													</a>
												</div>
											</td>
										@endif
									</tbody>
								@endforeach
							</table>
							@if(!isset($noPaginado))
								<div class="m-t-10 m-b-10 m-l-20 m-r-20">
									{!!$referidos->appends(Request::only(['codigo_r']))->render()!!}
								</div>
							@endif
						</div>
					</div>
				@else
					<div class="col-xl-12">
						<div class="alert alert-info background-info m-b-20">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<i class="icofont icofont-close-line-circled text-white"></i>
							</button>
							No se encontraron referidos
						</div>
					</div>
				@endif
			</div>
		</div>
	</div>
@stop