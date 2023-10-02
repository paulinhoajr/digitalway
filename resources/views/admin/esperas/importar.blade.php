@extends('admin.layouts.admin')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Importar CSV</h1>
        {{--<div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle d-flex align-items-center gap-1">
                <svg class="bi"><use xlink:href="#calendar3"/></svg>
                This week
            </button>
        </div>--}}
    </div>
    <div class="">

        @include('admin._partials.message')

        <form action="{{ route('admin.esperas.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row g-3">

                <div class="col-sm-6">
                    <label for="csv" class="form-label">Arquivo CSV</label>
                    <input type="file" class="form-control" id="csv" name="csv" required>
                </div>
            </div>

            <hr class="my-4">

            <button class="float-end btn btn-primary" type="submit">Importar CSV</button>
        </form>
    </div>
@endsection

@section('scripts')

    <script>
        $(function() {

        });

        /*$("#cpf").mask("999.999.999-99");*/

    </script>

@endsection
