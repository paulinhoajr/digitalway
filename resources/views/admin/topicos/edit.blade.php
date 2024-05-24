@extends('admin.layouts.admin')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Alterar Tópico</h1>
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

        @include('_partials.message')

        <form action="{{ route('admin.topicos.update') }}" method="post">
            @csrf
            <input type="hidden" name="id" value="{{ $topico->id }}">
            <div class="row g-3">
                <div class="col-sm-9">
                    <label for="topico" class="form-label">Tópico</label>
                    <input type="text" class="form-control" id="topico" name="topico" placeholder="Tópico" value="{{ $topico->topico }}" required>
                </div>

            </div>

            <hr class="my-4">

            <button class="float-end btn btn-primary" type="submit">Alterar Tópico</button>
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
