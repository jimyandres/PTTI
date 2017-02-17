<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Plataforma PTTI</title>

    <!--<link rel="stylesheet" href="{{asset('css/app.css')}}">-->
    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="https://blackrockdigital.github.io/startbootstrap-sb-admin/css/sb-admin.css"/>

    <!-- Morris Charts CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css"
          integrity="sha256-szHusaozbQctTn4FX+3l5E0A5zoxz7+ne4fr8NgWJlw=" crossorigin="anonymous"/>

    <!-- Custom Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css"
          integrity="sha256-AIodEDkC8V/bHBkfyxzolUMw57jeQ9CauwhVW6YJ9CA=" crossorigin="anonymous"/>
    <link href="http://pingendo.github.io/pingendo-bootstrap/themes/default/bootstrap.css"
          rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">

</head>
<body>
<div id="container_footer">
    <div class="section superior">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <a href="http://www.utp.edu.co" target="_blank"><img src="http://media.utp.edu.co/img/optimized/marca_UTP.png" class="displayed"></a>
                </div>
                <div class="col-md-4">
                    <h1 class="text-center">PTTI</h1>
                </div>
                <div class="col-md-4">
                    <a href="http://www.mineducacion.gov.co/1621/w3-channel.html" target="_blank"><img src="http://media.utp.edu.co/img/optimized/ministerioeducacion.png" class="displayed"></a>
                </div>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="{{url('/home')}}">Inicio</a></li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    @if (Auth::guest())
                        <li><a href="{{url('auth/login')}}">Iniciar sesión</a></li>
                        <li><a href="{{url('auth/register')}}">Registrarse</a></li>
                    @else
                        <li class="dropdown">
                            <a href="{{url('home')}}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> {{ Auth::user()->nombre}} {{Auth::user()->apellido}} <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{url('auth/logout')}}">Cerrar sesión</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <p> <div class="row"></div></p>

    @yield('content')

    <p> <div class="row"></div></p>

    <div class="modal fade" id="popupmodal_error"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                    <h4 class="modal-title custom_align" id="Heading">¡Advertencia!</h4>
                </div>
                <div class="modal-body">
                    <p>
                    <div class="alert alert-danger">
                        {{Session::get('modal_message_error')}}
                    </div>
                    </p>
                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <div class="modal fade" id="popupmodal_succes"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                    <h4 class="modal-title custom_align" id="Heading">¡Advertencia!</h4>
                </div>
                <div class="modal-body">
                    <p>
                    <div class="alert alert-success">
                        {{Session::get('modal_message_success')}}
                    </div>
                    </p>
                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="section superior" id="footer">
        <div class="container ">
            <div class="row text-center">
                <div class="col-md-11"></div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <a href="http://www.utp.edu.co" target="_blank" class="alignmiddle"><img src="http://media.utp.edu.co/img/optimized/marca_UTP.png" class="displayed"></a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
{!! Html::script('js/dropdown.js') !!}

@if(Session::has('modal_message_error'))
    <script type="text/javascript">
        $(document).ready(function () {
            $('#popupmodal_error').modal();
        });
    </script>
@elseif(Session::has('modal_message_success'))
    <script type="text/javascript">
        $(document).ready(function () {
            $('#popupmodal_succes').modal();
        });
    </script>
@endif

@yield('scripts')
</body>
</html>