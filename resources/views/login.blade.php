@extends('layout.layout')

@section('titulo')
    <title>Login :) | Tiendita</title>
@endsection

@section('formulario')
    <p class="login-box-msg">Inicia sesion para poder comprar por favor</p>
    @if (isset($estatus))
        @if ($estatus == 'success')
            <div class="alert alert-warning">
                {{ $mensaje }}
            </div>
        @else
            <div class="alert alert-danger">
                {{ $mensaje }}
            </div>
        @endif
    @endif
    <form action="{{ route('verificaciondelUsuario') }}" method="post">
        @csrf
        <div class="input-group mb-3">
            <input type="email" class="form-control" name="correo" placeholder="Correo">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
        </div>
        <div class="input-group mb-3">
            <input type="password" class="form-control" name="password" placeholder="Contraseña">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
        </div>
        @if(isset($_GET["r"]))
            <input type="hidden" name="url" value="{{$_GET["oops"]}}">
        @endif
        <div class="row">
            <div class="col-6" >
                <button type="submit" class="btn btn-outline-success">Entrar por favor</button>
            </div>
            <!-- /.col -->
        </div>
    </form>
    <p class="mb-0">
        <a href="{{ route('registro') }}" class="text-center">Registrate ;)</a>
    </p>
    <p class="mb-0">
        <a href="{{ route('home') }}" class="text-center">Home</a>
    </p>
@endsection
