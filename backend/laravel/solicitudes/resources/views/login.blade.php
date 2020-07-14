@extends('layout_login')

@section('content')
    <div class="row">
        <div class="col-md-4 col-md-offset-4" style="opacity: .75;">
            <div class="panel panel-default">

                <div class="panel-body">
                    <form method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <div class="form-group" {{$errors->has('email') ? 'has-error' : ''}}>
                            <input class="form-control"
                                   type="email"
                                   name="email"
                                   value="{{ old('email') }}"
                                   placeholder="Ingresa tu email">
                            {!! $errors->first('email','<span class="help-block">:message</span>') !!}
                        </div>
                        <div class="form-group" {{$errors->has('password') ? 'has-error' : ''}}>
                            <input class="form-control"
                                   type="password"
                                   name="password"
                                   placeholder="Ingresa tu contraseña">
                            {!! $errors->first('password','<span class="help-block">:message</span>') !!}
                        </div>
                        <input type="hidden" id="peticion" name="peticion" value="pc">
                        <button class="btn btn-primary btn-block">Acceder</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <div class="row" style="position:absolute;
                            left:100px;
                            right:100px;
                            bottom:5px;
                            height:40px;
                            z-index:0;">
        <footer class="page-footer font-small blue">
            <div class="footer-copyright text-center text-danger">
                <code>© 2020 jcMorales - v. Berlín</code>
            </div>
        </footer>
    </div>
@endsection