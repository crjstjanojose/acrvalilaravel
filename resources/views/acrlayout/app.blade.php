<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/stylemain.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-duallistbox.css') }}">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>ACR</title>
</head>

<body class="app sidebar-mini pace-done sidenav-toggled">
    <!-- Navbar-->
    <header class="app-header"><a class="app-header__logo" href="#">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" class="my-2">
        </a>
        <!-- Sidebar toggle button-->
        <!--
        <a class="app-sidebar__toggle" href="#" data-toggle="sidebar"
            aria-label="Hide Sidebar"></a> -->
        <!-- Navbar Right Menu-->
        <ul class="app-nav">
            <!-- User Menu-->
            <li class="dropdown"><a class="app-nav__item mx-4" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg mx-2"></i> {{ Auth::user()->name }}</a>
                <ul class="dropdown-menu settings-menu dropdown-menu-right">
                    <li><a class="dropdown-item" href="{{ route('alterar.senha') }}"><i class="fa fa-cog fa-lg"></i>Alterar Senha</a>
                    </li>
                    <!--
                    <li><a class="dropdown-item" href="page-user.html"><i class="fa fa-user fa-lg"></i> Perfil</a></li> -->
                    <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out fa-lg"></i>Sair</a>
                    </li>
                </ul>
            </li>
        </ul>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </header>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
        <!--
        <div class="app-sidebar__user"><img class="app-sidebar__user-avatar"
                src="https://s3.amazonaws.com/uifaces/faces/twitter/jsa/48.jpg" alt="User Image">
            <div>
                <p class="app-sidebar__user-name">João</p>
                <p class="app-sidebar__user-designation">Atendente</p>
            </div> -->
        </div>
        <ul class="app-menu my-2">
            @can('encomenda-listar-pendente')
            <li><a class="app-menu__item" href="{{ route('home') }}"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
            @endcan
            @can('grupo-listar')
            <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-shield"></i><span class="app-menu__label">Controle de
                        Acesso</span><i class="treeview-indicator fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                    @can('usuario-listar')
                    <li><a class="treeview-item" href="{{ route('users.index') }}"><i class=" icon fa fa-user" aria-hidden="true"></i>
                            Usuário</a>
                    </li>
                    @endcan
                    @can('grupo-listar')
                    <li><a class="treeview-item" href="{{ route('roles.index') }}"><i class=" icon fa fa-users" aria-hidden="true"></i>
                            Grupos</a>
                    </li>
                    @endcan
                    @can('permissao-listar')
                    <li><a class="treeview-item" href="{{ route('permissions.index') }}"><i class=" icon fa fa-check" aria-hidden="true"></i>
                            Permissões</a>
                    </li>
                    @endcan

                </ul>
            </li>
            @endcan
            @can('encomenda-listar-pendente')
            <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-laptop"></i><span class="app-menu__label">Encomendas</span><i class="treeview-indicator fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                    @can('encomenda-listar-pendente')
                    <li><a class="treeview-item" href="{{ route('encomendas.index') }}"><i class="icon fa fa-sticky-note-o" aria-hidden="true"></i>
                            Pendentes</a></li>
                    @endcan

                    @can('encomenda-listar-solicitada')
                    <li><a class="treeview-item" href="{{ route('encomendas.index.solcitadas') }}"><i class="icon fa fa-industry" aria-hidden="true"></i> Solicitadas</a>
                    </li>
                    @endcan
                    @can('encomenda-listar-entregue')
                    <li><a class="treeview-item" href="{{ route('encomendas.index.entregues') }}"><i class="icon fa fa-truck" aria-hidden="true"></i>
                            Entregues</a>
                    </li>
                    @endcan
                    @can('encomenda-listar-cancelada')
                    <li><a class="treeview-item" href="{{ route('encomendas.index.trash') }}"><i class="icon fa fa-trash"></i>
                            Canceladas</a>
                    </li>
                    @endcan
                </ul>
            </li>
            @endcan

            <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-user"></i><span class="app-menu__label">Conveniados</span><i class="treeview-indicator fa fa-user"></i></a>
                <ul class="treeview-menu">
                    @can('cliente-listar')
                    <li><a class="treeview-item" href="{{ route('conveniados.index') }}"><i class="icon fa fa-user-plus" aria-hidden="true"></i>
                            Novo Conveniado</a></li>
                    @endcan
                    @can('convenio-listar')
                    <li><a class="treeview-item" href="{{ route('convenios.index') }}"><i class="icon fa fa-user" aria-hidden="true"></i>
                            Convênio</a></li>
                    @endcan
                    @can('adm-cliente-listar')
                    <li><a class="treeview-item" href="{{ route('admconveniados.index') }}"><i class="icon fa fa-user" aria-hidden="true"></i>
                            Lista Conveniados</a></li>
                    @endcan

                </ul>
            </li>

        </ul>
    </aside>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                @yield('conteudo')
            </div>
        </div>
    </div>
    <!-- Essential javascripts for application to work-->
    <script type="text/javascript" src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/main.js') }}"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="{{ asset('js/plugins/pace.min.js') }}"></script>
    <script src="{{ asset('js/plugins/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('js/plugins/jquery.inputmask.bundle.min.js') }}"></script>
    <!-- Data table plugin-->
    <script type="text/javascript" src="{{ asset('js/plugins/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/plugins/dataTables.bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/plugins/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/plugins/jquery.bootstrap-duallistbox.min.js') }}"></script>
    @stack('scripts')
</body>

</html>
