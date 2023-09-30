@extends('admin.layouts.admin')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Excluir {{ $treinamento->nome }}</h1>
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

        <p>Confirma que gostaria de excluir o treinamento {{$treinamento->nome}}?</p>
        <a href="{{ route('admin.treinamentos.destroy', ['id'=>$treinamento->id]) }}" type="button" class="float-end btn btn-outline-danger btn-sm">
            <svg class="bi"><use xlink:href="#excluir"/></svg> EXCLUIR</a>

    </div>
@endsection
