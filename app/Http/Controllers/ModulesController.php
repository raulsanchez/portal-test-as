<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Module;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\StoreModulesRequest;

class ModulesController extends Controller
{

    public function __construct()
    {
        View::share('contentheader_title', 'Mantenedor Módulos');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modules = Module::with(['parent','roles'])->get();
        return view('modules.index', compact('modules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $modules = Module::where('parent_id', '=', '0')->pluck('name', 'id');
        $roles = Role::pluck('name', 'id');
        return view('modules.create', compact('modules', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreModulesRequest $request)
    {
        try {
            $module = Module::create($request->all());
            $module->roles()->attach($request->roles);
            Cache::pull('menu.*');
        } catch (Exception $e) {
            return redirect()->route('modules.create')->with('error', 'No se pudo crear el módulo.');
        }
        return redirect()->route('modules.index')->with('success', 'El módulo ha sido creado.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function show(Module $module)
    {
        $modules = Module::findOrFail();
        return view('modules.show', compact('modules'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function edit(Module $module)
    {
        $modules = Module::pluck('name', 'id');
        $roles = Role::pluck('name', 'id');
        return view('modules.edit', compact('module', 'modules', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Module $module)
    {
        $module->update($request->all());
        $module->roles()->sync($request->roles);
        return redirect()->route('modules.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $module = Module::findOrFail($id);
        $module->delete();
        $module->roles->sync();
        return response()->json(['success', 'El módulo se ha eliminado correctamente.']);
    }
}
