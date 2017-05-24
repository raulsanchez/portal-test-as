<?php

namespace App\Http\Controllers;

use App\Models\UsersType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUsersTypesRequest;
use App\Http\Requests\UpdateUsersTypesRequest;

class UsersTypesController extends Controller
{
    /**
     * Display a listing of UsersType.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users_types = UsersType::all();

        return view('acl.users_types.index', compact('users_types'));
    }

    /**
     * Show the form for creating new UsersType.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('acl.users_types.create');
    }

    /**
     * Store a newly created UsersType in storage.
     *
     * @param  \App\Http\Requests\StoreUsersTypesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUsersTypesRequest $request)
    {
        $slug = str_slug($request->name, '_');
        $request->request->add(['slug' => $slug]);

        $users_type = UsersType::create($request->all());

        return redirect()->route('users_types.index');
    }


    /**
     * Show the form for editing UsersType.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users_type = UsersType::findOrFail($id);

        return view('acl.users_types.edit', compact('users_type'));
    }

    /**
     * Update UsersType in storage.
     *
     * @param  \App\Http\Requests\UpdateUsersTypesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUsersTypesRequest $request, $id)
    {
        $users_type = UsersType::findOrFail($id);
        $users_type->update($request->all());

        return redirect()->route('users_types.index');
    }


    /**
     * Display UsersType.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $users_type = UsersType::findOrFail($id);

        return view('acl.users_types.show', compact('users_type'));
    }


    /**
     * Remove UsersType from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $users_type = UsersType::findOrFail($id);
        $users_type->delete();

        return redirect()->route('users_types.index');
    }
}
