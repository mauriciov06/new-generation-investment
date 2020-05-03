@extends('layouts.adminv2')

@section('content')
	<div class="col-xl-12">
		<div class="card">
			<div class="card-header">
				<h5 class="card-header-text b-b-default p-b-10 m-r-0" style="display: block;">Editar Usuario</h5>
			</div>
			<div class="card-block">
				{!!Form::model($usuario, ['route'=> ['usuarios.update', $usuario->id_user], 'method'=>'PUT', 'files'=>true])!!}
					<div class="row">
						@include('usuarios.forms.usr', ['userOrigin'=>true])
						<div class="col-xl-12 text-center">
							{!!Form::submit('Actualizar',['class'=>'btn btn-primary waves-effect waves-light m-t-20 m-b-20'])!!}
						</div>
					</div>
				{!!Form::close()!!}
			</div>
		</div>
	</div>
@stop