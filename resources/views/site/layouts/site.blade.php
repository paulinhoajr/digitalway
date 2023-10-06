<!doctype html>
<html lang="{{ config('app.locale') }}" data-bs-theme="auto">
    <head>
        <title>Site</title>

        @include('site._partials.head')

        <style>

        </style>

        @yield('head')
    </head>
    <body>
        @include('_partials.icons')

        <div class="container">
        @include('site._partials.header')

        <main style="bottom: 0;">
            {{--<h1 class="visually-hidden">Headers examples</h1>--}}

                {{--<div class="b-example-divider"></div>--}}

                @yield('content')

        </main>

        @include('site._partials.footer')

        </div>

        @include('site._partials.scripts')

        @yield('scripts')
    </body>
</html>
