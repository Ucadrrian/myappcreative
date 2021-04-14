@extends('admin.master')
@section('title', ' Comics')


@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/comics') }}"><i class="fas fa-book-dead"></i> Comics</a>
    </li>
@endsection


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-9">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-edit"></i> Editar Comics</h2>
                    </div>

                    <div class="inside">
                        {{ Form::open(['url' => '/admin/comics/' . $c->id . '/edit', 'files' => true]) }}
                        <div class="row">
                            <div class="col-md-6">
                                <label for="name">Nombre del Comics:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fas fa-keyboard"></i>
                                        </span>
                                    </div>
                                    {!! Form::text('name', $c->name, ['class' => 'form-control']) !!}
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
                                    {!! Form::select('category', $cats, $c->category_id, ['class' => 'custom-select']) !!}
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
                                    {!! Form::text('codigo', $c->codigo, ['class' => 'form-control']) !!}
                                </div>
                            </div>


                            <div class="col-md-3">
                                <label for="codigo">Estado</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="far fa-keyboard"></i>
                                        </span>
                                    </div>
                                    {{ Form::select('status',['1'=>'Publico','0'=>'Borrado'],$c->status,['class'
                                    =>'custom-select']) }}
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
                                {!! Form::textarea('content', $c->content, ['class' => 'form-control', 'id' => 'editor']) !!}
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

            <div class="col-md-3">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-image"></i> Imagen Destacada</h2>
                        <div class="insi">
                            <img src="{{ url('/uploads/' . $c->file_path . '/' . $c->image) }}" class="img-fluid">
                        </div>
                    </div>
                </div>

                <div class="panel shodow mtop16">
                    <div class="header">
                        <h2 class="title"> <i class="fas fa-images"></i> Galeria</h2>
                        <div class="inside comics_gallery">
                            @if(kvfj(Auth::user()->permissions,'comic_gallery_add'))
                            {!! Form::open(['url'=>'/admin/comics/'.$c->id.'/gallery/add','files'=> true ,'id'=>'form_comics_image']) !!}
                            {!! Form::file('file_image',['id'=>'comics_file_image','accept'=>'image/*','style' => 'display: none;','required']) !!}
                            {!! Form::close() !!}

                            <div class="btn-submit">
                                <a href="#"id="btn_comics_file_image"><i class="fas fa-plus"></i></a>
                            </div>
                            @endif

                            <div class="tumbs">
                                @foreach ($c->getGallery as $img)
                                <div class="tumb">
                                    @if(kvfj(Auth::user()->permissions,'comic_gallery_delete'))
                                    <a href="{{ url('/admin/comics/'.$c->id.'/gallery/'.$img->id.'/delete') }}"
                                       data-toggle="tooltip" data-placement="right" title="Eliminar">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                    @endif

                                    <img src="{{ url('/uploads/'.$img->file_path.'/t_'.$img->file_name) }}" >
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
