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
                        <label for="name" class="col-sm-2 control-label">Identificador:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" placeholder="grupo.modulo.accion">
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('display_name') ? 'has-error' : ''}}">
                        <label for="display_name" class="col-sm-2 control-label">Nombre:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="display_name" placeholder="Modulo Accion">
                            @if ($errors->has('display_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('display_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
                        <label for="description" class="col-sm-2 control-label">Descripción:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="description" placeholder="Descripción del permiso">
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
