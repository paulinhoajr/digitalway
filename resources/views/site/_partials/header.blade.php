<header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
    <a href="{{ route('site.index') }}" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
        <img src="{{ asset('images/favicons/apple-touch-icon.png') }}" alt="" width="60"/>
        <span class="fs-4 ms-4">{{ config('app.name') }}</span>
    </a>

    <ul class="nav nav-pills">

        @if(Auth::check())
            <li class="nav-item">
                <a href="{{ route('site.index') }}" class="nav-link {{ setActive('home') }}">Home</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('site.certificados') }}" class="nav-link {{ setActive('certificados') }}">Certificados</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('site.escolas') }}" class="nav-link {{ setActive('escolas') }}">Escolas</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('site.documentos') }}" class="nav-link {{ setActive('documentos') }}">Documentos</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('site.videos') }}" class="nav-link {{ setActive('videos') }}">Vídeos</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('site.usuarios.edit') }}" class="nav-link {{ setActive('usuarios/edit') }}">Meus Dados</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('usuario.logout') }}" class="nav-link">Sair</a>
            </li>

        @endif

    </ul>

</header>
