<!doctype html>
<html lang="{{ config('app.locale') }}" data-bs-theme="auto">
<head>
    <title>sistema.digitalw.com.br</title>

    @include('site._partials.head')

    <style>

    </style>

    @yield('head')
</head>
<body>
@include('_partials.icons')

<div class="container-fluid headerfooter_bg">
    <div class="container">
    @include('site._partials.header')
    </div>
</div>
<div class="container meio">

    <main>
        {{--<h1 class="visually-hidden">Headers examples</h1>--}}

        {{--<div class="b-example-divider"></div>--}}

        @yield('content')

    </main>



</div>

<div class="container-fluid headerfooter_bg">
    <div class="container">
        @include('site._partials.footer')
    </div>
</div>

@include('site._partials.scripts')

@yield('scripts')
</body>
</html>
