<?php
namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
use App\Http\Requests;
use Illuminate\Http\Request;

class PermissionsController extends Controller
{
    /**
     * Display a listing of the permissions.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::all();
        return view('acl.permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new Role.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('acl.permissions.create');
    }

    public function show()
    {
        return view('acl.permissions.create');
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

        Permission::create($request->all());
        return redirect()->route('permissions.index')->withSuccess('El permiso ha sido creado correctamente.');
    }

    /**
     * Show the form for editing the specified resource.
     * @param  Role   $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        return view('acl.permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Permission    $permission
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Permission $permission, Request $request)
    {

        $this->validate($request, [
            'display_name' => 'required',
            'description' => 'required'
        ]);

        $permission->update($request->only('display_name', 'description'));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     * @param  Role   $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        if (!Auth::user()->can('delete_roles')) {
            return back()->withError("You don't have permission for this action.");
        }

        // Force Delete
        $permission->users()->sync([]); // Delete relationship data
        $permission->perms()->sync([]); // Delete relationship data

        $permission->forceDelete();
        return redirect()->route('role_index');
    }
    /**
     * Get permissions assigned.
     * @param  Request $request
     * @return JSON
     */
    public function permsAssigned(Request $request)
    {
        try {
            $role = Role::findOrFail($request->role_id);
            $perms = $role->perms;
            $notAssigned = $this->permsNotAssigned($perms);
            return response()->json([
                'assigned' => $perms,
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
     * @param  Collection $perms
     * @return array
     */
    public function permsNotAssigned($perms)
    {
        $permissions = Permission::all();
        $notAssigned = $permissions->diff($perms);
        return $notAssigned->all();
    }
    /**
     * Attach permission to the role.
     * @param  Request $request
     * @return JSON
     */
    public function assign(Request $request)
    {
        $role = Role::findOrFail($request->role_id);
        $role->attachPermission($request->permission_id);
        return response()->json([
            'message' => 'Permission has been assigned'
        ]);
    }
    /**
     * Remove the specified resource from storage.
     * @param  Request $request
     * @return JSON
     */
    public function remove(Request $request)
    {
        $role = Role::findOrFail($request->role_id);
        $permission = Permission::findOrFail($request->permission_id);
        $role->detachPermission($permission);
        return response()->json([
            'message' => 'Permission has been removed'
        ]);
    }
}
