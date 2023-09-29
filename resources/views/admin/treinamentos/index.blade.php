@extends('admin.layouts.admin')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Lista de Treinamentos</h1>
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
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Cidade</th>
                    <th scope="col">Escola</th>
                    <th scope="col">Situação</th>
                    <th scope="col">Criado</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
            @foreach($treinamentos as $treinamento)
                <tr>
                    <td>{{ $treinamento->id }}</td>
                    <td>{{ $treinamento->nome }}</td>
                    <td>{{ $treinamento->cidade ? $treinamento->cidade->nome : "-----" }}</td>
                    <td>{{ $treinamento->escola ? $treinamento->escola->nome : "-----" }}</td>
                    <td>
                        @if($treinamento->situacao == 1)
                            <button class="btn btn-outline-success btn-sm disabled"><svg class="bi"><use xlink:href="#checado"/></svg></button>
                        @else
                            <button class="btn btn-outline-danger btn-sm disabled"><svg class="bi"><use xlink:href="#excluir"/></svg></button>
                        @endif
                    </td>
                    <td>{{ dateTimeUsParaDateTimeBr($treinamento->created_at) }}</td>
                    <td>
                        <div class="btn-group float-end" role="group" aria-label="">
                            <a href="" type="button" class="ri btn btn-outline-primary btn-sm"><svg class="bi"><use xlink:href="#editar"/></svg> EDITAR</a>
                            <a href="" type="button" class="btn btn-outline-danger btn-sm"><svg class="bi"><use xlink:href="#excluir"/></svg> EXCLUIR</a>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $treinamentos->onEachSide(1)->links('admin._partials.pagination') }}
    </div>
@endsection
