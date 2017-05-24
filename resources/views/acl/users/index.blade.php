@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div style="margin-bottom: 50px">
                <a href="{{ route('users.create')}}" class="pull-right btn btn-md btn-success">Crear Usuario</a>
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
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>

                            @ability('administrador', 'administracion.usuario.editar')
                                <a href="{{ route('users.edit', $user) }}" class=""><i class="fa fa-pencil" aria-hidden="true"></i></a>
                            @endability

                            @ability('administrador', 'administracion.usuario.eliminar')
                                <a href="{{route('users.destroy', $user)}}" data-method="delete" data-token="{{csrf_token()}}" data-confirm="¿Está seguro?"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            @endability

                            @ability('administrador', 'administracion.usuario.roles')
                            <a href="#" data-toggle="modal" data-user_id="{{$user->id}}" id="LMroles" data-target="#Mroles">
                                <i class="fa fa-user-plus" aria-hidden="true"></i>
                            </a>
                            @endability
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @include('acl.users.roles.modal')
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

        $('#select-roles').multiSelect({
            selectableHeader: "<div class='custom-header'>Permisos Disponibles</div>",
            selectionHeader: "<div class='custom-header'>Permisos Asignados</div>",
            afterSelect: function (value){
                var user_id = $('#LMroles').data('user_id');
                $.ajax({
                    url: '{{route("roles.assign")}}',
                    type: 'POST',
                    dataType: 'json',
                    data : {
                        role_id: value[0],
                        user_id: user_id
                    }
                }).done(function (data) {

                });
            },

            afterDeselect: function (value){
                var user_id = $('#LMroles').data('user_id');

                $.ajax({
                    url: '{{route("roles.remove")}}',
                    type: 'DELETE',
                    dataType: 'json',
                    data: {
                        role_id: value[0],
                        user_id: user_id
                    }
                }).done(function (data) {
                    $('#select-roles')
                });
            }

        });

        $('#LMroles').on('click', function(){
            var user_id = $(this).data('user_id');
            $('#select-roles').multiSelect('refresh');
            $('#select-roles option').attr('selected', false);
                $.ajax({
                    url : '{{route("roles.assigned")}}',
                    type : 'GET',
                    dataType: 'json',
                    data : {user_id: user_id}
                }).done(function(data){
                    $.each(data.assigned, function (index, value) {
                        console.log(value.id);

                        console.log($('#select-roles option[value="'+value.id+'"]').attr('selected', true))
                        $('#select-roles option[value="'+value.id+'"]').attr('selected', true);
                    });
                    $('#select-roles').multiSelect('refresh');
                });
            });
        }); //ready
</script>
@stop

