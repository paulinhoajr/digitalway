@extends('admin.layouts.admin')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Gerar CSV</h1>
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

        <form action="{{ route('admin.escolas.gerar') }}" method="post">
            @csrf
            <input type="hidden" name="id" value="{{ $escola->id }}">
            <div class="row g-3">
                <div class="col-sm-6">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome do CSV" value="{{old('nome')}}" required>
                </div>
                <div class="col-sm-6">
                    <label for="linhas" class="form-label">Linhas</label>
                    <input type="number" class="form-control" id="linhas" name="linhas" value="{{old('linhas')}}" required>
                </div>
            </div>

            <hr class="my-4">

            <button class="float-end btn btn-primary" type="submit">Gerar CSV</button>
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
