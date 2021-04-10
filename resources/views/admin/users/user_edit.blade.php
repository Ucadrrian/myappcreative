@extends('admin.master')
@section('title','Editar Usuario')

@section('breadcrumb')
    <li class="breadcrumb-item">
    <a href="{{ url('/admin/users') }}"><i class="fas fa-users"></i>    Usuarios</a>
    </li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title"><i class="fas fa-user"></i> Información</h2>
                </div>
            
                <div class="inside">
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title"><i class="fas fa-user"></i> Información</h2>
                </div>
            
                <div class="inside">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
