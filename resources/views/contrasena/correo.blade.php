<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Apertura de Cuenta</title>
	</head>
	<body>
        
		<h2>Datos del Cliente</h2>
		<p><strong>Nombre del Cliente:</strong> {!!$usuario->name!!}</p>
		<p><strong>Tipo de Documento:</strong> 
			@if($usuario->id_tipo_cuenta == 1)
				CC
			@elseif($usuario->id_tipo_cuenta == 2)
				TI
			@else
				CE
			@endif
		</p>
		<p><strong>N° de documento:</strong> {!!$usuario->numero_documento!!}</p>
		<p><strong>Correo Electronico:</strong> {!!$usuario->email!!}</p>
		<p><strong>Telefono:</strong> {!!$usuario->telefono_users!!}</p>
		<p><strong>Dirección:</strong> {!!$usuario->direccion_users!!}</p>
		<p><strong>URL:</strong> {!!$token!!}</p>
	</body>
</html>