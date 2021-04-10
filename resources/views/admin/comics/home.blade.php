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
            </div>
        
            <div class="inside">
                <div class="btns">
                    <a href="{{url('/admin/comics/add')}}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Agregar Comics
                    </a>
                </div>

                <table class="table table-striped mtop16">
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
                        @foreach($comics as $c)
                        <tr>
                            <td width="50">{{ $c->id }}</td>
                            <td width="64">
                                <a href="{{ url('/uploads/'.$c->file_path.'/'.$c->image) }}" data-fancybox="gallery">
                                    <img src="{{ url('/uploads/'.$c->file_path.'/t_'.$c->image) }}" width="64">
                                </a>
                            </td>
                            <td>{{ $c->name }}</td>
                            <td>{{ $c->cat->name }}</td>
                            <td>{{ $c->codigo }}</td>
                            <td>
                                <div class="opts">
                                    <a href="{{ url('/admin/comics/'.$c->id.'/edit') }} "
                                        data-toggle="tooltip" data-placement="left" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    
                                    <a  href="{{ url('/admin/comics/'.$c->id.'/delete') }}"
                                        data-toggle="tooltip" data-placement="right" title="Eliminar">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
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
