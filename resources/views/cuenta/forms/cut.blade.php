{{-- <div class="col-xs-4">
	<div class="form-group" style="text-align: center;">
		<output id="list" style="padding: 7px 0 7px 0 !important;">
			@if(!empty($usuario) && $usuario->avatar_users != null)
				<img class="thumb" src="/avatares/{!!$usuario->avatar_users!!}" alt="">
			@else
				<img class="thumb" src="/avatares/default-avatar.png" alt="">
			@endif
		</output>
		<input type="file" name="avatar" id="files" class="inputfile inputfile-1" />
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
@if(Auth::user()->id_tipo_cuenta == 1)
	{!!Form::hidden('id_tipo_cuenta','1')!!}
@else
	{!!Form::hidden('id_tipo_cuenta','2')!!}
@endif
