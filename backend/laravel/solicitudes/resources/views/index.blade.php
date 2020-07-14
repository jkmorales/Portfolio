@extends('layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1>
                        Listado de usuarios

                        <a href="{{ route('users.create') }}" class="btn btn-sm btn-primary pull-right">Nuevo</a>

                    </h1>
                    <form method="POST" action="{{ route('logout') }}">
                        {{ csrf_field() }}
                        <button class="btn btn-sm btn-danger ">Cerrar Sesión</button>
                    </form>

                </div>
            </div>

            <div class="panel-body">
                @include ('users.fragment.info')
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th width="20px">#</th>
                        <th> Usuario </th>
                        <th> E-mail </th>
                        <th> Perfil </th>
                        <th> Status </th>
                        <th> Borrar </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $key => $user)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>
                                <strong>
                                    <a href="{{route('users.edit', $user->id)}}" class="btn btn-link" title="Editar">
                                        {{$user->name}} {{$user->paterno}} {{$user->materno}}
                                    </a>
                                </strong>
                            </td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->perfil}}</td>
                            <td>{{$user->recordStatus}}</td>
                            <td>
                                <form action="{{route('users.destroy', $user->id)}}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button class="btn btn-link"> <i class="fas fa-trash-alt" title="Eliminar"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {!! $users->render() !!}
            </div>
        </div>
    </div>
</div>
@endsection
