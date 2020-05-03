{{-- <div class="col-xs-4">
	<div class="form-group" style="text-align: center;">
		<output id="list" style="padding: 7px 0 7px 0 !important;">
			@if(!empty($referido) && $referido->avatar_users != null)
				<img class="thumb" src="/avatares/{!!$referido->avatar_users!!}" alt="">
			@else
				<img class="thumb" src="/avatares/default-avatar.png" alt="">
			@endif
		</output>
		<input type="file" name="avatar_users" id="files" class="inputfile inputfile-1" />
		<label for="avatar"><span>Seleccionar avatar</span></label>
	</div>
</div> --}}
<div class="col-xl-6 col-sm-6">
	<div class="form-group">
		{!!Form::label('Nombre:')!!}
		{!!Form::text('name',null,['class'=>'form-control'])!!}
	</div>
</div>
<div class="col-xl-6 col-sm-6">
	<div class="form-group">
		{!!Form::label('Correo Electronico:')!!}
		{!!Form::email('email',null,['class'=>'form-control'])!!}
	</div>
</div>
<div class="col-xl-6 col-sm-6">
	<div class="form-group">
		{!!Form::label('Dirección:')!!}
		{!!Form::text('direccion_users',null,['class'=>'form-control'])!!}
	</div>
</div>
<div class="col-xl-6 col-sm-6">
	<div class="form-group">
		{!!Form::label('Celular:')!!}
		{!!Form::text('celular_users',null,['class'=>'form-control'])!!}
	</div>
</div>
<div class="col-xl-6 col-sm-6">
	<div class="form-group">
		{!!Form::label('Teléfono:')!!}
		{!!Form::text('telefono_users',null,['class'=>'form-control'])!!}
	</div>
</div>
<div class="col-xl-6 col-sm-6">
	<div class="form-group">
		{!!Form::label('Pais:')!!}
		{!!Form::select('id_pais',$paises, null,['class'=>'form-control'])!!}
	</div>
</div>
<div class="col-xl-6 col-sm-6">
	<div class="form-group">
		{!!Form::label('Dirección de billetera:')!!}
		{!!Form::text('direccion_billetera',null,['class'=>'form-control'])!!}
	</div>
</div>
<div class="col-xl-6 col-sm-6">
	<div class="form-group">
		{!!Form::label('Contraseña:')!!}
		{!!Form::password('password',['class'=>'form-control'])!!}
	</div>
</div>
<div class="col-xl-6 col-sm-6">
	<div class="form-group">
		{!!Form::label('Confirmar Contraseña:')!!}
		{!!Form::password('confirmar_contraseña',['class'=>'form-control'])!!}
	</div>
</div>
@if(isset($referido->codigo_referido_users))
	<div class="col-xl-6 col-sm-6">
		<div class="form-group">
			{!!Form::label('Codigo de referido:')!!}
			{!!Form::text('codigo_referido_users',$referido->codigo_referido_users,['class'=>'form-control', 'disabled'=>true])!!}
		</div>
	</div>
@endif
{!!Form::hidden('id_tipo_cuenta','2')!!}
