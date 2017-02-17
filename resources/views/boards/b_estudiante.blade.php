@extends('board_layout')

@section('style')
@parent
<style type="text/css">
    body { background: #2b669a !important;  }
    .top-nav { background: #2b669a !important;  }
    .side-nav { background: #2b669a !important;  }
    .navbar { background: #2b669a !important;  }
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
            <a href="{{url('/test')}}"><i class="fa fa-fw fa-file-text-o fa-lg" aria-hidden="true"></i> TEST</a>
        </li>

    </ul>
</div>
<!-- /.navbar-collapse -->
@stop
