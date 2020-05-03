
@if(Auth::user()->id_tipo_cuenta == 1)
	{!!Form::text('codigo_r',null,['id'=>'codigo_r', 'class'=>'form-control search_codigo_r', 'placeholder'=>"Codigo"])!!}
	{!!Form::text('direccion_b',null,['id'=>'direccion_b', 'class'=>'form-control search_direccion_b', 'placeholder'=>"Dirección de billetera"])!!}
@else
	{!!Form::text('codigo_r',null,['id'=>'codigo_r', 'class'=>'form-control search_codigo_r', 'placeholder'=>"Codigo", 'style'=>'width: 100% !important;'])!!}
@endif
