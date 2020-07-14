@extends('layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
            <h2>
                Nuevo Usuario
                <a href="{{ route('users.index') }}" class="btn btn-primary pull-right btn-sm">Todos los Usuarios</a>
            </h2>

            @include('users.fragment.error')

            {!! Form::open(['route' => 'users.store', 'files' => true]) !!}

                @include('users.fragment.form')

            {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection