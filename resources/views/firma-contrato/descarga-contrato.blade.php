@extends('layouts.adminv2')

@section('content')
	<div class="col-xl-12">
		<div class="alert alert-info background-info m-b-20">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<i class="icofont icofont-close-line-circled text-white"></i>
			</button>
			<strong>Importane!</strong> Firmar el contrato fisico le permitira solicitar retiros los dias viernes.
		</div>
	</div>
	<div class="col-xl-6">
		<div class="card latest-update-card time-paso-contrato">
			<div class="card-header">
				<h5>Descarga de contratos fisicos</h5>
				<p class="m-b-0 m-t-10">Sigue el paso a paso para poder subir el contrato firmado correctamente.</p>
			</div>
			<div class="card-block">
				<div class="latest-update-box">
					<div class="row p-b-20">
						<div class="col-auto text-left">
							<span class="badge btn-primary badge-paso">1</span>
						</div>
						<div class="col line-hei-paso">
							<h6>Descargar contrato</h6>
						</div>
					</div>
					<div class="row p-b-20">
						<div class="col-auto text-left">
							<span class="badge btn-primary badge-paso">2</span>
						</div>
						<div class="col line-hei-paso">
							<h6>Imprimir contrato</h6>
						</div>
					</div>
					<div class="row p-b-20">
						<div class="col-auto text-left">
							<span class="badge btn-primary badge-paso">3</span>
						</div>
						<div class="col line-hei-paso">
							<h6>Firmar contrato impreso</h6>
						</div>
					</div>
					<div class="row p-b-20">
						<div class="col-auto text-left">
							<span class="badge btn-primary badge-paso">4</span>
						</div>
						<div class="col line-hei-paso">
							<h6>Escanear contrato</h6>
						</div>
					</div>
					<div class="row p-b-0">
						<div class="col-auto text-left">
							<span class="badge btn-primary badge-paso">5</span>
						</div>
						<div class="col line-hei-paso">
							<h6>Subir contrato firmado en formato PDF</h6>
						</div>
					</div>
				</div>
				@if(!isset($conFirma))
					<div class="text-center p-t-20 p-b-20">						
						<a target="_blank" href="../contrato/CONTRATO_DE_VINCULACION_Y_ADMINISTRACION.pdf" class="btn btn-primary">Descargar Aquí</a>
					</div>
				@endif
			</div>
		</div>
	</div>
	<div class="col-xl-6">
		<div class="card">
			<div class="card-header p-b-10">
				<h5>Subida de contratos fisicos</h5>
				<p class="m-b-0 m-t-10">Adjunte su contrato fisico, recuerda que esta accion sera moderada por un asesor para confirmar la firma del contrato.</p>
			</div>
			<div class="card-block">	
				@if(isset($conFirma))
					<a class="url_previw_contrato" title="Ver Contrato" target="_blank" href="../contratos_firmados/{{$conFirma->url_contrato}}">
						<i class="fa fa-file-pdf-o"></i>
					</a>
					<div class="text-center">
						<a href="../contratos_firmados/{{$conFirma->url_contrato}}" target="_blank" class="btn btn-primary"><i class="fa fa-file-pdf-o"></i> Ver Contrato</a>
					</div>
				@endif
				@if(!isset($conFirma))
					<form action="/upload-contratos" method="POST" enctype="multipart/form-data">
						<input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="id_user" id="id_user" value="{{Auth::user()->id_user}}">
						<input type="file" name="adjunto_contrato" id="files" class="inputfile inputfile-1" />
						<div class="text-center">
							<button type="submit" class="btn btn-primary m-t-20">Subir contrato</button>
						</div>
					</form>
				@endif
				<div class="m-t-10 m-b-10">
        	@include('alerts.errors')
        </div>
			</div>
		</div>
	</div>
@stop

