<!DOCTYPE html>
<html>
  <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
  <head>
    <title>New Generation Investment - Cambiar Contraseña</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
    {!!Html::style('file_v2/bower_components/bootstrap/css/bootstrap.min.css')!!}
    {!!Html::style('file_v2/assets/icon/feather/css/feather.css')!!}
    {!!Html::style('file_v2/assets/icon/font-awesome/css/font-awesome.min.css')!!}
    {!!Html::style('file_v2/assets/css/style.css')!!}
    {!!Html::style('file_v2/assets/css/jquery.mCustomScrollbar.css')!!}

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
   
  </head>
  <body  class="fix-menu">

    <div class="theme-loader">
      <div class="ball-scale">
        <div class='contain'>
          <div class="ring"><div class="frame"></div></div>
          <div class="ring"><div class="frame"></div></div>
          <div class="ring"><div class="frame"></div></div>
          <div class="ring"><div class="frame"></div></div>
          <div class="ring"><div class="frame"></div></div>
          <div class="ring"><div class="frame"></div></div>
          <div class="ring"><div class="frame"></div></div>
          <div class="ring"><div class="frame"></div></div>
          <div class="ring"><div class="frame"></div></div>
          <div class="ring"><div class="frame"></div></div>
        </div>
      </div>
    </div>

    <section class="login-block bg-auxiliar">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="md-float-material form-material">
                        <div class="text-center">
                            <img src="/imagenes/new-generation-logo-white.png" alt="logo.png" width="80">
                        </div>
                        <div class="auth-box card">
                            <div class="card-block">
                                <div class="row m-b-10">
                                    <div class="col-md-12">
                                        <h3 class="text-center">Cambiar Contraseña</h3>
                                    </div>
                                </div>
                                <div class="text-center m-b-10">{!!$email!!}</div>
                                {!!Form::open(['route'=>'cambio.store', 'method'=>'POST','files'=>true])!!}
                                  {!!Form::hidden('email',$email)!!}
                                  <div class="col-xs-12">
                                      <div class="form-group">
                                          {!!Form::password('password',['class'=>'form-control', 'placeholder'=>'Contraseña'])!!}
                                      </div>
                                  </div>
                                  <div class="col-xs-12">
                                      <div class="form-group">
                                          {!!Form::password('confirmar_contraseña',['class'=>'form-control', 'placeholder'=>'Confirmar Contraseña'])!!}
                                      </div>
                                  </div>
                                  <div class="row">
                                      <div class="col-md-12">
                                          {!!Form::submit('Cambiar',['class'=>'btn btn-primary btn-md btn-block waves-effect text-center m-b-20'])!!}
                                      </div>
                                  </div>
                                {!!Form::close()!!}
                                @include('alerts.sucess')
                                @include('alerts.errors')
                                @include('alerts.request-registro')
                                <div class="row">
                                    <div class="col-md-10">
                                        <p class="text-inverse text-left m-b-0">Volver al</p>
                                        <p class="text-inverse text-left"><a href="{!!URL::to('/iniciar-sesion')!!}"><b class="f-w-600">Inicio de sesión</b></a></p>
                                    </div>
                                    <div class="col-md-2">
                                        <img src="/imagenes/new-generation-logo.png" alt="small-logo.png" style="width: 50px;float: right;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
  
    {!!Html::script('file_v2/bower_components/jquery/js/jquery.min.js')!!}
    {!!Html::script('file_v2/bower_components/jquery-ui/js/jquery-ui.min.js')!!}
    {!!Html::script('file_v2/bower_components/popper.js/js/popper.min.js')!!}
    {!!Html::script('file_v2/bower_components/bootstrap/js/bootstrap.min.js')!!}
    {!!Html::script('file_v2/bower_components/jquery-slimscroll/js/jquery.slimscroll.js')!!}
    {!!Html::script('file_v2/bower_components/modernizr/js/modernizr.js')!!}
    {!!Html::script('file_v2/bower_components/chart.js/js/Chart.js')!!}

    {!!Html::script('file_v2/assets/pages/widget/amchart/amcharts.js')!!}
    {!!Html::script('file_v2/assets/pages/widget/amchart/serial.js')!!}

    {!!Html::script('file_v2/assets/pages/widget/amchart/light.js')!!}
    {!!Html::script('file_v2/assets/js/jquery.mCustomScrollbar.concat.min.js')!!}
    {!!Html::script('file_v2/assets/js/SmoothScroll.js')!!}
    {!!Html::script('file_v2/assets/js/pcoded.min.js')!!}

    {!!Html::script('file_v2/assets/js/vartical-layout.min.js')!!}
    {!!Html::script('file_v2/assets/pages/dashboard/custom-dashboard.js')!!}
    {!!Html::script('file_v2/assets/js/script.min.js')!!}

    {!!Html::script('file_v2/assets/js/rocket-loader.min.js')!!}

  </body>
</html>