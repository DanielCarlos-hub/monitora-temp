<nav id="sidebar" aria-label="Main Navigation">
    <div class="content-header">
        <a class="font-w600 text-dual" href="{{ route('cliente.home', request()->tenant) }}" target="_blank">
            <img src="{{ asset("img/logo-icon.png") }}" width="30" height="38" alt="Freezolar" class="light-logo"/>
            <span class="smini-hide">
                <img src="{{ asset("img/logo-text.png") }}" width="152" height="38" alt="Freezolar Auto Refrigeração" class="light-logo"/>
            </span>
        </a>
    </div>

    <div class="content-side content-side-full">
        <ul class="nav-main">
            <li class="nav-main-item">
                <a class="nav-main-link{{ request()->route()->getName() == "cliente.home" ? ' active' : '' }}" href="{{route("cliente.home", request()->tenant)}}">
                    <i class="nav-main-link-icon si si-cursor"></i>
                    <span class="nav-main-link-name">Dashboard</span>
                </a>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link{{ request()->route()->getName() == "cliente.config" ? ' active' : '' }}" href="{{route("cliente.config", request()->tenant)}}">
                    <i class="nav-main-link-icon fa fa-cog"></i>
                    <span class="nav-main-link-name">Configurações</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
