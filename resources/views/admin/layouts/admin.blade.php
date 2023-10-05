<!doctype html>
<html lang="{{ config('app.locale') }}" data-bs-theme="auto">
    <head>
        <title>Admin</title>

        @include('admin._partials.head')

        <style>

        </style>

        @yield('head')
    </head>
    <body>
        @include('_partials.icons')

        @include('admin._partials.header')

        <div class="container-fluid">
            <div class="row">
                <div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
                    <div class="offcanvas-md offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu"
                         aria-labelledby="sidebarMenuLabel">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="sidebarMenuLabel">{{ config('app.name') }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu"
                                    aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
                            @include('admin._partials.nav')
                        </div>
                    </div>
                </div>

                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                    @yield('content')

                </main>


            </div>
        </div>

        @include('admin._partials.scripts')

        @yield('scripts')
    </body>
</html>
