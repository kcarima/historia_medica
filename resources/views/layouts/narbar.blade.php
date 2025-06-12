<header id="header" class="header sticky-top">
    <div class="branding d-flex align-items-center">
        <a href="{{ url('/') }}" class="logo-link" style="margin-left:20%;">
            <img src="{{ asset('assets/img/clinica anfe.png') }}" alt="Logo de la Clínica" style="height:100px;">
        </a>
        <div class="container position-relative d-flex align-items-center justify-content-end">
            <nav id="navmenu" class="navmenu">
                <ul>
                    <!-- PACIENTES -->
                    <li class="dropdown">
                        <a href="#">
                            <span>Pacientes</span>
                            <i class="bi bi-chevron-down toggle-dropdown"></i>
                        </a>
                        <ul>
                            <ol>
                                <li><a href="{{ route('historia.buscar') }}">Buscar Historia</a></li>


                                <li><a href="{{ route('pacientes.index') }}">Pacientes</a></li>
                                <li><a href="{{ url('pacientes/historia/reposoreposo000001') }}">Reposo Médico</a></li>
                                <li><a href="{{ route('reporte_enfermeria.index') }}">Enfermería</a></li>
                            </ol>
                        </ul>
                    </li>
                    <!-- SOLICITUDES -->
                    <li class="dropdown">
                        <a href="#">
                            <span>Solicitudes</span>
                            <i class="bi bi-chevron-down toggle-dropdown"></i>
                        </a>
                        <ul>
                            <ol>
                                <li><a href="{{ route('pacientes.solicitud_laboratorio') }}">Solicitud de Laboratorios</a></li>
                                <li><a href="{{ route('pacientes.solicitud_imagenologia') }}">Solicitud de Imagenología</a></li>
                            </ol>
                        </ul>
                    </li>
                    <!-- IMAGENOLOGÍA/LABORATORIO -->
                    <li class="dropdown">
                        <a href="#"><span>Imagenología/Laboratorio</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                        <ul>
                            <ol>
                                <li><a href="{{ route('pacientes.imagenologia') }}">Imagenología</a></li>
                                <li><a href="{{ route('pacientes.foraneas') }}">Imágenes Foráneas</a></li>
                            </ol>
                        </ul>
                    </li>
                    <!-- REPORTES -->
                    <li class="dropdown">
                        <a href="#"><span>Reportes</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                        <ul>
                            <ol>

                                <li><a href="{{ route('pacientes.reportes.pdf_pacientes') }}">Reporte de Pacientes</a></li>
                                <li><a href="{{ route('pacientes.reportes.pdf_diagnosticos') }}">Reporte de Diagnósticos</a></li>
                                <li><a href="{{ route('pacientes.reportes.medicos') }}">Reporte de Médicos</a></li>
                                <li><a href="{{ route('reportes.pacientes_atendidos') }}">Pacientes Atendidos</a></li>

                            </ol>
                        </ul>
                    </li>
                    <!-- USUARIO -->


            <li class="dropdown" ><a href="#">Usuario<i class="bi bi-chevron-down toggle-dropdown"></i></a>
                <ul>
                    <ol>
                        <li><a href="{{ route('users.index') }}">Gestor de Usuario</a></li>
                        <li><a href="#">Gestor de Roles</a></li>
                        <li><a href="#">Editar Clave</a></li>
                    </ol>
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

        {{--   <a class="cta-btn" href="#">Dashboard</a>  --}}

        </div>
    </div>
</header>
