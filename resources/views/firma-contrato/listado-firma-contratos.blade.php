@extends('layouts.adminv2')

@section('content')
	<div class="col-xl-12">
		<div class="card">
			<div class="card-header">
				<h5>Listado de Firmas de contrado</h5>
			</div>
			<div class="card-block table-border-style">
				@if(count($firmasContratos) > 0)
					
					<div class="col-xl-12">
						<div class="table-responsive">
							<table class="table">
								<thead>
									<tr>
										<th>Datos del usuario</th>
										<th>Adjunto contato</th>
										<th class="text-center">Acción</th>
									</tr>
								</thead>
								@foreach($firmasContratos as $firmaContrato)
									<?php 
										$infoUsu = \App\Http\Controllers\CuentaController::infoUsuario($firmaContrato->id_user);
									?>
									@if($infoUsu != null)
										<tr>
			    						<td class="first-item-table">
			    							Codigo: <small style="display: inline-block;color: #00576e;font-weight: 600;">{{$infoUsu->codigo_referido_users}}</small>
			    							<p class="m-b-0" style="display: block;line-height: 0.8;;">{{$infoUsu->name}}</p>
			    						</td>
			    						<td>
			    							<a target="_blank" class="btn-sm btn-warning" href="../contratos_firmados/{{$firmaContrato->url_contrato}}">Ver Contrato</a>
			    						</td>
			    						<td class="text-center">
			    							<a class="btn-eliminar" data-toggle="modal" data-target="#modaleliminar" data-toggle="tooltip" data-placement="top" title="Eliminar" data-ideliminar="{{$firmaContrato->id_user}}">
													<i class="feather icon-trash-2"></i>
												</a>
			    						</td>
			    					</tr>
									@endif
								@endforeach
							</table>
							
							<div class="m-t-10 m-b-10 m-l-20 m-r-20">
								{!!$firmasContratos->appends(Request::all())->render()!!}
							</div>
							
						</div>
					</div>
				@else
					<div class="col-xl-12">
						<div class="alert alert-info background-info m-b-20">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<i class="icofont icofont-close-line-circled text-white"></i>
							</button>
							No se encontraron firmas de contrados adjuntas en el sistema.
						</div>
					</div>
				@endif
			</div>
		</div>
	</div>
@stop