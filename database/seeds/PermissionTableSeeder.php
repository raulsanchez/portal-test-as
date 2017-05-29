<?php

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission = [
            // ROLES
            [
                'name' => 'administracion.roles.lista',
                'display_name' => 'Roles Listar',
                'description' => 'Ver solo la lista de Roles'
            ],
            [
                'name' => 'administracion.roles.crear',
                'display_name' => 'Roles Crear',
                'description' => 'Crear nuevos roles'
            ],
            [
                'name' => 'administracion.roles.editar',
                'display_name' => 'Roles Editar',
                'description' => 'Editar roles'
            ],
            [
                'name' => 'administracion.roles.eliminar',
                'display_name' => 'Roles Eliminar',
                'description' => 'Elimina Roles'
            ],
            // PERMISOS
            [
                'name' => 'administracion.permisos.lista',
                'display_name' => 'Permisos Listar',
                'description' => 'Ver solo la lista de permisos'
            ],
            [
                'name' => 'administracion.permisos.crear',
                'display_name' => 'Permisos Crear',
                'description' => 'Crear nuevos permisos'
            ],
            [
                'name' => 'administracion.permisos.editar',
                'display_name' => 'Permisos Editar',
                'description' => 'Editar permisos'
            ],
            [
                'name' => 'administracion.permisos.eliminar',
                'display_name' => 'Permisos Eliminar',
                'description' => 'Elimina permisos'
            ],
            // USUARIOS
            [
                'name' => 'administracion.usuarios.lista',
                'display_name' => 'Usuarios Listar',
                'description' => 'Ver solo la lista de usuarios'
            ],
            [
                'name' => 'administracion.usuarios.crear',
                'display_name' => 'Usuarios Crear',
                'description' => 'Crear nuevos usuarios'
            ],
            [
                'name' => 'administracion.usuarios.editar',
                'display_name' => 'Usuarios Editar',
                'description' => 'Editar usuarios'
            ],
            [
                'name' => 'administracion.usuarios.eliminar',
                'display_name' => 'Usuarios Eliminar',
                'description' => 'Elimina usuarios'
            ],
            // MODULOS
            [
                'name' => 'administracion.modulos.lista',
                'display_name' => 'Modulos Listar',
                'description' => 'Ver solo la lista de modulos'
            ],
            [
                'name' => 'administracion.modulos.crear',
                'display_name' => 'Modulos Crear',
                'description' => 'Crear nuevos modulos'
            ],
            [
                'name' => 'administracion.modulos.editar',
                'display_name' => 'Modulos Editar',
                'description' => 'Editar modulos'
            ],
            [
                'name' => 'administracion.modulos.eliminar',
                'display_name' => 'Modulos Eliminar',
                'description' => 'Elimina modulos'
            ],
        ];

        foreach ($permission as $key => $value) {
            Permission::create($value);
        }
    }
}
