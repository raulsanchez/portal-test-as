@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div style="margin-bottom: 50px">
                <a href="{{ route('users_types.create') }}" class="pull-right btn btn-md btn-success">Crear Tipos de Usuarios</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Listado de Tipos de Usuarios
                </div>

                <div class="panel-body table-responsive">
                    <table class="table {{ count($users_types) > 0 ? 'datatable' : '' }}">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Identificador</th>
                                <th>Tipo</th>
                                <th>Descripción</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($users_types) > 0)
                                @foreach ($users_types as $users_type)
                                    <tr data-entry-id="{{ $users_type->id }}">
                                        <td>{{ $users_type->id }}</td>
                                        <td>{{ $users_type->slug }}</td>
                                        <td>{{ $users_type->name }}</td>
                                        <td>{{ $users_type->description }}</td>
                                        <td>
                                            @ability('administrador', 'administracion.tipo_usuario.editar')
                                            <a href="{{ route('users_types.edit',[$users_type->id]) }}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                            @endability
                                            @ability('administrador', 'administracion.tipo_usuario.borrar')
                                            <a href="{{route('users_types.destroy', $users_type->id)}}" data-method="delete" data-token="{{csrf_token()}}" data-confirm="¿Está seguro?" class="record_delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                            @endability
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7">@lang('quickadmin.qa_no_entries_in_table')</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('script')
<script>

    $( document ).ready( function(){
        $.ajaxSetup(
        {
            headers:
            {
                'X-CSRF-Token': '{{ csrf_token() }}'
            }
        });
        $(document).on('click', 'a.record_delete', function(e) {
            e.preventDefault();
            var $this = $(this);
            $.post({
                type: $this.data('method'),
                url: $this.attr('href')
            }).done(function (data)
            {
                console.log(data);
                $this.parent().parent().remove();
            });
        });
    });
</script>
@stop
