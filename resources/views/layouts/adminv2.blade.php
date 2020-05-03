<!DOCTYPE html>
<html lang="en">


<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>New Generation Investment - Admin</title>

  
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  {{--       <meta name="description" content="#">
  <meta name="keywords" content="Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
  <meta name="author" content="#"> --}}

  {{-- <link rel="icon" href="https://colorlib.com//polygon/adminty/files/assets/images/favicon.ico" type="image/x-icon"> --}}

  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">

  {!!Html::style('file_v2/bower_components/bootstrap/css/bootstrap.min.css')!!}
  {!!Html::style('file_v2/assets/icon/feather/css/feather.css')!!}
  {!!Html::style('file_v2/assets/icon/font-awesome/css/font-awesome.min.css')!!}
  {!!Html::style('file_v2/assets/css/style.css')!!}
  {!!Html::style('file_v2/assets/css/jquery.mCustomScrollbar.css')!!}
  {!!Html::style('css/website.css')!!}

</head>
<body>

  <div class="theme-loader">
    <div class="ball-scale">
      <div class='contain'>
        <div class="ring">
          <div class="frame"></div>
        </div>
        <div class="ring">
          <div class="frame"></div>
        </div>
        <div class="ring">
          <div class="frame"></div>
        </div>
        <div class="ring">
          <div class="frame"></div>
        </div>
        <div class="ring">
          <div class="frame"></div>
        </div>
        <div class="ring">
          <div class="frame"></div>
        </div>
        <div class="ring">
          <div class="frame"></div>
        </div>
        <div class="ring">
          <div class="frame"></div>
        </div>
        <div class="ring">
          <div class="frame"></div>
        </div>
        <div class="ring">
          <div class="frame"></div>
        </div>
      </div>
    </div>
  </div>

  <div id="pcoded" class="pcoded">
    <div class="pcoded-overlay-box"></div>
    <div class="pcoded-container navbar-wrapper">
      <nav class="navbar header-navbar pcoded-header">
        <div class="navbar-wrapper">
          <div class="navbar-logo">
            <a class="mobile-menu" id="mobile-collapse" href="#!">
              <i class="feather icon-menu"></i>
            </a>
            <a href="{!!URL::to('/admin')!!}">
              <img class="img-fluid" src="/imagenes/new-generation-logo-white.png" alt="Logo" width="40" />
            </a>
            <a class="mobile-options">
              <i class="feather icon-more-horizontal"></i>
            </a>
          </div>
          <div class="navbar-container container-fluid">
            <ul class="nav-right">
              <li class="user-profile header-notification">
                <div class="dropdown-primary dropdown">
                  <div class="dropdown-toggle" data-toggle="dropdown">
                    <img src="/avatares/{!! (Auth::user()->avatar_users != null )?Auth::user()->avatar_users: 'default-avatar.png' !!}" class="img-radius" alt="User-Profile-Image">
                    <span>{!!Auth::user()->name!!}</span>
                    <i class="feather icon-chevron-down"></i>
                  </div>
                  <ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                    <li>
                      <a href="{!!URL::to('/cuenta/'.Auth::user()->id_user.'/edit')!!}">
                        <i class="feather icon-user"></i> Perfil
                      </a>
                    </li>
                    <li>
                      <a href="{!!URL::to('/logout')!!}">
                        <i class="feather icon-log-out"></i> Cerrar sesión
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </nav>

      <div class="pcoded-main-container">
        <div class="pcoded-wrapper">
          <nav class="pcoded-navbar">
            <div class="pcoded-inner-navbar main-menu">
              <div class="pcoded-navigatio-lavel">Menú</div>
              <ul class="pcoded-item pcoded-left-item">
                @if(Auth::user()->id_tipo_cuenta == 2)
                  <li class="active pcoded-trigger">
                    <a href="{!!URL::to('/admin')!!}">
                      <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                      <span class="pcoded-mtext">Dashboard</span>
                    </a>
                  </li>
                  <li>
                    <a href="{!!URL::to('/balance')!!}">
                      <span class="pcoded-micon"><i class="fa fa-usd"></i></span>
                      <span class="pcoded-mtext">Balance</span>
                    </a>
                  </li>
                  <li>
                    <a href="{!!URL::to('/activar-contratos')!!}">
                      <span class="pcoded-micon"><i class="feather icon-clipboard"></i></span>
                      <span class="pcoded-mtext">Contratos</span>
                    </a>
                  </li>
                @endif
                @if(Auth::user()->id_tipo_cuenta == 1)
                  <li class="pcoded-hasmenu">
                    <a href="javascript:void(0)">
                      <span class="pcoded-micon"><i class="feather icon-user"></i></span>
                      <span class="pcoded-mtext">Usuarios</span>
                    </a>
                    <ul class="pcoded-submenu">
                      <li class=" ">
                        <a href="{!!URL::to('/usuarios/create')!!}">
                          <span class="pcoded-mtext">Agregar usuario</span>
                        </a>
                      </li>
                      <li class=" ">
                        <a href="{!!URL::to('/usuarios')!!}">
                          <span class="pcoded-mtext">Listar usuarios</span>
                          <span class="pcoded-badge label label-warning">{!! \App\Http\Controllers\UsuarioController::countUsuarios() !!}</span>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="pcoded-hasmenu">
                    <a href="javascript:void(0)">
                      <span class="pcoded-micon"><i class="fa fa-university"></i></span>
                      <span class="pcoded-mtext">Inversiones</span>
                    </a>
                    <ul class="pcoded-submenu">
                      <li class=" ">
                        <a href="{!!URL::to('/confirmaciones-de-pago')!!}">
                          <span class="pcoded-mtext">Confirmaciones</span>
                          <span class="pcoded-badge label label-warning">{!! \App\Http\Controllers\CuentaController::countConfirmacionesPago() !!}</span>
                        </a>
                      </li>
                    </ul>
                  </li>
                @endif
                <li class="pcoded-hasmenu">
                  <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="feather icon-users"></i></span>
                    <span class="pcoded-mtext">Referidos</span>
                  </a>
                  <ul class="pcoded-submenu">
                    @if(Auth::user()->id_tipo_cuenta == 1)
                      <li class=" ">
                        <a href="{!!URL::to('/referidos/create')!!}">
                          <span class="pcoded-mtext">Agregar Referido</span>
                        </a>
                      </li>
                    @endif
                    <li class=" ">
                      <a href="{!!URL::to('/referidos')!!}">
                        <span class="pcoded-mtext">Listar Referidos</span>
                        <span class="pcoded-badge label label-warning">{!! \App\Http\Controllers\ReferidoController::countReferidos() !!}</span>
                      </a>
                    </li>
                  </ul>
                </li>
                <li class="pcoded-hasmenu">
                  <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="feather icon-layers"></i></span>
                    <span class="pcoded-mtext">Retiros</span>
                  </a>
                  <ul class="pcoded-submenu">
                    <?php 
                      $viernes = date('w',strtotime(date("Y-m-d"))) ;
                    ?>
                    @if($viernes == 5)
                      @if(Auth::user()->id_tipo_cuenta == 2)
                        <li class=" ">
                          <a href="#" data-toggle="modal" class="active-modal-soliret" data-target="#modalsoli-retiro">
                            <span class="pcoded-mtext">Solicitar Retiro</span>
                          </a>
                        </li>
                      @endif
                    @endif
                    <li class=" ">
                      <a href="{!!URL::to('/retiros')!!}">
                        <span class="pcoded-mtext">Listar Retiros</span>
                        <span class="pcoded-badge label label-warning">{!! \App\Http\Controllers\RetirosController::countRetiros() !!}</span>
                      </a>
                    </li>
                  </ul>
                </li>
              </ul>
              <div class="pcoded-navigatio-lavel">Firma de contracto</div>
              <ul class="pcoded-item pcoded-left-item">
                <li class="pcoded-hasmenu" dropdown-icon="style1" subitem-icon="style1">
                  <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="fa fa-cloud-download"></i></span>
                    <span class="pcoded-mtext">Firma</span>
                    <span class="pcoded-badge label label-danger">Nuevo</span>
                  </a>
                  <ul class="pcoded-submenu">
                    @if(Auth::user()->id_tipo_cuenta == 2)
                      <li class="">
                        <a href="{!!URL::to('/descargar-contrato/')!!}/{{Auth::user()->id_user}}">
                          <span class="pcoded-mtext">Descargar contrato</span>
                        </a>
                      </li>
                    @endif
                    @if(Auth::user()->id_tipo_cuenta == 1)
                      <li class=" ">
                        <a href="{!!URL::to('/listado-firmas-contrato')!!}">
                          <span class="pcoded-mtext">Listado de firmas</span>
                          <span class="pcoded-badge label label-warning">{!! \App\Http\Controllers\ContratoController::countFirmascont() !!}</span>
                        </a>
                      </li>
                    @endif
                  </ul>
                </li>
              </ul>
            </div>
          </nav>
          <div class="pcoded-content">
            <div class="pcoded-inner-content">
              <div class="main-body">
                <div class="page-wrapper">
                  <div class="page-body">
                    <div class="row">
                      <div class="col-xl-12">@include('alerts.sucess')</div>
                      <div class="col-xl-12">@include('alerts.request')</div>
                      @yield('content')
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <a href="https://api.whatsapp.com/send?phone=+573156260770" target="_blank" class="z-depth-top-0 fixed-right-main">
      <i class="fa fa-whatsapp"></i>
    </a>

    <!-- Modal de eliminacion de usuario -->
    @include('modal-eliminacion.modal-eliminar')

    <!-- Modal de solicitud de retiro -->
    @include('modals.create-soli-retiro')

    <!-- Modal de solicitud de retiro -->
    @include('modals.ver-balances')

    @if(isset($direccionBilletera))
      @include('modals.direbilletera')
    @endif

    <!-- Modal upgrade -->
    @include('modals.upgrade-contrato')


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
    <!--{!!Html::script('file_v2/assets/pages/dashboard/custom-dashboard.js')!!}-->
    {!!Html::script('file_v2/assets/js/script.min.js')!!}

    {!!Html::script('file_v2/assets/js/rocket-loader.min.js')!!}
    {!!Html::script('js/script.js')!!}

    @section('scripts')
    @show

  </body>

</html>
