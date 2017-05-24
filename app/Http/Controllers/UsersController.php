<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Muestra la lista de usuarios.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $roles = Role::all();
        // $users->attachRole('3');
        // dd($users);

        return view('acl.users.index', compact('users', 'roles'));
    }

    /**
     * Muestra el formulario para crear un nuevo usuario.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Almacena el registro recien creado en la base de datos
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'password'  => 'required'
        ]);
        $request->merge(['password' => bcrypt($request->password)]);
        User::create($request->all());

        return redirect()->route('users.index')->withSuccess('El usuario ha sido creado.');
    }

    public function show()
    {
    }

    /**
     * Muestra el formulario para modificar un registro en específico.
     * @param  User   $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('acl.users.edit', compact('user'));
    }

    /**
     * Actualiza un registro especificado en la base de datos.
     * @param  User    $user
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(User $user, Request $request)
    {
        $this->validate($request, [
            'description' => 'required'
        ]);

        $user->update($request->only('description'));
        return back();
    }

    /**
     * Remueve un registro en especifico de la base de datos.
     * @param  User   $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
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


}
