@extends('layouts.adminv2')

@section('content')
	<div class="col-xl-12">
		<div class="card">
			<div class="card-header">
				<h5>Listado de Usuarios</h5>
			</div>
			<div class="card-block table-border-style">
				@if(count($users) > 0)
					<div class="col-xl-12">
						<div class="table-responsive">
							<table class="table">
								<thead>
									<tr>
										<th>Nombre Completo</th>
										<th>Correo Electronico</th>
										<th>Celular</th>
										<th>Pais</th>
										<th class="text-center">Acciones</th>
									</tr>
								</thead>
								@foreach($users as $user)
									<tbody>
										<td class="first-item-table">{{$user->name}}</td>
										<td>{{$user->email}}</td>
										<td>{{$user->celular_users}}</td>
										<td>
											{!! \App\Http\Controllers\UsuarioController::nombreCiudad($user->id_pais) !!}
										</td>
										<td class="acciones-btns text-center">
											<div class="btn-group" role="group" aria-label="Basic example">
												<a class="btn-editar m-r-10" href="/usuarios/{{$user->id_user}}/edit" data-toggle="tooltip" data-placement="top" title="Editar">
													<i class="feather icon-edit"></i>
												</a>
												<a class="btn-eliminar" data-toggle="modal" data-target="#modaleliminar" data-toggle="tooltip" data-placement="top" title="Eliminar" data-ideliminar="{{$user->id_user}}">
													<i class="feather icon-trash-2"></i>
												</a>
											</div>
										</td>
									</tbody>
								@endforeach
							</table>
							@if(!isset($noPaginado))
								<div class="m-t-10 m-b-10 m-l-20 m-r-20">
									{!!$users->appends(Request::all())->render()!!}
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
							No se encontraron usuarios
						</div>
					</div>
				@endif
			</div>
		</div>
	</div>
@stop