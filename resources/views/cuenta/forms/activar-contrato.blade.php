@extends('layouts.adminv2')

@section('content')
	<div class="col-xl-12">
		<div class="card">
			<div class="card-header">
				<h5>Activar contratos</h5>
			</div>
			<div class="card-block table-border-style">
				<div class="col-md-12">
					<div class="alert alert-info background-info m-b-20">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<i class="icofont icofont-close-line-circled text-white"></i>
						</button>
						Por favor seleccione un contrato e ingrese el valor de inversión.
					</div>
					<div class="col-xl-12">
						<div class="row m-t-30">
							@foreach($contratos as $contrato)
								<div class="col-md-12 col-xl-4 search-result">
									<div class="card text-center
										<?php if($contrato->id_contrato == 1){
												echo 'plan-1';
											}else if($contrato->id_contrato == 2){
												echo 'plan-2';
											}else{
												echo 'plan-3';
											}
										?>">
										<a href="#" class="item-contrato p-b-20 p-t-10" data-idcontrato="{{$contrato->id_contrato}}">
											<div class="card-header-img">
												{{-- <div class="job-badge">
													<label class="label bg-primary">Seleccionado</label>
												</div> --}}
												{{-- <img src="../files/assets/images/user-card/img-round4.jpg" alt="card-img" class="img-fluid img-radius" style="
												width: 100%;
												"> --}}
												@if($contrato->id_contrato == 1)
													<h4>Basic</h4>
													<h6>Desde 100 USD hasta 1.000 USD</h6>
												@elseif($contrato->id_contrato == 2)
													<h4>Pro</h4>
													<h6>Desde 1.100 USD hasta 2.000 USD</h6>
												@else
													<h4>Ultimatu</h4>
													<h6>Desde 3.000 USD hasta 20.000 USD</h6>
												@endif
											</div>
										</a>
									</div>
								</div>
							@endforeach
						</div>
						<div class="mssge-request"></div>
					</div>	

					<div class="content-valor-inver col-xl-5 m-auto text-center m-t-10 m-b-40">
						<div class="input-group input-group-button input-group-primary">
							<input type="number" class="form-control inversion-valor" placeholder="Ingrese el valor de su inversión">
							<a style="color: #fff;" class="btn-invertir btn btn-primary input-group-addon" data-idusuinver="{{Auth::user()->id_user}}">Pagar</a>
						</div>
					</div>
			
					<input type="hidden" class="contrato-selected">

					{{-- <div class="col-xs-12 text-center">
						<div class="conten-space-inver">
							<a class="btn-invertir" data-idusuinver="{{Auth::user()->id_user}}"><i class="fas fa-hand-holding-usd fa-fw"></i> Pagar</a>
						</div>
						<div class="datos-inve-billetera" style="display: none;">
							<div class="direccion-billetera">3D8q5StxuAJRk9rq1Y11jwzdKcPFGSPqMv</div>
							<small class="text-small-ayu-confi2">*Copie la dirección de BTC y realize el pago manualmente.</small>	
						</div>
						<input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">
					</div>
				</div> --}}
			</div>
		</div>
	</div>


	<div class="modal fade confirmar-pago-modal" id="confirmar-pago-modal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-md" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Confirmación de pago</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
			      <div class="col-sm-12">
			      	<div class="col-xs-12">
				      	<small class="text-small-ayu-confi" style="padding-bottom: 0;">Copie la siguiente dirección de Bitcoin y dirÍjase a la billetera de su preferencia y generé el pago. Una vez realizado su pago de click en el boton "Confirmar pago".</small>
				      	<div class="col-xl-12 text-center m-t-10 m-b-10">
				      		<h5 class="text-small-ayu-confi"><strong>D8q5StxuAJRk9rq1Y11jwzdKcPFGSPqMv</strong></h5>
				      	</div>
					</div>
					<div class="col-md-12 m-auto m-t-10 m-b-10">
						<input type="text" name="hash_pago" class="form-control hash_pago input-style-custom" placeholder="Ingrese el hash de pago para su confirmación">
					</div>
					<div class="col-xs-12">
						<small class="text-small-ayu-confi" style="padding-bottom: 0;"><strong>*Tener en cuenta que su pago se validara y al no ser efectivo se cancelara.</strong></small>						
					</div>
			      </div>
			    </div>
			    <div class="row">
			    	<div class="col-xl-12">
			    		<div class="response-msg-modal-confi"></div>
			    	</div>
			    </div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default btn-cerrar-modal" data-dismiss="modal">Cerrar</button>
			    <button href="#" disabled type="button" class="btn btn-confirmarpago btn-success" data-idusuario="{{Auth::user()->id_user}}" data-idfirma=""><i class="fas fa-money-check fa-fw"></i> Confirmar pago</button>
				</div>
			</div>
		</div>
	</div>


	
	<div class="modal fade" id="modal-terminos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h4 class="modal-title" id="myModalLabel">Terminos y Condiciones</h4>
	      </div>
	      <div class="modal-body">
	        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
	        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
	        <div class="alert alert-warning" role="alert">
			 	<strong>Importante</strong> al ingresar su nombre y numero de documento esta aceptanto este contrato.
			</div>
			<div class="row">
				<div class="col-xs-6">
					<div class="form-group">
			        	<input type="text" class="form-control" id="nombre-firma" placeholder="Ingrese su nombre completo">
			        </div>
				</div>
				<div class="col-xs-6">
					<div class="form-group">
			        	<input type="text" class="form-control" id="numdoc-firma" placeholder="Ingrese su número de documento">
			        </div>	
				</div>
				<input type="hidden" id="token-firma" name="_token" value="{{ csrf_token() }}">
				<input type="hidden" id="id-user" value="{{Auth::user()->id_user}}">
			</div>
			<div class="msn-firma"></div>
	      </div>
	      <div class="modal-footer">
	      	<a type="button" class="btn btn-primary guardar-firma">Guardar</a>
	        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	      </div>
	    </div>
	  </div>
	</div>
@stop

@section('scripts')
	{!!Html::script('js/custom-file-input.js')!!}
	{!!Html::script('js/script.js')!!}
@endsection