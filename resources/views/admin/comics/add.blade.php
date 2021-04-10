@extends('admin.master')

@section('title', 'Agregar Comics')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/comics') }}"><i class="fas fa-book-dead"></i> Comics</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/comics/add') }}"><i class="fas fa-plus"></i> Agregar Comics</a>
    </li>
@endsection


@section('content')
    <div class="container-fluid">
        <div class="panel shadow">
            <div class="header">
                <h2 class="title"><i class="fas fa-plus"></i> Agregar Comics</h2>
            </div>

            <div class="inside">
                {!! Form::open(['url' => '/admin/comics/add','files'=> true,'class'=>'register-form']) !!}
                <div class="row">
                    <div class="col-md-6">
                        <label for="name">Nombre del Comics:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="fas fa-keyboard"></i>
                                </span>
                            </div>
                            {!! Form::text('name', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="category">Categoría</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="fas fa-keyboard"></i>
                                </span>
                            </div>
                            {!! Form::select('category', $cats,0,['class'=>'custom-select']) !!}
                    </div>
                    </div>


                    <div class="col-md-3">
                        <label for="name">Imagen Destacada:</label>
                        <div class="custom-file">
                            {!! Form::file('img', ['class' => 'custom-file-input', 'id' => 'customFile', 'accept' => 'image/*']) !!}
                            <label class="custom-file-label" for="customFile">Imagen</label>
                        </div>
                    </div>



                </div>
                <div class="row mtop16">
                    <div class="col-md-3">
                        <label for="codigo">Código</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="fas fa-keyboard"></i>
                                </span>
                            </div>
                            {!! Form::text('codigo', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>

                    {{-- <div class="col-md-3">
                            <label for="name">Archivo PDF:</label>
                            <div class="custom-file">
                            {!! Form::file('archivo',['class'=>'custom-file-input','id'=>'customFile','accept'=>'image/*']) !!}
                            <label class="custom-file-label" for="customFile">Imagen</label>
                            </div>
                        </div> --}}

                </div>


                <div class="row mtop16">
                    <div class="col-md-12">
                        <label for="content">Descripción</label>
                        {!! Form::textarea('content', null, ['class' => 'form-control', 'id' => 'editor']) !!}
                    </div>
                </div>

                <div class="row mtop16">
                    <div class="col-md-12">
                        {!! Form::submit('Guardar', ['class' => 'btn btn-success']) !!}
                    </div>

                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
