@extends('admin.layouts.admin')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Lista de Documentos</h1>
        <form action="{{ route('admin.documentos.index') }}" method="get">
            @csrf
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group me-2">
                    <input type="text" class="btn btn-sm btn-outline-secondary" name="search" placeholder="nome, descrição">
                </div>
                <button type="submit" class="btn btn-sm btn-outline-secondary  d-flex align-items-center gap-1">
                    <svg class="bi"><use xlink:href="#icon_search"/></svg>
                    Buscar
                </button>
            </div>
        </form>
    </div>

    <div class="table-responsive small">

        @include('_partials.message')

        <a href="{{ route('admin.documentos.create') }}" type="button" class="float-end ri btn btn-outline-secondary btn-sm">
            <svg class="bi"><use xlink:href="#icon_pdf"/></svg> NOVO DOCUMENTO</a>

        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Cidade</th>
                    <th scope="col">Escola</th>
                    <th scope="col">PDF</th>
                    <th scope="col">Situação</th>
                    <th scope="col">Criado</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
            @foreach($documentos as $documento)
                <tr>
                    <td>{{ $documento->id }}</td>
                    <td>{{ $documento->nome }}</td>
                    <td>{{ $documento->cidade ? $documento->cidade->nome : "-----" }}</td>
                    <td>{{ $documento->escola ? $documento->escola->nome : "-----" }}</td>
                    <td>
                        <a href="{{ asset('storage/documentos/'.$documento->pdf) }}" target="_blank">{{ $documento->nome }}</a>
                    </td>
                    <td>
                        @if($documento->situacao == 1)
                            <button class="btn btn-outline-success btn-sm disabled"><svg class="bi"><use xlink:href="#icon_checado"/></svg></button>
                        @else
                            <button class="btn btn-outline-danger btn-sm disabled"><svg class="bi"><use xlink:href="#icon_excluir"/></svg></button>
                        @endif
                    </td>
                    <td>{{ dateTimeUsParaDateTimeBr($documento->created_at) }}</td>
                    <td>
                        <div class="btn-group float-end" role="group" aria-label="">
                            <a href="{{ route('admin.documentos.edit', ['id'=>$documento->id]) }}" type="button" class="ri btn btn-outline-primary btn-sm"><svg class="bi"><use xlink:href="#icon_editar"/></svg> EDITAR</a>
                            <a href="{{ route('admin.documentos.delete', ['id'=>$documento->id]) }}" type="button" class="btn btn-outline-danger btn-sm"><svg class="bi"><use xlink:href="#icon_excluir"/></svg> EXCLUIR</a>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $documentos->onEachSide(1)->links('_partials.pagination') }}
    </div>
@endsection
