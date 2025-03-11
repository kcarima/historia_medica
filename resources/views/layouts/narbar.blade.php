<header id="header" class="header sticky-top">
    <div class="topbar d-flex align-items-center">
        <div class="container d-flex justify-content-center justify-content-md-between">
        <div class="d-none d-md-flex align-items-center">
            <a href="#" class="logo d-flex align-items-center me-auto">
                <img src="{{asset('assets/img/logo.png')}}">
                <h1 class="sitename">Sistema de Citas de Registro Médico</h1>
            </a>
        </div>

        </div>
    </div><!-- End Top Bar -->

    <div class="branding d-flex align-items-center">
        <div class="container position-relative d-flex align-items-center justify-content-end">


        <nav id="navmenu" class="navmenu">
            <ul>
            <li><a href="#">Citas</a></li>
            <li><a href="#">Especialidades</a></li>
            <li><a href="#">Doctores</a></li>
            <li><a href="{{-- route('historia') --}}#">Historias</a></li>
            <li class="dropdown"><a href="#"><span>Reportes</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                <ul>
                    <ol>
                <li><a href="#">Dropdown 1</a></li>
                <li class="dropdown"><a href="#"><span>Deep Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                    <ul>
                        <ol>
                        <li><a href="#">Deep Dropdown 1</a></li>
                        <li><a href="#">Deep Dropdown 2</a></li>
                        <li><a href="#">Deep Dropdown 3</a></li>
                        <li><a href="#">Deep Dropdown 4</a></li>
                        <li><a href="#">Deep Dropdown 5</a></li>
                        </ol>
                    </ul>
                </li>
                <li><a href="#">Dropdown 2</a></li>
                <li><a href="#">Dropdown 3</a></li>
                <li><a href="#">Dropdown 4</a></li>
                    </ol>
                </ul>
            </li>

            <li class="dropdown" ><a href="#">Usuario<i class="bi bi-chevron-down toggle-dropdown"></i></a>
                <ul>
                    <li><a href="#">Editar Perfil</a></li>
                </ul>
            </li>
            <li>
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Salir') }}
                    </x-responsive-nav-link>
                </form></li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        <a class="cta-btn" href="#">Dashboard</a>

        </div>

    </div>
</header>
