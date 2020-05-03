{!!Form::text('password',null,['id'=>'password-confi', 'class'=>'form-control input-custom-app', 'placeholder'=>'Dígitos'])!!}
<small>Ingresa los siguiente digitos para confirmar: <strong>12345</strong></small>
<input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
<div id="msg-eliminacion"></div>