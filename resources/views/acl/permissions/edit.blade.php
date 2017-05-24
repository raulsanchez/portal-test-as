@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                Create Role
            </div>
            <div class="panel-body">
                <form action="{{ route('permissions.update', $permission) }}" method="post" class="form-horizontal">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Identificador:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" value="{{ $permission->name }}" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="display_name" class="col-sm-2 control-label">Nombre:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="display_name" value="{{ $permission->display_name}}" >
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
                        <label for="description" class="col-sm-2 control-label">Descripción:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="description" value="{{old('description', $permission->description)}}">
                            @if ($errors->has('description'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="submit" class="btn btn-primary">Editar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop