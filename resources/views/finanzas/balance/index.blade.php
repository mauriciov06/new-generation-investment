@extends('layouts.adminv2')

@section('content')
	<div class="col-xl-12">
		<div class="row">
			<div class="col-xl-12">
				<div class="alert alert-info background-info m-b-20">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<i class="icofont icofont-close-line-circled text-white"></i>
					</button>
					Debido al tiempo de carga de los valores es posible que debas recargar de nuevo la pagina.
				</div>
			</div>
		</div>
	</div>

	<div class="col-xl-12">
		<div class="row">
			<div class="col-xl-4 col-md-6">
				<div class="card">
					<div class="card-block">
						<div class="row align-items-center">
							<div class="col-8">
								<h4 class="text-c-yellow f-w-600">{!! \App\Http\Controllers\FinanzasController::calcularRefNvl1(Auth::user()->codigo_referido_users) !!} USD</h4>
								<h6 class="text-muted m-b-0">Comisiones de referidos</h6>
							</div>
							<div class="col-4 text-right">
								<i class="feather icon-bar-chart f-28"></i>
							</div>
						</div>
					</div>
					<div class="card-footer bg-c-yellow">
						<div class="row align-items-center">
							<div class="col-9">
								<p class="text-white m-b-0">Nivel 1</p>
							</div>
							<div class="col-3 text-right">
								<i class="feather icon-trending-up text-white f-16"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-4 col-md-6">
				<div class="card">
					<div class="card-block">
						<div class="row align-items-center">
							<div class="col-8">
								<h4 class="text-c-green f-w-600">{!! \App\Http\Controllers\FinanzasController::calcularRefNvl2(Auth::user()->codigo_referido_users) !!} USD</h4>
								<h6 class="text-muted m-b-0">Comisiones de referidos</h6>
							</div>
							<div class="col-4 text-right">
								<i class="feather icon-bar-chart f-28"></i>
							</div>
						</div>
					</div>
					<div class="card-footer bg-c-green">
						<div class="row align-items-center">
							<div class="col-9">
								<p class="text-white m-b-0">Nivel 2</p>
							</div>
							<div class="col-3 text-right">
								<i class="feather icon-trending-up text-white f-16"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-4 col-md-6">
				<div class="card">
					<div class="card-block">
						<div class="row align-items-center">
							<div class="col-8">
								<h4 class="text-c-pink f-w-600">{!! \App\Http\Controllers\FinanzasController::calcularRefNvl3(Auth::user()->codigo_referido_users) !!} USD</h4>
								<h6 class="text-muted m-b-0">Comisiones de referidos</h6>
							</div>
							<div class="col-4 text-right">
								<i class="feather icon-bar-chart f-28"></i>
							</div>
						</div>
					</div>
					<div class="card-footer bg-c-pink">
						<div class="row align-items-center">
							<div class="col-9">
								<p class="text-white m-b-0">Nivel 3</p>
							</div>
							<div class="col-3 text-right">
								<i class="feather icon-trending-up text-white f-16"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>	

	<div class="col-xl-12">
		<div class="row">
			@if(count($infoBalanace) > 0)
				@foreach($infoBalanace as $balance)
					@foreach($balance as $itemBalance)
						<div class="col-xl-4 col-md-6">
							<div class="card">
								<div class="card-header p-b-15 text-center">
									<h4>{!! \App\Http\Controllers\CuentaController::infoContrato($itemBalance->id_contrato) !!}</h4>
									{{-- <div class="card-header-right">
										<ul class="list-unstyled card-option">
											<li><i class="fa fa fa-wrench open-card-option"></i></li>
											<li><i class="fa fa-window-maximize full-card"></i></li>
											<li><i class="fa fa-minus minimize-card"></i></li>
											<li><i class="fa fa-refresh reload-card"></i></li>
											<li><i class="fa fa-trash close-card"></i></li>
										</ul>
									</div> --}}
								</div>
								<div class="card-block">
									{{-- <p class="text-c-green f-w-500"><i class="feather icon-chevrons-up m-r-5"></i> 18% High than last month</p> --}}
									<div class="row">
										<div class="col-6 b-r-default m-b-10 text-center">
											<h4>{{$itemBalance->valor_utilidad}}</h4>
											<p class="text-muted m-b-10 l-h-13">Valor utilidad</p>
										</div>
										<div class="col-6 m-b-10 text-center">
											<h4>{!! \App\Http\Controllers\FinanzasController::redondearValor($itemBalance->valor_diario) !!} USD</h6>
											<p class="text-muted m-b-10 l-h-13">Valor diario ganado</p>
										</div>
										<div class="col-6 b-r-default text-center">
											<h4>{!! \App\Http\Controllers\FinanzasController::fechaActivacionContrato($itemBalance->id_referidos_contratos) !!}</h4>
											<p class="text-muted m-b-10 l-h-13">Activación del contrato</p>
										</div>
										<div class="col-6 text-center">
											<h4>{!! \App\Http\Controllers\FinanzasController::fechaVencimientoContrato($itemBalance->id_referidos_contratos) !!}</h4>
											<p class="text-muted m-b-10 l-h-13">Vencimiento del contrato</p>
										</div>
										<div class="col-12 text-center m-t-20 m-b-10">
											@if($itemBalance->estado_finanza == 1)
												<span class="label label-success">Finalizado</span>
											@else
												<span class="label label-primary">En curso</span>
											@endif
										</div>
									</div>
								</div>
							</div>
						</div>
					@endforeach	
				@endforeach
			@else
				<div class="col-xs-12">
					<div class="alert alert-info background-info m-b-20">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<i class="icofont icofont-close-line-circled text-white"></i>
						</button>
						Aun no se han generado balances para sus contratos, puede deberse a que no estan activos.
					</div>
				</div>
			@endif
		</div>
	</div>
@stop