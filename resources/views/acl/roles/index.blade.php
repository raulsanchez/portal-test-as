@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div style="margin-bottom: 50px">
                <a href="{{ route('roles.create')}}" class="pull-right btn btn-md btn-success">Create Role</a>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            Roles
        </div>
        <div class="panel-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Identificador</th>
                        <th>Descripción</th>
                        <th>Permisos</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <td>{{ $role->id }}</td>
                            <td>{{ $role->name }}</td>
                            <td>{{ $role->description }}</td>
                            <td>
                            {{-- @if(Auth::check()) --}}
                                {{-- @if(Auth::user()->hasRole('admin')) --}}
                                    <button type="button" class="btn btn-info btn-xs get-perms" role_id="{{ $role->id }}" data-toggle="modal" data-target=".permissions-modal">Permisos</button>
                                {{-- @endif --}}
                            {{-- @endif --}}
                            </td>
                            <td>
                                <a href="{{ route('roles.edit', $role) }}" class=""><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                @permission('delete_roles')
                                    <a href="{{route('roles.distroy', $role)}}" data-method="delete" data-token="{{csrf_token()}}" data-confirm="¿Está seguro?"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                @endpermission
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @include('acl.roles.permissions.modal')
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
            selectableHeader: "<div class='custom-header'>Permisos Disponibles</div>",
            selectionHeader: "<div class='custom-header'>Permisos Asignados</div>",
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
                    $('#select-perms')
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
                    console.log(data);
                    $.each(data.assigned, function (index, value) {
                        $('#select-perms option[value="'+value.id+'"]').attr('selected', true);
                    });
                    $('#select-perms').multiSelect('refresh');
                });
            });
        }); //ready
</script>
@stop
