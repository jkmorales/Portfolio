<div class="form-inline">
    <div class="form-group form-inline col-md-4">
        {!! Form::label('name', 'Nombre(s)') !!}
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group form-inline col-md-4">
        {!! Form::label('paterno', 'Apellido Paterno') !!}
        {!! Form::text('paterno', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group form-inline col-md-4">
        {!! Form::label('materno', 'Apellido Materno') !!}
        {!! Form::text('materno', null, ['class' => 'form-control']) !!}
    </div>
</div>
<br>
<hr>
</br>

<div class="form-group">
    {!! Form::label('email', 'Email') !!}
    {!! Form::text('email', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('password', 'Contraseña') !!}
    {!! Form::text('pass_word',  null, ['class' => 'form-control']) !!}
</div>

</br>
<div class="form-inline">
    <div class="form-group form-inline col-md-6">
        {!! Form::label('fkPerfil', 'Perfil') !!}
        {!! Form::select('fkPerfil', [  1 => 'Ninja - Administrador',
                                        2 => 'Project Managment',
                                        3 => 'Team Leader',
                                        4 => 'Tesorero'
                                    ], null,['placeholder' => 'Elige un Perfil', 'class' => 'form-control'])
        !!}
    </div>
    <div class="form-group form-inline col-md-6">
        {!! Form::label('fkRecordStatus', 'Estatus') !!}
        {!! Form::select('pkRecordStatus',[ 1 => 'Activo',
                                            2 => 'Pausado',
                                            3 => 'Eliminado'] , null,
                        ['placeholder' => 'Elige un Estatus', 'class' => 'form-control'])
        !!}
    </div>
</div>

<br>
<br>
</br>
<div class="form-inline">
    <div class="form-group form-inline col-md-12">
        {!! Form::label('file', 'Fotografía') !!}
        {!! Form::file('picture_path') !!}
    </div>
</div>

<br><br><br><br><br>
<div class="form-group">
    {!! Form::submit('ENVIAR', ['class' => 'btn btn-primary']) !!}
</div>
