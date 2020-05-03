@extends('layouts.adminv2')

@section('content')
	<div class="col-lg-12">
		<div class="cover-profile">
			<div class="profile-bg-img">
				<img class="profile-bg-img img-fluid" src="/imagenes/perfil/bg-img1.jpg" alt="bg-img">
				<div class="card-block user-info">
					<div class="col-md-12">
						<div class="media-left">
							<a href="#" class="profile-image">
								@if($usuario->avatar_users != null)
									<img class="user-img img-radius" src="/avatares/{{$usuario->avatar_users}}" alt="user-img" style="width: 120px;">
								@else
									<img class="user-img img-radius" src="/avatares/default-avatar-2.jpg" alt="user-img" style="width: 120px;">
								@endif
							</a>
						</div>
						<div class="media-body row">
							<div class="col-lg-12">
								<div class="user-title">
									<h2>{{$usuario->name}}</h2>
									<span class="text-white">{{$usuario->email}}</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-12">
		<div class="tab-header card">
			<ul class="nav nav-tabs md-tabs tab-timeline" role="tablist" id="mytab">
				<li class="nav-item">
					<a class="nav-link active" data-toggle="tab" href="#personal" role="tab">Información Personal</a>
					<div class="slide"></div>
				</li>
				@if(Auth::user()->id_tipo_cuenta == 2)
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#binfo" role="tab">Mis Contratos</a>
						<div class="slide"></div>
					</li>
				@endif
			</ul>
		</div>
		<div class="tab-content">
			<div class="tab-pane active" id="personal" role="tabpanel">
				<div class="card">
					<div class="card-header">
						<h5 class="card-header-text">Acerca de mi</h5>
					</div>
					<div class="card-block">
						{!!Form::model($usuario, ['route'=> ['cuenta.update', $usuario->id_user], 'method'=>'PUT', 'files'=>true])!!}
							<div class="row">
								@if(Auth::user()->id_tipo_cuenta == 1)
									@include('usuarios.forms.usr', ['userOrigin'=>false])
								@else
									@include('cuenta.forms.cut')
								@endif
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<div class="text-center">
										{!!Form::submit('Actualizar',['class'=>'btn btn-primary waves-effect waves-light m-t-20 m-b-20'])!!}
									</div>
								</div>
							</div>
						{!!Form::close()!!}
					</div>
				</div>
			</div>
			
			@if(Auth::user()->id_tipo_cuenta == 2)
				<div class="tab-pane" id="binfo" role="tabpanel">
					<div class="card">
						<div class="card-header">
							<h5 class="card-header-text">Contratos</h5>
						</div>
						<div class="card-block">
							<div class="row">
								@if(count($contratos) > 0)
									@foreach($contratos as $contrato)
										<div class="col-md-3">
											<div class="card <?php echo ($contrato->estado_referido_contratos == 1)? 'b-l-success' : 'b-l-danger'; ?> business-info services m-b-20 text-center">
												<div class="card-header">
													<div class="service-header">
														<a href="#">
															<h5 class="card-header-text">{!! \App\Http\Controllers\CuentaController::infoContrato($contrato->id_contrato) !!}</h5>
														</a>
													</div>
													{{-- <span class="dropdown-toggle addon-btn text-muted f-right service-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" role="tooltip">
													</span>
													<div class="dropdown-menu dropdown-menu-right b-none services-list">
														<a class="dropdown-item" href="#!"><i class="icofont icofont-edit"></i> Edit</a>
														<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-delete"></i> Delete</a>
														<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i> View</a>
													</div> --}}
												</div>
												<div class="card-block">
													<div class="row">
														<div class="col-sm-12">
															<p>{!! $contrato->valor_inversion !!} USD</p>
															<p class="task-detail">
																@if($contrato->estado_referido_contratos == 1)
														    	<span class="pcoded-badge label label-success">Activo</span>
														    @else
														    	<span class="pcoded-badge label label-danger">Inactivo</span>
														    @endif
															</p>
														</div>
													</div>
												</div>
											</div>
										</div>
									@endforeach
								@endif
							</div>
						</div>
					</div>
				</div>
			@endif
		</div>
	</div>
@stop