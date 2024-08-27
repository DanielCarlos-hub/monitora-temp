<nav id="sidebar" aria-label="Main Navigation">
    <div class="content-header">
        <a class="font-w600 text-dual" href="{{ route('dashboard.monitoramento.home') }}" target="_blank">
            <img src="{{ asset("img/logo-icon.png") }}" width="30" height="38" alt="Freezolar" class="light-logo"/>
            <span class="smini-hide">
                <img src="{{ asset("img/logo-text.png") }}" width="152" height="38" alt="Freezolar Auto Refrigeração" class="light-logo"/>
            </span>
        </a>
    </div>

    <div class="content-side content-side-full">
        <ul class="nav-main">
            <li class="nav-main-item">
                <a class="nav-main-link{{ request()->is('monitoramento/home') ? ' active' : '' }}" href="{{route("dashboard.monitoramento.home")}}">
                    <i class="nav-main-link-icon si si-cursor"></i>
                    <span class="nav-main-link-name">Dashboard</span>
                </a>
            </li>

            <li class="nav-main-heading">Monitoramento</li>
            <li class="nav-main-item{{ request()->is('monitoramento/clientes/*') || request()->is('monitoramento/clientes') ? ' open' : '' }}">
                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="true" href="#">
                    <i class="nav-main-link-icon si si-graph"></i>
                    <span class="nav-main-link-name">Clientes</span>
                </a>
                <ul class="nav-main-submenu">
                    <li class="nav-main-item">
                        <a class="nav-main-link{{ request()->is('monitoramento/clientes') || request()->route()->getName() == 'dashboard.monitoramento.clientes.show' || request()->route()->getName() == 'dashboard.monitoramento.clientes.edit' || request()->route()->getName() == 'dashboard.monitoramento.clientes.equipamentos.index' ? ' active' : '' }}" href="{{route("dashboard.monitoramento.clientes.index")}}">
                            <i class="nav-main-link-icon fa fa-th-list"></i>
                            <span class="nav-main-link-name">Lista de Clientes</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link{{ request()->is('monitoramento/clientes/create') ? ' active' : '' }}" href="{{route("dashboard.monitoramento.clientes.create")}}">
                            <i class="nav-main-link-icon fa fa-plus-square"></i>
                            <span class="nav-main-link-name">Cadastrar Cliente</span>
                        </a>
                    </li>
                </ul>
            </li>

        </ul>
    </div>
</nav>
