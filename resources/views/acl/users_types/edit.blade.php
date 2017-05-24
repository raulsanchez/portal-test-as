@extends('layouts.app')

@section('content')

    {!! Form::model($users_type, ['method' => 'PUT', 'route' => ['users_types.update', $users_type->id], 'class' => 'form-horizontal']) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            Listado de Tipos de Usuarios
        </div>

        <div class="panel-body">
            <div class="form-group">
                {!! Form::label('name', 'Nombre :', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-10">
                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    @if($errors->has('name'))
                        <p class="help-block">
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('description', 'Descripcion :', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-10">
                    {!! Form::text('description', old('description'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    @if($errors->has('description'))
                        <p class="help-block">
                            {{ $errors->first('description') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    {!! Form::submit('Editar Tipo de Usuario', ['class' => 'btn btn-success']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop