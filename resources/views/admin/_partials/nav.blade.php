<ul class="nav flex-column">
    <li class="nav-item">
        <a class="nav-link d-flex align-items-center gap-2 active" aria-current="page" href="{{ route('admin.index') }}">
            <svg class="bi"><use xlink:href="#icon_house-fill"/></svg>
            Dashboard
        </a>
    </li>

</ul>
<h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-body-secondary text-uppercase">
    <span>Pessoas</span>
</h6>
<ul class="nav flex-column">

    <li class="nav-item">
        <a class="nav-link d-flex align-items-center gap-2" href="{{ route('admin.usuarios.index') }}">
            <svg class="bi"><use xlink:href="#icon_usuarios"/></svg>
            Usuários
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link d-flex align-items-center gap-2" href="{{ route('admin.esperas.index') }}">
            <svg class="bi"><use xlink:href="#icon_ampulheta"/></svg>
            Espera
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link d-flex align-items-center gap-2" href="{{ route('admin.certificados.index') }}">
            <svg class="bi"><use xlink:href="#icon_qrcode"/></svg>
            Certificados
        </a>
    </li>
</ul>

<h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-body-secondary text-uppercase">
    <span>Geral</span>
    {{--<a class="link-secondary" href="#" aria-label="Add a new report">
        <svg class="bi"><use xlink:href="#icon_plus-circle"/></svg>
    </a>--}}
</h6>
<ul class="nav flex-column mb-auto">
    <li class="nav-item">
        <a class="nav-link d-flex align-items-center gap-2" href="{{ route('admin.escolas.index') }}">
            <svg class="bi"><use xlink:href="#icon_escola"/></svg>
            Escolas
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link d-flex align-items-center gap-2" href="{{ route('admin.treinamentos.index') }}">
            <svg class="bi"><use xlink:href="#icon_treinamento"/></svg>
            Treinamentos
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link d-flex align-items-center gap-2" href="{{ route('admin.videos.index') }}">
            <svg class="bi"><use xlink:href="#icon_video"/></svg>
            Vídeos
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link d-flex align-items-center gap-2" href="{{ route('admin.documentos.index') }}">
            <svg class="bi"><use xlink:href="#icon_pdf"/></svg>
            Documentos
        </a>
    </li>

</ul>

<hr class="my-3">

<ul class="nav flex-column mb-auto">
    {{--<li class="nav-item">
        <a class="nav-link d-flex align-items-center gap-2" href="#">
            <svg class="bi"><use xlink:href="#icon_gear-wide-connected"/></svg>
            Settings
        </a>
    </li>--}}
    <li class="nav-item">
        <a class="nav-link d-flex align-items-center gap-2" href="{{ route('usuario.logout') }}">
            <svg class="bi"><use xlink:href="#icon_door-closed"/></svg>
            Sair
        </a>
    </li>
</ul>
