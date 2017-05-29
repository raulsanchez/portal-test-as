@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                Crear Permiso
            </div>
            <div class="panel-body">
                <form action="{{ route('permissions.store') }}" method="post" class="form-horizontal">
                    {{ csrf_field() }}
                    <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                        {!! Form::label('name', 'Identificador :', ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                        {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => 'grupo.modulo.accion', 'required' => 'true']) !!}
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('display_name') ? 'has-error' : ''}}">
                        {!! Form::label('display_name', 'Nombre :', ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('display_name', old('display_name'), ['class' => 'form-control', 'placeholder' => 'Modulo Accion', 'required' => 'true']) !!}
                            @if ($errors->has('display_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('display_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
                        {!! Form::label('description', 'Descripción :', ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('description', old('description'), ['class' => 'form-control', 'placeholder' => 'Descripción del permiso', 'required' => 'true']) !!}
                            @if ($errors->has('description'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="submit" class="btn btn-success">Crear</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop
