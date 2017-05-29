@extends('layouts.auth')

@section('content')
<div class="login-box">
    <div class="login-logo">
        <a href="http://laaraucanasalud.cl"><b>Araucana</b>Salud</a>
    </div>
    <div class="login-box-body">
        <p class="login-box-msg">Ingresa los datos para Iniciar Sesión</p>
        <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}
            <div class="row">
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="col-md-12 text-left">Correo Electrónico</label>
                    <div class="col-md-12">
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                    </div>
                    <div class="col-md-12">
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="col-md-12">Contraseña</label>

                    <div class="col-md-12">
                        <input id="password" type="password" class="form-control" name="password" required>
                    </div>
                    <div class="col-md-12">
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox"> Recordarme
                        </label>
                    </div>
                </div>

                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                </div>
            </div>
        </form>
        <a href="{{route('password.request')}}">Olvidé mi contraseña</a><br>
    </div>
</div>
@endsection
