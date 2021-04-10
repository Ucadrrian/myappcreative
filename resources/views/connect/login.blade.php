@extends('connect.master')

@section('title', 'Login')

@section('content')
    <div class="box box_login shadow">
        <div class="header">
            <a href="{{ url('/') }}">
                <img src="{{ url('/static/images/login.png') }}" alt="">
            </a>
        </div>
        <div class="inside">
            {!! Form::open(['url' => '/login']) !!}
            <label for="email" class="form-label">Correo Electrónico:</label>
            <div class="input-group">
                <div class="input-group-text"><i class="fas fa-envelope"></i></div>
                {!! Form::email('email', null, ['class' => 'form-control']) !!}
            </div>

            <label for="password" class="form-label mtop16">Password:</label>
            <div class="input-group">
                <div class="input-group-text"><i class="fas fa-lock"></i></div>
                {!! Form::password('password', ['class' => 'form-control']) !!}
            </div>
            {!! Form::submit('Ingresar', ['class' => 'btn btn-success mtop16']) !!}
            {!! Form::close() !!}
            @if (Session::has('message'))
                <div class="container">
                    <div class="mtop16 alert alert-{{ Session::get('typealert') }}" style="display: none">
                        {{ Session::get('message') }}
                        @if ($errors->any())
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <script>
                            $('.alert').slideDown();
                            setTimeout(function() {
                                $('.alert').slideUp();
                            }, 10000)

                        </script>
                    </div>
                </div>
            @endif

            <div class="footer mtop16">
                <div class="d-flex justify-content-center links">
                    No tengo una cuenta? <a href="{{ url('/register') }}" class="ml-2">Registrarme</a>
                </div>
                <div class="d-flex justify-content-center links">
                    <a href="{{ url('/recover') }}">Reperar contraseña?</a>
                </div>
            </div>
            {{-- <div class="footer mtop16">
                <a href="{{url('/register')}}">¿No tienes una cuentas?, Registrarse</a>
                <a href="{{url('/register')}}">Recuperar Contraseña</a>
            </div> --}}
        </div>
    </div>
@stop
