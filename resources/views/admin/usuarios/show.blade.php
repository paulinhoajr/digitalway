@extends('admin.layouts.admin')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dados de {{ $usuario->nome }}</h1>
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

    <div class="table-responsive small">
        <h5>Escolas</h5>
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Escola</th>
                    <th scope="col">Cidade</th>
                    <th scope="col">Criado</th>
                </tr>
            </thead>
            <tbody>
            @foreach($usuario->escolas as $usuarioEscola)
                <tr>
                    <td>{{ $usuarioEscola->id }}</td>
                    <td>{{ $usuarioEscola->escola->nome }}</td>
                    <td>{{ $usuarioEscola->escola->cidade->nome }}</td>
                    <td>{{ dateTimeUsParaDateTimeBr($usuario->created_at) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <h5>Certificados</h5>
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Treinamento</th>
                <th scope="col">Criado</th>
            </tr>
            </thead>
            <tbody>
            @foreach($certificados as $certificado)
                <tr>
                    <td>{{ $certificado->id }}</td>
                    <td>{{ $certificado->treinamento->nome }}</td>
                    <td>{{ dateTimeUsParaDateTimeBr($certificado->created_at) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
