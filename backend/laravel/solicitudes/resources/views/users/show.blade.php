@extends('layout')

@section('content')
    <div class="col-sm-8">
        <h2>
            Nombre: {{$user->name}} {{$user->paterno}} {{$user->materno}}
            <hr>
            Email: {{$user->email}}
            <hr>
            Perfil: {{$user->perfil}}
            <hr>
            Estatus: {{$user->recordStatus}}
        </h2>
    </div>

@endsection