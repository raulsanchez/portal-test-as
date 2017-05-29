<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
use App\Models\User;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;

class RolesController extends Controller
{

    /**
     * Display a listing of the Roles.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        $permissionsDb = Permission::all();
        foreach ($permissionsDb as $key => $permission) :
            list($group, $module, $action) = explode('.', $permission->name);
            $allPermissions[$group][$permission->id]['id'] = $permission->id;
            $allPermissions[$group][$permission->id]['display_name'] = $permission->display_name;
            $allPermissions[$group][$permission->id]['action'] = $action;
            $allPermissions[$group][$permission->id]['module'] = $module;
        endforeach;
        return view('acl.roles.index', compact('roles', 'allPermissions'));
    }

    /**
     * Show the form for creating a new Role.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('acl.roles.create');
    }

    /**
     * Store a newly created resource in the storage.
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'display_name' => 'required',
            'description'  => 'required'
        ]);

        Role::create($request->all());
        return redirect()->route('roles.index')->withSuccess('El rol ha sido creado.');
    }

    /**
     * Show the form for editing the specified resource.
     * @param  Role   $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        return view('acl.roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Role    $role
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Role $role, Request $request)
    {
        $this->validate($request, [
            'description' => 'required'
        ]);

        $role->update($request->only('description'));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     * @param  Role   $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        if (!Auth::user()->can('delete_roles')) {
            return back()->withError("You don't have permission for this action.");
        }

        // Force Delete
        $role->users()->sync([]); // Delete relationship data
        $role->perms()->sync([]); // Delete relationship data

        $role->forceDelete();
        return redirect()->route('role_index');
    }
    public function assigned(Request $request)
    {

        try {
            $user = User::findOrFail($request->user_id);
            $roles = $user->roles;
            $notAssigned = $this->rolesNotAssigned($roles);
            return response()->json([
                'assigned' => $roles,
                'status' => 'success'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'assigned' => '',
                'status' => 'error',
                'message' => $e
            ]);
        }
    }

    /**
     * Get permissions not assigned.
     * @param  Collection $roles
     * @return array
     */
    public function rolesNotAssigned($roles)
    {
        $rolesAll = Role::all();
        $notAssigned = $rolesAll->diff($roles);
        return $notAssigned->all();
    }

    /**
     * Se agrega roles a la persona.
     * @param  Request $request
     * @return JSON
     */
    public function assign(Request $request)
    {

        $user = User::findOrFail($request->user_id);
        $user->attachRole($request->role_id);
        return response()->json([
            'message' => 'Rol asignado correctamente',
            'status' => 'success',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     * @param  Request $request
     * @return JSON
     */
    public function remove(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        $user->detachRole($request->role_id);

        return response()->json([
            'message' => 'Role has been removed'
        ]);
    }
}
