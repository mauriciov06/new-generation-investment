<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>New Generation Investment Admin</title>
    
    {!!Html::style('css/admin.css')!!}
    {!!Html::style('css/dashboard.css')!!}
    {!!Html::style('css/bootstrap.min.css')!!}
    {!!Html::style('css/metisMenu.min.css')!!}
    {!!Html::style('css/sb-admin-2.css')!!}
    {!!Html::style('css/font-awesome.min.css')!!}
    
</head>

<body>
    
  <nav class="navbar navbar-default navbar-fixed-top navbar-sty-top">
    <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Menú</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{!!URL::to('/')!!}">
          <img class="logo-admin" src="/imagenes/new-generation-logo.png" alt="">
        </a>
      </div>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right menu-aguest-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="padding-top: 9px;padding-bottom: 9px;background: transparent;">
            <img src="/avatares/{!! (Auth::user()->avatar_users != null )?Auth::user()->avatar_users: 'default-avatar.png' !!}" width="50" height="50" class="img-circle">  
            {!!Auth::user()->name!!} <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <div class="media">
              <div class="media-left">
                <img src="/avatares/{{ (Auth::user()->avatar_users != null ) ? Auth::user()->avatar_users: 'default-avatar.png' }}" width="60" height="60" class="media-object" style="border-radius: 10px;">
              </div>
              <div class="media-body">
                <p>Bienvenido, <strong>{!!Auth::user()->name!!}</strong></p>
                <a href="{!!URL::to('/cuenta/'.Auth::user()->id_user.'/edit')!!}" class="mi-cuenta">Mi cuenta</a>
              </div>
            </div>
            <li><a href="{!!URL::to('/logout')!!}">Cerrar Sesion</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </nav>

  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-3 col-md-2 sidebar">
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
          <div class="navbar-default sidebar" role="navigation" id="nav-bar">
            <div class="sidebar-nav navbar-collapse">
              <ul class="nav" id="side-menu">
                @if(Auth::user()->id_tipo_cuenta == 1)
                  <li class="active">
                    <a href="#"><i class="fas fa-user"></i></i> <h6>Usuarios</h6><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                      <li>
                        <a href="{!!URL::to('/usuarios/create')!!}"><h6>Agregar Usuario</h6></a>
                      </li>
                      <li>
                        <a href="{!!URL::to('/usuarios')!!}"><h6>Listar Usuarios</h6> 
                          <div class="badge">
                            {!! \App\Http\Controllers\UsuarioController::countUsuarios() !!}
                          </div>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="active">
                    <a href="#"><i class="fas fa-wallet"></i> <h6>Estados de Inversiones</h6><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                      <li>
                        <a href="{!!URL::to('/confirmaciones-de-pago')!!}"><h6>Confirmaciones</h6> 
                          <div class="badge">
                            {!! \App\Http\Controllers\CuentaController::countConfirmacionesPago() !!}
                          </div>
                        </a>
                      </li>
                    </ul>
                  </li>
                @endif
                <li class="active">
                  <a href="#"><i class="fas fa-users"></i> <h6>Referidos</h6><span class="fa arrow"></span></a>
                  <ul class="nav nav-second-level">
                    @if(Auth::user()->id_tipo_cuenta == 1)
                      <li>
                        <a href="{!!URL::to('/referidos/create')!!}"><h6>Agregar Referido</h6></a>
                      </li>
                    @endif
                    <li>
                      <a href="{!!URL::to('/referidos')!!}"><h6>Listar Referidos</h6> 
                        <div class="badge">
                          {!! \App\Http\Controllers\ReferidoController::countReferidos() !!}
                        </div>
                      </a>
                    </li>
                  </ul>
                </li>
                @if(Auth::user()->id_tipo_cuenta == 2)
                  <li class="active">
                    <a href="#"><i class="fas fa-cog"></i> <h6>Mi Cuenta</h6><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                      <li>
                        <a href="{!!URL::to('/detalles-cuenta/'.Auth::user()->id_user)!!}"><h6>Detalles de la cuenta</h6></a>
                      </li>
                      <li>
                        <a href="{!!URL::to('/activar-contratos')!!}"><h6>Activar contratos</h6></a>
                      </li>
                      <li>
                        <a href="{!!URL::to('/mis-contratos/'.Auth::user()->id_user)!!}"><h6>Mis Contratos</h6></a>
                      </li>
                    </ul>
                  </li>
                  <li class="active">
                    <a href="#"><i class="fas fa-chart-line"></i> <h6>Finanzas</h6><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                      <li>
                        <a href="{!!URL::to('/balance')!!}"><h6>Balance</h6></a>
                      </li>
                    </ul>
                  </li>
                @endif
                <li class="active">
                  <a href="#"><i class="fas fa-chart-line"></i> <h6>Retiros</h6><span class="fa arrow"></span></a>
                  <ul class="nav nav-second-level">
                    <?php 
                      $viernes = date('w',strtotime(date("Y-m-d"))) ;
                    ?>
                    @if($viernes == 5)
                      @if(Auth::user()->id_tipo_cuenta == 2)
                        <li>
                          <a href="#" data-toggle="modal" class="active-modal-soliret" data-target="#modalsoli-retiro"><h6>Solicitar retiro</h6></a>
                        </li>
                      @endif
                    @endif
                    <li>
                      <a href="{!!URL::to('/retiros')!!}">
                        <h6>Listado de retiros</h6>
                        <div class="badge">
                            {!! \App\Http\Controllers\RetirosController::countRetiros() !!}
                          </div>
                      </a>
                    </li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
        </nav>
      </div>

      <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main content-right-main">
        @include('alerts.sucess')
        @include('alerts.request')
        <div class="content-main">
          @yield('content')
        </div>
      </div>
      
      <!-- Modal de eliminacion de usuario -->
      @include('modal-eliminacion.modal-eliminar')
  
      <!-- Modal de solicitud de retiro -->
      @include('modals.create-soli-retiro')

      @if(isset($direccionBilletera))
        @include('modals.direbilletera')
      @endif

      <!-- Modal upgrade -->
      @include('modals.upgrade-contrato')

    </div>
  </div>
  
  <a href="https://api.whatsapp.com/send?phone=+573156260770" class="fixed-right-main">
    <i class="fab fa-whatsapp"></i>
  </a>
  

  {!!Html::script('js/jquery.min.js')!!}
  {!!Html::script('js/bootstrap.min.js')!!}
  {!!Html::script('js/metisMenu.min.js')!!}
  {!!Html::script('js/sb-admin-2.js')!!}
  {!!Html::script('js/script.js')!!}


  @section('scripts')
  @show

</body>

</html>
