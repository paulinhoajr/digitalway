@extends('admin.layouts.admin')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Lista de Certificados</h1>
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

        @include('_partials.message')

        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Usuário</th>
                    <th scope="col">Treinamento</th>
                    <th scope="col">Criado</th>
                    {{--<th scope="col"></th>--}}
                </tr>
            </thead>
            <tbody>
            @foreach($certificados as $certificado)
                <tr>
                    <td>{{ $certificado->id }}</td>
                    <td>{{ $certificado->usuario->nome }}</td>
                    <td>{{ $certificado->treinamento->nome }}</td>
                    <td>{{ dateTimeUsParaDateTimeBr($certificado->created_at) }}</td>
                    {{--<td>
                        <div class="btn-group float-end" role="group" aria-label="">
                            <a href="" type="button" class="ri btn btn-outline-primary btn-sm"><svg class="bi"><use xlink:href="#editar"/></svg> EDITAR</a>
                            <a href="" type="button" class="btn btn-outline-danger btn-sm"><svg class="bi"><use xlink:href="#excluir"/></svg> EXCLUIR</a>
                        </div>
                    </td>--}}
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $certificados->onEachSide(1)->links('_partials.pagination') }}
    </div>
@endsection
