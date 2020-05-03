<div class="row">
	<div class="col-xs-12 col-sm-6">
		<div class="form-group">
			{!!Form::text('name',null,['class'=>'form-control', 'placeholder'=>'Nombre'])!!}
		</div>
	</div>
	<div class="col-xs-12 col-sm-6">
		<div class="form-group">
			{!!Form::email('email',null,['class'=>'form-control', 'placeholder'=>'Correo electronico'])!!}
		</div>
	</div>
	<div class="col-xs-12 col-sm-6">
		<div class="form-group">
			{!!Form::text('celular_users',null,['class'=>'form-control', 'placeholder'=>'Celular'])!!}
		</div>
	</div>
	<div class="col-xs-12 col-sm-6">
		<div class="form-group">
			{!!Form::select('id_pais',$paises, null,['class'=>'form-control'])!!}
		</div>
	</div>
	<div class="col-xs-12 col-sm-6">
		<div class="form-group">
			{!!Form::password('password',['class'=>'form-control', 'placeholder'=>'Contraseña'])!!}
		</div>
	</div>
	<div class="col-xs-12 col-sm-6">
		<div class="form-group">
			{!!Form::password('confirmar_contraseña',['class'=>'form-control', 'placeholder'=>'Confirmar Contraseña'])!!}
		</div>
	</div>
	{{-- <div class="col-xs-12">
	    <div class="g-recaptcha" data-sitekey="{{env('CAPTCH_KEY')}}">

		</div>
	</div> --}}
	{!!Form::hidden('id_tipo_cuenta','2')!!}
	@if(isset($hashRef) && isset($referido[0]))
		<div class="col-xs-12">
			<div class="col-xs-12 panel-ref-registro">
				<label>Patrocinador:</label> {{$referido[0]->name}}
				<label>Código del patrocinador:</label> {{$hashRef}}
			</div>
		</div>
		{!!Form::hidden('codigo_referido_padre_users',$hashRef)!!}
	@endif
</div>