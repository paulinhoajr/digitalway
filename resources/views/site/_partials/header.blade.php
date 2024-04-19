<header class="d-flex flex-wrap justify-content-center py-3 color_white">

<nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a href="{{ route('site.index') }}" class="d-flex align-items-center mb-3 me-5">
                <img src="{{ asset('images/logo-digitalway.svg') }}" alt="Logo DigitalWay" class="img-fluid"/>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">


                <ul class="nav nav-pills">

                    @if(Auth::check())
                        <li class="nav-item">
                            <a href="{{ route('site.index') }}" class="nav-link {{ setActive('home') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('site.usuarios.escolas') }}" class="nav-link {{ setActive('usuarios/escolas') }}">Escolas</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('site.usuarios.certificados') }}" class="nav-link {{ setActive('usuarios/certificados') }}">Certificados</a>
                        </li>

                        {{--            <li class="nav-item">
                                        <a href="{{ route('site.usuarios.documentos') }}" class="nav-link {{ setActive('documentos') }}">Documentos</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('site.usuarios.videos') }}" class="nav-link {{ setActive('videos') }}">Vídeos</a>
                                    </li>--}}
                        <li class="nav-item">
                            <a href="{{ route('site.usuarios.edit') }}" class="nav-link {{ setActive('usuarios/edit') }}">Meus Dados</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('usuario.logout') }}" class="nav-link">Sair</a>
                        </li>

                    @endif

                </ul>


            </div>
        </div>
    </nav>





</header>
