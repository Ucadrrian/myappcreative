@extends('connect.master')

@section('title', 'Registrarse')

@section('content')
    <div class="box box_register shadow">
        <div class="header">
            <a href="{{ url('/') }}">
                <img src="{{ url('/static/images/regiter.png') }}" alt="">
            </a>
        </div>
        <div class="inside">
            {!! Form::open(['url' => '/register']) !!}
            <label for="name" class="form-label">Nombre:</label>
            <div class="input-group">
                <div class="input-group-text"><i class="fas fa-user"></i></div>
                {!! Form::text('name', null, ['class' => 'form-control','required']) !!}
            </div>

            <label for="lastname" class="form-label mtop16">Apellidos:</label>
            <div class="input-group">
                <div class="input-group-text"><i class="fas fa-user-tag"></i></div>
                {!! Form::text('lastname', null, ['class' => 'form-control','required']) !!}
            </div>

            <label for="email" class="form-label mtop16">Correo Electrónico:</label>
            <div class="input-group">
                <div class="input-group-text"><i class="fas fa-envelope"></i></div>
                {!! Form::email('email', null, ['class' => 'form-control','required']) !!}
            </div>

            <label for="password" class="form-label mtop16">Password:</label>
            <div class="input-group">
                <div class="input-group-text"><i class="fas fa-lock"></i></div>
                {!! Form::password('password', ['class' => 'form-control','required','pattern'=>'[A-Za-z0-9-]{1,15}']) !!}
            </div>

            <label for="cpassword" class="form-label mtop16">Confirmar Password:</label>
            <div class="input-group">
                <div class="input-group-text"><i class="fas fa-lock"></i></div>
                {!! Form::password('cpassword', ['class' => 'form-control','required' ,'pattern'=>'[A-Za-z0-9-]{1,15}' ]) !!}
            </div>

            {!! Form::submit('Registrarse', ['class' => 'btn btn-success mtop16']) !!}
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
                    ya tengo una cuenta? <a href="{{ url('/login') }}" class="ml-2">Ingresar</a>
                </div>

            </div>
            {{-- <div class="footer mtop16">
                <a href="{{url('/register')}}">¿No tienes una cuentas?, Registrarse</a>
                <a href="{{url('/register')}}">Recuperar Contraseña</a>
            </div> --}}
        </div>
    </div>
@stop
