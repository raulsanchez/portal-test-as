@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            Datos
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>Identificador</th>
                            <td>{{ $users_type->slug }}</td>
                        </tr>
                        <tr>
                            <th>Nombre</th>
                            <td>{{ $users_type->name }}</td>
                        </tr>
                        <tr>
                            <th>Descripción</th>
                            <td>{{ $users_type->description }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('users_types.index') }}" class="btn btn-default">Volver al Listado</a>
        </div>
    </div>
@stop