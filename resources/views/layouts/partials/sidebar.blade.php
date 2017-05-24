
<aside class="main-sidebar">
    <section class="sidebar">
        @if (! Auth::guest())
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="http://placehold.it/60x60" class="img-circle" alt="User Image" />
                </div>
                <div class="pull-left info">
                    <p>{{Auth::user()->name}}</p>
                    <a href="#"><i class="fa fa-circle text-success"></i>En linea</a>
                </div>
            </div>
        @endif

        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Buscar..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
        </form>

        <ul class="sidebar-menu">
            <li class="header">Menú</li>
            <li class="treeview">
                <a href="#"><i class='fa fa-link'></i> <span>Administración</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{route('users.index')}}">Usuarios</a></li>
                    <li><a href="{{route('users_types.index')}}">Tipos de Usuarios</a></li>
                    <li><a href="{{route('roles.index')}}">Roles</a></li>
                    <li><a href="{{route('permissions.index')}}">Permisos</a></li>
                </ul>
            </li>
            <li class="active"><a href="#"><i class='fa fa-link'></i> <span>Seguros</span></a></li>
        </ul>
    </section>
</aside>
