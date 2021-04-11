@extends('admin.master')
@section('title','Editar Usuario')

@section('breadcrumb')
    <li class="breadcrumb-item">
    <a href="{{ url('/admin/users/all') }}"><i class="fas fa-users"></i>    Usuarios</a>
    </li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="page_user">
        <div class="row">
            <div class="col-md-4">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-user"></i> Información</h2>
                    </div>
                
                    <div class="inside">
                        <div class="mini_profile">
                            @if(is_null($u->avatar))
                              <img src="{{ url('/static/images/avatar.png') }}" class="avatar">
                              @else
                              <img src="{{url('/uploads/user/'.$u->id.'/'.$user->avatar)  }}  class="avatar"">
                              @endif
                              <div class="info">
                                <span class="title"><i class="fas fa-address-card"></i> Nombre:</span>
                                <samp class="text">{{ $u->name }} {{ $u->lastname  }}</samp>
                                <span class="title"> <i class="fas fa-envelope"></i> Correo electrónico:</span>
                                <samp class="text">{{ $u->email }} </samp>
                                <span class="title"> <i class="far fa-calendar-alt"></i> Fecha de registro:</span>
                                <samp class="text">{{ $u->created_at }} </samp>
                                <span class="title"> <i class="fas fa-user-tie"></i> Role de usuario:</span>
                                <samp class="text">{{ getRoleUserArray(null,$u->role) }} </samp>
                                <span class="title"> <i class="fas fa-user-shield"></i> Estado del Usario:</span>
                                <samp class="text">{{ getUserStatusArray(null,$u->status) }} </samp>
                            </div>
                            @if($u->status =="100")
                            <a href="{{ url('/admin/user/'.$u->id.'/banned') }}" class="btn btn-success">Activar Usuario</a>
                            @else
                            <a href="{{ url('/admin/user/'.$u->id.'/banned') }}" class="btn btn-danger">Suspender Usuario</a>
                            @endif
                          </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-user-edit"></i></i> Editar Informacion</h2>
                    </div>
                
                    <div class="inside">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
