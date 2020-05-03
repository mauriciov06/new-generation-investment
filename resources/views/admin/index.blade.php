@extends('layouts.adminv2')

@section('content')
  @if(Auth::user()->id_tipo_cuenta == 2)
    <div class="col-xl-3 col-md-6">
      <div class="card bg-c-yellow update-card">
        <div class="card-block">
          <div class="row align-items-end">
            <div class="col-8">
              <h4 class="text-white">{!! \App\Http\Controllers\FinanzasController::calcularRefNvl1(Auth::user()->codigo_referido_users) !!} USD</h4>
              <h6 class="text-white m-b-0">Comisión de Referido</h6>
            </div>
            <div class="col-4 text-right">
              <canvas id="update-chart-1" height="50"></canvas>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <p class="text-white m-b-0"><i class="feather icon-clock text-white f-14 m-r-10"></i>Nivel 1</p>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-md-6">
      <div class="card bg-c-green update-card">
        <div class="card-block">
          <div class="row align-items-end">
            <div class="col-8">
              <h4 class="text-white">{!! \App\Http\Controllers\FinanzasController::calcularRefNvl2(Auth::user()->codigo_referido_users) !!} USD</h4>
              <h6 class="text-white m-b-0">Comisión de Referido</h6>
            </div>
            <div class="col-4 text-right">
              <canvas id="update-chart-2" height="50"></canvas>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <p class="text-white m-b-0"><i class="feather icon-clock text-white f-14 m-r-10"></i>Nivel 2</p>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-md-6">
      <div class="card bg-c-pink update-card">
        <div class="card-block">
          <div class="row align-items-end">
            <div class="col-8">
              <h4 class="text-white">{!! \App\Http\Controllers\FinanzasController::calcularRefNvl3(Auth::user()->codigo_referido_users) !!} USD</h4>
              <h6 class="text-white m-b-0">Comisión de referido</h6>
            </div>
            <div class="col-4 text-right">
              <canvas id="update-chart-3" height="50"></canvas>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <p class="text-white m-b-0"><i class="feather icon-clock text-white f-14 m-r-10"></i>Nivel 3</p>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-md-6">
      <div class="card bg-c-lite-green update-card">
        <div class="card-block">
          <div class="row align-items-end">
            <div class="col-8">
              <h4 class="text-white">{!! \App\Http\Controllers\ReferidoController::countReferidosList(Auth::user()->codigo_referido_users) !!}</h4>
              <h6 class="text-white m-b-0">Referidos </br> Directos</h6>
            </div>
            <div class="col-4 text-right">
              <canvas id="update-chart-4" height="50"></canvas>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <p class="text-white m-b-0"><i class="feather icon-clock text-white f-14 m-r-10"></i>Actualizado a las 12:01 am</p>
        </div>
      </div>
    </div>
  @endif
	<div class="<?php echo (Auth::user()->id_tipo_cuenta == 1)? 'col-xl-12' : 'col-xl-8' ;?> col-md-12">
		<div class="card">
			<div class="card-header text-center">
			<h2>¡Te damos la bienvenida!</h2>
			<span class="m-b-20">New Generation Investment te lleva a una nueva experiencia de invertir Online</span>
      @if(Auth::user()->id_tipo_cuenta == 2)
  			<div class="input-group m-b-10">
          <a class="input-group-addon style-1"><i class="fa fa-link"></i></a>
  				<input type="text" class="form-control text-center" id="copy-link-ref" readonly value="{!!URL::to('/r/'.$idUser->codigo_referido_users)!!}">
  				<a class="input-group-addon style-2 copy-link" onClick="copyToClipBoard()"><i class="fa fa-copy"></i></a>
  			</div>
        <span class="m-t-0 m-b-20" style="font-size: 12px;">Copie y comparta su link de referido</span>
      @endif
		</div>
		</div>
	</div>
  @if(Auth::user()->id_tipo_cuenta == 2)
  	<div class="col-xl-4 col-md-12">
  		<div class="card user-card-full">
  			<div class="row m-l-0 m-r-0">
  				<div class="col-sm-12">
  					<div class="card-block">
              @if($patrocinador == null)
                <div class="col-sm-12">
                  <i class="fa fa-question-circle-o user-default-ref"></i>
                  <h6 class="text-muted f-w-400 text-center">No tienes referido directo</h6>
                </div>
              @else
  						  <h6 class="m-b-10 p-b-5 b-b-default f-w-600">Informatión de Patrocinador</h6>
  						  <div class="row">
                  <div class="col-sm-12">
                    <p class="m-b-0 f-w-600">Nombre</p>
                    <h6 class="text-muted f-w-400">{{$patrocinador->name}}</h6>
                  </div>
    							<div class="col-sm-6">
    								<p class="m-b-0 f-w-600">Codigo</p>
    								<h6 class="text-muted f-w-400">{{$patrocinador->codigo_referido_users}}</h6>
    							</div>
    							<div class="col-sm-6">
    								<p class="m-b-0 f-w-600">Calular</p>
    								<h6 class="text-muted f-w-400">{{$patrocinador->celular_users}}</h6>
    							</div>
    							<div class="col-sm-6">
    								<p class="m-b-0 f-w-600">Ubicación</p>
    								<h6 class="text-muted f-w-400">{!! \App\Http\Controllers\UsuarioController::nombreCiudad($patrocinador->id_pais) !!}</h6>
    							</div>
                </div>
              @endif
  					</div>
  				</div>
  			</div>
  		</div>
  	</div>
  @endif
@endsection