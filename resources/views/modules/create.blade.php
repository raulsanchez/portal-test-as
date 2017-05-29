@extends('layouts.app')
@section('content')
    @php
        // dd($errors);
    @endphp
    <div class="row">
        <div class="col-md-12">
            <div style="margin-bottom: 50px">
                <a href="{{ route('modules.index') }}" class="pull-right btn btn-md btn-default">Ir al Listado</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Crear Enlace o Módulo
                </div>
                <div class="panel-body">
                    <form action="{{ route('modules.store') }}" method="post" class="form-horizontal">
                        {{ csrf_field() }}
                        <div class="form-group {{ $errors->has('parent_id') ? ' has-error' : '' }}">
                            {!! Form::label('parent_id', 'Superior :', ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-10">
                            {!! Form::select('parent_id',$modules, old('parent_id'), ['class' => 'form-control select2', 'placeholder' => '', 'required' => '']) !!}
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('parent_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('order') ? ' has-error' : '' }}">
                            {!! Form::label('order', 'Orden :', ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-10">
                            {!! Form::text('order', old('order'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('order') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                            {!! Form::label('name', 'Nombre :', ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-10">
                            {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '', 'required' => 'true']) !!}
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('link') ? ' has-error' : '' }}">
                            {!! Form::label('link', 'Enlace :', ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-10">
                            {!! Form::text('link', old('link'), ['class' => 'form-control', 'placeholder' => '', 'required' => 'true']) !!}
                                @if ($errors->has('link'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('link') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                            {!! Form::label('name', 'Roles acceder :', ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-10">
                            {!! Form::select('roles[]', $roles, old('role'), ['class' => 'form-control select2', 'multiple' => true, 'required' => 'true']) !!}
                                @if ($errors->has('roles'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('roles') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('icon') ? ' has-error' : '' }}">
                            {!! Form::label('icon', 'Icono :', ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-10">
                            {!! Form::text('icon', old('icon'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                                @if ($errors->has('icon'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('icon') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('visualize') ? ' has-error' : '' }}">
                            {!! Form::label('visualize', 'Visualizado :', ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-10">
                            {!! Form::select('visualize',['si'=>'Si','no'=>'No'], 'si', ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                                @if ($errors->has('visualize'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('visualize') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                              <button type="submit" class="btn btn-success">Crear Enlace o Módulo</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection