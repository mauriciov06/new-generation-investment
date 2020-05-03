<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Confirmación de Pago</title>
	</head>
	<body>
        
		<h2>Datos del Cliente</h2>
		<p><strong>Nombre del Cliente:</strong> {!!$usuario->name!!}</p>
		<p><strong>Codigo de referido:</strong> {!!$usuario->codigo_referido_users!!}</p>
		<p><strong>Correo Electronico:</strong> {!!$usuario->email!!}</p>
		<p><strong>Hash de Pago:</strong> {!!$hashPago!!}</p>

		<h2>Datos del Contrato Solicitado</h2>
		<p><strong>Tipo de contracto:</strong> 
		@if($idContrato == 1)
			Basic
		@elseif($idContrato == 2)
			Pro
		@else
			Ultimate
		@endif</p>
		<p><strong>Valor de inversión:</strong> {!!$valorInversion!!}</p>
	</body>
</html>