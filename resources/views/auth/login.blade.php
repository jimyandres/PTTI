@extends('layout_login')

@section('content')
    <div class="container-fluid login" id="body_footer">
        <div class="row">
            <div class="col-md-offset-4 col-md-4">
                <div class="form-login">
                    <h1 class="login">Inicia sesión</h1>
                        @include('partials/errors')

                        <form class="form-horizontal" role="form" method="POST" action="{{url('auth/login')}}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Correo Electrónico</h4>
                                </div>
                                <div class="col-md-6">
                                    <input name="email" type="email" value="{{old('email')}}" class="form-control input-sm chat-input" placeholder="Ingrese su e-mail" />
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Contraseña</h4>
                                </div>
                                <div class="col-md-6">
                                    <input name="password" type="password" class="form-control input-sm chat-input" placeholder="Ingrese su contraseña" />
                                </div>
                            </div>

                            <div class="form-group text-right">
                                <div class="col-md-offset-4 col-md-6">
                                    <a href="{{url('password/email')}}" >¿Olvidaste tu contraseña?</a>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember"> Recordar mi cuenta
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="wrapper">
                                <button type="submit" class="btn btn-primary" style="margin-right: 15px;">
                                    Inicia sesión
                                </button>
                            </div>
                        </form>
                </div>
            </div>
        </div>
        <p><div class="row"></div> </p>
    </div>
@endsection