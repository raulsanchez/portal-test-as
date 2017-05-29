@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Crear Rol
            </div>
            <div class="panel-body">
                <form action="{{ route('roles.store') }}" method="post" class="form-horizontal">
                    {{ csrf_field() }}
                    <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="col-sm-2 control-label">Name:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name">
                            {!! $errors->first('name', '<span class="help-block">:message</span>')!!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('display_name') ? 'has-error' : ''}}">
                        <label for="display_name" class="col-sm-2 control-label">Display Name:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="display_name">
                            {!! $errors->first('display_name', '<span class="help-block">:message</span>')!!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
                        <label for="description" class="col-sm-2 control-label">Description:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="description">
                            {!! $errors->first('description', '<span class="help-block">:message</span>')!!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="submit" class="btn btn-success">Crear Rol</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop
