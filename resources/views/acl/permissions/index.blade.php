@extends('layouts.app')

@section('content')
    @ability('administrador', 'administracion.permisos.crear')
    <div class="row">
        <div class="col-md-12">
            <div style="margin-bottom: 50px">
                <a href="{{ route('permissions.create')}}" class="pull-right btn btn-md btn-success">Crear Permiso</a>
            </div>
        </div>
    </div>
    @endability
    <div class="panel panel-default">
        <div class="panel-heading">
            Permisos
        </div>
        <div class="panel-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Identificador</th>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($permissions as $permission)
                        <tr>
                            <td>{{ $permission->id }}</td>
                            <td>{{ $permission->name }}</td>
                            <td>{{ $permission->display_name }}</td>
                            <td>{{ $permission->description }}</td>
                            <td>
                                <a href="{{ route('permissions.edit', $permission) }}" class=""><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                @permission('delete_roles')
                                    <a href="{{route('permissions.distroy', $permission)}}" data-method="delete" data-token="{{csrf_token()}}" data-confirm="¿Está seguro?"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                @endpermission
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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

        $('#select-perms').multiSelect({
            selectableHeader: "<div class='custom-header'>Selectable items</div>",
            selectionHeader: "<div class='custom-header'>Selection items</div>",
            afterSelect: function (value){
                $.ajax({
                    url: '{{ URL::to("/permissions/assign") }}',
                    type: 'POST',
                    dataType: 'json',
                    data : {
                        permission_id: value[0],
                        role_id: role_id
                    }
                }).done(function (data) {
                    console.log(data);
                });
            },

            afterDeselect: function (value){
                $.ajax({
                    url: '{{ URL::to("/permissions/remove") }}',
                    type: 'DELETE',
                    dataType: 'json',
                    data: {
                        permission_id: value[0],
                        role_id: role_id
                    }
                }).done(function (data) {

                });
            }

        });

        $('.get-perms').on('click', function(){
            role_id = $(this).attr('role_id');
            $('#select-perms').multiSelect('refresh');
            $('#select-perms option').attr('selected', false);
               $.ajax({
                url : '{{ URL::to("/permissions/assigned") }}',
                type : 'GET',
                dataType: 'json',
                data : {role_id: role_id}
            }).done(function(data){
                $.each(data.assigned, function (index, value) {
                    $('#select-perms option[value="'+value.id+'"]').attr('selected', true);
                });
                $('#select-perms').multiSelect('refresh');
            });
        });
    }); //ready
</script>
@stop
