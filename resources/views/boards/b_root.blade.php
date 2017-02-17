@extends('board_layout')

@section('style')
@parent
<style type="text/css">
    body { background: #3c763d !important;  } /* Adding !important forces the browser to overwrite the default style applied by Bootstrap */
    .top-nav { background: #3c763d !important;  }
    .navbar { background: #3c763d !important;  }
    .side-nav { background: #3c763d !important;  }
</style>
@stop



@section('sidebar_menu')
@parent
<!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
<div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav">
        <li>
            <a href="{{url('/home')}}"><i class="fa fa-fw fa-desktop fa-lg" aria-hidden="true"></i> ESCRITORIO</a>
        </li>
        <li>
            <a href="{{url('/usuarios')}}"><i class="fa fa-male fa-lg" aria-hidden="true"></i><i class="fa fa-female fa-lg"
                                                                              aria-hidden="true"></i> USUARIOS</a>
        </li>
        <li>
            <a href="{{url('/solicitudes')}}"><i class="fa fa-fw fa-check-square-o fa-lg" aria-hidden="true"></i> SOLICITUDES</a>
        </li>

    </ul>
</div>
<!-- /.navbar-collapse -->
@stop
