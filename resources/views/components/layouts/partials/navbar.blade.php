<nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('home') }}" class="nav-link">Home</a>
        </li>

    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
            @livewire('search')
        </li>

        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <img src="{{ Auth()->user()->imagen }}" class="user-image img-circle elevation-2"
                    alt="{{ asset('no-image.png') }}">
                <span class="d-none d-md-inline">
                    <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                </span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
                <!-- User image -->
                <li class="user-header bg-gray">
                    <img src={{ Auth::user()->imagen }} class="img-circle elevation-2">
                    @auth
                        <p>
                            {{ Auth::user()->name }}
                            <small>
                                {!! Auth::user()->admin
                                    ? '<span class="badge badge-pill badge-warning">Administrador</span>'
                                    : '<span class="badge badge-pill badge-light">Vendedor</span>' !!}
                            </small>
                        </p>
                    @else
                        <p class="d-block">Invitado</p>
                    @endauth
                </li>
                <!-- Menu Body -->

                <!-- Menu Footer-->
                <li class="user-footer">
                    <a href="{{ route('users.show', Auth::user()) }}" class="btn btn-default btn-flat">Perfil</a>
                    <a class="btn btn-default btn-flat float-right" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
                        Salir
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>

    </ul>
</nav>
