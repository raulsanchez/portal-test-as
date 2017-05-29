@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div style="margin-bottom: 50px">
                <a href="{{ route('modules.create') }}" class="pull-right btn btn-md btn-success">Crear Enlace o Módulo</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Listado de Modulos
                </div>

                <div class="panel-body table-responsive">
                    <table class="table {{ count($modules) > 0 ? 'datatable' : '' }}">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Superior</th>
                                <th>Nombre</th>
                                <th>Enlace</th>
                                <th>Icono</th>
                                <th>Roles</th>
                                <th></th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($modules) > 0)
                                @foreach ($modules as $module)
                                    <tr data-entry-id="{{ $module->id }}">
                                        <td>{{$module->id}}</td>
                                        <td>{{ $module->parent['name'] }}</td>
                                        <td>{{ $module->name }}</td>
                                        <td><a href="{{ $module->link }}">{{ $module->link }}</a></td>
                                        <td><i class="fa {{ $module->icon }}" aria-hidden="true"></i></td>
                                        <td>
                                            <ul class="list-unstyled">
                                                @foreach($module->roles as $role)
                                                <li>{{title_case($role->name)}}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>
                                            @if($module->isVisible())
                                                <i class="fa fa-eye color-green" aria-hidden="true"></i>
                                            @else
                                                <i class="fa fa-eye-slash color-red" aria-hidden="true"></i>
                                            @endif

                                            @if($module->isActive())
                                                <i class="icon-status img-circle bg-green"></i>
                                            @else
                                                <i class="icon-status img-circle bg-red"></i>
                                            @endif
                                        </td>
                                        <td>
                                            @ability('administrador', 'administracion.modulos.editar')
                                            <a href="{{ route('modules.edit',[$module->id]) }}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                            @endability
                                            @ability('administrador', 'administracion.modulos.borrar')
                                            <a href="{{route('modules.destroy', $module->id)}}" data-method="delete" data-token="{{csrf_token()}}" data-confirm="¿Está seguro?" class="record_delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                            @endability
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7">No existen registros</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
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
                    console.log($this.parent().parent());
                    $this.parent().parent().remove();
                });
            });
        });
    </script>
@stop
