@extends('admin.master')

@section('title', 'Comics')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/comics') }}"><i class="fas fa-book-dead"></i> Comics</a>
    </li>
@endsection


@section('content')
    <div class="container-fluid">
        <div class="panel shadow">
            <div class="header">
                <h2 class="title"><i class="fas fa-book-dead"></i> Comics</h2>
                <ul>
                    @if (kvfj(Auth::user()->permissions, 'comic_add'))
                        <li>
                            <a href="{{ url('admin/comics/add') }}">
                                <i class="fas fa-plus"></i>
                                Agragar Producto
                            </a>
                        </li>
                    @endif

                    <li>
                        <a href="#">Filtrar <i class="fas fa-chevron-down"></i></a>
                        <ul class="shadow">
                            <li> <a href="{{ url('/admin/comics/1') }}"><i class="fas fa-upload"></i> Públicos</a></li>
                            <li> <a href="{{ url('/admin/comics/0') }}"><i class="fas fa-eraser"></i> Borrador</a></li>
                            <li> <a href="{{ url('/admin/comics/trash') }}"><i
                                        class="fas fa-trash-restore"></i>Papelera</a></li>
                            <li> <a href="{{ url('/admin/comics/all') }}"><i class="fas fa-boxes"></i> Todos</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" id="btn_search">
                            <i class="fas fa-search"></i>Buscar
                        </a>
                        <ul>
                            <li>
                                {!! Form::open(['url' => '/admin/comics/search']) !!}
                                {!! Form::text('search', null, ['class' => 'form-control', 'placeholder' => 'Ingresa su busqueda']) !!}
                                {!! Form::close() !!}
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
      
        <div class="inside">

            {{-- @if (kvfj(Auth::user()->permissions, 'comic_add'))
                <div class="btns">
                    <a href="{{url('/admin/comics/add')}}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Agregar Comics
                    </a>
                </div>
                @endif --}}

            <table class="table table-striped ">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td></td>
                        <td>NOMBRE</td>
                        <td>CATEGORIA</td>
                        <td>CODIGO</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($comics as $c)
                        <tr>
                            <td width="50">{{ $c->id }}</td>
                            <td width="64">
                                <a href="{{ url('/uploads/' . $c->file_path . '/' . $c->image) }}"
                                    data-fancybox="gallery">
                                    <img src="{{ url('/uploads/' . $c->file_path . '/t_' . $c->image) }}" width="64">
                                </a>
                            </td>
                            <td>{{ $c->name }} @if ($c->status == '0')<i
                                        class="fas fa-eraser" data-toggle="tooltip" data-placement="top"
                                        title="Estado:Borrado"></i> @endif
                            </td>
                            <td>{{ $c->cat->name }}</td>
                            <td>{{ $c->codigo }}</td>
                            <td>
                                <div class="opts">
                                    @if (kvfj(Auth::user()->permissions, 'comic_edit'))
                                        <a href="{{ url('/admin/comics/' . $c->id . '/edit') }} " data-toggle="tooltip"
                                            data-placement="left" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    @endif

                                    @if (kvfj(Auth::user()->permissions, 'comic_delete'))
                                        <a href="{{ url('/admin/comics/' . $c->id . '/delete') }}" data-toggle="tooltip"
                                            data-placement="right" title="Eliminar">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    </div>
@endsection
