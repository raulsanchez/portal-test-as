<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Module;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class MenusController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function get()
    {
        $user = \Auth::user();
        if ($user->roles) :
            // if (cache::has('menu.'.$user->id)) :
            //     $menu = cache::get('menu.'.$user->id);
            //     return response($menu);
            // else :
                // Recorro los roles asignados del usuarios actual
            foreach ($user->roles as $role) :
                $roles[$role->id] = $role->id;
            endforeach;

            // busco todos los ID de modulos correspondiente a los roles actuales del usuario
            $modulesSearch = DB::table('module_role')
                                ->where('role_id', $roles)
                                ->pluck('role_id', 'module_id')
                                ->toArray();
            // Se obtienen todos modulos con el o los ID obtenidos anteriormente
            $modules = Module::whereIn('id', array_keys($modulesSearch))
                    ->where('parent_id', '!=', '0')
                    ->where('visualize', '=', 'si')
                    ->where('status', '=', 'activo')
                    ->orderBy('order', 'asc')
                    ->get();
            // Se genera el array para ser enviado al json
            foreach ($modules as $module) :
                if (!isset($menu[$module->parent->id])) :
                    $menu[$module->parent->id]['data']['name'] = $module->parent->name;
                    $menu[$module->parent->id]['data']['icon'] = $module->parent->icon;
                    $menu[$module->parent->id]['data']['link'] = $module->parent->link;
                endif;
                $menu[$module->parent->id]['data']['childs'][] = $module;
            endforeach;

            // Cache::forever('menu.'.$user->id, json_encode($menu));
            return response()->json($menu);
            // endif;
        else :
            return response()->json([
                    'status' => 'error',
                    'message' => 'No tiene rol asignado'
                ]);
        endif;
    }

    public function generateMenu(Request $request)
    {
        $url = key($request->all());
        $menuSuperior = json_decode($this->get()->content());
        $menuFinal = '<li class="header">Menú</li>';
        foreach ($menuSuperior as $key => $menus) :
            $menuInterno = '';
            $menuTree = '';
            $classLi = '';
            if ($menus->data->childs) :
                $classUl = 'treeview-menu';
                foreach ($menus->data->childs as $menu) :
                    if ($menu->link == $url) :
                        $classUl .= ' menu-open ';
                        $classLi .= ' active ';
                        $classLiInterno = 'active';
                    else :
                        $classLiInterno = '';
                    endif;
                    $menuInterno.='<li class="'.$classLiInterno.'">';
                        $menuInterno.='<a href="'.$menu->link.'">';
                            $menuInterno.='<i class="fa '.$menu->icon.'"></i>';
                            $menuInterno.=$menu->name;
                        $menuInterno.='</a>';
                    $menuInterno.='</li>';
                endforeach;
                $menuTree.='<ul class="'.$classUl.'">';
                $menuTree.= $menuInterno;
                $menuTree.='</ul>';
            endif;
            $classLi .= ' treeview ';
            $menuFinal.='<li class="'.$classLi.'">';
            $menuFinal.='<a href="'.$menus->data->link.'">';
            $menuFinal.='<i class="fa '.$menus->data->icon.'"></i>';
            $menuFinal.=' <span>'.$menus->data->name.'</span>';
            $menuFinal.='<i class="fa fa-angle-left pull-right"></i></a>';
            $menuFinal.= $menuTree;
            $menuFinal.='</li>';
        endforeach;
        echo $menuFinal;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
}
