@extends('board_layout')



@section('sidebar_menu')
@parent
<!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
<div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav">
        <li>
            <a href="{{url('/home')}}"><i class="fa fa-fw fa-desktop fa-lg" aria-hidden="true"></i> ESCRITORIO</a>
        </li>
        <li>
            <a href="{{url('/instituciones')}}"><i class="fa fa-fw fa-university fa-lg" aria-hidden="true"></i> INSTITUCIONES</a>
        </li>
        <li>
            <a href="{{url('/grupos')}}"><i class="fa fa-fw fa-users fa-lg" aria-hidden="true"></i> GRUPOS</a>
        </li>

        <li>
            <a href="{{url('/usuarios')}}"><i class="fa fa-male fa-lg" aria-hidden="true"></i><i class="fa fa-female fa-lg" aria-hidden="true"></i> USUARIOS </a>
        </li>

        <li>
            <a href="{{url('/test')}}"><i class="fa fa-fw fa-file-text-o fa-lg" aria-hidden="true"></i> TEST </a>
        </li>

        <!--<li>
            <a href="javascript:;" data-toggle="collapse" data-target="#tab_usuarios"><i
                        class="fa fa-male fa-lg" aria-hidden="true"></i><i class="fa fa-female fa-lg"
                                                                           aria-hidden="true"></i> USUARIOS <i
                        class="fa fa-fw fa-caret-down " aria-hidden="true"></i></a>
            <ul id="tab_usuarios" class="collapse">
                <li>
                    <a href="">Gestión de usuarios</a>
                </li>
                <li>
                    <a href="#">Gestión de Psicólogos</a>
                </li>
                <li>
                    <a href="#">Gestión de Estudiantes</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" data-toggle="collapse" data-target="#tab_test"><i
                        class="fa fa-fw fa-file-text-o fa-lg" aria-hidden="true"></i> TEST <i
                        class="fa fa-fw fa-caret-down" aria-hidden="true"></i></a>
            <ul id="tab_test" class="collapse">
                <li>
                    <a href="#">BD Preguntas</a>
                </li>
                <li>
                    <a href="#">BD Test</a>
                </li>
            </ul>
        </li>-->
        <li>
            <a href="#"><i class="fa fa-fw fa-bar-chart fa-lg" aria-hidden="true"></i> INFORMES</a>
        </li>
        <li>
            <a href="{{url('/solicitudes')}}"><i class="fa fa-fw fa-check-square-o fa-lg" aria-hidden="true"></i> SOLICITUDES</a>
        </li>

    </ul>
</div>
<!-- /.navbar-collapse -->
@stop
